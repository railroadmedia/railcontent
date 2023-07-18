<?php


namespace Railroad\Railcontent\Tests\Functional\Commands;

use Cache;
use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CreatePermissionTest extends RailcontentTestCase
{
    protected PermissionService $permissionService;

    protected PermissionsFactory $permissionFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->permissionService = $this->app->make(PermissionService::class);

        // things are a little finicky with doing a clear setup before each test, so make sure we clear out any permissions
        $existingPermissions = $this->permissionService->getAll();
        foreach ($existingPermissions as $existingPermission) {
            $this->permissionService->permissionRepository->delete($existingPermission["id"]);
        }
    }

    public function test_command_requires_valid_brand()
    {
        $this->artisan('content:createPermission foo "A new permission"')
            ->expectsOutput("foo is not a valid brand")
            ->assertFailed();
    }

    public function test_creates_a_new_permission()
    {
        $permissions = $this->permissionService->getAll();
        $this->assertEmpty($permissions);

        $this->artisan('content:createPermission drumeo "A new permission"')
            ->expectsOutput("Creating new permission for drumeo, named 'A new permission'")
            ->expectsOutput("New permission for drumeo, named 'A new permission' successfully created")
            ->assertSuccessful();

        $permissions = $this->permissionService->getAll();
        $this->assertCount(1, $permissions);

        $permission = $permissions[0];
        $this->assertSame("drumeo", $permission["brand"]);
        $this->assertSame("A new permission", $permission["name"]);
    }


    public function test_new_permission_is_available_in_cache()
    {
        $newPermissionName = "Some new permission";
        $newPermissionBrand = "pianote";

        for ($i = 0; $i < 5; $i++){
            $this->permissionFactory->create($i);
        }

        // directly check the cache, because the permission service normally handles this for us
        $hash = 'permissions_' . CacheHelper::getKey();
        $cacheResults = CacheHelper::getCachedResultsForKey($hash);
        $this->assertEmpty($cacheResults);

        // use the permission service, so that it will cache the results
        $serviceResults = $this->permissionService->getAll();
        $this->assertCount(5, $serviceResults);

        $this->assertTrue(collect($serviceResults)->contains("name", "1"));
        $this->assertFalse(collect($serviceResults)->contains("name", $newPermissionName));

        // retrieve the cache directly to ensure it's working as expected
        $cacheResults = CacheHelper::getCachedResultsForKey($hash);

        $this->assertTrue(collect($cacheResults)->contains("name", "1"));
        $this->assertFalse(collect($cacheResults)->contains("name", $newPermissionName));

        // use the command to create a new permission
        $this->artisan("content:createPermission", ["brand" => $newPermissionBrand, "name" => $newPermissionName]);

        // the permission service clears the cache when creating a new permission
        $cacheResults = CacheHelper::getCachedResultsForKey($hash);
        $this->assertEmpty($cacheResults);

        // use the permission service, and ensure it cached all the results
        $serviceResults = $this->permissionService->getAll();
        $this->assertCount(6, $serviceResults);
        $this->assertTrue(collect($serviceResults)->contains("name", "1"));
        $this->assertTrue(collect($serviceResults)->contains("name", $newPermissionName));
        // retrieve the cache directly to ensure it's working as expected
        $cacheResults = CacheHelper::getCachedResultsForKey($hash);
        $this->assertTrue(collect($cacheResults)->contains("name", "1"));
        $this->assertTrue(collect($cacheResults)->contains("name", $newPermissionName));
        $this->assertTrue(collect($cacheResults)->contains("brand", $newPermissionBrand));

        // DEV NOTE: the permission service's getByName function isn't actually used anywhere, so testing with it is redundant
        // $newPermission = $this->permissionService->getByName($newPermissionName)[0];
        // $this->assertSame($newPermissionName, $newPermission['name']);
        // $this->assertSame($newPermissionBrand, $newPermission['brand']);
    }
}
