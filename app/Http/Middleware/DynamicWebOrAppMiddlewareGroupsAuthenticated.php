<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class DynamicWebOrAppMiddlewareGroupsAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!empty(request()->bearerToken())) {
            $classes = app('router')->getMiddlewareGroups()['api_authenticated'] ?? [];
        } else {
            $classes = app('router')->getMiddlewareGroups()['web_authenticated'] ?? [];
        }

        return app(Pipeline::class)
            ->send($request)
            ->through($classes)
            ->then(function ($request) use ($next) {
                return $next($request);
            });
    }
}
