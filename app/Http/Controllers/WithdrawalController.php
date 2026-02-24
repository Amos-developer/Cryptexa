<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WithdrawalController extends Controller
{

    public function index()
    {
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

        // Check if user has completed at least one pool
        $hasCompletedPool = \App\Models\ComputeOrder::where('user_id', $user->id)
            ->where('status', 'completed')
            ->exists();

        if (!$hasCompletedPool) {
            return back()->with('error', 'You must complete at least one liquidity pool before withdrawing. Please activate a pool and wait for it to finish.');
        }

        // 1️⃣ Validate
        $request->validate([
            'network'     => 'required|in:BEP20,TRC20,ERC20',
            'address'     => 'required|string|min:20|max:120',
            'amount'      => 'required|numeric|min:10',
            'pin'         => 'required|digits:4',
            'email_code'  => 'required|digits:6',
        ]);

        // 2️⃣ Verify PIN
        if (!Hash::check($request->pin, $user->withdraw_pin)) {
            return back()->with('error', 'Invalid withdrawal PIN.');
        }

        // 3️⃣ Verify email code
        if (
            $user->email_verification_code !== $request->email_code ||
            now()->gt($user->email_verification_expires_at)
        ) {
            return back()->with('error', 'Invalid or expired email verification code.');
        }

        // 4️⃣ Validate address by network
        if (!$this->validateAddress($request->network, $request->address)) {
            return back()->with('error', 'Invalid address for selected network.');
        }

        // 5️⃣ Fees (can be changed later)
        $fees = [
            'BEP20' => 1,
            'TRC20' => 1,
            'ERC20' => 10,
        ];

        $fee = $fees[$request->network];
        $totalDebit = $request->amount + $fee;

        // 6️⃣ Check balance
        if ($user->balance < $totalDebit) {
            return back()->with('error', 'Insufficient balance.');
        }

        // 7️⃣ Transaction (CRITICAL)
        DB::transaction(function () use ($user, $request, $totalDebit) {

            // Lock funds
            $user->decrement('balance', $totalDebit);

            // Create withdrawal
            Withdrawal::create([
                'user_id'  => $user->id,
                'amount'   => $request->amount,
                'currency' => 'USDT_' . $request->network, // 👈 stored here
                'address'  => $request->address,
                'status'   => 'pending',
            ]);

            // Invalidate email code
            $user->update([
                'email_verification_code' => null,
                'email_verification_expires_at' => null,
            ]);
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
            'BEP20', 'ERC20' => preg_match('/^0x[a-fA-F0-9]{40}$/', $address),
            'TRC20' => preg_match('/^T[a-zA-Z0-9]{33}$/', $address),
            default => false,
        };
    }
}
