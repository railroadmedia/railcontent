<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class ContentDatumControllerTest extends RailcontentTestCase
{
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentDatumService::class);
    }

    public function test_add_content_datum_controller_method_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );
        $key = $this->faker->word;
        $value = $this->faker->text(500);

        $response1 = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'data' => [
                    'attributes' => [
                        'key' => $key,
                        'value' => $value,
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

        $this->assertEquals(200, $response1->status());

        $response1->assertJson(
            [
                'data' => [
                    'type' => 'contentData',
                    'id' => 1,
                    'attributes' => [
                        'key' => $key,
                        'value' => $value,
                        'position' => 0,
                    ],

                ],
            ]
        );

        $newValue = $this->faker->word;

        $response2 = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'data' => [
                    'attributes' => [
                        'key' => $key,
                        'value' => $newValue,
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

        $response2->assertJson(
            [
                'data' => [
                    'type' => 'contentData',
                    'id' => 2,
                    'attributes' => [
                        'key' => $key,
                        'value' => $newValue,
                        'position' => 1,
                    ],

                ],
            ]
        );

        $otherKey = $this->faker->word;

        $response3 = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'data' => [
                    'attributes' => [
                        'key' => $otherKey,
                        'value' => $newValue,
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

        $response3->assertJson(
            [
                'data' => [
                    'type' => 'contentData',
                    'id' => 3,
                    'attributes' => [
                        'key' => $otherKey,
                        'value' => $newValue,
                        'position' => 0,
                    ],

                ],
            ]
        );
    }

    public function test_add_content_datum_not_pass_the_validation()
    {
        $response = $this->call('PUT', 'railcontent/content/datum');

        $this->assertEquals(422, $response->status());
        $this->assertEquals(
            [
                [
                    'title' => 'Validation failed.',
                    "source" => "data.attributes.key",
                    "detail" => "The key field is required.",
                ],
                [
                    'title' => 'Validation failed.',
                    "source" => "data.relationships.content.data.id",
                    "detail" => "The content field is required.",
                ],
            ],
            $response->decodeResponseJson('errors')
        );
    }

    public function test_add_content_datum_key_not_pass_the_validation()
    {
        $key = $this->faker->text(600);
        $value = $this->faker->text(500);

        $response = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'data' => [
                    'attributes' => [
                        'key' => $key,
                        'value' => $value,
                        'position' => 1,
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => rand(100, 1000),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->status());
        $this->assertEquals(
            [
                [
                    "source" => "data.attributes.key",
                    "detail" => "The key may not be greater than 255 characters.",
                    'title' => 'Validation failed.',
                ],
                [
                    "source" => "data.relationships.content.data.id",
                    "detail" => "The selected content is invalid.",
                    'title' => 'Validation failed.',
                ],
            ],
            $response->decodeResponseJson('errors')
        );
    }

    public function test_update_content_datum_controller_method_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => 1,
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $new_value = $this->faker->text();

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum/' . $data->getId(),
            [
                'content_id' => $content[0]->getId(),
                'value' => $new_value,
            ]
        );

        $this->assertEquals(201, $response->status());

        $response->assertJson(
            [
                'data' => [
                    'type' => 'contentData',
                    'id' => 1,
                    'attributes' => [
                        'key' => $data->getKey(),
                        'value' => $new_value,
                        'position' => 1,
                    ],
                ],
            ]
        );
    }

    public function test_update_content_datum_not_pass_validation()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum/' . $data->getId(),
            [
                'data' => [
                    'attributes' => [
                        'key' => $this->faker->text(500),
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->status());
        $this->assertEquals(
            [
                [
                    "source" => "data.attributes.key",
                    "detail" => "The key may not be greater than 255 characters.",
                    'title' => 'Validation failed.',
                ],
            ],
            $response->decodeResponseJson('errors')
        );
    }

    public function test_delete_content_datum_controller()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];
        $contentDataId = $data->getId();

        $response = $this->call('DELETE', 'railcontent/content/datum/' . $contentDataId);

        $this->assertNull(json_decode($response->content()));
        $this->assertEquals(204, $response->status());
        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'id' => $contentDataId,
            ]
        );
    }

    public function test_update_content_datum_method_from_service_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $newData = [
            'key' => $data->getKey(),
            'value' => $this->faker->text(500),
            'position' => 1,
        ];

        $updatedData = $this->serviceBeingTested->update($data->getId(), $newData);

        $this->assertEquals(
            $newData['value'],
            $updatedData->getValue()
        );

        $this->assertEquals(
            $newData['key'],
            $updatedData->getKey()
        );

        $this->assertEquals(
            $newData['position'],
            $updatedData->getPosition()
        );
    }

    public function test_get_content_datum_method_from_service_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $results = $this->serviceBeingTested->get($data->getId());

        $this->assertEquals($data, $results);
    }

    public function test_delete_content_datum_method_from_service_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->populator->addEntity(
            ContentData::class,
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text(),
                'position' => $this->faker->numberBetween(),
            ]
        );
        $fakeData = $this->populator->execute();
        $data = $fakeData[ContentData::class][0];

        $results = $this->serviceBeingTested->delete($data->getId());

        $this->assertEquals(1, $results);
    }

    public function content_updated_event_dispatched_when_link_content_datum()
    {
        // Event::fake();

        $content = $this->contentFactory->create(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $key = $this->faker->word;
        $value = $this->faker->text(500);

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum',
            [
                'content_id' => $content['id'],
                'key' => $key,
                'value' => $value,
                'position' => 1,
            ]
        );

        $this->expectsEvents(\Railroad\Railcontent\Events\ContentUpdated::class);
        //check that the ContentUpdated event was dispatched with the correct content id
        /* Event::assertDispatched(ContentUpdated::class, function ($event) use ($content) {
             return $event->contentId == $content['id'];
         }); */
    }

    public function content_updated_event_dispatched_when_unlink_content_datum()
    {
        Event::fake();

        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
        ];
        $dataId =
            $this->query()
                ->table(ConfigService::$tableData)
                ->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId,
        ];
        $contentDataId =
            $this->query()
                ->table(ConfigService::$tableContentData)
                ->insertGetId($contentData);

        $response = $this->call(
            'DELETE',
            'railcontent/content/datum/' . $dataId,
            [
                'content_id' => $contentId,
            ]
        );

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(
            ContentUpdated::class,
            function ($event) use ($contentId) {
                return $event->contentId == $contentId;
            }
        );
    }
}
