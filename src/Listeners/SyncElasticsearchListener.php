<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;
use Railroad\Railcontent\Services\VersionService;

class SyncElasticsearchListener
{
    private $contentService;

    private $contentHierarchyService;

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
        $content = $this->contentService->getById($event->contentId);

        if (config('railcontent.use_elastic_search')){

            $client = $this->elasticService->getClient();

            $contentID = $content['id'];

            //get progress on content
//            $userContentPogress =
//                $oArgs->getEntityManager()
//                    ->getRepository(UserContentProgress::class);
//            $allProgress = $userContentPogress->countContentProgress($contentID);
//
//            $lastWeekProgress = $userContentPogress->countContentProgress(
//                $contentID,
//                Carbon::now()
//                    ->subWeek(1)
//            );

            $elasticData = array_merge(
                [
//                    'all_progress_count' => $allProgress,
//                    'last_week_progress_count' => $lastWeekProgress,
                ],
                $this->contentService->getElasticData($contentID)
            );

            $paramsContent = [
                'index' => 'content',
                'body' => $elasticData,
            ];

            // Create indexes if not exists
            if (!$client->indices()
                ->exists(['index' => 'content'])) {
                $this->elasticService->createContentIndex();
            }

            //update or create document
            try {
                $paramsSearch = [
                    'index' => 'content',
                    'body' => [
                        'query' => [
                            'term' => [
                                'content_id' => "$contentID",
                            ],
                        ],
                    ],
                ];

                $documents = $client->search($paramsSearch);

                //delete document if exists
                foreach ($documents['hits']['hits'] as $elData) {
                    $paramsDelete = [
                        'index' => 'content',
                        'id' => $elData['_id'],
                        'refresh' => true,
                    ];

                    $client->delete($paramsDelete);
                }

                $client->index($paramsContent);
            } catch (Exception $exception) {
                error_log('Can not delete elasticsearch index '.print_r($exception->getMessage(), true));
            }
        }
    }

    public function handleDelete(Event $event)
    {

    }

}