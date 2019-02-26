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
                'brand' => config('railcontent.brand'),
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
        $results = $this->classBeingTested->getByChildIdWhereType([2], 'course');

        $this->assertEquals(1, $results[0]->getId());
        $this->assertEquals('course', $results[0]->getType());
    }

    public function _test_entireCacheNotFlushed()
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
        $nr = $this->faker->randomNumber(1);
        $type = $this->faker->word;

        $contents = $this->fakeContent(
            $nr,
            [
                'slug' => $this->faker->slug,
                'status' => 'published',
                'type' => $type,
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $results = $this->classBeingTested->getAllByType($type);

        $this->assertEquals($nr, count($results));
        foreach ($results as $content) {
            $this->assertEquals($type, $content->getType());
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

        $contents = $this->fakeContent(
            10,
            [
                'type' => $type,
            ]
        );
        $contentOtherType = $this->fakeContent();

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'started',
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contentOtherType[0],
                'state' => 'started',
            ]
        );

        $results = $this->classBeingTested->getPaginatedByTypeUserProgressState($type, $userId, 'started');

        $this->assertEquals(1, count($results));
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

        $contents = $this->fakeContent(
            10,
            [
                'type' => $type,
            ]
        );
        $contentOtherType = $this->fakeContent();

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'started',
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contentOtherType[0],
                'state' => 'started',
            ]
        );

        $results = $this->classBeingTested->countByTypesUserProgressState([$type], $userId, 'started');

        $this->assertEquals(1, $results);
    }

    public function test_get_content_by_id()
    {
        $content = $this->fakeContent();
        $contentResponse1 = $this->classBeingTested->getById($content[0]->getId());
        $contentResponse2 = $this->classBeingTested->getById($content[0]->getId());

        $this->assertEquals($contentResponse1, $contentResponse2);
        $this->assertEquals($content[0]->getId(), $contentResponse1->getId());
    }

    public function test_get_content_by_ids()
    {
        $contents = $this->fakeContent(2);
        $response = $this->classBeingTested->getByIds([$contents[1]->getId(), $contents[0]->getId()]);

        $this->assertEquals(2, count($response));
        $this->assertEquals($contents[1]->getId(), $response[0]->getId());
        $this->assertEquals($contents[0]->getId(), $response[1]->getId());
    }

    public function test_get_by_parent_id()
    {
        $parent = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $child = $this->fakeContent(
            1,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $this->fakeHierarchy(
            1,
            [
                'parent' => $parent[0],
                'child' => $child[0],
                'childPosition' => 1,
            ]
        );
        $response = $this->classBeingTested->getByParentId($parent[0]->getId());

        $this->assertEquals(1, count($response));
        $this->assertEquals($child[0]->getId(), $response[0]->getId());
    }

    public function test_get_by_parent_id_paginated()
    {
        $parent = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $children = $this->fakeContent(
            10,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                ]
            );
        }

        //get childrens from page 2
        $response = $this->classBeingTested->getByParentIdPaginated($parent[0]->getId(), 2, 1);

        //assert one child it's returned
        $this->assertEquals(2, count($response));
        foreach ($response as $res) {
            $this->assertEquals(
                $parent[0]->getId(),
                $res->getParent()
                    ->getParent()
                    ->getId()
            );
        }
    }

    public function test_get_by_parent_id_and_type()
    {
        $type = $this->faker->word;

        $parent = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $children = $this->fakeContent(
            3,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => $type,
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }

        $children = $this->fakeContent(
            2,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => $this->faker->word,
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }
        //get childrens with type 'course-part'
        $response = $this->classBeingTested->getByParentIdWhereTypeIn($parent[0]->getId(), [$type]);

        $this->assertEquals(3, count($response));

        foreach ($response as $content) {
            $this->assertEquals($type, $content->getType());
            $this->assertEquals(
                $parent[0]->getId(),
                $content->getParent()
                    ->getParent()
                    ->getId()
            );
        }

    }

    public function test_get_by_parent_id_and_type_in_paginated()
    {
        $type = $this->faker->word;

        $parent = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $children = $this->fakeContent(
            3,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => $type,
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }

        $children = $this->fakeContent(
            2,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => $this->faker->word,
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }

        //get childrens with type 'course-part'
        $response = $this->classBeingTested->getByParentIdWhereTypeInPaginated($parent[0]->getId(), [$type], 2, 1);

        $this->assertEquals(1, count($response));
        $this->assertEquals($type, $response[0]->getType());
        $this->assertEquals(
            $parent[0]->getId(),
            $response[0]->getParent()
                ->getParent()
                ->getId()
        );
    }

    public function test_countByParentIdWhereTypeIn()
    {
        $parent = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $nrChildrenParent1 = $this->faker->randomNumber(1);
        $childType = $this->faker->word;

        $children = $this->fakeContent(
            $nrChildrenParent1,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => $childType,
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }

        $response = $this->classBeingTested->countByParentIdWhereTypeIn($parent[0]->getId(), [$childType]);

        $this->assertEquals($nrChildrenParent1, $response);
    }

    public function test_getByParentIds()
    {
        $parent = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $nrChildrenParent1 = $this->faker->randomNumber(1);
        $children = $this->fakeContent(
            $nrChildrenParent1,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }

        $parent2 = $this->fakeContent(
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        $nrChildrenParent2 = $this->faker->randomNumber(1);
        $children2 = $this->fakeContent(
            $nrChildrenParent2,
            [
                'slug' => 'slug2',
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );
        foreach ($children2 as $child) {
            $this->fakeHierarchy(
                1,
                [
                    'parent' => $parent2[0],
                    'child' => $child,
                    'childPosition' => 1,
                ]
            );
        }

        //get childrens by parent ids
        $response = $this->classBeingTested->getByParentIds([$parent[0]->getId(), $parent2[0]->getId()]);

        $this->assertEquals(($nrChildrenParent1 + $nrChildrenParent2), count($response));
    }

    public function test_getByChildIdWhereParentTypeIn()
    {
        $results = $this->classBeingTested->getByChildIdWhereParentTypeIn(2, ['course']);

        $this->assertEquals(1, $results[0]->getId());
        $this->assertEquals('course', $results[0]->getType());
    }

    public function test_getPaginatedByTypesRecentUserProgressState()
    {
        $type = 'song';
        $userId = $this->faker->numberBetween();

        $contents = $this->fakeContent(
            10,
            [
                'type' => $type,
            ]
        );
        $contentOtherType = $this->fakeContent();

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'started',
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[1],
                'state' => 'started',
                'updatedOn' => Carbon::now(),
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contentOtherType[0],
                'state' => 'started',
            ]
        );

        $results = $this->classBeingTested->getPaginatedByTypesRecentUserProgressState([$type], $userId, 'started');

        $this->assertEquals(2, count($results));

        $updatedOn = Carbon::now();

        foreach ($results as $result) {
            $this->assertTrue($result->getUpdatedOn() <= $updatedOn);
            $updatedOn = $result->getUpdatedOn();
        }
    }

    public function test_countByTypesRecentUserProgressState()
    {
        $type = 'song';
        $userId = $this->faker->numberBetween();

        $contents = $this->fakeContent(
            10,
            [
                'type' => $type,
            ]
        );
        $contentOtherType = $this->fakeContent();

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contents[0],
                'state' => 'started',
            ]
        );

        $this->fakeUserContentProgress(
            1,
            [
                'userId' => $userId,
                'content' => $contentOtherType[0],
                'state' => 'started',
            ]
        );

        $results = $this->classBeingTested->countByTypesRecentUserProgressState([$type], $userId, 'started');

        $this->assertEquals(1, $results);
    }

    public function test_getTypeNeighbouringSiblings()
    {
        $type = $this->faker->word;

        $contents1 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'sort' => 1,
            ]
        );
        $contents2 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'sort' => 2,
            ]
        );
        $contents3 = $this->fakeContent(
            1,
            [
                'type' => $type,
                'sort' => 3,
            ]
        );
        $results = $this->classBeingTested->getTypeNeighbouringSiblings($type, 'sort',$contents2[0]->getSort());

        $this->assertEquals($contents3[0], $results['before'][0]);
        $this->assertEquals($contents1[0], $results['after'][0]);

    }

}
