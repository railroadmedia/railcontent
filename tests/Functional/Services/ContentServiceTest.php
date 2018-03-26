<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Factories\UserContentProgressFactory;
use Railroad\Railcontent\Helpers\CacheHelper;
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
        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->commentAssignationFactory = $this->app->make(CommentAssignationFactory::class);
        $this->userContentProgressFactory = $this->app->make(UserContentProgressFactory::class);
    }

    public function test_delete_content()
    {
        $parent = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $content = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $otherContent = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        for ($i = 0; $i < 3; $i++) {
            $expectedFields = $this->fieldFactory->create($content['id']);
            $expectedData[] = $this->datumFactory->create($content['id']);
            $children = $this->contentHierarchyFactory->create($content['id']);
            $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $reply = $this->commentFactory->create($this->faker->text, null, $comment['id'], rand());
        }

        //save content in user playlist
        $playlist = $this->userContentProgressFactory->startContent($content['id'], rand());

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

        //check that the content comments and replies are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'content_id' => $content['id']
            ]
        );

        //check that the comments/replies assignments are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableCommentsAssignment,
            []
        );

        //check that the content it's deleted from the playlists
        $this->assertDatabaseMissing(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $content['id']
            ]
        );
    }

    public function test_soft_delete_content()
    {
        $parent = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $content = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $otherSiblingContent = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        for ($i = 0; $i < 3; $i++) {
            $expectedFields = $this->fieldFactory->create($content['id']);
            $expectedData[] = $this->datumFactory->create($content['id']);

            $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $reply = $this->commentFactory->create($this->faker->text, null, $comment['id'], rand());
        }

        $children = $this->contentFactory->create();
        $childrenHierarchy = $this->contentHierarchyFactory->create($content['id'], $children['id']);

        //save content in user playlist
        $playlist = $this->userContentProgressFactory->startContent($content['id'], rand());

        $parentLink = $this->contentHierarchyFactory->create($parent['id'], $content['id'], 1);

        $otherChildLink = $this->contentHierarchyFactory->create($parent['id'], $otherSiblingContent['id'], 2);

        $results = $this->classBeingTested->softDelete($content['id']);

        //check that the results it's true
        $this->assertEquals(1, $results);

        //check that the content it's marked as deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $content['id'],
                'status' => ContentService::STATUS_DELETED
            ]
        );

        //check that the content fields are not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContentFields,
            [
                'content_id' => $content['id']
            ]
        );

        //check that the content datum are not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'content_id' => $content['id']
            ]
        );

        //check that the link with the parent was not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $content['id']
            ]
        );

        //check that the link with the parent was not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $children['id'],
                'status' => ContentService::STATUS_DELETED
            ]
        );

        //check that the siblings was repositioned
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $otherSiblingContent['id'],
                'child_position' => $otherChildLink['child_position'] - 1
            ]
        );

    }

    public function test_getWhereTypeInAndStatusAndPublishedOnOrdered()
    {
        $content1 = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $content2 = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_ARCHIVED);

        $results = $this->classBeingTested->getWhereTypeInAndStatusAndPublishedOnOrdered([$content1['type']], $content1['status'], $content1['published_on']);
        $this->assertEquals([$content1['id'] => $content1], $results);
    }

    public function test_getByChildIdWhereType()
    {
        $content = $this->contentFactory->create($this->faker->slug(), $this->faker->randomElement(ConfigService::$commentableContentTypes), ContentService::STATUS_PUBLISHED);
        $children = $this->contentFactory->create();
        $childrenHierarchy = $this->contentHierarchyFactory->create($content['id'], $children['id']);
        $content['child_ids'] = [$children['id']];
        $content['position'] = 1;
        $content['parent_id'] = $content['id'];
        $content['child_id'] = $children['id'];

        $results = $this->classBeingTested->getByChildIdsWhereType([$children['id']], $content['type']);
        $this->assertEquals([$content['id'] => $content], $results);
    }

    public function test_entireCacheNotFlushed()
    {
        $content = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $contentResponse = $this->classBeingTested->getById($content['id']);

        CacheHelper::setPrefix();
        Cache::store(ConfigService::$cacheDriver)->put('do_not_delete', 'a_value', 10);

        $this->classBeingTested->update($contentResponse['id'], ['slug' => 'slug-'. rand()]);

        $this->assertEquals('a_value', Cache::store(ConfigService::$cacheDriver)->get('do_not_delete'));
        $this->assertEquals(3, count(Cache::store(ConfigService::$cacheDriver)->getRedis()->keys('*')));

        $this->classBeingTested->delete($contentResponse['id']);

        $this->assertEquals('a_value', Cache::store(ConfigService::$cacheDriver)->get('do_not_delete'));
        $this->assertEquals(2, count(Cache::store(ConfigService::$cacheDriver)->getRedis()->keys('*')));
    }
}
