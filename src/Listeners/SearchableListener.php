<?php

namespace Railroad\Railcontent\Listeners;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Elastica\Document;
use Entities\Behaviour\SearchableEntityInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Managers\SearchEntityManager;

class SearchableListener implements EventSubscriber
{

    /**
     * @param LifecycleEventArgs $oArgs
     */
    public function postPersist(LifecycleEventArgs $oArgs)
    {

        $oEntity = $oArgs->getEntity();

        if ($oEntity instanceof Content) {
            $sm = SearchEntityManager::get();
            $metadatas =
                $sm->getMetadataFactory()
                    ->getAllMetadata();

            $client = $sm->getClient();

            // Create indexes if not exists and add documents
            foreach ($metadatas as $metadata) {
                if (!$client->getIndex($metadata->index)
                    ->exists()) {
                    $client->createIndex($metadata->index);
                }

                $client->addDocuments($metadata, [json_encode($oEntity->toArray())]);
            }
        }
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }
}