<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

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

        $populator = new Populator($this->faker, $this->entityManager);

        $populator->addEntity(
            Permission::class,
            1,
            [
                'name' => 'permission 1',
                'brand' => ConfigService::$brand,
            ]
        );

        $populator->addEntity(
            Content::class,
            1,
            [
                'type' => 'course',
            ]
        );
        $populator->execute();

        $this->contentPermissionService = $this->app->make(ContentPermissionService::class);
    }

    public function test_index()
    {
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
                    'id' => 2,
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
        $permission['name'] = $name;

        $response = $this->call(
            'PATCH',
            'railcontent/permission/' . 1,
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
        $response = $this->call('DELETE', 'railcontent/permission/1');

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
                                'id' => 1,
                            ],
                        ],
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 1,
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
                    'id' => 1,
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['content']
        );
    }

    public function test_assign_permission_to_specific_content_type()
    {
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
                                'id' => 1,
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
                    'id' => 1,
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
                                'id' => 1,
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
                                'id' => 1,
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
        $assigned = $this->contentPermissionService->create(null, 'course', 1);

        $this->assertEquals('course', $assigned->getContentType());
        $this->assertEquals(
            1,
            $assigned->getPermission()
                ->getId()
        );
    }

    public function test_assign_permission_to_specific_content_service_result()
    {
        $assigned = $this->contentPermissionService->create(1, null, 1);

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
        $this->contentPermissionService->create(1, null, 1);
        $data = [
            'data' => [
                'type' => 'contentPermission',
                'relationships' => [
                    'permission' => [
                        'data' => [
                            'type' => 'permission',
                            'id' => 1,
                        ],
                    ],
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => 1,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'permission_id' => 1,
                'content_id' => 1,
            ]
        );

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            [
                'permission_id' => 1,
                'content_id' => 1,
            ]
        );
    }

    public function test_dissociation_by_content_type()
    {
        $this->contentPermissionService->create(null, 'course', 1);

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
                            'id' => 1,
                        ],
                    ],
                ],
            ],
        ];

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            ['content_type' => 'course', 'permission_id' => 1]
        );

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            ['content_type' => 'course', 'permission_id' => 1]
        );
    }
}
