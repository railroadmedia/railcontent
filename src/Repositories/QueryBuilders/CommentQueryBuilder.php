<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;


use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;

class CommentQueryBuilder extends QueryBuilder
{
    /** Select the comments columns
     * @return $this
     */
    public function selectColumns()
    {
        $this->select(
            [
                ConfigService::$tableComments . '.id as id',
                ConfigService::$tableComments . '.content_id as content_id',
                ConfigService::$tableComments . '.comment as comment',
                ConfigService::$tableComments . '.parent_id as parent_id',
                ConfigService::$tableComments . '.user_id as user_id',
                ConfigService::$tableComments . '.created_on as created_on',
                ConfigService::$tableComments . '.deleted_at as deleted_at',
            ]
        );

        return $this;
    }

    /** Restrict the comments by content type
     * @return $this
     */
    public function restrictByType()
    {
        if (CommentRepository::$availableContentType) {
            $this->leftJoin(ConfigService::$tableContent,
                'content_id',
                '=',
                ConfigService::$tableContent . '.id');
            $this->where(ConfigService::$tableContent . '.type', CommentRepository::$availableContentType);
        }

        return $this;
    }

    /** Restrict the comments by content id
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
     * @return $this
     */
    public function restrictByUser()
    {
        if (CommentRepository::$availableUserId) {
            $this->where('user_id', CommentRepository::$availableUserId);
        }

        return $this;
    }

    /** Restrict the comments by visibility
     * @return $this
     */
    public function restrictByVisibility()
    {
        if(!CommentRepository::$pullSoftDeletedComments)
        {
            $this->whereNull('deleted_at');
        }

        return $this;
    }

}