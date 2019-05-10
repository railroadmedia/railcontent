<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class CommentRepository extends EntityRepository
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
     *
     * @var bool
     */
    public static $pullSoftDeletedComments = false;


    protected $page;
    protected $limit;
    protected $orderBy;
    protected $orderDirection;
    protected $orderTableName;
    protected $orderTable;

    /** Based on softDelete we soft delete or permanently delete the comment with all his replies
     *
     * @param $id
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteCommentReplies($id)
    {
        if ($this::$softDelete) {
            return $this->softDeleteReplies($id);
        }

        return $this->deleteReplies($id);
    }

    /** Mark comment and it's replies as deleted
     *
     * @param $id
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function softDeleteReplies($id)
    {
        $replies = $this->findByParent($id);
        foreach ($replies as $reply) {
            $reply->setDeletedAt(Carbon::now());
            $this->getEntityManager()
                ->flush();
        }

        return true;
    }

    /**
     * @param $id
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function deleteReplies($id)
    {
        $replies = $this->findByParent($id);
        foreach ($replies as $reply) {
            $this->getEntityManager()
                ->remove($reply);
            $this->getEntityManager()
                ->flush();
        }
    }

    /**
     * @return bool
     */
    public function getSoftDelete()
    {
        return $this::$softDelete;
    }
}