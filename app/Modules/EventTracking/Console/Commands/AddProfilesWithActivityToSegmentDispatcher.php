<?php

namespace App\Modules\EventTracking\Console\Commands;

use Illuminate\Bus\Batch;
use App\Console\Commands\Infrastructure\Command;
use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\EventTracking\Jobs\AddProfilesWithActivityToSegmentManager;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class AddProfilesWithActivityToSegmentDispatcher extends Command
{
    /*
     * activityType: The type of activity to filter by. For example, 'profile_merge'.
     *  See also: https://customer.io/docs/api/app/#operation/listActivities
     */
    protected $signature = 'eventTracking:addProfilesWithActivityToSegment {workspaceName} {segmentId} {activityType} {daysAgo=30}';

    protected $description = 'Add impacted profiles to a segment in Customer.io based on a specific activity type.';

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function handle(CustomerIoService $customerIoService, CustomerIoApiGateway $customerIoApiGateway): int
    {
        $workspaceName = $this->argument('workspaceName');
        $segmentId = $this->argument('segmentId');
        $activityType = $this->argument('activityType');
        $daysAgo = $this->argument('daysAgo');
        $accountConfigData = $customerIoService->getAccountConfigData($workspaceName);

        $startAt = Carbon::now();
        $batch = Bus::batch(
            new AddProfilesWithActivityToSegmentManager(
                $accountConfigData,
                $workspaceName,
                $segmentId,
                $activityType,
                $startAt->subDays($daysAgo)->startOfDay()
            )
        )->then(function (Batch $batch) use ($startAt) {
            Log::info(
                sprintf("AddProfilesWithActivityToSegment: completed in %s seconds", $startAt->diffInSeconds())
            );
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error($e->getMessage());
        })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf("AddProfilesWithActivityToSegment: Batch ID %s dispatched.", $batch->id)
        );


        return self::SUCCESS;
    }
}
