<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Controllers\RevenueCatController;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Services\ShopifyCancelService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Modules\UserManagementSystem\Models\User;

class ShopifyCancelOrder extends Command
{
    protected $signature = 'ecommerce:ShopifyCancelOrder {email} {orderId}';

    public function handle(ShopifyCancelService $shopifyCancelService, ShopifySyncService $shopifySyncService): void
    {
        $this->withExecutionTime(function () use ($shopifyCancelService, $shopifySyncService) {
            $orderId = $this->argument('orderId');
            try {
                $shopifyCancelService->deleteOrder($orderId);
            } catch (\Throwable $e) {
                $this->info($e->getMessage());
            }
            $email = $this->argument('email');
            $user = User::query()->where('email', $email)->first();
            $shopifySyncService->syncCustomer($user->shopify_id, removeDeletedOrderPermissions: true);
        });
    }
}
