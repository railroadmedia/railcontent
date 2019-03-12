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
            config('railcontent.table_prefix'). 'comments'. '.id' => 'id',
            config('railcontent.table_prefix'). 'comments' . '.content_id' => 'content_id',
            config('railcontent.table_prefix'). 'comments' . '.comment' => 'comment',
            config('railcontent.table_prefix'). 'comments' . '.parent_id' => 'parent_id',
            config('railcontent.table_prefix'). 'comments'. '.user_id' => 'user_id',
            config('railcontent.table_prefix'). 'comments' . '.temporary_display_name' => 'display_name',
            config('railcontent.table_prefix'). 'comments'. '.created_on' => 'created_on',
            config('railcontent.table_prefix'). 'comments'. '.deleted_at' => 'deleted_at'
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

    public function aggregateOrderTable($table)
    {
        if (
            $table != config('railcontent.table_prefix'). 'comments' &&
            isset(ConfigService::$tableCommentsAggregates[$table])
        ) {
            $config = ConfigService::$tableCommentsAggregates[$table];

            if (isset($config['selectColumn'])) {
                $this->selectRaw($config['selectColumn']);
            }

            $this
                ->leftJoin(
                    $table,
                    $table .'.'. $config['foreignField'],
                    '=',
                    config('railcontent.table_prefix'). 'comments' .'.'. $config['localField']
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
            $this->where(config('railcontent.table_prefix'). 'comments' . '.user_id', '<>', CommentRepository::$availableUserId);
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
                config('railcontent.table_prefix') . 'content',
                'content_id',
                '=',
                config('railcontent.table_prefix') . 'content' . '.id'
            );
            $this->where(config('railcontent.table_prefix') . 'content' . '.type', CommentRepository::$availableContentType);
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
            $this->where(config('railcontent.table_prefix'). 'comments'. '.user_id', CommentRepository::$availableUserId);
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
            config('railcontent.table_prefix') . 'content' . ' as content',
            'content.id',
            '=',
            config('railcontent.table_prefix'). 'comments' . '.content_id'
        )
            ->whereIn('content.brand', array_values(array_wrap(config('railcontent.available_brands'))));

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
                config('railcontent.table_prefix'). 'comment_assignment',
                config('railcontent.table_prefix'). 'comment_assignment' . '.comment_id',
                '=',
                config('railcontent.table_prefix'). 'comments' . '.id'
            )
                ->where(
                    config('railcontent.table_prefix'). 'comment_assignment' . '.user_id',
                    CommentRepository::$assignedToUserId
                )
                ->addSelect( config('railcontent.table_prefix'). 'comment_assignment' . '.assigned_on');
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
                config('railcontent.table_prefix'). 'comment_assignment' . '.user_id',
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
            $this->where( config('railcontent.table_prefix'). 'comment_assignment' . '.comment_id', $commentId);
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
        $this->where(config('railcontent.table_prefix'). 'comments' . '.created_on', '>=', $creationDate);

        return $this;
    }

    public function directPaginate($page, $limit)
    {
        return parent::directPaginate($page, $limit); // TODO: Change the autogenerated stub
    }
}