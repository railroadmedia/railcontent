<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\DatabaseManager;
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
     * @var ContentPermissionRepository
     */
    private $contentPermissionRepository;

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
     * @param ContentPermissionRepository $contentPermissionRepository
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        ContentPermissionRepository $contentPermissionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository,
        ContentHierarchyRepository $contentHierarchyRepository,
        DatabaseManager $databaseManager
    ) {
        parent::__construct();

        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictBrand()
            ->restrictByPermissions()
//            ->addSlugInheritance($this->slugHierarchy)
            ->where(['id' => $id])
            ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentPermissionRows =
            $this->contentPermissionRepository->getByContentIdsOrTypes(
                array_column($contentRows, 'id'),
                array_column($contentRows, 'type')
            );

        return $this->processRows(
                $contentRows,
                $contentFieldRows,
                $contentDatumRows,
                $contentPermissionRows
            )[$id] ?? null;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids)
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictBrand()
//            ->addSlugInheritance($this->slugHierarchy)
            ->whereIn('id', $ids)
            ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentPermissionRows =
            $this->contentPermissionRepository->getByContentIds(array_column($contentRows, 'id'));

        return $this->processRows(
            $contentRows,
            $contentFieldRows,
            $contentDatumRows,
            $contentPermissionRows
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
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictBrand()
//            ->addSlugInheritance($this->slugHierarchy)
            ->where('slug', $slug)
            ->where('type', $type)
            ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentPermissionRows =
            $this->contentPermissionRepository->getByContentIds(array_column($contentRows, 'id'));

        return $this->processRows(
            $contentRows,
            $contentFieldRows,
            $contentDatumRows,
            $contentPermissionRows
        );
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
        // todo: fix
//        $this->contentHierarchyRepository->deleteChildParentLinks($id);
//        $this->contentHierarchyRepository->deleteParentChildLinks($id);
//
//        $this->unlinkContentFields($id);
//        $this->unlinkContentData($id);
//        $this->unlinkContentPermission($id);
//        $this->unlinkContentPlaylist($id);

        $amountOfDeletedRows = $this->query()
            ->where('id', $id)
            ->delete();

        return $amountOfDeletedRows > 0;
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
        $permissionRowsGroupedById = ContentHelper::groupArrayBy($permissionRows, 'content_id');
        $permissionRowsGroupedByType = ContentHelper::groupArrayBy($permissionRows, 'content_type');

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
                'permissions' => array_merge(
                    $permissionRowsGroupedById[$contentRow['id']] ?? [],
                    $permissionRowsGroupedByType[$contentRow['type']] ?? []
                ),
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
        $subQuery = $this->query()
            ->selectPrimaryColumns()
            ->orderBy($this->orderBy, $this->orderDirection)
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictBrand()
            ->directPaginate($this->page, $this->limit)
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->restrictByUserStates($this->requiredUserStates)
            ->includeByUserStates($this->includedUserStates)
            ->restrictBySlugHierarchy($this->slugHierarchy);

        $query = $this->query()
            ->orderBy($this->orderBy, $this->orderDirection)
            ->addSubJoinToQuery($subQuery);

        $contentRows = $query->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentPermissionRows =
            $this->contentPermissionRepository->getByContentIds(array_column($contentRows, 'id'));

        return $this->processRows(
            $contentRows,
            $contentFieldRows,
            $contentDatumRows,
            $contentPermissionRows
        );
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        $subQuery = $this->query()
            ->selectPrimaryColumns()
            ->orderBy($this->orderBy, $this->orderDirection)
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictBrand()
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->restrictBySlugHierarchy($this->slugHierarchy);

        $query = $this->query()
            ->orderBy($this->orderBy, $this->orderDirection)
            ->addSubJoinToQuery($subQuery);

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
     * @return array
     */
    public function getFilterFields()
    {
        $query = $this->query()
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->join(
                ConfigService::$tableContentFields,
                ConfigService::$tableContentFields . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            );

        $query->select(
            [
                ConfigService::$tableContentFields . '.id as field_id',
                ConfigService::$tableContentFields . '.key as field_key',
                ConfigService::$tableContentFields . '.value as field_value',
                ConfigService::$tableContentFields . '.type as field_type',
                ConfigService::$tableContentFields . '.position as field_position',
            ]
        )
            ->groupBy(
                [
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
     * @return ContentQueryBuilder
     */
    protected function query()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()->getQueryGrammar(),
            $this->connection()->getPostProcessor()
        ))
            ->from(ConfigService::$tableContent);
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
}