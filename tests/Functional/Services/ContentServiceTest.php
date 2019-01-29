<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Faker\ORM\Doctrine\Populator;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentHierarchy;
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
use Railroad\Railcontent\Tests\Hydrators\ContentFakeDataHydrator;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Transformers\ContentTransformer;
use Railroad\Resora\Entities\Entity;

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

        $this->fakeDataHydrator = new ContentFakeDataHydrator($this->entityManager);

        $populator = new Populator($this->faker, $this->entityManager);

        $populator->addEntity(
            Content::class,
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );
        $populator->execute();

        $populator->addEntity(
            Content::class,
            3,
            [
                'type' => 'course-part',
            ]
        );
        $populator->execute();

        $populator->addEntity(
            Content::class,
            1,
            [
                'type' => 'course',
                'difficulty' => 2,
            ]
        );
        $populator->execute();

        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(4),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(5),
                'childPosition' => 1,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
                'childPosition' => 1,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(3),
                'childPosition' => 2,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(4),
                'childPosition' => 3,
            ]
        );
        $populator->execute();

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->entityManager, $purger);

        $this->classBeingTested = $this->app->make(ContentService::class);

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
        $this->permissionFactory = $this->app->make(PermissionsFactory::class);
        $this->contentPermissionFactory = $this->app->make(ContentPermissionsFactory::class);
        //        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        //   $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        //        $this->commentFactory = $this->app->make(CommentFactory::class);
        //   $this->commentAssignationFactory = $this->app->make(CommentAssignationFactory::class);
        //  $this->userContentProgressFactory = $this->app->make(UserContentProgressFactory::class);
    }

    public function _test_delete_content()
    {
        $parent = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $content = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $otherContent = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
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
                'content_id' => $content['id'],
            ]
        );

        //check that the content datum are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentData,
            [
                'content_id' => $content['id'],
            ]
        );

        //check that the link with the parent was deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $content['id'],
            ]
        );

        //check that the other children are repositioned correctly
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $otherContent['id'],
                'child_position' => 1,
            ]
        );

        //check the the links with the content children are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => $content['id'],
            ]
        );

        //check that the content it's deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableContent,
            [
                'id' => $content['id'],
            ]
        );

        //check that the content comments and replies are deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'content_id' => $content['id'],
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
                'content_id' => $content['id'],
            ]
        );
    }

    public function _test_soft_delete_content()
    {
        $parent = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $content = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $otherSiblingContent = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
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
                'status' => ContentService::STATUS_DELETED,
            ]
        );

        //check that the content fields are not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContentFields,
            [
                'content_id' => $content['id'],
            ]
        );

        //check that the content datum are not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContentData,
            [
                'content_id' => $content['id'],
            ]
        );

        //check that the link with the parent was not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $content['id'],
            ]
        );

        //check that the link with the parent was not deleted
        $this->assertDatabaseHas(
            ConfigService::$tableContent,
            [
                'id' => $children['id'],
                'status' => ContentService::STATUS_DELETED,
            ]
        );

        //check that the siblings was repositioned
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $otherSiblingContent['id'],
                'child_position' => $otherChildLink['child_position'] - 1,
            ]
        );

    }

    public function test_getWhereTypeInAndStatusAndPublishedOnOrdered()
    {

        $results = $this->classBeingTested->getWhereTypeInAndStatusAndPublishedOnOrdered(
            ['course'],
            'published',
            Carbon::now()
                ->toDateTimeString()
        );

        $this->assertEquals('course', $results[0]->getType());
        $this->assertEquals('published', $results[0]->getStatus());
        $this->assertEquals(
            Carbon::now()
                ->toDateTimeString(),
            $results[0]->getPublishedOn()
        );
    }

    public function test_getByChildIdWhereType()
    {
        $results = $this->classBeingTested->getByChildIdsWhereType([2], 'course');

        $this->assertEquals(1, $results[0]->getId());
        $this->assertEquals('course', $results[0]->getType());
    }

    public function test_entireCacheNotFlushed()
    {
        $user = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->slug(),
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $contentResponse = $this->classBeingTested->getById($content['id']);

        CacheHelper::setPrefix();
        Cache::store(ConfigService::$cacheDriver)
            ->put('do_not_delete', 'a_value', 10);

        $this->classBeingTested->update($contentResponse['id'], ['slug' => 'slug-' . rand()]);

        $this->assertEquals(
            'a_value',
            Cache::store(ConfigService::$cacheDriver)
                ->get('do_not_delete')
        );

        $this->assertEquals(
            3,
            count(
                Cache::store(ConfigService::$cacheDriver)
                    ->getRedis()
                    ->keys('*')
            )
        );

        $this->classBeingTested->delete($contentResponse['id']);

        $this->assertEquals(
            'a_value',
            Cache::store(ConfigService::$cacheDriver)
                ->get('do_not_delete')
        );
        $this->assertEquals(
            2,
            count(
                Cache::store(ConfigService::$cacheDriver)
                    ->getRedis()
                    ->keys('*')
            )
        );
    }

    public function test_getAllByType()
    {
        $results = $this->classBeingTested->getAllByType('course-part');

        foreach ($results as $content) {
            $this->assertEquals('course-part', $content->getType());
        }
    }

    public function test_getWhereTypeInAndStatusAndField()
    {
        $type = 'course';

        $results = $this->classBeingTested->getWhereTypeInAndStatusAndField(
            [$type],
            ContentService::STATUS_PUBLISHED,
            'difficulty',
            5,
            'string'
        );

        foreach ($results as $content) {
            $this->assertEquals(5, $content->getDifficulty());
            $this->assertEquals($type, $content->getType());
            $this->assertEquals(ContentService::STATUS_PUBLISHED, $content->getStatus());
        }
    }

    public function test_getBySlugAndType()
    {
        $results = $this->classBeingTested->getBySlugAndType('slug1', 'course');

        foreach ($results as $content) {
            $this->assertEquals('course', $content->getType());
            $this->assertEquals('slug1', $content->getSlug());
        }
    }

    public function test_getByUserIdTypeSlug()
    {
        $results = $this->classBeingTested->getByUserIdTypeSlug(1, 'course', 'slug1');

        foreach ($results as $content) {
            $this->assertEquals('course', $content->getType());
            $this->assertEquals('slug1', $content->getSlug());
            $this->assertEquals(1, $content->getUserId());
        }
    }

    public function test_getPaginatedByTypeUserProgressState()
    {
        $type = 'song';
        $userId = $this->faker->numberBetween();

        $content1 = $this->contentFactory->create(
            $this->faker->slug(),
            $type,
            ContentService::STATUS_PUBLISHED,
            null,
            null,
            $userId
        );
        $content2 = $this->contentFactory->create(
            $this->faker->slug(),
            $type,
            ContentService::STATUS_PUBLISHED,
            null,
            null,
            $userId
        );

        $playlist = $this->userContentProgressFactory->startContent($content1['id'], $userId);
        $playlist = $this->userContentProgressFactory->startContent($content2['id'], $userId);

        $results = $this->classBeingTested->getPaginatedByTypeUserProgressState($type, $userId, 'started');

        $this->assertEquals(2, count($results));
    }

    public function test_getByContentFieldValuesForTypes()
    {
        $results = $this->classBeingTested->getByContentFieldValuesForTypes(['course'], 'difficulty', [2, 5]);
        foreach ($results as $content) {
            $this->assertTrue(in_array($content->getDifficulty(), [2, 5]));
        }
    }

    public function test_countByTypesUserProgressState()
    {
        $type = 'song';
        $userId = $this->faker->numberBetween();

        $content1 = $this->contentFactory->create(
            $this->faker->slug(),
            $type,
            ContentService::STATUS_PUBLISHED,
            null,
            null,
            $userId
        );
        $content2 = $this->contentFactory->create(
            $this->faker->slug(),
            $type,
            ContentService::STATUS_PUBLISHED,
            null,
            null,
            $userId
        );

        $playlist = $this->userContentProgressFactory->startContent($content1['id'], $userId);
        $playlist = $this->userContentProgressFactory->startContent($content2['id'], $userId);

        $results = $this->classBeingTested->countByTypesUserProgressState([$type], $userId, 'started');

        $this->assertEquals(2, $results);
    }

    public function test_get_content_by_id()
    {
        $contentResponse1 = $this->classBeingTested->getById(1);
        $contentResponse2 = $this->classBeingTested->getById(1);

        $this->assertEquals($contentResponse1, $contentResponse2);
        $this->assertEquals(1, $contentResponse1->getId());
    }

    public function test_get_content_by_ids()
    {
        $response = $this->classBeingTested->getByIds([2, 1]);

        $this->assertEquals(2, count($response));
        $this->assertEquals(2, $response[0]->getId());
        $this->assertEquals(1, $response[1]->getId());
    }

    public function test_get_by_parent_id()
    {
        $response = $this->classBeingTested->getByParentId(1);

        $this->assertEquals(3, count($response));
        $this->assertEquals(2, $response[0]->getId());
    }

    public function test_get_by_parent_id_paginated()
    {
        //get childrens from page 2
        $response = $this->classBeingTested->getByParentIdPaginated(1, 2, 1);

        //assert one child it's returned
        $this->assertEquals(1, count($response));

        $this->assertEquals(4, $response[0]->getId());
    }

    public function test_get_by_parent_id_and_type()
    {
        //get childrens with type 'course-part'
        $response = $this->classBeingTested->getByParentIdWhereTypeIn(1, ['course-part']);

        $this->assertEquals(3, count($response));

        $this->assertEquals(2, $response[0]->getId());
    }

    public function test_get_by_parent_id_and_type_in_paginated()
    {
        //get childrens with type 'course-part'
        $response = $this->classBeingTested->getByParentIdWhereTypeInPaginated(1, ['course-part'], 2, 1);

        $this->assertEquals(1, count($response));

        $this->assertEquals(4, $response[0]->getId());
    }

    public function test_countByParentIdWhereTypeIn()
    {
        $response = $this->classBeingTested->countByParentIdWhereTypeIn(1, ['course-part']);

        $this->assertEquals(3, $response);
    }

    public function test_getByParentIds()
    {
        //get childrens by parent ids
        $response = $this->classBeingTested->getByParentIds([1, 4]);

        $this->assertEquals(4, count($response));
    }
}
