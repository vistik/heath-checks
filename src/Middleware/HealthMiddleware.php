<?php

namespace Phpsafari\Middleware;

use Closure;
use Phpsafari\Metrics\Metrics;

class HealthMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $time = round((microtime(true) - LARAVEL_START) * 1000, 2);
        Metrics::trackResponse($response);
        Metrics::trackRequest($request, $time);
    }
}
