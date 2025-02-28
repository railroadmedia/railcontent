<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\UserNotificationKeys;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use App\Modules\Content\Services\ChallengesAwardService;
use App\Modules\Content\Services\ChallengesService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;

class ChallengesMetaDataController extends Controller
{
    public function __construct(
        private ChallengesService $challengesService,
        private ChallengesAwardService $challengesAwardService,
    ) {
    }

    /**
     * @param Request $request
     * @param $slug
     * @param $purchased
     * @return View
     */
    public function enrollmentPage(Request $request, $slug, $purchased = false): View
    {
        $enrollmentPageData = $this->challengesService->getEnrollmentPageData($slug, brand());
        if (!$enrollmentPageData || $enrollmentPageData['need_access']) {
            abort(404);
        }
        $challengeId = $enrollmentPageData['id'];
        $nPackOwners = $this->challengesService->getActiveUsersCount($challengeId);

        $userProgress = user() ? ChallengeUserProgress::whereChallengeIdAndUser(
            $challengeId,
            user()->id
        ) : null;

        $isEnrolled = $userProgress?->is_active ?? false;
        $hasCompletedChallenge = !is_null($userProgress?->last_completed_date);
        if ($hasCompletedChallenge) {
            $lastCompletionDate = $userProgress?->last_completed_date->toISOString();
        }

        $isNotified = $this->challengesService->isUserNotifiedForChallenge($challengeId, user(), UserNotificationKeys::ENROLLMENT_NOTIFICATION_KEY);
        $enrollmentClosedDate = Carbon::parse($enrollmentPageData['enrollment_end_time']);
        $enrollmentClosed = !$enrollmentPageData['is_solo'] && $enrollmentClosedDate < Carbon::now();

        $enrollmentPageData['conversation_url'] =
            $enrollmentPageData['conversation_thread_id'] ?
                url()->route('forums.jump-to-thread', ['threadId' => $enrollmentPageData['conversation_thread_id']]) : '';
        $enrollmentPageData['timeline_image_url'] =
            config('railcontent.cohort_timeline_image_urls')[brand()]
            ??
            config('railcontent.cohort_timeline_image_urls')['pianote'];
        $enrollmentPageData['has_completed_challenge'] = $hasCompletedChallenge;
        $enrollmentPageData['is_notified'] = $isNotified;
        if ($hasCompletedChallenge) {
            $enrollmentPageData['last_completion_date'] = $lastCompletionDate;
        }
        if (!is_null($enrollmentPageData['cohort_start_date']) && !is_null($enrollmentPageData['cohort_end_date'])) {
            $enrollmentPageData['duration_text'] = $this->challengesService->getDurationText(Carbon::parse($enrollmentPageData['cohort_start_date']), Carbon::parse($enrollmentPageData['cohort_end_date']));
        }
        $view = false && $enrollmentPageData['custom_cohort'] ? 'content.cohort-template-mk' : 'content.cohort-template';

        return view($view, [
            'hasProduct' => $isEnrolled,
            'nPackOwners' => $nPackOwners,
            'brand' => brand(),
            'cohort' => $enrollmentPageData,
            'enrollmentClosed' => $enrollmentClosed,
            'homeUrl' => url()->route('platform.home', ['brand' => brand()]),
            'purchased' => $purchased,
            'recaptchaKey' => config('recaptcha.key'),
        ]);
    }

    /**
     * Return challenge and user data for all user's active challenges (of that brand)
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getActiveChallengesForUser(Request $request)
    {
        $userId = user()->id;
        $userProgresses = ChallengeUserProgress::whereUserIdAndActive($userId);
        if ($userProgresses->isEmpty()) {
            return response()->json([]);
        }
        $brand = $request->get('brand', brand());
        $challengeIds = $userProgresses->pluck('content_id')->toArray();
        $resultPackage = $this->challengesService->getChallengeMetaDataForUserProgress(
            $challengeIds,
            $userProgresses,
            true,
            $brand
        );
        return response()->json($resultPackage);
    }

    /**
     * @param $id - Challenge railcontent id
     * @return JsonResponse
     */
    public function getChallengeMetadata($id)
    {
        $response = $this->challengesService->getEnrolledUsersMetadata($id);
        return response()->json($response);
    }

