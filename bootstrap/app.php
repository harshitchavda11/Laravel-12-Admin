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
            Route::prefix('admin')
                ->name('admin.')
                ->middleware('web')
                ->group(base_path('routes/web/admin/auth.php'));

            Route::prefix('admin')
                ->name('admin.')
                ->middleware(['web', 'admin.guest'])
                ->group(base_path('routes/web/admin/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\RedirectIfNotAdmin::class,
            'admin.auth' => \App\Http\Middleware\CheckAdminAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
