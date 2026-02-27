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
        if (auth()->check() && auth()->user()->language) {
            $locale = auth()->user()->language;
            App::setLocale($locale);
            Session::put('locale', $locale);
        } elseif (Session::has('locale')) {
            $locale = Session::get('locale');
            App::setLocale($locale);
        } elseif ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            App::setLocale('en');
        }
        
        return $next($request);
    }
}
