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
}
