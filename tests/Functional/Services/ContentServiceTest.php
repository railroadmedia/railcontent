<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentServiceTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $datumFactory;

    /**
     * @var ContentHierarchyRepository
     */
    protected $contentHierarchyRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentService::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
    }

    public function test_delete_content()
    {
        $parent = $this->contentFactory->create();
        $content = $this->contentFactory->create();
        $otherContent = $this->contentFactory->create();
        for ($i = 0; $i < 3; $i++) {
            $expectedFields = $this->fieldFactory->create($content['id']);
            $expectedData[] = $this->datumFactory->create($content['id']);
            $permission = $this->permissionFactory->create();
            $contentPermission = $this->contentPermissionFactory->create(
                $content['id'],
                null,
                $permission['id']
            );
            $children = $this->contentHierarchyFactory->create($content['id']);
        }

        $parentLink = $this->contentHierarchyFactory->create($parent['id'], $content['id'], 1);

        $otherChildLink = $this->contentHierarchyFactory->create($parent['id'], $otherContent['id'], 2);

        $results = $this->classBeingTested->delete($content['id']);

        //check that the results it's true
        $this->assertTrue($results);

        //check that the content fields are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentFields,
            [
                'content_id' => $content['id']
            ]
        );

        //check that the content datum are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'content_id' => $content['id']
            ]
        );

        //check that the link with the parent was deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $content['id']
            ]
        );

        //check that the other children are repositioned correctly
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $otherContent['id'],
                'child_position' => 1
            ]
        );

        //check the the links with the content children are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $content['id']
            ]
        );

        //check that the content it's deleted
       $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $content['id']
            ]
        );

        //check that the links with the permissions are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentPermissions,
            [
                'content_id' => $content['id']
            ]
        );
    }
}
