<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;

class NowPaymentsWebhookController extends Controller
{
    public function handle(Request $request, NowPaymentsService $now)
    {
        $payload = $request->json()->all();

        // Signature header (try common names)
        $signature = $request->header('x-nowpayments-signature') ?? $request->header('x-signature') ?? null;

        if ($signature && !$now->verifyIpnSignature($payload, $signature)) {
            logger()->warning('NOWPayments IPN signature verification failed', ['payload' => $payload]);
            return response()->json(['error' => 'invalid signature'], 400);
        }

        logger()->info('NOWPayments IPN received', ['payload' => $payload]);

        // extract identifiers
        $invoiceId = $payload['id'] ?? $payload['invoice_id'] ?? $payload['payment_id'] ?? null;
        $tokenId = $payload['token_id'] ?? null;
        $orderId = $payload['order_id'] ?? null;

        $deposit = null;

        // If order_id is present and follows deposit-{id}, parse it
        if ($orderId && preg_match('/^deposit-(\d+)$/', $orderId, $m)) {
            $deposit = Deposit::find((int)$m[1]);
        }

        // fallback lookups
        if (!$deposit && $invoiceId) {
            $deposit = Deposit::where('payment_id', $invoiceId)->first();
        }

        if (!$deposit && $tokenId) {
            $deposit = Deposit::where('token_id', $tokenId)->first();
        }

        if (!$deposit) {
            logger()->warning('NOWPayments IPN: no matching deposit found', ['invoice_id' => $invoiceId, 'token_id' => $tokenId, 'order_id' => $orderId]);
            return response()->json(['ok' => true]);
        }

        // Update deposit with any provided payment details
        $update = [];
        if (!empty($payload['pay_address'])) {
            $update['pay_address'] = $payload['pay_address'];
        }

        if (!empty($payload['pay_currency'])) {
            $update['pay_currency'] = $payload['pay_currency'];
        }

        if (!empty($payload['price_amount'])) {
            $update['pay_amount'] = $payload['price_amount'];
        } elseif (!empty($payload['pay_amount'])) {
            $update['pay_amount'] = $payload['pay_amount'];
        }

        if (!empty($payload['payment_status'])) {
            $update['status'] = $payload['payment_status'];
        } elseif (!empty($payload['status'])) {
            $update['status'] = $payload['status'];
        }

        if (!empty($payload['id']) && empty($deposit->payment_id)) {
            $update['payment_id'] = $payload['id'];
        }

        if (!empty($payload['token_id']) && empty($deposit->token_id)) {
            $update['token_id'] = $payload['token_id'];
        }

        $previousStatus = $deposit->status;

        if (!empty($update)) {
            $deposit->update($update);
        }

        // Pay referral bonuses when deposit is confirmed as paid
        if (!empty($update['status']) && $update['status'] === 'finished' && $previousStatus !== 'finished') {
            $this->payReferralBonuses($deposit->user, $deposit->amount);
        }

        logger()->info('NOWPayments IPN processed', ['deposit_id' => $deposit->id, 'update' => $update]);

        return response()->json(['ok' => true]);
    }

    protected function payReferralBonuses(User $user, float $amount): void
    {
        // 6-level referral structure - paid when user makes a deposit
        $levels = [0.16, 0.08, 0.04, 0.02, 0.01, 0.005];

        $referrer = $user->referrer;

        foreach ($levels as $rate) {
            if (!$referrer) break;

            $bonus = round($amount * $rate, 2);

            $referrer->increment('balance', $bonus);
            $referrer->increment('referral_earnings', $bonus);

            $referrer = $referrer->referrer;
        }
    }
}
