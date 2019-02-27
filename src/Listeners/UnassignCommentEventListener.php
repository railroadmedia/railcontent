<?php

namespace Railroad\Railcontent\Listeners;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Services\CommentAssignmentService;


class UnassignCommentEventListener
{
    private $entityManager;

    private $commentAssignmentService;

    private $commentRepository;


    public function __construct(CommentAssignmentService $commentAssignmentService, EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->commentAssignmentService = $commentAssignmentService;
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
    }

    /**
     * Call the store method from service to assign the comment to the corresponding manager id
     *
     * @param CommentDeleted $event
     * @return int
     */
    public function handle(CommentDeleted $event)
    {
        $this->commentRepository->deleteCommentReplies($event->commentId);

        $results = $this->commentAssignmentService->deleteCommentAssignations($event->commentId);

        return $results;
    }

}