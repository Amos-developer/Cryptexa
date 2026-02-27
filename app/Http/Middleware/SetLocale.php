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
        $locale = Session::get('locale');
        
        if (!$locale && auth()->check() && auth()->user()->language) {
            $locale = auth()->user()->language;
            Session::put('locale', $locale);
        }
        
        if (!$locale) {
            $locale = 'en';
        }
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
