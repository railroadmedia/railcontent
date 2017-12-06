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
     * @param array $parentIds
     */
    public function countParentsChildren(array $parentIds)
    {
        $results = $this->contentHierarchyRepository->countParentsChildren($parentIds);

        return array_combine(array_column($results, 'parent_id'), array_column($results, 'count'));
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
        $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
            $parentId,
            $childId,
            $childPosition
        );

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
    public function update($parentId, $childId, $childPosition = null)
    {
        $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
            $parentId,
            $childId,
            $childPosition
        );

        return $this->contentHierarchyRepository->getByChildIdParentId($parentId, $childId);
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

    public function repositionSiblings($childId)
    {
        $parentHierarchy = $this->contentHierarchyRepository->getParentByChildId($childId);
        if(!$parentHierarchy){
            return true;
        }
        return $this->contentHierarchyRepository->decrementSiblings($parentHierarchy['parent_id'], $parentHierarchy['child_position']);

    }
}