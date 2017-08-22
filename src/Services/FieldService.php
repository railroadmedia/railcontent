<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 8/17/2017
 * Time: 8:47 AM
 */

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FieldRepository;

class FieldService
{
    private $fieldReposity, $contentRepository;

    public function __construct(FieldRepository $fieldRepository, ContentRepository $contentRepository)
    {
        $this->fieldReposity = $fieldRepository;
        $this->contentRepository = $contentRepository;
    }

    /**
     * Create a new field, link the content with the new created field and return the content with the linked field
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @return array
     */
    public function createField($contentId, $fieldId = null, $key, $value, $type, $position)
    {
        $fieldId = $this->fieldReposity->updateOrCreateField($fieldId, $key, $value, $type, $position);

        $this->contentRepository->linkField($contentId, $fieldId);

        return $this->contentRepository->getLinkedField($fieldId, $contentId);
    }

    /**
     * Update a category field and return the category with the field
     * @param $categoryId
     * @param $key
     * @param $value
     * @return int
     */
    public function updateField($contentId, $fieldId, $key, $value, $type, $position)
    {
        $this->fieldReposity->updateOrCreateField($fieldId, $key ,$value,  $type, $position);

        return  $this->fieldReposity->getSubjectField($fieldId, $contentId);
    }

    /**
     * Return the category with the linked field
     * @param integer $fieldId
     * @param integer $categoryId
     * @return array
     */
    public function getCategoryField($fieldId, $categoryId, $subjectType)
    {
        return $this->fieldReposity->getSubjectField($fieldId, $categoryId, $subjectType);
    }

    /**
     * Call the repository method to unlink the category's field
     * @param integer $fieldId
     * @param integer $categoryId
     * @return bool
     */
    public function deleteField($fieldId, $contentId)
    {
        return $this->fieldReposity->unlinkCategoryField($fieldId, $contentId);
    }

    /**
     * Call the delete method from repository and return true if the category was deleted
     * @param integer $categoryId
     * @param bool $deleteChildren
     * @return bool|void
     */
    public function deleteCategoryFields($categoryId)
    {
        return $this->fieldReposity->unlinkCategoryFields($categoryId);
    }
}