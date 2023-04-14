<?php

namespace App\Providers;

use App\Modules\Content\Services\CarouselService;
use App\Modules\Content\Services\CohortService;
use App\Nova\Cohort;
use Carbon\Carbon;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;

class MusoraApiProductProvider implements ProductProviderInterface
{
    private CarouselService $carouselService;
    private \App\Modules\Ecommerce\Services\UserProductService $userProductService;
    private ProductRepository $productRepository;
    private CohortService $cohortService;

    public function __construct(
        CarouselService $carouselService,
        \App\Modules\Ecommerce\Services\UserProductService $userProductService,
        ProductRepository $productRepository,
        CohortService $cohortService
    ) {
        $this->carouselService = $carouselService;
        $this->userProductService = $userProductService;
        $this->productRepository = $productRepository;
        $this->cohortService = $cohortService;
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
        return $this->carouselService->getCarouselSlides();
    }

    /**
     * @param $slug
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCohortTemplate($slug) :array
    {
        $cohort = $this->cohortService->getCohort($slug);

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
}
