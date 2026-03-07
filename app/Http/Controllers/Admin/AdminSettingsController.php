<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function cacheClean()
    {
        Artisan::call('cache:clear');
        return back()->with('success', 'Application cache cleared successfully');
    }

    public function configClear()
    {
        Artisan::call('config:clear');
        return back()->with('success', 'Configuration cache cleared successfully');
    }

    public function viewClear()
    {
        Artisan::call('view:clear');
        return back()->with('success', 'View cache cleared successfully');
    }

    public function routeClear()
    {
        Artisan::call('route:clear');
        return back()->with('success', 'Route cache cleared successfully');
    }

    public function optimize()
    {
        Artisan::call('optimize');
        return back()->with('success', 'Application optimized successfully');
    }

    public function optimizeClear()
    {
        Artisan::call('optimize:clear');
        return back()->with('success', 'All optimizations cleared successfully');
    }

    public function logsClear()
    {
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            file_put_contents($logFile, '');
        }
        return back()->with('success', 'Logs cleared successfully');
    }
}
