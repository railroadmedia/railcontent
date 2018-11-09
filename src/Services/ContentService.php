<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentVersionRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Support\Collection;

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

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_DELETED = 'deleted';

    /**
     * ContentService constructor.
     *
     * @param ContentRepository $contentRepository
     * @param ContentVersionRepository $versionRepository
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param ContentPermissionRepository $contentPermissionRepository
     * @param CommentRepository $commentRepository
     * @param CommentAssignmentRepository $commentAssignmentRepository
     * @param UserContentProgressRepository $userContentProgressRepository
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
        UserContentProgressRepository $userContentProgressRepository
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
    }

    /**
     * Call the get by id method from repository and return the content
     *
     * @param integer $id
     * @return ContentEntity|array|null
     */
    public function getById($id)
    {
        $hash = 'contents_by_id_' . CacheHelper::getKey($id);

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->query()
                    ->selectPrimaryColumns()
                    ->restrictByUserAccess()
                    ->where(ConfigService::$tableContent . '.id', $id)
                    ->first(),
                [$id]
            );
        }
        return $results;
    }

    /**
     * Call the get by ids method from repository
     *
     * @param integer[] $ids
     * @return array|Collection|ContentEntity[]
     */
    public function getByIds($ids)
    {
        $hash = 'contents_by_ids_' . CacheHelper::getKey(...$ids);

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $unorderedContentRows = $this->contentRepository->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->whereIn(ConfigService::$tableContent . '.id', $ids)
                ->get();

            // restore order of ids passed in
            $contentRows = [];
            foreach ($ids as $id) {
                foreach ($unorderedContentRows as $index => $unorderedContentRow) {
                    if ($id == $unorderedContentRow['id']) {
                        $contentRows[] = $unorderedContentRow;
                    }
                }
            }
            $results = CacheHelper::saveUserCache(
                $hash,
                $contentRows
            );
        }

        return $results;
    }

    /**
     * Get all contents with specified type.
     *
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getAllByType($type)
    {
        $hash = 'contents_by_type_' . $type . '_' . CacheHelper::getKey($type);

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->query()
                    ->selectPrimaryColumns()
                    ->restrictByUserAccess()
                    ->where('type', $type)
                    ->get()
            );
        }

        return $results;
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
        $hash = 'contents_by_types_field_and_status_' . CacheHelper::getKey(
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
                $this->contentRepository->query()
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
                    ->get()
            );
        }

        return $results;
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
     * @return array|Collection|ContentEntity[]
     */
    public function getWhereTypeInAndStatusAndPublishedOnOrdered(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'published_on',
        $orderByDirection = 'desc'
    ) {
        return $this->contentRepository->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->whereIn('type', $types)
            ->where('status', $status)
            ->where(
                'published_on',
                $publishedOnComparisonOperator,
                $publishedOnValue
            )
            ->orderBy($orderByColumn, $orderByDirection)
            ->get();
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
        $hash = 'contents_by_slug_type_' . $type . '_' . CacheHelper::getKey($slug, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->query()
                    ->selectPrimaryColumns()
                    ->restrictByUserAccess()
                    ->where('slug', $slug)
                    ->where('type', $type)
                    ->get()
            );
        }

        return $results;
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
        $hash = 'contents_by_user_slug_type_' . $type . '_' . CacheHelper::getKey($userId, $type, $slug);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->query()
                    ->selectPrimaryColumns()
                    ->restrictByUserAccess()
                    ->where('slug', $slug)
                    ->where('type', $type)
                    ->where(ConfigService::$tableContent . '.user_id', $userId)
                    ->get()
            );
        }

        return $results;
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
        $hash = 'contents_by_parent_id_' . CacheHelper::getKey($parentId, $orderBy, $orderByDirection);
        $results = CacheHelper::getCachedResultsForKey($hash);
        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
                    ->selectPrimaryColumns()
                    ->restrictByUserAccess()
                    ->selectInheritenceColumns()
                    ->leftJoin(
                        ConfigService::$tableContentHierarchy,
                        ConfigService::$tableContentHierarchy . '.child_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )
                    ->orderBy($orderBy, $orderByDirection, ConfigService::$tableContentHierarchy)
                    ->where(ConfigService::$tableContentHierarchy . '.parent_id', $parentId)
            ->get();
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), [$parentId]));
        }

        return $results;
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
            'contents_by_parent_id_paginated_' .
            CacheHelper::getKey($parentId, $limit, $skip, $orderBy, $orderByDirection);

        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();

            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), [$parentId]));
        }

        return $results;
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
        $hash = 'contents_by_parent_id_type_' . CacheHelper::getKey($parentId, $types, $orderBy, $orderByDirection);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), [$parentId]));
        }

        return $results;
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
        $hash = 'contents_by_parent_id_type_in_' . CacheHelper::getKey(
                $parentId,
                $types,
                $limit,
                $skip,
                $orderBy,
                $orderByDirection
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), [$parentId]));
        }

        return $results;
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
        return $this->contentRepository->query()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableContentHierarchy,
                ConfigService::$tableContentHierarchy . '.child_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->where(ConfigService::$tableContentHierarchy . '.parent_id', $parentId)
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->count();
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
        $hash = 'contents_by_parent_ids_' . CacheHelper::getKey($parentIds, $orderBy, $orderByDirection);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), $parentIds));
        }

        return $results;
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
        $hash = 'contents_by_child_id_and_type_' . $type . '_' . CacheHelper::getKey($childId, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), [$childId]));
        }

        return $results;
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
        $hash = 'contents_by_child_ids_and_type_' . $type . '_' . CacheHelper::getKey($childIds, $type);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), $childIds));
        }

        return $results;
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
        $hash = 'contents_by_child_ids_and_parent_types_' . CacheHelper::getKey($childId, $types);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (is_null($results)) {
            $resultsDB =
                $this->contentRepository->query()
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
                    ->get();
            //->getByChildIdWhereParentTypeIn($childId, $types);
            $results =
                CacheHelper::saveUserCache($hash, $resultsDB, array_merge(array_pluck($resultsDB, 'id'), [$childId]));
        }

        return $results;
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
        $hash = 'contents_paginated_by_type_' . $type . '_and_user_progress_' . $userId . '_' . CacheHelper::getKey(
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
                $this->contentRepository->query()
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
                    ->get()
            );
        }

        return $results;
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
        $hash = 'contents_paginated_by_types_and_user_progress_' . $userId . '_' . CacheHelper::getKey(
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
                $this->contentRepository->query()
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
                    ->get()
            );
        }

        return $results;
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
        $hash = 'contents_paginated_by_types_and_user_progress_' . $userId . '_' . CacheHelper::getKey(
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
                $this->contentRepository->query()
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
                    ->get()
            );
        }

        return $results;
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
        return $this->contentRepository->query()
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
        $orderDirection = 'desc'
    ) {
        $hash = 'contents_type_neighbouring_siblings_' . CacheHelper::getKey(
                $type,
                $columnName,
                $columnValue,
                $siblingPairLimit,
                $orderColumn,
                $orderDirection
            );

        // $5 sez we can remove this
        $this->contentRepository->query()->getTypeNeighbouringSiblings(
            $type,
            $columnName,
            $columnValue,
            $siblingPairLimit,
            $orderColumn,
            $orderDirection
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
                    $orderDirection
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
        $results =
            $this->contentRepository->query()
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

        return $results;
    }

    /**
     * Get filtered contents.
     * Returns:
     * ['results' => $lessons, 'total_results' => $totalLessonsAfterFiltering]
     *
     * @param int $page
     * @param int $limit
     * @param string $orderByAndDirection
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredFields
     * @param array $includedFields
     * @param array $requiredUserStates
     * @param array $includedUserStates
     * @param boolean $pullFilterFields
     * @return ContentFilterResultsEntity
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
        $pullFilterFields = true
    ) {
        $results = null;
        if ($limit == 'null') {
            $limit = -1;
        }
        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($orderByAndDirection, '-');
        $hash = 'contents_results_' . CacheHelper::getKey(
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
                implode(' ', array_values($includedUserStates) ?? '')
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
                $requiredParentIds
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
            $resultsDB = new ContentFilterResultsEntity(
                [
                    'results' => $this->contentRepository->query()->retrieveFilter(),
                    'total_results' => $this->contentRepository->query()->countFilter(),
                    'filter_options' => $pullFilterFields ? $this->contentRepository->query()->getFilterFields() : [],
                ]
            );
            $results = CacheHelper::saveUserCache($hash, $resultsDB, array_pluck($resultsDB['results'], 'id'));
            $results = new ContentFilterResultsEntity($results);
        }
        return $results;
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
        $sort = 0
    ) {
        $content = $this->contentRepository->create(
            [
                'slug' => $slug,
                'type' => $type,
                'sort' => $sort,
                'status' => $status ?? self::STATUS_DRAFT,
                'language' => $language ?? ConfigService::$defaultLanguage,
                'brand' => $brand ?? ConfigService::$brand,
                'user_id' => $userId,
                'published_on' => $publishedOn,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        //save the link with parent if the parent id exist on the request
        if ($parentId) {
            $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
                $parentId,
                $content['id'],
                null
            );
        }

        CacheHelper::deleteUserFields(null, 'contents');

        event(new ContentCreated($content['id']));

        return $this->getById($content['id']);
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
        $content = $this->contentRepository->read($id);
        if (empty($content)) {
            return null;
        }

        $this->contentRepository->update($id, $data);

        event(new ContentUpdated($id));

        CacheHelper::deleteCache('content_' . $id);

        if (array_key_exists('status', $data)) {
            CacheHelper::deleteUserFields(null, 'contents');
        }

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
        $content = $this->contentRepository->read($id);

        if (empty($content)) {
            return null;
        }
        event(new ContentDeleted($id));

        CacheHelper::deleteCache('content_' . $id);

        return $this->contentRepository->destroy($id);
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

        $this->commentAssignationRepository->query()->whereIn('comment_id', array_pluck($comments, 'id'))->delete() ;
            //->deleteCommentAssignations(array_pluck($comments, 'id'));

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

        CacheHelper::deleteCache('content_' . $id);

        return $this->contentRepository->query()
            ->whereIn('id', [$id])
            ->update(
                ['status' => ContentService::STATUS_DELETED]
            );
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
        CacheHelper::deleteCache('content_' . $id);

        return $this->contentRepository->query()
            ->whereIn('id', array_pluck($children, 'child_id'))
            ->update(
                ['status' => ContentService::STATUS_DELETED]
            );
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
        $hash = 'contents_by_types_and_field_value_' . CacheHelper::getKey(
                $contentTypes,
                $contentFieldKey,
                $contentFieldValues
            );
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache(
                $hash,
                $this->contentRepository->query()
                    ->restrictByUserAccess()
                    ->addSelect(
                        [
                            ConfigService::$tableContent . '.id as id',
                        ]
                    )
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
                    ->get()
            );
        }

        return $results;
    }
}