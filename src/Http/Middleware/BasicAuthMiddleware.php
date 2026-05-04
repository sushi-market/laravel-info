<?php

namespace DF\LaravelInfo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local')) {
            return $next($request);
        }

        $password = env('LARAVEL_INFO_PASSWORD');

        if (!$password || $request->getPassword() !== $password) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Laravel Info"',
            ]);
        }

        return $next($request);
    }
}
