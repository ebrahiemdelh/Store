<?php

use App\Http\Middleware\CheckUserType;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('web',[
            \App\Http\Middleware\UpdateLastActiveAt::class,
        ]);
        $middleware->alias([
            'auth.type' => CheckUserType::class,
            'updateLastActiveAt' => \App\Http\Middleware\UpdateLastActiveAt::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
