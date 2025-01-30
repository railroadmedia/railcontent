<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ChallengeUserProgressStatus;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Models\Sanity\Challenge;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\RailTracker\Services\MediaPlaybackService;
use App\Services\UserTimezoneService;
use Carbon\Carbon;
use Gedmo\Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Modules\UserManagementSystem\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

enum UserNotificationKeys: string
{
    case ENROLLMENT_NOTIFICATION_KEY = 'challenges_enrollment_notifications';
    case COMMUNITY_NOTIFICATION_KEY = 'challenges_community_notifications';
    case SOLO_NOTIFICATION_KEY = 'challenges_solo_notifications';
}

class ChallengesService
{
    //TODO update for solo challenges - TCH-113

    public const int MAX_BUTTON_TEXT_LENGTH = 13;


    public function __construct(
        private CustomerIoService $customerIoService,
        private SanityGateway $sanityGateway,
        private MediaPlaybackService $mediaPlaybackService,
        private ContentUserProgress $contentUserProgress,
        private UserAccessPermissionsService $userAccessPermissionsService,
    ) {
    }

    /**
     * Get a boolean if the user has access to the challenge
     * @param int $contentId
     */
    public function hasAccess(int $contentId): bool
    {
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($contentId, user()->id);
        return $userProgress &&  ($userProgress->is_active || !$userProgress->is_locked);
    }

    /**
     * Get enrolled Users models for a given challenge
     * @param int $contentId
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|User[]
     */
    public function getEnrolledUsers(int $contentId, int $count = 3)
    {
        $maxDisplayNameLength = 10;
        $enrolledUserIds = $this->getEnrolledUserIds($contentId);
        $IdsblockList = $this->getBlockListForDisplayedUsers();
        $results = User::query()
            ->whereIn('id', $enrolledUserIds)
            ->whereNotNull('profile_picture_url')
            // this will also filter out deleted users as they have the format musora+deleted
            ->whereNotLike('email', '%@musora%')
            ->whereNotLike('email', '%@drumeo%')
            ->whereNotLike('email', '%@guitareo%')
            ->whereNotLike('email', '%@singeo%')
            ->whereNotLike('email', '%@pianote%')
            ->whereNotLike('email', '%@playbass%')
            ->whereNotLike('email', '%@recordeo%')
            ->whereNotLike(
                'email',
                '%test%'
            ) // this isn't great because many users have @testX.com accounts for businesses
            ->whereRaw("LENGTH(display_name) <= $maxDisplayNameLength")
            ->whereNotIn('id', $IdsblockList)
            ->inRandomOrder()
            ->limit($count)
            ->get();

        $resultsCount = count($results);
        $enrolledCount = count($enrolledUserIds);
        if ($resultsCount < 3) {
            $fillerCount = 3 - $resultsCount;
            $fillerResults = User::query()
                ->whereIn('id', $this->getFillerAccountIds())
                ->limit($fillerCount)
                ->inRandomOrder()
                ->get();
            $results = $results->concat($fillerResults);
            if ($enrolledCount < 3) {
                $enrolledCount = 3;
            }
        }
        return [
            'users' => $results,
            'total' => $enrolledCount,
        ];
    }

    // Return known dummy account ids to populate the user array in case there are no existing users
    private function getFillerAccountIds(): array
    {
        //
        return [4,5,7,8,136,145,5814,6747,6885,28224,75158,87011,96326,102905,149628,149629,149630,149632,149641,150243,150244,150245,150246,150247,150250,150259,150270,150378,150447,150458,150466,150474,150475,150478,150481,151112,151155,151917,152472,153715,154064,154138,154713,155577,155762,156169,156171,164416,164418,164681,166859,166904,166906,166907,166951,173259,245201,272444,274569,293043,298176,298348,314690,318009,321592,328363,340756,343979,344840,347345,349001,349574,350636,356084,360053,360551,361772,365658,388242,388344,389536,389914,391264,392696,393357,393449,394753,396653,397568,397822,398008,401282,402454,402486,403844,404255,406398,407824,412338,414874];
    }

