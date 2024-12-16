<?php

namespace App\Modules\Content\Resources\Algolia;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Models\Instructor;
use App\Modules\Content\Requests\ContentSearchRequest;
use App\Modules\Content\Resources\Algolia\Enum\DocumentType;
use App\Modules\Content\Resources\Algolia\Enum\Facet;
use App\Modules\Content\Services\AlgoliaSearchService;
use Illuminate\Support\Facades\Log;

/**
 * Search Parameters are used to build up the query used by the Algolia Search Service.
 * This allows us to build any desired options for the query and apply filtering via facets.
 */
class SearchParameters
{
    /**
     * TODO NOTE:
     * We could really make this solid by creating a custom attribute class for the different types of validation
     * (e.g. integer within a range, string is one of, array values are in allowed list, etc.)
     * and then apply those attributes where appropriate. Then we'd have a validation method to use reflection
     * to check the properties set in the options() function for any of our custom attributes and then check for
     * any issues, throwing an InvalidArgumentException if necessary.
     * This is kind of overkill for now, so I won't bother adding in all of that and just rely on the phpdoc comments.
     */

    /**
     * These are (nearly) the complete list of options for the search API.
     * @see https://www.algolia.com/doc/rest-api/search/#tag/Search/operation/searchSingleIndex
     *
     * There were a few omissions like lat/long precision that are far too complicated to bother with,
     * or some options like facetFilters that have a different usage recommended.
     *
     * Any comment about allowed options are from the documentation.
     */
    public ?bool $advancedSyntax = null;
    /** @var string[]|null allowed options: 'exactPhrase' 'excludeWords' */
    public ?array $advancedSyntaxFeatures = null;
    public ?bool $allowTyposOnNumericTokens = null;
    /** @var string[]|null allowed options: 'ignorePlurals' 'multiWordsSynonym' 'singleWordSynonym' */
    public ?array $alternativesAsExact = null;
    public ?bool $analytics = null;
    /** @var string[]|null */
    public ?array $analyticsTags = null;
    public ?string $aroundLatLng = null;
    public ?bool $attributeCriteriaComputedByMinProximity = null;
    /** @var string[] */
    public ?array $attributesToHighlight = null;
    /** @var string[]|null */
    public ?array $attributesToRetrieve = null;
    /** @var string[]|null */
    public ?array $attributesToSnippet = null;
    public ?bool $clickAnalytics = null;
    public ?bool $decompoundQuery = null;
    /** @var string[]|null */
    public ?array $disableExactOnAttributes = null;
    /** @var string[]|null */
    public ?array $disableTypoToleranceOnAttributes = null;
    public ?bool $enableABTest = null;
    public ?bool $enablePersonalization = null;
    public ?bool $enableReRanking = null;
    public ?bool $enableRules = null;
    /** @var string|null allowed options: 'attribute' 'none' 'word' */
    public ?string $exactOnSingleWordQuery = null;
    public ?bool $facetingAfterDistinct = null;
    /** @var string[]|null */
    public ?array $facets = null;
    /** @var string[]|null */
    public ?array $filters = null;
    public ?bool $getRankingInfo = null;
    public ?string $highlightPostTag = null;
    public ?string $highlightPreTag = null;
    public ?int $hitsPerPage = null;
    /** @var string[]|bool|null array of supportedLanguage (string) or bool */
    public array|bool|null $ignorePlurals = null;
    public ?string $keepDiacriticsOnCharacters = null;
    public ?int $length = null;
    /** @var int|null max value of 1000 */
    public ?int $maxFacetHits = null;
    /** @var int|null max value of 1000 */
    public ?int $maxValuesPerFacet = null;
    /** @var int|null max value of 7 */
    public ?int $minProximity = null;
    public ?int $minWordSizefor1Typo = null;
    public ?int $minWordSizefor2Typos = null;
    /** @var string[] lowercase ISO language codes to use for natural language queries. e.g. 'en', 'fr', 'ro' */
    public ?array $naturalLanguages = null;
    public ?int $offset = null;
    /** @var string|array|null array of optionalFilters, or string */
    public string|array|null $optionalFilters = null;
    /** @var string[] */
    public ?array $optionalWords = null;
    public ?int $page = null;
    public ?bool $percentileComputation = null;
    /** @var int|null max value of 100 */
    public ?int $personalizationImpact = null;
    /** @var string[] lowercase ISO language codes for language-specific query processing steps. e.g. 'en', 'fr', 'ro' */
    public ?array $queryLanguages = null;
    /** @var string|null allowed options: 'prefixAll' 'prefixLast' 'prefixNone' */
    public ?string $queryType = null;
    /** @var string[]|null order of ranking criteria options */
    public ?array $ranking = null;
    public ?int $relevancyStrictness = null;
    /** @var string[]|bool|null array of supportedLanguage (string) or bool */
    public array|bool|null $removeStopWords = null;
    /** @var string|null allowed options: 'allOptional' 'firstWords' 'lastWords' 'none' */
    public ?string $removeWordsIfNoResults = null;
    public ?bool $replaceSynonymsInHighlight = null;
    /** @var string[]|null */
    public ?array $responseFields = null;
    public ?bool $restrictHighlightAndSnippetArrays = null;
    /** @var string[]|null  */
    public ?array $restrictSearchableAttributes = null;
    /** @var string[]|null  */
    public ?array $ruleContexts = null;
    public ?string $similarQuery = null;
    public ?string $snippetEllipsisText = null;
    /** @var string|null allowed options: 'count' 'alpha' */
    public ?string $sortFacetValuesBy = null;
    public ?bool $sumOrFiltersScores = null;
    public ?bool $synonyms = null;
    /** @var array|string|null array of tagFilters (any) or string */
    public array|string|null $tagFilters = null;
    /** @var bool|string|null boolean or typo tolerance ('min', 'strict', or word splitting and concatenation setting) */
    public bool|string|null $typoTolerance = null;
    public ?string $userToken = null;

