<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header("Access-Control-Allow-Origin", env('FRONT_DOMAIN', '*'));
        $response->header("Access-Control-Allow-Credentials", "true");
        $response->header("Access-Control-Max-Age", "600");

        $response->header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE, PUT");

        $response->header("Access-Control-Allow-Headers", "Content-Type, Accept, Authorization, X-Requested-With, Application");

        return $response;
    }
}
