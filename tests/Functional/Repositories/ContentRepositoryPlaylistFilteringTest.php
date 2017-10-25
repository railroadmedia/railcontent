<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\PlaylistFactory;
use Railroad\Railcontent\Factories\UserPlaylistFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryPlaylistFilteringTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var PlaylistFactory
     */
    protected $playlistFactory;

    /**
     * @var UserPlaylistFactory
     */
    protected $userPlaylistFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->playlistFactory = $this->app->make(PlaylistFactory::class);
        $this->userPlaylistFactory = $this->app->make(UserPlaylistFactory::class);
    }

    public function test_require_playlists_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 5, 6, 7... 14 ]
         *
         * Expected content ids after  pagination:
         * [ 8, 9, 10 ]
         *
         */

        $type = $this->faker->word;
        $userId = $this->faker->randomNumber();

        $requiredUserPlaylistName = $this->faker->word;
        $requiredUserPlaylistUserId = $this->faker->word;
        $requiredUserPlaylistContentId = $this->faker->word;

        $otherRequiredUserPlaylistName = $this->faker->word;
        $otherRequiredUserPlaylistUserId = $this->faker->word;
        $otherRequiredUserPlaylistContentId = $this->faker->word;

        $requiredPlaylistId = $this->playlistFactory->create(
            [
                0 => $requiredUserPlaylistName,
                1 => $requiredUserPlaylistUserId
            ]
        );

        $otherRequiredPlaylistId = $this->playlistFactory->create(
            [
                0 => $otherRequiredUserPlaylistName,
                1 => $otherRequiredUserPlaylistUserId
            ]
        );


        // content that has none of the required playlists
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that only has 1 of the required playlists
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $userPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $requiredPlaylistId,
                    2 => $requiredUserPlaylistUserId,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that has all the required playlists
        for ($i = 0; $i < 10; $i++) {
            $expectedContent = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $requiredUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $requiredPlaylistId,
                    2 => $requiredUserPlaylistUserId,
                ]
            );

            $otherRequiredPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherRequiredPlaylistId,
                    2 => $otherRequiredUserPlaylistUserId
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $expectedContent['id']
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type])
            ->requireUserPlaylist(
                $requiredUserPlaylistUserId,
                $requiredUserPlaylistName
            )
            ->requireUserPlaylist(
                $otherRequiredUserPlaylistUserId,
                $otherRequiredUserPlaylistName
            )
            ->get();

        $this->assertEquals([8, 9, 10], array_column($rows, 'id'));
    }

    public function test_include_single_playlist_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 3, 4, 5, 6... 12 ]
         *
         * Expected content ids after  pagination:
         * [ 6, 7, 8 ]
         *
         */

        $type = $this->faker->word;
        $userId = $this->faker->numberBetween();
        $includedUserPlaylistName = $this->faker->word;

        $includedPlaylistId = $this->playlistFactory->create(
            [
                0 => $includedUserPlaylistName,
                1 => $userId
            ]
        );

        // content that has none of the included playlists
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that only has 1 of the included playlists
        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedPlaylistId,
                    2 => $userId,
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type])
            ->includeUserPlaylist(
                $userId,
                $includedUserPlaylistName
            )
            ->get();

        $this->assertEquals([6, 7, 8], array_column($rows, 'id'));
    }

    public function test_include_playlists_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 3, 4, 5, 6... 12 ]
         *
         * Expected content ids after  pagination:
         * [ 9, 10, 11 ]
         *
         */

        $type = $this->faker->word;
        $userId = $this->faker->numberBetween();
        $includedUserPlaylistName = $this->faker->word;
        $otherIncludedUserPlaylistName = $this->faker->word;

        $includedPlaylistId = $this->playlistFactory->create(
            [
                0 => $includedUserPlaylistName,
                1 => $userId
            ]
        );

        $otherIncludedPlaylistId = $this->playlistFactory->create(
            [
                0 => $otherIncludedUserPlaylistName,
                1 => $userId
            ]
        );

        // content that has none of the included playlists
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that only has 1 of the included playlists
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedPlaylistId,
                    2 => $userId,
                ]
            );
            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that only has all of the included playlists
        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedPlaylistId,
                    2 => $userId,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $otherIncludedPlaylistId,
                    2 => $userId,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(3, 3, 'id', 'asc', [$type])
            ->includeUserPlaylist(
                $userId,
                $includedUserPlaylistName
            )
            ->includeUserPlaylist(
                $userId,
                $otherIncludedUserPlaylistName
            )
            ->get();

        $this->assertEquals([9, 10, 11], array_column($rows, 'id'));
    }

    public function test_included_and_required_playlists_with_pagination()
    {
        /*
         * Expected content ids before pagination:
         * [ 8, 9... 17 ]
         *
         * Expected content ids after  pagination:
         * [ 11, 12, 13 ]
         *
         */

        $type = $this->faker->word;
        $userId = $this->faker->numberBetween();
        $requiredUserPlaylistName = $this->faker->word;
        $otherRequiredUserPlaylistName = $this->faker->word;
        $includedUserPlaylistName = $this->faker->word;
        $otherIncludedUserPlaylistName = $this->faker->word;

        $requiredPlaylistId = $this->playlistFactory->create(
            [
                0 => $requiredUserPlaylistName,
                1 => $userId
            ]
        );

        $otherRequiredUserPlaylistId = $this->playlistFactory->create(
            [
                0 => $otherRequiredUserPlaylistName,
                1 => $userId
            ]
        );

        $includedPlaylistId = $this->playlistFactory->create(
            [
                0 => $includedUserPlaylistName,
                1 => $userId
            ]
        );

        $otherIncludedPlaylistId = $this->playlistFactory->create(
            [
                0 => $otherIncludedUserPlaylistName,
                1 => $userId
            ]
        );

        // content that has none of the included playlists
        for ($i = 0; $i < 5; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that only has 1 of the included playlists and 1 required playlists
        for ($i = 0; $i < 2; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedPlaylistId,
                    2 => $userId,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $requiredPlaylistId,
                    2 => $userId,
                ]
            );
            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        // content that only has 1 of the included playlists and the all required playlists
        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                [
                    1 => ContentService::STATUS_PUBLISHED,
                    2 => $type,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $includedPlaylistId,
                    2 => $userId,
                ]
            );

            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $requiredPlaylistId,
                    2 => $userId,
                ]
            );
            $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    1 => $otherRequiredUserPlaylistId,
                    2 => $userId,
                ]
            );

            $randomUserPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $content['id'],
                    2 => $userId,
                ]
            );
        }

        $rows = $this->classBeingTested->startFilter(2, 3, 'id', 'asc', [$type])
            ->requireUserPlaylist(
                $userId,
                $requiredUserPlaylistName
            )
            ->requireUserPlaylist(
                $userId,
                $otherRequiredUserPlaylistName
            )
            ->includeUserPlaylist(
                $userId,
                $includedUserPlaylistName
            )
            ->includeUserPlaylist(
                $userId,
                $otherIncludedUserPlaylistName
            )
            ->get();

        $this->assertEquals([11, 12, 13], array_column($rows, 'id'));
    }
}