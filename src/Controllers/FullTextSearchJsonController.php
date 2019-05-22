<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Responses\JsonPaginatedResponse;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Services\ResponseService;

class FullTextSearchJsonController extends Controller
{
    /**
     * @var FullTextSearchService
     */
    private $fullTextSearchService;

    /**
     * FullTextSearchJsonController constructor.
     *
     * @param FullTextSearchService $fullTextSearchService
     */
    public function __construct(FullTextSearchService $fullTextSearchService)
    {
        $this->fullTextSearchService = $fullTextSearchService;
    }

    /** Call the method from the service to pull the contents based on the criteria passed in request.
     *  Return a Json paginated response with the contents
     *
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        ContentRepository::$availableContentStatues =
            $request->get('statuses', ContentRepository::$availableContentStatues);

        $contentsData = $this->fullTextSearchService->search(
            $request->get('term', null),
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('included_types', []),
            $request->get('statuses', []),
            $request->get('sort', '-score'),
            $request->get('date_time_cutoff', null),
            $request->get('brands', null)
        );

        return ResponseService::content($contentsData['results'], $contentsData['qb'])
            ->respond();
    }
}