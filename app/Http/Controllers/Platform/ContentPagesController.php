<?php

namespace App\Http\Controllers\Platform;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;

class ContentPagesController extends BaseController
{
    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * @var ContentFollowsService
     */
    private $contentFollowService;

    /**
     * @param ContentService $contentService
     * @param ContentFollowsService $contentFollowsService
     */
    public function __construct(
        ContentService $contentService,
        ContentFollowsService $contentFollowsService
    ) {
        $this->contentService = $contentService;
        $this->contentFollowService = $contentFollowsService;
    }

    public function homeRedirect()
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function home(Request $request, $brand) {
        return view('home.index', [
            'brand' => $brand,
        ]);
    }

    public function courses(Request $request, $domain) {
        ConfigService::$availableBrands = [brand()];
        ContentRepository::$bypassPermissions = true;

        $lessonType = 'course';
        $catalogName = 'courses';
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$catalogName] ?? [];

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;

        if (user()->permission_level === 'administrator') {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        $futureLessons = $this->contentService->getFiltered(1, 10, '-published_on', [$lessonType]);

        foreach ($futureLessons['results'] as $futureLessonIndex => $futureLesson) {
            if (Carbon::parse($futureLesson['published_on']) < Carbon::now()) {
                unset($futureLessons['results'][$futureLessonIndex]);
            }
        }

        if (user()->permission_level === 'administrator') {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        ContentRepository::$pullFutureContent = false;

        $sortOverride = $lessonType === 'chord-and-scale' ? 'slug' : null;

        $defaultPage = $lessonType === 'routine' ? 12 : 20;
        if($request->get('page', 1) == 1) {
            $defaultPage = $defaultPage - count($futureLessons['results']);
        }

        $listLessons = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', $defaultPage),
            $sortOverride ?? '-published_on',
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        );

        $routinesCount = $recentRoutines = null;
        $hasRecentRoutines = false;

        if ($lessonType === 'routine') {
            $recentRoutines = $this->getUsersStartedRoutinesContent();

            $hasRecentRoutines = count($recentRoutines->results()) > 0;

            $recentRoutines = $recentRoutines->toResponseRawJson();

            $routinesCount = $listLessons['total_results'];
        }

        $listLessons['results'] = $futureLessons['results']->merge($listLessons['results']);

        $isStudentFocus = in_array($lessonType, ['student-review', 'question-and-answer']);

        return view('content.catalogue', [
            "listLessons" => $listLessons->toResponseRawJson(),
            "lessonType" => $lessonType,
            "sortOverride" => $sortOverride,
            "isStudentFocus" => $isStudentFocus,
            "recentRoutines" => $recentRoutines,
            "hasRecentRoutines" => $hasRecentRoutines,
            "routinesCount" => $routinesCount,
            "catalogueMeta" => $catalogueMeta,
        ]);
    }
}
