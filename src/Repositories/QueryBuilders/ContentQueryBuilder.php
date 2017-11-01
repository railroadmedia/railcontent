<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

class ContentQueryBuilder extends Builder
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
     * @param integer $page
     * @param integer $limit
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return $this
     */
    public function paginateAndOrder($page, $limit, $orderByColumn, $orderByDirection)
    {
        $this->orderBy(ConfigService::$tableContent . '.' . $orderByColumn, $orderByDirection)
            ->limit($limit)
            ->skip(($page - 1) * $limit);

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
     * @param array $requiredFields
     * @return $this
     */
    public function restrictByFields(array $requiredFields)
    {
        $this->where(
            function (Builder $builder) use ($requiredFields) {

                foreach ($requiredFields as $requiredFieldData) {
                    $builder->whereExists(
                        function (Builder $builder) use ($requiredFieldData) {
                            $builder
                                ->select([ConfigService::$tableContentFields . '.id'])
                                ->from(ConfigService::$tableContentFields)
                                ->where(
                                    [
                                        ConfigService::$tableContentFields .
                                        '.key' => $requiredFieldData['name'],
                                        ConfigService::$tableContentFields .
                                        '.content_id' => $this->getConnection()->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                )
                                ->where(
                                    function (Builder $builder) use ($requiredFieldData) {
                                        $builder->where(
                                            [
                                                ConfigService::$tableContentFields .
                                                '.value' => $requiredFieldData['value']
                                            ]
                                        )
                                            ->orWhereExists(
                                                function (Builder $builder) use ($requiredFieldData) {
                                                    $builder
                                                        ->select(['linked_content.id'])
                                                        ->from(
                                                            ConfigService::$tableContent .
                                                            ' as linked_content'
                                                        )
                                                        ->where(
                                                            'linked_content.slug',
                                                            $requiredFieldData['value']
                                                        )
                                                        ->whereIn(
                                                            $this->connection->raw(
                                                                ConfigService::$tableContentFields . '.value'
                                                            )
                                                            ,
                                                            [
                                                                $this->connection->raw(
                                                                    'linked_content.id'
                                                                )
                                                            ]
                                                        );
                                                }
                                            );
                                    }
                                );

                            if ($requiredFieldData['type'] !== '') {
                                $builder->where(
                                    ConfigService::$tableContentFields . '.type',
                                    $requiredFieldData['type']
                                );
                            }
                            return $builder;
                        }
                    );
                }

            }
        );

        return $this;
    }

    /**
     * @param array $includedFields
     * @return $this
     */
    public function includeByFields(array $includedFields)
    {
        $this->where(
            function (Builder $builder) use ($includedFields) {

                foreach ($includedFields as $includedFieldData) {
                    $builder->orWhereExists(
                        function (Builder $builder) use ($includedFieldData) {
                            $builder
                                ->select([ConfigService::$tableContentFields . '.id'])
                                ->from(ConfigService::$tableContentFields)
                                ->where(
                                    [
                                        ConfigService::$tableContentFields .
                                        '.key' => $includedFieldData['name'],
                                        ConfigService::$tableContentFields .
                                        '.value' => $includedFieldData['value'],
                                        ConfigService::$tableContentFields .
                                        '.content_id' => $this->connection->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                );

                            if ($includedFieldData['type'] !== '') {
                                $builder->where(
                                    ConfigService::$tableContentFields . '.type',
                                    $includedFieldData['type']
                                );
                            }

                            return $builder;
                        }
                    );
                }

            }
        );

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