<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserPermissionsJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;

    public function setUp()
    {
        parent::setUp();
        $this->permissionRepository     = $this->app->make(PermissionRepository::class);
        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);
    }

    public function test_store_validation()
    {
        $results = $this->call('PUT', 'railcontent/user-permission',
            [
                'user_id'       => $this->faker->numberBetween(),
                'permission_id' => $this->faker->numberBetween(),
                'start_date'    => Carbon::now()->toDateTimeString()
            ]);

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals([
            [
                'source' => 'permission_id',
                'detail' => 'The selected permission id is invalid.'
            ]
        ], $results->decodeResponseJson('meta')['errors']);
    }

    public function test_store()
    {
        $permission = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);
        $userId     = $this->faker->numberBetween();
        $results    = $this->call('PUT', 'railcontent/user-permission',
            [
                'user_id'       => $userId,
                'permission_id' => $permission,
                'start_date'    => Carbon::now()->toDateTimeString()
            ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset([
            'user_id'         => $userId,
            'permissions_id'  => $permission,
            'start_date'      => Carbon::now()->toDateTimeString(),
            'expiration_date' => null,
            'created_on'      => Carbon::now()->toDateTimeString(),
            'updated_on'      => null
        ], $results->decodeResponseJson('data')[0]);
        $this->assertDatabaseHas(
            ConfigService::$tableUserPermissions,
            [
                'user_id'         => $userId,
                'permissions_id'  => $permission,
                'start_date'      => Carbon::now()->toDateTimeString(),
                'expiration_date' => null,
                'created_on'      => Carbon::now()->toDateTimeString(),
                'updated_on'      => null
            ]);
    }

    public function test_update()
    {
        $permission = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);
        $userId     = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => $permission,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $results        = $this->call('PATCH', 'railcontent/user-permission/' . $userPermission,
            [
                'expiration_date' => Carbon::now()->addMonth(1)->toDateTimeString()
            ]);
        $this->assertEquals(201, $results->getStatusCode());
        $this->assertArraySubset([
            'user_id'         => $userId,
            'permissions_id'  => $permission,
            'start_date'      => Carbon::now()->toDateTimeString(),
            'expiration_date' => Carbon::now()->addMonth(1)->toDateTimeString(),
            'created_on'      => Carbon::now()->toDateTimeString(),
            'updated_on'      => Carbon::now()->toDateTimeString()
        ], $results->decodeResponseJson('data')[0]);
        $this->assertDatabaseHas(
            ConfigService::$tableUserPermissions,
            [
                'user_id'         => $userId,
                'permissions_id'  => $permission,
                'start_date'      => Carbon::now()->toDateTimeString(),
                'expiration_date' => Carbon::now()->addMonth(1)->toDateTimeString(),
                'created_on'      => Carbon::now()->toDateTimeString(),
                'updated_on'      => Carbon::now()->toDateTimeString()
            ]);
    }

    public function test_update_user_permission_not_exists()
    {
        $randomId = rand();
        $results  = $this->call('PATCH', '/railcontent/user-permission/' . $randomId);
        $this->assertEquals(404, $results->getStatusCode());
        $this->assertEquals([
            'title'  => 'Entity not found.',
            'detail' => 'Update failed, user permission not found with id: ' . $randomId
        ], $results->decodeResponseJson('meta')['errors']);
    }

    public function test_update_validation()
    {
        $permission = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);
        $userId     = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => $permission,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $results        = $this->call('PATCH', 'railcontent/user-permission/' . $userPermission,
            [
                'permission_id' => rand(),
                'start_date'    => $this->faker->word
            ]);
        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals([
            [
                'source' => 'permission_id',
                'detail' => 'The selected permission id is invalid.'
            ],
            [
                "source" => "start_date",
                "detail" => "The start date is not a valid date."
            ]
        ], $results->decodeResponseJson('meta')['errors']);
    }

    public function test_delete_user_permission_not_exist()
    {
        $randomId = rand();
        $results  = $this->call('DELETE', '/railcontent/user-permission/' . $randomId);
        $this->assertEquals(404, $results->getStatusCode());
        $this->assertEquals([
            'title'  => 'Entity not found.',
            'detail' => 'Delete failed, user permission not found with id: ' . $randomId
        ], $results->decodeResponseJson('meta')['errors']);
    }

    public function test_delete_user_permission()
    {
        $permission = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);
        $userId     = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => $userId,
            'permissions_id' => $permission,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $results        = $this->call('DELETE', '/railcontent/user-permission/' . $permission);
        $this->assertEquals(204, $results->getStatusCode());

        $this->assertDatabaseMissing(
            ConfigService::$tableUserPermissions,
            [
                'id'              => $userPermission,
                'user_id'         => $userId,
                'permissions_id'  => $permission,
                'start_date'      => Carbon::now()->toDateTimeString(),
                'expiration_date' => null,
                'created_on'      => Carbon::now()->toDateTimeString(),
                'updated_on'      => null
            ]);
    }

    public function test_index_all_active_permissions()
    {
        $permission1 = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);

        $permission2 = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => 1,
            'permissions_id' => $permission1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => 2,
            'permissions_id' => $permission1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id'         => 1,
            'permissions_id'  => $permission2,
            'start_date'      => Carbon::now()->toDateTimeString(),
            'expiration_date' => Carbon::now()->subMonth(1)->toDateTimeString(),
            'created_on'      => Carbon::now()->toDateTimeString()
        ]);

        //pull all the active user permissions
        $results = ($this->call('GET', '/railcontent/user-permission'));

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(2 , count($results->decodeResponseJson('data')));
    }

    public function test_index_specific_user_active_permissions()
    {
        $permission1 = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);

        $permission2 = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => 1,
            'permissions_id' => $permission1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => 2,
            'permissions_id' => $permission1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id'         => 1,
            'permissions_id'  => $permission2,
            'start_date'      => Carbon::now()->toDateTimeString(),
            'expiration_date' => Carbon::now()->subMonth(1)->toDateTimeString(),
            'created_on'      => Carbon::now()->toDateTimeString()
        ]);

        //pull all the active user permissions
        $results = $this->call('GET', '/railcontent/user-permission',[
            'user_id' => 1
    ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(1 , count($results->decodeResponseJson('data')));
    }

    public function test_index_pull_active_and_expired_user_permissions()
    {
        $permission1 = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);

        $permission2 = $this->permissionRepository->create([
            'name'  => $this->faker->word,
            'brand' => ConfigService::$brand
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => 1,
            'permissions_id' => $permission1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);
        $userPermission = $this->userPermissionRepository->create([
            'user_id'        => 2,
            'permissions_id' => $permission1,
            'start_date'     => Carbon::now()->toDateTimeString(),
            'created_on'     => Carbon::now()->toDateTimeString()
        ]);

        $userPermission = $this->userPermissionRepository->create([
            'user_id'         => 1,
            'permissions_id'  => $permission2,
            'start_date'      => Carbon::now()->toDateTimeString(),
            'expiration_date' => Carbon::now()->subMonth(1)->toDateTimeString(),
            'created_on'      => Carbon::now()->toDateTimeString()
        ]);

        //pull all the active user permissions
        $results = $this->call('GET', '/railcontent/user-permission',[
            'only_active' => false
        ]);

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(3 , count($results->decodeResponseJson('data')));
    }
}
