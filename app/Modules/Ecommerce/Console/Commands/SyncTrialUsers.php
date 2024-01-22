<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagementSystem\Models\User;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ProductService;

class SyncTrialUsers extends Command
{
    protected $signature = 'ecommerce:SyncTrialUsers';

    public function handle(ShopifySyncService $shopifySyncService, ProductService $productService, UserService $userService )
    {
        $this->withExecutionTime(function ()  use ($shopifySyncService, $productService, $userService){
            User::query()
                ->where('created_at', '>', Carbon::now()->subMonth(2))
                ->whereNotNull('shopify_id')
                ->whereNull('trial_expiration_date')
                ->orderBy('created_at', 'desc')
                ->chunk(100, function (Collection $users) use ($shopifySyncService, $productService, $userService) {
                    foreach ($users as $user) {
                        if ($user) {
                            $ownedProducts = $shopifySyncService->getOwnedProducts($user->shopify_id);
                            $lineItems = $ownedProducts;
                            foreach ($lineItems as $lineItem) {
                                $sku = $lineItem->sku;
                                if (Product::IsTrialSku($sku)) {
                                    $trialProduct = $productService->getProductsBySkus([$sku])[0];
                                    $processedAt = $lineItem->order->processedAt;
                                    $userService->setLastTrialDate($user->shopify_id, $processedAt->addDays($trialProduct->getTrialDays()));
                                }
                            }
                        }
                    }
                });
        });
    }
}
