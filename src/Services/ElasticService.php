<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Elasticsearch\ClientBuilder;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;

class ElasticService
{
    /**
     * @var ContentService ContentService
     */
    private $contentService;

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
     * @return array
     */
    public function createContentIndex()
    {
        $client = $this->getClient();
        $indexName = config('railcontent.elastic_index_name', 'content');

        if (!$client->indices()
            ->exists(['index' => $indexName])) {
            $params = [
                'index' => $indexName,
                'body' => [
                    'settings' => [
                        'number_of_shards' => 1,
                        'number_of_replicas' => 0,
                    ],
                    'mappings' => [
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'content_id' => ['type' => 'integer'],
                            'is_coach' => ['type' => 'integer'],
                            'is_coach_of_the_month' => ['type' => 'integer'],
                            'is_active' => ['type' => 'integer'],
                            'is_featured' => ['type' => 'integer'],
                            'title' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'name' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'slug' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'brand' => ['type' => 'text'],
                            'content_type' => ['type' => 'keyword'],
                            'status' => ['type' => 'text'],
                            'difficulty' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'style' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'description' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'topic' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'artist' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'instructor' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'vimeo_video_id' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'youtube_video_id' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'instructors_name' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'bpm' => ['type' => 'integer', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'published_on' => ['type' => 'date', "format" => "yyyy-MM-dd HH:mm:ss"],
                            'created_on' => ['type' => 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
                            'show_in_new_feed' => ['type' => 'integer'],
                            'permission_ids' => ['type' => 'text'],
                            'focus' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'associated_user_id' => ['type' => 'text', 'fields' => ['raw' => ['type' => 'keyword']]],
                            'popularity' => ['type' => 'integer'],
                        ],
                    ],
                ],
            ];

            // Create the index with mappings and settings
            return $client->indices()
                ->create($params);
        }
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
        $searchTerm = null,
        array $followedContents = []
    ) {
        $client = $this->getClient();
        $indexName = config('railcontent.elastic_index_name', 'content');

        if ($client->indices()
            ->exists(['index' => $indexName])) {
            $searchQuery =
                $this->build()
                    ->restrictByUserStates($requiredContentIdsByState)
                    ->restrictByUserAccess()
                    ->restrictByTypes($includedTypes)
                    ->includeByUserStates($includedContentsIdsByState)
                    ->includeByFields($includedFields)
                    ->restrictByParentIds($requiredParentIds)
                    ->restrictBySlugHierarchy($slugHierarchy)
                    ->restrictByPlaylistIds($requiredUserPlaylistIds)
                    ->restrictFollowedContent($followedContents)
                    ->restrictByFields($requiredFields);
            if ($searchTerm) {
                $searchQuery->restrictByTerm(explode(' ', strtolower($searchTerm)));
            }
            $searchQuery->sortResults($sort);

            $params = [
                'index' => $indexName,
                'body' => [
                    'query' => [
                        'function_score' => [
                            'query' => [
                                'bool' => [
                                    'must' => $searchQuery->getMust(),
                                ],
                            ],
                            'functions' => $searchQuery->getFilters(),
                        ],
                    ],
                    'sort' => $searchQuery->getSort(),
                    'from' => ($page - 1) * $limit,
                    'size' => $limit,
                ],
            ];

            return $client->search($params);
        }
    }

    /**
     * @param $term
     * @param int $page
     * @param int $limit
     * @param array $contentTypes
     * @param array $contentStatuses
     * @param null $dateTimeCutoff
     * @param string $sort
     * @return array|callable
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
        if ($term) {
            $arrTerm = explode(' ', strtolower($term));
        }
        $indexName = config('railcontent.elastic_index_name', 'content');

        $searchQuery =
            $this->build()
                ->restrictByUserAccess()
                ->includeByTypes($contentTypes)
                ->restrictByContentStatuses($contentStatuses)
                ->restrictByTerm($arrTerm ?? [])
                ->restrictByPublishedDate($dateTimeCutoff)
                ->setResultRelevanceBasedOnConfigSettings($arrTerm)
                ->sortResults($sort);

        $params = [
            'index' => $indexName,
            'body' => [
                'query' => [
                    'function_score' => [
                        'query' => [
                            'bool' => [
                                'must' => $searchQuery->getMust(),
                            ],
                        ],
                        'functions' => $searchQuery->getFilters(),
                    ],
                ],
                'sort' => $searchQuery->getSort(),
                'from' => ($page - 1) * $limit,
                'size' => $limit,
            ],
        ];

        return $client->search($params);
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
            $idEs[] = $elData['_source']['content_id'];

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
                                ucfirst(trim($option)),
                                array_map('trim', $filteredContents[$requiredFieldData] ?? [])
                            )) {
                                $filteredContents[$requiredFieldData][] = ucfirst(trim($option));
                            }
                        }
                    } else {
                        if (($elData['_source'][$requiredFieldData]) && (!in_array(
                                ucfirst(trim(($elData['_source'][$requiredFieldData]))),
                                array_map('strtolower', $filteredContents[$requiredFieldData] ?? [])
                            ))) {
                            $filteredContents[$requiredFieldData][] =
                                ucfirst(trim($elData['_source'][$requiredFieldData]));
                        }
                    }
                }
            }

            if (!in_array($elData['_source']['content_type'], $filteredContents['content_type'] ?? [])) {
                $filteredContents['content_type'][] = $elData['_source']['content_type'];
            }
        }

        foreach ($filteredContents as $availableFieldIndex => $availableField) {
            usort($filteredContents[$availableFieldIndex], function ($a, $b) {
                if (is_numeric($a) && is_numeric($b)) {
                    return $a > $b;
                }

                return strncmp($a, $b, 15);
            });
        }

        if (!empty($instructorsIds)) {
            $filteredContents['instructors'] = $instructorsIds;
        }

        unset($filteredContents['instructor']);

        return $filteredContents;
    }

    public function deleteIndex($indexName)
    {
        $client = $this->getClient();

        $client->indices()
            ->delete(['index' => $indexName]);
    }

    public function syncDocument($content)
    {
        $client = $this->getClient();

        $contentID = $content['id'];

        $this->contentService = app(ContentService::class);
        $elasticData = $this->contentService->getElasticData($contentID);

        $paramsContent = [
            'index' => 'content',
            'body' => $elasticData,
        ];

        // Create indexes if not exists
        if (!$client->indices()
            ->exists(['index' => 'content'])) {
            $this->createContentIndex();
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

        return $elasticData;
    }
}
