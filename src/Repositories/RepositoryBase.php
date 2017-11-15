<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

abstract class RepositoryBase
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
     * @param integer $id
     * @return array
     */
    public function getById($id)
    {
        return $this->query()->where(['id' => $id])->first();
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return integer|null
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        $this->query()->updateOrInsert($attributes, $values);

        return $this->query()->where($attributes)->get(['id'])->first()['id'] ?? null;
    }

    /**
     * Returns new record id.
     *
     * @param array $data
     * @return int
     */
    public function create(array $data)
    {
        $existing = $this->query()->where($data)->first();

        if (empty($existing)) {
            return $this->query()->insertGetId($data);
        }

        return $existing['id'];
    }

    /**
     * @param integer $id
     * @param array $data
     * @return integer
     */
    public function update($id, array $data)
    {
        $existing = $this->query()->where(['id' => $id])->first();

        if (!empty($existing)) {
            $this->query()->where(['id' => $id])->update($data);
        }

        return $id;
    }

    /**
     * Delete a record.
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->query()->where(['id' => $id])->delete() > 0;
    }

    /**
     * @return Builder
     */
    protected abstract function query();

    /**
     * @return Connection
     */
    protected function connection()
    {
        /**
         * @var $realConnection Connection
         */
        $realConnection = app('db')->connection(ConfigService::$databaseConnectionName);
        $realConfig = $realConnection->getConfig();

        $realConfig['name'] = ConfigService::$connectionMaskPrefix . $realConfig['name'];

        $maskConnection =
            new Connection(
                $realConnection->getPdo(),
                $realConnection->getDatabaseName(),
                $realConnection->getTablePrefix(),
                $realConfig
            );

        return $maskConnection;
    }
}