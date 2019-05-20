<?php

namespace Railroad\Railcontent\Repositories\Traits;

use \Doctrine\ORM\QueryBuilder;
use Illuminate\Http\Request;
use Railroad\Railcontent\Repositories\QueryBuilders\FromRequestRailcontentQueryBuilder;

trait RailcontentCustomQueryBuilder
{
    /**
     * @param string $alias
     * @param null $indexBy
     * @return FromRequestEcommerceQueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = new FromRequestRailcontentQueryBuilder($this->getEntityManager());
        $queryBuilder->select($alias)
            ->from($this->getEntityName(), $alias, $indexBy);
        return $queryBuilder;
    }

    /**
     * @param Request $request
     * @param int $defaultPage
     * @param int $defaultLimit
     * @return $this
     */
    public function paginateByRequest(Request $request, $defaultPage = 1, $defaultLimit = 10)
    {
        $page = $request->get('page', $defaultPage);
        $limit = $request->get('limit', $defaultLimit);

        $first = ($page - 1) * $limit;

        $this->setMaxResults($limit)
            ->setFirstResult($first);

        return $this;
    }

    /**
     * @param Request $request
     * @param $entityAlias
     * @param string $defaultOrderByColumnAndDirection
     * @return $this
     */
    public function orderByRequest(
        Request $request,
        $entityAlias,
        $defaultOrderByColumnAndDirection = '-created_on'
    ) {

        $orderBy = $request->get('sort', $defaultOrderByColumnAndDirection);
        if (strpos($orderBy, '_') !== false || strpos($orderBy, '-') !== false) {
            $orderBy = camel_case($orderBy);
        }

        $orderByColumn = $entityAlias . '.' . $orderBy;
        $orderByDirection = substr($orderBy, 0, 1) !== '-' ? 'asc' : 'desc';

        $this->orderBy($orderByColumn, $orderByDirection);

        return $this;
    }

    /**
     * @param int $limit
     * @param int $skip
     * @return $this
     */
    public function paginate($limit = 10, $skip = 0)
    {
        $first = $skip * $limit;

        $this->setMaxResults($limit)
            ->setFirstResult($first);

        return $this;
    }

    /**
     * @param $entityAlias
     * @param $orderByColumn
     * @param $orderByDirection
     * @return $this
     */
    public function orderByColumn($entityAlias, $orderByColumn, $orderByDirection)
    {
        $orderByColumn = $entityAlias . '.' . $orderByColumn;

        $this->orderBy($orderByColumn, $orderByDirection);

        return $this;
    }
}