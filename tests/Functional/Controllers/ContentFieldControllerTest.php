<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentFieldControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentFieldService
     */
    protected $contentFieldService;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFieldService = $this->app->make(ContentFieldService::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);
    }

    public function test_create_content_field_controller_method_response()
    {
        $content = $this->contentFactory->create();
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $response = $this->call(
            'PUT',
            'railcontent/content/field',
            [
                'content_id' => $content['id'],
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position,
            ]
        );

        $expectedResults = [
            "id" => "1",
            "content_id" => $content['id'],
            "key" => $key,
            "value" => $value,
            "type" => $type,
            "position" => 1,
        ];

        $this->assertEquals(200, $response->status());
        $this->assertEquals($expectedResults, $response->decodeResponseJson('data')[0]);

    }

    public function test_add_content_field_not_pass_the_validation()
    {
        $content = $this->contentFactory->create();
        $response = $this->call(
            'PUT',
            'railcontent/content/field',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(422, $response->status());
        $this->assertEquals(4, count($response->decodeResponseJson('meta')['errors']));
    }

    public function test_add_content_field_incorrect_fields()
    {
        $key = $this->faker->text(500);
        $value = $this->faker->text(500);
        $type = $this->faker->text(500);
        $position = $this->faker->word;

        $response = $this->call(
            'PUT',
            'railcontent/content/field',
            [
                'content_id' => 1,
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position,
            ]
        );

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $response->decodeResponseJson('meta'));

        $expectedErrors = [
            [
                "source" => "key",
                "detail" => "The key may not be greater than 255 characters.",
            ],
            [
                "source" => "value",
                "detail" => "The value may not be greater than 255 characters.",
            ],
            [
                "source" => "position",
                "detail" => "The position must be a number.",
            ],
            [
                "source" => "type",
                "detail" => "The type may not be greater than 255 characters.",
            ],
            [
                "source" => "content_id",
                "detail" => "The selected content id is invalid.",
            ],
        ];
        $this->assertEquals($expectedErrors, $response->decodeResponseJson('meta')['errors']);
    }

    public function test_update_content_field_controller_method_response()
    {
        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $new_value = $this->faker->text(255);

        $response = $this->call(
            'PATCH',
            'railcontent/content/field/' . $field['id'],
            [
                'content_id' => $content['id'],
                'key' => $field['key'],
                'value' => $new_value,
                'position' => $field['position'],
                'type' => $field['type'],
            ]
        );

        $this->assertEquals(201, $response->status());

        $expectedResults = [
            "id" => "1",
            "content_id" => $content['id'],
            "key" => $field['key'],
            "value" => $new_value,
            "type" => $field['type'],
            "position" => $field['position'],
        ];

        $this->assertEquals($expectedResults, $response->decodeResponseJson('data')[0]);
    }

    public function test_update_content_field_not_pass_validation()
    {
        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $response = $this->call(
            'PATCH',
            'railcontent/content/field/' . $field['id'],
            [
                'id' => $field['id'],
                'content_id' => $this->faker->numberBetween(),
            ]
        );
        $decodedResponse = $response->decodeResponseJson('meta');

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);

        $expectedErrors = [
            [
                "source" => "content_id",
                "detail" => "The selected content id is invalid.",
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_delete_content_field_controller()
    {
        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $response = $this->call('DELETE', 'railcontent/content/field/' . $field['id']);

        $this->assertEquals(null, json_decode($response->getContent()));
        $this->assertEquals(204, $response->status());
    }

    public function test_delete_content_field_not_exist()
    {
        $fieldId = $this->faker->numberBetween();
        $contentId = $this->faker->numberBetween();
        $response = $this->call('DELETE', 'railcontent/content/field/' . $fieldId);

        $this->assertEquals(
            'Delete failed, field not found with id: ' . $fieldId,
            $response->decodeResponseJson('meta')['errors']['detail']
        );

        $this->assertEquals(404, $response->status());
    }

    public function test_update_content_field_method_from_service_response()
    {
        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create();

        $updatedField = [
            'content_id' => $content['id'],
            'key' => $field['key'],
            'value' => $this->faker->word,
            'id' => $field['id'],
            'type' => $field['type'],
            'position' => $field['position'],
        ];

        $results = $this->contentFieldService->update($field['id'], $updatedField);

        $this->assertEquals($updatedField, $results->getArrayCopy());
    }

    public function test_delete_content_field_method_from_service_response()
    {
        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $results = $this->contentFieldService->delete($field['id']);

        $this->assertTrue($results);
    }

    public function content_updated_event_dispatched_when_link_content_field()
    {
        Event::fake();

        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $contentId = $this->createContent();

        $response = $this->call(
            'POST',
            'railcontent/content/field',
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position,
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

    public function content_updated_event_dispatched_when_unlink_content_field()
    {
        Event::fake();

        $contentId = $this->createContent();

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
        ];

        $fieldId =
            $this->query()
                ->table(ConfigService::$tableFields)
                ->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId,
        ];

        $contentFieldId =
            $this->query()
                ->table(ConfigService::$tableContentFields)
                ->insertGetId($contentField);

        $response = $this->call('DELETE', 'railcontent/content/field/' . $fieldId);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(
            ContentUpdated::class,
            function ($event) use ($contentId) {
                return $event->contentId == $contentId;
            }
        );
    }

    public function test_update_content_field()
    {
        $content = $this->contentFactory->create();

        $field = $this->contentFieldFactory->create($content['id']);

        $content = $this->contentFactory->create();
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $response = $this->call(
            'PATCH',
            'railcontent/content/field/' . $field['id'],
            [
                'content_id' => $content['id'],
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position,
            ]
        );
        $expectedResults = [
            "id" => $field['id'],
            "content_id" => $content['id'],
            "key" => $key,
            "value" => $value,
            "type" => $type,
            "position" => 1,
        ];

        $this->assertEquals(201, $response->status());
        $this->assertEquals($expectedResults, $response->decodeResponseJson('data')[0]);

    }

    // test reposition
}
