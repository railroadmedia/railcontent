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
}