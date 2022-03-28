<?php

namespace Railroad\Railcontent\Services;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentLikes;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\CommentUnLiked;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\CommentRepository;

class CommentLikeService
{
    /**
     * @var ObjectRepository|EntityRepository
     */
    private $commentLikeRepository;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $commentRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * CommentLikeService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     * @param CommentRepository $commentRepository
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        UserProviderInterface $userProvider
    ) {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);

        $this->commentLikeRepository = $this->entityManager->getRepository(CommentLikes::class);

    }

    /**
     * @param $commentIds
     * @return mixed
     */
    public function getByCommentIds($commentIds)
    {
        return $this->commentLikeRepository->findByComment($commentIds);
    }

    /** Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array|false
     */
    public function countForCommentIds($commentIds)
    {
        $qb =
            $this->commentRepository->createQueryBuilder('co')
                ->leftJoin('co.likes', 'c');

        $results =
            $qb->select('co.id, count(c.id) as nr')
                ->where(
                    $qb->expr()
                        ->in('co.id', ':commentIds')
                )
                ->setParameter('commentIds', $commentIds)
                ->groupBy('co.id')
                ->getQuery()
                ->getResult('Railcontent');

        return array_combine(array_column($results, 'id'), array_column($results, 'nr'));
    }

    /** Returns [commentId => [user1, user2], ...]
     *
     * @param $commentIds
     * @param $amountOfUserIdsToPull
     * @return array
     */
    public function getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull)
    {
        $commentIds = array_unique(array_values($commentIds));
        $commentLikes = [];
        $alias = 'c';

        $qb =
            $this->commentLikeRepository->createQueryBuilder($alias)
                ->where($alias . '.comment IN (:commentIds)')
                ->setParameter('commentIds', $commentIds)
                ->orderByColumn($alias, 'createdOn', 'desc');
        $results =
            $qb->getQuery()
                ->getResult('Railcontent');

        foreach ($results as $result) {
            if (count(
                    $commentLikes[$result->getComment()
                        ->getId()] ?? []
                ) < $amountOfUserIdsToPull) {

                $commentLikes[$result->getComment()
                    ->getId()][] =
                    $result->getUser()
                        ->getId();
            }
        }

        return $commentLikes;
    }

    /**
     * @param $commentId
     * @param $userId
     * @return array|object[]|CommentLikes
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create($commentId, $userId)
    {
        $user = $this->userProvider->getUserById($userId);
        $comment = $this->commentRepository->find($commentId);

        $commentLikes = $this->commentLikeRepository->getUserCommentLikes($user, $comment);
        $commentLike = array_first($commentLikes);

        if (empty($commentLike)) {
            $commentLike = new CommentLikes();
            $commentLike->setUser($user);

        }
        $commentLike->setComment($comment);
        $this->entityManager->persist($commentLike);
        $this->entityManager->flush();

//        $this->entityManager->getCache()
//            ->evictEntity(Comment::class, $commentId);
//
//        $this->entityManager->getCache()
//            ->evictEntity(
//                Content::class,
//                $comment->getContent()
//                    ->getId()
//            );

         event(new CommentLiked($comment, $user));

        return $commentLikes;
    }

    /**
     * @param $commentId
     * @param $userId
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($commentId, $userId)
    {
        $user = $this->userProvider->getUserById($userId);
        $comment = $this->commentRepository->find($commentId);

        $commentLikes = $this->commentLikeRepository->findOneBy(
            [
                'comment' => $comment,
                'user' => $user,
            ]
        );

        if ($commentLikes) {
            $this->entityManager->remove($commentLikes);
            $this->entityManager->flush();

//            $this->entityManager->getCache()
//                ->evictEntity(Comment::class, $commentId);

            event(new CommentUnLiked($comment, $user));
        }
        return true;
    }

    /**
     * @param $commentAndReplyIds
     * @param $userId
     * @return array|false|mixed
     */
    public function isLikedByUserId($commentAndReplyIds, $userId)
    {
        $qb =
            $this->commentLikeRepository->createQueryBuilder('cl')
                ->join('cl.comment', 'c');
        $qb->select('cl.user as user, c.id as commentId')
            ->where('cl.user = :userId')
            ->andWhere('cl.comment IN (:commentIds)')
            ->setParameter('userId', $userId)
            ->setParameter('commentIds', $commentAndReplyIds);

        $results =
            $qb->getQuery()
                ->getResult('Railcontent');

        if (!empty($results)) {
            $results = array_combine(array_column($results, 'commentId'), array_column($results, 'user'));
        }
        return $results;
    }

    /**
     * @param $commentId
     * @param int $limit
     * @param int $page
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function getCommentLikesPaginated(
        $commentId,
        $limit = 25,
        $page = 1,
        $orderByColumn = 'createdOn',
        $orderByDirection = 'desc'
    ) {

        $first = ($page - 1) * $limit;

        $qb =
            $this->commentLikeRepository->createQueryBuilder('cl')
                ->join('cl.comment', 'c');
        $qb->where('cl.comment = :commentId')
            ->setParameter('commentId', $commentId)
            ->setMaxResults($limit)
            ->setFirstResult($first)
            ->orderBy('cl.' . $orderByColumn, $orderByDirection);

        return $qb->getQuery()
            ->getResult();
    }
}