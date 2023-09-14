<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Events\UserProductsUpdated;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifySyncService
{
    private Shopify $shopify;
    private ContentPermissionsService $permissionService;

    public function __construct(Shopify $shopify, ContentPermissionsService $permissionService)
    {
        $this->shopify = $shopify;
        $this->permissionService = $permissionService;
    }

    public function syncCustomer($shopifyCustomerId)
    {
        if(!config('shopify.enabled')){
            return;
        }
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        if (!$userId) {
            throw new \Exception("User not found for shopify customer id $shopifyCustomerId");
        }
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

        event(new UserProductsUpdated($userId));
    }


}
