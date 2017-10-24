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
    private $types = [];

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
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * ContentRepository constructor.
     *
     * @param PermissionRepository $permissionRepository
     * @param FieldRepository $fieldRepository
     * @param DatumRepository $datumRepository
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        FieldRepository $fieldRepository,
        DatumRepository $datumRepository,
        DatabaseManager $databaseManager
    ) {
        parent::__construct();

        $this->permissionRepository = $permissionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
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
        return (array)$this->baseQuery()
            ->where([ConfigService::$tableContent . '.id' => $id])
            ->get()
            ->first();
    }

    /**
     * @param string $slug
     * @return array|null
     */
    public function getBySlug($slug)
    {
        // todo: write function
    }

    /**
     * Returns an array of lesson data arrays.
     *
     * You can switch the field pulling style between inclusive and exclusive by changing the $subLimitQuery
     * between whereIn and orWhereIn.
     *
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $orderDirection
     * @param array $types
     * @param array $requiredFields
     * @param array $playlists
     * @return array|null
     */
    public function getFiltered(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $types,
        array $requiredFields,
        array $playlists
    ) {
        // ** legacy

//        $subLimitQuery = $this->baseQuery(false)
//            ->select(ConfigService::$tableContent . '.id as id');
//
//        if (!empty($types)) {
//            $subLimitQuery->whereIn(ConfigService::$tableContent . '.type', $types);
//        }
//
//        foreach ($requiredFields as $requiredFieldName => $requiredFieldValues) {
//            foreach ($requiredFieldValues as $requiredFieldValue) {
//                $subLimitQuery->whereExists(
//                    function (Builder $builder) use ($requiredFieldValue, $requiredFieldName) {
//                        return $builder
//                            ->select([ConfigService::$tableFields . '.id'])
//                            ->from(ConfigService::$tableContentFields)
//                            ->join(
//                                ConfigService::$tableFields,
//                                ConfigService::$tableFields . '.id',
//                                '=',
//                                ConfigService::$tableContentFields . '.field_id'
//                            )
//                            ->where(ConfigService::$tableFields . '.key', $requiredFieldName)
//                            ->whereIn(
//                                ConfigService::$tableContentFields .
//                                '.content_id',
//                                [
//                                    $this->databaseManager->raw(ConfigService::$tableContent . '.id'),
//                                    $this->databaseManager->raw(ConfigService::$tableContent . '.parent_id')
//                                ]
//                            )
//                            ->where(
//                                function ($builder) use ($requiredFieldName, $requiredFieldValue) {
//                                    $builder
//                                        ->where(ConfigService::$tableFields . '.value', $requiredFieldValue)
//                                        ->orWhereExists(
//                                            function ($builder) use (
//                                                $requiredFieldName,
//                                                $requiredFieldValue
//                                            ) {
//                                                $builder
//                                                    ->select([ConfigService::$tableContent . '.id'])
//                                                    ->from(ConfigService::$tableContent)
//                                                    ->where(
//                                                        ConfigService::$tableContent . '.slug',
//                                                        $requiredFieldValue
//                                                    )
//                                                    ->where(
//                                                        $this->databaseManager->raw(
//                                                            ConfigService::$tableFields . '.type'
//                                                        ),
//                                                        'content_id'
//                                                    )
//                                                    ->whereIn(
//                                                        $this->databaseManager->raw(
//                                                            ConfigService::$tableFields . '.value'
//                                                        )
//                                                        ,
//                                                        [
//                                                            $this->databaseManager->raw(
//                                                                ConfigService::$tableContent . '.id'
//                                                            ),
//                                                            $this->databaseManager->raw(
//                                                                ConfigService::$tableContent . '.parent_id'
//                                                            )
//                                                        ]
//                                                    );
//                                            }
//                                        );
//                                }
//                            );
//                    }
//                );
//            }
//        }
//
//        if (!empty($playlists)) {
//            $subLimitQuery->whereExists(
//                function (Builder $builder) use ($playlists) {
//                    return $builder
//                        ->select([ConfigService::$tableUserContent . '.content_id'])
//                        ->from(ConfigService::$tableUserContent)
//                        ->leftJoin(
//                            ConfigService::$tableUserContentPlaylists,
//                            ConfigService::$tableUserContent . '.id',
//                            '=',
//                            ConfigService::$tableUserContentPlaylists . '.content_user_id'
//                        )
//                        ->leftJoin(
//                            ConfigService::$tablePlaylists,
//                            ConfigService::$tablePlaylists . '.id',
//                            '=',
//                            ConfigService::$tableUserContentPlaylists . '.playlist_id'
//                        )
//                        ->where(
//                            [
//                                ConfigService::$tableUserContent . '.user_id' => 1,
//                                ConfigService::$tableUserContent .
//                                '.content_id' => $this->databaseManager->raw(
//                                    ConfigService::$tableContent . '.id'
//                                )
//                            ]
//                        )
//                        ->whereIn(ConfigService::$tablePlaylists . '.name', $playlists);
//                }
//            );
//        }
//
//        $subLimitQuery
//            ->groupBy(ConfigService::$tableContent . '.id')
//            ->orderBy($orderBy, $orderDirection)
//            ->limit($limit)
//            ->skip(($page - 1) * $limit);
//
//        $subLimitQueryString = $subLimitQuery->toSql();
//
//        $query = $this->queryTable()
//            ->select(
//                [
//                    ConfigService::$tableContent . '.id as id',
//                    ConfigService::$tableContent . '.slug as slug',
//                    ConfigService::$tableContent . '.status as status',
//                    ConfigService::$tableContent . '.type as type',
//                    ConfigService::$tableContent . '.position as position',
//                    ConfigService::$tableContent . '.parent_id as parent_id',
//                    ConfigService::$tableContent . '.language as language',
//                    ConfigService::$tableContent . '.published_on as published_on',
//                    ConfigService::$tableContent . '.created_on as created_on',
//                    ConfigService::$tableContent . '.archived_on as archived_on',
//                    ConfigService::$tableContent . '.brand as brand',
//                    ConfigService::$tableFields . '.id as field_id',
//                    ConfigService::$tableFields . '.key as field_key',
//                    ConfigService::$tableFields . '.value as field_value',
//                    ConfigService::$tableFields . '.type as field_type',
//                    ConfigService::$tableFields . '.position as field_position',
//                    ConfigService::$tableData . '.id as datum_id',
//                    ConfigService::$tableData . '.key as datum_key',
//                    ConfigService::$tableData . '.value as datum_value',
//                    ConfigService::$tableData . '.position as datum_position',
//                ]
//            )
//            ->leftJoin(
//                ConfigService::$tableContentFields,
//                ConfigService::$tableContentFields . '.content_id',
//                '=',
//                ConfigService::$tableContent . '.id'
//            )
//            ->leftJoin(
//                ConfigService::$tableFields,
//                ConfigService::$tableFields . '.id',
//                '=',
//                ConfigService::$tableContentFields . '.field_id'
//            )
//            ->leftJoin(
//                ConfigService::$tableContentData,
//                ConfigService::$tableContentData . '.content_id',
//                '=',
//                ConfigService::$tableContent . '.id'
//            )
//            ->leftJoin(
//                ConfigService::$tableData,
//                ConfigService::$tableData . '.id',
//                '=',
//                ConfigService::$tableContentData . '.datum_id'
//            )
//            ->join(
//                $this->databaseManager->raw('(' . $subLimitQueryString . ') inner_content'),
//                function (JoinClause $joinClause) {
//                    $joinClause->on(ConfigService::$tableContent . '.id', '=', 'inner_content.id');
//                }
//            )
//            ->addBinding($subLimitQuery->getBindings())
//            ->orderBy($orderBy, $orderDirection);
//
//        return $this->parseBaseQueryRows($query->get()->toArray());
    }

    /**
     * Insert a new content in the database, save the content slug in the translation table and recalculate position
     *
     * @param string $slug
     * @param string $status
     * @param string $type
     * @param integer $position
     * @param string $language |null
     * @param integer|null $parentId
     * @param string|null $publishedOn
     * @return int
     */
    public function create($slug, $status, $type, $position, $language, $parentId, $publishedOn)
    {
        $contentId = $this->queryTable()->insertGetId(
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'brand' => ConfigService::$brand,
                'position' => $position,
                'language' => $language,
                'parent_id' => $parentId,
                'published_on' => $publishedOn,
                'created_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        $this->reposition($contentId, $type, $position);

        return $contentId;
    }

    /**
     * Update a content record, recalculate position and return the content id
     *
     * @param $id
     * @param string $slug
     * @param string $status
     * @param string $type
     * @param integer $position
     * @param string|null $language
     * @param integer|null $parentId
     * @param string|null $publishedOn
     * @param string|null $archivedOn
     * @return int $categoryId
     */
    public function update(
        $id,
        $slug,
        $status,
        $type,
        $position,
        $language,
        $parentId,
        $publishedOn,
        $archivedOn
    ) {
        $oldPosition = $this->queryTable()->where('id', $id)->first(['position'])['position'] ?? null;

        $this->queryTable()->where('id', $id)->update(
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position,
                'language' => $language,
                'parent_id' => $parentId,
                'published_on' => $publishedOn,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => $archivedOn,
            ]
        );

        $this->reposition($id, $type, $position, $oldPosition);

        return $id;
    }

    /**
     * Unlink content's fields, content's datum and content's children,
     * delete the content and reposition the content children.
     *
     * @param int $id
     * @param bool $deleteChildren
     * @return int
     */
    public function delete($id, $deleteChildren = false)
    {
        $contentBeingDeleted = $this->queryTable()
            ->where('id', $id)
            ->first();

        $this->unlinkFields($id);
        $this->unlinkData($id);

        if ($deleteChildren) {
            $this->unlinkChildren($id);
        }

        $delete = $this->queryTable()->where('id', $id)->delete();

        $this->otherChildrenRepositions(
            $contentBeingDeleted['parent_id'],
            $id,
            $contentBeingDeleted['type'],
            null,
            $contentBeingDeleted['position']
        );

        return $delete;
    }

    /**
     * Update content position and call function that recalculate position for other children
     *
     * @param int $contentId
     * @param string $type
     * @param int $newPosition
     * @param int|null $oldPosition
     */
    public function reposition($contentId, $type, $newPosition, $oldPosition = null)
    {
        $parentContentId = $this->queryTable()
                ->where('id', $contentId)
                ->first(['parent_id'])
            ['parent_id'] ?? null;

        $childContentCount = $this->queryTable()
            ->where('parent_id', $parentContentId)
            ->where('type', $type)
            ->count();

        if ($newPosition < 1) {
            $newPosition = 1;
        } elseif ($newPosition > $childContentCount) {
            $newPosition = $childContentCount;
        }

        $this->transaction(
            function () use ($oldPosition, $type, $contentId, $newPosition, $parentContentId) {
                $this->queryTable()
                    ->where('id', $contentId)
                    ->update(
                        ['position' => $newPosition]
                    );

                $this->otherChildrenRepositions(
                    $parentContentId,
                    $contentId,
                    $type,
                    $newPosition,
                    $oldPosition
                );
            }
        );
    }

    /** Update position for other categories with the same parent id
     *
     * @param $parentContentId
     * @param $contentId
     * @param $type
     * @param $newPosition
     * @param null $oldPosition
     * @return int
     */
    function otherChildrenRepositions(
        $parentContentId,
        $contentId,
        $type,
        $newPosition = null,
        $oldPosition = null
    ) {
        if (!is_null($newPosition) && !is_null($oldPosition) && $newPosition > $oldPosition) {

            // content position is being updated to larger position in the stack
            return $this->queryTable()
                ->where('parent_id', $parentContentId)
                ->where('id', '!=', $contentId)
                ->where('position', '>', $oldPosition)
                ->where('position', '<=', $newPosition)
                ->where('type', $type)
                ->decrement('position');

        } elseif (!is_null($newPosition) && !is_null($oldPosition) && $newPosition < $oldPosition) {

            // content position is being updated to smaller position in the stack
            return $this->queryTable()
                ->where('parent_id', $parentContentId)
                ->where('id', '!=', $contentId)
                ->where('position', '<', $oldPosition)
                ->where('position', '>=', $newPosition)
                ->where('type', $type)
                ->increment('position');

        } elseif (is_null($oldPosition)) {

            // content is being created with position anywhere in stack
            return $this->queryTable()
                ->where('parent_id', $parentContentId)
                ->where('id', '!=', $contentId)
                ->where('position', '>=', $newPosition)
                ->where('type', $type)
                ->increment('position');
        } else {

            // content is being deleted
            return $this->queryTable()
                ->where('parent_id', $parentContentId)
                ->where('id', '!=', $contentId)
                ->where('position', '>=', $oldPosition)
                ->where('type', $type)
                ->decrement('position');

        }
    }

    /**
     * Unlink all fields for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function unlinkFields($contentId)
    {
        return $this->contentFieldsQuery()->where('content_id', $contentId)->delete();
    }

    /**
     * @return Builder
     */
    public function contentFieldsQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentFields);
    }

    /**
     * Unlink all datum for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function unlinkData($contentId)
    {
        return $this->contentDataQuery()->where('content_id', $contentId)->delete();
    }

    /**
     * @return Builder
     */
    public function contentDataQuery()
    {
        return parent::connection()->table(ConfigService::$tableContentData);
    }

    /**
     * Unlink content children.
     *
     * @param integer $id
     * @return integer
     */
    public function unlinkChildren($id)
    {
        return $this->queryTable()->where('parent_id', $id)->update(['parent_id' => null]);
    }

    /**
     * Delete a specific content field link
     *
     * @param $contentId
     * @param null $fieldId
     * @return int
     */
    public function unlinkField($contentId, $fieldId)
    {
        return $this->contentFieldsQuery()
            ->where('content_id', $contentId)
            ->where('field_id', $fieldId)
            ->delete();
    }

    /**
     * Delete a specific content datum link
     *
     * @param $contentId
     * @param null $datumId
     * @return int
     */
    public function unlinkDatum($contentId, $datumId)
    {
        return $this->contentDataQuery()
            ->where('content_id', $contentId)
            ->where('datum_id', $datumId)
            ->delete();
    }

    /**
     * Insert a new record in railcontent_content_data
     *
     * @param integer $contentId
     * @param integer $datumId
     * @return int
     */
    public function linkDatum($contentId, $datumId)
    {
        return $this->contentDataQuery()->insertGetId(
            [
                'content_id' => $contentId,
                'datum_id' => $datumId
            ]
        );
    }

    /**
     * Insert a new record in railcontent_content_fields
     *
     * @param integer $contentId
     * @param integer $fieldId
     * @return int
     */
    public function linkField($contentId, $fieldId)
    {
        return $this->contentFieldsQuery()->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId
            ]
        );
    }

    /**
     * Get the content and the linked datum from database
     *
     * @param integer $datumId
     * @param integer $contentId
     * @return mixed
     */
    public function getLinkedDatum($datumId, $contentId)
    {
        $dataIdLabel = ConfigService::$tableData . '.id';

        return $this->contentDataQuery()
            ->leftJoin(ConfigService::$tableData, 'datum_id', '=', $dataIdLabel)
            ->select(
                ConfigService::$tableContentData . '.*',
                ConfigService::$tableData . '.*'
            )
            ->where(
                [
                    'datum_id' => $datumId,
                    'content_id' => $contentId
                ]
            )
            ->get()
            ->first();
    }

    /**
     * Get the content and the associated field from database
     *
     * @param integer $fieldId
     * @param integer $contentId
     * @return mixed
     */
    public function getLinkedField($fieldId, $contentId)
    {
        $fieldIdLabel = ConfigService::$tableFields . '.id';

        return
            $this->contentFieldsQuery()
                ->leftJoin(ConfigService::$tableFields, 'field_id', '=', $fieldIdLabel)
                ->select(
                    ConfigService::$tableContentFields . '.*',
                    ConfigService::$tableFields . '.*'
                )
                ->where(
                    [
                        'field_id' => $fieldId,
                        'content_id' => $contentId
                    ]
                )
                ->get()
                ->first();
    }

    /**
     * Get the content and the associated field from database based on key
     *
     * @param string $key
     * @param integer $contentId
     * @return mixed
     */
    public function getContentLinkedFieldByKey($key, $contentId)
    {
        $fieldIdLabel = ConfigService::$tableFields . '.id';

        return $this->contentFieldsQuery()
            ->leftJoin(ConfigService::$tableFields, 'field_id', '=', $fieldIdLabel)
            ->where(
                [
                    'key' => $key,
                    'content_id' => $contentId
                ]
            )->get()->first();
    }

    /**
     * @return Builder
     */
    public function queryIndex()
    {
        return $this->queryTable()
            ->select(
                [
                    ConfigService::$tableContent . '.id as id',
                    ConfigService::$tableContent . '.slug as slug',
                    ConfigService::$tableContent . '.status as status',
                    ConfigService::$tableContent . '.type as type',
                    ConfigService::$tableContent . '.position as position',
                    ConfigService::$tableContent . '.parent_id as parent_id',
                    ConfigService::$tableContent . '.published_on as published_on',
                    ConfigService::$tableContent . '.created_on as created_on',
                    ConfigService::$tableContent . '.archived_on as archived_on',
                    ConfigService::$tableContent . '.brand as brand',
                    'allfieldsvalue.id as field_id',
                    'allfieldsvalue.key as field_key',
                    'allfieldsvalue.value as field_value',
                    'allfieldsvalue.type as field_type',
                    'allfieldsvalue.position as field_position',
                    ConfigService::$tableData . '.id as datum_id',
                    ConfigService::$tableData . '.key as datum_key',
                    ConfigService::$tableData . '.value as datum_value',
                    ConfigService::$tableData . '.position as datum_position',

                ]
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
                ConfigService::$tableContentFields . ' as allcontentfields',
                'allcontentfields.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->leftJoin(
                ConfigService::$tableFields . ' as allfieldsvalue',
                'allfieldsvalue.id',
                '=',
                'allcontentfields.field_id'
            )
            ->leftJoin(
                ConfigService::$tableContentPermissions,
                function ($join) {
                    return $join->on(
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
                ConfigService::$tableContentPermissions . '.required_permission_id'
            )
            ->groupBy(
                [
                    'allfieldsvalue.id',
                    ConfigService::$tableContent . '.id',
                    ConfigService::$tableData . '.id'
                ]
            );
    }

    /**
     * @return Builder
     */
    public function contentVersionQuery()
    {
        return parent::connection()->table(ConfigService::$tableVersions);
    }

    /**
     * Get a collection with the contents Ids, where the content it's linked
     *
     * @param integer $contentId
     * @return \Illuminate\Support\Collection
     */
    public function linkedWithContent($contentId)
    {
        $fieldIdLabel = ConfigService::$tableFields . '.id';

        return $this->contentFieldsQuery()
            ->select('content_id')
            ->leftJoin(ConfigService::$tableFields, 'field_id', '=', $fieldIdLabel)
            ->where(
                [
                    'value' => $contentId,
                    'type' => 'content_id'
                ]
            )->get();
    }

    /**
     * @return Builder
     */
    public function queryTable()
    {
        return $this->connection()->table(ConfigService::$tableContent);
    }

    /** Generate the Query Builder
     *
     * @param bool $includeJoins
     * @return Builder
     */
    public function baseQuery($includeJoins = true)
    {
        $selects = [
            ConfigService::$tableContent . '.id as id',
            ConfigService::$tableContent . '.slug as slug',
            ConfigService::$tableContent . '.status as status',
            ConfigService::$tableContent . '.type as type',
            ConfigService::$tableContent . '.position as position',
            ConfigService::$tableContent . '.parent_id as parent_id',
            ConfigService::$tableContent . '.language as language',
            ConfigService::$tableContent . '.published_on as published_on',
            ConfigService::$tableContent . '.created_on as created_on',
            ConfigService::$tableContent . '.archived_on as archived_on',
            ConfigService::$tableContent . '.brand as brand',
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

        $query = $this->queryTable()
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

        return $query;
    }

    /**
     * @param array $rows
     */
    private function parseBaseQueryRows(array $rows)
    {
        $contents = [];
        $fields = [];
        $data = [];

        foreach ($rows as $row) {
            $content = [
                'id' => $row['id'],
                'slug' => $row['slug'],
                'status' => $row['status'],
                'type' => $row['type'],
                'position' => $row['position'],
                'parent_id' => $row['parent_id'],
                'language' => $row['language'],
                'published_on' => $row['published_on'],
                'created_on' => $row['created_on'],
                'archived_on' => $row['archived_on'],
                'brand' => $row['brand'],
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

        }

        foreach ($contents as $contentId => $content) {
            $contents[$contentId]['fields'] = $fields[$contentId] ?? null;
            $contents[$contentId]['data'] = $data[$contentId] ?? null;

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
     * @param array $types
     * @return $this
     */
    public function startFilter(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $types
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->types = $types;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @param $type
     * @return $this
     */
    public function requireField($name, $value, $type)
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
    public function includeField($name, $value, $type)
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
     * @return array
     */
    public function get()
    {
        $subLimitQuery = $this->baseQuery(false)
            ->select(ConfigService::$tableContent . '.id as id');

        if (!empty($types)) {
            $subLimitQuery->whereIn(ConfigService::$tableContent . '.type', $this->types);
        }

        // exclusive field filters
        $subLimitQuery->where(
            function (Builder $builder) use ($subLimitQuery) {

                foreach ($this->requiredFields as $requiredFieldData) {
                    $builder->whereExists(
                        function (Builder $builder) use ($requiredFieldData) {
                            return $builder
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
                                        ConfigService::$tableFields . '.type' => $requiredFieldData['type'],
                                        ConfigService::$tableContentFields .
                                        '.content_id' => $this->databaseManager->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                );
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
                            return $builder
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
                                        ConfigService::$tableFields . '.type' => $includedFieldData['type'],
                                        ConfigService::$tableContentFields .
                                        '.content_id' => $this->databaseManager->raw(
                                            ConfigService::$tableContent . '.id'
                                        )
                                    ]
                                );
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

                foreach ($this->requiredUserPlaylists as $requiredUserPlaylistData) {
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
                                    ConfigService::$tablePlaylists . '.name',
                                    $requiredUserPlaylistData['name']
                                );
                        }
                    );
                }

            }
        );

        $subLimitQuery
            ->orderBy($this->orderBy, $this->orderDirection)
            ->limit($this->limit)
            ->skip(($this->page - 1) * $this->limit);

        $subLimitQueryString = $subLimitQuery->toSql();

        $query = $this->queryTable()
            ->select(
                [
                    ConfigService::$tableContent . '.id as id',
                    ConfigService::$tableContent . '.slug as slug',
                    ConfigService::$tableContent . '.status as status',
                    ConfigService::$tableContent . '.type as type',
                    ConfigService::$tableContent . '.position as position',
                    ConfigService::$tableContent . '.parent_id as parent_id',
                    ConfigService::$tableContent . '.language as language',
                    ConfigService::$tableContent . '.published_on as published_on',
                    ConfigService::$tableContent . '.created_on as created_on',
                    ConfigService::$tableContent . '.archived_on as archived_on',
                    ConfigService::$tableContent . '.brand as brand',
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
            ->join(
                $this->databaseManager->raw('(' . $subLimitQueryString . ') inner_content'),
                function (JoinClause $joinClause) {
                    $joinClause->on(ConfigService::$tableContent . '.id', '=', 'inner_content.id');
                }
            )
            ->addBinding($subLimitQuery->getBindings())
            ->orderBy($this->orderBy, $this->orderDirection);

        return $this->parseBaseQueryRows($query->get()->toArray());
    }
}