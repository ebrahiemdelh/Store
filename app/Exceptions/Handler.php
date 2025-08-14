<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        // 'SomeException' => 'warning',
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (QueryException $e, $request) {
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage(),
            ])
            ->with('info', $e->getMessage())
            ;
        });
    }
}
