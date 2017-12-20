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
    public function __construct(CommentAssignmentRepository $commentAssignmentRepository)
    {
        $this->commentAssignmentRepository = $commentAssignmentRepository;
    }

    /**
     * @param $commentId
     * @param $userId
     * @return array
     */
    public function store($commentId, $userId)
    {
        $id = $this->commentAssignmentRepository->updateOrCreate(
            [
                'comment_id' => $commentId,
                'user_id' => $userId,
            ],
            [
                'assigned_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        return $this->commentAssignmentRepository->getById($id);
    }

    /**
     * Call the repository function to get the assigned comments
     *
     * @param integer $userId
     * @param int $page
     * @param int $limit
     * @param string $orderByColumnAndDirection
     * @return array
     * @internal param string $orderByColumn
     * @internal param string $orderByDirection
     */
    public function getAssignedCommentsForUser(
        $userId,
        $page = 1,
        $limit = 25,
        $orderByColumnAndDirection = '-assigned_on'
    ) {
        $orderByDirection = substr($orderByColumnAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($orderByColumnAndDirection, '-');

        return $this->commentAssignmentRepository->getAssignedCommentsForUser(
            $userId,
            $page,
            $limit,
            $orderByColumn,
            $orderByDirection
        );
    }

    /**
     * Call the repository function to get the assigned comments
     *
     * @param integer $userId
     * @return int
     */
    public function countAssignedCommentsForUser($userId)
    {
        return $this->commentAssignmentRepository->countAssignedCommentsForUser($userId);
    }

    /**
     * Delete all assignments for a given comment.
     *
     * @param integer $commentId
     * @return bool|null
     */
    public function deleteCommentAssignations($commentId)
    {
        return $this->commentAssignmentRepository->deleteCommentAssignations([$commentId]);
    }
}