    // internal settings
    protected bool $hasOptions;

    public function __construct(public AlgoliaSearchService $algoliaSearchService, public string $query)
    {
        $this->hasOptions = false;
    }

    /**
     * Build up a SearchParameters object with all possible options set by the ContentSearchRequest
     *
     * @param  AlgoliaSearchService  $algoliaSearchService
     * @param  ContentSearchRequest  $request
     * @return SearchParameters
     */
    public static function fromRequest(AlgoliaSearchService $algoliaSearchService, ContentSearchRequest $request): SearchParameters
    {
        $searchParams = new SearchParameters($algoliaSearchService, $request->get('term'));

        $requestedStatuses = $request->get('statuses');
        if ($requestedStatuses) {
            $validStatuses = self::sanitizeEnumValues(Status::class, $requestedStatuses);
            if (!empty($validStatuses)) {
                $searchParams->onlyForStatus(...$validStatuses);
            }
        }

        $requestedBrands = $request->get('brands');
        if ($requestedBrands) {
            $validBrands = self::sanitizeEnumValues(Brand::class, $requestedBrands);
            if (!empty($validBrands)) {
                $searchParams->onlyForBrand(...$validBrands);
            }
        }

        $instructors = Instructor::findMany($request->get('coach_ids', []));
        if ($instructors->isNotEmpty()) {
            $searchParams->onlyForInstructor(...$instructors->toArray());
        }

        $requestedDocumentTypes = $request->get('included_types');
        if ($requestedDocumentTypes) {
            $validDocumentTypes = self::sanitizeEnumValues(DocumentType::class, $requestedDocumentTypes);
            if (!empty($validDocumentTypes)) {
                $searchParams->onlyForType(...$validDocumentTypes);
            }
        }

        $searchParams->withOptions(
            hitsPerPage: $request->get('limit'),
            page: $request->get('page')
        );

        //TODO sort - I'm not sure how to make this work with Algolia ...
        //TODO include_future_scheduled_content_only (if we're going to support it)

        return $searchParams;
    }

    /**
     * Get the array of Enum Class built from the values associated with it
     *
     * @param  string  $enumClass
     * @param  array  $requestValues
     * @return array
     */
    private static function sanitizeEnumValues(string $enumClass, array $requestValues)
    {
        return array_values(
            array_filter(
                array_map(
                    fn (string $value) => $enumClass::tryFrom($value),
                    $requestValues
                )
            )
        );
    }

