<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifyOrderService;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncCustomer extends Command
{
    protected $signature = 'ecommerce:ShopifySyncCustomer {shopifyCustomerId}';

    public function handle(ShopifyOrderService $shopifyOrderService)
    {
        $shopifyCustomerId = $this->argument('shopifyCustomerId');
        $shopifyOrderService->syncCustomer($shopifyCustomerId);
    }
}
