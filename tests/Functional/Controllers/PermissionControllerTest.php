<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\DataFixtures\PermissionFixtureLoader;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class PermissionControllerTest extends RailcontentTestCase
{
    /**
     * @var PermissionService
     */
    protected $serviceBeingTested;
    protected $userId;

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

        $purger = new ORMPurger();

        $executor = new ORMExecutor($this->entityManager, $purger);
        // dd($this->entityManager);
        $executor->execute([app(PermissionFixtureLoader::class)]);
        //
        //        $this->serviceBeingTested = $this->app->make(PermissionService::class);
        //        $this->classBeingTested = $this->app->make(PermissionRepository::class);
                $this->contentPermissionService = $this->app->make(ContentPermissionService::class);
        //
                $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        //        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
                $this->contentFactory = $this->app->make(ContentFactory::class);
        //
        //        $this->userId = $this->createAndLogInNewUser();
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
                    'name' => 'permission 1',
                    'brand' => ConfigService::$brand,
                ],
            ],
            $response->decodeResponseJson()
        );

    }

    public function test_store_response()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $permission = [
            'id' => 2,
            'name' => $name,
        ];

        $response = $this->call(
            'PUT',
            'railcontent/permission',
            [
                'name' => $name,
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            array_add($permission, 'brand', ConfigService::$brand),
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
                    "source" => "name",
                    "detail" => "The name field is required.",
                ],
            ],
            $response->decodeResponseJson('meta')['errors']
        );
    }

    public function test_update_response()
    {
        $name = $this->faker->word;

        $response = $this->call(
            'PATCH',
            'railcontent/permission/' . 1,
            [
                'name' => $name,
            ]
        );

        $this->assertEquals(201, $response->status());

        $response->assertJson(
            [
                'id' => '1',
                'name' => $name,
            ]
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
                'name' => $name,
            ]
        );

        $this->assertEquals(404, $response->status());

        $this->assertEquals(
            'Update failed, permission not found with id: ' . $id,
            $response->decodeResponseJson('meta')['errors']['detail']
        );
    }

    public function test_update_validation()
    {
        $response = $this->call('PATCH', 'railcontent/permission/1');

        $this->assertEquals(422, $response->status());

        $expectedErrors = [
            "source" => "name",
            "detail" => "The name field is required.",
        ];

        $this->assertEquals([$expectedErrors], $response->decodeResponseJson('meta')['errors']);
    }

     public function test_delete_permission_response()
    {
        $response = $this->call('DELETE', 'railcontent/permission/1');

        $this->assertEquals(204, $response->status());
        $this->assertEquals('', $response->content());
    }

    public function test_delete_missing_permission_response()
    {
        $id = rand(2,10);
        $response = $this->call('DELETE', 'railcontent/permission/'.$id);

        $this->assertEquals(404, $response->status());
        $this->assertEquals(
            'Delete failed, permission not found with id: '.$id,
            $response->decodeResponseJson('meta')['errors']['detail']
        );
    }


    public function test_assign_permission_to_specific_content()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission->getId(),
                'content_id' => $content->getId(),
            ]
        );

        $expectedResults = [
            "id" => "1",
            "content" => $this->serializer->toArray($content),
            "content_type" => null,
            "permission" => $this->serializer->toArray($permission),
            "brand" => ConfigService::$brand
        ];

        $this->assertEquals(200, $response->status());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')[0]);
    }

    public function test_assign_permission_to_specific_content_type()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission->getId(),
                'content_type' => $content->getType(),
            ]
        );

        $this->assertEquals(200, $response->status());
    }

    public function test_assign_permission_validation()
    {
        $randomPermissionId = $this->faker->numberBetween();
        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $randomPermissionId,
            ]
        );

        $decodedResponse = $response->decodeResponseJson('meta');

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
                'detail' => 'The content type field is required when none of content id are present.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_incorrect_content_id()
    {
        $permission = $this->permissionFactory->create();
        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission->getId(),
                'content_id' => rand(),
            ]
        );

        $decodedResponse = $response->decodeResponseJson('meta');

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);

        $expectedErrors = [
            [
                'source' => 'content_id',
                'detail' => 'The selected content id is invalid.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_incorrect_content_type()
    {
        $permission = $this->permissionFactory->create();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission->getId(),
                'content_type' => $this->faker->word,
            ]
        );

        $decodedResponse = $response->decodeResponseJson('meta');

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);

        $expectedErrors = [
            [
                'source' => 'content_type',
                'detail' => 'The selected content type is invalid.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_to_content_type_service_result()
    {
        $permission = $this->permissionFactory->create();
        $contentType = $this->faker->word;
        $assigned = $this->contentPermissionService->create(null, $contentType, $permission->getId());

        $this->assertEquals(
            [
                'id' => 1,
                'content' => null,
                'content_type' => $contentType,
                'permission' => $this->serializer->toArray($permission),
                'brand' => ConfigService::$brand,
            ],
            $this->serializer->toArray($assigned)
        );
    }

    public function test_assign_permission_to_specific_content_service_result()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create();
        $assigned = $this->contentPermissionService->create($content->getId(), null, $permission->getId());

        $this->assertEquals(
            [
                'id' => 1,
                'content' => $this->serializer->toArray($content),
                'content_type' => null,
                'permission' => $this->serializer->toArray($permission),
                'brand' => $permission->getBrand(),
            ],
            $this->serializer->toArray($assigned)
        );
    }

    public function test_dissociation_by_content_id()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $this->contentPermissionService->create($content->getId(), null, $permission->getId());
        $data = ['content_id' => $content->getId(), 'permission_id' => $permission->getId()];
        $this->assertDatabaseHas(ConfigService::$tableContentPermissions, $data);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());
       // $this->assertEquals(1, $response->decodeResponseJson('data')[0][0]);
        $this->assertDatabaseMissing(ConfigService::$tableContentPermissions, $data);
    }

    public function test_dissociation_by_content_type()
    {
        $permission = $this->permissionFactory->create();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $this->contentPermissionService->create(null, $content->getType(), $permission->getId());
        $data = ['content_type' => $content->getType(), 'permission_id' => $permission->getId()];
        $this->assertDatabaseHas(ConfigService::$tableContentPermissions, $data);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing(ConfigService::$tableContentPermissions, $data);
    }
}