    /**
     * Get enrolled users metadata for a given challenge
     * @param int $contentId
     * @param int|null $count
     *
     * @return array<{
     *      entity: array<{
     *          id: int,
     *          email: string,
     *          display_name: string,
     *          profile_picture_url: string
     *      }>,
     *      total: int
     *  }>
     */
    public function getEnrolledUsersMetadata(int $contentId, ?int $count = 3)
    {
        $enrolledUsersAndCount = $this->getEnrolledUsers($contentId, $count);
        $enrolledUsers = $enrolledUsersAndCount['users'];
        $formattedUsers = $enrolledUsers->map(fn (User $user) => [
            'id' => $user->id,
            'display_name' => $user->display_name,
            'profile_picture_url' => $user->profile_picture_url,
        ]);

        return [
            'data' => $formattedUsers,
            'total' => $enrolledUsersAndCount['total'],
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
    private function getEnrolledUserIds(int $challengeId): array|null
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
    private function getBlockListForDisplayedUsers(): array
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
    public function startChallenge(
        int $challengeId,
        int $userId,
        $startDate = null,
        $isLocked = true,
        $challenge = null,
    ): ChallengeUserProgress|null {
        if (!$challenge) {
            $challenge = $this->getChallengeById($challengeId);
        }
        if (!$challenge) {
            return null;
        }
        $isSolo = ($challenge['is_solo'] ?? false) || !(is_null($startDate) && $isLocked);
        $startDate = Carbon::parse($startDate ?? $challenge['published_on']);
        $lessonMetaData = ChallengeUserProgress::defineLessonsMetaData(
            $challenge,
            startDate: $startDate,
            isChallengeLocked: $isLocked
        );
        $restDays = ChallengeUserProgress::calculateDefaultRestDays($challenge);
        $data = [
            'current_rest_days' => $restDays,
            'start_date' => $startDate,
            'is_locked' => $isLocked,
            'lessons_meta_data' => $lessonMetaData,
            'is_active' => $isLocked,
            'is_solo' => $isSolo,
        ];
        // Resubscribe user for solo notifications if they were previously subscribed
        if ($this->isUserSubscribedToNotificationsForActiveSoloChallenge($challengeId, $userId)) {
            $data['solo_notification_to_be_processed'] = 1;
        }
        // unsubscribe user from notifications when they unlock a challenge
        if ($isSolo && !$isLocked) {
            $this->updateNotification($challengeId, User::whereId($userId), UserNotificationKeys::SOLO_NOTIFICATION_KEY, enable: false);
            $data['solo_notification_to_be_processed'] = 0;
        }
        $challengeUserProgress = ChallengeUserProgress::updateOrCreate(
            [
                'content_id' => $challengeId,
                'user_id' => $userId,
            ],
            $data,
        );
        return $challengeUserProgress;
    }

    private function isUserSubscribedToNotificationsForActiveSoloChallenge($challengeId, $userId)
    {
        $existingProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
        $wasSoloAndActive = $existingProgress && ($existingProgress->is_solo && $existingProgress->is_active);
        if ($wasSoloAndActive) {
            $existingNotifications = $user[UserNotificationKeys::SOLO_NOTIFICATION_KEY->value] ?? [];
            return in_array($challengeId, $existingNotifications);
        }
        return false;
    }


    /**
     * Unenroll the user in a challenge. Returns false if user wasn't already enrolled
     * @param int $challengeId - Challenge id
     * @param User $userId - user id
     * @return ChallengeUserProgress|null
     */
    public function leaveChallenge(int $challengeId, User $user) : bool
    {
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $user->id);
        if (is_null($userProgress)) {
            return false;
        }
        $notificationKey = $userProgress->is_solo ? UserNotificationKeys::SOLO_NOTIFICATION_KEY : UserNotificationKeys::COMMUNITY_NOTIFICATION_KEY;
        $userProgress->leaveChallenge();

        $this->updateNotification($challengeId, $user, $notificationKey, enable: false);
        return true;
    }


    /**
     * Get lesson and related content metadata for the current user progress.
     * @param int $contentId
     * @param int $userId
     * @return array
     */
    public function getCurrentLessonData(int $contentId, int $userId, bool $isLesson = true, $lessonDocument = null, $challenge = null): ?array
    {
        if ($isLesson) {
            if (!$lessonDocument || !$challenge) {
                $lessonDocument = $this->sanityGateway->getChallengeChildAndParentData($contentId);
                $challenge = $lessonDocument['parent'];
            }
            $challengeLessons = $challenge['lessons'];
        } else {
            $challenge = $this->getChallengeById($contentId);
            $challengeLessons = $challenge['lessons'];
            $lessonDocument = $challenge;
            unset($lessonDocument['lessons']);
        }

        $progressData = ChallengeUserProgress::whereChallengeIdAndUser($challenge['id'], $userId);
        $firstIncompleteLesson = null;
        $isUserActive = $progressData?->is_active ?? false;
        $challengeLessons = $this->combineUserLessonDataWithSanityLessonData($challengeLessons, $progressData);
        $userData = $progressData?->getCompiledMetadata() ?? ['is_active' => false];
        $userData['challenge_state'] = $this->getChallengeState($challenge, $userData['end_date'] ?? null);
        $nextPreviousLesson = ['next_lesson' => null, 'previous_lesson' => null];

        // Assign the formatted lesson to the `lesson` object and add relevant challenge data
        if ($isLesson) { // This is on the lesson's index page
            $nextPreviousLesson = $this->getPreviousAndNextLesson($contentId, $challengeLessons);
            foreach ($challengeLessons as $lesson) {
                if ($lesson['id'] == $contentId) {
                    $lessonDocument = $lesson;
                    break;
                }
            }
            $challengeFieldsToCopyToLesson = ['dark_mode_logo_url', 'light_mode_logo_url', 'logo_image_url', 'title', 'slug', 'instructor'];
            foreach ($challengeFieldsToCopyToLesson as $toCopy) {
                $lessonDocument["challenge_$toCopy"] = $challenge[$toCopy] ?? null;
            }

            // filter related lessons object to contain show incomplete future curriculum lessons.
            if ($isUserActive) {
                $temp = [];
                foreach ($challengeLessons as $lesson) {
                    $isCurriculumLesson = ChallengeUserProgress::isCurriculumSanityLesson($lesson);
                    $isCurrentLesson = $lesson['id'] == $contentId;
                    $isComplete = $lesson['completed'];
                    if ($isCurriculumLesson && !$isCurrentLesson && !$isComplete) {
                        $temp[] = $lesson;
                    }
                }
                $challengeLessons = $temp;
            }
        } else {
            $firstIncompleteLesson = $this->getFirstIncompleteCirriculumLesson($challengeLessons, $progressData);
            $nextPreviousLesson['next_lesson'] = $firstIncompleteLesson;
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

    private function combineUserLessonDataWithSanityLessonData(
        array $lessons,
        ?ChallengeUserProgress $challengeUserProgress,
        bool $removeVideoData = false
    ): array {
        $curriculumDay = 0;
        $previousCurriculumLesson = null;

        $challengeUserProgress = ChallengeUserProgress::shiftUnlockDaysIfRestDayUsed($challengeUserProgress);

        foreach ($lessons as $index => $lesson) {
            $lessons[$index]['is_first_lesson'] = $index == 0;
            $isCurriculumLesson = ChallengeUserProgress::isCurriculumSanityLesson($lesson);
            $dayRexeg = "/Day\s?#?[\d]*\.?[\d]*/";
            preg_match($dayRexeg, $lesson['title'], $matches);
            $shortName = $matches[0] ?? $lesson['title'];
            if (strlen($shortName) > self::MAX_BUTTON_TEXT_LENGTH) {
                $shortName = substr($shortName, 0, self::MAX_BUTTON_TEXT_LENGTH - 3) . '...';
            }
            $lessons[$index]['short_name'] = $shortName;
            if ($isCurriculumLesson) {
                $curriculumDay += 1;
                $lessons[$index]['index'] = $curriculumDay;
            } else {
                $lessons[$index]['index'] = '';
            }
            if ($challengeUserProgress?->is_active ?? false) {
                $lessonDatum = $challengeUserProgress->getMetaDatumForContent($lesson['id']);
                $unlockDate = Carbon::parse($lessonDatum['unlock_date']);

                if ($challengeUserProgress?->is_solo ?? false) {
                    $unlockDate = Carbon::parse($lessonDatum['unlock_date'], UserTimezoneService::getUsersCurrentTimezone());
                }

                $isLocked = $challengeUserProgress->is_locked;
                $isCompleted = $lessonDatum['completed'];
            } else {
                $unlockDate = $lesson['published_on'];
                $isLocked = true;
                $userId = user()?->id ?? $challengeUserProgress->user_id;
                $isCompleted = $this->contentUserProgress::isCompletedByUser($lesson['id'], $userId);
            }

            // For solo challenges, always assume unlock dates are stored in the users local timezone, even if it changes over time.
            if ($challengeUserProgress?->is_solo ?? false) {
                $unlockDate = Carbon::parse($unlockDate)->startOfDay();

                // we must compare based on day without letting Carbon account for timezones
                $unlockDateForComparison = Carbon::createFromFormat('Y-m-d', $unlockDate->toDateString())
                    ->startOfDay();
                // comparing 00:00:00 dates does weird things
                $todayForComparison = Carbon::createFromFormat(
                    'Y-m-d',
                    Carbon::today(UserTimezoneService::getUsersCurrentTimezone())->toDateString()
                )->startOfDay()->addSecond();
                // TODO Rob Adrian Caleb, do we lock the lessons if previous lessons haven't been completed
                // this was vaguely discussed in this thread: https://musoraworkspace.slack.com/archives/C0723ESKW49/p1733173597489469
                $shouldLessonBeLocked = $isLocked && $unlockDateForComparison->greaterThanOrEqualTo($todayForComparison);
            } else {
                // For community challenges, unlock dates are stored in PST so we must convert it to UTC and check
                // against now.
                $shouldLessonBeLocked = Carbon::parse($unlockDate, 'America/Vancouver')->greaterThanOrEqualTo(Carbon::now());

                // now convert the unlock time to the users local timezone
                $unlockDate = Carbon::parse(Carbon::parse($unlockDate, 'America/Vancouver')->timezone(UserTimezoneService::getUsersCurrentTimezone())->toDateTimeString());
            }

            $lessons[$index]['is_locked'] = $shouldLessonBeLocked;
            $lessons[$index]['unlock_date'] = $unlockDate->toISOString();
            $lessons[$index]['completed'] = $isCompleted;
            if ($removeVideoData) {
                unset($lessons[$index]['video']);
            }
            if ($isCurriculumLesson) {
                $previousCurriculumLesson = $lessons[$index];
            }
        }

        return $lessons;
    }

    private function getChallengeState($challenge, $userEndDate = null): string
    {
        $now = Carbon::now();
        return match (true) {
            $challenge['is_solo'] => 'active_solo',
            !is_null($challenge['enrollment_start_time']) && $now < Carbon::parse(
                $challenge['enrollment_start_time']
            ) => 'upcoming',
            $now < Carbon::parse($challenge['published_on']) => 'enrollment',
            $now < $this->getChallengeEndDate($challenge) => 'active_community',
            default => 'completed_community',
        };
    }

    public function getChallengeMetaDataForUserProgress(
        ?array $allChallengeIds,
        mixed $userProgresses,
        bool $returnChallengeData,
        ?string $brand = null
    ): array {
        $resultPackage = [];
        $userProgresses = $userProgresses->keyBy('content_id');
        $challenges = $allChallengeIds ? $this->getChallengeByIds($allChallengeIds, $brand) : $this->getAllChallengesByBrand($brand);
        $challenges = collect($challenges)->keyBy('id');
        foreach ($challenges as $contentId => $challenge) {
            $challengeMetaDataToReturn = null;
            $userProgress = $userProgresses->get($contentId);
            if (!is_null($userProgress)) {
                if ($userProgress->is_active) {
                    $startEndDate = $userProgress->getStartAndEndDate();
                    $challenge['lessons'] = $this->combineUserLessonDataWithSanityLessonData(
                        $challenge['lessons'],
                        $userProgress,
                        removeVideoData: true
                    );

                    $firstIncompleteLesson = $this->getFirstIncompleteCirriculumLesson(
                        $challenge['lessons'],
                        $userProgress
                    );
                    $nextPreviousLessonAroundFirstIncompleteLesson = $this->getPreviousAndNextLesson(
                        $firstIncompleteLesson['id'],
                        $challenge['lessons']
                    );
                    $previousCompletedLesson = $nextPreviousLessonAroundFirstIncompleteLesson['previous_lesson'];

                    if ($challenge['is_solo'] ?? false) {
                        $durationText = $userProgress->is_locked ?
                            $this->getDurationText(
                                Carbon::parse($startEndDate['start_date']),
                                Carbon::parse($startEndDate['end_date'])
                            ) :
                            'Unlocked';
                    } else {
                        $durationText = $this->getDurationText(
                            Carbon::parse($challenge['cohort_start_date']),
                            Carbon::parse($challenge['cohort_end_date'])
                        );
                    }


                    $challengeMetaDataToReturn = [
                        'is_user_enrolled' => true,
                        'is_locked' => $userProgress->is_locked,
                        'progress_percent' => $userProgress->getCompletionPercent(),
                        'duration_text' => $durationText,
                        'is_solo' => $userProgress['is_solo'],
                        'status' => ChallengeUserProgressStatus::ACTIVE,
                        'next_lesson' => $firstIncompleteLesson,
                        'previous_completed_lesson' => $previousCompletedLesson,
                        ... $userProgress->getCompiledMetadata(),
                    ];
                } elseif ($userProgress->isCompleteAndNotActive()) {
                    $durationText = $this->getDurationText(
                        Carbon::parse($challenge['published_on']),
                        $this->getChallengeEndDate($challenge)
                    );
                    $challengeMetaDataToReturn = [
                        'is_user_enrolled' => true,
                        'is_locked' => $userProgress->is_locked,
                        'progress_percent' => 100,
                        'duration_text' => $durationText,
                        'is_solo' => $challenge['is_solo'],
                        'status' => ChallengeUserProgressStatus::COMPLETED,
                        'next_lesson' => null,
                        'previous_completed_lesson' => end($challenge['lessons']),
                    ];
                }
            }
            if (is_null($challengeMetaDataToReturn)) {
                if ($challenge['is_solo'] ?? false) {
                    $durationText = $this->getDurationText(
                        Carbon::parse($challenge['published_on']),
                        $this->getChallengeEndDate($challenge)
                    );
                } else {
                    $durationText = $this->getDurationText(
                        Carbon::parse($challenge['cohort_start_date']),
                        Carbon::parse($challenge['cohort_end_date'])
                    );
                }
                $isEnrolled = !($userProgress?->is_locked ?? true);
                $challengeMetaDataToReturn = [
                    'is_user_enrolled' => $isEnrolled,
                    'is_locked' => $userProgress?->is_locked ?? true,
                    'progress_percent' => 0,
                    'duration_text' => $durationText,
                    'is_solo' => $challenge['is_solo'],
                    'status' => ChallengeUserProgressStatus::NOTSTARTED,
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
                'content_id' => $challenge['id']
            ];

            $resultPackage[] = $challengeMetaDataToReturn;
        }
        return $resultPackage;
    }

    public function getDurationText(Carbon $startDate, Carbon $endDate): string
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
    private function getFirstIncompleteCirriculumLesson($challengeLessons, $progressData)
    {
        foreach ($challengeLessons as $lesson) {
            if ($progressData?->is_active ?? false) {
                foreach ($progressData->lessons_meta_data as $userProgressLesson) {
                    if ($lesson['id'] == $userProgressLesson['content_id']) {
                        $isCurriculumLesson = ChallengeUserProgress::isCurriculumMetadataLesson($userProgressLesson);
                        $isCompleted = $userProgressLesson['completed'];
                        if ($isCurriculumLesson && !$isCompleted) {
                            return $lesson;
                        }
                    }
                }
            } else {
                $isCurriculumLesson = ChallengeUserProgress::isCurriculumSanityLesson($lesson);
                if ($isCurriculumLesson) {
                    return $lesson;
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
    private function getPreviousAndNextLesson($lessonId, $allLessons): array
    {
        $index = array_search($lessonId, Arr::pluck($allLessons, 'id')); // index in the lesson array
        $nextLesson = null;
        $previousLesson = null;
        foreach ($allLessons as $testLessonIndex => $testLesson) {
            if ($testLessonIndex < $index && ChallengeUserProgress::isCurriculumSanityLesson($testLesson)) {
                $previousLesson = $testLesson;
            }
            if ($testLessonIndex > $index && ChallengeUserProgress::isCurriculumSanityLesson($testLesson)) {
                $nextLesson = $testLesson;
                break;
            }
        }
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
    public function getChallengeById($challengeId): array|null
    {
        return $this->sanityGateway->getByRailContentId($challengeId, 'challenge');
    }

    /**
     * Get enrollment Page information from Sanity by slug
     * @param $slug
     * @param $brand
     * @return array | null
     */
    public function getEnrollmentPageData($slug, $brand): array | null
    {
        return $this->sanityGateway->getChallengeEnrollmentPageData($slug, $brand);
    }

    /**
     * Get the sanity Documents for listed challenges
     * @param array $challengeIds
     * @param string $brand
     * @return array | null
     */
    public function getChallengeByIds($challengeIds, ?string $brand = null): array|null
    {
        return $this->sanityGateway->getByRailContentIds($challengeIds, 'challenge', $brand);
    }

    /**
     * Get the sanity Documents for listed challenges
     * @param array $challengeIds
     * @param string $brand
     * @return array | null
     */
    public function getAllChallengesByBrand(string $brand = null): array|null
    {
        return $this->sanityGateway->getAllChallengesByBrand($brand);
    }

    public function completeLessonAndGetCurrentProgressResults($lessonId, $userId, $completedTime = null, $lessonDocument = null, $challenge = null, $userProgress = null): array
    {
        if (!$lessonDocument || !$challenge) {
            $lessonDocument = $this->sanityGateway->getChallengeChildAndParentData($lessonId);
            $challenge = $lessonDocument['parent'];
        }
        if (!$userProgress) {
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challenge['id'], $userId);
            // User has directly accessed a lesson and clicked complete.
            if (!$userProgress) {
                return ['show_modal' => false];
            }
        }
        $wasChallengeCompleted = $userProgress->areAllLessonsCompleted();
        $secondsPracticed = $this->mediaPlaybackService->getSecondsWatchedSince(
            $lessonId,
            $userId,
            Carbon::parse($userProgress->start_date)
        );
        $lessonsProgress = $userProgress->updateLessonsProgress(
            $lessonId,
            isCompleted: true,
            totalSecondsPracticed: $secondsPracticed,
            completedTime: $completedTime
        );
        $isChallengeCompleted = $userProgress->areAllLessonsCompleted();

        $lessonData = $this->getCurrentLessonData($lessonId, $userId, isLesson: true, lessonDocument: $lessonDocument, challenge: $challenge);
        $active = true;
        $motivationalText = [];

        if (!$userProgress->is_locked || !ChallengeUserProgress::isCurriculumSanityLesson($lessonData['lesson'])) {
            $active = false;
        } elseif ($lessonsProgress['is_milestone']) {
            $milestone = $isChallengeCompleted ? 'complete' : $lessonData['user_data']['current_streak'];
            $motivationalTextConfig = config('challengemotivationalresponses')[$milestone] ?? config(
                'challengemotivationalresponses'
            )['default'];
            $motivationalText = [
                'lottie_url' => $motivationalTextConfig[brand()],
                'milestone' => $milestone,
                'motivational_title' => $isChallengeCompleted ? "You've completed {$challenge['title']}!" : "You're on a {$milestone} Day Streak!",
                'motivational_subtext' => $isChallengeCompleted ? '' : "You've earned an additional streak saver!",
                'badge_text' => $motivationalTextConfig['text'],
                'styles' => $motivationalTextConfig['styles'],
                'duration' => $motivationalTextConfig['duration'],
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
                'styles' => null,
                'duration' => null,
            ];
        }
        $userProgress->refresh();
        $userData = $userProgress->getCompiledMetadata();
        if (!$wasChallengeCompleted && $isChallengeCompleted) {
            $this->completeChallenge($userProgress);
        }

        $challengeData = array_intersect_key(
            $lessonData['lesson'],
            array_flip(
                [
                    'challenge_dark_mode_logo_url',
                    'challenge_light_mode_logo_url',
                    'challenge_logo_image_url',
                    'index',
                    'short_name'
                ]
            )
        );
        return [
            'challenge_id' => $challenge['id'],
            'current_lesson_thumbnail' => $lessonDocument['thumbnail'],
            'show_modal' => $active,
            ...$lessonsProgress,
            ...$motivationalText,
            ...$challengeData,
            'user_data' => $userData,
            'next_lesson' => $lessonData['next_lesson']
        ];
    }

    /**
     * @param ChallengeUserProgress $userProgress
     * @return void
     * @throws \Exception
     */
    public function completeChallenge(ChallengeUserProgress $userProgress)
    {
        $today = Carbon::now();
        $bestStreak = max($userProgress->getBestCurrentStreak(), $userProgress->completed_best_streak);
        $bestMinutesPracticed = max($userProgress->getMinutesPracticed(), $userProgress->completed_time_practiced);
        $userProgress->completed_time_practiced = $bestMinutesPracticed;
        $userProgress->completed_best_streak = $bestStreak;
        $userProgress->last_completed_date = $today->toISOString();
        $userProgress->is_active = false;
        $userProgress->hide_completed_banner = false;
        $userProgress->save();
        $this->unlockChallenge($userProgress->content_id, $userProgress->user_id);
    }

    public function unlockChallenge($id, $userId): ChallengeUserProgress|null
    {
        return $this->startChallenge(
            $id,
            $userId,
            startDate: \Illuminate\Support\Carbon::now()->toISOString(),
            isLocked: false
        );
    }

    private function updateCustomerIONotifications(int $challengeId, User $user, UserNotificationKeys $notificationKey, bool $add = true): void
    {
        $musoraWorkspace = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
        $customerIO = $this->customerIoService->getCustomerByEmail($musoraWorkspace, $user->email);
        if (is_null($customerIO)) {
            return;
        }
        $existingNotifications = json_decode($customerIO->getExternalAttributes()[$notificationKey->value] ?? '[]');
        if ($add) {
            if (!in_array($challengeId, $existingNotifications)) {
                $existingNotifications[] = $challengeId;
            }
        } else {
            unset($existingNotifications[$challengeId]);
        }
        $data = [$notificationKey->value => $existingNotifications];
        $this->customerIoService->createOrUpdateCustomerByUserId(
            $user->id,
            $musoraWorkspace,
            $user->email,
            $data,
            $user->created_at->timestamp
        );
    }

    public function isUserNotifiedForChallenge(int $challengeId, ?User $user, UserNotificationKeys $notificationKey): bool
    {
        if (!$user) {
            return false;
        }
        $existingNotifications = $user[$notificationKey->value] ?? [];
        return in_array($challengeId, $existingNotifications);
    }


    /**
     * Return the date of the last day of the challenge
     * @param array $challenge - Sanity challenge document
     * @return Carbon|null
     */
    public function getChallengeEndDate(array $challenge): Carbon|null
    {
        $startDate = Carbon::parse($challenge['published_on']);
        $dayCount = -1;
        foreach ($challenge['lessons'] as $child) {
            $dayCount += $child['is_always_unlocked_for_challenge'] ?? false ? 0 : 1;
        }
        return $startDate->copy()->addDays($dayCount);
    }

    /**
     * @param int $challengeId
     * @param int $userId
     * @return bool
     * @throws \Exception
     */
    public function hideCompletedBanner(int $challengeId, int $userId): bool
    {
        $progress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
        if (is_null($progress?->last_completed_date)) {
            return false;
        }
        $progress->hide_completed_banner = true;
        $progress->save();
        return true;
    }

    public function getOwnedChallenges(): \Illuminate\Support\Collection
    {
        $ownedProductIds = $this->userAccessPermissionsService->getOwnedChallengeProductIds();
        if (count($ownedProductIds) == 0) {
            return collect();
        }
        $challenges = collect($this->sanityGateway->getAllByType('challenge', 10000));
        $ownedChallenges = $challenges->whereNotNull('product_id')->whereIn('product_id', $ownedProductIds);
        return $ownedChallenges;
    }

    private function updateChallengesNotificationForUser(int $challengeId, User $user, UserNotificationKeys $key, bool $enable = true)
    {
        try {
            $existingNotifications = $user[$key->value] ?? [];
            if ($enable) {
                if (!in_array($challengeId, $existingNotifications)) {
                    $existingNotifications[] = $challengeId;
                }
            } else {
               unset($existingNotifications[$challengeId]);
            }
            $user[$key->value] = $existingNotifications;
            $user->save();
        } catch (\Exception $ex) {
        }
    }

    public function updateNotification(int $challengeId, User $user, UserNotificationKeys $key, bool $enable = true)
    {
        $this->updateChallengesNotificationForUser($challengeId, $user, $key, enable: $enable);
        $this->updateCustomerIONotifications($challengeId, $user, $key, add: $enable   );
    }

    public function enableNotificationsForSoloChallengeAndClearProcessFlag(ChallengeUserProgress $userProgress): void
    {
        if (!$userProgress->solo_notification_to_be_processed) {
            return;
        }
        try {
            $this->updateNotification($userProgress->content_id, $userProgress->user, UserNotificationKeys::SOLO_NOTIFICATION_KEY);
            $userProgress->solo_notification_to_be_processed = 0;
            $userProgress->save();
        } catch (\Exception $ex) {
        }
    }
}
