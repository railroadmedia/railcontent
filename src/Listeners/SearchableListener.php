<?php

namespace Railroad\Railcontent\Listeners;

use Carbon\Carbon;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Entities\Behaviour\SearchableEntityInterface;
use Exception;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentInstructor;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\ContentPlaylist;
use Railroad\Railcontent\Entities\ContentTopic;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Services\ElasticService;

class SearchableListener implements EventSubscriber
{
    /**
     * @var ElasticService
     */
    protected $elasticService;

    /**
     * SearchableListener constructor.
     *
     * @param ElasticService $elasticService
     */
    public function __construct()
    {
        $this->elasticService = app()->make(ElasticService::class);
    }

    /**
     * @param LifecycleEventArgs $oArgs
     */
    public function postPersist(LifecycleEventArgs $oArgs)
    {
        $oEntity = $oArgs->getEntity();

        if (config('railcontent.use_elastic_search') &&
            (($oEntity instanceof Content) ||
                ($oEntity instanceof ContentInstructor) ||
                ($oEntity instanceof ContentHierarchy) ||
                ($oEntity instanceof ContentPermission) ||
                ($oEntity instanceof ContentPlaylist) ||
                ($oEntity instanceof ContentTopic) ||
                $oEntity instanceof UserContentProgress)) {
            $client = $this->elasticService->getClient();

            $content =
                ($oEntity instanceof Content) ? $oEntity :
                    (($oEntity instanceof ContentHierarchy) ? $oEntity->getChild() : $oEntity->getContent());
            $contentID = $content->getId();

            //get progress on content
            $userContentPogress =
                $oArgs->getEntityManager()
                    ->getRepository(UserContentProgress::class);
            $allProgress = $userContentPogress->countContentProgress($contentID);

            $lastWeekProgress = $userContentPogress->countContentProgress(
                $contentID,
                Carbon::now()
                    ->subWeek(1)
            );

            $elasticData = array_merge(
                [
                    'all_progress_count' => $allProgress,
                    'last_week_progress_count' => $lastWeekProgress,
                ],
                $content->getElasticData()
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

    public function preRemove(LifecycleEventArgs $args)
    : void {
        $entity = $args->getObject();
        $entity->historicalId = $entity->getId(); // $historicalId is not defined or referenced anywhere but here
    }

    public function postRemove(LifecycleEventArgs $oArgs)
    {
        $oEntity = $oArgs->getEntity();

        if (config('railcontent.use_elastic_search') &&
            (($oEntity instanceof Content) ||
                ($oEntity instanceof ContentInstructor) ||
                ($oEntity instanceof ContentHierarchy) ||
                ($oEntity instanceof ContentPlaylist) ||
                ($oEntity instanceof ContentTopic) ||
                ($oEntity instanceof UserContentProgress))) {
            $client = $this->elasticService->getClient();

            // Create indexes if not exists
            if (!$client->indices()
                ->exists(['index' => 'content'])) {
                $this->elasticService->createContentIndex();
            }

            $content =
                ($oEntity instanceof Content) ? $oEntity :
                    (($oEntity instanceof ContentHierarchy) ? $oEntity->getChild() : $oEntity->getContent());
            if ($oEntity instanceof Content) {
                $contentID = $content->historicalId;
            } else {
                $contentID = $content->getId();
            }

            $paramsSearch = [
                'index' => 'content',
                'body' => [
                    'query' => [
                        'term' => [
                            'content_id' => $contentID,
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

            //update content if relationship removed
            if (!$oEntity instanceof Content) {
                //progress on content
                $userContentPogress =
                    $oArgs->getEntityManager()
                        ->getRepository(UserContentProgress::class);
                $allProgress = $userContentPogress->countContentProgress($contentID);
                $lastWeekProgress = $userContentPogress->countContentProgress(
                    $contentID,
                    Carbon::now()
                        ->subWeek(1)
                );

                $elasticData = array_merge(
                    [
                        'all_progress_count' => $allProgress,
                        'last_week_progress_count' => $lastWeekProgress,
                    ],
                    $content->getElasticData()
                );

                if (!empty($elasticData)) {
                    $params = [
                        'index' => 'content',
                        'body' => $elasticData,
                    ];

                    $client->index($params);
                }
            }
        }
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::preRemove,
            Events::postRemove,
        ];
    }
}
