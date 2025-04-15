<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('x-api-token');
        if(!$token) {
            return  FacadesResponse::json([
                'message' => 'Api Token is required'
            ], 400);
        }
        if ($token !== env('app.api_token')) {
            return  FacadesResponse::json([
                'message' => 'Invalid Api Token'
            ], 400);
        }
        return $next($request);
    }
}
