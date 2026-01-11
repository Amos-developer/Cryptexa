<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * STEP 1: Select network
     */
    public function store(Request $request, NowPaymentsService $nowPayments)
    {
        $request->validate([
            'currency' => 'required|in:usdttrc20,usdtbsc,usdcbsc,bnbbsc',
        ]);

        // Reuse active deposit per user + network
        $deposit = Deposit::where('user_id', auth()->id())
            ->where('currency', $request->currency)
            ->whereIn('status', ['pending', 'confirming'])
            ->first();

        if ($deposit) {
            return redirect()->route('deposit.qr', $deposit->id);
        }

        // Create new deposit
        $deposit = Deposit::create([
            'user_id'  => auth()->id(),
            'amount'   => 10000, // minimum USD
            'currency' => $request->currency,
            'status'   => 'pending',
        ]);

        // Create NOWPayments payment
        $payment = $nowPayments->createPayment(
            $request->currency,
            $deposit->id
        );

        if (empty($payment['payment_id'])) {
            logger()->error('NOWPayments create failed', $payment);
            abort(500, 'Payment provider error');
        }

        $deposit->update([
            'payment_id' => $payment['payment_id'],
        ]);

        return redirect()->route('deposit.qr', $deposit->id);
    }

    /**
     * STEP 2: QR page
     * Fetch address ONLY if missing
     */
    public function showQrCode(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        abort_if($deposit->user_id !== auth()->id(), 403);

        // Only active deposits
        abort_if(!in_array($deposit->status, ['pending', 'confirming']), 404);

        // 🔑 THIS WAS MISSING
        if (!$deposit->pay_address && $deposit->payment_id) {
            $status = $nowPayments->getPaymentStatus($deposit->payment_id);

            if (!empty($status['pay_address'])) {
                $deposit->update([
                    'pay_address'  => $status['pay_address'],
                    'pay_currency' => $status['pay_currency'],
                    'pay_amount'   => $status['pay_amount'],
                ]);
            }
        }

        return view('qr-code', compact('deposit'));
    }
}
