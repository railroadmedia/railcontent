<?php

namespace App\Modules\Content\Controllers\V1;

use App\Modules\Content\Services\V1\CarouselServiceV1;
use Illuminate\Http\JsonResponse;

class CarouselControllerV1
{
    public function __construct(
        private readonly CarouselServiceV1 $carouselService
    ) {
    }

    public function getHomepageCarousel(): JsonResponse
    {
        return response()->json($this->carouselService->getCarouselCards(brand()));
    }
}
