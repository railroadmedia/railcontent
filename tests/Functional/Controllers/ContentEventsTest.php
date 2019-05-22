<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentEventsTest extends RailcontentTestCase
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

    public function test_event_on_content_creation()
    {
        Event::fake();

        $res = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'attributes' => [
                        'slug' => $this->faker->word,
                        'position' => $this->faker->numberBetween(),
                        'status' => ContentService::STATUS_PUBLISHED,
                        'type' => $this->faker->word,
                    ],
                ],
            ]
        );
        $content = $res->decodeResponseJson('data');

        $contentEntity =
            $this->entityManager->getRepository(Content::class)
                ->find(1);

        //check that the ContentCreated event was dispatched with the correct content id
        Event::assertDispatched(
            ContentCreated::class,
            function ($event) use ($contentEntity) {
                return $event->content == $contentEntity;
            }
        );
    }

    public function test_event_on_content_update()
    {
        Event::fake();

        $content = $this->fakeContent();

        $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
                    'attributes' => [
                        'slug' => $this->faker->word,
                    ],
                ],
            ]
        );

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(
            ContentUpdated::class,
            function ($event) use ($content) {
                return $event->content == $content[0];
            }
        );
    }

    public function test_event_on_link_content_datum()
    {
        Event::fake();
        $content = $this->fakeContent();

        $res = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'data' => [
                    'attributes' => [
                        'key' => $this->faker->word,
                        'value' => $this->faker->word,
                        'position' => $this->faker->numberBetween(),
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        //check that the ContentDatumCreated event was dispatched with the correct content id
        Event::assertDispatched(
            ContentDatumCreated::class,
            function ($event) use ($content) {
                return $event->content == $content[0];
            }
        );
    }

    public function test_event_on_update_content_datum()
    {
        Event::fake();

        $content = $this->fakeContent();

        $datum = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
            ]
        );

        $this->call(
            'PATCH',
            'railcontent/content/datum/' . $datum[0]->getId(),
            [
                'data' => [
                    'attributes' => [
                        'key' => $this->faker->word,
                        'value' => $this->faker->word,
                        'position' => $this->faker->numberBetween(),
                    ],
                ],
            ]
        );

        //check that the ContentDatumUpdated event was dispatched with the correct content id
        Event::assertDispatched(
            ContentDatumUpdated::class,
            function ($event) use ($content) {
                return $event->content == $content[0];
            }
        );
    }

    public function test_event_on_delete_content_datum()
    {
        Event::fake();

        $content = $this->fakeContent();

        $datum = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
            ]
        );

        $this->call('DELETE', 'railcontent/content/datum/' . $datum[0]->getId());

        //check that the ContentDatumDeleted event was dispatched with the correct content id
        Event::assertDispatched(
            ContentDatumDeleted::class,
            function ($event) use ($content) {
                return $event->content == $content[0];
            }
        );
    }
}
