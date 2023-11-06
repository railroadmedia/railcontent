<?php

namespace App\Modules\Ecommerce\Listeners\Shopify;

use App\Modules\Ecommerce\Services\ShopifyCustomerService;
use Modules\UserManagementSystem\Events\User\UserUpdated;

class ShopifyEventListener
{
    /**
     * @var bool
     */
    public static bool $disable = false;

    /**
     *
     * @param  ShopifyCustomerService  $shopifyCustomerService
     */
    public function __construct(
        private readonly ShopifyCustomerService $shopifyCustomerService
    ) {
    }

    /**
     * Handle necessary updates to Shopify when the user has been updated.
     *
     * @param  UserUpdated  $userUpdated
     */
    public function handleUserUpdated(UserUpdated $userUpdated): void
    {
        if (self::$disable) {
            return;
        }

        if ($userUpdated->getNewUser()->email != $userUpdated->getOldUser()->email
            && $userUpdated->getNewUser()->shopify_id) {
            $this->shopifyCustomerService->createShopifyCustomer($userUpdated->getNewUser());
        }
    }
}
