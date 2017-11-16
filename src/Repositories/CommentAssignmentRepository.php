<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Repositories\QueryBuilders\CommentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class CommentAssignmentRepository extends RepositoryBase
{
    /** If it's false all the comments assigned to manager id are returned. Otherwise return the comment id with manadgr id association
     * @var integer|bool
     */
    public static $availableCommentId = false;

    /** If it's false all the comments for any manager id are returned. Otherwise return the comments associated with the manager
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

    /** Pull the comments assignation
     * @param bool|integer $commentId
     * @return array
     */
    public function getAssignedComments($commentId = false)
    {
        $assignments = $this->query()
            ->selectColumns()
            ->leftJoin(ConfigService::$tableComments,
                'comment_id',
                '=',
                ConfigService::$tableComments.'.id')
            ->restrictByAssociatedManagerId()
            ->restrictByCommentId($commentId)
            ->getToArray();

        //get an array with comment ids that will be used as keys in the results
        $commentIds = array_pluck($assignments, 'id');

        return array_combine($commentIds, $assignments);
    }

    /** Delete the association between comment and manager user id
     * @param integer $commentId
     * @param intereg $userId
     * @return bool
     */
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