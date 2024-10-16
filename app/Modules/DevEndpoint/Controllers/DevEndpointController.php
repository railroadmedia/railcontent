<?php

namespace App\Modules\DevEndpoint\Controllers;

use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Google\Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\Content\ApiGateways\SanityGateway;
use Modules\Content\Services\ChallengesService;
use Railroad\Railcontent\Enums\RecommenderSection;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Services\APIEndPoint;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Services\RecommendationService;
use Railroad\Railcontent\Support\Collection;
use Stripe\Card;

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
    ) {
    }

    public function handleRequest(Request $request, $arg1 = null)
    {
        $challengeId = 402199;
        $userId = 631736; //If you update this to your id, everything should be an unlock date of the startdate

//        $this->prepChallengeData($challengeId);
//        $this->setContentCompleted($challengeId);

//        $this->unlockChallenge($challengeId, $userId);
//        $this->challengesService->completeChallenge($challengeId, $userId);
        return 'whooo challenge data inserted';
        return view("pages.devendpoint", ['results' => 'some results here', 'json_results' => ['key1' => 'value1']]);


    }

    private function prepChallengeData($challengeId = null, $startdate = null)
    {
        $challengeId = $challengeId ?? 402199; // https://web-staging-one.musora.com/admin/studio/publishing/structure/challenge;challenge_402199
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

    private function setContentCompleted($challengeId)
    {

        $data = [
            755987 => [
                '402542' => [
                    'is_completed' => true,
                    'time_practiced' => 8,
                ],
                '402314' => [
                    'is_completed' => true,
                    'time_practiced' => 3,
                ],
            ],
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
}
