<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\CohortService;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Modules\Content\Services\ChallengesService;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Services\UserPermissionsService;

class ChallengesMetaDataController extends Controller
{
    public function __construct(
        private ChallengesService $challengesService,
        private CohortService $cohortService,
        private ProductService $productService,
        private UserAccessPermissionsService $userAccessPermissionsService,
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
        // TODO TCH-56 this needs to be updated to pull all data from sanity instead of nova (and the cohort table).
        // this is the just the first pass so we can start testing enrollment
        $cohort = $this->cohortService->getCohort($slug);
        if (!$cohort) {
            abort(404);
        }
        $challengeId = $cohort['content_id'];
        $today = now()->startOfDay()->format('Ymd');
        $registerButtonUrl = url()->route('challenges.set_start_date', ['id' => $challengeId, 'start_date', $today]);
        $content = $this->challengesService->getChallengeById($challengeId);
        $nPackOwners =  $this->challengesService->getActiveUsersCount($challengeId);
        $cohort['course_url'] = $content['web_url_path'];
        $isEnrolled = user() ? ChallengeUserProgress::whereChallengeIdAndUser($challengeId, user()->id)?->is_active ?? false : false;
        //$productId = $cohort['product_id'];
        //$hasProduct = user() && $this->userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        // below here is where things need to be refactored

        // TODO TCH-56 this needs to be updated to pull all data from sanity instead of nova (and the cohort table).
        $enrollmentClosedDate = Carbon::parse($content['enrollment_end_date']);
        $enrollmentClosed = false; // $enrollmentClosedDate >= Carbon::now();
        $cohort['is_solo'] = $content['is_solo'] ?? false;

        $cohort['conversation_url'] =
            $cohort['conversation_thread_id'] ?
                url()->route('forums.jump-to-thread', ['threadId' => $cohort['conversation_thread_id']]) : '';
        $cohort['timeline_image_url'] =
            config('railcontent.cohort_timeline_image_urls')[brand()]
            ??
            config('railcontent.cohort_timeline_image_urls')['pianote'];

        $lists = $cohort->lists;
        foreach ($lists as $list) {
            $list->description = preg_replace('/{' . 'enrolled' . '}/', $nPackOwners, $list->description);
        }
        $cohort->lists = $lists;

        if ($cohort['custom_cohort'] == true) {
            $view = 'content.cohort-template-mk';
        } else {
            $view = 'content.cohort-template';
        }


        return view($view, [
            'hasProduct' => $isEnrolled,
            'nPackOwners' => $nPackOwners,
            'registerButtonUrl' => $registerButtonUrl,
            'brand' => brand(),
            'cohort' => $cohort,
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
        $resultPackage = $this->challengesService->getChallengeMetaDataForUserProgress($challengeIds, $userProgresses, true, $brand);
        return response()->json($resultPackage);
    }

    /**
     * @param $id - Challenge railcontent id
     * @return JsonResponse
     */
    public function getChallengeMetadata($id)
    {

        $enrolledUsersAndCount = $this->challengesService->getEnrolledUsers($id);
        $enrolledUsers = $enrolledUsersAndCount['users'];
        // TODO https://musora.atlassian.net/browse/TCH-51
        // Decorate these using a decorator (api resource) instead of raw
        $formattedUsers = $enrolledUsers->map(function ($user) {
            return collect($user->toArray())
                ->only(['id', 'email', 'display_name', 'profile_picture_url'])
                ->all();
        });
        $response = [
            'entity' => $formattedUsers,
            'total' => $enrolledUsersAndCount['total'],
        ];
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
        $contentIds = $request->get('content_ids', '');
        $contentIds = explode(',', $contentIds);
        if (!$contentIds) {
            return response()->json([]);
        }
        $userProgresses = ChallengeUserProgress::whereChallengeIdsAndUser($contentIds, $userId);
        $brand = $request->get('brand', brand());
        $resultPackage = $this->challengesService->getChallengeMetaDataForUserProgress($contentIds, $userProgresses, false, $brand);
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
        $userId = user()->id;
        $result = $this->challengesService->startChallenge($id, $userId);
        if (is_null($result)) {
            return response()->json(['error' => "Challenge $id not found"], status: 404);
        }
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
        $userId = user()->id;
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($id, $userId);
        if (is_null($userProgress)) {
            return response()->json(['error' => "Challenge $id not found"], status: 404);
        }
        $userProgress->leaveChallenge();
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
        $result = $this->challengesService->startChallenge($id, $userId, startDate: Carbon::now()->toISOString(), isLocked: false);
        if (is_null($result)) {
            return response()->json(['error' => "Challenge $id not found"], status: 404);
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
        //TODO move this to users timezone
        // Explicitly set to start of day
        // https://musora.atlassian.net/browse/TCH-40
        $startDate = \Carbon\Carbon::parse($request->get('start_date'));
        $this->challengesService->startChallenge($id, $userId, startDate: $startDate);
        return response()->json();
    }

    /**
     * Return all badges a user has completed
     * @return JsonResponse
     */
    public function getUserBadges(Request $request)
    {
        $user = user();
        $userId = $user->id;
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $challengeProgress = ChallengeUserProgress::whereUserIdAndCompleted($userId, $page, $limit);
        if ($challengeProgress->isEmpty()) {
            return response()->json([]);
        }
        $challengeIds = $challengeProgress->pluck('content_id')->toArray();
        $brand = $request->get('brand', brand());
        $challenges = $this->challengesService->getChallengeByIds($challengeIds, $brand);
        $badges = [];
        $completedDates = $challengeProgress->pluck('last_completed_date', 'content_id')->toArray();
        arsort($completedDates);
        foreach($challengeProgress as $progress) {
            foreach($challenges as $challenge) {
                if ($progress->content_id == $challenge['id']) {
                    $badges[] = $this->getUserAwardData($challenge, $progress, $user);
                    break;
                }
            }
        }
        return response()->json($badges);
    }


    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function getUserAward($id)
    {
        $challenge = $this->challengesService->getChallengeById($id);
        $user = user();
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($id, $user->id);
        // what's the correct handling here? this shouldn't happen
        if (is_null($userProgress->last_completed_date)) {
            return  response()->json([]);
        }
        return  response()->json($this->getUserAwardData($challenge, $userProgress, $user));
    }

    private function getUserAwardData($challenge, $userProgress, $user)
    {
        $tier = $userProgress->getAwardTier()->value;
        $lastCompleted = Carbon::parse($userProgress->last_completed_date);
        $lastCompleted = $lastCompleted->toFormattedDateString();

        $ribbonUrl = "https://d3fzm1tzeyr5n3.cloudfront.net/challenges/{$tier}_ribbon.png";
        $musoraTextLogoUrl = 'https://d3fzm1tzeyr5n3.cloudfront.net/challenges/on_musora.png';
        $brandUrl = match($challenge['brand']) {
            'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png',
            'singeo' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png',
            'guitareo' => 'https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png',
            'pianote' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/marketing/pianote/membership/homepage/2023/pianote-logo-red.png'
        };
        $imageValues = [
            'award' => $challenge["{$tier}_award"],
            'instructor_signature' =>  $challenge['instructor_signature'],
            'musora_logo' => $musoraTextLogoUrl,
            'brand_logo' => $brandUrl,
            'ribbon_image' => $ribbonUrl,
        ];
        foreach($imageValues as $key => $url) {
            $file = $url ? file_get_contents($url) : '';
            $imageValues[$key . '_64'] = base64_encode($file);
        }

        return [
            'user_name' => $user->display_name,
            'streak' => $userProgress->completed_best_streak,
            'minutes_practiced' => $userProgress->completed_time_practiced,
            'date_completed' => $lastCompleted,
            'challenge_title' => $challenge['title'],
            'award_text' => $challenge['award_custom_text'],
            'tier' => $tier,
            'title' => $challenge['title'],
            'badge' => $challenge['badge'],
            'id' => $challenge['id'],
            ... $imageValues,
        ];
    }

    /**
     * Get all challenges the user has started or purchased
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getOwnedChallenges(Request $request)
    {
        $userId = user()->id;
        $brand = $request->get('brand', brand());
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $completedChallenges = ChallengeUserProgress::whereUserId($userId, $page, $limit);
        if (!$completedChallenges) {
            return response()->json([]);
        }
        $completedIds = $completedChallenges->pluck('content_id')->toArray();
        $challenges = $this->challengesService->getChallengeByIds($completedIds, $brand);
        $output = [
            'entity' => $challenges,
            'total' => count($challenges),
        ];
        return response()->json($output);
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
        $brand = $request->get('brand', brand());
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $completedChallenges = ChallengeUserProgress::whereUserIdAndCompleted($userId, $page, $limit);
        if (!$completedChallenges) {
            return response()->json([]);
        }
        $completedIds = $completedChallenges->pluck('content_id')->toArray();
        $challenges = $this->challengesService->getChallengeByIds($completedIds, $brand);
        $output = [
            'entity' => $challenges,
            'total' => count($challenges),
        ];
        return response()->json($output);
    }

    /**
     * Notify the user when enrollment opens for a given challenge
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function notificationsEnrollmentOpen(int $id): JsonResponse
    {
        return $this->enableNotification($id, ChallengesService::ENROLLMENT_NOTIFICATION_KEY) ?
            response()->json() :
            response()->json(['error' => "Challenge $id not found"], status: 404);
    }

    /**
     * Notify the user for community notifications
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function notificationsCommunityReminders(int $id): JsonResponse
    {
        return $this->enableNotification($id, ChallengesService::COMMUNITY_NOTIFICATION_KEY) ?
            response()->json() :
            response()->json(['error' => "Challenge $id not found"], status: 404);
    }

    private function enableNotification($id, $key): bool
    {
        $challenge = $this->challengesService->getChallengeById($id);
        if (is_null($challenge)) {
            return false;
        }
        $this->challengesService->updateCustomerIONotifications($id, user(), $key);
        return true;
    }
}
