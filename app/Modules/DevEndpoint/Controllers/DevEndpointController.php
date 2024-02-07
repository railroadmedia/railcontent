<?php

namespace App\Modules\DevEndpoint\Controllers;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\ShopifyAPIService;
use App\Modules\UserManagementSystem\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\UserManagementSystem\Events\UserEvent;
use Railroad\Railcontent\Enums\RecommenderSection;
use Railroad\Railcontent\Services\RecommendationService;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use function Amp\delay;


class DevEndpointController extends Controller
{
    use AuthorizesRequests;

    /**
     * ContentRedirectController constructor.
     */
    public function __construct(
        private RecommendationService $recommendationService,
    )
    { }

    public function handleRequest(Request $request, $arg1=null)
    {
        //phpinfo();
        $results = [
            'drumeo' => $this->recommendationService->getFilteredRecommendations($arg1,'drumeo', RecommenderSection::Song),
            'singeo' => $this->recommendationService->getFilteredRecommendations($arg1,'singeo', RecommenderSection::Song),
            'pianote' => $this->recommendationService->getFilteredRecommendations($arg1,'pianote', RecommenderSection::Song),
            'guitareo' => $this->recommendationService->getFilteredRecommendations($arg1,'guitareo', RecommenderSection::Song),
        ];
        dd($results);
        return $this->recommendationService->getFilteredRecommendations(1111,'pianote', RecommenderSection::Course);
        $this->testRandomization();
        dd("hello from the playground");

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
        foreach ($inputs as $input) {
            if($transposeResults) {
                $timeResults[$input] = [
                    'time' => [],
                    'result' => [],
                ];
            } else {
                $timeResults[$input] = [];
            }
            for($i = 0; $i < $numAttempts; $i++) {
                $start = microtime(true);
                $result = $callback($input);
                $time_elapsed_secs = microtime(true) - $start;
                if ($transposeResults) {
                    $timeResults[$input]['time'][] = $time_elapsed_secs;
                    $timeResults[$input]['result'][] = $result;
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

