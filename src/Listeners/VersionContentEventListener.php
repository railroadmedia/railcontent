<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\VersionService;

class VersionContentEventListener
{
    private $versionService;

    public function __construct(VersionService $versionService)
    {
        $this->versionService = $versionService;
    }

    public function handle(Event $event)
    {
        $results = $this->versionService->store($event->contentId);

        return $results;
    }

    public function handleFieldCreated(ContentFieldCreated $contentFieldCreated)
    {
        $results = $this->versionService->store($contentFieldCreated->newField['content_id']);

        return $results;
    }

    public function handleFieldUpdated(ContentFieldUpdated $contentFieldUpdated)
    {
        $results = $this->versionService->store($contentFieldUpdated->newField['content_id']);

        return $results;
    }

    public function handleFieldDeleted(ContentFieldDeleted $contentFieldDeleted)
    {
        $results = $this->versionService->store($contentFieldDeleted->deletedField['content_id']);

        return $results;
    }

}