<?php

namespace App\Http\Controllers\Platform;

use App\Modules\Content\Services\CarouselService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class WorkoutsPageController extends BaseController
{
    private ContentService $contentService;

    /**
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService, CarouselService $carouselService)
    {
        $this->contentService = $contentService;
        $this->carouselService = $carouselService;
    }

    public function showWorkoutsPage(Request $request,  $domain, $brand)
    {
        $lessonType = 'challenge-part';
        $workouts = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('sort', '-popularity'),
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', []),
            true
        );

        $startedLessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
            [$lessonType],
            auth()->id(),
            'started',
            6,
            0
        );

        $featuredChallenges = $this->contentService->getFiltered(
            1,
            20,
            'slug',
            ['challenge'],
            [],
            [],
            ['is_featured,1']
        );

        $startedListLessons =
            count($startedLessons) > 0 ?
                (new ContentFilterResultsEntity(['results' => $startedLessons]))->toResponseRawJson() : false;

        $hasStartedLessons = !empty(json_decode($startedListLessons)->data);

        $catalogName = $lessonType;
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$catalogName] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];

         $carousel = $this->carouselService->getCarouselSlides()->where('is_featured', 1);

        return view('pages.workouts',
                    [
                        "listLessons" => $workouts->toResponseRawJson(),
                        "startedLessons" => $startedListLessons,
                        "hasStartedLessons" => $hasStartedLessons,
                        "featuredChallenges" => $featuredChallenges,
                        "hasFeaturedChallenges" => $featuredChallenges->totalResults() > 0,
                        "lessonType" => $lessonType,
                        "catalogueMeta" => $catalogueMeta,
                        'carousel' => $carousel,
                    ]);
    }
}
