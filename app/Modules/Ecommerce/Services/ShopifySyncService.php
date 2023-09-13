<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\PermissionsService;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifySyncService
{
    private Shopify $shopify;
    private PermissionsService $permissionService;
    private ShopifyCustomerService $shopifyCustomerService;

    public function __construct(
        Shopify $shopify,
        PermissionsService $permissionService,
        ShopifyCustomerService $shopifyCustomerService
    ) {
        $this->shopify = $shopify;
        $this->permissionService = $permissionService;
        $this->shopifyCustomerService = $shopifyCustomerService;
    }

    public function syncCustomer($shopifyCustomerId)
    {
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        $ownedProducts = $this->getOwnedProducts($shopifyCustomerId);
        $userPermissions = $this->getUserPermissions($ownedProducts);

        $this->permissionService->syncPermissions($userId, $userPermissions);
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
            "fulfillable_quantity" => 1,
            "fulfillment_service" => "manual",
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

    private function getUserPermissions(array $ownedProducts)
    : array {
        $permissionsLookup =
            $this->permissionService->getAll()
                ->keyBy(function ($permission) {
                    return $permission->brand . '_' . $permission->name;
                });

        $permissionsToCreate = [];

        $products =
            Product::query()
                ->whereIn('shopify_id', array_keys($ownedProducts))
                ->get()
                ->keyBy('shopify_id');
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

                if (!array_key_exists($permissionId, $permissionsToCreate) ||
                    $permissionsToCreate[$permissionId]['expiration_date'] < $expirationDate) {
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
