<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;

class UserContentProgressRepository extends RepositoryBase
{
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
}