<?php

namespace App\Modules\DevEndpoint\Controllers;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\ShopifyAPIService;
use App\Modules\UserManagementSystem\Services\UserService;
use Closure;
use Google\Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Railroad\Railcontent\Enums\RecommenderSection;
use Railroad\Railcontent\Services\APIEndPoint;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\RecommendationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class DevEndpointController extends Controller
{
    use AuthorizesRequests;

    /**
     * ContentRedirectController constructor.
     */
    public function __construct(
        private RecommendationService $recommendationService,
        private ContentService $contentService,
    )
    { }

    public function handleRequest(Request $request, $arg1=null)
    {
        $results = [
            'drumeo' => $this->recommendationService->getFilteredRecommendations($arg1,'drumeo'),
            'singeo' => $this->recommendationService->getFilteredRecommendations($arg1,'singeo'),
            'pianote' => $this->recommendationService->getFilteredRecommendations($arg1,'pianote'),
            'guitareo' => $this->recommendationService->getFilteredRecommendations($arg1,'guitareo'),
        ];
        dd($results);
        return $this->recommendationService->getFilteredRecommendations(1111,'pianote', RecommenderSection::Course);
        $this->testRandomization();
        dd("hello from the playground");
    }

    private function testAPIEndpoints()
    {
        $inputs = array_map(function($endpoint) {return $endpoint->value;}, APIEndPoint::cases());
        $callback = function($endpoint) {
            $this->recommendationService->APIEndPoint = $endpoint;
            $userIDs = [579297,648632, 149869, 150909, 152882];
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
        $callback = function($sections) use ($userID, $brand) {
            return $this->contentService->getRecommendedContent($userID, $brand, $sections);
        };
        $results = $this->timeEvent($callback, $inputSections, 1, 0);
        return $results;
    }

    private function testBulkRecommendation() {

        $userIDs = [648632, 149869, 150909, 152882];
        $brand = 'SINGEO';
        $results = $this->recommendationService->getBulkFilterRecommendations($userIDs, $brand, RecommenderSection::Song);
        dd($results);
    }

    private function testingForRecommendationSystem() {

        $brand = 'drumeo';
        $section = RecommenderSection::Song;
        $ids = ['579297', '1114', '149628', '149643', '111'];
        $callback = function($id) use ($brand, $section) {
            return $this->recommendationService->getFilteredRecommendations($id, $brand, $section);
        };
        $timeResults = $this->timeEvent($callback, $ids, 2, 1);
        dd($timeResults);
        $userID = 579297;
        $results = $this->recommendationService->getFilteredRecommendations($userID, $brand, $section);
        dd($results);
    }

    // ----------------------------------- UTILITY FUNCTIONS ------------------------------------------

    private function timeEvent($callback, $inputs, $numAttempts=1, $delay=1, $transposeResults=true)
    {
        $timeResults = [];
        foreach(array_keys($inputs) as $key) {
            $input = $inputs[$key];
            if($transposeResults) {
                $timeResults[$key] = [
                    'time' => [],
                    'result' => [],
                ];
            } else {
                $timeResults[$key] = [];
            }
            for($i = 0; $i < $numAttempts; $i++) {
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