    /**
     * Set any available options. Default values will be set for any options not set here.
     * DEV NOTE: use named arguments to set only those values that you want to adjust.
     *
     * @param string[]|null $advancedSyntaxFeatures allowed options: 'exactPhrase' 'excludeWords'
     * @param string[]|null $alternativesAsExact allowed options: 'ignorePlurals' 'multiWordsSynonym' 'singleWordSynonym'
     * @param string[]|null $analyticsTags
     * @param string[]|null $attributesToHighlight
     * @param string[]|null $attributesToRetrieve
     * @param string[]|null $attributesToSnippet
     * @param string[]|null $disableExactOnAttributes
     * @param string[]|null $disableTypoToleranceOnAttributes
     * @param string|null $exactOnSingleWordQuery allowed options: 'attribute' 'none' 'word'
     * @param string[]|null $facets
     * @param int|null $maxFacetHits max value of 1000
     * @param int|null $maxValuesPerFacet max value of 1000
     * @param int|null $minProximity max value of 7
     * @param string[]|null $naturalLanguages lowercase ISO language codes to use for natural language queries. e.g. 'en', 'fr', 'ro'
     * @param string|array|null $optionalFilters array of optionalFilters, or string
     * @param string[]|null $optionalWords
     * @param int|null $personalizationImpact max value of 100
     * @param string[]|null $queryLanguages lowercase ISO language codes for language-specific query processing steps. e.g. 'en', 'fr', 'ro'
     * @param string|null $queryType allowed options: 'prefixAll' 'prefixLast' 'prefixNone'
     * @param string[]|null $ranking order of ranking criteria options
     * @param string[]|bool|null $ignorePlurals array of supportedLanguage (string) or bool
     * @param string|null $removeWordsIfNoResults allowed options: 'allOptional' 'firstWords' 'lastWords' 'none'
     * @param string[]|null $responseFields
     * @param string[]|null $restrictSearchableAttributes
     * @param string[]|null $ruleContexts
     * @param string|null $sortFacetValuesBy allowed options: 'count' 'alpha'
     * @param array|string|null $tagFilters array of tagFilters (any) or string
     * @param bool|string|null $typoTolerance boolean or typo tolerance ('min', 'strict', or word splitting and concatenation setting)
     * @return $this
     */
    public function withOptions(
        ?bool $advancedSyntax = null,
        ?array $advancedSyntaxFeatures = null,
        ?bool $allowTyposOnNumericTokens = null,
        ?array $alternativesAsExact = null,
        ?bool $analytics = null,
        ?array $analyticsTags = null,
        ?string $aroundLatLng = null,
        ?bool $attributeCriteriaComputedByMinProximity = null,
        ?array $attributesToHighlight = null,
        ?array $attributesToRetrieve = null,
        ?array $attributesToSnippet = null,
        ?bool $clickAnalytics = null,
        ?bool $decompoundQuery = null,
        ?array $disableExactOnAttributes = null,
        ?array $disableTypoToleranceOnAttributes = null,
        ?bool $enableABTest = null,
        ?bool $enablePersonalization = null,
        ?bool $enableReRanking = null,
        ?bool $enableRules = null,
        ?string $exactOnSingleWordQuery = null,
        ?bool $facetingAfterDistinct = null,
        ?array $facets = null,
        ?bool $getRankingInfo = null,
        ?string $highlightPostTag = null,
        ?string $highlightPreTag = null,
        ?int $hitsPerPage = null,
        array|bool|null $ignorePlurals = null,
        ?string $keepDiacriticsOnCharacters = null,
        ?int $length = null,
        ?int $maxFacetHits = null,
        ?int $maxValuesPerFacet = null,
        ?int $minProximity = null,
        ?int $minWordSizefor1Typo = null,
        ?int $minWordSizefor2Typos = null,
        ?array $naturalLanguages = null,
        ?int $offset = null,
        string|array|null $optionalFilters = null,
        ?array $optionalWords = null,
        ?int $page = null,
        ?bool $percentileComputation = null,
        ?int $personalizationImpact = null,
        ?array $queryLanguages = null,
        ?string $queryType = null,
        ?array $ranking = null,
        ?int $relevancyStrictness = null,
        array|bool|null $removeStopWords = null,
        ?string $removeWordsIfNoResults = null,
        ?bool $replaceSynonymsInHighlight = null,
        ?array $responseFields = null,
        ?bool $restrictHighlightAndSnippetArrays = null,
        ?array $restrictSearchableAttributes = null,
        ?array $ruleContexts = null,
        ?string $similarQuery = null,
        ?string $snippetEllipsisText = null,
        ?string $sortFacetValuesBy = null,
        ?bool $sumOrFiltersScores = null,
        ?bool $synonyms = null,
        array|string|null $tagFilters = null,
        bool|string|null $typoTolerance = null,
        ?string $userToken = null,
    ): self {
        $this->hasOptions = true;

        $this->advancedSyntax = $advancedSyntax;
        $this->advancedSyntaxFeatures = $advancedSyntaxFeatures;
        $this->allowTyposOnNumericTokens = $allowTyposOnNumericTokens;
        $this->alternativesAsExact = $alternativesAsExact;
        $this->analytics = $analytics;
        $this->analyticsTags = $analyticsTags;
        $this->aroundLatLng = $aroundLatLng;
        $this->attributeCriteriaComputedByMinProximity = $attributeCriteriaComputedByMinProximity;
        $this->attributesToHighlight = $attributesToHighlight;
        $this->attributesToRetrieve = $attributesToRetrieve;
        $this->attributesToSnippet = $attributesToSnippet;
        $this->clickAnalytics = $clickAnalytics;
        $this->decompoundQuery = $decompoundQuery;
        $this->disableExactOnAttributes = $disableExactOnAttributes;
        $this->disableTypoToleranceOnAttributes = $disableTypoToleranceOnAttributes;
        $this->enableABTest = $enableABTest;
        $this->enablePersonalization = $enablePersonalization;
        $this->enableReRanking = $enableReRanking;
        $this->enableRules = $enableRules;
        $this->exactOnSingleWordQuery = $exactOnSingleWordQuery;
        $this->facetingAfterDistinct = $facetingAfterDistinct;
        $this->facets = $facets;
        $this->getRankingInfo = $getRankingInfo;
        $this->highlightPostTag = $highlightPostTag;
        $this->highlightPreTag = $highlightPreTag;
        $this->hitsPerPage = $hitsPerPage;
        $this->ignorePlurals = $ignorePlurals;
        $this->keepDiacriticsOnCharacters = $keepDiacriticsOnCharacters;
        $this->length = $length;
        $this->maxFacetHits = $maxFacetHits;
        $this->maxValuesPerFacet = $maxValuesPerFacet;
        $this->minProximity = $minProximity;
        $this->minWordSizefor1Typo = $minWordSizefor1Typo;
        $this->minWordSizefor2Typos = $minWordSizefor2Typos;
        $this->naturalLanguages = $naturalLanguages;
        $this->offset = $offset;
        $this->optionalFilters = $optionalFilters;
        $this->optionalWords = $optionalWords;
        $this->page = $page;
        $this->percentileComputation = $percentileComputation;
        $this->personalizationImpact = $personalizationImpact;
        $this->queryLanguages = $queryLanguages;
        $this->queryType = $queryType;
        $this->ranking = $ranking;
        $this->relevancyStrictness = $relevancyStrictness;
        $this->removeStopWords = $removeStopWords;
        $this->removeWordsIfNoResults = $removeWordsIfNoResults;
        $this->replaceSynonymsInHighlight = $replaceSynonymsInHighlight;
        $this->responseFields = $responseFields;
        $this->restrictHighlightAndSnippetArrays = $restrictHighlightAndSnippetArrays;
        $this->restrictSearchableAttributes = $restrictSearchableAttributes;
        $this->ruleContexts = $ruleContexts;
        $this->similarQuery = $similarQuery;
        $this->snippetEllipsisText = $snippetEllipsisText;
        $this->sortFacetValuesBy = $sortFacetValuesBy;
        $this->sumOrFiltersScores = $sumOrFiltersScores;
        $this->synonyms = $synonyms;
        $this->tagFilters = $tagFilters;
        $this->typoTolerance = $typoTolerance;
        $this->userToken = $userToken;

        return $this;
    }

