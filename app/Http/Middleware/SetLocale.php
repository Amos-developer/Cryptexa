<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            // Force fresh query from database
            $userId = auth()->id();
            $user = \App\Models\User::find($userId);
            
            if ($user && $user->language) {
                $locale = $user->language;
                App::setLocale($locale);
                Session::put('locale', $locale);
                \Log::info('SetLocale: Set to ' . $locale . ' for user ' . $userId);
            } else {
                \Log::info('SetLocale: No language set for user ' . $userId);
            }
        } elseif (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
            \Log::info('SetLocale: Set from session to ' . $locale);
        } elseif ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
            App::setLocale($locale);
            Session::put('locale', $locale);
            \Log::info('SetLocale: Set from cookie to ' . $locale);
        } else {
            App::setLocale('en');
            \Log::info('SetLocale: Default to en');
        }
        
        return $next($request);
    }
}
