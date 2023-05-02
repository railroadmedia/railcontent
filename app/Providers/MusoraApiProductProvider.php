<?php

namespace App\Providers;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Maps\ProductAccessMap;
use App\Models\Brand;
use App\Models\Carousel;
use App\Modules\Content\Services\CarouselService;
use Carbon\Carbon;
use App\Services\User\UserAccessService;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPermissionsService;

class MusoraApiProductProvider implements ProductProviderInterface
{
    private CarouselService $carouselService;
    private VimeoTrailerDecorator $vimeoTrailerDecorator;

    public function __construct(CarouselService $carouselService, VimeoTrailerDecorator $vimeoTrailerDecorator)
    {
        $this->carouselService = $carouselService;
        $this->vimeoTrailerDecorator = $vimeoTrailerDecorator;
    }

    public function getPackPrice($slug): array
    {
        return [];
        // TODO: Implement getPackPrice() method.
    }

    public function getAppleProductId($slug): string
    {
        $productSkuToPackSlugArray = config('event-data-synchronizer.pack_ecommerce_product_sku_to_content_slug') ?? [];

        $productSKU = array_flip($productSkuToPackSlugArray)[$slug] ?? null;

        return array_flip(config('ecommerce.apple_store_products_map', []))[$productSKU] ?? '';
    }

    public function getGoogleProductId($slug): string
    {
        $productSkuToPackSlugArray = config('event-data-synchronizer.pack_ecommerce_product_sku_to_content_slug');

        $productSKU = array_flip($productSkuToPackSlugArray)[$slug] ?? null;

        return array_flip(config('ecommerce.google_store_products_map'))[$productSKU] ?? '';
    }

    public function currentUserOwnsPack($id): bool
    {
        return true;
        // TODO: Implement currentUserOwnsPack() method.
    }

    public function getMembershipProductIds(): array
    {
        return [];
        // TODO: Implement getMembershipProductIds() method.
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function carousel()
    {
        $slides =  $this->carouselService->getCarouselSlides();

        foreach ($slides as $slide){
            if($slide['video_src'] && ($slide['is_enrolled'] != true)){
                $vimeoId =  (int) substr(parse_url($slide['video_src'], PHP_URL_PATH), 7);
                $slide['trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId);
            }
        }

        return $slides;
    }
}
