<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\DatumRepository;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Repositories\VersionRepository;

class ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository, $versionRepository, $fieldRepository, $datumRepository;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    /**
     * ContentService constructor.
     *
     * @param ContentRepository $contentRepository
     */
    public function __construct(
        ContentRepository $contentRepository,
        VersionRepository $versionRepository,
        FieldRepository $fieldRepository,
        DatumRepository $datumRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
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
        $orderByDirection,
        $orderByColumn,
        array $statues = [],
        array $types = [],
        array $requiredFields = [],
        $parentSlug = null,
        $includeFuturePublishedOn = false
    )
    {
        $parentId = null;

        if(!is_null($parentSlug)) {
            $parent = $this->getBySlug($parentSlug);
            $parentId = key($parent);
        }

        return $this->contentRepository->getPaginated(
            $page,
            $amount,
            $orderByDirection,
            $orderByColumn,
            $statues,
            $types,
            $requiredFields,
            $parentId,
            $includeFuturePublishedOn
        );
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

        if(!is_null($parentSlug)) {
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
    )
    {
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
        $restoredContentVersion = $this->getContentVersion($versionId);

        $contentId = $restoredContentVersion['content_id'];

        //get old content data
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


        // unlink all fields and datum
        $this->contentRepository->unlinkField($contentId);
        $this->contentRepository->unlinkDatum($contentId);

        //link fields from content version
        if(array_key_exists('fields', $oldContent)) {

            foreach($oldContent['fields'] as $key => $value) {

                if(is_array($value)) {

                    //check if file type is 'content_id'
                    if(array_key_exists('id', $value)) {

                        $linkedContentField = $this->getById($value['id']);

                        //check if the linked content still exist; if not create a new content
                        $linkedContentFieldId = (is_null($linkedContentField)) ?
                            $this->contentRepository->create($value['slug'], $value['status'], $value['type'], $value['position'], $value['parent_id'], $value['published_on']) :
                            $linkedContentField['id'];

                        //create field if not exist and link it to content
                        $this->restoreContentField($contentId, $key, $linkedContentFieldId, 'content_id', null);

                    } else {

                        //field type it's multiple
                        foreach($value as $pos => $val) {
                            //create field if not exist and link it to content
                            $this->restoreContentField($contentId, $key, $val, 'multiple', $pos);
                        }
                    }
                } else {

                    //create field if not exist and link it to content
                    $this->restoreContentField($contentId, $key, $value, 'string', null);
                }
            }
        }

        //link datum from content version
        if(array_key_exists('datum', $oldContent)) {
            foreach($oldContent['datum'] as $key => $value) {
                $this->restoreContentDatum($contentId, $key, $value);
            }
        }

        return $this->contentRepository->getById($contentId);
    }

    /**
     * Create field if not exist and link it to the content
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param string $type
     * @param integer|null $position
     */
    protected function restoreContentField($contentId, $key, $value, $type, $position)
    {
        //get field based on key and value
        $field = $this->fieldRepository->getFieldByKeyAndValue($key, $value);

        //create field if not exist
        $fieldId = (is_null($field)) ?
            $this->fieldRepository->updateOrCreateField(0, $key, $value, $type, $position) :
            $field['id'];

        //link the field with the content
        $this->contentRepository->linkField($contentId, $fieldId);
    }

    /**
     * Create datum if not exist and link it to the content
     * @param integer $contentId
     * @param string $key
     * @param string $value
     */
    protected function restoreContentDatum($contentId, $key, $value)
    {
        $datum = $this->datumRepository->getDatumByKeyAndValue($key, $value);

        $datumId = (is_null($datum)) ?
            $this->datumRepository->updateOrCreateDatum(0, $key, $value, 0) :
            $datum['id'];

        $this->contentRepository->linkDatum($contentId, $datumId);
    }

    /**
     * Get a collection with the contents Ids, where the content it's linked
     * @param integer $contentId
     * @return \Illuminate\Support\Collection
     */
    public function linkedWithContent($contentId)
    {
        return $this->contentRepository->linkedWithContent($contentId);
    }

    /**
     * Get the content version based on id
     * @param integer $versionId
     * @return mixed
     */
    public function getContentVersion($versionId)
    {
        $restoredContentVersion = $this->versionRepository->get($versionId);
        return $restoredContentVersion;
    }
}