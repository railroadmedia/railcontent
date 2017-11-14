<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Services\CommentAssignmentService;


class AssignCommentEventListener
{
    private $commentAssignmentService;

    public function __construct(CommentAssignmentService $commentAssignmentService)
    {
        $this->commentAssignmentService = $commentAssignmentService;
    }

    public function handle(Event $event)
    {
        $results = $this->commentAssignmentService->store($event->commentId, $event->contentType);

        return $results;
    }

}