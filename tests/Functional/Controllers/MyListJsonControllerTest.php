<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class MyListJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var
     */
    protected $userId;

    /** @var  ContentFactory */
    protected $contentFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);

        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_add_to_my_list()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call(
            'PUT',
            'api/railcontent/add-to-my-list',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson()[0]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $content['id'],
            ]
        );
    }

    public function test_remove_from_my_list()
    {
        $myList = $this->contentFactory->create(
            'primary-playlist',
            'user-playlist',
            ContentService::STATUS_PUBLISHED,
            null,
            config('railcontent.brand'),
            $this->userId
        );

        $content1 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $this->contentHierarchyFactory->create($myList['id'], $content1['id']);
        $this->contentHierarchyFactory->create($myList['id'], $content2['id']);

        $response = $this->call(
            'PUT',
            'api/railcontent/remove-from-my-list',
            [
                'content_id' => $content1['id'],
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson()[0]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $content1['id'],
            ]
        );
    }

    public function test_my_list()
    {
        $myList = $this->contentFactory->create(
            'primary-playlist',
            'user-playlist',
            ContentService::STATUS_PUBLISHED,
            null,
            config('railcontent.brand'),
            $this->userId
        );

        $content1 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );
        $content3 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );

        $this->contentHierarchyFactory->create($myList['id'], $content1['id']);
        $this->contentHierarchyFactory->create($myList['id'], $content2['id']);

        $response = $this->call(
            'GET',
            'api/railcontent/my-list'
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(2, count($response->decodeResponseJson('data')));
    }
}
