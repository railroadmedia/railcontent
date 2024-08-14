<?php

namespace App\Modules\DevEndpoint\Controllers;

use Google\Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\ApiGateways\SanityGateway;
use Railroad\Railcontent\Enums\RecommenderSection;
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
        private UserPermissionsService $userPermissionsService,
        private SubscriptionService $subscriptionService,
        private UserAccessPermissionsService $userAccessPermissionsService,
    ) {
    }

    public function handleRequest(Request $request, $arg1 = null)
    {
        $userId = $request->query('userid', false);
        if ($userId) {
            return $this->setUserToBasic($userId, $request->query('interval', null));
        }
        if ($arg1) {
            return $this->updatePermissions($arg1);
        }

        $results = [
            'drumeo' => $this->recommendationService->getFilteredRecommendations($arg1, 'drumeo'),
            'singeo' => $this->recommendationService->getFilteredRecommendations($arg1, 'singeo'),
            'pianote' => $this->recommendationService->getFilteredRecommendations($arg1, 'pianote'),
            'guitareo' => $this->recommendationService->getFilteredRecommendations($arg1, 'guitareo'),
        ];
        dd($results);
        return $this->recommendationService->getFilteredRecommendations(1111, 'pianote', RecommenderSection::Course);
        $this->testRandomization();
        dd("hello from the playground");
    }

    private function testSanity()
    {
        $client = new SanityGateway();
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

    private function testAPIEndpoints()
    {
        $inputs = array_map(function ($endpoint) {
            return $endpoint->value;
        }, APIEndPoint::cases());
        $callback = function ($endpoint) {
            $this->recommendationService->APIEndPoint = $endpoint;
            $userIDs = [579297, 648632, 149869, 150909, 152882];
            $randomize = false;
            $userID = $randomize ? $userIDs[0] : $userIDs[array_rand($userIDs, 1)];
            return $this->recommendationService->getFilteredRecommendations($userID, "drumeo", RecommenderSection::Song);
        };
        $results = $this->timeEvent($callback, $inputs, 5, 1, );
        return $results;
    }

    private function testingRecSysSections()
    {
        $inputSections = [
            'two sections' => [RecommenderSection::Course, RecommenderSection::QuickTip],
            'one sections' => [RecommenderSection::QuickTip],
            'blank' => [],
        ];
        $userID = 631736;
        $brand = 'drumeo';
        $callback = function ($sections) use ($userID, $brand) {
            return $this->contentService->getRecommendedContent($userID, $brand, $sections);
        };
        $results = $this->timeEvent($callback, $inputSections, 1, 0);
        return $results;
    }

    private function testBulkRecommendation()
    {

        $userIDs = [648632, 149869, 150909, 152882];
        $brand = 'SINGEO';
        $results = $this->recommendationService->getBulkFilterRecommendations($userIDs, $brand, RecommenderSection::Song);
        dd($results);
    }

    private function testingForRecommendationSystem()
    {

        $brand = 'drumeo';
        $section = RecommenderSection::Song;
        $ids = ['579297', '1114', '149628', '149643', '111'];
        $callback = function ($id) use ($brand, $section) {
            return $this->recommendationService->getFilteredRecommendations($id, $brand, $section);
        };
        $timeResults = $this->timeEvent($callback, $ids, 2, 1);
        dd($timeResults);
        $userID = 579297;
        $results = $this->recommendationService->getFilteredRecommendations($userID, $brand, $section);
        dd($results);
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
