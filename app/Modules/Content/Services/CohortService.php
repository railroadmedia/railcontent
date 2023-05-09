<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\Cohort;
use Carbon\Carbon;

class CohortService
{
    private ?Cohort $activeCohort = null;

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

        $cohort = Cohort::query()
            ->where('slug', $slug)
            ->where('brand_id', $brandId)
            ->select(['*'])
            ->selectRaw('enrollment_start_date <= "'.Carbon::now('PST')->toDateTimeString().'"  as start_compare')
            ->selectRaw('enrollment_start_date > "'.Carbon::now('PST')->toDateTimeString() .'" or enrollment_end_date < "'.Carbon::now('PST')->subWeeks(2)->toDateTimeString().'" as enrollmentClosed')
            ->first();

        return $cohort;
    }

    public function getActiveCohort(): ?Cohort
    {
        if (!$this->activeCohort) {
            $brandId =
                Brand::query()
                    ->where('name', brand())
                    ->first()->id;

            $this->activeCohort = Cohort::query()
                ->where('brand_id', $brandId)
                ->where('cohort_start_date', '<=', Carbon::now('PST')->toDateTimeString())
                ->where('cohort_end_date', '>=', Carbon::now('PST')->subWeeks(2)->toDateTimeString())
                ->first();
        }

        return $this->activeCohort;
    }
}
