<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Services\CarouselService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
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
    public function __construct(ContentService $contentService,
        CarouselService $carouselService,
        UserContentProgressService $userContentProgressService)
    {
        $this->contentService = $contentService;
        $this->carouselService = $carouselService;
        $this->userContentProgressService = $userContentProgressService;
    }

    public function showWorkoutsPage(Request $request, $domain, $brand)
    {
        $lessonType = 'workout';
        $requiredFields = $request->get('required_fields', []);

        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$lessonType] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];
        ContentRepository::$countFilterOptionItems = true;

        if($request->get('tabs', false)){
            $tabs = $request->get('tabs');

            if(!is_array($request->get('tabs'))){
                $tabs = [$request->get('tabs')];
            }

            foreach($tabs as $tab) {
                $extra = explode(',', $tab);
                if ($extra['0'] == 'group_by') {
                    $group_by = $extra['1'];
                }
                if ($extra['0'] == 'duration') {
                    $requiredFields[] = 'length_in_seconds,'.$extra[1].',integer,'.$extra[2].',video';
                }
                if ($extra['0'] == 'length_in_seconds') {
                    $requiredFields[] = $tab;
                }
                if ($extra['0'] == 'topic') {
                    $requiredFields[] = $tab;
                }
            }
        }

        $workouts = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on'),
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $requiredFields,
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', []),
            true,
            false,
            true,
            false,
            false,
            $group_by ?? false
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
            $lessons->transform(function ($lesson){
                $lesson = collect($lesson);
                return $lesson->only(['id','slug','type','fields','data','url','published_on','instructors'])->toArray();

            });
            $startedListLessons =
                (new ContentFilterResultsEntity(['results' => $lessons->values()]))->toResponseRawJson() ;
            $hasStartedLessons = count($startedProgressRows) > 0;

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
