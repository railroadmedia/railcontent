<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;

class ContentEventListener
{
    private $contentService;

    private $contentHierarchyService;

    public function __construct(ContentService $contentService, ContentHierarchyService $contentHierarchyService)
    {
        $this->contentService = $contentService;
        $this->contentHierarchyService = $contentHierarchyService;
    }

    public function handleDelete(Event $event)
    {
        $results = $this->contentService->deleteContentRelated($event->content);

        return $results;
    }

    public function handleSoftDelete(Event $event)
    {
        //reposition other siblings
        $this->contentHierarchyService->repositionSiblings($event->content);

        //soft delete content children
        $results = $this->contentService->softDeleteContentChildren($event->content);

        return $results;
    }

}