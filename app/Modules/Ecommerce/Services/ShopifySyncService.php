<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\PermissionsService;
use App\Modules\Ecommerce\Events\UserProductsUpdated;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifySyncService
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
        $this->syncUserProducts($userId, $ownedProducts);
    }

    private function getUserIdFromShopifyCustomerId($shopifyCustomerId)
    {
        $user = User::query()->where('shopify_id', '=', $shopifyCustomerId)->first('id');
        return $user->id ?? null;
    }

    private function getOwnedProducts(int $shopifyCustomerId): array
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

    private function syncUserProducts(mixed $userId, array $ownedShopifyProducts)
    {
        $products = Product::query()
            ->whereIn('shopify_id', array_keys($ownedShopifyProducts))
            ->get()
            ->keyBy('shopify_id');


        $userProducts = collect();

        $existingUserProducts = UserProduct::query()
            ->where('user_id', '=', $userId)
            ->get()
            ->keyBy('product_id');

        foreach ($ownedShopifyProducts as $shopifyProductId => $createdAt) {
            $product = $products[$shopifyProductId] ?? null;
            if (!$product) {
                Log::error("Shopify Product $shopifyProductId not found");
                continue;
            }
            $userProduct = $existingUserProducts[$product->id] ?? new UserProduct();
            $userProduct->user_id = $userId;
            $userProduct->product_id = $product->id;
            $userProduct->start_date = $createdAt;
            $userProduct->expiration_date = $product->calculateExpirationDate($createdAt);
            $userProduct->quantity = 1;
            $userProduct->save();
            $userProducts[$userProduct->product_id] = $userProduct;
        }
        $userProductIdsToDelete = [];
        foreach ($existingUserProducts as $existingUserProduct) {
            if (!array_key_exists($existingUserProduct->product_id, $userProducts->toArray())) {
                $userProductIdsToDelete[] = $existingUserProduct->id;
            }
        }
        UserProduct::query()->whereIn('id', $userProductIdsToDelete)->delete();

        event(new UserProductsUpdated($userId, collect($userProducts)));
    }


}