    /**
     * @param $id - Challenge railcontent id
     * @return JsonResponse
     */
    public function completeLesson($id)
    {
        $userId = user()->id;
        $completionData = $this->challengesService->completeLessonAndGetCurrentProgressResults($id, $userId);
        return response()->json($completionData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getChallengesMetadataForIndexPage(Request $request)
    {
        $userId = user()->id;
        $userProgresses = ChallengeUserProgress::whereUserId($userId);
        $brand = $request->get('brand', brand());
        $resultPackage = $this->challengesService->getChallengeMetaDataForUserProgress(
            null,
            $userProgresses,
            false,
            $brand
        );
        return response()->json($resultPackage);
    }

    /**
     * @param $id - Challenge railcontent id
     * @return JsonResponse
     */
    public function getUserChallengeProgress(int $id)
    {
        return response()->json($this->challengesService->getCurrentLessonData($id, user()->id, isLesson: false));
    }

    /**
     * @param $id - Challenge railcontent id
     * @return JsonResponse
     */
    public function getAllProgressDataForUser(int $id)
    {
        return response()->json($this->challengesService->getAllProgressDataForUser($id));
    }


    /**
     * @param $id - Lesson railcontent id
     * @return JsonResponse
     */
    public function getChallengeLessons(int $id)
    {
        return response()->json($this->challengesService->getCurrentLessonData($id, user()->id, isLesson: true));
    }


    /**
     * @param $id - Challenge railcontent id
     * @return JsonResponse
     */
    public function enrollUser(int $id)
    {
        return $this->enrollUserById(user()->id, $id);
    }

    /**
     * @param $user_id - user id
     * @param $challenge_id - Challenge railcontent id
     * @return JsonResponse
     */
    public function enrollUserAdmin(int $user_id, int $challenge_id)
    {
        if (!user()->isAdmin()) {
            return response()->json(['error' => "user must be an administrator to enroll other users"], status: 403);
        }
        return $this->enrollUserById($user_id, $challenge_id);
    }

    /**
     * Enroll user in challenge and fire c.io event
     * @param int $userId - user to enroll
     * @param int $challengeId - challenge to enroll in
     * @return JsonResponse
     */
    private function enrollUserById(int $userId, int $challengeId) : JsonResponse
    {
        $challenge = $this->challengesService->getChallengeById($challengeId);
        $startDate = ($challenge['is_solo'] ?? false) ? Carbon::now() : null;
        $result = $this->challengesService->startChallenge($challengeId, $userId, $startDate);
        if (is_null($result)) {
            return response()->json("Challenge $challengeId not found", status: 404);
        }

        CustomerIoCreateEventByUserId::dispatchAfterResponse(
            $userId,
            accountName: config('event-data-synchronizer.customer_io_account_to_sync_all_brands'),
            eventName: 'challenge_enrolled',
            eventData: [
                'challenge_id' => $challengeId,
                'brand' => $challenge['brand'] ?? 'musora',
            ],
            eventTimestamp: Carbon::now()->timestamp
        );

        return response()->json();
    }

    /**
     * Clear User Progress for given challenge
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function leaveChallenge(int $id): JsonResponse
    {
        $user = user();
        if (!$this->challengesService->leaveChallenge($id, $user)) {
            return self::NotFoundErrorResponse($id, $user->id);
        }
        return response()->json();
    }

    /**
     * Unlock all content
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function unlockChallenge(int $id): JsonResponse
    {
        $userId = user()->id;
        $result = $this->challengesService->unlockChallenge($id, $userId);
        if (is_null($result)) {
            return self::NotFoundErrorResponse($id, $userId);
        }
        return response()->json();
    }

    /**
     * Update user's start date, this will reset any progress the user has in the current challenge
     * @param int $userId - user id
     * @param int $contentId - Challenge id
     * @param $startDate - date the user will start the challenge
     * @param $isLocked - flag to indicate if content should be gated by time
     * @return JsonResponse
     */
    public function setStartDate(Request $request, int $id): JsonResponse
    {
        $userId = user()->id;

        // Start date MUST always be stored in the users local timezone. Even if the UTC time is 24-12-01 01:00:00,
        // if the users timezone is UTC offset -5 when they start, we must store: 24-11-31 00:00:00
        // this ensures that the unlock days are stored properly in the DB when converted to any future timezone
        // the student may be in.
        $startDate = Carbon::parse($request->get('start_date'))->startOfDay()->toISOString();

        $this->challengesService->startChallenge($id, $userId, startDate: $startDate);

        return response()->json();
    }

    /**
     * Return all badges a user has completed
     * @return JsonResponse
     */
    public function getUserBadges(Request $request): JsonResponse
    {
        $user = user();
        $userId = $user->id;
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $challengeProgress = ChallengeUserProgress::whereUserIdAndCompleted($userId, $page, $limit);
        if ($challengeProgress->isEmpty()) {
            return response()->json([]);
        }
        $challengeProgress->sortByDesc('last_completed_date');
        $badges = $this->challengesAwardService->getBadgesData($challengeProgress, brand());
        return response()->json($badges);
    }


    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function getUserAward($id): JsonResponse
    {
        $challenge = $this->challengesService->getChallengeById($id);
        $user = user();
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($id, $user->id);
        if (!$userProgress) {
            return self::NotFoundErrorResponse($id, $user->id);
        }
        return response()->json(
            $this->challengesAwardService->getUserAwardData($challenge, $userProgress, $user, includeBase64: true)
        );
    }

    /**
     * Get all challenges the user has started or purchased
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getOwnedChallenges(Request $request)
    {
        $ownedChallenges = $this->challengesService->getOwnedChallenges();
        $ownedChallengeIds = $ownedChallenges->pluck('id')->toArray();
        return response()->json($ownedChallengeIds);
    }

    /**
     * Get all challenges the user has completed
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getCompletedChallenges(Request $request)
    {
        $userId = user()->id;
        $completedChallenges = ChallengeUserProgress::whereUserIdAndCompleted($userId, limit: 1000);
        $completedIds = $completedChallenges->pluck('content_id')->toArray();
        return response()->json($completedIds);
    }

    /**
     * Notify the user when enrollment opens for a given challenge
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function notificationsEnrollmentOpen(int $id): JsonResponse
    {
        return $this->enableNotification($id, UserNotificationKeys::ENROLLMENT_NOTIFICATION_KEY) ?
            response()->json() :
            self::NotFoundErrorResponse($id);
    }

    /**
     * Notify the user for community notifications
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function notificationsCommunityReminders(int $id): JsonResponse
    {
        return $this->enableNotification($id, UserNotificationKeys::COMMUNITY_NOTIFICATION_KEY) ?
            response()->json() :
            self::NotFoundErrorResponse($id);
    }

    /**
     * Notify the user for solo notifications
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function notificationsSoloReminders(int $id): JsonResponse
    {
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($id, user()->id);
        if (!$userProgress) {
            return self::NotFoundErrorResponse($id);
        }
        $userProgress->solo_notification_to_be_processed = 1;
        $userProgress->save();
        return response()->json();

    }

    private function enableNotification($id, UserNotificationKeys $key): bool
    {
        $challenge = $this->challengesService->getChallengeById($id);
        if (is_null($challenge)) {
            return false;
        }
        $user = user();
        $this->challengesService->updateNotification($id, $user, $key);
        return true;
    }

    /**
     * Hide Badge Banner
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function hideCompletedBadge(int $id): JsonResponse
    {
        $userId = user()->id;
        return $this->challengesService->hideCompletedBanner($id, $userId) ?
            response()->json() :
            response()->json(['error' => "Challenge $id not found or not complete for user $userId"], status: 404);
    }

    private static function NotFoundErrorResponse(int $challengeId, ?int $userId = null): JsonResponse
    {
        $userId = $userId ?? user()->id;
        return response()->json(['error' => "Challenge $challengeId not found for user $userId"], status: 404);
    }
}
