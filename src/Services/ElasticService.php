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
use Railroad\Railcontent\Repositories\ContentRepository;
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
                'title' => ['type' => 'keyword'],
                'slug' => ['type' => 'keyword'],
                'brand' => ['type' => 'text'],
                'content_type' => ['type' => 'keyword'],
                'status' => ['type' => 'text'],
                'difficulty' => ['type' => 'text'],
                'style' => ['type' => 'text'],
                'description' => ['type' => 'keyword'],
                'topic' => ['type' => 'keyword'],
                'bpm' => ['type' => 'text'],
            ]
        );

        // Send mapping to type
        $mapping->send($index);
    }

    /**
     * @return ElasticQueryBuilder
     */
    public function build()
    {
        $query = new ElasticQueryBuilder();

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
     * @param array|null $requiredContentIdsByState
     * @param array|null $includedContentsIdsByState
     * @param array $requiredUserPlaylistIds
     * @return \Elastica\ResultSet
     */
    public function getElasticFiltered(
        $page = 1,
        $limit = 10,
        $sort = 'newest',
        array $includedTypes = [],
        array $slugHierarchy = [],
        array $requiredParentIds = [],
        array $requiredFields = [],
        array $includedFields = [],
        ?array $requiredContentIdsByState = [],
        ?array $includedContentsIdsByState = [],
        array $requiredUserPlaylistIds = []
    ) {
        $client = $this->getClient();
        $index = $client->getIndex('content');

        $searchQuery =
            $this->build()
                ->restrictByUserAccess()
                ->restrictByTypes($includedTypes)
                ->includeByUserStates($includedContentsIdsByState)
                ->includeByFields($includedFields)
                ->restrictByParentIds($requiredParentIds)
                ->restrictByUserStates($requiredContentIdsByState)
                ->restrictBySlugHierarchy($slugHierarchy)
                ->restrictByPlaylistIds($requiredUserPlaylistIds)
                ->restrictByFields($requiredFields)
                ->sortResults($sort)
                ->setSize($limit)
                ->setFrom(($page - 1) * $limit);

        return $index->search($searchQuery);
    }

    /**
     * @param $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param null $dateTimeCutoff
     * @return \Elastica\ResultSet
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentTypes = [],
        $contentStatuses = [],
        $dateTimeCutoff = null
    ) {

        $client = $this->getClient();
        $index = $client->getIndex('content');
        $arrTerm = explode(' ', strtolower($term));

        $searchQuery =
            $this->build()
                ->restrictByUserAccess()
                ->restrictByTypes($contentTypes)
                ->restrictByContentStatuses($contentStatuses)
                ->restrictByTerm($arrTerm)
                ->restrictByPublishedDate($dateTimeCutoff)
                ->fullSearchSort($arrTerm)
                ->setSize($limit)
                ->setFrom(($page - 1) * $limit);

        return $index->search($searchQuery);
    }

    /**
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredFields
     * @param array $includedFields
     * @param array|null $requiredUserStates
     * @param array|null $includedUserStates
     * @param array $requiredUserPlaylistIds
     * @return array
     */
    public function getFilterFields(
        array $includedTypes = [],
        array $slugHierarchy = [],
        array $requiredParentIds = [],
        array $requiredFields = [],
        array $includedFields = [],
        ?array $requiredUserStates = [],
        ?array $includedUserStates = [],
        array $requiredUserPlaylistIds = []
    ) {
        $filtersEl = $this->getElasticFiltered(
            1,
            10000,
            'newest',
            $includedTypes,
            $slugHierarchy,
            $requiredParentIds,
            $requiredFields,
            $includedFields,
            $requiredUserStates,
            $includedUserStates,
            $requiredUserPlaylistIds
        );

        $idEs = [];
        $filteredContents = [];
        $instructorsIds = [];

        foreach ($filtersEl->getResults() as $elData) {
            $idEs[] = $elData->getData()['id'];

            if (!in_array($elData->getData()['content_type'], $filteredContents['content_type'] ?? []) &&
                (!in_array($elData->getData()['content_type'], $includedTypes))) {
                $filteredContents['content_type'][] = $elData->getData()['content_type'];
            }

            $requiredFiltersData =
                (array_intersect_key(config('railcontent.field_option_list', []), array_keys($elData->getData())));

            foreach ($requiredFiltersData as $requiredFieldData) {
                if ($requiredFieldData == 'instructor') {
                    foreach ($elData->getData()['instructor'] as $insId) {
                        $instructorsIds[$insId] = $insId;
                    }
                }
                if (array_key_exists($requiredFieldData, $elData->getData())) {

                    if (is_array($elData->getData()[$requiredFieldData])) {
                        foreach ($elData->getData()[$requiredFieldData] as $option) {
                            if (!in_array(strtolower($option), array_map('strtolower',$filteredContents[$requiredFieldData]?? []) )) {
                                $filteredContents[$requiredFieldData][] = $option;
                            }
                        }
                    } else {
                        if (($elData->getData()[$requiredFieldData]) && (!in_array(
                                strtolower($elData->getData()[$requiredFieldData]),
                                array_map('strtolower',$filteredContents[$requiredFieldData] ?? [])

                            ))) {
                            $filteredContents[$requiredFieldData][] = $elData->getData()[$requiredFieldData];
                        }
                    }
                }
            }
        }

        foreach ($filteredContents as $availableFieldIndex => $availableField) {
            usort(
                $filteredContents[$availableFieldIndex],
                function ($a, $b) {
                    return strncmp($a, $b, 15);
                }
            );
        }

        if (!empty($instructorsIds)) {
            $filteredContents['instructors'] = $instructorsIds;
        }

        unset($filteredContents['instructor']);

        return $filteredContents;
    }
}
