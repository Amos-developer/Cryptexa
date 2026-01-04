<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationCodeMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Register logic
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registration logic
    public function register(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',
            'ref' => 'required|digits:8|exists:users,referral_code',
        ]);

        // 2️⃣ Generate OTP
        $code = rand(100000, 999999);

        // 3️⃣ Find referrer (if exists)
        $referrer = null;
        if ($request->filled('ref')) {
            $referrer = User::where('referral_code', $request->ref)->first();
        }

        // 4️⃣ Generate UNIQUE numeric referral code (8 digits)
        do {
            $myReferralCode = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        } while (User::where('referral_code', $myReferralCode)->exists());


        // 5️⃣ Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'verification_code' => $code,
            'verification_expires_at' => Carbon::now()->addMinutes(10),
            'referral_code' => $myReferralCode,
            'referred_by' => $referrer?->id,

            // Register bonus
            'balance' => 3.00,
        ]);

        // 6️⃣ Send OTP email
        Mail::to($user->email)->send(
            new VerificationCodeMail($code)
        );

        // 7️⃣ Redirect to OTP page
        return redirect()->route('verify')
            ->with('success', 'We sent a verification code to your email.');
    }


    // Verification logic
    public function showVerify()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('verification_code', $request->otp)->first();

        if (!$user) {
            return back()->with('error', 'Invalid verification code');
        }

        if (Carbon::now()->gt($user->verification_expires_at)) {
            return back()->with('error', 'Verification code expired');
        }

        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_expires_at' => null,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Email verified successfully');
    }


    // Login logic
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (!Auth::user()->email_verified_at) {
                Auth::logout();
                return back()->withErrors(['email' => 'Verify your email first']);
            }

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }


    // reset logic
    public function resend()
    {
        $user = User::whereNull('email_verified_at')->latest()->first();

        if (!$user) {
            return back()->with('error', 'No pending verification found');
        }

        $user->update([
            'verification_code' => rand(100000, 999999),
            'verification_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(
            new \App\Mail\VerificationCodeMail($user)
        );

        return back()->with('success', 'Verification code resent');
    }

    // Logout logic
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
