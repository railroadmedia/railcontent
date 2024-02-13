<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Modules\UserManagementSystem\Models\User;

class ShopifySyncCustomerByUserId extends Command
{
    protected $signature = 'ecommerce:ShopifySyncCustomerByUserId {id}';

    public function handle(ShopifySyncService $shopifySyncService)
    {
        $id = $this->argument('id');
        $user = User::query()->find($id);
        $shopifySyncService->syncCustomerByUser($user);
    }
}
