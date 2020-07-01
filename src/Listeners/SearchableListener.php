<?php

namespace Railroad\Railcontent\Listeners;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Elastica\Document;
use Elastica\Query\MatchPhrase;
use Entities\Behaviour\SearchableEntityInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentInstructor;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\ContentPlaylist;
use Railroad\Railcontent\Entities\ContentTopic;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Managers\SearchEntityManager;
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

        if (($oEntity instanceof Content) ||
            ($oEntity instanceof ContentInstructor) ||
            ($oEntity instanceof ContentHierarchy) ||
            ($oEntity instanceof ContentPermission) ||
            ($oEntity instanceof ContentPlaylist) ||
            ($oEntity instanceof ContentTopic) ||
            $oEntity instanceof UserContentProgress) {

            $client = $this->elasticService->getClient();

            // Create indexes if not exists and add documents
            $index = $client->getIndex('content');

            if (!$index->exists()) {
                $index->create(['settings' => ['index' => ['number_of_shards' => 1, 'number_of_replicas' => 1]]]);
            }

            //delete document
            $contentID =
                ($oEntity instanceof Content) ? $oEntity->getId() :
                    $oEntity->getContent()
                        ->getId();

            $matchPhraseQuery = new MatchPhrase("id", $contentID);

            $index = $client->getIndex('content');
            $index->deleteByQuery($matchPhraseQuery);

            $document = new Document(
                '',
                ($oEntity instanceof Content) ? $oEntity->getElasticData() :
                    $oEntity->getContent()
                        ->getElasticData()
            );

            // Add tweet to type
            $index->addDocument($document);

            // Refresh Index
            $index->refresh();

        }
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }
}