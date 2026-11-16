<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Storefront (Public)
            Route::middleware('web')
                ->group(base_path('routes/shop.php'));

            // Staff & Admin Portal
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            // Webhooks (Payment & External)
            Route::prefix('webhooks')
                ->name('webhooks.')
                ->group(base_path('routes/webhooks.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Exclude webhooks from CSRF verification
        $middleware->validateCsrfTokens(except: [
            'webhooks/*',
        ]);

        // Redirect unauthenticated users to admin login page
        $middleware->redirectGuestsTo('/admin/login');

        // Middleware aliases
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
