<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\Carousel;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CarouselService
{
    private UserProductService $userProductService;

    public function __construct(UserProductService $userProductService)
    {
        $this->userProductService = $userProductService;
    }

    public function getCarouselSlides()
    {
        $brandId = Brand::query()
            ->where('name', brand())
            ->first()->id;

        $carousel = Carousel::query()
            ->where('brand_id', $brandId)
            ->where('visible', true)
            ->where(
                function ($query) {
                    return $query
                        ->whereNull('start_date')
                        ->orWhere('start_date', '<=', Carbon::now()->toDateTimeString());
                }
            )
            ->where(
                function ($query) {
                    return $query
                        ->whereNull('end_date')
                        ->orWhere('end_date', '>', Carbon::now()->toDateTimeString());
                }
            )
            ->orderBy('display_order')
            ->get();

        $carousel->each(function (Carousel $slide) {
            if ($slide->is_featured) {
                if ($slide->product_id &&
                    $this->userProductService->hasProductNotCached(user()->id, $slide->product_id)) {
                    $slide->cta_url = $slide->product_url;
                    $slide->registered = true;
                } else {
                    $slide->cta_url = $slide->endpoint;
                }
            }
        });
        return $carousel;
    }
}
