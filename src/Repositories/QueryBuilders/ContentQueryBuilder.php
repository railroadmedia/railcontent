<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

class ContentQueryBuilder extends QueryBuilder
{
    /**
     * @return $this
     */
    public function selectPrimaryColumns()
    {
        $this->addSelect(
            [
                ConfigService::$tableContent . '.id as id',
                ConfigService::$tableContent . '.slug as slug',
                ConfigService::$tableContent . '.type as type',
                ConfigService::$tableContent . '.sort as sort',
                ConfigService::$tableContent . '.status as status',
                ConfigService::$tableContent . '.language as language',
                ConfigService::$tableContent . '.brand as brand',
                ConfigService::$tableContent . '.total_xp as total_xp',
                ConfigService::$tableContent . '.published_on as published_on',
                ConfigService::$tableContent . '.created_on as created_on',
                ConfigService::$tableContent . '.archived_on as archived_on',
                ConfigService::$tableContent . '.popularity as popularity',
            ]
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function selectCountColumns($orderBy = null)
    {
        $this->addSelect([
                ConfigService::$tableContent . '.id as id',
            ]);

        if($orderBy && $orderBy == 'content_likes'){
            $this->addSelect([DB::raw('count('.ConfigService::$tableContentLikes.'.id) as '.$orderBy)]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function selectInheritenceColumns()
    {
        $this->addSelect(
            [
                ConfigService::$tableContentHierarchy . '.child_position as child_position',
                ConfigService::$tableContentHierarchy . '.child_id as child_id',
                ConfigService::$tableContentHierarchy . '.parent_id as parent_id',
            ]
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function selectFilterOptionColumns()
    {
        $this->addSelect(
            [
                ConfigService::$tableContent . '.type as content_type',
                ConfigService::$tableContentFields . '.key as key',
                ConfigService::$tableContentFields . '.value as value',
                ConfigService::$tableContentFields . '.type as type',
            ]
        );

        return $this;
    }

    /**
     * Sub query must be completely created before being passed in here.
     * Any changes to the $subQuery object after being passed in will not be reflected at retrieval time.
     *
     * @param Builder $subQuery
     * @return $this
     */
    public function addSubJoinToQuery(Builder $subQuery)
    {
        $this->join(
            $this->connection->raw('(' . $subQuery->toSql() . ') inner_content'),
            function (JoinClause $joinClause) {
                $joinClause->on(ConfigService::$tableContent . '.id', '=', 'inner_content.id');
            }
        )
            ->addBinding($subQuery->getBindings());

        return $this;
    }

    /**
     * @param array $slugHierarchy
     * @return $this
     */
    public function addSlugInheritance(array $slugHierarchy)
    {
        $previousTableName = ConfigService::$tableContent;
        $previousTableJoinColumn = '.id';

        foreach ($slugHierarchy as $i => $slug) {
            $tableName = 'inheritance_' . $i;

            $this->leftJoin(
                ConfigService::$tableContentHierarchy . ' as ' . $tableName,
                $tableName . '.child_id',
                '=',
                $previousTableName . $previousTableJoinColumn
            );

            $inheritedContentTableName = 'inherited_content_' . $i;

            $this->leftJoin(
                ConfigService::$tableContent . ' as ' . $inheritedContentTableName,
                $inheritedContentTableName . '.id',
                '=',
                $tableName . '.parent_id'
            );

            $this->addSelect([$tableName . '.child_position as child_position_' . $i]);
            $this->addSelect([$tableName . '.parent_id as parent_id_' . $i]);
            $this->addSelect([$inheritedContentTableName . '.slug as parent_slug_' . $i]);

            $previousTableName = $tableName;
            $previousTableJoinColumn = '.parent_id';
        }

        return $this;
    }

    /**
     * @param array $slugHierarchy
     * @return $this
     */
    public function restrictBySlugHierarchy(array $slugHierarchy)
    {
        if (empty($slugHierarchy)) {
            return $this;
        }

        $this->whereIn(
            ConfigService::$tableContent . '.id',
            function (Builder $builder) use ($slugHierarchy) {
                $builder->select([ConfigService::$tableContent . '.id'])
                    ->from(ConfigService::$tableContent);

                $previousTableName = ConfigService::$tableContent;
                $previousTableJoinColumn = '.id';

                foreach (array_reverse($slugHierarchy) as $i => $slug) {
                    $tableName = 'inheritance_' . $i;

                    $builder->leftJoin(
                        ConfigService::$tableContentHierarchy . ' as ' . $tableName,
                        $tableName . '.child_id',
                        '=',
                        $previousTableName . $previousTableJoinColumn
                    );

                    $inheritedContentTableName = 'inherited_content_' . $i;

                    $builder->leftJoin(
                        ConfigService::$tableContent . ' as ' . $inheritedContentTableName,
                        $inheritedContentTableName . '.id',
                        '=',
                        $tableName . '.parent_id'
                    );

                    $builder->where($inheritedContentTableName . '.slug', $slug);

                    $previousTableName = $tableName;
                    $previousTableJoinColumn = '.parent_id';
                }
            }
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $this->whereIn('status', ContentRepository::$availableContentStatues);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPublishedOnDate()
    {
        if (!ContentRepository::$pullFutureContent) {
            $this->where(
                'published_on',
                '<=',
                Carbon::now()
                    ->toDateTimeString()
            );
        } else {
            // this strange hack is required to get the DB indexing to be used, todo: fix properly
            $this->where(
                function ($builder) {
                    $builder->where(
                        'published_on',
                        '<=',
                        Carbon::now()
                            ->addMonths(18)
                            ->toDateTimeString()
                    )
                        ->orWhereNull('published_on');
                }
            );
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->whereIn(
            ConfigService::$tableContent . '.brand',
            array_values(array_wrap(ConfigService::$availableBrands))
        );

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $this->whereIn(ConfigService::$tableContent . '.type', $typesToInclude);
        }

        return $this;
    }

    /**
     * @param array $parentIds
     * @return $this
     */
    public function restrictByParentIds(array $parentIds)
    {
        if (empty($parentIds)) {
            return $this;
        }

        $this->whereIn(
            ConfigService::$tableContent . '.id',
            function (Builder $builder) use ($parentIds) {
                $builder->select([ConfigService::$tableContentHierarchy . '.child_id'])
                    ->from(ConfigService::$tableContentHierarchy)
                    ->whereIn('parent_id', $parentIds);
            }
        );

        return $this;
    }

    /**
     * @param array $requiredUserStates
     * @return $this
     */
    public function restrictByUserStates(array $requiredUserStates)
    {
        if (empty($requiredUserStates)) {
            return $this;
        }

        foreach ($requiredUserStates as $index => $requiredUserState) {
            $tableName = 'ucp_' . $index;

            $this->join(ConfigService::$tableUserContentProgress . ' as ' . $tableName,
                function (JoinClause $joinClause) use ($requiredUserState, $tableName) {
                    $joinClause->on(
                        $tableName . '.content_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )
                        ->on(
                            $tableName . '.user_id',
                            '=',
                            $joinClause->raw(
                                DB::connection()
                                    ->getPdo()
                                    ->quote($requiredUserState['user_id'])
                            )
                        )
                        ->on(
                            $tableName . '.state',
                            '=',
                            $joinClause->raw(
                                DB::connection()
                                    ->getPdo()
                                    ->quote($requiredUserState['state'])
                            )
                        );
                }
            );
        }

        return $this;
    }

    /**
     * @param array $includedUserStates
     * @return $this
     */
    public function includeByUserStates(array $includedUserStates)
    {
        if (empty($includedUserStates)) {
            return $this;
        }

        $this->join(ConfigService::$tableUserContentProgress,
            function (JoinClause $joinClause) use ($includedUserStates) {
                $joinClause->on(
                    ConfigService::$tableUserContentProgress . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                );

                $joinClause->on(function (JoinClause $joinClause) use ($includedUserStates) {
                    foreach ($includedUserStates as $index => $includedUserState) {
                        $joinClause->orOn(function (JoinClause $joinClause) use ($includedUserState) {
                            $joinClause->on(
                                ConfigService::$tableUserContentProgress . '.user_id',
                                '=',
                                $joinClause->raw(
                                    DB::connection()
                                        ->getPdo()
                                        ->quote($includedUserState['user_id'])
                                )
                            )
                                ->on(
                                    ConfigService::$tableUserContentProgress . '.state',
                                    '=',
                                    $joinClause->raw(
                                        DB::connection()
                                            ->getPdo()
                                            ->quote($includedUserState['state'])
                                    )
                                );
                        });
                    }
                }

                );
            });

        return $this;
    }

    /**
     * @param array $requiredFields
     * @return $this
     */
    public function restrictByFields(array $requiredFields)
    {
        if (empty($requiredFields)) {
            return $this;
        }

        foreach ($requiredFields as $index => $requiredFieldData) {
            $tableName = 'cf_' . $index;

            if ($requiredFieldData['field'] != '') {
                $this->join(ConfigService::$tableContentFields . ' as ' . $tableName,
                    function (JoinClause $join) use ($tableName, $requiredFieldData, $index) {
                        $join->on(
                            $tableName . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->on(
                                $tableName . '.key',
                                '=',
                                $join->raw(
                                    DB::connection()
                                        ->getPdo()
                                        ->quote($requiredFieldData['name'])
                                )
                            );
                    })
                    ->join(ConfigService::$tableContentFields . ' as ' . $tableName . '_f'.$index,
                        function (JoinClause $join) use ($tableName, $requiredFieldData, $index) {
                            $join->on(
                                $tableName . '_f'.$index . '.content_id',
                                '=',
                                $tableName . '.value'
                            )
                                ->on(
                                    $tableName . '_f'.$index . '.key',
                                    '=',
                                    $join->raw(
                                        DB::connection()
                                            ->getPdo()
                                            ->quote($requiredFieldData['value'])
                                    )
                                )
                                ->on(
                                    $tableName . '_f'.$index . '.value',
                                    '=',
                                    $join->raw(
                                        DB::connection()
                                            ->getPdo()
                                            ->quote($requiredFieldData['field'])
                                    )
                                );
                        });
            } else {
                $this->join(
                    ConfigService::$tableContentFields . ' as ' . $tableName,
                    function (JoinClause $joinClause) use ($requiredFieldData, $tableName) {
                        $joinClause->on(
                            $tableName . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->on(
                                $tableName . '.key',
                                '=',
                                $joinClause->raw(
                                    DB::connection()
                                        ->getPdo()
                                        ->quote($requiredFieldData['name'])
                                )
                            )
                            ->on(
                                $tableName . '.value',
                                $requiredFieldData['operator'],
                                is_numeric($requiredFieldData['value']) ?
                                    $joinClause->raw($requiredFieldData['value']) : $joinClause->raw(
                                    DB::connection()
                                        ->getPdo()
                                        ->quote($requiredFieldData['value'])
                                )
                            );
                    }
                );
            }
        }

        return $this;
    }

    /**
     * @param array $includedFields
     * @return $this
     */
    public function includeByFields(array $includedFields)
    {
        if (empty($includedFields)) {
            return $this;
        }

        $tableName = '_icf';

        $this->join(ConfigService::$tableContentFields . ' as ' . $tableName,
            function (JoinClause $joinClause) use ($includedFields, $tableName) {
                $joinClause->on(
                    $tableName . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                );

                $joinClause->on(function (JoinClause $joinClause) use ($tableName, $includedFields) {
                    foreach ($includedFields as $index => $includedFieldData) {
                        $joinClause->orOn(function (JoinClause $joinClause) use ($tableName, $includedFieldData) {
                            $joinClause->on(
                                $tableName . '.key',
                                '=',
                                $joinClause->raw(
                                    DB::connection()
                                        ->getPdo()
                                        ->quote($includedFieldData['name'])
                                )
                            )
                                ->on(
                                    $tableName . '.value',
                                    $includedFieldData['operator'],
                                    is_numeric($includedFieldData['value']) ?
                                        $joinClause->raw($includedFieldData['value']) : $joinClause->raw(
                                        DB::connection()
                                            ->getPdo()
                                            ->quote($includedFieldData['value'])
                                    )
                                );
                        });
                    }
                }

                );
            });

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

        $this->leftJoin(ConfigService::$tableContentPermissions . ' as id_content_permissions',
            function (JoinClause $join) {
                $join->on(
                    'id_content_permissions' . '.content_id',
                    ConfigService::$tableContent . '.id'
                );
            })
            ->leftJoin(ConfigService::$tableContentPermissions . ' as type_content_permissions',
                function (JoinClause $join) {
                    $join->on(
                        'type_content_permissions' . '.content_type',
                        ConfigService::$tableContent . '.type'
                    )
                        ->whereIn('type_content_permissions' . '.brand', ConfigService::$availableBrands);
                })
            ->where(function (Builder $builder) {
                return $builder->where(function (Builder $builder) {
                    return $builder->whereNull(
                        'id_content_permissions' . '.permission_id'
                    )
                        ->whereNull(
                            'type_content_permissions' . '.permission_id'
                        );
                })
                    ->orWhereExists(function (Builder $builder) {
                        return $builder->select('id')
                            ->from(ConfigService::$tableUserPermissions)
                            ->where('user_id', auth()->id() ?? null)
                            ->where(function (Builder $builder) {
                                return $builder->whereRaw(
                                    'permission_id = id_content_permissions.permission_id'
                                )
                                    ->orWhereRaw(
                                        'permission_id = type_content_permissions.permission_id'
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

    /**
     * @return $this
     */
    public function restrictByUserAccess()
    {
        $this->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictBrand()
            ->restrictByPermissions();

        return $this;
    }

    /**
     * @param $orderBy
     * @param $orderDirection
     * @return $this
     */
    public function order($orderBy, $orderDirection)
    {
        $orderByExploded = explode(' ', $orderBy);

        $orderByColumns = [ConfigService::$tableContent . '.' . 'created_on'];

        foreach ($orderByExploded as $orderByColumn) {
            if ($orderByColumn == 'content_likes') {
                array_unshift(
                    $orderByColumns,
                    $orderByColumn . ' ' . $orderDirection
                );
            }elseif ($orderByColumn == 'title') {
                array_unshift(
                    $orderByColumns,
                    ConfigService::$tableContentFields . '.value ' . $orderDirection
                );
            }
            elseif ($orderByColumn != 'progress') {
                array_unshift(
                    $orderByColumns,
                    ConfigService::$tableContent . '.' . $orderByColumn . ' ' . $orderDirection
                );
            } else {
                array_unshift(
                    $orderByColumns,
                    ConfigService::$tableUserContentProgress . '.' . 'updated_on' . ' ' . $orderDirection
                );
            }
        }


            if ($orderBy == 'progress') {
                $this->leftJoin(ConfigService::$tableUserContentProgress, function (JoinClause $joinClause) {
                    $joinClause->on(
                        ConfigService::$tableUserContentProgress . '.content_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )
                        ->on(
                            ConfigService::$tableUserContentProgress . '.user_id',
                            '=',
                            $joinClause->raw(
                                DB::connection()
                                    ->getPdo()
                                    ->quote(auth()->id())
                            )
                        );
                });
                $this->orderByRaw(
                    DB::raw(
                        implode(', ', $orderByColumns) . ' ' . $orderDirection
                    )
                );
            } elseif ($orderBy == 'title') {
                    $this->join(ConfigService::$tableContentFields, function (JoinClause $joinClause) {
                        $joinClause->on(
                            ConfigService::$tableContentFields . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->where(
                                ConfigService::$tableContentFields . '.key',
                                '=',
                               "title"
                            );
                    });

            $this->orderByRaw(
                DB::raw(
                    implode(', ', $orderByColumns) . ' ' . $orderDirection
                )
            );
        } elseif($orderBy == 'content_likes'){
                $this->leftJoin(ConfigService::$tableContentLikes, function (JoinClause $joinClause) {
                    $joinClause->on(
                        ConfigService::$tableContentLikes . '.content_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )
                        ;
                });

                $this->orderByRaw(
                    DB::raw(
                        implode(', ', $orderByColumns) . ' ' . $orderDirection
                    )
                );
            }else {
                $this->orderByRaw(
                    DB::raw(
                        implode(', ', $orderByColumns) . ' ' . $orderDirection
                    )
                );
            }
        return $this;
    }

    /**
     * @param $orderBy
     * @return \Doctrine\ORM\QueryBuilder|ContentQueryBuilder
     */
    public function group($orderBy)
    {
        $orderByExploded = explode(' ', $orderBy);

        $groupByColumns = [ConfigService::$tableContent . '.' . 'created_on'];

        foreach ($orderByExploded as $orderByColumn) {
            if (($orderByColumn != 'progress') && ($orderByColumn != 'content_likes') && ($orderByColumn != 'title')) {
                array_unshift($groupByColumns, ConfigService::$tableContent . '.' . $orderByColumn);
            }elseif ($orderByColumn == 'content_likes') {
                array_unshift($groupByColumns,  ConfigService::$tableContentLikes . '.content_id' );
            }elseif ($orderByColumn == 'title') {
                array_unshift($groupByColumns,  ConfigService::$tableContentFields . '.value' );
    }
        }

        return $this->groupBy(
            array_merge(
                [
                    ConfigService::$tableContent . '.id',
                    ConfigService::$tableContent . '.' . 'created_on',
                ],
                $groupByColumns
            )
        );
    }

    /**
     * @return $this
     */
    public function restrictFollowedContent()
    {
        $this->join(ConfigService::$tableContentFollows, function (JoinClause $joinClause) {
            $joinClause->on(
                ConfigService::$tableContentFollows . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            );
        })
            ->where(ConfigService::$tableContentFollows . '.user_id', auth()->id() ?? null);

        return $this;
    }
}
