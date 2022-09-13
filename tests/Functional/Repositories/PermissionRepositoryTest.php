<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionRepositoryTest extends RailcontentTestCase
{
    /**
     * @var PermissionRepository
     */
    protected $classBeingTested;
    /**
     * @var PermissionsFactory
     */
    protected $permissionsFactory;

    public function test_create_permission()
    {
        $name = $this->faker->word;
        $brand = $this->faker->word;

        $id = $this->classBeingTested->create(['name' => $name, 'brand' => $brand]);

        $this->assertEquals(1, $id);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'name' => $name,
                'brand' => $brand,
            ]
        );
    }

    public function test_update_permission_name()
    {
        $permission = $this->permissionsFactory->create();

        $newName = $this->faker->word;
        $newBrand = $this->faker->word;

        $result =
            $this->classBeingTested->update($permission['id'], ['name' => $newName, 'brand' => $newBrand]);

        $this->assertEquals(1, $result);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            ['name' => $newName, 'brand' => $newBrand]
        );
    }

    public function test_delete_permission()
    {
        $permission = $this->permissionsFactory->create();

        $result = $this->classBeingTested->delete($permission['id']);

        $this->assertTrue($result);

        $this->assertDatabaseMissing(
            ConfigService::$tablePermissions,
            [
                'name' => $permission['name'],
                'brand' => $permission['brand'],
            ]
        );
    }

    public function test_get_permission_by_id()
    {
        $permission = $this->permissionsFactory->create();

        $response = $this->classBeingTested->getById($permission['id']);

        $this->assertEquals(
            $permission,
            $response
        );
    }

    public function test_get_permission_by_id_none_exist()
    {
        $response = $this->classBeingTested->getById(rand());

        $this->assertEmpty($response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PermissionRepository::class);
        $this->permissionsFactory = $this->app->make(PermissionsFactory::class);
    }
}
