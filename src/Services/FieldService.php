<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;

class FieldService
{
    /**
     * @var ContentFieldRepository
     */
    private $fieldRepository;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * FieldService constructor.
     *
     * @param ContentFieldRepository $fieldRepository
     * @param ContentRepository $contentRepository
     */
    public function __construct(ContentFieldRepository $fieldRepository, ContentRepository $contentRepository)
    {
        $this->fieldRepository = $fieldRepository;
        $this->contentRepository = $contentRepository;
    }

    /**
     * Create a new field and return it.
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param string $position
     * @param string $type
     * @return array
     */
    public function create($contentId, $key, $value, $position, $type)
    {
        $fieldId = $this->fieldRepository->create($contentId, $key, $value, $type, $position);

        return $this->fieldRepository->get($fieldId);
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