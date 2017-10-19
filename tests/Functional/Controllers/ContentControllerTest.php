<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentService;
use Response;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class ContentControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected $serviceBeingTested;

    protected $userId;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_show()
    {
        $content = $this->contentFactory->create();

//        dd($content);
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'content', [
            'slug' => $slug,
            'position' => null,
            'status' => $status,
            'parent_id' => null,
            'type' => $type
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function test_store_not_pass_the_validation()
    {
        $response = $this->call('POST', 'content');

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for all missing fields
        $response->assertSessionHasErrors(['slug', 'status', 'type']);
    }

    public function test_store_with_negative_position()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => -1
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['position']);
    }

    public function test_store_with_slug_huge()
    {
        $slug = $this->faker->text(500);
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => -1
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['slug']);
    }

    public function test_store_published_on_not_required()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => $position
        ]);

        //expecting that the response has a successful status code
        $response->assertSuccessful();
    }

    public function test_content_created_is_returned_in_json_format()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => $position
        ]);

        $response->assertJson(
            [
                'id' => '1',
                'slug' => $slug,
                'position' => 1,
                'parent_id' => null,
                'status' => $status,
                'type' => $type,
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ]
        );
    }

    public function test_content_service_return_new_content_after_create()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;
        $parentId = null;

        $content = $this->serviceBeingTested->create($slug, $status, $type, $position, $parentId);

        $expectedResult = [
            'id' => 1,
            'slug' => $slug,
            'position' => 1,
            'parent_id' => null,
            'status' => $status,
            'type' => $type,
            'created_on' => Carbon::now()->toDateTimeString(),
            'published_on' => null,
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $this->assertEquals($expectedResult, $content);

    }

    public function test_update_response_status()
    {
        $contentId = $this->createContent();

        $slug = implode('-', $this->faker->words());

        $response = $this->call('PUT', 'content/'.$contentId, [
            'slug' => $slug,
            'position' => 1,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function test_update_missing_content_response_status()
    {
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->word;

        $response = $this->call('PUT', 'content/1', [
            'slug' => $slug,
            'position' => 1,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $type
        ]);

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
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
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $response = $this->call('PUT', 'content/'.$contentId, [
//            'slug' => $content['slug'],
            'position' => -1
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['position']);
    }

    public function test_update_not_pass_the_validation()
    {
        $content = [
            //   'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $response = $this->call('PUT', 'content/'.$contentId);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['slug', 'status', 'type']);
    }

    public function test_after_update_content_is_returned_in_json_format()
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
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $new_slug = implode('-', $this->faker->words());
        $response = $this->call('PUT', 'content/'.$contentId,
            ['slug' => $new_slug,
                'status' => ContentService::STATUS_DRAFT,
                'position' => $content['position'],
                'type' => $content['type']
            ]);

        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
            ]
        );

        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $new_slug,
                'position' => 1,
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null
            ]
        );
    }

    public function test_content_service_return_updated_content_after_update()
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
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $new_slug = implode('-', $this->faker->words());
        $updatedContent = $this->serviceBeingTested->update($contentId, $new_slug, ContentService::STATUS_DRAFT, $content['type'], $content['position'], null, null, null);

        $content['id'] = $contentId;
        $content['slug'] = $new_slug;
        $content['position'] = 1;

        $this->assertEquals($content, $updatedContent);
    }

    public function test_service_delete_method_result()
    {
        $content = [
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $content['id'] = $contentId;

        $delete = $this->serviceBeingTested->delete($content);

        $this->assertTrue($delete);
    }

    public function test_service_delete_method_when_content_not_exist()
    {

        $delete = $this->serviceBeingTested->delete(1);

        $this->assertFalse($delete);
    }

    public function test_controller_delete_method_response_status()
    {
        $content = [
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $response = $this->call('DELETE', 'content/'.$contentId, ['deleteChildren' => 1]);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $contentId,
                //   'slug' => $content['slug']
            ]
        );
    }

    public function test_delete_missing_content_response_status()
    {
        $response = $this->call('DELETE', 'content/1', ['deleteChildren' => 0]);

        $this->assertEquals(404, $response->status());
    }

    public function test_version_old_content_on_update()
    {
        Event::fake();

        $content = [
             'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand
        ];

        $contentId = $this->createContent($content);

        $new_slug = $this->faker->word;

        $response = $this->call('PUT', 'content/'.$contentId, [
            'slug' => $new_slug,
            'status' => ContentService::STATUS_DRAFT,
            'position' => $content['position'],
            'type' => $content['type']
        ]);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function test_version_old_content_before_delete_content()
    {
        Event::fake();

        $contentId = $this->createContent();

        $response = $this->call('DELETE', 'content/'.$contentId);

        //check that the ContentUpdated event was dispatched with the correct content id
        Event::assertDispatched(ContentUpdated::class, function($event) use ($contentId) {
            return $event->contentId == $contentId;
        });
    }

    public function test_restore_content_with_datum()
    {
        $content = [
            // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null
        ];

        $contentId = $this->createContent($content);
        //query()->table(ConfigService::$tableContent)->insertGetId($content);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $datum = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(500)
        ];

        $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $datum['key'],
            'value' => $datum['value'],
            'position' => 1
        ]);

        $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();

        $content['datum'] = [$datum['key'] => $datum['value']];

        $this->call('DELETE', 'content/datum/1', [
            'content_id' => $contentId
        ]);

        //restore content to version 2, where the datum it's linked to the content
        $response = $this->call('GET', 'content/restore/2');

        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'datum'
            ]
        );

        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $contentSlug,
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'datum' => $content['datum']
            ]
        );
    }

    public function test_restore_content_with_fields()
    {
        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);
        //query()->table(ConfigService::$tableContent)->insertGetId($content);
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'type' => 'string',
            'position' => 1
        ]);

        // content that is linked via a field
        $linkedContent = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->createContent($linkedContent);
        //query()->table(ConfigService::$tableContent)->insertGetId($linkedContent);
        $linkedContentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedContentId, ConfigService::$tableContent, $linkedContentSlug);

        $fieldKey = $this->faker->word;

        $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        //get content that will be restored
        $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $content['fields'] = [$fieldKey => $linkedContent];

        $del = $this->call('DELETE', 'content/field/1', [
            'content_id' => $contentId
        ]);

        //restore content to version 3, where the field with type content_id it's linked to the content
        $response = $this->call('GET', 'content/restore/3');

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $contentSlug,
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'fields' => $content['fields'],
                'brand' => ConfigService::$brand
            ]
        );
    }

    public function test_restore_and_recreate_missing_field()
    {
        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        // content that is linked via a field
        $linkedContent = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->createContent($linkedContent);

        $linkedContentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedContentId, ConfigService::$tableContent, $linkedContentSlug);

        $linkedContent['id'] = $linkedContentId;

        $fieldKey = $this->faker->word;

        $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $content['fields'] = [$fieldKey => $linkedContent];

        $this->call('DELETE', 'content/field/1', [
            'content_id' => $contentId
        ]);

        $this->call('DELETE', 'content/field/'.$linkedContentId, [
            'content_id' => $contentId
        ]);

        $this->call('DELETE', 'content/'.$linkedContentId);

        //restore content to version 3, where the field with type content_id it's linked to the content
        $response = $this->call('GET', 'content/restore/2');

        //a new linked content should be created => the content id is incremented
        $content['fields'][$fieldKey]['id']++;

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $contentSlug,
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'fields' => $content['fields']
            ]
        );
    }

    public function test_restore_multiple_fields()
    {
        $content = [
            // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        // Add a multiple key field
        $multipleKeyFieldKey = $this->faker->word;
        $multipleKeyFieldValues = [$this->faker->word, $this->faker->word, $this->faker->word];

        $multipleField1 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[0],
                'type' => 'multiple',
                'position' => 0,
            ]
        );
        $this->translateItem($this->classBeingTested->getUserLanguage(), $multipleField1, ConfigService::$tableFields, $multipleKeyFieldValues[0]);

        $multipleFieldLink1 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField1,
            ]
        );

        $multipleField2 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[2],
                'type' => 'multiple',
                'position' => 2,
            ]
        );
        $this->translateItem($this->classBeingTested->getUserLanguage(), $multipleField2, ConfigService::$tableFields, $multipleKeyFieldValues[2]);

        $multipleFieldLink2 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField2,
            ]
        );

        $multipleField3 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[1],
                'type' => 'multiple',
                'position' => 1,
            ]
        );
        $this->translateItem($this->classBeingTested->getUserLanguage(), $multipleField3, ConfigService::$tableFields, $multipleKeyFieldValues[1]);

        $multipleFieldLink3 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField3,
            ]
        );

        $content = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $content['fields'] = [$multipleKeyFieldKey => [0 => $multipleKeyFieldValues[0], 2 => $multipleKeyFieldValues[2], 1 => $multipleKeyFieldValues[1]]];
        $response = $this->call('DELETE', 'content/field/'.$multipleField1, [
            'content_id' => $contentId
        ]);

        //restore content to version 1, where all the fields are linked to the content
        $response = $this->call('GET', 'content/restore/1');

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $contentSlug,
                'position' => $content['position'],
                'status' => $content['status'],
                'type' => $content['type'],
                'parent_id' => $content['parent_id'],
                'created_on' => $content['created_on'],
                'archived_on' => $content['archived_on'],
                'fields' => $content['fields']
            ]
        );
    }

    public function test_restore_with_fields_and_datum()
    {
        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        //link a field with 'string' type
        $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'type' => 'string',
            'position' => 1
        ]);

        // content linked
        $linkedContent = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => 2,
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->createContent($linkedContent);

        $linkedContentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $linkedContentId, ConfigService::$tableContent, $linkedContentSlug);

        $fieldKey = $this->faker->word;

        $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        //link first datum to content
        $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $this->faker->word,
            'value' => $this->faker->text(500),
            'position' => 1
        ]);

        $datum = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(500)
        ];

        //link second datum to content
        $this->call('POST', 'content/datum', [
            'content_id' => $contentId,
            'key' => $datum['key'],
            'value' => $datum['value'],
            'position' => 2
        ]);

        $versionContent = $this->query()->table(ConfigService::$tableContent)->where(['id' => $contentId])->get()->first();
        $versionContent['fields'] = [$fieldKey => $linkedContent];
        $versionContent['datum'] = [$datum['key'] => $datum['value']];
        $versionContent['slug'] = $contentSlug;

        //delete first linked field
        $this->call('DELETE', 'content/field/1', [
            'content_id' => $contentId
        ]);

        //delete second linked field
        $this->call('DELETE', 'content/field/2', [
            'content_id' => $contentId
        ]);

        //delete first linked datum
        $this->call('DELETE', 'content/datum/1', [
            'content_id' => $contentId
        ]);

        //delete second linked datum
        $this->call('DELETE', 'content/datum/2', [
            'content_id' => $contentId
        ]);

        //restore content to version 5, where all the fields and datum are linked to the content
        $response = $this->call('GET', 'content/restore/5');

        //check response structure
        $response->assertJsonStructure(
            [
                'id',
                'slug',
                'status',
                'type',
                'position',
                'parent_id',
                'published_on',
                'created_on',
                'archived_on',
                'fields',
                'datum'
            ]
        );

        //check response values
        $response->assertJson(
            [
                'id' => $contentId,
                'slug' => $versionContent['slug'],
                'position' => $versionContent['position'],
                'status' => $versionContent['status'],
                'type' => $versionContent['type'],
                'parent_id' => $versionContent['parent_id'],
                'created_on' => $versionContent['created_on'],
                'archived_on' => $versionContent['archived_on'],
                'fields' => $versionContent['fields'],
                'datum' => $versionContent['datum']
            ]
        );
    }

    public function test_restore_content_version_not_exist()
    {
        //restore content to a missing version
        $response = $this->call('GET', 'content/restore/1');

        $this->assertEquals('"Restore content failed, version not found with id: 1"', $response->content());

        $this->assertEquals(404, $response->status());
    }

    public function test_can_not_delete_content_linked()
    {
        $contentId = $this->createContent();
        $contentId2 = $this->createContent();

        // content linked
        $linkedContentId = $this->createContent();

        $fieldKey = $this->faker->word;

        $this->call('POST', 'content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        $this->call('POST', 'content/field', [
            'content_id' => $contentId2,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);
        $response = $this->call('DELETE', 'content/'.$linkedContentId);

        $this->assertEquals('"This content is being referenced by other content ('.$contentId.', '.$contentId2.'), you must delete that content first."', $response->content());

        $this->assertEquals(404, $response->status());
    }

    public function test_index_response_no_results()
    {
        $response = $this->call('GET', '/', [
            'page' => 1,
            'amount' => 10,
            'statues' => ['draft', 'published'],
            'types' => ['course'],
            'fields' => [],
            'parent_slug' => '',
            'include_future_published_on' => false
        ]);

        $expectedResults = [];

        $this->assertEquals(200, $response->status());

        $response->assertJson($expectedResults);
    }

    public function test_index_with_results()
    {
        $statues = ['draft', 'published'];
        $types = ['course'];

        $expectedContents = [];

        //create courses
        for($i = 0; $i < 30; $i++) {
            $content = [
                //    'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $types[0],
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);

            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        //create library lessons
        $libraryLesson = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'library lesson',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $this->createContent($libraryLesson);

        //we expect to receive only first 10 courses with status 'draft' or 'published'
        $expectedContent = array_slice($contents, 0, 10, true);

        $response = $this->call('GET', '/', [
            'page' => 1,
            'amount' => 10,
            'order_by' => 'id',
            'order' => 'asc',
            'statues' => $statues,
            'types' => $types,
            'fields' => [],
            'parent_slug' => '',
            'include_future_published_on' => false
        ]);

        $response->assertJson($expectedContent);
    }

    public function test_index_with_required_fields()
    {
        $expectedResults = [];
        $statues = ['draft', 'published'];
        $types = ['course'];

        //create courses
        for($i = 0; $i < 30; $i++) {
            $content = [
                //'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $types[0],
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
            ];

            $contentId = $this->createContent($content);
            $contentSlug = $this->faker->word;
            $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);
            $contents[$contentId] = array_merge(['id' => $contentId, 'slug' => $contentSlug], $content);
        }

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => 'string',
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $fieldId, ConfigService::$tableFields, $field['value']);

        for($i = 1; $i < 5; $i++) {
            $contentField = [
                'content_id' => $contents[$i]['id'],
                'field_id' => $fieldId
            ];

            $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);
            $expectedResults[$i] = $contents[$i];
            $expectedResults[$i]['fields'] = [$field['key'] => $field['value']];
        }

        $response = $this->call('GET', '/', [
            'page' => 1,
            'amount' => 10,
            'statues' => $statues,
            'types' => $types,
            'fields' => [$field['key'] => $field['value']],
            'parent_slug' => '',
            'include_future_published_on' => false
        ]);

        $response->assertJson($expectedResults);

    }

    public function test_start_content()
    {
        $contentId = $this->createContent();
        $response = $this->call('PUT', 'start', ['content_id' => $contentId]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('true', $response->content());
    }

    public function test_start_content_invalid_content_id()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'start', ['content_id' => 1]);

        $this->assertEquals(404, $response->status());

        $this->assertEquals('"Start content failed, content not found with id: 1"', $response->content());
    }

    public function test_complete_content()
    {
        $contentId = $this->createContent();

        $userId = $this->createAndLogInNewUser();

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];

        $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $response = $this->call('PUT', 'complete', ['content_id' => $contentId]);

        $this->assertEquals(201, $response->status());
        $this->assertEquals('true', $response->content());
    }

    public function test_complete_content_invalid_content_id()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'complete', ['content_id' => 1]);

        $this->assertEquals(404, $response->status());

        $this->assertEquals('"Complete content failed, content not found with id: 1"', $response->content());
    }

    public function test_save_user_progress_on_content()
    {
        $content = [
            // 'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => "1",
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $userId = $this->createAndLogInNewUser();

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 10)
        ];

        $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $response = $this->call('PUT', 'progress', ['content_id' => $contentId, 'progress' => $this->faker->numberBetween(10, 99)]);

        $this->assertEquals(201, $response->status());
        $this->assertEquals('true', $response->content());
    }

    public function test_save_user_progress_on_content_inexistent()
    {
        $contentId = 1;
        $userId = $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'progress', ['content_id' => $contentId, 'progress' => $this->faker->numberBetween(10, 99)]);

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Save user progress failed, content not found with id: 1"', $response->content());
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }
}