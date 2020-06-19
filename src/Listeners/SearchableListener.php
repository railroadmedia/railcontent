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
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Managers\SearchEntityManager;

class SearchableListener implements EventSubscriber
{

    /**
     * @param LifecycleEventArgs $oArgs
     */
    public function postPersist(LifecycleEventArgs $oArgs)
    {

        $oEntity = $oArgs->getEntity();

        if (($oEntity instanceof Content) ||
            ($oEntity instanceof ContentData) ||
            $oEntity instanceof UserContentProgress) {
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

                //delete document
                $contentID =
                    ($oEntity instanceof Content) ? $oEntity->getId() :
                        $oEntity->getContent()
                            ->getId();

                $matchPhraseQuery = new MatchPhrase("id", $contentID);

                $index = $client->getIndex($metadata->index);
                $index->deleteByQuery($matchPhraseQuery);

                $document =
                    new Document(
                        '',
                        ($oEntity instanceof Content) ? $oEntity->toArray() :
                            $oEntity->getContent()
                                ->toArray()
                    );
                $client->getIndex($metadata->index)
                    ->addDocuments([$document]);

                $index->refresh();
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