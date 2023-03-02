<?php

namespace Railroad\Railcontent\Decorators\Comments;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Repositories\CommentLikeRepository;
use Railroad\Railcontent\Repositories\ReportedCommentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Support\Collection;

class CommentLikesDecorator implements DecoratorInterface
{
    private CommentLikeRepository $commentLikeRepository;
    private ReportedCommentRepository $reportedCommentRepository;

    /**
     * @param CommentLikeRepository $commentLikeRepository
     * @param ReportedCommentRepository $reportedCommentRepository
     */
    public function __construct(CommentLikeRepository $commentLikeRepository, ReportedCommentRepository $reportedCommentRepository)
    {
        $this->commentLikeRepository = $commentLikeRepository;
        $this->reportedCommentRepository = $reportedCommentRepository;
    }

    public function decorate(Collection $comments)
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
        $isLikedByCurrentUser = $this->commentLikeRepository->isLikedByUserId($commentAndReplyIds, auth()->id());
        $isReportedByCurrentUser =  $this->reportedCommentRepository->isReportedByUserId($commentAndReplyIds, auth()->id());
        $comments = $comments->toArray();
        foreach ($comments as $commentIndex => $comment) {
            $comments[$commentIndex]['like_count'] = $likeCounts[$comment['id']] ?? 0;
            $comments[$commentIndex]['like_users'] = $likeUsers[$comment['id']] ?? [];
            $comments[$commentIndex]['is_liked'] = (boolean)($isLikedByCurrentUser[$comment['id']] ?? false);
            $comments[$commentIndex]['is_reported_by_viewer'] = (boolean)($isReportedByCurrentUser[$comment['id']] ?? false);

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                $comments[$commentIndex]['replies'][$replyIndex]['like_count'] =
                    $likeCounts[$reply['id']] ?? 0;
                $comments[$commentIndex]['replies'][$replyIndex]['like_users'] =
                    $likeUsers[$reply['id']] ?? [];
                $comments[$commentIndex]['replies'][$replyIndex]['is_liked'] =
                    (boolean)($isLikedByCurrentUser[$reply['id']] ?? false);
                $comments[$commentIndex]['replies'][$replyIndex]['is_reported_by_viewer'] =
                    (boolean)($isReportedByCurrentUser[$reply['id']] ?? false);
            }
        }

        return new Collection($comments);
    }
}