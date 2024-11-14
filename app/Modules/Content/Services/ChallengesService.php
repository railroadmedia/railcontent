<?php

namespace Modules\Content\Services;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Modules\UserManagementSystem\Models\User;

class ChallengesService
{
    const string ENROLLMENT_NOTIFICATION_KEY = 'challenges_enrollment_notifications';
    const string COMMUNITY_NOTIFICATION_KEY = 'challenges_community_notifications';


    public function __construct(
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
     * Get number of active users in the specified challenge
     * @param int $challengeId
     * @return int
     *
     */
    public function getActiveUsersCount(int $challengeId): int
    {
        return ChallengeUserProgress::query()
            ->where('content_id', $challengeId)
            ->where('is_active', true)
            ->count();
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
        $isSolo = ($challenge['is_solo'] ?? false) || !(is_null($startDate) && $isLocked);
        $startDate = Carbon::parse($startDate ?? $challenge['published_on']);
        $startDate = $startDate->startOfDay();
        $lessonMetaData = ChallengeUserProgress::defineLessonsMetaData($challenge, startDate: $startDate, isLocked: $isLocked);
        $restDays = ChallengeUserProgress::calculateDefaultRestDays($challenge);
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
            'is_solo' => $isSolo,
        ]);
        return $challengeUserProgress;
    }



    /**
     * Get lesson and related content metadata for the current user progress.
     * @param int $contentId
     * @param int $userId
     * @return array
     */
    public function getCurrentLessonData(int $contentId, int $userId, bool $isLesson = true) : ?array
    {
        if ($isLesson) {
            $sanityDocument = $this->sanityGateway->getChallengeChildAndParentData($contentId);
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
            $challengeLessons = $this->combineUserLessonDataWithSanityLessonData($challengeLessons, $progressData);
            $firstIncompleteLesson = $this->getFirstIncompleteUnlockedLesson($challengeLessons, $progressData);

            $userData = $progressData->getCompiledMetadata();
            $now = Carbon::now();
            $userData['challenge_state'] = match (true) {
                $challenge['is_solo'] => 'active_solo',
                !is_null($challenge['enrollment_start_time']) && $now < Carbon::parse(
                    $challenge['enrollment_start_time']
                ) => 'upcoming',
                $now < Carbon::parse($challenge['published_on']) => 'enrollment',
                $now < Carbon::parse($userData['end_date']) => 'active_community',
                default => 'completed_community',
            };
            if ($isLesson) {
                $nextPreviousLesson = $this->getPreviousAndNextLesson($contentId, $challengeLessons);
            } else {
                $nextPreviousLesson = [
                    'next_lesson' => $firstIncompleteLesson,
                    'previous_lesson' => null,
                ];
            }
        } else {
            $userData['is_active'] = false;
            $nextPreviousLesson = [];
        }


        // Assign the formatted lesson to the `lesson` object and add relevant challenge data
        if ($isLesson) {
            foreach ($challengeLessons as $lesson) {
                if ($lesson['id'] == $contentId) {
                    $lessonDocument = $lesson;
                    break;
                }
            }
            $lessonDocument['challenge_dark_mode_logo_url'] = $challenge['dark_mode_logo_url'];
            $lessonDocument['challenge_light_mode_logo_url'] = $challenge['light_mode_logo_url'];
            $lessonDocument['challenge_logo_image_url'] = $challenge['logo_image_url'];
            $lessonDocument['challenge_title'] = $challenge['title'];
        } else {
            // format the duration of the challenge
            if ($userData['is_active']) {
                $startDate = Carbon::parse($userData['start_date']);
                $endDate = Carbon::parse($userData['end_date']);
            } else {
                $startDate = Carbon::parse($lessonDocument['published_on']);
                $endDate = $this->getChallengeEndDate($challenge);
            }
            $lessonDocument['duration_text'] = $this->getDurationText($startDate, $endDate);

        }

        return [
            'lesson' => $lessonDocument,
            'lessons' => $challengeLessons,
            'first_incomplete_lesson' => $firstIncompleteLesson,
            'user_data' => $userData,
            ... $nextPreviousLesson,
        ];
    }

    private function combineUserLessonDataWithSanityLessonData(array $lessons, ChallengeUserProgress $challengeUserProgress, bool $removeVideoData = false) : array
    {
        $day = 0;
        foreach($lessons as $index => $lesson) {
            if (!$lesson['is_always_unlocked_for_challenge']) {
                $day += 1;
                $lessons[$index]['index'] = $day;
                $lessons[$index]['short_name'] = "Day {$day}";
            } else {
                $lessons[$index]['index'] = '';
                $lessons[$index]['short_name'] = $lesson['title'];
            }
            $lessonDatum = $challengeUserProgress->getMetaDatumForContent($lesson['id']);
            $unlockDate = $lessonDatum['unlock_date'];
            $unlockDate = Carbon::parse($unlockDate);
            $today = Carbon::now()->startOfDay();
            $lessons[$index]['unlock_date'] = $unlockDate->toISOString();
            $lessons[$index]['is_locked'] = $challengeUserProgress->is_locked && $unlockDate > $today;
            $lessons[$index]['completed'] = $lessonDatum['completed'];
            if ($removeVideoData) {
                unset($lessons[$index]['video']);
            }
        }

        return $lessons;
    }

    public function getChallengeMetaDataForUserProgress(array $allChallengeIds, Collection $userProgresses, bool $returnChallengeData, ?string $brand = null) : array
    {
        $resultPackage = [];
        $challenges = $this->getChallengeByIds($allChallengeIds, $brand);
        foreach($allChallengeIds as $contentId) {
            $challenge = null;
            foreach($challenges as $testChallenge) {
                if ($testChallenge['id'] == $contentId) {
                    $challenge = $testChallenge;
                    break;
                }
            }
            if (is_null($challenge)) {
                continue;
            }

            $challengeMetaDataToReturn = null;
            foreach ($userProgresses as $userProgress) {
                if ($userProgress['content_id'] == $contentId) {
                    if ($userProgress->is_active) {
                        $startEndDate = $userProgress->getStartAndEndDate();
                        $status = $userProgress->isCompleteAndNotActive() ? 'completed' : 'active';
                        $challenge['lessons'] = $this->combineUserLessonDataWithSanityLessonData(
                            $challenge['lessons'],
                            $userProgress,
                            removeVideoData: true
                        );
                        if ($userProgress->isCompleteAndNotActive()) {
                            $firstIncompleteLesson = null;
                            $previousCompletedLesson = end($challenge['lessons']);
                        } else {
                            $firstIncompleteLesson = $this->getFirstIncompleteUnlockedLesson(
                                $challenge['lessons'],
                                $userProgress
                            );
                            $nextPreviousLessonAroundFirstIncompleteLesson = $this->getPreviousAndNextLesson(
                                $firstIncompleteLesson['id'],
                                $challenge['lessons']
                            );
                            $previousCompletedLesson = $nextPreviousLessonAroundFirstIncompleteLesson['previous_lesson'];
                        }
                        $durationText = $userProgress->is_locked ?
                            $this->getDurationText(
                                Carbon::parse($startEndDate['start_date']),
                                Carbon::parse($startEndDate['end_date'])
                            ) :
                            'Unlocked';
                        $challengeMetaDataToReturn = [
                            'is_user_enrolled' => true,
                            'progress_percent' => $userProgress->getCompletionPercent(),
                            'duration_text' => $durationText,
                            'is_solo' => $userProgress['is_solo'],
                            'status' => $status,
                            'next_lesson' => $firstIncompleteLesson,
                            'previous_completed_lesson' => $previousCompletedLesson,
                            ... $userProgress->getCompiledMetadata(),
                        ];
                        break;
                    } else {
                        $durationText = $this->getDurationText(Carbon::parse($challenge['published_on']), $this->getChallengeEndDate($challenge));
                        $challengeMetaDataToReturn = [
                            'is_user_enrolled' => true,
                            'progress_percent' => 100,
                            'duration_text' => $durationText,
                            'is_solo' => $challenge['is_solo'],
                            'status' => 'completed',
                            'next_lesson' => null,
                            'previous_completed_lesson' => null,
                        ];
                        break;
                    }
                }
            }
            if (is_null($challengeMetaDataToReturn)) {
                $challengeMetaDataToReturn = [
                    'is_user_enrolled' => false,
                    'progress_percent' => 0,
                    'duration_text' => $this->getDurationText(Carbon::parse($challenge['published_on']), $this->getChallengeEndDate($challenge)),
                    'is_solo' => $challenge['is_solo'],
                    'status' => 'not_started',
                    'next_lesson' => null,
                    'previously_completed_lesson' => null,
                ];
            }
            if ($returnChallengeData) {
                unset($challenge['lessons']);
                unset($challenge['video']);
                $challengeDataToAdd = $challenge;
            } else {
                $challengeDataToAdd = [];
            }
            $challengeMetaDataToReturn = [
                ... $challengeMetaDataToReturn,
                ... $challengeDataToAdd,
                'content_id' => $challenge['id']];

            $resultPackage[] = $challengeMetaDataToReturn;
        }
        return $resultPackage;
    }

    public function getDurationText(Carbon $startDate, Carbon $endDate) : string
    {
        $isSameMonth = $startDate->month == $endDate->month;
        $formatKey = $isSameMonth ? 'F' : 'M';
        $durationText = $startDate->format($formatKey . ' j');
        $durationText .= ' - ' . ($isSameMonth ? $endDate->format('j') : $endDate->format($formatKey . ' j'));
        return $durationText;
    }

    /**
     * @param $challengeLessons
     * @param $progressData
     * @return mixed|null
     */
    private function getFirstIncompleteUnlockedLesson($challengeLessons, $progressData)
    {
        foreach ($challengeLessons as $lesson) {
            foreach ($progressData->lessons_meta_data as $userProgressLesson) {
                if ($lesson['id'] == $userProgressLesson['content_id']) {
                    if (!$userProgressLesson['is_always_unlocked'] && !$userProgressLesson['completed']) {
                        return $lesson;
                    }
                    break;
                }
            }
        }
        return null;
    }

    /**
     * @param $lessonId
     * @param $allLessons
     * @return array|null[]
     */
    private function getPreviousAndNextLesson($lessonId, $allLessons) : array
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
     * Get the sanity Documents for listed challenges
     * @param array $challengeIds
     * @param string $brand
     * @return array | null
     */
    public function getChallengeByIds($challengeIds, ?string $brand = null) : array | null
    {
        return $this->sanityGateway->getByRailContentIds($challengeIds, 'challenge', $brand);
    }

    public function completeLessonAndGetCurrentProgressResults($lessonId, $userId) : array
    {
        $sanityDocument = $this->sanityGateway->getChallengeChildAndParentData($lessonId);
        $challenge = $sanityDocument['parent'];
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challenge['id'], $userId);
        $wasChallengeCompleted = $userProgress->areAllLessonsCompleted();
        $lessonsProgress = $userProgress->updateLessonsProgress($lessonId, isCompleted: true);
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challenge['id'], $userId);
        $isChallengeCompleted = $userProgress->areAllLessonsCompleted();

        $lessonData = $this->getCurrentLessonData($lessonId, $userId, isLesson: true);
        $active = true;
        $motivationalText = [];
        if (!$userProgress->is_locked || !$lessonsProgress['added_to_streak']) {
            $active = false;
        } else if ($lessonsProgress['is_milestone']) {
            $milestone = $isChallengeCompleted ? 'complete' : $lessonData['user_data']['current_streak'];
            $motivationalTextConfig = config('challengemotivationalresponses')[$milestone] ?? config('challengemotivationalresponses')['default'];
            $motivationalText = [
                'lottie_url' => $motivationalTextConfig[brand()],
                'milestone' => $milestone,
                'motivational_title' => $isChallengeCompleted ? "You've completed {$challenge['title']}!" : "You're on a {$milestone} Day Streak!",
                'motivational_subtext' => $isChallengeCompleted  ? '' : "You've earned an additional freeze token!",
                'badge_text' => $motivationalTextConfig['text'],
            ];
        } else {
            $missingLessons = $lessonData['user_data']['missed_lessons'];
            $noMissingLessons = $missingLessons == 0;
            $motivationalText = [
                'lottie_url' => null,
                'milestone' => null,
                'motivational_title' => $noMissingLessons ? "You're done for the day!" : "You're almost caught up!",
                'motivational_subtext' => $noMissingLessons ? "Return tomorrow to maintain your streak!" : "Complete {$missingLessons} more lesson(s) to catch up",
                'badge_text' => null,
            ];
        }
        $userData = $userProgress->getCompiledMetadata();
        if (!$wasChallengeCompleted && $isChallengeCompleted) {
            $this->completeChallenge($challenge['id'], $userId);
        }
        $challengeData = array_intersect_key($lessonData['lesson'], array_flip(['challenge_dark_mode_logo_url', 'challenge_light_mode_logo_url', 'challenge_logo_image_url', 'index', 'short_name']));
        return [
            'challenge_id' => $challenge['id'],
            'current_lesson_thumbnail' => $sanityDocument['thumbnail'],
            'show_modal' => $active,
            ...$lessonsProgress,
            ...$motivationalText,
            ...$challengeData,
            'user_data' => $userData,
            'next_lesson' => $lessonData['next_lesson']
        ];
    }

    /**
     * @param $challengeId
     * @param $userId
     * @return void
     * @throws \Exception
     */
    public function completeChallenge($challengeId, $userId)
    {
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
        $today = Carbon::now();
        $bestStreak = max($userProgress->getBestCurrentStreak(), $userProgress->completed_best_streak);
        $bestMinutesPracticed = max($userProgress->getMinutesPracticed(), $userProgress->completed_time_practiced);
        $userProgress->completed_time_practiced = $bestMinutesPracticed;
        $userProgress->completed_best_streak = $bestStreak;
        $userProgress->last_completed_date = $today->toISOString();
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

    /**
     * Return the date of the last day of the challenge
     * @param array $challenge - Sanity challenge document
     * @return Carbon|null
     */
    public function getChallengeEndDate(array $challenge) : Carbon | null
    {
        $startDate =  Carbon::parse($challenge['published_on']);
        $dayCount = -1;
        foreach($challenge['lessons'] as $child) {
            $dayCount += $child['is_always_unlocked_for_challenge'] ?? false ? 0 : 1;
        }
        return $startDate->copy()->addDays($dayCount);
    }
}
