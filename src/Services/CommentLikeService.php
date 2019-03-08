<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentLikes;
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
    public function __construct(EntityManager $entityManager, UserProviderInterface  $userProvider)
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
            $this->commentLikeRepository->createQueryBuilder('c')
                ->join('c.comment', 'co');
        $results =
            $qb->select('co.id, count(c.id) as nr')
                ->where(
                    $qb->expr()
                        ->in('c.comment', ':commentIds')
                )
                ->setParameter('commentIds', $commentIds)
                ->groupBy('c.comment')
                ->getQuery()
                ->getResult();

        return array_combine(array_column($results, 'id'), array_column($results, 'nr'));
    }

    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull)
    {
        return $this->commentLikeRepository->getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull);
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
            $commentLikes->setComment($comment);
        }
        $this->entityManager->persist($commentLikes);
        $this->entityManager->flush();

       $this->entityManager->getCache()->evictEntity(Comment::class, $commentId);

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

        $this->entityManager->getCache()->evictEntity(Comment::class, $commentId);

        event(new CommentUnLiked($commentId, $userId));

        return true;
    }
}