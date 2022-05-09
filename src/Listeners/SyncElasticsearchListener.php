<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;

class SyncElasticsearchListener
{
    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * @var ElasticService
     */
    private $elasticService;

    public function __construct(ContentService $contentService, ElasticService $elasticService)
    {
        $this->contentService = $contentService;
        $this->elasticService = $elasticService;
    }

    public function handleSync(Event $event)
    {
        if (config('railcontent.use_elastic_search')) {
            $content = $this->contentService->getById($event->contentId);
            $this->elasticService->syncDocument($content);
        }
    }
}