<?php

namespace App\Modules\Ecommerce\Listeners;

use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Services\ShopifyCustomerService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Log;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;

class EcommerceEventListener
{

    public function __construct(
        private readonly ShopifySyncService $shopifySyncService,
        private readonly ShopifyCustomerService $shopifyCustomerService,
        private readonly RechargeGateway $rechargeGateway
    ) {
    }

    public function handleUserCreated(UserCreated $userCreated)
    {
        try {
            $user = $userCreated->getUser();
            $this->shopifySyncService->syncUser($user);
            $this->shopifySyncService->syncCustomer($user->shopify_id);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle necessary updates to external ecommerce systems when the user has been updated.
     *
     * @param  UserUpdated  $userUpdated
     */
    public function handleUserUpdated(UserUpdated $userUpdated): void
    {
        $oldEmail = $userUpdated->getOldUser()->email;
        $newEmail = $userUpdated->getNewUser()->email;
        // email change needs to sync to Shopify and Recharge
        if ($newEmail != $oldEmail && $userUpdated->getNewUser()->shopify_id) {
            $this->shopifyCustomerService->createShopifyCustomer($userUpdated->getNewUser());

            try {
                $updateSuccess = $this->rechargeGateway->updateCustomer(
                    $userUpdated->getNewUser()->shopify_id,
                    ["email" => $newEmail]
                );

                if (!$updateSuccess) {
                    Log::error("Failed to update Recharge email address from $oldEmail to $newEmail");
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
