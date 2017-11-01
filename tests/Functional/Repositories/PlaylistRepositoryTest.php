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

    public function test_create_a_private_playlist()
    {
        $userId = $this->faker->randomNumber();

        $playlist = [
            'name' => $this->faker->word,
            'privacy' => PlaylistsService::PRIVACY_PRIVATE,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $results = $this->classBeingTested->create($playlist);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'name' => $playlist['name'],
                'user_id' => $playlist['user_id'],
                'privacy' => $playlist['privacy'],
                'brand' => ConfigService::$brand
            ]
        );
    }

    public function test_create_a_public_playlist()
    {
        $userId = $this->faker->randomNumber();

        $playlist = [
            'name' => $this->faker->word,
            'privacy' => PlaylistsService::PRIVACY_PUBLIC,
            'user_id' => $userId,
            'brand' => ConfigService::$brand
        ];

        $results = $this->classBeingTested->create($playlist);

        $this->assertDatabaseHas(
            ConfigService::$tablePlaylists,
            [
                'id' => $results,
                'name' => $playlist['name'],
                'user_id' => $playlist['user_id'],
                'privacy' => $playlist['privacy'],
                'brand' => ConfigService::$brand
            ]
        );
    }

    public function test_get_by_user_id_and_privacy()
    {
        $userId = $this->faker->randomNumber();

        $expectedPlaylists = [];

        for ($i = 0; $i < 3; $i++) {
            $playlist = [
                'name' => $this->faker->word,
                'privacy' => PlaylistsService::PRIVACY_PUBLIC,
                'user_id' => $userId,
                'brand' => ConfigService::$brand
            ];

            $result = $this->classBeingTested->create($playlist);

            $expectedPlaylists[] = array_merge($playlist, ['id' => $result]);
        }

        $results = $this->classBeingTested->getByUserIdAndPrivacy($userId, PlaylistsService::PRIVACY_PUBLIC);

        $this->assertEquals($expectedPlaylists, $results);
    }
}
