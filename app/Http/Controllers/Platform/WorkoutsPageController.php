<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use App\Http\Controllers\BaseController;
use App\Modules\Content\Services\CarouselService;
use Google\Service\Gmail\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Helpers\FiltersHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;

class WorkoutsPageController extends BaseController
{
    private ContentService $contentService;
    private CarouselService $carouselService;
    private UserContentProgressService $userContentProgressService;

    /**
     * @param ContentService $contentService
     * @param CarouselService $carouselService
     */
    public function __construct(
        ContentService $contentService,
        CarouselService $carouselService,
        UserContentProgressService $userContentProgressService
    ) {
        $this->contentService = $contentService;
        $this->carouselService = $carouselService;
        $this->userContentProgressService = $userContentProgressService;
    }

    public function showWorkoutsPage(Request $request, $domain, $brand)
    {
        $lessonType = 'workout';

        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$lessonType] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];
        ContentRepository::$countFilterOptionItems = true;

        FiltersHelper::prepareFiltersFields();

        $workouts = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on'),
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            FiltersHelper::$requiredFields,
            FiltersHelper::$includedFields,
            $request->get('required_user_states', []),
            $request->get('included_user_states', []),
            true,
            false,
            true,
            false,
            false,
            FiltersHelper::$groupBy
        );

        $startedProgressRows = $this->userContentProgressService->getForUserStateContentTypes(
            auth()->id(),
            [$lessonType],
            'started',
            'updated_on',
            'desc',
            4
        );
        $lessons = $this->contentService->getByIds(array_column($startedProgressRows, 'content_id'));
        $lessons->transform(function ($lesson) {
            $lesson = collect($lesson);

            return $lesson->only(['id', 'slug', 'type', 'fields', 'data', 'url', 'published_on', 'instructors', 'need_access'])
                ->toArray();
        });
        $startedListLessons = (new ContentFilterResultsEntity(['results' => $lessons->values()]))->toResponseRawJson();
        $hasStartedLessons = count($startedProgressRows) > 0;

        CarouselService::$workoutsPage = true;
        $carousel = $this->carouselService->getCarouselSlides();
        return view('pages.workouts', [
                                        "listLessons" => $workouts->toResponseRawJson(),
                                        "startedLessons" => $startedListLessons,
                                        "hasStartedLessons" => $hasStartedLessons,
                                        "lessonType" => $lessonType,
                                        "catalogueMeta" => $catalogueMeta,
                                        'carousel' => $carousel,
                                    ]);
    }

    public function showChallengesPage(Request $request, $domain, $brand): View
    {
        ContentRepository::$pullFutureContent = true;
        $lessonType = 'challenge';
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$lessonType] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];
        ContentRepository::$countFilterOptionItems = true;

        FiltersHelper::prepareFiltersFields();

        $challenges = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on'),
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            FiltersHelper::$requiredFields,
            FiltersHelper::$includedFields,
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

    public function showWorkoutPage(Request $request, $domain, $brand, $slug, $id): View
    {
        $contentToRenderAsLesson = $this->contentService->getById($id);
        $relatedLessons = (new ContentFilterResultsEntity(['results' => []]))->toResponseRawJson();
        $thisLessonJson =
            (new ContentFilterResultsEntity(
                ['results' => [$contentToRenderAsLesson], 'total_results' => 1]
            ))->toResponseRawJson();

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
