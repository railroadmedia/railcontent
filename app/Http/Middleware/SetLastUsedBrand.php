<?php

namespace App\Http\Middleware;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Closure;
use Illuminate\Http\Request;

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
        if (!empty(user()) && in_array($request->segment(0), config('brands'))) {
            $this->brandService->setLastUsedBrand(user(), Brand::from($request->segment(0)));
        }

        return $next($request);
    }
}
