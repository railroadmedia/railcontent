<?php

namespace App\Modules\Content\tests\Unit;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Resources\Algolia\Enum\DocumentType;
use App\Modules\Content\Resources\Algolia\Enum\Facet;
use App\Modules\Content\Resources\Algolia\SearchParameters;
use App\Modules\Content\Services\AlgoliaSearchService;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AlgoliaSearchParametersTest extends TestCase
{
    protected AlgoliaSearchService $searchService;

    public function test_only_query_if_no_options(): void
    {
        $query = 'FOO';
        $searchParams = (new SearchParameters($this->searchService, $query));
        $this->assertEquals(['query' => $query], $searchParams->toArray());
    }

    public function test_query_adds_options_when_called(): void
    {
        $searchParams = (new SearchParameters($this->searchService, 'FOO'))->withOptions(advancedSyntax: true);
        $this->assertArraySubsetMatch(['advancedSyntax' => true], $searchParams->toArray());
    }

    public function test_query_only_adds_filter_options_when_set_using_only_for_brand(): void
    {
        $query = 'FOO';
        $brand = Brand::Drumeo;
        $searchParams = (new SearchParameters($this->searchService, $query))->onlyForBrand($brand);

        $queryArray = $searchParams->toArray();
        $this->assertContains('query', array_keys($queryArray));
        $this->assertContains('filters', array_keys($queryArray));
        $this->assertEmpty(
            array_filter($queryArray, fn ($value, $key) => $key != 'query' && $key != 'filters', ARRAY_FILTER_USE_BOTH)
        );
        $this->assertArraySubsetMatch(['query' => $query], $queryArray);
        $this->assertArraySubsetMatch(['filters' => sprintf('%s:%s', Facet::Brand->value, $brand->value)], $queryArray);
    }

    public function test_query_only_adds_filter_options_when_set_using_only_for_type(): void
    {
        $query = 'FOO';
        $types = [DocumentType::Song, DocumentType::Challenge];
        $searchParams = (new SearchParameters($this->searchService, $query))->onlyForType(...$types);

        $queryArray = $searchParams->toArray();
        $this->assertContains('query', array_keys($queryArray));
        $this->assertContains('filters', array_keys($queryArray));
        $this->assertEmpty(
            array_filter($queryArray, fn ($value, $key) => $key != 'query' && $key != 'filters', ARRAY_FILTER_USE_BOTH)
        );
        $this->assertArraySubsetMatch(['query' => $query], $queryArray);
        $this->assertArraySubsetMatch(
            [
                'filters' => sprintf(
                    '(%s:%s OR %s:%s)',
                    Facet::DocumentType->value,
                    DocumentType::Song->value,
                    Facet::DocumentType->value,
                    DocumentType::Challenge->value
                )
            ],
            $queryArray
        );
    }

    public function test_query_only_adds_filter_options_when_set_using_only_for_status(): void
    {
        $query = 'FOO';
        $status = Status::STATUS_PUBLISHED;
        $searchParams = (new SearchParameters($this->searchService, $query))->onlyForStatus($status);

        $queryArray = $searchParams->toArray();
        $this->assertContains('query', array_keys($queryArray));
        $this->assertContains('filters', array_keys($queryArray));
        $this->assertEmpty(
            array_filter($queryArray, fn ($value, $key) => $key != 'query' && $key != 'filters', ARRAY_FILTER_USE_BOTH)
        );
        $this->assertArraySubsetMatch(['query' => $query], $queryArray);
        $this->assertArraySubsetMatch(['filters' => sprintf('%s:%s', Facet::Status->value, $status->value)], $queryArray);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('algolia.app_id', 'foo');
        Config::set('algolia.api_key', 'bar');
        $this->searchService = new AlgoliaSearchService();
    }
}
