<?php

namespace Railroad\Railcontent\Services;

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
        return $this->contentHierarchyRepository->query()
            ->where(['parent_id' => $parentId, 'child_id' => $childId])
            ->first();
    }

    /**
     * @param array $parentIds
     * @param $childId
     * @return array|null
     */
    public function getByParentIds(array $parentIds)
    {
        return $this->contentHierarchyRepository->query()
            ->whereIn('parent_id', $parentIds)
            ->get();
    }

    /**
     * @param array $parentIds
     */
    public function countParentsChildren(array $parentIds)
    {
        $results = $this->contentHierarchyRepository->query()
            ->selectRaw(
                'COUNT(' . ConfigService::$tableContentHierarchy . '.child_id) as count, parent_id'
            )
            ->whereIn(ConfigService::$tableContentHierarchy . '.parent_id', $parentIds)
            ->groupBy(ConfigService::$tableContentHierarchy . '.parent_id')
            ->get();

        return array_combine($results->pluck('parent_id')->toArray(), $results->pluck('count')->toArray());
    }

    /**
     * Create/update a new field and return it.
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

        $results = $this->contentHierarchyRepository
            ->query()
            ->where(['parent_id' => $parentId, 'child_id' => $childId])
            ->first();

        return $results;
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

        return $this->contentHierarchyRepository
            ->query()
            ->deleteAndReposition(
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
            ],
            'child_'
        );
            //->deleteParentChildLink($parentId, $childId);
    }

    public function repositionSiblings($childId)
    {
        $parentHierarchy = $this->contentHierarchyRepository
            ->query()
            ->where(ConfigService::$tableContentHierarchy . '.child_id', $childId)
            ->first();

        if (!$parentHierarchy) {
            return true;
        }
        //delete the cached results for parent id
        CacheHelper::deleteCache('content_' . $parentHierarchy['parent_id']);

        CacheHelper::deleteCache('content_' . $childId);

        return $this->contentHierarchyRepository
            ->query()
            ->where('parent_id', $parentHierarchy['parent_id'])
            ->where('child_position', '>', $parentHierarchy['child_position'])
            ->decrement('child_position');
    }
}