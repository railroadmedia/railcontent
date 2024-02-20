<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerByEmailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;

class ShopifySyncOrdersSince extends Command
{
    protected $signature = 'ecommerce:ShopifySyncOrdersSince
                            {startDate : The ISO 8601 date time for all Shopify orders to get where the updated_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endDate= : (Optional) The ISO 8601 date time for all Shopify orders to get where the updated_at at or before. e.g. 2023-10-13T17:30:14+00:00}';

    public function handle(ShopifyGateway $shopifyGateway)
    {
        $startDate = Carbon::parse($this->argument('startDate'));
        $endDate = $this->option("endDate") ? Carbon::parse($this->option('endDate')) : Carbon::now();

        $emails = $shopifyGateway->getCustomersToUpdate($startDate, $endDate);
        $jobs = collect();
        $emails->chunk(100)->each(function ($chunk) use ($jobs) {
            $jobs->push(new ShopifySyncCustomerByEmailJob($chunk->toArray()));
        });
        Bus::batch($jobs)->onQueue('command')->dispatch();
    }
}
