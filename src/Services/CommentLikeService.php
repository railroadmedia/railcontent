<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\CommentUnLiked;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\CommentLikeRepository;

class CommentLikeService
{
    /**
     * @var CommentLikeRepository
     */
    private $commentLikeRepository;

    /**
     * CommentService constructor.
     *
     * @param CommentLikeRepository $commentLikeRepository
     */
    public function __construct(CommentLikeRepository $commentLikeRepository)
    {
        $this->commentLikeRepository = $commentLikeRepository;
    }

    /**
     * @param $commentIds
     * @return array|null
     */
    public function getByCommentIds($commentIds)
    {
        return $this->commentLikeRepository->getByCommentIds($commentIds);
    }

    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function countForCommentIds($commentIds)
    {
        return $this->commentLikeRepository->countForCommentIds($commentIds);
    }

    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull)
    {
        return $this->commentLikeRepository->getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull);
    }

    /**
     * @param $commentId
     * @param integer $userId
     * @return bool
     */
    public function create($commentId, $userId)
    {
        $commentLikeId = $this->commentLikeRepository->create(
            [
                'comment_id' => $commentId,
                'user_id' => $userId,
                'created_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        CacheHelper::deleteAllCachedSearchResults('get_comments_');

        event(new CommentLiked($commentId, $userId));

        return true;
    }

    /**
     * @param $commentId
     * @param $userId
     * @return bool|int|null|array
     */
    public function delete($commentId, $userId)
    {
        $deleted = $this->commentLikeRepository->deleteForUserComment($commentId, $userId);

        CacheHelper::deleteAllCachedSearchResults('get_comments_');

        event(new CommentUnLiked($commentId, $userId));

        return true;
    }
}