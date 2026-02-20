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
