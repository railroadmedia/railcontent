<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;

class CommentAssignmentService
{

    /**
     * @var CommentAssignmentRepository
     */
    protected $commentAssignmentRepository;

    /**
     * CommentAssignmentService constructor.
     *
     * @param CommentAssignmentRepository $commentAssignmentRepository
     */
    public function __construct(
        CommentAssignmentRepository $commentAssignmentRepository
    ) {
        $this->commentAssignmentRepository = $commentAssignmentRepository;
    }

    /** Call the create method from repository that save the comment assignation to user.
     * The user id it's specified in the config file for content types.
     * Return the comment assignment id
     *
     * @param array $comment
     * @param string $contentType
     * @return array
     */
    public function store($comment, $contentType)
    {
        if (!array_key_exists($contentType, ConfigService::$commentsAssignation)) {
            return false;
        }

        $managerUserId = ConfigService::$commentsAssignation[$contentType];

        //if the manager create the comment we should not assign it
        if ($comment['user_id'] == $managerUserId) {
            return false;
        }

        $this->commentAssignmentRepository->create(
            [
                'comment_id' => $comment['id'],
                'user_id' => $managerUserId,
                'assigned_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        CommentAssignmentRepository::$availableAssociatedManagerId = $managerUserId;

        return $this->getAssignedComments($comment['id']);
    }

    /** Call the repository function to get the assigned comments
     *
     * @param bool|integer $commentId
     * @return array
     */
    public function getAssignedComments($commentId = false)
    {
        return $this->commentAssignmentRepository->getAssignedComments($commentId);
    }

    /** Call the method from repository that delete the link between comment and manager id if the link exist.
     * Return null if the link not exist or the method response.
     *
     * @param integer $commentId
     * @param integer $userId
     * @return bool|null
     */
    public function deleteCommentAssignation($commentId, $userId)
    {
        $commentAssignation = $this->getAssignedComments($commentId);
        if (count($commentAssignation) == 0) {
            return null;
        }
        return $this->commentAssignmentRepository->deleteCommentAssignation($commentId, $userId);
    }

}