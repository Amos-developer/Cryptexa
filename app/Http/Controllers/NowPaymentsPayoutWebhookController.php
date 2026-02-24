<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NowPaymentsPayoutWebhookController extends Controller
{
    public function handle(Request $request)
    {
        try {
            Log::info('NOWPayments Payout Webhook received', $request->all());

            $payoutId = $request->input('id');
            $status = $request->input('status');
            $txid = $request->input('hash');

            // Find withdrawal by payout_id
            $withdrawal = Withdrawal::where('payout_id', $payoutId)->first();

            if (!$withdrawal) {
                Log::warning('Withdrawal not found for payout_id: ' . $payoutId);
                return response()->json(['status' => 'ok']);
            }

            // Update based on status
            switch ($status) {
                case 'finished':
                case 'confirmed':
                    $withdrawal->update([
                        'status' => 'completed',
                        'txid' => $txid,
                    ]);
                    
                    // Send email notification
                    try {
                        \Mail::send('emails.withdrawal-success', ['withdrawal' => $withdrawal], function ($message) use ($withdrawal) {
                            $message->to($withdrawal->user->email)
                                ->subject('Withdrawal Completed - Cryptexa');
                        });
                    } catch (\Exception $e) {
                        Log::error('Failed to send withdrawal email: ' . $e->getMessage());
                    }
                    
                    Log::info('Withdrawal completed', ['id' => $withdrawal->id, 'txid' => $txid]);
                    break;

                case 'failed':
                case 'expired':
                    // Refund user
                    $withdrawal->user->increment('balance', $withdrawal->amount);
                    $withdrawal->update(['status' => 'rejected']);
                    Log::info('Withdrawal failed and refunded', ['id' => $withdrawal->id]);
                    break;
            }

            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            Log::error('NOWPayments webhook error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }
}
