<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\OldStructure;

use Carbon\Carbon;
use Doctrine\DBAL\Logging\DebugStack;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class ContentJsonControllerOldStructureTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);
        ResponseService::$oldResponseStructure = true;
    }

    public function test_index_empty()
    {
        $response = $this->call('GET', 'railcontent/content');

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $status = ContentService::STATUS_PUBLISHED;
        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'position' => null,
                'status' => $status,
                'parent_id' => null,
                'type' => $type,
                'published_on' => Carbon::now()
                    ->toDateTimeString(),
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
                'source' => "status",
                "detail" => "The status field is required.",
            ],
            [
                'source' => "type",
                "detail" => "The type field is required.",
            ],
        ];
        $this->assertEquals($errors, $response->decodeResponseJson('meta')['errors']);
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
                'position' => -1,
            ]
        );

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "position",
                "detail" => "The position must be at least 0.",
            ],
        ];
        $this->assertEquals($errors, $response->decodeResponseJson('meta')['errors']);
    }

    public function test_store_published_on_not_required()
    {
        $slug = $this->faker->word;
        $type = $this->faker->word;
        $position = $this->faker->numberBetween();
        $status = ContentService::STATUS_DRAFT;
        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = [ContentService::STATUS_DRAFT];
        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position,
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
        $publishedOn =
            Carbon::now()
                ->toDateTimeString();
        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'status' => $status,
                'type' => $type,
                'position' => $position,
                'auth_level' => 'administrator',
                'published_on' => $publishedOn,
            ]
        );
        $expectedResults = [
            'id' => '1',
            'slug' => $slug,
            'brand' => config('railcontent.brand'),
            'language' => config('railcontent.default_language'),
            'status' => $status,
            'type' => $type,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'published_on' => $publishedOn,
            'archived_on' => null,
            'parent_id' => null,
            'fields' => [],
            'child_id' => null,
            'sort' => 0,
            'completed' => false,
            'started' => false,
            'progress_percent' => 0,

        ];
        $this->assertEquals($expectedResults, $response->decodeResponseJson('data'));
    }

    public function test_content_service_return_new_content_after_create()
    {
        $content = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $response = $this->call('GET', 'railcontent/content/' . $content[0]->getId());

        // assert the user data is subset of response
        $this->assertArraySubset(
            [
                'slug' => 'slug1',
            ],
            $response->decodeResponseJson()['data']
        );
    }

    public function test_update_response_status()
    {
        $content = $this->fakeContent();

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'slug' => $content[0]->getSlug(),
                'status' => ContentService::STATUS_PUBLISHED,
                'type' => $this->faker->word,
            ]
        );

        $this->assertEquals(200, $response->status());
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
                'type' => $type,
            ]
        );

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {
        $content = $this->fakeContent();

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'position' => -1,
            ]
        );

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());
        //check that the error message is received
        $errors = [
            [
                'source' => "position",
                "detail" => "The position must be at least 0.",
            ],
        ];
        $this->assertEquals($errors, $response->decodeResponseJson('meta')['errors']);
    }

    public function test_update_not_pass_the_validation()
    {
        $content = $this->fakeContent();

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'status' => $this->faker->word,
            ]
        );

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => "status",
                "detail" => "The selected status is invalid.",
            ],
        ];
        $this->assertEquals($errors, $response->decodeResponseJson('meta')['errors']);
    }

    public function test_after_update_content_is_returned_in_json_format()
    {
        $content = $this->fakeContent(
            1,
            [
                'difficulty' => 1,
                'slug' => 'test 1',
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => 'topic1',
                'position' => 1,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            12,
            [
                'content' => $content[0],
                'topic' => 'topic3',
                'position' => 2,
            ]
        );

        $instructors = $this->fakeContent(
            2,
            [
                'type' => 'instructor',
                'status' => 'published',
                'slug' => $this->faker->name,
                'brand' => config('railcontent.brand'),
            ]
        );

        $contentInstructor = $this->fakeContentInstructor(
            1,
            [
                'content' => $content[0],
                'instructor' => $instructors[0],
            ]
        );

        $new_slug = implode('-', $this->faker->words());

        $first = $this->call('GET', 'railcontent/content/' . $content[0]->getId());

        $this->assertEquals($content[0]->getSlug(), $first->decodeResponseJson('data')['slug']);

        //assert cache exist
        $this->assertTrue(
            $this->entityManager->getCache()
                ->containsEntity(Content::class, $content[0]->getId())
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'slug' => $new_slug,
                'status' => ContentService::STATUS_PUBLISHED,
            ]
        );

        $this->assertArraySubset(
            [
                'id' => $content[0]->getId(),
                'slug' => $new_slug,
                'status' => ContentService::STATUS_PUBLISHED,
                'type' => $content[0]->getType(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $response->decodeResponseJson('data')
        );

        //assert cache was inactivated
        $this->assertFalse(
            $this->entityManager->getCache()
                ->containsEntity(Content::class, $content[0]->getId())
        );
    }

    public function test_controller_delete_method_response_status()
    {
        $content = $this->fakeContent();

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => $this->faker->word,
                'position' => 1,
            ]
        );

        $this->fakeContentPermission(
            1,
            [
                'content' => $content[0],
                'permission' => $this->fakePermission()[0],
            ]
        );

        $this->fakeComment(
            5,
            [
                'content' => $content[0],
                'comment' => $this->faker->paragraph,
            ]
        );

        $id = $content[0]->getId();
        $response = $this->call('DELETE', 'railcontent/content/' . $id);

        $this->assertEquals(204, $response->status());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content',
            [
                'id' => 1,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_topics',
            [
                'content_id' => $id,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'comments',
            [
                'content_id' => $id,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_permissions',
            [
                'content_id' => $id,
            ]
        );
    }

    public function test_delete_missing_content_response_status()
    {
        $randomId = $this->faker->numberBetween();
        $response = $this->call('DELETE', 'railcontent/content/' . $randomId);

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function test_index_response_no_results()
    {
        $randomContents = $this->fakeContent(12);

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
                'include_future_published_on' => false,
            ]
        );

        $expectedResults = [];

        $this->assertEquals(200, $response->status());

        $response->assertJson($expectedResults);
    }

    public function test_index_with_results()
    {
        $userId = $this->createAndLogInNewUser();
        $permission = $this->fakePermission(2);

        $content = $this->fakeContent(
            3,
            [
                'difficulty' => 1,
                'type' => 'course',
                'status' => 'published',
                'publishedOn' => Carbon::now(),

            ]
        );

        $otherContent = $this->fakeContent(12);
        $this->fakeUserPermission(
            1,
            [
                'userId' => $userId,
                'permission' => $permission[0],
                'startDate' => Carbon::now(),
                'expirationDate' => Carbon::now()
                    ->addMinute(10),
            ]
        );

        $this->fakeUserPermission(
            1,
            [
                'userId' => $userId,
                'permission' => $permission[1],
                'startDate' => Carbon::now(),
                'expirationDate' => Carbon::now()
                    ->addDays(10),
            ]
        );

        $types = ['course'];
        $page = 1;
        $limit = 10;
        $filter = ['difficulty,1'];

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
                'required_fields' => $filter,
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        foreach ($responseContent as $content) {
            $this->assertTrue(in_array($content['type'], $types));
        }
    }

    public function test_index_with_required_fields()
    {
        $statues = ['published', 'scheduled'];
        $types = ['course', 'course-part'];
        $page = 1;
        $limit = 10;

        $contentWithFieldsNr = 5;
        $fieldKey = 'difficulty';
        $fieldValue = 1;
        $fieldType = 'integer';

        $filter = [$fieldKey . ',' . $fieldValue . ',' . $fieldType];
        $contents = $this->fakeContent(
            $contentWithFieldsNr,
            [
                $fieldKey => $fieldValue,
                'type' => $this->faker->randomElement($types),
                'status' => $this->faker->randomElement($statues),
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
                'required_fields' => $filter,
            ]

        );
        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals($contentWithFieldsNr, count($responseContent));

        foreach ($responseContent as $content) {
            $this->assertTrue(
                in_array(
                    [
                        'content_id' => $content['id'],
                        'key' => $fieldKey,
                        'value' => $fieldValue,
                        'position' => 1,
                    ],
                    $content['fields']
                )
            );
        }
    }

    //Get 5 courses with given string field
    public function test_index_with_fields_and_data()
    {
        $statues = ['published'];
        $types = ['course'];
        $page = 1;
        $limit = 5;

        $randomContents = $this->fakeContent(
            5,
            [
                'difficulty' => rand(1, 10),
                'type' => $this->faker->word,
                'status' => 'published',
            ]
        );
        $contents = $this->fakeContent(
            6,
            [
                'difficulty' => 1,
                'type' => 'course',
                'status' => 'published',
            ]
        );

        $instructor = $this->fakeContent(
            2,
            [
                'type' => 'instructor',
                'status' => 'published',
                'slug' => $this->faker->name,
                'brand' => config('railcontent.brand'),
                'difficulty' => null,
            ]
        );

        foreach ($contents as $content) {
            $contentInstructor = $this->fakeContentInstructor(
                1,
                [
                    'content' => $content,
                    'instructor' => $instructor[0],
                ]
            );
        }

        $randomContents = $this->fakeContent(
            19,
            [
                'difficulty' => rand(1, 10),
            ]
        );

        $data = $this->fakeContentData(
            1,
            [
                'content' => $contents[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 1,
            ]
        );

        $data = $this->fakeContentData(
            1,
            [
                'content' => $contents[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 2,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'statues' => $statues,
                'sort' => 'id',
                'included_types' => $types,
                'included_fields' => [
                    'difficulty,1',
                    'instructor,' . $instructor[0]->getId(),
                    'instructor,' . $instructor[1]->getId(),
                ],
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        foreach ($responseContent as $data) {
            $this->assertTrue(
                in_array(
                    [
                        'content_id' => $data['id'],
                        'key' => 'difficulty',
                        'value' => 1,
                        'position' => 1,
                    ],
                    $data['fields']
                )
            );
            $this->assertEquals($statues[0], $data['status']);
        }

        $this->assertArrayHasKey('filterOptions', $response->decodeResponseJson('meta'));
        $this->assertArrayHasKey('instructor', $response->decodeResponseJson('meta')['filterOptions']);
        $this->assertArrayHasKey('difficulty', $response->decodeResponseJson('meta')['filterOptions']);
        $this->assertArrayHasKey('style', $response->decodeResponseJson('meta')['filterOptions']);
        $this->assertArrayHasKey('artist', $response->decodeResponseJson('meta')['filterOptions']);
    }

    public function test_getByParentId_when_parentId_not_exist()
    {
        $response = $this->call(
            'GET',
            'railcontent/content/parent/' . rand()
        );

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_getByParentId()
    {
        $parent = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $child = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $hierarchy = $this->fakeHierarchy(
            1,
            [
                'parent' => $parent[0],
                'child' => $child[0],
            ]
        );
        $start1 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/parent/' . $parent[0]->getId()
        );

        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/parent/' . $parent[0]->getId()
        );
        $time2 = microtime(true) - $start2;

        $this->assertTrue($time2 < $time1);

        $results = $response->decodeResponseJson('data');

        $this->assertEquals(1, count($results));

        $this->assertEquals($child[0]->getId(), $results[0]['id']);
    }

    public function test_get_by_ids_when_ids_not_exists()
    {
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            [rand(), rand()]
        );

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_get_by_ids()
    {
        $contents = $this->fakeContent(
            2,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => 2 . ',' . 1]
        );

        $this->assertArraySubset([['id' => 2], ['id' => 1]], $response->decodeResponseJson('data'));
    }

    public function test_get_id_cached()
    {
        $content = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $id = $content[0]->getId();
        $start1 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $id);

        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $id);
        $time2 = microtime(true) - $start2;

        $start3 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $id);
        $time3 = microtime(true) - $start3;

        $start4 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $id);
        $time4 = microtime(true) - $start4;

        $start5 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . $id);
        $time5 = microtime(true) - $start5;

        $start6 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $id]
        );
        $time6 = microtime(true) - $start6;

        $start7 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $id]
        );
        $time7 = microtime(true) - $start7;

        $this->assertTrue($time7 < $time6);
        $this->assertTrue($time5 < $time1);
        $this->assertTrue($time4 < $time1);
        $this->assertTrue($time3 < $time1);
        $this->assertTrue($time2 < $time1);

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

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'slug' => $slug,
                'position' => null,
                'status' => $status,
                'parent_id' => null,
                'type' => $type,
                'published_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $executionEndTime = microtime(true);

        //The result will be in seconds and milliseconds.
        $seconds = $executionEndTime - $executionStartTime;

        //Print it out
        echo "Create content method(inclusive clear Redis cache) took $seconds seconds to execute when in Redis cache exists 300.000 keys that should be deleted.";

        $this->assertEquals(201, $response->status());
    }

    public function test_pull_content_permission()
    {
        $userId = $this->createAndLogInNewUser();
        $content1 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission = $this->fakePermission();

        $this->fakeContentPermission(
            1,
            [
                'content' => $content1[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $content2 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission2 = $this->fakePermission();

        $this->fakeContentPermission(
            1,
            [
                'content' => $content2[0],
                'permission' => $permission2[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $userPermission = $this->fakeUserPermission(
            1,
            [
                'permission' => $permission[0],
                'userId' => $userId,
                'startDate' => Carbon::parse(now())
                    ->subMonth(2),
                'expirationDate' => Carbon::parse(now())
                    ->addMonth(1),
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $content2[0]->getId() . ',' . $content1[0]->getId()]
        );
        $results = $response->decodeResponseJson('data');

        $this->assertEquals(1, count($results));
        $this->assertEquals($content1[0]->getId(), $results[0]['id']);
    }

    public function test_pull_content_user_permission()
    {
        $user = $this->createAndLogInNewUser();
        $contents = $this->fakeContent(
            2,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $permission = $this->fakePermission();
        $this->fakeContentPermission(
            1,
            [
                'content' => $contents[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->fakeUserPermission(
            1,
            [
                'userId' => $user,
                'permission' => $permission[0],
                'startDate' => Carbon::now()
                    ->subMonth(2),
                'expirationDate' => Carbon::now()
                    ->subMonth(1),
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $contents[0]->getId() . ',' . $contents[1]->getId()]
        );

        $this->assertEquals(1, count($response->decodeResponseJson('data')));
        $this->assertEquals($contents[1]->getId(), $response->decodeResponseJson('data')[0]['id']);
    }

    public function test_get_by_id_with_fields()
    {
        $content = $this->fakeContent(
            1,
            [
                'difficulty' => 1,
                'type' => 'course',
                'status' => 'published',
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => $this->faker->word,
                'position' => 1,
            ]
        );

        $instructor = $this->fakeContent(
            1,
            [
                'type' => 'instructor',
                'status' => 'published',
                'slug' => $this->faker->name,
                'brand' => config('railcontent.brand'),
            ]
        );

        $contentInstructor = $this->fakeContentInstructor(
            1,
            [
                'content' => $content[0],
                'instructor' => $instructor[0],
            ]
        );
        $data = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 1,
            ]
        );

        $data = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 2,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content/' . $content[0]->getId()
        );

        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals($content[0]->getId(), $responseContent['id']);
        $this->assertNotEmpty($responseContent['data']);

        $this->assertTrue(
            in_array(
                [
                    'content_id' => $content[0]->getId(),
                    'key' => 'topic',
                    'value' => $contentTopic[0]->getTopic(),
                    'position' => 1,
                ],
                $responseContent['fields']
            )
        );
    }

    public function test_controller_soft_delete_method()
    {
        $content = $this->fakeContent(2);

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => $this->faker->word,
                'position' => 1,
            ]
        );

        $response = $this->call('DELETE', 'railcontent/soft/content/' . $content[0]->getId());

        $this->assertEquals(204, $response->status());

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'content',
            [
                'id' => $content[0]->getId(),
                'status' => ContentService::STATUS_DELETED,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'content',
            [
                'id' => $content[1]->getId(),
                'status' => ContentService::STATUS_DELETED,
            ]
        );
    }

    public function test_delete_content_and_associations()
    {
        $content = $this->fakeContent();
        $id = $content[0]->getId();

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => $this->faker->word,
                'position' => 1,
            ]
        );

        $this->assertTrue(
            $this->entityManager->getCache()
                ->containsEntity(Content::class, $id)
        );

        $response = $this->call('DELETE', 'railcontent/content/' . $id);

        $this->assertFalse(
            $this->entityManager->getCache()
                ->containsEntity(Content::class, $id)
        );
        $this->assertEquals(204, $response->status());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content',
            [
                'id' => $id,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_topics',
            [
                'id' => 1,
            ]
        );
    }

    public function test_delete_content_reposition_siblings()
    {
        $contents = $this->fakeContent(4);

        $this->fakeHierarchy(
            1,
            [
                'parent' => $contents[0],
                'child' => $contents[1],
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $contents[0],
                'child' => $contents[2],
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $contents[0],
                'child' => $contents[3],
            ]
        );

        $id = $contents[2]->getId();

        $response = $this->call('DELETE', 'railcontent/content/' . $id);

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content',
            [
                'id' => $id,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_hierarchy',
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[1]->getId(),
                'child_position' => 1,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_hierarchy',
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[3]->getId(),
                'child_position' => 2,
            ]
        );
    }

    public function test_soft_delete_content_reposition_siblings()
    {
        $contents = $this->fakeContent(4);

        $this->fakeHierarchy(
            1,
            [
                'parent' => $contents[0],
                'child' => $contents[1],
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $contents[0],
                'child' => $contents[2],
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $contents[0],
                'child' => $contents[3],
            ]
        );

        $id = $contents[2]->getId();

        $response = $this->call('DELETE', 'railcontent/soft/content/' . $id);

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'content',
            [
                'id' => $id,
                'status' => 'deleted',
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_hierarchy',
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[1]->getId(),
                'child_position' => 1,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_hierarchy',
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[3]->getId(),
                'child_position' => 2,
            ]
        );
    }

    public function test_after_delete()
    {
        $contents = $this->fakeContent(
            10,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        sleep(1);

$id2 = $contents[2]->getId();
$id1 = $contents[1]->getId();
$id5 = $contents[5]->getId();
        $firstRequest = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $id2 . ',' . $id1 . ',' . $id5]
        );

        $this->assertEquals(3, count($firstRequest->decodeResponseJson('data')));

       // $id = $contents[1]->getId();

        $response = $this->call('DELETE', 'railcontent/content/' . $id1);

        $secondRequest = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $id2 . ',' . $id1 . ',' . $id5]
        );

        $this->assertEquals(2, count($secondRequest->decodeResponseJson('data')));
    }

    public function test_after_soft_delete()
    {
        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $stack = new DebugStack();
        $this->entityManager->getConfiguration()
            ->setSQLLogger($stack);

        $firstRequest = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $contents[2]->getId() . ',' . $contents[1]->getId() . ',' . $contents[5]->getId()]
        );

        $this->assertEquals(3, count($firstRequest->decodeResponseJson('data')));

        $id = $contents[1]->getId();

        $response = $this->call('DELETE', 'railcontent/soft/content/' . $id);

        $secondRequest = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $contents[2]->getId() . ',' . $id . ',' . $contents[5]->getId()]
        );

        $this->assertEquals(2, count($secondRequest->decodeResponseJson('data')));
    }

    public function test_fetch()
    {
        $user = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
                'difficulty' => 2,
                'title' => $this->faker->word,
            ]
        );
        $instructor = $this->fakeContent(
            1,
            [
                'type' => 'instructor',
                'slug' => 'dave-atkinson',
                'status' => 'published',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
                'name' => 'Dave Atkinson',
            ]
        );

        $instructorData = $this->fakeContentData(
            1,
            [
                'content' => $instructor[0],
                'key' => 'head_shot_picture_url',
                'value' => 'https://s3.amazonaws.com/drumeo-assets/instructors/adam-smith.png?v=1513185407',
            ]
        );

        $this->fakeContentInstructor(
            1,
            [
                'content' => $content[0],
                'instructor' => $instructor[0],
            ]
        );
        $desc = $this->faker->word;

        $this->fakeContentData(
            1,
            [
                'content' => $content[0],
                'key' => 'description',
                'value' => $desc,
            ]
        );

        for ($i = 0; $i < 3; $i++) {
            $randomData[] = $this->fakeContentData(
                1,
                [
                    'content' => $content[0],
                    'key' => $this->faker->word,
                    'value' => $this->faker->paragraph,
                ]
            );
        }

        $sheet_music_image_url1 = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
                'key' => 'sheet_music_image_url',
                'value' => 'https://dz5i3s4prcfun.cloudfront.net/04-drum-rudiment-system/jpegs/28-single-flammed-mill.png',
            ]
        );
        $sheet_music_image_url2 = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
                'key' => 'sheet_music_image_url',
                'value' => 'https://dz5i3s4prcfun.cloudfront.net/05-drum-fill-system/jpegs/05-8th-note-triplets-to-8th-notes.png',
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'content' => $content[0],
                'userId' => $user,
                'state' => 'started',
                'progressPercent' => 30,
            ]
        );

        $contentTopic1 = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => 'general',
                'position' => 1,
            ]
        );

        $contentTopic2 = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => 'performances',
                'position' => 2,
            ]
        );

        $results = $this->serviceBeingTested->getById($content[0]->getId());

        $this->assertInstanceOf(Content::class, $results);

        $this->assertEquals($content[0]->getId(), $results->fetch('id'));
        $this->assertEquals($content[0]->getSlug(), $results->fetch('slug'));
        $this->assertEquals($content[0]->getType(), $results->fetch('type'));
        $this->assertEquals($content[0]->getSort(), $results->fetch('sort'));
        $this->assertEquals($content[0]->getStatus(), $results->fetch('status'));
        $this->assertEquals($content[0]->getLanguage(), $results->fetch('language'));
        $this->assertEquals($content[0]->getBrand(), $results->fetch('brand'));
        $this->assertEquals($content[0]->getPublishedOn(), $results->fetch('published_on'));
        $this->assertEquals($content[0]->getCreatedOn(), $results->fetch('created_on'));
        $this->assertEquals($content[0]->getArchivedOn(), $results->fetch('archived_on'));

        foreach ($randomData as $randomDatum) {
            $this->assertEquals($randomDatum[0]->getValue(), $results->fetch('data.' . $randomDatum[0]->getKey()));
            $this->assertEquals(
                $randomDatum[0]->getValue(),
                $results->fetch('data.' . $randomDatum[0]->getKey() . '.' . $randomDatum[0]->getPosition())
            );
        }

        $this->assertEquals($desc, $content[0]->fetch('data.description', ''));
        $this->assertEquals(0, $content[0]->fetch('data.timecode', 0));
        $this->assertEquals(2, count($content[0]->fetch('*data.sheet_music_image_url', [])));

        $this->assertEquals(2, count($content[0]->fetch('*fields.topic', [])));
        $this->assertEquals($contentTopic1[0]->getTopic(), $content[0]->fetch('fields.topic.1', null));
        $this->assertEquals($contentTopic2[0]->getTopic(), $content[0]->fetch('fields.topic.2', null));

        $this->assertEquals([], $content[0]->fetch('*fields.tag', []));

        $this->assertEquals(2, count($content[0]->fetch('*data.sheet_music_image_url', [])));
        $this->assertFalse($content[0]->fetch('completed'));
        $this->assertEquals($instructor[0]->getName(), $content[0]->fetch('fields.instructor.fields.name'));
        $this->assertEquals($instructor[0]->getName(), $content[0]->fetch('fields.instructor.fields.name'));
        $this->assertEquals($instructor[0]->getName(), $content[0]->fetch('fields.instructor.fields.name'));
        $this->assertEquals($content[0]->getDifficulty(), $content[0]->fetch('fields.difficulty'));
        $this->assertEquals($content[0]->getHomeStaffPickRating(), $content[0]->fetch('fields.home_staff_pick_rating'));
        $this->assertEquals(1, $content[0]->fetch('fields.video.fields.length_in_seconds', 1));
        $this->assertEquals($content[0]->getType(), $content[0]->fetch('type'));
        $this->assertEquals($content[0]->getTitle(), $content[0]->fetch('fields.title', ''));
        $this->assertEquals($content[0]->getTitle(), $content[0]->fetch('fields.title', ''));
        $this->assertEquals(
            $instructorData[0]->getValue(),
            $content[0]->fetch('fields.instructor.data.head_shot_picture_url', null)
        );
        $this->assertNull($content[0]->fetch('url', null));
    }
}