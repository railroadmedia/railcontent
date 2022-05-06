<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
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

    /**
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;

    protected function setUp()
    : void
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);

        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_add_to_my_list()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call('PUT', 'api/railcontent/add-to-my-list', [
            'content_id' => $content['id'],
            'brand' => config('railcontent.brand'),
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson()
                ->json()[0]
        );

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_playlist_content', [
            'content_id' => $content['id'],
        ]);
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

        $response = $this->call('PUT', 'api/railcontent/remove-from-my-list', [
            'content_id' => $content1['id'],
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson()
                ->json()[0]
        );

        $this->assertDatabaseMissing(ConfigService::$tableContentHierarchy, [
            'child_id' => $content1['id'],
        ]);
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

    public function test_my_list_in_progress()
    {
        $user = $this->createAndLogInNewUser();

        for ($i = 1; $i < 15; $i++) {
            $courses[$i] = $this->contentFactory->create(
                $this->faker->word,
                'course',
                ContentService::STATUS_PUBLISHED,
                'en-US',
                ConfigService::$brand,
                rand(),
                Carbon::now()
                    ->subMinute($i)
            );
            $difficulty[$i] = $this->contentFieldFactory->create($courses[$i]['id'], 'difficulty', $i);
        }

        $userContent = [
            'content_id' => $courses[2]['id'],
            'user_id' => $user,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 10),
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent);

        $userContent = [
            'content_id' => $courses[4]['id'],
            'user_id' => $user,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 10),
            'updated_on' => Carbon::now()
                ->addHours(5)
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent);

        $response = $this->call(
            'GET',
            'api/railcontent/my-list?state=started'
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals(2, count($response->decodeResponseJson('data')));
    }
}
