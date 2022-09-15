<?php

namespace App\Services;

use Illuminate\Database\Connection;
use Illuminte\Support\Collection;

class DatabaseService
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getDatabaseName()
    {
        return $this->connection->getDatabaseName();
    }

    public function tableExists(string $tableName)
    {
        $result = $this->query("SELECT table_name
                                         FROM information_schema.tables
                                         WHERE table_schema = '{$this->getDatabaseName()}'
                                             AND table_name = '$tableName'
                                         LIMIT 1");
        return $result->count() >= 1;
    }

    public function query($query)
    {
        return collect($this->connection->select($query));
    }
}
