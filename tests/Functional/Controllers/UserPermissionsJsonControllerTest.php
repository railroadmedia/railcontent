<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserPermissionsJsonControllerTest extends RailcontentTestCase
{
    use ArraySubsetAsserts;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;

    /**
     * @var ContentPermissionRepository
     */
    private $contentPermissionRepository;

    /**
     * @var ContentFactory
     */
    private $contentFactory;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->permissionRepository = $this->app->make(PermissionRepository::class);
        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);
        $this->contentPermissionRepository = $this->app->make(ContentPermissionRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentRepository = $this->app->make(ContentRepository::class);
    }

    public function test_store_validation()
    {
        $results = $this->call('PUT', 'railcontent/user-permission', [
            'user_id' => $this->faker->numberBetween(),
            'permission_id' => $this->faker->numberBetween(),
            'start_date' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'permission_id',
                    'detail' => 'The selected permission id is invalid.',
                ],
            ],
            $results->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_store()
    {
        $permission = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);
        $contentPermission = $this->contentPermissionRepository->create([
            'content_id' => 1,
            'permission_id' => $permission,
        ]);
        $userId = $this->createAndLogInNewUser();
        $results = $this->call('PUT', 'railcontent/user-permission', [
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => null,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $results->decodeResponseJson()
                ->json('data')[0]
        );
        $this->assertDatabaseHas(ConfigService::$tableUserPermissions, [
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => null,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
    }

    public function test_update()
    {
        $permission = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);
        $userId = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $results = $this->call('PUT', 'railcontent/user-permission', [
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => Carbon::now()
                ->addMonth(1)
                ->toDateTimeString(),
        ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $results->decodeResponseJson()
                ->json('data')[0]
        );
        $this->assertDatabaseHas(ConfigService::$tableUserPermissions, [
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => Carbon::now()
                ->addMonth(1)
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
    }

    public function test_update_validation()
    {
        $permission = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);
        $userId = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
        $results = $this->call('PUT', 'railcontent/user-permission', [
            'user_id' => $userId,
            'permission_id' => rand(),
            'start_date' => $this->faker->word,
        ]);
        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'permission_id',
                    'detail' => 'The selected permission id is invalid.',
                ],
                [
                    "source" => "start_date",
                    "detail" => "The start date is not a valid date.",
                ],
            ],
            $results->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_delete_user_permission_not_exist()
    {
        $randomId = rand();
        $results = $this->call('DELETE', '/railcontent/user-permission/' . $randomId);
        $this->assertEquals(404, $results->getStatusCode());
        $this->assertEquals(
            [
                'title' => 'Entity not found.',
                'detail' => 'Delete failed, user permission not found with id: ' . $randomId,
            ],
            $results->decodeResponseJson()
                ->json('meta')['errors']
        );
    }

    public function test_delete_user_permission()
    {
        $permission = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);
        $userId = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
        $results = $this->call('DELETE', '/railcontent/user-permission/' . $permission);
        $this->assertEquals(204, $results->getStatusCode());

        $this->assertDatabaseMissing(ConfigService::$tableUserPermissions, [
            'id' => $userPermission,
            'user_id' => $userId,
            'permission_id' => $permission,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => null,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'updated_on' => null,
        ]);
    }

    public function test_index_all_active_permissions()
    {
        $permission1 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);

        $permission2 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 1,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 2,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 1,
            'permission_id' => $permission2,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => Carbon::now()
                ->subMonth(1)
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        //pull all the active user permissions
        $results = ($this->call('GET', '/railcontent/user-permission', [
            'only_active' => true,
        ]));

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(
            2,
            count(
                $results->decodeResponseJson()
                    ->json('data')
            )
        );
    }

    public function test_index_specific_user_active_permissions()
    {
        $permission1 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);

        $permission2 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 1,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 2,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 1,
            'permission_id' => $permission2,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => Carbon::now()
                ->subMonth(1)
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        //pull all the active user permissions
        $results = $this->call('GET', '/railcontent/user-permission', [
            'user_id' => 1,
            'only_active' => true,
        ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(
            1,
            count(
                $results->decodeResponseJson()
                    ->json('data')
            )
        );
    }

    public function test_index_pull_active_and_expired_user_permissions()
    {
        $permission1 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);

        $permission2 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 1,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 2,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id' => 1,
            'permission_id' => $permission2,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'expiration_date' => Carbon::now()
                ->subMonth(1)
                ->toDateTimeString(),
            'created_on' => Carbon::now()
                ->toDateTimeString(),
        ]);

        //pull all the active user permissions
        $results = $this->call('GET', '/railcontent/user-permission', [
            'only_active' => false,
        ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(
            3,
            count(
                $results->decodeResponseJson()
                    ->json('data')
            )
        );
    }

    public function test_old_user_cache_deleted_when_new_user_permission_activate()
    {
        $userId = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create($this->faker->word, 'course', 'published');
        $content2 = $this->contentFactory->create($this->faker->word, 'course', 'published');

        $permission1 = $this->permissionRepository->create([
            'name' => $this->faker->word,
            'brand' => ConfigService::$brand,
        ]);
        sleep(1);

        $contentPermission = $this->contentPermissionRepository->assign(
            $content1['id'],
            null,
            $permission1
        );

        //only the content2 it's returned to the user
        $response = $this->call('GET', 'railcontent/content', [
                'included_types' => [$content2['type'], $content1['type']],
            ]

        );
        $this->assertArraySubset(
            [(array)$content2],
            $response->decodeResponseJson()
                ->json('data')
        );

        //assign permission to user
        $this->call('PUT', 'railcontent/user-permission', [
            'user_id' => $userId,
            'permission_id' => $permission1,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
        ]);

        sleep(1);

        //both contents are returned to user
        $response = $this->call('GET', 'railcontent/content', [
            'included_types' => [$content2['type'], $content1['type']],
            'sort' => 'id',
        ]);
        $this->assertArraySubset(
            [(array)$content1, (array)$content2],
            $response->decodeResponseJson()
                ->json('data')
        );
    }

    protected function tearDown(): void
    {
    }
}
