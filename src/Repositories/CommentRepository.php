<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\CommentQueryBuilder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class CommentRepository extends RepositoryBase
{
    use ByContentIdTrait;
    /** The value it's set in ContentPermissionMiddleware: if the user it's admin the value it's false, otherwise it's true.
     * If the value it' is false the comment with all his replies will be deleted.
     * If it's true the comment with the replies are only soft deleted (marked as deleted).
     *
     * @var bool
     */
    public static $softDelete = true;

    /**
     * If this is false comment for any content type will be pulled. If its defined, only comments for content with the
     * type will be pulled.
     *
     * @var string|bool
     */
    public static $availableContentType = false;

    /**
     * If this is false comment for any content will be pulled. If its defined, only comments for content with id
     *  will be pulled.
     *
     * @var integer|bool
     */
    public static $availableContentId = false;

    /**
     * If this is false comment for any content will be pulled. If its defined, only user comments will be pulled.
     *
     * @var integer|bool
     */
    public static $availableUserId = false;

    /**
     * If it's true all the comments (inclusive the comments marked as deleted) will be pulled.
     * If it's false, only the comments that are not marked as deleted will be pulled.
     * @var bool
     */
    public static $pullSoftDeletedComments = false;

    /**
     * If not false only pull comments that have been assigned to this user id.
     *
     * @var integer|bool
     */
    public static $assignedToUserId = false;

    protected $page;
    protected $limit;
    protected $orderBy;
    protected $orderDirection;

    /**
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        $row = $this->query()->selectColumns()->where(['id' => $id])->first();

        if ($row) {
            $repliesRows = $this->getRepliesByCommentIds(array_column([$row], 'id'));
            $parsedRows = $this->parseRows([$row], $repliesRows);
            $row = reset($parsedRows);
        }
        return $row;
    }
    
    /** Set the pagination parameters
     * @param int $page
     * @param int $limit
     * @param string $orderByDirection
     * @param string $orderByColumn
     * @return $this
     */
    public function setData($page, $limit, $orderByDirection, $orderByColumn)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderByColumn;
        $this->orderDirection = $orderByDirection;

        return $this;
    }

    /** Get all the comments that meet the search criteria, paginated
     * @return array
     */
    public function getComments()
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByBrand()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByVisibility()
            ->restrictByAssignedUserId()
            ->onlyComments()
            ->orderBy($this->orderBy, $this->orderDirection, ConfigService::$tableComments)
            ->directPaginate($this->page, $this->limit);

        $rows = $query->getToArray();

        $repliesRows =  $this->getRepliesByCommentIds(array_column($rows, 'id'));

        return $this->parseRows($rows, $repliesRows);
    }

    /** Count all the comments
     * @return int
     */
    public function countComments()
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByBrand()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByVisibility()
            ->restrictByAssignedUserId()
            ->onlyComments();

        return $query->count();
    }

    /** Based on softDelete we soft delete or permanently delete the comment with all his replies
     * @param int $id
     * @return bool|int
     */
    public function deleteCommentReplies($id)
    {
        if ($this::$softDelete) {
            return $this->softDeleteReplies($id);
        }

        return $this->deleteReplies($id);
    }

    /**
     * @return CommentQueryBuilder
     */
    protected function query()
    {
        return (new CommentQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableComments);
    }

    /** Mark comment and it's replies as deleted
     * @param integer $id
     * @return bool
     */
    private function softDeleteReplies($id)
    {
        $deleted = $this->query()
            ->where(['parent_id' => $id])
            ->update(
                [
                    'deleted_at' => Carbon::now()->toDateTimeString()
                ]
            );

        return $deleted;
    }

    /** Delete comment and it's replies
     * @param integer $id
     * @return bool
     */
    private function deleteReplies($id)
    {
        $deleted = $this->query()
            ->where(['parent_id' => $id])
            ->delete();

        return $deleted;
    }

    /** Parse the rows to return the results in the following format:
     * [
     *      comment_id => [
     *              'id' => comment id,
     *              'content_id' => content id,
     *              'comment' => comment text,
     *              'parent_id' => null for the comments
     *              'user_id' => the user id that create the comment,
     *              'created_on' => creation date,
     *              'deleted_at' => null|date when the comment was marked deleted
     *              'replies' => [
     *                  0 => [
     *                      'id' => reply id,
     *                      'content_id' => content id,
     *                      'comment' => reply text,
     *                      'parent_id' => the comment id
     *                      'user_id' => the user id that create the reply,
     *                      'created_on' => creation date,
     *                      'deleted_at' => null|date when the comment was marked deleted
     *                  ]
     *              ]
     *       ]
     * ]
     * @param $rows
     * @return array
     */
    private function parseRows($rows, $repliesRows)
    {
        $results = [];

        $repliesRowsGrouped = ContentHelper::groupArrayBy($repliesRows, 'parent_id');

        foreach($rows as $row){
            $comment = [
                'id' => $row['id'],
                'comment' => $row['comment'],
                'content_id' => $row['content_id'],
                'parent_id' => $row['parent_id'],
                'user_id' => $row['user_id'],
                'display_name' => $row['display_name'],
                'created_on' => $row['created_on'],
                'deleted_at' => $row['deleted_at'],
                'replies' => $repliesRowsGrouped[$row['id']] ?? []
            ];

            if (!empty($comment['assigned_on'])) {
                $comment['assigned_on'] = $row['assigned_on'];
            }

            $results[] = $comment;
        }

        return $results;
    }

    /** Pull all the comment's replies
     * @param array $commentIds
     * @return array
     */
    private function getRepliesByCommentIds(array $commentIds)
    {
        return $this->query()
            ->selectColumns()
            ->whereIn('parent_id', $commentIds)
            ->restrictByVisibility()
            ->get()
            ->toArray();
    }

    /**
     * @param array $comment
     * @return array
     */
    public function populateCommentWithReplies($comment)
    {
        return $this->parseRows($comment, $this->getRepliesByCommentIds([$comment['id']]));
    }

    public function deleteCommentsReplyAndAssignmentByContentId($contentId)
    {
        $commentsAndAssignment = $this->getByContentId($contentId);
    }

    public function getSoftDelete()
    {
        return $this::$softDelete;
    }

    /** Count the comments created after the createdOn date
     * @param string $createdOn
     * @return int
     */
    public function countLatestComments($createdOn)
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByBrand()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByVisibility()
            ->restrictByAssignedUserId()
            ->restrictByCreationDate($createdOn)
            ->onlyComments();

        return $query->count();
    }
}