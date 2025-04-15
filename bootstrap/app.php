<?php

use App\Http\Middleware\CheckApiToken;
use App\Http\Middleware\CheckUserType;
use App\Http\Middleware\UpdateLastActiveAt;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api/admin',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('web', [
            UpdateLastActiveAt::class,
        ]);
        $middleware->prependToGroup('api', [
            CheckApiToken::class,
        ]);
        $middleware->alias([
            'auth.type' => CheckUserType::class,
            'updateLastActiveAt' => UpdateLastActiveAt::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
