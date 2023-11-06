<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\UserManagementSystem\Services\UserService;
use App\Providers\EcommerceUserProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncService
{
    use HandlesMaskedEmailAddress;

    private Shopify $shopify;
    private RechargeGateway $recharge;
    private UserProductService $userProductService;
    private ProductService $productService;
    private UserAccessPermissionsService $userAccessPermissionsService;
    private ShopifyCustomerService $shopifyCustomerService;
    private UserService $userService;
    private EcommerceUserProvider $ecommerceUserProvider;
    private ShopifyGateway $shopifyGateway;

    public function __construct(
        Shopify $shopify,
        ShopifyGateway $shopifyGateway,
        RechargeGateway $recharge,
        UserAccessPermissionsService $userAccessPermissionsService,
        ProductService $productService,
        UserProductService $userProductService,
        ShopifyCustomerService $shopifyCustomerService,
        UserService $userService,
        EcommerceUserProvider $ecommerceUserProvider,
    ) {
        $this->shopify = $shopify;
        $this->recharge = $recharge;
        $this->userProductService = $userProductService;
        $this->productService = $productService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
        $this->shopifyCustomerService = $shopifyCustomerService;
        $this->userService = $userService;
        $this->ecommerceUserProvider = $ecommerceUserProvider;
        $this->shopifyGateway = $shopifyGateway;
    }

    public function syncCustomer($shopifyCustomerId, $email = '', $skipRechargeSync = false): void
    {
        if (!config('shopify.enabled') || !$shopifyCustomerId) {
            return;
        }
        Log::debug("Customer $shopifyCustomerId: GetCustomerOrders");
        $orders = $this->shopifyGateway->getCustomerOrders($shopifyCustomerId);
        $skus = $orders->pluck('lineItems')->flatten(1)->pluck('sku')->unique()->toArray();
        $products = $this->productService->getProductsBySkus($skus);
        if ($products->contains(fn(Product $product) => $product->isDigital())) {
            $count = $orders->count();
            Log::debug("Customer $shopifyCustomerId: Found $count orders");
            $user = $this->getUser($shopifyCustomerId, $email);
            $this->userAccessPermissionsService->syncShopifyOrders($user, $orders, $products, $skipRechargeSync);
        } else {
            Log::debug("Customer $shopifyCustomerId: No digital products found");
            $user = $this->userService->getUserByShopifyCustomerId($shopifyCustomerId);
            if ($user) {
                $this->userAccessPermissionsService->syncUser($user, $skipRechargeSync);
            }
        }
    }

    public function syncCustomerByEmail($email)
    {
        if (!config('shopify.enabled')) {
            return;
        }
        $customer = $this->getShopifyCustomer($email);
        if (!$customer) {
            throw new \Exception("Shopify customer not found for email: $email");
        }
        $this->syncCustomer($customer->id, $email);
    }

    public function syncOrder(
        User $user,
        array $productIds,
        string $brand,
        Carbon $processedAt,
        float $price,
        ?float $tax,
        ShopifyPaymentSourceEnum $paymentSource,
        ?string $currency
    ): void {
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
        $postData = $this->createOrderData(
            $customerShopifyId,
            $user->email,
            $productIds,
            $brand,
            $processedAt,
            $price,
            $tax,
            $paymentSource,
            $currency
        );

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
    public function doesOrderExist(?int $shopifyCustomerId, Carbon $processedAt): bool
    {
        if (!$shopifyCustomerId) {
            return false;
        }

        return $this->shopifyGateway->doesOrderExist($shopifyCustomerId, $processedAt);
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param int $customerShopifyId
     * @param string $email
     * @param int[] $productIds
     * @param string $brand
     * @param Carbon $processedAt
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
        float $tax,
        ShopifyPaymentSourceEnum $paymentSource,
        ?string $currency
    ): array {
        $data = [
            "customer" => ["id" => $customerShopifyId],
            "email" => $this->getEmailForShopify($email),
            "processed_at" => $processedAt,
            "subtotal_price" => number_format($price, 2, '.', ''),
            "total_outstanding" => "0.00",
            "total_price" => number_format($price + ($tax ?? 0), 2, '.', ''),
            "line_items" => $this->createOrderItems($productIds, $price),
            "currency" => $currency ?? 'USD',
            "metafields" => [
                [
                    "key" => ShopifyMetafieldKey::Brand->value,
                    "value" => $brand,
                    "type" => ShopifyMetafieldTypes::single_line_text_field->value,
                    "namespace" => ShopifyMetafieldNamespace::Musora->value
                ],
                [
                    "key" => ShopifyMetafieldKey::PaymentSource->value,
                    "value" => $paymentSource->value,
                    "type" => ShopifyMetafieldTypes::single_line_text_field->value,
                    "namespace" => ShopifyMetafieldNamespace::Musora->value
                ]
            ]
        ];

        if ($tax) {
            $data['total_tax'] = number_format($tax, 2, '.', '');
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
    private function createOrderItems(array $productIds, float $price): array
    {
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

    public function getUser(
        int $shopifyCustomerId,
        ?string $email = null
    ): ?User {
        $user = $this->userService->getUserByShopifyCustomerId($shopifyCustomerId);
        if ($user) {
            return $user;
        }
        if ($email) {
            $user = $this->userService->getByEmailOrNull($email);
            if ($user) {
                return $user;
            }
            return $this->userService->createUser(
                $email,
                config('user_management_system.default_user_password')
            );
        }
        throw new \Exception("User not found for shopify customer id $shopifyCustomerId");
    }

    public function ensureUserSynced(User $user)
    {
        $shopifyCustomer = $this->getShopifyCustomer($user->email);
        if ($shopifyCustomer && $user->isAccountSetup()) {
            $customerData = [];
            $customerData["metafields"] = [
                [
                    "key" => ShopifyMetafieldKey::Id->value,
                    "value" => (string)$user->id,
                    "type" => ShopifyMetafieldTypes::integer->value,
                    "namespace" => ShopifyMetafieldNamespace::Model_Users->value,
                ],
            ];
            $this->shopify->updateCustomer($shopifyCustomer->id, $customerData);
        }
    }

    public function getShopifyCustomer($email): mixed
    {
        $customers = $this->shopify->getCustomers(['email' => $email]);
        $customer = collect($customers)->first(fn($item) => $item->email === $email);
        return $customer;
    }
}
