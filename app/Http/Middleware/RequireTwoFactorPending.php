<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequireTwoFactorPending
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If user is already authenticated, redirect to home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // If there's no pending 2FA verification, redirect to login
        if (!$request->session()->has('2fa_pending_user_id')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        return $next($request);
    }
}
