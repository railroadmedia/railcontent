<?php

namespace Railroad\Railcontent\Services;


use Railroad\Railcontent\Repositories\CommentAssignmentRepository;


class CommentAssignmentService
{

    /**
     * @var CommentAssignmentRepository
     */
    protected $commentAssignmentRepository;

    /**
     * CommentAssignmentService constructor.
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
     * @param integer $commentId
     * @param string $contentType
     * @return integer
     */
    public function store($commentId, $contentType)
    {
        $userId = ConfigService::$commentsAssignation[$contentType];

        $this->commentAssignmentRepository->create(
            [
                'comment_id' => $commentId,
                'user_id' => $userId
            ]);
        CommentAssignmentRepository::$availableAssociatedManagerId = $userId;
        CommentAssignmentRepository::$availableCommentId = $commentId;

        return $this->getAssignedComments();
    }

    public function getAssignedComments()
    {
        return $this->commentAssignmentRepository->getAssignedComments();
    }

    public function deleteCommentAssignation($commentId, $userId)
    {
        return $this->commentAssignmentRepository->deleteCommentAssignation($commentId, $userId);
    }


}