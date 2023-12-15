<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Services\CarouselService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $lessonType = 'workout';
        $requiredFields = $request->get('required_fields', []);

        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$lessonType] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];
        ContentRepository::$countFilterOptionItems = true;

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
        Log::debug(var_export($startedListLessons, true));
        $hasStartedLessons = !empty(json_decode($startedListLessons)->data);

        CarouselService::$workoutsPage = true;
        $carousel =
            $this->carouselService->getCarouselSlides();

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
        ContentRepository::$pullFutureContent = true;
        $lessonType = 'challenge';
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$lessonType] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];
        ContentRepository::$countFilterOptionItems = true;

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

    public function showWorkoutPage(Request $request, $domain, $brand, $slug, $id)
    {
        $contentToRenderAsLesson = $this->contentService->getById($id);
        $relatedLessons = (new ContentFilterResultsEntity(['results' => []]))->toResponseRawJson();
        $thisLessonJson =
            (new ContentFilterResultsEntity(['results' => [$contentToRenderAsLesson], 'total_results' => 1]))->toResponseRawJson(
            );

        return view('content.lesson', [
            "parentType" => $contentToRenderAsLessonParent['type'] ?? null,
            "lessonType" => 'workout',
            "lessonContent" => $contentToRenderAsLesson,
            "relatedLessons" => $relatedLessons,
            "showEmail" => false,
            "thisLessonJson" => $thisLessonJson,

        ]);
    }
}
