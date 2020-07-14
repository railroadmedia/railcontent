<?php

namespace Railroad\Railcontent\Entities;

use Illuminate\Http\JsonResponse;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Transformers\DecoratedContentTransformer;

class ContentFilterResultsEntity extends \ArrayObject
{
    /**
     * @return string
     */
    public function toResponseRawJson()
    {
        return ResponseService::content(
            $this->results(),
            $this->qb(),
            [],
            $this->filterOptions()
        )
            ->addMeta(
                [
                    'totalResults' => $this->totalResults()
                ]
            )
            ->respond()
            ->getContent();
    }

    /**
     * @return JsonResponse
     */
    public function toJsonResponse()
    {
        return ResponseService::content(
            $this->results(),
            null,
            [],
            $this->filterOptions()
        )
            ->addMeta(['totalResults' => $this->totalResults()])
            ->respond();

        return reply()->json(
            $this->results(),
            [
                'transformer' => DecoratedContentTransformer::class,
                'totalResults' => $this->totalResults(),
                'filterOptions' => $this->filterOptions(),
            ]
        );
    }

    /**
     * @return array|Collection
     */
    public function results()
    {
        return $this['results'] ?? [];
    }

    /**
     * @return int
     */
    public function totalResults()
    {
        return $this['total_results'] ?? 0;
    }

    /**
     * @return array
     */
    public function filterOptions()
    {
        return $this['filter_options'] ?? [];
    }

    public function qb()
    {
        return $this['qb'] ?? null;
    }

    public function customPagination()
    {
        return $this['custom_pagination'] ?? null;
    }

    public function activeFilters()
    {
        return $this['active_filters']??[];
    }
}