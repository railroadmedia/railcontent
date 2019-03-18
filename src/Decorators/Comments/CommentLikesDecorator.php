<?php

namespace Railroad\Railcontent\Decorators\Comments;

use Railroad\Railcontent\Repositories\CommentLikeRepository;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Resora\Decorators\DecoratorInterface;

class CommentLikesDecorator implements DecoratorInterface
{
    /**
     * @var CommentLikeService
     */
    private $commentLikeService;

    /**
     * CommentLikesDecorator constructor.
     *
     * @param CommentLikeRepository $commentLikeRepository
     */
    public function __construct(CommentLikeService $commentLikeService)
    {
        $this->commentLikeService = $commentLikeService;
    }

    public function decorate($comments)
    {
        $likeCount = $this->commentLikeService->countForCommentIds([$comments->getId()]);

        $likeUsers = $this->commentLikeService->getUserIdsForEachCommentId(
            [$comments],
            config('railcontent.comment_likes_amount_of_users')
        );
        $isLikedByCurrentUser = $this->commentLikeService->isLikedByUserId([$comments], auth()->id());

        $comments->createProperty('like_count', $likeCount[$comments->getId()]);
        $comments->createProperty('like_users', $likeUsers[$comments->getId()] ?? []);
        $comments->createProperty('is_liked', empty($isLikedByCurrentUser) ? false : true);
    }
}