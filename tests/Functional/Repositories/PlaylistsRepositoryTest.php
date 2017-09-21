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
            'user_id' => $this->createAndLogInNewUser(),
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(1,99)
        ];

        $contentUserId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($contentUser);

        $playlist = [
            'name' => $this->faker->word
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
}
