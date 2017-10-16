<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Repositories\CategoryRepository;
use Railroad\Railcontent\Repositories\DatumRepository;
use Railroad\Railcontent\Services\DatumService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class DatumControllerTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(DatumService::class);
        $this->classBeingTested = $this->app->make(DatumRepository::class);
        $userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($userId);
        //$this->categoryClass = $this->app->make(CategoryRepository::class);
    }

    public function test_create_datum_method_from_service_response()
    {
        $key = $this->faker->word;
        $value = $this->faker->text(500);

        $contentId = $this->createContent();

        $categoryField = $this->serviceBeingTested->createDatum($contentId, null, $key, $value, 1);

        $expectedResult = [
            'id' => 1,
            'content_id' => $contentId,
            'datum_id' => 1,
            'key' => $key,
            'value' => $value,
            'position' => 1
        ];

        $this->assertEquals($expectedResult, $categoryField);
    }

    public function test_add_content_datum_controller_method_response()
    {
        $contentId = $this->createContent();

        $key = $this->faker->word;
        $value = $this->faker->text(500);

        $response = $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => 1
        ]);

        $this->assertEquals(200, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'content_id',
                'datum_id',
                'key',
                'position',
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'content_id' => $contentId,
                'datum_id' => 1,
                'key' => $key,
                'value' => $value,
                'position' => 1
            ]
        );
    }

    public function test_add_content_datum_not_pass_the_validation()
    {
        $response = $this->call('POST', 'content/datum');

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key', 'value', 'content_id']);
    }

    public function test_add_content_datum_key_not_pass_the_validation()
    {
        $key = $this->faker->text(600);
        $value = $this->faker->text(500);

        $response = $this->call('POST', 'content/datum',['content_id'=>1,'key'=>$key, 'value' => $value]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for key field
        $response->assertSessionHasErrors(['key']);
    }

    public function test_update_content_datum_controller_method_response()
    {
        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
           // 'value' => $this->faker->text(),
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $new_value =  $this->faker->text();

        $response = $this->call('PUT', 'content/datum/'.$dataId, [
            'content_id' => $contentId,
            'key' => $data['key'],
            'value' => $new_value,
            'position' => $data['position']
        ]);

        $this->assertEquals(201, $response->status());

        $response->assertJsonStructure(
            [
                'id' ,
                'content_id',
                'datum_id',
                'key',
                'value',
                'position'
            ]
        );

        $response->assertJson(
            [
                'id' => 1,
                'content_id' => $contentId,
                'datum_id' => $dataId,
                'key' => $data['key'],
                'value' => $new_value,
                'position' => $data['position']
            ]
        );
    }

    public function test_update_content_datum_not_pass_validation()
    {
        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $response = $this->call('PUT', 'content/datum/'.$dataId);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['key','value','content_id']);
    }

    public function test_delete_content_datum_controller()
    {
        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $response = $this->call('DELETE', 'content/datum/'.$dataId, [
            'content_id' => $contentId
        ]);

        $this->assertEquals(1, $response->content());
        $this->assertEquals(200, $response->status());
    }

    public function test_update_content_datum_method_from_service_response()
    {
        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $new_value = $this->faker->text(500);
        $categoryField = $this->serviceBeingTested->updateDatum($contentId, $dataId, $data['key'], $new_value, $data['position']);

        $expectedResult = [
            'id' => $contentDataId,
            'content_id' => $contentId,
            'datum_id' => $dataId,
            'key' => $data['key'],
            'value' => $new_value,
            'position' => $data['position']
        ];

        $this->assertEquals($expectedResult, $categoryField);
    }

    public function test_get_content_datum_method_from_service_response()
    {
        $contentId = $this->createContent();
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $data = [
            'key' => $this->faker->word,
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);
        $dataValue= $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $dataId, ConfigService::$tableData, $dataValue);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $results = $this->serviceBeingTested->getDatum($dataId, $contentId);

        $expectedResults = [
            'id' => $contentDataId,
            'content_id' => $contentId,
            'datum_id' => $dataId,
            'key' => $data['key'],
            'value' => $dataValue,
            'position' => $data['position']
        ];

        $this->assertEquals($expectedResults, $results);
    }

    public function test_delete_content_datum_method_from_service_response()
    {
        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $results = $this->serviceBeingTested->deleteDatum($dataId, $contentId);

        $this->assertEquals(1, $results);
    }

    public function test_content_updated_event_dispatched_when_link_content_datum()
    {
        Event::fake();

        $contentId = $this->createContent();

        $key = $this->faker->word;
        $value = $this->faker->text(500);

        $response = $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $key,
            'value' => $value,
            'position' => 1
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function ($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function test_content_updated_event_dispatched_when_unlink_content_datum()
    {
        Event::fake();

        $contentId = $this->createContent();

        $data = [
            'key' => $this->faker->word,
            'position' =>$this->faker->numberBetween()
        ];
        $dataId = $this->query()->table(ConfigService::$tableData)->insertGetId($data);

        $contentData = [
            'content_id' => $contentId,
            'datum_id' => $dataId
        ];
        $contentDataId = $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentData);

        $response = $this->call('DELETE', 'content/datum/'.$dataId, [
            'content_id' => $contentId
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function ($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }
}
