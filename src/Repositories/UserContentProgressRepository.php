<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class UserContentProgressRepository extends RepositoryBase
{
    use ByContentIdTrait;
    /**
     * @param $userId
     * @param array $contentIds
     * @return array
     */
    public function getByUserIdAndWhereContentIdIn($userId, array $contentIds)
    {
        return $this->query()
            ->where('user_id', $userId)
            ->whereIn('content_id', $contentIds)
            ->get()
            ->toArray();
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

    public function query()
    {
        return parent::connection()->table(ConfigService::$tableUserContentProgress);
    }

    /**
     * @param $contentType
     * @param $userId
     * @param $state
     * @return array
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
     * @return array
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
                    'content_id'
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
            ->select()
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $id)
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

        if($count){
            $select = $this->databaseManager->raw(
                'COUNT(' . ConfigService::$tableUserContentProgress . '.id) as count'
            );
        }

        $query = $this->query()
            ->select($select)->join(
                ConfigService::$tableContent,
                function(JoinClause $join) use ($type){
                    $join
                        ->on(ConfigService::$tableContent . '.id',
                            '=',
                            ConfigService::$tableUserContentProgress . '.content_id'
                        )
                        ->where(ConfigService::$tableContent. '.type', '=', $type);
                }
            )
            ->where(ConfigService::$tableUserContentProgress . '.user_id', '=', $id);

        if(!is_null($state)){
            $query = $query->where(ConfigService::$tableUserContentProgress . '.state', '=',  $state);
        }

        if($count){
            return $query->get()->first()['count'];
        }

        return $query->get()->toArray();
    }
}