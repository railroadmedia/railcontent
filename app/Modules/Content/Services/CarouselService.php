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
                        ->orWhere('start_date', '<=', Carbon::now('PST')->toDateTimeString());
                }
            )
            ->where(
                function ($query) {
                    return $query
                        ->whereNull('end_date')
                        ->orWhere('end_date', '>', Carbon::now('PST')->toDateTimeString());
                }
            )
            ->orderBy('display_order')
            ->get();

        $carousel->each(function (Carousel $slide) {
            if ($slide->is_featured) {
                if ($slide->product_id &&
                    $this->userProductService->hasProductNotCached(user()->id, $slide->product_id)) {
                    $slide->primary_cta_text = $slide->primary_cta_text_alt;
                    $slide->primary_cta_url = $slide->primary_cta_url_alt;
                    $slide->secondary_cta_text = null;
              //      $slide->cta_text = "Go to course"; //todo: added for 30-day-drummer remove once CMS handles this case
                } else {
                    $slide->primary_cta_url = $slide->primary_cta_url;
                }
            }
        });
        return $carousel;
    }
}
