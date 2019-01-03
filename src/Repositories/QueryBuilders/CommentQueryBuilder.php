<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\ConfigService;

class CommentQueryBuilder extends QueryBuilder
{
    protected function getSelectColumns()
    {
        return [
            ConfigService::$tableComments . '.id' => 'id',
            ConfigService::$tableComments . '.content_id' => 'content_id',
            ConfigService::$tableComments . '.comment' => 'comment',
            ConfigService::$tableComments . '.parent_id' => 'parent_id',
            ConfigService::$tableComments . '.user_id' => 'user_id',
            ConfigService::$tableComments . '.temporary_display_name' => 'display_name',
            ConfigService::$tableComments . '.created_on' => 'created_on',
            ConfigService::$tableComments . '.deleted_at' => 'deleted_at',
        ];
    }

    /** Select the comments columns
     *
     * @return $this
     */
    public function selectColumns()
    {
        $columns = [];

        foreach ($this->getSelectColumns() as $field => $alias) {
            $columns[] = $field . ' as ' . $alias;
        }

        $this->select(
            $columns
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function selectLikeCounts()
    {
        $this->leftJoin(
            $this->raw(
                "(SELECT COUNT(*) AS like_count, content_id as _content_id FROM " .
                ConfigService::$tableContentLikes .
                " GROUP BY _content_id) content_likes"
            ),
            "content_likes._content_id",
            "=",
            ConfigService::$tableComments . '.content_id'
        );

        return $this;
    }

    public function aggregateOrderTable($table)
    {
        if ($table != ConfigService::$tableComments && isset(ConfigService::$tableCommentsAggregates[$table])) {
            $config = ConfigService::$tableCommentsAggregates[$table];

            if (isset($config['selectColumn'])) {
                $this->selectRaw($config['selectColumn']);
            }

            $this->leftJoin(
                $table,
                $table . '.' . $config['foreignField'],
                '=',
                ConfigService::$tableComments . '.' . $config['localField']
            );

            if (isset($config['groupBy'])) {

                $this->groupBy($config['groupBy'], ...array_keys($this->getSelectColumns()));
            }
        }

        return $this;
    }

    /** Exclude the comments by user id
     *
     * @return $this
     */
    public function excludeByUser()
    {
        if (CommentRepository::$availableUserId) {
            $this->where(ConfigService::$tableComments . '.user_id', '<>', CommentRepository::$availableUserId);
        }

        return $this;
    }

    /** Restrict the comments by content type
     *
     * @return $this
     */
    public function restrictByType()
    {
        if (CommentRepository::$availableContentType) {
            $this->leftJoin(
                ConfigService::$tableContent,
                'content_id',
                '=',
                ConfigService::$tableContent . '.id'
            );
            $this->where(ConfigService::$tableContent . '.type', CommentRepository::$availableContentType);
        }

        return $this;
    }

    /** Restrict the comments by content id
     *
     * @return $this
     */
    public function restrictByContentId()
    {
        if (CommentRepository::$availableContentId) {
            $this->where('content_id', CommentRepository::$availableContentId);
        }

        return $this;
    }

    /** Restrict the comments by user id
     *
     * @return $this
     */
    public function restrictByUser()
    {
        if (CommentRepository::$availableUserId) {
            $this->where(ConfigService::$tableComments . '.user_id', CommentRepository::$availableUserId);
        }

        return $this;
    }

    /** Restrict the comments by visibility
     *
     * @return $this
     */
    public function restrictByVisibility()
    {
        if (!CommentRepository::$pullSoftDeletedComments) {
            $this->whereNull('deleted_at');
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByBrand()
    {
        $this->leftJoin(
            ConfigService::$tableContent . ' as content',
            'content.id',
            '=',
            ConfigService::$tableComments . '.content_id'
        )
            ->whereIn('content.brand', array_values(array_wrap(ConfigService::$availableBrands)));

        return $this;
    }

    /** Restrict the comments by visibility
     *
     * @return $this
     */
    public function restrictByAssignedUserId()
    {
        if (CommentRepository::$assignedToUserId !== false) {
            $this->leftJoin(
                ConfigService::$tableCommentsAssignment,
                ConfigService::$tableCommentsAssignment . '.comment_id',
                '=',
                ConfigService::$tableComments . '.id'
            )
                ->where(
                    ConfigService::$tableCommentsAssignment . '.user_id',
                    CommentRepository::$assignedToUserId
                )
                ->addSelect(ConfigService::$tableCommentsAssignment . '.assigned_on');
        }

        return $this;
    }

    /** Only the comments are returned
     *
     * @return $this
     */
    public function onlyComments()
    {
        $this->whereNull('parent_id');

        return $this;
    }

    /** Restrict comments by associated manager id
     *
     * @return $this
     */
    public function restrictByAssociatedManagerId()
    {

        if (CommentAssignmentRepository::$availableAssociatedManagerId) {
            $this->where(
                ConfigService::$tableCommentsAssignment . '.user_id',
                CommentAssignmentRepository::$availableAssociatedManagerId
            );
        }

        return $this;
    }

    /** Restrict by comment id
     *
     * @param $commentId
     * @return $this
     */
    public function restrictByCommentId($commentId)
    {
        if ($commentId) {
            $this->where(ConfigService::$tableCommentsAssignment . '.comment_id', $commentId);
        }

        return $this;
    }

    /** Restrict comments by creation date, will return the comments created after the param creationDate
     *
     * @param string $creationDate
     * @return $this
     */
    public function restrictByCreationDate($creationDate)
    {
        $this->where(ConfigService::$tableComments . '.created_on', '>=', $creationDate);

        return $this;
    }

    public function directPaginate($page, $limit)
    {
        return parent::directPaginate($page, $limit); // TODO: Change the autogenerated stub
    }
}