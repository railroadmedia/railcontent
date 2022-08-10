<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;


use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\ContentRepository;
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
                ConfigService::$tableSearchIndexes . '.content_status as content_status',
                DB::raw("( (MATCH (high_value) AGAINST ('+\"" . implode('" +"', explode(' ', $term)) . "\"' IN BOOLEAN MODE) * 18 * (UNIX_TIMESTAMP(content_published_on) / 1000000000)) + MATCH (medium_value) AGAINST (\"'$term'\") * 2 + MATCH (low_value) AGAINST (\"'$term'\")) as score"),
                DB::raw(" MATCH (high_value) AGAINST ('+\"" . implode('" +"', explode(' ', $term)) . "\"' IN BOOLEAN MODE) * 18 * (UNIX_TIMESTAMP(content_published_on) / 1000000000) AS high_score"),
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
        if (!empty($term)) {
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
        $this->whereIn(ConfigService::$tableSearchIndexes . '.brand', array_values(Arr::wrap(ConfigService::$availableBrands)));

        return $this;
    }

    public function order($column = null, $direction = 'asc')
    {
        if ($column) {
            $this->orderByRaw($column .' '. $direction);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByPermissions()
    {
        if (ContentRepository::$bypassPermissions === true) {
            return $this;
        }

        $this->leftJoin(ConfigService::$tableContentPermissions.' as id_content_permissions',
            function (JoinClause $join) {
                $join->on(
                    'id_content_permissions'.'.content_id',
                    ConfigService::$tableSearchIndexes.'.content_id'
                );
            })
            ->where(function (Builder $builder) {
                return $builder->where(function (Builder $builder) {
                    return $builder->whereNull(
                        'id_content_permissions'.'.permission_id'
                    );
                })
                    ->orWhereExists(function (Builder $builder) {
                        return $builder->select('id')
                            ->from(ConfigService::$tableUserPermissions)
                            ->where('user_id', auth()->id() ?? null)
                            ->where(function (Builder $builder) {
                                return $builder->whereRaw(
                                    'permission_id = id_content_permissions.permission_id'
                                );
                            })
                            ->where(function (Builder $builder) {
                                return $builder->where(
                                    'expiration_date',
                                    '>=',
                                    Carbon::now()
                                        ->toDateTimeString()
                                )
                                    ->orWhereNull('expiration_date');
                            })
                            ->where(function (Builder $builder) {
                                return $builder->where(
                                    'start_date',
                                    '<=',
                                    Carbon::now()
                                        ->toDateTimeString()
                                )
                                    ->orWhereNull('start_date');
                            });
                    });
            });

        return $this;
    }
}