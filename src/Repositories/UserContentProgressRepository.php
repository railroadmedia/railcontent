<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class UserContentProgressRepository extends RepositoryBase
{
    use ByContentIdTrait;

    public static $cache = [];

    public function query()
    {
        return parent::connection()
            ->table(ConfigService::$tableUserContentProgress);
    }

    /**
     * @param $userId
     * @param array $contentIds
     * @return array
     */
    public function getByUserIdAndWhereContentIdIn($userId, array $contentIds)
    {
        $key = $userId . '+' . implode('_', $contentIds);

        if (!key_exists($key, self::$cache)) {
            self::$cache[$key] =
                $this->query()
                    ->where('user_id', $userId)
                    ->whereIn('content_id', $contentIds)
                    ->get()
                    ->toArray();

            return self::$cache[$key];
        }

        return self::$cache[$key];
    }

    /**
     * @param $userId
     * @param $contentId
     * @return bool
     */
    public function isContentAlreadyCompleteForUser($contentId, $userId)
    {
        return $this->query()
            ->where('user_id', $userId)
            ->where('content_id', $contentId)
            ->where('state', 'completed')
            ->exists();
    }

    /**
     * @param $contentType
     * @param $userId
     * @param $state
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function getMostRecentByContentTypeUserState($contentType, $userId, $state)
    {
        return $this->query()
            ->select([ConfigService::$tableUserContentProgress . '.*'])
            ->join(
                ConfigService::$tableContent,
                ConfigService::$tableContent . '.id',
                '=',
                ConfigService::$tableUserContentProgress . '.content_id'
            )
            ->where(ConfigService::$tableContent . '.brand', ConfigService::$brand)
            ->where(ConfigService::$tableContent . '.type', $contentType)
            ->where(ConfigService::$tableUserContentProgress . '.state', $state)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
            ->orderBy(ConfigService::$tableUserContentProgress . '.updated_on', 'desc')
            ->first();
    }

    /**
     * @param $contentType
     * @param $userId
     * @param $state
     * @param int $limit
     * @param int $skip
     * @return \Illuminate\Support\Collection
     */
    public function getPaginatedByContentTypeUserState($contentType, $userId, $state, $limit = 25, $skip = 0)
    {
        return $this->query()
            ->select([ConfigService::$tableUserContentProgress . '.*'])
            ->join(
                ConfigService::$tableContent,
                ConfigService::$tableContent . '.id',
                '=',
                ConfigService::$tableUserContentProgress . '.content_id'
            )
            ->where(ConfigService::$tableContent . '.brand', ConfigService::$brand)
            ->where(ConfigService::$tableContent . '.type', $contentType)
            ->where(ConfigService::$tableUserContentProgress . '.state', $state)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
            ->orderBy(ConfigService::$tableUserContentProgress . '.updated_on', 'desc')
            ->get();
    }

    /**
     * @param $state
     * @param array $contentIds
     * @return array
     */
    public function countTotalStatesForContentIds($state, array $contentIds)
    {
        return $this->query()
            ->select(
                [
                    $this->databaseManager->raw(
                        'COUNT(' . ConfigService::$tableUserContentProgress . '.id) as count'
                    ),
                    'content_id',
                ]
            )
            ->whereIn(ConfigService::$tableUserContentProgress . '.content_id', $contentIds)
            ->where(ConfigService::$tableUserContentProgress . '.state', $state)
            ->groupBy(ConfigService::$tableUserContentProgress . '.content_id')
            ->get()
            ->toArray();
    }

    /**
     * @param $id
     * @return array
     */
    public function getForUser($id)
    {
        return $this->query()
            ->join(
                ConfigService::$tableContent,
                function (JoinClause $join) {
                    $join->on(
                        ConfigService::$tableContent . '.id',
                        '=',
                        ConfigService::$tableUserContentProgress . '.content_id'
                    );
                }
            )
            ->where(ConfigService::$tableContent . '.brand', ConfigService::$brand)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $id)
            ->limit(100)
            ->get()
            ->toArray();
    }

    /**
     * @param $id
     * @param array $types
     * @param string $state
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param int $limit
     * @return array
     */
    public function getForUserStateContentTypes(
        $id,
        array $types,
        $state,
        $orderByColumn = 'updated_on',
        $orderByDirection = 'desc',
        $limit = 25
    ) {
        return $this->query()
            ->join(
                ConfigService::$tableContent,
                function (JoinClause $join) use ($types) {
                    $join->on(
                        ConfigService::$tableContent . '.id',
                        '=',
                        ConfigService::$tableUserContentProgress . '.content_id'
                    )
                        ->whereIn('type', $types);
                }
            )
            ->where(ConfigService::$tableContent . '.brand', ConfigService::$brand)
            ->where(ConfigService::$tableUserContentProgress . '.state', '=', $state)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $id)
            ->orderBy($orderByColumn, $orderByDirection)
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * @param $id
     * @param $type
     * @param null $state
     * @param bool $count
     * @return mixed
     */
    public function getLessonsForUserByType($id, $type, $state = null, $count = false)
    {
        $select = '*';

        if ($count) {
            $select = $this->databaseManager->raw(
                'COUNT(' . ConfigService::$tableUserContentProgress . '.id) as count'
            );
        }

        $query =
            $this->query()
                ->select($select)
                ->join(
                    ConfigService::$tableContent,
                    function (JoinClause $join) use ($type) {
                        $join->on(
                            ConfigService::$tableContent . '.id',
                            '=',
                            ConfigService::$tableUserContentProgress . '.content_id'
                        )
                            ->where(ConfigService::$tableContent . '.type', '=', $type);
                    }
                )
                ->where(ConfigService::$tableContent . '.brand', ConfigService::$brand)
                ->where(ConfigService::$tableUserContentProgress . '.user_id', '=', $id);

        if (!is_null($state)) {
            $query = $query->where(ConfigService::$tableUserContentProgress . '.state', '=', $state);
        }

        if ($count) {
            return $query->get()
                ->first()['count'];
        }

        return $query->get()
            ->toArray();
    }

    /**
     * @param $userId
     * @param $contentId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function getUserProgressOnContent($userId, $contentId)
    {
        return $this->query()
            ->where(ConfigService::$tableUserContentProgress . '.content_id', '=', $contentId)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
            ->first();
    }

    /**
     * @param $userId
     * @param null $date
     * @param null $state
     * @param bool $count
     * @return mixed
     */
    public function countUserProgress($userId, $date = null, $state = null, $brand = null)
    {
        $query =
            $this->query()
                ->select(
                    $this->databaseManager->raw(
                        'COUNT(' . ConfigService::$tableUserContentProgress . '.id) as count'
                    )
                )
                ->join(
                    ConfigService::$tableContent,
                    function (JoinClause $join) {
                        $join->on(
                            ConfigService::$tableContent . '.id',
                            '=',
                            ConfigService::$tableUserContentProgress . '.content_id'
                        );
                    }
                )
                ->whereIn(ConfigService::$tableContent . '.type', config('railcontent.singularContentTypes',[]))
                ->where(ConfigService::$tableUserContentProgress . '.user_id', '=', $userId);

        if ($brand) {
            $query->where(ConfigService::$tableContent . '.brand', '=', $brand);
        }

        if ($state) {
            $query->where(ConfigService::$tableUserContentProgress . '.state', '=', $state);
        }

        if ($date) {
            $query->where(ConfigService::$tableUserContentProgress . '.updated_on', '>=', $date);
        }

        return $query->get()
            ->first()['count'];
    }

    /**
     * @param $id
     * @param array $types
     * @param string $state
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param int $limit
     * @return array
     */
    public function getUserProgressForState(
        $id,
        $state,
        $orderByColumn = 'updated_on',
        $orderByDirection = 'desc'
    ) {
        return $this->query()
            ->join(
                ConfigService::$tableContent,
                function (JoinClause $join) {
                    $join->on(
                        ConfigService::$tableContent . '.id',
                        '=',
                        ConfigService::$tableUserContentProgress . '.content_id'
                    );
                }
            )
            ->where(ConfigService::$tableContent . '.brand', ConfigService::$brand)
            ->where(ConfigService::$tableUserContentProgress . '.state', '=', $state)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $id)
            ->orderBy($orderByColumn, $orderByDirection)
            ->get()
            ->toArray();
    }

    public function countContentProgress($contentId, $date = null, $state = null)
    {
        $query =
            $this->query()
                ->select(
                    $this->databaseManager->raw(
                        'COUNT(' . ConfigService::$tableUserContentProgress . '.id) as count'
                    )
                )
                ->join(
                    ConfigService::$tableContent,
                    function (JoinClause $join) {
                        $join->on(
                            ConfigService::$tableContent . '.id',
                            '=',
                            ConfigService::$tableUserContentProgress . '.content_id'
                        );
                    }
                )
                ->where(ConfigService::$tableContent . '.id', $contentId);

        if ($state) {
            $query->where(ConfigService::$tableUserContentProgress . '.state', '=', $state);
        }

        if ($date) {
            $query->where(ConfigService::$tableUserContentProgress . '.updated_on', '>=', $date);
        }

        return $query->get()
            ->first()['count'];
    }

}
