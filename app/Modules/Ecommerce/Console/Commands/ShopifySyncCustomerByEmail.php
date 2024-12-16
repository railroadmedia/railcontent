<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Services\ShopifySyncService;

class ShopifySyncCustomerByEmail extends Command
{
    protected $signature = 'ecommerce:ShopifySyncCustomerByEmail {email}';

    public function handle(ShopifySyncService $shopifySyncService): void
    {
        $email = $this->argument('email');
        $shopifySyncService->syncCustomerByEmail($email);
    }
}
