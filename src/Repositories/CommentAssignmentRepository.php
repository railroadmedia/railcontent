<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;

class CommentAssignmentRepository extends RepositoryBase
{
    /**
     * @return Builder
     */
    protected function query()
    {
        return $this->connection()->table(ConfigService::$tableCommentsAssignment);
    }

    public function getAssignedComments($userId)
    {
        return $this->query()->where(
            [
                'user_id' => $userId
            ]
        )->getToArray();
    }

}