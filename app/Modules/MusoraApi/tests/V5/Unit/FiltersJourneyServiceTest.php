<?php

namespace App\Modules\MusoraApi\tests\V5\Unit;

use App\Modules\MusoraApi\Services\V5\FiltersJourneyService;
use Tests\TestCase;

class FiltersJourneyServiceTest extends TestCase
{
    public function test_parse_filters_no_progress_set()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $filters = $filtersJourneyService->parseFilters([
            'filters' => ['style,Pop', 'difficulty,Introductory'],
        ]);

        $this->assertEquals([
            [
                'filter_category' => 'style',
                'filter_tag' => 'Pop',
            ],
            [
                'filter_category' => 'difficulty',
                'filter_tag' => 'Introductory',
            ],
            [
                'filter_category' => 'progress',
                'filter_tag' => 'all',
            ],
        ], $filters);
    }

    public function test_parse_filters_progress_set()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $filters = $filtersJourneyService->parseFilters([
            'filters' => ['style,Pop', 'difficulty,Introductory'],
            'progress' => 'notStarted',
        ]);

        $this->assertEquals([
            [
                'filter_category' => 'style',
                'filter_tag' => 'Pop',
            ],
            [
                'filter_category' => 'difficulty',
                'filter_tag' => 'Introductory',
            ],
            [
                'filter_category' => 'progress',
                'filter_tag' => 'notStarted',
            ],
        ], $filters);
    }

    public function test_parse_filters_no_filters_no_progress()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $filters = $filtersJourneyService->parseFilters([]);

        $this->assertEquals([
            [
                'filter_category' => 'progress',
                'filter_tag' => 'all',
            ],
        ], $filters);
    }

    public function test_parse_no_filters_progress_set()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $filters = $filtersJourneyService->parseFilters([
            'progress' => 'notStarted',
        ]);

        $this->assertEquals([
            [
                'filter_category' => 'progress',
                'filter_tag' => 'notStarted'
            ],
        ], $filters);
    }

    public function test_parse_filters_wrong_format()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $filters = $filtersJourneyService->parseFilters([
            'filters' => ['style => Pop'],
        ]);

        $this->assertEquals([
            [
                'filter_category' => 'progress',
                'filter_tag' => 'all',
            ],
        ], $filters);
    }

    public function test_parse_filters_no_props_set()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $filters = $filtersJourneyService->parseFilters(null);

        $this->assertEquals([
            [
                'filter_category' => 'progress',
                'filter_tag' => 'all',
            ],
        ], $filters);
    }

    public function test_parse_sort_popularity()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('popularity');

        $this->assertEquals('Least Popular', $sort);
    }

    public function test_parse_sort_negative_popularity()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('-popularity');

        $this->assertEquals('Most Popular', $sort);
    }

    public function test_parse_sort_slug()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('slug');

        $this->assertEquals('Name: A to Z', $sort);
    }

    public function test_parse_sort_negative_slug()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('-slug');

        $this->assertEquals('Name: Z to A', $sort);
    }

    public function test_parse_sort_published_on()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('published_on');

        $this->assertEquals('Oldest First', $sort);
    }

    public function test_parse_sort_created_at()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('created_at');

        $this->assertEquals('Oldest First', $sort);
    }

    public function test_parse_sort_negative_published_on()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('-published_on');

        $this->assertEquals('Newest First', $sort);
    }

    public function test_parse_sort_negative_created_at()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('-created_at');

        $this->assertEquals('Newest First', $sort);
    }

    public function test_parse_sort_negative_progress()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('-progress');

        $this->assertEquals('Progress', $sort);
    }

    public function test_parse_sort_negative_last_progress()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('-last_progress');

        $this->assertEquals('Recently Viewed', $sort);
    }

    public function test_parse_sort_most_recent()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('most_recent');

        $this->assertEquals('Most Recent', $sort);
    }

    public function test_parse_sort_pinned()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('pinned');

        $this->assertEquals('Pinned', $sort);
    }

    public function test_parse_sort_invalid()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort('invalid');

        $this->assertEquals('Unknown', $sort);
    }

    public function test_parse_sort_null()
    {
        $filtersJourneyService = new FiltersJourneyService();
        $sort = $filtersJourneyService->parseSort(null);

        $this->assertEquals('Unknown', $sort);
    }
}
