<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;

class ContentHierarchyService
{
    /**
     * @var ContentHierarchyRepository
     */
    private $contentHierarchyRepository;

    private $entityManager;

    /**
     * FieldService constructor.
     *
     * @param ContentHierarchyRepository $contentHierarchyRepository
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->contentHierarchyRepository = $this->entityManager->getRepository(ContentHierarchy::class);
    }

    /**
     * @param $parentId
     * @param $childId
     * @return array|null
     */
    public function get($parentId, $childId)
    {
        dd(
            $this->contentHierarchyRepository->findOneBy(
                [
                    'parent_id' => $parentId,
                    'child_id' => $childId,
                ]
            )
        );
        return $this->contentHierarchyRepository->findOneBy(
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
            ]
        );
        //            ->where(['parent_id' => $parentId, 'child_id' => $childId])
        //            ->first();
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
        $results =
            $this->contentHierarchyRepository->query()
                ->selectRaw(
                    'COUNT(' . ConfigService::$tableContentHierarchy . '.child_id) as count, parent_id'
                )
                ->whereIn(ConfigService::$tableContentHierarchy . '.parent_id', $parentIds)
                ->groupBy(ConfigService::$tableContentHierarchy . '.parent_id')
                ->get();

        return array_combine(
            $results->pluck('parent_id')
                ->toArray(),
            $results->pluck('count')
                ->toArray()
        );
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
        $otherChildrenForParent = $this->contentHierarchyRepository->findby(
            [
                'parent' => $parentId,
            ]
        );
        $position =
            $this->contentHierarchyRepository->recalculatePosition(
                $childPosition,
                count($otherChildrenForParent),
                null
            );

        $hierarchy = new ContentHierarchy();
        $hierarchy->setChild(
            $this->entityManager->getRepository(Content::class)
                ->find($childId)
        );
        $hierarchy->setParent(
            $this->entityManager->getRepository(Content::class)
                ->find($parentId)
        );
        $hierarchy->setChildPosition($position);

        $this->entityManager->persist($hierarchy);
        $this->entityManager->flush();

        if (!empty($otherChildrenForParent)) {
            if ($position <= count($otherChildrenForParent)) {
                $q =
                    $this->contentHierarchyRepository->createQueryBuilder('c')
                        ->where('c.parent = :id')
                        ->andWhere('c.childPosition >= :position')
                        ->andWhere('c.id != :excludedId')
                        ->setParameters(
                            [
                                'excludedId' => $hierarchy->getId(),
                                'id' => $parentId,
                                'position' => $position,
                            ]
                        );
                $iterableResult =
                    $q->getQuery()
                        ->getResult();

                foreach ($iterableResult as $otherChild) {
                    $otherChild->setChildPosition($otherChild->getChildPosition() + 1);
                    $this->entityManager                        ->persist($otherChild);
                    $this->entityManager                        ->flush();
                }

            }
        }

        //delete the cached results for parent id
        CacheHelper::deleteCache('content_' . $parentId);

        //delete the cached results for child id
        CacheHelper::deleteCache('content_' . $childId);


        return $hierarchy;
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

        return $this->contentHierarchyRepository->query()
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
        $parentHierarchy =
            $this->contentHierarchyRepository->query()
                ->where(ConfigService::$tableContentHierarchy . '.child_id', $childId)
                ->first();

        if (!$parentHierarchy) {
            return true;
        }
        //delete the cached results for parent id
        CacheHelper::deleteCache('content_' . $parentHierarchy['parent_id']);

        CacheHelper::deleteCache('content_' . $childId);

        return $this->contentHierarchyRepository->query()
            ->where('parent_id', $parentHierarchy['parent_id'])
            ->where('child_position', '>', $parentHierarchy['child_position'])
            ->decrement('child_position');
    }
}