<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\VersionService;

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
        $results = $this->contentService->deleteContentRelated($event->contentId);

        return $results;
    }

    public function handleSoftDelete(Event $event)
    {
        //TODO: reposition other siblings
        $this->contentHierarchyService->repositionSiblings($event->contentId);

        //TODO: soft delete content childrens
        $results = $this->contentService->softDeleteContentChildrens($event->contentId);

        return $results;
    }

}