<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
            then: function (): void {
                Route::middleware('web')->prefix('admin')->name('admin.')->group(base_path('routes/web/admin/auth.php'));
                Route::middleware(['web', 'admin_auth'])->prefix('admin')->name('admin.')->group(base_path('routes/web/admin/admin.php'));
            }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin_auth' => \App\Http\Middleware\RedirectIfNotAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
