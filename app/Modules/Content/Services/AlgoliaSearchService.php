<?php

namespace App\Modules\Content\Services;

use Algolia\AlgoliaSearch\Api\SearchClient;
use Algolia\AlgoliaSearch\Model\Search\Exhaustive;
use Algolia\AlgoliaSearch\Model\Search\FacetStats;
use Algolia\AlgoliaSearch\Model\Search\Hit;
use Algolia\AlgoliaSearch\Model\Search\Redirect;
use Algolia\AlgoliaSearch\Model\Search\RenderingContent;
use Algolia\AlgoliaSearch\Model\Search\SearchResponse as AlgoliaSearchResponse;
use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Resources\Algolia\Enum\Index;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\AllHit;
use App\Modules\Content\Resources\Algolia\Model\Search\Hit\SongHit;
use App\Modules\Content\Resources\Algolia\Model\Search\SearchResponse;
use App\Modules\Content\Resources\Algolia\SearchParameters;
use Exception;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Repositories\ContentRepository;

class AlgoliaSearchService
{
    protected SearchClient $client;
    public readonly ?Brand $brand;
    /** @var Status[] */
    public array $statusRestrictions;

    public function __construct(public Index $index = Index::All, ?Brand $brand = null)
    {
        $this->client = SearchClient::create(
            config('algolia.app_id'),
            config('algolia.api_key')
        );
        $this->brand = $brand ?? Brand::tryFrom(brand());
        $this->statusRestrictions = $this->getStatusRestrictions();
    }

    /**
     * Get the array of Statuses that the user is allowed to access
     *
     * @return Status[]
     */
    protected function getStatusRestrictions(): array
    {
        // ContentTypes::$availableContentStatues; is set by the SetContentPermissions middleware, and is either
        // false (content with any status will be allowed), or
        // an array of the statuses that are allowed
        $this->statusRestrictions = ContentRepository::$availableContentStatues ? array_filter(
            array_map(
                function (string $status) {
                    $enum = Status::tryFrom($status);
                    if (is_null($enum)) {
                        Log::error(sprintf('[Algolia] Unknown status: %s', $status));
                    }
                    return $enum;
                },
                ContentRepository::$availableContentStatues
            ),
            fn ($item) => !is_null($item)
        ) : [];

        // cast to strictly ensure Status[] type
        return array_map(fn (Status $status) => $status, $this->statusRestrictions);
    }

    /**
     * Perform a search on the service's index
     */
    public function search(string|SearchParameters $query): SearchResponse
    {
        if (is_string($query)) {
            $query = new SearchParameters($this, $query);
        }

        // apply default restrictions if necessary
        if ($this->brand) {
            $query->onlyForBrand($this->brand);
        }

        if (!empty($this->statusRestrictions)) {
            $query->onlyForStatus(...$this->statusRestrictions);
        }

        // dd($query->toArray());
        $response = $this->client->searchSingleIndex($this->index->valueForEnvironment(), $query->toArray());

        // the library automatically converts the response down to an array, but we'd like to work with the classes
        if ($response instanceof AlgoliaSearchResponse) {
            return SearchResponse::fromAlgoliaResponse($response, $this->index);
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Format the response array into the SearchResponse class provided by the Algolia package
     */
    protected function formatResponse(array $responseData): SearchResponse
    {
        $searchResponse = new SearchResponse($responseData, $this->index);
        // format each applicable attribute into its type
        if (array_key_exists('exhaustive', $responseData)) {
            $searchResponse->setExhaustive(new Exhaustive($responseData['exhaustive']));
        }
        if (array_key_exists('facetsStats', $responseData)) {
            $facetStats = array_map(function ($data) {
                return new FacetStats($data);
            }, $responseData['facetsStats']);
            $searchResponse->setFacetsStats($facetStats);
        }
        if (array_key_exists('redirect', $responseData)) {
            $searchResponse->setRedirect(new Redirect($responseData['redirect']));
        }
        if (array_key_exists('renderingContent', $responseData)) {
            $searchResponse->setRenderingContent(new RenderingContent($responseData['renderingContent']));
        }
        if (array_key_exists('hits', $responseData)) {
            $hits = array_map(function ($data) {
                try {
                    return $this->formatHitData($data);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                    return null;
                }
            }, $responseData['hits']);
            $searchResponse->setHits($hits);
        }

        return $searchResponse;
    }

    /**
     * Our Hit data will have different attributes depending on the index we're searching,
     * so format it to the appropriate type.
     *
     * @throws Exception
     */
    protected function formatHitData($hitData): Hit
    {
        switch ($this->index) {
            case Index::All: return new AllHit($hitData);
            case Index::Pack:
                throw new Exception('To be implemented');
            case Index::Workout:
                throw new Exception('To be implemented');
            case Index::StudentFocus:
                throw new Exception('To be implemented');
            case Index::SongTutorial:
                throw new Exception('To be implemented');
            case Index::Song: return new SongHit($hitData);
            case Index::Rudiment:
                throw new Exception('To be implemented');
            case Index::Routine:
                throw new Exception('To be implemented');
            case Index::QuickTips:
                throw new Exception('To be implemented');
            case Index::Podcast:
                throw new Exception('To be implemented');
            case Index::PlayAlong:
                throw new Exception('To be implemented');
            case Index::Course:
                throw new Exception('To be implemented');
            case Index::Bootcamp:
                throw new Exception('To be implemented');
            default:
                throw new Exception('Hit format has not been defined for index ' . $this->index->value);
        }
    }
}
