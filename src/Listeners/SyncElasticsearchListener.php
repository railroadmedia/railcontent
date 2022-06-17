<?php

namespace Railroad\Railcontent\Listeners;

use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
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

    public function handleSync(ElasticDataShouldUpdate $event)
    {
        if (config('railcontent.use_elastic_search')) {
            $elasticDocument = ($event->contentType)?$this->elasticService->syncDocumentsByContentType($event->contentType):$this->elasticService->syncDocument($event->contentId);
        }
    }
}
