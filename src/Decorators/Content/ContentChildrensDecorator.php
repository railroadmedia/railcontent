<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;

class ContentChildrensDecorator implements DecoratorInterface
{
    /**
     * @var RailcontentEntityManager
     */
    public $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentChildrensDecorator constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param EntityRepository|ObjectRepository $contentRepository
     */
    public function __construct(RailcontentEntityManager $entityManager, ContentHierarchyService $contentHierarchyService, ContentService $contentService)
    {
        $this->entityManager = $entityManager;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;

        $this->contentRepository = $this->entityManager->getRepository(Content::class);;
    }

    /**
     * @param array $entities
     * @return array
     */
    public function decorate(array $entities)
    : array {
        //        foreach ($entities as $entity) {
        //            $entityIds = [];
        //            foreach($entity->getChild() as $child){
        //                $entityIds[] = $child->getChild()->getId();
        //            }
        //            $entity->createProperty('child_ids', $entityIds);
        //        }

        //        dd($entities);
        //
        $parentIds = [];
        foreach ($entities as $entity) {
            $parentIds[] = $entity->getId();
        }
        $childrens = $this->contentHierarchyService->getByParentIds($parentIds);
        $parentChildrens = [];
        $childrenIds = [];

        foreach ($childrens as $children) {
            $parentChildrens[$children->getParent()
                ->getId()][] = $children->getChild();
            $childrenIds[] =
                $children->getChild()
                    ->getId();
        }

       $this->contentService->getByIds($childrenIds);

//        foreach ($entities as $entity) {
//            if(array_key_exists($entity->getId(), $parentChildrens)){
//                $entity->addChild($parentChildrens[$entity->getId()]);
//            }
//        }

        return $entities;
    }
}