<?php

namespace App\Modules\Ecommerce\Listeners;

use App\Modules\Ecommerce\Services\ShopifySyncService;
use Log;
use Modules\UserManagementSystem\Events\User\UserCreated;

class EcommerceEventListener
{
    private ShopifySyncService $shopifySyncService;

    public function __construct(ShopifySyncService $shopifySyncService)
    {
        $this->shopifySyncService = $shopifySyncService;
    }

    public function handleUserCreated(UserCreated $userCreated)
    {
        try {
            $user = $userCreated->getUser();
            $this->shopifySyncService->syncUser($user);
            $this->shopifySyncService->syncCustomer($user->shopify_id);
        }
        catch(\Throwable $e){
            Log::error($e->getMessage());
        }
    }
}
