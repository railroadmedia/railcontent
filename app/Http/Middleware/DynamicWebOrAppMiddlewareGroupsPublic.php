<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class DynamicWebOrAppMiddlewareGroupsPublic
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty($request->bearerToken()) || $request->expectsJson()) {
            $classes = app('router')->getMiddlewareGroups()['api_public'] ?? [];
        } else {
            $classes = app('router')->getMiddlewareGroups()['web_public'] ?? [];
        }

        return app(Pipeline::class)
            ->send($request)
            ->through($classes)
            ->then(function ($request) use ($next) {
                return $next($request);
            });
    }
}
