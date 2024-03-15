<?php

namespace Railroad\Railcontent\Entities;

use Illuminate\Http\JsonResponse;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentFilterResultsEntity extends Entity
{
    /**
     * @return string
     */
    public function toResponseRawJson()
    {
        return reply()
            ->json(
                $this->results(),
                [
                    'transformer' => DataTransformer::class,
                    'totalResults' => $this->totalResults(),
                    'totalLessons' => $this->totalLessons(),
                    'filterOptions' => $this->filterOptions(),
                ]
            )
            ->getContent();
    }

    /**
     * @return JsonResponse
     */
    public function toJsonResponse()
    {
        return reply()->json(
            $this->results(),
            [
                'transformer' => DataTransformer::class,
                'totalResults' => $this->totalResults(),
                'totalLessons' => $this->totalLessons(),
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

    /**
     * @return int
     */
    public function totalLessons()
    {
        return $this['total_lessons'] ?? 0;
    }
}