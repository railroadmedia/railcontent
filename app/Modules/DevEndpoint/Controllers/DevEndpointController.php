<?php

namespace App\Modules\DevEndpoint\Controllers;

<<<<<<< HEAD
use App\Jobs\UpdatePermissionsJob;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\UserPermission;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Google\Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;
=======
use Google\Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\ApiGateways\SanityGateway;
>>>>>>> feature/sanity-studio-cms
use Railroad\Railcontent\Enums\RecommenderSection;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Services\APIEndPoint;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Services\RecommendationService;
<<<<<<< HEAD
use Railroad\Railcontent\Services\UserPermissionsService;
=======
>>>>>>> feature/sanity-studio-cms

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

<<<<<<< HEAD

    private function setUserToBasic($userID, $interval=null)
    {
        $user = User::whereId($userID)->first();
        #$a = $user->subscriptionIntervalType();
        #$accessPermissions = $this->userAccessPermissionsService->getUserAccessPermissionsByUser($user);
        #$subscriptions = $this->subscriptionService->syncSubscriptionData($accessPermissions);
        if (!$user) {
            throw new InvalidArgumentException("cant find user $userID");
        }
        UserPermission::query()->where([['user_id', '=', $userID], ['permission_id', '!=', UserAccessPermissionsCollection::MusoraBasicMembershipPermission] ])->delete();
        $user->is_lifetime_member = 0;
        $user->is_drumeo_lifetime_member = 0;
        $user->access_level = 'member';
        $user->permission_level = null;
        $user->membership_level = 'basic';
        if (in_array($interval, [null, 'year', 'month', 'day'])) {
            $user->recharge_interval = $interval;
        } else {
            return "Interval needs to be null, month, year, or day not $interval";
        }
        $user->save();
        return "Updated User $userID";
    }

    private function testUserIDs()
    {
        $ids = [522299, 718337, 609588, 349181, 298826];
        $results = [];
        $minID = 723817;
        $maxID = 724827;
        for ($id = $minID; $id <= $maxID; $id++){
            $user = User::whereId($id)->first();
            if ($user) {
                $results[$id]['subMethod'] = $user->getSubscriptionMethod();
                $results[$id]['isBasic'] = $user->isABasicMember();
            }
        }
        return $results;
    }

    private function updatePermissions($contentID)
    {
        $content = Content::whereId($contentID)->first();
        if (!$content) {
            throw new InvalidArgumentException("Invalid ContentID $contentID");
        }
        $currentPermissions = $this->contentPermissionRepository->getByContentIdsOrTypes([$contentID], []);
        foreach($currentPermissions as $currentPermission) {
            $this->contentPermissionRepository->dissociate($contentID, null, $currentPermission);
        }
        $this->contentPermissionService->create($contentID, null, UserAccessPermissionsCollection::MusoraPlusMembershipPermission, 'musora');
        return "Permissions updated for $contentID";
	}

    private function saveJson()
    {
        $permissionsLookup = ['all_content_ids' => []];
        $permissionsLookup = $this->updatePermissionsLookup('Songs Band Takedown Script Sheets - Gate Content.tsv', 5, $permissionsLookup);
        $permissionsLookup = $this->updatePermissionsLookup('Songs Band Takedown Script Sheets - Special Permissions.tsv', 6, $permissionsLookup);
        $permissionsLookup['all_content_ids'] = array_unique($permissionsLookup['all_content_ids']);
        foreach($permissionsLookup as $permissionID => $contentIds) {
            $permissionsLookup[$permissionID] = array_unique($contentIds);
        }
        $directory = 'resources/';
        $fileName = 'permissions.json';
        $outputFilePath = storage_path($fileName);
        if (file_exists($outputFilePath)) {
            unlink($outputFilePath);
        }
        $data = json_encode($permissionsLookup);
        file_put_contents($outputFilePath, $data);
        return $permissionsLookup;
    }

    private function updatePermissionsLookup($input, $permissionsColumn, $permissionsLookup)
    {
        $duplicateIds = [];
        $contentIdColumn = 0;
        $firstRow = true;
        $filePath = storage_path($input);
        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, "\t")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $contentId = $data[$contentIdColumn];
                $permissionIds = $data[$permissionsColumn];
                if (!$contentId || !$permissionIds) {
                    continue;
                }
                $permissionsLookup['all_content_ids'][] = $contentId;
                $permissionIds = explode(';', $permissionIds);
                foreach($permissionIds as $permissionId) {
                    if (!isset($permissionsLookup[$permissionId])) {
                        $permissionsLookup[$permissionId] = [];
                    }
                    if (in_array($contentId, $permissionsLookup[$permissionId])) {
                        if (!isset($duplicateIds[$contentId])) {
                            $duplicateIds[$contentId] = [];
                        }
                        $duplicateIds[$contentId][] = $permissionId;
                        \Log::info("Duplicate Content ID found $input content: $contentId permission: $permissionId");
                    } else {
                        $permissionsLookup[$permissionId][] = $contentId;
                    }
                }
            }
            fclose($handle);
        }
        $fileName = 'duplicates.json';
        $outputFilePath = storage_path($fileName);
        if (file_exists($outputFilePath)) {
            unlink($outputFilePath);
        }
        $data = json_encode($duplicateIds);
        file_put_contents($outputFilePath, $data);
        return $permissionsLookup;
    }

    private function processPermissions()
    {
        $contents = file_get_contents(storage_path('permissions.json'));
        $permissionsLookup = json_decode($contents, true);
        $this->deleteAllPermissions($permissionsLookup['all_content_ids']);
        $entriesAdded = 0;
        foreach($permissionsLookup as $permissionID => $contentIds) {
            if ($permissionID == 'all_content_ids') {
                continue;
            }
            $entriesAdded += count($contentIds);
            dispatch(new UpdatePermissionsJob($contentIds, $permissionID));
        }
        // 128268 total rows when starting (SQL count(id))
        // count at 13724 to remove (deleteAllPermissions)
        // remaining count should be 114544 (and it was)
        // entries added are 12573 ($entriesAdded)
        // post values are: 127117 (SLQ count(id))
        return $permissionsLookup;
    }

    private function deleteAllPermissions($contentIds)
    {
        $count = $this->musoraDB()->from('railcontent_content_permissions')
            ->whereIn('content_id', $contentIds)
            ->count();


        $this->musoraDB()->from('railcontent_content_permissions')
            ->whereIn('content_id', $contentIds)
            ->delete();
        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
=======
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
>>>>>>> feature/sanity-studio-cms
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
