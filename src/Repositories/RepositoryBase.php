<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ConfigService;

class RepositoryBase
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * CategoryRepository constructor.
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @return Connection
     */
    protected function connection()
    {
        return $this->databaseManager->connection(ConfigService::$databaseConnectionName);
    }

    /**
     * @param callable $callback
     * @return mixed
     */
    public function transaction(callable $callback)
    {
        return $this->connection()->transaction($callback);
    }
}