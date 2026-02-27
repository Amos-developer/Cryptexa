<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\SetsLocale;

class DepositController extends Controller
{
    use SetsLocale;
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

        try {
            // ✅ Correct argument order
            $payment = $nowPayments->createPayment(
                $deposit->id,
                $request->currency
            );

            if (empty($payment['payment_id'])) {
                logger()->error('NOWPayments create failed', $payment);
                $deposit->delete();
                
                $errorMsg = $payment['message'] ?? 'Unable to create payment. Please try again or contact support.';
                
                return redirect()->route('select.network')
                    ->with('error', $errorMsg);
            }

            $deposit->update([
                'payment_id' => $payment['payment_id'],
            ]);

            return redirect()->route('deposit.qr', $deposit->id);
            
        } catch (\Exception $e) {
            logger()->error('Payment creation exception: ' . $e->getMessage());
            $deposit->delete();
            
            return redirect()->route('select.network')
                ->with('error', 'Payment service temporarily unavailable. Please try again later.');
        }
    }

    /**
     * STEP 2: QR page
     */
    public function showQrCode(Deposit $deposit, NowPaymentsService $nowPayments)
    {
        $this->setLocale();
        
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

        // If already completed, don't check again
        if ($deposit->status === 'completed') {
            return response()->json([
                'status' => 'completed',
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

        // Update deposit status if changed. Map provider statuses to our internal enum.
        if (!empty($paymentStatus['payment_status'])) {
            $oldStatus = $deposit->status;
            $providerStatus = $paymentStatus['payment_status'];

            // Map NOWPayments statuses to our deposits.status enum
            $map = [
                'waiting'   => 'pending',
                'confirming' => 'confirming',
                'finished'  => 'completed',
                'expired'   => 'expired',
                'failed'    => 'failed',
            ];

            $mappedStatus = $map[$providerStatus] ?? $deposit->status;

            // Only update if mapped status differs from current
            if ($mappedStatus !== $deposit->status || !empty($paymentStatus['pay_address']) || !empty($paymentStatus['pay_amount'])) {
                $deposit->update([
                    'status' => $mappedStatus,
                    'pay_address' => $paymentStatus['pay_address'] ?? $deposit->pay_address,
                    'pay_currency' => $paymentStatus['pay_currency'] ?? $deposit->pay_currency,
                    'pay_amount' => $paymentStatus['price_amount'] ?? $paymentStatus['pay_amount'] ?? $deposit->pay_amount,
                ]);
            }

            // If payment is now completed, dispatch processing job
            if ($mappedStatus === 'completed' && $oldStatus !== 'completed') {
                \App\Jobs\ProcessDepositPayment::dispatch($deposit->id);

                return response()->json([
                    'status' => 'completed',
                    'provider_status' => $providerStatus,
                    'message' => 'Payment confirmed! Balance updated.',
                    'balance' => $deposit->user->fresh()->balance,
                    'received' => $deposit->pay_amount ?? $deposit->amount,
                ]);
            }
        }

        return response()->json([
            'status' => $deposit->status,
            'message' => 'Still waiting for payment...',
        ]);
    }
}
