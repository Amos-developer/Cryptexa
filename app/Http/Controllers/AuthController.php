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
        $locale = request()->cookie('locale', session('locale', 'en'));
        app()->setLocale($locale);
        return view('auth.register');
    }

    // Registration logic
    public function register(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'username' => 'required|string|min:3|max:20|unique:users,username|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|email|unique:users,email',
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
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $code,
            'verification_expires_at' => Carbon::now()->addMinutes(10),
            'referral_code' => $myReferralCode,
            'referred_by' => $referrer?->id,
            'language' => $request->cookie('locale', 'en'),

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
        $locale = request()->cookie('locale', session('locale', 'en'));
        app()->setLocale($locale);
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:20',
            'password' => 'required|string',
            'captcha' => 'required|string',
            'captcha_token' => 'required|string',
        ]);

        // Validate captcha
        if (strtoupper($request->captcha) !== strtoupper($request->captcha_token)) {
            return back()->withErrors(['captcha' => 'Invalid captcha code'])->withInput();
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->email_verified_at) {
                Auth::logout();
                
                // Regenerate verification code
                $code = rand(100000, 999999);
                $user->update([
                    'verification_code' => $code,
                    'verification_expires_at' => Carbon::now()->addMinutes(10),
                ]);
                
                // Send verification email
                Mail::to($user->email)->send(new VerificationCodeMail($code));
                
                return redirect()->route('verify')
                    ->with('info', 'Please verify your email first. A new verification code has been sent to your email.');
            }
            
            // Save cookie language to database if different from current
            if ($request->cookie('locale') && $user->language !== $request->cookie('locale')) {
                $user->update(['language' => $request->cookie('locale')]);
            }

            // Check if user has 2FA enabled
            if ($user->two_factor_enabled) {
                // Store user ID in session for 2FA verification
                Auth::logout();
                $request->session()->put('2fa_pending_user_id', $user->id);
                $request->session()->put('2fa_pending_remember', $request->boolean('remember'));
                return redirect()->route('two-factor.login');
            }

            // 🔥 ROLE-BASED REDIRECT
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/'); // normal user
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }



    // reset logic
    public function resend()
    {
        $user = User::whereNull('email_verified_at')->latest()->first();

        if (!$user) {
            return back()->with('error', 'No pending verification found');
        }

        $code = rand(100000, 999999);
        $user->update([
            'verification_code' => $code,
            'verification_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(
            new VerificationCodeMail($code)
        );

        return back()->with('success', 'Verification code resent');
    }

    // Logout logic
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Update password logic
    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('The current password is incorrect.');
                        }
                    },
                ],
                'password' => [
                    'required',
                    'min:8',
                    'confirmed',
                    function ($attribute, $value, $fail) use ($request) {
                        // New password must not be same as current password
                        if (Hash::check($value, Auth::user()->password)) {
                            $fail('New password must be different from current password.');
                        }
                    },
                ],
            ]);

            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);

            // Return JSON response for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully'
                ]);
            }

            return back()->with('success', 'Password updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => collect($e->errors())->flatten()->first()
                ], 422);
            }
            throw $e;
        }
    }
}
