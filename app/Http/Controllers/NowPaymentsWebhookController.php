<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;

class NowPaymentsWebhookController extends Controller
{
    public function handle(Request $request, NowPaymentsService $nowPayments)
    {
        $signature = $request->header('x-nowpayments-sig');
        $payload = $request->getContent();

        if (!$nowPayments->verifyIpnSignature($payload, $signature)) {
            logger()->warning('NOWPayments webhook: invalid signature');
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $data = json_decode($payload, true);
        
        if (empty($data['order_id']) || empty($data['payment_status'])) {
            logger()->warning('NOWPayments webhook: missing data', $data);
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        $deposit = Deposit::find($data['order_id']);

        if (!$deposit) {
            logger()->warning('NOWPayments webhook: deposit not found', ['order_id' => $data['order_id']]);
            return response()->json(['error' => 'Deposit not found'], 404);
        }

        $statusMap = [
            'waiting'    => 'pending',
            'confirming' => 'confirming',
            'finished'   => 'completed',
            'expired'    => 'expired',
            'failed'     => 'failed',
        ];

        $newStatus = $statusMap[$data['payment_status']] ?? $deposit->status;
        $oldStatus = $deposit->status;

        // Update deposit with actual received amount
        $deposit->update([
            'status' => $newStatus,
            'pay_address' => $data['pay_address'] ?? $deposit->pay_address,
            'pay_currency' => $data['pay_currency'] ?? $deposit->pay_currency,
            'pay_amount' => $data['actually_paid'] ?? $data['pay_amount'] ?? $deposit->pay_amount,
        ]);

        // If payment completed, process it
        if ($newStatus === 'completed' && $oldStatus !== 'completed') {
            \App\Jobs\ProcessDepositPayment::dispatch($deposit->id);
            
            logger()->info('NOWPayments webhook: payment completed', [
                'deposit_id' => $deposit->id,
                'amount' => $deposit->amount,
                'actually_paid' => $data['actually_paid'] ?? null,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
