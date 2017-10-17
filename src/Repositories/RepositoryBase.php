<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;
use Illuminate\Http\Request;

class RepositoryBase
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->databaseManager = app('db');
    }

    /**
     * @return Connection
     */
    protected function connection()
    {
        return app('db')->connection(ConfigService::$databaseConnectionName);
    }

    /**
     * @param callable $callback
     * @return mixed
     */
    public function transaction(callable $callback)
    {
        return $this->connection()->transaction($callback);
    }

    /**
     * @param Request $request
     * @return int|null
     */
    public function getAuthenticatedUserId(Request $request)
    {
        return $request->user()->id ?? null;
    }
}