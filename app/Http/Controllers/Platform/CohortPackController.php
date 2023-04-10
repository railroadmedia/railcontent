<?php

namespace App\Http\Controllers\Platform;

use App\Models\Brand;

use App\Models\Cohort;
use Illuminate\Http\Request;
use Railroad\Ecommerce\Services\UserProductService;

class CohortPackController
{

    private UserProductService $userProductService;

    public function __construct(
        UserProductService $userProductService
    ) {
        $this->userProductService = $userProductService;
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function template(Request $request, $domain, $brand, $slug)
    {
        $brandId =
            Brand::query()
                ->where('name', brand())
                ->first()->id;

        $cohort =
            Cohort::query()
                ->where('slug', $slug)
                ->where('brand_id', $brandId)
                ->first();

        return view('content.cohort', [
            'hasProduct' => false,
            'theme' => brand(),
            'brand' => brand(),
            'cohort' => $cohort,
        ]);
    }

}
