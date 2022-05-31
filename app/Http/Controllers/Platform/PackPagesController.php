<?php

namespace App\Http\Controllers\Platform;

use App\Collections\PackCollection;
use App\Decorators\Content\VimeoVideoSourcesDecorator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PackPagesController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var UserContentProgressService
     */
    private $userContentProgressService;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var VimeoVideoSourcesDecorator
     */
    private $vimeoVideoSourcesDecorator;

    public function __construct(
        ContentService $contentService,
        UserContentProgressService $userContentProgressService,
        ContentHierarchyService $contentHierarchyService,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator
    ) {
        $this->contentService = $contentService;
        $this->userContentProgressService = $userContentProgressService;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request, $domain, $brand)
    {
        ContentRepository::$pullFutureContent = true;

        if (user()->isAMember()) {
            ContentRepository::$bypassPermissions = true;
        }

        $packs = (new PackCollection(
            $this->contentService->getFiltered(1, -1, '-published_on', ['pack', 'semester-pack'])['results']
        ))->sortByUserActivity(user()->id);

        if (user()->isALifetimeMember() && brand() == 'drumeo') {
            foreach ($packs as $packIndex => $pack) {
                // only lifetime drumeo members should have access to this pack 'lifetime-members-masterclass'
                if ($pack['id'] == 353337) {
                    unset($pack[$packIndex]);
                }
            }
        }

        return view(
            'content.packs.packs-index',
            [
                "packs" => $packs,
            ]
        );
    }

    /**
     * @param Request $request
     * @param $packSlug
     * @return Factory|RedirectResponse|View|NotFoundHttpException
     */
    public function packBundles(Request $request, $domain, $brand, $packSlug, $packId)
    {
        ContentRepository::$pullFutureContent = true;

        if (user()->isAMember()) {
            ContentRepository::$bypassPermissions = true;
        }

        $pack = $this->contentService->getById($packId);

        if (empty($pack)) {
            throw new NotFoundHttpException();
        }

        $packBundles = $this->contentService->getByParentId($pack['id']);

        $totalLessonCount = 0;

        foreach ($packBundles as $packBundle) {
            $totalLessonCount += count($packBundle['lessons'] ?? []);
        }

        $thisPackBundle = $packBundles[0];

        if (empty($thisPackBundle)) {
            return new NotFoundHttpException();
        }

        if (count($packBundles) == 1) {
            return redirect()->route(
                'platform.packs.second-level',
                [$pack['slug'], $pack['id'], $packBundles->first()['slug'], $packBundles->first()['id']]
            );
        }

        $infoData = [
            "lessons" => $totalLessonCount,
            "xp" => $pack->fetch('total_xp'),
        ];

        $backButton = [
            "text" => "Back to All Lessons",
            "url" => $pack->fetch('url'),
        ];

        $xpBonus = $pack->fetch('xp_bonus', 0);

        $childContent = new ContentFilterResultsEntity(['results' => $packBundles]);

        return view(
            'content.packs.pack-overview-bundles',
            [
                "pack" => $pack,
                "parentContent" => $pack,
                "childContent" => $childContent->toResponseRawJson(),
                "infoData" => $infoData,
                "backButton" => $backButton,
                "xpBonus" => $xpBonus,
                "themeColor" => "pack",
                "nextLessonUrl" => '',
            ]
        );
    }

    /**
     * @param Request $request
     * @param $packSlug
     * @return Factory|View|NotFoundHttpException
     */
    public function packBundleLessons(
        Request $request,
        $domain,
        $brand,
        $packSlug,
        $packId,
        $packBundleSlug,
        $packBundleId
    ) {
        ContentRepository::$pullFutureContent = true;

        if (user()->isAMember()) {
            ContentRepository::$bypassPermissions = true;
        }

        $pack = $this->contentService->getById($packId);

        if (empty($pack)) {
            throw new NotFoundHttpException();
        }

        $packBundles = $this->contentService->getByParentId($pack['id']);

        $totalLessonCount = 0;

        foreach ($packBundles as $packBundle) {
            if ($packBundle['id'] == $packBundleId) {
                $thisPackBundle = $packBundle;
            }
        }

        if (empty($thisPackBundle)) {
            return new NotFoundHttpException();
        }

        $lessons = $this->contentService->getByParentId($thisPackBundle['id']);

        $childContent = new ContentFilterResultsEntity(['results' => $lessons]);

        $infoData = [
            "lessons" => $thisPackBundle['lesson_count'],
            "xp" => $thisPackBundle->fetch('total_xp'),
        ];

        $backButton = [
            "text" => "Back to All Lessons",
            "url" => $pack->fetch('url'),
        ];

        $xpBonus = $thisPackBundle->fetch('xp_bonus', 0);

        $nextLessonUrl = '';

        return view(
            'content.overview',
            [
                "pack" => $pack,
                "parentContent" => $thisPackBundle,
                "childContent" => $childContent->toResponseRawJson(),
                "infoData" => $infoData,
                "backButton" => $backButton,
                "xpBonus" => $xpBonus,
                "themeColor" => "pack",
                'nextLessonUrl' => $pack->fetch('next_lesson_url'),
            ]
        );
    }

    /**
     * @param Request $request
     * @param $packSlug
     * @param $lessonSlug
     * @param $lessonId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lesson(
        Request $request,
        $packSlug,
        $lessonSlug,
        $lessonId
    ) {
        if (current_user()->getPermissionLevel() == 'administrator') {
            ContentRepository::$availableContentStatues =
                [
                    ContentService::STATUS_PUBLISHED,
                    ContentService::STATUS_ARCHIVED,
                    ContentService::STATUS_SCHEDULED,
                    ContentService::STATUS_DRAFT
                ];
        } else {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];
        }

        if (UserAccessService::isMember(current_user()->getId())) {
            ContentRepository::$bypassPermissions = true;
        }

        $pack =
            $this->contentService->getBySlugAndType($packSlug, 'pack')
                ->first();

        if (empty($pack)) {
            throw new NotFoundHttpException();
        }

        $packBundles = $this->contentService->getByParentId($pack['id']);
        $thisPackBundle = $packBundles[0];

        $parentChildren = $thisPackBundle['lessons'];

        foreach ($parentChildren as $parentChild) {
            if ($parentChild['id'] == $lessonId) {
                $lesson = $parentChild;
            }
        }

        if (empty($lesson)) {
            throw new NotFoundHttpException();
        }

        $nextChild = $parentChildren->getMatchOffset($lesson, 1);
        $previousChild = $parentChildren->getMatchOffset($lesson, -1);

        $lessonContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$lesson]))
                ->first();

        $parentChildrenTrimmed = [];
        $matched = false;

        foreach ($parentChildren as $parentChildIndex => $parentChild) {
            if ((count($parentChildren) - $parentChildIndex) <= 10 && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            } elseif ($matched && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            }

            if ($parentChild['id'] == $lessonContent['id']) {
                $matched = true;
            }
        }

        $lessonAssignments = $lesson['assignments'] ?? [];

        $relatedLessons = (new ContentFilterResultsEntity(
            ['results' => $parentChildrenTrimmed]
        ))->toResponseRawJson();

        $lesson['assignments'] = $lessonAssignments;
        $lesson['assignmentszz'] = $lessonAssignments;

        $userAccessLevel = UserAccessService::getAccessLevelName(current_user()->getId());

        return view(
            'members.content.lesson',
            [
                "parentType" => 'pack',
                "lessonType" => 'pack-lesson',
                "lessonContent" => $lesson,
                "thisLessonJson" => content_to_json(clone $lesson),
                "nextLessonJson" => content_to_json($nextChild),
                "pack" => $pack,
                "parent" => $thisPackBundle,
                "parentChildren" => $parentChildren,
                "nextChild" => $nextChild,
                "previousChild" => $previousChild,
                "isLive" => false,
                "relatedLessons" => $relatedLessons,
                "showEmail" => false,
                'showRelated' => true,
                "userAccessLevel" => $userAccessLevel,
            ]
        );
    }

    /**
     * @param Request $request
     * @param $packSlug
     * @param $lessonSlug
     * @param $lessonId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bundleLesson(
        Request $request,
        $packSlug,
        $bundleSlug,
        $lessonSlug,
        $lessonId
    ) {
        if (current_user()->getPermissionLevel() == 'administrator') {
            ContentRepository::$availableContentStatues =
                [
                    ContentService::STATUS_PUBLISHED,
                    ContentService::STATUS_ARCHIVED,
                    ContentService::STATUS_SCHEDULED,
                    ContentService::STATUS_DRAFT
                ];
        } else {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];
        }

        if (UserAccessService::isMember(current_user()->getId())) {
            ContentRepository::$bypassPermissions = true;
        }

        $pack =
            $this->contentService->getBySlugAndType($packSlug, 'pack')
                ->first();

        if (empty($pack)) {
            throw new NotFoundHttpException();
        }

        $allPackLessons = [];
        $packBundles = $this->contentService->getByParentId($pack['id']);

        foreach ($packBundles as $packBundle) {
            if ($packBundle['slug'] == $bundleSlug) {
                $thisPackBundle = $packBundle;
            }
            $allPackLessons = array_merge($allPackLessons, $packBundle['lessons']->toArray());
        }

        if (empty($thisPackBundle)) {
            throw new NotFoundHttpException();
        }

        $parentChildren = $thisPackBundle['lessons'];

        foreach ($parentChildren as $parentChild) {
            if ($parentChild['id'] == $lessonId) {
                $lesson = $parentChild;
                $lesson['resources'] = array_merge(
                    $pack['resources'] ?? [],
                    $lesson['resources'] ?? []
                );
            }
        }

        if (empty($lesson)) {
            throw new NotFoundHttpException();
        }

        $allPackLessons = new Collection($allPackLessons);
        $nextChild = $allPackLessons->getMatchOffset($lesson, 1);
        $previousChild = $allPackLessons->getMatchOffset($lesson, -1);

        $lessonContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$lesson]))
                ->first();

        $parentChildrenTrimmed = [];
        $matched = false;

        foreach ($parentChildren as $parentChildIndex => $parentChild) {
            if ((count($parentChildren) - $parentChildIndex) <= 10 && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            } elseif ($matched && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            }

            if ($parentChild['id'] == $lessonContent['id']) {
                $matched = true;
            }
        }

        $lessonAssignments = $lesson['assignments'] ?? [];

        $relatedLessons = (new ContentFilterResultsEntity(
            ['results' => $parentChildrenTrimmed]
        ))->toResponseRawJson();

        $lesson['assignments'] = $lessonAssignments;

        $userAccessLevel = UserAccessService::getAccessLevelName(current_user()->getId());

        return view(
            'members.content.lesson',
            [
                "parentType" => 'pack',
                "lessonType" => 'pack-lesson',
                "lessonContent" => $lesson,
                "thisLessonJson" => content_to_json(clone $lesson),
                "nextLessonJson" => content_to_json($nextChild),
                "pack" => $pack,
                "parent" => $thisPackBundle,
                "parentChildren" => $parentChildren,
                "nextChild" => $nextChild,
                "previousChild" => $previousChild,
                "isLive" => false,
                "relatedLessons" => $relatedLessons,
                "showEmail" => false,
                'showRelated' => true,
                "userAccessLevel" => $userAccessLevel,
            ]
        );
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function start(Request $request, $id)
    {
        $learningPath = $this->contentService->getById($id);

        if (empty($learningPath)) {
            throw new NotFoundHttpException();
        }

        $learningPathLessons = $this->contentService->getByParentId($learningPath['id']);

        $this->userContentProgressService->startContent(
            $id,
            auth()->id()
        );

        return redirect()->away($learningPathLessons->first()['url']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jumpToNextLesson(Request $request, $id)
    {
        $pack = $this->contentService->getById($id);

        $packBundles = $this->contentService->getByParentId($pack['id']);
        $thisPackBundle = null;

        if ($pack['type'] == 'pack') {
            foreach ($packBundles as $packBundle) {
                if ($packBundle['completed'] == false) {
                    $lessons = $this->contentService->getByParentId($packBundle['id']);

                    foreach ($lessons as $lesson) {
                        if ($lesson['completed'] == false) {
                            return redirect()->route(
                                'members.packs.lesson',
                                [$pack['slug'], $lesson['slug'], $lesson['id']]
                            );
                        }
                    }
                }
            }
        }

        throw new NotFoundHttpException();
    }
}
