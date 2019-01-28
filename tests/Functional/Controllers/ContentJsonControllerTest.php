<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Faker\ORM\Doctrine\Populator;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentExercise;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
//use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Response;

class ContentJsonControllerTest extends RailcontentTestCase
{
    //    /**
    //     * @var ContentRepository
    //     */
    //    protected $classBeingTested;
    //
    //    /**
    //     * @var ContentFactory
    //     */
    //    protected $contentFactory;
    //
    //    /**
    //     * @var ContentHierarchyFactory
    //     */
    //    protected $contentHierarchyFactory;
    //
    //    /**
    //     * @var ContentContentFieldFactory
    //     */
    //    protected $fieldFactory;
    //
    //    /**
    //     * @var ContentDatumFactory
    //     */
    //    protected $contentDatumFactory;
    //
    //    /**
    //     * @var ContentService
    //     */
        protected $serviceBeingTested;
    //
    //    /**
    //     * @var \Railroad\Railcontent\Repositories\ContentPermissionRepository
    //     */
    //    protected $contentPermissionRepository;
    //
    //    /**
    //     * @var \Railroad\Railcontent\Repositories\UserPermissionsRepository
    //     */
    //    protected $userPermissionRepository;
    //
    //    /**
    //     * @var \Railroad\Railcontent\Repositories\PermissionRepository
    //     */
    //    protected $permissionRepository;

