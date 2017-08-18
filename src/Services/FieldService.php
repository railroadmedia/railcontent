<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 8/17/2017
 * Time: 8:47 AM
 */

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\FieldRepository;

class FieldService
{
    private $fieldReposity;

    public function __construct(FieldRepository $fieldRepository)
    {
        $this->fieldReposity = $fieldRepository;
    }

    /**
     * Create a new field, link the category with the new created field and return the category with the linked field
     * @param integer $categoryId
     * @param string $key
     * @param string $value
     * @return array
     */
    public function createCategoryField($categoryId, $fieldId = null, $key, $value, $subjectType)
    {
        $fieldId = $this->fieldReposity->updateOrCreateField($fieldId,$key,$value);

        $this->fieldReposity->linkSubjectField($fieldId, $categoryId, $subjectType);

        return $this->fieldReposity->getSubjectField($fieldId, $categoryId, $subjectType);
    }

    /**
     * Update a category field and return the category with the field
     * @param $categoryId
     * @param $key
     * @param $value
     * @return int
     */
    public function updateCategoryField($categoryId, $fieldId, $key, $value, $subjectType)
    {
        $this->fieldReposity->updateOrCreateField($fieldId, $key ,$value);

        return  $this->fieldReposity->getSubjectField($fieldId, $categoryId, $subjectType);
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
    public function deleteCategoryField($fieldId, $categoryId, $subjectType)
    {
        return $this->fieldReposity->unlinkCategoryField($fieldId, $categoryId, $subjectType);
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