<?php

namespace App\Modules\RailTracker\tests\Functional;

use App\Modules\RailTracker\Models\Requests;
use App\Modules\RailTracker\Services\IpDataApiSdkService;
use App\Modules\RailTracker\tests\RailtrackerTestCase;
use App\Modules\RailTracker\tests\Resources\IpDataApiStubDataProvider;
use App\Modules\RailTracker\ValueObjects\RequestVO;
use Mockery;
use Mockery\MockInterface;

class RequestTrackerTest extends RailtrackerTestCase
{
    public function test_ipData_api_not_queried_for_already_known_ips()
    {
        $requests = collect();
        $expected = collect();

        $input = IpDataApiStubDataProvider::$INPUT;
        $output = IpDataApiStubDataProvider::output();

        // -------------------------------------------------------------------------------------------------------------

        $this->instance(
            IPDataApiSdkService::class,
            Mockery::mock(IPDataApiSdkService::class, function (MockInterface $mock) use ($output) {
                $mock->shouldReceive('bulkRequest')->andReturn($output);
            })
        );

        // first set of requests ---------------------------------------------------------------------------------------

        // create requests and corresponding DB expectations for the results of their processing
        foreach ($input as $ip) {
            $request = $this->randomRequest($ip);
            $requests->push($request);

            $requestVO = new RequestVO($request);
            $expected->push($requestVO);
        }

        foreach ($requests as $request) {
            $this->sendRequest($request);
        }

        try {
            $this->processTrackings();
        } catch (\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $expectedInDatabase = IpDataApiStubDataProvider::expectedInDatabase($expected, $output);

        foreach ($expectedInDatabase as $expectedRow) {
            $expectedRow['ip_latitude'] = number_format($expectedRow['ip_latitude'], 8);
            $expectedRow['ip_longitude'] = number_format($expectedRow['ip_longitude'], 8);

            $this->assertDatabaseHas(
                config('railtracker.table_prefix') . 'requests',
                $expectedRow
            );
        }

        // second set of requests --------------------------------------------------------------------------------------

        foreach ($input as $ip) {
            $request = $this->randomRequest($ip);
            $this->sendRequest($request);
        }

        try {
            $this->processTrackings();
        } catch (\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        foreach ($expectedInDatabase as $expectedRow) {
            $expectedRow['ip_latitude'] = number_format($expectedRow['ip_latitude'], 8);
            $expectedRow['ip_longitude'] = number_format($expectedRow['ip_longitude'], 8);

            $this->assertDatabaseHas(
                config('railtracker.table_prefix') . 'requests',
                $expectedRow
            );
        }
    }

    public function test_ipData_api_only_some_ips_already_known()
    {
        $this->markTestSkipped('Not working after update and migration to MWP.');

        $onlyTestBulkRequestParams = true; // debugging aid - manually flip this to false to test only the params-as-expected assertions below.

        $requests = collect();
        $expected = collect();

        $requestsTwo = collect();
        $expectedTwo = collect();

        $outputKeyedByIp = [];

        $inputAll = IpDataApiStubDataProvider::$INPUT;
        $outputAll = IpDataApiStubDataProvider::output();

        $inputFirst = [
            $inputAll[0],
            $inputAll[1],
            $inputAll[2],
        ];

        $inputSecond = [
            $inputAll[3],
            $inputAll[4],
            $inputAll[5],
        ];

        $outputFirst = [
            $outputAll[0],
            $outputAll[1],
            $outputAll[2],
        ];

        $outputSecond = [
            $outputAll[3],
            $outputAll[4],
            $outputAll[5],
        ];

        // -------------------------------------------------------------------------------------------------------------

        $this->instance(
            IPDataApiSdkService::class,
            Mockery::mock(IPDataApiSdkService::class, function (MockInterface $mock) use ($outputFirst) {
                $mock->shouldReceive('bulkRequest')->andReturn($outputFirst);
            })
        );

        // first set of requests ---------------------------------------------------------------------------------------

        foreach ($outputFirst as $dataForIp) {
            $outputKeyedByIp[$dataForIp['ip']] = $dataForIp;
        }

        // create requests and corresponding DB expectations for the results of their processing
        foreach ($inputFirst as $ip) {
            $request = $this->randomRequest($ip);
            $requests->push($request);

            $requestVO = new RequestVO($request);
            $expected->push($requestVO);
        }

        foreach ($requests as $request) {
            $this->sendRequest($request);
        }

        try {
            $this->processTrackings();
        } catch (\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $expectedInDatabase = IpDataApiStubDataProvider::expectedInDatabase($expected, $outputAll);

        if (!$onlyTestBulkRequestParams) {
            foreach ($expectedInDatabase as $expectedRow) {
                $this->assertDatabaseHas(
                    config('railtracker.table_prefix') . 'requests',
                    $expectedRow
                );
            }
        }

        // second set of requests --------------------------------------------------------------------------------------

        foreach ($inputFirst as $ip) {
            $request = $this->randomRequest($ip);
            $requestsTwo->push($request);
            $requestVO = new RequestVO($request);
            $expectedTwo->push($requestVO);
            $this->sendRequest($request);
        }

        $expectedInDatabaseTwo = IpDataApiStubDataProvider::expectedInDatabase($expectedTwo, $outputAll);

        $expectedInDatabaseBoth = array_merge($expectedInDatabase, $expectedInDatabaseTwo);

        foreach ($inputSecond as $ip) {
            $request = $this->randomRequest($ip);
            $this->sendRequest($request);
        }

        try {
            $this->processTrackings();
        } catch (\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        if (!$onlyTestBulkRequestParams) {
            foreach ($expectedInDatabaseBoth as $expectedRow) {
                $this->assertDatabaseHas(
                    config('railtracker.table_prefix') . 'requests',
                    $expectedRow
                );
            }
        }
    }

    /**
     * @doesNotPerformAssertions
     */
    public function test_process_no_keys()
    {
        try {
            $this->processTrackings();
        } catch (\Exception $exception) {
            $this->fail($exception->getMessage());
        }
    }
}
