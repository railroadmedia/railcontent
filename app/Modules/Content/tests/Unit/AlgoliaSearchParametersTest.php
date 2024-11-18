<?php

namespace App\Modules\Content\tests\Unit;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Models\Instructor;
use App\Modules\Content\Resources\Algolia\Enum\DocumentType;
use App\Modules\Content\Resources\Algolia\Enum\Facet;
use App\Modules\Content\Resources\Algolia\SearchParameters;
use App\Modules\Content\Services\AlgoliaSearchService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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

    public function test_add_filter_validates_facet_index(): void
    {
        $query = 'FOO';
        $facet = Facet::Album;
        $searchParams = (new SearchParameters($this->searchService, $query));

        Log::shouldReceive('error')->once()->withArgs(function ($message) use ($facet) {
            return Str::contains(
                $message,
                sprintf(
                    'Facet %s is not available',
                    $facet->value
                )
            );
        });
        $searchParams->addFilter($facet, 'BAR');

        $queryArray = $searchParams->toArray();

        // the Album facet is not available on the All Index (the default index on the service)
        $this->assertFalse($facet->isInIndex($this->searchService->index));
        $this->assertEquals(['query' => $query], $queryArray);
        $this->assertNotContains('filters', array_keys($queryArray));
    }

    public function test_add_filter_requires_comparator_for_numeric_and_datetime_facets(): void
    {
        $query = 'FOO';
        // the Popularity facet is a numeric type
        $popularity = Facet::Popularity;
        $this->assertEquals(Facet::TYPE_NUMERIC, $popularity->getAttributeType());
        $searchParams = (new SearchParameters($this->searchService, $query));

        Log::shouldReceive('error')->once()->withArgs(function ($message) use ($popularity) {
            return Str::contains($message, 'Missing required comparator');
        });
        $searchParams->addFilter($popularity, 99);

        $queryArray = $searchParams->toArray();

        $this->assertEquals(['query' => $query], $queryArray);
        $this->assertNotContains('filters', array_keys($queryArray));

        // the PublishedOn facet is a datetime type
        $publishedOn = Facet::PublishedOn;
        $this->assertEquals(Facet::TYPE_DATE_TIMESTAMP, $publishedOn->getAttributeType());
        Log::shouldReceive('error')->once()->withArgs(function ($message) use ($publishedOn) {
            return Str::contains($message, 'Missing required comparator');
        });
        $searchParams->addFilter($publishedOn, Carbon::now());

        $queryArray = $searchParams->toArray();

        $this->assertEquals(['query' => $query], $queryArray);
        $this->assertNotContains('filters', array_keys($queryArray));
    }

    public function test_add_filter_with_comparator_builds_filter_with_it(): void
    {
        $query = 'FOO';
        $popularity = Facet::Popularity;
        $searchParams = (new SearchParameters($this->searchService, $query));
        $value = 99;
        $comparator = '>';
        $searchParams->addFilter($popularity, $value, $comparator);

        $filters = $searchParams->toArray()['filters'];
        $this->assertEquals(sprintf('%s %s %s', $popularity->value, $comparator, $value), $filters);
    }

    public function test_adding_filters_appends_to_filter_query(): void
    {
        $query = 'FOO';
        $searchParams = new SearchParameters($this->searchService, $query);

        $brand = Brand::Drumeo;
        $searchParams->onlyForBrand($brand);

        $type = DocumentType::Song;
        $searchParams->onlyForType($type);

        $status = Status::STATUS_PUBLISHED;
        $searchParams->onlyForStatus($status);

        // the instructor factory creates a Content model, so this works around that
        Instructor::factory()->create();
        $instructor = Instructor::first();
        $searchParams->onlyForInstructor($instructor);

        $filters = $searchParams->toArray()['filters'];
        $filterPieces = explode(' AND ', $filters);
        $this->assertContains(sprintf('%s:%s', Facet::Brand->value, $brand->value), $filterPieces);
        $this->assertContains(sprintf('%s:%s', Facet::DocumentType->value, $type->value), $filterPieces);
        $this->assertContains(sprintf('%s:%s', Facet::Status->value, $status->value), $filterPieces);
        $this->assertContains(sprintf('%s:%s', Facet::InstructorNames->value, $instructor->name), $filterPieces);
    }

    public function test_adding_filters_with_multiple_values_appends_a_subfilter_to_filter_query(): void
    {
        $query = 'FOO';
        $searchParams = new SearchParameters($this->searchService, $query);

        $brands = [Brand::Drumeo, Brand::Guitareo];
        $searchParams->onlyForBrand(...$brands);

        $types = [DocumentType::Song, DocumentType::Challenge];
        $searchParams->onlyForType(...$types);

        $statuses = [Status::STATUS_DRAFT, Status::STATUS_PUBLISHED, Status::STATUS_DELETED, Status::STATUS_ARCHIVED];
        $searchParams->onlyForStatus(...$statuses);

        // the instructor factory creates a Content model, so this works around that
        Instructor::factory()->create();
        Instructor::factory()->create();
        $instructors = Instructor::all();
        $searchParams->onlyForInstructor(...$instructors);

        $filters = $searchParams->toArray()['filters'];
        $filterPieces = explode(' AND ', $filters);
        $this->assertContains(
            sprintf('(%s:%s OR %s:%s)', Facet::Brand->value, $brands[0]->value, Facet::Brand->value, $brands[1]->value),
            $filterPieces
        );
        $this->assertContains(
            sprintf(
                '(%s:%s OR %s:%s)',
                Facet::DocumentType->value,
                $types[0]->value,
                Facet::DocumentType->value,
                $types[1]->value
            ),
            $filterPieces
        );
        $this->assertContains(
            sprintf(
                '(%s:%s OR %s:%s OR %s:%s OR %s:%s)',
                Facet::Status->value,
                $statuses[0]->value,
                Facet::Status->value,
                $statuses[1]->value,
                Facet::Status->value,
                $statuses[2]->value,
                Facet::Status->value,
                $statuses[3]->value
            ),
            $filterPieces
        );
        $this->assertContains(
            sprintf(
                '(%s:%s OR %s:%s)',
                Facet::InstructorNames->value,
                $instructors[0]->name,
                Facet::InstructorNames->value,
                $instructors[1]->name
            ),
            $filterPieces
        );
    }

    public function test_adding_filters_with_NOT_option_adds_not_clause_to_filter_query(): void
    {
        $query = 'FOO';
        $facet = Facet::Status;
        $facetValue = Status::STATUS_DELETED->value;
        $searchParams = (new SearchParameters($this->searchService, $query));
        $searchParams->addFilter($facet, $facetValue, applyNot: true);

        $filters = $searchParams->toArray()['filters'];
        $this->assertEquals(sprintf('NOT %s:%s', $facet->value, $facetValue), $filters);
    }

    public function test_add_raw_filter_appends_anything_to_the_filter_query(): void
    {
        $query = 'FOO';
        $brand = Brand::Drumeo;
        $searchParams = (new SearchParameters($this->searchService, $query));
        $searchParams->onlyForBrand($brand);
        $rawFilter = "some bad string";
        $searchParams->addRawFilter($rawFilter);

        $filters = $searchParams->toArray()['filters'];
        $filterPieces = explode(' AND ', $filters);
        $this->assertContains(sprintf('%s:%s', Facet::Brand->value, $brand->value), $filterPieces);
        $this->assertContains($rawFilter, $filterPieces);
    }

    public function test_set_raw_filter_overwrites_previous_filter_in_the_filter_query(): void
    {
        $query = 'FOO';
        $brand = Brand::Drumeo;
        $searchParams = (new SearchParameters($this->searchService, $query));
        $searchParams->onlyForBrand($brand);
        $rawFilter = "some bad string";
        $searchParams->setRawFilters([$rawFilter]);

        $filters = $searchParams->toArray()['filters'];
        $this->assertEquals($rawFilter, $filters);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('algolia.app_id', 'foo');
        Config::set('algolia.api_key', 'bar');
        $this->searchService = new AlgoliaSearchService();
    }
}
