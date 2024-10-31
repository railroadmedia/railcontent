<?php

namespace App\Modules\DevEndpoint\Controllers;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Google\Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Content\Services\ChallengesService;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Services\APIEndPoint;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Services\RecommendationService;

class DevEndpointController extends Controller
{
    use AuthorizesRequests;

    /**
     * ContentRedirectController constructor.
     */
    public function __construct(
        private RecommendationService $recommendationService,
        private ContentService $contentService,
        private PermissionService $permissionService,
        private ContentPermissionService $contentPermissionService,
        private ContentPermissionRepository $contentPermissionRepository,
        private ChallengesService $challengesService,
        private CustomerIoSyncService $customerIoSyncService,
        private UserService $userService,
        private SanityGateway $sanityGateway,
    ) {
    }

    public function handleRequest(Request $request, $arg1 = null)
    {
        if ($arg1 == 'challenges') {
            return $this->handleChallengesEndpoints($request);
        }
        return view("pages.devendpoint", ['results' => 'some results here', 'json_results' => ['key1' => 'value1']]);

    }

    private function handleChallengesEndpoints($request) : string
    {
        $action = $request->get('action');
        $userId = $request->get('user_id', user()?->id ?? 631736); // adrian@musora.com
        $challengeId = $request->get('challenge_id', 402199); // https://web-staging-one.musora.com/admin/studio/publishing/structure/challenge;challenge_402199
        switch($action) {
            case ('prep'):
                $this->prepChallengeData($challengeId, $request->get('start_date', null));
                return "Prepped Challenge Data $challengeId";
            case ('complete');
                $this->challengesService->completeChallenge($challengeId, $userId);
                return "Completed Challenge $challengeId for user $userId";
            case('complete_lessons'):
                $this->setContentCompleted($challengeId, $userId);
                return "Content Completed: $challengeId for user $userId";
            case('move_days'):
                $numDays = $request->get('num_days', 1);
                $progress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
                $startDate = Carbon::parse($progress->start_date);
                $newStartDate = $startDate->subDays($numDays);
                $challenge = $this->challengesService->getChallengeById($challengeId);

                $newLessonData = ChallengeUserProgress::defineLessonsMetaData($challenge, $newStartDate);
                $originalProgress = $progress->lessons_meta_data;
                foreach($progress->lessons_meta_data as $index => $_) {
                    $originalProgress[$index]['unlock_date'] = $newLessonData[$index]['unlock_date'];
                }
                $progress->lessons_meta_data = $originalProgress;
                $progress->start_date = $newStartDate->toISOString();
                $progress->save();
                $challengeName = $challenge['title'];
                return "Start date for $challengeName for user: $userId moved to {$newStartDate->toISOString()}. Completed lessons and practice time maintained";
            case('clean'):
                ChallengeUserProgress::truncate();
                return "All challenge data cleared";
        }
        return '';
    }

    private function prepChallengeData($challengeId, $startdate = null)
    {
        $userIds = [
            // "good" users
            755987,755984,755976,755957,755953,755945,755932,755919,755916,755904,755886,755880,755877,755866,755848,755827,755824,755820,755808,755807,755799,755787,755786,755782,755764,
            755675, // explicitly in block list
            755745, // user with no profile picture
            755406, // musora user
            735658, //eli test user
            631736, // me
        ];
        ChallengeUserProgress::truncate();
        foreach($userIds as $userId) {
            $isUnlocked = $userId == 755976 || $userId == 755957;
            $this->challengesService->startChallenge($challengeId, $userId, startDate: $startdate, isLocked: !$isUnlocked);
        }

    }

    private function testStreakData($challengeId)
    {
        $userId = 631736;
        $data = [];
        $startDate = '20241010';
        $this->challengesService->startChallenge($challengeId, $userId, $startDate);
        $this->setContentCompleted($challengeId);
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);

        $progressData = $userProgress->getStreakCurrentData();
        $data[] = $progressData;
        for($i = 0; $i < 8; $i++) {
            $userProgress = $this->setUserProgressBackDays($userProgress);
            $progressData = $userProgress->getStreakCurrentData();
            $data[] = $progressData;
        }

//        $startDate = '20241011';
//        $this->challengesService->startChallenge($challengeId, $userId, $startDate);
//        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
//        $progressData = $userProgress->getStreakCurrentData();
//        $data[] = $progressData;

