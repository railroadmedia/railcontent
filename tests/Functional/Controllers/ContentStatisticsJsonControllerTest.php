<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentLikeRepository;
use Railroad\Railcontent\Repositories\ContentStatisticsRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ContentStatisticsService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentStatisticsJsonControllerTest extends RailcontentTestCase
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
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;
    /**
     * @var UserContentProgressRepository
     */
    protected $userContentRepository;
    /**
     * @var ContentStatisticsRepository
     */
    private $contentStatisticsRepository;
    /**
     * @var ContentStatisticsService
     */
    private $contentStatisticsService;

    public function test_content_statistics()
    {
        // random date, between 16 and 30 days ago
        $testSmallDate = Carbon::now()->subDays($this->faker->numberBetween(16, 30));

        // random date, between 5 and 15 days ago
        $testBigDate = Carbon::now()->subDays($this->faker->numberBetween(5, 15));

        $testIntervalSmallDate = $testSmallDate->copy()->subDays($testSmallDate->dayOfWeek)->startOfDay();
        $testIntervalBigDate = $testBigDate->addDays(6 - $testBigDate->dayOfWeek)->endOfDay();

        // add content
        $contentData = [];

        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->randomElement(ConfigService::$commentableContentTypes),
                ContentService::STATUS_PUBLISHED
            );
            $fieldTitle = $this->contentFieldFactory->create($content['id'], 'title');
            $contentData[$content['id']] = [
                'content_id' => $content['id'],
                'content_type' => $content['type'],
                'content_published_on' => $content['published_on'],
                'content_brand' => $content['brand'],
                'content_title' => $fieldTitle['value'],
            ];
        }

        // content statistics seed intervals
        $intervals = $this->contentStatisticsService->getContentStatisticsIntervals(
            Carbon::now()->subDays($this->faker->numberBetween(35, 45)),
            Carbon::now()
        );

        $expectedStats = [];

        foreach ($intervals as $interval) {
            foreach ($contentData as $contentId => $content) {
                if (!$this->faker->randomElement([0, 1, 1, 1, 1])) {
                    // for 1 in 5 chance, do not add content stats, as in all stats should be 0
                    continue;
                }

                // generate random stats
                $contentStats = [
                    'completes' => $this->faker->numberBetween(0, 15),
                    'starts' => $this->faker->numberBetween(1, 15),
                    'comments' => $this->faker->numberBetween(0, 15),
                    'likes' => $this->faker->numberBetween(0, 15),
                    'added_to_list' => $this->faker->numberBetween(1, 15),
                    'start_interval' => $interval['start']->toDateTimeString(),
                    'end_interval' => $interval['end']->toDateTimeString(),
                    'week_of_year' => $interval['week'],
                    'created_on' => Carbon::now()->toDateTimeString(),
                ];

                $insertData = array_diff_key(
                        $content,
                        ['content_brand' => true, 'content_title' => true]
                    ) + $contentStats;

                $this->contentStatisticsRepository->create($insertData);

                if (
                    $interval['start'] >= $testIntervalSmallDate
                    && $interval['start'] <= $testIntervalBigDate
                    && $interval['end'] >= $testIntervalSmallDate
                    && $interval['end'] <= $testIntervalBigDate
                ) {
                    if (!isset($expectedStats[$contentId])) {
                        $expectedStats[$contentId] = $content + [
                                'total_completes' => 0,
                                'total_starts' => 0,
                                'total_comments' => 0,
                                'total_likes' => 0,
                                'total_added_to_list' => 0,
                            ];
                    }

                    $expectedStats[$contentId]['total_completes'] += $contentStats['completes'];
                    $expectedStats[$contentId]['total_starts'] += $contentStats['starts'];
                    $expectedStats[$contentId]['total_comments'] += $contentStats['comments'];
                    $expectedStats[$contentId]['total_likes'] += $contentStats['likes'];
                    $expectedStats[$contentId]['total_added_to_list'] += $contentStats['added_to_list'];
                }
            }
        }

        $response = $this->call(
            'GET',
            'railcontent/content-statistics',
            [
                'small_date_time' => $testSmallDate->toDateTimeString(),
                'big_date_time' => $testBigDate->toDateTimeString(),
                'sort_by' => 'total_completes',
                'sort_dir' => 'desc',
            ]
        );

        $lastSortedByValue = -1;

        foreach ($response->decodeResponseJson()->json() as $stats) {
            // assert stats value
            $this->assertEquals(
                $expectedStats[$stats['content_id']],
                $stats
            );

            // assert sorting
            if ($lastSortedByValue >= 0) {
                // each stats result, starting with second group, should have total_completes less or equal to previous group
                $this->assertTrue($lastSortedByValue >= $stats['total_completes']);
            }

            $lastSortedByValue = $stats['total_completes'];
        }
    }

    public function test_individual_content_statistics()
    {
        // random date, between 16 and 30 days ago
        $testSmallDate = Carbon::now()->subDays($this->faker->numberBetween(16, 30));

        // random date, between 5 and 15 days ago
        $testBigDate = Carbon::now()->subDays($this->faker->numberBetween(5, 15));

        // add content
        $contentIds = [];

        for ($i = 0; $i < 10; $i++) {
            $content = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->randomElement(ConfigService::$commentableContentTypes),
                ContentService::STATUS_PUBLISHED
            );
            $contentIds[] = $content['id'];
        }

        $testContentId = $this->faker->randomElement($contentIds);

        $expectedCompleted = 0;

        // add progress complete
        for ($i = 0; $i < 50; $i++) {
            // increased chance to add progress to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId,
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
        for ($i = 0; $i < 50; $i++) {
            // increased chance to add progress to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId,
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
        for ($i = 0; $i < 50; $i++) {
            // increased chance to add comment to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId,
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
        for ($i = 0; $i < 50; $i++) {
            // increased chance to add like to test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId,
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
        for ($i = 0; $i < 50; $i++) {
            // increased chance to add to a list the test content id
            $contentId = $this->faker->randomElement(
                [
                    $this->faker->randomElement($contentIds),
                    $testContentId,
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
            $response->decodeResponseJson()->json()
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
                'started_on' => $updatedOn,
                'completed_on' => $updatedOn,
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

        $myList = [
            'brand' => config('railcontent.brand'),
            'type' => 'primary-playlist',
            'user_id' => rand(),
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];

        $myListId =
            $this->query()
                ->table(ConfigService::$tablePlaylists)
                ->insertGetId($myList);

        $userPlaylistContent1 = [
            'content_id' => $contentId,
            'user_playlist_id' => $myListId,
            'created_at' => $createdOn,
        ];

        $this->query()
            ->table(ConfigService::$tablePlaylistContents)
            ->insertGetId($userPlaylistContent1);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentRepository = $this->app->make(CommentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->contentHierarchyRepository = $this->app->make(ContentHierarchyRepository::class);
        $this->contentLikeRepository = $this->app->make(ContentLikeRepository::class);
        $this->contentStatisticsRepository = $this->app->make(ContentStatisticsRepository::class);
        $this->contentStatisticsService = $this->app->make(ContentStatisticsService::class);
        $this->userContentRepository = $this->app->make(UserContentProgressRepository::class);
    }
}
