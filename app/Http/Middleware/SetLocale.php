<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = 'en';
        
        if (auth()->check() && auth()->user()->language) {
            $locale = auth()->user()->language;
        } elseif (session()->has('locale')) {
            $locale = session('locale');
        } elseif ($request->cookie('locale')) {
            $locale = $request->cookie('locale');
        }
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
