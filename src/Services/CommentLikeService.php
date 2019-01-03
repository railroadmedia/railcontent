<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\Decorator;
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
        return $this->commentLikeRepository->query()->whereIn('comment_id', $commentIds)->get();
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
     * @param int $limit
     * @param int $page
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function getCommentLikesPaginated(
        $commentId,
        $limit = 25,
        $page = 1,
        $orderByColumn = 'created_on',
        $orderByDirection = 'desc'
    ) {
        $likesQuery =
            $this->commentLikeRepository->query()
                ->where('comment_id', $commentId)
                ->orderBy($orderByColumn, $orderByDirection);
        $likesCount = $likesQuery->count();

        $likesQuery =
            $this->commentLikeRepository->query()
                ->where('comment_id', $commentId)
                ->orderBy($orderByColumn, $orderByDirection);

        $likesData =
            $likesQuery->limit($limit)
                ->skip(($page - 1) * $limit)
                ->get();

        $results = [
            'results' => $likesData,
            'total_results' => $likesCount,
        ];

        return Decorator::decorate($results, 'comment_likes');
    }

    /**
     * @param $commentId
     * @param integer $userId
     * @return bool
     */
    public function create($commentId, $userId)
    {
        $commentLikeId = $this->commentLikeRepository->updateOrCreate(
            [
                'comment_id' => $commentId,
                'user_id' => $userId,
            ],
            [
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
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
        $deleted = $this->commentLikeRepository->query()->where(['user_id' => $userId, 'comment_id' => $commentId])
            ->delete();

        CacheHelper::deleteAllCachedSearchResults('get_comments_');

        event(new CommentUnLiked($commentId, $userId));

        return true;
    }
}