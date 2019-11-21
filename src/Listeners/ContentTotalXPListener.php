<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\HierarchyUpdated;
//use Railroad\Railcontent\Events\XPModified;
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
     * @param XPModified $XPModified
     * @return bool
     */
    public function handleXPCalculation($contentId)
    {
        $totalXP = $this->contentService->calculateTotalXp($contentId);
        $this->contentService->update($contentId, ['total_xp' => $totalXP]);

        return true;
    }

    /**
     * @param $contentId
     */
    private function recursiveCalculateXP($contentId)
    {
        //event(new XPModified($contentId));
$this->handleXPCalculation($contentId);
        $parents = $this->contentService->getByChildId($contentId);
        foreach ($parents as $parent) {
            $this->recursiveCalculateXP($parent['id']);
        }
    }

    /**
     * @param HierarchyUpdated $event
     */
    public function handleHierarchyUpdated(HierarchyUpdated $event)
    {
        $this->recursiveCalculateXP($event->parentId);
    }

}