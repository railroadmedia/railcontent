<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ChallengeUserProgress;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Modules\Content\Services\ChallengesService;
use Railroad\Railcontent\Services\UserContentProgressService;

class ChallengesMetaDataController extends Controller
{
    public function __construct(
        private ChallengesService $challengesService,
        private UserContentProgressService $userContentProgressService,
    )
    {
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
        if ($userProgresses->isEmpty()) return response()->json([]);
        $brand = $request->get('brand', brand());
        $resultPackage = $this->challengesService->getChallengeMetaDataForUserProgress($userProgresses, true, $brand);
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
        if (!$contentIds) return response()->json([]);
        $userProgresses = ChallengeUserProgress::whereChallengeIdsAndUser($contentIds, $userId);
        $brand = $request->get('brand', brand());
        $resultPackage = $this->challengesService->getChallengeMetaDataForUserProgress($userProgresses, false, $brand);
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
    public function leaveChallenge(int $id) : JsonResponse
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
    public function unlockChallenge(int $id) : JsonResponse
    {
        $userId = user()->id;
        $result = $this->challengesService->startChallenge($id, $userId, isLocked: false);
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
    public function setStartDate(Request $request, int $id) : JsonResponse
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
        $challengeProgress = ChallengeUserProgress::whereUserIdAndCompleted($userId);
        if ($challengeProgress->isEmpty()) return response()->json([]);
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
     * Notify the user when enrollment opens for a given challenge
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function notificationsEnrollmentOpen(int $id) : JsonResponse
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
    public function notificationsCommunityReminders(int $id) : JsonResponse
    {
        return $this->enableNotification($id, ChallengesService::COMMUNITY_NOTIFICATION_KEY) ?
            response()->json() :
            response()->json(['error' => "Challenge $id not found"], status: 404);
    }

    private function enableNotification($id, $key) : bool
    {
        $challenge = $this->challengesService->getChallengeById($id);
        if (is_null($challenge)) {
            return false;
        }
        $this->challengesService->updateCustomerIONotifications($id, user(), $key);
        return true;
    }
}

