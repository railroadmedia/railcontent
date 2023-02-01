<?php

namespace App\Providers;

use App\Maps\ProductAccessMap;
use App\Models\Brand;
use App\Models\Carousel;
use Carbon\Carbon;
use App\Services\User\UserAccessService;
use Carbon\Carbon;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPermissionsService;

class MusoraApiProductProvider implements ProductProviderInterface
{

    public function getPackPrice($slug)
    : array {
        return [];
        // TODO: Implement getPackPrice() method.
    }

    public function getAppleProductId($slug)
    : string {
        $productSkuToPackSlugArray = config('event-data-synchronizer.pack_ecommerce_product_sku_to_content_slug') ?? [];

        $productSKU = array_flip($productSkuToPackSlugArray)[$slug] ?? null;

        return array_flip(config('ecommerce.apple_store_products_map', []))[$productSKU] ?? '';
    }

    public function getGoogleProductId($slug)
    : string {
        $productSkuToPackSlugArray = config('event-data-synchronizer.pack_ecommerce_product_sku_to_content_slug');

        $productSKU = array_flip($productSkuToPackSlugArray)[$slug] ?? null;

        return array_flip(config('ecommerce.google_store_products_map'))[$productSKU] ?? '';
    }

    public function currentUserOwnsPack($id)
    : bool {
        return true;
        // TODO: Implement currentUserOwnsPack() method.
    }

    public function getMembershipProductIds()
    : array
    {
        return [];
        // TODO: Implement getMembershipProductIds() method.
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function carousel()
    {
        $brandId =
            Brand::query()
                ->where('name', ucfirst(config('railcontent.brand')))
                ->first()->id;

        return Carousel::query()
            ->where('brand_id', $brandId)
            ->where('visible', true)
            ->where(
                function($query) {
                    return $query
                        ->whereNull('start_date')
                        ->orWhere('start_date', '<=', Carbon::now()->toDateTimeString());
                })
            ->where(
                function($query) {
                    return $query
                        ->whereNull('end_date')
                        ->orWhere('end_date', '>', Carbon::now()->toDateTimeString());
                })
            ->orderBy('display_order')
            ->get()
            ->toArray();
    }
}
