<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Railroad\Railcontent\Repositories\ContentRepository;

class ElasticQueryBuilder
{
    public static $userPermissions = [];

    public static $userTopics = [];

    public static $skillLevel;

    private $must = [];

    private $sort = [];

    private $filters = [];

    /**
     * @param array $slugHierarchy
     * @return $this
     */
    public function restrictBySlugHierarchy(array $slugHierarchy)
    {
        if (empty($slugHierarchy)) {
            return $this;
        }

        $this->must[] = ['terms' => ['parent_slug' => $slugHierarchy]];

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictStatuses()
    {
        if (is_array(ContentRepository::$availableContentStatues)) {
            $this->must[] = ['terms' => ['status' => ContentRepository::$availableContentStatues]];
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function restrictPublishedOnDate()
    {
        if (!ContentRepository::$pullFutureContent) {
            $this->must[] = ['range' => ['published_on' => ['lte' => 'now']]];
        }

        if (ContentRepository::$getFutureContentOnly) {
            $this->must[] = ['range' => ['published_on' => ['gt' => 'now']]];
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function restrictBrand()
    {
        $this->must[] = ['terms' => ['brand' => array_values(array_wrap(config('railcontent.available_brands')))]];

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $this->must[] = ['terms' => ['content_type' => $typesToInclude]];
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

        $this->must[] = ['terms' => ['parent_id' => $parentIds]];

        return $this;
    }

    /**
     * @param array|null $requiredContentIdsByState
     * @return $this
     */
    public function restrictByUserStates(?array $requiredContentIdsByState)
    {
        if (!is_array($requiredContentIdsByState)) {
            return $this;
        }

        $this->must[] = [['terms' => ['id' => $requiredContentIdsByState]],];

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

        $this->must[] = [
            'bool' => [
                'should' => [
                    ['terms' => ['id' => $includedContentsIdsByState]],
                ],
            ],
        ];

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

        foreach ($requiredFields as $index => $requiredFieldData) {
            $this->must[] = ['terms' => [$requiredFieldData['name'] . '.raw' => [$requiredFieldData['value']]]];

        }
        //dd($this);
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

        $terms = [];
        foreach ($includedFields as $index => $includedFieldData) {
            $terms[] = ['terms' => [$includedFieldData['name'] . '.raw' => [strtolower($includedFieldData['value'])]]];

        }

        $this->must[] = [
            'bool' => [
                'should' => $terms,

            ],
        ];

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

        $this->must[] = [
            'bool' => [
                'should' => [
                    ['terms' => ['permission_ids' => $currentUserActivePermissions]],
                    ['bool' => ['must_not' => ['exists' => ['field' => 'permission_ids']]]],
                ],
            ],
        ];

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
        $this->must[] = ['terms' => ['playlist_ids' => $userPlaylistIds]];

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
                $this->sort[] = [
                    'published_on' => 'desc',
                ];
                break;

            case 'oldest':
                $this->sort[] = [
                    'published_on' => 'asc',
                ];
                break;

            case 'popularity':
                $this->sort[] = [
                    'all_progress_count' => 'desc',
                ];
                break;

            case 'trending':
                $this->sort[] = [
                    'last_week_progress_count' => 'desc',
                ];
                break;

            case 'relevance':

                $userDifficulty = self::$skillLevel;
                $userTopics = self::$userTopics;

                if ($userDifficulty) {
                    $this->filters[] = [
                        'filter' => ['terms' => ['difficulty.raw' => [$userDifficulty, 'All Skill Levels']]],
                        'weight' => 20,
                    ];
                }

                if ($userTopics) {
                    $this->filters[] = [
                        'filter' => ['terms' => ['topic' => $userTopics]],
                        'weight' => 20,
                    ];
                }

                $this->sort[] = [
                    '_score' => 'desc',
                ];

                break;

            case 'slug':
                $this->sort[] = [
                    'slug.raw' => 'asc',
                ];
                break;

            case 'score':
                $this->sort[] = [
                    '_score' => 'desc',
                ];
                break;
        }

        return $this;
    }

    /**
     * @param $term
     * @return $this
     */
    public function setResultRelevanceBasedOnConfigSettings($term)
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

        //set different relevance
        $relevance = [
            'high_value' => 100,
            'medium_value' => 10,
            'low_value' => 5,
        ];

        foreach ($searchableFields as $priority => $fields) {
            foreach ($fields as $field) {
                $this->filters[] = [
                    'filter' => ['terms' => [$field => $term]],
                    'weight' => $relevance[$priority],
                ];
            }
        }

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

        $terms = [];
        foreach (array_unique($searchableFields) as $field) {
            $terms[] = ['terms' => [$field => $arrTerms]];
        }

        $this->must[] = [
            'bool' => [
                'should' => $terms,
            ],
        ];

        return $this;
    }

    /**
     * @param $contentStatuses
     * @return $this
     */
    public function restrictByContentStatuses($contentStatuses)
    {
        if (!empty($contentStatuses)) {
            $this->must[] = ['terms' => ['status' => $contentStatuses]];
        }

        return $this;
    }

    /**
     * @param $publishedOn
     * @return $this
     */
    public function restrictByPublishedDate($publishedOn)
    {
        if ($publishedOn) {
            $this->must[] = ['range' => ['published_on' => ['gt' => $publishedOn]]];
        }

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function includeByTypes(array $typesToInclude)
    {

        if (empty($typesToInclude)) {
            return $this;
        }

        $terms = ['terms' => ['content_type' => $typesToInclude]];

        $this->must[] = [
            'bool' => [
                'should' => $terms,
            ],
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function getMust()
    {
        return $this->must;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
