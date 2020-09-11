<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Doctrine\DBAL\Logging\DebugStack;
use Elastica\Mapping;
use Elastica\Processor\Sort;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Script as ScriptQuery;
use Elastica\Query\Term;
use Elastica\QueryBuilder;
use Elastica\Script\Script;
use JMS\Serializer\Tests\Fixtures\Discriminator\Car;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Managers\SearchEntityManager;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class ContentJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected $railcontentEntityManager;

    protected $userProviderInterface;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);

        $this->railcontentEntityManager = $this->app->make(RailcontentEntityManager::class);

        $this->userProviderInterface = $this->app->make(UserProviderInterface::class);

        ResponseService::$oldResponseStructure = false;
    }

    public function test_index_empty()
    {
        $response = $this->call('GET', 'railcontent/content');

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = 'course';
        $status = ContentService::STATUS_DRAFT;
        $instructor = $this->fakeContent(
            1,
            [
                'type' => 'instructor',
            ]
        );

        $exercises = $this->fakeContent(
            2,
            [
                'type' => 'assignment',
            ]
        );

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => $slug,
                        'position' => null,
                        'status' => $status,
                        'parent_id' => null,
                        'brand' => config('railcontent.brand'),
                        'type' => $type,
                        'fields' => [
                            [
                                'key' => 'topic',
                                'value' => $this->faker->word,
                            ],
                            [
                                'key' => 'topic',
                                'value' => $this->faker->word,
                                'position' => 1,
                            ],
                            [
                                'key' => 'difficulty',
                                'value' => 10,
                                'position' => 1,
                            ],
                            [
                                'key' => 'instructor',
                                'value' => $instructor[0]->getId(),
                            ],
                            [
                                'key' => 'exercise',
                                'value' => $exercises[0]->getId(),
                            ],
                            [
                                'key' => 'exercise',
                                'value' => $exercises[1]->getId(),
                            ],
                        ],
                        'published_on' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                ],
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals(201, $response->status());
        $this->assertArrayHasKey('instructor', $responseContent['relationships']);
        $this->assertArrayHasKey('topic', $responseContent['relationships']);
        $this->assertArrayHasKey('exercise', $responseContent['relationships']);
        $this->assertEquals(
            $instructor[0]->getId(),
            $responseContent['relationships']['instructor']['data'][0]['id']
        );
        $this->assertEquals(2, count($responseContent['relationships']['exercise']['data']));
    }

    public function test_store_not_pass_the_validation()
    {
        $response = $this->put('railcontent/content');

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'title' => 'Validation failed.',
                'source' => 'data.type',
                'detail' => 'The type field is required.',
            ],
            [
                'title' => 'Validation failed.',
                'source' => 'data.attributes.status',
                'detail' => 'The status field is required.',
            ],
            [
                'title' => 'Validation failed.',
                'source' => 'data.attributes.type',
                'detail' => 'The type field is required.',
            ],
        ];

        $this->assertArraySubset($errors, $response->decodeResponseJson('errors'));
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
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => $slug,
                        'status' => $status,
                        'type' => $type,
                        'position' => -1,
                    ],
                ],
            ]
        );

        //expecting it to redirect us to previous page.
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                'source' => 'data.attributes.position',
                'detail' => 'The position must be at least 0.',
                'title' => 'Validation failed.',
            ],

        ];
        $this->assertEquals($errors, $response->decodeResponseJson('errors'));
    }

    public function _test_store_with_custom_validation_and_slug_huge()
    {
        $slug = $this->faker->text(500);
        $status = ContentService::STATUS_DRAFT;

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'attributes' => [
                        'slug' => $slug,
                        'status' => $status,
                        'type' => $this->faker->word,
                        'position' => 1,
                    ],
                ],
            ]
        );

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

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => $slug,
                        'status' => $status,
                        'type' => $type,
                        'position' => $position,
                    ],
                ],
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
        $parent = $this->fakeContent();

        $exercise = $this->fakeContent();
        $instructor = $this->fakeContent();

        $contentData = [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'sort' => $position,
            'brand' => config('railcontent.brand'),
            'fields' => [
                [
                    'key' => 'title',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'episode_number',
                    'value' => $this->faker->randomNumber(1),
                ],
                [
                    'key' => 'difficulty',
                    'value' => $this->faker->randomNumber(1),
                ],
                [
                    'key' => 'tag',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'tag',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'key',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'keyPitchType',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'exercise',
                    'value' => $exercise[0]->getId(),
                ],
                [
                    'key' => 'playlist',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'instructor',
                    'value' => $instructor[0]->getId(),
                ],
            ],
        ];

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => $contentData,
                    'relationships' => [
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $parent[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        unset($contentData['fields']);

        $this->assertArraySubset($contentData, $response->decodeResponseJson('data')['attributes']);
        $this->assertArrayHasKey('title', $response->decodeResponseJson('data')['attributes']);
        $this->assertArrayHasKey('difficulty', $response->decodeResponseJson('data')['attributes']);
        $this->assertArrayHasKey('tag', $response->decodeResponseJson('data')['relationships']);
        $this->assertArrayHasKey('key', $response->decodeResponseJson('data')['relationships']);
        $this->assertArrayHasKey('keyPitchType', $response->decodeResponseJson('data')['relationships']);
        $this->assertArrayHasKey('exercise', $response->decodeResponseJson('data')['relationships']);
        $this->assertArrayHasKey('parent', $response->decodeResponseJson('data')['relationships']);
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
            $response->decodeResponseJson('data')[0]['attributes']
        );
    }

    public function test_update_response_status()
    {
        $content = $this->fakeContent();

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => 'new slug',
                        'status' => ContentService::STATUS_PUBLISHED,
                        'type' => 'roxana',
                    ],
                ],
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
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => $slug,
                        'position' => 1,
                        'status' => ContentService::STATUS_DRAFT,
                        'type' => $type,
                    ],
                ],
            ]
        );

        $this->assertEquals(404, $response->status());
    }

    public function test_update_with_negative_position()
    {
        $response = $this->call(
            'PATCH',
            'railcontent/content/' . 1,
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'position' => -1,
                    ],
                ],
            ]
        );

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());
        //check that the error message is received
        $errors = [
            [
                'source' => 'data.attributes.position',
                'detail' => 'The position must be at least 0.',
                'title' => 'Validation failed.',
            ],
        ];
        $this->assertEquals($errors, $response->decodeResponseJson('errors'));
    }

    public function test_update_not_pass_the_validation()
    {
        $response = $this->call(
            'PATCH',
            'railcontent/content/' . 1,
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'status' => $this->faker->word,
                    ],
                ],
            ]
        );

        //expecting a response with 422 status
        $this->assertEquals(422, $response->status());

        //check that all the error messages are received
        $errors = [
            [
                "title" => "Validation failed.",
                "source" => "data.attributes.status",
                "detail" => "The selected status is invalid.",
            ],
        ];
        $this->assertEquals($errors, $response->decodeResponseJson('errors'));
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
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic1',
                'position' => 1,
            ]
        );
        for ($i = 0; $i < 12; $i++) {
            $contentTopic[$i] = $this->fakeContentTopic(
                [
                    'content_id' => $content[0]->getId(),
                    'topic' => 'topic3',
                    'position' => 2,
                ]
            );
        }

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
            [
                'content_id' => $content[0]->getId(),
                'instructor_id' => $instructors[0]->getId(),
            ]
        );

        $new_slug = implode('-', $this->faker->words());

        $first = $this->call('GET', 'railcontent/content/' . $content[0]->getId());

        $this->assertEquals($content[0]->getSlug(), $first->decodeResponseJson('data')[0]['attributes']['slug']);

        //assert cache exist
        $this->assertTrue(
            $this->entityManager->getCache()
                ->containsEntity(Content::class, $content[0]->getId())
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => $new_slug,
                        'status' => ContentService::STATUS_PUBLISHED,
                        'fields' => [
                            [
                                'key' => 'topic',
                                'value' => 'topic1',
                                'position' => 1,
                            ],
                            [
                                'key' => 'topic',
                                'value' => 'topic2',
                                'position' => 1,
                            ],
                            [
                                'key' => 'difficulty',
                                'value' => 2,
                                'position' => 1,
                            ],
                            [
                                'key' => 'instructor',
                                'value' => $instructors[1]->getId(),
                                'position' => 1,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertArraySubset(
            [
                'data' => [
                    'attributes' => [
                        'slug' => $new_slug,
                        'status' => ContentService::STATUS_PUBLISHED,
                        'difficulty' => 2,
                    ],
                    'relationships' => [
                        'topic' => [
                            'data' => [
                                [
                                    'type' => 'topic',
                                    'id' => 1,
                                ],
                                [
                                    'type' => 'topic',
                                    'id' => 14,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            $response->decodeResponseJson()
        );

        //assert cache was inactivated
        $this->assertFalse(
            $this->entityManager->getCache()
                ->containsEntity(Content::class, $content[0]->getId())
        );
    }

    public function test_content_service_return_updated_content_after_update()
    {
        $content = $this->fakeContent();

        $new_slug = implode('-', $this->faker->words());
        $updatedContent = $this->serviceBeingTested->update(
            $content[0]->getId(),
            [
                'data' => [
                    'attributes' => [
                        "slug" => $new_slug,
                    ],
                ],
            ]
        );

        $this->assertEquals($new_slug, $updatedContent->getSlug());
    }

    public function test_service_delete_method_result()
    {
        $content = $this->fakeContent();
        $delete = $this->serviceBeingTested->delete($content[0]->getId());

        $this->assertTrue($delete);
    }

    public function test_service_delete_method_when_content_not_exist()
    {
        $delete = $this->serviceBeingTested->delete(rand(100, 500));

        $this->assertNull($delete);
    }

    public function test_controller_delete_method_response_status()
    {
        $content = $this->fakeContent();

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => $this->faker->word,
                'position' => 1,
            ]
        );

        $this->fakeContentPermission(
            [
                'content_id' => $content[0]->getId(),
                'permission_id' => $this->fakePermission()['id'],
            ]
        );

        $this->fakeComment(
            [
                'content_id' => $content[0]->getId(),
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
        $permission = $this->fakePermission();
        $permission2 = $this->fakePermission();

        $content = $this->fakeContent(
            3,
            [
                'difficulty' => 1,
                'type' => 'course',
                'status' => 'published',
                'publishedOn' => Carbon::now(),

            ]
        );

        $this->fakeContentTopic(
            [
                'content_id' => $content[1]->getId(),
                'topic' => 'test',
            ]
        );

        $this->fakeContentTopic(
            [
                'content_id' => $content[1]->getId(),
                'topic' => 'dsdfdf',
            ]
        );

        $otherContent = $this->fakeContent(12);

        $this->fakeUserPermission(
            [
                'user_id' => $userId,
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now(),
                'expiration_date' => Carbon::now()
                    ->addMinute(10),
            ]
        );

        $this->fakeUserPermission(
            [
                'user_id' => $userId,
                'permission_id' => $permission2['id'],
                'start_date' => Carbon::now(),
                'expiration_date' => Carbon::now()
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
            $this->assertTrue(in_array($content['attributes']['type'], $types));
            $this->assertEquals(1, $content['attributes']['difficulty']);
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
            $this->assertEquals($fieldValue, $content['attributes']['difficulty']);
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
                [
                    'content_id' => $content->getId(),
                    'instructor_id' => $instructor[0]->getId(),
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
            [
                'content_id' => $contents[0]->getId(),
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 1,
            ]
        );

        $data = $this->fakeContentData(
            [
                'content_id' => $contents[0]->getId(),
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
            $this->assertEquals(1, $data['attributes']['difficulty']);
            $this->assertEquals($statues[0], $data['attributes']['status']);
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
            [
                'parent_id' => $parent[0]->getId(),
                'child_id' => $child[0]->getId(),
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
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'slug' => $slug,
                        'position' => null,
                        'status' => $status,
                        'parent_id' => null,
                        'type' => $type,
                        'published_on' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                ],
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
            [
                'content_id' => $content1[0]->getId(),
                'permission_id' => $permission['id'],
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
            [
                'content_id' => $content2[0]->getId(),
                'permission_id' => $permission2['id'],
                'brand' => config('railcontent.brand'),
            ]
        );

        $userPermission = $this->fakeUserPermission(
            [
                'permission_id' => $permission['id'],
                'user_id' => $userId,
                'start_date' => Carbon::parse(now())
                    ->subMonth(2),
                'expiration_date' => Carbon::parse(now())
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
            [
                'content_id' => $contents[0]->getId(),
                'permission_id' => $permission['id'],
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->fakeUserPermission(
            [
                'user_id' => $user,
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now()
                    ->subMonth(2),
                'expiration_date' => Carbon::now()
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
            [
                'content_id' => $content[0]->getId(),
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
            [
                'content_id' => $content[0]->getId(),
                'instructor_id' => $instructor[0]->getId(),
            ]
        );
        $data = $this->fakeContentData(
            [
                'content_id' => $content[0]->getId(),
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 1,
            ]
        );

        $data = $this->fakeContentData(
            [
                'content_id' => $content[0]->getId(),
                'key' => $this->faker->word,
                'value' => $this->faker->text,
                'position' => 2,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content/' . $content[0]->getId()
        );

        $responseContent = $response->decodeResponseJson('data')[0];

        $this->assertEquals($content[0]->getId(), $responseContent['id']);
        $this->assertArrayHasKey('data', $responseContent['relationships']);
        $this->assertArrayHasKey('instructor', $responseContent['relationships']);
        $this->assertArrayHasKey('topic', $responseContent['relationships']);
    }

    public function test_after_update_content_reposition_associated_fields()
    {
        $content = $this->fakeContent(
            1,
            [
                'difficulty' => 1,
                'brand' => config('railcontent.brand'),
                'status' => 'published',
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic1',
                'position' => 1,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic3',
                'position' => 2,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic4',
                'position' => 3,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic5',
                'position' => 4,
            ]
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'status' => ContentService::STATUS_PUBLISHED,
                        'fields' => [
                            [
                                'key' => 'topic',
                                'value' => 'topic1',
                            ],
                            [
                                'key' => 'topic',
                                'value' => 'topic5',
                            ],
                            [
                                'key' => 'topic',
                                'value' => 'topic3',
                                'position' => 3,
                            ],
                            [
                                'key' => 'topic',
                                'value' => 'topic4',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertArraySubset(
            [
                'data' => [
                    'attributes' => [
                        'status' => ContentService::STATUS_PUBLISHED,
                    ],
                ],
            ],
            $response->decodeResponseJson()
        );

        $this->assertEquals(4, count($response->decodeResponseJson('data')['relationships']['topic']['data']));
        $this->assertArraySubset(
            [
                [
                    "topic" => "topic1",
                    "position" => 1,
                ],
                [
                    "topic" => "topic3",
                    "position" => 3,
                ],
                [
                    "topic" => "topic4",
                    "position" => 2,
                ],
                [
                    "topic" => "topic5",
                    "position" => 4,
                ],
            ],
            array_pluck($response->decodeResponseJson('included'), 'attributes')
        );
    }

    public function test_after_update_content_delete_associated_field()
    {
        $content = $this->fakeContent(
            1,
            [
                'difficulty' => 1,
                'brand' => config('railcontent.brand'),
                'status' => 'published',
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic1',
                'position' => 1,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'topic2',
                'position' => 2,
            ]
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => [
                        'status' => ContentService::STATUS_PUBLISHED,
                        'fields' => [
                            [
                                'key' => 'topic',
                                'value' => 'topic2',
                            ],
                            [
                                'key' => 'difficulty',
                                'value' => 2,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertArraySubset(
            [
                'data' => [
                    'attributes' => [
                        'status' => ContentService::STATUS_PUBLISHED,
                    ],
                    'relationships' => [
                        'topic' => [
                            'data' => [
                                [
                                    'type' => 'topic',
                                    'id' => $contentTopic['id'],
                                ],
                            ],
                        ],
                    ],
                ],
                'included' => [
                    [
                        'type' => 'topic',
                        'id' => $contentTopic['id'],
                        'attributes' => [
                            'topic' => 'topic2',
                            'position' => 1,
                        ],
                    ],
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_create_contents_topics_position()
    {
        $content1Data = [
            'slug' => $this->faker->word,
            'status' => 'published',
            'type' => $this->faker->word,
            'brand' => config('railcontent.brand'),
            'fields' => [
                [
                    'key' => 'title',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'difficulty',
                    'value' => $this->faker->randomNumber(1),
                ],
                [
                    'key' => 'topic',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'topic',
                    'value' => $this->faker->word,
                ],
            ],
        ];

        $response1 = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => $content1Data,
                ],
            ]
        );

        $content2Data = [
            'slug' => $this->faker->word,
            'status' => 'published',
            'type' => $this->faker->word,
            'brand' => config('railcontent.brand'),
            'fields' => [
                [
                    'key' => 'title',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'difficulty',
                    'value' => $this->faker->randomNumber(1),
                ],
                [
                    'key' => 'topic',
                    'value' => $this->faker->word,
                ],
                [
                    'key' => 'topic',
                    'value' => $this->faker->word,
                ],
            ],
        ];

        $response2 = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => $content2Data,
                ],
            ]
        );

        //assert position on each sortable group(content)
        $this->assertEquals(0, $response1->decodeResponseJson('included')[0]['attributes']['position']);
        $this->assertEquals(1, $response1->decodeResponseJson('included')[1]['attributes']['position']);
        $this->assertEquals(0, $response2->decodeResponseJson('included')[0]['attributes']['position']);
        $this->assertEquals(1, $response2->decodeResponseJson('included')[1]['attributes']['position']);
    }

    public function test_controller_soft_delete_method()
    {
        $content = $this->fakeContent(2);

        $this->fakeHierarchy(
            [
                'parent_id' => $content[0]->getId(),
                'child_id' => $content[1]->getId(),
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
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
            [
                'content_id' => $id,
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
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[1]->getId(),
            ]
        );

        $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[2]->getId(),
            ]
        );

        $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[3]->getId(),
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
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[1]->getId(),
            ]
        );

        $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[2]->getId(),
            ]
        );

        $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[3]->getId(),
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

        $firstRequest = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $contents[2]->getId() . ',' . $contents[1]->getId() . ',' . $contents[5]->getId()]
        );

        $this->assertEquals(3, count($firstRequest->decodeResponseJson('data')));

        $id = $contents[1]->getId();

        $response = $this->call('DELETE', 'railcontent/content/' . $id);

        $secondRequest = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $contents[2]->getId() . ',' . $id . ',' . $contents[5]->getId()]
        );

        $this->assertEquals(2, count($secondRequest->decodeResponseJson('data')));
    }

    public function test_create_new_content()
    {
        $type = $this->faker->word;

        $content = $this->fakeContent(
            1,
            [
                'difficulty' => 1,
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'status' => 'published',
            ]
        );
        $otherContent = $this->fakeContent(12);

        $types = [$type];
        $page = 1;
        $limit = 10;
        $filter = ['difficulty,1'];

        $response1 = $this->call(
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

        $responseContent = $response1->decodeResponseJson('data');

        $contentData = [
            'slug' => $this->faker->word,
            'status' => 'published',
            'type' => $type,
            'sort' => 1,
            'title' => $this->faker->word,
            'brand' => config('railcontent.brand'),
            'published_on' => Carbon::now(),
            'fields' => [
                [
                    'key' => 'difficulty',
                    'value' => 1,
                ],
            ],
        ];

        $response = $this->call(
            'PUT',
            'railcontent/content',
            [
                'data' => [
                    'type' => 'content',
                    'attributes' => $contentData,
                ],
            ]
        );

        $response2 = $this->call(
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

        $responseContent2 = $response2->decodeResponseJson('data');

        $this->assertEquals(count($responseContent) + 1, count($responseContent2));
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

    public function _test_fetch()
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
            [
                'content_id' => $instructor[0]->getId(),
                'key' => 'head_shot_picture_url',
                'value' => 'https://s3.amazonaws.com/drumeo-assets/instructors/adam-smith.png?v=1513185407',
            ]
        );

        $this->fakeContentInstructor(
            [
                'content_id' => $content[0]->getId(),
                'instructor_id' => $instructor[0]->getId(),
            ]
        );
        $desc = $this->faker->word;

        $this->fakeContentData(
            [
                'content_id' => $content[0]->getId(),
                'key' => 'description',
                'value' => $desc,
                'position' => 1,
            ]
        );

        for ($i = 0; $i < 3; $i++) {
            $randomData[$i] = $this->fakeContentData(
                [
                    'content_id' => $content[0]->getId(),
                    'key' => $this->faker->word,
                    'value' => $this->faker->paragraph,
                    'position' => $i + 2,
                ]
            );
        }

        $sheet_music_image_url1 = $this->fakeContentData(
            [
                'content_id' => $content[0]->getId(),
                'key' => 'sheet_music_image_url',
                'value' => 'https://dz5i3s4prcfun.cloudfront.net/04-drum-rudiment-system/jpegs/28-single-flammed-mill.png',
            ]
        );
        $sheet_music_image_url2 = $this->fakeContentData(
            [
                'content_id' => $content[0]->getId(),
                'key' => 'sheet_music_image_url',
                'value' => 'https://dz5i3s4prcfun.cloudfront.net/05-drum-fill-system/jpegs/05-8th-note-triplets-to-8th-notes.png',
            ]
        );

        $this->fakeUserContentProgress(
            [
                'content_id' => $content[0]->getId(),
                'user_id' => $user,
                'state' => 'started',
                'progress_percent' => 30,
            ]
        );

        $contentTopic1 = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
                'topic' => 'general',
                'position' => 1,
            ]
        );

        $contentTopic2 = $this->fakeContentTopic(
            [
                'content_id' => $content[0]->getId(),
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
        $this->assertEquals($content[0]->getArchivedOn(), $results->fetch('archived_on'));

        foreach ($randomData as $randomDatum) {
            $this->assertEquals($randomDatum['value'], $results->fetch('data.' . $randomDatum['key']));
            $this->assertEquals(
                $randomDatum['value'],
                $results->fetch('data.' . $randomDatum['key'] . '.' . $randomDatum['position'])
            );
        }

        // $this->assertEquals($desc, $content[0]->fetch('data.description', ''));
        $this->assertEquals(0, $content[0]->fetch('data.timecode', 0));
        // $this->assertEquals(2, count($content[0]->fetch('*data.sheet_music_image_url', [])));

        // $this->assertEquals(2, count($content[0]->fetch('*fields.topic', [])));
        $this->assertEquals($contentTopic1['topic'], $content[0]->fetch('fields.topic.1', null));
        $this->assertEquals($contentTopic2['topic'], $content[0]->fetch('fields.topic.2', null));

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

    public function test_sort_by_newest_and_oldest()
    {
        for ($i = 0; $i < 20; $i++) {
            $contents[$i] = $this->fakeContent2(
                [
                    'difficulty' => 1,
                    'type' => 'course',
                    'status' => 'published',
                    'language' => $this->faker->word,
                    'published_on' => Carbon::now()
                        ->subDays($i),
                    'created_on' => Carbon::now()
                        ->subWeek($i),
                ]
            );
        }

        $page = 1;
        $limit = 10;

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'newest',
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        foreach ($responseContent as $index => $content) {
            $this->assertEquals($contents[$index]['id'], $content['id']);
        }

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'oldest',
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        foreach ($responseContent as $index => $content) {
            $this->assertEquals(array_reverse($contents)[$index]['id'], $content['id']);
        }
    }

    public function test_sort_by_popularity()
    {
        $expectedResults = [];
        for ($i = 0; $i < 20; $i++) {
            $contents[$i] = $this->fakeContent2(
                [
                    'difficulty' => 1,
                    'type' => 'course',
                    'status' => 'published',
                    'language' => $this->faker->word,
                    'published_on' => Carbon::now()
                        ->subDays($i),
                    'created_on' => Carbon::now()
                        ->subWeek($i),
                ]
            );
            if ($i % 2 == 0) {
                $expectedResults[] = $contents[$i];
                $this->fakeUserContentProgress(
                    [
                        'content_id' => $contents[$i]['id'],
                    ]
                );
            }
        }

        $page = 1;
        $limit = 10;

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'popularity',
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        foreach ($responseContent as $index => $content) {
            $this->assertEquals($expectedResults[$index]['id'], $content['id']);
        }
    }

    public function test_sort_by_trending()
    {
        $expectedResults = [];
        for ($i = 0; $i < 20; $i++) {
            $contents[$i] = $this->fakeContent2(
                [
                    'difficulty' => 1,
                    'type' => 'course',
                    'status' => 'published',
                    'language' => $this->faker->word,
                    'published_on' => Carbon::now()
                        ->subDays($i),
                    'created_on' => Carbon::now()
                        ->subWeek($i),
                ]
            );
            if (in_array($i, [1, 4, 5])) {

                $expectedResults[] = $contents[$i];
                $this->fakeUserContentProgress(
                    [
                        'content_id' => $contents[$i]['id'],
                        'updated_on' => Carbon::now()
                            ->subDays($i),
                    ]
                );
            }
        }

        $page = 1;
        $limit = 10;

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'trending',
            ]
        );

        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals($expectedResults[0]['id'], $responseContent[0]['id']);
        $this->assertEquals($expectedResults[1]['id'], $responseContent[1]['id']);
        $this->assertEquals($expectedResults[2]['id'], $responseContent[2]['id']);
    }
}
