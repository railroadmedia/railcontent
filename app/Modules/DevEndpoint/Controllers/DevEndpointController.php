<?php

namespace App\Modules\DevEndpoint\Controllers;

use Algolia\AlgoliaSearch\Api\SearchClient;
use App\Models\Cohort;
use App\Models\CohortDropdown;
use App\Models\CohortList;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Resources\Algolia\SearchParameters;
use App\Modules\Content\Services\AlgoliaSearchService;
use App\Modules\Content\Services\ChallengesService;
use App\Modules\Content\Services\V1\CarouselServiceV1;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use App\Modules\UserManagementSystem\Services\UserService;
use Google\Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Content\Console\Commands\ChallengesV2UpdateWebUrlPath;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\APIEndPoint;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;
use Railroad\Railcontent\Services\RecommendationService;
use App\Modules\Content\Console\Commands\Data\ImportSanityPublishers;

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
        private RailcontentV2DataSyncingService $dataSyncingService,
        private CarouselServiceV1 $carouselServiceV1,
        private ImportSanityPublishers $importSanityPublishers,
    ) {
    }


    public function handleRequest(Request $request, $arg1 = null)
    {
        if ($arg1 == 'challenges') {
            return $this->handleChallengesEndpoints($request);
        }
        $result = $this->convertTSVToArray(storage_path('Publisher-Information-2025.tsv'));
        //$results = $this->importSanityPublishers->handle();

        return $result;
    }

    private function convertTSVToArray($filePath): array
    {
        $array = [];
        $fileTSV = fopen($filePath, 'r');
        while ($line = fgets($fileTSV)) {
            $line = explode("\t", trim($line));
            $child = $line[0];
            $name = $line[1];

            if ($name == 'Publisher Name') {
                continue;
            }

            foreach ($array as $entries) {
                if ($entries['name'] == $name) {
                    $entries['child'][] = $child;
                    $name = null;
                    $child = null;
                }
            }

            if ($name != null) {
                $length = count($array);
                $array[$length+1]['name'] = $name;
                $array[$length+1]['child'] = [];
                $array[$length+1]['child'][] = $child;
            }


        }
        fclose($fileTSV);

        return $array;
    }

    private function deleteThingsFromSanity($queryString)
    {
        $temp = "_type == 'onboarding-content-card'";
        $query = ["query" => "*[$queryString]"];
        $this->sanityGateway->sanity->delete($query);
    }

    private function runArtisanCommand()
    {
        //return 'We did not run anything but you can use this to debug commands';
        \Artisan::call('sanity:import-content', [
            'destination' => 'development',
            'type' => 'onboarding-card',
        ]);
        return '';
    }

    private function handleChallengesEndpoints($request): string
    {
        $action = $request->get('action');
        $userId = $request->get('user_id', user()?->id ?? 631736); // adrian@musora.com
        $challengeId = $request->get(
            'challenge_id',
            402199
        ); // https://web-staging-one.musora.com/admin/studio/publishing/structure/challenge;challenge_402199
        switch ($action) {
            case ('prep'):
                $this->prepChallengeData($challengeId, $request->get('start_date', null));
                return "Prepped Challenge Data $challengeId";
            case ('complete'):
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
                $this->challengesService->completeChallenge($userProgress);
                return "Completed Challenge $challengeId for user $userId";
            case('move_days'):
                $numDays = $request->get('num_days', 1);
                $progress = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $userId);
                if (!$progress) {
                    return "Invalid challenge Id and user_id combination. Please enroll your user in the challenge first :D with /challenges/enroll/challenge_id or /challenges/set_start_date/challenge_id&start_date=YYYYMMDD which can be set to the past";
                }
                $startDate = Carbon::parse($progress->start_date);
                $newStartDate = $startDate->subDays($numDays);
                $challenge = $this->challengesService->getChallengeById($challengeId);

                $newLessonData = ChallengeUserProgress::defineLessonsMetaData($challenge, $newStartDate);
                $originalProgress = $progress->lessons_meta_data;
                foreach ($progress->lessons_meta_data as $index => $_) {
                    $oCompletedDate = $originalProgress[$index]['completed_at'];
                    if ($oCompletedDate) {
                        $oCompletedDate = Carbon::parse($oCompletedDate);
                        $newCompletedDate = $oCompletedDate->subDays($numDays);
                        $originalProgress[$index]['completed_at'] = $newCompletedDate->toISOString();
                    }
                    $originalProgress[$index]['unlock_date'] = $newLessonData[$index]['unlock_date'];
                }
                $progress->lessons_meta_data = $originalProgress;
                $progress->start_date = $newStartDate->toISOString();
                $progress->save();
                $challengeName = $challenge['title'];
                return "Start date for $challengeName for user: $userId moved to {$newStartDate->toISOString()}. Completed lessons and practice time maintained";
            case('cohort'):
                $cohortId = $request->get('cohort_id');
                $cohort = Cohort::query()->where('id', $cohortId)->first();
                $cohort->content_id = $challengeId;
                $cohort->enrollment_end_date = Carbon::parse('20251111 23:00')->toISOString();
                $cohort->save();
                return "Cohort {$cohort->cohort_title} updated to point to $challengeId";
            case('enroll'):
                $this->challengesService->startChallenge($challengeId, $userId);
                return "User $userId Enrolled in $challengeId";
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
            755987,
            755984,
            755976,
            755957,
            755953,
            755945,
            755932,
            755919,
            755916,
            755904,
            755886,
            755880,
            755877,
            755866,
            755848,
            755827,
            755824,
            755820,
            755808,
            755807,
            755799,
            755787,
            755786,
            755782,
            755764,
            755675, // explicitly in block list
            755745, // user with no profile picture
            755406, // musora user
            735658, //eli test user
            631736, // me
        ];
        ChallengeUserProgress::truncate();
        foreach ($userIds as $userId) {
            $isUnlocked = $userId == 755976 || $userId == 755957;
            $this->challengesService->startChallenge(
                $challengeId,
                $userId,
                startDate: $startdate,
                isLocked: !$isUnlocked
            );
        }
    }

    private function testSanity()
    {
        $client = app()->make(SanityGateway::class);
        return $client->getChildrenByRailcontentID(206303);
        $documents = $client->getByRailContentIds([206303], includeParents: true);
        return 'eehhh';
        $songId = 'drafts.ae22572b-6219-4d8f-ba6e-aaa86c29036a'; // Head like a hole
        $licenceId = 'drafts.044f865a-5e1d-4477-aa8a-7cc783acc903'; // Let it Be (test license
        $publisherId = 'drafts.9b7840ff-a2ff-4a85-bab3-589d94bda677'; //Disney on development
        $updatedDoc = $client->patchSetSingle('044f865a-5e1d-4477-aa8a-7cc783acc903', ['mlc' => 'new mlc2']);
        $updatedDoc = $client->patchSetSingle($songId, ['popularity' => 200]);
        $updatedDoc = $client->patchSetSingle($publisherId, ['name' => 'Disney2']);
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
