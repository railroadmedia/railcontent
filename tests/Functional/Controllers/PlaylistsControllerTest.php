<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\PlaylistRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PlaylistsControllerTest extends RailcontentTestCase
{
    protected $serviceBeingTested;

    protected $userId;

    protected $contentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->serviceBeingTested = $this->app->make(PlaylistsService::class);
        $this->classBeingTested = $this->app->make(PlaylistRepository::class);
        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_add_content_to_playlist()
    {
        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::PRIVACY_PUBLIC,
            'brand' => ConfigService::$brand
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $content = $this->contentFactory->create();

        $response = $this->post('railcontent/playlists/add', [
            'content_id' => $content['id'],
            'playlist_id' => $playlistId

        ], [
            'Accept' => 'application/json'
        ]);

        $this->assertEquals(200, $response->status());

        $this->assertEquals('true', $response->content());
    }

    public function test_create_a_playlist()
    {
        $playlistName = $this->faker->word();
        $response = $this->post('railcontent/playlists/create', [
            'name' => $playlistName
        ], [
            'Accept' => 'application/json'
        ]);

        $this->assertEquals(200, $response->status());

        $this->assertEquals('true', $response->content());
    }

    public function test_add_to_playlist_service()
    {
        $contentId = 1;

        $playlist = [
            'name' => $this->faker->word,
            'type' => PlaylistsService::PRIVACY_PUBLIC,
            'brand' => ConfigService::$brand
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $results = $this->serviceBeingTested->addToPlaylist($contentId, $playlistId, $this->userId);

        $this->assertTrue($results);
    }

    public function test_store_playlist_private_service()
    {
        $paylistName = $this->faker->word();
        $isAdmin = false;

        $results = $this->serviceBeingTested->store($paylistName, $this->userId, $isAdmin);

        $this->assertTrue($results);
    }

    public function test_store_playlist_public_service()
    {
        $paylistName = $this->faker->word();
        $isAdmin = true;

        $results = $this->serviceBeingTested->store($paylistName, $this->userId, $isAdmin);

        $this->assertTrue($results);
    }

}
