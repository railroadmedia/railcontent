<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentStatistics;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentStatisticsRepository;

class ContentStatisticsService
{

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ContentStatisticsRepository
     */
    private $contentStatisticsRepository;

    private $contentRepository;

    /**
     * ContentStatisticsService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(RailcontentEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->contentStatisticsRepository = $this->entityManager->getRepository(ContentStatistics::class);

        $this->contentRepository = $this->entityManager->getRepository(Permission::class);
    }

    public function getFieldFiltersValues()
    {
        return [
            'difficulty' => $this->contentStatisticsRepository->getDifficultyFieldsValues(),
            'instructor' => $this->contentStatisticsRepository->getInstructorFieldsValues(),
            'style' => $this->contentStatisticsRepository->getStyleFieldsValues(),
            'tag' => $this->contentStatisticsRepository->getTagFieldsValues(),
            'topic' => $this->contentStatisticsRepository->getTopicFieldsValues(),
        ];
    }

    /**
     * @param contentId $id
     * @param Carbon|null $smallDate
     * @param Carbon|null $bigDate
     *
     * @return array
     */
    public function getIndividualContentStatistics($contentId, ?Carbon $smallDate, ?Carbon $bigDate)
    : array {
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
    public function computeContentStatistics(Carbon $smallDate, Carbon $bigDate, $command = null)
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
        $this->contentStatisticsRepository->removeExistingIntervalContentStatistics($start, $end);
        $this->contentStatisticsRepository->initIntervalContentStatistics($start, $end, $weekOfYear);
        $this->contentStatisticsRepository->computeIntervalCompletesContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeIntervalStartsContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeIntervalCommentsContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeIntervalLikesContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeIntervalAddToListContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeTopLevelCommentsContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeTopLevelLikesContentStatistics($start, $end);
        $this->contentStatisticsRepository->computeContentStatisticsAge($start, $end);
        $this->contentStatisticsRepository->cleanIntervalContentStatistics($start, $end);
    }

    /**
     * @param Carbon $smallDate
     * @param Carbon $bigDate
     *
     * @return array
     */
    public function getContentStatisticsIntervals(Carbon $smallDate, Carbon $bigDate)
    : array {
        $intervalStart =
            $smallDate->copy()
                ->subDays($smallDate->dayOfWeek)
                ->startOfDay();
        $intervalEnd =
            $intervalStart->copy()
                ->addDays(6)
                ->endOfDay();

        $lastDay =
            $bigDate->copy()
                ->addDays(6 - $bigDate->dayOfWeek)
                ->endOfDay();

        $result = [
            [
                'start' => $intervalStart,
                'end' => $intervalEnd,
                'week' => $intervalEnd->weekOfYear,
            ],
        ];

        while ($intervalEnd < $lastDay) {

            $intervalStart =
                $intervalStart->copy()
                    ->addDays(7);
            $intervalEnd =
                $intervalEnd->copy()
                    ->addDays(7);

            $result[] = [
                'start' => $intervalStart,
                'end' => $intervalEnd,
                'week' => $intervalEnd->weekOfYear,
            ];
        }

        return $result;
    }
}