<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * STEP 1: Create deposit + payment
     */
    public function store(Request $request, NowPaymentsService $nowPayments)
    {
        $request->validate([
            'currency' => 'required|in:usdttrc20,usdtbsc,usdcbsc,bnbbsc',
        ]);

        // Prevent duplicate active deposits
        $deposit = Deposit::where('user_id', auth()->id())
            ->where('currency', $request->currency)
            ->whereIn('status', ['pending', 'confirming'])
            ->first();

        if ($deposit) {
            return redirect()->route('deposit.qr', $deposit->id);
        }

        $amount = 50; // USD (must match NOWPayments)

        $deposit = Deposit::create([
            'user_id'  => auth()->id(),
            'amount'   => $amount,
            'currency' => $request->currency,
            'status'   => 'pending',
        ]);

        // ✅ Correct argument order
        $payment = $nowPayments->createPayment(
            $deposit->id,
            $request->currency
        );

        if (empty($payment['payment_id'])) {
            logger()->error('NOWPayments create failed', $payment);
            $deposit->delete();
            return back()->with('error', 'Unable to create payment.');
        }

        $deposit->update([
            'payment_id' => $payment['payment_id'],
        ]);

        return redirect()->route('deposit.qr', $deposit->id);
    }

    /**
     * STEP 2: QR page
     */
    public function showQrCode(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        abort_if($deposit->user_id !== auth()->id(), 403);
        abort_if(!in_array($deposit->status, ['pending', 'confirming']), 404);

        if (!$deposit->pay_address && $deposit->payment_id) {
            $this->fetchPaymentAddress($deposit, $nowPayments);
        }

        return view('qr-code', compact('deposit'));
    }

    /**
     * AJAX refresh
     */
    public function refreshAddress(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        abort_if($deposit->user_id !== auth()->id(), 403);

        $this->fetchPaymentAddress($deposit, $nowPayments);

        return response()->json([
            'pay_address' => $deposit->fresh()->pay_address,
            'pay_currency' => $deposit->fresh()->pay_currency,
            'pay_amount'  => $deposit->fresh()->pay_amount,
        ]);
    }

    /**
     * Fetch address from NOWPayments
     */
    private function fetchPaymentAddress(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        $status = $nowPayments->getPaymentStatus($deposit->payment_id);

        if (!empty($status['pay_address'])) {
            $deposit->update([
                'pay_address'  => $status['pay_address'],
                'pay_currency' => $status['pay_currency'] ?? $deposit->currency,
                'pay_amount'   => $status['pay_amount'] ?? null,
            ]);
        }
    }

    /**
     * STEP 3: Check deposit status and process payment automatically
     */
    public function checkStatus(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        abort_if($deposit->user_id !== auth()->id(), 403);

        // If already paid, don't check again
        if ($deposit->status === 'finished') {
            return response()->json([
                'status' => 'finished',
                'message' => 'Payment already confirmed',
                'balance' => $deposit->user->fresh()->balance,
            ]);
        }

        // Fetch current status from NOWPayments API
        $paymentStatus = $nowPayments->getPaymentStatus($deposit->payment_id);

        if (empty($paymentStatus)) {
            return response()->json([
                'status' => $deposit->status,
                'message' => 'Checking payment...',
            ]);
        }

        // Update deposit status if changed
        if (!empty($paymentStatus['payment_status']) && $paymentStatus['payment_status'] !== $deposit->status) {
            $oldStatus = $deposit->status;
            $newStatus = $paymentStatus['payment_status'];

            $deposit->update([
                'status' => $newStatus,
                'pay_address' => $paymentStatus['pay_address'] ?? $deposit->pay_address,
                'pay_currency' => $paymentStatus['pay_currency'] ?? $deposit->pay_currency,
                'pay_amount' => $paymentStatus['price_amount'] ?? $paymentStatus['pay_amount'] ?? $deposit->pay_amount,
            ]);

            // If payment is now finished, credit user and pay referrals
            if ($newStatus === 'finished' && $oldStatus !== 'finished') {
                $this->processDepositPayment($deposit);

                return response()->json([
                    'status' => 'finished',
                    'message' => 'Payment confirmed! Balance updated.',
                    'balance' => $deposit->user->fresh()->balance,
                    'received' => $deposit->amount,
                ]);
            }
        }

        return response()->json([
            'status' => $deposit->status,
            'message' => 'Still waiting for payment...',
        ]);
    }

    /**
     * Process deposit payment: Credit user + Pay referrals
     */
    private function processDepositPayment(Deposit $deposit)
    {
        // Credit user balance
        $deposit->user->increment('balance', $deposit->amount);

        // Pay referral bonuses (6-level structure)
        $this->payReferralBonuses($deposit->user, $deposit->amount);
    }

    /**
     * Pay referral bonuses to all levels
     */
    private function payReferralBonuses($user, $amount)
    {
        // 6-level referral structure
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
