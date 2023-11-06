<?php

namespace App\Modules\Ecommerce\Listeners;

use App\Modules\Ecommerce\Services\ShopifySyncService;
use Modules\UserManagementSystem\Events\User\UserCreated;

class EcommerceEventListener
{
    private ShopifySyncService $shopifySyncService;

    public function __construct(ShopifySyncService $shopifySyncService)
    {
        $this->shopifySyncService = $shopifySyncService;
    }

    public function handleUserCreated(UserCreated $userCreated) {
        $this->shopifySyncService->ensureUserSynced($userCreated->getUser());
        $this->shopifySyncService->syncCustomerByEmail($userCreated->getUser()->email);
    }
}
