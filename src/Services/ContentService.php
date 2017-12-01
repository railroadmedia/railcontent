<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentVersionRepository;

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
     */
    public function __construct(
        ContentRepository $contentRepository,
        ContentVersionRepository $versionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository,
        ContentHierarchyRepository $contentHierarchyRepository
    ) {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
    }

    /**
     * Call the get by id method from repository and return the content
     *
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        return $this->contentRepository->getById($id);
    }

    /**
     * Call the get by ids method from repository
     *
     * @param integer[] $ids
     * @return array|null
     */
    public function getByIds($ids)
    {
        return $this->contentRepository->getByIds($ids);
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
        return $this->contentRepository->getByType($type);
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
        return $this->contentRepository->getWhereTypeInAndStatusAndField(
            $types,
            $status,
            $fieldKey,
            $fieldValue,
            $fieldType,
            $fieldComparisonOperator
        );
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
        return $this->contentRepository->getWhereTypeInAndStatusAndPublishedOnOrdered(
            $types,
            $status,
            $publishedOnValue,
            $publishedOnComparisonOperator,
            $orderByColumn,
            $orderByDirection
        );
    }

    /**
     * @param string $slug
     * @param string $type
     * @return array
     */
    public function getBySlugAndType($slug, $type)
    {
        return $this->contentRepository->getBySlugAndType($slug, $type);
    }

    /**
     * @param $userId
     * @param $type
     * @param $slug
     * @return array
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        return $this->contentRepository->getByUserIdTypeSlug($userId, $type, $slug);
    }

    /**
     * @param integer $parentId
     * @return array
     */
    public function getByParentId($parentId, $orderBy = 'child_position', $orderByDirection = 'asc')
    {
        return $this->contentRepository->getByParentId($parentId, $orderBy, $orderByDirection);
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
     * @param array $types
     * @return array
     */
    public function getByChildIdWhereTypes($childId, array $types)
    {
        return $this->contentRepository->getByChildIdWhereTypes($childId, $types);
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
    public function getPaginatedByTypesUserProgressState(array $types, $userId, $state, $limit = 25, $skip = 0)
    {
        return $this->contentRepository->getPaginatedByTypeUserProgressState(
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

        return [
            'results' => $filter->retrieveFilter(),
            'total_results' => $filter->countFilter(),
            'filter_options' => $filter->getFilterFields()
        ];
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
     * @return array
     */
    public function create(
        $slug,
        $type,
        $status,
        $language,
        $brand,
        $userId,
        $publishedOn
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
                    'created_on' => Carbon::now()->toDateTimeString(),
                ]
            );

        event(new ContentCreated($id));

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

        return $this->contentRepository->delete($id);
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
}