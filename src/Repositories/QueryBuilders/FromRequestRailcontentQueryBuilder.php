<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use \Doctrine\ORM\QueryBuilder;
use Illuminate\Http\Request;

class FromRequestRailcontentQueryBuilder extends QueryBuilder
{
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
     * @param string $defaultOrderByColumn
     * @param string $defaultOrderByDirection
     * @return $this
     */
    public function orderByRequest(
        Request $request,
        $entityAlias,
        $defaultOrderByColumn = 'created_at',
        $defaultOrderByDirection = 'desc'
    ) {
        $orderByColumn = $request->get('order_by_column', $defaultOrderByColumn);
        $orderByDirection = $request->get('order_by_direction', $defaultOrderByDirection);

        if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
            $orderByColumn = camel_case($orderByColumn);
        }

        $orderByColumn = $entityAlias . '.' . $orderByColumn;

        $this->orderBy($orderByColumn, $orderByDirection);

        return $this;
    }
}