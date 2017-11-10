<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentHierarchyRepository;

class ContentHierarchyService
{
    /**
     * @var ContentHierarchyRepository
     */
    private $contentHierarchyRepository;

    /**
     * FieldService constructor.
     *
     * @param ContentHierarchyRepository $contentHierarchyRepository
     */
    public function __construct(ContentHierarchyRepository $contentHierarchyRepository)
    {
        $this->contentHierarchyRepository = $contentHierarchyRepository;
    }

    /**
     * @param $parentId
     * @param $childId
     * @return array|null
     */
    public function get($parentId, $childId)
    {
        return $this->contentHierarchyRepository->getByChildIdParentId($parentId, $childId);
    }

    /**
     * Create a new field and return it.
     *
     * @param int $parentId
     * @param int $childId
     * @param int|null $childPosition
     * @return array
     */
    public function create($parentId, $childId, $childPosition = null)
    {
        $id = $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
            $parentId,
            $childId,
            $childPosition
        );

        return $this->contentHierarchyRepository->getById($id);
    }

    /**
     * Create a new field and return it.
     *
     * @param int $parentId
     * @param int $childId
     * @param int|null $childPosition
     * @return array
     */
    public function update($parentId, $childId, $childPosition = null)
    {
        $id = $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
            $parentId,
            $childId,
            $childPosition
        );

        return $this->contentHierarchyRepository->getById($id);
    }

    /**
     * @param $parentId
     * @param $childId
     * @return bool
     */
    public function delete($parentId, $childId)
    {
        return $this->contentHierarchyRepository->deleteParentChildLink($parentId, $childId);
    }
}