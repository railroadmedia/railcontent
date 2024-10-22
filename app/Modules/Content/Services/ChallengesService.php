<?php

namespace Modules\Content\Services;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Modules\UserManagementSystem\Models\User;

class ChallengesService
{
    const string ENROLLMENT_NOTIFICATION_KEY = 'challenges_enrollment_notifications';
    const string COMMUNITY_NOTIFICATION_KEY = 'challenges_community_notifications';


    public function __construct(
        private UserAccessPermissionsService $userAccessPermissionsService,
        private CustomerIoSyncService $customerIoSyncService,
        private CustomerIoService $customerIoService,
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
        $maxDisplayNameLength = 10;
        $enrolledUserIds = $this->getEnrolledUserIds($contentId);
        $IdsblockList = $this->getBlockListForDisplayedUsers();
        $results = User::query()
            ->whereIn('id', $enrolledUserIds)
            ->whereNotNull('profile_picture_url')
            // this will also filter out deleted users as they have the format musora+deleted
            ->whereNotLike('email', '%@musora%')
            ->whereNotLike('email', '%test%') // this isn't great because many users have @testX.com accounts for businesses
            ->whereRaw("LENGTH(display_name) <= $maxDisplayNameLength")
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
        return ChallengeUserProgress::query()
            ->where('content_id', $challengeId)
            ->where('is_active', true)
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
        $challenge = $this->getChallengeById($challengeId);
        if (!$challenge) {
            return null;
        }
        $startDate = Carbon::parse($startDate ?? $challenge['published_on']);
        $startDate = max($startDate, Carbon::now()->startOfDay());
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
            'is_active' => true,
        ]);
        return $challengeUserProgress;
    }



    /**
     * Get lesson metadata for lock dates and completion status.
     * @param int $contentId
     * @param int $userId
     * @return array
     */
    public function getCurrentLessonData(int $contentId, int $userId, bool $isLesson = true) : ?array
    {
        if ($isLesson) {
            $sanityDocument = $this->sanityGateway->getChallengeDataFromChild($contentId);
            $challenge = $sanityDocument['parent'];
            $challengeLessons = $challenge['lessons'];

        } else {
            $challenge = $this->getChallengeById($contentId);
            $challengeLessons = $challenge['lessons'];
            $lessonDocument = $challenge;
            unset($lessonDocument['lessons']);
        }

        $progressData = ChallengeUserProgress::whereChallengeIdAndUser($challenge['id'], $userId);
        $firstIncompleteLesson = [];
        $userData = [];

        if (!is_null($progressData) && $progressData->is_active) {
            $today = Carbon::now()->startOfDay();
            foreach($challengeLessons as $index => $lesson) {
                $unlockDate = $progressData->lessons_meta_data[$index]['unlock_date'];
                $unlockDate = Carbon::parse($unlockDate);
                $challengeLessons[$index]['unlock_date'] = $unlockDate->toISOString();
                $challengeLessons[$index]['is_locked'] = $progressData->is_locked && $unlockDate > $today;
                $challengeLessons[$index]['is_completed'] = $progressData->lessons_meta_data[$index]['is_completed'];;
            }

            $firstIncompleteLesson = $this->getFirstIncompleteLesson($challengeLessons, $progressData);

            $userData = $progressData->getCompiledMetadata();
            $now = Carbon::now();
            $userData['challenge_state'] = match (true) {
                $challenge['is_solo_challenge'] => 'active_solo',
                !is_null($challenge['enrollment_start_time']) && $now < Carbon::parse(
                    $challenge['enrollment_start_time']
                ) => 'upcoming',
                $now < Carbon::parse($challenge['published_on']) => 'enrollment',
                $now < Carbon::parse($userData['end_date']) => 'active_community',
                default => 'completed_community',
            };
        } else {
            $userData['is_active'] = false;
        }

        $nextPreviousLesson = $this->getPreviousAndNextLessonIds($contentId, $challengeLessons);

        if ($isLesson) {
            foreach ($challengeLessons as $lesson) {
                if ($lesson['id'] == $contentId) {
                    $lessonDocument = $lesson;
                    break;
                }
            }
            $lessonDocument['challenge_dark_mode_logo_url'] = $challenge['dark_mode_logo_url'];
            $lessonDocument['challenge_light_mode_logo_url'] = $challenge['light_mode_logo_url'];
            $lessonDocument['challenge_title'] = $challenge['title'];
        }

        return [
            'lesson' => $lessonDocument,
            'lessons' => $challengeLessons,
            'first_incomplete_lesson' => $firstIncompleteLesson,
            'user_data' => $userData,
            'next_lesson' => $nextPreviousLesson['next_lesson'],
            'previous_lesson' => $nextPreviousLesson['previous_lesson'],
        ];
    }

    /**
     * @param $challengeLessons
     * @param $progressData
     * @return mixed|null
     */
    private function getFirstIncompleteLesson($challengeLessons, $progressData)
    {
        $firstIncompleteLesson = null;
        $now = Carbon::now()->startOfDay();
        foreach ($challengeLessons as $index => $lesson) {
            foreach ($progressData->lessons_meta_data as $userProgressLesson) {
                if ($lesson['id'] == $userProgressLesson['content_id']) {
                    if (is_null($firstIncompleteLesson) && !$userProgressLesson['is_completed']) {
                        $firstIncompleteLesson = $lesson;
                    }
                    $unlockDate = Carbon::parse($userProgressLesson['unlock_date']);
                    $challengeLessons[$index]['unlock_date'] = $unlockDate->toISOString();
                    $challengeLessons[$index]['is_locked'] = $unlockDate >= $now;
                    break;
                }
            }
        }
        return $firstIncompleteLesson;
    }

    /**
     * @param $lessonId
     * @param $allLessons
     * @return array|null[]
     */
    private function getPreviousAndNextLessonIds($lessonId, $allLessons)
    {

        $index = array_search($lessonId, Arr::pluck($allLessons, 'id'));
        $nextLesson = $allLessons[$index+1] ?? null;
        $previousLesson = $allLessons[$index-1] ?? null;
        return [
            'previous_lesson' => $previousLesson,
            'next_lesson' => $nextLesson,
        ];
    }

    /**
     * Get the sanity Document for this challenge
     * @param $challengeId
     * @return array | null
     */
    public function getChallengeById($challengeId) : array | null
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

    public function updateCustomerIONotifications($challengeId, $user, $notificationKey) : void
    {
        $musoraWorkspace = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
        $customerIO = $this->customerIoService->getCustomerByEmail($musoraWorkspace, $user->email);
        if (is_null($customerIO)) {
            return;
        }
        $existingNotifications = json_decode($customerIO->getExternalAttributes()[$notificationKey] ?? '[]');

        if (!in_array($challengeId, $existingNotifications) ) {
            $existingNotifications[] = $challengeId;
        }
        $data = [$notificationKey => $existingNotifications];

        $this->customerIoService->createOrUpdateCustomerByUserId(
            $user->id,
            $musoraWorkspace,
            $user->email,
            $data,
            $user->created_at->timestamp
        );
    }
}
