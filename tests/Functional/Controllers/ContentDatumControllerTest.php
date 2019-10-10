<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentDatumControllerTest extends RailcontentTestCase
{
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentDatumService::class);
        ResponseService::$oldResponseStructure = false;
    }

    public function test_add_content_datum_controller_method_response()
    {
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
                'difficulty' => 1,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content['0'],
                'topic' => $this->faker->word,
            ]
        );

        $key = 'description';
        $value = $this->faker->text(20);

        $response1 = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'data' => [
                    'type' => 'contentData',
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
                    'type' => 'contentData',
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
                    'type' => 'contentData',
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
                    "source" => "data.type",
                    "detail" => "The json data type field is required.",
                ],
                [
                    'title' => 'Validation failed.',
                    "source" => "data.attributes.key",
                    "detail" => "The key field is required.",
                ],
                [
                    'title' => 'Validation failed.',
                    "source" => "data.relationships.content.data.type",
                    "detail" => "The content type field is required.",
                ],
                [
                    'title' => 'Validation failed.',
                    "source" => "data.relationships.content.data.id",
                    "detail" => "The content id field is required.",
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
                    'type' => 'contentData',
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
                    "detail" => "The selected content id is invalid.",
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
                'type' => $this->faker->word,
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
                'data' => [
                    'type' => 'contentData',
                    'attributes' => [
                        'value' => $new_value,
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
                    'type' => 'contentData',
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
            config('railcontent.table_prefix') . 'content_data',
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
            'data' => [
                'attributes' => [
                    'key' => $data->getKey(),
                    'value' => $this->faker->text(500),
                    'position' => 1,
                ],
            ],
        ];

        $updatedData = $this->serviceBeingTested->update($data->getId(), $newData);

        $this->assertEquals(
            $newData['data']['attributes']['value'],
            $updatedData->getValue()
        );

        $this->assertEquals(
            $newData['data']['attributes']['key'],
            $updatedData->getKey()
        );

        $this->assertEquals(
            $newData['data']['attributes']['position'],
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

        $this->expectsEvents(ContentUpdated::class);
        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function ($event) use ($content) {
             return $event->content == $content;
         });
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
                ->table(config('railcontent.table_prefix') . 'content_data')
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
                return $event->content == $contentId;
            }
        );
    }
}
