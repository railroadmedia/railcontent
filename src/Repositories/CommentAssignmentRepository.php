<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\QueryBuilders\CommentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class CommentAssignmentRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    /**
     * @return CommentQueryBuilder
     */
    public function query()
    {
        return (new CommentQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableCommentsAssignment);
    }

    /**
     * @param int $userId
     * @param int $page
     * @param int $limit
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return array
     */
    public function getAssignedCommentsForUser(
        $userId,
        $page = 1,
        $limit = 25,
        $orderByColumn = 'assigned_on',
        $orderByDirection = 'desc'
    ) {
        $assignments = $this->query()
            ->selectColumns()
            ->leftJoin(
                ConfigService::$tableComments,
                'comment_id',
                '=',
                ConfigService::$tableComments . '.id'
            )
            ->where(ConfigService::$tableCommentsAssignment . '.user_id', $userId)
            ->orderBy(
                $orderByColumn,
                $orderByDirection,
                ConfigService::$tableCommentsAssignment
            )
            ->skip(($page - 1) * $limit)
            ->limit($limit)
            ->getToArray();

        return $assignments;
    }

    /**
     * @param int $userId
     * @return integer
     */
    public function countAssignedCommentsForUser($userId)
    {
        return $this->query()
            ->selectColumns()
            ->leftJoin(
                ConfigService::$tableComments,
                'comment_id',
                '=',
                ConfigService::$tableComments . '.id'
            )
            ->where(ConfigService::$tableCommentsAssignment . '.user_id', $userId)
            ->count();
    }

    /**
     * @param $commentId
     * @return bool
     */
    public function deleteCommentAssignations($commentId)
    {
        return $this->query()->whereIn('comment_id', $commentId)->delete() > 0;
    }
}