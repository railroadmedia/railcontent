<?php

namespace Railroad\Railcontent\Services;

use Elastica\Client;
use Elastica\Mapping;
use Elastica\ResultSet;
use Elasticsearch\ClientBuilder;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;

class ElasticService
{

    /**
     * @return \Elasticsearch\Client
     */
    public function getClient()
    {
        $config = [
            'host' => config('railcontent.elastic_search_host', 'elasticsearch'),
            'user' => config('railcontent.elastic_search_username', 'elastic'),
            'pass' => config('railcontent.elastic_search_password', 'changeme'),
            'port' => config('railcontent.elastic_search_port', 9200),
            'scheme' => config('railcontent.elastic_search_transport', 'Http'),
        ];

        $client = ClientBuilder::create()           // Instantiate a new Elasticsearch ClientBuilder
        ->setHosts([$config])      // Set the hosts
        ->build();

        return $client;
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
     * @param null $searchTerm
     * @return array|callable
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
        ?array $requiredContentIdsByState,
        ?array $includedContentsIdsByState,
        array $requiredUserPlaylistIds = [],
        $searchTerm = null
    ) {
        $client = $this->getClient();

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
                ->restrictByFields($requiredFields);
        if ($searchTerm) {
            $searchQuery->restrictByTerm(explode(' ', strtolower($searchTerm)));
        }
        $searchQuery->sortResults($sort);

        $params = [
            'index' => 'content',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => $searchQuery->getMust(),
                    ],
                ],
                'sort' => $searchQuery->getSort(),
                'from' => ($page - 1) * $limit,
                'size' => $limit,
            ],
        ];

        $results = $client->search($params);

        return $results;
    }

    /**
     * @param $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param null $dateTimeCutoff
     * @param string $sort
     * @return ResultSet
     */
    public function search(
        $term,
        $page = 1,
        $limit = 10,
        $contentTypes = [],
        $contentStatuses = [],
        $dateTimeCutoff = null,
        $sort = 'score'
    ) {

        $client = $this->getClient();
        $index = $client->getIndex('content');
        $arrTerm = explode(' ', strtolower($term));

        $searchQuery =
            $this->build()
                ->restrictByUserAccess()
                ->includeByTypes($contentTypes)
                ->restrictByContentStatuses($contentStatuses)
                ->restrictByTerm($arrTerm)
                ->restrictByPublishedDate($dateTimeCutoff)
                ->setResultRelevanceBasedOnConfigSettings($arrTerm)
                ->sortResults($sort)
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
     * @param null $searchTerm
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
        array $requiredUserPlaylistIds = [],
        $searchTerm = null
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
            $requiredUserPlaylistIds,
            $searchTerm
        );

        $idEs = [];
        $filteredContents = [];
        $instructorsIds = [];

        foreach ($filtersEl['hits']['hits'] as $elData) {
            $idEs[] = $elData['_source']['id'];

            if (!in_array($elData['_source']['content_type'], $filteredContents['content_type'] ?? []) &&
                (!in_array($elData['_source']['content_type'], $includedTypes))) {
                $filteredContents['content_type'][] = $elData['_source']['content_type'];
            }

            $requiredFiltersData =
                (array_intersect_key(config('railcontent.field_option_list', []), array_keys($elData['_source'])));

            foreach ($requiredFiltersData as $requiredFieldData) {
                if ($requiredFieldData == 'instructor') {
                    foreach ($elData['_source']['instructor'] ?? [] as $insId) {
                        $instructorsIds[$insId] = $insId;
                    }
                }
                if (array_key_exists($requiredFieldData, $elData['_source'])) {

                    if (is_array($elData['_source'][$requiredFieldData])) {
                        foreach ($elData['_source'][$requiredFieldData] as $option) {
                            if (!in_array(
                                strtolower($option),
                                array_map('strtolower', $filteredContents[$requiredFieldData] ?? [])
                            )) {
                                $filteredContents[$requiredFieldData][] = $option;
                            }
                        }
                    } else {
                        if (($elData['_source'][$requiredFieldData]) && (!in_array(
                                strtolower($elData['_source'][$requiredFieldData]),
                                array_map('strtolower', $filteredContents[$requiredFieldData] ?? [])

                            ))) {
                            $filteredContents[$requiredFieldData][] = $elData['_source'][$requiredFieldData];
                        }
                    }
                }
            }
        }

        foreach ($filteredContents as $availableFieldIndex => $availableField) {
            if (is_numeric(reset($filteredContents[$availableFieldIndex])) &&
                ctype_digit(implode('', $filteredContents[$availableFieldIndex]))) {
                sort($filteredContents[$availableFieldIndex]);
            } else {
                usort(
                    $filteredContents[$availableFieldIndex],
                    function ($a, $b) {
                        return strncmp($a, $b, 15);
                    }
                );
            }
        }

        if (!empty($instructorsIds)) {
            $filteredContents['instructors'] = $instructorsIds;
        }

        unset($filteredContents['instructor']);

        return $filteredContents;
    }
}
