<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PlaylistRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PlaylistRepositoryTest extends RailcontentTestCase
{
    /**
     * @var PlaylistRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PlaylistRepository::class);
    }

    public function test_add_content_to_playlist()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $contentUser = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(1, 99)
        ];

        $contentUserId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($contentUser);

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'brand' => ConfigService::$brand,
            'user_id' => $userId
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $results = $this->classBeingTested->addToPlaylist($contentUserId, $playlistId);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylistContents,
            [
                'id' => $results,
                'content_user_id' => $contentUserId,
                'playlist_id' => $playlistId
            ]
        );
    }

    public function test_create_a_private_playlist()
    {
        $userId = $this->faker->randomNumber();

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'userId' => $userId
        ];

        $results = $this->classBeingTested->store($playlist['name'], $playlist['userId'], $playlist['type']);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'name' => $playlist['name'],
                'user_id' => $playlist['userId'],
                'type' => $playlist['type'],
                'brand' => ConfigService::$brand
            ]
        );
    }

    public function test_create_a_public_playlist()
    {
        $userId = $this->faker->randomNumber();

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'userId' => $userId
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
        $userId = $this->faker->randomNumber();

        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $expectedResults[] = array_merge(['id' => $playlistId1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $expectedResults[] = array_merge(['id' => $playlistId2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_my_playlists()
    {
        $userId = $this->faker->randomNumber();

        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $expectedResults[] = array_merge(['id' => $playlistId1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $expectedResults[] = array_merge(['id' => $playlistId2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }
}
