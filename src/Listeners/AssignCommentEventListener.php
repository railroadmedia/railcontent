<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;

class AssignCommentEventListener
{
    private $commentAssignmentService;
    private $commentService;

    public function __construct(
        CommentAssignmentService $commentAssignmentService,
        CommentService $commentService
    ) {
        $this->commentAssignmentService = $commentAssignmentService;
        $this->commentService = $commentService;
    }

    /**
     * @param CommentCreated $commentCreatedEvent
     */
    public function handle(CommentCreated $commentCreatedEvent)
    {
        if (in_array($commentCreatedEvent->userId, ConfigService::$commentsAssignationOwnerIds)) {
            $this->commentAssignmentService->deleteCommentAssignations($commentCreatedEvent->parentId);
        }
    }
}