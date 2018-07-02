<?php

namespace Railroad\Railcontent\Responses;

use Illuminate\Contracts\Support\Responsable;

class JsonPaginatedResponse implements Responsable
{
    public $results;
    public $totalResults;
    public $filterOptions;
    public $code;

    /**
     * JsonPaginatedResponse constructor.
     *
     * @param $results
     * @param $totalResults
     * @param $filterOptions
     * @param $code
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
        if (!isset($this->results['id'])) {
            foreach ($this->results as $resultIndex => $result) {
                if (method_exists($result, 'dot')) {
                    $this->results[$resultIndex]['fetch'] = $result->dot();
                }
            }
        } else {
            if (method_exists($this->results, 'dot')) {
                $this->results['fetch'] = $this->results->dot();
            }
        }

        return [
            'status' => 'ok',
            'code' => $this->code,
            'page' => $request->get('page', 1),
            'limit' => $request->get('limit', 10),
            'total_results' => $this->totalResults,

            // json encoding ruins the ordering of arrays if the keys are random numbers
            'results' => array_values((array)$this->results),
            'filter_options' => $this->filterOptions,
        ];
    }
}