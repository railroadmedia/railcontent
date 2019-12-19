<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

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
     * If true all content will be returned regarless of user permissions.
     *
     * @var array|bool
     */
    public static $bypassPermissions = false;

    private $requiredFields = [];
    private $includedFields = [];

    private $requiredUserStates = [];
    private $includedUserStates = [];

    private $getFutureContentOnly = false;

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
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where([ConfigService::$tableContent . '.id' => $id])
                ->getToArray();

        if (empty($contentRows)) {
            return null;
        }

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
            array_column($contentRows, 'id'),
            array_column($contentRows, 'type')
        );

        return $this->processRows(
                $contentRows,
                $contentFieldRows,
                $contentDatumRows,
                $contentPermissionRows
            )[0] ?? null;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids)
    {
        $unorderedContentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->whereIn(ConfigService::$tableContent . '.id', $ids)
                ->getToArray();

        // restore order of ids passed in
        $contentRows = [];

        foreach ($ids as $id) {
            foreach ($unorderedContentRows as $index => $unorderedContentRow) {
                if ($id == $unorderedContentRow['id']) {
                    $contentRows[] = $unorderedContentRow;
                }
            }
        }

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $contentRows =
            $this->query()
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

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
    public function getByParentIdPaginated(
        $parentId,
        $limit = 10,
        $skip = 0,
        $orderBy = 'child_position',
        $orderByDirection = 'asc'
    ) {
        $contentRows =
            $this->query()
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
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
    public function getByParentIdWhereTypeIn(
        $parentId,
        array $types,
        $orderBy = 'child_position',
        $orderByDirection = 'asc'
    ) {
        $contentRows =
            $this->query()
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
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
    public function getByParentIdWhereTypeInPaginated(
        $parentId,
        array $types,
        $limit = 10,
        $skip = 0,
        $orderBy = 'child_position',
        $orderByDirection = 'asc'
    ) {
        $contentRows =
            $this->query()
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
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->limit($limit)
                ->skip($skip)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
    public function countByParentIdWhereTypeIn($parentId, array $types)
    {
        return $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                ConfigService::$tableContentHierarchy . '.child_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->where(ConfigService::$tableContentHierarchy . '.parent_id', $parentId)
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->selectInheritenceColumns()
            ->count();
    }

    /**
     * @param $parentId
     * @return array
     */
    public function getByParentIds(array $parentIds, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $contentRows =
            $this->query()
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

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $contentRows =
            $this->query()
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
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
    public function getByChildIdsWhereType(array $childIds, $type)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    ConfigService::$tableContentHierarchy . '.parent_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->whereIn(ConfigService::$tableContentHierarchy . '.child_id', $childIds)
                ->where(ConfigService::$tableContent . '.type', $type)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
     * @param $childId
     * @param array $types
     * @return array
     */
    public function getByChildIdWhereParentTypeIn($childId, array $types)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    ConfigService::$tableContentHierarchy . '.parent_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContentHierarchy . '.child_id', $childId)
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
     * @param $type
     * @param $userId
     * @param $state
     */
    public function getPaginatedByTypeUserProgressState($type, $userId, $state, $limit, $skip)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableUserContentProgress,
                    ConfigService::$tableUserContentProgress . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContent . '.type', $type)
                ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress . '.state', $state)
                ->orderBy('published_on', 'desc')
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
     * @param $userId
     * @param $state
     * @param $limit
     * @param $skip
     * @return array
     */
    public function getPaginatedByTypesUserProgressState(array $types, $userId, $state, $limit, $skip)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableUserContentProgress,
                    ConfigService::$tableUserContentProgress . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress . '.state', $state)
                ->orderBy('published_on', 'desc')
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
     * @param $userId
     * @param $state
     * @param $limit
     * @param $skip
     * @return array
     */
    public function getPaginatedByTypesRecentUserProgressState(array $types, $userId, $state, $limit, $skip)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableUserContentProgress,
                    ConfigService::$tableUserContentProgress . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress . '.state', $state)
                ->orderBy('updated_on', 'desc', ConfigService::$tableUserContentProgress)
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
     * @param $userId
     * @param $state
     * @return integer
     */
    public function countByTypesRecentUserProgressState(array $types, $userId, $state)
    {
        return $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableUserContentProgress,
                ConfigService::$tableUserContentProgress . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
            ->where(ConfigService::$tableUserContentProgress . '.state', $state)
            ->orderBy('updated_on', 'desc', ConfigService::$tableUserContentProgress)
            ->count();
    }

    /**
     * @param int $id
     * @param string $type
     * @param string $columnName
     * @param string $columnValue
     * @param int $siblingPairLimit
     * @param string $orderColumn
     * @param string $orderDirection
     * @return array
     */
    public function getTypeNeighbouringSiblings(
        $type,
        $columnName,
        $columnValue,
        $siblingPairLimit = 1,
        $orderColumn = 'published_on',
        $orderDirection = 'desc'
    ) {
        $beforeContents =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where(ConfigService::$tableContent . '.type', $type)
                ->where(ConfigService::$tableContent . '.' . $columnName, '<', $columnValue)
                ->orderBy($orderColumn, 'desc')
                ->limit($siblingPairLimit)
                ->getToArray();

        $afterContents =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where(ConfigService::$tableContent . '.type', $type)
                ->where(ConfigService::$tableContent . '.' . $columnName, '>', $columnValue)
                ->orderBy($orderColumn, 'asc')
                ->limit($siblingPairLimit)
                ->getToArray();

        $merged = array_merge($beforeContents, $afterContents);

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($merged, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($merged, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
            array_column($merged, 'id'),
            array_column($merged, 'type')
        );

        $processedContents = $this->processRows(
            $merged,
            $contentFieldRows,
            $contentDatumRows,
            $contentPermissionRows
        );

        foreach ($afterContents as $afterContentIndex => $afterContent) {
            foreach ($processedContents as $processedContentIndex => $processedContent) {
                if ($processedContent['id'] == $afterContent['id']) {
                    $afterContents[$afterContentIndex] = $processedContents[$processedContentIndex];
                }
            }
        }

        foreach ($beforeContents as $beforeContentIndex => $beforeContent) {
            foreach ($processedContents as $processedContentIndex => $processedContent) {
                if ($processedContent['id'] == $beforeContent['id']) {
                    $beforeContents[$beforeContentIndex] = $processedContents[$processedContentIndex];
                }
            }
        }

        if ($orderDirection == 'desc') {
            return [
                'before' => array_reverse($afterContents),
                'after' => array_reverse($beforeContents),
            ];
        }

        return [
            'before' => $beforeContents,
            'after' => $afterContents,
        ];
    }

    /**
     * @param array $types
     * @param $userId
     * @param $state
     * @return integer
     */
    public function countByTypesUserProgressState(array $types, $userId, $state)
    {
        return $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableUserContentProgress,
                ConfigService::$tableUserContentProgress . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
            ->where(ConfigService::$tableUserContentProgress . '.state', $state)
            ->orderBy('published_on', 'desc')
            ->count();
    }

    /**
     * @param string $type
     * @return array|null
     */
    public function getByType($type)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where('type', $type)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where('slug', $slug)
                ->where('type', $type)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where('slug', $slug)
                ->where('type', $type)
                ->where(ConfigService::$tableContent . '.user_id', $userId)
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $query =
            $this->query()
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

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $contentRows =
            $this->query()
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
                        )
                            ->where(
                                ConfigService::$tableContentFields . '.key',
                                '=',
                                $fieldKey
                            )
                            ->where(
                                ConfigService::$tableContentFields . '.type',
                                '=',
                                $fieldType
                            )
                            ->where(
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

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $contentRows =
            $this->query()
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

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        if (count($newData) == 0) {
            return true;
        };
        $amountOfUpdatedRows =
            $this->query()
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
        $amountOfDeletedRows =
            $this->query()
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
            $contents[$contentRow['id']]['id'] = $contentRow['id'];
            $contents[$contentRow['id']]['slug'] = $contentRow['slug'];
            $contents[$contentRow['id']]['type'] = $contentRow['type'];
            $contents[$contentRow['id']]['sort'] = $contentRow['sort'];
            $contents[$contentRow['id']]['status'] = $contentRow['status'];
            $contents[$contentRow['id']]['language'] = $contentRow['language'];
            $contents[$contentRow['id']]['brand'] = $contentRow['brand'];
            $contents[$contentRow['id']]['total_xp'] = $contentRow['total_xp'];
            $contents[$contentRow['id']]['published_on'] = $contentRow['published_on'];
            $contents[$contentRow['id']]['created_on'] = $contentRow['created_on'];
            $contents[$contentRow['id']]['archived_on'] = $contentRow['archived_on'];
            $contents[$contentRow['id']]['parent_id'] = $contentRow['parent_id'] ?? null;
            $contents[$contentRow['id']]['child_id'] = $contentRow['child_id'] ?? null;
            $contents[$contentRow['id']]['fields'] = $fieldRowsGrouped[$contentRow['id']] ?? [];
            $contents[$contentRow['id']]['data'] = $datumRowsGrouped[$contentRow['id']] ?? [];
            $contents[$contentRow['id']]['permissions'] = array_merge(
                $permissionRowsGroupedById[$contentRow['id']] ?? [],
                $permissionRowsGroupedByType[$contentRow['type']] ?? []
            );

            if (!empty($contentRow['child_id'])) {
                $contents[$contentRow['id']]['child_ids'][] = $contentRow['child_id'];
            }

            if (!empty($contentRow['parent_id'])) {
                $contents[$contentRow['id']]['parent_id'] = $contentRow['parent_id'];
                $contents[$contentRow['id']]['position'] = $contentRow['child_position'] ?? null;
            }
        }

        return $this->attachContentsLinkedByField(array_values($contents));
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
        array $requiredParentIds,
        $getFutureContentOnly = false
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;
        $this->requiredParentIds = $requiredParentIds;
        $this->getFutureContentOnly = $getFutureContentOnly;

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
        $orderByExploded = explode(' ', $this->orderBy);

        $orderByColumns = [ConfigService::$tableContent . '.' . 'created_on'];
        $groupByColumns = [ConfigService::$tableContent . '.' . 'created_on'];

        foreach ($orderByExploded as $orderByColumn) {
            array_unshift(
                $orderByColumns,
                ConfigService::$tableContent . '.' . $orderByColumn . ' ' . $this->orderDirection
            );

            array_unshift($groupByColumns, ConfigService::$tableContent . '.' . $orderByColumn);
        }

        $subQuery =
            $this->query()
                ->selectCountColumns()
                ->orderByRaw(
                    $this->databaseManager->raw(
                        implode(', ', $orderByColumns) . ' ' . $this->orderDirection
                    )
                )
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
                    array_merge(
                        [
                            ConfigService::$tableContent . '.id',
                            ConfigService::$tableContent . '.' . 'created_on',
                        ],
                        $groupByColumns
                    )
                );

        if ($this->getFutureContentOnly) {
            $subQuery->where('published_on', '>', Carbon::now()->toDateTimeString());
        }

        $query =
            $this->query()
                ->orderByRaw($this->databaseManager->raw(implode(', ', $orderByColumns) . ' ' . $this->orderDirection))
                ->addSubJoinToQuery($subQuery);

        $contentRows = $query->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
        $subQuery =
            $this->query()
                ->selectCountColumns()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByParentIds($this->requiredParentIds)
                ->groupBy(ConfigService::$tableContent . '.id');

        return $this->connection()
            ->table(
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
        $possibleContentFields =
            $this->query()
                ->selectFilterOptionColumns()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
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
                ->get()
                ->toArray();

        return $this->parseAvailableFields($possibleContentFields);
    }

    /**
     * @param $name
     * @param $value
     * @param $type
     * @param $operator
     * @return $this
     */
    public function requireField($name, $value, $type = '', $operator = '=')
    {
        $this->requiredFields[] = ['name' => $name, 'value' => $value, 'type' => $type, 'operator' => $operator];

        return $this;
    }

    /**
     * Including a single field is basically the same as requiring it. Only after
     * including a second field does it start to behave inclusively.
     *
     * @param $name
     * @param $value
     * @param $type
     * @param $operator
     * @return $this
     */
    public function includeField($name, $value, $type = '', $operator = '=')
    {
        $this->includedFields[] = ['name' => $name, 'value' => $value, 'type' => $type, 'operator' => $operator];

        return $this;
    }

    /**
     * @param $state
     * @param $userId null
     * @return $this
     */
    public function requireUserStates($state, $userId = null)
    {
        $this->requiredUserStates[] = ['state' => $state, 'user_id' => $userId ?? auth()->id()];

        return $this;
    }

    /**
     * @param $userId
     * @param $state
     * @return $this
     */
    public function includeUserStates($state, $userId = null)
    {
        $this->includedUserStates[] = ['state' => $state, 'user_id' => $userId ?? auth()->id()];

        return $this;
    }

    /**
     * @return ContentQueryBuilder
     */
    public function query()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()
                ->getQueryGrammar(),
            $this->connection()
                ->getPostProcessor()
        ))->from(ConfigService::$tableContent);
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

            // We always want to pull published linked contents regardless of parent content status
            if (is_array(ContentRepository::$availableContentStatues) &&
                !in_array(ContentService::STATUS_PUBLISHED, ContentRepository::$availableContentStatues)) {
                ContentRepository::$availableContentStatues[ContentService::STATUS_PUBLISHED] =
                    ContentService::STATUS_PUBLISHED;

                $linkedContents = $this->getByIds($contentIdsToPull);

                unset(ContentRepository::$availableContentStatues[ContentService::STATUS_PUBLISHED]);
            } else {
                $linkedContents = $this->getByIds($contentIdsToPull);
            }

            foreach ($parsedContents as $contentId => $parsedContent) {
                if (!empty($parsedContent['fields'])) {
                    foreach ($parsedContent['fields'] as $fieldIndex => $field) {
                        if ($field['type'] === 'content_id') {
                            unset($parsedContents[$contentId]['fields'][$fieldIndex]);

                            $linkedContents = array_combine(array_column($linkedContents, 'id'), $linkedContents);

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
                                'position' => $field['position'],
                            ];

                        }
                    }
                }

                // this prevent json from casting the fields to an object instead of an array
                $parsedContents[$contentId]['fields'] = array_values($parsedContents[$contentId]['fields']);
            }
        }

        return $parsedContents;
    }

    private function parseAvailableFields($rows)
    {
        $rows = array_map("unserialize", array_unique(array_map("serialize", $rows)));

        $availableFields = [];
        $subContentIds = [];

        foreach ($rows as $row) {
            if ($row['type'] == 'content_id') {
                $subContentIds[] = $row['value'];
            } else {
                $availableFields['content_type'][] = $row['content_type'];
                $availableFields[$row['key']][] = trim(strtolower($row['value']));

                // only uniques
                $availableFields[$row['key']] = array_values(array_unique($availableFields[$row['key']]));
                $availableFields['content_type'] = array_values(array_unique($availableFields['content_type']));
            }
        }

        $subContents = $this->getByIds($subContentIds);
        $subContents = array_combine(array_column($subContents, 'id'), $subContents);

        foreach ($rows as $row) {
            if ($row['type'] == 'content_id' && !empty($subContents[$row['value']])) {
                $availableFields[$row['key']][] = $subContents[strtolower($row['value'])];

                // only uniques (this is a multidimensional array_unique equivalent)
                $availableFields[$row['key']] =
                    array_map("unserialize", array_unique(array_map("serialize", $availableFields[$row['key']])));

                $availableFields[$row['key']] = array_values($availableFields[$row['key']]);
            }
        }

        foreach ($availableFields as $availableFieldIndex => $availableField) {
            usort(
                $availableFields[$availableFieldIndex],
                function ($a, $b) {
                    if (is_array($a)) {
                        return strncmp($a['slug'], $b['slug'], 15);
                    }

                    return strncmp($a, $b, 15);
                }
            );
        }

        // random use case, should be refactored at some point
        if (!empty($availableFields['difficulty']) && count(
                array_diff(
                    $availableFields['difficulty'],
                    [
                        'beginner',
                        'intermediate',
                        'advanced',
                        'all',
                    ]
                )
            ) == 0) {

            $availableFields['difficulty'] = [
                'beginner',
                'intermediate',
                'advanced',
                'all',
            ];
        }

        return $availableFields;
    }

    public function softDelete(array $contentIds)
    {
        return $this->query()
            ->whereIn('id', $contentIds)
            ->update(
                ['status' => ContentService::STATUS_DELETED]
            );
    }

    /**
     * @param $contentTypes
     * @param $contentFieldKey
     * @param array $contentFieldValues
     * @return array
     *
     * can get all for content_field key by not passing content_field values, or can filter by values.
     *
     */
    public function getByContentFieldValuesForTypes($contentTypes, $contentFieldKey, $contentFieldValues = [])
    {
        $query =
            $this->query()
                ->addSelect(
                    [
                        ConfigService::$tableContent . '.id as id',
                    ]
                );

        $rows =
            $query->restrictByUserAccess()
                ->join(
                    ConfigService::$tableContentFields,
                    function (JoinClause $joinClause) use (
                        $contentFieldKey,
                        $contentFieldValues
                    ) {
                        $joinClause->on(
                            ConfigService::$tableContentFields . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->where(
                                ConfigService::$tableContentFields . '.key',
                                '=',
                                $contentFieldKey
                            );
                        if (!empty($contentFieldValues)) {
                            $joinClause->whereIn(
                                ConfigService::$tableContentFields . '.value',
                                $contentFieldValues
                            );
                        }
                    }
                )
                ->whereIn(ConfigService::$tableContent . '.type', $contentTypes)
                ->getToArray();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row['id'];
        }

        return $rows;
    }

    /** Get from the database the contents that have been published starting with a date.
     *
     * @param string $startDate
     * @return array
     */
    public function getRecentPublishedContents($startDate)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->whereBetween(
                    ConfigService::$tableContent . '.published_on',
                    [
                        $startDate,
                        Carbon::now()
                            ->toDateTimeString(),
                    ]
                )
                ->whereNull('user_id')
                ->getToArray();

        return $contentRows;

    }

    /**
     * @param array $type
     * @return int
     */
    public function countByTypes(array $type)
    {
        return $this->query()
            ->selectCountColumns()
            ->restrictByUserAccess()
            ->whereIn(ConfigService::$tableContent . '.type', $type)
            ->count();
    }

    /**
     * @param $userId
     * @param $state
     * @return array
     */
    public function getFiltersUserProgressState($userId, $state)
    {
        $possibleFilters =
            $this->query()
                ->selectFilterOptionColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableUserContentProgress,
                    ConfigService::$tableUserContentProgress . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->leftJoin(
                    ConfigService::$tableContentFields,
                    ConfigService::$tableContentFields . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress . '.state', $state)
                ->getToArray();

        return $this->parseAvailableFields($possibleFilters);
    }

    public function getByChildId($childId)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    ConfigService::$tableContentHierarchy . '.parent_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContentHierarchy . '.child_id', $childId)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
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
}