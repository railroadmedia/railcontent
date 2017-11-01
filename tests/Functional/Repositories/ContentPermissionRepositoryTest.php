<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentPermissionRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentPermissionRepository
     */
    protected $classBeingTested;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentPermissionRepository::class);
        $this->permissionRepository = $this->app->make(PermissionRepository::class);
    }

    public function test_assign_permission_to_specific_content()
    {
        $name = $this->faker->word;

        $id = $this->permissionRepository->create(['name' => $name]);

        $contentId = $this->faker->randomNumber();

        $this->classBeingTested->assign($contentId, null, $id);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'content_id' => $contentId,
                'content_type' => null,
                'permission_id' => $id
            ]
        );
    }

    public function test_assign_permission_to_content_type()
    {
        $name = $this->faker->word;

        $id = $this->permissionRepository->create(['name' => $name]);

        $contentType = $this->faker->word;

        $this->classBeingTested->assign(null, $contentType, $id);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'content_id' => null,
                'content_type' => $contentType,
                'permission_id' => $id
            ]
        );
    }
}
