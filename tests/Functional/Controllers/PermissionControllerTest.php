<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionControllerTest extends RailcontentTestCase
{
    protected $serviceBeingTested, $userId;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    /** @var  ContentFactory */
    protected $contentFactory;

    /**
     * @var ContentPermissionService
     */
    protected $contentPermissionService;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(PermissionService::class);
        $this->classBeingTested = $this->app->make(PermissionRepository::class);
        $this->contentPermissionService = $this->app->make(ContentPermissionService::class);

        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);

        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_store_response()
    {
        $name = $this->faker->word;
        $permission = [
            'id' => 1,
            'name' => $name
        ];

        $response = $this->call('PUT', 'railcontent/permission', [
            'name' => $name
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(array_add($permission,'brand', ConfigService::$brand), json_decode($response->content(), true)['results']);
    }

    public function test_store_validation()
    {
        $response = $this->call('PUT', 'railcontent/permission');

        $this->assertEquals(422, $response->status());
        $this->assertContains('name', array_column(json_decode($response->getContent())->errors, 'source'));
    }

    public function test_new_permission_returned_after_store_service()
    {
        $name = $this->faker->word;

        $permission = $this->serviceBeingTested->create($name);

        $expectedResult = [
            'id' => 1,
            'name' => $name
        ];

        $this->assertEquals(array_add($expectedResult, 'brand', ConfigService::$brand), $permission);
    }

    public function test_update_response()
    {
        $permission = $this->permissionFactory->create();

        $name = $this->faker->word;

        $response = $this->call('PATCH', 'railcontent/permission/' . $permission['id'], [
            'name' => $name
        ]);

        $this->assertEquals(201, $response->status());

        $response->assertJson(
            [
                'results' =>
                    [
                        'id' => '1',
                        'name' => $name
                    ]
            ]
        );
    }

    public function test_update_not_exist_permission()
    {

        $name = $this->faker->word;

        $response = $this->call('PATCH', 'railcontent/permission/1', [
            'name' => $name
        ]);

        $this->assertEquals(404, $response->status());

        $this->assertEquals('Update failed, permission not found with id: 1', json_decode($response->content())->error->detail);
    }

    public function test_update_validation()
    {
        $permission = $this->permissionFactory->create();


        $response = $this->call('PATCH', 'railcontent/permission/' . $permission['id']);

        $this->assertEquals(422, $response->status());

        $expectedErrors = [
            "source" => "name",
            "detail" => "The name field is required."
        ];

        $this->assertEquals([$expectedErrors], json_decode($response->getContent(), true)['errors']);
    }

    public function test_updated_permission_returned_after_update_service()
    {
        $permission = $this->permissionFactory->create();

        $newName = $this->faker->word;

        $updatedPermission = $this->serviceBeingTested->update($permission['id'], $newName);

        $permission['name'] = $newName;
        $permission['brand'] = ConfigService::$brand;

        $this->assertEquals($permission, $updatedPermission);
    }

    public function test_delete_permission_response()
    {
        $permission = $this->permissionFactory->create();

        $response = $this->call('DELETE', 'railcontent/permission/' . $permission['id']);

        $this->assertEquals(204, $response->status());
        $this->assertEquals('', $response->content());
    }

    public function test_delete_missing_permission_response()
    {
        $response = $this->call('DELETE', 'railcontent/permission/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('Delete failed, permission not found with id: 1', json_decode($response->content())->error->detail);
    }


    public function test_delete_permission_service_result()
    {
        $permission = $this->permissionFactory->create();
        $assignPemission = $this->contentPermissionFactory->create(rand(), null, $permission['id']);

        $delete = $this->serviceBeingTested->delete($permission['id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            [
                'id' => $assignPemission['id']
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tablePermissions,
            [
                'name' => $permission['name']
            ]
        );

        $this->assertTrue($delete);
    }

    public function test_delete_permission_when_permission_not_exist_service_result()
    {
        $delete = $this->serviceBeingTested->delete(1);

        $this->assertNull($delete);
    }

    public function test_assign_permission_to_specific_content()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
            'permission_id' => $permission['id'],
            'content_id' => $content['id']
        ]);

        $expectedResults = $this->createExpectedResult("ok", "200", [
            "id" => "1",
            "content_id" => $content['id'],
            "content_type" => null,
            "permission_id" => $permission['id'],
            "name" => $permission['name'],
            "brand" => ConfigService::$brand
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_assign_permission_to_specific_content_type()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
            'permission_id' => $permission['id'],
            'content_type' => $content['type']
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function test_assign_permission_validation()
    {
        $randomPermissionId = $this->faker->numberBetween();
        $response = $this->call('PUT', 'railcontent/permission/assign', [
            'permission_id' => $randomPermissionId
        ]);

        $decodedResponse = $response->decodeResponseJson();

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);

        $expectedErrors = [
            [
                'source' => 'permission_id',
                'detail' => 'The selected permission id is invalid.',
            ],
            [
                'source' => 'content_id',
                'detail' => 'The content id field is required when none of content type are present.',
            ],
            [
                'source' => 'content_type',
                'detail' => 'The content type field is required when none of content id are present.'
            ]
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_incorrect_content_id()
    {
        $permission = $this->permissionFactory->create();

        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
            'permission_id' => $permission['id'],
            'content_id' => ($content['id'] + 1)
        ]);

        $decodedResponse = $response->decodeResponseJson();

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);

        $expectedErrors = [
            [
                'source' => 'content_id',
                'detail' => 'The selected content id is invalid.',
            ]
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_incorrect_content_type()
    {
        $permission = $this->permissionFactory->create();

        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
            'permission_id' => $permission['id'],
            'content_type' => $this->faker->word
        ]);

        $decodedResponse = $response->decodeResponseJson();

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);

        $expectedErrors = [
            [
                'source' => 'content_type',
                'detail' => 'The selected content type is invalid.',
            ]
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_to_content_type_service_result()
    {
        $permission = $this->permissionFactory->create();
        $contentType = $this->faker->word;
        $assigned = $this->contentPermissionService->create(null, $contentType, $permission['id']);

        $this->assertEquals([
            'id' => 1,
            'content_id' => null,
            'content_type' => $contentType,
            'permission_id' => $permission['id'],
            'name' => $permission['name'],
            'brand' => ConfigService::$brand
        ], $assigned);
    }

    public function test_assign_permission_to_specific_content_service_result()
    {
        $permission = $this->permissionFactory->create();
        $contentId = $this->faker->numberBetween();
        $assigned = $this->contentPermissionService->create($contentId, null, $permission['id']);

        $this->assertEquals([
            'id' => 1,
            'content_id' => $contentId,
            'content_type' => null,
            'permission_id' => $permission['id'],
            'name' => $permission['name'],
            'brand' => $permission['brand']
        ], $assigned);
    }

    public function test_dissociation_by_content_id()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create();
        $this->contentPermissionService->create($content['id'], null, $permission['id']);
        $data = [ 'content_id' => $content['id'], 'permission_id' => $permission['id'] ];
        $this->assertDatabaseHas(ConfigService::$tableContentPermissions, $data);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(1, json_decode($response->content(), true)['results']);
        $this->assertDatabaseMissing(ConfigService::$tableContentPermissions, $data);
    }

    public function test_dissociation_by_content_type(){
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create();
        $this->contentPermissionService->create(null, $content['type'], $permission['id']);
        $data = [ 'content_type' => $content['type'], 'permission_id' => $permission['id'] ];
        $this->assertDatabaseHas(ConfigService::$tableContentPermissions, $data);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(1, json_decode($response->content(), true)['results']);
        $this->assertDatabaseMissing(ConfigService::$tableContentPermissions, $data);
    }
}
