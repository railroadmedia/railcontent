<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncService
{
    private Shopify $shopify;
    private RechargeGateway $recharge;
    private UserProductService $userProductService;
    private ProductService $productService;
    private UserAccessPermissionsService $userAccessPermissionsService;
    private ShopifyCustomerService $shopifyCustomerService;

    public function __construct(
        Shopify $shopify,
        RechargeGateway $recharge,
        UserAccessPermissionsService $userAccessPermissionsService,
        ProductService $productService,
        UserProductService $userProductService,
        ShopifyCustomerService $shopifyCustomerService,
    ) {
        $this->shopify = $shopify;
        $this->recharge = $recharge;
        $this->userProductService = $userProductService;
        $this->productService = $productService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
        $this->shopifyCustomerService = $shopifyCustomerService;
    }

    public function syncCustomer($shopifyCustomerId)
    : void {
        if (!config('shopify.enabled')) {
            return;
        }
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        if (!$userId) {
            throw new \Exception("User not found for shopify customer id $shopifyCustomerId");
        }
        $orders = $this->shopify->getCustomerOrders($shopifyCustomerId, ['status' => 'any']);
        $this->userAccessPermissionsService->syncShopifyOrders($userId, $orders);
    }

    private function getUserIdFromShopifyCustomerId($shopifyCustomerId)
    {
        $user = User::query()->where('shopify_id', '=', $shopifyCustomerId)->first('id');
        return $user->id ?? null;
    }

    /**
     * @param User $user
     * @param int[] $productIds
     * @param string $brand
     * @param float $price
     * @param float|null $tax
     * @return void
     */
    public function syncOrder(User $user, array $productIds, string $brand, Carbon $processedAt, float $price, ?float $tax)
    : void {
        if (!config('shopify.enabled')) {
            return;
        }
        Log::debug("Start syncing purchase for user $user->id");
        // STEP 1: Is user synced?
        $customerShopifyId = $user->shopify_id;
        if (!$customerShopifyId) {
            $customerShopifyId = $this->shopifyCustomerService->createShopifyCustomer($user);
            if (!$customerShopifyId) {
                return;
            } // Return and it will be reprocessed in a command
        }

        Log::debug("User ID: $user->id; Customer Shopify ID: $customerShopifyId. Creating Shopify order payload");
        // STEP 2: create shopify order data
        $postData = $this->createOrderData($customerShopifyId, $user->email, $productIds, $brand, $processedAt, $price, $tax);

        Log::debug("User ID: $user->id; Customer Shopify ID: $customerShopifyId. Pushing order to Shopify");
        // STEP 3: push order to shopify
        $orderResource = $this->shopify->createOrder($postData);
        Log::info(
            "User ID: $user->id; Customer Shopify ID: $customerShopifyId. Created order $orderResource->id in Shopify"
        );

        // STEP 4: sync user products
        try {
            $this->syncCustomer($customerShopifyId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    /**
     * Checks if there's an order for a specific processed date
     *
     * @param int|null $shopifyCustomerId
     * @param Carbon $processedAt
     * @return bool
     */
    public function orderExistsForProcessDate(?int $shopifyCustomerId, Carbon $processedAt)
    : bool {
        if (!$shopifyCustomerId) {
            return false;
        }

        $orders =
            $this->shopify->getCustomerOrders($shopifyCustomerId, ['status' => 'any', 'processed_at' => $processedAt]);
        return $orders->count() > 0;
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param int $customerShopifyId
     * @param string $email
     * @param int[] $productIds
     * @param string $brand
     * @param float $price
     * @param float $tax
     * @return array
     */
    private function createOrderData(
        int $customerShopifyId,
        string $email,
        array $productIds,
        string $brand,
        Carbon $processedAt,
        float $price,
        float $tax
    )
    : array {
        $data = [
            "customer" => ["id" => $customerShopifyId],
            "email" => $email,
            "processed_at" => $processedAt,
            "source_name" => $brand,
            "subtotal_price" => number_format($price, 2),
            "total_outstanding" => "0.00",
            "total_price" => number_format($price + ($tax ?? 0), 2),
            "line_items" => $this->createOrderItems($productIds, $price),
        ];

        if ($tax) {
            $data['total_tax'] = number_format($tax, 2);
        }

        return $data;
    }

    /**
     * Create the data required for all Order Items of the Order
     *
     * @param int[] $productIds
     * @param float $price
     * @return array
     */
    private function createOrderItems(array $productIds, float $price)
    : array {
        return Product::whereIn('id', $productIds)
            ->get()
            ->map(
                fn(Product $product) => [
                    "price" => $price,
                    "quantity" => 1, // for digital products, only 1 item of each
                    "requires_shipping" => false, // no shipping required since it is for digital products
                    "sku" => $product->sku,
                    "title" => $product->name,
                    "variant_id" => $product->shopify_id,
                    "variant_inventory_management" => "shopify",
                    "vendor" => $product->brand,
                ]
            )->all();
    }
}
