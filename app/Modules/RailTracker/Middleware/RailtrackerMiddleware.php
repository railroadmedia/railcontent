<?php

namespace App\Modules\RailTracker\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Modules\RailTracker\Services\BatchService;
use App\Modules\RailTracker\ValueObjects\RequestVO;
use Ramsey\Uuid\Uuid;

class RailtrackerMiddleware
{
    /**
     * @var BatchService
     */
    private $batchService;

    public static $UUID;

    /**
     * RailtrackerMiddleware constructor.
     *
     * @param BatchService $batchService
     */
    public function __construct(
        BatchService $batchService
    ){
        $this->batchService = $batchService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        // skip if disabled in the config
        if (config('railtracker.global_is_active') != true) {
            return $next($request);
        }

        // if the path is in the exclusions skip the request
        foreach (config('railtracker.exclusion_regex_paths') as $exclusionRegexPath) {
            if (preg_match($exclusionRegexPath, $request->path())) {
                return $next($request);
            }
        }

        // set visitor cookie if there isn't one already and there is no authenticated user
        if (empty($request->user()) && !$request->cookies->has(RequestVO::$visitorCookieKey)) {
            $cookieId = Uuid::uuid4()->toString();
            $cookie = cookie()->forever(RequestVO::$visitorCookieKey, $cookieId);

            $request->cookies->set(RequestVO::$visitorCookieKey, $cookieId);
        }

        $response = $next($request);

        // set tracking cookie on response
        if (!empty($cookie) && !empty($response)) {
            $response->withCookie($cookie);
        }

        return $response;
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     */
    public function terminate(Request $request, $response): void
    {
        // send request to cache
        try {
            $requestVO = new RequestVO($request);
            $this->batchService->storeRequest($requestVO);

            // add response data and resend request to cache
            $requestVO->setResponseData($response);

            $this->batchService->storeRequest($requestVO);
        } catch (Exception $exception) {
            error_log($exception);
        }
    }
}
