<?php

namespace App\Providers;

use App\Decorators\Content\VimeoTrailerDecorator;
use App\Modules\Content\Services\CarouselService;
use App\Modules\Content\Services\CohortService;
use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Content\Services\LearningPathsService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\Ecommerce\Services\UserProductService;
use App\Services\PackService;
use App\Services\PlaylistService;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class MusoraApiProductProvider implements ProductProviderInterface
{
    private CarouselService $carouselService;
    private UserProductService $userProductService;
    private CohortService $cohortService;
    private PackService $packService;
    private VimeoTrailerDecorator $vimeoTrailerDecorator;
    private ContentService $contentService;
    private PlaylistService $playlistService;
    private ProductService $productService;
    private LearningPathsService $learningPathsService;
    private ContentPermissionsService $contentPermissionsService;
    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(
        CarouselService $carouselService,
        UserProductService $userProductService,
        CohortService $cohortService,
        PackService $packService,
        VimeoTrailerDecorator $vimeoTrailerDecorator,
        ContentService $contentService,
        PlaylistService $playlistService,
        ProductService $productService,
        LearningPathsService $learningPathsService,
        ContentPermissionsService $contentPermissionsService,
        UserAccessPermissionsService $userAccessPermissionsService,
    ) {
        $this->carouselService = $carouselService;
        $this->userProductService = $userProductService;
        $this->cohortService = $cohortService;
        $this->packService = $packService;
        $this->vimeoTrailerDecorator = $vimeoTrailerDecorator;
        $this->contentService = $contentService;
        $this->playlistService = $playlistService;
        $this->productService = $productService;
        $this->learningPathsService = $learningPathsService;
        $this->contentPermissionsService = $contentPermissionsService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    public function getPackPrice($slug): array
    {
        return [];
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
    }

    public function getMembershipProductIds(): array
    {
        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function carousel($isWorkoutPage = false)
    {
        CarouselService::$workoutsPage = $isWorkoutPage;
        $slides = $this->carouselService->getCarouselSlides();

        foreach ($slides as $slide) {
            if ($slide['video_src'] && ($slide['is_enrolled'] != true)) {
                $vimeoId = (int)substr(parse_url($slide['video_src'], PHP_URL_PATH), 7);
                $slide['trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId);
            }
            if ($slide['primary_video_src']) {
                $vimeoId = (int)substr(parse_url($slide['primary_video_src'], PHP_URL_PATH), 7);
                $slide['trailer_button_1'] = $this->vimeoTrailerDecorator->decorate($vimeoId);
            }
        }

        return $slides;
    }

    /**
     * @param $slug
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCohortTemplate($slug): array
    {
        $cohort = $this->cohortService->getCohort($slug);
        $cohort['timeline_image_url'] = config('railcontent.cohort_timeline_image_urls')[brand()] ?? config(
            'railcontent.cohort_timeline_image_urls'
        )['pianote'];
        foreach (config('railcontent.cohort_icons')[brand()] ?? [] as $key => $value) {
            $cohort[$key] = $value;
        }
        if ($cohort['cohort_trailer']) {
            $vimeoId = (int)substr(parse_url($cohort['cohort_trailer'], PHP_URL_PATH), 7);
            $cohort['trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId);
        }
        if ($cohort['description_trailer_1']) {
            $vimeoId1 = (int)substr(parse_url($cohort['description_trailer_1'], PHP_URL_PATH), 7);
            $cohort['first_day_trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId1);
        }
        if ($cohort['description_trailer_2']) {
            $vimeoId2 = (int)substr(parse_url($cohort['description_trailer_2'], PHP_URL_PATH), 7);
            $cohort['last_day_trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId2);
        }
        if ($cohort['demo_trailer']) {
            $vimeoId3 = (int)substr(parse_url($cohort['demo_trailer'], PHP_URL_PATH), 7);
            $cohort['demo_trailer'] = $this->vimeoTrailerDecorator->decorate($vimeoId3);
        }
        if ($cohort['content_id']) {
            $initialBypassPermissions = ContentRepository::$bypassPermissions;
            $initialPullFutureContent = ContentRepository::$pullFutureContent;
            $initialContentStatuses = ContentRepository::$availableContentStatues;
            ContentRepository::$bypassPermissions = true;
            ContentRepository::$pullFutureContent = true;
            ContentRepository::$availableContentStatues = false;
            $content = $this->contentService->getById($cohort['content_id']);
            ContentRepository::$bypassPermissions = $initialBypassPermissions;
            ContentRepository::$pullFutureContent = $initialPullFutureContent;
            ContentRepository::$availableContentStatues = $initialContentStatuses;

            if ($content) {
                $cohort['content'] = [
                    'page_type' => 'PackOverview',
                    'page_params' => [
                        'id' => $cohort['content_id'],
                        'type' => (($content['bundle_count'] ?? 0) > 1) ? 'Bundles' : 'Lesson',
                    ],
                ];
            }
        }

        $product = $this->productService->getById($cohort['product_id']);
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $permissionID = $product->getContentPermissions($contentPermissionsLookup)->first()->id ?? null;
        $hasProduct = user() && $this->userAccessPermissionsService->hasPermission(user()?->id, $permissionID);
        $nPackOwners = $this->userAccessPermissionsService->getNumberPermissionOwners($permissionID);

        $registerButtonUrl =
            (!$hasProduct) ?
                url()->route('platform.cohort.register', ['brand' => brand(), 'product' => $product->sku]) : '';

        $enrollmentClosed = $cohort['enrollmentClosed'];
        $lists = $cohort->lists;
        foreach ($lists as $list) {
            $list->description = preg_replace('/{' . 'enrolled' . '}/', $nPackOwners, $list->description);
        }

        return [
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
            'registerButtonUrl' => $registerButtonUrl,
            'cohort' => $cohort,
            'faq' => $cohort->dropdowns->toArray(),
            'lists' => $lists->toArray(),
            'enrollmentClosed' => $enrollmentClosed,
        ];
    }

    public function getPacks($requiredFieds = [], $sort = '-progress')
    {
        return $this->packService->getPacks($requiredFieds, $sort);
    }

    public function getActiveCohort()
    {
        return $this->cohortService->getActiveCohort();
    }

    public function userOwnProduct($productId)
    {
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        return $hasProduct;
    }

    public function getPlaybackItemId($playlistId)
    {
        return $this->playlistService->getPlaylistNextItem($playlistId);
    }

    public function getVimeoEndpoints($vimeoId)
    {
        return $this->vimeoTrailerDecorator->decorate($vimeoId);
    }

    public function getLearningPaths()
    {
        return $this->learningPathsService->getLearningPaths();
    }

}
