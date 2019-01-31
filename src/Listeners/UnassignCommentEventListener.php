<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentAssignmentService;


class UnassignCommentEventListener
{
    private $commentAssignmentService;

    private $commentRepository;


    public function __construct(CommentAssignmentService $commentAssignmentService)
    {
        $this->commentAssignmentService = $commentAssignmentService;
       // $this->commentRepository = $commentRepository;
    }

    /**
     * Call the store method from service to assign the comment to the corresponding manager id
     *
     * @param CommentDeleted $event
     * @return int
     */
    public function handle(CommentDeleted $event)
    {
//        $this->commentRepository->deleteCommentReplies($event->commentId);
//
//        $results = $this->commentAssignmentService->deleteCommentAssignations($event->commentId);
//
//        return $results;
    }

}