<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Entities\ContentFollows;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class ContentFollowsRepository extends EntityRepository
{
    use RailcontentCustomQueryBuilder;

    public static $cache = [];

    /**
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(RailcontentEntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(ContentFollows::class));
    }

    /**
     * @return array|mixed
     */
    public function getFollowedContentIds()
    {
        if (!isset(self::$cache[auth()->id()])) {
            $alias = 'cf';
            $contents =   $this->createQueryBuilder($alias)
                ->join($alias.'.content', 'c')
                ->where('c.brand = :brand')
                ->andWhere($alias.'.user = :user')
                ->setParameter('brand', config('railcontent.brand'))
                ->setParameter('user', auth()->id())
               ->getResult();

            self::$cache[auth()->id()] = $contents->pluck('content_id')->toArray();
        }

        return self::$cache[auth()->id()];
    }
}