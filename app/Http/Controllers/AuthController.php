<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // Register logic
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $code = rand(100000, 999999); // OTP code

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $code,
        ]);

        // send email
        Mail::raw("Your verification code is: $code", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Email Verification Code');
        });

        return redirect('/verify')->with('success', 'Check your email for verification code');
    }


    // Verification logic
    public function showVerify()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $user = User::where('verification_code', $request->code)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid verification code']);
        }

        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        return redirect('/login')->with('success', 'Email verified, you can login now');
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

            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout logic
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
