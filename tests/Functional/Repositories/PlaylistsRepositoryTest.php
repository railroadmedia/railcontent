<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/21/2017
 * Time: 4:03 PM
 */

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PlaylistsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PlaylistsRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PlaylistsRepository::class);
    }

    public function test_add_content_to_playlist()
    {
        $userId =  $this->createAndLogInNewUser();
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $contentUser = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(1,99)
        ];

        $contentUserId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($contentUser);

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
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
            'userId' => $this->createAndLogInNewUser()
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
            'userId' => $this->createAndLogInNewUser()
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
        $userId =  $this->createAndLogInNewUser();

        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $expectedResults[] = array_merge(['id' => $playlistId1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PUBLIC,
            'user_id' => $userId
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $expectedResults[] = array_merge(['id' => $playlistId2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_my_playlists()
    {
        $userId = $this->createAndLogInNewUser();

        $playlist1 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId
        ];

        $playlistId1 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist1);

        $expectedResults[] = array_merge(['id' => $playlistId1], $playlist1);

        $playlist2 = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::TYPE_PRIVATE,
            'user_id' => $userId
        ];

        $playlistId2 = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist2);

        $expectedResults[] = array_merge(['id' => $playlistId2], $playlist2);

        $results = $this->classBeingTested->getUserPlaylists($userId);

        $this->assertEquals($expectedResults, $results);
    }
}
