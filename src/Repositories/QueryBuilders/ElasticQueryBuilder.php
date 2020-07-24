<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Elastica\Query;
use Elastica\Query\FunctionScore;
use Elastica\Query\Terms;
use Railroad\Railcontent\Repositories\ContentRepository;

class ElasticQueryBuilder extends \Elastica\Query
{
    public static $userPermissions = [];

    public static $userTopics = [];

    public static $skillLevel;

    /**
     * @param array $slugHierarchy
     * @return $this
     */
    public function restrictBySlugHierarchy(array $slugHierarchy)
    {
        if (empty($slugHierarchy)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('parent_slug', $slugHierarchy);

        $query->addMust($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
            $termsQuery = new Terms('status', ContentRepository::$availableContentStatues);

            $query->addMust($termsQuery);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPublishedOnDate()
    {
        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();

        if (!ContentRepository::$pullFutureContent) {

            $range = new \Elastica\Query\Range();
            $range->addField('published_on.date', ['lte' => 'now']);

            $query->addMust($range);

            $this->setQuery($query);
        }

        if (ContentRepository::$getFutureContentOnly) {
            $range = new \Elastica\Query\Range();
            $range->addField('published_on.date', ['gt' => 'now']);

            $query->addMust($range);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('brand', array_values(array_wrap(config('railcontent.available_brands'))));

        $query->addMust($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
            $termsQuery = new Terms('content_type', $typesToInclude);

            $query->addMust($termsQuery);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @param array $parentIds
     * @return $this
     */
    public function restrictByParentIds(array $parentIds)
    {
        if (empty($parentIds)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('parent_id', $parentIds);

        $query->addMust($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array|null $requiredContentIdsByState
     * @return $this
     */
    public function restrictByUserStates(?array $requiredContentIdsByState)
    {
        if (!$requiredContentIdsByState) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $query2 = new Query\BoolQuery();
        $termsQuery = new Terms('id', $requiredContentIdsByState);

        $query2->addMust($termsQuery);
        $query->addMust($query2);
        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array|null $includedContentsIdsByState
     * @return $this
     */
    public function includeByUserStates(?array $includedContentsIdsByState)
    {
        if (!$includedContentsIdsByState) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $query2 = new Query\BoolQuery();
        $termsQuery = new Terms('id', $includedContentsIdsByState);

        $query2->addShould($termsQuery);
        $query->addMust($query2);
        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array $requiredFields
     * @return $this
     */
    public function restrictByFields(array $requiredFields)
    {
        if (empty($requiredFields)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();

        foreach ($requiredFields as $index => $requiredFieldData) {

            $termsQuery = new Terms($requiredFieldData['name'], [strtolower($requiredFieldData['value'])]);

            $query->addMust($termsQuery);
        }

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param array $includedFields
     * @return $this
     */
    public function includeByFields(array $includedFields)
    {
        if (empty($includedFields)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $query2 = new Query\BoolQuery();
        foreach ($includedFields as $index => $includedFieldData) {

            $termsQuery = new Terms($includedFieldData['name'], [strtolower($includedFieldData['value'])]);

            $query2->addShould($termsQuery);
        }

        $query->addFilter($query2);
        $this->setQuery($query);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByPermissions()
    {
        if (ContentRepository::$bypassPermissions === true) {
            return $this;
        }

        $currentUserActivePermissions = self::$userPermissions;

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();

        $exists = new Query\Exists('permission_ids');

        $nullPermissionsQuery = new Query\BoolQuery();
        $mustNot = $nullPermissionsQuery->addMustNot($exists);

        $termsQuery = new Terms('permission_ids', $currentUserActivePermissions);
        $query3 = new Query\BoolQuery();
        $query3->addShould($termsQuery)
            ->addShould($mustNot);

        $query->addMust($query3);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictByUserAccess()
    {
        $this->restrictPublishedOnDate()
            ->restrictStatuses()
            ->restrictBrand()
            ->restrictByPermissions();

        return $this;
    }

    /**
     * @param array $userPlaylistIds
     * @return $this
     */
    public function restrictByPlaylistIds(array $userPlaylistIds)
    {
        if (empty($userPlaylistIds)) {
            return $this;
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $termsQuery = new Terms('playlist_ids', $userPlaylistIds);

        $query->addMust($termsQuery);

        $this->setQuery($query);

        return $this;
    }

    /**
     * @param $orderBy
     * @return $this
     */
    public function sortResults($orderBy)
    {
        switch ($orderBy) {
            case 'newest':
                $this->addSort(
                    [
                        'published_on' => [
                            'order' => 'desc',
                            'unmapped_type' => 'date',
                        ],
                    ]
                );
                break;
            case 'oldest':
                $this->addSort(
                    [
                        'published_on' => [
                            'order' => 'asc',
                            'unmapped_type' => 'date',
                        ],
                    ]
                );

                break;
            case 'popularity':
                $this->addSort(
                    [
                        'all_progress_count' => [
                            'order' => 'desc',
                        ],
                    ]
                );

                break;

            case 'trending':
                $this->addSort(
                    [
                        'last_week_progress_count' => [
                            'order' => 'desc',
                        ],
                    ]
                );

                break;
            case 'relevance':

                $userDifficulty = self::$skillLevel;
                $userTopics = self::$userTopics;

                $topics = new Terms('topics');
                $topics->setTerms($userTopics);

                $contentTypeFilter = new Query\BoolQuery();

                $contentTypeFilter->addMust($topics);

                $contentTypeFilter2 = new Query\BoolQuery();

                 $contentTypeFilter2->addShould($topics);

                if ($userDifficulty) {
                    $difficulty = new Terms('difficulty');
                    $difficulty->setTerms([$userDifficulty, 'All Skill Levels']);
                    $contentTypeFilter->addMust($difficulty);
                    $contentTypeFilter2->addShould($difficulty);
                }

                $query = new FunctionScore();
                $query->setParam('query', $this->getQuery());

                //set different relevance
                $query->addWeightFunction(15.0, $contentTypeFilter);
                $query->addWeightFunction(10.0, $contentTypeFilter);
                $this->setQuery($query);
                $this->addSort(
                    [
                        '_score' => [
                            'order' => 'desc',
                        ],
                    ]
                );

                break;
        }

        return $this;
    }

    /**
     * @param $term
     * @return $this
     */
    public function fullSearchSort($term)
    {
        $searchableFields = [];
        foreach (config('railcontent.search_index_values', []) as $index => $searchFields) {
            foreach ($searchFields as $field) {
                if (!empty($field)) {
                    foreach ($field as $key => $value) {
                        if ($value == 'instructor:name') {
                            $searchableFields[$index][] = 'instructors_name';
                        } else {
                            if ($value == '*') {
                                $searchableFields[$index] = array_merge(
                                    $searchableFields[$index] ?? [],
                                    config('railcontent.search_all_fields_keys', [])
                                );
                            } else {
                                $searchableFields[$index][] = $value;
                            }
                        }
                    }
                }
            }
        }

        $searcheableFieldsWeightQueries = [];
        foreach ($searchableFields as $priority => $fields) {
            $searcheableFieldsWeightQuery = new Query\BoolQuery();
            foreach ($fields as $field) {
                $termF = new Terms($field);
                $termF->setTerms($term);
                $searcheableFieldsWeightQuery->addShould($termF);
            }
            $searcheableFieldsWeightQueries[$priority] = $searcheableFieldsWeightQuery;
        }

        $query = new FunctionScore();
        $query->setParam('query', $this->getQuery());

        //set different relevance
        $relevance = [
            'high_value' => 20,
            'medium_value' => 10,
            'low_value' => 5,
        ];

        foreach ($searcheableFieldsWeightQueries as $priority => $filterQuery) {
            $query->addWeightFunction($relevance[$priority], $filterQuery);
        }

        $this->setQuery($query);
        $this->addSort(
            [
                '_score' => [
                    'order' => 'desc',
                ],
            ]
        );

        return $this;
    }

    /**
     * @param $arrTerms
     * @return $this
     */
    public function restrictByTerm($arrTerms)
    {
        $searchableFields = [];
        foreach (config('railcontent.search_index_values', []) as $searchFields) {
            foreach ($searchFields as $field) {
                if (!empty($field)) {
                    foreach ($field as $key => $value) {
                        if ($value == 'instructor:name') {
                            $searchableFields[] = 'instructors_name';
                        } else {
                            if ($value == '*') {
                                $searchableFields =
                                    array_merge($searchableFields, config('railcontent.search_all_fields_keys', []));
                            } else {
                                $searchableFields[] = $value;
                            }
                        }
                    }
                }
            }
        }

        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
        $queryFields = new Query\BoolQuery();

        foreach ($searchableFields as $field) {

            $title = new Terms($field);
            $title->setTerms($arrTerms);

            $queryFields->addShould($title);
        }

        $query->addMust($queryFields);
        $this->setQuery($query);

        return $this;
    }

    /**
     * @param $contentStatuses
     * @return $this
     */
    public function restrictByContentStatuses($contentStatuses)
    {
        if (!empty($contentStatuses)) {
            $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();
            $termsQuery = new Terms('status', $contentStatuses);

            $query->addMust($termsQuery);

            $this->setQuery($query);
        }

        return $this;
    }

    /**
     * @param $publishedOn
     * @return $this
     */
    public function restrictByPublishedDate($publishedOn)
    {
        $query = ($this->hasParam('query')) ? $this->getQuery() : new Query\BoolQuery();

        if ($publishedOn) {

            $range = new \Elastica\Query\Range();
            $range->addField('published_on.date', ['gt' => $publishedOn]);

            $query->addMust($range);

            $this->setQuery($query);
        }

        return $this;
    }
}
