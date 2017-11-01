<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionRepositoryTest extends RailcontentTestCase
{
    /**
     * @var PermissionRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PermissionRepository::class);
    }

    public function test_create_permission()
    {
        $name = $this->faker->word;

        $id = $this->classBeingTested->create(['name' => $name]);

        $this->assertEquals(1, $id);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'name' => $name
            ]
        );
    }

    public function test_update_permission_name()
    {
        $name = $this->faker->word;

        $id = $this->classBeingTested->create(['name' => $name]);

        $newName = $this->faker->word;

        $id = $this->classBeingTested->update($id, ['name' => $newName]);

        $this->assertEquals(1, $id);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'name' => $newName
            ]
        );
    }

    public function test_delete_permission()
    {
        $name = $this->faker->word;

        $id = $this->classBeingTested->create(['name' => $name]);

        $result = $this->classBeingTested->delete($id);

        $this->assertTrue($result);

        $this->assertDatabaseMissing(
            ConfigService::$tablePermissions,
            [
                'name' => $name
            ]
        );
    }

    public function test_get_permission_by_id()
    {
        $name = $this->faker->word;

        $id = $this->classBeingTested->create(['name' => $name]);

        $response = $this->classBeingTested->getById($id);

        $this->assertEquals(
            ['id' => $id, 'name' => $name],
            $response
        );
    }

    public function test_get_permission_by_id_none_exist()
    {
        $response = $this->classBeingTested->getById(rand());

        $this->assertEmpty($response);
    }
}
