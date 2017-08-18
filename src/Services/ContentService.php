<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;

class ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * ContentService constructor.
     *
     * @param ContentRepository $contentRepository
     */
    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function getPaginated(
        $page,
        $amount,
        array $statues = [],
        array $types = [],
        $parentSlug = null,
        $includeFuturePublishedOn = false
    ) {
        $parentId = null;

        if (!is_null($parentSlug)) {
            $parentId = $this->getBySlug($parentSlug);
        }
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
     * Call the get by id method from repository and return the category
     *
     * @param string $slug
     * @param int|null $parentSlug
     * @return array|null
     */
    public function getBySlug($slug, $parentSlug = null)
    {
        $parentId = null;

        if (!is_null($parentSlug)) {
            $parentId = $this->getBySlug($parentSlug);
        }

        return $this->contentRepository->getBySlug($slug, $parentId);
    }

    /**
     * Call the create method from ContentRepository and return the new created content
     *
     * @param string $slug
     * @param string $status
     * @param string $type
     * @param integer $position
     * @param integer $parentId
     * @param string|null $publishedOn
     * @return array
     */
    public function create($slug, $status, $type, $position, $parentId, $publishedOn = null)
    {
        $id = $this->contentRepository->create($slug, $status, $type, $position, $parentId, $publishedOn);

        return $this->contentRepository->getById($id);
    }

    /**
     * Call the update method from Category repository and return the category
     *
     * @param integer $id
     * @param string $slug
     * @param integer $position
     * @param string $status
     * @param string $type
     * @param integer $parentId
     * @param string|null $publishedOn
     * @param string|null $archivedOn
     * @return array
     */
    public function update(
        $id,
        $slug,
        $status,
        $type,
        $position,
        $parentId,
        $publishedOn,
        $archivedOn
    ) {
        $this->contentRepository->update(
            $id,
            $slug,
            $status,
            $type,
            $position,
            $parentId,
            $publishedOn,
            $archivedOn
        );

        return $this->getById($id);
    }

    /**
     * Call the delete method from repository and returns true if the category was deleted
     *
     * @param integer $id
     * @param bool $deleteChildren
     * @return bool
     */
    public function delete($id, $deleteChildren = false)
    {
        return $this->contentRepository->delete($id, $deleteChildren) > 0;
    }
}