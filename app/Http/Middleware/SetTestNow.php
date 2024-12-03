<?php

namespace App\Http\Middleware;

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Closure;

class SetTestNow
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!App::isProduction()) {
            if ($request->has('testNow')) {
                $testNow = Carbon::parse($request->get('testNow'))->timezone('UTC');
                Carbon::setTestNow($testNow);
                CarbonImmutable::setTestNow($testNow);
            }

            if ($request->hasHeader('testNow')) {
                $testNow = Carbon::parse($request->header('testNow'))->timezone('UTC');
                Carbon::setTestNow($testNow);
                CarbonImmutable::setTestNow($testNow);
            }
        }

        return $next($request);
    }
}
