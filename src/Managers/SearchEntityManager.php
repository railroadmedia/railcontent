<?php

namespace Railroad\Railcontent\Managers;

use Doctrine\Common\Cache\ArrayCache as SearchArrayCache;
use Doctrine\Common\EventManager;
use Doctrine\Search\Configuration as SearchConfiguration;
use Doctrine\Search\ElasticSearch\Client as ElasticSearchClient;
use Doctrine\Search\SearchManager as SearchManager;
use Doctrine\Search\Serializer\JMSSerializer as SearchJMSSerializer;
use Elastica\Client as ElasticaClient;
use JMS\Serializer\SerializationContext as SearchSerializerContext;

class SearchEntityManager
{

    public static function get()
    {
        //Annotation metadata driver
        $config = new SearchConfiguration();
        $config->setMetadataCacheImpl(new SearchArrayCache());
        $config->setEntitySerializer(
            new SearchJMSSerializer(
                SearchSerializerContext::create()
                    ->setGroups('search')
            )
        );

        $paths = [];
        foreach (config('doctrine.entities') as $driverConfig) {
            $paths[] = $driverConfig['path'];

        }

        $md = $config->newDefaultAnnotationDriver($paths);
        $config->setMetadataDriverImpl($md);

        //Add event listeners here
        $eventManager = new EventManager();
        //$eventManager->addEventListener('prePersist', $listener);

        //Get the search manager
        return new SearchManager(
            $config, new ElasticSearchClient(
                new ElasticaClient(
                    ['host' => 'elasticsearch', 'port' => '9200', 'username' => 'elastic', 'password' => 'changeme']

                )
            ), $eventManager
        );
    }
}