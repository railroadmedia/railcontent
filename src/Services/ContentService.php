<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
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
     * @var ContentPermissionsRepository
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
     * @param CommentAssignmentRepository $commentAssignationRepository
     * @param UserContentProgressRepository
     *
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
     * @return array|null
     */
    public function getById($id)
    {
        $hash = 'content_' . CacheHelper::getKey($id);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($id, $hash) {
            $results = $this->contentRepository->getById($id);
            $this->saveCacheResults($hash, [$id]);
            return $results;
        });

        return $results;
    }

    /**
     * Call the get by ids method from repository
     *
     * @param integer[] $ids
     * @return array|null
     */
    public function getByIds($ids)
    {
        $hash = 'contents_ids_' . CacheHelper::getKey(...$ids);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($ids, $hash) {
            return $this->contentRepository->getByIds($ids);
        });
        $this->saveCacheResults($hash, $ids);

        return $results;
    }

    /**
     * Get content based on the slug hierarchy, for example if you have course lessons as children of
     * a course, you can pull the course lesson using the slugs:
     *
     * getBySlugHierarchy('my-parent-course-content-slug', 'my-child-course-lesson-slug');
     *
     *
     * @param array ...$slugs
     * @return array
     */
    public function getBySlugHierarchy(...$slugs)
    {
        return $this->contentRepository->getBySlugHierarchy($slugs);
    }

    /**
     * @param string $slug
     * @param string $type
     * @return array
     */
    public function getAllByType($type)
    {
        $hash = 'contents_by_type_' . CacheHelper::getKey($type);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($type, $hash) {
            $res = $this->contentRepository->getByType($type);
            $this->saveCacheResults($hash, array_keys($res));
            return $res;
        });

        return $results;
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
        $hash = 'contents_by_type_field_and_status_' . CacheHelper::getKey($types,
                $status,
                $fieldKey,
                $fieldValue,
                $fieldType,
                $fieldComparisonOperator);

        $results = Cache::store('redis')->rememberForever($hash, function () use (
            $hash,
            $types,
            $status,
            $fieldKey,
            $fieldValue,
            $fieldType,
            $fieldComparisonOperator
        ) {
            $res = $this->contentRepository->getWhereTypeInAndStatusAndField(
                $types,
                $status,
                $fieldKey,
                $fieldValue,
                $fieldType,
                $fieldComparisonOperator
            );
            $this->saveCacheResults($hash, array_keys($res));
            return $res;
        });

        return $results;
    }

    /**
     * @param array $types
     * @param $status
     * @param $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
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
        $hash = 'contents_by_type_status_published_' . CacheHelper::getKey(implode(' ',$types),
                $status,
                $publishedOnValue,
                $publishedOnComparisonOperator,
                $orderByColumn,
                $orderByDirection);

        $results = Cache::store('redis')->rememberForever($hash, function () use (
            $hash,
            $types,
            $status,
            $publishedOnValue,
            $publishedOnComparisonOperator,
            $orderByColumn,
            $orderByDirection
        ) {
            $res = $this->contentRepository->getWhereTypeInAndStatusAndPublishedOnOrdered(
                $types,
                $status,
                $publishedOnValue,
                $publishedOnComparisonOperator,
                $orderByColumn,
                $orderByDirection
            );
            $this->saveCacheResults($hash, array_keys($res));
            return $res;
        });

        return $results;
    }

    /**
     * @param string $slug
     * @param string $type
     * @return array
     */
    public function getBySlugAndType($slug, $type)
    {
        $hash = 'contents_by_slug_type' . CacheHelper::getKey($slug, $type);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($hash, $slug, $type) {
            $results = $this->contentRepository->getBySlugAndType($slug, $type);
            $this->saveCacheResults($hash, array_keys($results));
            return $results;
        });

        return $results;
    }

    /**
     * @param $userId
     * @param $type
     * @param $slug
     * @return array
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        $hash = 'contents_by_user_slug_type' . CacheHelper::getKey($userId, $type, $slug);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($hash, $userId, $slug, $type) {
            $results = $this->contentRepository->getByUserIdTypeSlug($userId, $type, $slug);
            $this->saveCacheResults($hash, array_keys($results));
            return $results;
        });

        return $results;
    }

    /**
     * @param integer $parentId
     * @return array
     */
    public function getByParentId($parentId, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        $hash = 'contents_by_parent_id_'. CacheHelper::getKey($parentId, $orderBy, $orderByDirection);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($hash, $parentId, $orderBy, $orderByDirection) {
            //dd('se cheama rep');
            $results = $this->contentRepository->getByParentId($parentId, $orderBy, $orderByDirection);
            $this->saveCacheResults($hash, array_merge(array_keys($results),[$parentId]));
            //$this->saveCacheResults($hash, [$parentId]);
            return $results;
        });

        return $results;

    }

    /**
     * @param integer $parentId
     * @return array
     */
    public function getByParentIds(array $parentIds, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        return $this->contentRepository->getByParentIds($parentIds, $orderBy, $orderByDirection);
    }

    /**
     * @param $childId
     * @param $type
     * @return array
     */
    public function getByChildIdWhereType($childId, $type)
    {
        return $this->contentRepository->getByChildIdWhereType($childId, $type);
    }


    /**
     * @param $childId
     * @param $type
     * @return array
     */
    public function getByChildIdsWhereType(array $childIds, $type)
    {
        return $this->contentRepository->getByChildIdsWhereType($childIds, $type);
    }

    /**
     * @param $childId
     * @param array $types
     * @return array
     */
    public function getByChildIdWhereParentTypeIn($childId, array $types)
    {
        return $this->contentRepository->getByChildIdWhereParentTypeIn($childId, $types);
    }

    /**
     * @param $type
     * @param $userId
     * @param $state
     * @param int $limit
     * @param int $skip
     * @return array
     */
    public function getPaginatedByTypeUserProgressState($type, $userId, $state, $limit = 25, $skip = 0)
    {
        return $this->contentRepository->getPaginatedByTypeUserProgressState(
            $type,
            $userId,
            $state,
            $limit,
            $skip
        );
    }

    /**
     * @param array $types
     * @param $userId
     * @param $state
     * @param int $limit
     * @param int $skip
     * @return array
     */
    public function getPaginatedByTypesUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0
    ) {
        return $this->contentRepository->getPaginatedByTypesUserProgressState(
            $types,
            $userId,
            $state,
            $limit,
            $skip
        );
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
     * @return array|null
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

        $hash = 'contents_results_' . CacheHelper::getKey($page,
                $limit,
                $orderByColumn,
                $orderByDirection,
                implode(' ', array_values($includedTypes) ?? ''),
                implode(' ', array_values($slugHierarchy) ?? ''),
                implode(' ', array_values(array_collapse($requiredParentIds)) ?? ''),
                implode(' ', array_values(array_collapse($requiredFields)) ?? ''),
                implode(' ', array_values(array_collapse($includedFields)) ?? ''),
                implode(' ', array_values(array_collapse($requiredUserStates)) ?? ''),
                implode(' ', array_values(array_collapse($includedUserStates)) ?? ''));

        $results = Cache::store('redis')->rememberForever($hash, function () use ($hash,
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
            $includedUserStates) {
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

            $res = [
                'results' => $filter->retrieveFilter(),
                'total_results' => $filter->countFilter(),
                'filter_options' => $filter->getFilterFields()];
            $this->saveCacheResults($hash, array_keys($res['results']));
            return $res;
        });
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
     * @return array
     */
    public function create(
        $slug,
        $type,
        $status,
        $language,
        $brand,
        $userId,
        $publishedOn,
        $parentId = null
    ) {
        $id =
            $this->contentRepository->create(
                [
                    'slug' => $slug,
                    'type' => $type,
                    'status' => $status ?? self::STATUS_DRAFT,
                    'language' => $language ?? ConfigService::$defaultLanguage,
                    'brand' => $brand ?? ConfigService::$brand,
                    'user_id' => $userId,
                    'published_on' => $publishedOn,
                    'created_on' => Carbon::now()->toDateTimeString()
                ]
            );

        //save the link with parent if the parent id exist on the request
        if ($parentId) {
            $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
                $parentId,
                $id,
                null
            );

        }
        event(new ContentCreated($id));

        //delete all the search results from cache
        CacheHelper::deleteAllCachedSearchResults('contents_results_');

        return $this->getById($id);
    }

    /**
     * Update and return the updated content.
     *
     * @param integer $id
     * @param array $data
     * @return array
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

        CacheHelper::deleteCache('content_' . $id);

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
     * @param $contents
     * @param null $singlePlaylistSlug
     * @return array
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
     * @return array
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

        return $this->contentRepository->softDelete([$id]);
    }

    public function softDeleteContentChildren($id)
    {
        $children = $this->contentHierarchyRepository->getByParentIds([$id]);

        return $this->contentRepository->softDelete(array_pluck($children, 'child_id'));
    }

    private function saveCacheResults($hash, $contentIds)
    {
        CacheHelper::addLists($hash, $contentIds);

        return true;

    }
}