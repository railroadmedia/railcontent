<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class ContentDatumControllerTest extends RailcontentTestCase
{
    protected $classBeingTested;
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDatumFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentDatumService::class);
        $this->classBeingTested = $this->app->make(ContentDatumRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
    }

    public function test_add_content_datum_controller_method_response()
    {
        $content = $this->contentFactory->create();

        $key = $this->faker->word;
        $value = $this->faker->text(500);

        $response = $this->call(
            'PUT',
            'railcontent/content/datum',
            [
                'content_id' => $content['id'],
                'key' => $key,
                'value' => $value,
                'position' => 1,
            ]
        );

        $this->assertEquals(200, $response->status());

        $response->assertJson(
            [
                'data' => [
                    0 => [
                        'id' => '1',
                        'content_id' => $content['id'],
                        'key' => $key,
                        'value' => $value,
                        'position' => 1,
                    ],

                ],
            ]
        );
    }

    public function test_add_content_datum_not_pass_the_validation()
    {
        $response = $this->call('PUT', 'railcontent/content/datum');

        $this->assertEquals(422, $response->status());
        $this->assertEquals([
            [
                "source" => "key",
                "detail" => "The key field is required.",
            ],
            [
                "source" => "content_id",
                "detail" => "The content id field is required.",
            ]
        ], $response->decodeResponseJson('meta')['errors']);
    }

    public function test_add_content_datum_key_not_pass_the_validation()
    {
        $key = $this->faker->text(600);
        $value = $this->faker->text(500);

        $response =
            $this->call('PUT', 'railcontent/content/datum', ['content_id' => 1, 'key' => $key, 'value' => $value]);

        $this->assertEquals(422, $response->status());
        $this->assertEquals([
            [
                "source" => "key",
                "detail" => "The key may not be greater than 255 characters.",
            ],
            [
                "source" => "content_id",
                "detail" => "The selected content id is invalid.",
            ]
        ], $response->decodeResponseJson('meta')['errors']);
    }

    public function test_update_content_datum_controller_method_response()
    {
        $content = $this->contentFactory->create();

        $data = [
            'content_id' => $content['id'],
            'key' => $this->faker->word,
            'value' => $this->faker->text(),
            'position' => $this->faker->numberBetween(),
        ];
        $dataId =
            $this->query()
                ->table(ConfigService::$tableContentData)
                ->insertGetId($data);

        $new_value = $this->faker->text();

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum/' . $dataId,
            [
                'content_id' => $content['id'],
                'key' => $data['key'],
                'value' => $new_value,
                'position' => $data['position'],
            ]
        );

        $this->assertEquals(201, $response->status());

        $response->assertJson(
            [
                'data' => [
                    0 => [
                        'id' => 1,
                        'content_id' => $content['id'],
                        'key' => $data['key'],
                        'value' => $new_value,
                        'position' => 1,
                    ],
                ],
            ]
        );
    }

    public function test_update_content_datum_not_pass_validation()
    {
        $content = $this->contentFactory->create();

        $data = [
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'content_id' => $content['id'],
        ];
        $dataId =
            $this->query()
                ->table(ConfigService::$tableContentData)
                ->insertGetId($data);

        $response = $this->call(
            'PATCH',
            'railcontent/content/datum/' . $dataId,
            [
                'key' => $this->faker->text(500),
            ]
        );

        $this->assertEquals(422, $response->status());
        $this->assertEquals([
            [
                "source" => "key",
                "detail" => "The key may not be greater than 255 characters.",
            ]
        ], $response->decodeResponseJson('meta')['errors']);
    }

    public function test_delete_content_datum_controller()
    {
        $content = $this->contentFactory->create();

        $data = $this->contentDatumFactory->create($content['id']);

        $response = $this->call('DELETE', 'railcontent/content/datum/' . $data['id']);

        $this->assertNull(json_decode($response->content()));
        $this->assertEquals(204, $response->status());
    }

    public function test_update_content_datum_method_from_service_response()
    {
        $content = $this->contentFactory->create();

        $data = $this->contentDatumFactory->create($content['id']);

        $newData = [
            'key' => $data['key'],
            'value' => $this->faker->text(500),
            'position' => 1,
            'content_id' => $content['id'],
        ];
        $updatedData = $this->serviceBeingTested->update($data['id'], $newData);

        $this->assertEquals(
            array_merge(
                [
                    'id' => $data['id'],
                    'content_id' => $content['id'],
                ],
                $newData
            ),
            $updatedData
        );
    }

    public function test_get_content_datum_method_from_service_response()
    {
        $content = $this->contentFactory->create();

        $data = $this->contentDatumFactory->create($content['id']);

        $results = $this->serviceBeingTested->get($data['id']);

        $this->assertEquals($data, $results);
    }

    public function test_delete_content_datum_method_from_service_response()
    {
        $content = $this->contentFactory->create();

        $data = $this->contentDatumFactory->create($content['id']);

        $results = $this->serviceBeingTested->delete($data['id']);

        $this->assertEquals(1, $results);
    }

    public function content_updated_event_dispatched_when_link_content_datum()
    {
        // Event::fake();

        $content = $this->contentFactory->create();

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
