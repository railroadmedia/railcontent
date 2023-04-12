<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\Cohort;

class CohortService
{
    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getCohort($slug)
    {
        $brandId =
            Brand::query()
                ->where('name', brand())
                ->first()->id;

        return Cohort::query()
            ->where('slug', $slug)
            ->where('brand_id', $brandId)
            ->first();
    }
}
