<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\VersionRepository;

class ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository, $versionRepository;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * ContentService constructor.
     *
     * @param ContentRepository $contentRepository
     */
    public function __construct(ContentRepository $contentRepository, VersionRepository $versionRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
    }

    /**
     * @param int $page
     * @param int $amount
     * @param array $statues
     * @param array $types
     * @param array $requiredFields
     * @param null $parentSlug
     * @param bool $includeFuturePublishedOn
     */
    public function getPaginated(
        $page,
        $amount,
        array $statues = [],
        array $types = [],
        array $requiredFields = [],
        $parentSlug = null,
        $includeFuturePublishedOn = false
    ) {
        $parentId = null;

        if (!is_null($parentSlug)) {
            $parentId = $this->getBySlug($parentSlug);
        }

        // WIP
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

    /**
     * Get old version content based on the versionId, restore the content data, link fields and datum
     * @param integer $versionId
     * @return bool
     */
    public function restoreContent($versionId)
    {
        //get saved content version from database
        $restoredContentVersion = $this->versionRepository->get($versionId);

        $contentId = $restoredContentVersion['content_id'];

        //unserialize content
        $oldContent = unserialize($restoredContentVersion['data']);

        //update content with version data
        $this->contentRepository->update(
            $contentId,
            $oldContent['slug'],
            $oldContent['status'],
            $oldContent['type'],
            $oldContent['position'],
            $oldContent['parent_id'],
            $oldContent['published_on'],
            $oldContent['archived_on']
        );


        // unlink all fields and data
        $this->contentRepository->unlinkField($contentId);
        $this->contentRepository->unlinkDatum($contentId);

        //link fields from content version
        if(array_key_exists('fields', $oldContent))
        {
            foreach ($oldContent['fields'] as $key=>$value)
            {
                $this->contentRepository->linkField($contentId, $key);
            }
        }

        //link datum from content version
        if(array_key_exists('datum', $oldContent))
        {
            foreach ($oldContent['datum'] as $key=>$value)
            {
                $this->contentRepository->linkDatum($contentId, $key);
            }
        }

        return $this->contentRepository->getById($contentId);
    }
}