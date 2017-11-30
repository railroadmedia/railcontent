<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\DatabaseManager;
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

    private $requiredUserStates = [];
    private $includedUserStates = [];

    private $page;
    private $limit;
    private $orderBy;
    private $orderDirection;
    private $typesToInclude = [];
    private $slugHierarchy = [];
    private $requiredParentIds = [];

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
        ContentHierarchyRepository $contentHierarchyRepository
    ) {
        parent::__construct();

        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
    }

    /**
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->where([ConfigService::$tableContent . '.id' => $id])
            ->getToArray();

        if (empty($contentRows)) {
            return null;
        }

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
            ->restrictByUserAccess()
            ->whereIn(ConfigService::$tableContent.'.id', $ids)
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
        );
    }

    /**
     * @param $parentId
     * @return array
     */
    public function getByParentId($parentId, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                ConfigService::$tableContentHierarchy . '.child_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
            ->where(ConfigService::$tableContentHierarchy . '.parent_id', $parentId)
            ->selectInheritenceColumns()
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
        );
    }

    /**
     * @param $parentId
     * @return array
     */
    public function getByParentIds(array $parentIds, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                ConfigService::$tableContentHierarchy . '.child_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
            ->whereIn(ConfigService::$tableContentHierarchy . '.parent_id', $parentIds)
            ->selectInheritenceColumns()
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
        );
    }

    /**
     * @param $parentId
     * @return array
     */
    public function getByChildIdWhereType($childId, $type)
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                ConfigService::$tableContentHierarchy . '.parent_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->where(ConfigService::$tableContentHierarchy . '.child_id', $childId)
            ->where(ConfigService::$tableContent . '.type', $type)
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
     * @param string $type
     * @return array|null
     */
    public function getByType($type)
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->where('type', $type)
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
        );
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
            ->restrictByUserAccess()
            ->where('slug', $slug)
            ->where('type', $type)
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
        );
    }

    /**
     * @param $userId
     * @param string $type
     * @param string $slug
     * @return array|null
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->where('slug', $slug)
            ->where('type', $type)
            ->where('user_id', $userId)
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
        );
    }

    /**
     * @param $userId
     * @param $childContentIds
     * @param null $slug
     * @return array
     */
    public function getByUserIdWhereChildIdIn($userId, $childContentIds, $slug = null)
    {
        $query = $this->query()
            ->selectPrimaryColumns()
            ->selectInheritenceColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                function (JoinClause $joinClause) use ($childContentIds) {
                    $joinClause->on(
                        ConfigService::$tableContentHierarchy . '.parent_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )
                        ->whereIn(ConfigService::$tableContentHierarchy . '.child_id', $childContentIds);
                }
            )
            ->where(ConfigService::$tableContent . '.user_id', $userId);

        if (!empty($slug)) {
            $query->where('slug', $slug);
        }

        $contentRows = $query->getToArray();

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
        );
    }

    /**
     * @param array $types
     * @param $status
     * @param $fieldKey
     * @param $fieldValue
     * @param $fieldType
     * @param string $fieldComparisonOperator
     * @return array
     */
    public function getWhereTypeInAndStatusAndField(
        array $types,
        $status,
        $fieldKey,
        $fieldValue,
        $fieldType,
        $fieldComparisonOperator = '='
    ) {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->join(
                ConfigService::$tableContentFields,
                function (JoinClause $joinClause) use (
                    $fieldKey,
                    $fieldValue,
                    $fieldType,
                    $fieldComparisonOperator
                ) {
                    $joinClause->on(
                        ConfigService::$tableContentFields . '.content_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )->where(
                        ConfigService::$tableContentFields . '.key',
                        '=',
                        $fieldKey
                    )->where(
                        ConfigService::$tableContentFields . '.type',
                        '=',
                        $fieldType
                    )->where(
                        ConfigService::$tableContentFields . '.value',
                        $fieldComparisonOperator,
                        $fieldValue
                    );
                }
            )
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->where(ConfigService::$tableContent . '.status', $status)
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
        );
    }

    /**
     * @param array $types
     * @param $status
     * @return array
     */
    public function getWhereTypeInAndStatusAndPublishedOnOrdered(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'published_on',
        $orderByDirection = 'desc'
    ) {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->where(ConfigService::$tableContent . '.status', $status)
            ->where(
                ConfigService::$tableContent . '.published_on',
                $publishedOnComparisonOperator,
                $publishedOnValue
            )
            ->orderBy($orderByColumn, $orderByDirection)
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
                'parent_id' => $contentRow['parent_id'] ?? null,
                'child_id' => $contentRow['child_id'] ?? null,
                'fields' => $fieldRowsGrouped[$contentRow['id']] ?? [],
                'data' => $datumRowsGrouped[$contentRow['id']] ?? [],
                'permissions' => array_merge(
                    $permissionRowsGroupedById[$contentRow['id']] ?? [],
                    $permissionRowsGroupedByType[$contentRow['type']] ?? []
                ),
            ];

            if (!empty($contentRow['parent_id'])) {
                $content['parent_id'] = $contentRow['parent_id'];
                $content['position'] = $contentRow['child_position'] ?? null;
            }

            $contents[$contentRow['id']] = $content;
        }

        return $this->attachContentsLinkedByField($contents);
    }

    /**
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $orderDirection
     * @param array $typesToInclude
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @return $this
     * @internal param array $requiredParentIds
     */
    public function startFilter(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $typesToInclude,
        array $slugHierarchy,
        array $requiredParentIds
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;
        $this->requiredParentIds = $requiredParentIds;

        // reset all the filters for the new query
        $this->requiredFields = [];
        $this->includedFields = [];
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
            ->selectCountColumns()
            ->orderBy($this->orderBy, $this->orderDirection)
            ->restrictByUserAccess()
            ->directPaginate($this->page, $this->limit)
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->restrictByUserStates($this->requiredUserStates)
            ->includeByUserStates($this->includedUserStates)
            ->restrictByTypes($this->typesToInclude)
            ->restrictBySlugHierarchy($this->slugHierarchy)
            ->restrictByParentIds($this->requiredParentIds)
            ->groupBy(
                ConfigService::$tableContent . '.id',
                ConfigService::$tableContent . '.' . $this->orderBy
            );

        $query = $this->query()
            ->orderBy($this->orderBy, $this->orderDirection)
            ->addSubJoinToQuery($subQuery);

        $contentRows = $query->getToArray();

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
        );
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        $subQuery = $this->query()
            ->selectCountColumns()
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictByUserAccess()
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->restrictByUserStates($this->requiredUserStates)
            ->includeByUserStates($this->includedUserStates)
            ->restrictByTypes($this->typesToInclude)
            ->restrictBySlugHierarchy($this->slugHierarchy)
            ->restrictByParentIds($this->requiredParentIds)
            ->groupBy(ConfigService::$tableContent . '.id');

        return $this->connection()->table(
            $this->databaseManager->raw('(' . $subQuery->toSql() . ') as rows')
        )
            ->addBinding($subQuery->getBindings())
            ->count();
    }

    /**
     * @return array
     */
    public function getFilterFields()
    {
        $possibleContentFields = $this->query()
            ->selectFilterOptionColumns()
            ->restrictByUserAccess()
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->restrictByUserStates($this->requiredUserStates)
            ->includeByUserStates($this->includedUserStates)
            ->restrictStatuses()
            ->restrictPublishedOnDate()
            ->restrictByTypes($this->typesToInclude)
            ->restrictBrand()
            ->restrictByParentIds($this->requiredParentIds)
            ->leftJoin(
                ConfigService::$tableContentFields,
                ConfigService::$tableContentFields . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->whereIn(
                ConfigService::$tableContentFields . '.key',
                ConfigService::$fieldOptionList
            )
            ->groupBy(
                ConfigService::$tableContentFields . '.key',
                ConfigService::$tableContentFields . '.value',
                ConfigService::$tableContentFields . '.type'
            )
            ->get()
            ->toArray();

        return $this->parseAvailableFields($possibleContentFields);
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
     * @param $state
     * @return $this
     */
    public function requireUserStates($userId, $state)
    {
        $this->requiredUserStates[] = ['user_id' => $userId, 'state' => $state];

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

                            if (empty($linkedContents[$field['value']])) {
                                continue;
                            }

                            $linkedContent = $linkedContents[$field['value']];

                            $parsedContents[$contentId]['fields'][] = [
                                'id' => $field['id'],
                                'content_id' => $field['content_id'],
                                'key' => $field['key'],
                                'value' => $linkedContent,
                                'type' => 'content',
                                'position' => $field['position']
                            ];

                        }
                    }
                }

                // this prevent json from casting the fields to an object instead of an array
                $parsedContents[$contentId]['fields'] =
                    array_values($parsedContents[$contentId]['fields']);
            }
        }

        return $parsedContents;
    }

    private function parseAvailableFields($rows)
    {
        $availableFields = [];
        $subContentIds = [];

        foreach ($rows as $row) {
            if ($row['type'] == 'content_id') {
                $subContentIds[] = $row['value'];
            } else {
                $availableFields[$row['key']][] = $row['value'];
            }
        }

        $subContents = $this->getByIds($subContentIds);

        foreach ($rows as $row) {
            if ($row['type'] == 'content_id' && !empty($subContents[$row['value']])) {
                $availableFields[$row['key']][] = $subContents[$row['value']];
            }
        }

        return $availableFields;
    }
}