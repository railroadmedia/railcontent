<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Elastica\Client;
use Elastica\QueryBuilder;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Entities\UserPlaylist;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Hydrators\CustomRailcontentHydrator;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Managers\SearchEntityManager;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;
use Railroad\Railcontent\Repositories\UserPlaylistRepository;
use Elastica\Query;
use Elastica\Query\Match;

class ElasticService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $userPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentUserPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var CustomRailcontentHydrator
     */
    private $resultsHydrator;

    /**
     * UserPlaylistService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     */
    public function __construct()
    {

    }

    /**
     * @return Client
     */
    public function getClient()
    {
        $config = [
            'host' => 'elasticsearch',
            'username' => 'elastic',
            'password' => 'changeme',
        ];
        $client = new Client($config);

        return $client;
    }

    public function setMapping($index)
    {
        // Define mapping
        $mapping = new \Elastica\Mapping();

        // Set mapping
        $mapping->setProperties(
            [
                'id' => ['type' => 'integer'],
                'title' => ['type' => 'text'],
                'slug' => ['type' => 'text'],
                'brand' => ['type' => 'text'],
                'content_type' => ['type' => 'text'],
                'status' => ['type' => 'text'],
                'difficulty' => ['type' => 'text'],
                'style' => ['type' => 'text'],
            ]
        );

        // Send mapping to type
        $mapping->send($index);
    }

    public function build(){
        $query  = new ElasticQueryBuilder();

        return $query;
    }

    public function restrictBrandQuery()
    {
        $bool = new Query\BoolQuery();

        $updateQuery = new Match();
        $updateQuery->setField('brand', 'drumeo');
        $bool->addMust($updateQuery);

        return $bool;
    }
}
