<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Call the create method from Category repository and return the new created category
     * @param string $slug
     * @param integer $parentId
     * @param integer $position
     * @return array
     */
    public function create($slug, $parentId, $position)
    {
        $categoryId = $this->categoryRepository->create($slug, $parentId, $position);

        return $this->categoryRepository->getById($categoryId);
    }

    /**
     * Call the update method from Category repository and return the category
     * @param integer $categoryId
     * @param string $slug
     * @param integer $position
     * @return array
     */
    public function update($categoryId, $slug,  $position)
    {
        $this->categoryRepository->update($categoryId, $slug,  $position);

        return $this->get($categoryId);
    }

    /** Call the get by id method from repository and return the category
     * @param integer $categoryId
     * @return array
     */
    public function get($categoryId)
    {
        return $this->categoryRepository->getById($categoryId);
    }

    /**
     * Call the delete method from repository and return true if the category was deleted
     * @param integer $categoryId
     * @param bool $deleteChildren
     * @return bool|void
     */
    public function delete($categoryId, $deleteChildren = false)
    {
        return $this->categoryRepository->delete($categoryId,$deleteChildren);
    }

    /**
     * Create a new field, link the category with the new created field and return the category with the linked field
     * @param integer $categoryId
     * @param string $key
     * @param string $value
     * @return array
     */
    public function createCategoryField($categoryId, $fieldId = null, $key, $value)
    {
        $fieldId = $this->categoryRepository->updateOrCreateField($fieldId,$key,$value);

        $this->categoryRepository->linkCategoryField($fieldId, $categoryId, ConfigService::$subjectTypeCategory);

        return $this->categoryRepository->getCategoryField($fieldId, $categoryId);
    }

    /**
     * Update a category field and return the category with the field
     * @param $categoryId
     * @param $key
     * @param $value
     * @return int
     */
    public function updateCategoryField($categoryId, $fieldId, $key, $value)
    {
        $this->categoryRepository->updateOrCreateField($fieldId, $key ,$value);

        return  $this->categoryRepository->getCategoryField($fieldId, $categoryId);
    }

    /**
     * Return the category with the linked field
     * @param integer $fieldId
     * @param integer $categoryId
     * @return array
     */
    public function getCategoryField($fieldId, $categoryId)
    {
        return $this->categoryRepository->getCategoryField($fieldId, $categoryId);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * Call the repository method to unlink the category's field
     * @param integer $fieldId
     * @param integer $categoryId
     * @return bool
     */
    public function deleteCategoryField($fieldId, $categoryId)
    {
        return $this->categoryRepository->unlinkCategoryField($fieldId, $categoryId);
    }
}