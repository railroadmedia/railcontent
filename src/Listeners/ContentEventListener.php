<?php

namespace Railroad\Railcontent\Listeners;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;

class ContentEventListener
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * ContentEventListener constructor.
     *
     * @param ContentService $contentService
     * @param ContentHierarchyService $contentHierarchyService
     */
    public function __construct(ContentService $contentService, ContentHierarchyService $contentHierarchyService)
    {
        $this->contentService = $contentService;
        $this->contentHierarchyService = $contentHierarchyService;
    }

    /**
     * @param Event $event
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handleDelete(Event $event)
    {
        $results = $this->contentService->deleteContentRelated($event->content);

        return $results;
    }

    /**
     * @param Event $event
     * @return int|void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handleSoftDelete(Event $event)
    {
        //reposition other siblings
        $this->contentHierarchyService->repositionSiblings($event->content);

        //soft delete content children
        $results = $this->contentService->softDeleteContentChildren($event->content);

        return $results;
    }

}