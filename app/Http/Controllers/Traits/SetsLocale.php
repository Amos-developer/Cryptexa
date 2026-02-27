<?php

namespace App\Http\Controllers\Traits;

trait SetsLocale
{
    protected function setLocale()
    {
        if (auth()->check() && auth()->user()->language) {
            app()->setLocale(auth()->user()->language);
        }
    }
}
