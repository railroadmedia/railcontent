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

        $contentUserId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($contentUser);

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'brand' => ConfigService::$brand,
            'user_id' => $userId
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
            'userId' => $userId
        ];

        $results = $this->classBeingTested->store($playlist['name'], $playlist['userId'], $playlist['type']);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'user_id' => $playlist['userId'],
                'type' => $playlist['type'],
                'brand' => ConfigService::$brand
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tablePlaylists,
                'entity_id' => $results,
                'value' => $playlist['name'],
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_create_a_public_playlist()
    {
        $playlist = [
            'name' => $this->faker->word,
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'userId' => $userId
        ];

        $results = $this->classBeingTested->store($playlist['name'], $playlist['userId'], $playlist['type']);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'user_id' => $playlist['userId'],
                'type' => $playlist['type']
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tablePlaylists,
                'entity_id' => $results,
                'value' => $playlist['name'],
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_get_all_public_playlists()
    {
        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $playlistName1 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId1, ConfigService::$tablePlaylists, $playlistName1);

        $expectedResults[] = array_merge(['id' => $playlistId1, 'name' => $playlistName1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $playlistName2 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId2, ConfigService::$tablePlaylists, $playlistName2);

        $expectedResults[] = array_merge(['id' => $playlistId2, 'name' => $playlistName2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_my_playlists()
    {
        $playlist1 = [
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);
        $playlistName1 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId1, ConfigService::$tablePlaylists, $playlistName1);
        $expectedResults[] = array_merge(['id' => $playlistId1, 'name' => $playlistName1], $playlist1);

        $playlist2 = [
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);
        $playlistName2 = $this->faker->word();
        $this->translateItem($this->languageId, $playlistId2, ConfigService::$tablePlaylists, $playlistName2);
        $expectedResults[] = array_merge(['id' => $playlistId2, 'name' => $playlistName2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_playlist_with_my_content()
    {
        $userId = $userId;

        $playlist = [
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);
        $playlistName = $this->faker->word();
        $this->translateItem($this->languageId, $playlistId, ConfigService::$tablePlaylists, $playlistName);

        $content = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);
        $contentSlug = $this->faker->word();
        $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);

        $content2 = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId2 = $this->createContent($content2);
        $contentSlug2 = $this->faker->word();
        $this->translateItem($this->languageId, $contentId2, ConfigService::$tableContent, $contentSlug2);

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
            'name' => $playlistName,
            'type' => $playlist['type'],
            'brand' => ConfigService::$brand,
            'contents' => $expectedContents
        ];

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_playlists_from_brand()
    {
        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $playlistName1 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId1, ConfigService::$tablePlaylists, $playlistName1);

        $expectedResults[] = array_merge(['id' => $playlistId1, 'name' => $playlistName1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $playlistName2 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId2, ConfigService::$tablePlaylists, $playlistName2);

        $expectedResults[] = array_merge(['id' => $playlistId2, 'name' => $playlistName2], $playlist2);

        $playlist3 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => $this->faker->word
        ];

        $playlistId3 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist3);

        $playlistName3 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId3, ConfigService::$tablePlaylists, $playlistName3);

        $playlist4 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId,
            'brand' => $this->faker->word
        ];

        $playlistId4 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist4);

        $playlistName4 = $this->faker->word;
        $this->translateItem($this->languageId, $playlistId4, ConfigService::$tablePlaylists, $playlistName4);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }
}
