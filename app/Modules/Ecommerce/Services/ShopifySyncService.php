<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Events\UserProductsUpdated;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifySyncService
{
    private Shopify $shopify;
    private RechargeGateway $recharge;
    private UserProductService $userProductService;
    private ProductService $productService;
    private MembershipTimeService $membershipTimeService;

    public function __construct(
        Shopify $shopify,
        RechargeGateway $recharge,
        MembershipTimeService $membershipTimeService,
        ProductService $productService,
        UserProductService $userProductService
    ) {
        $this->shopify = $shopify;
        $this->recharge = $recharge;
        $this->userProductService = $userProductService;
        $this->productService = $productService;
        $this->membershipTimeService = $membershipTimeService;
    }

    public function syncCustomer($shopifyCustomerId)
    {
        if (!config('shopify.enabled')) {
            return;
        }
        $userId = $this->getUserIdFromShopifyCustomerId($shopifyCustomerId);
        if (!$userId) {
            throw new \Exception("User not found for shopify customer id $shopifyCustomerId");
        }
        $orders = $this->shopify->getCustomerOrders($shopifyCustomerId, ['status' => 'any']);
        $membershipTimes = $this->membershipTimeService->syncShopifyOrders($userId, $orders);
        $membershipExpirationDate = $this->membershipTimeService->getMembershipExpirationDate($membershipTimes);
        $this->syncUserProducts($userId, $orders, $membershipTimes, $membershipExpirationDate);
        $this->syncSubscriptionData($userId, $shopifyCustomerId, $membershipExpirationDate);
    }

    /**
     * @param User $user
     * @param int[] $productIds
     * @param string $brand
     * @param float $price
     * @param float $tax
     * @return void
     */
    public function syncOrder(User $user, array $productIds, string $brand, float $price, float $tax)
    : void {
        if(!config('shopify.enabled')){
            return;
        }
        Log::debug("Start syncing purchase for user $user->id");
        // STEP 1: Is user synced?
        $customerShopifyId = $user->shopify_id;
        if (!$customerShopifyId) {
            $customerShopifyId = $this->shopifyCustomerService->createShopifyCustomer($user);
            if (!$customerShopifyId) return; // Return and it will be reprocessed in a command
        }

        Log::debug("User ID: $user->id; Customer Shopify ID: $customerShopifyId. Creating Shopify order payload");
        // STEP 2: create shopify order data
        $postData = $this->createOrderData($customerShopifyId, $user->email, $productIds, $brand, $price, $tax);

        Log::debug("User ID: $user->id; Customer Shopify ID: $customerShopifyId. Pushing order to Shopify");
        // STEP 3: push order to shopify
        $orderResource = $this->shopify->createOrder($postData);
        Log::info("User ID: $user->id; Customer Shopify ID: $customerShopifyId. Created order $orderResource->id in Shopify");

        // STEP 4: sync user products
        try {
            $this->syncCustomer($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
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
        float $price,
        float $tax
    )
    : array {
        return [
            "customer" => ["id" => $customerShopifyId],
            "email" => $email,
            "processed_at" => Carbon::now(),
            "source_name" => $brand,
            "subtotal_price" => $price,
            "total_outstanding" => 0,
            "total_price" => $price,
            "total_tax" => $tax,
            "line_items" => $this->createOrderItems($productIds, $price),
        ];
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
        return Product::whereIn('id', $productIds)->get()->map(
            fn (Product $product) => [
            "price" => $price,
            "quantity" => 1, // for digital products, only 1 item of each
            "requires_shipping" => false, // no shipping required since it is for digital products
            "sku" => $product->sku,
            "title" => $product->name,
            "variant_id" => $product->shopify_id,
            "variant_inventory_management" => "shopify",
            "vendor" => $product->brand,
        ]);
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
                $variantId = $lineItem['variant_id'];
                if (!($ownedProducts[$variantId] ?? null) || $ownedProducts[$variantId] < $createdAt) {
                    $ownedProducts[$variantId] = $createdAt;
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

        foreach ($ownedProducts as $shopifyVariantId => $createdAt) {
            $product = $products[$shopifyVariantId] ?? null;
            if (!$product) {
                Log::error("Shopify Product $shopifyVariantId not found");
                continue;
            }
            $expirationDate = ($membershipTimesLatestLookup[$shopifyVariantId]?->tempExpirationDate ??
                $product->calculateExpirationDate($createdAt))
                ->clone()
                ->addDays(config('ecommerce.days_before_access_revoked_after_expiry', 7));

            $userProduct = $this->createOrUpdateUserProduct(
                $product->id,
                $userId,
                $createdAt,
                $expirationDate,
                $existingUserProducts
            );
            $userProducts[$userProduct->product_id] = $userProduct;
            if ($product->digital_membership_access_expiration_date) {
                $bonusUserProduct = $this->handlePackMembershipBonus(
                    $product,
                    $membershipExpirationDate,
                    $existingUserProducts,
                    $userId,
                    $createdAt
                );
                if ($bonusUserProduct) {
                    $userProducts[$bonusUserProduct->product_id] = $bonusUserProduct;
                }
            }
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

    private function syncSubscriptionData(int $userId, int $shopifyCustomerId, ?Carbon $membershipExpirationDate)
    {
        $subscriptions = $this->recharge->getSubscriptions($shopifyCustomerId);
        $shopifyVariantIds = $subscriptions->pluck('shopify_variant_id')->toArray();
        $productLookup = $this->productService->getProductsByShopifyIdsQuery($shopifyVariantIds)
            ->keyBy('shopify_id');

        $membershipSubscriptions = $subscriptions->filter(function ($subscription) use ($productLookup) {
            $product = $productLookup[$subscription->shopify_variant_id] ?? null;
            if (!$product) {
                Log::error("Product not found for recharge subscription $subscription->id");
                return false;
            }
            return $product->isMembershipProduct() && $subscription->status == 'active';
        });

        $userProducts = $this->userProductService->getUserProductsQuery($userId)->with('product')->get();
        $isLifetimeMember = $userProducts->contains(function ($userProduct) {
            /** @var UserProduct $userProduct */
            return $userProduct->isValidLifeTime();
        });


        if ($isLifetimeMember) {
            foreach ($membershipSubscriptions as $membershipSubscription) {
                $this->recharge->cancelSubscription($membershipSubscription, 'Lifetime Member');
            }
        } elseif ($membershipSubscriptions->count() > 1) {
            $mostRecentSubscription = $subscriptions->sortByDesc('created_at')->first();

            foreach ($membershipSubscriptions as $membershipSubscription) {
                if ($membershipSubscription->id != $mostRecentSubscription->id) {
                    $this->recharge->cancelSubscription($membershipSubscription, 'Duplicate Subscription');
                }
            }

            $this->recharge->updateSubscriptionNextChargeDate($mostRecentSubscription, $membershipExpirationDate);
        }
    }

    private function handlePackMembershipBonus(
        Product $product,
        ?Carbon $membershipExpirationDate,
        int $userId,
        Carbon $createdAt,
        Collection $existingUserProducts
    ): ?UserProduct {
        if ($product->digital_membership_access_expiration_date > $membershipExpirationDate) {
            $bonusMembershipProductId = config('ecommerce.bonus_membership_product_id');
            return $this->createOrUpdateUserProduct(
                $bonusMembershipProductId,
                $userId,
                $createdAt,
                $product->digital_membership_access_expiration_date,
                $existingUserProducts
            );
        }
        return null;
    }

    private function getOwnedProductsArray($orders): array
    {
        $ownedProducts = [];
        /** @var OrderResource $order */
        foreach ($orders as $order) {
            $createdAt = Carbon::createFromDate($order->created_at);
            foreach ($order->line_items as $lineItem) {
                $variantId = $lineItem['variant_id'];
                if (!($ownedProducts[$variantId] ?? null) || $ownedProducts[$variantId] < $createdAt) {
                    $ownedProducts[$variantId] = $createdAt;
                }
            }
        }
        return $ownedProducts;
    }

    public function createOrUpdateUserProduct(
        int $productId,
        int $userId,
        Carbon $createdAt,
        ?Carbon $expirationDate,
        Collection $existingUserProducts
    ): UserProduct {
        $userProduct = $existingUserProducts[$productId] ?? null;
        if (!$userProduct) {
            $userProduct = new UserProduct();
            $userProduct->user_id = $userId;
            $userProduct->product_id = $productId;
            $userProduct->quantity = 1;
        }
        if ($userProduct->start_date != $createdAt || $userProduct->expiration_date != $expirationDate) {
            $userProduct->start_date = $createdAt;
            $userProduct->expiration_date = $expirationDate;
            $userProduct->save();
        }
        return $userProduct;
    }
}
