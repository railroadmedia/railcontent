<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;



use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class QueryBuilder extends CachedQuery
{
    /**
     * @param integer $page
     * @param integer $limit
     * @return $this
     */
    public function directPaginate($page, $limit)
    {
        if ($limit >= 1) {
            $this->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        return $this;
    }

    /**
     * @param null $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column = null, $direction = 'asc', $table = null)
    {
        if ($column) {
            // this properly formats orderBy table names
            // including the case with '' table name used for non-mapped generated columns such as counts
            $tableName = $table ?? config('railcontent.table_prefix'). 'content';
            $orderByTable = $tableName ? $tableName . '.' : '';
            parent::orderBy($orderByTable . $column, $direction);
        }

        return $this;
    }

    /**
     * @param array $columns
     * @return array
     */
    public function getToArray(array $columns = ['*'])
    {
        return parent::get($columns)->toArray();
    }
}