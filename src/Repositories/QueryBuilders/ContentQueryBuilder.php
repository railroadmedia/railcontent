<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Doctrine\ORM\Query\Expr\Join;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentField;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class ContentQueryBuilder extends \Doctrine\ORM\QueryBuilder
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
                //                ConfigService::$tableContent . '.published_on as published_on',
                //                ConfigService::$tableContent . '.created_on as created_on',
                //                ConfigService::$tableContent . '.archived_on as archived_on',
            ]
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function selectCountColumns()
    {
        $this->addSelect(
            [
                ConfigService::$tableContent . '.id as id',
            ]
        );

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
            $this->raw('(' . $subQuery->toSql() . ') inner_content'),
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

        $this->join(ContentHierarchy::class, 'hierarchy', 'WITH', 'railcontent_content.id = hierarchy.child');
        $this->join(Content::class, 'inherited_content_', 'WITH', 'hierarchy.parent = inherited_content_.id');
        $this->andWhere('inherited_content_.slug IN (:slugs)')
            ->setParameter('slugs', $slugHierarchy);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $this->add(
                'where',
                $this->expr()
                    ->in(
                        config('railcontent.table_prefix') . 'content' . '.status',
                        ContentRepository::$availableContentStatues
                    )
            );
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPublishedOnDate()
    {
        if (!ContentRepository::$pullFutureContent) {
            $this->add(
                'where',
                $this->expr()
                    ->lte(
                        config('railcontent.table_prefix') . 'content' . '.publishedOn',
                        ':published'
                    )
            )
                ->setParameter('published', Carbon::now());
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->andWhere(
            config('railcontent.table_prefix') . 'content' . '.brand IN (:brands)'
        )
            ->setParameter('brands', array_values(array_wrap(ConfigService::$availableBrands)));

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $this->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $typesToInclude);
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

        $this->join(ContentHierarchy::class, 'ph', 'WITH', 'railcontent_content.id = ph.child');
        $this->andWhere('ph.parent IN (:parentIds)')
            ->setParameter('parentIds', $parentIds);

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
            $this->join(UserContentProgress::class, 'p', 'WITH', 'railcontent_content.id = p.content');
            $this->andWhere('p.state IN (:states)')
                ->andWhere('p.userId = :userId')
                ->setParameter('states', $requiredUserState['state'])
                ->setParameter('userId', $requiredUserState['user_id']);
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
        $this->join(UserContentProgress::class, 'pu', 'WITH', 'railcontent_content.id = pu.content');
        $orX =
            $this->expr()
                ->orX();
        foreach ($includedUserStates as $includedUserState) {
            $condition =
                $this->expr()
                    ->andX(
                        'pu.state  = ' .
                        $this->expr()
                            ->literal($includedUserState['state']) .
                        ' AND pu.userId = ' .
                        $this->expr()
                            ->literal($includedUserState['user_id'])
                    );

            $orX->add($condition);
        }
        $this->andWhere($orX);

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
            if (in_array(
                $requiredFieldData['name'],
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getFieldNames()
            )) {
                $this->andWhere(ConfigService::$tableContent . '.' . $requiredFieldData['name'] . ' IN (:value)')
                    ->setParameter('value', $requiredFieldData['value']);
            } else {
                if (in_array(
                    $requiredFieldData['name'],
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getAssociationNames()
                )) {
                    $this->join(
                        ConfigService::$tableContent .
                        '.' .
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getFieldName($requiredFieldData['name']),
                        'p'
                    )
                        ->andWhere('p IN (:value)')
                        ->setParameter('value', $requiredFieldData['value']);
                }
            }

            return $this;
        }
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

        $this->join(
            ConfigService::$tableContentFields . ' as ' . $tableName,
            function (JoinClause $joinClause) use ($includedFields, $tableName) {
                $joinClause->on(
                    $tableName . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                );

                $joinClause->on(
                    function (JoinClause $joinClause) use ($tableName, $includedFields) {
                        foreach ($includedFields as $index => $includedFieldData) {
                            $joinClause->orOn(
                                function (JoinClause $joinClause) use ($tableName, $includedFieldData) {
                                    $joinClause->on(
                                        $tableName . '.key',
                                        '=',
                                        $joinClause->raw("'" . $includedFieldData['name'] . "'")
                                    )
                                        ->on(
                                            $tableName . '.value',
                                            $includedFieldData['operator'],
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
        if (ContentRepository::$bypassPermissions === true) {
            return $this;
        }
        $this->leftJoin(
            ContentPermission::class,
            'content_permission',
            'WITH',
            $this->expr()
                ->orX(
                    $this->expr()
                        ->eq('railcontent_content.id', 'content_permission.content'),
                    $this->expr()
                        ->eq('railcontent_content.id', 'content_permission.contentType')
                )
        )
            ->leftJoin(
                UserPermission::class,
                'user_permission',
                'WITH',
                'content_permission.permission = user_permission.permission'
            );
        $this->andWhere(
            $this->expr()
                ->orX(
                    $this->expr()
                        ->isNull('content_permission'),
                    $this->expr()
                        ->andX(
                            $this->expr()
                                ->eq('user_permission.userId', ':userId'),
                            $this->expr()
                                ->orX(
                                    $this->expr()
                                        ->isNull('user_permission.expirationDate'),
                                    $this->expr()
                                        ->gte('user_permission.expirationDate', ':expirationDateOrNow')
                                )
                        )

                )
        )
            ->setParameter(
                'expirationDateOrNow',
                Carbon::now()
            )
            ->setParameter(
                'userId',
                auth()->id()
            );

        return $this;

        //        $this->leftJoin(
        //            ConfigService::$tableContentPermissions . ' as id_content_permissions',
        //            function (JoinClause $join) {
        //                $join->on(
        //                    'id_content_permissions' . '.content_id',
        //                    ConfigService::$tableContent . '.id'
        //                );
        //            }
        //        )
        //            ->leftJoin(
        //                ConfigService::$tableContentPermissions . ' as type_content_permissions',
        //                function (JoinClause $join) {
        //                    $join->on(
        //                        'type_content_permissions' . '.content_type',
        //                        ConfigService::$tableContent . '.type'
        //                    )
        //                        ->whereIn('type_content_permissions' . '.brand', ConfigService::$availableBrands);
        //                }
        //            )
        //            ->where(
        //                function (Builder $builder) {
        //                    return $builder->where(
        //                        function (Builder $builder) {
        //                            return $builder->whereNull(
        //                                'id_content_permissions' . '.permission_id'
        //                            )
        //                                ->whereNull(
        //                                    'type_content_permissions' . '.permission_id'
        //                                );
        //                        }
        //                    )
        //                        ->orWhereExists(
        //                            function (Builder $builder) {
        //                                return $builder->select('id')
        //                                    ->from(ConfigService::$tableUserPermissions)
        //                                    ->where('user_id', auth()->user()->id ?? null)
        //                                    ->where(
        //                                        function (Builder $builder) {
        //                                            return $builder->whereRaw(
        //                                                'permission_id = id_content_permissions.permission_id'
        //                                            )
        //                                                ->orWhereRaw(
        //                                                    'permission_id = type_content_permissions.permission_id'
        //                                                );
        //                                        }
        //                                    )
        //                                    ->where(
        //                                        function (Builder $builder) {
        //                                            return $builder->where(
        //                                                'expiration_date',
        //                                                '>=',
        //                                                Carbon::now()
        //                                                    ->toDateTimeString()
        //                                            )
        //                                                ->orWhereNull('expiration_date');
        //                                        }
        //                                    );
        //                            }
        //                        );
        //                }
        //            );

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

    public function whereIn($param, $values)
    {
        $this->andWhere($param . ' IN (:values)')
            ->setParameter('values', $values);

        return $this;
    }

    /**
     * @param array $requiredFields
     * @return $this
     */
    public function restrictByFilterOptions()
    {
        foreach (ConfigService::$fieldOptionList as $requiredFieldData) {
            if (in_array(
                $requiredFieldData,
                $this->getEntityManager()
                    ->getClassMetadata(Content::class)
                    ->getAssociationNames()
            )) {
                $this->addSelect($requiredFieldData);
                $this->leftJoin(
                    ConfigService::$tableContent .
                    '.' .
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getFieldName($requiredFieldData),
                    $requiredFieldData
                );
            }
        }

        return $this;
    }
}