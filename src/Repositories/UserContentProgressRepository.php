<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class UserContentProgressRepository extends EntityRepository
{
    use RailcontentCustomQueryBuilder;

    public static $cache = [];

    /**
     * UserContentProgressRepository constructor.
     *
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(RailcontentEntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(UserContentProgress::class));
    }

    /**
     * @param $userId
     * @param array $contentIds
     * @return array
     */
    public function getByUserIdAndWhereContentIdIn($userId, array $contentIds)
    {
        $key = $userId . '+' . implode('_', $contentIds);

        if (!key_exists($key, self::$cache)) {
            self::$cache[$key] =
                $this->createQueryBuilder('up')
                    ->where('up.content IN (:contentIds)')
                    ->andWhere('up.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->setParameter('contentIds', $contentIds)
                    ->getQuery()
                    ->getResult();

            return self::$cache[$key];
        }

        return self::$cache[$key];
    }

    public function getByUserContentState($user, $content, $state = '')
    {
        $alias = 'uc';
        $qb = $this->createQueryBuilder($alias);

        $qb->where($alias . '.user = :user')
            ->andWhere($alias . '.content = :content')
            ->setParameter('content', $content)
            ->setParameter('user', $user)
            ->setMaxResults(100);

        if ($state) {
            $qb->andWhere($alias . '.state = :state')
                ->setParameter('state', $state);
        }

        return $qb->getQuery()
            ->getOneOrNullResult('Railcontent');
    }
}