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
    private ShopifyCustomerService $shopifyCustomerService;
    private ContentPermissionsService $permissionService;

    public function __construct(
        Shopify $shopify,
        ContentPermissionsService $permissionService,
        ShopifyCustomerService $shopifyCustomerService
    ) {
        $this->shopify = $shopify;
        $this->permissionService = $permissionService;
        $this->shopifyCustomerService = $shopifyCustomerService;
    }

    public function syncCustomer($shopifyCustomerId)
    {
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        if (!$userId) {
            throw new \Exception("User not found for shopify customer id $shopifyCustomerId");
        }
        $ownedProducts = $this->getOwnedProducts($shopifyCustomerId);
        $this->syncUserProducts($userId, $ownedProducts);
    }

    /**
     * @param User $user
     * @param Product $product
     * @param float $price
     * @param float $tax
     * @return void
     */
    public function syncOrder(User $user, Product $product, float $price, float $tax)
    : void {
        // STEP 1: Is user sync'ed?
        $customerShopifyId = $user->shopify_id;
        if (!$customerShopifyId) {
            $customerShopifyId = $this->shopifyCustomerService->createShopifyCustomer($user);
        }

        if (!$customerShopifyId) {
            // TODO: something happened and the customer wasn't created in Shopify. What to do?
        }

        // STEP 2: create shopify order data
        $postData = $this->createOrderData($customerShopifyId, $user->email, $product, $price, $tax);

        // STEP 3: push order to shopify
        $this->shopify->createOrder($postData);
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param int $customerShopifyId
     * @param string $email
     * @param Product $product
     * @param float $price
     * @param float $tax
     * @return array
     */
    private function createOrderData(
        int $customerShopifyId,
        string $email,
        Product $product,
        float $price,
        float $tax
    )
    : array {
        return [
            "customer" => ["id" => $customerShopifyId],
            "email" => $email,
            "note" => $product->note,
            "processed_at" => Carbon::now(),
            "source_name" => $product->brand,
            "subtotal_price" => $price,
            "total_outstanding" => 0,
            "total_price" => $price,
            "total_tax" => $tax,
            "line_items" => $this->createOrderItems($product, $price),
        ];
    }

    /**
     * Create the data required for all Order Items of the Order
     *
     * @param Product $product
     * @param float $price
     * @return array
     */
    private function createOrderItems(Product $product, float $price)
    : array {
        return [
            "price" => $price,
            "quantity" => 1,
            "requires_shipping" => false,
            "sku" => $product->sku,
            "title" => $product->name,
            "variant_id" => $product->shopify_id,
            "variant_inventory_management" => "shopify",
            "vendor" => $product->brand,
        ];
    }

    private function getUserIdFromShopifyCustomerId($shopifyCustomerId)
    {
        $user =
            User::query()
                ->where('shopify_id', '=', $shopifyCustomerId)
                ->first('id');
        return $user->id ?? null;
    }

    private function getOwnedProducts(int $shopifyCustomerId)
    : array {
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
        $products =
            Product::query()
                ->whereIn('shopify_id', array_keys($ownedShopifyProducts))
                ->get()
                ->keyBy('shopify_id');

        $userProducts = collect();

        $existingUserProducts =
            UserProduct::query()
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
        UserProduct::query()
            ->whereIn('id', $userProductIdsToDelete)
            ->delete();

        event(new UserProductsUpdated($userId));
    }

}
