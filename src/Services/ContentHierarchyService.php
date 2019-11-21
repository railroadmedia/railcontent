<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\HierarchyUpdated;
//use Railroad\Railcontent\Events\XPModified;
use Railroad\Railcontent\Helpers\CacheHelper;
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
     * @param $childId
     * @return array|null
     */
    public function getByParentIds(array $parentIds)
    {
        return $this->contentHierarchyRepository->getByParentIds($parentIds);
    }

    /**
     * @param array $parentIds
     * @param array $contentStatuses
     * @return array|null
     */
    public function getByParentIdsWhereContentStatusIn(
        array $parentIds,
        array $contentStatuses = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ]
    ) {
        return $this->contentHierarchyRepository->getByParentIdsWhereContentStatusIn($parentIds, $contentStatuses);
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

        //delete the cached results for parent id
        CacheHelper::deleteCache('content_' . $parentId);

        //delete the cached results for child id
        CacheHelper::deleteCache('content_' . $childId);

        event(new HierarchyUpdated($parentId, $childId));
        // event(new XPModified($parentId));

        $results = $this->contentHierarchyRepository->getByChildIdParentId($parentId, $childId);

        return $results;
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
        $contentHierarchy = $this->get($parentId, $childId);
        if (is_null($contentHierarchy)) {
            return $contentHierarchy;
        }

        $this->contentHierarchyRepository->updateOrCreateChildToParentLink(
            $parentId,
            $childId,
            $childPosition
        );

        //delete the cached results for parent id and child id
        CacheHelper::deleteCache('content_' . $parentId);

        CacheHelper::deleteCache('content_' . $childId);
        event(new HierarchyUpdated($parentId, $childId));
        //event(new XPModified($parentId));

        return $this->contentHierarchyRepository->getByChildIdParentId($parentId, $childId);
    }

    /**
     * @param $parentId
     * @param $childId
     * @return bool
     */
    public function delete($parentId, $childId)
    {
        //delete the cached results for parent id
        CacheHelper::deleteCache('content_' . $parentId);

        CacheHelper::deleteCache('content_' . $childId);

        $results = $this->contentHierarchyRepository->deleteParentChildLink($parentId, $childId);
        event(new HierarchyUpdated($parentId, $childId));
        //event(new XPModified($parentId));

        return $results;
    }

    public function repositionSiblings($childId)
    {
        $parentHierarchy = $this->contentHierarchyRepository->getParentByChildId($childId);

        if (!$parentHierarchy) {
            return true;
        }
        //delete the cached results for parent id
        CacheHelper::deleteCache('content_' . $parentHierarchy['parent_id']);

        CacheHelper::deleteCache('content_' . $childId);

        return $this->contentHierarchyRepository->decrementSiblings(
            $parentHierarchy['parent_id'],
            $parentHierarchy['child_position']
        );

    }
}