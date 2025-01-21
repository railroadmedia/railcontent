<?php

namespace App\Modules\RailTracker\Trackers;

use Illuminate\Cache\Repository;
use Illuminate\Cookie\CookieJar;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Modules\RailTracker\Services\BatchService;
use App\Modules\RailTracker\Services\ConfigService;

class TrackerBase
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Repository
     */
    protected $cache;

    /**
     * @var CookieJar
     */
    protected $cookieJar;

    /**
     * @var BatchService
     */
    protected $batchService;

    /**
     * TrackerBase constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param Router $router
     * @param CookieJar $cookieJar
     * @param Repository|null $cache
     * @param BatchService $batchService
     */
    public function __construct(
        DatabaseManager $databaseManager,
        Router $router,
        CookieJar $cookieJar,
        BatchService $batchService,
        Repository $cache = null
    ) {
        $this->databaseManager = $databaseManager;
        $this->router = $router;
        $this->cookieJar = $cookieJar;
        $this->batchService = $batchService;
        $this->cache = $cache;
    }

    /**
     * @param $table
     * @return Builder
     */
    protected function query($table)
    {
        return $this->connection()->table($table);
    }

    /**
     * @return Connection
     */
    protected function connection()
    {
        return $this->databaseManager->connection(config('railtracker.database_connection_name'));
    }

    /**
     * @param Request $request
     * @return string
     */
    protected function getClientIp(Request $request)
    {
        if (!empty(config('railtracker.ip-api.test-ip'))) {
            return config('railtracker.ip-api.test-ip');
        }

        if (!empty($request->server('HTTP_X_ORIGINAL_FORWARDED_FOR'))) {
            $ip = $request->server('HTTP_X_ORIGINAL_FORWARDED_FOR');
        }
        elseif (!empty($request->server('HTTP_X_FORWARDED_FOR'))) {
            $ip = $request->server('HTTP_X_FORWARDED_FOR');
        }
        elseif (!empty($request->server('HTTP_CLIENT_IP'))) {
            $ip = $request->server('HTTP_CLIENT_IP');
        }
        else {
            $ip = $request->server('REMOTE_ADDR');
        }

        return explode(',', $ip)[0] ?? '';
    }
}
