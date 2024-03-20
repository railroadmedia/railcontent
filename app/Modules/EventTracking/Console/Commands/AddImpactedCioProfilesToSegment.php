<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

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

                $activities = collect($response->activities ?? [])
                    ->filter(function ($activity) use ($startDate, $daysAgo) {
                        $timestamp = Carbon::createFromTimestamp($activity->timestamp);
                        return $timestamp->gte($startDate);
                    });

                $ids = collect($activities)->pluck('customer_identifiers.id')->unique()->toArray();

                $this->info(
                    'Adding ' . count($ids) . ' profiles to segment ' . $segmentId . ' for workspace ' . $workspaceName
                );

                $customerIoApiGateway->addProfilesToSegment(
                    $accountConfigData['site_id'],
                    $accountConfigData['track_api_key'],
                    $segmentId,
                    $ids,
                );

                $this->info('Profiles added to segment');

                // so we don't exceed the rate limit
                sleep(1);
            } catch (Exception $e) {
                $this->error($e->getMessage());
                return;
            }
        } while ($next !== "");
    }
}
