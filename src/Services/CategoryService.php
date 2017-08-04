<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {

        $this->categoryRepository = $categoryRepository;
    }

    /** Call the create method from Category repository and return the new created category
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

        return $this->categoryRepository->getById($categoryId);

    }
}