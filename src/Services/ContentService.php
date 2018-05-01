<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentEntity;
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

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($id, $hash) {

                $results = $this->contentRepository->getById($id);
                $this->saveCacheResults($hash, [$id]);

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
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

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($ids, $hash) {

                return $this->contentRepository->getByIds($ids);
            }
        );
        $this->saveCacheResults($hash, $ids);

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getAllByType($type)
    {
        $hash = 'contents_by_type_' . $type . '_' . CacheHelper::getKey($type);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($type, $hash) {
                $results = $this->contentRepository->getByType($type);
                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param array $types
     * @param $status
     * @param $fieldKey
     * @param $fieldValue
     * @param $fieldType
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

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use (
                $hash,
                $types,
                $status,
                $fieldKey,
                $fieldValue,
                $fieldType,
                $fieldComparisonOperator
            ) {
                $results = $this->contentRepository->getWhereTypeInAndStatusAndField(
                    $types,
                    $status,
                    $fieldKey,
                    $fieldValue,
                    $fieldType,
                    $fieldComparisonOperator
                );
                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param array $types
     * @param $status
     * @param $publishedOnValue
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
        return Decorator::decorate(
            $this->contentRepository->getWhereTypeInAndStatusAndPublishedOnOrdered(
                $types,
                $status,
                $publishedOnValue,
                $publishedOnComparisonOperator,
                $orderByColumn,
                $orderByDirection
            ),
            'content'
        );
    }

    /**
     * @param string $slug
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getBySlugAndType($slug, $type)
    {
        $hash = 'contents_by_slug_type_' . $type . '_' . CacheHelper::getKey($slug, $type);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $slug, $type) {
                $results = $this->contentRepository->getBySlugAndType($slug, $type);
                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param $userId
     * @param $type
     * @param $slug
     * @return array|Collection|ContentEntity[]
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        $hash = 'contents_by_user_slug_type_' . $type . '_' . CacheHelper::getKey($userId, $type, $slug);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $userId, $slug, $type) {
                $results = $this->contentRepository->getByUserIdTypeSlug($userId, $type, $slug);
                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param integer $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentId($parentId, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $hash = 'contents_by_parent_id_' . CacheHelper::getKey($parentId, $orderBy, $orderByDirection);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $parentId, $orderBy, $orderByDirection) {
                $results = $this->contentRepository->getByParentId($parentId, $orderBy, $orderByDirection);
                $this->saveCacheResults($hash, array_merge(array_keys($results), [$parentId]));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');

    }

    /**
     * @param integer $parentId
     * @param $types
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
        $hash = 'contents_by_parent_id_type_' .
            CacheHelper::getKey($parentId, $types, $orderBy, $orderByDirection);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $parentId, $types, $orderBy, $orderByDirection) {
                $results = $this->contentRepository->getByParentIdWhereTypeIn(
                    $parentId,
                    $types,
                    $orderBy,
                    $orderByDirection
                );
                $this->saveCacheResults($hash, array_merge(array_keys($results), [$parentId]));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');

    }

    /**
     * @param array $parentIds
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIds(array $parentIds, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $hash = 'contents_by_parent_ids_' . CacheHelper::getKey($parentIds, $orderBy, $orderByDirection);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $parentIds, $orderBy, $orderByDirection) {
                $results = $this->contentRepository->getByParentIds($parentIds, $orderBy, $orderByDirection);
                $this->saveCacheResults($hash, array_merge(array_keys($results), $parentIds));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param $childId
     * @param $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdWhereType($childId, $type)
    {
        $hash = 'contents_by_child_id_and_type_' . $type . '_' . CacheHelper::getKey($childId, $type);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $childId, $type) {
                $results = $this->contentRepository->getByChildIdWhereType($childId, $type);
                $this->saveCacheResults($hash, array_merge(array_keys($results), [$childId]));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param array $childIds
     * @param $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdsWhereType(array $childIds, $type)
    {
        $hash = 'contents_by_child_ids_and_type_' . $type . '_' . CacheHelper::getKey($childIds, $type);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $childIds, $type) {
                $results = $this->contentRepository->getByChildIdsWhereType($childIds, $type);
                $this->saveCacheResults($hash, array_merge(array_keys($results), $childIds));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param $childId
     * @param array $types
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdWhereParentTypeIn($childId, array $types)
    {
        $hash = 'contents_by_child_ids_and_parent_types_' . CacheHelper::getKey($childId, $types);

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $childId, $types) {
                $results = $this->contentRepository->getByChildIdWhereParentTypeIn($childId, $types);
                $this->saveCacheResults($hash, array_merge(array_keys($results), [$childId]));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param $type
     * @param $userId
     * @param $state
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

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $type, $userId, $state, $limit, $skip) {
                $results = $this->contentRepository->getPaginatedByTypeUserProgressState(
                    $type,
                    $userId,
                    $state,
                    $limit,
                    $skip
                );
                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param array $types
     * @param $userId
     * @param $state
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

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $types, $userId, $state, $limit, $skip) {
                $results = $this->contentRepository->getPaginatedByTypesUserProgressState(
                    $types,
                    $userId,
                    $state,
                    $limit,
                    $skip
                );
                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
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

        $this->contentRepository->getTypeNeighbouringSiblings(
            $type,
            $columnName,
            $columnValue,
            $siblingPairLimit,
            $orderColumn,
            $orderDirection
        );

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use (
                $hash,
                $type,
                $columnName,
                $columnValue,
                $siblingPairLimit,
                $orderColumn,
                $orderDirection
            ) {
                $results = $this->contentRepository->getTypeNeighbouringSiblings(
                    $type,
                    $columnName,
                    $columnValue,
                    $siblingPairLimit,
                    $orderColumn,
                    $orderDirection
                );

                $this->saveCacheResults($hash, array_keys($results));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /**
     * @param array $types
     * @param $userId
     * @param $state
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
     *
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
     * @return array|Collection|ContentEntity[]
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
        array $includedUserStates = []
    ) {
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
                implode(' ', array_values(array_collapse($requiredParentIds)) ?? ''),
                implode(' ', array_values(array_collapse($requiredFields)) ?? ''),
                implode(' ', array_values(array_collapse($includedFields)) ?? ''),
                implode(' ', array_values(array_collapse($requiredUserStates)) ?? ''),
                implode(' ', array_values(array_collapse($includedUserStates)) ?? '')
            );

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use (
                $hash,
                $page,
                $limit,
                $orderByColumn,
                $orderByDirection,
                $includedTypes,
                $slugHierarchy,
                $requiredParentIds,
                $requiredFields,
                $includedFields,
                $requiredUserStates,
                $includedUserStates
            ) {
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
                    $filter->requireField(...$requiredField);
                }

                foreach ($includedFields as $includedField) {
                    $filter->includeField(...$includedField);
                }

                foreach ($requiredUserStates as $requiredUserState) {
                    $filter->requireUserStates(...$requiredUserState);
                }

                foreach ($includedUserStates as $includedUserState) {
                    $filter->includeUserStates(...$includedUserState);
                }

                $results = [
                    'results' => $filter->retrieveFilter(),
                    'total_results' => $filter->countFilter(),
                    'filter_options' => $filter->getFilterFields(),
                ];
                $this->saveCacheResults($hash, array_keys($results['results']));

                return $results;
            }
        );

        return Decorator::decorate($results, 'content');
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
        $id =
            $this->contentRepository->create(
                [
                    'slug' => $slug,
                    'type' => $type,
                    'sort' => $sort,
                    'status' => $status ?? self::STATUS_DRAFT,
                    'language' => $language ?? ConfigService::$defaultLanguage,
                    'brand' => $brand ?? ConfigService::$brand,
                    'user_id' => $userId,
                    'published_on' => $publishedOn,
                    'created_on' => Carbon::now()->toDateTimeString(),
                ]
            );

        //save the link with parent if the parent id exist on the request
        if ($parentId) {
            $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
                $parentId,
                $id,
                null
            );

            //delete all the results related to the user's progress
            CacheHelper::deleteAllCachedSearchResults('user_');

        }
        event(new ContentCreated($id));

        //delete all the search results from cache
        CacheHelper::deleteAllCachedSearchResults('contents_results_');

        CacheHelper::deleteAllCachedSearchResults('_type_' . $type);

        CacheHelper::deleteAllCachedSearchResults('types');

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
        $content = $this->getById($id);

        if (empty($content)) {
            return null;
        }

        $this->contentRepository->update($id, $data);

        event(new ContentUpdated($id));

        CacheHelper::deleteCache('content_list_' . $id);

        //delete all the search results from cache
        CacheHelper::deleteAllCachedSearchResults('contents_results_');
        CacheHelper::deleteAllCachedSearchResults('_type_' . $content['type']);
        CacheHelper::deleteAllCachedSearchResults('types_');

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
        $content = $this->getById($id);

        if (empty($content)) {
            return null;
        }
        event(new ContentDeleted($id));

        CacheHelper::deleteCache('content_list_' . $id);

        return $this->contentRepository->delete($id);
    }

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

        $this->commentAssignationRepository->deleteCommentAssignations(array_pluck($comments, 'id'));

        $this->commentRepository->deleteByContentId($contentId);

        //delete content playlists
        $this->userContentProgressRepository->deleteByContentId($contentId);
    }

    /**
     * @param $userId
     * @param $contentOrContents
     * @param null $singlePlaylistSlug
     * @return array|Collection|ContentEntity[]
     */
    public function attachPlaylistsToContents($userId, $contentOrContents, $singlePlaylistSlug = null)
    {
        $isArray = !isset($contentOrContents['id']);

        if (!$isArray) {
            $contentOrContents = [$contentOrContents];
        }

        $userPlaylistContents = $this->contentRepository->getByUserIdWhereChildIdIn(
            $userId,
            array_column($contentOrContents, 'id'),
            $singlePlaylistSlug
        );

        $contentsHierarchy = $this->contentHierarchyRepository->getByParentIds(
            array_column($userPlaylistContents, 'parent_id')
        );

        foreach ($contentOrContents as $index => $content) {
            $contentOrContents[$index]['user_playlists'][$userId] = [];

            foreach ($userPlaylistContents as $userPlaylistContent) {
                foreach ($contentsHierarchy as $contentHierarchy) {

                    if ($contentHierarchy['parent_id'] == $userPlaylistContent['id'] &&
                        $contentHierarchy['child_id'] == $content['id']) {
                        $contentOrContents[$index]['user_playlists'][$userId][] = $userPlaylistContent;
                    }
                }
            }
        }

        if ($isArray) {
            return $contentOrContents;
        } else {
            return reset($contentOrContents);
        }
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

        CacheHelper::deleteCache('content_list_' . $id);

        return $this->contentRepository->softDelete([$id]);
    }

    public function softDeleteContentChildren($id)
    {
        $children = $this->contentHierarchyRepository->getByParentIds([$id]);

        //delete parent content cache
        CacheHelper::deleteCache('content_list_' . $id);

        return $this->contentRepository->softDelete(array_pluck($children, 'child_id'));
    }

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

        $results = Cache::store(ConfigService::$cacheDriver)->remember(
            $hash,
            ConfigService::$cacheTime,
            function () use ($hash, $contentTypes, $contentFieldKey, $contentFieldValues) {
                $results = $this->contentRepository->getByContentFieldValuesForTypes(
                    $contentTypes,
                    $contentFieldKey,
                    $contentFieldValues
                );
                $this->saveCacheResults($hash, array_keys($results));

                return Decorator::decorate($results, 'content');
            }
        );

        return Decorator::decorate($results, 'content');
    }

    /** Call the method that save in a redis set the mapping between content ids and the method cache key
     *
     * @param string $hash
     * @param array $contentIds
     * @return bool
     */
    private function saveCacheResults($hash, $contentIds)
    {
        CacheHelper::addLists($hash, $contentIds);

        return true;
    }
}