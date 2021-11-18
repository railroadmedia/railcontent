<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Illuminate\Support\Facades\Event;

class ContentVersionEventsTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDatumFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);
    }

    public function test_version_content_on_content_creation()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $this->call('PUT', 'railcontent/content', [
            'slug' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'status' => ContentService::STATUS_PUBLISHED,
            'parent_id' => null,
            'type' => $this->faker->word
        ]);

        //check that the ContentCreated event was dispatched with the correct content id
        Event::assertDispatched(ContentCreated::class, function($event) use ($content) {
            return $event->contentId == $content['id'];
        });
    }

    public function test_version_content_on_content_update()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $this->call('PATCH', 'railcontent/content/'.$content['id'], [
            'slug' => $this->faker->word
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($content) {
            return $event->contentId == $content['id'];
        });
    }

    public function test_version_content_on_link_content_datum()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $this->call('PUT', 'railcontent/content/datum',
            [
                'content_id' => $content['id'],
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $this->faker->numberBetween()
            ]);

        //check that the ContentDatumCreated event was dispatched with the correct content id
        Event::assertDispatched(ContentDatumCreated::class, function($event) use ($content) {
            return $event->contentId == $content['id'];
        });
    }

    public function test_version_content_on_update_content_datum()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $datum = $this->contentDatumFactory->create($content['id']);

        $this->call('PATCH', 'railcontent/content/datum/'.$datum['id'],
            [
                'content_id' => $content['id'],
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $this->faker->numberBetween()
            ]);

        //check that the ContentDatumUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentDatumUpdated::class, function($event) use ($content) {
            return $event->contentId == $content['id'];
        });
    }

    public function _test_version_content_on_delete_content_datum()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $datum = $this->contentDatumFactory->create($content['id']);

        $this->call('DELETE', 'railcontent/content/datum/'.$datum['id']);

        //check that the ContentDatumDeleted event was dispatched with the correct content id
        Event::assertDispatched(ContentDatumDeleted::class, function($event) use ($content) {
            return $event->contentId == $content['id'];
        });
    }

    public function test_version_content_on_link_content_field()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $this->call('PUT', 'railcontent/content/field',
            [
                'content_id' => $content['id'],
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $this->faker->numberBetween(),
                'type' => $this->faker->word
            ]);

        //check that the ContentFieldCreated event was dispatched with the correct content id
        Event::assertDispatched(ContentFieldCreated::class, function($event) use ($content) {
            return $event->newField['content_id'] == $content['id'];
        });
    }

    public function test_version_content_on_update_content_field()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $this->call('PATCH', 'railcontent/content/field/'.$field['id'],
            [
                'content_id' => $content['id'],
                'value' => $this->faker->word
            ]);

        //check that the ContentFieldUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentFieldUpdated::class, function($event) use ($content) {
            return $event->newField['content_id'] == $content['id'];
        });
    }

    public function test_version_content_on_delete_content_field()
    {
        Event::fake();

        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $this->call('DELETE', 'railcontent/content/field/'.$field['id']);

        //check that the ContentFieldDeleted event was dispatched with the correct content id
        Event::assertDispatched(ContentFieldDeleted::class, function($event) use ($content) {
            return $event->deletedField['content_id'] == $content['id'];
        });
    }

}
