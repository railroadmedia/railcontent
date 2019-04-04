<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class ContentJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);
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
            $responseContent['relationships']['instructor']['data']['id']
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
            $response->decodeResponseJson()['data']['attributes']
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
        $response = $this->call(
            'PATCH',
            'railcontent/content/' . 1,
            [
                'data' => [
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

        $this->assertEquals($content[0]->getSlug(), $first->decodeResponseJson('data')['attributes']['slug']);

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
                        'instructor' => [
                            'data' => [
                                'type' => 'instructor',
                                'id' => 2,
                            ],
                        ],
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

        $this->fakeComment(5, [
            'content' => $content[0],
            'comment' => $this->faker->paragraph
        ]);

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
            config('railcontent.table_prefix') . 'content_topic',
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
            $this->assertEquals(1, $data['attributes']['difficulty']);
            $this->assertEquals($statues[0], $data['attributes']['status']);
        }

        $this->assertArrayHasKey('filterOption', $response->decodeResponseJson('meta'));
        $this->assertArrayHasKey('instructor', $response->decodeResponseJson('meta')['filterOption']);
        $this->assertArrayHasKey('difficulty', $response->decodeResponseJson('meta')['filterOption']);
        $this->assertArrayHasKey('style', $response->decodeResponseJson('meta')['filterOption']);
        $this->assertArrayHasKey('artist', $response->decodeResponseJson('meta')['filterOption']);
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
                'data' => [
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
            1,
            [
                'content' => $content1[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand')
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
                'brand' => config('railcontent.brand')
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
                'brand' => config('railcontent.brand')
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
                'status' => 'published'
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
            1,
            [
                'content' => $content[0],
                'topic' => 'topic3',
                'position' => 2,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => 'topic4',
                'position' => 3,
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            1,
            [
                'content' => $content[0],
                'topic' => 'topic5',
                'position' => 4,
            ]
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
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
                'brand' =>config('railcontent.brand'),
                'status' => 'published',
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
            1,
            [
                'content' => $content[0],
                'topic' => 'topic2',
                'position' => 2,
            ]
        );

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . $content[0]->getId(),
            [
                'data' => [
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
                                    'id' => $contentTopic[0]->getId(),
                                ],
                            ],
                        ],
                    ],
                ],
                'included' => [
                    [
                        'type' => 'topic',
                        'id' => $contentTopic[0]->getId(),
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
            config('railcontent.table_prefix') . 'content_topic',
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
                'status' => 'published'
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
}