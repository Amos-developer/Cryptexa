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
            $locale = auth()->user()->language ?? 'en';
            App::setLocale($locale);
        } else {
            $locale = Session::get('locale', 'en');
            App::setLocale($locale);
        }
        
        return $next($request);
    }
}
