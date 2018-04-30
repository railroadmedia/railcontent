<?php

namespace Railroad\Railcontent\Decorators\Comments;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Repositories\CommentLikeRepository;
use Railroad\Railcontent\Services\ConfigService;

class CommentLikesDecorator implements DecoratorInterface
{
    /**
     * @var CommentLikeRepository
     */
    private $commentLikeRepository;

    /**
     * CommentLikesDecorator constructor.
     * @param CommentLikeRepository $commentLikeRepository
     */
    public function __construct(CommentLikeRepository $commentLikeRepository)
    {
        $this->commentLikeRepository = $commentLikeRepository;
    }

    public function decorate($comments)
    {
        $commentAndReplyIds = [];

        foreach ($comments as $commentIndex => $comment) {
            $commentAndReplyIds[] = $comment['id'];

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                $commentAndReplyIds[] = $reply['id'];
            }
        }

        if (empty($commentAndReplyIds)) {
            return $comments;
        }

        $likeCounts = $this->commentLikeRepository->countForCommentIds($commentAndReplyIds);
        $likeUsers = $this->commentLikeRepository->getUserIdsForEachCommentId(
            $commentAndReplyIds,
            ConfigService::$commentLikesDecoratorAmountOfUsers
        );

        foreach ($comments as $commentIndex => $comment) {
            $comments[$commentIndex]['like_count'] = $likeCounts[$comment['id']] ?? 0;
            $comments[$commentIndex]['like_users'] = $likeUsers[$comment['id']] ?? 0;

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                $comments[$commentIndex]['replies'][$replyIndex]['like_count'] =
                    $likeCounts[$reply['id']] ?? 0;
                $comments[$commentIndex]['replies'][$replyIndex]['like_users'] =
                    $likeUsers[$reply['id']] ?? 0;
            }
        }

        return $comments;
    }
}