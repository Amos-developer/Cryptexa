<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * STEP 1: User selects crypto/network
     * STEP 2: Create payment & show QR immediately
     */
    public function store(Request $request, NowPaymentsService $nowPayments)
    {
        $request->validate([
            'currency' => 'required|in:usdttrc20,usdtbsc,usdcbsc,bnbbsc',
        ]);

        $deposit = Deposit::create([
            'user_id'  => auth()->id(),
            'amount'   => 50, // minimum
            'currency' => $request->currency,
            'status'   => 'pending',
        ]);

        $payment = $nowPayments->createPayment(
            $request->currency,
            $deposit->id
        );

        if (empty($payment['payment_id'])) {
            logger()->error('NOWPayments create failed', $payment);
            return back()->withErrors(['error' => 'Payment provider error']);
        }

        $deposit->update([
            'payment_id' => $payment['payment_id'],
        ]);

        return redirect()->route('deposit.qr', $deposit->id);
    }

    /**
     * QR PAGE — NO API CALLS HERE
     */
    public function showQrCode(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        abort_if($deposit->user_id !== auth()->id(), 403);

        if (!$deposit->payment_address) {
            $status = $nowPayments->getPaymentStatus($deposit->payment_id);

            if (!empty($status['pay_address'])) {
                $deposit->update([
                    'payment_address' => $status['pay_address'],
                    'pay_amount'      => $status['pay_amount'],
                    'pay_currency'    => $status['pay_currency'],
                ]);
            }
        }

        return view('qr-code', compact('deposit'));
    }
}
