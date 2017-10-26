<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FieldRepository;

class FieldService
{
    /**
     * @var FieldRepository
     */
    private $fieldRepository;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * FieldService constructor.
     *
     * @param FieldRepository $fieldRepository
     * @param ContentRepository $contentRepository
     */
    public function __construct(FieldRepository $fieldRepository, ContentRepository $contentRepository)
    {
        $this->fieldRepository = $fieldRepository;
        $this->contentRepository = $contentRepository;
    }

    /**
     * Create a new field, link the content with the new created field and return the content with the linked field
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @return array
     */
    public function createField($contentId, $key, $value, $type, $position)
    {
        $fieldId = $this->fieldRepository->updateOrCreateField(null, $key, $value, $type, $position);

        $this->contentRepository->linkField($contentId, $fieldId);

        return $this->fieldRepository->getLinkedField($fieldId, $contentId);
    }

    /**
     * Update a content field and return the content with the field
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @return array
     */
    public function updateField($contentId, $fieldId, $key, $value, $type, $position)
    {
        $this->fieldRepository->updateOrCreateField($fieldId, $key, $value, $type, $position);

        return $this->fieldRepository->getLinkedField($fieldId, $contentId);
    }

    /**
     * Return the content with the linked field
     *
     * @param integer $fieldId
     * @param $contentId
     * @return array
     */
    public function getField($fieldId, $contentId)
    {
        return $this->fieldRepository->getLinkedField($fieldId, $contentId);
    }

    /**
     * Call the repository method to unlink the content's field
     *
     * @param integer $fieldId
     * @param integer $contentId
     * @return bool
     */
    public function deleteField($fieldId, $contentId)
    {
        return $this->contentRepository->unlinkField($contentId, $fieldId);
    }

}