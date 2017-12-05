<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentAssignmentService;


class UnassignCommentEventListener
{
    private $commentAssignmentService;

    private $commentRepository;

    public function __construct(CommentAssignmentService $commentAssignmentService, CommentRepository $commentRepository)
    {
        $this->commentAssignmentService = $commentAssignmentService;
        $this->commentRepository = $commentRepository;
    }

    /** Call the store method from service to assign the comment to the corresponding manager id
     * @param Event $event
     * @return int
     */
    public function handle(Event $event)
    {
        $this->commentRepository->deleteCommentReplies($event->commentId);

        $results = $this->commentAssignmentService->unassignComment($event->commentId);

        return $results;
    }

}