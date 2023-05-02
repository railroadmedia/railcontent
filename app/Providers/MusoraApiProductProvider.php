<?php

namespace App\Providers;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Maps\ProductAccessMap;
use App\Models\Brand;
use App\Models\Carousel;
use App\Modules\Content\Services\CarouselService;
use App\Modules\Content\Services\CohortService;
use App\Modules\Ecommerce\Services\UserProductService;
use App\Services\PackService;
use Carbon\Carbon;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;

class MusoraApiProductProvider implements ProductProviderInterface
{
    private CarouselService $carouselService;
    private UserProductService $userProductService;
    private ProductRepository $productRepository;
    private CohortService $cohortService;
    private PackService $packService;
    private VimeoTrailerDecorator $vimeoTrailerDecorator;

    public function __construct(
        CarouselService $carouselService,
        UserProductService $userProductService,
        ProductRepository $productRepository,
        CohortService $cohortService,
        PackService $packService,
        VimeoTrailerDecorator $vimeoTrailerDecorator
    ) {
        $this->carouselService = $carouselService;
        $this->userProductService = $userProductService;
        $this->productRepository = $productRepository;
        $this->cohortService = $cohortService;
        $this->packService = $packService;
        $this->vimeoTrailerDecorator = $vimeoTrailerDecorator;
    }

    public function getPackPrice($slug)
    : array {
        return [];
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
    }

    public function getMembershipProductIds()
    : array
    {
        return [];
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

    /**
     * @param $slug
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCohortTemplate($slug)
    : array {
        $cohort = $this->cohortService->getCohort($slug);

        foreach (config('railcontent.cohort_icons')[brand()] ?? [] as $key => $value) {
            $cohort[$key] = $value;
        }
        if($cohort['cohort_trailer']){
            $vimeoId =  (int) substr(parse_url($cohort['cohort_trailer'], PHP_URL_PATH), 7);
            $cohort['trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId);
        }
        $product = $this->productRepository->findProduct($cohort['product_id']);
        $hasProduct = user() && $this->userProductService->hasProductNotCached(user()?->id, $cohort['product_id']);
        $nPackOwners = $this->userProductService->getNumberProductOwners($cohort['product_id']);
        $registerButtonUrl =
            (!$hasProduct) ?
                url()->route('platform.cohort.register', ['brand' => brand(), 'product' => $product->getSku()]) : '';

        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $cohort['enrollment_end_date']);
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $cohort['enrollment_start_date']);
        $now = Carbon::now();
        $enrollmentClosed = $endDate->lessThan($now) || $startDate->greaterThan($now);

        return [
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
            'registerButtonUrl' => $registerButtonUrl,
            'cohort' => $cohort,
            'faq' => $cohort->dropdowns->toArray(),
            'enrollmentClosed' => $enrollmentClosed,
        ];
    }

    public function getPacks()
    {
        return $this->packService->getPacks();
    }

    public function getActiveCohort()
    {
        return $this->cohortService->getActiveCohort();
    }

    public function userOwnProduct($productId)
    {
        return $this->userProductService->hasProductNotCached(user()?->id, $productId ?? 0);
    }
}
