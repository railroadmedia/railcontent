<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\ContentCompiledColumnTransformer;
use Railroad\Railcontent\Transformers\ContentTransformer;
use Railroad\Railcontent\Transformers\VideoTransformer;

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

    public static $catalogMetaAllowableFilters = null;
    public static $pullFilterResultsOptionsAndCount = true;
    public static $countFilterOptionItems = false;

    public static $includedInPlaylistsIds = false;

    private $requiredFields = [];
    private $includedFields = [];

    private $requiredUserStates = [];
    private $includedUserStates = [];

    public static $getFutureContentOnly = false;
    public static $getFollowedContentOnly = false;
    public static $getFutureScheduledContentOnly = false;

    private $page;
    private $limit;
    private $orderBy;
    private $orderDirection;
    private $typesToInclude = [];
    private $slugHierarchy = [];
    private $requiredParentIds = [];

    private $groupByFields = false;

    private ContentCompiledColumnTransformer $contentCompiledColumnTransformer;

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
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;
    /**
     * @var ContentStyleRepository
     */
    private $contentStyleRepository;

    /**
     * @var ContentBpmRepository
     */
    private $contentBpmRepository;

    const TABLESFORFIELDS = [
        'instructor' => [
            'table' => 'railcontent_content_instructors',
            'column' => 'instructor_id',
            'alias' => '_rci',
        ],
        'style' => [
            'table' => 'railcontent_content_styles',
            'column' => 'style',
            'alias' => '_rcs',
        ],
        'topic' => [
            'table' => 'railcontent_content_topics',
            'column' => 'topic',
            'alias' => '_rct',
        ],
        'focus' => [
            'table' => 'railcontent_content_focus',
            'column' => 'focus',
            'alias' => '_rcf',
        ],
        'bpm' => [
            'table' => 'railcontent_content_bpm',
            'column' => 'bpm',
            'alias' => '_rcb',
        ],
    ];

    /**
     * @param ContentPermissionRepository $contentPermissionRepository
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param ContentInstructorRepository $contentInstructorRepository
     * @param ContentStyleRepository $contentStyleRepository
     * @param ContentBpmRepository $contentBpmRepository
     */
    public function __construct(
        ContentPermissionRepository $contentPermissionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository,
        ContentHierarchyRepository $contentHierarchyRepository,
        ContentInstructorRepository $contentInstructorRepository,
        ContentStyleRepository $contentStyleRepository,
        ContentBpmRepository $contentBpmRepository,
        ContentCompiledColumnTransformer $contentCompiledColumnTransformer
    ) {
        parent::__construct();

        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
        $this->contentInstructorRepository = $contentInstructorRepository;
        $this->contentStyleRepository = $contentStyleRepository;
        $this->contentBpmRepository = $contentBpmRepository;
        $this->contentCompiledColumnTransformer = $contentCompiledColumnTransformer;
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

        $data = $contentRows[0] ?? null;

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($data)) {
            $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
                array_column($contentRows, 'id'),
                array_column($contentRows, 'type')
            );
            $contentRows[0]['permissions'] = $contentPermissionRows;
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows))[0] ?? null;
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($data);
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
                ->distinct()
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
    }

    /**
     * @param $parentId
     * @return array
     */
    public function getByParentId($parentId, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $contentRows =
            $this->query()
                ->distinct()
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $extraData = $this->geExtraDataInOldStyle(['data', 'instructor', 'video'], $contentRows);

        $parser = $this->setPresenter(ContentTransformer::class);
        $parser->presenter->addParam($extraData);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
                    ConfigService::$tableContentHierarchy . '.parent_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->whereIn(ConfigService::$tableContentHierarchy . '.child_id', $childIds)
                ->where(ConfigService::$tableContent . '.type', $type)
                ->selectInheritenceColumns()
                ->getToArray(['id', 'slug', 'child_ids']);

        $this->setPresenter(ContentTransformer::class);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
                ->havingRaw(
                    ConfigService::$tableContent . ".type IN (" . implode(
                        ",",
                        array_fill(0, count([$type]), "?")
                    ) . ")",
                    [$type]
                )
                ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress . '.state', $state)
                ->orderBy('published_on', 'desc')
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
                ->havingRaw(
                    ConfigService::$tableContent . ".type IN (" . implode(",", array_fill(0, count($types), "?")) . ")",
                    $types
                )
                ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
                ->where(ConfigService::$tableUserContentProgress . '.state', $state)
                ->groupBy('updated_on', ConfigService::$tableUserContentProgress . '.id')
                ->orderBy('updated_on', 'desc', ConfigService::$tableUserContentProgress)
                ->limit($limit)
                ->skip($skip)
                ->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
     * @param int $contentId
     * @param string $operator
     * @param string $direction
     * @param int $limit
     * @return array
     */
    private function getSubqueryForNeighbouringSiblings(
        $type,
        $columnName,
        $columnValue,
        $orderColumn,
        $contentId,
        $operator,
        $direction,
        $limit
    )
    {
        $subquery['subqueryOne'] = $this
            ->query()
            ->selectRaw(
                DB::raw(
                    'ROW_NUMBER() OVER (order by railcontent_content.' . $orderColumn . ' ' . $direction . ', railcontent_content.id ' . $direction . ') AS rowNumber'
                )
            )
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->where(ConfigService::$tableContent . '.type', $type)
            ->where(ConfigService::$tableContent . '.' . $columnName, $operator, $columnValue)
            ->limit($limit);

        $subquery['subqueryTwo'] = $this->query()
            ->selectRaw(DB::raw('rowNumber'))
            ->fromSub($subquery['subqueryOne'], 'sub')
            ->where('id', $contentId)
            ->get()
            ->value('rowNumber');

        return $subquery;
    }


    /**
     * @param int $id
     * @param string $type
     * @param string $columnName
     * @param string $columnValue
     * @param int $siblingPairLimit
     * @param string $orderColumn
     * @param string $orderDirection
     * @param int $contentId
     * @return array
     */
    public function getTypeNeighbouringSiblings(
        $type,
        $columnName,
        $columnValue,
        $siblingPairLimit = 1,
        $orderColumn = 'published_on',
        $orderDirection = 'desc',
        $contentId = null
    ) {
        if ($contentId) {

            $beforeSubquery = $this->getSubqueryForNeighbouringSiblings($type, $columnName, $columnValue,
                $orderColumn, $contentId, '<=', 'desc', 10);

            if (!$beforeSubquery['subqueryTwo']) {
                $beforeSubquery = $this->getSubqueryForNeighbouringSiblings($type, $columnName, $columnValue,
                    $orderColumn, $contentId, '<=', 'desc', 200);
            }

            $beforeContents =
                $this->query()
                    ->select('*')
                    ->fromSub($beforeSubquery['subqueryOne'], 'sub')
                    ->where('rowNumber', '>', $beforeSubquery['subqueryTwo'])
                    ->limit($siblingPairLimit)
                    ->getToArray();

            $afterSubquery = $this->getSubqueryForNeighbouringSiblings($type, $columnName, $columnValue,
                $orderColumn, $contentId, '>=', 'asc', 10);
            if (!$afterSubquery['subqueryTwo']) {
                $afterSubquery = $this->getSubqueryForNeighbouringSiblings($type, $columnName, $columnValue,
                    $orderColumn, $contentId, '>=', 'asc', 200);
            }

            if ($afterSubquery['subqueryTwo']) {
                $afterContents =
                    $this->query()
                        ->select('*')
                        ->fromSub($afterSubquery['subqueryOne'], 'sub')
                        ->where('rowNumber', '>', $afterSubquery['subqueryTwo'])
                        ->limit($siblingPairLimit)
                        ->getToArray();
            } else {
                $afterContents = [];
            }
        } else {
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
        }

        $merged = array_merge($beforeContents, $afterContents);

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($merged)) {
            $processedContents = $this->contentCompiledColumnTransformer->transform(Arr::wrap($merged)) ?? [];
        } else {
            $this->configurePresenterForResults($merged);
            $processedContents = $this->parserResult($merged);
        }

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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
    }

    /**
     * @param string $slug
     * @param string $type
     * @return array|null
     */
    public function getBySlugAndTypeAndBrand($slug, $type, $brand)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where('slug', $slug)
                ->where(ConfigService::$tableContent . '.brand', $brand)
                ->where('type', $type)
                ->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
                })
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->where(ConfigService::$tableContent . '.status', $status)
                ->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $contentFieldRows = $this->getFieldsByContentIds($contentRows);
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($contentRows, 'id'));

        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
            array_column($contentRows, 'id'),
            array_column($contentRows, 'type')
        );

        return array_values(
            $this->processRows(
                $contentRows,
                $contentFieldRows,
                $contentDatumRows,
                $contentPermissionRows
            )
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
     * @param integer $limit
     * @return array
     */
    public function getWhereTypeInAndStatusAndPublishedOnOrdered(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'published_on',
        $orderByDirection = 'desc',
        $requiredField = [],
        $limit = null
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
                ->distinct()
                ->orderBy($orderByColumn, $orderByDirection);

        if (!empty($limit)) {
            $contentRows->limit($limit);
        }

        if (!empty($requiredField)) {
            if (in_array($requiredField['key'], config('railcontent.contentColumnNamesForFields'))) {
                $contentRows->where(
                    ConfigService::$tableContent . '.' . $requiredField['key'],
                    $requiredField['value']
                );
            } else {
                $column = ($requiredField['key'] == 'instructor') ? 'instructor_id' : $requiredField['key'];
                $table = config('railcontent.table_prefix') . 'content_' . $requiredField['key'] . 's';
            }
            $contentRows->join($table, function (JoinClause $joinClause) use (
                $requiredField,
                $table,
                $column
            ) {
                $joinClause->on(
                    $table . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                    ->whereIn(
                        $table . '.' . $column,
                        $requiredField['value']
                    );
            })
                ->groupBy('railcontent_content.id');
        }

        $contentRows = $contentRows->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
            $contents[$contentRow['id']]['content_id'] = $contentRow['content_id'] ?? null;
            $contents[$contentRow['id']]['popularity'] = $contentRow['popularity'];
            $contents[$contentRow['id']]['difficulty'] = $contentRow['difficulty'];
            $contents[$contentRow['id']]['title'] = $contentRow['title'];
            $contents[$contentRow['id']]['video'] = $contentRow['video'];
            $contents[$contentRow['id']]['vimeo_video_id'] = $contentRow['vimeo_video_id'];
            $contents[$contentRow['id']]['youtube_video_id'] = $contentRow['youtube_video_id'];
            $contents[$contentRow['id']]['name'] = $contentRow['name'];
            $contents[$contentRow['id']]['slug'] = $contentRow['slug'];
            $contents[$contentRow['id']]['type'] = $contentRow['type'];
            $contents[$contentRow['id']]['sort'] = $contentRow['sort'];
            $contents[$contentRow['id']]['status'] = $contentRow['status'];
            $contents[$contentRow['id']]['language'] = $contentRow['language'];
            $contents[$contentRow['id']]['brand'] = $contentRow['brand'];
            $contents[$contentRow['id']]['total_xp'] = $contentRow['total_xp'];
//            $contents[$contentRow['id']]['instrumentless'] = $contentRow['instrumentless'];
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

        return $contents;
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
        $getFollowedContentOnly = false,
        $getFutureScheduledContentOnly = false
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
        self::$getFutureScheduledContentOnly = $getFutureScheduledContentOnly;

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
        if ($this->groupByFields) {
            $subQuery =
                $this->query()
                    ->restrictByTypes($this->typesToInclude)
                    ->restrictByUserAccess()
                    ->restrictByFields($this->requiredFields)
                    ->includeByFields($this->includedFields)
                    ->restrictByUserStates($this->requiredUserStates)
                    ->directPaginate($this->page, $this->limit)
                    ->groupByField($this->groupByFields);
            $query = $subQuery;

            if ($this->groupByFields['is_a_related_content']) {
                $query =
                    $this->query()
                        ->selectPrimaryColumns()
                        ->addSelect('inner_content.lessons_grouped_by_field as lessons_grouped_by_field')
                        ->addSubJoinToQuery($subQuery);
                //        ->orderBy('slug', 'asc');  causes out of memory issue, need to improve query performance before enabling
                $contentRows = $query->getToArray();

                $contentRows = $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];

                $contentRows = $this->contentCompiledColumnTransformer->transformLessons($contentRows) ?? [];

                return $contentRows;
            }
            $contentRows = $query->getToArray();

            return $this->contentCompiledColumnTransformer->transformLessons($contentRows) ?? [];
        }

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
                ->order($this->orderBy, $this->orderDirection);

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

        // if there are no join we don't need group by
        if (empty($subQuery->joins)) {
            $subQuery->groups = null;
        }

        $query =
            $this->query()
                ->selectPrimaryColumns()
                ->addSubJoinToQuery($subQuery);

        $contentRows = $query->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        if ($this->groupByFields) {
            $subQuery =
                $this->query()
                    ->restrictByTypes($this->typesToInclude)
                    ->restrictByUserAccess()
                    ->restrictByFields($this->requiredFields)
                    ->includeByFields($this->includedFields)
                    ->restrictByUserStates($this->requiredUserStates)
                    ->groupByField($this->groupByFields);

            return $this->connection()
                ->table(
                    $this->databaseManager->raw('(' . $subQuery->toSql() . ') as results')
                )
                ->addBinding($subQuery->getBindings())
                ->count();
        }

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

        if (self::$getFollowedContentOnly) {
            $subQuery->restrictFollowedContent();
        }

        return $this->connection()
            ->table(
                $this->databaseManager->raw('(' . $subQuery->toSql() . ') as results')
            )
            ->addBinding($subQuery->getBindings())
            ->count();
    }

    /**
     * @return array
     */
    public function getFilterFields()
    {
        $query =   $this->query()
                ->selectFilterOptionColumns()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictByParentIds($this->requiredParentIds);

        if (self::$getFollowedContentOnly) {
            $query->restrictFollowedContent();
        }

//        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData) {
//
//            return $this->getFilterOptionsFromCompiledColumn($query);
//        }

        $possibleContentFields = $this->getFilterOptionsForQuery($query);
        if(self::$countFilterOptionItems) {
            $includedFields = collect($this->includedFields);
            $selectedFilterCategories = $includedFields->pluck('name');
            $initialFilters = $this->includedFields;

            $myResults = [];
            foreach ($selectedFilterCategories as $category)
            {
                if(isset($possibleContentFields[$category])){
                    $otherCategories = $includedFields->where('name', '!=', $category);
                    $this->includedFields = $otherCategories->values()->toArray();
                    $allQuery =
                        $this->query()
                            ->selectFilterOptionColumns()
                            ->restrictByUserAccess()
                            ->restrictByFields($this->requiredFields)
                            ->includeByFields($this->includedFields)
                            ->restrictByUserStates($this->requiredUserStates)
                            ->includeByUserStates($this->includedUserStates)
                            ->restrictByTypes($this->typesToInclude)
                            ->restrictByParentIds($this->requiredParentIds);
                    $possibleContentFields2 = $this->getFilterOptionsForQueryVersion2($allQuery);
                    $myResults[$category]= $possibleContentFields2[$category];
                    $this->includedFields = $initialFilters;
                }
            }

            foreach ($possibleContentFields as $possibleContentFieldKey => $possibleContentFieldValue){
                if(isset($myResults[$possibleContentFieldKey])){
                    $possibleContentFields[$possibleContentFieldKey] = $myResults[$possibleContentFieldKey];
                }
            }
}

        return $possibleContentFields;
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
        $value = Arr::first(explode(' (',$value));
        $this->requiredFields[] =
            [
                'name' => $name,
                'value' => $value,
                'type' => $type,
                'operator' => $operator,
                'field' => $field,
                'associated_table' => self::TABLESFORFIELDS[$name] ?? [],
                'is_content_column' => in_array(
                    $name,
                    config('railcontent.content_fields_that_are_now_columns_in_the_content_table', [])
                )
            ];

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
        $value = Arr::first(explode(' (',$value));

        $this->includedFields[] = [
            'name' => $name,
            'value' => $value,
            'type' => $type,
            'operator' => $operator,
            'associated_table' => self::TABLESFORFIELDS[$name] ?? [],
            'is_content_column' => in_array(
                $name,
                config('railcontent.content_fields_that_are_now_columns_in_the_content_table', [])
            )
        ];

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
     * @param $field
     * @return $this
     */
    public function groupByField($field)
    {
        $groupByFields = [
            'field' => $field,
            'associated_table' => self::TABLESFORFIELDS[$field] ?? [],
            'is_content_column' => in_array(
                    $field,
                    config('railcontent.content_fields_that_are_now_columns_in_the_content_table', [])
                ) && ($field != 'length_in_seconds'),
            'is_a_related_content' => $field == 'instructor',
        ];
        $this->groupByFields = ($groupByFields['is_content_column'] || !empty($groupByFields['associated_table']))?$groupByFields:null;
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

    private function parseAvailableFields($contentRows)
    {
        $contentRows = array_map("unserialize", array_unique(array_map("serialize", $contentRows)));

        $availableFields = [];

        foreach ($contentRows as $contentRow) {
            foreach ($contentRow['fields'] as $row) {
                $availableFields['content_type'][] = $contentRow['type'];
                if ($row['type'] == 'content') {
                    $availableFields[$row['key']][$row['value']['id']] = $row['value'];
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
                    ConfigService::$tableContent . '.id as id',
                ]);

        $rows =
            $query->restrictByUserAccess()
                ->join(ConfigService::$tableContentFields, function (JoinClause $joinClause) use (
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
                })
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
                ->whereBetween(ConfigService::$tableContent . '.published_on', [
                    $startDate,
                    Carbon::now()
                        ->toDateTimeString(),
                ])
                ->whereNull('user_id')
                ->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

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
                ->whereIn(ConfigService::$tableContent . '.type', $type);

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

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
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
     * @param $contentIds
     * @return array
     */
    public function getInstructorsForContents($contentIds)
    {
        $instructors =
            $this->query()
                ->select([
                    config('railcontent.table_prefix') . 'content_instructors' . '.content_id',
                    config('railcontent.table_prefix') . 'content_instructors' . '.instructor_id as field_value',
                    config('railcontent.table_prefix') . 'content' . '.*',
                ])
                ->leftJoin(
                    config('railcontent.table_prefix') . 'content_instructors',
                    config('railcontent.table_prefix') . 'content' . '.id',
                    '=',
                    config('railcontent.table_prefix') . 'content_instructors' . '.instructor_id'
                )
                ->join(
                    config('railcontent.table_prefix') . 'content as co',
                    config('railcontent.table_prefix') . 'content_instructors' . '.content_id',
                    '=',
                    'co.id'
                )
                ->whereIn(
                    config('railcontent.table_prefix') . 'content_instructors' . '.content_id',
                    $contentIds
                )
                ->get()
                ->toArray();

        $contentFieldRows = $this->getFieldsByContentIds(array_values($instructors), true);
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($instructors, 'id'));
        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
            array_column($instructors, 'id'),
            array_column($instructors, 'type')
        );

        $instructorRows = $this->processRows(
            $instructors,
            $contentFieldRows,
            $contentDatumRows,
            $contentPermissionRows
        );


        $results = [];
        foreach ($instructors as $instructor) {
            $results[$instructor['content_id']][] = $instructorRows[$instructor['field_value']];
        }

        return $results;
    }

    /**
     * @param $contentIds
     * @return array
     */
    public function getVideoForContents($contentIds)
    {
        $videos =
            $this->query()
                ->select([
                    'video' . '.*',
                    config('railcontent.table_prefix') . 'content.id as content_id',
                ])
                ->leftJoin(
                    config('railcontent.table_prefix') . 'content as video',
                    config('railcontent.table_prefix') . 'content' . '.video',
                    '=',
                    'video.id'
                )
                ->whereIn(
                    config('railcontent.table_prefix') . 'content' . '.id',
                    $contentIds
                )
                ->get()
                ->toArray();

        if (empty($videos)) {
            return [];
        }

        $contentFieldRows = $this->getFieldsByContentIds(array_values($videos), true);
        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($videos, 'id'));
        $contentPermissionRows = $this->contentPermissionRepository->getByContentIdsOrTypes(
            array_column($videos, 'id'),
            array_column($videos, 'type')
        );

        $videoRows = array_values(
            $this->processRows(
                $videos,
                $contentFieldRows,
                $contentDatumRows,
                $contentPermissionRows
            )
        );

        $results = [];
        foreach ($videoRows as $video) {
            $results[$video['content_id']][] = $video;
        }

        return $results;
    }

    /**
     * @param $contentRows
     * @param false $withoutAssociatedJoin
     * @return array
     */
    public function getFieldsByContentIds($contentRows, $withoutAssociatedJoin = false)
    {
        $instructors = [];
        $styles = [];
        $bpm = [];
        $topics = [];
        $videos = [];
        $tags = [];

        if (!$withoutAssociatedJoin) {
            $videos = $this->getVideoForContents(array_column($contentRows, 'id'));
            $instructors = $this->getInstructorsForContents(array_column($contentRows, 'id'));

            $styles =
                $this->query()
                    ->select([
                        config('railcontent.table_prefix') . 'content_styles' . '.style as field_value',
                        config('railcontent.table_prefix') . 'content' . '.id',
                    ])
                    ->join(
                        config('railcontent.table_prefix') . 'content_styles',
                        config('railcontent.table_prefix') . 'content' . '.id',
                        '=',
                        config('railcontent.table_prefix') . 'content_styles' . '.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix') . 'content' . '.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();

            $bpm =
                $this->query()
                    ->select([
                        config('railcontent.table_prefix') . 'content_bpm' . '.bpm as field_value',
                        config('railcontent.table_prefix') . 'content' . '.id',
                    ])
                    ->join(
                        config('railcontent.table_prefix') . 'content_bpm',
                        config('railcontent.table_prefix') . 'content' . '.id',
                        '=',
                        config('railcontent.table_prefix') . 'content_bpm' . '.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix') . 'content' . '.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();

            $topics =
                $this->query()
                    ->select([
                        config('railcontent.table_prefix') . 'content_topics' . '.topic as field_value',
                        config('railcontent.table_prefix') . 'content' . '.id',
                    ])
                    ->join(
                        config('railcontent.table_prefix') . 'content_topics',
                        config('railcontent.table_prefix') . 'content' . '.id',
                        '=',
                        config('railcontent.table_prefix') . 'content_topics' . '.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix') . 'content' . '.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();

            $tags =
                $this->query()
                    ->select([
                        config('railcontent.table_prefix') . 'content_tags' . '.tag as field_value',
                        config('railcontent.table_prefix') . 'content' . '.id',
                    ])
                    ->join(
                        config('railcontent.table_prefix') . 'content_tags',
                        config('railcontent.table_prefix') . 'content' . '.id',
                        '=',
                        config('railcontent.table_prefix') . 'content_tags' . '.content_id'
                    )
                    ->whereIn(
                        config('railcontent.table_prefix') . 'content' . '.id',
                        array_column($contentRows, 'id')
                    )
                    ->get()
                    ->groupBy('id')
                    ->toArray();
        }

        $fieldsColumns = config('railcontent.contentColumnNamesForFields', []);

        $fields = [];

        foreach ($contentRows as $contentRow) {
            $fields[$contentRow['id']] = [];

            foreach ($fieldsColumns as $column) {
                if ($column != 'video') {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => $column,
                        "value" => $contentRow[$column] ?? '',
                        "type" => "string",
                        "position" => 1,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $instructors)) {
                foreach ($instructors[$contentRow['id']] as $index => $instructor) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'instructor',
                        "value" => $instructor,
                        "type" => "content",
                        "position" => $index,
                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $styles)) {
                foreach ($styles[$contentRow['id']] as $index => $style) {
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
                foreach ($bpm[$contentRow['id']] as $index => $bpmRow) {
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
                foreach ($topics[$contentRow['id']] as $index => $topic) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'topic',
                        "value" => $topic['field_value'] ?? '',
                        "type" => "integer",
                        "position" => $index,

                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $tags)) {
                foreach ($tags[$contentRow['id']] as $index => $tag) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'tag',
                        "value" => $tag['field_value'] ?? '',
                        "type" => "string",
                        "position" => $index,

                    ];
                }
            }

            if (array_key_exists($contentRow['id'], $videos)) {
                foreach ($videos[$contentRow['id']] as $index => $video) {
                    $fields[$contentRow['id']][] = [
                        "content_id" => $contentRow['id'],
                        "key" => 'video',
                        "value" => $video,
                        "type" => "content",
                        "position" => $index,
                    ];
                }
            }
        }

        return $fields;
    }

    public function getVideoByContentIds($contentIds)
    {
        $data =
            $this->query()
                ->select(config('railcontent.table_prefix') . 'content.id as content_id', 'videoRow.*')
                ->join(
                    config('railcontent.table_prefix') . 'content as videoRow',
                    config('railcontent.table_prefix') . 'content.video',
                    '=',
                    'videoRow.id'
                )
                ->whereIn(config('railcontent.table_prefix') . 'content.id', $contentIds)
                ->get()
                ->toArray();

        $parser = $this->setPresenter(VideoTransformer::class);

        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($data, 'id'));

        $parser->presenter->addParam(['data' => ContentHelper::groupArrayBy($contentDatumRows, 'content_id')]);

        return $this->parserResult($data);
    }

    /**
     * @param integer $id
     * @return array|null
     */
    public function getElasticContentById($id)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->where([ConfigService::$tableContent . '.id' => $id])
                ->getToArray();

        if (empty($contentRows)) {
            return null;
        }

        $data = $contentRows[0] ?? null;

        return $data;
    }

    /**
     * @param $contentRows
     * @return void
     */
    private function configurePresenterForResults($contentRows)
    {
        $this->setPresenter(ContentTransformer::class);

        $filterOptions = ['data'];

        if (self::$pullFilterResultsOptionsAndCount) {
            $filterOptions = self::$catalogMetaAllowableFilters ?? [
                'data',
                'instructor',
                'style',
                'topic',
                'focus',
                'bpm',
                'video',
                'original_video',
                'high_video',
                'low_video'
            ];
        }

        // we always need the related data
        if (!in_array('data', $filterOptions)) {
            $filterOptions[] = 'data';
        }

        $extraData = $this->geExtraDataInOldStyle($filterOptions, $contentRows);

        $this->presenter->addParam($extraData);
    }

    /**
     * Return format:
     * [
     *     'filter_name' => ['value1', 'value2',...],
     * ]
     *
     * @param ContentQueryBuilder $contentQueryBuilder
     * @return array
     */
    private function getFilterOptionsForQuery(ContentQueryBuilder $contentQueryBuilder)
    {
        $filterOptionsArray = [];

        $joinTablesQuery = clone($contentQueryBuilder);
        $contentTableQuery = clone($contentQueryBuilder);

        $joinTablesQuery->select([]);

        // get values that are in other tables
        $filterNameToTableNameAndColumnName = [
            'instructor' => [
                'table' => 'railcontent_content_instructors',
                'column' => 'instructor_id',
                'alias' => '_rci'
            ],
            'style' => ['table' => 'railcontent_content_styles', 'column' => 'style', 'alias' => '_rcs'],
            'topic' => ['table' => 'railcontent_content_topics', 'column' => 'topic', 'alias' => '_rct'],
            'focus' => ['table' => 'railcontent_content_focus', 'column' => 'focus', 'alias' => '_rcf'],
            'bpm' => ['table' => 'railcontent_content_bpm', 'column' => 'bpm', 'alias' => '_rcb'],
            'essentials' => ['table' => 'railcontent_content_essentials', 'column' => 'essentials', 'alias' => '_rce'],
            'theory' => ['table' => 'railcontent_content_theory', 'column' => 'theory', 'alias' => '_rct'],
            'creativity' => ['table' => 'railcontent_content_creativity', 'column' => 'creativity', 'alias' => '_rcc'],
            'lifestyle' => ['table' => 'railcontent_content_lifestyle', 'column' => 'lifestyle', 'alias' => '_rcl'],
        ];

        $filterOptions = self::$catalogMetaAllowableFilters ?? [
                'data',
                'instructor',
                'style',
                'topic',
                'focus',
                'bpm',
            ];

        // we always need the related data
        if (!in_array('data', $filterOptions)) {
            $filterOptions[] = 'data';
        }

        $filterOptions = array_unique($filterOptions);

        foreach ($filterOptions as $filterOption) {
            $filterOptionTableName = $filterNameToTableNameAndColumnName[$filterOption]['table'] ?? null;
            $filterOptionTableAliasName = $filterNameToTableNameAndColumnName[$filterOption]['alias'] ?? null;
            $filterOptionColumnName = $filterNameToTableNameAndColumnName[$filterOption]['column'] ?? null;

            if (empty($filterOptionTableName) || empty($filterOptionColumnName)) {
                continue;
            }

            $hasJoinAlready = false;

            if (!empty($joinTablesQuery->joins)) {
                foreach ($joinTablesQuery->joins as $existingJoin) {
                    /**
                     * @var $existingJoin JoinClause
                     */
                    if ($existingJoin->table == $filterOptionTableName . ' as ' . $filterOptionTableAliasName) {
                        $hasJoinAlready = true;
                    }
                }
            }

            if (!$hasJoinAlready) {
                $joinTablesQuery->leftJoin(
                    $filterOptionTableName . ' as ' . $filterOptionTableAliasName,
                    $filterOptionTableAliasName . '.content_id',
                    '=',
                    'railcontent_content.id'
                );
            }

            $joinTablesQuery->addSelect(
                [$filterOptionTableAliasName . '.' . $filterOptionColumnName . ' as ' . $filterOptionColumnName]
            );

            $groupBy[] = $filterOptionColumnName;

            $filterOptionsArray[$filterOptionColumnName] = [];
        }

        $countingQuery = clone($joinTablesQuery);

        if (!empty($groupBy)) {
            $joinTablesQuery->groupBy($groupBy);
        } else {
            $joinTablesQuery->select(['railcontent_content.id']);
        }

        $tableResults = $joinTablesQuery->get();
        $countingQueryResults = collect([]);
        if (self::$countFilterOptionItems) {
            $countingQuery->addSelect(
                ['railcontent_content.id']
            );
            $groupBy[] = 'id';
            $countingQuery->groupBy($groupBy);

            $countingQueryResults = $countingQuery->get();
        }

        $counts = [];
        foreach ($filterOptionsArray as $filterOptionName => $filterOptionValue) {
            $filterOptionsArray[$filterOptionName] = $tableResults->whereNotNull($filterOptionName)
                ->pluck($filterOptionName)
                ->unique()
                ->values()
                ->toArray();
            $counts[$filterOptionName] = $countingQueryResults->whereNotNull($filterOptionName)
                ->unique(function ($item) use($filterOptionName) {
                    return $item['id'].$item["$filterOptionName"];
                })
                ->pluck($filterOptionName)
                ->countBy()
                ->toArray();

            foreach ($filterOptionsArray[$filterOptionName] as $filterOptionIndexToClean => $filterOptionValueToClean) {
                $countingItems = '';
                if (self::$countFilterOptionItems) {
                    $nr = $counts[$filterOptionName][$filterOptionValueToClean];
                    $countingItems = ' ('.$nr.')';
                }
                $filterOptionsArray[$filterOptionName][$filterOptionIndexToClean] = ucwords(
                    trim(
                        $filterOptionValueToClean.$countingItems
                    )
                );
            }

            $filterOptionsArray[$filterOptionName] = array_unique($filterOptionsArray[$filterOptionName]);
            sort($filterOptionsArray[$filterOptionName]);
        }

        // todo: handle instructors which need to be pulled from matching content rows
        if (!empty($filterOptionsArray['instructor_id']) && in_array('instructor', $filterOptions)) {
            $instructorRows = $this->query()
                ->select(['railcontent_content.id as id', 'name', 'value as head_shot_picture_url'])
                ->leftJoin(
                    ConfigService::$tableContentData,
                    function (JoinClause $joinClause) {
                        $joinClause->on(
                            ConfigService::$tableContentData . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->where(
                                ConfigService::$tableContentData . '.id',
                                '=',
                                DB::raw(
                                    '(SELECT id FROM ' . ConfigService::$tableContentData . ' WHERE ' . ConfigService::$tableContentData . '.content_id = railcontent_content.id and railcontent_content_data.key = \'head_shot_picture_url\' LIMIT 1)'
                                )
                            );
                    }
                )
                ->whereIn('railcontent_content.id', $filterOptionsArray['instructor_id'])
                ->orderBy('name')
                ->get()
                ->toArray();

            foreach ($instructorRows as $instructorRowIndex => $instructorRow) {
                $instructorRows[$instructorRowIndex]["fields"][] = [
                    'id' => 1,
                    'key' => 'name',
                    'value' => $instructorRow["name"]
                ];
                $instructorRows[$instructorRowIndex]["data"][] = [
                    'id' => 1,
                    'key' => 'head_shot_picture_url',
                    'value' => $instructorRow["head_shot_picture_url"]
                ];
            }

            $filterOptionsArray['instructor'] = $instructorRows;
        }

        // todo: now to the right place
        $filterOptionNameToContentTableColumnName = [
            'difficulty' => ConfigService::$tableContent . '.difficulty',
            'difficulty_range' => ConfigService::$tableContent . '.difficulty_range',
            'artist' => ConfigService::$tableContent . '.artist',
            'type' => ConfigService::$tableContent . '.type',
            'instrument' => ConfigService::$tableContent . '.instrument',
            'content_id' => ConfigService::$tableContent . '.id',
        ];

        $contentTableQuery->addSelect(
            [ 'railcontent_content.id as id']
        );
        $contentTableQuery->groupBy($filterOptionNameToContentTableColumnName)
            ->select($filterOptionNameToContentTableColumnName);

        $tableResults = $contentTableQuery->get();

        foreach ($filterOptionNameToContentTableColumnName as $filterOptionName => $filterOptionValue) {
            $filterOptionsArray[$filterOptionName] = $tableResults->whereNotNull($filterOptionName)
                ->pluck($filterOptionName)
                ->unique()
                ->values()
                ->toArray();
            $counts[$filterOptionName] = $tableResults->whereNotNull($filterOptionName)
                ->unique(function ($item) use($filterOptionName) {
                    return $item['id'].$item["$filterOptionName"];
                })
                ->pluck($filterOptionName)
                ->countBy()
                ->toArray();
            foreach ($filterOptionsArray[$filterOptionName] as $filterOptionIndexToClean => $filterOptionValueToClean) {
                $countingItems = '';
                if (self::$countFilterOptionItems) {
                    $nr = $counts[$filterOptionName][$filterOptionValueToClean];
                    $countingItems = ' ('.$nr.')';
                }

                $filterOptionsArray[$filterOptionName][$filterOptionIndexToClean] = trim(
                    ucwords(
                        $filterOptionValueToClean.$countingItems
                    )
                );
            }

            $filterOptionsArray[$filterOptionName] = array_unique($filterOptionsArray[$filterOptionName]);
            usort($filterOptionsArray[$filterOptionName], [$this, 'sortByAlphaThenNumeric']);
        }

        return $filterOptionsArray;
    }

    private function getFilterOptionsFromCompiledColumn(ContentQueryBuilder $contentQueryBuilder)
    {
        $filterOptionsArray = [];

        $filterOptions = self::$catalogMetaAllowableFilters ?? [
            'instructor',
            'style',
            'topic',
            'focus',
            'bpm',
            'difficulty',
            'artist',
            'difficulty_range',
            'type',
            'instrument'
        ];

        $filterOptions = array_unique($filterOptions);

        foreach ($filterOptions as $filterOption) {
            $filterOptionsArray[$filterOption] = [];
        }

        // todo: this needs to be made much more efficient
        $contentRows = $contentQueryBuilder->get();

        foreach ($contentRows as $contentRowIndex => $contentRow) {
            $contentRowCompiledColumnValues = json_decode($contentRow['compiled_view_data'] ?? '', true);
            foreach ($filterOptionsArray as $filterOptionName => $filterOptionValue) {
                if ($filterOptionName == 'instructor' && isset($contentRowCompiledColumnValues[$filterOptionName])) {
                    $instructors = $contentRowCompiledColumnValues[$filterOptionName];
                    if (isset($instructors['id'])) {
                        $instructors = [$instructors];
                    }
                    if (!is_array($instructors)) {
                        continue;
                    }
                    foreach ($instructors as $instructor) {
                        if (isset($instructor['id']) && !isset($compiledViewData[$instructor['id']])) {
                            $compiledViewData[$instructor['id']] = json_decode(
                                $instructor['compiled_view_data'] ?? '',
                                true
                            );


                            $filterOptionsArray[$filterOptionName][] = [
                                'id' => $instructor['id'],
                                'name' => $instructor['name'],
                                'fields' => [
                                    [
                                        "id" => $instructor['id'],
                                        "key" => "name",
                                        "value" => $instructor['name'],
                                    ],
                                ],
                                'data' => [
                                    [
                                        "id" => $instructor['id'],
                                        "key" => "head_shot_picture_url",
                                        "value" => $compiledViewData[$instructor['id']]['head_shot_picture_url'] ?? $compiledViewData[$instructor['id']]['avatar_image_url'] ?? '',
                                    ],
                                ],
                            ];
                        }
                    }
                } elseif (isset($contentRowCompiledColumnValues[$filterOptionName])) {
                    $filterOptionsArray[$filterOptionName] = array_merge(
                        $filterOptionsArray[$filterOptionName] ?? [],
                        (array)$contentRowCompiledColumnValues[$filterOptionName]
                    );
                }
            }
        }

        foreach ($filterOptionsArray as $filterOptionName => $filterOptionValue) {
            foreach ($filterOptionValue as $filterOptionIndexToClean => $filterOptionValueToClean) {
                if (!is_array($filterOptionValueToClean)) {
                    $filterOptionValue[$filterOptionIndexToClean] = trim(
                        ucwords(
                            $filterOptionValueToClean
                        )
                    );
                    $filterOptionsArray[$filterOptionName] = array_keys(array_flip($filterOptionValue));
                    sort($filterOptionsArray[$filterOptionName]);
                } else {
                    $tempArr = array_unique(array_column($filterOptionValue, 'id'));
                    $filterOptionsArray[$filterOptionName] = array_intersect_key($filterOptionValue, $tempArr);
                    usort($filterOptionsArray[$filterOptionName], function ($a, $b) {
                        if (is_array($a)) {
                            return strncmp(strtolower($a['name']), strtolower($b['name']), 15);
                        }

                        return strncmp(strtolower($a), strtolower($b), 15);
                    });
                }
            }
        }

        return $filterOptionsArray;
    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    private function sortByAlphaThenNumeric($a, $b)
    {
        if (is_numeric($a) && !is_numeric($b)) {
            return 1;
        } else {
            if (!is_numeric($a) && is_numeric($b)) {
                return -1;
            } else {
                return ($a < $b) ? -1 : 1;
            }
        }
    }

    /**
     * @param array $types
     * @param $status
     * @param $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param array $requiredField
     * @param integer $limit
     * @return array
     */
    public function getWhereTypeInAndStatusInAndPublishedOnOrderedAndPaginated(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'published_on',
        $orderByDirection = 'desc',
        $requiredField = [],
        $limit = null,
        $page = 1
    ) {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->whereIn(ConfigService::$tableContent . '.type', $types)
                ->whereIn(ConfigService::$tableContent . '.status', $status)
                ->where(
                    ConfigService::$tableContent . '.published_on',
                    $publishedOnComparisonOperator,
                    $publishedOnValue
                )
                ->distinct()
                ->orderBy($orderByColumn, $orderByDirection);

        if (!empty($limit)) {
            $contentRows->limit($limit)->skip(($page - 1) * $limit);
        }

        if (!empty($requiredField)) {
            if (in_array($requiredField['key'], config('railcontent.contentColumnNamesForFields'))) {
                $contentRows->where(
                    ConfigService::$tableContent . '.' . $requiredField['key'],
                    $requiredField['value']
                );
            } else {
                $column = ($requiredField['key'] == 'instructor') ? 'instructor_id' : $requiredField['key'];
                $table = config('railcontent.table_prefix') . 'content_' . $requiredField['key'] . 's';
            }
            $contentRows->join($table, function (JoinClause $joinClause) use (
                $requiredField,
                $table,
                $column
            ) {
                $joinClause->on(
                    $table . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                    ->whereIn(
                        $table . '.' . $column,
                        $requiredField['value']
                    );
            })
                ->groupBy('railcontent_content.id');
        }

        $contentRows = $contentRows->getToArray();

        if (ContentCompiledColumnTransformer::$useCompiledColumnForServingData && !empty($contentRows)) {
            return $this->contentCompiledColumnTransformer->transform(Arr::wrap($contentRows)) ?? [];
        }

        $this->configurePresenterForResults($contentRows);

        return $this->parserResult($contentRows);
    }

    /**
     * @param $parentId
     * @return array
     */
    public function countByTypeInAndStatusInAndPublishedOn(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'published_on',
        $orderByDirection = 'desc',
        $requiredField = []
    ) {
        $contentRows = $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->whereIn(ConfigService::$tableContent . '.status', $status)
            ->where(
                ConfigService::$tableContent . '.published_on',
                $publishedOnComparisonOperator,
                $publishedOnValue
            );

        if (!empty($requiredField)) {
            if (in_array($requiredField['key'], config('railcontent.contentColumnNamesForFields'))) {
                $contentRows->where(
                    ConfigService::$tableContent . '.' . $requiredField['key'],
                    $requiredField['value']
                );
            } else {
                $column = ($requiredField['key'] == 'instructor') ? 'instructor_id' : $requiredField['key'];
                $table = config('railcontent.table_prefix') . 'content_' . $requiredField['key'] . 's';
            }
            $contentRows->join($table, function (JoinClause $joinClause) use (
                $requiredField,
                $table,
                $column
            ) {
                $joinClause->on(
                    $table . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                    ->whereIn(
                        $table . '.' . $column,
                        $requiredField['value']
                    );
            })
                ->groupBy('railcontent_content.id');
        }

        return $contentRows->count(DB::raw('DISTINCT '.ConfigService::$tableContent . '.id'));
    }

    private function getFilterOptionsForQueryVersion2(ContentQueryBuilder $contentQueryBuilder)
    {
        $filterOptionsArray = [];

        $joinTablesQuery = clone($contentQueryBuilder);
        $contentTableQuery = clone($contentQueryBuilder);

        $joinTablesQuery->select([]);

        // get values that are in other tables
        $filterNameToTableNameAndColumnName = [
            'instructor' => [
                'table' => 'railcontent_content_instructors',
                'column' => 'instructor_id',
                'alias' => '_rci'
            ],
            'style' => ['table' => 'railcontent_content_styles', 'column' => 'style', 'alias' => '_rcs'],
            'topic' => ['table' => 'railcontent_content_topics', 'column' => 'topic', 'alias' => '_rct'],
            'focus' => ['table' => 'railcontent_content_focus', 'column' => 'focus', 'alias' => '_rcf'],
            'bpm' => ['table' => 'railcontent_content_bpm', 'column' => 'bpm', 'alias' => '_rcb'],
            'essentials' => ['table' => 'railcontent_content_essentials', 'column' => 'essentials', 'alias' => '_rce'],
            'theory' => ['table' => 'railcontent_content_theory', 'column' => 'theory', 'alias' => '_rct'],
            'creativity' => ['table' => 'railcontent_content_creativity', 'column' => 'creativity', 'alias' => '_rcc'],
            'lifestyle' => ['table' => 'railcontent_content_lifestyle', 'column' => 'lifestyle', 'alias' => '_rcl'],
        ];

        $filterOptions = self::$catalogMetaAllowableFilters ?? [
                'data',
                'instructor',
                'style',
                'topic',
                'focus',
                'bpm',
            ];

        // we always need the related data
        if (!in_array('data', $filterOptions)) {
            $filterOptions[] = 'data';
        }

        $filterOptions = array_unique($filterOptions);

        foreach ($filterOptions as $filterOption) {
            $filterOptionTableName = $filterNameToTableNameAndColumnName[$filterOption]['table'] ?? null;
            $filterOptionTableAliasName = $filterNameToTableNameAndColumnName[$filterOption]['alias'] ?? null;
            $filterOptionColumnName = $filterNameToTableNameAndColumnName[$filterOption]['column'] ?? null;

            if (empty($filterOptionTableName) || empty($filterOptionColumnName)) {
                continue;
            }

            $hasJoinAlready = false;

            if (!empty($joinTablesQuery->joins)) {
                foreach ($joinTablesQuery->joins as $existingJoin) {
                    /**
                     * @var $existingJoin JoinClause
                     */
                    if ($existingJoin->table == $filterOptionTableName . ' as ' . $filterOptionTableAliasName) {
                        $hasJoinAlready = true;
                    }
                }
            }

            if (!$hasJoinAlready) {
                $joinTablesQuery->leftJoin(
                    $filterOptionTableName . ' as ' . $filterOptionTableAliasName,
                    $filterOptionTableAliasName . '.content_id',
                    '=',
                    'railcontent_content.id'
                );
            }

            $joinTablesQuery->addSelect(
                [$filterOptionTableAliasName . '.' . $filterOptionColumnName . ' as ' . $filterOptionColumnName]
            );

            $groupBy[] = $filterOptionColumnName;

            $filterOptionsArray[$filterOptionColumnName] = [];
        }

        $countingQuery = clone($joinTablesQuery);

        if (!empty($groupBy)) {
            $joinTablesQuery->groupBy($groupBy);
        } else {
            return [];
        }

        $tableResults = $joinTablesQuery->get();

        $countingQuery->addSelect(
            [ 'railcontent_content.id']
        );
        $groupBy[] = 'id';
        $countingQuery->groupBy($groupBy);

        $countingQueryResults = $countingQuery->get();

        $counts = [];
        foreach ($filterOptionsArray as $filterOptionName => $filterOptionValue) {
            $filterOptionsArray[$filterOptionName] = $tableResults->whereNotNull($filterOptionName)
                ->pluck($filterOptionName)
                ->unique()
                ->values()
                ->toArray();
            $counts[$filterOptionName] = $countingQueryResults->whereNotNull($filterOptionName)
                ->unique(function ($item) use($filterOptionName) {
                    return $item['id'].$item["$filterOptionName"];
                })
                ->pluck($filterOptionName)
                ->countBy()
                ->toArray();

            foreach ($filterOptionsArray[$filterOptionName] as $filterOptionIndexToClean => $filterOptionValueToClean) {
                $countingItems = '';
                if (self::$countFilterOptionItems) {
                    $nr = $counts[$filterOptionName][$filterOptionValueToClean];
                    $countingItems = ' ('.$nr.')';
                }
                $filterOptionsArray[$filterOptionName][$filterOptionIndexToClean] = ucwords(
                    trim(
                        $filterOptionValueToClean.$countingItems
                    )
                );
            }

            $filterOptionsArray[$filterOptionName] = array_unique($filterOptionsArray[$filterOptionName]);
            sort($filterOptionsArray[$filterOptionName]);
        }

        // todo: handle instructors which need to be pulled from matching content rows
        if (!empty($filterOptionsArray['instructor_id'])) {
            $instructorRows = $this->query()
                ->select(['railcontent_content.id as id', 'name', 'value as head_shot_picture_url'])
                ->leftJoin(
                    ConfigService::$tableContentData,
                    function (JoinClause $joinClause) {
                        $joinClause->on(
                            ConfigService::$tableContentData . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->where(
                                ConfigService::$tableContentData . '.id',
                                '=',
                                DB::raw(
                                    '(SELECT id FROM ' . ConfigService::$tableContentData . ' WHERE ' . ConfigService::$tableContentData . '.content_id = railcontent_content.id and railcontent_content_data.key = \'head_shot_picture_url\' LIMIT 1)'
                                )
                            );
                    }
                )
                ->whereIn('railcontent_content.id', $filterOptionsArray['instructor_id'])
                ->orderBy('name')
                ->get()
                ->toArray();

            foreach ($instructorRows as $instructorRowIndex => $instructorRow) {
                $instructorRows[$instructorRowIndex]["fields"][] = [
                    'id' => 1,
                    'key' => 'name',
                    'value' => $instructorRow["name"]
                ];
                $instructorRows[$instructorRowIndex]["data"][] = [
                    'id' => 1,
                    'key' => 'head_shot_picture_url',
                    'value' => $instructorRow["head_shot_picture_url"]
                ];
            }

            $filterOptionsArray['instructor'] = $instructorRows;
        }

        // dd($filterOptionsArray);

        // todo: now to the right place
        $filterOptionNameToContentTableColumnName = [
            'difficulty' => ConfigService::$tableContent . '.difficulty',
            'difficulty_range' => ConfigService::$tableContent . '.difficulty_range',
            'artist' => ConfigService::$tableContent . '.artist',
            'type' => ConfigService::$tableContent . '.type',
            'instrument' => ConfigService::$tableContent . '.instrument',
            'content_id' => ConfigService::$tableContent . '.id',
        ];

        $contentTableQuery->addSelect(
            [ 'railcontent_content.id as id']
        );
        $contentTableQuery->groupBy($filterOptionNameToContentTableColumnName)
            ->select($filterOptionNameToContentTableColumnName);

        $tableResults = $contentTableQuery->get();
        if(!self::$catalogMetaAllowableFilters){
            self::$catalogMetaAllowableFilters = ['style','topic','difficulty'];
        }

        $filterOptionNameToContentTableColumnName = array_intersect_key($filterOptionNameToContentTableColumnName, array_combine(self::$catalogMetaAllowableFilters, self::$catalogMetaAllowableFilters));
        foreach ($filterOptionNameToContentTableColumnName as $filterOptionName => $filterOptionValue) {
            $filterOptionsArray[$filterOptionName] = $tableResults->whereNotNull($filterOptionName)
                ->pluck($filterOptionName)
                ->unique()
                ->values()
                ->toArray();
            $counts[$filterOptionName] = $tableResults->whereNotNull($filterOptionName)
                ->unique(function ($item) use($filterOptionName) {
                    return $item['id'].$item["$filterOptionName"];
                })
                ->pluck($filterOptionName)
                ->countBy()
                ->toArray();
            foreach ($filterOptionsArray[$filterOptionName] as $filterOptionIndexToClean => $filterOptionValueToClean) {
                $countingItems = '';
                if (self::$countFilterOptionItems) {
                    $nr = $counts[$filterOptionName][$filterOptionValueToClean];
                    $countingItems = ' ('.$nr.')';
                }

                $filterOptionsArray[$filterOptionName][$filterOptionIndexToClean] = trim(
                    ucwords(
                        $filterOptionValueToClean.$countingItems
                    )
                );
            }

            $filterOptionsArray[$filterOptionName] = array_unique($filterOptionsArray[$filterOptionName]);
            usort($filterOptionsArray[$filterOptionName], [$this, 'sortByAlphaThenNumeric']);
        }

        return $filterOptionsArray;
    }

}
