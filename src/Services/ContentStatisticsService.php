<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentStatisticsRepository;

class ContentStatisticsService
{
	/**
     * @var ContentStatisticsRepository
     */
    private $contentStatisticsRepository;

    /**
     * ContentStatisticsService constructor.
     *
     * @param ContentStatisticsRepository $contentStatisticsRepository
     */
    public function __construct(
        ContentStatisticsRepository $contentStatisticsRepository
    ) {
        $this->contentStatisticsRepository = $contentStatisticsRepository;
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
     */
    public function computeContentStatistics(Carbon $smallDate, Carbon $bigDate)
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
            $this->computeIntervalContentStatistics(...$interval);
        }
    }

    /**
     * @param Carbon $smallDate
     * @param Carbon $bigDate
     * @param int $weekOfYear
     */
    public function computeIntervalContentStatistics(Carbon $start, Carbon $end, int $weekOfYear)
    {
        // todo - add logic

        // fetch content ids, content_type, content_published_on
            // filter by ConfigService::$statisticsContentTypes, maybe also filter by created_on <= $end

        // foreach content id
            // call $this->getIndividualContentStatistics($start, $end)
            // add content details, $weekOfYear, $start, $end
            // insert into ConfigService::$tableContentStatistics
    }

    /**
     * @param Carbon $smallDate
     * @param Carbon $bigDate
     *
     * @return array
     */
    public function getContentStatisticsIntervals(Carbon $smallDate, Carbon $bigDate): array
    {
        // todo - add logic

        return []
    }
}
