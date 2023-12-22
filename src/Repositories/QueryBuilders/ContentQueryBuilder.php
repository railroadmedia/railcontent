<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class ContentQueryBuilder extends QueryBuilder
{
    /**
     * @return $this
     */
    public function selectPrimaryColumns()
    {
        $this->addSelect([
                             ConfigService::$tableContent.'.*',
                         ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function selectCountColumns($orderBy = null)
    {
        $this->addSelect([
                             $this->raw('DISTINCT('. ConfigService::$tableContent.'.id) as id'),
                             ConfigService::$tableContent . '.published_on',
                             ConfigService::$tableContent . '.created_on',
                             ConfigService::$tableContent . '.slug',
                             ConfigService::$tableContent . '.popularity',
                             ConfigService::$tableContent . '.title',
                             ConfigService::$tableContent . '.sort',
//                             ConfigService::$tableContent . '.instrumentless as instrumentless',
                         ]);

        if ($orderBy && $orderBy == 'content_likes') {
            $this->addSelect([DB::raw('count('.ConfigService::$tableContentLikes.'.id) as '.$orderBy)]);
        }

        if ($orderBy && $orderBy == 'progress') {
            $this->addSelect([DB::raw(ConfigService::$tableUserContentProgress.'.updated_on ')]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function selectInheritenceColumns()
    {
        $this->addSelect([
                             ConfigService::$tableContentHierarchy.'.child_position as child_position',
                             ConfigService::$tableContentHierarchy.'.child_id as child_id',
                             ConfigService::$tableContentHierarchy.'.parent_id as parent_id',
                         ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function selectFilterOptionColumns()
    {
        $this->addSelect([
                             ConfigService::$tableContent.'.type as content_type',
                             ConfigService::$tableContent.'.*',
                         ]);

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
            $this->connection->raw('('.$subQuery->toSql().') inner_content'),
            function (JoinClause $joinClause) {
                $joinClause->on(ConfigService::$tableContent.'.id', '=', 'inner_content.id');
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
            $tableName = 'inheritance_'.$i;

            $this->leftJoin(
                ConfigService::$tableContentHierarchy.' as '.$tableName,
                $tableName.'.child_id',
                '=',
                $previousTableName.$previousTableJoinColumn
            );

            $inheritedContentTableName = 'inherited_content_'.$i;

            $this->leftJoin(
                ConfigService::$tableContent.' as '.$inheritedContentTableName,
                $inheritedContentTableName.'.id',
                '=',
                $tableName.'.parent_id'
            );

            $this->addSelect([$tableName.'.child_position as child_position_'.$i]);
            $this->addSelect([$tableName.'.parent_id as parent_id_'.$i]);
            $this->addSelect([$inheritedContentTableName.'.slug as parent_slug_'.$i]);

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

        $this->whereIn(ConfigService::$tableContent.'.id', function (Builder $builder) use ($slugHierarchy) {
            $builder->select([ConfigService::$tableContent.'.id'])
                ->from(ConfigService::$tableContent);

            $previousTableName = ConfigService::$tableContent;
            $previousTableJoinColumn = '.id';

            foreach (array_reverse($slugHierarchy) as $i => $slug) {
                $tableName = 'inheritance_'.$i;

                $builder->leftJoin(
                    ConfigService::$tableContentHierarchy.' as '.$tableName,
                    $tableName.'.child_id',
                    '=',
                    $previousTableName.$previousTableJoinColumn
                );

                $inheritedContentTableName = 'inherited_content_'.$i;

                $builder->leftJoin(
                    ConfigService::$tableContent.' as '.$inheritedContentTableName,
                    $inheritedContentTableName.'.id',
                    '=',
                    $tableName.'.parent_id'
                );

                $builder->where($inheritedContentTableName.'.slug', $slug);

                $previousTableName = $tableName;
                $previousTableJoinColumn = '.parent_id';
            }
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $this->whereIn(ConfigService::$tableContent.'.status', ContentRepository::$availableContentStatues);
        }

        if (ContentRepository::$getFutureScheduledContentOnly) {
//            We make sure not to show the 'scheduled' content that is already in the past
//              SQL condition:  "where ((status in (published)) or (status = 'scheduled' and published_on > $now))"
            $this->where(function (Builder $builder) {
                return $builder->whereIn(ConfigService::$tableContent.'.status', array_diff(ContentRepository::$availableContentStatues, [ContentService::STATUS_SCHEDULED]))
                    ->orWhere(function (Builder $builder) {
                        return $builder->where(ConfigService::$tableContent.'.status', '=','scheduled')
                            ->where(ConfigService::$tableContent.'.published_on', '>', Carbon::now()->toDateTimeString());
                    });
            });
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
                ConfigService::$tableContent.'.published_on',
                '<=',
                Carbon::now()
                    ->toDateTimeString()
            );
        } else {
            // this strange hack is required to get the DB indexing to be used, todo: fix properly
            $this->where(function ($builder) {
                $builder->where(
                    ConfigService::$tableContent.'.published_on',
                    '<=',
                    Carbon::now()
                        ->addMonths(18)
                        ->toDateTimeString()
                )
                    ->orWhereNull(ConfigService::$tableContent.'.published_on');
            });
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->whereIn(
            ConfigService::$tableContent.'.brand',
            array_values(Arr::wrap(ConfigService::$availableBrands))
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
            $this->whereIn(ConfigService::$tableContent.'.type', $typesToInclude);
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

        $this->whereIn(ConfigService::$tableContent.'.id', function (Builder $builder) use ($parentIds) {
            $builder->select([ConfigService::$tableContentHierarchy.'.child_id'])
                ->from(ConfigService::$tableContentHierarchy)
                ->whereIn('parent_id', $parentIds);
        });

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
            $tableName = 'ucp_'.$index;

            $this->join(
                ConfigService::$tableUserContentProgress.' as '.$tableName,
                function (JoinClause $joinClause) use ($requiredUserState, $tableName) {
                    $joinClause->on(
                        $tableName.'.content_id',
                        '=',
                        ConfigService::$tableContent.'.id'
                    )
                        ->on(
                            $tableName.'.user_id',
                            '=',
                            $joinClause->raw(
                                DB::connection()
                                    ->getPdo()
                                    ->quote($requiredUserState['user_id'])
                            )
                        )
                        ->on(
                            $tableName.'.state',
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
                    ConfigService::$tableUserContentProgress.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                );

                $joinClause->on(function (JoinClause $joinClause) use ($includedUserStates) {
                    foreach ($includedUserStates as $index => $includedUserState) {
                        $joinClause->orOn(function (JoinClause $joinClause) use ($includedUserState) {
                            $joinClause->on(
                                ConfigService::$tableUserContentProgress.'.user_id',
                                '=',
                                $joinClause->raw(
                                    DB::connection()
                                        ->getPdo()
                                        ->quote($includedUserState['user_id'])
                                )
                            )
                                ->on(
                                    ConfigService::$tableUserContentProgress.'.state',
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

        // group the required fields by name first since we only need 1 join per associated table
        $requiredFieldsGroupedByTable = [];

        foreach ($requiredFields as $requiredFieldIndex => $requiredField) {
            if (!empty($requiredField['associated_table']['table'])) {
                $requiredFieldsGroupedByTable[$requiredField['associated_table']['table']][] = $requiredField;
            } else {
                $requiredFieldsGroupedByTable[$requiredField['name']][] = $requiredField;
            }
        }

        // set the joins first, then we'll add the where's after
        foreach ($requiredFieldsGroupedByTable as $name => $requiredFieldDataGrouped) {

                if ($requiredFieldDataGrouped[0]['is_content_column']) {
                    foreach($requiredFieldDataGrouped as $requiredFieldGroup) {
                        $this->where(
                            'railcontent_content.' . $requiredFieldGroup['name'],
                            $requiredFieldGroup['operator'],
                            is_numeric($requiredFieldGroup['value']) ?
                                DB::raw($requiredFieldGroup['value']) : DB::raw(
                                DB::connection()
                                    ->getPdo()
                                    ->quote($requiredFieldGroup['value'])
                            )
                        );
                    }
                } elseif (!empty($requiredFieldDataGrouped[0]['associated_table'])) {
                    $field =
                        $requiredFieldDataGrouped[0]['field'] ? $requiredFieldDataGrouped[0]['field'] : 'content_id';
                    $this->leftJoin(
                        $requiredFieldDataGrouped[0]['associated_table']['table'] .
                        ' as ' .
                        $requiredFieldDataGrouped[0]['associated_table']['alias'],
                        $requiredFieldDataGrouped[0]['associated_table']['alias'] . '.' . $field,
                        '=',
                        ConfigService::$tableContent . '.id'
                    );

                    $this->where(function (Builder $builder) use (
                        $requiredFieldDataGrouped
                    ) {
                        foreach ($requiredFieldDataGrouped as $requiredFieldGroup) {
                            $this->where(
                                $requiredFieldGroup['associated_table']['alias'] .
                                '.' .
                                $requiredFieldGroup['associated_table']['column'],
                                $requiredFieldGroup['operator'],
                                is_numeric($requiredFieldGroup['value']) ? DB::raw($requiredFieldGroup['value']) :
                                    DB::raw(
                                        DB::connection()
                                            ->getPdo()
                                            ->quote($requiredFieldGroup['value'])
                                    )
                            );
                        }
                    });
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

        // group the included fields by name first since we only need 1 join per associated table
        $includedFieldsGroupedByTable = [];

        foreach ($includedFields as $includedFieldIndex => $includedField) {
            if (!empty($includedField['associated_table']['table'])) {
                $includedFieldsGroupedByTable[$includedField['associated_table']['table']][] = $includedField;
            } else {
                $includedFieldsGroupedByTable[$includedField['name']][] = $includedField;
            }
        }

        // set the joins first, then we'll add the where's after
        foreach ($includedFieldsGroupedByTable as $name => $includedFieldDataGrouped) {
            if ($includedFieldDataGrouped[0]['is_content_column']) {
                $whereInArray = [];

                foreach ($includedFieldDataGrouped as $includedFieldData) {
                    $whereInArray[] = $includedFieldData['value'];
                }

                if(count($whereInArray) > 1) {
                    $this->whereIn(
                        'railcontent_content.' . $includedFieldDataGrouped[0]['name'],
                        $whereInArray
                    );
                }else {
                    $this->where(
                        'railcontent_content.'.$includedFieldDataGrouped[0]['name'],
                        $includedFieldDataGrouped[0]['operator'],
                        is_numeric($includedFieldDataGrouped[0]['value']) ?
                            DB::raw($includedFieldDataGrouped[0]['value']) : DB::raw(
                            DB::connection()
                                ->getPdo()
                                ->quote($includedFieldDataGrouped[0]['value'])
                        )
                    );
                }
            } elseif (!empty($includedFieldDataGrouped[0]['associated_table'])) {
                $this->leftJoin(
                    $includedFieldDataGrouped[0]['associated_table']['table'].
                    ' as '.
                    $includedFieldDataGrouped[0]['associated_table']['alias'],
                    $includedFieldDataGrouped[0]['associated_table']['alias'] . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                );

                $whereInArray = [];

                foreach ($includedFieldDataGrouped as $includedFieldData) {
                    $whereInArray[] = $includedFieldData['value'];
                }

                $this->whereIn(
                    $includedFieldDataGrouped[0]['associated_table']['alias'] . '.' .
                    $includedFieldDataGrouped[0]['associated_table']['column'],
                    $whereInArray
                );
            }
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

        // A member for any brand should get access to all brands membership content.
        // If the contents' permission id is any member one and the users permission id is any member one, show all with
        // the membership content.
        //
        // 1 - Drumeo Edge
        // 77 - Pianote Membership
        // 73 - Singeo Membership
        // 52 - Guitareo Membership

        $membershipPermissionIds = [1, 52, 73, 77,];

        $this->leftJoin(ConfigService::$tableContentPermissions.' as id_content_permissions',
            function (JoinClause $join) {
                $join->on(
                    'id_content_permissions'.'.content_id',
                    ConfigService::$tableContent.'.id'
                );
            })
            ->where(function (Builder $builder) use ($membershipPermissionIds) {
                return $builder->where(function (Builder $builder) {
                    return $builder->whereNull(
                        'id_content_permissions'.'.permission_id'
                    );
                })
                    ->orWhereExists(function (Builder $builder)  {
                        return $builder->select('id')
                            ->from(ConfigService::$tableContentFields)
                            ->where(ConfigService::$tableContentFields.'.content_id', '=',DB::raw(ConfigService::$tableContent.'.id'))
                            ->where(ConfigService::$tableContentFields.'.key', '=','enrollment_end_time')
                            ->where(ConfigService::$tableContentFields.'.value', '>=', Carbon::now()
                                ->toDateTimeString());
                    })
                    ->orWhereExists(function (Builder $builder) use ($membershipPermissionIds) {
                        return $builder->select('id')
                            ->from(ConfigService::$tableUserPermissions)
                            ->where('user_id', auth()->id() ?? null)
                            ->where(function (Builder $builder) use ($membershipPermissionIds) {
                                return $builder
                                    ->whereRaw(
                                        'permission_id = id_content_permissions.permission_id'
                                    )
                                    ->orWhere(function (Builder $builder) use ($membershipPermissionIds) {
                                        return $builder
                                            ->whereIn('permission_id', $membershipPermissionIds)
                                            ->whereIn(
                                                'id_content_permissions.permission_id',
                                                $membershipPermissionIds
                                            );
                                    });
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
            ->restrictByPermissions()
            ->restrictPlaylistIds();

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

        $orderByColumns = [ConfigService::$tableContent.'.'.'created_on'];

        foreach ($orderByExploded as $orderByColumn) {
            if ($orderByColumn == 'content_likes') {
                array_unshift(
                    $orderByColumns,
                    $orderByColumn.' '.$orderDirection
                );
            } elseif ($orderByColumn != 'progress') {
                $orderByColumns = [ConfigService::$tableContent.'.'.$orderByColumn];
            } else {
                array_unshift(
                    $orderByColumns,
                    ConfigService::$tableUserContentProgress.'.'.'updated_on'.' '.$orderDirection
                );
            }
        }

        if ($orderBy == 'progress') {
            $this->leftJoin(ConfigService::$tableUserContentProgress, function (JoinClause $joinClause) {
                $joinClause->on(
                    ConfigService::$tableUserContentProgress.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                    ->on(
                        ConfigService::$tableUserContentProgress.'.user_id',
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
                    implode(', ', $orderByColumns).' '.$orderDirection
                )
            );
        } elseif ($orderBy == 'content_likes') {
            $this->leftJoin(ConfigService::$tableContentLikes, function (JoinClause $joinClause) {
                $joinClause->on(
                    ConfigService::$tableContentLikes.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                );
            });

            $this->orderByRaw(
                DB::raw(
                    implode(', ', $orderByColumns).' '.$orderDirection
                )
            );
            $this->groupBy(ConfigService::$tableContent.'.id');
        } else {
            $this->orderByRaw(
                DB::raw(
                    implode(', ', $orderByColumns).' '.$orderDirection.', '.ConfigService::$tableContent.'.id'.' '.$orderDirection
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

        $groupByColumns = [ConfigService::$tableContent.'.'.'created_on'];

        foreach ($orderByExploded as $orderByColumn) {
            if (($orderByColumn != 'progress') && ($orderByColumn != 'content_likes') && ($orderByColumn != 'title')) {
                array_unshift($groupByColumns, ConfigService::$tableContent.'.'.$orderByColumn);
            } elseif ($orderByColumn == 'content_likes') {
                array_unshift($groupByColumns, ConfigService::$tableContentLikes.'.content_id');
            } elseif ($orderByColumn == 'title') {
                array_unshift($groupByColumns, 'field.value');
            } elseif ($orderByColumn == 'progress') {
                array_unshift($groupByColumns, ConfigService::$tableUserContentProgress.'.updated_on');
            }
        }

        return $this->groupBy(
            array_merge(
                [
                    ConfigService::$tableContent.'.id',
                    ConfigService::$tableContent.'.'.'created_on',
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
                ConfigService::$tableContentFollows.'.content_id',
                '=',
                ConfigService::$tableContent.'.id'
            );
        })
            ->where(ConfigService::$tableContentFollows.'.user_id', auth()->id() ?? null);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPlaylistIds()
    {
        if (ContentRepository::$includedInPlaylistsIds === false) {
            return $this;
        }

        $this->join(ConfigService::$tablePlaylistContents, function (JoinClause $joinClause) {
            $joinClause->on(
                ConfigService::$tablePlaylistContents.'.content_id',
                '=',
                ConfigService::$tableContent.'.id'
            );
        })
            ->whereIn(
                ConfigService::$tablePlaylistContents.'.user_playlist_id',
                ContentRepository::$includedInPlaylistsIds
            );

        return $this;
    }

    public function groupByField($groupBy)
    {
        $isTableContent = $groupBy['is_content_column'] ?? false;

        if ($isTableContent) {
            $field = $groupBy['field'];
            $this->addSelect([
                                 $this->raw(ConfigService::$tableContent.'.'.$field.' as '.$field),
                                 $this->raw(ConfigService::$tableContent.'.'.$field.' as grouped_by_field'),

                                 DB::raw(
                                     "( 
           JSON_ARRAYAGG(
            id
        ) ) as lessons_grouped_by_field"
                                 ),
                             ])
                ->whereNotNull(ConfigService::$tableContent.'.'.$field)
                ->groupBy(ConfigService::$tableContent.'.'.$field);

            return $this;
        }

        if(empty($groupBy['associated_table']))
        {
            return $this;
        }

        $table = $groupBy['associated_table']['table'];
        $field = $groupBy['associated_table']['column'];
        $alias = $groupBy['associated_table']['alias'];

        $this->addSelect([
                             $this->raw($alias.'.'.$field.' as grouped_by_field'),
                             $this->raw($alias.'.'.$field.' as id'),
                             DB::raw(
                                 "( 
           JSON_ARRAYAGG(
            ".$alias.".content_id      
        ) ) as lessons_grouped_by_field"
                             ),
                         ])
            ->join(
                $table.' as '.$alias,
                $alias.'.'.'content_id',
                '=',
                ConfigService::$tableContent.'.id'
            )
            ->whereNotNull($alias.'.'.$field)
            ->groupBy($alias.'.'.$field);

        return $this;
    }
}
