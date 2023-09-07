<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\PermissionsService;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifyOrderService
{
    private Shopify $shopify;
    private PermissionsService $permissionService;

    public function __construct(Shopify $shopify, PermissionsService $permissionService)
    {
        $this->shopify = $shopify;
        $this->permissionService = $permissionService;
    }

    public function syncCustomer($shopifyCustomerId)
    {
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        $ownedProducts = $this->getOwnedProducts($shopifyCustomerId);
        $userPermissions = $this->getUserPermissions($ownedProducts);

        $this->permissionService->syncPermissions($userId, $userPermissions);
    }

    public function getOwnedProducts(int $shopifyCustomerId): array
    {
        $orders = $this->shopify->getCustomerOrders($shopifyCustomerId);
        $ownedProducts = [];
        /** @var OrderResource $order */
        foreach ($orders as $order) {
            $createdAt = Carbon::createFromDate($order->created_at);
            foreach ($order->line_items as $lineItem) {
                $productId = $lineItem['product_id'];
                if (!($ownedProducts[$productId] ?? null) || $ownedProducts[$productId] < $createdAt) {
                    $ownedProducts[$productId] = $createdAt;
                }
            }
        }
        return $ownedProducts;
    }

    private function getUserIdFromShopifyCustomerId($shopifyCustomerId)
    {
        $user = User::query()->where('shopify_id', '=', $shopifyCustomerId)->first('id');
        return $user->id ?? null;
    }

    private function getUserPermissions(array $ownedProducts): array
    {
        $permissionsLookup = $this->permissionService->getAll()->keyBy(function ($permission) {
            return $permission->brand . '_' . $permission->name;
        });

        $permissionsToCreate = [];

        $products = Product::query()->whereIn('shopify_id', array_keys($ownedProducts))->get()->keyBy('shopify_id');
        foreach ($ownedProducts as $productId => $createdAt) {
            /** @var Product $product */
            $product = $products[$productId] ?? null;
            if (!$product) {
                continue;
            }
            $expirationDate = $product->calculateExpirationDate($createdAt);
            $permissionNames = $product->getDigitalAccessPermissionNames();
            if (empty($permissionNames)) {
                continue;
            }

            foreach ($permissionNames as $permissionName) {
                // we need to check by brand as well since some permissions across brands have the same name
                $brand = $product->brand;
                $keyBrand = $brand . '_' . $permissionName;
                $keyGeneral = 'musora_' . $permissionName;
                $permission = $permissionsLookup[$keyBrand] ?? $permissionsLookup[$keyGeneral] ?? null;
                if (!$permission) {
                    Log::error(
                        "Permission $brand - $permissionName does not exist.  Fix issue with product $product->id - $product->name and resync."
                    );
                    continue;
                }
                $permissionId = $permission['id'];

                if (!array_key_exists($permissionId, $permissionsToCreate)
                    || $permissionsToCreate[$permissionId]['expiration_date'] < $expirationDate) {
                    $permissionsToCreate[$permissionId] = [
                        'expiration_date' => $expirationDate,
                        'start_date' => $createdAt,
                    ];
                }
            }
        }
        return $permissionsToCreate;
    }


}
