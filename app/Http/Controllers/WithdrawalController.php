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
            'amount'      => 'required|numeric|min:30',
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
        $user = auth()->user();

        // Generate 6-digit code
        $code = random_int(100000, 999999);

        // Store in database (expires in 10 minutes)
        $user->update([
            'email_verification_code' => $code,
            'email_verification_expires_at' => now()->addMinutes(10),
        ]);

        // TODO: Send email with code (implement Mail::send)
        // Mail::send('emails.verification-code', ['code' => $code], function ($mail) use ($user) {
        //     $mail->to($user->email)->subject('Withdrawal Verification Code');
        // });

        return back()->with('success', 'Verification code sent to your email.');
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
