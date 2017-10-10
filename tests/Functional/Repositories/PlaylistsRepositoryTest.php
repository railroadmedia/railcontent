<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PlaylistsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PlaylistsRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested, $userId;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PlaylistsRepository::class);
        $this->userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($this->userId);
    }

    public function test_add_content_to_playlist()
    {
        $contentId = $this->createContent();

        $contentUser = [
            'content_id' => $contentId,
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(1, 99)
        ];

        $contentUserId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($contentUser);

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $this->userId
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $results = $this->classBeingTested->addToPlaylist($contentUserId, $playlistId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentPlaylists,
            [
                'id' => $results,
                'content_user_id' => $contentUserId,
                'playlist_id' => $playlistId
            ]
        );
    }

    public function test_create_a_private_playlist()
    {
        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'userId' => $this->userId
        ];

        $results = $this->classBeingTested->store($playlist['name'], $playlist['userId'], $playlist['type']);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'name' => $playlist['name'],
                'user_id' => $playlist['userId'],
                'type' => $playlist['type']
            ]
        );
    }

    public function test_create_a_public_playlist()
    {
        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'userId' => $this->userId
        ];

        $results = $this->classBeingTested->store($playlist['name'], $playlist['userId'], $playlist['type']);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'name' => $playlist['name'],
                'user_id' => $playlist['userId'],
                'type' => $playlist['type']
            ]
        );
    }

    public function test_get_all_public_playlists()
    {
        //$userId =  $this->createAndLogInNewUser();

        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $this->userId
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId1, ConfigService::$tablePlaylists, $playlist1['name']);

        $expectedResults[] = array_merge(['id' => $playlistId1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $this->userId
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId2, ConfigService::$tablePlaylists, $playlist2['name']);

        $expectedResults[] = array_merge(['id' => $playlistId2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($this->userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_my_playlists()
    {
        // $userId = $this->createAndLogInNewUser();

        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $this->userId
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId1, ConfigService::$tablePlaylists, $playlist1['name']);
        $expectedResults[] = array_merge(['id' => $playlistId1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $this->userId
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId2, ConfigService::$tablePlaylists, $playlist2['name']);
        $expectedResults[] = array_merge(['id' => $playlistId2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($this->userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_playlist_with_my_content()
    {
        $userId = $this->userId;
        //$this->createAndLogInNewUser();

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $content = [
            // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $content2 = [
            //  'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId2 = $this->query()->table(ConfigService::$tableContent)->insertGetId($content2);

        $contentUser = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(1, 99)
        ];

        $contentUserId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($contentUser);

        $expectedContents[$contentId] = [
            'id' => $contentId,
            'state' => $contentUser['state'],
            'progress' => $contentUser['progress']
        ];

        $contentUser2 = [
            'content_id' => $contentId2,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(1, 99)
        ];

        $contentUserId2 = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($contentUser2);

        $expectedContents[$contentId2] = [
            'id' => $contentId2,
            'state' => $contentUser2['state'],
            'progress' => $contentUser2['progress']
        ];

        $userPlaylist = [
            'content_user_id' => $contentUserId,
            'playlist_id' => $playlistId
        ];

        $userPlaylistId = $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userPlaylist);

        $userPlaylist2 = [
            'content_user_id' => $contentUserId2,
            'playlist_id' => $playlistId
        ];

        $userPlaylistId2 = $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userPlaylist2);

        $results = $this->classBeingTested->getPlaylistWithContent($playlistId, $userId);

        $expectedResults[$playlistId] = [
            'id' => $playlistId,
            'name' => $playlist['name'],
            'type' => $playlist['type'],
            'contents' => $expectedContents
        ];

        $this->assertEquals($expectedResults, $results);
    }
}
