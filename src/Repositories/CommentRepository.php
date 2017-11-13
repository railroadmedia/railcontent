<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\QueryBuilders\CommentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;

class CommentRepository extends RepositoryBase
{
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

    protected $page;
    protected $limit;
    protected $orderBy;
    protected $orderDirection;

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
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByVisibility()
            ->orderBy($this->orderBy, $this->orderDirection, ConfigService::$tableComments)
            ->directPaginate($this->page, $this->limit);

        return $query->get()->toArray();
    }

    /** Count all the comments
     * @return int
     */
    public function countComments()
    {
        $query = $this->query()
            ->selectColumns()
            ->restrictByType()
            ->restrictByContentId()
            ->restrictByUser()
            ->restrictByVisibility();

        return $query->count();
    }

    /** Based on softDelete we soft delete or permanently delete the comment with all his replies
     * @param int $id
     * @return bool|int
     */
    public function delete($id)
    {
        if ($this::$softDelete) {
            return $this->softDeleteCommentWithReplies($id);
        }

        return $this->deleteCommentWithReplies($id);
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
    private function softDeleteCommentWithReplies($id)
    {
        $deleted = $this->query()
            ->where(['parent_id' => $id])
            ->orWhere(['id' => $id])
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
    private function deleteCommentWithReplies($id)
    {
        $this->query()
            ->where(['parent_id' => $id])
            ->delete();

        $deleted = parent::delete($id);

        return $deleted;
    }
}