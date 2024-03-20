<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\EventTracking\Jobs\AddImpactedCioProfilesToSegmentJob;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Bus;
use Throwable;

class AddImpactedCioProfilesToSegment extends Command
{
    /*
     * activityType: The type of activity to filter by. For example, 'profile_merge'.
     *  See also: https://customer.io/docs/api/app/#operation/listActivities
     */
    protected $signature = 'eventTracking:addImpactedCioProfilesToSegment {workspaceName} {segmentId} {activityType} {daysAgo=30}';

    protected $description = 'Add impacted profiles to a segment in Customer.io based on a specific activity type.';

    /**
     * @throws Exception
     */
    public function handle(CustomerIoService $customerIoService, CustomerIoApiGateway $customerIoApiGateway): void
    {
        $workspaceName = $this->argument('workspaceName');
        $segmentId = $this->argument('segmentId');
        $activitieType = $this->argument('activityType');
        $daysAgo = $this->argument('daysAgo');
        $accountConfigData = $customerIoService->getAccountConfigData($workspaceName);

        $startDate = Carbon::now()->subDays($daysAgo)->startOfDay();
        $start = 'start';
        $jobs = collect();
        do {
            try {
                $response = $customerIoApiGateway->getActivities(
                    $accountConfigData['app_api_key'],
                    $activitieType,
                    null,
                    100,
                    $start
                );
                $next = $response->next ?? "";
                $start = $next;

                $ids = collect($response->activities ?? [])
                    ->filter(function ($activity) use ($startDate) {
                        $timestamp = Carbon::createFromTimestamp($activity->timestamp);
                        return $timestamp->gte($startDate);
                    })
                    ->pluck('customer_identifiers.id')
                    ->unique()
                    ->toArray();

                if (count($ids) === 0) {
                    continue;
                }

                $jobs->push(
                    new AddImpactedCioProfilesToSegmentJob(
                        $workspaceName,
                        $segmentId,
                        $startDate,
                        $accountConfigData,
                        $ids
                    )
                );
            } catch (Exception $e) {
                $this->error($e->getMessage());
                return;
            }
        } while ($next !== "" && count($ids) > 0);

        try {
            Bus::batch($jobs)->onQueue('command')->dispatch();
        } catch (Throwable $e) {
            $this->error($e->getMessage());
            return;
        }
    }
}