        return $data;
    }

    private function setUserProgressBackDays($userProgress, int $days = 1)
    {
        $oStartDate = Carbon::parse($userProgress->start_date);
        $oStartDate = $oStartDate->subDays($days);
        $oLessonData = $userProgress->lessons_meta_data;
        $userProgress->start_date = $oStartDate->toISOString();
        foreach($oLessonData as $index => $lessonDatum) {
            $oUnlockDate = Carbon::parse($lessonDatum['unlock_date']);
            $oUnlockDate = $oUnlockDate->subDays($days);
            $oLessonData[$index]['unlock_date'] = $oUnlockDate->toISOString();
        }
        $userProgress->lessons_meta_data = $oLessonData;
        $userProgress->save();
        return $userProgress;
    }

    private function setContentCompleted($challengeId)
    {

        $data = [
//            755987 => [
//                '402542' => [
//                    'is_completed' => true,
//                    'time_practiced' => 8,
//                ],
//                '402314' => [
//                    'is_completed' => true,
//                    'time_practiced' => 3,
//                ],
//            ],
            631736 => [
                '402542' => [
                    'is_completed' => true,
                    'time_practiced' => 8,
                ],
                '402314' => [
                    'is_completed' => true,
                    'time_practiced' => 10,
                ],
                '402316' => [
                    'is_completed' => true,
                    'time_practiced' => 1000,
                ],
                '402318' => [
                    'is_completed' => false,
                    'time_practiced' => 1000,
                ],
                '402320' => [
                    'is_completed' => false,
                    'time_practiced' => 1000,
                ],
                '402322' => [
                    'is_completed' => true,
                    'time_practiced' => 1000,
                ],
                '402324' => [
                    'is_completed' => true,
                    'time_practiced' => 1000,
                ],
                '402326' => [
                    'is_completed' => true,
                    'time_practiced' => 1000,
                ],
                '402328' => [
                    'is_completed' => true,
                    'time_practiced' => 1000,
                ],
            ],
        ];

        foreach($data as $userId => $lessons) {
            $challengeProgress =  ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
            foreach($lessons as $lessonId => $lesson) {
                $challengeProgress->updateLessonsProgress($lessonId, $lesson['is_completed'], $lesson['time_practiced']);
            }
        }

    }

    private function unlockChallenge($challengeId, $userId)
    {
        $progressData = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
        $progressData->is_locked = false;
        $progressData->save();
    }



    private function testSanity()
    {
        $client = new SanityGateway();
        return $client->getChildrenByRailcontentID(206303);
        $documents = $client->getByRailContentIds([206303], includeParents: true);
        return 'eehhh';
        $songId = 'drafts.ae22572b-6219-4d8f-ba6e-aaa86c29036a'; // Head like a hole
        $licenceId = 'drafts.044f865a-5e1d-4477-aa8a-7cc783acc903'; // Let it Be (test license
        $publisherId = 'drafts.9b7840ff-a2ff-4a85-bab3-589d94bda677'; //Disney on development
        $updatedDoc = $client->patchSetSingle('044f865a-5e1d-4477-aa8a-7cc783acc903', ['mlc' => 'new mlc2']);
        $updatedDoc = $client->patchSetSingle($songId, ['popularity' => 200]);
        $updatedDoc = $client->patchSetSingle($publisherId, ['name'  => 'Disney2']);
        $updatedDoc = $client->patchAppend($publisherId, 'child', [['name' => 'bananas']]);
        $updatedDoc = $client->patchAppendReferences($songId, 'license', [$licenceId]);
        $patches = [
            $licenceId => ['mlc' => 'new aoesntuhmlc2'],
            'drafts.854eb313-c415-4c87-82d0-6569dc15be3b' => ['name' => 'WBNAAAAAA'],
        ];
        $updatedDoc = $client->patchSetMany($patches);
        return $updatedDoc;
    }


    // ----------------------------------- UTILITY FUNCTIONS ------------------------------------------

    private function timeEvent($callback, $inputs, $numAttempts = 1, $delay = 1, $transposeResults = true)
    {
        $timeResults = [];
        foreach (array_keys($inputs) as $key) {
            $input = $inputs[$key];
            if ($transposeResults) {
                $timeResults[$key] = [
                    'time' => [],
                    'result' => [],
                ];
            } else {
                $timeResults[$key] = [];
            }
            for ($i = 0; $i < $numAttempts; $i++) {
                $start = microtime(true);
                try {
                    $result = $callback($input);
                } catch (Exception $e) {
                    $result = ["Exception: $e"];
                }
                $time_elapsed_secs = microtime(true) - $start;
                if ($transposeResults) {
                    $timeResults[$key]['time'][] = $time_elapsed_secs;
                    $timeResults[$key]['result'][] = $result;
                } else {
                    $timeResults[$input][] = [
                        'time' => $time_elapsed_secs,
                        'result' => $result
                    ];
                }
                if ($delay > 0) {
                    sleep($delay);
                }
            }
        }
        return $timeResults;
    }

    private function saveSanityCall($id, $fileName, $type = null)
    {
        // Used like:

        $fullPath = Storage::disk("content_test_resources")->path($fileName);
        $result = $this->sanityGateway->getByRailContentId($id, $type);
        $json = json_encode($result);
        file_put_contents($fullPath, $json);
    }
}
