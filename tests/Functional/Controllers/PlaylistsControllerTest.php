<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PlaylistsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PlaylistsService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PlaylistsControllerTest extends RailcontentTestCase
{
    protected $serviceBeingTested, $userId;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(PlaylistsService::class);
        $this->classBeingTested = $this->app->make(PlaylistsRepository::class);
        $this->userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($this->userId);
    }

    public function test_add_content_to_playlist()
    {
        $playlist = [
            'type' => PlaylistsService::TYPE_PUBLIC,
            'brand' => ConfigService::$brand
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $playlistName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId, ConfigService::$tablePlaylists, $playlistName);

        $content = [
            //'slug' => $this->faker->word,
            'status' => ContentService::STATUS_DRAFT,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent();

        $expectedResults = [
            1 => [
                'id' => 1,
                'name' => $playlistName,
                'type' => $playlist['type'],
                'brand' => ConfigService::$brand,
                'contents' => [
                    $contentId => [
                        'id' => $contentId,
                        'state' => UserContentService::STATE_ADDED_TO_LIST,
                        'progress' => 0
                    ]
                ]
            ]
        ];

        $response = $this->call('POST', '/playlists/add', [
            'content_id' => $contentId,
            'playlist_id' => $playlistId

        ]);

        $this->assertEquals(200, $response->status());

        $this->assertEquals($expectedResults, json_decode($response->content(), true));
    }

    public function test_create_a_playlist()
    {
        $playlistName = $this->faker->word();
        $response = $this->call('POST', '/playlists/create', [
            'name' => $playlistName
        ]);

        $expectedResults = [
            1 => [
                'id' => 1,
                'name' => $playlistName,
                'type' => PlaylistsService::TYPE_PRIVATE,
                'brand' => ConfigService::$brand
            ]
        ];

        $this->assertEquals(200, $response->status());

        $this->assertEquals($expectedResults, json_decode($response->content(), true));
    }

    public function test_add_to_playlist_service()
    {
        $contentId = 1;

        $playlist = [
            'type' => PlaylistsService::TYPE_PUBLIC,
            'brand' => ConfigService::$brand
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $playlistName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId, ConfigService::$tablePlaylists, $playlistName);

        $expectedResults = [
            1 => [
                'id' => 1,
                'name' => $playlistName,
                'type' => $playlist['type'],
                'brand' => ConfigService::$brand,
                'contents' => [
                    1 => [
                        'id' => 1,
                        'state' => 'added',
                        'progress' => 0
                    ]
                ]
            ]
        ];
        $results = $this->serviceBeingTested->addToPlaylist($contentId, $playlistId, $this->userId);

        $this->assertEquals($expectedResults, $results);
    }

    public function test_store_playlist_private_service()
    {
        // $userId = $this->createAndLogInNewUser();
        $paylistName = $this->faker->word();
        $isAdmin = false;

        $results = $this->serviceBeingTested->store($paylistName, $this->userId, $isAdmin);

        $expectedResults = [
            1 => [
                'id' => 1,
                'name' => $paylistName,
                'type' => PlaylistsService::TYPE_PRIVATE,
                'brand' => ConfigService::$brand
            ]
        ];

        $this->assertEquals($expectedResults, $results);
    }

    public function test_store_playlist_public_service()
    {
        // $userId = $this->createAndLogInNewUser();
        $paylistName = $this->faker->word();
        $isAdmin = true;

        $results = $this->serviceBeingTested->store($paylistName, $this->userId, $isAdmin);

        $expectedResults = [
            1 => [
                'id' => 1,
                'name' => $paylistName,
                'type' => PlaylistsService::TYPE_PUBLIC,
                'brand' => ConfigService::$brand
            ]
        ];

        $this->assertEquals($expectedResults, $results);
    }

    public function test_get_playlist_with_contents()
    {
        $playlist = [
            'type' => PlaylistsService::TYPE_PUBLIC,
            'brand' => ConfigService::$brand
        ];

        $playlistId = $this->query()->table(ConfigService::$tablePlaylists)->insertGetId($playlist);

        $playlistName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $playlistId, ConfigService::$tablePlaylists, $playlistName);

        $contentId1 = $this->createContent();
        $contentId2 = $this->createContent();

        $userContent1 = [
            'content_id' => $contentId1,
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_ADDED_TO_LIST,
            'progress' => 0
        ];

        $userContentId1 = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent1);

        $userContent2 = [
            'content_id' => $contentId2,
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_ADDED_TO_LIST,
            'progress' => 0
        ];

        $userContentId2 = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent2);

        $userContentPlaylist1 = [
            'content_user_id' => $userContentId1,
            'playlist_id' => $playlistId
        ];

        $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userContentPlaylist1);

        $userContentPlaylist2 = [
            'content_user_id' => $userContentId2,
            'playlist_id' => $playlistId
        ];

        $this->query()->table(ConfigService::$tableUserContentPlaylists)->insertGetId($userContentPlaylist2);

        $expectedResults = [
            $playlistId => [
                'id' => $playlistId,
                'name' => $playlistName,
                'type' => $playlist['type'],
                'brand' => ConfigService::$brand,
                'contents' => [
                    $contentId1 => [
                        'id' => $contentId1,
                        'state' => $userContent1['state'],
                        'progress' => $userContent1['progress']
                    ],
                    $contentId2 => [
                        'id' => $contentId2,
                        'state' => $userContent2['state'],
                        'progress' => $userContent2['progress']
                    ]
                ]
            ]
        ];
        $results = $this->serviceBeingTested->getPlaylist($playlistId, $this->userId);

        $this->assertEquals($expectedResults, $results);
    }
}
