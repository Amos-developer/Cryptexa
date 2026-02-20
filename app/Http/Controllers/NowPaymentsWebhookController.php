<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
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

        if (!empty($update)) {
            $deposit->update($update);
        }

        logger()->info('NOWPayments IPN processed', ['deposit_id' => $deposit->id, 'update' => $update]);

        return response()->json(['ok' => true]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NowPaymentsWebhookController extends Controller {
    public function handle(Request $request)
    {
        /**
         * 1️⃣ Verify signature FIRST
         */
        if (!$this->isValidSignature($request)) {
            Log::warning('NOWPayments invalid signature', [
                'payload' => $request->all()
            ]);

            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $data = $request->all();

        /**
         * 2️⃣ Required fields
         */
        if (
            empty($data['payment_id']) ||
            empty($data['payment_status'])
        ) {
            return response()->json(['status' => 'ignored']);
        }

        /**
         * 3️⃣ Process atomically
         */
        DB::transaction(function () use ($data) {

            /** 🔒 Lock deposit row */
            $deposit = Deposit::where('payment_id', $data['payment_id'])
                ->lockForUpdate()
                ->first();

            if (!$deposit) {
                Log::warning('NOWPayments deposit not found', [
                    'payment_id' => $data['payment_id']
                ]);
                return;
            }

            /**
             * 4️⃣ Idempotency — never credit twice
             */
            if ($deposit->status === 'completed') {
                return;
            }

            /**
             * 5️⃣ Ignore unpaid states
             */
            if (!in_array($data['payment_status'], ['finished', 'partially_paid'])) {
                return;
            }

            /**
             * 6️⃣ Finalize deposit
             */
            $paidAmount = (float) ($data['actually_paid'] ?? 0);

            if ($paidAmount <= 0) {
                Log::warning('NOWPayments paid amount invalid', $data);
                return;
            }

            $deposit->update([
                'status'     => 'completed',
                'pay_amount' => $paidAmount,
                'txid'       => $data['payin_hash'] ?? null,
            ]);

            /**
             * 7️⃣ Credit user balance
             */
            $deposit->user()->lockForUpdate()->increment('balance', $paidAmount);
        });

        return response()->json(['status' => 'ok']);
    }

    /**
     * 🔐 NOWPayments signature verification
     */
    private function isValidSignature(Request $request): bool
    {
        $signature = $request->header('x-nowpayments-sig');
        if (!$signature) return false;

        $secret = config('services.nowpayments.ipn_secret');

        return hash_equals(
            hash_hmac('sha512', $request->getContent(), $secret),
            $signature
        );
    }
}
