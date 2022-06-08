<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Factories\UserContentProgressFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentJsonControllerTest extends RailcontentTestCase
{
    use ArraySubsetAsserts;

    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDatumFactory;

    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    /**
     * @var \Railroad\Railcontent\Repositories\ContentPermissionRepository
     */
    protected $contentPermissionRepository;

    /**
     * @var \Railroad\Railcontent\Repositories\UserPermissionsRepository
     */
    protected $userPermissionRepository;

    /**
     * @var \Railroad\Railcontent\Repositories\PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @var ContentHierarchyService
     */
    protected $contentHierarchyService;

    /**
     * @var UserContentProgressFactory
     */
    protected $userContentProgressFactory;

    protected function setUp()
    : void
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentPermissionRepository = $this->app->make(ContentPermissionRepository::class);
        $this->permissionRepository = $this->app->make(PermissionRepository::class);
        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);
        $this->contentHierarchyService = $this->app->make(ContentHierarchyService::class);
        $this->userContentProgressFactory = $this->app->make(UserContentProgressFactory::class);
    }

    public function test_index_empty()
    {
        $response = $this->call('GET', 'railcontent/content');

        $this->assertEquals(
            [],
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_PUBLISHED;

        $response = $this->call('PUT', 'railcontent/content', [
            'slug' => $slug,
            'position' => null,
            'status' => $status,
            'parent_id' => null,
            'type' => $type,
            'published_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function test_store_not_pass_the_validation()
    {
        $response = $this->put('railcontent/content');

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "type",
                "detail" => "The type field is required.",
            ],
        ];
        $this->assertEquals(
            $errors,
            $response->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_store_with_negative_position()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('PUT', 'railcontent/content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => -1,
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "position",
                "detail" => "The position must be at least 0.",
            ],

        ];
        $this->assertEquals(
            $errors,
            $response->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function _test_store_with_custom_validation_and_slug_huge()
    {
        $slug = $this->faker->text(500);
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('PUT', 'railcontent/content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $this->faker->word,
            'position' => 1,
        ]);

        $this->assertEquals(422, $response->status());

        $errors = [
            [
                'source' => "slug",
                "detail" => "The slug may not be greater than 64 characters.",
            ],

        ];
        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
    }

    public function test_store_published_on_not_required()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;
        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = [ContentService::STATUS_DRAFT];

        $response = $this->call('PUT', 'railcontent/content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => $position,
        ]);

        //expecting that the response has a successful status code
        $response->assertSuccessful();
    }

    public function test_content_created_is_returned_in_json_format()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_PUBLISHED;
        $publishedOn =
            Carbon::now()
                ->toDateTimeString();

        $response = $this->call('PUT', 'railcontent/content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => $position,
            'auth_level' => 'administrator',
            'published_on' => $publishedOn,
        ]);

        $expectedResults = [
            0 => [
                'id' => '1',
                'slug' => $slug,
                'brand' => ConfigService::$brand,
                'language' => ConfigService::$defaultLanguage,
                'status' => $status,
                'type' => $type,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'published_on' => $publishedOn,
                'archived_on' => null,
                'parent_id' => null,
                'fields' => [],
                'data' => [],
                'permissions' => [],
                'child_id' => null,
                'sort' => 0,
            ],
        ];

        $this->assertArraySubset(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_content_service_return_new_content_after_create()
    {
        $content = $this->contentFactory->create();
        unset($content['name']);

        $response = $this->call('GET', 'railcontent/content/'.$content['id']);

        $this->assertEquals(
            $content->getArrayCopy(),
            $response->decodeResponseJson()
                ->json('data')[0]
        );
    }

    public function test_update_response_status()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $this->call('GET', 'railcontent/content', [
            'page' => 1,
            'limit' => 10,
            'sort' => 'id',
            'statuses' => [ContentService::STATUS_PUBLISHED],
        ]);

        $response = $this->call('PATCH', 'railcontent/content/'.$content['id'], [
            'slug' => $content['slug'],
            'status' => ContentService::STATUS_PUBLISHED,
            'type' => $this->faker->word,
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function test_update_missing_content_response_status()
    {
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->word;

        $response = $this->call('PATCH', 'railcontent/content/'.rand(), [
            'slug' => $slug,
            'position' => 1,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $type,
        ]);

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('PATCH', 'railcontent/content/'.$content['id'], [
            'position' => -1,
            'status' => $content['status'],
            'type' => $content['type'],
        ]);

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());
        //check that the error message is received
        $errors = [
            [
                'source' => "position",
                "detail" => "The position must be at least 0.",
            ],
        ];
        $this->assertEquals(
            $errors,
            $response->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_update_not_pass_the_validation()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('PATCH', 'railcontent/content/'.$content['id'], [
            'status' => $this->faker->word,
        ]);

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "status",
                "detail" => "The selected status is invalid.",
            ],
        ];
        $this->assertEquals(
            $errors,
            $response->decodeResponseJson()
                ->json('meta')['errors']
        );
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
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand,
        ];

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $new_slug = implode('-', $this->faker->words());

        $response = $this->call('PATCH', 'railcontent/content/'.$content['id'], [
            'slug' => $new_slug,
            'status' => ContentService::STATUS_PUBLISHED,
            'type' => $content['type'],
        ]);
        $this->assertArraySubset(
            [
                'id' => $content['id'],
                'slug' => $new_slug,
                'status' => ContentService::STATUS_PUBLISHED,
                'type' => $content['type'],
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'sort' => 0,
            ],
            $response->decodeResponseJson()
                ->json('data')[0]
        );
    }

    public function test_content_service_return_updated_content_after_update()
    {
        $content = $this->contentFactory->create();

        $new_slug = implode('-', $this->faker->words());
        $updatedContent = $this->serviceBeingTested->update($content['id'], [
            "slug" => $new_slug,
            "status" => $content['status'],
            "type" => $content['type'],
            "language" => ConfigService::$defaultLanguage,
            "published_on" => $content['published_on'],
        ]);

        $content['slug'] = $new_slug;
        //$content['position'] = 1;

        $this->assertEquals($content, $updatedContent);
    }

    public function test_service_delete_method_result()
    {
        $content = $this->contentFactory->create();
        $delete = $this->serviceBeingTested->delete($content['id']);

        $this->assertTrue($delete);
    }

    public function test_service_delete_method_when_content_not_exist()
    {
        $delete = $this->serviceBeingTested->delete(1);

        $this->assertNull($delete);
    }

    public function test_controller_delete_method_response_status()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('DELETE', 'railcontent/content/'.$content['id']);

        $this->assertEquals(204, $response->status());

        $this->assertDatabaseMissing(ConfigService::$tableContent, [
            'id' => $content['id'],
        ]);
    }

    public function test_delete_missing_content_response_status()
    {
        $randomId = $this->faker->numberBetween();
        $response = $this->call('DELETE', 'railcontent/content/'.$randomId);

        $this->assertEquals(404, $response->status());
        $this->assertEquals(
            'Entity not found.',
            $response->decodeResponseJson()
                ->json('meta')['errors']['title']
        );
        $this->assertEquals(
            'Delete failed, content not found with id: '.$randomId,
            $response->decodeResponseJson()
                ->json('meta')['errors']['detail']
        );
    }

    public function test_index_response_no_results()
    {
        $response = $this->call('GET', 'railcontent/content', [
            'page' => 1,
            'amount' => 10,
            'statues' => ['draft', 'published'],
            'types' => ['course'],
            'fields' => [],
            'parent_slug' => '',
            'include_future_published_on' => false,
        ]);

        $expectedResults = [];

        $this->assertEquals(200, $response->status());

        $response->assertJson($expectedResults);
    }

    public function test_index_with_results()
    {
        $userId = $this->createAndLogInNewUser();
        $statues = ['published'];
        $types = ['course'];
        $page = 1;
        $limit = 10;
        $filter = [];

        $expectedContent = [
            'page' => $page,
            'limit' => $limit,
            'status' => 'ok',
            'code' => 200,
            'filter_options' => $filter,
        ];

        //create courses
        $nrCourses = 30;

        for ($i = 0; $i < $nrCourses; $i++) {
            $content = $this->contentFactory->create(
                $this->faker->word,
                $types[0],
                $this->faker->randomElement($statues)
            );
            unset($content['name']);
            $contents[$i] = (array)$content;
        }

        //create library lessons
        $libraryLesson = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'library lesson',
            'published_on' => Carbon::now()
                ->subDays(($i + 1) * 10)
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage,
        ];
        $libraryId =
            $this->query()
                ->table(ConfigService::$tableContent)
                ->insertGetId($libraryLesson);

        //we expect to receive only first 10 courses with status 'draft' or 'published'
        $expectedContent['results'] = array_slice($contents, 0, $limit, true);
        $expectedContent['total_results'] = $nrCourses;

        sleep(1);
        $response = $this->call('GET', 'railcontent/content', [
            'page' => $page,
            'limit' => $limit,
            'sort' => 'id',
            'included_types' => $types,
        ]);

        $responseContent =
            $response->decodeResponseJson()
                ->json('data');

        $this->assertArraySubset($expectedContent['results'], $responseContent);
    }

    public function test_index_with_required_fields()
    {
        $expectedResults = [];
        $statues = ['published'];
        $types = ['course'];
        $page = 1;
        $limit = 5;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit,
            'status' => 'ok',
            'code' => 200,
        ];

        $nrCourses = 10;

        //create courses
        for ($i = 1; $i < $nrCourses; $i++) {
            $content = $this->contentFactory->create(
                $this->faker->word,
                $types[0],
                $this->faker->randomElement($statues)
            );
            unset($content['name']);
            $contents[$i] = (array)$content;
        }

        $contentWithFieldsNr = 5;
        $fieldKey = 'title';
        $fieldValue = $this->faker->text();
        $fieldType = 'string';

        $filter = [$fieldKey.','.$fieldValue.','.$fieldType];
        $expectedContent['filter_options'] = [];

        for ($i = 1; $i < $contentWithFieldsNr; $i++) {
            $field = $this->fieldFactory->create($contents[$i]['id'], $fieldKey, $fieldValue, 1, $fieldType);

            $expectedResults[$i - 1] = $contents[$i];
            $expectedResults[$i - 1]['fields'][] = $field;
        }
        $expectedContent['results'] = $expectedResults;
        $expectedContent['total_results'] = $contentWithFieldsNr - 1;

        $response = $this->call('GET', 'railcontent/content', [
            'page' => $page,
            'limit' => $limit,
            'sort' => 'id',
            'included_types' => $types,
            'required_fields' => $filter,
        ]);
        $responseContent =
            $response->decodeResponseJson()
                ->json('data');

        $this->assertArraySubset($expectedContent['results'], $responseContent);
    }

    //Get 5 courses with given string field
    public function test_index_with_fields_and_datum()
    {
        $expectedResults = [];
        $statues = ['published'];
        $types = ['course'];
        $page = 1;
        $limit = 5;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit,
            'status' => 'ok',
            'code' => 200,
        ];

        //create 30th courses
        for ($i = 0; $i < 30; $i++) {
            $content = $this->contentFactory->create('slug-'.$i, $types[0], 'published');
            unset($content['name']);
            $contents[$content['id']] = (array)$content;
        }

        //create the required field
        $requiredField = [
            'key' => 'title',
            'value' => $this->faker->text(255),
            'type' => 'string',
        ];

        //only first 5 courses have the required field associated
        for ($i = 1; $i < 6; $i++) {
            $field = $this->fieldFactory->create(
                $contents[$i]['id'],
                $requiredField['key'],
                $requiredField['value'],
                1,
                $requiredField['type']
            );

            $expectedResults[$i - 1] = $contents[$i];
            $expectedResults[$i - 1]['fields'][] = $field;
        }

        $instructor =
            $this->contentFactory->create($this->faker->word, 'instructor', $this->faker->randomElement($statues));

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructor['id'],
            'type' => 'content_id',
        ];

        for ($i = 1; $i < 7; $i++) {
            $contentField = $this->fieldFactory->create(
                $contents[$i]['id'],
                $fieldInstructor['key'],
                $fieldInstructor['value'],
                1,
                $fieldInstructor['type']
            );
            $contentField['type'] = 'content';
            unset($instructor['sort']);
            unset($instructor['name']);
            unset($instructor['created_on']);
            unset($instructor['archived_on']);
            unset($instructor['brand']);
            unset($instructor['language']);
            unset($instructor['parent_id']);
            unset($instructor['child_id']);
            unset($instructor['popularity']);
            $contentField['value'] = (array)$instructor;
            if (array_key_exists(($i - 1), $expectedResults)) {
                $expectedResults[$i - 1]['fields'][] = (array)$contentField;
            }
        }

        //        for ($i = 1; $i < 25; $i++) {
        //            $datum = $this->contentDatumFactory->create($contents[$i]['id']);
        //
        //            if (array_key_exists(($i - 1), $expectedResults)) {
        //                $expectedResults[$i - 1]['data'][] = $datum;
        //            }
        //        }

        $expectedContent['results'] = $expectedResults;
        $expectedContent['total_results'] = count($expectedContent['results']);
        $expectedContent['filter_options'] = [$fieldInstructor['key'] => [(array)$instructor]];

        $response = $this->call('GET', 'railcontent/content', [
            'page' => 1,
            'limit' => 10,
            'statuses' => $statues,
            'sort' => 'id',
            'included_types' => $types,
            //            'filter' => [
            'required_fields' => [
                $requiredField['key'].','.$requiredField['value'].','.$requiredField['type'],
                $fieldInstructor['key'].','.$fieldInstructor['value'].','.$fieldInstructor['type'],
            ],
            //            ],
            // 'parent_slug' => '',
        ]);

        $responseContent =
            $response->decodeResponseJson()
                ->json('data');

        $this->assertArraySubset($expectedContent['results'], $responseContent);
    }

    public function test_getByParentId_when_parentId_not_exist()
    {
        $response = $this->call(
            'GET',
            'railcontent/content/parent/'.rand()
        );

        $this->assertEquals(
            [],
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_getByParentId()
    {
        $parent = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $firstChild = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $firstChild['parent_id'] = $parent['id'];
        $firstChild['child_id'] = $firstChild['id'];
        $firstChild['position'] = 1;
        $firstChild['child_ids'] = [$firstChild['id']];
        $fieldFirstChild = $this->fieldFactory->create($firstChild['id']);
        $firstChild['fields'][] = $fieldFirstChild;

        $this->contentHierarchyFactory->create($parent['id'], $firstChild['id']);

        $secondChild = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $secondChild['parent_id'] = $parent['id'];
        $secondChild['child_id'] = $secondChild['id'];
        $secondChild['position'] = 2;
        $secondChild['child_ids'] = [$secondChild['id']];

        $this->contentHierarchyFactory->create($parent['id'], $secondChild['id']);

        $response = $this->call(
            'GET',
            'railcontent/content/parent/'.$parent['id']
        );

        $this->assertEquals(
            2,
            count(
                $response->decodeResponseJson()
                    ->json('data')
            )
        );

        unset($firstChild['child_id']);
        unset($secondChild['child_id']);
        $expectedResults = [
            (array)$firstChild,
            (array)$secondChild,
        ];
        $this->assertEquals(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_get_by_ids_when_ids_not_exists()
    {
        $response = $this->call('GET', 'railcontent/content/get-by-ids', [rand(), rand()]);

        $this->assertEquals(
            [],
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_get_by_ids()
    {
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        unset($content1['name']);
        unset($content2['name']);
        $response =
            $this->call('GET', 'railcontent/content/get-by-ids', ['ids' => $content2['id'].','.$content1['id']]);
        $expectedResults = [
            (array)$content2,
            (array)$content1,
        ];

        $this->assertEquals(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_get_id_cached()
    {
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $start1 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/'.$content1['id']);
        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/'.$content1['id']);
        $time2 = microtime(true) - $start2;

        $start3 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/'.$content1['id']);
        $time3 = microtime(true) - $start3;

        $start4 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/'.$content1['id']);
        $time4 = microtime(true) - $start4;

        $start5 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/'.$content1['id']);
        $time5 = microtime(true) - $start5;

        $start6 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/get-by-ids', [$content1['id']]);
        $time6 = microtime(true) - $start6;

        $start7 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/get-by-ids', [$content1['id']]);
        $time7 = microtime(true) - $start7;

        $response->assertStatus(200);
    }

    public function test_store_content_execution_time()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_PUBLISHED;

        //prepare Redis cache with 300.000 keys that will be deleted when a new content it's created
        //        for ($i = 0; $i < 100000; $i++) {
        //            Redis::set('contents_results_' . $i, $i);
        //            Redis::set('_type_' . $type . $i, $i);
        //            Redis::set('types' . $i, $i);
        //        }

        $executionStartTime = microtime(true);

        $response = $this->call('PUT', 'railcontent/content', [
            'slug' => $slug,
            'position' => null,
            'status' => $status,
            'parent_id' => null,
            'type' => $type,
            'published_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
        $executionEndTime = microtime(true);

        //The result will be in seconds and milliseconds.
        $seconds = $executionEndTime - $executionStartTime;

        //Print it out
        echo "Create content method(inclusive clear Redis cache) took $seconds seconds to execute when in Redis cache exists 300.000 keys that should be deleted.";

        $this->assertEquals(201, $response->status());
    }

    public function test_pull_content_permission()
    {
        $user = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $permission = $this->permissionRepository->create([
                                                              'name' => $this->faker->word,
                                                              'brand' => ConfigService::$brand,
                                                          ]);
        $contentPermission = $this->contentPermissionRepository->create([
                                                                            'content_id' => $content1['id'],
                                                                            'permission_id' => $permission,
                                                                        ]);
        $userPermission = $this->userPermissionRepository->create([
                                                                      'user_id' => $user,
                                                                      'permission_id' => $permission,
                                                                      'start_date' => Carbon::now()
                                                                          ->subMonth(2)
                                                                          ->toDateTimeString(),
                                                                      'expiration_date' => Carbon::now()
                                                                          ->subMonth(1)
                                                                          ->toDateTimeString(),
                                                                      'created_on' => Carbon::now()
                                                                          ->subMonth(2)
                                                                          ->toDateTimeString(),
                                                                  ]);
        $content2 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response =
            $this->call('GET', 'railcontent/content/get-by-ids', ['ids' => $content2['id'].','.$content1['id']]);
        $expectedResults = [(array)$content2];

        $this->assertEquals(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_pull_content_user_permission()
    {
        $user = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'lesson',
            ContentService::STATUS_PUBLISHED
        );

        $permission = $this->permissionRepository->create([
                                                              'name' => $this->faker->word,
                                                              'brand' => ConfigService::$brand,
                                                          ]);

        $contentPermission = $this->contentPermissionRepository->create([
                                                                            'content_id' => $content1['id'],
                                                                            'permission_id' => $permission,
                                                                        ]);

        $userPermission = $this->userPermissionRepository->create([
                                                                      'user_id' => $user,
                                                                      'permission_id' => $permission,
                                                                      'start_date' => Carbon::now()
                                                                          ->subMonth(2)
                                                                          ->toDateTimeString(),
                                                                      'expiration_date' => Carbon::now()
                                                                          ->subMonth(1)
                                                                          ->toDateTimeString(),
                                                                      'created_on' => Carbon::now()
                                                                          ->subMonth(2)
                                                                          ->toDateTimeString(),
                                                                  ]);

        $response =
            $this->call('GET', 'railcontent/content/get-by-ids', ['ids' => $content2['id'].','.$content1['id']]);
        $expectedResults = [(array)$content2];

        $this->assertEquals(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_pull_content_user_permission_before_start_date()
    {
        $user = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'lesson',
            ContentService::STATUS_PUBLISHED
        );

        $permission = $this->permissionRepository->create([
                                                              'name' => $this->faker->word,
                                                              'brand' => ConfigService::$brand,
                                                          ]);

        $contentPermission = $this->contentPermissionRepository->create([
                                                                            'content_id' => $content1['id'],
                                                                            'permission_id' => $permission,
                                                                        ]);

        $userPermission = $this->userPermissionRepository->create([
                                                                      'user_id' => $user,
                                                                      'permission_id' => $permission,
                                                                      'start_date' => Carbon::now()
                                                                          ->addMonths(2)
                                                                          ->toDateTimeString(),
                                                                      'expiration_date' => Carbon::now()
                                                                          ->addMonths(6)
                                                                          ->toDateTimeString(),
                                                                      'created_on' => Carbon::now()
                                                                          ->subMonth(2)
                                                                          ->toDateTimeString(),
                                                                  ]);

        $response =
            $this->call('GET', 'railcontent/content/get-by-ids', ['ids' => $content2['id'].','.$content1['id']]);
        $expectedResults = [(array)$content2];

        $this->assertEquals(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_pull_content_user_permission_after_start_date()
    {
        $user = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'lesson',
            ContentService::STATUS_PUBLISHED
        );

        $permission = $this->permissionRepository->create([
                                                              'name' => $this->faker->word,
                                                              'brand' => ConfigService::$brand,
                                                          ]);

        $contentPermission = $this->contentPermissionRepository->create([
                                                                            'content_id' => $content1['id'],
                                                                            'permission_id' => $permission,
                                                                        ]);

        $userPermission = $this->userPermissionRepository->create([
                                                                      'user_id' => $user,
                                                                      'permission_id' => $permission,
                                                                      'start_date' => Carbon::now()
                                                                          ->subDays(2)
                                                                          ->toDateTimeString(),
                                                                      'expiration_date' => Carbon::now()
                                                                          ->addMonths(6)
                                                                          ->toDateTimeString(),
                                                                      'created_on' => Carbon::now()
                                                                          ->subMonth(2)
                                                                          ->toDateTimeString(),
                                                                  ]);

        $response =
            $this->call('GET', 'railcontent/content/get-by-ids', ['ids' => $content2['id'].','.$content1['id']]);
        $expectedResults = [(array)$content2, (array)$content1];

        $this->assertArraySubset(
            $expectedResults,
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_all_content()
    {
        for ($i = 1; $i < 15; $i++) {
            $courses[] = $this->contentFactory->create(
                $this->faker->word,
                'course',
                ContentService::STATUS_PUBLISHED
            );
        }

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'lesson',
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call('GET', 'api/railcontent/all', [
                                         'included_types' => ['course'],
                                         'statuses' => ['published', 'scheduled'],
                                         'sort' => 'published_on',
                                         'brand' => config('railcontent.brand'),
                                         'limit' => 10,
                                     ]

        );
        $results =
            $response->decodeResponseJson()
                ->json('data');

        $this->assertTrue(count($results) <= 10);

        foreach ($results as $result) {
            $this->assertEquals('course', $result['type']);
            $this->assertTrue(in_array($result['status'], ['published', 'scheduled']));
            $this->assertEquals($result['brand'], config('railcontent.brand'));
        }
    }

    public function _test_our_picks()
    {
        $statues = ['published'];
        $types = ['course'];
        $page = 1;
        $limit = 10;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit,
            'status' => 'ok',
            'code' => 200,
        ];

        $nrCourses = 30;

        //create courses
        for ($i = 1; $i < $nrCourses; $i++) {
            $content = $this->contentFactory->create(
                $this->faker->word,
                $types[0],
                $this->faker->randomElement($statues)
            );
            $contents[$i] = (array)$content;
        }

        for ($i = 1; $i < $nrCourses; $i++) {
            $field = $this->fieldFactory->create($contents[$i]['id'], 'staff_pick_rating', rand(1, 30), null, 'string');
        }

        $response = $this->call('GET', 'api/railcontent/our-picks', [
            'page' => $page,
            'limit' => $limit,
            'included_types' => $types,
        ]);

        $responseContent =
            $response->decodeResponseJson()
                ->json('data');

        $previousValue = 0;

        foreach ($responseContent as $result) {
            $this->assertTrue(
                (($result['fields'][0]['key'] == 'staff_pick_rating') && ($result['fields'][0]['value'] <= 20))
            );
            $this->assertTrue($result['fields'][0]['value'] >= $previousValue);
            $previousValue = $result['fields'][0]['value'];
        }
    }

    public function _test_total_xp()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            'course',
            'published',
            $this->faker->word,
            null,
            null,
            Carbon::now()
                ->toDateTimeString()
        );

        $this->assertEquals($content['total_xp'], config('xp_ranks.course_content_completed'));

        for ($i = 0; $i < 5; $i++) {
            $courseParts[] = $this->contentFactory->create(
                $this->faker->word,
                'course-part',
                'published',
                $this->faker->word,
                null,
                null,
                Carbon::now()
                    ->toDateTimeString(),
                $content['id']
            );
        }

        for ($i = 0; $i < 5; $i++) {
            $assignments[] = $this->contentFactory->create($this->faker->word, 'assignment');
        }

        foreach ($assignments as $index => $assignment) {
            $this->contentHierarchyFactory->create($courseParts[$index]['id'], $assignment['id']);
        }

        $response = $this->call('GET', 'railcontent/content/'.$content['id']);

        $assignmentsTotalXp = 0;
        $coursePartTotalXp = 0;

        foreach ($assignments as $assignment) {
            $assignmentsTotalXp += $assignment->fetch(
                'fields.xp',
                config('xp_ranks.assignment_content_completed')
            );
        }

        foreach ($courseParts as $index => $coursePart) {
            $coursePartTotalXp += config('xp_ranks.difficulty_xp_map.all') + $assignments[$index]->fetch(
                    'fields.xp',
                    config('xp_ranks.assignment_content_completed')
                );
        }

        $courseTotalXP = $content->fetch(
            'fields.xp',
            config('xp_ranks.course_content_completed')
        );

        $this->assertEquals($assignmentsTotalXp, 5 * config('xp_ranks.assignment_content_completed'));
        $this->assertEquals(
            $courseTotalXP + $coursePartTotalXp,
            $response->decodeResponseJson()
                ->json('data')[0]['total_xp']
        );
    }

    public function _test_total_xp_calculation_when_difficulty_change()
    {
        $difficulty = 3;

        $content = $this->contentFactory->create();

        $this->assertEquals($content['total_xp'], config('xp_ranks.difficulty_xp_map.all'));

        $this->fieldFactory->create($content['id'], 'difficulty', $difficulty);

        $response = $this->call('GET', 'railcontent/content/'.$content['id']);

        $this->assertEquals(
            $response->decodeResponseJson()
                ->json('data')[0]['total_xp'],
            config('xp_ranks.difficulty_xp_map.'.$difficulty)
        );
    }

    public function _test_total_xp_calculation_when_delete_child()
    {
        $content = $this->contentFactory->create();
        $children = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->word,
            'published',
            $this->faker->word,
            null,
            null,
            Carbon::now()
                ->toDateTimeString(),
            $content['id']
        );

        $this->contentHierarchyService->delete($content['id'], $children['id']);

        $response2 = $this->call('GET', 'railcontent/content/'.$content['id']);

        $this->assertEquals(
            $response2->decodeResponseJson('data')[0]['total_xp'],
            config('xp_ranks.difficulty_xp_map.all')
        );
    }

    public function test_follow_content()
    {
        $content = $this->contentFactory->create();

        $loggedInUserId = $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/follow/', ['content_id' => $content['id']]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            $response->decodeResponseJson()
                ->json('data')[0]['content_id'],
            $content['id']
        );
        $this->assertEquals(
            $response->decodeResponseJson()
                ->json('data')[0]['user_id'],
            $loggedInUserId
        );
    }

    public function test_follow_content_validation()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/follow/', ['content_id' => rand()]);

        $this->assertEquals(422, $response->status());
        $errors = [
            [
                'source' => "content_id",
                "detail" => "The selected content id is invalid.",
            ],
        ];
        $this->assertEquals(
            $errors,
            $response->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_unfollow_content()
    {
        $content = $this->contentFactory->create();
        $loggedInUserId = $this->createAndLogInNewUser();

        $follow1 = [
            'content_id' => $content['id'],
            'user_id' => $loggedInUserId,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableContentFollows)
            ->insertGetId($follow1);

        $response = $this->call('PUT', 'railcontent/unfollow/', ['content_id' => $content['id']]);

        $this->assertEquals(204, $response->status());
        $this->assertDatabaseMissing(ConfigService::$tableContentFollows, [
            'content_id' => $content['id'],
            'user_id' => $loggedInUserId,
        ]);
    }

    public function test_unfollow_content_validation()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/unfollow/', ['content_id' => rand()]);

        $this->assertEquals(422, $response->status());
        $errors = [
            [
                'source' => "content_id",
                "detail" => "The selected content id is invalid.",
            ],
        ];
        $this->assertEquals(
            $errors,
            $response->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_get_followed_content()
    {
        $userId = $this->createAndLogInNewUser();

        $content1 = $this->contentFactory->create($this->faker->word, 'coach', 'published');
        $content2 = $this->contentFactory->create($this->faker->word, 'coach', 'published');
        $content3 = $this->contentFactory->create($this->faker->word, 'coach', 'published');

        $follow1 = [
            'content_id' => $content1['id'],
            'user_id' => $userId,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableContentFollows)
            ->insertGetId($follow1);

        $follow2 = [
            'content_id' => $content2['id'],
            'user_id' => $userId,
            'created_on' => Carbon::now()
                ->subDays(1)
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableContentFollows)
            ->insertGetId($follow2);

        $follow3 = [
            'content_id' => $content3['id'],
            'user_id' => $userId,
            'created_on' => Carbon::now()
                ->subDays(2)
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableContentFollows)
            ->insertGetId($follow3);

        $response = $this->call('GET', 'api/railcontent/followed-content/');

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            3,
            $response->decodeResponseJson()
                ->json('meta')['totalResults']
        );
        $this->assertEquals(
            [$content1->getArrayCopy(), $content2->getArrayCopy(), $content3->getArrayCopy()],
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_get_newest_lessons_for_followed_content()
    {
        $userId = $this->createAndLogInNewUser();

        $content1 = $this->contentFactory->create($this->faker->word, 'course', 'published');

        $slug = $this->faker->word;
        $instructor = $this->contentFactory->create($slug, 'instructor', 'published');

        $coach = $this->contentFactory->create($slug, 'coach', 'published');

        $follow1 = [
            'content_id' => $instructor['id'],
            'user_id' => $userId,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableContentFollows)
            ->insertGetId($follow1);

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructor['id'],
            'type' => 'content_id',
        ];

        $this->fieldFactory->create(
            $content1['id'],
            $fieldInstructor['key'],
            $fieldInstructor['value'],
            1,
            $fieldInstructor['type']
        );

        $response = $this->call('GET', 'railcontent/followed-lessons');

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            1,
            $response->decodeResponseJson()
                ->json('meta')['totalResults']
        );
        $this->assertArraySubset(
            [$content1->getArrayCopy()],
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    public function test_sort_contents_by_popularity()
    {
        $this->createAndLogInNewUser();

        $content11 = [
            'slug' => ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'type' => 'course',
            'status' => ContentService::STATUS_PUBLISHED,

            'language' => 'en-US',
            'brand' => ConfigService::$brand,
            'created_on' => Carbon::now()
                ->subDays(1),
            'published_on' => Carbon::now(),
            'popularity' => 0,
        ];

        $content1 =
            $this->query()
                ->table(ConfigService::$tableContent)
                ->insertGetId($content11);

        $this->elasticService->syncDocument($content1);

        $content12 = [
            'slug' => ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'type' => 'course',
            'status' => ContentService::STATUS_PUBLISHED,

            'language' => 'en-US',
            'brand' => ConfigService::$brand,
            'created_on' => Carbon::now()
                ->subDays(1),
            'published_on' => Carbon::now(),
            'popularity' => 4,
        ];

        $content122 =
            $this->query()
                ->table(ConfigService::$tableContent)
                ->insertGetId($content12);

        $this->elasticService->syncDocument($content122);

        $content13 = [
            'slug' => ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'type' => 'course',
            'status' => ContentService::STATUS_PUBLISHED,
            'language' => 'en-US',
            'brand' => ConfigService::$brand,
            'created_on' => Carbon::now()
                ->subDays(2),
            'published_on' => Carbon::now(),
            'popularity' => 5,
        ];

        $content113 =
            $this->query()
                ->table(ConfigService::$tableContent)
                ->insertGetId($content13);

        $this->elasticService->syncDocument($content113);

        sleep(1);

        $response = $this->call('GET', 'railcontent/content', [
            'included_types' => ['course'],
            'statuses' => ['published'],
            'sort' => '-popularity',
            'brand' => config('railcontent.brand'),
            'limit' => 10,
        ]);

        $this->assertEquals(
            3,
            $response->decodeResponseJson()
                ->json('meta')['totalResults']
        );

        $firstPopularity =
            $response->decodeResponseJson()
                ->json('data')[0]['popularity'];
        $secondPopularity =
            $response->decodeResponseJson()
                ->json('data')[1]['popularity'];
        $thirdPopularity =
            $response->decodeResponseJson()
                ->json('data')[2]['popularity'];

        $this->assertTrue($firstPopularity > $secondPopularity);
        $this->assertTrue($secondPopularity > $thirdPopularity);
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }
}
