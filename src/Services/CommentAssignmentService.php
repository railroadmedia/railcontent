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
        return $this->commentAssignmentRepository->query()->updateOrCreate(
            [
                'comment_id' => $commentId,
                'user_id' => $userId,
            ],
            [
                'assigned_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
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

        $assignedComments =
            $this->commentAssignmentRepository->query()
                ->selectColumns()
                ->leftJoin(
                    ConfigService::$tableComments,
                    'comment_id',
                    '=',
                    ConfigService::$tableComments . '.id'
                )
                ->where(ConfigService::$tableCommentsAssignment . '.user_id', $userId)
                ->orderBy(
                    $orderByColumn,
                    $orderByDirection,
                    ConfigService::$tableCommentsAssignment
                )
                ->skip(($page - 1) * $limit)
                ->limit($limit)
                ->get();

        return $assignedComments;
    }

    /**
     * Call the repository function to get the assigned comments
     *
     * @param integer $userId
     * @return int
     */
    public function countAssignedCommentsForUser($userId)
    {
        return $this->commentAssignmentRepository->query()
            ->selectColumns()
            ->leftJoin(
                ConfigService::$tableComments,
                'comment_id',
                '=',
                ConfigService::$tableComments . '.id'
            )
            ->where(ConfigService::$tableCommentsAssignment . '.user_id', $userId)
            ->count();
    }

    /**
     * Delete all assignments for a given comment.
     *
     * @param integer $commentId
     * @return bool|null
     */
    public function deleteCommentAssignations($commentId)
    {
        return $this->commentAssignmentRepository->query()
                ->whereIn('comment_id', [$commentId])
                ->delete() > 0;
    }
}