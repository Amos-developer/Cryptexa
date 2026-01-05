<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NowPaymentsWebhookController extends Controller
{
    public function handle(Request $request)
    {
        if (!$this->isValidSignature($request)) {
            Log::warning('NOWPayments invalid signature');
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $data = $request->all();

        if (
            empty($data['payment_id']) ||
            empty($data['payment_status'])
        ) {
            return response()->json(['status' => 'ignored']);
        }

        $deposit = Deposit::where('payment_id', $data['payment_id'])->lockForUpdate()->first();

        if (!$deposit || $deposit->status === 'completed') {
            return response()->json(['status' => 'already_processed']);
        }

        if (!in_array($data['payment_status'], ['finished', 'partially_paid'])) {
            return response()->json(['status' => 'pending']);
        }

        DB::transaction(function () use ($deposit, $data) {

            $deposit->update([
                'status'     => 'completed',
                'pay_amount' => (float) $data['actually_paid'],
                'txid'       => $data['payin_hash'] ?? null,
            ]);

            $deposit->user->increment(
                'balance',
                (float) $data['actually_paid']
            );
        });

        return response()->json(['status' => 'ok']);
    }

    private function isValidSignature(Request $request): bool
    {
        $signature = $request->header('x-nowpayments-sig');
        if (!$signature) return false;

        $payload = $request->getContent();
        $secret  = config('services.nowpayments.ipn_secret');

        return hash_equals(
            hash_hmac('sha512', $payload, $secret),
            $signature
        );
    }
}
