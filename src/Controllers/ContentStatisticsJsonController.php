<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentStatisticsRepository;
use Railroad\Railcontent\Requests\IndividualStatisticsContentRequest;
use Railroad\Railcontent\Requests\StatisticsContentRequest;
use Railroad\Railcontent\Services\ContentStatisticsService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentStatisticsJsonController extends Controller
{
    /**
     * @var ContentStatisticsRepository
     */
    private $contentStatisticsRepository;

    /**
     * @var ContentStatisticsService
     */
    private $contentStatisticsService;

    /**
     * ContentStatisticsJsonController constructor.
     *
     * @param ContentStatisticsRepository $contentStatisticsRepository
     * @param ContentStatisticsService $contentStatisticsService
     */
    public function __construct(
        ContentStatisticsRepository $contentStatisticsRepository,
        ContentStatisticsService $contentStatisticsService
    ) {
        $this->contentStatisticsRepository = $contentStatisticsRepository;
        $this->contentStatisticsService = $contentStatisticsService;
    }

    /**
     * Fetch individual content statistics
     *
     * @param IndividualStatisticsContentRequest $request
     * @param int $contentId
     *
     * @return JsonResponse
     */
    public function individualContentStatistics(IndividualStatisticsContentRequest $request, $contentId)
    {
        $smallDateTime = $request->has('small_date_time') ?
                            Carbon::parse($request->get('small_date_time')) : null;
        $bigDateTime = $request->has('big_date_time') ?
                            Carbon::parse($request->get('big_date_time')) : null;

        $stats = $this->contentStatisticsService->getIndividualContentStatistics(
            $contentId,
            $smallDateTime,
            $bigDateTime
        );

        return new JsonResponse($stats);
    }

    /**
     * Fetch content statistics
     *
     * @param StatisticsContentRequest $request
     *
     * @return JsonResponse
     */
    public function contentStatistics(StatisticsContentRequest $request)
    {
        $smallDate = $request->has('small_date_time') ? Carbon::parse($request->get('small_date_time')) : null;
        $bigDate = $request->has('big_date_time') ? Carbon::parse($request->get('big_date_time')) : null;
        $publishedOnSmallDate = $request->has('published_on_small_date_time') ?
                                Carbon::parse($request->get('published_on_small_date_time')) : null;
        $publishedOnBigDate = $request->has('published_on_big_date_time') ?
                                Carbon::parse($request->get('published_on_big_date_time')) : null;

        $sortBy = null;
        $sortDir = null;

        if ($request->has('sort_by')) {
            $sortBy = $request->get('sort_by');
            $sortDir = $request->has('sort_dir') ? $request->get('sort_dir') : 'desc';
        }

        if ($smallDate) {
            $smallDate = $smallDate->subDays($smallDate->dayOfWeek)->startOfDay();
        }

        if ($bigDate) {
            $bigDate = $bigDate->addDays(6 - $bigDate->dayOfWeek)->endOfDay();
        }

        $stats = $this->contentStatisticsRepository->getContentStatistics(
            $smallDate,
            $bigDate,
            $publishedOnSmallDate,
            $publishedOnBigDate,
            $request->get('content_types'),
            $sortBy,
            $sortDir
        );

        return new JsonResponse($stats);
    }
}
