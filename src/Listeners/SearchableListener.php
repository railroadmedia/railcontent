<?php

namespace Railroad\Railcontent\Listeners;

use Carbon\Carbon;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Entities\Behaviour\SearchableEntityInterface;
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

            // Create indexes if not exists
            if (!$client->indices()
                ->exists(['index' => 'content'])) {
                $this->elasticService->createContentIndex();
            }

            $content =
                ($oEntity instanceof Content) ? $oEntity :
                    (($oEntity instanceof ContentHierarchy) ? $oEntity->getChild() : $oEntity->getContent());
            $contentID = $content->getId();

            //delete document
            $client->deleteByQuery(
                [
                    'index' => 'content',
                    'body' => [
                        'query' => [
                            'match' => [
                                'id' => $content->getId(),
                            ],
                        ],
                    ],
                ]
            );

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

            $params = [
                'index' => 'content',
                'body' => $elasticData,
            ];

            $client->index($params);
        }
    }

    public function postRemove(LifecycleEventArgs $oArgs)
    {
        $oEntity = $oArgs->getEntity();

        if (config('railcontent.use_elastic_search') &&
            (($oEntity instanceof Content) ||
                ($oEntity instanceof ContentInstructor) ||
                ($oEntity instanceof ContentHierarchy) ||
                ($oEntity instanceof ContentPermission) ||
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
            $contentID = $content->getId();

            //delete document
            $client->deleteByQuery(
                [
                    'index' => 'content',
                    'body' => [
                        'query' => [
                            'match' => [
                                'id' => $content->getId(),
                            ],
                        ],
                    ],
                ]
            );

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
            Events::postRemove,
        ];
    }
}