    protected function setUp()
    {
        parent::setUp();

        $populator = new Populator($this->faker, $this->entityManager);
        $populator->addEntity(
            Content::class,
            1,
            [
                'slug' => 'slug1',
                'status' => 'published'
            ]
        );
        $populator->execute();
        $populator->addEntity(
            Content::class,
            2,
            [
                'slug' => 'exercise',
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentExercise::class,
            1,
            [
                'content' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'exercise' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
            ]
        );
        $populator->execute();

        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
                'childPosition' => 1,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(3),
                'childPosition' => 2,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(4),
                'childPosition' => 3,
            ]
        );
        $populator->execute();

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->entityManager, $purger);

        //    $this->contentFactory = $this->app->make(ContentFactory::class);
        //        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        //    $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        //        $this->contentDatumFactory = $this->app->make(ContentDatumFactory::class);
           $this->serviceBeingTested = $this->app->make(ContentService::class);
        //        $this->classBeingTested = $this->app->make(ContentRepository::class);
        //        $this->contentPermissionRepository = $this->app->make(ContentPermissionRepository::class);
        //        $this->permissionRepository = $this->app->make(PermissionRepository::class);
        //        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);
    }

    public function _test_index_empty()
    {
        $response = $this->call('GET', 'railcontent/content');

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_store_response_status()
    {
        $slug = $this->faker->word;
        $type = 'course';
        $status = ContentService::STATUS_SCHEDULED;

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
                        'brand' => ConfigService::$brand,
                        'type' => $type,
                        'published_on' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                ],
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
                'slug' => $slug,
                'status' => $status,
                'type' => $this->faker->word,
                'position' => 1,
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

        $contentData = [
            'slug' => $slug,
            'status' => $status,
            'type' => $type,
            'sort' => $position,
            'brand' => ConfigService::$brand,
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

        $this->assertArraySubset($contentData, $response->decodeResponseJson('data')['attributes']);
    }

    public function test_content_service_return_new_content_after_create()
    {
        $content = [];

        $response = $this->call('GET', 'railcontent/content/' . 1);

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
        $response = $this->call(
            'PATCH',
            'railcontent/content/' . 1,
            [
                'slug' => 'new slug',
                'status' => ContentService::STATUS_PUBLISHED,
                'type' => 'roxana',
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
                'detail' => 'The data.attributes.position must be at least 0.',
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
        $new_slug = implode('-', $this->faker->words());

        $response = $this->call(
            'PATCH',
            'railcontent/content/' . 1,
            [
                'data' => [
                    'attributes' => [
                        'slug' => $new_slug,
                        'status' => ContentService::STATUS_PUBLISHED,
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
                    ],
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_content_service_return_updated_content_after_update()
    {

        $new_slug = implode('-', $this->faker->words());
        $updatedContent = $this->serviceBeingTested->update(
            1,
            ['data' => ['attributes' => [
                "slug" => $new_slug,
                ]]
            ]
        );

        $this->assertEquals( $new_slug, $updatedContent->getSlug());
    }

    public function test_service_delete_method_result()
    {
        $delete = $this->serviceBeingTested->delete(1);

        $this->assertTrue($delete);
    }

    public function test_service_delete_method_when_content_not_exist()
    {

        $delete = $this->serviceBeingTested->delete(rand(100,500));

        $this->assertNull($delete);
    }

    public function test_controller_delete_method_response_status()
    {

        $response = $this->call('DELETE', 'railcontent/content/' . 1);

        $this->assertEquals(204, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => 1,
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

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
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
            ]
        );

        $responseContent = $response->decodeResponseJson();

        $this->assertArraySubset($expectedContent['results'], $responseContent);
        $this->assertEquals($nrCourses, $response->decodeResponseJson('meta')['totalResults']);
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
            'code' => 200,
        ];

        $nrCourses = 30;

        //create courses
//        for ($i = 1; $i < $nrCourses; $i++) {
//            $content = $this->contentFactory->create(
//                $this->faker->word,
//                $types[0],
//                $this->faker->randomElement($statues)
//            );
//            $contents[$i] = (array)$content;
//        }
//
//        $contentWithFieldsNr = 5;
        $fieldKey = 'difficulty';
        $fieldValue = 1;
        $fieldType = 'integer';
//
        $filter = [$fieldKey . ',' . $fieldValue . ',' . $fieldType];
//        $expectedContent['filter_options'] = [];

//        for ($i = 1; $i < $contentWithFieldsNr; $i++) {
//            $field =
//                $this->fieldFactory->create($contents[$i]['id'], $fieldKey, $fieldValue, null, $fieldType)
//                    ->getArrayCopy();
//
//            $expectedResults[$i - 1] = $contents[$i];
//            $expectedResults[$i - 1]['fields'][] = array_merge($field, ['id' => $field['id']]);
//        }
//        $expectedContent['results'] = $expectedResults;
//        $expectedContent['total_results'] = $contentWithFieldsNr - 1;

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
            $content = $this->contentFactory->create($this->faker->word, $types[0]);
            $contents[$content->getId()] = $this->serializer->toArray($content);
        }

        //create the required field
        $requiredField = [
            'key' => $this->faker->word,
            'value' => $this->faker->text(255),
            'type' => 'string',
        ];

        //only first 5 courses have the required field associated
        for ($i = 1; $i < 6; $i++) {
            $field = $this->fieldFactory->create(
                $contents[$i]['id'],
                $requiredField['key'],
                $requiredField['value'],
                null,
                $requiredField['type']
            );

            $expectedResults[$i - 1] = $contents[$i];
            $expectedResults[$i - 1]['fields'][] = $this->serializer->toArray($field);
        }

        $instructor =
            $this->contentFactory->create($this->faker->word, 'instructor', $this->faker->randomElement($statues));

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructor->getId(),
            'type' => 'content_id',
        ];

        for ($i = 1; $i < 7; $i++) {
            $contentField = $this->fieldFactory->create(
                $contents[$i]['id'],
                $fieldInstructor['key'],
                $fieldInstructor['value'],
                null,
                $fieldInstructor['type']
            );

            // $contentField['type'] = 'content';
            // $contentField['value'] = (array)$instructor;
            if (array_key_exists(($i - 1), $expectedResults)) {
                $expectedResults[$i - 1]['fields'][] = $this->serializer->toArray($contentField);
            }
        }

        //        for ($i = 1; $i < 25; $i++) {
        //            $datum = $this->contentDatumFactory->create($contents[$i]['id']);
        //            if (array_key_exists(($i - 1), $expectedResults)) {
        //                $expectedResults[$i - 1]['data'][] = $datum->getArrayCopy();
        //            }
        //        }

        $expectedContent['results'] = $expectedResults;
        $expectedContent['total_results'] = count($expectedContent['results']);
        $expectedContent['filter_options'] = [$fieldInstructor['key'] => [(array)$instructor]];

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'statues' => $statues,
                'sort' => 'id',
                'included_types' => $types,
                //'filter' => [
                'required_fields' => [
                    $requiredField['key'] . ',' . $requiredField['value'] . ',' . $requiredField['type'],
                    $fieldInstructor['key'] . ',' . $fieldInstructor['value'] . ',' . $fieldInstructor['type'],
                ],
                // ],
                'parent_slug' => '',
            ]
        );

        $responseContent = $response->decodeResponseJson();

        $this->assertArraySubset($expectedContent['results'], $responseContent);
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

        $response = $this->call(
            'GET',
            'railcontent/content/parent/' . 1
        );

        $this->assertEquals(3, count($response->decodeResponseJson('data')));

//        $expectedResults = [
//            (array)$firstChild,
//            (array)$secondChild,
//        ];
//        $this->assertEquals($expectedResults, $response->decodeResponseJson('data'));
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
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => 2 . ',' . 1]
        );

        $this->assertArraySubset([['id' => 2], ['id' => 1]], $response->decodeResponseJson('data'));
    }

    public function test_get_id_cached()
    {
        //        $content1 = $this->contentFactory->create(
        //            $this->faker->word,
        //            $this->faker->randomElement(ConfigService::$commentableContentTypes),
        //            ContentService::STATUS_PUBLISHED
        //        );

        // $id = $content1->getId();
        $start1 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . 1);

        $time1 = microtime(true) - $start1;

        $start2 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . 1);
        $time2 = microtime(true) - $start2;

        $start3 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . 1);
        $time3 = microtime(true) - $start3;

        $start4 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . 1);
        $time4 = microtime(true) - $start4;

        $start5 = microtime(true);
        $response = $this->call('GET', 'railcontent/content/' . 1);
        $time5 = microtime(true) - $start5;

        $start6 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => 1]
        );
        $time6 = microtime(true) - $start6;

        $start7 = microtime(true);
        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => 1]
        );
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
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $contentPermission = $this->contentPermissionRepository->create(
            [
                'content_id' => $content1['id'],
                'permission_id' => $permission['id'],
            ]
        );
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now()
                    ->subMonth(2)
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->subMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->subMonth(2)
                    ->toDateTimeString(),
            ]
        );
        $content2 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $content2['id'] . ',' . $content1['id']]
        );
        $expectedResults = [(array)$content2];

        $this->assertEquals($expectedResults, $response->decodeResponseJson('data'));
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

        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $contentPermission = $this->contentPermissionRepository->create(
            [
                'content_id' => $content1['id'],
                'permission_id' => $permission['id'],
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $user,
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now()
                    ->subMonth(2)
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->subMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->subMonth(2)
                    ->toDateTimeString(),
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content/get-by-ids',
            ['ids' => $content2['id'] . ',' . $content1['id']]
        );
        $expectedResults = [(array)$content2];

        $this->assertEquals($expectedResults, $response->decodeResponseJson('data'));
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function query()
    {
        return $this->databaseManager->connection();
    }

    public function test_drumeo()
    {
        $this->assertTrue(true);
    }
}