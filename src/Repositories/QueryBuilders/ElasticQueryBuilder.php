<?php

namespace Railroad\Railcontent\Repositories\QueryBuilders;

use Illuminate\Support\Arr;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

class ElasticQueryBuilder
{
    public static $userPermissions = [];

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
        $this->must[] = ['terms' => ['brand' => array_values(Arr::wrap(ConfigService::$availableBrands))]];

        return $this;
    }

    /**
     * @param array $typesToInclude
     * @return $this
     */
    public function restrictByTypes(array $typesToInclude)
    {
        if (!empty($typesToInclude)) {
            $this->must[] = [
                'terms' => [
                    'content_type' => array_map(
                        'strtolower',
                        $typesToInclude
                    ),
                ],
            ];
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

        $this->must[] = ['terms' => ['content_id' => $requiredContentIdsByState]];

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
                    ['terms' => ['content_id' => $includedContentsIdsByState]],
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
            if ($requiredFieldData['operator'] == '>' || $requiredFieldData['operator'] == '>=') {
                $this->must[] = [
                    ['range' => [$requiredFieldData['name'] => ['gte' => $requiredFieldData['value']]]],
                ];
            } elseif ($requiredFieldData['operator'] == '<' || $requiredFieldData['operator'] == '<=') {
                $this->must[] = [
                    ['range' => [$requiredFieldData['name'] => ['lte' => $requiredFieldData['value']]]],
                ];
            } elseif ($requiredFieldData['operator'] == 'like') {
                $this->must[] = [
                    ['match' => [$requiredFieldData['name'] => $requiredFieldData['value']]],
                ];
            } else {
                $this->must[] = [
                    'bool' => [
                        'should' => [
                            [
                                'terms' => [
                                    $requiredFieldData['name'].'.raw' => [
                                        strtolower(
                                            $requiredFieldData['value']
                                        ),
                                    ],
                                ],
                            ],
                            ['terms' => [$requiredFieldData['name'] => [strtolower($requiredFieldData['value'])]]],
                            ['terms' => [$requiredFieldData['name'].'.raw' => [($requiredFieldData['value'])]]],
                            ['terms' => [$requiredFieldData['name'] => [($requiredFieldData['value'])]]],
                        ],
                    ],
                ];
            }
        }

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
            $terms[] = ['terms' => [$includedFieldData['name'] => [strtolower($includedFieldData['value'])]]];
            $terms[] = ['terms' => [$includedFieldData['name'].'.raw' => [strtolower($includedFieldData['value'])]]];
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
        $this->must[] = ['terms' => ['content_id' => $userPlaylistIds]];

        return $this;
    }

    /**
     * @param array $userPlaylistIds
     * @return $this
     */
    public function restrictFollowedContent(array $followedContents)
    {
        if (empty($followedContents)) {
            return $this;
        }

        $this->must[] = ['terms' => ['content_id' => $followedContents]];

        return $this;
    }

    /**
     * @param $orderBy
     * @return $this
     */
    public function sortResults($orderBy)
    {
        switch ($orderBy) {
            case 'id':
                $this->sort[] = [
                    'content_id' => 'asc',
                ];
                break;
            case '-id':
                $this->sort[] = [
                    'content_id' => 'desc',
                ];
                break;
            case 'newest':
                $this->sort[] = [
                    'published_on' => 'desc',
                ];
                break;
            case '-created_on':
                $this->sort[] = [
                    'created_on' => 'desc',
                ];
                break;
            case 'created_on':
                $this->sort[] = [
                    'created_on' => 'asc',
                ];
                break;
            case '-published_on':
                $this->sort[] = [
                    'published_on' => 'desc',
                ];
                break;
            case 'published_on':
                $this->sort[] = [
                    'published_on' => 'asc',
                ];
                break;
            case 'oldest':
                $this->sort[] = [
                    'published_on' => 'asc',
                ];
                break;
            case '-popularity':
                $this->sort[] = [
                    'popularity' => 'desc',
                ];
                break;
            case 'slug':
                $this->sort[] = [
                    'title.raw' => 'asc',
                ];
                break;
            case '-slug':
                $this->sort[] = [
                    'title.raw' => 'desc',
                ];
                break;
            case 'title':
                $this->sort[] = [
                    'title.raw' => 'asc',
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
        if (!$term) {
            return $this;
        }

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
        if (empty($arrTerms)) {
            return $this;
        }

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

        $terms = [
            'terms' => [
                'content_type' => array_map(
                    'strtolower',
                    $typesToInclude
                ),
            ],
        ];

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

    /**
     * @param array $instructorIds
     * @return $this
     */
    public function restrictByInstructorIds(array $instructorIds)
    {
        if (empty($instructorIds)) {
            return $this;
        }

        $terms = [];
        foreach ($instructorIds as $instructorId) {
            $terms[] = ['terms' => ['instructor' => [$instructorId]]];
        }

        $this->must[] = [
            'bool' => [
                'should' => $terms,
            ],
        ];

        return $this;
    }
}
