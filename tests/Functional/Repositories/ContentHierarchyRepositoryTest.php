<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentHierarchyRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentHierarchyRepository::class);
    }

    public function test_create_new_link()
    {
        $parentId = rand();
        $childId = rand();
        $position = rand();

        $result = $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $childId, $position);

        $this->assertTrue($result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
                'child_position' => 1
            ]
        );
    }

    public function test_create_new_link_and_update_other_children()
    {
        $parentId = rand();
        $childId = 6;
        $position = 2;

        for ($i = 0; $i < 3; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $i + 1);
        }

        $result = $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $childId, $position);

        $this->assertTrue($result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
                'child_position' => $position
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 1,
                'child_position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 2,
                'child_position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 3,
                'child_position' => 4
            ]
        );
    }

    public function test_update_existing_link_larger_position_and_update_other_children()
    {
        $parentId = rand();
        $childId = 3;
        $position = 6;

        for ($i = 0; $i < 8; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $i + 1);
        }

        $result = $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $childId, $position);

        $this->assertTrue($result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
                'child_position' => $position
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 1,
                'child_position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 2,
                'child_position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 4,
                'child_position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 5,
                'child_position' => 4
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 6,
                'child_position' => 5
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 7,
                'child_position' => 7
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 8,
                'child_position' => 8
            ]
        );
    }

    public function test_update_existing_link_smaller_position_and_update_other_children()
    {
        $parentId = rand();
        $childId = 7;
        $position = 2;

        for ($i = 0; $i < 8; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $i + 1);
        }

        $result = $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $childId, $position);

        $this->assertTrue($result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
                'child_position' => $position
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 1,
                'child_position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 2,
                'child_position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 3,
                'child_position' => 4
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 4,
                'child_position' => 5
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 5,
                'child_position' => 6
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 6,
                'child_position' => 7
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 8,
                'child_position' => 8
            ]
        );
    }

    public function test_update_link_using_existing_position()
    {
        $parentId = rand();
        $childId = 7;
        $position = 2;

        $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $childId, $position);

        $result = $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $childId, $position);

        $this->assertTrue($result);
    }

    public function test_delete_child_parent_links_and_update_other_children()
    {
        $parentId1 = rand();
        $parentId2 = rand();

        for ($i = 0; $i < 6; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId1, $i + 1);
        }

        for ($i = 0; $i < 6; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId2, $i + 1, 1);
        }

        $result = $this->classBeingTested->deleteChildParentLinks(2);

        $this->assertTrue($result);

        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId1,
                'child_id' => 1,
                'child_position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId2,
                'child_id' => 1,
                'child_position' => 5
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId1,
                'child_id' => 3,
                'child_position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId2,
                'child_id' => 3,
                'child_position' => 4
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId1,
                'child_id' => 4,
                'child_position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId2,
                'child_id' => 5,
                'child_position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId1,
                'child_id' => 5,
                'child_position' => 4
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId2,
                'child_id' => 6,
                'child_position' => 1
            ]
        );
    }

    public function test_delete_parent_child_links()
    {
        $parentId = rand();

        for ($i = 0; $i < 6; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $i + 1);
        }

        $result = $this->classBeingTested->deleteParentChildLinks($parentId);

        $this->assertTrue($result);

        $this->assertDatabaseMissing(ConfigService::$tableContentHierarchy, ['parent_id' => $parentId]);
    }

    public function test_delete_parent_child_link_and_reposition()
    {
        $parentId = rand();

        for ($i = 0; $i < 6; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $i + 1);
        }

        $result = $this->classBeingTested->deleteParentChildLink($parentId, 2);

        $this->assertTrue($result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 3,
                'child_position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 4,
                'child_position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 5,
                'child_position' => 4
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 6,
                'child_position' => 5
            ]
        );
    }

    public function test_delete_last_parent_child_link()
    {
        $parentId = rand();

        for ($i = 0; $i < 6; $i++) {
            $this->classBeingTested->updateOrCreateChildToParentLink($parentId, $i + 1);
        }

        $result = $this->classBeingTested->deleteParentChildLink($parentId, 6);

        $this->assertTrue($result);

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 1,
                'child_position' => 1
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 2,
                'child_position' => 2
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 3,
                'child_position' => 3
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 4,
                'child_position' => 4
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $parentId,
                'child_id' => 5,
                'child_position' => 5
            ]
        );

    }

}