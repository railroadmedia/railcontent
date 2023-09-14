<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use App\Services\User\UserAccessService;
use App\Services\UserMetricsService;
use Illuminate\Http\Request;
use Modules\UserManagementSystem\Models\ReportedUser;
use Modules\UserManagementSystem\Models\User;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfilePublicPagesController extends BaseController
{
    private ContentService $contentService;
    private UserContentProgressService $userContentProgressService;
    private UserMetricsService $userMetricsService;

    /**
     * UserDashboardController constructor.
     *
     * @param  UserContentProgressService  $userContentProgressService
     * @param  ContentService  $contentService
     */
    public function __construct(
        UserContentProgressService $userContentProgressService,
        ContentService $contentService,
        UserMetricsService $userMetricsService
    ) {
        $this->contentService = $contentService;
        $this->userContentProgressService = $userContentProgressService;
        $this->userMetricsService = $userMetricsService;
    }

    public function dashboard(Request $request, $domain, $brand, $userId)
    {
        if (!empty($userId)) {
            $user = User::query()->findOrFail($userId);
            $userId = $user->id;
        } else {
            $userId = user()->id;
            $user = user();
        }

        $userMetrics = $this->getUserMetrics($user);
        switch (brand()) {
            case 'drumeo':
                $methodSlug = 'drumeo-method';
                break;
            case 'pianote':
                $methodSlug = 'pianote-method';
                break;
            case 'guitareo':
                $methodSlug = 'guitareo-method';
                break;
            case 'singeo':
                $methodSlug = 'singeo-method';
                break;
            default:
                throw new NotFoundHttpException();
        }
        $methodContent =
            $this->contentService->getBySlugAndType($methodSlug, 'learning-path')
                ->first();
        $userProgressOnMethod = $methodContent ? $this->userContentProgressService->getUserProgressOnContent($userId, $methodContent['id']) : null;

        // completed/started lessons
        $startedProgressRows = $this->userContentProgressService->getForUserStateContentTypes(
            $userId,
            ContentTypes::userListContentTypes(),
            'started',
            'updated_on',
            'desc',
            4
        );

        $startedProgressContents = $this->contentService->getByIds(array_column($startedProgressRows, 'content_id'));

        $completedProgressRows = $this->userContentProgressService->getForUserStateContentTypes(
            $userId,
            ContentTypes::userListContentTypes(),
            'completed',
            'updated_on',
            'desc',
            4
        );

        $completedProgressContents =
            $this->contentService->getByIds(array_column($completedProgressRows, 'content_id'));

        $isCurrentUsersProfile = user()->id == $user->id;

        $startedProgressContents =
            (new ContentFilterResultsEntity(['results' => $startedProgressContents]))->toResponseRawJson();

        $completedProgressContents =
            (new ContentFilterResultsEntity(['results' => $completedProgressContents]))->toResponseRawJson();

        $userXP = $user->getBrandTotalXp();

        $currentUser = [
            "avatar" => $user->profile_picture_url,
            "xp" => $userXP,
            "access_level" => $user->access_level,
            "xp_rank" => $user->getXpRank(),
        ];

        $isSubscriber = $user->isAMember();

        $reported =
            ReportedUser::where('user_id', '=', $user->id)
                ->where('reporter_id', '=', user()->id)
                ->first();

        $user->is_reported = $reported ? true : false;

        return view(
            'account.dashboard',
            [
                'userMetrics' => $userMetrics,
                'startedProgressContents' => $startedProgressContents,
                'completedProgressContents' => $completedProgressContents,
                'dashboardUser' => $user,
                'isCurrentUsersProfile' => $isCurrentUsersProfile,
                'userXP' => $userXP,
                'currentUser' => $currentUser,
                "isSubscriber" => $isSubscriber,
                "nextLearningPathLevel" => $user->getMethodLevel(),
                "nextLearningPathProgressPercent" => $userProgressOnMethod?$userProgressOnMethod['progress_percent']:0
            ]
        );
    }

    /**
     * @return array
     */
    private function getUserMetrics(User $user)
    {
        $userProfileMetrics = $this->userMetricsService->getUserProfileMetrics($user->id);

        return [
            "musora_xp" => [
                "icon" => "icon-experience-points",
                "value" => $user->getTotalXp(),
                "label" => $user->getXpRank(),
            ],
            "xp" => [
                "icon" => "icon-experience-points",
                "value" => $user->getBrandTotalXp(),
                "label" => $user->getXpRank(),
            ],
            "forums_likes" => [
                "icon" => "fa fa-comments",
                "value" => $userProfileMetrics->getForumPostLikes(),
                "label" => "Forum Post Likes",
            ],
            "comments" => [
                "icon" => "icon-comments-liked",
                "value" => $userProfileMetrics->getCommentLikes(),
                "label" => "Comment Likes",
            ],
            "practiced" => [
                "icon" => "icon-minutes-practiced",
                "value" => $user->getBrandMinutesPracticed(),
                "label" => "Minutes Practiced",
            ],
        ];
    }
}
