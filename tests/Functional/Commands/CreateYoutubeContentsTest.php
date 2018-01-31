<?php

use Illuminate\Support\Facades\Artisan;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CreateYoutubeContentsTest extends RailcontentTestCase
{
protected $contentService;
    protected function setUp()
    {
        parent::setUp();

        $this->contentService = $this->app->make(ContentService::class);
    }

    public function test_youtube_command()
    {
        Artisan::call('command:CreateYoutubeVideoContentRecords');
        $contents = $this->contentService->getFiltered(1, 1, '-published_on', [], [], [], [], [], [], []);

        $this->assertEquals($contents['total_results'], 252);
        $this->assertEquals(count($contents['results'][1]['fields']), 2);
    }
}
