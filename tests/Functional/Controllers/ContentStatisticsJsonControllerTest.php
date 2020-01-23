<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentLikeRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * @var ContentHierarchyRepository
     */
    protected $contentHierarchyRepository;

    /**
     * @var ContentLikeRepository
     */
    protected $contentLikeRepository;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var UserContentProgressRepository
     */
    protected $userContentRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->commentRepository = $this->app->make(CommentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        $this->contentLikeRepository = $this->app->make(ContentLikeRepository::class);
        $this->userContentRepository = $this->app->make(UserContentProgressRepository::class);
    }

    public function test_individual_content_statistics()
    {
        // random date, between 16 and 30 days ago
        $testSmallDate = Carbon::now()->subDays($this->faker->numberBetween(16, 30));

        // random date, between 5 and 15 days ago
        $testBigDate = Carbon::now()->subDays($this->faker->numberBetween(5, 15));

        // add content
        $contentIds = [];

        for ($i=0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                $this->faker->word,
                $this->faker->randomElement(ConfigService::$commentableContentTypes),
                ContentService::STATUS_PUBLISHED
            );
            $contentIds[] = $content['id'];
        }

        $testContentId = $this->faker->randomElement($contentIds);

        $expectedCompleted = 0;

        // add progress complete
        for ($i=0; $i < 50; $i++) {

            // increased chance to add progress to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId
                ]
            );

            // user content progress date may be a little out of the test interval
            $updatedOn = Carbon::now()->subDays($this->faker->numberBetween(2, 35));

            $userContentProgress = $this->addUserContentProgress(
                $contentId,
                UserContentProgressService::STATE_COMPLETED,
                $updatedOn
            );

            if (
                $contentId == $testContentId
                && $updatedOn >= $testSmallDate
                && $updatedOn <= $testBigDate
            ) {
                $expectedCompleted++;
            }
        }

        $expectedStarts = 0;

        // add progress started
        for ($i=0; $i < 50; $i++) {

            // increased chance to add progress to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId
                ]
            );

            // user content progress date may be a little out of the test interval
            $updatedOn = Carbon::now()->subDays($this->faker->numberBetween(2, 35));

            $userContentProgress = $this->addUserContentProgress(
                $contentId,
                UserContentProgressService::STATE_STARTED,
                $updatedOn
            );

            if (
                $contentId == $testContentId
                && $updatedOn >= $testSmallDate
                && $updatedOn <= $testBigDate
            ) {
                $expectedStarts++;
            }
        }

        $expectedComments = 0;

        // add comments
        for ($i=0; $i < 50; $i++) {

            // increased chance to add comment to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId
                ]
            );

            // comment date may be a little out of the test interval
            $createdOn = Carbon::now()->subDays($this->faker->numberBetween(2, 35));

            $comment = $this->addContentComment($contentId, $createdOn);

            if (
                $contentId == $testContentId
                && $createdOn >= $testSmallDate
                && $createdOn <= $testBigDate
            ) {
                $expectedComments++;
            }
        }

        $expectedLikes = 0;

        // add likes
        for ($i=0; $i < 50; $i++) {

            // increased chance to add like to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId
                ]
            );

            // like date may be a little out of the test interval
            $createdOn = Carbon::now()->subDays($this->faker->numberBetween(2, 35));

            $like = $this->addContentLike($contentId, $createdOn);

            if (
                $contentId == $testContentId
                && $createdOn >= $testSmallDate
                && $createdOn <= $testBigDate
            ) {
                $expectedLikes++;
            }
        }

        $expectedAddToList = 0;

        // add to lists
        for ($i=0; $i < 50; $i++) {

            // increased chance to add to a list the test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId
                ]
            );

            // add to lists date may be a little out of the test interval
            $createdOn = Carbon::now()->subDays($this->faker->numberBetween(2, 35));

            $addToList = $this->addContentToList($contentId, $createdOn);

            if (
                $contentId == $testContentId
                && $createdOn >= $testSmallDate
                && $createdOn <= $testBigDate
            ) {
                $expectedAddToList++;
            }
        }

        $response = $this->call(
            'GET',
            'railcontent/content-statistics/individual/' . $testContentId,
            [
                'small_date_time' => $testSmallDate->toDateTimeString(),
                'big_date_time' => $testBigDate->toDateTimeString(),
            ]
        );

        $this->assertEquals(
            [
                'total_completes' => $expectedCompleted,
                'total_starts' => $expectedStarts,
                'total_comments' => $expectedComments,
                'total_likes' => $expectedLikes,
                'total_added_to_list' => $expectedAddToList,
            ],
            $response->decodeResponseJson()
        );
    }

    protected function addUserContentProgress($contentId, $state, $updatedOn = null)
    {
        // UserContentProgressFactory does not allow to specify the UserContentProgress updated_on field

        $progressPercent = $state == UserContentProgressService::STATE_COMPLETED ? 100 : 50;

        if (!$updatedOn) {
            $updatedOn = Carbon::now();
        }

        $updatedOn = $updatedOn->toDateTimeString();

        $this->userContentRepository->create(
            [
                'content_id' => $contentId,
                'user_id' => rand(),
                'state' => $state,
                'progress_percent' => $progressPercent,
                'updated_on' => $updatedOn,
            ]
        );
    }

    protected function addContentComment($contentId, $createdOn = null)
    {
        // CommentFactory does not allow to specify the comment created_on field

        if (!$createdOn) {
            $createdOn = Carbon::now();
        }

        $createdOn = $createdOn->toDateTimeString();

        $this->commentRepository->create(
            [
                'content_id' => $contentId,
                'user_id' => rand(),
                'comment' => $this->faker->word,
                'temporary_display_name' => $this->faker->word,
                'created_on' => $createdOn,
            ]
        );
    }

    protected function addContentLike($contentId, $createdOn = null)
    {
        if (!$createdOn) {
            $createdOn = Carbon::now();
        }

        $createdOn = $createdOn->toDateTimeString();

        $this->contentLikeRepository->create(
            [
                'content_id' => $contentId,
                'user_id' => rand(),
                'created_on' => $createdOn,
            ]
        );
    }

    protected function addContentToList($contentId, $createdOn = null)
    {
        if (!$createdOn) {
            $createdOn = Carbon::now();
        }

        $createdOn = $createdOn->toDateTimeString();

        $contentUserPlaylist = $this->contentFactory->create(
            $this->faker->word,
            'user-playlist',
            ContentService::STATUS_PUBLISHED
        );

        $this->contentHierarchyRepository->create(
            [
                'parent_id' => $contentUserPlaylist['id'],
                'child_id' => $contentId,
                'child_position' => 0,
                'created_on' => $createdOn,
            ]
        );
    }
}
