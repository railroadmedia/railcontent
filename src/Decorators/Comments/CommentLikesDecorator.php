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

    /**
     * @param array $entitites
     * @return array
     */
    public function decorate(array $entitites)
    : array {
        $entitiesIds = array_map(
            function ($value) {
                return $value->getId();
            },
            $entitites
        );

        $likeCount = $this->commentLikeService->countForCommentIds($entitiesIds);

        $likeUsers = $this->commentLikeService->getUserIdsForEachCommentId(
            $entitiesIds,
            config('railcontent.comment_likes_amount_of_users')
        );

        $isLikedByCurrentUser = $this->commentLikeService->isLikedByUserId($entitiesIds, auth()->id());

        foreach ($entitites as $index => $entity) {
            $entity->createProperty('like_count', $likeCount[$entity->getId()]);
            $entity->createProperty('like_users', $likeUsers[$entity->getId()] ?? []);
            $entity->createProperty('is_liked', empty($isLikedByCurrentUser) ? false : true);
        }

        return $entitites;
    }
}