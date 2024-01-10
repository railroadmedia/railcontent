<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Enums\RecommenderSection;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentBpmRepository;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentInstructorRepository;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentStyleRepository;
use Railroad\Railcontent\Repositories\ContentTopicRepository;
use Railroad\Railcontent\Repositories\ContentVersionRepository;
use Railroad\Railcontent\Repositories\ContentVideoRepository;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Support\Collection;

//use Railroad\Railcontent\Events\XPModified;

class ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentVersionRepository
     */
    private $versionRepository;

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
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var CommentAssignmentRepository
     */
    private $commentAssignationRepository;

    /**
     * @var ContentPermissionRepository
     */
    private $contentPermissionRepository;

    /**
     * @var UserContentProgressRepository
     */
    private $userContentProgressRepository;

    /**
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;
    /**
     * @var ContentFollowsRepository
     */
    private $contentFollowRepository;

    /**
     * @var ElasticService
     */
    private $elasticService;
    /**
     * @var ContentTopicRepository
     */
    private $contentTopicRepository;
    /**
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;
    /**
     * @var ContentStyleRepository
     */
    private $contentStyleRepository;

    private $contentBpmRepository;
    /**
     * @var ContentVideoRepository
     */
    private $contentVideoRepository;

    /**
     * @var RecommendationService
     */
    private $recommendationService;

    private DatabaseManager $databaseManager;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_ARCHIVED = 'archived';

    const STATUS_DELETED = 'deleted';

    public $idContentCache = [];

    /**
     * @param ContentRepository $contentRepository
     * @param ContentVersionRepository $versionRepository
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param ContentPermissionRepository $contentPermissionRepository
     * @param CommentRepository $commentRepository
     * @param CommentAssignmentRepository $commentAssignmentRepository
     * @param UserContentProgressRepository $userContentProgressRepository
     * @param UserPermissionsRepository $userPermissionsRepository
     * @param ContentFollowsRepository $contentFollowsRepository
     * @param ElasticService $elasticService
     * @param ContentTopicRepository $contentTopicRepository
     * @param ContentInstructorRepository $contentInstructorRepository
     * @param ContentStyleRepository $contentStyleRepository
     * @param ContentBpmRepository $contentBpmRepository
     * @param RecommendationService $recommendationService
     */
    public function __construct(
        ContentRepository $contentRepository,
        ContentVersionRepository $versionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository,
        ContentHierarchyRepository $contentHierarchyRepository,
        ContentPermissionRepository $contentPermissionRepository,
        CommentRepository $commentRepository,
        CommentAssignmentRepository $commentAssignmentRepository,
        UserContentProgressRepository $userContentProgressRepository,
        UserPermissionsRepository $userPermissionsRepository,
        ContentFollowsRepository $contentFollowsRepository,
        ElasticService $elasticService,
        ContentTopicRepository $contentTopicRepository,
        ContentInstructorRepository $contentInstructorRepository,
        ContentStyleRepository $contentStyleRepository,
        ContentBpmRepository $contentBpmRepository,
        DatabaseManager $databaseManager,
        ContentVideoRepository $contentVideoRepository,
        RecommendationService $recommendationService,
    ) {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->commentRepository = $commentRepository;
        $this->commentAssignationRepository = $commentAssignmentRepository;
        $this->userContentProgressRepository = $userContentProgressRepository;
        $this->userPermissionRepository = $userPermissionsRepository;
        $this->contentFollowsRepository = $contentFollowsRepository;
        $this->elasticService = $elasticService;
        $this->contentTopicRepository = $contentTopicRepository;
        $this->contentInstructorRepository = $contentInstructorRepository;
        $this->contentStyleRepository = $contentStyleRepository;
        $this->contentBpmRepository = $contentBpmRepository;
        $this->databaseManager = $databaseManager;
        $this->contentVideoRepository = $contentVideoRepository;
        $this->recommendationService = $recommendationService;
    }

    /**
     * Call the get by id method from repository and return the content
     *
     * @param integer $id
     * @return ContentEntity|array|null
     */
    public function getById($id)
    {
        $hash = 'contents_by_id_'.CacheHelper::getKey($id);

        if (isset($this->idContentCache[$hash])) {
            return $this->idContentCache[$hash];
        }

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->contentRepository->getById($id), [$id]);
        }

        $this->idContentCache[$hash] = Decorator::decorate($results, 'content');

        return $this->idContentCache[$hash];
    }

    /**
     *
     *
     * @param int user_id
     * @param string brand
     * @param int limit -
     * @return mixed|Collection|null
     */
    public function getRecommendationsByContentType($user_id, $brand, $contentTypes, RecommenderSection $section, bool $randomize=false, $limit=6)
    {
        $filter = $this->contentRepository->startFilter(
            1,
            $limit,
            'published_on',
            'desc',
            $contentTypes,
            [],
            [],
        );
        $filterOptions = $this->getFilterOptions($filter, true, $contentTypes);
        $recommendations = $this->recommendationService->getFilteredRecommendations($user_id, $brand, $section);
        if ($randomize) {
            $recommendations = $this->randomizeRecommendations($recommendations, $limit);
        } else {
            $recommendations = array_slice($recommendations, 0, $limit);
        }
        $content = $this->getByIds($recommendations);
        return (new ContentFilterResultsEntity([
            'results' => $content,
            'filter_options' => $filterOptions,
            'total_results' => $filter->countFilter()
        ]));
    }

    private function randomizeRecommendations($recommendations, $limit=6, $useHourly=true)
    {
        if ($limit > count($recommendations)) {
            return $recommendations;
        }
        if ($useHourly) {
            // deterministic random: results will be the same for each hour of the day
            // no caching involved :)
            $hour = date("H");
            srand($hour);
            $temp =  array_rand($recommendations, $limit);
            srand(time());
            return $recommendations[$temp];
        } else {
            return array_rand($recommendations, $limit);
        }
    }

    /**
     * Call the get by ids method from repository
     *
     * @param integer[] $ids
     * @return array|Collection|ContentEntity[]
     */
    public function getByIds($ids)
    {
        $hash = 'contents_by_ids_'.CacheHelper::getKey(...$ids);

        if (isset($this->idContentCache[$hash])) {
            return $this->idContentCache[$hash];
        }

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->contentRepository->getByIds($ids));
        }

        $this->idContentCache[$hash] = Decorator::decorate($results, 'content');

        return $this->idContentCache[$hash];
    }

    /**
     * Get all contents with specified type.
     *
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getAllByType($type)
    {
        $hash = 'contents_by_type_'.$type.'_'.CacheHelper::getKey($type);

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->contentRepository->getByType($type));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get all contents with specified status, field and type.
     *
     * @param array $types
     * @param string $status
     * @param string $fieldKey
     * @param string $fieldValue
     * @param string $fieldType
     * @param string $fieldComparisonOperator
     * @return array|Collection|ContentEntity[]
     */
    public function getWhereTypeInAndStatusAndField(
        array $types,
        $status,
        $fieldKey,
        $fieldValue,
        $fieldType,
        $fieldComparisonOperator = '='
    ) {
        $hash = 'contents_by_types_field_and_status_'.CacheHelper::getKey(
                $types,
                $status,
                $fieldKey,
                $fieldValue,
                $fieldType,
                $fieldComparisonOperator
            );

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->getWhereTypeInAndStatusAndField(
                    $types,
                    $status,
                    $fieldKey,
                    $fieldValue,
                    $fieldType,
                    $fieldComparisonOperator
                )
            );
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get ordered contents by type, status and published_on date.
     *
     * @param array $types
     * @param string $status
     * @param string $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param integer $limit
     * @return array|Collection|ContentEntity[]
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
        return Decorator::decorate(
            $this->contentRepository->getWhereTypeInAndStatusAndPublishedOnOrdered(
                $types,
                $status,
                $publishedOnValue,
                $publishedOnComparisonOperator,
                $orderByColumn,
                $orderByDirection,
                $requiredField,
                $limit
            ),
            'content'
        );
    }

    /**
     * Get contents by slug and title.
     *
     * @param string $slug
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getBySlugAndType($slug, $type)
    {
        $hash = 'contents_by_slug_type_'.$type.'_'.CacheHelper::getKey($slug, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->contentRepository->getBySlugAndType($slug, $type));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get contents by userId, type and slug.
     *
     * @param integer $userId
     * @param string $type
     * @param string $slug
     * @return array|Collection|ContentEntity[]
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        $hash = 'contents_by_user_slug_type_'.$type.'_'.CacheHelper::getKey($userId, $type, $slug);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results =
                CacheHelper::saveUserCache($hash, $this->contentRepository->getByUserIdTypeSlug($userId, $type, $slug));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get contents based on parent id.
     *
     * @param integer $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentId($parentId, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $hash = 'contents_by_parent_id_'.CacheHelper::getKey($parentId, $orderBy, $orderByDirection);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByParentId($parentId, $orderBy, $orderByDirection);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$parentId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get paginated contents by parent id.
     *
     * @param integer $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIdPaginated(
        $parentId,
        $limit = 10,
        $skip = 0,
        $orderBy = 'child_position',
        $orderByDirection = 'asc'
    ) {
        $hash =
            'contents_by_parent_id_paginated_'.
            CacheHelper::getKey($parentId, $limit, $skip, $orderBy, $orderByDirection);

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByParentIdPaginated(
                $parentId,
                $limit,
                $skip,
                $orderBy,
                $orderByDirection
            );
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$parentId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get ordered contents by parent id with specified type.
     *
     * @param integer $parentId
     * @param array $types
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIdWhereTypeIn(
        $parentId,
        $types,
        $orderBy = 'child_position',
        $orderByDirection = 'asc'
    ) {
        $hash = 'contents_by_parent_id_type_'.CacheHelper::getKey($parentId, $types, $orderBy, $orderByDirection);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByParentIdWhereTypeIn(
                $parentId,
                $types,
                $orderBy,
                $orderByDirection
            );
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$parentId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get ordered contents by parent id and type.
     *
     * @param integer $parentId
     * @param array $types
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIdWhereTypeInPaginated(
        $parentId,
        $types,
        $limit = 10,
        $skip = 0,
        $orderBy = 'child_position',
        $orderByDirection = 'asc'
    ) {
        $hash = 'contents_by_parent_id_type_in_'.CacheHelper::getKey(
                $parentId,
                $types,
                $limit,
                $skip,
                $orderBy,
                $orderByDirection
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByParentIdWhereTypeInPaginated(
                $parentId,
                $types,
                $limit,
                $skip,
                $orderBy,
                $orderByDirection
            );
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$parentId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Count contents with specified type and parent id.
     *
     * @param integer $parentId
     * @param array $types
     * @return integer
     */
    public function countByParentIdWhereTypeIn(
        $parentId,
        $types
    ) {
        return $this->contentRepository->countByParentIdWhereTypeIn(
            $parentId,
            $types
        );
    }

    /**
     * Get ordered contents based on parent ids.
     *
     * @param array $parentIds
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIds(array $parentIds, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $hash = 'contents_by_parent_ids_'.CacheHelper::getKey($parentIds, $orderBy, $orderByDirection);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByParentIds($parentIds, $orderBy, $orderByDirection);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), $parentIds));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get contents by child and type.
     *
     * @param integer $childId
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdWhereType($childId, $type)
    {
        $hash = 'contents_by_child_id_and_type_'.$type.'_'.CacheHelper::getKey($childId, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByChildIdWhereType($childId, $type);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$childId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get contents by child ids with specified type.
     *
     * @param array $childIds
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdsWhereType(array $childIds, $type)
    {
        $hash = 'contents_by_child_ids_and_type_'.$type.'_'.CacheHelper::getKey($childIds, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByChildIdsWhereType($childIds, $type);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), $childIds));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get contents by child ids with specified type.
     *
     * @param array $childIds
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdsWhereTypeForUrl(array $childIds, $type)
    {
        $hash = 'contents_by_child_ids_and_type_for_url_'.$type.'_'.CacheHelper::getKey($childIds, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByChildIdsWhereTypeForUrl($childIds, $type);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), $childIds));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get contents by child id where parent type met the criteria.
     *
     * @param integer $childId
     * @param array $types
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdWhereParentTypeIn($childId, array $types)
    {
        $hash = 'contents_by_child_ids_and_parent_types_'.CacheHelper::getKey($childId, $types);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (is_null($results)) {
            $resultsDB = $this->contentRepository->getByChildIdWhereParentTypeIn($childId, $types);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$childId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get paginated contents by type and user progress state.
     *
     * @param string $type
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function getPaginatedByTypeUserProgressState($type, $userId, $state, $limit = 25, $skip = 0)
    {
        $hash = 'contents_paginated_by_type_'.$type.'_and_user_progress_'.$userId.'_'.CacheHelper::getKey(
                $type,
                $userId,
                $state,
                $limit,
                $skip
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->getPaginatedByTypeUserProgressState(
                    $type,
                    $userId,
                    $state,
                    $limit,
                    $skip
                )
            );
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get paginated contents by types and user progress state.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function getPaginatedByTypesUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0
    ) {
        $hash = 'contents_paginated_by_types_and_user_progress_'.$userId.'_'.CacheHelper::getKey(
                $types,
                $userId,
                $state,
                $limit,
                $skip
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->getPaginatedByTypesUserProgressState(
                    $types,
                    $userId,
                    $state,
                    $limit,
                    $skip
                )
            );
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get recent paginated contents by types and user progress state.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function getPaginatedByTypesRecentUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0
    ) {
        $hash = 'contents_paginated_by_types_and_user_progress_'.$userId.'_'.CacheHelper::getKey(
                $types,
                $userId,
                $state,
                $limit,
                $skip
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->getPaginatedByTypesRecentUserProgressState(
                    $types,
                    $userId,
                    $state,
                    $limit,
                    $skip
                )
            );
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * Count recent contents with user progress state and type.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function countByTypesRecentUserProgressState(
        array $types,
        $userId,
        $state
    ) {
        return $this->contentRepository->countByTypesUserProgressState(
            $types,
            $userId,
            $state
        );
    }

    /**
     * Get neighbouring siblings by type.
     *
     * @param string $type
     * @param string $columnName
     * @param string $columnValue
     * @param int $siblingPairLimit
     * @param string $orderColumn
     * @param string $orderDirection
     * @return array|ContentEntity|Collection
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
        $hash = 'contents_type_neighbouring_siblings_'.CacheHelper::getKey(
                $type,
                $columnName,
                $columnValue,
                $siblingPairLimit,
                $orderColumn,
                $orderDirection
            );

        // $5 sez we can remove this
        $this->contentRepository->getTypeNeighbouringSiblings(
            $type,
            $columnName,
            $columnValue,
            $siblingPairLimit,
            $orderColumn,
            $orderDirection,
            $contentId
        );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->getTypeNeighbouringSiblings(
                    $type,
                    $columnName,
                    $columnValue,
                    $siblingPairLimit,
                    $orderColumn,
                    $orderDirection,
                    $contentId
                )
            );
        }

        $results['before'] = Decorator::decorate($results['before'], 'content');
        $results['after'] = Decorator::decorate($results['after'], 'content');

        return $results;
    }

    /**
     * Count contents by type and user progress state.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @return integer
     */
    public function countByTypesUserProgressState(array $types, $userId, $state)
    {
        $results = $this->contentRepository->countByTypesUserProgressState(
            $types,
            $userId,
            $state
        );

        return $results;
    }

    /**
     *  Get filtered contents.
     * Returns:
     * ['results' => $lessons, 'total_results' => $totalLessonsAfterFiltering]
     *
     * @param $page
     * @param $limit
     * @param string $orderByAndDirection
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredFields
     * @param array $includedFields
     * @param array $requiredUserStates
     * @param array $includedUserStates
     * @param bool $pullFilterFields
     * @param false $getFutureContentOnly
     * @param bool $pullPagination
     * @param false $getFollowedContentOnly
     * @return mixed|Collection|null
     */
    public function getFiltered(
        $page,
        $limit,
        $orderByAndDirection = '-published_on',
        array $includedTypes = [],
        array $slugHierarchy = [],
        array $requiredParentIds = [],
        array $requiredFields = [],
        array $includedFields = [],
        array $requiredUserStates = [],
        array $includedUserStates = [],
        $pullFilterFields = true,
        $getFutureContentOnly = false,
        $pullPagination = true,
        $getFollowedContentOnly = false,
        $getFutureScheduledContentOnly = false,
        $groupBy = null
    ) {
        $results = null;
        if ($limit == 'null') {
            $limit = -1;
        }

        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($orderByAndDirection, '-');

        $hash = 'contents_results_'.CacheHelper::getKey(
                $page,
                $limit,
                $orderByColumn,
                $orderByDirection,
                implode(' ', array_values($includedTypes) ?? ''),
                implode(' ', array_values($slugHierarchy) ?? ''),
                implode(' ', array_values($requiredParentIds) ?? ''),
                implode(' ', array_values($requiredFields) ?? ''),
                implode(' ', array_values($includedFields) ?? ''),
                implode(' ', array_values($requiredUserStates) ?? ''),
                implode(' ', array_values($includedUserStates) ?? ''),
                ContentRepository::$bypassPermissions,
                $getFollowedContentOnly,
                $groupBy
            );

        $cache = CacheHelper::getCachedResultsForKey($hash);

        if ($cache) {
            $results = new ContentFilterResultsEntity($cache);
        }

        if (!$results) {
            $filter = $this->contentRepository->startFilter(
                $page,
                $limit,
                $orderByColumn,
                $orderByDirection,
                $includedTypes,
                $slugHierarchy,
                $requiredParentIds,
                $getFutureContentOnly,
                $getFollowedContentOnly,
                $getFutureScheduledContentOnly
            );

            foreach ($requiredFields as $requiredField) {
                $filter->requireField(
                    ...
                    (is_array($requiredField) ? $requiredField : explode(',', $requiredField))
                );
            }

            foreach ($includedFields as $includedField) {
                $filter->includeField(
                    ...
                    (is_array($includedField) ? $includedField : explode(',', $includedField))
                );
            }

            foreach ($requiredUserStates as $requiredUserState) {
                $filter->requireUserStates(
                    ...
                    is_array($requiredUserState) ? $requiredUserState : explode(',', $requiredUserState)
                );
            }

            foreach ($includedUserStates as $includedUserState) {
                $filter->includeUserStates(
                    ...
                    is_array($includedUserState) ? $includedUserState : explode(',', $includedUserState)
                );
            }

            if($groupBy){
                $filter->groupByField($groupBy);
            }

            if (config('railcontent.use_elastic_search') == true) {
                $filters = [];

                if (!empty($includedUserStates)) {
                    $includedContentsIdsByState = [];
                    $includedContentsByState =
                        $this->userContentProgressRepository->createQueryBuilder('up')
                            ->where('up.user = :userId')
                            ->andWhere('up.state IN (:state)')
                            ->setParameter('userId', auth()->id())
                            ->setParameter('state', $includedUserStates)
                            ->getQuery()
                            ->getResult();
                    foreach ($includedContentsByState as $progress) {
                        $includedContentsIdsByState[] =
                            $progress->getContent()
                                ->getId();
                    }
                }

                $followedContents = [];
                if ($getFollowedContentOnly) {
                    $followedContents = $this->contentFollowsRepository->getFollowedContentIds();
                    if (empty($followedContents)) {
                        $resultsDB = new ContentFilterResultsEntity([
                            'results' => $followedContents,
                            'total_results' => 0,
                            'filter_options' => [],
                        ]);

                        $results =
                            CacheHelper::saveUserCache($hash, $resultsDB, Arr::pluck($resultsDB['results'], 'id'));

                        return new ContentFilterResultsEntity($results);
                    }
                }

                if (!empty($requiredUserStates)) {
                    $requiredContentsByState = $this->userContentProgressRepository->getUserProgressForState(
                        auth()->id(),
                        $requiredUserStates[0]
                    );

                    $requiredContentIdsByState = Arr::pluck($requiredContentsByState, 'content_id');
                }

                $permissionIds = [];
                if (auth()->id()) {
                    $userPermissions = $this->userPermissionRepository->getUserPermissions(auth()->id(), true);
                    $permissionIds = Arr::pluck($userPermissions, 'permission_id');
                }

                ElasticQueryBuilder::$userPermissions = $permissionIds;

                $requiredUserPlaylistIds = [];
                $start = microtime(true);
                $elasticData = $this->elasticService->getElasticFiltered(
                    $page,
                    $limit,
                    $orderByAndDirection,
                    $includedTypes,
                    $slugHierarchy,
                    $requiredParentIds,
                    $filter->getRequiredFields(),
                    $filter->getIncludedFields(),
                    $requiredContentIdsByState ?? null,
                    $includedContentsIdsByState ?? null,
                    $requiredUserPlaylistIds,
                    null,
                    $followedContents
                );
                $finish = microtime(true) - $start;
                error_log('get elastic data in '.$finish);
                $totalResults = $elasticData['hits']['total']['value'];

                $ids = [];
                foreach ($elasticData['hits']['hits'] as $elData) {
                    $ids[] = $elData['_source']['content_id'];
                }
                $start = microtime(true);
                $unorderedContentRows = $this->getByIds($ids);
                $finish = microtime(true) - $start;

                // error_log('get contents by ids from elasticsearch '.$finish.'  contentIds = '.print_r($elasticData['hits']['hits'], true));

                $data = [];
                foreach ($ids as $id) {
                    foreach ($unorderedContentRows as $index => $unorderedContentRow) {
                        if ($id == $unorderedContentRow['id']) {
                            $data[] = $unorderedContentRow;
                        }
                    }
                }

                if ($pullFilterFields === true) {
                    $start = microtime(true);
                    $filterOptions = $this->elasticService->getFilterFields(
                        $includedTypes,
                        $slugHierarchy,
                        $requiredParentIds,
                        $filter->getRequiredFields(),
                        $filter->getIncludedFields(),
                        $requiredContentIdsByState ?? null,
                        $includedContentsIdsByState ?? null,
                        $requiredUserPlaylistIds
                    );

                    if (array_key_exists('instructors', $filterOptions)) {
                        $instructors = $this->contentRepository->getByIds($filterOptions['instructors']);

                        unset($filterOptions['instructors']);
                        usort($instructors, function ($a, $b) {
                            return strncmp(
                                ContentHelper::getFieldValue($a, 'name'),
                                ContentHelper::getFieldValue($b, 'name'),
                                15
                            );
                        });
                        $filterOptions['instructor'] = $instructors;
                    }

                    if (!empty($filterOptions['difficulty'])) {
                        $filterOptions['difficulty'] = $this->difficultyFilterOptionsCleanup(
                            $includedTypes,
                            $filterOptions['difficulty']
                        );
                    }

                    $filters = $filterOptions;
                    $finish = microtime(true) - $start;

                    error_log('get filter options in  '.$finish);
                }

                $resultsDB = new ContentFilterResultsEntity([
                    'results' => $data,
                    'total_results' => $totalResults,
                    'filter_options' => $filters,
                ]);

                $results = CacheHelper::saveUserCache($hash, $resultsDB, Arr::pluck($resultsDB['results'], 'id'));
                $results = new ContentFilterResultsEntity($results);
            } else {
                $filterFields = $this->getFilterOptions($filter, $pullFilterFields, $includedTypes);
                $resultsDB = new ContentFilterResultsEntity([
                    'results' => $filter->retrieveFilter(),
                    'total_results' => $pullPagination ?
                        $filter->countFilter() : 0,
                    'filter_options' => $filterFields,
                ]);

                $results = CacheHelper::saveUserCache($hash, $resultsDB, Arr::pluck($resultsDB['results'], 'id'));
                $results = new ContentFilterResultsEntity($results);
            }
        }


        return Decorator::decorate($results, 'content');
    }

    private function getFilterOptions( $filter, $pullFilterFields, $includedTypes)
    {
        $filterFields = $pullFilterFields ? $filter->getFilterFields() : [];
        if ($pullFilterFields && !empty($filterFields['difficulty'])) {
            $filterFields['difficulty'] = $this->difficultyFilterOptionsCleanup(
                $includedTypes,
                $filterFields['difficulty']
            );
        }
        return $filterFields;
    }

    // for remove extraneous options and order logically rather than alphabetically
    private function difficultyFilterOptionsCleanup($includedContentTypes, $difficultyOptions)
    {
        // It is deliberate that values are *arrays* of single strings. The Catalog pages—that this section
        // accommodates—have an "included_types" value like this—an array of one string.
        $isContentTypeWithSpecialConditions = in_array($includedContentTypes, [
            ['student-focus'],
            ['student-review'],
        ]);

        if (!$isContentTypeWithSpecialConditions) {
            return $difficultyOptions;
        }

        foreach ($difficultyOptions as &$option) {
            $option = is_string($option) ? strtolower((string)$option) : $option;
        }

        $hasBeginner = in_array('beginner', $difficultyOptions);
        $hasIntermediate = in_array('intermediate', $difficultyOptions);
        $hasAdvanced = in_array('advanced', $difficultyOptions);
        if ($hasBeginner || $hasIntermediate || $hasAdvanced) {
            $difficultyOptions = [];
            if ($hasBeginner) {
                $difficultyOptions[] = 'Beginner';
            }
            if ($hasIntermediate) {
                $difficultyOptions[] = 'Intermediate';
            }
            if ($hasAdvanced) {
                $difficultyOptions[] = 'Advanced';
            }
        }

        return $difficultyOptions;
    }

    /**
     * Call the create method from ContentRepository and return the new created content
     *
     * @param string $slug
     * @param string $type
     * @param string $status
     * @param string|null $language
     * @param string|null $brand
     * @param int|null $userId
     * @param string|null $publishedOn
     * @param int|null $parentId
     * @param int $sort
     * @param bool $slugify
     * @return array|ContentEntity
     */
    public function create(
        $slug,
        $type,
        $status,
        $language,
        $brand,
        $userId,
        $publishedOn,
        $parentId = null,
        $sort = 0,
        $slugify = true
    ) {
        if ($slugify) {
            $slug = ContentHelper::slugify($slug);
        }

        $id = $this->contentRepository->create([
            'slug' => $slug,
            'type' => $type,
            'sort' => $sort,
            'status' => $status ?? self::STATUS_DRAFT,
            'language' => $language ?? ConfigService::$defaultLanguage,
            'brand' => $brand ?? ConfigService::$brand,
            //                                                   'instrumentless' => ($type === 'song') ? false : null,
            'total_xp' => $this->getDefaultXP($type, 0),
            'user_id' => $userId,
            'published_on' => $publishedOn,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        //save the link with parent if the parent id exist on the request
        if ($parentId) {
            $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
                $parentId,
                $id,
                null
            );

            event(new HierarchyUpdated($parentId));
        }

        CacheHelper::deleteUserFields(null, 'contents');

        event(new ContentCreated($id));

        event(new ElasticDataShouldUpdate($id));

        return $this->getById($id);
    }

    /**
     * Update and return the updated content.
     *
     * @param integer $id
     * @param array $data
     * @return array|ContentEntity
     */
    public function update($id, array $data)
    {
        $content = $this->contentRepository->getById($id);
        if (empty($content)) {
            return null;
        }

        $this->contentRepository->update($id, $data);

        event(new ContentUpdated($id, $content, $data));

        event(new ElasticDataShouldUpdate($id));

        CacheHelper::deleteCache('content_'.$id);

        CacheHelper::deleteUserFields(null, 'contents');

        return $this->getById($id);
    }

    /**
     * Call the delete method from repository and returns true if the content was deleted
     *
     * @param $id
     * @return bool|null - if the content not exist
     */
    public function delete($id)
    {
        $content = $this->contentRepository->getById($id);

        if (empty($content)) {
            return null;
        }
        event(new ContentDeleted($id));

        event(new ElasticDataShouldUpdate($id));

        CacheHelper::deleteCache('content_'.$id);

        return $this->contentRepository->delete($id);
    }

    /**
     * Delete data related with the specified content id.
     *
     * @param integer $contentId
     */
    public function deleteContentRelated($contentId)
    {
        //delete the link with the parent and reposition other siblings
        $this->contentHierarchyRepository->deleteChildParentLinks($contentId);

        //delete the content children
        $this->contentHierarchyRepository->deleteParentChildLinks($contentId);

        //delete the content fields
        $this->fieldRepository->deleteByContentId($contentId);

        //delete the content datum
        $this->datumRepository->deleteByContentId($contentId);

        //delete the links with the permissions
        $this->contentPermissionRepository->deleteByContentId($contentId);

        //delete the content comments, replies and assignation
        $comments = $this->commentRepository->getByContentId($contentId);

        $this->commentAssignationRepository->deleteCommentAssignations(Arr::pluck($comments, 'id'));

        $this->commentRepository->deleteByContentId($contentId);

        //delete content playlists
        $this->userContentProgressRepository->deleteByContentId($contentId);
    }

    /**
     * @param $userId
     * @param array $contents
     * @param null $singlePlaylistSlug
     * @return array|Collection|ContentEntity[]
     */
    public function attachChildrenToContents($userId, $contents, $singlePlaylistSlug = null)
    {
        if (empty($userId)) {
            return $contents;
        }

        $isArray = !isset($contents['id']);

        if (!$isArray) {
            $contents = [$contents];
        }

        $userPlaylistContents = $this->contentRepository->getByUserIdWhereChildIdIn(
            $userId,
            array_column($contents, 'id'),
            $singlePlaylistSlug
        );

        foreach ($contents as $index => $content) {
            $contents[$index]['user_playlists'][$userId] = [];
            foreach ($userPlaylistContents as $userPlaylistContent) {
                if ($userPlaylistContent['parent_id'] == $content['id']) {
                    $contents[$index]['user_playlists'][$userId][] = $userPlaylistContent;
                }
            }
        }

        if ($isArray) {
            return $contents;
        } else {
            return reset($contents);
        }
    }

    /**
     * Call the update method from repository to mark the content as deleted and returns true if the content was updated
     *
     * @param $id
     * @return bool|null - if the content not exist
     */
    public function softDelete($id)
    {
        $content = $this->getById($id);

        if (empty($content)) {
            return null;
        }

        event(new ContentSoftDeleted($id));

        event(new ElasticDataShouldUpdate($id));

        CacheHelper::deleteCache('content_'.$id);

        return $this->contentRepository->softDelete([$id]);
    }

    /**
     * Soft delete the children for specified content id.
     *
     * @param int $id
     * @return int
     */
    public function softDeleteContentChildren($id)
    {
        $children = $this->contentHierarchyRepository->getByParentIds([$id]);

        //delete parent content cache
        CacheHelper::deleteCache('content_'.$id);

        return $this->contentRepository->softDelete(Arr::pluck($children, 'child_id'));
    }

    /**
     * Get contents by field value and types.
     *
     * @param array $contentTypes
     * @param string $contentFieldKey
     * @param array $contentFieldValues
     * @return mixed
     */
    public function getByContentFieldValuesForTypes(
        array $contentTypes,
        $contentFieldKey,
        array $contentFieldValues = []
    ) {
        $hash = 'contents_by_types_and_field_value_'.CacheHelper::getKey(
                $contentTypes,
                $contentFieldKey,
                $contentFieldValues
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->getByContentFieldValuesForTypes(
                    $contentTypes,
                    $contentFieldKey,
                    $contentFieldValues
                )
            );
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param null $brand
     * @param bool $includeSemesterPackLessons
     * @return Collection|ContentEntity[]
     */
    public function getContentForCalendar($brand = null, $includeSemesterPackLessons = true)
    {
        $liveEventsTypes = array_merge(
            (array)config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [],
            (array)config('railcontent.liveContentTypes', [])
        );
        $contentReleasesTypes = array_merge(
            (array)config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [],
            (array)config('railcontent.contentReleaseContentTypes', [])
        );

        if (empty($liveEventsTypes) && empty($contentReleasesTypes)) {
            // Accommodates AddEvent calling this method from Musora, where railcontent config is different than expected.
            $liveEventsTypes = array_merge(
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.showTypes', []),
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.liveContentTypes', [])
            );
            $contentReleasesTypes = array_merge(
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.showTypes', []),
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.contentReleaseContentTypes', [])
            );
        }

        if ($includeSemesterPackLessons) {
            $parents = [];
            $idsOfChildrenOfSelectSemesterPacks = [];
            $culledSemesterPackLessons = [];
        }

        $brand = $brand ?? ConfigService::$brand;

        $compareFunc = function ($a, $b) {
            return Carbon::parse($a['published_on']) >= Carbon::parse($b['published_on']);
        };

        $oldStatuses = ContentRepository::$availableContentStatues;
        $oldFutureContent = ContentRepository::$pullFutureContent;

        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        if ($includeSemesterPackLessons) {
            $semesterPacksToGet = config('railcontent.semester-pack-schedule-labels.'.$brand, []);
        }

        if (empty($liveEventsTypes) && empty($contentReleasesTypes) && empty($semesterPacksToGet)) {
            return new Collection();
        }

        if ($includeSemesterPackLessons) {
            foreach ($semesterPacksToGet ?? [] as $slug => $kebabCaseLabel) {
                $parents[] = $this->getSemesterPackParent($slug);
            }
        }

        $liveEvents = $this->getWhereTypeInAndStatusAndPublishedOnOrdered(
            $liveEventsTypes,
            ContentService::STATUS_SCHEDULED,
            Carbon::now()
                ->toDateTimeString(),
            '>'
        );

        $contentReleases = $this->getWhereTypeInAndStatusAndPublishedOnOrdered(
            $contentReleasesTypes,
            ContentService::STATUS_PUBLISHED,
            Carbon::now()
                ->toDateTimeString(),
            '>'
        );

        /*
         * -------------------------------------------------------------------------------------------------------------
         *
         * The following sections are fairly (and therefore maybe *overly*) complex (aka messy).
         * These comment will explain the sections. They are labels as they represent a singluar concern and are thus
         * best addressed with single explanatory comment-block.
         *
         *      Jonathan, January 2019
         *
         * -------------------------------------------------------------------------------------------------------------
         *
         * Section One:
         *
         *      Get just ids of semester-packs-lessons, keyed by their parents' slug.
         *
         *      We could also get the lesson objects themselves here, but that's not important. What really matters is
         *      that we know which lessons belong in select semester-packs, which we get here.
         *
         *      We key them by slug, because in Section Three we'll need the slug to set a "user-friendly label".
         *
         * Section Two:
         *
         *      Get information about which semester-pack-lessons are eligible to be be shown in the schedule based on
         *      status (published rather than draft or deleted), and release date (no reason to show already-released
         *      content).
         *
         *      We also get the actual lesson objects here, but that's not as important because we could do that
         *      anywhere really.
         *
         * Section Three:
         *
         *      Now we combine these two pieces of information to have a set of only the relevant semester-pack-lessons.
         *
         *      We set the 'type' to a value determined by the parent-slug (see Section One above) because these are all
         *      semester-pack-lessons, and the schedule page displays each items' content as a label. If we didn't do
         *      this here, then the label showing would be "SEMESTER-PACK-LESSON". That wouldn't do at all.
         */

        if ($includeSemesterPackLessons) {
            /*
             * Section One
             */
            foreach ($parents ?? [] as $parent) {
                foreach (
                    $this->getByParentIdWhereTypeIn($parent['id'], ['semester-pack-lesson'])
                        ->all() as $lesson
                ) {
                    $idsOfChildrenOfSelectSemesterPacks[$parent['slug']][] = $lesson['id'];
                }
            }

            /*
             * Section Two
             */
            $semesterPackLessons = $this->getWhereTypeInAndStatusAndPublishedOnOrdered(
                ['semester-pack-lesson'],
                ContentService::STATUS_PUBLISHED,
                Carbon::now()
                    ->toDateTimeString(),
                '>'
            );

            /*
             * Section Three
             */

            $culledSemesterPackLessons = new Collection();

            foreach ($semesterPackLessons as $lesson) {
                foreach ($idsOfChildrenOfSelectSemesterPacks ?? [] as $parentSlug => $setOfIds) {
                    if (in_array($lesson['id'], $setOfIds)) {
                        $labels = config('railcontent.semester-pack-schedule-labels.'.$brand);
                        if (array_key_exists($parentSlug, $labels)) {
                            $result =
                                $this->getByChildIdWhereParentTypeIn($lesson['id'], ['semester-pack'])
                                    ->first();
                            $lesson['parent_id'] = $result['id'];
                            //$culledSemesterPackLessons[$labels[$parentSlug]] = $lesson;
                            $culledSemesterPackLessons[] = $lesson;
                        }
                    }
                }
            }
        }

        $scheduleEvents =
            $liveEvents->merge($contentReleases)
                ->sort($compareFunc)
                ->values();

        if ($includeSemesterPackLessons) {
            $culledSemesterPackLessons = collect($culledSemesterPackLessons ?? []);
            $scheduleEvents =
                $scheduleEvents->merge($culledSemesterPackLessons)
                    ->sort($compareFunc)
                    ->values();
        } else {
            $scheduleEvents =
                $scheduleEvents->sort($compareFunc)
                    ->values();
        }

        ContentRepository::$availableContentStatues = $oldStatuses;
        ContentRepository::$pullFutureContent = $oldFutureContent;

        if (empty($scheduleEvents)) {
            return new Collection();
        }

        foreach ($scheduleEvents as $key => $content) {
            $contentBrand = $content['brand'];
            $incorrectBrand = $contentBrand !== $brand;
            if ($incorrectBrand) {
                $keysToUnset[] = $key;
            }
        }

        foreach ($keysToUnset ?? [] as $key) {
            unset($scheduleEvents[$key]);
        }

        return $scheduleEvents;
    }

    /**
     * @param $parentSlug
     * @return mixed
     */
    public function getSemesterPackParent($parentSlug)
    {
        $before = ContentRepository::$availableContentStatues;

        if (empty(ContentRepository::$availableContentStatues)) {
            ContentRepository::$availableContentStatues = [
                ContentService::STATUS_PUBLISHED,
                ContentService::STATUS_SCHEDULED,
            ];
        }

        $setWithThis = array_merge(ContentRepository::$availableContentStatues, [ContentService::STATUS_DRAFT]);

        // include drafts because packs might not be published, but we still want to get their *lessons*
        ContentRepository::$availableContentStatues = $setWithThis;

        $result = $this->getBySlugAndType($parentSlug, 'semester-pack');
        $result = $result->first();

        ContentRepository::$availableContentStatues = $before;

        return $result;
    }

    /**
     * @param array $types
     * @param string $groupBy
     * @return mixed
     */
    public function countByTypes(array $types, $groupBy = '')
    {
        $hash = 'count_by_types_'.CacheHelper::getKey(implode($types), $groupBy);

        if (isset($this->idContentCache[$hash])) {
            return $this->idContentCache[$hash];
        }

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->contentRepository->countByTypes($types, $groupBy));
        }

        $this->idContentCache[$hash] = $results;

        return $this->idContentCache[$hash];
    }

    /**
     * @param $userId
     * @param $state
     * @return array
     */
    public function getFiltersForUserProgressState($userId, $state)
    {
        return $this->contentRepository->getFiltersUserProgressState($userId, $state);
    }

    public function getByChildId($childId)
    {
        $hash = 'contents_by_child_id_'.'_'.CacheHelper::getKey($childId);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB = $this->contentRepository->getByChildId($childId);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(Arr::pluck($resultsDB, 'id'), [$childId]));
        }

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param $contentId
     * @return array|ContentEntity
     */
    public function calculateTotalXp($contentId)
    {
        $content = $this->getById($contentId);
        $children = $this->getByParentId($content['id']);

        $childrenTotalXP = 0;
        foreach ($children as $child) {
            $childrenTotalXP += $child->fetch(
                'total_xp',
                $this->getDefaultXP($child['type'], $child->fetch('fields.difficulty', 0))
            );
        }

        $contentTotalXp = $content->fetch(
                'fields.xp',
                $this->getDefaultXP($content['type'], $content->fetch('fields.difficulty', 0))
            ) + $childrenTotalXP;

        return $this->update($contentId, ['total_xp' => $contentTotalXp]);
    }

    /**
     * @param $contentIds
     * @return array
     */
    public function calculateTotalXpForContents($contentIds)
    {
        $contentTotalXp = [];

        $children =
            $this->getByParentIds($contentIds)
                ->groupBy('parent_id');

        $childrenTotalXP = array_fill_keys(array_keys($children->toArray()), 0);

        foreach ($children as $parentId => $child) {
            foreach ($child as $childO) {
                $childDifficulty = ContentHelper::getFieldValue([$childO['id']], 'difficulty');
                $childrenTotalXP[$parentId] += $childO['total_xp']
                    ??
                    $this->getDefaultXP($childO['type'], $childDifficulty ?? 0);
            }
        }

        $parentsCollection = new Collection($this->contentRepository->getByIds($contentIds));
        $parents =
            $parentsCollection->keyBy('id')
                ->toArray();

        foreach ($parents as $id => $content) {
            $contentDifficulty = ContentHelper::getFieldValue([$content['id']], 'difficulty');
            $childrenXp = $childrenTotalXP[$id] ?? 0;
            $contentTotalXp[$id] =
                ($content['xp'] ?? $this->getDefaultXP($content['type'], $contentDifficulty ?? 0)) + $childrenXp;
        }

        return $contentTotalXp;
    }

    public function getDefaultXP($type, $difficulty)
    {
        $defaultBasedOnDifficulty =
            config('xp_ranks.difficulty_xp_map')[$difficulty] ?? config('xp_ranks.difficulty_xp_map.all');

        if ($type == 'pack') {
            $defaultXp = config('xp_ranks.pack_content_completed');
        } elseif ($type == 'pack_bundle') {
            $defaultXp = config('xp_ranks.pack_bundle_content_completed');
        } elseif ($type == 'learning_path') {
            $defaultXp = config('xp_ranks.learning_path_content_completed');
        } elseif ($type == 'course') {
            $defaultXp = config('xp_ranks.course_content_completed');
        } elseif ($type == 'song') {
            $defaultXp = config('xp_ranks.song_content_completed') ?? $defaultBasedOnDifficulty;
        } elseif ($type == 'assignment') {
            $defaultXp = config('xp_ranks.assignment_content_completed');
        } elseif ($type == 'unit') {
            $defaultXp = config('xp_ranks.unit_content_completed');
        } else {
            $defaultXp = $defaultBasedOnDifficulty;
        }

        return $defaultXp;
    }

    /**
     * @param $contentId
     * @return array
     */
    public function getElasticData($contentId)
    {
        $content = $this->getContentForElastic($contentId);

        $topics = $this->contentTopicRepository->getByContentIds([$content['id']]);
        $styles = $this->contentStyleRepository->getByContentIds([$content['id']]);
        $instructors = $this->contentInstructorRepository->getByContentIds([$content['id']]);
        $bpm = $this->contentBpmRepository->getByContentIds([$content['id']]);
        if (isset($content['video'])) {
            $video = $this->contentRepository->getById($content['video']);

            $vimeoVideoId = $video ? $video['vimeo_video_id'] : '';
            $youtubeVideoId = $video ? $video['youtube_video_id'] : '';
        }

        $permissions =
            $this->contentPermissionRepository->query()
                ->select('permission_id')
                ->where('content_id', $content['id'])
                ->orWhere('content_type', $content['type'])
                ->orderBy('id', 'asc')
                ->get();

        $data = $this->datumRepository->getByContentIdAndKey($content['id'], 'description');

        $document = [
            'content_id' => $content['id'],
            'title' => utf8_encode($content['title'] ?? ''),
            'slug' => utf8_encode($content['slug'] ?? ''),
            'name' => utf8_encode($content['name'] ?? ''),
            'difficulty' => $content['difficulty'] ?? null,
            'description' => (!empty($data)) ? $data[0]['value'] : '',
            'status' => $content['status'],
            'brand' => $content['brand'],
            'style' => Arr::pluck($styles, 'style'),
            'instructor' => Arr::pluck($instructors, 'id'),
            'internal_video_id' => $content['video'] ?? '',
            'vimeo_video_id' => $vimeoVideoId ?? '',
            'youtube_video_id' => $youtubeVideoId ?? '',
            'content_type' => $content['type'],
            'published_on' => $content['published_on'],
            'created_on' => $content['created_on'],
            'topic' => Arr::pluck($topics, 'topic'),
            'bpm' => Arr::pluck($bpm, 'bpm'),
            'staff_pick_rating' => $content['staff_pick_rating'] ?? null,
            'is_coach' => $content['is_coach'] ?? 0,
            'is_active' => $content['is_active'] ?? 0,
            'is_coach_of_the_month' => $content['is_coach_of_the_month'] ?? 0,
            'is_featured' => $content['is_featured'] ?? 0,
            'associated_user_id' => $content['associated_user_id'] ?? null,
            'popularity' => $content['popularity'] ?? 0,
            'permission_ids' => $permissions->pluck('permission_id')
                ->toArray(),
        ];

        return $document;
    }

    /**
     * Call the getElasticContentById method from repository and return the data for elasticsearch documents
     *
     * @param integer $id
     * @return ContentEntity|array|null
     */
    public function getContentForElastic($id)
    {
        return $this->contentRepository->getElasticContentById($id);
    }

    /**
     * @param $contentType
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getElasticDataByContentType($contentType)
    {
        $contents = $this->contentRepository->getByType($contentType);
        $documents = [];
        foreach ($contents as $contentRow) {
            $content = $this->getContentForElastic($contentRow['id']);

            $topics = $this->contentTopicRepository->getByContentIds([$contentRow['id']]);
            $styles = $this->contentStyleRepository->getByContentIds([$contentRow['id']]);
            $instructors = $this->contentInstructorRepository->getByContentIds([$contentRow['id']]);
            $bpm = $this->contentBpmRepository->getByContentIds([$contentRow['id']]);
            if (isset($contentRow['video'])) {
                $video = $this->contentRepository->getById($contentRow['video']);

                $vimeoVideoId = $video ? $video['vimeo_video_id'] : '';
                $youtubeVideoId = $video ? $video['youtube_video_id'] : '';
            }

            $permissions =
                $this->contentPermissionRepository->query()
                    ->select('permission_id')
                    ->where('content_id', $contentRow['id'])
                    ->orWhere('content_type', $contentRow['type'])
                    ->orderBy('id', 'asc')
                    ->get();

            $documents[$contentRow['id']] = [
                'content_id' => $contentRow['id'],
                'title' => utf8_encode($content['title'] ?? ''),
                'slug' => utf8_encode($content['slug'] ?? ''),
                'name' => utf8_encode($content['name'] ?? ''),
                'description' => utf8_encode($content['description'] ?? ''),
                'difficulty' => $content['difficulty'] ?? null,
                'status' => $content['status'],
                'brand' => $content['brand'],
                'style' => Arr::pluck($styles, 'style'),
                'instructor' => Arr::pluck($instructors, 'id'),
                'internal_video_id' => $content['video'] ?? '',
                'vimeo_video_id' => $vimeoVideoId ?? '',
                'youtube_video_id' => $youtubeVideoId ?? '',
                'content_type' => $content['type'],
                'published_on' => $content['published_on'],
                'created_on' => $content['created_on'],
                'topic' => Arr::pluck($topics, 'topic'),
                'bpm' => Arr::pluck($bpm, 'bpm'),
                'staff_pick_rating' => $content['staff_pick_rating'] ?? null,
                'is_coach' => $content['is_coach'] ?? 0,
                'is_active' => $content['is_active'] ?? 0,
                'is_coach_of_the_month' => $content['is_coach_of_the_month'] ?? 0,
                'is_featured' => $content['is_featured'] ?? 0,
                'associated_user_id' => $content['associated_user_id'] ?? null,
                'popularity' => $content['popularity'] ?? 0,
                'permission_ids' => $permissions->pluck('permission_id')
                    ->toArray(),
            ];
        }

        return $documents;
    }

    public function fillParentContentDataColumnForContentIds(array $contentIds)
    {
        $hierarchyRows =
            $this->contentRepository->query()
                ->from(config('railcontent.table_prefix').'content_hierarchy as rch1')
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp1',
                    'rcp1.id',
                    '=',
                    'rch1.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content_hierarchy as rch2',
                    'rch2.child_id',
                    '=',
                    'rch1.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp2',
                    'rcp2.id',
                    '=',
                    'rch2.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content_hierarchy as rch3',
                    'rch3.child_id',
                    '=',
                    'rch2.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp3',
                    'rcp3.id',
                    '=',
                    'rch3.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content_hierarchy as rch4',
                    'rch4.child_id',
                    '=',
                    'rch3.parent_id'
                )
                ->leftJoin(
                    config('railcontent.table_prefix').'content as rcp4',
                    'rcp4.id',
                    '=',
                    'rch4.parent_id'
                )
                ->select([
                    'rch1.child_id as rch1_child_id',
                    'rch1.parent_id as rch1_parent_id',
                    'rch1.child_position as rch1_child_position',
                    'rcp1.id as rcp1_content_id',
                    'rcp1.slug as rcp1_content_slug',
                    'rcp1.type as rcp1_content_type',
                    'rch2.child_id as rch2_child_id',
                    'rch2.parent_id as rch2_parent_id',
                    'rch2.child_position as rch2_child_position',
                    'rcp2.id as rcp2_content_id',
                    'rcp2.slug as rcp2_content_slug',
                    'rcp2.type as rcp2_content_type',
                    'rch3.child_id as rch3_child_id',
                    'rch3.parent_id as rch3_parent_id',
                    'rch3.child_position as rch3_child_position',
                    'rcp3.id as rcp3_content_id',
                    'rcp3.slug as rcp3_content_slug',
                    'rcp3.type as rcp3_content_type',
                    'rch4.child_id as rch4_child_id',
                    'rch4.parent_id as rch4_parent_id',
                    'rch4.child_position as rch4_child_position',
                    'rcp4.id as rcp4_content_id',
                    'rcp4.slug as rcp4_content_slug',
                    'rcp4.type as rcp4_content_type',
                ])
                ->whereIn('rch1.child_id', $contentIds)
                ->get();

        $cases = [];
        $ids = [];
        $params = [];

        foreach ($contentIds as $contentId) {
            $hierarchyData =
                $hierarchyRows->where('rch1_child_id', $contentId)
                    ->first();

            if (!empty($hierarchyData)) {
                $parentContentDataForDatabase = [];

                if (!empty($hierarchyData['rch1_parent_id']) &&
                    !empty($hierarchyData['rcp1_content_id']) &&
                    !empty($hierarchyData['rcp1_content_slug'])) {
                    $parentContentDataForDatabase[] = (object)[
                        'id' => $hierarchyData['rcp1_content_id'],
                        'slug' => $hierarchyData['rcp1_content_slug'],
                        'type' => $hierarchyData['rcp1_content_type'],
                        'position' => $hierarchyData['rch2_child_position'],
                    ];
                }

                if (!empty($hierarchyData['rch2_parent_id']) &&
                    !empty($hierarchyData['rcp2_content_id']) &&
                    !empty($hierarchyData['rcp2_content_slug'])) {
                    $parentContentDataForDatabase[] = (object)[
                        'id' => $hierarchyData['rcp2_content_id'],
                        'slug' => $hierarchyData['rcp2_content_slug'],
                        'type' => $hierarchyData['rcp2_content_type'],
                        'position' => $hierarchyData['rch3_child_position'],
                    ];
                }

                if (!empty($hierarchyData['rch3_parent_id']) &&
                    !empty($hierarchyData['rcp3_content_id']) &&
                    !empty($hierarchyData['rcp3_content_slug'])) {
                    $parentContentDataForDatabase[] = (object)[
                        'id' => $hierarchyData['rcp3_content_id'],
                        'slug' => $hierarchyData['rcp3_content_slug'],
                        'type' => $hierarchyData['rcp3_content_type'],
                        'position' => $hierarchyData['rch4_child_position'],
                    ];
                }

                if (!empty($hierarchyData['rch4_parent_id']) &&
                    !empty($hierarchyData['rcp4_content_id']) &&
                    !empty($hierarchyData['rcp4_content_slug'])) {
                    $parentContentDataForDatabase[] = (object)[
                        'id' => $hierarchyData['rcp4_content_id'],
                        'slug' => $hierarchyData['rcp4_content_slug'],
                        'type' => $hierarchyData['rcp4_content_type'],
                        'position' => null,
                    ];
                }

                // save

                if (!empty($parentContentDataForDatabase)) {
                    $cases[] = "WHEN {$contentId} then ?";
                    $params[] = json_encode($parentContentDataForDatabase);
                    $ids[] = $contentId;
                } elseif (!empty($contentRow->parent_content_data)) {
                    $cases[] = "WHEN {$contentId} then ?";
                    $params[] = null;
                    $ids[] = $contentId;
                }
            }
        }

        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);

        if (!empty($ids)) {
            DB::connection(config('railcontent.database_connection_name'))
                ->update(
                    "UPDATE railcontent_content SET `parent_content_data` = CASE `id` {$cases} END WHERE `id` in ({$ids})",
                    $params
                );
        }

        return true;
    }

    /**
     * @param $parentContentId
     * @param $userId
     * @return array|ContentEntity
     */
    public function getNextContentForParentContentForUser($parentContentId, $userId)
    {
        $isParentComplete =
            $this->contentRepository->connectionMask()->table('railcontent_user_content_progress')
                ->where(['content_id' => $parentContentId, 'user_id' => $userId, 'state' => 'complete'])
                ->exists();

        $contentHierarchyDataQuery =
            $this->contentRepository->connectionMask()->table('railcontent_content_hierarchy AS ch_1')
                ->leftJoin('railcontent_content_hierarchy AS ch_2', 'ch_2.parent_id', '=', 'ch_1.child_id')
                ->leftJoin('railcontent_content_hierarchy AS ch_3', 'ch_3.parent_id', '=', 'ch_2.child_id')
                ->leftJoin('railcontent_content_hierarchy AS ch_4', 'ch_4.parent_id', '=', 'ch_3.child_id')
                ->leftJoin('railcontent_content AS ch_1_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_1_child.id', '=', 'ch_1.child_id')
                        ->whereNot('ch_1_child.type', 'assignment')
                        ->where('ch_1_child.status', '=', 'published')
                        ->where(
                            'ch_1_child.published_on',
                            '<',
                            Carbon::now()
                                ->toDateTimeString()
                        );
                })
                ->leftJoin('railcontent_content AS ch_2_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_2_child.id', '=', 'ch_2.child_id')
                        ->whereNot('ch_2_child.type', 'assignment')
                        ->where('ch_2_child.status', '=', 'published')
                        ->where(
                            'ch_2_child.published_on',
                            '<',
                            Carbon::now()
                                ->toDateTimeString()
                        );
                })
                ->leftJoin('railcontent_content AS ch_3_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_3_child.id', '=', 'ch_3.child_id')
                        ->whereNot('ch_3_child.type', 'assignment')
                        ->where('ch_2_child.status', '=', 'published')
                        ->where(
                            'ch_2_child.published_on',
                            '<',
                            Carbon::now()
                                ->toDateTimeString()
                        );
                })
                ->leftJoin('railcontent_content AS ch_4_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_4_child.id', '=', 'ch_4.child_id')
                        ->whereNot('ch_4_child.type', 'assignment')
                        ->where('ch_2_child.status', '=', 'published')
                        ->where(
                            'ch_2_child.published_on',
                            '<',
                            Carbon::now()
                                ->toDateTimeString()
                        );
                })
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_1',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_1.content_id', '=', 'ch_1.child_id')
                            ->where('ucp_1.user_id', $userId);
                    }
                )
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_2',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_2.content_id', '=', 'ch_2.child_id')
                            ->where('ucp_2.user_id', $userId);
                    }
                )
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_3',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_3.content_id', '=', 'ch_3.child_id')
                            ->where('ucp_3.user_id', $userId);
                    }
                )
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_4',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_4.content_id', '=', 'ch_4.child_id')
                            ->where('ucp_4.user_id', $userId);
                    }
                )
                ->select([
                    'ch_1.parent_id AS ch_1_parent_id',
                    'ch_2.parent_id AS ch_2_parent_id',
                    'ch_3.parent_id AS ch_3_parent_id',
                    'ch_4.parent_id AS ch_4_parent_id',
                    'ch_1.child_id AS ch_1_child_id',
                    'ch_2.child_id AS ch_2_child_id',
                    'ch_3.child_id AS ch_3_child_id',
                    'ch_4.child_id AS ch_4_child_id',
                    'ch_1.child_position AS ch_1_child_position',
                    'ch_2.child_position AS ch_2_child_position',
                    'ch_3.child_position AS ch_3_child_position',
                    'ch_4.child_position AS ch_4_child_position',
                    'ch_1_child.slug AS ch_1_child_slug',
                    'ch_2_child.slug AS ch_2_child_slug',
                    'ch_3_child.slug AS ch_3_child_slug',
                    'ch_4_child.slug AS ch_4_child_slug',
                    'ucp_1.state AS ucp_1_state',
                    'ucp_2.state AS ucp_2_state',
                    'ucp_3.state AS ucp_3_state',
                    'ucp_4.state AS ucp_4_state',
                ])
                ->where('ch_1.parent_id', $parentContentId)
                ->orderBy('ch_1.child_position')
                ->orderBy('ch_2.child_position')
                ->orderBy('ch_3.child_position')
                ->orderBy('ch_4.child_position')
                ->limit(1);

        // if the parent is complete, then just return the first lesson, otherwise get the next uncomplete lesson
        if (!$isParentComplete) {
            $contentHierarchyDataQuery->where($this->databaseManager->raw('IFNULL(ucp_1.state, "")'), '!=', 'completed')
                ->where($this->databaseManager->raw('IFNULL(ucp_2.state, "")'), '!=', 'completed')
                ->where($this->databaseManager->raw('IFNULL(ucp_3.state, "")'), '!=', 'completed')
                ->where($this->databaseManager->raw('IFNULL(ucp_4.state, "")'), '!=', 'completed');
        }

        $contentHierarchyDataRow =
            $contentHierarchyDataQuery->get()
                ->first();

        $contentId = null;

        if (!empty($contentHierarchyDataRow)) {
            if (!empty($contentHierarchyDataRow['ch_4_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_4_child_id'];
            } elseif (!empty($contentHierarchyDataRow['ch_3_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_3_child_id'];
            } elseif (!empty($contentHierarchyDataRow['ch_2_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_2_child_id'];
            } elseif (!empty($contentHierarchyDataRow['ch_1_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_1_child_id'];
            }
        }

        if (!empty($contentId)) {
            return $this->getById($contentId);
        }

        return null;
    }

    /**
     * @param $parentContentId
     * @param $userId
     * @return void
     */
    public function getLatestActiveContentForParentContentForUser($parentContentId, $userId)
    {
    }

    public function fillCompiledViewContentDataColumnForContentIds(array $contentIds)
    {
        /*
         * Keys:
         * title
         * instructor_names
         * type
         * difficulty
         * description
         * song_styles
         * song_artist
         * song_album
         * coach_name
         * coach_focus_text
         */
        $contentRowsById =
            $this->contentRepository->connectionMask()->table('railcontent_content')
                ->whereIn('id', $contentIds)
                ->get()
                ->keyBy('id');

        // content fields are the source of truth at the moment but that will change eventually
        $contentsFieldRows =
            $this->contentRepository->connectionMask()->table('railcontent_content_fields')
                ->whereIn('content_id', $contentIds)
                ->get();

        $contentsFieldRowsByContentId = $contentsFieldRows->groupBy('content_id');

        $contentsDataRowsByContentId =
            $this->contentRepository->connectionMask()->table('railcontent_content_data')
                ->whereIn('content_id', $contentIds)
                ->get()
                ->groupBy('content_id');

        // get all content that is linked via field
        $keysThatLinkToOtherContent = config('railcontent.compiled_column_mapping_sub_content_field_keys');
        $linkedContentIds =
            $contentsFieldRows->whereIn('key', $keysThatLinkToOtherContent)
                ->pluck('value');

        $contentsFieldLinkedContentRowsById = collect();
        $contentsFieldLinkedContentsFieldRowsById = collect();
        $contentsFieldLinkedContentsDataRowsById = collect();

        if (!empty($linkedContentIds)) {
            $contentsFieldLinkedContentRowsById =
                $this->contentRepository->connectionMask()->table('railcontent_content')
                    ->whereIn('id', $linkedContentIds)
                    ->get()
                    ->keyBy('id');

            $contentsFieldLinkedContentsFieldRowsById =
                $this->contentRepository->connectionMask()->table('railcontent_content_fields')
                    ->whereIn('content_id', $linkedContentIds)
                    ->get()
                    ->groupBy('content_id');

            $contentsFieldLinkedContentsDataRowsById =
                $this->contentRepository->connectionMask()->table('railcontent_content_data')
                    ->whereIn('content_id', $linkedContentIds)
                    ->get()
                    ->groupBy('content_id');
        }

        $cases = [];
        $ids = [];
        $params = [];

        foreach ($contentIds as $contentId) {
            $contentRow = $contentRowsById[$contentId];

            if (!empty($contentRow)) {
                // compile
                $contentFieldRows = $contentsFieldRowsByContentId[$contentId] ?? collect();
                $contentDataRows = $contentsDataRowsByContentId[$contentId] ?? collect();

                $jsonArray = $this->compileContentData($contentRow, $contentFieldRows, $contentDataRows);

                // handle contents linked by fields
                foreach ($linkedContentIds as $linkedContentId) {
                    $linkedContentRow = $contentsFieldLinkedContentRowsById[$linkedContentId] ?? [];
                    $linkedContentFieldRows = $contentsFieldRowsByContentId[$linkedContentId] ?? collect();
                    $linkedContentDataRows = $contentsDataRowsByContentId[$linkedContentId] ?? collect();

                    if (!empty($linkedContentRow)) {
                        $subContentJsonArray = $this->compileContentData(
                            $linkedContentRow,
                            $linkedContentFieldRows,
                            $linkedContentDataRows
                        );

                        // substitute the field id with the compiled data
                        foreach ($jsonArray as $jsonArrayKey => $jsonArrayValue) {
                            if (in_array($jsonArrayKey, $keysThatLinkToOtherContent) && !empty($subContentJsonArray)) {
                                if (is_array($jsonArrayValue)) {
                                    foreach ($jsonArrayValue as $jsonArraySubKey => $jsonArraySubValue) {
                                        if ((integer)$jsonArraySubValue == $linkedContentRow['id'] &&
                                            $jsonArraySubKey !== 'id') {
                                            $jsonArray[$jsonArrayKey][$jsonArraySubKey] = $subContentJsonArray;
                                        }
                                    }
                                } elseif ((integer)$jsonArrayValue == $linkedContentRow['id']) {
                                    $jsonArray[$jsonArrayKey] = $subContentJsonArray;
                                }

                                // always set length in seconds on parent content data as well
                                if (isset($subContentJsonArray['length_in_seconds'])) {
                                    $jsonArray['length_in_seconds'] = $subContentJsonArray['length_in_seconds'];
                                }
                            }
                        }
                    }
                }

                // add a few shorthand compiled keys for easy usage
                // instructor_names
                $instructorNames = [];

                foreach ($jsonArray as $jsonArrayKey => $jsonArrayValue) {
                    if ($jsonArrayKey == 'instructor') {
                        if (is_array($jsonArrayValue) && empty($jsonArrayValue['id'])) {
                            foreach ($jsonArrayValue as $jsonArraySubValue) {
                                if (!empty($jsonArraySubValue['name'])) {
                                    $instructorNames[] = $jsonArraySubValue['name'];
                                }
                            }
                        } else {
                            if (!empty($jsonArrayValue['name'])) {
                                $instructorNames[] = $jsonArrayValue['name'];
                            }
                        }
                    }
                }

                if (!empty($instructorNames)) {
                    $jsonArray['instructor_names'] = $instructorNames;
                }

                // remove compiled view data from json data
                foreach ($jsonArray as $jsonArrayKey => $jsonArrayValue) {
                    if ($jsonArrayKey == 'compiled_view_data') {
                        unset($jsonArray[$jsonArrayKey]);
                    }
                }

                // save
                if (!empty($jsonArray)) {
                    $cases[] = "WHEN {$contentId} then ?";
                    $params[] = json_encode($jsonArray);
                    $ids[] = $contentId;
                } elseif (!empty($contentRow->compiled_view_data)) {
                    $cases[] = "WHEN {$contentId} then ?";
                    $params[] = null;
                    $ids[] = $contentId;
                }
            }
        }

        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);

        if (!empty($ids)) {
            DB::connection(config('railcontent.database_connection_name'))
                ->update(
                    "UPDATE railcontent_content SET `compiled_view_data` = CASE `id` {$cases} END WHERE `id` in ({$ids})",
                    $params
                );
        }

        return true;
    }

    /**
     * @param $contentRow
     * @param \Illuminate\Support\Collection $contentFieldRows
     * @param \Illuminate\Support\Collection $contentDataRows
     * @return array
     */
    public function compileContentData(
        $contentRow,
        \Illuminate\Support\Collection $contentFieldRows,
        \Illuminate\Support\Collection $contentDataRows
    ) {
        $compiledData = (array)$contentRow;

        // remove null/empty values
        foreach ($compiledData as $contentRowColumnKey => $contentRowColumnValue) {
            if (empty($contentRowColumnValue)) {
                unset($compiledData[$contentRowColumnKey]);
            }
        }

        $contentFieldDataRows = $contentFieldRows->merge($contentDataRows);
        $contentFieldDataRowsGroupedByKey = $contentFieldDataRows->groupBy('key');

        foreach ($contentFieldDataRowsGroupedByKey as $key => $rows) {
            foreach ($rows as $row) {
                // skip empty values except 0
                if ($row['value'] === '' || $row['value'] === null) {
                    continue;
                }

                if (!isset($compiledData[$key])) {
                    $compiledData[$key] = $row['value'];
                } elseif (isset($compiledData[$key]) && !is_array($compiledData[$key])) {
                    $existingValue = $compiledData[$key];
                    $compiledData[$key] = [$existingValue, $row['value']];
                } elseif (is_array($compiledData[$key])) {
                    $compiledData[$key][] = $row['value'];
                }

                // remove dupes
                if (is_array($compiledData[$key]) &&
                    (!in_array($key, config('railcontent.compiled_columns_that_should_allow_dups', [])))) {
                    $compiledData[$key] = array_unique($compiledData[$key]);
                }

                // if its an array with a single value, change it back to a single value instead of an array
                if (is_array($compiledData[$key]) && count($compiledData[$key]) === 1) {
                    $compiledData[$key] = reset($compiledData[$key]);
                }
            }
        }

        return $compiledData;
    }

    /**
     * @param null $brand
     * @param null $limit
     * @param int $page
     * @return ContentFilterResultsEntity|Collection
     */
    public function getScheduledContent($brand = null, $limit = null, $page = 1)
    {
        $liveEventsTypes = array_merge(
            (array)config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [],
            (array)config('railcontent.liveContentTypes', [])
        );
        $contentReleasesTypes = array_merge(
            (array)config('railcontent.showTypes', [])[config('railcontent.brand')] ?? [],
            (array)config('railcontent.contentReleaseContentTypes', [])
        );

        if (empty($liveEventsTypes) && empty($contentReleasesTypes)) {
            // Accommodates AddEvent calling this method from Musora, where railcontent config is different than expected.
            $liveEventsTypes = array_merge(
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.showTypes', []),
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.liveContentTypes', [])
            );
            $contentReleasesTypes = array_merge(
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.showTypes', []),
                (array)config('railcontent.calendar-content-types-by-brand.'.$brand.'.contentReleaseContentTypes', [])
            );
        }

        $oldStatuses = ContentRepository::$availableContentStatues;
        $oldFutureContent = ContentRepository::$pullFutureContent;

        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        $types = array_merge($liveEventsTypes, $contentReleasesTypes);

        if (empty($types)) {
            return new Collection();
        }

        $scheduleEvents = $this->contentRepository->getWhereTypeInAndStatusInAndPublishedOnOrderedAndPaginated(
            $types,
            [ContentService::STATUS_SCHEDULED, ContentService::STATUS_PUBLISHED],
            Carbon::now()
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc',
            [],
            $limit,
            $page
        );
        $countEvents = $this->contentRepository->countByTypeInAndStatusInAndPublishedOn($types,
            [ContentService::STATUS_SCHEDULED, ContentService::STATUS_PUBLISHED],
            Carbon::now()
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc',
            []);

        ContentRepository::$availableContentStatues = $oldStatuses;
        ContentRepository::$pullFutureContent = $oldFutureContent;

        $results = new ContentFilterResultsEntity([
            'results' => $scheduleEvents,
            'total_results' => $countEvents,
        ]);

        return Decorator::decorate($results, 'content');
    }

    /**
     * Get ordered contents by type, status and published_on date.
     *
     * @param array $types
     * @param string $status
     * @param string $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param integer $limit
     * @return array|Collection|ContentEntity[]
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
        $scheduleEvents = Decorator::decorate(
            $this->contentRepository->getWhereTypeInAndStatusInAndPublishedOnOrderedAndPaginated(
                $types,
                $status,
                $publishedOnValue,
                $publishedOnComparisonOperator,
                $orderByColumn,
                $orderByDirection,
                $requiredField,
                $limit,
                $page
            ),
            'content'
        );
        $countEvents = $this->contentRepository->countByTypeInAndStatusInAndPublishedOn($types,
            [ContentService::STATUS_SCHEDULED],
            Carbon::now()
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc',
            []);

        return new ContentFilterResultsEntity([
            'results' => $scheduleEvents,
            'total_results' => $countEvents,
        ]);
    }

    /**
     * @param $videoId
     * @return \Illuminate\Support\Collection
     */
    public function getContentWithExternalVideoId($videoId)
    {
        return $this->contentVideoRepository->getContentWithExternalVideoId($videoId);
    }

    public function getNextCohortLesson($parentContentId, $userId)
    {
        $isParentComplete =
            $this->contentRepository->connectionMask()->table('railcontent_user_content_progress')
                ->where(['content_id' => $parentContentId, 'user_id' => $userId, 'state' => 'completed'])
                ->exists();

        $contentHierarchyDataQuery =
            $this->contentRepository->connectionMask()->table('railcontent_content_hierarchy AS ch_1')
                ->leftJoin('railcontent_content_hierarchy AS ch_2', 'ch_2.parent_id', '=', 'ch_1.child_id')
                ->leftJoin('railcontent_content_hierarchy AS ch_3', 'ch_3.parent_id', '=', 'ch_2.child_id')
                ->leftJoin('railcontent_content_hierarchy AS ch_4', 'ch_4.parent_id', '=', 'ch_3.child_id')
                ->leftJoin('railcontent_content AS ch_1_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_1_child.id', '=', 'ch_1.child_id')
                        ->whereNot('ch_1_child.type', 'assignment');
                })
                ->leftJoin('railcontent_content AS ch_2_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_2_child.id', '=', 'ch_2.child_id')
                        ->whereNot('ch_2_child.type', 'assignment');
                })
                ->leftJoin('railcontent_content AS ch_3_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_3_child.id', '=', 'ch_3.child_id')
                        ->whereNot('ch_3_child.type', 'assignment');
                })
                ->leftJoin('railcontent_content AS ch_4_child', function (JoinClause $joinClause) {
                    return $joinClause->on('ch_4_child.id', '=', 'ch_4.child_id')
                        ->whereNot('ch_4_child.type', 'assignment');
                })
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_1',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_1.content_id', '=', 'ch_1.child_id')
                            ->where('ucp_1.user_id', $userId);
                    }
                )
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_2',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_2.content_id', '=', 'ch_2.child_id')
                            ->where('ucp_2.user_id', $userId);
                    }
                )
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_3',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_3.content_id', '=', 'ch_3.child_id')
                            ->where('ucp_3.user_id', $userId);
                    }
                )
                ->leftJoin(
                    'railcontent_user_content_progress AS ucp_4',
                    function (JoinClause $joinClause) use ($userId) {
                        return $joinClause->on('ucp_4.content_id', '=', 'ch_4.child_id')
                            ->where('ucp_4.user_id', $userId);
                    }
                )
                ->select([
                    'ch_1.parent_id AS ch_1_parent_id',
                    'ch_2.parent_id AS ch_2_parent_id',
                    'ch_3.parent_id AS ch_3_parent_id',
                    'ch_4.parent_id AS ch_4_parent_id',
                    'ch_1.child_id AS ch_1_child_id',
                    'ch_2.child_id AS ch_2_child_id',
                    'ch_3.child_id AS ch_3_child_id',
                    'ch_4.child_id AS ch_4_child_id',
                    'ch_1.child_position AS ch_1_child_position',
                    'ch_2.child_position AS ch_2_child_position',
                    'ch_3.child_position AS ch_3_child_position',
                    'ch_4.child_position AS ch_4_child_position',
                    'ch_1_child.slug AS ch_1_child_slug',
                    'ch_2_child.slug AS ch_2_child_slug',
                    'ch_3_child.slug AS ch_3_child_slug',
                    'ch_4_child.slug AS ch_4_child_slug',
                    'ucp_1.state AS ucp_1_state',
                    'ucp_2.state AS ucp_2_state',
                    'ucp_3.state AS ucp_3_state',
                    'ucp_4.state AS ucp_4_state',
                ])
                ->where('ch_1.parent_id', $parentContentId)
                ->orderBy('ch_1.child_position')
                ->orderBy('ch_2.child_position')
                ->orderBy('ch_3.child_position')
                ->orderBy('ch_4.child_position')
                ->limit(1);

        // if the parent is complete, then just return the first lesson, otherwise get the next uncomplete lesson
        if (!$isParentComplete) {
            $contentHierarchyDataQuery->where($this->databaseManager->raw('IFNULL(ucp_1.state, "")'), '!=', 'completed')
                ->where($this->databaseManager->raw('IFNULL(ucp_2.state, "")'), '!=', 'completed')
                ->where($this->databaseManager->raw('IFNULL(ucp_3.state, "")'), '!=', 'completed')
                ->where($this->databaseManager->raw('IFNULL(ucp_4.state, "")'), '!=', 'completed');
        }

        $contentHierarchyDataRow =
            $contentHierarchyDataQuery->get()
                ->first();

        $contentId = null;

        if (!empty($contentHierarchyDataRow)) {
            if (!empty($contentHierarchyDataRow['ch_4_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_4_child_id'];
            } elseif (!empty($contentHierarchyDataRow['ch_3_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_3_child_id'];
            } elseif (!empty($contentHierarchyDataRow['ch_2_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_2_child_id'];
            } elseif (!empty($contentHierarchyDataRow['ch_1_child_slug'])) {
                $contentId = $contentHierarchyDataRow['ch_1_child_id'];
            }
        }

        if (!empty($contentId)) {
            $pullFutureContent = ContentRepository::$pullFutureContent;
            ContentRepository::$pullFutureContent = true;
            $content = $this->getById($contentId);
            ContentRepository::$pullFutureContent = $pullFutureContent;
            return $content;
        }

        return null;
    }

    /**
     * @param $contentId
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countLessonsAndAssignments($contentId)
    {
        $singularContentTypes = array_merge(
            config('railcontent.showTypes')[config('railcontent.brand')] ?? [],
            config('railcontent.singularContentTypes')
        );
        $results = [];
        $lessons = [];

        $content = $this->getById($contentId);
        if (!$content) {
            return $results;
        }
        if (in_array($content['type'], $singularContentTypes)) {
            $soundsliceAssingment = 0;
            $assign = [];
            $assignments = $this->contentRepository->getByParentId($content['id']);
            foreach ($assignments as $assignment) {
                if (isset($assignment['soundslice_slug'])) {
                    $soundsliceAssingment++;
                    $assign[] = $assignment;
                }
            }
            $results['soundslice_assignments_count'] = $soundsliceAssingment;
            $results['soundslice_assignments'][$content['id']] = $assign;
            if ($content['type'] == 'song') {
                if ($content['instrumentless']) {
                    $results['song_instrumentless_assignment'] = $assign;
                    $results['soundslice_assignments_count'] = 2;
                }
                $results['song_full_assignment'] = $assign;
            }
        } elseif (in_array(
                $content['type'],
                config('railcontent.content_multiple_level_content_depth_playlist_allowed', [])
            ) || (in_array($content['brand'] ,['singeo', 'guitareo']) && $content['type'] == 'learning-path-level')) {
            ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
            $lessons = $this->getByParentId($content['id']);
            $soundsliceAssingment = 0;
            $assign = [];
            $lessonsCount = 0;

            foreach ($lessons as $lesson) {
                $assignments = $this->getByParentIdWhereTypeIn($lesson['id'], ['assignment']);
                foreach ($assignments ?? [] as $assignment) {
                    if ($assignment->fetch('soundslice_slug')) {
                        $soundsliceAssingment++;
                        $assign[$lesson['id']][] = $assignment;
                    }
                }
                $lessonsCount++;
            }

            $results['lessons_count'] = $lessonsCount;
            $results['lessons'] = $lessons;
            $results['soundslice_assignments_count'] = $soundsliceAssingment;
            $results['soundslice_assignments'] = $assign;
        } elseif (in_array($content['type'], ['pack'])) {
            $soundsliceAssingment = 0;
            $assign = [];
            $lessonsCount = 0;
            $allLessons = [];
            $bundles = $this->contentRepository->getByParentId($content['id']);
            foreach ($bundles as $bundle) {
                $lessons = $this->contentRepository->getByParentId($bundle['id']);
                foreach ($lessons as $lesson) {
                    $lessonsCount++;
                    array_push($allLessons, $lesson);
                    $assignments = $this->contentRepository->getByParentId($lesson['id']);
                    foreach ($assignments ?? [] as $lessonAssignment) {
                        if (isset($lessonAssignment['soundslice_slug'])) {
                            $soundsliceAssingment++;
                            $assign[$lesson['id']][] = $lessonAssignment;
                        }
                    }
                }
            }
            $results['lessons_count'] = $lessonsCount;
            $results['lessons'] = $allLessons;
            $results['soundslice_assignments_count'] = $soundsliceAssingment;
            $results['soundslice_assignments'] = $assign;
        }

        return $results;
    }
}
