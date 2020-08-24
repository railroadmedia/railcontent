<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;

class AssignCommentEventListener
{
    private $commentAssignmentService;
    private $commentService;
    private $commentRepository;

    public function __construct(
        CommentAssignmentService $commentAssignmentService,
        CommentService $commentService,
        CommentRepository $commentRepository
    )
    {
        $this->commentAssignmentService = $commentAssignmentService;
        $this->commentService = $commentService;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param CommentCreated $commentCreatedEvent
     */
    public function handle(CommentCreated $commentCreatedEvent)
    {
        if (in_array($commentCreatedEvent->userId, ConfigService::$commentsAssignationOwnerIds)) {
            $this->commentAssignmentService->deleteCommentAssignations($commentCreatedEvent->parentId);
        }

        // if there is a new reply to a comment, set the conversation status to open unless its being created by an
        // admin or community mangers in which case it should remain closed
        if (!empty($commentCreatedEvent->parentId)) {
            if (!in_array($commentCreatedEvent->userId, ConfigService::$commentsAssignationOwnerIds)) {
                $this->commentRepository->update($commentCreatedEvent->parentId, ['conversation_status' => 'open']);
            }
        }
    }
}