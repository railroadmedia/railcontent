<?php

namespace App\Modules\RailTracker\tests\Stress;

use App\Modules\RailTracker\Console\Commands\ProcessTrackings;
use App\Modules\RailTracker\Services\ConfigService;
use App\Modules\RailTracker\Services\IpDataApiSdkService;
use App\Modules\RailTracker\tests\RailtrackerTestCase;
use App\Modules\RailTracker\tests\Resources\IpDataApiStubDataProvider;
use App\Modules\RailTracker\tests\Resources\Models\User;
use Ramsey\Uuid\Uuid;

class AnonymousRequestsStressTest extends RailtrackerTestCase
{



    public function test_limited_amount_of_anonymous_data_updated()
    {
        $this->markTestSkipped('Not working after update and migration to MWP.');
        $input = IpDataApiStubDataProvider::$INPUT;
        $output = IpDataApiStubDataProvider::output();

        // -------------------------------------------------------------------------------------------------------------

        $numberOfRequestsFromUser = rand(50,150);
//        $numberOfRequestsFromUser = 1000;

        $ipDataApiSdkServiceMock = $this
            ->getMockBuilder(IpDataApiSdkService::class)
            ->onlyMethods(['bulkRequest'])
            ->getMock();

        app()->instance(IpDataApiSdkService::class, $ipDataApiSdkServiceMock);

        $url = 'https://www.drumeo.com/';
        $clientIp = $input[0];

        $cookies = [ProcessTrackings::$cookieKey => Uuid::uuid4()->toString()];

        $response = $this->createResponse(200);

        $tStart = microtime(true);

        for ($i = 0; $i < $numberOfRequestsFromUser; $i++) {
            $request = $this->createRequest($this->faker->userAgent, $url, '', $clientIp, 'GET', $cookies);

            $this->sendRequest($request, $response);
            $this->processTrackings();
        }

        $secondsToProcessInitialRequests = microtime(true) - $tStart;

        $this->assertDatabaseHas(
            config('railtracker.table_prefix') . 'requests',
            [
                'user_id' => null,
                'cookie_id' => $cookies[ProcessTrackings::$cookieKey],
            ]
        );

        $userId = $this->createAndLogInNewUser();

        $request = $this->createRequest($this->faker->userAgent, $url, '', $clientIp, 'GET', $cookies);
        $request->setUserResolver(
            function () use ($userId) {
                return User::query()->find($userId);
            }
        );

        $tStart = microtime(true);

        $this->sendRequest($request, $response);
        $this->processTrackings();

        $tEnd = microtime(true) - $tStart;
        $anonUpdateTime = $tEnd * 1000;

        $this->assertEquals(
            $numberOfRequestsFromUser + 1,
            $this->databaseManager->connection()
                ->table(config('railtracker.table_prefix') . 'requests')
                ->where('user_id', $userId)
                ->count()
        );

        $this->assertLessThan(100, $anonUpdateTime);

        dump($numberOfRequestsFromUser . ' requests from an anonymous were saved in about ' .
            round($secondsToProcessInitialRequests, 1) . ' seconds');

        dump('The user then authenticated and those previously anonymous requests were updated with the user\'s id ' .
            'in about ' . round($anonUpdateTime) . ' milliseconds.');
    }
}
