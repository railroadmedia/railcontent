<?php

namespace Modules\Content\Services;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\AwardTier;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use JMS\Serializer\Tests\Fixtures\Discriminator\Car;
use Modules\UserManagementSystem\Models\User;

class ChallengesService
{
    public function __construct(
        private UserService $userService,
        private SanityGateway $sanityGateway,
    )
    {
    }

    /**
     * Get enrolled Users models for a given challenge
     * @param int $contentId
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|User[]
     */
    public function getEnrolledUsers(int $contentId, int $count=3)
    {
        $enrolledUserIds = $this->getEnrolledUserIds($contentId);
        $IdsblockList = $this->getBlockListForDisplayedUsers();
        $results = User::query()
            ->whereIn('id', $enrolledUserIds)
            ->whereNotNull('profile_picture_url')
            // this will also filter out deleted users as they have the format musora+deleted
            ->whereNotLike('email', '%@musora%')
            ->whereNotLike('email', '%test%') // this isn't great because many users have @testX.com accounts for businesses
            ->whereNotIn('id', $IdsblockList)
            ->inRandomOrder()
            ->limit($count)
            ->get();
        return [
            'users' => $results,
            'total' => count($enrolledUserIds),
        ];
    }

    /**
     * Get all users ids enrolled in a challenge
     * @param int $challengeId
     * @return array|null
     */
    private function getEnrolledUserIds(int $challengeId) : array | null
    {
        // TODO https://musora.atlassian.net/browse/TCH-42
        // only pull currently enrolled users? something with start_date and last_completed_date?
        // or add a "in_progress" field?
        // ->whereNotNull('start_date')->get();
        return ChallengeUserProgress::query()
            ->where('content_id', $challengeId)
            ->get('user_id')
        ->toArray();
    }

    /**
     * All manually restricted userids for displaying as enrolled
     * @return int[]
     */
    private function getBlockListForDisplayedUsers() : array
    {
        // TODO https://musora.atlassian.net/browse/TCH-37
        // make query builder
        return [755675];
    }

    /**
     * Enroll a user in a challenge based on the start date and locked status. Create or update the ChallengeUserProgress entry
     * @param int $challengeId - Challenge id
     * @param $startDate - date the user will start the challenge
     * @param $isLocked - flag to indicate if content should be gated by time
     * @return ChallengeUserProgress|null
     */
    public function startChallenge(int $challengeId, int $userId, $startDate = null, $isLocked = true) : ChallengeUserProgress | null
    {
        $challenge = $this->getById($challengeId);
        if (!$challenge) {
            return null;
        }
        $startDate = Carbon::parse($startDate ?? $challenge['published_on']);
        $startDate = max($startDate, Carbon::now());
        $lessonMetaData = ChallengeUserProgress::defineLessonsMetaData($challenge, startDate: $startDate, isLocked: $isLocked);
        $restDays = ChallengeUserProgress::calculateDefaultRestdays($challenge);
        $challengeUserProgress = ChallengeUserProgress::updateOrCreate([
            'content_id' => $challengeId,
            'user_id' => $userId,
            ],
        [
            'current_rest_days' => $restDays,
            'start_date' => $startDate,
            'is_locked' => $isLocked,
            'lessons_meta_data' => $lessonMetaData,
        ]);
        return $challengeUserProgress;
    }



    /**
     * Get lesson metadata for lock dates and completion status.
     * @param int $challengeId
     * @param ChallengeUserProgress $userProgress
     * @return array
     */
    public function getCurrentLessonData(int $challengeId, ChallengeUserProgress $userProgress) : array
    {
        $challenge = $this->getById($challengeId);
        $challengeLessons = $challenge['lessons'];
        $userProgressLessons = $userProgress->lessons_meta_data;
        $now = Carbon::now();
        foreach($challengeLessons as $index => $lesson) {
            $unlockDate =  $userProgressLessons[$lesson['id']]['unlock_date'];
            $unlockDate = Carbon::parse($unlockDate);
            $challengeLessons[$index]['unlock_date'] = $unlockDate->toISOString();
            $challengeLessons[$index]['is_locked'] = $unlockDate >=$now;
        }
        return $challengeLessons;
    }

    /**
     * Get the sanity Document for this challenge
     * @param $challengeId
     * @return array
     */
    public function getById($challengeId) : array
    {
        return $this->sanityGateway->getByRailContentId($challengeId, 'challenge');
    }

    /**
     * @param $challengId
     * @param $userId
     * @return void
     * @throws \Exception
     */
    public function completeChallenge($challengId, $userId)
    {
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengId, $userId);
        $today = Carbon::now();
        $bestStreak = max($userProgress->completed_best_streak, $userProgress->getBestCurrentStreak());
        $bestMinutesPracticed = max($userProgress->completed_time_practiced, $userProgress->getMinutesPracticed());
        $userProgress->completed_time_practiced = $bestMinutesPracticed;
        $userProgress->completed_best_streak = $bestStreak;
        $userProgress->last_completed_date = $today;
        $userProgress->is_active = false;
        $userProgress->save();
    }
}
