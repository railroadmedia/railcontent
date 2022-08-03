<?php

namespace Railroad\Railcontent\Tests\Functional\Listeners;

use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Factories\UserContentProgressFactory;
use Railroad\Railcontent\Listeners\RailcontentV2DataSyncingEventListener;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class RailcontentV2DataSyncingEventListenerTest extends RailcontentTestCase
{
    /**
     * @var RailcontentV2DataSyncingEventListener
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

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var CommentAssignationFactory
     */
    protected $commentAssignationFactory;

    /**
     * @var UserContentProgressFactory
     */
    protected $userContentProgressFactory;

    public function test_update_content_children_parent_data_columns()
    {
        $parent = $this->contentFactory->create(
            $this->faker->slug(),
            'learning-path',
            ContentService::STATUS_PUBLISHED
        );

        // first level
        $children = [];

        for ($a = 0; $a < 2; $a++) {
            $child1 = $this->contentFactory->create(
                $this->faker->slug(),
                'learning-path-level',
                ContentService::STATUS_PUBLISHED
            );
            $childrenHierarchy = $this->contentHierarchyFactory->create($parent['id'], $child1['id'], $a + 1);
            $children[1][] = $child1;

            for ($b = 0; $b < 2; $b++) {
                $child2 = $this->contentFactory->create(
                    $this->faker->slug(),
                    'learning-path-course',
                    ContentService::STATUS_PUBLISHED
                );
                $childrenHierarchy = $this->contentHierarchyFactory->create($child1['id'], $child2['id'], $b + 1);
                $children[2][] = $child2;

                for ($c = 0; $c < 2; $c++) {
                    $child3 = $this->contentFactory->create(
                        $this->faker->slug(),
                        'learning-path-lesson',
                        ContentService::STATUS_PUBLISHED
                    );
                    $childrenHierarchy = $this->contentHierarchyFactory->create($child2['id'], $child3['id'], $c + 1);
                    $children[3][] = $child3;

                    for ($d = 0; $d < 1; $d++) {
                        $child4 = $this->contentFactory->create(
                            $this->faker->slug(),
                            'assignment',
                            ContentService::STATUS_PUBLISHED
                        );
                        $childrenHierarchy =
                            $this->contentHierarchyFactory->create($child3['id'], $child4['id'], $d + 1);
                        $children[4][] = $child4;
                    }
                }
            }
        }

        $this->classBeingTested->updateAllContentsChildrenParentDataColumns($parent['id']);

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $child1['id'],
                'parent_content_data' => json_encode([
                    ["id" => $parent['id'], "slug" => $parent['slug'], "type" => $parent['type'], "position" => null],
                ]),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $child2['id'],
                'parent_content_data' => json_encode([
                    ["id" => $child1['id'], "slug" => $child1['slug'], "type" => $child1['type'], "position" => 2],
                    ["id" => $parent['id'], "slug" => $parent['slug'], "type" => $parent['type'], "position" => null],
                ]),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $child3['id'],
                'parent_content_data' => json_encode([
                    ["id" => $child2['id'], "slug" => $child2['slug'], "type" => $child2['type'], "position" => 2],
                    ["id" => $child1['id'], "slug" => $child1['slug'], "type" => $child1['type'], "position" => 2],
                    ["id" => $parent['id'], "slug" => $parent['slug'], "type" => $parent['type'], "position" => null],
                ]),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $child4['id'],
                'parent_content_data' => json_encode([
                    ["id" => $child3['id'], "slug" => $child3['slug'], "type" => $child3['type'], "position" => 2],
                    ["id" => $child2['id'], "slug" => $child2['slug'], "type" => $child2['type'], "position" => 2],
                    ["id" => $child1['id'], "slug" => $child1['slug'], "type" => $child1['type'], "position" => 2],
                    ["id" => $parent['id'], "slug" => $parent['slug'], "type" => $parent['type'], "position" => null],
                ]),
            ]
        );
    }

    public function test_update_contents_that_link_to_content_via_field()
    {
        $contentLinked = $this->contentFactory->create(
            $this->faker->slug(),
            'instructor',
            ContentService::STATUS_PUBLISHED
        );
        $contentLinkedField =
            $this->fieldFactory->create($contentLinked['id'], 'name', 'Billy Joel', 1, 'string');

        $linkedContent1 = $this->contentFactory->create(
            $this->faker->slug(),
            'course-lesson',
            ContentService::STATUS_PUBLISHED
        );
        $linkedContentField1 =
            $this->fieldFactory->create($linkedContent1['id'], 'instructor', $contentLinked['id'], 1, 'content_id');

        $linkedContent2 = $this->contentFactory->create(
            $this->faker->slug(),
            'course-lesson',
            ContentService::STATUS_PUBLISHED
        );
        $linkedContentField2 =
            $this->fieldFactory->create($linkedContent2['id'], 'instructor', $contentLinked['id'], 1, 'content_id');

        $linkedContent3 = $this->contentFactory->create(
            $this->faker->slug(),
            'course-lesson',
            ContentService::STATUS_PUBLISHED
        );
        $linkedContentField3 =
            $this->fieldFactory->create($linkedContent3['id'], 'instructor', $contentLinked['id'], 1, 'content_id');

        $this->classBeingTested->updateContentsThatLinkToContentViaField($contentLinked['id']);

        $linkedContent1Row = $this->databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(ConfigService::$tableContent)
            ->where('id', $linkedContent1['id'])
            ->get()
            ->first();

        $this->assertEquals(
            $contentLinked['id'],
            json_decode($linkedContent1Row['compiled_view_data'], true)['instructor']['id']
        );
        $this->assertEquals(
            'Billy Joel',
            json_decode($linkedContent1Row['compiled_view_data'], true)['instructor']['name']
        );
        $this->assertEquals(
            ['Billy Joel'],
            json_decode($linkedContent1Row['compiled_view_data'], true)['instructor_names']
        );

        $linkedContent2Row = $this->databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(ConfigService::$tableContent)
            ->where('id', $linkedContent1['id'])
            ->get()
            ->first();

        $this->assertEquals(
            $contentLinked['id'],
            json_decode($linkedContent2Row['compiled_view_data'], true)['instructor']['id']
        );
        $this->assertEquals(
            'Billy Joel',
            json_decode($linkedContent2Row['compiled_view_data'], true)['instructor']['name']
        );
        $this->assertEquals(
            ['Billy Joel'],
            json_decode($linkedContent2Row['compiled_view_data'], true)['instructor_names']
        );

        $linkedContent3Row = $this->databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(ConfigService::$tableContent)
            ->where('id', $linkedContent1['id'])
            ->get()
            ->first();

        $this->assertEquals(
            $contentLinked['id'],
            json_decode($linkedContent3Row['compiled_view_data'], true)['instructor']['id']
        );
        $this->assertEquals(
            'Billy Joel',
            json_decode($linkedContent3Row['compiled_view_data'], true)['instructor']['name']
        );
        $this->assertEquals(
            ['Billy Joel'],
            json_decode($linkedContent3Row['compiled_view_data'], true)['instructor_names']
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(RailcontentV2DataSyncingEventListener::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->commentAssignationFactory = $this->app->make(CommentAssignationFactory::class);
        $this->userContentProgressFactory = $this->app->make(UserContentProgressFactory::class);
    }
}
