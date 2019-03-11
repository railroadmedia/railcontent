<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentPermissionService
     */
    protected $contentPermissionService;

    protected function setUp()
    {
        parent::setUp();

        $this->contentPermissionService = $this->app->make(ContentPermissionService::class);
    }

    public function test_index()
    {
        $permission = $this->fakePermission(
            1,
            [
                'name' => 'permission 1',
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);
        $response = $this->call(
            'GET',
            'railcontent/permission'
        );

        $this->assertEquals(
            [
                [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => [
                        'name' => 'permission 1',
                        'brand' => ConfigService::$brand,
                    ],
                ],
            ],
            $response->decodeResponseJson('data')
        );

    }

    public function test_store_response()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $permission = [
            'name' => $name,
        ];

        $response = $this->call(
            'PUT',
            'railcontent/permission',
            [
                'data' => [
                    'type' => 'permission',
                    'attributes' => [
                        'name' => $name,
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            [
                'data' => [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => array_add($permission, 'brand', ConfigService::$brand),
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_store_validation()
    {
        $response = $this->call('PUT', 'railcontent/permission');

        $this->assertEquals(422, $response->status());
        $this->assertEquals(
            [
                [
                    'title' => 'Validation failed.',
                    'source' => 'data.attributes.name',
                    'detail' => 'The name field is required.',
                ],
            ],
            $response->decodeResponseJson('errors')
        );
    }

    public function test_update_response()
    {
        $name = $this->faker->word;
        $fakeData = $this->fakePermission(1);
        $permission['name'] = $name;

        $response = $this->call(
            'PATCH',
            'railcontent/permission/' . $fakeData[0]->getId(),
            [
                'data' => [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => $permission,
                ],
            ]
        );

        $this->assertEquals(201, $response->status());

        $this->assertEquals(
            [
                'data' => [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => array_add($permission, 'brand', ConfigService::$brand),
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_update_not_exist_permission()
    {

        $name = $this->faker->word;
        $id = rand(2, 10);

        $response = $this->call(
            'PATCH',
            'railcontent/permission/' . $id,
            [
                'id' => $id,
                'type' => 'permission',
                'data' => [
                    'attributes' => [
                        'name' => $name,
                    ],
                ],
            ]
        );

        $this->assertEquals(404, $response->getStatusCode());

        $this->assertEquals(
            'Update failed, permission not found with id: ' . $id,
            $response->decodeResponseJson('errors')['detail']
        );
    }

    public function test_update_validation()
    {
        $response = $this->call('PATCH', 'railcontent/permission/1');

        $this->assertEquals(422, $response->status());

        $expectedErrors = [
            'source' => 'data.attributes.name',
            'detail' => 'The name field is required.',
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $response->decodeResponseJson('errors'));
    }

    public function test_delete_permission_response()
    {
        $permission = $this->fakePermission();
        $response = $this->call('DELETE', 'railcontent/permission/' . $permission[0]->getId());

        $this->assertEquals(204, $response->status());
        $this->assertEquals('', $response->content());
    }

    public function test_delete_missing_permission_response()
    {
        $id = rand(2, 10);
        $response = $this->call('DELETE', 'railcontent/permission/' . $id);

        $this->assertEquals(404, $response->status());
        $this->assertEquals(
            'Delete failed, permission not found with id: ' . $id,
            $response->decodeResponseJson('errors')['detail']
        );
    }

    public function test_assign_permission_to_specific_content()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'attributes' => [
                        'brand' => ConfigService::$brand,
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $expectedResults = [
            "content_type" => null,
            "brand" => ConfigService::$brand,
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')['attributes']);

        $this->assertEquals(
            [
                'data' => [
                    'type' => 'permission',
                    'id' => 1,
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['permission']
        );

        $this->assertEquals(
            [
                'data' => [
                    'type' => 'content',
                    'id' => $content[0]->getId(),
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['content']
        );
    }

    public function test_assign_permission_to_specific_content_type()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => 'course',
            ]
        );
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'attributes' => [
                        'content_type' => 'course',
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $expectedResults = [
            "content_type" => 'course',
            "brand" => ConfigService::$brand,
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')['attributes']);

        $this->assertEquals(
            [
                'data' => [
                    'type' => 'permission',
                    'id' => $permission[0]->getId(),
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['permission']
        );
    }

    public function test_assign_permission_validation()
    {
        $randomPermissionId = $this->faker->numberBetween();
        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $randomPermissionId,
                            ],
                        ],
                    ],
                ],

            ]
        );

        $decodedResponse = $response->decodeResponseJson('errors');

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                'source' => 'data.relationships.permission.data.id',
                'detail' => 'The selected permission is invalid.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.content.data.id',
                'detail' => 'The content field is required when none of content type are present.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.attributes.content_type',
                'detail' => 'The content type field is required when none of content are present.',
                'title' => 'Validation failed.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse);
    }

    public function test_assign_permission_incorrect_content_id()
    {
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => rand(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                "title" => "Validation failed.",
                "source" => "data.relationships.content.data.id",
                "detail" => "The selected content is invalid.",
            ],
        ];
        $this->assertEquals($expectedErrors, $response->decodeResponseJson('errors'));
    }

    public function test_assign_permission_incorrect_content_type()
    {
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'attributes' => [
                        'content_type' => $this->faker->word,
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                'source' => 'data.attributes.content_type',
                'detail' => 'The selected content type is invalid.',
                'title' => 'Validation failed.',
            ],
        ];
        $this->assertEquals($expectedErrors, $response->decodeResponseJson('errors'));
    }

    public function test_assign_permission_to_content_type_service_result()
    {
        $permission = $this->fakePermission();

        $assigned = $this->contentPermissionService->create(null, 'course', $permission[0]->getId());

        $this->assertEquals('course', $assigned->getContentType());
        $this->assertEquals(
            1,
            $assigned->getPermission()
                ->getId()
        );
    }

    public function test_assign_permission_to_specific_content_service_result()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $assigned = $this->contentPermissionService->create($content[0]->getId(), null, $permission[0]->getId());

        $this->assertNull($assigned->getContentType());
        $this->assertEquals(
            1,
            $assigned->getPermission()
                ->getId()
        );
        $this->assertEquals(
            1,
            $assigned->getContent()
                ->getId()
        );
    }

    public function test_dissociation_by_content_id()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $this->contentPermissionService->create($content[0]->getId(), null, $permission[0]->getId());
        $data = [
            'data' => [
                'type' => 'contentPermission',
                'relationships' => [
                    'permission' => [
                        'data' => [
                            'type' => 'permission',
                            'id' => $permission[0]->getId(),
                        ],
                    ],
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ];
        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => $content[0]->getId(),
            ]
        );

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => $content[0]->getId(),
            ]
        );
    }

    public function test_dissociation_by_content_type()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => 'course',
            ]
        );
        $permission = $this->fakePermission();

        $this->contentPermissionService->create(null, 'course', $permission[0]->getId());

        $data = [
            'data' => [
                'type' => 'contentPermission',
                'attributes' => [
                    'content_type' => 'course',
                ],
                'relationships' => [
                    'permission' => [
                        'data' => [
                            'type' => 'permission',
                            'id' => $permission[0]->getId(),
                        ],
                    ],
                ],
            ],
        ];

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            ['content_type' => 'course', 'permission_id' => $permission[0]->getId()]
        );

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            ['content_type' => 'course', 'permission_id' => $permission[0]->getId()]
        );
    }

    public function test_content_filter_after_permission_assignation()
    {
        $type = $this->faker->word;

        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );
        $this->assertTrue(
            in_array($contents[0]->getId(), array_pluck($firstRequest->decodeResponseJson('data'), 'id'))
        );

        $permission = $this->fakePermission();

        $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'attributes' => [
                        'brand' => config('railcontent.brand'),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $contents[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertEquals(
            $secondRequest->decodeResponseJson('meta')['pagination']['total'],
            $firstRequest->decodeResponseJson('meta')['pagination']['total'] - 1
        );

        $this->assertFalse(
            in_array($contents[0]->getId(), array_pluck($secondRequest->decodeResponseJson('data'), 'id'))
        );
    }

    public function test_content_filter_after_type_permission_assignation()
    {
        $type = $this->faker->word;

        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertTrue(
            in_array(
                $contents[0]->getType(),
                array_pluck(array_pluck($firstRequest->decodeResponseJson('data'), 'attributes'), 'type')
            )
        );

        $permission = $this->fakePermission();

        $a = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'attributes' => [
                        'brand' => config('railcontent.brand'),
                        'content_type' => $contents[0]->getType(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertFalse(
            in_array(
                $contents[0]->getType(),
                array_pluck(array_pluck($secondRequest->decodeResponseJson('data'), 'attributes'), 'type')
            )
        );
    }

    public function test_contents_filter_without_rights()
    {
        $user = $this->createAndLogInNewUser();

        $type = $this->faker->word;

        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission = $this->fakePermission();

        $this->fakeContentPermission(
            1,
            [
                'content' => $contents[0],
                'permission' => $permission[0],
            ]
        );

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertEquals(9, $firstRequest->decodeResponseJson('meta')['pagination']['total']);

        $response = $this->call(
            'PATCH',
            'railcontent/permission/dissociate/',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $contents[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );
        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );
        $this->assertEquals(10, $secondRequest->decodeResponseJson('meta')['pagination']['total']);
    }

    public function test_getByContentTypeOrIdAndByPermissionId()
    {
        $contents = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'type' => 'course',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission = $this->fakePermission(
            2,
            [
                'brand' => config('railcontent.brand'),
            ]
        );

        $type = $this->faker->word;
        $otherTypeContent = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeContentPermission(
            1,
            [
                'content' => $contents[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );
        $this->fakeContentPermission(
            1,
            [
                'contentType' => $type,
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->fakeContentPermission(
            1,
            [
                'contentType' => $type,
                'permission' => $permission[0],
                'brand' => $this->faker->word,
            ]
        );

        $results = $this->contentPermissionService->getByContentTypeOrIdAndByPermissionId(
            $contents[0]->getId(),
            $type,
            $permission[0]->getId()
        );

        $this->assertEquals(2, count($results));

        foreach ($results as $result) {
            $this->assertTrue(
                (($result->getContentType() == $type) ||
                    ($result->getContent()
                            ->getId() == $contents[0]->getId())) &&
                $result->getPermission()
                    ->getId() == $permission[0]->getId()
            );
        }
    }
}