    /**
     * Add to the filtering applied to this search.
     * The given value will be used along with the facet's name to create a filter.
     * If applicable, supply a comparator (e.g. '<', '=', '!=', 'TO', etc.). These are currently only used for
     * numeric or date_timestamp types of facets.
     * If you're adding multiple filters, they can be AND'ed or OR'ed together.
     * When using a string or array facet, you can also make this a NOT clause by setting $applyNot to true.
     *
     * @param  Facet  $facet attribute to filter on
     * @param  string|int|array  $value value to use on the filter
     * @param  string|null  $comparator comparator to use on numeric or date_timestamp attributes
     * @param  bool  $orStatement append to the existing filter with an OR clause. Defaults to AND if not set to true.
     * @param  bool  $applyNot make this filter a NOT clause. Used only for string and array attributes.
     * @return $this
     */
    public function addFilter(Facet $facet, string|int|array $value, ?string $comparator = null, bool $orStatement = false, bool $applyNot = false): self
    {
        if (!$facet->isInIndex($this->algoliaSearchService->index)) {
            Log::error(sprintf('Facet %s is not available for index %s. Filter has not been applied.', $facet->value, $this->algoliaSearchService->index->value));
            return $this;
        }

        $filter = '';

        if (!empty($this->filters)) {
            $filter = $orStatement ? ', OR ' : '';
        }
        if ($applyNot) {
            $filter .= 'NOT ';
        }

        switch ($facet->getAttributeType()) {
            case Facet::TYPE_STRING:
            case Facet::TYPE_ARRAY:
                if (is_array($value)) {
                    $typeValueStrings = array_map(fn ($value) => sprintf('%s:%s', $facet->value, $value), $value);
                    $filter .= sprintf('(%s)', implode(' OR ', $typeValueStrings));
                } else {
                    $filter .= sprintf('%s:%s', $facet->value, $value);
                }
                break;
            case Facet::TYPE_NUMERIC:
            case Facet::TYPE_DATE_TIMESTAMP:
                if (!$comparator) {
                    Log::error(sprintf('Missing required comparator for %s facet %s. Filter has not been applied.', $facet->getAttributeType(), $facet->value));
                    return $this;
                }
                $filter .= sprintf('%s %s %s', $facet->value, $comparator, $value);
                break;
            default:
                Log::error(sprintf('Unsupported attribute type for: %s. Filter has not been applied.', $facet->value));
                return $this;
        }

        $this->filters[] = $filter;
        $this->hasOptions = true;
        return $this;
    }

