<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\Models\Content;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;
use Tests\TestCase;

class WebUrlPathTest extends TestCase
{
    private RailcontentV2DataSyncingService $rcService;

    public function setUp(): void
    {
        parent::setUp();
        $this->rcService = app()->make(RailcontentV2DataSyncingService::class);

    }

    public function test_first_tier_web_url_resolves()
    {
        $brand = 'pianote';
        $parentContent = Content::factory()->create([
            "type" => 'student-review',
            "brand" => $brand,
        ]);
        $childContent = Content::factory()->create([
            "type" => 'student-review',
            "brand" => $brand,
        ]);
        $garbageGUID = '046eed4f-37e1-4351-b17d-8854cf4375d4';
        $childContent->web_url_path = $garbageGUID;
        $childContent->setParentId($parentContent->id);
        $this->rcService->syncContentId($childContent->id); // set the parent_content_data column compiled from the content_hierachy table
        $this->rcService->syncContentId($childContent->id); // set the url using the parent_content_data column
        $childContent->refresh();

        $this->assertStringNotContainsStringIgnoringCase($parentContent->slug, $childContent->web_url_path);
        $this->assertStringNotContainsStringIgnoringCase($garbageGUID, $childContent->web_url_path);
        $this->assertStringContainsStringIgnoringCase($childContent->slug, $childContent->web_url_path);
    }
}
