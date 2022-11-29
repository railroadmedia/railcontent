<?php

namespace App\Modules\Content\tests\Feature\Services;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\Instructor;
use App\Modules\Content\Services\SearchService;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Modules\UserManagementSystem\Models\User;
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
        $this->searchService->rebuildIndexes();

        $slug = str_replace('-', '', $content->slug);
        $this->assertDatabaseHas('railcontent_search_indexes', [
            'content_id' => $content->id,
            'high_value' => "$slug $content->title $instructor->name",
            'medium_value' => "$content->title",
            'low_value' => "$content->title",
        ]);
    }
}
