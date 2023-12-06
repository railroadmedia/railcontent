<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Collections\OrderCollection;
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
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\REST\Resources\OrderResource;
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

    public function syncCustomerByUser(User $user, bool $isRebuildingPermissions = false, bool $skipEventSync): void
    {
        if ($user->shopify_id) {
            $this->syncCustomer(
                $user->shopify_id,
                isRebuildingPermissions: $isRebuildingPermissions,
                skipEventSync: $skipEventSync
            );
        } else {
            $this->userAccessPermissionsService->syncUser($user, $skipEventSync);
        }
    }

    public function syncCustomer(
        $shopifyCustomerId,
        $email = '',
        bool $isRebuildingPermissions = false,
        bool $skipEventSync = false
    ): void {
        if (!$shopifyCustomerId) {
            $user = $this->userService->getByEmailOrNull($email);
            if ($user) {
                $this->userAccessPermissionsService->syncUser($user, $skipEventSync);
            }
            return;
        }
        Log::debug("Customer $shopifyCustomerId: GetCustomerOrders");
        $orders = $this->shopifyGateway->getCustomerOrders($shopifyCustomerId);
        $skus = $orders->pluck('lineItems')->flatten(1)->pluck('sku')->unique()->toArray();
        $products = $this->productService->getProductsBySkus($skus);
        if ($products->contains(fn(Product $product) => $product->isDigital())) {
            $count = $orders->count();
            Log::debug("Customer $shopifyCustomerId: Found $count orders");

            $user = $this->getOrCreateUser($shopifyCustomerId, $email);
            $orderCollection = new OrderCollection($orders, $products);
            $this->updateUserData($shopifyCustomerId, $user);
            $this->userAccessPermissionsService->syncShopifyOrders(
                $user,
                $orderCollection,
                $isRebuildingPermissions,
                $skipEventSync
            );
        } else {
            Log::debug("Customer $shopifyCustomerId: No digital products found");
            $user = $this->userService->getUserByShopifyCustomerId($shopifyCustomerId);
            if (!$user) {
                $user = $this->userService->getByEmailOrNull($email);
            }
            if ($user) {
                $this->userAccessPermissionsService->syncUser($user, $skipEventSync);
            }
        }
    }

    public function syncCustomerByEmail($email)
    {
        $emailShopify = $this->getEmailForShopify($email);
        $customers = $this->shopify->getCustomers(['email' => $email]);

        $customer = collect($customers)->first(fn($item) => strtolower($item->email) === strtolower($email));
        if (!$customer) {
            Log::warning("Customer with email $email not found in Shopify");
            return;
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
        Log::debug("Start syncing purchase for user $user->id");
        // STEP 1: Is user synced?
        $customerShopifyId = $user->shopify_id;
        if (!$customerShopifyId) {
            $customerShopifyId = $this->shopifyCustomerService->updateOrCreateShopifyCustomer($user);
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
        } catch (Exception $e) {
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

    public function getOrCreateUser(
        int $shopifyCustomerId,
        ?string $email = null
    ): User {
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
                config('user_management_system.default_user_password'),
                shopifyCustomerId: $shopifyCustomerId,
                requiresPasswordUpdate: true
            );
        }
        throw new Exception("User not found for shopify customer id $shopifyCustomerId");
    }

    /**
     * @param int $shopifyCustomerId
     * @return Collection
     */
    public function getOwnedProducts(int $shopifyCustomerId): Collection
    {
        $orders = $this->shopifyGateway->getCustomerOrders($shopifyCustomerId);
        return $orders->pluck('lineItems')->flatten(1);
    }

    /**
     * @throws Exception
     */
    public function getOrder(int $orderId): OrderResource
    {
        return $this->shopify->getOrder($orderId);
    }

    public function getCustomerOrderIdByProcessedAtDate(int $shopifyCustomerId, Carbon $processedAt): int|null
    {
        $orders = $this->shopifyGateway->getCustomerOrderByProcessAtDate($shopifyCustomerId, $processedAt);
        return collect($orders)->first()?->legacyResourceId ?? null;
    }

    public function updateUserData(int $shopifyCustomerId, User $user): void
    {
        $user->shopify_id = $shopifyCustomerId;
        $user->save();
    }

    public function cancelOrder(int $shopifyCustomerId, string $email, int $orderId): void
    {
        $this->shopify->cancelOrder($orderId);
        $this->syncCustomer($shopifyCustomerId, $email);
    }

    public function syncUser(User $user)
    {
        Log::debug("Shopify: syncing user $user->id");
        $customerResource = $this->getShopifyCustomer($user->email);

        $shopifyCustomerId = $customerResource['id'];
        $customerData = [];
        $customerData["metafields"] = $user->getNewMetafieldsForShopify();
        $this->shopify->updateCustomer($shopifyCustomerId, $customerData);

        // record the shopify ID on the User
        $user->shopify_id = $shopifyCustomerId;
        $user->saveWithoutUpdatedAt();
    }

    public function getShopifyCustomer($email): mixed
    {
        $customers = $this->shopify->getCustomers(['email' => $email]);
        $customer = collect($customers)->first(fn($item) => $item->email === $email);
        return $customer;
    }

    public function getOrderPaymentSource(int $orderId): ShopifyPaymentSourceEnum
    {
        $metafields = $this->shopify->getOrderMetafields($orderId);
        $paymentSource = collect($metafields)->first(
            fn($item) => $item->key === ShopifyMetafieldKey::PaymentSource->value
        );

        $paymentSourceEnum = ShopifyPaymentSourceEnum::tryFrom($paymentSource?->value);
        
        if (is_null($paymentSourceEnum)) {
            if (!is_null($paymentSource)) {
                Log::error(
                    "Unknown payment source from {ShopifyMetafieldKey::PaymentSource->value} metafield: {$paymentSource->value} on Shopify order $orderId"
                );
            }
            
            return ShopifyPaymentSourceEnum::Web;
        }

        return $paymentSourceEnum;
    }
}
