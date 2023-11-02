<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncCustomerByEmail extends Command
{
    protected $signature = 'ecommerce:ShopifySyncCustomerByEmail {email}';

    public function handle(ShopifySyncService $shopifySyncService)
    {
        $email = $this->argument('email');
        $shopifySyncService->syncCustomerByEmail($email);
    }
}
