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
    private $includedParentSlugs = [];
    private $contentId;
    private $slug;

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
        $this->contentId = $id;

        return $this->parseRows($this->filter(false)->get()->toArray())[$id] ?? null;
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
     * @return array
     */
    public function getMany()
    {
        return $this->parseRows($this->filter()->get()->toArray());
    }

    /**
     * @param string|null $parentSlug
     * @return array|null
     */
    public function getManyByParentSlug($parentSlug)
    {
        return $this->filter(false)->where('parent_slug', $parentSlug)->get()->toArray();
    }

    /**
     * Insert a new content in the database and recalculate position
     *
     * @param string $slug
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
     * @return int
     */
    public function delete($id)
    {
        $this->contentHierarchyRepository->deleteChildParentLinks($id);
        $this->contentHierarchyRepository->deleteParentChildLinks($id);

        $this->fieldRepository->unlinkContentFields($id);
        $this->datumRepository->unlinkContentData($id);

        // todo: unlink permissions, playlists

        $amountOfDeletedRows = $this->query()
            ->where('id', $id)
            ->delete();

        return $amountOfDeletedRows > 0;
    }

    /** Generate the Query Builder
     *
     * @param bool $includeJoins
     * @return Builder
     */
    public function baseQuery($includeJoins = true)
    {

        return $query;
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
     * @param array $includedParentSlugs
     * @return $this
     */
    public function startFilter(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $includedParentSlugs
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->includedParentSlugs = $includedParentSlugs;

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

    /**
     * @return int
     */
    private function count()
    {
        $mainQuery = $this->filter()
            ->select([ConfigService::$tableContent . '.id'])
            ->groupBy(
                ConfigService::$tableContent . '.id',
                ConfigService::$tableContent . '.' . $this->orderBy
            );

        return $this->connection()->table(
            $this->databaseManager->raw('(' . $mainQuery->toSql() . ') as rows')
        )
            ->addBinding($mainQuery->getBindings())
            ->count();
    }

    /**
     * @return Builder
     */
    private function filter()
    {
        $selects = [
            ConfigService::$tableContent . '.id as id',
            ConfigService::$tableContent . '.slug as slug',
            ConfigService::$tableContent . '.status as status',
            ConfigService::$tableContent . '.language as language',
            ConfigService::$tableContent . '.published_on as published_on',
            ConfigService::$tableContent . '.created_on as created_on',
            ConfigService::$tableContent . '.archived_on as archived_on',
            ConfigService::$tableContent . '.brand as brand',
            'inherited_content.slug as parent_slug',
            ConfigService::$tableContentHierarchy . '.parent_id as parent_id',
            ConfigService::$tableContentHierarchy . '.child_position as parent_child_position',
        ];

        if ($includeJoins) {
            $selects = array_merge(
                $selects,
                [
                    ConfigService::$tableFields . '.id as field_id',
                    ConfigService::$tableFields . '.key as field_key',
                    ConfigService::$tableFields . '.value as field_value',
                    ConfigService::$tableFields . '.type as field_type',
                    ConfigService::$tableFields . '.position as field_position',

                    ConfigService::$tableData . '.id as datum_id',
                    ConfigService::$tableData . '.value as datum_value',
                    ConfigService::$tableData . '.key as datum_key',
                    ConfigService::$tableData . '.position as datum_position',
                ]
            );
        }

        $query = $this->query()
            ->select($selects);

        if ($includeJoins) {
            $query = $this->fieldRepository->attachFieldsToContentQuery($query);
            $query = $this->datumRepository->attachDatumToContentQuery($query);
            $query = $this->permissionRepository->restrictContentQueryByPermissions($query);
        }

        if (is_array(self::$availableContentStatues)) {
            $query = $query->whereIn('status', self::$availableContentStatues);
        }

        if (is_array(self::$includedLanguages)) {
            $query = $query->whereIn('language', self::$includedLanguages);
        }

        if (!self::$pullFutureContent) {
            $query = $query->where('published_on', '<', Carbon::now()->toDateTimeString());
        }

        $subLimitQuery = $query
            ->select(ConfigService::$tableContent . '.id as id')
            ->groupBy(ConfigService::$tableContent . '.id')
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

        if (!empty($this->includedParentSlugs)) {
            $subLimitQuery->whereIn('inherited_content.slug', $this->includedParentSlugs);
        }

        if (!empty($this->contentId)) {
            $subLimitQuery->where(ConfigService::$tableContent . '.id', $this->contentId);
        }

        if (!empty($this->slug)) {
            $subLimitQuery->where(ConfigService::$tableContent . '.slug', $this->slug);
        }

        // exclusive field filters
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

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
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

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
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

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
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

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
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

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
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

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

        if (!empty($this->page)) {
            $subLimitQuery
                ->orderBy(ConfigService::$tableContent . '.' . $this->orderBy, $this->orderDirection)
                ->limit($this->limit)
                ->skip(($this->page - 1) * $this->limit);
        }

        $subLimitQueryString = $subLimitQuery->toSql();

        $query = $this->query()
            ->select(
                [
                    ConfigService::$tableContent . '.id as id',
                    ConfigService::$tableContent . '.slug as slug',
                    ConfigService::$tableContent . '.status as status',
                    ConfigService::$tableContent . '.language as language',
                    ConfigService::$tableContent . '.published_on as published_on',
                    ConfigService::$tableContent . '.created_on as created_on',
                    ConfigService::$tableContent . '.archived_on as archived_on',
                    ConfigService::$tableContent . '.brand as brand',
                    'inherited_content.slug as parent_slug',
                    ConfigService::$tableContentHierarchy . '.parent_id as parent_id',
                    ConfigService::$tableContentHierarchy . '.child_position as parent_child_position',
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
            )
            ->join(
                $this->databaseManager->raw('(' . $subLimitQueryString . ') inner_content'),
                function (JoinClause $joinClause) {
                    $joinClause->on(ConfigService::$tableContent . '.id', '=', 'inner_content.id');
                }
            )
            ->addBinding($subLimitQuery->getBindings());

        if (!empty($this->orderBy)) {
            $query->orderBy(ConfigService::$tableContent . '.' . $this->orderBy, $this->orderDirection);
        }

        return $query;
    }

    /**
     * @return Builder
     */
    private function query()
    {
        return $this->connection()->table(ConfigService::$tableContent);
    }
}