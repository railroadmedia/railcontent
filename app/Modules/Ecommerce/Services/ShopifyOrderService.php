<?php

namespace App\Modules\Ecommerce\Services;

use Modules\UserManagementSystem\Models\User;

class ShopifyOrderService
{
    public function __construct()
    {
    }

    public function orderCreated($shopifyCustomerId, $productsPurchased)
    {
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        $userPermissions = $this->getUserPermissions($productsPurchased);
        $this->updateUserPermissions($userId, $userPermissions);
    }

    private function getUserIdFromShopifyCustomerId($shopifyCustomerId)
    {
        $user = User::query()->where('shopify_customer_id', '=', $shopifyCustomerId)->first('id');
        return $user->id;
    }

    private function updateUserPermissions($userId, $userPermissions)
    {
    }

    private function getUserPermissions($productsPurchased)
    {
        return [];
    }
}
