<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentVersionJsonControllerTest extends RailcontentTestCase
{
    public function test_version_old_content_on_update()
    {
        Event::fake();

        $content = [
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $content = $this->contentFactory->create();

        $new_slug = $this->faker->word;
        $contentId = $content['id'];
        $response = $this->call('PUT', 'railcontent/content/'.$contentId, [
            'slug' => $new_slug,
            'status' =>$content['status'],
            'position' => $content['position'],
            'type' => $content['type']
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function test_version_old_content_before_delete_content()
    {
        Event::fake();

        $content = $this->contentFactory->create();
        $contentId = $content['id'];

        $response = $this->call('DELETE', 'railcontent/content/'.$contentId);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

}
