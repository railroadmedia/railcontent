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
                'published_on' => ['type' => 'date'],
                'topics' => ['type' => 'nested']
            ]
        );

        // Send mapping to type
        $mapping->send($index);
    }

    /**
     * @return ElasticQueryBuilder
     */
    public function build(){
        $query  = new ElasticQueryBuilder();

        return $query;
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string $sort
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredFields
     * @param array $includedFields
     * @param array $requiredUserStates
     * @param array $includedUserStates
     * @param bool $pullFilterFields
     * @param bool $getFutureContentOnly
     * @param bool $pullPagination
     * @param array $requiredUserPlaylistIds
     * @return \Elastica\Result[]
     */
    public function getElasticFiltered(
        $page =1,
        $limit = 10,
        $sort = 'newest',
        array $includedTypes = [],
        array $slugHierarchy = [],
        array $requiredParentIds = [],
        array $requiredFields = [],
        array $includedFields = [],
        array $requiredUserStates = [],
        array $includedUserStates = [],
        $pullFilterFields = true,
        $getFutureContentOnly = false,
        $pullPagination = true,
        array $requiredUserPlaylistIds = []
    )
    {
        $client = $this->getClient();
        $index = $client->getIndex('content');

        $searchQuery =
            $this->build()
                ->restrictByUserAccess()
                ->restrictByTypes($includedTypes)
                ->includeByUserStates($includedUserStates, $client)
                ->restrictByParentIds($requiredParentIds)
                ->restrictByUserStates($requiredUserStates, $client)
                ->restrictBySlugHierarchy($slugHierarchy)
                ->restrictByPlaylistIds($requiredUserPlaylistIds)
                ->restrictByFields($requiredFields)
                ->sortResults($sort)
                ->setSize($limit)
                ->setFrom(($page - 1) * $limit);

        return $index->search($searchQuery);
    }
}