    /**
     * Apply a filter so that only documents for the given brand(s) of will be searched
     *
     * @param  Brand  ...$brands
     * @return self
     */
    public function onlyForBrand(Brand ...$brands): self
    {
        if (count($brands) === 1) {
            $updated = $this->addFilter(Facet::Brand, $brands[0]->value);
        } else {
            $brandStrings = array_map(fn (Brand $brand) => $brand->value, $brands);
            $updated = $this->addFilter(Facet::Brand, $brandStrings);
        }
        return $updated;
    }

    /**
     * Apply a filter so that only the given type(s) of documents will be searched
     *
     * @param  DocumentType  ...$types
     * @return self
     */
    public function onlyForType(DocumentType ...$types): self
    {
        if (count($types) === 1) {
            $updated = $this->addFilter(Facet::DocumentType, $types[0]->value);
        } else {
            $typeStrings = array_map(fn (DocumentType $type) => $type->value, $types);
            $updated = $this->addFilter(Facet::DocumentType, $typeStrings);
        }
        return $updated;
    }

    /**
     * Apply a filter so that only the given documents with the given status(es) will be searched
     *
     * @param  Status  ...$statuses
     * @return $this
     */
    public function onlyForStatus(Status ...$statuses): self
    {
        if (count($statuses) === 1) {
            $updated = $this->addFilter(Facet::Status, $statuses[0]->value);
        } else {
            $statusStrings = array_map(fn (Status $status) => $status->value, $statuses);
            $updated = $this->addFilter(Facet::Status, $statusStrings);
        }
        return $updated;
    }

    /**
     * Apply a filter so that only the given documents with the given instructor(s) will be searched
     *
     * @param  Instructor  ...$instructors
     * @return $this
     */
    public function onlyForInstructor(Instructor ...$instructors): self
    {
        if (count($instructors) === 1) {
            $updated = $this->addFilter(Facet::InstructorNames, $instructors[0]->name);
        } else {
            $instructorNames = array_map(fn (Instructor $instructor) => $instructor->name, $instructors);
            $updated = $this->addFilter(Facet::InstructorNames, $instructorNames);
        }
        return $updated;
    }

    /**
     * Add a filter to the full filters array without any validation.
     * Only use this if you know what you're doing.
     *
     * @return $this
     */
    public function addRawFilter(string $filter): self
    {
        $this->filters[] = $filter;
        $this->hasOptions = true;
        return $this;
    }

    /**
     * Override for setting filters to a full array without any validation.
     * Only use this if you know what you're doing.
     *
     * @return $this
     */
    public function setRawFilters(array $filters): self
    {
        $this->filters = $filters;
        $this->hasOptions = true;
        return $this;
    }

    public function toArray(): array
    {
        if ($this->hasOptions) {
            $options = get_object_vars($this);

            // remove our internal attributes
            unset($options['hasOptions']);
            unset($options['algoliaSearchService']);

            // convert the filters into a string
            if (!empty($this->filters)) {
                $options['filters'] = implode(' AND ', $this->filters);
            }

            // remove any null values
            return array_filter($options, function ($value) {
                return $value !== null;
            });
        }

        return ['query' => $this->query];
    }
}
