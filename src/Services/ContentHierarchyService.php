<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentFieldRepository;
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
     * Create a new field and return it.
     *
     * @param $parentId
     * @param $childId
     * @param $childPosition
     * @return array
     */
    public function create($parentId, $childId, $childPosition)
    {
        $id = $this->contentHierarchyRepository->create(
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
                'child_position' => $childPosition,
            ]
        );

        return $this->contentHierarchyRepository->getById($id);
    }
}