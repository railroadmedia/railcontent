<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
     * ContentRepository constructor.
     *
     * @param PermissionRepository $permissionRepository
     * @param FieldRepository $fieldRepository
     * @param DatumRepository $datumRepository
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        FieldRepository $fieldRepository,
        DatumRepository $datumRepository
    ) {
        parent::__construct();

        $this->permissionRepository = $permissionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
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
     *
     * Returns an array of lesson data arrays.
     *
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $orderDirection
     * @param array $statuses
     * @param array $types
     * @param array $requiredFields
     * @return array|null
     */
    public function getFiltered(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $statuses,
        array $types,
        array $requiredFields
    ) {
        // todo: write function
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

        $this->reposition($contentId, $position);

        return $contentId;
    }

    /**
     * Update content position and call function that recalculate position for other children
     *
     * @param int $contentId
     * @param int $position
     */
    public function reposition($contentId, $position)
    {
        $parentContentId = $this->queryTable()->where('id', $contentId)->first(['parent_id'])['parent_id']
            ?? null;
        $childContentCount = $this->queryTable()->where('parent_id', $parentContentId)->count();

        if ($position < 1) {
            $position = 1;
        } elseif ($position > $childContentCount) {
            $position = $childContentCount;
        }

        $this->transaction(
            function () use ($contentId, $position, $parentContentId) {
                $this->queryTable()
                    ->where('id', $contentId)
                    ->update(
                        ['position' => $position]
                    );

                $this->otherChildrenRepositions($parentContentId, $contentId, $position);
            }
        );
    }

    /** Update position for other categories with the same parent id
     *
     * @param integer $parentCategoryId
     * @param integer $categoryId
     * @param integer $position
     */
    function otherChildrenRepositions($parentContentId, $contentId, $position)
    {
        $childContent =
            $this->queryTable()
                ->where('parent_id', $parentContentId)
                ->where('id', '<>', $contentId)
                ->orderBy('position')
                ->get()
                ->toArray();

        $start = 1;

        foreach ($childContent as $child) {
            if ($start == $position) {
                $start++;
            }

            $this->queryTable()
                ->where('id', $child['id'])
                ->update(
                    ['position' => $start]
                );
            $start++;
        }
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

        $this->reposition($id, $position);

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
        $this->unlinkFields($id);
        $this->unlinkData($id);

        if ($deleteChildren) {
            $this->unlinkChildren($id);
        }

        $delete = $this->queryTable()->where('id', $id)->delete();

        // todo: get parent id for this content id and replace null with it
        $this->otherChildrenRepositions(null, $id, 0);

        return $delete;
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
     * @return Builder
     */
    public function baseQuery()
    {
        $query = $this->queryTable()
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
                    ConfigService::$tableFields . '.id as field_id',
                    ConfigService::$tableFields . '.key as field_key',
                    ConfigService::$tableFields . '.value as field_value',
                    ConfigService::$tableFields . '.type as field_type',
                    ConfigService::$tableFields . '.position as field_position',
                    ConfigService::$tableData . '.id as datum_id',
                    ConfigService::$tableData . '.key as datum_key',
                    ConfigService::$tableData . '.position as datum_position',
                ]
            );

        $query = $this->fieldRepository->attachFieldsToContentQuery($query);
        $query = $this->datumRepository->attachDatumToContentQuery($query);
        $query = $this->permissionRepository->restrictContentQueryByPermissions($query);

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
}