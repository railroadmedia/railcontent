<?php

namespace Railroad\Railcontent\Decorators\Comments;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\CommentLikeService;

class CommentLikesDecorator implements DecoratorInterface
{
    /**
     * @var CommentLikeService
     */
    private $commentLikeService;

    /**
     * CommentLikesDecorator constructor.
     *
     * @param CommentLikeService $commentLikeService
     */
    public function __construct(CommentLikeService $commentLikeService)
    {
        $this->commentLikeService = $commentLikeService;
    }

    public function decorate(array $entities): array
    {
        $likeCount = $this->commentLikeService->countForCommentIds([$entities->getId()]);

        $likeUsers = $this->commentLikeService->getUserIdsForEachCommentId(
            [$entities],
            config('railcontent.comment_likes_amount_of_users')
        );
        $isLikedByCurrentUser = $this->commentLikeService->isLikedByUserId([$entities], auth()->id());

        $entities->createProperty('like_count', $likeCount[$entities->getId()]);
        $entities->createProperty('like_users', $likeUsers[$entities->getId()] ?? []);
        $entities->createProperty('is_liked', empty($isLikedByCurrentUser) ? false : true);
    }
}