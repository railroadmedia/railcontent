<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentLikes;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\CommentUnLiked;
use Railroad\Railcontent\Repositories\CommentLikeRepository;
use Railroad\Railcontent\Repositories\CommentRepository;

class CommentLikeService
{
    /**
     * @var CommentLikeRepository
     */
    private $commentLikeRepository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * CommentLikeService constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, UserProviderInterface $userProvider)
    {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;

        $this->commentLikeRepository = $this->entityManager->getRepository(CommentLikes::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);
    }

    /**
     * @param $commentIds
     * @return array|null
     */
    public function getByCommentIds($commentIds)
    {
        return $this->commentLikeRepository->findByComment($commentIds);
    }

    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
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
                ->getResult();

        return array_combine(array_column($results, 'id'), array_column($results, 'nr'));
    }

    /**
     * Returns [commentId => [user1, user2], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull)
    {
        $commentIds = array_unique(array_values($commentIds));
        $commentLikes = [];

        $qb =
            $this->commentLikeRepository->createQueryBuilder('c')
                ->where('c.comment IN (:commentIds)')
                ->setParameter('commentIds', $commentIds)
                ->orderBy('c.createdOn', 'desc');
        $results =
            $qb->getQuery()
                ->getResult();

        foreach ($results as $result) {
            if (count(
                    $commentLikes[$result->getComment()
                        ->getId()] ?? []
                ) < $amountOfUserIdsToPull) {

                $commentLikes[$result->getComment()
                    ->getId()][] = $result->getUser()->getId();
            }
        }

        return $commentLikes;
    }

    /**
     * @param $commentId
     * @param integer $userId
     * @return bool
     */
    public function create($commentId, $userId)
    {
        $user = $this->userProvider->getUserById($userId);
        $comment = $this->commentRepository->find($commentId);

        $commentLikes = $this->commentLikeRepository->findBy(
            [
                'comment' => $comment,
                'user' => $user,
            ]
        );

        if (empty($commentLikes)) {
            $commentLikes = new CommentLikes();
            $commentLikes->setUser($user);

        }
        $commentLikes->setComment($comment);
        $this->entityManager->persist($commentLikes);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntity(Comment::class, $commentId);

        $this->entityManager->getCache()
            ->evictEntity(
                Content::class,
                $comment->getContent()
                    ->getId()
            );

        event(new CommentLiked($commentId, $userId));

        return $commentLikes;
    }

    /**
     * @param $commentId
     * @param $userId
     * @return bool|int|null|array
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

        $this->entityManager->remove($commentLikes);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntity(Comment::class, $commentId);

        event(new CommentUnLiked($commentId, $userId));

        return true;
    }

    public function isLikedByUserId($commentAndReplyIds, $userId)
    {
        $qb = $this->commentLikeRepository->createQueryBuilder('cl')
        ->join('cl.comment','c');
        $qb ->select('cl.user as user, c.id as commentId')
            ->where('cl.user = :userId')
            ->andWhere('cl.comment IN (:commentIds)')
            ->setParameter('userId', $userId)
            ->setParameter('commentIds', $commentAndReplyIds);

        $results = $qb->getQuery()
            ->getResult();

        if(!empty($results)) {
            $results = array_combine(array_column($results, 'commentId'), array_column($results, 'user'));
        }
        return $results;
    }
}