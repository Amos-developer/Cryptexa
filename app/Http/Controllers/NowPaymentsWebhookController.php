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
        // Use the raw request body for signature verification
        $payloadRaw = (string) $request->getContent();
        $payload = json_decode($payloadRaw, true) ?? [];

        // Signature header (try common names)
        $signature = $request->header('x-nowpayments-signature') ?? $request->header('x-signature') ?? null;

        if ($signature && !$now->verifyIpnSignature($payloadRaw, $signature)) {
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

        // Update deposit with any provided payment details and store raw payload for audit
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

        if (!empty($payload['payment_status']) || !empty($payload['status'])) {
            $providerStatus = $payload['payment_status'] ?? $payload['status'];

            // Map provider statuses to our internal enum
            $map = [
                'waiting'    => 'pending',
                'confirming' => 'confirming',
                'finished'   => 'completed',
                'expired'    => 'expired',
                'failed'     => 'failed',
            ];

            $update['status'] = $map[$providerStatus] ?? $deposit->status;
            $update['provider_status_raw'] = $providerStatus;
        }

        if (!empty($payload['id']) && empty($deposit->payment_id)) {
            $update['payment_id'] = $payload['id'];
        }

        if (!empty($payload['token_id']) && empty($deposit->token_id)) {
            $update['token_id'] = $payload['token_id'];
        }

        // store raw JSON payload for audit
        $update['provider_payload'] = $payload;

        $previousStatus = $deposit->status;

        if (!empty($update)) {
            $deposit->update($update);
        }

        // Validate received amounts (if present)
        $received = $payload['price_amount'] ?? $payload['pay_amount'] ?? null;
        if ($received !== null && (float)$received < (float)$deposit->amount) {
            logger()->warning('NOWPayments IPN: received amount less than deposit amount, skipping processing', ['deposit_id' => $deposit->id, 'received' => $received, 'expected' => $deposit->amount]);
            return response()->json(['ok' => true]);
        }

        // Dispatch processing job when deposit transitions to completed
        if (!empty($update['status']) && $update['status'] === 'completed' && $previousStatus !== 'completed') {
            \App\Jobs\ProcessDepositPayment::dispatch($deposit->id);
        }

        logger()->info('NOWPayments IPN processed', ['deposit_id' => $deposit->id, 'update' => $update]);

        return response()->json(['ok' => true]);
    }

    protected function payReferralBonuses(User $user, float $amount): void
    {
        // 3-level referral structure - paid when user makes a deposit
        $levels = [0.02, 0.01, 0.005]; // Level 1: 2%, Level 2: 1%, Level 3: 0.5%

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
