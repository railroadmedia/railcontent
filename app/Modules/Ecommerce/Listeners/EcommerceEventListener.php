<?php

namespace App\Modules\Ecommerce\Listeners;

use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Services\ShopifyCustomerService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Log;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Usora\Events\User\UserUpdated as UsoraUserUpdated;

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
     * @param  UserUpdated|UsoraUserUpdated  $userUpdated
     */
    public function handleUserUpdated(UserUpdated|UsoraUserUpdated $userUpdated): void
    {
        if ($userUpdated instanceof UsoraUserUpdated) {
            $newEmail = $userUpdated->getNewUser()->getEmail();
            $oldEmail = $userUpdated->getOldUser()->getEmail();
            // UsoraUserUpdated's User models are Railroad\Usora\Entities type, so get the
            // Modules\UserManagementSystem\Models version, so we can interact with it the same way
            $newUser = User::find($userUpdated->getNewUser()->getId());
        } else {
            $newEmail = $userUpdated->getNewUser()->email;
            $oldEmail = $userUpdated->getOldUser()->email;
            $newUser = $userUpdated->getNewUser();
        }

        // email change needs to sync to Recharge and Shopify (in that order!)
        if ($newEmail != $oldEmail && $newUser->shopify_id) {
            try {
                $updateSuccess = $this->rechargeGateway->updateCustomer(
                    $newUser->shopify_id,
                    ["email" => $newEmail]
                );

                if (!$updateSuccess) {
                    Log::error("Failed to update Recharge email address from $oldEmail to $newEmail");
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            $this->shopifyCustomerService->updateOrCreateShopifyCustomer($newUser);
        }
    }
}
