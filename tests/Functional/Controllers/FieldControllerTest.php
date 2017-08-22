<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
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
        //$this->categoryClass = $this->app->make(CategoryRepository::class);
    }

    public function test_create_content_field_method_from_service_response()
    {
        $key = $this->faker->text(255);
        $value = $this->faker->text(255);
        $type = $this->faker->text(64);
        $position = $this->faker->numberBetween();

        $content = [
            'slug' => $this->faker->word,
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
            'slug' => $this->faker->word,
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
}
