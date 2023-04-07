<?php

namespace App\Http\Controllers\Platform;

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

    public function template(Request $request, $domain, $brand, $slug)
    {
        //        $brandId = Brand::query()
        //            ->where('name', brand())
        //            ->first()->id;

        return view('content.cohort', [
            'hasProduct' => false,
            'theme' => 'drumeo',
        ]);
    }

}
