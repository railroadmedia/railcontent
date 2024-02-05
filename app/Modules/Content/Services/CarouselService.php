<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\Carousel;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Content\Services\ContentPermissionsService;
use Railroad\Railcontent\Services\ContentService;

class CarouselService
{
    private UserProductService $userProductService;
    private UserAccessPermissionsService $userAccessPermissionsService;
    private ProductService $productService;
    private ContentPermissionsService $contentPermissionsService;
    private ContentService $contentService;

    public static $workoutsPage = false;

    public function __construct(
        UserProductService $userProductService,
        UserAccessPermissionsService $userAccessPermissionsService,
        ProductService $productService,
        ContentPermissionsService $contentPermissionsService,
        ContentService $contentService
    ) {
        $this->userProductService = $userProductService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
        $this->productService = $productService;
        $this->contentPermissionsService = $contentPermissionsService;
        $this->contentService = $contentService;
    }

    public function getCarouselSlides()
    {
        $mobileEndpointVersion = (config('musora-api.api.version'));
        $mobileEndpointVersion = str_replace('v', '', $mobileEndpointVersion);

        $brandId =
            Brand::query()
                ->where('name', brand())
                ->first()->id;

        $query =
            Carousel::query()
                ->where('brand_id', $brandId)
                ->where(function ($query) {
                    return $query->whereNull('start_date')
                        ->orWhere(
                            'start_date',
                            '<=',
                            Carbon::now('PST')
                                ->toDateTimeString()
                        );
                })
                ->where(function ($query) {
                    return $query->whereNull('end_date')
                        ->orWhere(
                            'end_date',
                            '>',
                            Carbon::now('PST')
                                ->toDateTimeString()
                        );
                });

        if (!is_null(user()) && !user()->isAdmin()) {
            $query = $query->where(function ($query) {
                return $query->whereNull('draft')
                    ->orWhere('draft', '=', 0);
            });
        }

        if ($mobileEndpointVersion) {
            $query =
                $query->where('visible_on_mobile', '=', 1)
                    ->where(
                        function ($query) use ($mobileEndpointVersion) {
                            return $query->whereNull('mobile_version_below')
                                ->orWhere('mobile_version_below', '>=', $mobileEndpointVersion);
                        }
                    )
                    ->where(function ($query) use ($mobileEndpointVersion) {
                        return $query->whereNull('mobile_version_above')
                            ->orWhere('mobile_version_above', '<=', $mobileEndpointVersion);
                    });
        } else {
            $query = $query->where('visible_on_desktop', '=', 1);
        }
        $carousel =
            $query->orderBy('display_order')
                ->get();
        if(self::$workoutsPage){
            $carousel = $carousel->filter(function($slide){
                return $slide->is_featured && ($slide->show_on_workouts == 1);
            })->values();
        }else{
            $carousel = $carousel->filter(function($slide){
                return (!$slide->is_featured || ($slide->is_featured && ($slide->show_on_homepage == 1)));
            })->values();
        }
        $carousel->each(function (Carousel $slide) {

            if ($slide->is_featured) {
                $challenge = null;
                if ($slide->challenge_id) {
                    $challenge = $this->contentService->getById($slide->challenge_id);
                }
                if($challenge && $challenge['challenge_state'] === 'upcoming'){
                        $slide->primary_cta_text = 'Notify Me';

                        $slide->is_enrolled = false;
                }
                elseif ($slide->product_id && $this->isEnrolled(user()->id, $slide->product_id)) {
                    $slide->primary_cta_text = $slide->primary_cta_text_alt;
                    $slide->primary_cta_url = $slide->primary_cta_url_alt;
                    // $slide->secondary_cta_text = null;
                    $slide->is_enrolled = true;
                    //      $slide->cta_text = "Go to course"; //todo: added for 30-day-drummer remove once CMS handles this case
                } else {
                    $slide->primary_cta_url = $slide->primary_cta_url;
                    $slide->is_enrolled = false;
                }
            }
        });

        return $carousel;
    }

    private function isEnrolled(int $userId, int $productId)
    {
        $product = $this->productService->getById($productId);

        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $permissionID =
            $product->getContentPermissions($contentPermissionsLookup)
                ->first()->id ?? null;

        if (!$permissionID) {
            return true;
        }
        $hasProduct = $this->userAccessPermissionsService->hasPermission($userId, $permissionID);

        return $hasProduct;
    }
}
