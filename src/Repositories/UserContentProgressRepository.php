<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
                    ->andWhere('up.user = :userId')
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
            ->setParameter('user', $user);

        if ($state) {
            $qb->andWhere($alias . '.state = :state')
                ->setParameter('state', $state);
        }

        return $qb->getQuery()
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getOneOrNullResult();
    }

    /**
     * @param $contentId
     * @param null $startDate
     * @return int|mixed|string
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countContentProgress($contentId, $startDate = null)
    {
        $query =
            $this->createQueryBuilder('ucp')
                ->select('count(ucp.id)')
                ->where('ucp.content = :content')
                ->setParameter('content', $contentId);

        if ($startDate) {
            $query->andWhere('ucp.updatedOn >= :startDate')
                ->setParameter('startDate', $startDate);
        }
        return $query->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param $contentId
     * @param null $startDate
     * @return int|mixed|string
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countUserProgress($userId, $startDate = null,  $state = null)
    {
        $query =
            $this->createQueryBuilder('ucp')
                ->select('count(ucp.id)')
                ->leftJoin('ucp.content', 'c')
                ->where('ucp.user = :user')
                ->andWhere('c.brand = :brand')
        ->andWhere('c.type IN (:type)');
        if($state){
            $query->andWhere('ucp.state = :state')
                ->setParameter('state', $state);
        }
        $query->setParameter('user', $userId)
                ->setParameter('brand', config('railcontent.brand'))
        ->setParameter('type', config('railcontent.singularContentTypes',[]));

        if ($startDate) {
            $query->andWhere('ucp.updatedOn >= :startDate')
                ->setParameter('startDate', $startDate);
        }
        return $query->getQuery()
            ->getSingleScalarResult();
    }
}