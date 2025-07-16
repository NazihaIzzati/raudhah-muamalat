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
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'locale' => \App\Http\Middleware\SetLocale::class,
        ]);
        
        // Apply SetLocale middleware to all web routes
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        
        // Exclude CSRF for API routes
        $middleware->validateCsrfTokens(except: [
            'api/*',
            'payment/api/*',
            'payment/cardzone/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
