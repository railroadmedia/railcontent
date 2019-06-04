<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Entities\CommentLikes;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class CommentLikeRepository extends EntityRepository
{
    use RailcontentCustomQueryBuilder;

    /**
     * CommentLikeRepository constructor.
     *
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(RailcontentEntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(CommentLikes::class));
    }

    /**
     * @param $user
     * @param $comment
     * @return mixed
     */
    public function getUserCommentLikes($user, $comment)
    {
        $alias = 'ul';
        $qb = $this->createQueryBuilder($alias);

        $qb->where($alias . '.user = :user')
            ->andWhere($alias . '.comment = :comment')
            ->setParameter('comment', $comment)
            ->setParameter('user', $user)
            ->setMaxResults(100);

        return $qb->getQuery()
            ->getResult('Railcontent');
    }
}