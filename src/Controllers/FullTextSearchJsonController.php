<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Responses\JsonPaginatedResponse;
use Railroad\Railcontent\Services\ElasticService;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Services\ResponseService;

/**
 * Class FullTextSearchJsonController
 *
 * @package Railroad\Railcontent\Controllers
 *
 * @group Full text search API
 */
class FullTextSearchJsonController extends Controller
{
    /**
     * @var FullTextSearchService
     */
    private $fullTextSearchService;

    /**
     * @var ElasticService
     */
    private $elasticService;

    /**
     * FullTextSearchJsonController constructor.
     *
     * @param FullTextSearchService $fullTextSearchService
     */
    public function __construct(FullTextSearchService $fullTextSearchService, ElasticService $elasticService)
    {
        $this->fullTextSearchService = $fullTextSearchService;

        $this->elasticService = $elasticService;
    }

    /** Full text search in contents
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @bodyParam term string required    Serch criteria. Example:Expanding The Triple Paradiddle
     * @bodyParam included_types string Contents with these types will be returned. Example:
     * @bodyParam statuses string    All content must have one of these statuses. By default:published.
     *     Example:published
     * @bodyParam sort string  Defaults to descending order; to switch to ascending order remove the minus sign (-).
     *     Can be any of the following: score or content_published_on. By default:-score. Example:-score
     * @bodyParam brand string  Contents from the brand will be returned. Example:brand
     * @bodyParam page integer  Which page to load, will be {limit} long.By default:1. Example:1
     * @bodyParam limit integer  How many to load per page. By default:10. Example:10
     * @responseFile ../../../../../docs-new/responseFile/fullTextSearch.json
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

        return ResponseService::content(
            $contentsData['results'],
            null,
            [],
            $contentsData['filter_options'],
            $contentsData['custom_pagination']
        )
            ->respond();
    }
}