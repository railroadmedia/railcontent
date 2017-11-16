<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;

class ContentQueryBuilder extends QueryBuilder
{
    /**
     * @return $this
     */
    public function selectPrimaryColumns()
    {
        $this->select(
            [
                ConfigService::$tableContent . '.id as id',
                ConfigService::$tableContent . '.slug as slug',
                ConfigService::$tableContent . '.type as type',
                ConfigService::$tableContent . '.status as status',
                ConfigService::$tableContent . '.language as language',
                ConfigService::$tableContent . '.brand as brand',
                ConfigService::$tableContent . '.published_on as published_on',
                ConfigService::$tableContent . '.created_on as created_on',
                ConfigService::$tableContent . '.archived_on as archived_on',
            ]
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function selectCountColumns()
    {
        $this->select(
            [
                ConfigService::$tableContent . '.id as id',
            ]
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function selectFilterOptionColumns()
    {
        $this->select(
            [
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
        $this
            ->join(
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
                $builder
                    ->select([ConfigService::$tableContent . '.id'])
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
            $this->where('published_on', '<', Carbon::now()->toDateTimeString());
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->where('brand', ConfigService::$brand);

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
                $builder
                    ->select([ConfigService::$tableContentHierarchy . '.child_id'])
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

            $this->join(
                ConfigService::$tableUserContentProgress . ' as ' . $tableName,
                function (JoinClause $joinClause) use ($requiredUserState, $tableName) {
                    $joinClause->on(
                        $tableName . '.content_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )->on(
                        $tableName .
                        '.user_id',
                        '=',
                        $joinClause->raw("'" . $requiredUserState['user_id'] . "'")
                    )->on(
                        $tableName .
                        '.state',
                        '=',
                        $joinClause->raw("'" . $requiredUserState['state'] . "'")
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

        $this->join(
            ConfigService::$tableUserContentProgress,
            function (JoinClause $joinClause) use ($includedUserStates) {
                $joinClause->on(
                    ConfigService::$tableUserContentProgress . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                );

                $joinClause->on(
                    function (JoinClause $joinClause) use ($includedUserStates) {
                        foreach ($includedUserStates as $index => $includedUserState) {
                            $joinClause->orOn(
                                function (JoinClause $joinClause) use ($includedUserState) {
                                    $joinClause->on(
                                        ConfigService::$tableUserContentProgress .
                                        '.user_id',
                                        '=',
                                        $joinClause->raw("'" . $includedUserState['user_id'] . "'")
                                    )->on(
                                        ConfigService::$tableUserContentProgress .
                                        '.state',
                                        '=',
                                        $joinClause->raw("'" . $includedUserState['state'] . "'")
                                    );

                                }
                            );
                        }
                    }

                );
            }
        );

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

            $this->join(
                ConfigService::$tableContentFields . ' as ' . $tableName,
                function (JoinClause $joinClause) use ($requiredFieldData, $tableName) {
                    $joinClause->on(
                        $tableName . '.content_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )->on(
                        $tableName .
                        '.key',
                        '=',
                        $joinClause->raw("'" . $requiredFieldData['name'] . "'")
                    )->on(
                        $tableName .
                        '.value',
                        '=',
                        $joinClause->raw("'" . $requiredFieldData['value'] . "'")
                    );

                }
            );
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

        $this->join(
            ConfigService::$tableContentFields,
            function (JoinClause $joinClause) use ($includedFields) {
                $joinClause->on(
                    ConfigService::$tableContentFields . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                );

                $joinClause->on(
                    function (JoinClause $joinClause) use ($includedFields) {
                        foreach ($includedFields as $index => $includedFieldData) {
                            $joinClause->orOn(
                                function (JoinClause $joinClause) use ($includedFieldData) {
                                    $joinClause->on(
                                        ConfigService::$tableContentFields .
                                        '.key',
                                        '=',
                                        $joinClause->raw("'" . $includedFieldData['name'] . "'")
                                    )->on(
                                        ConfigService::$tableContentFields .
                                        '.value',
                                        '=',
                                        $joinClause->raw("'" . $includedFieldData['value'] . "'")
                                    );

                                }
                            );
                        }
                    }

                );
            }
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByPermissions()
    {
        if (PermissionRepository::$availableContentPermissionIds === false) {
            return $this;
        }

        $this->whereIn(
            ConfigService::$tableContent . '.id',
            function (Builder $builder) {
                $builder
                    ->select([ConfigService::$tableContent . '.id'])
                    ->from(ConfigService::$tableContent)
                    ->leftJoin(
                        ConfigService::$tableContentPermissions,
                        function (JoinClause $join) {
                            return $join
                                ->on(
                                    ConfigService::$tableContentPermissions . '.content_id',
                                    ConfigService::$tableContent . '.id'
                                )
                                ->orOn(
                                    ConfigService::$tableContentPermissions . '.content_type',
                                    ConfigService::$tableContent . '.type'
                                );
                        }
                    )
                    ->leftJoin(
                        ConfigService::$tablePermissions,
                        ConfigService::$tablePermissions . '.id',
                        '=',
                        ConfigService::$tableContentPermissions . '.permission_id'
                    )
                    ->where(
                        function (Builder $builder) {
                            if (is_array(PermissionRepository::$availableContentPermissionIds)) {
                                return $builder->whereNull(
                                    ConfigService::$tableContentPermissions . '.permission_id'
                                )
                                    ->orWhereIn(
                                        ConfigService::$tablePermissions . '.id',
                                        PermissionRepository::$availableContentPermissionIds
                                    );
                            }

                            return $builder;
                        }
                    );
            }
        );

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
}