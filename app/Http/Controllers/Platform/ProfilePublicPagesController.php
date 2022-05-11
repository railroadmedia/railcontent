<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use App\Services\User\UserAccessService;
use App\Services\UserMetricsService;
use Illuminate\Http\Request;
use Modules\UserManagementSystem\Models\User;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;

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

        $userMetrics = $this->getUserMetrics();

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

        $userXP = $user->total_xp;

        $currentUser = [
            "avatar" => $user->profile_picture_url,
            "xp" => $user->total_xp,
            "access_level" => $user->access_level,
            "xp_rank" => $user->getXpRank(),
        ];

        $isSubscriber = $user->isSubscriber();

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
            ]
        );
    }

    /**
     * @return array
     */
    private function getUserMetrics()
    {
        $userProfileMetrics = $this->userMetricsService->getUserProfileMetrics(user()->id);

        return [
            "xp" => [
                "icon" => "icon-experience-points",
                "value" => user()->total_xp,
                "label" => user()->getXpRank(),
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
                "value" => $userProfileMetrics->getMinutesPracticed(),
                "label" => "Minutes Practiced",
            ],
        ];
    }
}
