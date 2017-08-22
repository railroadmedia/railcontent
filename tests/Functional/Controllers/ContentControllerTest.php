<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Response;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Services\ConfigService;

class ContentControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
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
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for all missing fields
        $response->assertSessionHasErrors(['slug','status','type']);
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
        $slug =  $this->faker->text(500);
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
            'created_on' =>  Carbon::now()->toDateTimeString(),
            'published_on' => null,
            'archived_on' => null
        ];

        $this->assertEquals($expectedResult, $content);

    }

    public function test_update_response_status()
    {
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

        $slug = implode('-', $this->faker->words());

        $response = $this->call('PUT', 'content/'.$contentId, [
            'slug' => $slug,
            'position'=> 1,
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
            'position'=> 1,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $type
        ]);

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {
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

        $response = $this->call('PUT', 'content/'.$contentId, [
            'slug' => $content['slug'],
            'position' => -1
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['position']);
    }

    public function test_update_not_pass_the_validation()
    {
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

        $response = $this->call('PUT', 'content/'.$contentId);

        //expecting it to redirect us to previous page.
        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors();

        //expecting session has error for missing fields
        $response->assertSessionHasErrors(['slug','status','type']);
    }

    public function test_after_update_content_is_returned_in_json_format()
    {
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

        $new_slug = implode('-', $this->faker->words());
        $response = $this->call('PUT', 'content/'.$contentId,
                                [   'slug' => $new_slug,
                                    'status' => ContentService::STATUS_DRAFT,
                                    'position' => $content['position'],
                                    'type' => $content['type']
                                ]);

        $response->assertJsonStructure(
            [
                'id' ,
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
                'status' =>  $content['status'],
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

        $delete = $this->serviceBeingTested->delete($contentId);

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

        $response = $this->call('DELETE', 'content/'.$contentId, ['deleteChildren' => 1]);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id'=> $contentId,
                'slug' => $content['slug']
            ]
        );
    }

    public function test_delete_missing_content_response_status()
    {
        $response = $this->call('DELETE', 'content/1', ['deleteChildren' => 0]);

        $this->assertEquals(404, $response->status());
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }
}