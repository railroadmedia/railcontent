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
    protected $databaseManager;

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var Connection
     */
    public static $connectionMask;

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->databaseManager = app('db');

        if (empty(self::$connectionMask)) {
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

            if (!empty($realConnection->getSchemaGrammar())) {
                $maskConnection->setSchemaGrammar($realConnection->getSchemaGrammar());
            }

            $maskConnection->setQueryGrammar($realConnection->getQueryGrammar());
            $maskConnection->setEventDispatcher($realConnection->getEventDispatcher());
            $maskConnection->setPostProcessor($realConnection->getPostProcessor());

            self::$connectionMask = $maskConnection;
        }

        $this->connection = self::$connectionMask;
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
     * @param $key
     * @param $value
     * @param $type
     * @param $position
     * @return array
     */
    public function getByKeyValueTypePosition($key, $value, $type, $position)
    {
        return $this->query()
            ->where(
                ['key' => $key, 'value' => $value, 'type' => $type, 'position' => $position]
            )
            ->get()
            ->toArray();
    }

    /**
     * @param $key
     * @param $value
     * @param $type
     * @return array
     */
    public function getByKeyValueType($key, $value, $type)
    {
        return $this->query()
            ->where(
                ['key' => $key, 'value' => $value, 'type' => $type]
            )
            ->get()
            ->toArray();
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
     * @param null $dataId
     * @param $data
     * @return bool|int
     */
    public function createOrUpdateAndReposition($dataId = null, $data)
    {
        $existingData = $this->query()
            ->where('id', $dataId)
            ->get()
            ->first();

        $contentId = $existingData['content_id'] ?? $data['content_id'];
        $key = $existingData['key'] ?? $data['key'];

        $dataCount = $this->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'key' => $key
                ]
            )
            ->count();

        $data['position'] = $this->recalculatePosition(
            $data['position'] ?? $existingData['position'],
            $dataCount,
            $existingData
        );

        if (empty($existingData)) {
            $this->incrementOtherEntitiesPosition(
                null,
                $contentId,
                $key,
                $data['position'],
                null
            );

            return $this->query()->insertGetId($data);

        } elseif ($data['position'] > $existingData['position']) {

            $this->query()
                ->where('id', $dataId)
                ->update($data);

            return $this->decrementOtherEntitiesPosition(
                $dataId,
                $contentId,
                $key,
                $existingData['position'],
                $data['position']
            );

        } elseif ($data['position'] < $existingData['position']) {
            $updated = $this->query()
                ->where('id', $dataId)
                ->update($data);

            $this->incrementOtherEntitiesPosition(
                $dataId,
                $contentId,
                $key,
                $data['position'],
                $existingData['position']
            );

            return $updated;

        } else {
            return $this->query()
                ->where('id', $dataId)
                ->update($data);
        }
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

    public function deleteAndReposition($entity, $positionColumnPrefix = '')
    {
        $existingLink = $this->query()
            ->where($entity)
            ->first();

        unset($entity['position']);
        unset($entity['id']);
        unset($entity['value']);
        unset($entity['type']);
        unset($entity['child_id']);

        $this->query()
            ->where($entity)
            ->where(
                $positionColumnPrefix . 'position',
                '>',
                $existingLink[$positionColumnPrefix . "position"]
            )
            ->decrement($positionColumnPrefix . 'position');

        $deleted = $this->query()
            ->where(['id' => $existingLink['id']])
            ->delete();
        return $deleted > 0;
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
        return $this->connection;
    }

    /**
     * @param $position
     * @param $dataCount
     * @param $existingData
     * @return mixed
     */
    private function recalculatePosition($position, $dataCount, $existingData)
    {
        if ($position === null || $position > $dataCount) {
            if (empty($existingData)) {
                $position = $dataCount + 1;
            } else {
                $position = $dataCount;
            }
        }

        if ($position < 1) {
            $position = 1;
        }

        return $position;
    }

    private function incrementOtherEntitiesPosition(
        $excludedEntityId = null,
        $contentId,
        $key,
        $startPosition,
        $endPosition = null
    ) {
        $query = $this->query()
            ->where('content_id', $contentId)
            ->where('key', $key)
            ->where('position', '>=', $startPosition);

        if ($excludedEntityId) {
            $query->where('id', '!=', $excludedEntityId);
        }

        if ($endPosition) {
            $query->where('position', '<', $endPosition);
        }

        return $query->increment('position') > 0;
    }

    private function decrementOtherEntitiesPosition(
        $excludedEntityId,
        $contentId,
        $key,
        $startPosition,
        $endPosition
    ) {
        return $this->query()
                ->where('content_id', $contentId)
                ->where('key', $key)
                ->where('id', '!=', $excludedEntityId)
                ->where('position', '>', $startPosition)
                ->where('position', '<=', $endPosition)
                ->decrement('position') > 0;
    }
}