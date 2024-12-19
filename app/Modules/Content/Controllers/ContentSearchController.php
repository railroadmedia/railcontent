<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Requests\ContentSearchRequest;
use App\Modules\Content\Resources\Algolia\SearchParameters;
use App\Modules\Content\Services\AlgoliaSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ContentSearchController extends Controller
{
    public function search(ContentSearchRequest $request): JsonResponse
    {
        // TODO do we need to support date_time_cutoff? If so, update ContentSearchRequest and SearchParameters::fromRequest
        $search = new AlgoliaSearchService();

        if (!empty($request->get('page')) && is_numeric($request->get('page')) && (int)$request->get('page') >= 0) {
            $request['page'] = ((integer)$request['page']) - 1;
        }

        $searchParams = SearchParameters::fromRequest($search, $request);

        $searchResponse = $search->search($searchParams);

        return response()->json($searchResponse->formatToObject());
    }
}
