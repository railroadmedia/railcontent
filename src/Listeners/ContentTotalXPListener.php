<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Services\ContentService;

class ContentTotalXPListener
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentTotalXPListener constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param ContentFieldCreated $contentFieldCreated
     */
    public function handleFieldCreated(ContentFieldCreated $contentFieldCreated)
    {
        if ($contentFieldCreated->newField['key'] == 'xp') {
            $this->recursiveCalculateXP($contentFieldCreated->newField['content_id']);
        }
    }

    /**
     * @param ContentFieldUpdated $contentFieldUpdated
     */
    public function handleFieldUpdated(ContentFieldUpdated $contentFieldUpdated)
    {
        if ($contentFieldUpdated->newField['key'] == 'xp') {
            $this->recursiveCalculateXP($contentFieldUpdated->newField['content_id']);
        }
    }

    /**
     * @param ContentFieldDeleted $contentFieldDeleted
     */
    public function handleFieldDeleted(ContentFieldDeleted $contentFieldDeleted)
    {
        if ($contentFieldDeleted->deletedField['key'] == 'xp') {
            $this->recursiveCalculateXP($contentFieldDeleted->deletedField['content_id']);
        }
    }

    /**
     * @param HierarchyUpdated $event
     */
    public function handleHierarchyUpdated(HierarchyUpdated $event)
    {
        $this->recursiveCalculateXP($event->parentId);
    }

    /**
     * @param $contentId
     */
    private function recursiveCalculateXP($contentId)
    {
        $this->contentService->calculateTotalXp($contentId);

        $parents = $this->contentService->getByChildId($contentId);
        foreach ($parents as $parent) {
            if ($parent['type'] != 'user-playlist') {
                $this->recursiveCalculateXP($parent['id']);
            }
        }
    }
}