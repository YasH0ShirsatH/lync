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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest.multi' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);

        $middleware->redirectTo(
            guests: 'account/login',
            users: function ($request) {
                if (auth()->guard('teacher')->check()) {
                    return '/teacher/dashboard';
                } elseif (auth()->guard('student')->check()) {
                    return '/student/dashboard';
                }
                return '/account/login';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
