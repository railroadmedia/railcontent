<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerByEmailJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncOrdersSince extends Command
{
    protected $signature = 'ecommerce:ShopifySyncOrdersSince {date}';

    public function handle(ShopifyGateway $shopifyGateway)
    {
        $date = Carbon::parse($this->argument('date'));
        $emails = $shopifyGateway->getCustomersToUpdate($date);
        $jobs = collect();
        $emails->chunk(100)->each(function ($chunk) use ($jobs) {
            $jobs->push(new ShopifySyncCustomerByEmailJob($chunk->toArray()));
        });
        Bus::batch($jobs)->onQueue('command')->dispatch();
    }
}
