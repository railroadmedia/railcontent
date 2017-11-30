<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;


use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Services\ConfigService;

class FullTextSearchQueryBuilder extends QueryBuilder
{
    /** Select the search indexes columns
     * @return $this
     */
    public function selectColumns($term)
    {
        $this->addSelect(
            [
                ConfigService::$tableSearchIndexes . '.content_id as content_id',
                ConfigService::$tableSearchIndexes . '.high_value as high_value',
                ConfigService::$tableSearchIndexes . '.medium_value as medium_value',
                ConfigService::$tableSearchIndexes . '.low_value as low_value',
                ConfigService::$tableSearchIndexes . '.created_at as created_at',
                DB::raw(" MATCH (high_value) AGAINST ('+\"" . implode('" +"', explode(' ', $term)) . "\"' IN BOOLEAN MODE) * 10 * (UNIX_TIMESTAMP(created_at) / 1350517005) AS high_score"),
                DB::raw(" MATCH (medium_value) AGAINST (\"'$term'\") * 2 AS medium_score"),
                DB::raw(" MATCH (low_value) AGAINST (\"'$term'\") AS low_score")
            ]
        );

        return $this;
    }

    /** Full text search by term
     * @param string $term
     * @return $this
     */
    public function restrictByTerm($term)
    {
        if ($term) {
            $this->whereRaw(" (MATCH (high_value) AGAINST ('+\"" . implode(' +', explode(' ', $term)) . "\"' IN BOOLEAN
            MODE) OR
            MATCH (medium_value) AGAINST (\"'$term'\") OR
            MATCH (low_value) AGAINST (\"'$term'\"))");
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->where(ConfigService::$tableSearchIndexes . '.brand', ConfigService::$brand);

        return $this;
    }

    public function orderByScore()
    {
        $this->orderByRaw('(high_score + medium_score + low_score) DESC');

        return $this;
    }
}