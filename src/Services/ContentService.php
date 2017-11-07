<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
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

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * ContentService constructor.
     *
     * @param ContentRepository $contentRepository
     * @param ContentVersionRepository $versionRepository
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     */
    public function __construct(
        ContentRepository $contentRepository,
        ContentVersionRepository $versionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository
    ) {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
    }

    /**
     * Call the get by id method from repository and return the category
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
    public function getBySlugAndType($slug, $type)
    {
        return $this->contentRepository->getBySlugAndType($slug, $type);
    }

    /**
     * @param integer $parentId
     * @return array
     */
    public function getByParentId($parentId)
    {
        return $this->contentRepository->getByParentId($parentId);
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
        $orderByAndDirection,
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
     * @param string|null $createdOn
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

        //if the content not exist return null
        if(!$content){
            return $content;
        }

        //call the event that save a new content version in the database
        event(new ContentUpdated($id));

        $this->contentRepository->update($id, $data);

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

        //if the content not exist return null
        if(!$content){
            return $content;
        }

        event(new ContentUpdated($id));
        return $this->contentRepository->delete($id);
    }

    /**
     * Return a string with the linked contents Ids
     *
     * @param integer $contentId
     * @return string
     */
    public function linkedWithContent($contentId)
    {
        $linkedWithContent = $this->contentRepository->getLinkedContent($contentId);

        $linkedContentsIds = implode(',', array_pluck($linkedWithContent, ['content_id']));

        request()->request->add(
            [
                'linked_content_ids' => $linkedContentsIds
            ]
        );

        return $linkedContentsIds;
    }
}