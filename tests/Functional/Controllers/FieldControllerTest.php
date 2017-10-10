<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Services\FieldService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class FieldControllerTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(FieldService::class);
        $this->classBeingTested = $this->app->make(FieldRepository::class);
        $userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($userId);
        //$this->categoryClass = $this->app->make(CategoryRepository::class);
    }

    public function test_create_content_field_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->text(64);
        $position = $this->faker->numberBetween();

        $content = [
          //  'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $contentField = $this->serviceBeingTested->createField($contentId, null, $key, $value, $type, $position);

        $expectedResult = [
            'id' => 1,
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => $position,
            'field_id' => 1,
            'type' => $type
        ];

        $this->assertEquals($expectedResult, $contentField);
    }

    public function test_add_content_field_controller_method_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $content = [
           // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $response = $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'type' => $type,
            'position' => $position
        ]);

        $this->assertEquals(200, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'content_id',
                'field_id',
                'key',
                'value',
                'type',
                'position'
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'content_id' => $contentId,
                'field_id' => 1,
                'key' => $key,
                'value' => $value,
                'type' => $type,
                'position' => $position
            ]
        );
    }

    public function test_add_content_field_not_pass_the_validation()
    {
        $response = $this->call('POST', 'content/field');

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key', 'value', 'content_id', 'type']);
    }

    public function test_add_content_field_incorrect_fields()
    {
        $key = $this->faker->text(500);
        $value = $this->faker->text(500);
        $type = $this->faker->text(500);
        $position = $this->faker->word;
        $response = $this->call('POST', 'content/field',[
            'content_id' => 1,
            'key' => $key,
            'value' => $value,
            'type' => $type,
            'position' => $position
        ]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for incorrect fields
        $response->assertSessionHasErrors(['key', 'value', 'type', 'position']);
    }

    public function test_update_content_field_controller_method_response()
    {
        $content = [
           // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId
        ];

        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $new_value =$this->faker->text(255);

        $response = $this->call('PUT', 'content/field/'.$fieldId, [
            'content_id' => $contentId,
            'key' => $field['key'],
            'value' => $new_value,
            'position' => $field['position'],
            'type' => $field['type']
        ]);

        $this->assertEquals(201, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'content_id',
                'field_id',
                'key',
                'value',
                'type',
                'position'
            ]
        );

        $response->assertJson(
            [
                'id' => $contentFieldId,
                'content_id' => $contentId,
                'field_id' => $fieldId,
                'key' => $field['key'],
                'value' => $new_value,
                'type' => $field['type'],
                'position' => $field['position']
            ]
        );
    }

    public function test_update_content_field_not_pass_validation()
    {
        $content = [
          //  'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId
        ];

        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $response = $this->call('PUT', 'content/field/'.$fieldId);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','content_id', 'type']);
    }

    public function test_delete_content_field_controller()
    {
        $content = [
          //  'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId
        ];

        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $response = $this->call('DELETE', 'content/field/'.$fieldId, ['content_id' => $contentId]);

        $this->assertEquals(1, $response->content());
        $this->assertEquals(200, $response->status());
    }

    public function test_delete_content_field_not_exist()
    {
        $fieldId = $this->faker->numberBetween();
        $contentId = $this->faker->numberBetween();
        $response = $this->call('DELETE', 'content/field/'.$fieldId, ['content_id' => $contentId]);

        $this->assertEquals('"Delete failed, content field not found with id: ' . $fieldId.'"', $response->content());
        $this->assertEquals(404, $response->status());
    }

    public function test_update_content_field_method_from_service_response()
    {
        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId
        ];

        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $new_value = implode('-', $this->faker->words());
        $categoryField = $this->serviceBeingTested->updateField($contentId, $fieldId, $field['key'], $new_value, $field['type'], $field['position']);

        $expectedResult = [
            'id' => $contentFieldId,
            'content_id' => $contentId,
            'field_id' => $fieldId,
            'key' => $field['key'],
            'value' => $new_value,
            'type' => $field['type'],
            'position' => $field['position']
        ];

        $this->assertEquals($expectedResult, $categoryField);
    }

    public function test_delete_content_field_method_from_service_response()
    {
        $content = [
          //  'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId
        ];

        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $results = $this->serviceBeingTested->deleteField($fieldId, $contentId);

        $this->assertEquals(1, $results);
    }

    public function test_content_updated_event_dispatched_when_link_content_field()
    {
        Event::fake();

        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();

        $content = [
          //  'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $response = $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'type' => $type,
            'position' => $position
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function ($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function test_content_updated_event_dispatched_when_unlink_content_field()
    {
        Event::fake();

        $content = [
           // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        $contentField = [
            'content_id' => $contentId,
            'field_id' => $fieldId
        ];

        $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        $response = $this->call('DELETE', 'content/field/'.$fieldId, ['content_id' => $contentId]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function ($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }
}
