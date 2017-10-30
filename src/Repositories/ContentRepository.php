<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Services\ConfigService;

class ContentRepository extends RepositoryBase
{
    /**
     * If this is false content with any status will be pulled. If its an array, only content with those
     * statuses will be pulled.
     *
     * @var array|bool
     */
    public static $availableContentStatues = false;

    /**
     * If this is false content with any language will be pulled. If its an array, only content with those
     * languages will be pulled.
     *
     * @var array|bool
     */
    public static $includedLanguages = false;

    /**
     * Determines whether content with a published_on date in the future will be pulled or not.
     *
     * @var array|bool
     */
    public static $pullFutureContent = true;

    private $requiredFields = [];
    private $includedFields = [];

    private $requiredUserPlaylists = [];
    private $includedUserPlaylists = [];

    private $requiredUserStates = [];
    private $includedUserStates = [];

    private $page;
    private $limit;
    private $orderBy;
    private $orderDirection;
    private $typesToInclude = [];
    private $slugHierarchy = [];

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var FieldRepository
     */
    private $fieldRepository;

    /**
     * @var DatumRepository
     */
    private $datumRepository;

    /**
     * @var ContentHierarchyRepository
     */
    private $contentHierarchyRepository;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * ContentRepository constructor.
     *
     * @param PermissionRepository $permissionRepository
     * @param FieldRepository $fieldRepository
     * @param DatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        FieldRepository $fieldRepository,
        DatumRepository $datumRepository,
        ContentHierarchyRepository $contentHierarchyRepository,
        DatabaseManager $databaseManager
    ) {
        parent::__construct();

        $this->permissionRepository = $permissionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
        $this->databaseManager = $databaseManager;
    }

    /**
     * Call the get by id method from repository and return the category
     *
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        $query = $this->initQuery();

        //$this->addInheritedContentToQuery($query);
        $this->addFieldsAndDatumToQuery($query);

        return $this->parseRows(
                $query->where(ConfigService::$tableContent . '.id', $id)
                    ->get()
                    ->toArray()
            )[$id] ?? null;
    }

    /**
     * @param array $slugs
     * @return array|null
     */
    public function getBySlugHierarchy(...$slugs)
    {
        // todo: write function
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        $subQuery = $this->initQuery();

        $this->addSlugInheritanceToQuery($subQuery);
        $this->addFilteringToQuery($subQuery);

        $query = $this->initQuery();

        $this->addFieldsAndDatumToQuery($query);
        $this->addSlugInheritanceToQuery($query);
        $this->addSubJoinToQuery($query, $subQuery);

        $query->select([ConfigService::$tableContent . '.id'])
            ->groupBy(
                ConfigService::$tableContent . '.id',
                ConfigService::$tableContent . '.' . $this->orderBy
            );

        return $this->connection()->table(
            $this->databaseManager->raw('(' . $query->toSql() . ') as rows')
        )
            ->addBinding($query->getBindings())
            ->count();
    }

    /**
     * Insert a new content in the database and recalculate position
     *
     * @param string $slug
     * @param string $type
     * @param string $status
     * @param string $brand
     * @param string $language |null
     * @param string|null $publishedOn
     * @param string|null $createdOn
     * @param string|null $archivedOn
     * @return int
     */
    public function create(
        $slug,
        $type,
        $status,
        $brand,
        $language,
        $publishedOn,
        $createdOn = null,
        $archivedOn = null
    ) {
        $contentId = $this->query()
            ->insertGetId(
                [
                    'slug' => $slug,
                    'type' => $type,
                    'status' => $status,
                    'brand' => $brand,
                    'language' => $language,
                    'published_on' => $publishedOn,
                    'created_on' => $createdOn ?? Carbon::now()->toDateTimeString(),
                    'archived_on' => $archivedOn
                ]
            );

        return $contentId;
    }

    /**
     * Update a content record, recalculate position and return whether a row was updated or not.
     *
     * @param $id
     * @param array $newData
     * @return bool
     */
    public function update($id, array $newData)
    {
        $amountOfUpdatedRows = $this->query()
            ->where('id', $id)
            ->update($newData);

        return $amountOfUpdatedRows > 0;
    }

    /**
     * Unlink content's fields, content's datum and content's children,
     * delete the content and reposition the content children.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $this->contentHierarchyRepository->deleteChildParentLinks($id);
        $this->contentHierarchyRepository->deleteParentChildLinks($id);

        $this->unlinkContentFields($id);
        $this->unlinkContentData($id);
        $this->unlinkContentPermission($id);
        $this->unlinkContentPlaylist($id);

        // todo: unlink permissions, playlists

        $amountOfDeletedRows = $this->query()
            ->where('id', $id)
            ->delete();

        return $amountOfDeletedRows > 0;
    }

    /**
     * @param array $rows
     * @return array
     */
    private function parseRows(array $rows)
    {
        $contents = [];
        $parents = [];
        $fields = [];
        $data = [];

        foreach ($rows as $row) {
            $content = [
                'id' => $row['id'],
                'slug' => $row['slug'],
                'type' => $row['type'],
                'status' => $row['status'],
                'language' => $row['language'],
                'brand' => $row['brand'],
                'published_on' => $row['published_on'],
                'created_on' => $row['created_on'],
                'archived_on' => $row['archived_on'],
            ];

            $contents[$row['id']] = $content;

            $contents[$row['id']] =
                array_map("unserialize", array_unique(array_map("serialize", $contents[$row['id']])));

            if (!empty($row['field_id'])) {
                $field = [
                    'id' => $row['field_id'],
                    'key' => $row['field_key'],
                    'value' => $row['field_value'],
                    'type' => $row['field_type'],
                    'position' => $row['field_position'],
                ];

                $fields[$row['id']][] = $field;

                $fields[$row['id']] =
                    array_map("unserialize", array_unique(array_map("serialize", $fields[$row['id']])));
            }

            if (!empty($row['datum_id'])) {
                $datum = [
                    'id' => $row['datum_id'],
                    'key' => $row['datum_key'],
                    'value' => $row['datum_value'],
                    'position' => $row['datum_position'],
                ];

                $data[$row['id']][] = $datum;

                $data[$row['id']] =
                    array_map("unserialize", array_unique(array_map("serialize", $data[$row['id']])));
            }

            if (!empty($row['parent_id'])) {
                $parent = [
                    'parent_child_position' => $row['parent_child_position'],
                    'id' => $row['parent_id'],
                    'slug' => $row['parent_slug'],
                ];

                $parents[$row['id']][] = $parent;

                $parents[$row['id']] =
                    array_map("unserialize", array_unique(array_map("serialize", $parents[$row['id']])));
            }

        }

        foreach ($contents as $contentId => $content) {
            $contents[$contentId]['fields'] = $fields[$contentId] ?? null;
            $contents[$contentId]['data'] = $data[$contentId] ?? null;
            $contents[$contentId]['parents'] = $parents[$contentId] ?? null;

            $contents[$contentId] =
                array_map("unserialize", array_unique(array_map("serialize", $contents[$contentId])));
        }

        return $contents;
    }

    /**
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $orderDirection
     * @param array $typesToInclude
     * @param array $slugHierarchy
     * @return $this
     */
    public function startFilter(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $typesToInclude,
        array $slugHierarchy
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;

        // reset all the filters for the new query
        $this->requiredFields = [];
        $this->includedFields = [];
        $this->requiredUserPlaylists = [];
        $this->includedUserPlaylists = [];
        $this->requiredUserStates = [];
        $this->includedUserStates = [];

        return $this;
    }

    /**
     * @return array
     */
    public function retrieveFilter()
    {
        $subQuery = $this->initQuery();

        $this->addSlugInheritanceToQuery($subQuery);
        $this->addFilteringToQuery($subQuery);
        $this->addPaginationToQuery($subQuery);

        $query = $this->initQuery();

        $this->addFieldsAndDatumToQuery($query);
        $this->addSlugInheritanceToQuery($query);
        $this->addSubJoinToQuery($query, $subQuery);

        return $this->parseRows($query->get()->toArray());
    }

    /**
     * @param $name
     * @param $value
     * @param $type
     * @return $this
     */
    public function requireField($name, $value, $type = '')
    {
        $this->requiredFields[] = ['name' => $name, 'value' => $value, 'type' => $type];

        return $this;
    }

    /**
     * Including a single field is basically the same as requiring it. Only after
     * including a second field does it start to behave inclusively.
     *
     * @param $name
     * @param $value
     * @param $type
     * @return $this
     */
    public function includeField($name, $value, $type = '')
    {
        $this->includedFields[] = ['name' => $name, 'value' => $value, 'type' => $type];

        return $this;
    }

    /**
     * @param $userId
     * @param $name
     * @return $this
     */
    public function requireUserPlaylist($userId, $name)
    {
        $this->requiredUserPlaylists[] = ['user_id' => $userId, 'name' => $name];

        return $this;
    }

    /**
     * @param $userId
     * @param $name
     * @return $this
     */
    public function includeUserPlaylist($userId, $name)
    {
        $this->includedUserPlaylists[] = ['user_id' => $userId, 'name' => $name];

        return $this;
    }

    /**
     * @param $userId
     * @param $state
     * @return $this
     */
    public function requireUserStates($userId, $state)
    {
        $this->requiredUserStates = ['user_id' => $userId, 'state' => $state];

        return $this;
    }

    /**
     * @param $userId
     * @param $state
     * @return $this
     */
    public function includeUserStates($userId, $state)
    {
        $this->includedUserStates[] = ['user_id' => $userId, 'state' => $state];

        return $this;
    }

    private function addSlugInheritanceToQuery(Builder &$query)
    {
        $previousTableName = ConfigService::$tableContent;
        $previousTableJoinColumn = '.id';

        foreach ($this->slugHierarchy as $i => $slug) {
            $tableName = 'inheritance_' . $i;

            $query->leftJoin(
                ConfigService::$tableContentHierarchy . ' as ' . $tableName,
                $tableName . '.child_id',
                '=',
                $previousTableName . $previousTableJoinColumn
            );

            $inheritedContentTableName = 'inherited_content_' . $i;

            $query->leftJoin(
                ConfigService::$tableContent . ' as ' . $inheritedContentTableName,
                $inheritedContentTableName . '.id',
                '=',
                $tableName . '.parent_id'
            );

            $query->addSelect([$tableName . '.child_position as child_position_' . $i]);
            $query->addSelect([$tableName . '.parent_id as parent_id_' . $i]);
            $query->addSelect([$inheritedContentTableName . '.slug as parent_slug_' . $i]);

            $previousTableName = $tableName;
            $previousTableJoinColumn = '.parent_id';
        }
    }

    /**
     * @param Builder $query
     */
    private function addFilteringToQuery(Builder &$query)
    {
        if (is_array(self::$availableContentStatues)) {
            $query->whereIn('status', self::$availableContentStatues);
        }

        if (is_array(self::$includedLanguages)) {
            $query->whereIn('language', self::$includedLanguages);
        }

        if (!self::$pullFutureContent) {
            $query->where('published_on', '<', Carbon::now()->toDateTimeString());
        }

        if (!empty($this->typesToInclude)) {
            $query->whereIn(ConfigService::$tableContent . '.type', $this->typesToInclude);
        }

        foreach (array_reverse($this->slugHierarchy) as $i => $slug) {
            $query->where('parent_slug_' . $i, $slug);
        }

//        dd($query->orderBy(ConfigService::$tableContent . '.id')->get()->toArray());

//        if (!empty($this->includedParentSlugs)) {
//            $query->where(
//                function (Builder $builder) use ($query) {
//                    $parentsSlugs = $this->includedParentSlugs;
//                    $builder->whereExists(
//                        function (Builder $builder) use ($parentsSlugs) {
//                            $builder
//                                ->select([ConfigService::$tableContentHierarchy . '.child_id'])
//                                ->from(ConfigService::$tableContentHierarchy)
//                                ->join(
//                                    ConfigService::$tableContent . ' as inherited_content',
//                                    ConfigService::$tableContentHierarchy . '.parent_id',
//                                    '=',
//                                    'inherited_content.id'
//                                )
//                                ->whereIn('inherited_content.slug', $parentsSlugs)
//                                ->where([ConfigService::$tableContentHierarchy .
//                                '.child_id' => $this->databaseManager->raw(
//                                    ConfigService::$tableContent . '.id')
//                                ]);
//
//                            return $builder;
//                        }
//                    );
//                }
//            );
//        }

        // exclusive field filters
        $query->where(
            function (Builder $builder) use ($query) {

                foreach ($this->requiredFields as $requiredFieldData) {
                    $builder->whereExists(
                        function (Builder $builder) use ($requiredFieldData) {
                            $builder
                                ->select([ConfigService::$tableFields . '.id'])
                                ->from(ConfigService::$tableContentFields)
                                ->join(
                                    ConfigService::$tableFields,
                                    ConfigService::$tableFields . '.id',
                                    '=',
                                    ConfigService::$tableContentFields . '.field_id'
                                )
                                ->where(
                                    [
                                        ConfigService::$tableFields . '.key' => $requiredFieldData['name'],
                                        ConfigService::$tableFields . '.value' => $requiredFieldData['value'],
                                        ConfigService::$tableContentFields .
                                        '.content_id' => $this->databaseManager->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                );

                            if ($requiredFieldData['type'] !== '') {
                                $builder->where(
                                    ConfigService::$tableFields . '.type',
                                    $requiredFieldData['type']
                                );
                            }

                            return $builder;
                        }
                    );
                }

            }
        );

        // inclusive field filters
        $query->where(
            function (Builder $builder) use ($query) {

                foreach ($this->includedFields as $includedFieldData) {
                    $builder->orWhereExists(
                        function (Builder $builder) use ($includedFieldData) {
                            $builder
                                ->select([ConfigService::$tableFields . '.id'])
                                ->from(ConfigService::$tableContentFields)
                                ->join(
                                    ConfigService::$tableFields,
                                    ConfigService::$tableFields . '.id',
                                    '=',
                                    ConfigService::$tableContentFields . '.field_id'
                                )
                                ->where(
                                    [
                                        ConfigService::$tableFields . '.key' => $includedFieldData['name'],
                                        ConfigService::$tableFields . '.value' => $includedFieldData['value'],
                                        ConfigService::$tableContentFields .
                                        '.content_id' => $this->databaseManager->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                );

                            if ($includedFieldData['type'] !== '') {
                                $builder->where(
                                    ConfigService::$tableFields . '.type',
                                    $includedFieldData['type']
                                );
                            }

                            return $builder;
                        }
                    );
                }

            }
        );

        // exclusive user playlist filters
        $query->where(
            function (Builder $builder) use ($query) {

                foreach ($this->requiredUserPlaylists as $requiredUserPlaylistData) {
                    $builder->whereExists(
                        function (Builder $builder) use ($requiredUserPlaylistData) {
                            return $builder
                                ->select([ConfigService::$tableUserContent . '.content_id'])
                                ->from(ConfigService::$tableUserContent)
                                ->leftJoin(
                                    ConfigService::$tableUserContentPlaylists,
                                    ConfigService::$tableUserContent . '.id',
                                    '=',
                                    ConfigService::$tableUserContentPlaylists . '.content_user_id'
                                )
                                ->leftJoin(
                                    ConfigService::$tablePlaylists,
                                    ConfigService::$tablePlaylists . '.id',
                                    '=',
                                    ConfigService::$tableUserContentPlaylists . '.playlist_id'
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.user_id',
                                    $requiredUserPlaylistData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.content_id',
                                    $this->databaseManager->raw(
                                        ConfigService::$tableContent . '.id'
                                    )
                                )
                                ->where(
                                    ConfigService::$tablePlaylists . '.name',
                                    $requiredUserPlaylistData['name']
                                );
                        }
                    );
                }

            }
        );

        // inclusive user playlist filters
        $query->where(
            function (Builder $builder) use ($query) {

                foreach ($this->includedUserPlaylists as $requiredUserPlaylistData) {
                    $builder->orWhereExists(
                        function (Builder $builder) use ($requiredUserPlaylistData) {
                            return $builder
                                ->select([ConfigService::$tableUserContent . '.content_id'])
                                ->from(ConfigService::$tableUserContent)
                                ->leftJoin(
                                    ConfigService::$tableUserContentPlaylists,
                                    ConfigService::$tableUserContent . '.id',
                                    '=',
                                    ConfigService::$tableUserContentPlaylists . '.content_user_id'
                                )
                                ->leftJoin(
                                    ConfigService::$tablePlaylists,
                                    ConfigService::$tablePlaylists . '.id',
                                    '=',
                                    ConfigService::$tableUserContentPlaylists . '.playlist_id'
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.user_id',
                                    $requiredUserPlaylistData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.content_id',
                                    $this->databaseManager->raw(
                                        ConfigService::$tableContent . '.id'
                                    )
                                )
                                ->where(
                                    ConfigService::$tablePlaylists . '.name',
                                    $requiredUserPlaylistData['name']
                                );
                        }
                    );
                }

            }
        );

        // exclusive user state filter
        $query->where(
            function (Builder $builder) use ($query) {

                if (count($this->requiredUserStates) > 0) {
                    $requiredUserStateData = $this->requiredUserStates;
                    $builder->whereExists(
                        function (Builder $builder) use ($requiredUserStateData) {
                            return $builder
                                ->select([ConfigService::$tableUserContent . '.content_id'])
                                ->from(ConfigService::$tableUserContent)
                                ->where(
                                    ConfigService::$tableUserContent . '.user_id',
                                    $requiredUserStateData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.content_id',
                                    $this->databaseManager->raw(
                                        ConfigService::$tableContent . '.id'
                                    )
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.state',
                                    $requiredUserStateData['state']
                                );
                        }
                    );
                }
            }
        );

        // inclusive user state filters
        $query->where(
            function (Builder $builder) use ($query) {

                foreach ($this->includedUserStates as $requiredUserStateData) {
                    $builder->orWhereExists(
                        function (Builder $builder) use ($requiredUserStateData) {
                            return $builder
                                ->select([ConfigService::$tableUserContent . '.content_id'])
                                ->from(ConfigService::$tableUserContent)
                                ->where(
                                    ConfigService::$tableUserContent . '.user_id',
                                    $requiredUserStateData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.content_id',
                                    $this->databaseManager->raw(
                                        ConfigService::$tableContent . '.id'
                                    )
                                )
                                ->where(
                                    ConfigService::$tableUserContent . '.state',
                                    $requiredUserStateData['state']
                                );
                        }
                    );
                }
            }
        );
    }

    /**
     * @param Builder $query
     */
    private function addPaginationToQuery(Builder &$query)
    {
        $query
            ->orderBy(ConfigService::$tableContent . '.' . $this->orderBy, $this->orderDirection)
            ->limit($this->limit)
            ->skip(($this->page - 1) * $this->limit);
    }

    /**
     * Sub query must be completely created before being passed in here.
     * Any changes to the $subQuery object after being passed in will not be reflected at retrieval time.
     *
     * @param Builder $query
     * @param Builder $subQuery
     */
    private function addSubJoinToQuery(Builder &$query, Builder $subQuery)
    {
        $query
            ->join(
                $this->databaseManager->raw('(' . $subQuery->toSql() . ') inner_content'),
                function (JoinClause $joinClause) {
                    $joinClause->on(ConfigService::$tableContent . '.id', '=', 'inner_content.id');
                }
            )
            ->addBinding($subQuery->getBindings());
    }

    /**
     * @param Builder $query
     */
    private function addFieldsAndDatumToQuery(Builder &$query)
    {
        $query
            ->addSelect(
                [
                    ConfigService::$tableFields . '.id as field_id',
                    ConfigService::$tableFields . '.key as field_key',
                    ConfigService::$tableFields . '.value as field_value',
                    ConfigService::$tableFields . '.type as field_type',
                    ConfigService::$tableFields . '.position as field_position',
                    ConfigService::$tableData . '.id as datum_id',
                    ConfigService::$tableData . '.key as datum_key',
                    ConfigService::$tableData . '.value as datum_value',
                    ConfigService::$tableData . '.position as datum_position',
                ]
            )
            ->leftJoin(
                ConfigService::$tableContentFields,
                ConfigService::$tableContentFields . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableFields,
                ConfigService::$tableFields . '.id',
                '=',
                ConfigService::$tableContentFields . '.field_id'
            )
            ->leftJoin(
                ConfigService::$tableContentData,
                ConfigService::$tableContentData . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableData,
                ConfigService::$tableData . '.id',
                '=',
                ConfigService::$tableContentData . '.datum_id'
            );
    }

    /**
     * @param Builder $query
     */
    private function addInheritedContentToQuery(Builder &$query)
    {
        $query
            ->addSelect(
                [
                    'inherited_content.slug as parent_slug',
                    ConfigService::$tableContentHierarchy . '.parent_id as parent_id',
                    ConfigService::$tableContentHierarchy . '.child_position as parent_child_position',
                ]
            )
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                ConfigService::$tableContentHierarchy . '.child_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableContent . ' as inherited_content',
                'inherited_content.id',
                '=',
                ConfigService::$tableContentHierarchy . '.parent_id'
            );
    }

    /**
     * @return Builder
     */
    private function initQuery()
    {
        return $this->query()
            ->select(
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
            )
            ->orderBy(
                ConfigService::$tableContent . '.' . ($this->orderBy ?? 'published_on'),
                $this->orderDirection ?? 'desc'
            );
    }

    /**
     * @return Builder
     */
    private function query()
    {
        return $this->connection()->table(ConfigService::$tableContent);
    }

    /**
     * @return Builder
     */
    private function contentDataQuery()
    {
        return $this->connection()->table(ConfigService::$tableContentData);
    }

    /**
     * @return Builder
     */
    private function contentFieldsQuery()
    {
        return $this->connection()->table(ConfigService::$tableContentFields);
    }

    /**
     * @return Builder
     */
    private function contentPermissionQuery()
    {
        return $this->connection()->table(ConfigService::$tableContentPermissions);
    }

    /**
     * @return Builder
     */
    private function userContentQuery()
    {
        return $this->connection()->table(ConfigService::$tableUserContent);
    }

    /**
     * @return Builder
     */
    private function fieldQuery()
    {
        return $this->connection()->table(ConfigService::$tableFields);
    }

    /**
     * @return Builder
     */
    private function userPlaylistQuery()
    {
        return $this->connection()->table(ConfigService::$tableUserContentPlaylists);
    }


    /**
     * Unlink all data for a content id.
     *
     * @param $contentId
     * @return int
     */
    private function unlinkContentData($contentId)
    {
        return $this->contentDataQuery()->where(
            [
                'content_id' => $contentId
            ]
        )->delete();
    }

    /**
     * Unlink all fields for a content id.
     *
     * @param $contentId
     * @return int
     */
    private function unlinkContentFields($contentId)
    {
        return $this->contentFieldsQuery()->where(
            [
                'content_id' => $contentId
            ]
        )->delete();
    }

    /** Delete all the permissions for the content_id
     * @param integer $contentId
     * @return int
     */
    private function unlinkContentPermission($contentId)
    {
        return $this->contentPermissionQuery()->where(
            [
                'content_id' => $contentId
            ]
        )->delete();
    }

    private function unlinkContentPlaylist($contentId)
    {
        $userContents = $this->userContentQuery()->where([
            'content_id' => $contentId
        ]) ->get()->toArray();

        foreach($userContents as $userContent){
            $this->userPlaylistQuery()->where([
                'content_user_id' => $userContent['id']
            ]) -> delete();

            $this->userContentQuery()->where([
                'id' => $userContent['id']
            ])->delete();
        }

        return true;
    }

    public function getLinkedContent($contentId)
    {
        return $this->fieldQuery()
            ->join(ConfigService::$tableContentFields,
                ConfigService::$tableContentFields.'.field_id',
                '=',
                ConfigService::$tableFields.'.id')
            ->where(
                [
                    'value' => $contentId,
                    'type' => 'content_id'
                ]
            )->get()->toArray();
    }
}