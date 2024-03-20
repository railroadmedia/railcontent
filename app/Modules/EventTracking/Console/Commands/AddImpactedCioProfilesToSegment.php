<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Exception;

class AddImpactedCioProfilesToSegment extends Command
{
    protected $signature = 'eventTracking:addImpactedCioProfilesToSegment {workspaceName}';

    protected $description = 'Merge duplicate customer.io profiles that exists in the customer_io_customers table';

    /**
     * @throws Exception
     */
    public function handle(CustomerIoService $customerIoService, CustomerIoApiGateway $customerIoApiGateway): void
    {
        $workspaceName = $this->argument('workspaceName');
        $accountConfigData = $customerIoService->getAccountConfigData($workspaceName);

        $segmentId = 801;
        $start = 'start';
        do {
            try {
                $response = $customerIoApiGateway->getActivities(
                    $accountConfigData['app_api_key'],
                    'profile_merge',
                    null,
                    100,
                    $start
                );
                $next = $response['next'];
                $start = $next;
                $activities = $response['activities'];

                $ids = collect($activities)->pluck('customer_identifiers.id')->unique();

                $customerIoApiGateway->addProfilesToSegment(
                    $accountConfigData['site_id'],
                    $accountConfigData['track_api_key'],
                    $segmentId,
                    $ids,
                );

                // so we don't exceed the rate limit
                sleep(1);

            } catch (Exception $e) {
                $this->error($e->getMessage());
                return;
            }
        } while ($next !== "");
    }
}
