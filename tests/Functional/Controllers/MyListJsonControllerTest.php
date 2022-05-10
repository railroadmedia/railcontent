<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentFactory;
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

    protected function setUp()
    : void
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
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
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $myList = [
            'brand' => config('railcontent.brand'),
            'type' => 'primary-playlist',
            'user_id' => $this->userId,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];

        $myListId =
            $this->query()
                ->table(ConfigService::$tablePlaylists)
                ->insertGetId($myList);

        $userPlaylistContent1 = [
            'content_id' => $content['id'],
            'user_playlist_id' => $myListId,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tablePlaylistContents)
            ->insertGetId($userPlaylistContent1);

        $response = $this->call('PUT', 'api/railcontent/remove-from-my-list', [
            'content_id' => $content['id'],
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            'success',
            $response->decodeResponseJson()
                ->json()[0]
        );

        $this->assertDatabaseMissing(ConfigService::$tablePlaylistContents, [
            'content_id' => $content['id'],
            'user_playlist_id' => $myListId,
        ]);
    }

    public function test_my_list()
    {
        $content1 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $content2 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $content3 = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $myList = [
            'brand' => config('railcontent.brand'),
            'type' => 'primary-playlist',
            'user_id' => $this->userId,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];
        $myListId =
            $this->query()
                ->table(ConfigService::$tablePlaylists)
                ->insertGetId($myList);

        $userPlaylistContent1 = [
            'content_id' => $content1['id'],
            'user_playlist_id' => $myListId,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];
        $this->query()
            ->table(ConfigService::$tablePlaylistContents)
            ->insertGetId($userPlaylistContent1);

        $userPlaylistContent2 = [
            'content_id' => $content2['id'],
            'user_playlist_id' => $myListId,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];
        $this->query()
            ->table(ConfigService::$tablePlaylistContents)
            ->insertGetId($userPlaylistContent2);

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
