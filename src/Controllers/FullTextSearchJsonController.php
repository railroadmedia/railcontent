<?php

namespace Railroad\Railcontent\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Responses\JsonPaginatedResponse;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Transformers\DataTransformer;

class FullTextSearchJsonController extends Controller
{
    /**
     * @var FullTextSearchService
     */
    private $fullTextSearchService;

    /**
     * FullTextSearchJsonController constructor.
     * @param FullTextSearchService $fullTextSearchService
     */
    public function __construct(FullTextSearchService $fullTextSearchService)
    {
        $this->fullTextSearchService = $fullTextSearchService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /** Call the method from the service to pull the contents based on the criteria passed in request.
     *  Return a Json paginated response with the contents
     *
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
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

        return reply()->json(
            $contentsData['results'],
            [
                'transformer' => DataTransformer::class,
                'totalResults' => $contentsData['total_results']
            ]
        );
    }
}