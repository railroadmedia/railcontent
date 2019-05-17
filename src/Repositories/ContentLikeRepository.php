<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Repositories\QueryBuilders\FromRequestRailcontentQueryBuilder;

class ContentLikeRepository extends EntityRepository
{
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = new FromRequestRailcontentQueryBuilder($this->_em);
        $queryBuilder->select($alias)
            ->from($this->_entityName, $alias, $indexBy);
        return $queryBuilder;
    }
}