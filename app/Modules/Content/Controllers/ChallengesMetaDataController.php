<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ChallengeUserProgress;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\Content\Services\ChallengesService;

class ChallengesMetaDataController extends Controller
{
    public function __construct(
        private ChallengesService $challengesService,
    )
    {
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
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getUserAward($id)
    {
        $challenge = $this->challengesService->getChallengeById($id);
        $user = user();
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($id, $user->id);
        // what's the correct handling here? this shouldn't happen
        if (is_null($userProgress->last_completed_date)) {
            return null;
        }
        $lastCompleted = Carbon::parse($userProgress->last_completed_date);
        $lastCompleted = $lastCompleted->toFormattedDateString();
        $tier = $userProgress->getAwardTier()->value;
        $award = $challenge["{$tier}_award"];
        //TODO how to handle images/make pretty?
        // https://musora.atlassian.net/browse/TCH-46
        $userAwardPDF = Pdf::loadView("awards.award-template", [
            'user_name' => $user->display_name,
            'streak' => $userProgress->completed_best_streak,
            'minutes_practiced' => $userProgress->completed_time_practiced,
            'date_completed' => $lastCompleted,
            'challenge_title' => $challenge['title'],
            'award' => $award,
            'award_text' => $challenge['award_custom_text'],
            'tier' => $tier,
            'instructor_signature' => $challenge['instructor_signature'],
        ]);
        $today = Carbon::now()->toDateString();
        $challengeName = $challenge['slug'];
        $fileName = "$challengeName-$today.pdf";
        return  $userAwardPDF->stream($fileName);
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

