<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Services\CarouselService;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class WorkoutsPageController extends BaseController
{
    private ContentService $contentService;
    private CarouselService $carouselService;

    /**
     * @param ContentService $contentService
     * @param CarouselService $carouselService
     */
    public function __construct(ContentService $contentService, CarouselService $carouselService)
    {
        $this->contentService = $contentService;
        $this->carouselService = $carouselService;
    }

    public function showWorkoutsPage(Request $request, $domain, $brand)
    {
        $lessonType = 'challenge-part';
        $requiredFields = $request->get('required_fields', []);
        if ($request->has('duration')) {
            switch ($request->get('duration')) {
                case 5:
                    $requiredFields[] = 'length_in_seconds,300,integer,<=,video';
                    break;
                case 10:
                    $requiredFields[] = 'length_in_seconds,300,integer,>,video';
                    $requiredFields[] = 'length_in_seconds,6000,integer,<=,video';
                    break;
                case 15:
                    $requiredFields[] = 'length_in_seconds,900,integer,>=,video';
                    break;
                default:
                    break;
            }
        }

        $workouts = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('sort', '-popularity'),
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $requiredFields,
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

        $startedListLessons =
            count($startedLessons) > 0 ?
                (new ContentFilterResultsEntity(['results' => $startedLessons]))->toResponseRawJson() : false;

        $hasStartedLessons = !empty(json_decode($startedListLessons)->data);

        $catalogName = $lessonType;
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$catalogName] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];

        $carousel =
            $this->carouselService->getCarouselSlides()
                ->where('is_featured', 1);

        return view(
            'pages.workouts',
            [
                "listLessons" => $workouts->toResponseRawJson(),
                "startedLessons" => $startedListLessons,
                "hasStartedLessons" => $hasStartedLessons,
                "lessonType" => $lessonType,
                "catalogueMeta" => $catalogueMeta,
                'carousel' => $carousel,
            ]
        );
    }

    public function showChallengesPage(Request $request, $domain, $brand)
    {
        $lessonType = 'challenge';
        $challenges = $this->contentService->getFiltered(
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

        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$lessonType] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];

        $searchTerm = null;

        return view('content.child-catalog', [
            "listLessons" => $challenges->toResponseRawJson(),
            "lessonType" => $lessonType,
            "catalogueMeta" => $catalogueMeta,
            "searchTerm" => $searchTerm,
            "statuses" => ContentRepository::$availableContentStatues,
            "hasStartedLessons" => 0,
        ]);
    }
}
