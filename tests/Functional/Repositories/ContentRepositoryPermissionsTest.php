<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryPermissionsTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
    }

    protected function tearDown()
    {
        PermissionRepository::$availableContentPermissionIds = false;
    }

    public function test_get_by_id_is_protected_by_single()
    {
        $content = $this->contentFactory->create();
        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create([$permission['id'], $content['id']]);

        PermissionRepository::$availableContentPermissionIds = [];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_protected_by_multiple()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create([$permission['id'], $content['id']]);

        $otherPermission = $this->permissionFactory->create([$this->faker->word]);
        $otherContentPermission =
            $this->contentPermissionFactory->create([$permission['id'], $content['id']]);

        PermissionRepository::$availableContentPermissionIds = [];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_satisfiable_by_single()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create([$permission['id'], $content['id']]);

        PermissionRepository::$availableContentPermissionIds = [$permission['id']];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content, $response);
    }

    public function test_get_by_id_is_satisfiable_by_multiple()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create([$permission['id'], $content['id']]);

        $otherPermission = $this->permissionFactory->create([$this->faker->word]);
        $otherContentPermission =
            $this->contentPermissionFactory->create([$otherPermission['id'], $content['id']]);

        PermissionRepository::$availableContentPermissionIds = [$otherPermission['id']];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content, $response);
    }

    public function test_get_by_id_is_protected_by_single_type()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create(
            [$permission['id'], null, $content['type']]
        );

        PermissionRepository::$availableContentPermissionIds = [];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_protected_by_multiple_type()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create(
            [$permission['id'], null, $content['type']]
        );

        $otherPermission = $this->permissionFactory->create([$this->faker->word]);
        $otherContentPermission =
            $this->contentPermissionFactory->create([$permission['id'], null, $content['type']]);

        PermissionRepository::$availableContentPermissionIds = [];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertNull($response);
    }

    public function test_get_by_id_is_satisfiable_by_single_type()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create(
            [$permission['id'], null, $content['type']]
        );

        PermissionRepository::$availableContentPermissionIds = [$permission['id']];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content, $response);
    }

    public function test_get_by_id_is_satisfiable_by_multiple_type()
    {
        $content = $this->contentFactory->create();

        $permission = $this->permissionFactory->create([$this->faker->word]);
        $contentPermission = $this->contentPermissionFactory->create(
            [$permission['id'], null, $content['type']]
        );

        $otherPermission = $this->permissionFactory->create([$this->faker->word]);
        $otherContentPermission =
            $this->contentPermissionFactory->create([$otherPermission['id'], null, $content['type']]);

        PermissionRepository::$availableContentPermissionIds = [$otherPermission['id']];

        $response = $this->classBeingTested->getById($content['id']);

        $this->assertEquals($content, $response);
    }

}