<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncCustomer extends Command
{
    protected $signature = 'ecommerce:ShopifySyncCustomer {shopifyCustomerId}';

    public function handle(ShopifySyncService $shopifySyncService): void
    {
        $shopifyCustomerId = $this->argument('shopifyCustomerId');
        $shopifySyncService->syncCustomer($shopifyCustomerId);
    }
}
