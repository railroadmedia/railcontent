<?php

namespace App\Modules\Content\Services;

use App\Models\Brand;
use App\Models\Carousel;
use App\Models\TrialSection;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Content\Services\ContentPermissionsService;
use Railroad\Railcontent\Services\ContentService;

class LearningPathsService
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

    public function getLearningPaths()
    {
        $brandId =
            Brand::query()
                ->where('name', brand())
                ->first()->id;

        $learningPaths =
            TrialSection::query()
                ->where('brand_id', $brandId)
                ->orderBy('display_order')
                ->get();

        $learningPaths->each(function (TrialSection $section) {
            $content = $this->contentService->getById($section->product_id);
            $section->bgImg = $section->desktop_img;
            $section->topPillText = $section->tagline ?? '';
            $section->ctaUrl = $content['url'];
            $section->ctaText = ($content['completed'])?'Completed':((!$content['started']) ? 'Start now':'Continue');
        });

        return $learningPaths;
    }
}
