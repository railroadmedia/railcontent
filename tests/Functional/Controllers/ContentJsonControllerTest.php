<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class ContentJsonControllerTest extends RailcontentTestCase
{
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

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
    }

    public function test_index_empty()
    {
        $response = $this->call('GET', 'railcontent/content');

        $this->assertEquals(
            [
                "status" => "ok",
                "code" => 200,
                "page" => 1,
                "limit" => 10,
                "total_results" => 0,
                "results" => [],
                "filter_options" => []
            ],
            $response->json()
        );
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'position' => null,
                'status' => $status,
                'parent_id' => null,
                'type' => $type
            ]
        );

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
                "detail" => "The type field is required."
            ]
        ];
        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);

    }

    public function test_store_with_negative_position()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => -1
            ]
        );

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "position",
                "detail" => "The position must be at least 0."
            ]

        ];
        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
    }

    public function test_store_with_custom_validation_and_slug_huge()
    {
        $slug = $this->faker->text(500);
        $type = array_keys(ConfigService::$validationRules[ConfigService::$brand]);
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $this->faker->randomElement($type),
                'position' => 1
            ]
        );

        $this->assertEquals(422, $response->status());

        $errors = [
            [
                'source' => "slug",
                "detail" => "The slug may not be greater than 64 characters."
            ]

        ];
        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
    }

    public function test_store_published_on_not_required()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position
            ]
        );

        //expecting that the response has a successful status code
        $response->assertSuccessful();
    }

    public function test_content_created_is_returned_in_json_format()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_PUBLISHED;
        $publishedOn = Carbon::now()->toDateTimeString();

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position,
                'auth_level' => 'administrator',
                'published_on' => $publishedOn
            ]
        );

        $expectedResults = $this->createExpectedResult('ok', 201, [
            0 =>
                [
                    'id' => '1',
                    'slug' => $slug,
                    'brand' => ConfigService::$brand,
                    'language' => ConfigService::$defaultLanguage,
                    'status' => $status,
                    'type' => $type,
                    'created_on' => Carbon::now()->toDateTimeString(),
                    'published_on' => $publishedOn,
                    'archived_on' => null,
                    'parent_id' => null,
                    'fields' => [],
                    'data' => [],
                    'permissions' => [],
                    'child_id' => null,
                    'sort' => 0,
                ]
        ]);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());


    }

    public function test_content_service_return_new_content_after_create()
    {

        $content = $this->contentFactory->create();

        $response = $this->call('GET', 'railcontent/content/' . $content['id']);

        $this->assertEquals(
            [
                "status" => "ok",
                "code" => 200,
                "results" => [0 => $content]
            ],
            $response->json()
        );
    }

    public function test_update_response_status()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => 1,
                'limit' => 10,
                'sort' => 'id',
                'statuses' => [ContentService::STATUS_PUBLISHED]
            ]
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content['id'],
            [
                'slug' => $content['slug'],
                'status' => ContentService::STATUS_PUBLISHED,
                'type' => $this->faker->word
            ]
        );

        $this->assertEquals(201, $response->status());
    }

    public function test_update_missing_content_response_status()
    {
        $slug = implode('-', $this->faker->words());
        $type = $this->faker->word;

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . rand(),
            [
                'slug' => $slug,
                'position' => 1,
                'status' => ContentService::STATUS_DRAFT,
                'type' => $type
            ]
        );

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {

        $content = $this->contentFactory->create();

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content['id'],
            [
                'position' => -1,
                'status' => $content['status'],
                'type' => $content['type']
            ]
        );

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());
        //check that the error message is received
        $errors = [
            [
                'source' => "position",
                "detail" => "The position must be at least 0."
            ]
        ];
        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
    }

    public function test_update_not_pass_the_validation()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('PATCH', 'railcontent/content/' . $content['id'], [
            'status' => $this->faker->word
        ]);

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "status",
                "detail" => "The selected status is invalid."
            ]
        ];
        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
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

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $new_slug = implode('-', $this->faker->words());

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content['id'],
            [
                'slug' => $new_slug,
                'status' => ContentService::STATUS_PUBLISHED,
                'type' => $content['type']
            ]
        );

        $response->assertJsonStructure(
            [
                "status",
                "code",
                "results" => ['id',
                    'slug',
                    'status',
                    'type',
                    'published_on',
                    'created_on',
                ]
            ]
        );

        $response->assertJson(
            [
                'status' => 'ok',
                'code' => 201,
                'results' => [
                    'id' => $content['id'],
                    'slug' => $new_slug,
                    'status' => ContentService::STATUS_PUBLISHED,
                    'type' => $content['type'],
                    'created_on' => Carbon::now()->toDateTimeString(),
                    'sort' => 0,
                ]
            ]
        );
    }

    public function test_content_service_return_updated_content_after_update()
    {
        $content = $this->contentFactory->create();

        $new_slug = implode('-', $this->faker->words());
        $updatedContent = $this->serviceBeingTested->update(
            $content['id'],
            [
                "slug" => $new_slug,
                "status" => $content['status'],
                "type" => $content['type'],
                "language" => ConfigService::$defaultLanguage,
                "published_on" => $content['published_on']
            ]
        );

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

        $response = $this->call('DELETE', 'railcontent/content/' . $content['id']);

        $this->assertEquals(204, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $content['id'],
            ]
        );
    }

    public function test_delete_missing_content_response_status()
    {
        $randomId = $this->faker->numberBetween();
        $response = $this->call('DELETE', 'railcontent/content/' . $randomId);

        $this->assertEquals(404, $response->status());
        $this->assertEquals('Entity not found.', json_decode($response->getContent())->error->title, true);
        $this->assertEquals('Delete failed, content not found with id: ' . $randomId, json_decode($response->getContent())->error->detail, true);
    }

    public function test_index_response_no_results()
    {
        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => 1,
                'amount' => 10,
                'statues' => ['draft', 'published'],
                'types' => ['course'],
                'fields' => [],
                'parent_slug' => '',
                'include_future_published_on' => false
            ]
        );

        $expectedResults = [];

        $this->assertEquals(200, $response->status());

        $response->assertJson($expectedResults);
    }

    public function test_index_with_results()
    {
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
            'filter_options' => $filter
        ];

        //create courses
        $nrCourses = 30;

        for ($i = 0; $i < $nrCourses; $i++) {
            $content = $this->contentFactory->create(
                $this->faker->word,
                $types[0],
                $this->faker->randomElement($statues));
            $contents[$i] = $content;
        }

        //create library lessons
        $libraryLesson = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'library lesson',
            'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];
        $libraryId = $this->query()->table(ConfigService::$tableContent)->insertGetId($libraryLesson);

        //we expect to receive only first 10 courses with status 'draft' or 'published'
        $expectedContent['results'] = array_slice($contents, 0, $limit, true);
        $expectedContent['total_results'] = $nrCourses;

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types
            ]
        );
        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types
            ]
        );
        $responseContent = $response->decodeResponseJson();
        $this->assertEquals($expectedContent, $responseContent);

    }

    public function test_index_with_required_fields()
    {
        $expectedResults = [];
        $statues = ['published'];
        $types = ['course'];
        $page = 1;
        $limit = 10;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit,
            'status' => 'ok',
            'code' => 200
        ];

        $nrCourses = 30;

        //create courses
        for ($i = 0; $i < $nrCourses; $i++) {
            $content = $this->contentFactory->create(
                $this->faker->word,
                $types[0],
                $this->faker->randomElement($statues));
            $contents[$i] = $content;
        }

        $contentWithFieldsNr = 5;
        $fieldKey = $this->faker->word;
        $fieldValue = $this->faker->text();
        $fieldType = 'string';

        $filter = [$fieldKey . ',' . $fieldValue . ',' . $fieldType];
        $expectedContent['filter_options'] = [];

        for ($i = 1; $i < $contentWithFieldsNr; $i++) {
            $field = $this->fieldFactory->create($contents[$i]['id'], $fieldKey, $fieldValue, null, $fieldType);

            $expectedResults[$i - 1] = $contents[$i];
            $expectedResults[$i - 1]['fields'][] = array_merge($field, ['id' => $field['id']]);
        }
        $expectedContent['results'] = $expectedResults;
        $expectedContent['total_results'] = $contentWithFieldsNr - 1;

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
                'filter' => ['required_fields' => $filter]
            ]
        );
        $responseContent = $response->decodeResponseJson();

        $this->assertEquals($expectedContent['results'], $responseContent['results']);
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
            'code' => 200
        ];

        //create 30th courses
        for ($i = 0; $i < 30; $i++) {
            $content = $this->contentFactory->create($this->faker->word, $types[0]);
            $contents[$content['id']] = $content;
        }

        //create the required field
        $requiredField = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => 'string'
        ];

        //only first 5 courses have the required field associated
        for ($i = 1; $i < 6; $i++) {
            $field = $this->fieldFactory->create($contents[$i]['id'], $requiredField['key'], $requiredField['value'], null, $requiredField['type']);

            $expectedResults[$i - 1] = $contents[$i];
            $expectedResults[$i - 1]['fields'][] = $field;
        }

        $instructor = $this->contentFactory->create($this->faker->word, 'instructor', $this->faker->randomElement($statues));

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructor['id'],
            'type' => 'content_id'
        ];

        for ($i = 1; $i < 7; $i++) {
            $contentField = $this->fieldFactory->create($contents[$i]['id'], $fieldInstructor['key'], $fieldInstructor['value'], null, $fieldInstructor['type']);
            $contentField['type'] = 'content';
            $contentField['value'] = $instructor;
            if (array_key_exists(($i - 1), $expectedResults)) {
                $expectedResults[$i - 1]['fields'][] = $contentField;

            }
        }

        for ($i = 1; $i < 25; $i++) {
            $datum = $this->contentDatumFactory->create($contents[$i]['id']);

            if (array_key_exists(($i - 1), $expectedResults)) {
                $expectedResults[$i - 1]['data'][] = $datum;
            }
        }

        $expectedContent['results'] = $expectedResults;
        $expectedContent['total_results'] = count($expectedContent['results']);
        $expectedContent['filter_options'] = [$fieldInstructor['key'] => [$instructor]];

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'statues' => $statues,
                'sort' => 'id',
                'included_types' => $types,
                'filter' => [
                    'required_fields' =>
                        [
                            $requiredField['key'] . ',' . $requiredField['value'] . ',' . $requiredField['type'],
                            $fieldInstructor['key'] . ',' . $fieldInstructor['value'] . ',' . $fieldInstructor['type']
                        ]
                ],
                'parent_slug' => ''
            ]
        );
        $responseContent = $response->decodeResponseJson();

        $this->assertEquals($expectedContent, $responseContent);
    }

    public function test_getByParentId_when_parentId_not_exist()
    {
        $response = $this->call(
            'GET',
            'railcontent/content/parent/' . rand()
        );

        $this->assertEquals([], $response->decodeResponseJson()['results']);
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
            'railcontent/content/parent/' . $parent['id']
        );

        $this->assertEquals(2, count($response->decodeResponseJson()['results']));

        $expectedResults = [$firstChild['id'] => $firstChild,
            $secondChild['id'] => $secondChild];
        $this->assertEquals($expectedResults, $response->decodeResponseJson()['results']);
    }

    public function test_get_by_ids_when_ids_not_exists()
    {
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids', [rand(), rand()]
        );

        $this->assertEquals([], $response->decodeResponseJson()['results']);
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

        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids', ['ids' => $content2['id'] . ',' . $content1['id']]
        );
        $expectedResults = [
            $content2['id'] => $content2,
            $content1['id'] => $content1
        ];

        $this->assertEquals($expectedResults, $response->decodeResponseJson()['results']);
    }

    public function test_get_id_cached()
    {
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $start1 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $content1['id']);
        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $content1['id']);
        $time2 = microtime(true) - $start2;

        $start3 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $content1['id']);
        $time3 = microtime(true) - $start3;

        $start4 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $content1['id']);
        $time4 = microtime(true) - $start4;

        $start5 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $content1['id']);
        $time5 = microtime(true) - $start5;

        $start6 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids', [$content1['id']]
        );
        $time6 = microtime(true) - $start6;

        $start7 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids', [$content1['id']]
        );
        $time7 = microtime(true) - $start7;

        $response->assertStatus(200);
    }

    public function test_store_content_execution_time()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        //prepare Redis cache with 300.000 keys that will be deleted when a new content it's created
        for($i = 0; $i< 100000; $i++)
        {
            Redis::set('contents_results_'.$i,$i);
            Redis::set('_type_'.$type.$i,$i);
            Redis::set('types'.$i, $i);
        }

        $executionStartTime = microtime(true);

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'position' => null,
                'status' => $status,
                'parent_id' => null,
                'type' => $type
            ]
        );
        $executionEndTime = microtime(true);

        //The result will be in seconds and milliseconds.
        $seconds = $executionEndTime - $executionStartTime;

        //Print it out
        echo "Create content method(inclusive clear Redis cache) took $seconds seconds to execute when in Redis cache exists 300.000 keys that should be deleted.";

        $this->assertEquals(201, $response->status());
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }
}