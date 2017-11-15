<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\QueryBuilders\CommentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class CommentAssignmentRepository extends RepositoryBase
{
    /**
     * @var integer|bool
     */
    public static $availableCommentId = false;

    /**
     * @var integer|bool
     */
    public static $availableAssociatedManagerId = false;

    /**
     * @return Builder
     */
    protected function query()
    {
        return (new CommentQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableCommentsAssignment);
    }

    public function getAssignedComments()
    {
        $assignments = $this->query()
            ->selectColumns()
            ->leftJoin(ConfigService::$tableComments,
                'comment_id',
                '=',
                ConfigService::$tableComments.'.id')
            ->restrictByAssociatedManagerId()
            ->restrictByCommentId()
            ->getToArray();

        //get an array with comment ids that will be used as keys in the results
        $commentIds = array_pluck($assignments, 'id');

        return array_combine($commentIds, $assignments);
    }

    public function deleteCommentAssignation($commentId, $userId)
    {
        return $this->query()->where(
            [
                'user_id' => $userId,
                'comment_id' => $commentId
            ]
        )->delete() > 0;
    }

}