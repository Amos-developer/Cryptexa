<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\SetsLocale;

class WithdrawalController extends Controller
{
    use SetsLocale;

    public function index()
    {
        $this->setLocale();
        $user = auth()->user();
        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('withdrawal.index', compact('withdrawals'));
    }
    /**
     * Submit withdrawal request
     */
    public function submit(Request $request)
    {
        $user = auth()->user();

        // Check if user has set withdrawal PIN
        if (empty($user->withdrawal_pin)) {
            return back()->with('error', 'Please set up your withdrawal PIN first.');
        }

        // Check if user has completed at least one pool
        $hasCompletedPool = \App\Models\ComputeOrder::where('user_id', $user->id)
            ->where('status', 'completed')
            ->exists();

        if (!$hasCompletedPool) {
            return back()->with('error', 'You must complete at least one liquidity pool before withdrawing. Please activate a pool and wait for it to finish.');
        }

        // Check if user has already withdrawn today
        $todayWithdrawal = Withdrawal::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->exists();

        if ($todayWithdrawal) {
            return back()->with('error', 'You can only make one withdrawal per day. Please try again tomorrow.');
        }

        // 1️⃣ Validate
        $request->validate([
            'network'     => 'required|in:BEP20,USDC_BEP20,TRC20,BNB_BSC',
            'address'     => 'required|string|min:20|max:120',
            'amount'      => 'required|numeric|min:10',
            'pin'         => 'required|digits:4',
            'email_code'  => session('email_code_verified') ? 'nullable' : 'required|digits:6',
        ]);

        // 2️⃣ Verify PIN
        if (!Hash::check($request->pin, $user->withdrawal_pin)) {
            return back()->with('error', 'Invalid withdrawal PIN.');
        }

        // 3️⃣ Verify email code (only if not already verified in session)
        if (!session('email_code_verified')) {
            if (
                $user->email_verification_code !== $request->email_code ||
                now()->gt($user->email_verification_expires_at)
            ) {
                return back()->with('error', 'Invalid or expired email verification code.');
            }
        }

        // 4️⃣ Validate address by network
        if (!$this->validateAddress($request->network, $request->address)) {
            return back()->with('error', 'Invalid address for selected network.');
        }

        // 5️⃣ Fees (8% for all networks)
        $feePercentage = 8;
        $fee = ($request->amount * $feePercentage) / 100;
        $totalDebit = $request->amount + $fee;

        // 6️⃣ Check balance
        if ($user->balance < $totalDebit) {
            return back()->with('error', 'Insufficient balance.');
        }

        // 7️⃣ Transaction (CRITICAL)
        DB::transaction(function () use ($user, $request, $totalDebit) {
            $balanceBefore = $user->balance;

            // Lock funds
            $user->decrement('balance', $totalDebit);
            $user->refresh();
            $balanceAfter = $user->balance;

            // Create withdrawal
            Withdrawal::create([
                'user_id'  => $user->id,
                'amount'   => $request->amount,
                'currency' => 'USDT_' . $request->network,
                'address'  => $request->address,
                'status'   => 'pending',
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
            ]);

            // Invalidate email code and session
            $user->update([
                'email_verification_code' => null,
                'email_verification_expires_at' => null,
            ]);
            
            // Clear session flag
            session()->forget('email_code_verified');
        });

        return redirect()->route('withdraw.history')
            ->with('success', 'Withdrawal request submitted successfully.');
    }

    /**
     * Send email verification code for withdrawal
     */
    public function sendCode()
    {
        try {
            $user = auth()->user();

            // Generate 6-digit code
            $code = random_int(100000, 999999);

            // Store in database (expires in 10 minutes)
            $user->update([
                'email_verification_code' => $code,
                'email_verification_expires_at' => now()->addMinutes(10),
            ]);

            // Send email with code
            try {
                \Mail::send('emails.withdrawal-verification', [
                    'code' => $code,
                    'url' => route('withdraw')
                ], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Withdrawal Verification Code - Cryptexa');
                });

                return response()->json([
                    'success' => true,
                    'message' => 'Verification code sent to ' . substr($user->email, 0, 3) . '***@' . explode('@', $user->email)[1]
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to send email: ' . $e->getMessage());
                
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send verification code. Please try again or contact support.'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Send code error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Verify email code
     */
    public function verifyCode(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        if (
            $user->email_verification_code !== $request->code ||
            now()->gt($user->email_verification_expires_at)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired verification code'
            ]);
        }

        // Mark as verified in session
        session(['email_code_verified' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Code verified successfully'
        ]);
    }

    /**
     * Get withdrawal history
     */
    public function history()
    {
        $this->setLocale();
        $user = auth()->user();
        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('withdrawal.history', compact('withdrawals'));
    }

    /**
     * Address validation per network
     */
    protected function validateAddress(string $network, string $address): bool
    {
        return match ($network) {
            'BEP20', 'USDC_BEP20', 'BNB_BSC' => preg_match('/^0x[a-fA-F0-9]{40}$/', $address),
            'TRC20' => preg_match('/^T[a-zA-Z0-9]{33}$/', $address),
            default => false,
        };
    }
}
