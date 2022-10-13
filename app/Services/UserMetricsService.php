<?php

namespace App\Services;

use App\ValueObjects\UserProfileMetrics;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Points\Services\UserPointsService;

class UserMetricsService
{
//    /**
//     * @var UserProductService
//     */
//    private $userProductService;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var UserProfileMetrics[]
     */
    private $cache = [];

    /**
     * UserMetricsService constructor.
     *
     * @param  DatabaseManager  $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
//        $this->userProductService = $userProductService;
        $this->databaseManager = $databaseManager;
    }

    public function getUserProfileMetrics($userId)
    {
        if (isset($this->cache[$userId])) {
            return $this->cache[$userId];
        }

        $userProfileMetricsVO = new UserProfileMetrics(
            0,
            0,
            $this->getTotalCommentLikes($userId),
            $this->getTotalMinutesPracticed($userId),
            $this->getTotalForumLikes($userId),
        );

        $this->cache[$userId] = $userProfileMetricsVO;

        return $userProfileMetricsVO;
    }

    /**
     * @param $userId
     *
     * @return int
     */
    private function getDaysAsMember($userId)
    {
        return 100; // todo: fix after ecom
        $usersProducts = $this->userProductService->getAllUsersProducts((integer)$userId);

        /**
         * @var $startDate Carbon|null
         */
        $startDate = null;

        /**
         * @var $endDate Carbon|null
         */
        $endDate = null;

        // go through all membership products and grab their earliest created at and latest expiration date

        foreach ($usersProducts as $usersProduct) {
            // skip all non-membership products
            if (!in_array(
                $usersProduct->getProduct()
                    ->getSku(),
                config('event-data-synchronizer.drumeo_membership_product_skus')
            )
            ) {
                continue;
            }

            if (!empty($usersProduct->getCreatedAt()) && $startDate == null) {
                $startDate = $usersProduct->getCreatedAt();
            }

            if (!empty($usersProduct->getExpirationDate()) && $endDate == null) {
                $endDate = $usersProduct->getExpirationDate();
            }

            if (!empty($usersProduct->getCreatedAt()) && $startDate !== null
                && $usersProduct->getCreatedAt() < $startDate
            ) {
                $startDate = $usersProduct->getCreatedAt();
            }

            if (!empty($usersProduct->getExpirationDate()) && $endDate !== null
                && $usersProduct->getExpirationDate() < $endDate
            ) {
                $endDate = $usersProduct->getExpirationDate();
            }
        }

        if ($startDate !== null && $endDate == null) {
            $endDate = Carbon::now();
        }

        if (!empty($endDate) && $endDate > Carbon::now()) {
            $endDate = Carbon::now();
        }

        if ($startDate !== null && $endDate !== null) {
            return $startDate->diffInDays($endDate);
        }

        return 0;
    }

    /**
     * @param $userId
     *
     * @return int
     */
    private function getTotalForumLikes($userId)
    {
        return $this->databaseManager->connection(config('railforums.database_connection_name'))
            ->table('forum_posts')
            ->join('forum_post_likes', 'forum_post_likes.post_id', '=', 'forum_posts.id')
            ->where('forum_posts.author_id', '=', $userId)
            ->count();
    }

    /**
     * @param $userId
     *
     * @return int
     */
    private function getTotalCommentLikes($userId)
    {
        return $this->databaseManager->connection(config('railcontent.database_connection_name'))
            ->table('railcontent_comments')
            ->join('railcontent_comment_likes', 'railcontent_comment_likes.comment_id', '=', 'railcontent_comments.id')
            ->where('railcontent_comments.user_id', '=', $userId)
            ->count();
    }

    /**
     * @param $userId
     *
     * @return integer
     */
    private function getTotalMinutesPracticed($userId)
    {
        $assignmentTypeIds = $this->databaseManager->connection(config('railtracker.database_connection_name'))
            ->table('railtracker_media_playback_types')->where('type', 'assignment')->get('id');
        $assignmentTypeIds = $assignmentTypeIds->pluck('id')->toArray();

        return round(
            ((integer)$this->databaseManager->connection(config('railtracker.database_connection_name'))
                ->table('railtracker_media_playback_sessions')
                ->where('user_id', $userId)
                ->whereIn('type_id', $assignmentTypeIds)
                ->sum('seconds_played')) / 60,
            0
        );
    }
}
