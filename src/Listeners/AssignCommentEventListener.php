<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\CommentRepository;

class AssignCommentEventListener
{

    /**
     * @var RailcontentEntityManager
     */
    private $railcontentEntityManager;

    /**
     * AssignCommentEventListener constructor.
     * @param RailcontentEntityManager $railcontentEntityManager
     */
    public function __construct(RailcontentEntityManager $railcontentEntityManager)
    {
        $this->railcontentEntityManager = $railcontentEntityManager;
    }

    /**
     * @param CommentCreated $commentCreatedEvent
     */
    public function handle(CommentCreated $commentCreatedEvent)
    {
        // if there is a new reply to a comment, set the conversation status to open unless its being created by an
        // admin or community mangers in which case it should remain closed
        if (!empty($commentCreatedEvent->parentId)) {
            if (!in_array($commentCreatedEvent->userId, config('rail.comment_assignation_owner_ids', []))) {
                $commentCreatedEvent->comment->setConversationStatus(CommentRepository::CONVERSATION_STATUS_OPEN);

                $this->railcontentEntityManager->persist($commentCreatedEvent->comment);
                $this->railcontentEntityManager->flush($commentCreatedEvent->comment);
            }
        }
    }
}