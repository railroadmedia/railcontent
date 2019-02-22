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

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ContentHierarchyService constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->contentHierarchyRepository = $this->entityManager->getRepository(ContentHierarchy::class);
    }

    /**
     * @param $parentId
     * @param $childId
     * @return object|null
     */
    public function get($parentId, $childId)
    {
        return $this->contentHierarchyRepository->findOneBy(
            [
                'parent' => $parentId,
                'child' => $childId,
            ]
        );
    }

    /**
     * @param array $parentIds
     * @return array|object[]
     */
    public function getByParentIds(array $parentIds)
    {
        return $this->contentHierarchyRepository->findBy(
            [
                'parent' => $parentIds,
            ]
        );
    }

    /**
     * @param array $parentIds
     */
    public function countParentsChildren(array $parentIds)
    {
        $results = [];
        $parents =
            $this->contentHierarchyRepository->createQueryBuilder('ch')
                ->addSelect('COUNT(ch) as nr')
                ->where('ch.parent IN (:parentIds)')
                ->setParameter('parentIds', $parentIds)
                ->groupBy('ch.parent')
                ->getQuery()
                ->getResult();
        foreach ($parents as $hierarchy) {
            $parentId =
                $hierarchy[0]->getParent()
                    ->getId();
            $count = $hierarchy['nr'];
            $results[$parentId] = $count;
        }

        return  $results;
    }

    /**
     * Create/update a new hierarchy and return it.
     *
     * @param int $parentId
     * @param int $childId
     * @param int|null $childPosition
     * @return array
     */
    public function createOrUpdateHierarchy($parentId, $childId, $childPosition = null)
    {
        $hierarchy = $this->contentHierarchyRepository->findOneBy(
            [
                'parent' => $parentId,
                'child' => $childId,
            ]
        );

        $otherChildrenForParent = count($this->contentHierarchyRepository->findby(
            [
                'parent' => $parentId,
            ]
        ));

        if (!$childPosition || ($childPosition > $otherChildrenForParent)) {
            $childPosition = -1;
        }

        if ($childPosition < -1) {
            $childPosition = 0;
        }

        if (!$hierarchy) {
            $hierarchy = new ContentHierarchy();
            $hierarchy->setChild(
                $this->entityManager->getRepository(Content::class)
                    ->find($childId)
            );
            $hierarchy->setParent(
                $this->entityManager->getRepository(Content::class)
                    ->find($parentId)
            );
        }

        $hierarchy->setChildPosition($childPosition);

        $this->entityManager->persist($hierarchy);
        $this->entityManager->flush();

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

        $hierarchy = $this->contentHierarchyRepository->findOneBy(
            [
                'parent' => $parentId,
                'child' => $childId,
            ]
        );

        if (!$hierarchy) {
            return true;
        }

        $this->entityManager->remove($hierarchy);
        $this->entityManager->flush();

        return true;
    }

    public function repositionSiblings($childId)
    {
        $parentHierarchy = $this->contentHierarchyRepository->findOneBy(
            [
                'child' => $childId,
            ]
        );

        if (!$parentHierarchy) {
            return true;
        }

        //delete the cached results for parent id
        CacheHelper::deleteCache(
            'content_' .
            $parentHierarchy->getParent()
                ->getId()
        );

        CacheHelper::deleteCache('content_' . $childId);

        return $this->entityManager->createQuery(
            '   UPDATE Railroad\Railcontent\Entities\ContentHierarchy h
                SET h.childPosition = h.childPosition - 1 
                WHERE h.parent = :id AND h.childPosition > :oldPosition'
        )
            ->execute(
                [
                    'id' => $parentHierarchy->getParent()
                        ->getId(),
                    'oldPosition' => $parentHierarchy->getChildPosition(),
                ]
            );
    }
}