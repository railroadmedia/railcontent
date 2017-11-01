<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
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
     * @var ContentFieldRepository
     */
    private $fieldRepository;

    /**
     * @var ContentDatumRepository
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
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository,
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
        $contentRows = $this->query()
            ->selectCoreColumns()
            ->addSlugInheritance($this->slugHierarchy)
            ->where(['id' => $id])
            ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentPermissionRows = $this->permissionRepository->getByContentIds(array_column($contentRows, 'id'));

        return $this->processRows(
            $contentRows,
            $contentFieldRows,
            $contentDatumRows,
            $contentPermissionRows
        )[$id] ?? null;
    }

    /**
     * Call the get by id method from repository and return the category
     *
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids)
    {
        $query = $this->query();

//        $this->addInheritedContentToQuery($query);
        $this->addSlugInheritanceToQuery($query);
        // $this->addFieldsAndDatumToQuery($query);

        return $this->parseRows(
            $query->whereIn(ConfigService::$tableContent . '.id', $ids)
                ->get()
                ->toArray()
        );
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
     * @param string $slug
     * @param string $type
     * @return array|null
     */
    public function getBySlugAndType($slug, $type)
    {
        $query = $this->query();

//        $this->addInheritedContentToQuery($query);
        $this->addSlugInheritanceToQuery($query);
        $this->addFieldsAndDatumToQuery($query);

        return reset(
                $this->parseRows(
                    $query->where(ConfigService::$tableContent . '.slug', $slug)
                        ->where(ConfigService::$tableContent . '.type', $type)
                        ->get()
                        ->toArray()
                )
            ) ?? null;
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        $subQuery = $this->query();

        $this->addSlugInheritanceToQuery($subQuery);
        $this->addFilteringToQuery($subQuery);

        $query = $this->query();

        // $this->addFieldsAndDatumToQuery($query);
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

        $amountOfDeletedRows = $this->query()
            ->where('id', $id)
            ->delete();

        return $amountOfDeletedRows > 0;
    }

    /**
     * @param array $parsedContents
     * @return array
     */
    public function attachContentsLinkedByField(array $parsedContents)
    {

        $contentIdsToPull = [];

        foreach ($parsedContents as $parsedContent) {
            if (!empty($parsedContent['fields'])) {
                foreach ($parsedContent['fields'] as $field) {
                    if ($field['type'] === 'content_id') {
                        $contentIdsToPull[$field['id']] = $field['value'];
                    }
                }
            }
        }

        if (!empty($contentIdsToPull)) {
            $linkedContents = $this->getByIds($contentIdsToPull);

            foreach ($parsedContents as $contentId => $parsedContent) {
                if (!empty($parsedContent['fields'])) {
                    foreach ($parsedContent['fields'] as $fieldIndex => $field) {
                        if ($field['type'] === 'content_id') {
                            unset($parsedContents[$contentId]['fields'][$fieldIndex]);

                            $linkedContent = $linkedContents[$field['value']];

                            $parsedContents[$contentId]['fields'][] = [
                                'id' => $field['id'],
                                'key' => $field['key'],
                                'value' => $linkedContent,
                                'type' => 'content',
                                'position' => $field['position']
                            ];

                        }
                    }

                    // this prevent json from casting the fields to an object instead of an array
                    $parsedContents[$contentId]['fields'] =
                        array_values($parsedContents[$contentId]['fields']);
                }
            }
        }

        return $parsedContents;
    }

    /**
     * @param array $contentRows
     * @param array $fieldRows
     * @param array $datumRows
     * @param array $permissionRows
     * @return array
     */
    private function processRows(
        array $contentRows,
        array $fieldRows,
        array $datumRows,
        array $permissionRows
    ) {
        $contents = [];
        $parents = [];

        $fieldRowsGrouped = ContentHelper::groupArrayBy($fieldRows, 'content_id');
        $datumRowsGrouped = ContentHelper::groupArrayBy($datumRows, 'content_id');
        $permissionRowsGrouped = ContentHelper::groupArrayBy($permissionRows, 'content_id');

        foreach ($contentRows as $contentRow) {
            $content = [
                'id' => $contentRow['id'],
                'slug' => $contentRow['slug'],
                'type' => $contentRow['type'],
                'status' => $contentRow['status'],
                'language' => $contentRow['language'],
                'brand' => $contentRow['brand'],
                'published_on' => $contentRow['published_on'],
                'created_on' => $contentRow['created_on'],
                'archived_on' => $contentRow['archived_on'],
                'fields' => $fieldRowsGrouped[$contentRow['id']] ?? [],
                'datum' => $datumRowsGrouped[$contentRow['id']] ?? [],
                'permissions' => $permissionRowsGrouped[$contentRow['id']] ?? [],
            ];

            $contents[$contentRow['id']] = $content;

//            if (!empty($contentRow['parent_id'])) {
//                $parent = [
//                    'parent_child_position' => $contentRow['parent_child_position'],
//                    'id' => $contentRow['parent_id'],
//                    'slug' => $contentRow['parent_slug'],
//                ];
//
//                $parents[$contentRow['id']][] = $parent;
//
//                $parents[$contentRow['id']] =
//                    array_map(
//                        "unserialize",
//                        array_unique(array_map("serialize", $parents[$contentRow['id']]))
//                    );
//            }

        }

        return $contents;
    }

    /**
     * @param array $rows
     * @return array
     */
    private function parseRows(array $rows)
    {
        $contents = [];
        $parents = [];

        $fields = $this->getContentsFields($rows);
        $data = $this->getContentsData($rows);

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
                'datum' => $data[$row['id']] ?? [],
                'fields' => $fields[$row['id']] ?? []
            ];

            $contents[$row['id']] = $content;

            $contents[$row['id']] =
                array_map("unserialize", array_unique(array_map("serialize", $contents[$row['id']])));

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
            $contents[$contentId]['parents'] = $parents[$contentId] ?? null;

            $contents[$contentId] =
                array_map("unserialize", array_unique(array_map("serialize", $contents[$contentId])));
        }

        return $this->attachContentsLinkedByField($contents);
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
        $subQuery = $this->query();

        $this->addSlugInheritanceToQuery($subQuery);
        $this->addFilteringToQuery($subQuery);
        $this->addPaginationToQuery($subQuery);

        $query = $this->query();

        //$this->addFieldsAndDatumToQuery($query);
        $this->addSlugInheritanceToQuery($query);
        $this->addSubJoinToQuery($query, $subQuery);

        return $this->parseRows($query->get()->toArray());
    }

    /**
     * @return array
     */
    public function getFilterFields()
    {
        $query = $this->query();

        $this->addFieldsAndDatumToQuery($query);
        $this->addFilteringToQuery($query);

        $query->select(
            [
                ConfigService::$tableContentFields . '.id as field_id',
                ConfigService::$tableContentFields . '.key as field_key',
                ConfigService::$tableContentFields . '.value as field_value',
                ConfigService::$tableContentFields . '.type as field_type',
            ]
        )
            ->groupBy(
                [
                    ConfigService::$tableContentFields . '.id',
                    ConfigService::$tableContentFields . '.key',
                    ConfigService::$tableContentFields . '.value',
                    ConfigService::$tableContentFields . '.type',
                ]
            );

        return $this->parseAvailableFields($query->get()->toArray());
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

        // exclusive field filters
        $query->where(
            function (Builder $builder) use ($query) {

                foreach ($this->requiredFields as $requiredFieldData) {
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
                                        '.content_id' => $this->databaseManager->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                )
                                ->where(
                                    function ($builder) use ($requiredFieldData) {
                                        $builder->where(
                                            [
                                                ConfigService::$tableContentFields .
                                                '.value' => $requiredFieldData['value']
                                            ]
                                        )
                                            ->orWhereExists(
                                                function ($builder) use ($requiredFieldData) {
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
                                                            $this->databaseManager->raw(
                                                                ConfigService::$tableContentFields . '.value'
                                                            )
                                                            ,
                                                            [
                                                                $this->databaseManager->raw(
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
                                ->select([ConfigService::$tableUserContentProgress . '.content_id'])
                                ->from(ConfigService::$tableUserContentProgress)
                                ->leftJoin(
                                    ConfigService::$tablePlaylistContents,
                                    ConfigService::$tableUserContentProgress . '.id',
                                    '=',
                                    ConfigService::$tablePlaylistContents . '.content_user_id'
                                )
                                ->leftJoin(
                                    ConfigService::$tablePlaylists,
                                    ConfigService::$tablePlaylists . '.id',
                                    '=',
                                    ConfigService::$tablePlaylistContents . '.playlist_id'
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.user_id',
                                    $requiredUserPlaylistData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.content_id',
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
                                ->select([ConfigService::$tableUserContentProgress . '.content_id'])
                                ->from(ConfigService::$tableUserContentProgress)
                                ->leftJoin(
                                    ConfigService::$tablePlaylistContents,
                                    ConfigService::$tableUserContentProgress . '.id',
                                    '=',
                                    ConfigService::$tablePlaylistContents . '.content_user_id'
                                )
                                ->leftJoin(
                                    ConfigService::$tablePlaylists,
                                    ConfigService::$tablePlaylists . '.id',
                                    '=',
                                    ConfigService::$tablePlaylistContents . '.playlist_id'
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.user_id',
                                    $requiredUserPlaylistData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.content_id',
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
                                ->select([ConfigService::$tableUserContentProgress . '.content_id'])
                                ->from(ConfigService::$tableUserContentProgress)
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.user_id',
                                    $requiredUserStateData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.content_id',
                                    $this->databaseManager->raw(
                                        ConfigService::$tableContent . '.id'
                                    )
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.state',
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
                                ->select([ConfigService::$tableUserContentProgress . '.content_id'])
                                ->from(ConfigService::$tableUserContentProgress)
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.user_id',
                                    $requiredUserStateData['user_id']
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.content_id',
                                    $this->databaseManager->raw(
                                        ConfigService::$tableContent . '.id'
                                    )
                                )
                                ->where(
                                    ConfigService::$tableUserContentProgress . '.state',
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
     * @return ContentQueryBuilder
     */
    private function query()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableContent);
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
     *
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
        $userContents = $this->userContentQuery()->where(
            [
                'content_id' => $contentId
            ]
        )->get()->toArray();

        foreach ($userContents as $userContent) {
            $this->userPlaylistQuery()->where(
                [
                    'content_user_id' => $userContent['id']
                ]
            )->delete();

            $this->userContentQuery()->where(
                [
                    'id' => $userContent['id']
                ]
            )->delete();
        }

        return true;
    }

    public function getLinkedContent($contentId)
    {
        return $this->fieldQuery()
            ->join(
                ConfigService::$tableContentFields,
                ConfigService::$tableContentFields . '.field_id',
                '=',
                ConfigService::$tableFields . '.id'
            )
            ->where(
                [
                    'value' => $contentId,
                    'type' => 'content_id'
                ]
            )->get()->toArray();
    }

    private function parseAvailableFields($rows)
    {
        $availableFields = [];
        $subContentIds = [];

        foreach ($rows as $row) {
            if (!empty($row['field_id'])) {

                if ($row['field_type'] == 'content_id') {
                    $subContentIds[] = $row['field_value'];
                } else {
                    $availableFields[$row['field_key']][] = $row['field_value'];
                }

            }
        }

        $subContents = $this->getByIds($subContentIds);

        foreach ($rows as $row) {
            if ($row['field_type'] == 'content_id' && !empty($subContents[$row['field_value']])) {
                $availableFields[$row['field_key']][] = $subContents[$row['field_value']];
            }
        }

        return $availableFields;
    }

    /**
     * @param array $rows
     * @param $contentFiels
     */
    private function getContentsFields(array $rows)
    {
        $contentFields = [];

        $contentFieldsResults = $this->fieldRepository->getByContentIds(array_pluck($rows, 'id'));
        foreach ($contentFieldsResults as $key => $contentFieldResult) {
            $contentFields[$contentFieldResult['content_id']][] = $contentFieldResult;
        }

        return $contentFields;
    }

    /**
     * @param array $rows
     * @param $contentFiels
     */
    private function getContentsData(array $rows)
    {
        $contentData = [];

        $contentDataResults = $this->datumRepository->getByContentIds(array_pluck($rows, 'id'));
        foreach ($contentDataResults as $key => $contentDataResult) {
            $contentData[$contentDataResult['content_id']][] = $contentDataResult;
        }

        return $contentData;
    }
}