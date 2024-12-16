<?php

namespace App\Modules\RailTracker\Trackers;

use Exception;
use Illuminate\Cache\Repository;
use Illuminate\Cookie\CookieJar;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Modules\RailTracker\Services\BatchService;
use App\Modules\RailTracker\ValueObjects\ExceptionVO;
use App\Modules\RailTracker\ValueObjects\RequestVO;

class ExceptionTracker extends TrackerBase
{
    public function __construct(
        DatabaseManager $databaseManager,
        Router $router,
        CookieJar $cookieJar,
        BatchService $batchService,
        Repository $cache = null
    ){
        parent::__construct(
            $databaseManager,
            $router,
            $cookieJar,
            $batchService,
            $cache
        );
        $this->batchService = $batchService;
    }

    /**
     * @param Request $request
     * @param Exception $exception
     * @return void
     */
    public function trackException(Request $request, Exception $exception)
    {
        try {
            $exceptionVO = new ExceptionVO($exception, RequestVO::$UUID);
            $this->batchService->storeException($exceptionVO);
        } catch (Exception $exception) {
            error_log($exception);
        }
    }
}
