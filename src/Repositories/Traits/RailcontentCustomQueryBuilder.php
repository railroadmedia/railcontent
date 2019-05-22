<?php

namespace Railroad\Railcontent\Repositories\Traits;

use Railroad\Railcontent\Repositories\QueryBuilders\FromRequestRailcontentQueryBuilder;

trait RailcontentCustomQueryBuilder
{
    /**
     * @param $alias
     * @param null $indexBy
     * @return FromRequestRailcontentQueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = new FromRequestRailcontentQueryBuilder($this->getEntityManager());

        $queryBuilder->select($alias)
            ->from($this->getEntityName(), $alias, $indexBy);

        return $queryBuilder;
    }
}