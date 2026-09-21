<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'sales.context' => \App\Http\Middleware\ResolveActiveSales::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // User yang login tapi tertolak canAccessPanel() mendapat 403.
        // Alihkan ke panel milik role-nya sendiri alih-alih tampil 403 mentah.
        $exceptions->respond(function ($response, \Throwable $e, \Illuminate\Http\Request $request) {
            if ($response->getStatusCode() === 403 && ($user = $request->user())) {
                $target = match ($user->role) {
                    'admin' => '/admin',
                    'sales' => '/sales',
                    default => '/',
                };

                if ($request->getPathInfo() !== $target) {
                    return redirect($target);
                }
            }

            return $response;
        });
    })->create();
