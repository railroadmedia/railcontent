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

    /** Call the store method from service to assign the comment to the corresponding manager id
     * @param Event $event
     * @return int
     */
    public function handle(Event $event)
    {
        $results = $this->commentAssignmentService->store($event->comment, $event->contentType);

        return $results;
    }

}