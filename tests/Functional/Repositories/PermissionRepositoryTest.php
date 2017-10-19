<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
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

        $permissionId = $this->classBeingTested->create($name);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'id' => $permissionId,
                'name' => $name,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );
    }

    public function test_update_permission_name()
    {
        $permission = [
            'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $newName = $this->faker->word;

        $this->classBeingTested->update($permissionId, $newName);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'id' => $permissionId,
                'name' => $newName,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );
    }

    public function test_delete_permission()
    {
        $permission = [
            'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $this->classBeingTested->delete($permissionId);

        $this->assertDatabaseMissing(
            ConfigService::$tablePermissions,
            [
                'id' => $permissionId
            ]
        );
    }

    public function test_get_permission_by_id()
    {
        $permission = [
            'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $response = $this->classBeingTested->getById($permissionId);

        $this->assertEquals(
            array_merge(['id' => $permissionId], $permission),
            $response
        );
    }

    public function test_get_permission_by_id_none_exist()
    {
        $response = $this->classBeingTested->getById(rand());

        $this->assertEquals(
            null,
            $response
        );
    }

    public function test_assign_permission_to_specific_content()
    {
        $permission = [
            'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentId = $this->faker->randomNumber();

        $this->classBeingTested->assign($permissionId, $contentId, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'id' => $permissionId,
                'content_id' => $contentId,
                'content_type' => null,
                'required_permission_id' => $permissionId
            ]
        );
    }

    public function test_assign_permission_to_content_type()
    {
        $permission = [
            'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $contentType = $this->faker->word;

        $this->classBeingTested->assign($permissionId, null, $contentType);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'id' => $permissionId,
                'content_id' => null,
                'content_type' => $contentType,
                'required_permission_id' => $permissionId
            ]
        );
    }
}
