<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{

    // Register logic
    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        // 1️⃣ Validate input (MATCHES your form)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // 2️⃣ Generate OTP
        $code = rand(100000, 999999);

        // 3️⃣ Create user (NOT verified yet)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $code,
            'verification_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        // 4️⃣ Send OTP email
        Mail::to($user->email)->send(
            new \App\Mail\VerificationCodeMail($code)
        );

        // 5️⃣ Redirect to verify page
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
