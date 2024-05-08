<?php

namespace App\Modules\Content\tests\Feature\Services;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\Instructor;
use App\Modules\Content\Services\SearchService;
use Tests\TestCase;

class SearchServiceTest extends TestCase
{
    private SearchService $searchService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->searchService = app(SearchService::class);
    }

    public function test_rebuildSearchIndexes()
    {
        /** @var Instructor $instructor */
        $instructor = Instructor::factory()->create();
        /** @var Content $content */
        $content = Content::factory()->hasInstructor($instructor)->create();
        $slug = str_replace('-', '', $content->slug);

        $this->assertDatabaseMissing('railcontent_search_indexes', [
            'content_id' => $content->id,
            'high_value' => $this->format($slug, $content->title, $instructor->name) . ' ',
            'medium_value' => $this->format($content->type, $content->title),
            'low_value' => $this->format($content->title),
        ]);

        $this->searchService->rebuildIndexes();

        $this->assertDatabaseHas('railcontent_search_indexes', [
            'content_id' => $content->id,
            'high_value' => $this->format($slug, $content->title, $instructor->name) . ' ',
            'medium_value' => $this->format($content->type, $content->title),
            'low_value' => $this->format($content->title),
        ]);
    }

    /**
     * Format the string value(s), in the manner done by the SearchService
     *
     * @param  string  ...$values
     * @return string
     */
    private function format(string ...$values): string
    {
        return substr(preg_replace("/[^A-Za-z0-9_ ]/", '', implode(' ', array_unique($values))), 0, 245);
    }
}
