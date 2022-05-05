<?php

namespace App\Modules\Brand\Middleware;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Closure;
use Illuminate\Http\Request;

use function user;

class SetLastUsedBrand
{
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * NOTE: this must be set to run AFTER all auth middleware.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // web requests
        if (!empty(user()) && in_array($request->segment(1), config('brands'))) {
            $this->brandService->setLastUsedBrand(user(), Brand::from($request->segment(1)));
        }

        // token API requests will have the brand in the params
        if (!empty(user()) &&
            !empty($request->get('brand')) &&
            in_array($request->get('brand'), config('brands'))) {
            $this->brandService->setLastUsedBrand(user(), Brand::from($request->get('brand')));
        }

        return $next($request);
    }
}
