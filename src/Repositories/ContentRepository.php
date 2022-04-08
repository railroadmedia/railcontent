<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

    public static $getFutureContentOnly = false;
    public static $getFollowedContentOnly = false;

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
                ->where([ConfigService::$tableContent.'.id' => $id])
                ->getToArray();

        if (empty($contentRows)) {
            return null;
        }

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
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
                ->whereIn(ConfigService::$tableContent.'.id', $ids)
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

        $contentFieldRows = //$this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
            $this->getFieldsByContentIds($contentRows);

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
                    ConfigService::$tableContentHierarchy.'.child_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
                ->where(ConfigService::$tableContentHierarchy.'.parent_id', $parentId)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
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
                    ConfigService::$tableContentHierarchy.'.child_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
                ->where(ConfigService::$tableContentHierarchy.'.parent_id', $parentId)
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
                    ConfigService::$tableContentHierarchy.'.child_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
                ->where(ConfigService::$tableContentHierarchy.'.parent_id', $parentId)
                ->whereIn(ConfigService::$tableContent.'.type', $types)
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
                    ConfigService::$tableContentHierarchy.'.child_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
                ->where(ConfigService::$tableContentHierarchy.'.parent_id', $parentId)
                ->whereIn(ConfigService::$tableContent.'.type', $types)
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
                ConfigService::$tableContentHierarchy.'.child_id',
                '=',
                ConfigService::$tableContent.'.id'
            )
            ->where(ConfigService::$tableContentHierarchy.'.parent_id', $parentId)
            ->whereIn(ConfigService::$tableContent.'.type', $types)
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
                    ConfigService::$tableContentHierarchy.'.child_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
                ->whereIn(ConfigService::$tableContentHierarchy.'.parent_id', $parentIds)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
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
                    ConfigService::$tableContentHierarchy.'.parent_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->where(ConfigService::$tableContentHierarchy.'.child_id', $childId)
                ->where(ConfigService::$tableContent.'.type', $type)
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
                    ConfigService::$tableContentHierarchy.'.parent_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->whereIn(ConfigService::$tableContentHierarchy.'.child_id', $childIds)
                ->where(ConfigService::$tableContent.'.type', $type)
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
    public function getByChildIdsWhereTypeForUrl(array $childIds, $type)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    ConfigService::$tableContentHierarchy.'.parent_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->whereIn(ConfigService::$tableContentHierarchy.'.child_id', $childIds)
                ->where(ConfigService::$tableContent.'.type', $type)
                ->selectInheritenceColumns()
                ->getToArray(['id', 'slug', 'child_ids']);

        return $this->processRows($contentRows, [], [], []);
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
                    ConfigService::$tableContentHierarchy.'.parent_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->where(ConfigService::$tableContentHierarchy.'.child_id', $childId)
                ->whereIn(ConfigService::$tableContent.'.type', $types)
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
                    ConfigService::$tableUserContentProgress.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->havingRaw(
                    ConfigService::$tableContent.".type IN (".implode(",", array_fill(0, count([$type]), "?")).")",
                    [$type])
                ->where(ConfigService::$tableUserContentProgress.'.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress.'.state', $state)
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
                    ConfigService::$tableUserContentProgress.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->whereIn(ConfigService::$tableContent.'.type', $types)
                ->where(ConfigService::$tableUserContentProgress.'.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress.'.state', $state)
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
                    ConfigService::$tableUserContentProgress.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->havingRaw(
                    ConfigService::$tableContent.".type IN (".implode(",", array_fill(0, count($types), "?")).")",
                    $types
                )
                ->where(ConfigService::$tableUserContentProgress.'.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress.'.state', $state)
                ->orderBy('updated_on', 'desc', ConfigService::$tableUserContentProgress)
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
            //$this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
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
                ConfigService::$tableUserContentProgress.'.content_id',
                '=',
                ConfigService::$tableContent.'.id'
            )
            ->whereIn(ConfigService::$tableContent.'.type', $types)
            ->where(ConfigService::$tableUserContentProgress.'.user_id', $userId)
            ->where(ConfigService::$tableUserContentProgress.'.state', $state)
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
                ->where(ConfigService::$tableContent.'.type', $type)
                ->where(ConfigService::$tableContent.'.'.$columnName, '<', $columnValue)
                ->orderBy($orderColumn, 'desc')
                ->limit($siblingPairLimit)
                ->getToArray();

        $afterContents =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where(ConfigService::$tableContent.'.type', $type)
                ->where(ConfigService::$tableContent.'.'.$columnName, '>', $columnValue)
                ->orderBy($orderColumn, 'asc')
                ->limit($siblingPairLimit)
                ->getToArray();

        $merged = array_merge($beforeContents, $afterContents);

        $contentFieldRows = $this->getFieldsByContentIds($merged);
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
                ConfigService::$tableUserContentProgress.'.content_id',
                '=',
                ConfigService::$tableContent.'.id'
            )
            ->whereIn(ConfigService::$tableContent.'.type', $types)
            ->where(ConfigService::$tableUserContentProgress.'.user_id', $userId)
            ->where(ConfigService::$tableUserContentProgress.'.state', $state)
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
                ->where(ConfigService::$tableContent.'.user_id', $userId)
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
        if (empty($userId)) {
            return [];
        }

        $query =
            $this->query()
                ->selectPrimaryColumns()
                ->selectInheritenceColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    function (JoinClause $joinClause) use ($childContentIds) {
                        $joinClause->on(
                            ConfigService::$tableContentHierarchy.'.parent_id',
                            '=',
                            ConfigService::$tableContent.'.id'
                        )
                            ->whereIn(ConfigService::$tableContentHierarchy.'.child_id', $childContentIds);
                    }
                )
                ->where(ConfigService::$tableContent.'.user_id', $userId);

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
                ->join(ConfigService::$tableContentFields, function (JoinClause $joinClause) use (
                    $fieldKey,
                    $fieldValue,
                    $fieldType,
                    $fieldComparisonOperator
                ) {
                    $joinClause->on(
                        ConfigService::$tableContentFields.'.content_id',
                        '=',
                        ConfigService::$tableContent.'.id'
                    )
                        ->where(
                            ConfigService::$tableContentFields.'.key',
                            '=',
                            $fieldKey
                        )
                        ->where(
                            ConfigService::$tableContentFields.'.type',
                            '=',
                            $fieldType
                        )
                        ->where(
                            ConfigService::$tableContentFields.'.value',
                            $fieldComparisonOperator,
                            $fieldValue
                        );
                })
                ->whereIn(ConfigService::$tableContent.'.type', $types)
                ->where(ConfigService::$tableContent.'.status', $status)
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
     * @param $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param array $requiredField
     * @return array
     */
    public function getWhereTypeInAndStatusAndPublishedOnOrdered(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'published_on',
        $orderByDirection = 'desc',
        $requiredField = []
    ) {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->whereIn(ConfigService::$tableContent.'.type', $types)
                ->where(ConfigService::$tableContent.'.status', $status)
                ->where(
                    ConfigService::$tableContent.'.published_on',
                    $publishedOnComparisonOperator,
                    $publishedOnValue
                )
                ->orderBy($orderByColumn, $orderByDirection);

        if (!empty($requiredField)) {
            $contentRows->join(ConfigService::$tableContentFields, function (JoinClause $joinClause) use (
                $requiredField
            ) {
                $joinClause->on(
                    ConfigService::$tableContentFields.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                    ->where(
                        ConfigService::$tableContentFields.'.key',
                        '=',
                        $requiredField['key']
                    )
                    ->whereIn(
                        ConfigService::$tableContentFields.'.value',
                        $requiredField['value']
                    );
            });
        }

        $contentRows = $contentRows->getToArray();

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
            //$this->fieldRepository->getByContentIds(array_column($contentRows, 'id'));
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
        }
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

        $fieldRowsGrouped = $fieldRows;
        // $fieldRowsGrouped = ContentHelper::groupArrayBy($fieldRows, 'content_id');
        $datumRowsGrouped = ContentHelper::groupArrayBy($datumRows, 'content_id');
        $permissionRowsGroupedById = ContentHelper::groupArrayBy($permissionRows, 'content_id');
        $permissionRowsGroupedByType = ContentHelper::groupArrayBy($permissionRows, 'content_type');

        foreach ($contentRows as $contentRow) {
            $contents[$contentRow['id']]['id'] = $contentRow['id'];
            $contents[$contentRow['id']]['popularity'] = $contentRow['popularity'];
            $contents[$contentRow['id']]['difficulty'] = $contentRow['difficulty'];
            $contents[$contentRow['id']]['title'] = $contentRow['title'];
            $contents[$contentRow['id']]['name'] = $contentRow['name'];
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
        $getFutureContentOnly = false,
        $getFollowedContentOnly = false
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;
        $this->requiredParentIds = $requiredParentIds;

        self::$getFutureContentOnly = $getFutureContentOnly;
        self::$getFollowedContentOnly = $getFollowedContentOnly;

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
        $subQuery =
            $this->query()
                ->selectCountColumns($this->orderBy)
                ->restrictByUserAccess()
                ->directPaginate($this->page, $this->limit)
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByParentIds($this->requiredParentIds)
                ->order($this->orderBy, $this->orderDirection)
                ->group($this->orderBy);

        if (self::$getFutureContentOnly) {
            $subQuery->where(
                'published_on',
                '>',
                Carbon::now()
                    ->toDateTimeString()
            );
        }

        if (self::$getFollowedContentOnly) {
            $subQuery->restrictFollowedContent();
        }

        $query =
            $this->query()
                ->selectPrimaryColumns()
                ->order($this->orderBy, $this->orderDirection)
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
                ->groupBy(ConfigService::$tableContent.'.id');

        if (self::$getFollowedContentOnly) {
            $subQuery->restrictFollowedContent();
        }

        return $this->connection()
            ->table(
                $this->databaseManager->raw('('.$subQuery->toSql().') as results')
            )
            ->addBinding($subQuery->getBindings())
            ->count();
    }

    /**
     * @return array
     */
    public function getFilterFields()
    {
        $query =
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
                    ConfigService::$tableContentFields.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->whereIn(
                    ConfigService::$tableContentFields.'.key',
                    ConfigService::$fieldOptionList
                );

        if (self::$getFollowedContentOnly) {
            $query->restrictFollowedContent();
        }
        $possibleContentFields =
            $query->get()
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
    public function requireField($name, $value, $type = '', $operator = '=', $field = '')
    {
        $this->requiredFields[] =
            ['name' => $name, 'value' => $value, 'type' => $type, 'operator' => $operator, 'field' => $field];

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
                        $contentIdsToPull[] = $field['value'];
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
                                // 'id' => $field['id'],
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
            $availableFields['content_type'][] = $row['content_type'];
            if ($row['type'] == 'content_id') {
                $subContentIds[] = $row['value'];
            } else {
                $availableFields[$row['key']][] = trim(ucfirst($row['value']));
                // only uniques - despite of upper/lowercase
                $data = array_intersect_key(
                    $availableFields[$row['key']],
                    array_unique(array_map('strtolower', $availableFields[$row['key']]))
                );

                $availableFields[$row['key']] = array_values($data);
            }

            $availableFields['content_type'] = array_values(array_unique($availableFields['content_type']));
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
            // if they are all numeric, sort by numbers, otherwise sort by string comparision
            if (is_numeric(reset($availableFields[$availableFieldIndex])) &&
                ctype_digit(implode('', $availableFields[$availableFieldIndex]))) {
                sort($availableFields[$availableFieldIndex]);
            } else {
                usort($availableFields[$availableFieldIndex], function ($a, $b) {
                    if (is_array($a)) {
                        return strncmp(strtolower($a['slug']), strtolower($b['slug']), 15);
                    }

                    return strncmp(strtolower($a), strtolower($b), 15);
                });
            }
        }

        // random use case, should be refactored at some point
        if (!empty($availableFields['difficulty']) && count(
                array_diff($availableFields['difficulty'], [
                    'Beginner',
                    'Intermediate',
                    'Advanced',
                    'All',
                ])
            ) == 0) {
            $availableFields['difficulty'] = [
                'Beginner',
                'Intermediate',
                'Advanced',
                'All',
            ];
        }

        // random use case, should be refactored at some point
        if (!empty($availableFields['difficulty']) && count(
                array_diff(
                    [
                        '2',
                        '3',
                        '4',
                        'All',
                    ],
                    $availableFields['difficulty']
                )
            ) <= 1) {
            sort($availableFields['difficulty'], SORT_NUMERIC);
        }

        return $availableFields;
    }

    public function softDelete(array $contentIds)
    {
        return $this->query()
            ->whereIn('id', $contentIds)
            ->update(['status' => ContentService::STATUS_DELETED]);
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
                ->addSelect([
                                ConfigService::$tableContent.'.id as id',
                            ]);

        $rows =
            $query->restrictByUserAccess()
                ->join(ConfigService::$tableContentFields, function (JoinClause $joinClause) use (
                    $contentFieldKey,
                    $contentFieldValues
                ) {
                    $joinClause->on(
                        ConfigService::$tableContentFields.'.content_id',
                        '=',
                        ConfigService::$tableContent.'.id'
                    )
                        ->where(
                            ConfigService::$tableContentFields.'.key',
                            '=',
                            $contentFieldKey
                        );
                    if (!empty($contentFieldValues)) {
                        $joinClause->whereIn(
                            ConfigService::$tableContentFields.'.value',
                            $contentFieldValues
                        );
                    }
                })
                ->whereIn(ConfigService::$tableContent.'.type', $contentTypes)
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
                ->whereBetween(ConfigService::$tableContent.'.published_on', [
                    $startDate,
                    Carbon::now()
                        ->toDateTimeString(),
                ])
                ->whereNull('user_id')
                ->getToArray();

        return $contentRows;
    }

    /**
     * @param array $type
     * @param $groupBy
     * @return Collection
     */
    public function countByTypes(array $type, $groupBy)
    {
        $query =
            $this->query()
                ->select('type', DB::raw('count(*) as total'))
                ->restrictByUserAccess()
                ->whereIn(ConfigService::$tableContent.'.type', $type);

        if (!empty($groupBy)) {
            $query->groupBy($groupBy);
        }

        return $query->get()
            ->keyBy('type');
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
                    ConfigService::$tableUserContentProgress.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->leftJoin(
                    ConfigService::$tableContentFields,
                    ConfigService::$tableContentFields.'.content_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->where(ConfigService::$tableUserContentProgress.'.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress.'.state', $state)
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
                    ConfigService::$tableContentHierarchy.'.parent_id',
                    '=',
                    ConfigService::$tableContent.'.id'
                )
                ->where(ConfigService::$tableContentHierarchy.'.child_id', $childId)
                ->selectInheritenceColumns()
                ->getToArray();

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
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

    public function getRequiredFields()
    {
        return $this->requiredFields;
    }

    public function getIncludedFields()
    {
        return $this->includedFields;
    }

    /**
     * @param $contentRows
     * @return array
     */
    public function getFieldsByContentIds($contentRows)
    {
        $instructors =
            $this->query()
                ->select([
                             config('railcontent.table_prefix').'content_instructors'.'.instructor_id as field_value',
                             config('railcontent.table_prefix').'content'.'.id',
                         ])
                ->join(
                    config('railcontent.table_prefix').'content_instructors',
                    config('railcontent.table_prefix').'content'.'.id',
                    '=',
                    config('railcontent.table_prefix').'content_instructors'.'.content_id'
                )
                ->whereIn(
                    config('railcontent.table_prefix').'content'.'.id',
                    array_column($contentRows, 'id')
                )
                ->get()
                ->groupBy('id')
                ->toArray();

        $styles =
            $this->query()
                ->select([
                             config('railcontent.table_prefix').'content_styles'.'.style as field_value',
                             config('railcontent.table_prefix').'content'.'.id',
                         ])
                ->join(
                    config('railcontent.table_prefix').'content_styles',
                    config('railcontent.table_prefix').'content'.'.id',
                    '=',
                    config('railcontent.table_prefix').'content_styles'.'.content_id'
                )
                ->whereIn(
                    config('railcontent.table_prefix').'content'.'.id',
                    array_column($contentRows, 'id')
                )
                ->get()
                ->groupBy('id')
                ->toArray();

        $bpm =
            $this->query()
                ->select([
                             config('railcontent.table_prefix').'content_bpm'.'.bpm as field_value',
                             config('railcontent.table_prefix').'content'.'.id',
                         ])
                ->join(
                    config('railcontent.table_prefix').'content_bpm',
                    config('railcontent.table_prefix').'content'.'.id',
                    '=',
                    config('railcontent.table_prefix').'content_bpm'.'.content_id'
                )
                ->whereIn(
                    config('railcontent.table_prefix').'content'.'.id',
                    array_column($contentRows, 'id')
                )
                ->get()
                ->groupBy('id')
                ->toArray();

        $topics =
            $this->query()
                ->select([
                             config('railcontent.table_prefix').'content_topics'.'.topic as field_value',
                             config('railcontent.table_prefix').'content'.'.id',
                         ])
                ->join(
                    config('railcontent.table_prefix').'content_topics',
                    config('railcontent.table_prefix').'content'.'.id',
                    '=',
                    config('railcontent.table_prefix').'content_topics'.'.content_id'
                )
                ->whereIn(
                    config('railcontent.table_prefix').'content'.'.id',
                    array_column($contentRows, 'id')
                )
                ->get()
                ->groupBy('id')
                ->toArray();

        $contentColumnNames = [
            'difficulty',
            'home_staff_pick_rating',
            'legacy_id',
            'legacy_wordpress_post_id',
            //            'qna_video',
            'title',
            'xp',
            'album',
            'artist',
            'bpm',
            'cd-tracks',
            'chord_or_scale',
            'difficulty_range',
            'episode_number',
            'exercise-book-pages',
            'fast_bpm',
            'includes_song',
            'live_event_start_time',
            'live_event_end_time',
            'live_event_youtube_id',
            'live_stream_feed_type',
            'name',
            'released',
            'slow_bpm',
            'transcriber_name',
            'week',
            'avatar_url',
            'length_in_seconds',
            'soundslice_slug',
            'staff_pick_rating',
            'student_id',
                        'vimeo_video_id',
                        'youtube_video_id',
            'show_in_new_feed',
            'bands',
            'endorsements',
            'focus',
            'forum_thread_id',
            'is_active',
            'is_coach',
            'is_house_coach',
            'is_coach_of_the_month',
            'is_featured',
            'associated_user_id',
            'high_soundslice_slug',
            'low_soundslice_slug',
            //            'high_video',
            //            'low_video',
            //            'original_video',
            'pdf',
            'pdf_in_g',
            'sbt_bpm',
            'sbt_exercise_number',
            'song_name',
            'soundslice_xml_file_url',
        ];
        $fields = [];

        foreach ($contentRows as $contentRow) {
            $fields[$contentRow['id']] = [];
            foreach ($contentColumnNames as $column) {
                if(isset($contentRow[$column])) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => $column,
                        "value" => $contentRow[$column] ?? '',
                        "type" => "integer",
                        "position" => 1,
                    ];
                }
            }
            if (array_key_exists($contentRow['id'], $instructors)) {
                foreach ($instructors[$contentRow['id']] as $index=>$instructor) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'instructor',
                        "value" => $instructor['field_value'] ?? '',
                        "type" => "content_id",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $styles)) {
                foreach ($styles[$contentRow['id']] as $index=>$style) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'style',
                        "value" => $style['field_value'] ?? '',
                        "type" => "string",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $bpm)) {
                foreach ($bpm[$contentRow['id']] as $index=>$bpmRow) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'bpm',
                        "value" => $bpmRow['field_value'] ?? '',
                        "type" => "integer",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $topics)) {
                foreach ($topics[$contentRow['id']] as $index=>$topic) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'topic',
                        "value" => $topic['field_value'] ?? '',
                        "type" => "integer",
                        "position" => $index,
                    ];
                }
            }

            if($contentRow['video']){
                $fields[$contentRow['id']][] = [
                    "content_id" => $contentRow['id'],
                    "key" => 'video',
                    "value" => $contentRow['video'],
                    "type" => "content_id",
                    "position" => 1,
                ];
            }
        }

        return $fields;
    }
}
