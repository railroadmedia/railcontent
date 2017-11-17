<?php

namespace Railroad\Railcontent\Responses;

use Illuminate\Contracts\Support\Responsable;

class JsonPaginatedResponse implements Responsable
{
    protected $results;

    protected $totalResults;

    protected $filterOptions;

    protected $code;

    /**
     * JsonPaginatedResponse constructor.
     * @param $results
     */
    public function __construct($results, $totalResults, $filterOptions, $code)
    {
        $this->results = $results;
        $this->totalResults = $totalResults;
        $this->filterOptions = $filterOptions;
        $this->code = $code;
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function toResponse($request)
    {
        return response()->json(
            $this->transformResult($request),
            $this->code
        );
    }

    public function transformResult($request)
    {
        return [
            'status' => 'ok',
            'code' => $this->code,
            'page' => $request->get('page', 1),
            'limit' => $request->get('limit', 10),
            'total_results' => $this->totalResults,
            'results' => array_values($this->results),
            'filter_options' => $this->filterOptions,
        ];
    }
}