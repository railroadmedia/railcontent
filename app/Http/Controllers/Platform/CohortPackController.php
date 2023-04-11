<?php

namespace App\Http\Controllers\Platform;

use App\Models\Brand;

use App\Models\Cohort;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;


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

        $productId = $cohort['pack_id'];
       // $productId = 516;

        $hasProduct = user() && $this->userProductService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $this->userProductService->getNumberProductOwners($productId);
        $registerButtonUrl = (!$hasProduct)?'/cohort-packs/register/30-day-drummer-2':'#final';
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $cohort['end_date']);
        $now = Carbon::now();
        $enrollmentClosed = $endDate->lessThanOrEqualTo($now);

        return view('content.cohort-template', [
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
            'registerButtonUrl' => $registerButtonUrl,
            'brand' => brand(),
            'cohort' => $cohort,
            'enrollmentClosed' => $enrollmentClosed
        ]);
    }

}
