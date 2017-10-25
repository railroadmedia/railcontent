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

        // todo: this is a work in progress, and was copied and edited from the field filtering tests

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
                    1 => $requiredUserPlaylistName,
                    2 => $requiredUserPlaylistUserId,
                    3 => $requiredUserPlaylistContentId,
                    4 => 1
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
                    1 => $requiredUserPlaylistName,
                    2 => $requiredUserPlaylistUserId,
                    3 => $requiredUserPlaylistContentId,
                    4 => 1
                ]
            );

            $otherRequiredPlaylist = $this->userPlaylistFactory->create(
                [
                    0 => $expectedContent['id'],
                    1 => $otherRequiredUserPlaylistName,
                    2 => $otherRequiredUserPlaylistUserId,
                    3 => $otherRequiredUserPlaylistContentId,
                    4 => 1
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
                $requiredUserPlaylistName,
                $requiredUserPlaylistUserId,
                $requiredUserPlaylistContentId
            )
            ->requirePlaylist(
                $otherRequiredUserPlaylistName,
                $otherRequiredUserPlaylistUserId,
                $otherRequiredUserPlaylistContentId
            )
            ->get();

        $this->assertEquals([8, 9, 10], array_column($rows, 'id'));
    }

}