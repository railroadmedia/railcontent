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
    }

    public function test_version_content_on_content_creation()
    {
        Event::fake();

        $content = $this->fakeContent();

        $this->call('PUT', 'railcontent/content', ['data' => ['attributes' => [
            'slug' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'status' => ContentService::STATUS_PUBLISHED,
            'parent_id' => null,
            'type' => $this->faker->word
        ]]]);

        //check that the ContentCreated event was dispatched with the correct content id
        Event::assertDispatched(ContentCreated::class, function($event) use ($content) {
            return $event->contentId == $content[0]->getId();
        });
    }

    public function test_version_content_on_content_update()
    {
        Event::fake();

        $content = $this->fakeContent();

        $this->call('PATCH', 'railcontent/content/'.$content[0]->getId(), ['data' => ['attributes' => [
            'slug' => $this->faker->word
        ]]]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($content) {
            return $event->contentId == $content[0]->getId();
        });
    }

    public function test_version_content_on_link_content_datum()
    {
        Event::fake();

        $content = $this->fakeContent();

        $this->call('PUT', 'railcontent/content/datum',
            ['data' => ['attributes' => [
                'content_id' => $content[0]->getId(),
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $this->faker->numberBetween()
           ]] ]);

        //check that the ContentDatumCreated event was dispatched with the correct content id
        Event::assertDispatched(ContentDatumCreated::class, function($event) use ($content) {
            return $event->contentId == $content[0]->getId();
        });
    }

    public function test_version_content_on_update_content_datum()
    {
        Event::fake();

        $content = $this->fakeContent();

        $datum = $this->fakeContentData(1,[
            'content' => $content[0]
        ]);

        $this->call('PATCH', 'railcontent/content/datum/'.$datum[0]->getId(),
            ['data' => ['attributes' => [
                'key' => $this->faker->word,
                'value' => $this->faker->word,
                'position' => $this->faker->numberBetween()
            ]]]);

        //check that the ContentDatumUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentDatumUpdated::class, function($event) use ($content) {
            return $event->contentId == $content[0]->getId();
        });
    }

    public function test_version_content_on_delete_content_datum()
    {
        Event::fake();

        $content = $this->fakeContent();

        $datum = $this->fakeContentData(1,[
            'content' => $content[0]
        ]);

        $this->call('DELETE', 'railcontent/content/datum/'.$datum[0]->getId());

        //check that the ContentDatumDeleted event was dispatched with the correct content id
        Event::assertDispatched(ContentDatumDeleted::class, function($event) use ($content) {
            return $event->contentId == $content[0]->getId();
        });
    }
}
