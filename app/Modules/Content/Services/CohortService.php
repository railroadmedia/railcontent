<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\Cohort;
use Carbon\Carbon;

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

    public function getActiveCohort()
    {
        $brandId =
            Brand::query()
                ->where('name', brand())
                ->first()->id;

        return Cohort::query()
            ->where('brand_id', $brandId)
            ->where('cohort_start_date','<=', Carbon::now()->toDateTimeString())
            ->where('cohort_end_date','>=', Carbon::now()->subWeeks(2)->toDateTimeString())
            ->first();
    }
}
