<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
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
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var  ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);

        $this->classBeingTested = $this->app->make(ContentPermissionRepository::class);
        $this->permissionRepository = $this->app->make(PermissionRepository::class);
    }

    public function test_assign_permission_to_specific_content()
    {
        $permission = $this->permissionFactory->create();

        $contentId = $this->faker->randomNumber();

        $this->classBeingTested->assign($contentId, null, $permission['id']);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'content_id' => $contentId,
                'content_type' => null,
                'permission_id' => $permission['id']
            ]
        );
    }

    public function test_assign_permission_to_content_type()
    {
        $permission = $this->permissionFactory->create();

        $contentType = $this->faker->word;

        $this->classBeingTested->assign(null, $contentType, $permission['id']);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'content_id' => null,
                'content_type' => $contentType,
                'permission_id' => $permission['id']
            ]
        );
    }

    public function test_unlink_permission()
    {
        $permission = $this->permissionFactory->create();
        $assigmPermission = $this->contentPermissionFactory->create(rand(), null, $permission['id']);

        $this->classBeingTested->unlinkPermissionFromAllContent($permission['id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            [
                'id' => $permission['id']
            ]
        );
    }
}
