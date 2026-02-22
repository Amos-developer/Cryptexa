<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use App\Console\Kernel as ConsoleKernel;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withSingletons([
        ConsoleKernelContract::class => ConsoleKernel::class,
    ])

    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'require.2fa.pending' => \App\Http\Middleware\RequireTwoFactorPending::class,
        ]);
    })

    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
