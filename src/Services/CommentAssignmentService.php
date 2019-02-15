<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentAssignment;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;

class CommentAssignmentService
{
    /**
     * @var CommentAssignmentRepository
     */
    protected $commentAssignmentRepository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CommentAssignmentService constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->commentAssignmentRepository = $this->entityManager->getRepository(CommentAssignment::class);
    }

    /**
     * @param $commentId
     * @param $userId
     * @return array
     */
    public function store($commentId, $userId)
    {
        $comment =
            $this->entityManager->getRepository(Comment::class)
                ->find($commentId);

        $commentAssignment = $this->commentAssignmentRepository->findOneBy(
            [
                'comment' => $comment,
                'userId' => $userId,
            ]
        );
        if (!$commentAssignment) {
            $commentAssignment = new CommentAssignment();
            $commentAssignment->setComment($comment);
            $commentAssignment->setUserId($userId);
        }

        $this->entityManager->persist($commentAssignment);
        $this->entityManager->flush();

        return $commentAssignment;
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
        $assignedComments = $this->getQb($userId, $limit, $page, $orderByColumnAndDirection);

        return $assignedComments->getQuery()
            ->getResult();
    }

    /**
     * Call the repository function to get the assigned comments
     *
     * @param integer $userId
     * @return int
     */
    public function countAssignedCommentsForUser($userId)
    {
        $qb = $this->commentAssignmentRepository->createQueryBuilder('a');

        return $qb->select('count(a)')
            ->where('a.userId = :user')
            ->setParameter('user', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Delete all assignments for a given comment.
     *
     * @param integer $commentId
     * @return bool|null
     */
    public function deleteCommentAssignations($commentId)
    {
        $commentAssignments = $this->commentAssignmentRepository->findByComment($commentId);

        if (empty($commentAssignments)) {
            return false;
        }

        foreach ($commentAssignments as $commentAssignment) {
            $this->entityManager->remove($commentAssignment);
            $this->entityManager->flush();
        }

        return true;
    }

    /**
     * @param $userId
     * @param $limit
     * @param $first
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQb($userId, $limit, $page, string $orderByColumnAndDirection)
    : \Doctrine\ORM\QueryBuilder {

        $orderByDirection = substr($orderByColumnAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($orderByColumnAndDirection, '-');
        $first = ($page - 1) * $limit;

        if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
            $orderByColumn = camel_case($orderByColumn);
        }

        $assignedComments =
            $this->commentAssignmentRepository->createQueryBuilder('a')
                ->join('a.comment', 'c')
                ->where('a.userId = :userId')
                ->setParameter('userId', $userId)
                ->setMaxResults($limit)
                ->setFirstResult($first)
                ->orderBy('a.' . $orderByColumn, $orderByDirection);

        return $assignedComments;
    }
}