<?php

namespace App\Http\Controllers\Platform;

use App\Modules\Content\Services\CarouselService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class WorkoutsPageController extends BaseController
{
    private CarouselService $carouselService;

    public function __construct(CarouselService $carouselService){
        $this->carouselService = $carouselService;
    }

    public function showWorkoutsPage(Request $request)
    {
        $carousel = $this->carouselService->getCarouselSlides()->where('is_featured', 1);

        return view('pages.workouts', [
            'carousel' => $carousel,
        ]);
    }
}
