<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Repositories\ContentStatisticsRepository;

class ContentStatisticsService
{
	/**
     * @var ContentStatisticsRepository
     */
    private $contentStatisticsRepository;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * ContentStatisticsService constructor.
     *
     * @param ContentStatisticsRepository $contentStatisticsRepository
     */
    public function __construct(
        ContentStatisticsRepository $contentStatisticsRepository
    ) {
        $this->contentStatisticsRepository = $contentStatisticsRepository;
        $this->databaseManager = app('db');
    }

    /**
     * @param contentId $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return array
     */
	public function getIndividualContentStatistics($contentId, ?Carbon $smallDate, ?Carbon $bigDate): array
    {
        $completedCount = $this->contentStatisticsRepository->getCompletedContentCount(
            $contentId,
            $smallDate,
            $bigDate
        );

        $startedCount = $this->contentStatisticsRepository->getStartedContentCount(
            $contentId,
            $smallDate,
            $bigDate
        );

        $commentsCount = $this->contentStatisticsRepository->getContentCommentsCount(
            $contentId,
            $smallDate,
            $bigDate
        );

        $likesCount = $this->contentStatisticsRepository->getContentLikesCount(
            $contentId,
            $smallDate,
            $bigDate
        );

        $listedCount = $this->contentStatisticsRepository->getContentAddToListCount(
            $contentId,
            $smallDate,
            $bigDate
        );

        return [
            'total_completes' => $completedCount,
            'total_starts' => $startedCount,
            'total_comments' => $commentsCount,
            'total_likes' => $likesCount,
            'total_added_to_list' => $listedCount,
        ];
    }

    /**
     * @param Carbon $smallDate
     * @param Carbon $bigDate
     * @param mixed $command
     */
    public function computeContentStatistics(Carbon $smallDate, Carbon $bigDate, $command)
    {
        $intervals = $this->getContentStatisticsIntervals($smallDate, $bigDate);

        /*
        $intervals = [
            0 => [
                'start' => Carbon (Sunday),
                'end' => Carbon (Saturday),
                'week' => int (week of year),
            ],
            ...
            n => [
                'start' => Carbon (Sunday),
                'end' => Carbon (Saturday),
                'week' => int (week of year),
            ]
        ];
        the $smallDate is between $intervals[0]['start'] and $intervals[0]['end']
        the $bigDate is between $intervals[n]['start'] and $intervals[n]['end']
        */

        foreach ($intervals as $interval) {
            if ($command) {
                // todo - remove after optimizations done
                $start = microtime(true);
            }
            $this->computeIntervalContentStatistics($interval['start'], $interval['end'], $interval['week']);
            if ($command) {
                // todo - remove after optimizations done
                $finish = microtime(true) - $start;
                $format = "Finished sub-interval [%s -> %s] in total %s seconds\n";
                $command->info(
                    sprintf(
                        $format,
                        $interval['start']->toDateTimeString(),
                        $interval['end']->toDateTimeString(),
                        $finish
                    )
                );
            }
        }
    }

    /**
     * @param Carbon $smallDate
     * @param Carbon $bigDate
     * @param int $weekOfYear
     */
    public function computeIntervalContentStatistics(Carbon $start, Carbon $end, int $weekOfYear)
    {
        $contentDataToProcess = $this->contentStatisticsRepository->getStatisticsContentIds($end);

        $insertData = [];
        $insertChunkSize = 1000;

        foreach ($contentDataToProcess as $contentData) {

            $contentStats = $this->getIndividualContentStatistics($contentData['content_id'], $start, $end);

            $hasPositiveValues = false;

            foreach ($contentStats as $statsValue) {
                if ($statsValue > 0) {
                    $hasPositiveValues = true;
                    break;
                }
            }

            if (!$hasPositiveValues) {
                continue;
            }

            $stats = $contentData + [
                'completes' => $contentStats['total_completes'],
                'starts' => $contentStats['total_starts'],
                'comments' => $contentStats['total_comments'],
                'likes' => $contentStats['total_likes'],
                'added_to_list' => $contentStats['total_added_to_list'],
                'start_interval' => $start->toDateTimeString(),
                'end_interval' => $end->toDateTimeString(),
                'week_of_year' => $weekOfYear,
                'created_on' => Carbon::now()->toDateTimeString(),
            ];

            $insertData[] = $stats;

            if (count($insertData) > $insertChunkSize) {
                $this->contentStatisticsRepository->bulkInsert($insertData);
                $insertData = [];
            }
        }

        if (!empty($insertData)) {
            $this->contentStatisticsRepository->bulkInsert($insertData);
        }
    }

    /**
     * @param Carbon $smallDate
     * @param Carbon $bigDate
     *
     * @return array
     */
    public function getContentStatisticsIntervals(Carbon $smallDate, Carbon $bigDate): array
    {
        $intervalStart = $smallDate->copy()->subDays($smallDate->dayOfWeek)->startOfDay();
        $intervalEnd = $intervalStart->copy()->addDays(6)->endOfDay();

        $lastDay = $bigDate->copy()->addDays(6 - $bigDate->dayOfWeek)->endOfDay();

        $result = [
            [
                'start' => $intervalStart,
                'end' => $intervalEnd,
                'week' => $intervalEnd->weekOfYear
            ]
        ];

        while ($intervalEnd < $lastDay) {

            $intervalStart = $intervalStart->copy()->addDays(7);
            $intervalEnd = $intervalEnd->copy()->addDays(7);

            $result[] = [
                'start' => $intervalStart,
                'end' => $intervalEnd,
                'week' => $intervalEnd->weekOfYear
            ];
        }

        return $result;
    }
}
