<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\VersionService;

class VersionContentEventListener
{
    private $versionService;

    public function __construct (VersionService $versionService)
    {
        $this->versionService = $versionService;
    }

    public function handle(ContentUpdated $event)
    {
        $results = $this->versionService->store($event->contentId);

        return $results;
    }

}