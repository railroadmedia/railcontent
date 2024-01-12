<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Closure;

class LoggingContextMiddleware
{
    public static function getTraceId(): int
    {
        return rand(1000, 9999);
    }

    public function handle(Request $request, Closure $next): Response
    {
        $user = user();
        $url = $request->url();
        Log::shareContext(
            array_filter([
                    'tid' => self::getTraceId(),
                    'path' => $url,
                    'uid' => $user?->id,
                ]
            )
        );

        return $next($request);
    }
}
