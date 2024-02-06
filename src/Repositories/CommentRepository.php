<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
     * If this is empty comment for any content will be pulled. If its defined, the users comments will not be pulled.
     *
     * @var integer|bool
     */
    public static $blockedUserIds = [];

    /**
     * If this is false comment with any status will be pulled. If its defined, only comments with the given status will
     * be pulled.
     *
     * @var string|bool
     */
    public static $conversationStatus = false;

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
    protected $orderTableName;
    protected $orderTable;

    const CONVERSATION_STATUS_OPEN = 'open';
    const CONVERSATION_STATUS_CLOSED = 'closed';

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

        $this->orderTableName = ($orderByColumn == 'like_count' ?
            ConfigService::$tableCommentLikes :
            ConfigService::$tableComments);

        $this->orderTable = ($orderByColumn == 'like_count' ? '' :
            ConfigService::$tableComments);

        return $this;
    }

    /** Get all the comments that meet the search criteria, paginated
     * @return array
     */
    public function getComments($searchTerm = '')
    {
        if ($this->orderBy == 'replied_on') {
            $query =
                $this->query()
                    ->selectColumns()
                    ->aggregateOrderTable($this->orderTableName)
                    ->addSelect($this->databaseManager->raw('child_comment.created_on as child_created_on'))
                    ->addSelect($this->databaseManager->raw('child_comment.id as child_id'))
                    ->addSelect(
                        $this->databaseManager->raw(
                            'GREATEST(COALESCE(child_comment.created_on, "0000-00-00 00.00:00"), COALESCE(' . ConfigService::$tableComments . '.created_on, "0000-00-00 00.00:00")) as replied_on'
                        )
                    )
                    ->leftJoin(
                        ConfigService::$tableComments . ' as child_comment',
                        'child_comment.parent_id',
                        '=',
                        ConfigService::$tableComments . '.id'
                    )
                    ->whereNull(ConfigService::$tableComments . '.parent_id')
                    ->where(
                        function (Builder $builder) {
                            $builder->where(
                                'child_comment.id',
                                '=',
                                function (Builder $builder) {
                                    $builder->selectRaw('MAX(id) as id')
                                        ->from(ConfigService::$tableComments . ' as child_sub_comment')
                                        ->whereRaw(
                                            'child_sub_comment.parent_id = ' . ConfigService::$tableComments . '.id'
                                        );
                                }
                            )
                                ->orWhereNull('child_comment.id');
                        }
                    )
                    ->restrictByBrand()
                    ->restrictByType()
                    ->restrictByContentId()
                    ->restrictByUser()
                    ->restrictByConversationStatus()
                    ->restrictByVisibility()
                    ->restrictByAssignedUserId()
                    ->searchExpression($searchTerm)
                    ->selectCommentLikeCounts()
                    ->orderByRaw('replied_on ' . ($this->orderDirection))
                    ->groupBy(['child_comment.created_on', 'child_comment.id'])
                    ->directPaginate($this->page, 25);

            $rows = $query->get()->toArray();
        } else {
            $query = $this->query()
                ->selectColumns()
                ->aggregateOrderTable($this->orderTableName)
                ->restrictByBrand()
                ->restrictByType()
                ->restrictByContentId()
                ->restrictByUser()
                ->restrictByConversationStatus()
                ->restrictByVisibility()
                ->restrictByAssignedUserId()
                ->onlyComments()
                ->searchExpression($searchTerm)
                ->selectCommentLikeCounts()
                ->orderBy($this->orderBy, $this->orderDirection, $this->orderTable)
                ->orderBy('created_on', 'desc', ConfigService::$tableComments)
                ->directPaginate($this->page, $this->limit);

            $rows = $query->getToArray();
        }


        $repliesRows = $this->getRepliesByCommentIds(array_column($rows, 'id'));

        return $this->parseRows($rows, $repliesRows);
    }

    /**
     * Get current user comments that meet the search criteria, paginated
     *
     * @return array
     */
    public function getCurrentUserComments()
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByBrand()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByConversationStatus()
            ->restrictByVisibility()
            ->restrictByAssignedUserId()
            ->orderBy(
                $this->orderBy,
                $this->orderDirection,
                ConfigService::$tableComments
            )
            ->selectCommentLikeCounts()
            ->onlyComments()
            ->orderBy('created_on', 'desc', ConfigService::$tableComments)
            ->directPaginate($this->page, $this->limit);

        $rows = $query->getToArray();

        $commentsIds = [];
        $threadsIds = [];

        foreach ($rows as $item) {
            if ($item['parent_id']) {
                $threadsIds[] = $item['parent_id'];
            } else {
                $commentsIds[] = $item['id'];
            }
        }

        $repliesRows = $this->getRepliesByCommentIds($commentsIds);

        $threadRows = $this->getThreadByCommentIds($threadsIds);

        return $this->parseCurrentUserRows($rows, $repliesRows, $threadRows);
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
            ->restrictByConversationStatus()
            ->restrictByVisibility()
            ->restrictByAssignedUserId()
            ->onlyComments();

        return $query->count();
    }

    /** Count all the comments
     * @return int
     */
    public function countCommentsAndReplies()
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByBrand()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictBlockedUsers()
            ->restrictByConversationStatus()
            ->restrictByVisibility()
            ->restrictByAssignedUserId();

        return $query->count();
    }

    /**
     * Count current user comments
     * @return int
     */
    public function countCurrentUserComments()
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByBrand()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByConversationStatus()
            ->restrictByVisibility()
            ->restrictByAssignedUserId();

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
    public function query()
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

    /**
     * Parse the rows to return the results in the following format:
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
     *
     * @param $rows - comment or replies having current user as author
     * @param $repliesRows - replies to current user comments
     * @param $threadRows - if any of the current user comments are replies, the threads (parent comment and other replies to it)
     *
     * @return array
     */
    private function parseCurrentUserRows($rows, $repliesRows, $threadRows)
    {
        $results = [];

        // get threads from $rows
        foreach ($rows as $item) {
            if ($item['parent_id'] === null) {
                $results[$item['id']] = $item;
            }
        }

        // get threads from $threadRows
        foreach ($threadRows as $item) {
            if ($item['parent_id'] === null) {
                $results[$item['id']] = $item;
            }
        }

        // add replies from $rows
        foreach ($rows as $item) {
            if ($item['parent_id'] !== null && isset($results[$item['parent_id']])) {
                if (!isset($results[$item['parent_id']]['replies'])) {
                    $results[$item['parent_id']]['replies'] = [];
                }
                $results[$item['parent_id']]['replies'][] = $item;
            }
        }

        // add replies from $repliesRows
        foreach ($repliesRows as $item) {
            if (isset($results[$item['parent_id']])) {
                if (!isset($results[$item['parent_id']]['replies'])) {
                    $results[$item['parent_id']]['replies'] = [];
                }
                $results[$item['parent_id']]['replies'][] = $item;
            }
        }

        // add replies from $threadRows
        foreach ($threadRows as $item) {
            if ($item['parent_id'] !== null && isset($results[$item['parent_id']])) {
                if (!isset($results[$item['parent_id']]['replies'])) {
                    $results[$item['parent_id']]['replies'] = [];
                }
                $results[$item['parent_id']]['replies'][] = $item;
            }
        }

        return $results;
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

        foreach ($rows as $row) {
            $comment = [
                'id' => $row['id'],
                'comment' => $row['comment'],
                'content_id' => $row['content_id'],
                'parent_id' => $row['parent_id'],
                'user_id' => $row['user_id'],
                'assigned_moderator_id' => $row['assigned_moderator_id'],
                'conversation_status' => $row['conversation_status'],
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
            ->restrictBlockedUsers()
            ->get()
            ->toArray();
    }

    /**
     * Pull all the comments, main and replies, having id or parent id in $threadIds
     *
     * @param array $threadIds
     * @return array
     */
    private function getThreadByCommentIds(array $threadIds)
    {
        return $this->query()
            ->selectColumns()
            ->where(function ($query) use ($threadIds) {
                $query
                    ->whereIn('parent_id', $threadIds)
                    ->orWhereIn('id', $threadIds);
            })
            ->restrictByVisibility()
            ->excludeByUser()
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
            ->restrictByConversationStatus()
            ->restrictByVisibility()
            ->restrictByAssignedUserId()
            ->restrictByCreationDate($createdOn)
            ->onlyComments();

        return $query->count();
    }

    public function markUserCommentsAsDeleted($userId)
    {
        $deleted =
            $this->query()
                ->where(['user_id' => $userId])
                ->update([
                    'deleted_at' => Carbon::now()
                        ->toDateTimeString(),
                ]);

        return $deleted;
    }
}
