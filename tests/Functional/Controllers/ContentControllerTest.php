<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PlaylistsService;
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

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
    }

    public function show()
    {
        $content = $this->contentFactory->create();

//        dd($content);
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'railcontent/content', [
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
        $response = $this->post('railcontent/content', [], ['Accept' => 'application/json']);

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        $this->assertEquals(2, count(json_decode($response->content(), true)));

        //check that all the error messages are received
        $this->assertArrayHasKey('status', json_decode($response->content(), true));
        $this->assertArrayHasKey('type', json_decode($response->content(), true));

    }

    public function test_store_with_negative_position()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'railcontent/content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'position' => -1
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        $this->assertEquals(1, count(json_decode($response->content(), true)));

        //the position should be positive value; check that the error message id received
        $this->assertArrayHasKey('position', json_decode($response->content(), true));
    }

    public function test_store_with_custom_validation_and_slug_huge()
    {
        $slug = $this->faker->text(500);
        $type = array_keys(ConfigService::$validationRules[ConfigService::$brand]);
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'railcontent/content', [
            'slug' => $slug,
            'status' => $status,
            'type' => $this->faker->randomElement($type),
            'position' => 1
        ]);

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        $this->assertEquals(1, count(json_decode($response->content(), true)));

        //check that all the error messages are received
        $this->assertArrayHasKey('slug', json_decode($response->content(), true));
    }

    public function test_store_published_on_not_required()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call('POST', 'railcontent/content', [
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

        $response = $this->call('POST', 'railcontent/content', [
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

        $content = $this->serviceBeingTested->create($slug, $status, $type, $position, null, $parentId);

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
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage,
            'field_id' => null,
            'field_key' => null,
            'field_value' => null,
            'field_type' => null,
            'field_position' => null,
            'datum_id' => null,
            'datum_value' => null,
            'datum_key' => null,
            'datum_position' => null
        ];

        $this->assertEquals($expectedResult, $content);

    }

    public function test_update_response_status()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/content/'.$content['id'], [
            'slug' => $content['slug'],
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

        $response = $this->call('PUT', 'railcontent/content/'.rand(), [
            'slug' => $slug,
            'position' => 1,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $type
        ]);

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {

        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/content/'.$content['id'], [
            'position' => -1,
            'status' => $content['status'],
            'type' => $content['type']
        ]);

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());
        $this->assertEquals(1, count(json_decode($response->content(), true)));

        //check that position error messages is received
        $this->assertArrayHasKey('position', json_decode($response->content(), true));
    }

    public function test_update_not_pass_the_validation()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/content/'.$content['id']);

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());
        $this->assertEquals(2, count(json_decode($response->content(), true)));

        //check that status and type error messages are received
        $this->assertArrayHasKey('status', json_decode($response->content(), true));
        $this->assertArrayHasKey('type', json_decode($response->content(), true));
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

        $content = $this->contentFactory->create();

        $new_slug = implode('-', $this->faker->words());
        $response = $this->call('PUT', 'railcontent/content/'.$content['id'],
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
                'id' => $content['id'],
                'slug' => $new_slug,
                'position' => 1,
                'status' => ContentService::STATUS_DRAFT,
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

        // $contentId = $this->createContent($content);

        $content = $this->contentFactory->create();

        $new_slug = implode('-', $this->faker->words());
        $updatedContent = $this->serviceBeingTested->update(
            $content['id'],
            $new_slug,
            $content['status'],
            $content['type'],
            $content['position'],
            ConfigService::$defaultLanguage,
            null,
            $content['published_on'],
            null
        );

        $content['slug'] = $new_slug;
        $content['position'] = 1;

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

        $this->assertFalse($delete);
    }

    public function test_controller_delete_method_response_status()
    {
        $content = $this->contentFactory->create();

        $response = $this->call('DELETE', 'railcontent/content/'.$content['id'], ['deleteChildren' => 1]);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $content['id'],
            ]
        );
    }

    public function test_delete_missing_content_response_status()
    {
        $response = $this->call('DELETE', 'railcontent/content/1', ['deleteChildren' => 0]);

        $this->assertEquals(404, $response->status());
    }

    public function test_can_not_delete_content_linked()
    {
        $content = $this->contentFactory->create();
        $contentId = $content['id'];

        $content2 = $this->contentFactory->create();
        $contentId2 = $content2['id'];

        // content linked
        $linkedContent = $this->contentFactory->create();
        $linkedContentId = $linkedContent['id'];

        $fieldKey = $this->faker->word;

        $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);

        $this->call('POST', 'railcontent/content/field', [
            'content_id' => $contentId2,
            'key' => $fieldKey,
            'value' => $linkedContentId,
            'type' => 'content_id',
            'position' => 2
        ]);
        $response = $this->call('DELETE', 'railcontent/content/'.$linkedContentId);

        $this->assertEquals('"This content is being referenced by other content ('.$contentId.', '.$contentId2.'), you must delete that content first."', $response->content());

        $this->assertEquals(404, $response->status());
    }

    public function test_index_response_no_results()
    {
        $response = $this->call('GET', 'railcontent/', [
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
        $page = 1;
        $limit = 10;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit
        ];

        //create courses
        for($i = 0; $i < 30; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $types[0],
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'brand' => ConfigService::$brand,
                'language' => ConfigService::$defaultLanguage
            ];
            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        //create library lessons
        $libraryLesson = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'library lesson',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];
        $libraryId = $this->query()->table(ConfigService::$tableContent)->insertGetId($libraryLesson);


        //we expect to receive only first 10 courses with status 'draft' or 'published'
        $expectedContent['items'] = array_slice($contents, 0, 10, true);
        $expectedContent['totalItems'] = count($expectedContent['items']);

        $response = $this->call('GET', 'railcontent/', [
            'page' => $page,
            'limit' => $limit,
            'order-by' => 'id',
            'order-direction' => 'asc',
            'types' => $types,
            'required-fields' => []
        ]);
        $responseContent = $response->content();

        $this->assertEquals($expectedContent, json_decode($responseContent, true));
    }

    public function test_index_with_required_fields()
    {
        $expectedResults = [];
        $statues = ['draft', 'published'];
        $types = ['course'];
        $page = 1;
        $limit = 10;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit
        ];

        //create courses
        for($i = 0; $i < 30; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $types[0],
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'brand' => ConfigService::$brand,
                'language' => ConfigService::$defaultLanguage
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => 'string',
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        for($i = 1; $i < 5; $i++) {
            $contentField = [
                'content_id' => $contents[$i]['id'],
                'field_id' => $fieldId
            ];

            $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);
            $expectedResults[$i] = $contents[$i];
            $expectedResults[$i]['fields'][] = array_merge($field, ['id' => $fieldId]);
        }
        $expectedContent['items'] = $expectedResults;
        $expectedContent['totalItems'] = count($expectedContent['items']);


        $response = $this->call('GET', 'railcontent/', [
            'page' => $page,
            'limit' => $limit,
            'types' => $types,
            'required-fields' => [$field['key'] => [$field['value']]]
        ]);
        $responseContent = $response->content();

        $this->assertEquals($expectedContent, json_decode($responseContent, true));
    }

    //Get 5 courses with given string field
    public function test_index_with_fields_and_datum()
    {
        $expectedResults = [];
        $statues = ['draft', 'published'];
        $types = ['course'];
        $page = 1;
        $limit = 5;

        $expectedContent = [
            'page' => $page,
            'limit' => $limit
        ];

        //create 30th courses
        for($i = 0; $i < 30; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => $types[0],
                'position' => $this->faker->numberBetween(),
                'parent_id' => null,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'brand' => ConfigService::$brand,
                'language' => ConfigService::$defaultLanguage
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
            $contents[$contentId] = array_merge(['id' => $contentId], $content);
        }

        //create the required field
        $field = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => 'string',
            'position' => $this->faker->numberBetween()
        ];

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId($field);

        //only first 5 courses have the required field associated
        for($i = 1; $i < 6; $i++) {
            $contentField = [
                'content_id' => $contents[$i]['id'],
                'field_id' => $fieldId
            ];

            $contentFieldId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);
            $expectedResults[$i] = $contents[$i];
            $expectedResults[$i]['fields'][] = array_merge($field, ['id' => $fieldId]);
        }

        $instructor = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'instructor',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];

        $instructorId = $this->query()->table(ConfigService::$tableContent)->insertGetId($instructor);

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructorId,
            'type' => 'content_id',
            'position' => $this->faker->numberBetween()
        ];

        $fieldInstructorId = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldInstructor);

        for($i = 1; $i < 7; $i++) {
            $contentField = [
                'content_id' => $contents[$i]['id'],
                'field_id' => $fieldInstructorId
            ];

            $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

            if(array_key_exists($i, $expectedResults)) {
                $expectedResults[$i]['fields'][] = array_merge($fieldInstructor, ['id' => $fieldInstructorId]);
            }
        }

        $datum = [
            'key' => $this->faker->word,
            'value' => $this->faker->word,
            'position' => $this->faker->numberBetween()
        ];

        $datumId = $this->query()->table(ConfigService::$tableData)->insertGetId($datum);

        for($i = 1; $i < 25; $i++) {
            $contentDatum = [
                'content_id' => $contents[$i]['id'],
                'datum_id' => $datumId
            ];

            $this->query()->table(ConfigService::$tableContentData)->insertGetId($contentDatum);

            if(array_key_exists($i, $expectedResults)) {
                $expectedResults[$i]['data'][] = array_merge($datum, ['id' => $datumId]);
            }
        }

        $expectedContent['items'] = $expectedResults;
        $expectedContent['totalItems'] = count($expectedContent['items']);

        $response = $this->call('GET', 'railcontent/', [
            'page' => $page,
            'limit' => $limit,
            'statues' => $statues,
            'types' => $types,
            'required-fields' => [$field['key'] => [$field['value']]],
            'parent_slug' => ''
        ]);
        $responseContent = $response->content();

        $this->assertEquals($expectedContent, json_decode($responseContent, true));
    }

    //Get first 10 lessons for the course with given instructor
    public function test_get_course_lesson_for_instructor()
    {
        $page = 1;
        $limit = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $instructorSlug = $this->faker->word;

        $requiredFields = [
            'instructor' => [$instructorSlug],
        ];

        $course1 = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];
        $courseId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($course1);

        $instructor = [
            'slug' => $instructorSlug,
            'status' => $this->faker->randomElement($statues),
            'type' => 'instructor',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];
        $instructorId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($instructor);

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructorId1,
            'type' => 'content_id'
        ];
        $fieldId1 = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldInstructor);

        $contentField = [
            'content_id' => $courseId1,
            'field_id' => $fieldId1
        ];

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        for($i = 0; $i < 25; $i++) {
            $content = [
                'slug' => $this->faker->word,
                'status' => $this->faker->randomElement($statues),
                'type' => 'course lesson',
                'position' => $this->faker->numberBetween(),
                'parent_id' => $courseId1,
                'published_on' => Carbon::now()->subDays(($i + 1) * 10)->toDateTimeString(),
                'created_on' => Carbon::now()->toDateTimeString(),
                'archived_on' => null,
                'brand' => ConfigService::$brand,
                'language' => ConfigService::$defaultLanguage
            ];

            $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
            $contents[$contentId] = array_merge($content, ['id' => $contentId]);
        }

        //Get the course lesson with instructor
        $expectedContent = array_slice($contents, 0, $limit, TRUE);

        $response = $this->call('GET', 'railcontent/', [
            'page' => $page,
            'limit' => $limit,
            'types' => ['course lesson'],
            'required-fields' => $requiredFields,
            'order-by' => $orderByColumn,
            'order-direction' => $orderByDirection
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results['items']);
    }

    //get courses from my playlist with given name and with given instructor
    public function test_pull_lessons_from_playlist_with_instructor()
    {
        $page = 1;
        $limit = 10;
        $orderByDirection = 'asc';
        $orderByColumn = 'id';
        $statues = [$this->faker->word, $this->faker->word, $this->faker->word];
        $parentId = null;
        $instructorSlug = $this->faker->word;

        $requiredFields = [
            'instructor' => [$instructorSlug],
        ];

        $course1 = [
            'slug' => $this->faker->word,
            'status' => $this->faker->randomElement($statues),
            'type' => 'course',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];
        $courseId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($course1);

        $instructor = [
            'slug' => $instructorSlug,
            'status' => $this->faker->randomElement($statues),
            'type' => 'instructor',
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => Carbon::now()->subDays(10)->toDateTimeString(),
            'created_on' => Carbon::now()->toDateTimeString(),
            'brand' => ConfigService::$brand,
            'language' => ConfigService::$defaultLanguage
        ];
        $instructorId1 = $this->query()->table(ConfigService::$tableContent)->insertGetId($instructor);

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructorId1,
            'type' => 'content_id'
        ];
        $fieldId1 = $this->query()->table(ConfigService::$tableFields)->insertGetId($fieldInstructor);

        $contentField = [
            'content_id' => $courseId1,
            'field_id' => $fieldId1
        ];

        $this->query()->table(ConfigService::$tableContentFields)->insertGetId($contentField);

        //create playlists
        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'brand' => ConfigService::$brand
        ];
        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        //add content to the playlist
        $userContent = [
            'content_id' => $courseId1,
            'user_id' => $this->createAndLogInNewUser(),
            'state' => UserContentService::STATE_ADDED_TO_LIST,
            'progress' => $this->faker->numberBetween(1, 99)
        ];
        $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $userContentPlaylist = [
            'content_user_id' => $userContentId,
            'playlist_id' => $playlistId
        ];
        $userContentPlaylistId = $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userContentPlaylist);

        $expectedContent[$courseId1] = array_merge($course1,[
            'id' => $courseId1,
            'fields' => [array_merge($fieldInstructor,['id' => $fieldId1,'position' => null])]]);

        $response = $this->call('GET', 'railcontent/', [
            'page' => $page,
            'limit' => $limit,
            'types' => ['course'],
            'required-fields' => $requiredFields,
            'playlists' => [$playlist['name']],
            'order-by' => $orderByColumn,
            'order-direction' => $orderByDirection
        ]);

        $results = json_decode($response->content(), true);

        $this->assertEquals($expectedContent, $results['items']);
    }


    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }
}