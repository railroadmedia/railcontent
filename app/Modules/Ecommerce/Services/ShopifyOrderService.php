<?php

namespace App\Modules\Ecommerce\Services;

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
        return null;
    }

    private function updateUserPermissions($userId, $userPermissions)
    {
    }

    private function getUserPermissions($productsPurchased)
    {
        return [];
    }
}
