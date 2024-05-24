<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Services\CustomerIoService;

class UnsuppressCustomerIoProfileEmail extends Command
{
    protected $signature = 'eventTracking:unsuppressCustomerIoProfileEmail {email} {workspace}';
    protected $description = 'Unsuppress an email that is the ID for a CustomerIo profile';

    public function handle(CustomerIoService $customerIoService, CustomerIoApiGateway $customerIoApiGateway): void
    {
        $email = $this->argument('email');
        $workspace = $this->argument('workspace');
        $accountConfigData = $customerIoService->getAccountConfigData($workspace);
        $customerIoApiGateway->unsuppressEmail(
            $accountConfigData['site_id'],
            $accountConfigData['track_api_key'],
            $email
        );
    }
}
