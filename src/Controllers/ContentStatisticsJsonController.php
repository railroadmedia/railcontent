<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\IndividualStatisticsContentRequest;
use Railroad\Railcontent\Requests\StatisticsContentRequest;
use Railroad\Railcontent\Services\ContentStatisticsService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentStatisticsJsonController extends Controller
{
    /**
     * @var ContentStatisticsService
     */
    private $contentStatisticsService;

    /**
     * ContentStatisticsJsonController constructor.
     *
     * @param ContentStatisticsService $contentStatisticsService
     */
    public function __construct(ContentStatisticsService $contentStatisticsService)
    {
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
        $stats = $this->contentStatisticsService->getContentStatistics($request);

        return reply()->json($stats);
    }
}
