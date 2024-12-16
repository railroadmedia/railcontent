<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Enums\PaymentType;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\PaymentMethod;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use App\Modules\EventDataSynchronizer\Jobs\EverflowTrackConversion;
use App\Modules\EventDataSynchronizer\Jobs\ImpactTrackConversion;
use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class EventTrackingService
{
    public function __construct(
        private readonly ShopifySyncService $shopifySyncService,
        private readonly CustomerIoService $customerIoService
    ) {
    }

    /**
     * @throws \Exception
     */
    public function handleOrderCreatedEventTracking(array $order): void
    {
        $user = $this->shopifySyncService->getOrCreateUser($order['customer']['id'], $order['customer']['email']);

        $brand = $this->getBrandFromOrder($order);
        $data = $this->getOrderEventData($order, $brand);

        dispatchWithDelay(
            new CustomerIoCreateEventByUserId(
                $user->id,
                $brand,
                'musora_user_order',
                $data,
                null,
                Carbon::parse($order['processed_at'])->timestamp
            ),
            3
        );


        if ($brand !== 'musora') {
            dispatchWithDelay(
                new CustomerIoCreateEventByUserId(
                    $user->id,
                    $brand,
                    $brand . "_user_order",
                    $data,
                    null,
                    Carbon::parse($order['processed_at'])->timestamp
                ),
                3
            );
        }

        // NOTE: BE-248 sync to musora prospects workspace if user is a musora prospect
        $customer = $this->customerIoService->getCustomerByEmail('musora_prospects', $user->email);
        if ($customer) {
            dispatchWithDelay(
                new CustomerIoCreateEventByUserId(
                    $user->id,
                    'musora_prospects',
                    'musora_user_order',
                    $data,
                    null,
                    Carbon::parse($order['processed_at'])->timestamp
                ),
                3
            );
        }

        try {
            Avo::order_placed(AvoHelper::defaultEventProperties($data, $user));
        } catch (\Exception $e) {
            // Do not block user flow if event tracking fails
            \Log::error($e->getMessage());
        }

        dispatchWithDelay(new ImpactTrackConversion($user, $brand, $order), 3);
        dispatchWithDelay(new EverflowTrackConversion($brand, $order['id']), 3);
    }

    public function handleOrderRefundEventTracking(array $refund, array $order): void
    {
        $user = User::query()->where('shopify_id', $order['customer']['id'])->first();

        $brand = $this->getBrandFromOrder($order);
        $data = $this->getRefundData($refund, $order, $brand);

        dispatchWithDelay(
            new CustomerIoCreateEventByUserId(
                $user->id,
                $brand,
                'musora_user_refund',
                $data,
                null,
                null
            ),
            3
        );

        try {
            $eventTrackingData = $this->getRefundData($refund, $order, $brand);
            Avo::order_refunded(AvoHelper::defaultEventProperties($eventTrackingData, $user));
        } catch (\Exception $e) {
            // Do not block user flow if event tracking fails
            \Log::error($e->getMessage());
        }
    }

    private function getProductList(array $lineItems = []): array
    {
        return collect($lineItems)
            ->map(function ($lineItem) {
                return [
                    'product_id' => $lineItem['product_id'],
                    'product_name' => $lineItem['name'],
                    'brand' => strtolower($lineItem['vendor']),
                    'price' => floatval($lineItem['price_set']['presentment_money']['amount']),
                    'quantity' => $lineItem['quantity'],
                    'variant_id' => $lineItem['variant_id'],
                    'variant_name' => $lineItem['variant_title'],
                    'sku' => $lineItem['sku'],
                ];
            })
            ->toArray();
    }

    public function getBrandFromOrder(array $order): string
    {
        $brand = $order[ShopifyMetafieldNamespace::Musora->value . '.' . ShopifyMetafieldKey::Brand->value] ?? null;
        if ($brand) {
            return strtolower($brand);
        }

        $product = Product::where('sku', $order['line_items'][0]['sku'])->first() ?? null;
        $brand = $product->brand ?? 'musora';

        return strtolower($brand);
    }

    private function getOrderEventData(array $order, string $brand): array
    {
        $paymentSource = $this->shopifySyncService->getOrderPaymentSource($order['id'])->value;

        $total = floatval($order['total_price_set']['presentment_money']['amount']);
        $discount = floatval($order['total_discounts_set']['presentment_money']['amount']);
        $products = $this->getProductList($order['line_items']);

        return [
            'checkout_token' => $order['checkout_token'],
            'order_id' => $order['id'],
            'subtotal' => floatval($order['subtotal_price_set']['presentment_money']['amount']),
            'total' => $total,
            'revenue' => $total + $discount,
            'shipping' => floatval($order['total_shipping_price_set']['presentment_money']['amount']),
            'tax' => floatval($order['total_tax_set']['presentment_money']['amount']),
            'discount' => $discount,
            'discount_tags' => $this->getDiscountCodes($order),
            'currency' => $order['total_price_set']['presentment_money']['currency_code'],
            'products' => $products,
            'order_sku_quantity' => count($products),
            'brand' => $brand,
            'payment_source' => $paymentSource,
            'timestamp' => Carbon::parse($order['processed_at'])->timestamp,
        ];
    }

    public function getRefundData(array $refund, array $order, string $brand): array
    {
        $refundLineItems = collect($refund['refund_line_items']);

        $refundLineItemsAmount = $refundLineItems
            ->pluck('subtotal_set')
            ->map(fn ($a) => floatval($a['presentment_money']['amount']))
            ->sum();

        $orderAdjustmentsAmount = collect($refund['order_adjustments'])
            ->pluck('amount_set')
            ->map(fn ($a) => floatval($a['presentment_money']['amount']) * -1)
            ->sum();

        $lineItems = $refundLineItems->pluck('line_item')->toArray();

        return [
            'refund_id' => $refund['id'],
            'order_id' => $refund['order_id'],
            'refund_amount' => $refundLineItemsAmount + $orderAdjustmentsAmount,
            'currency' => $order['total_price_set']['presentment_money']['currency_code'],
            'products' => $this->getProductList($lineItems),
            'brand' => $brand,
            'timestamp' => Carbon::parse($refund['processed_at'])->timestamp,
        ];
    }

    public function getDiscountCodes(array $order): array
    {
        return collect($order['discount_applications'])
            ->map(function (array $discount) {
                return match ($discount['type']) {
                    'automatic' => $discount['title'],
                    'discount_code' => $discount['code'],
                    default => $discount['description'] ?? ''
                };
            })->toArray();
    }

    public function trackPaymentMethodExpiryDate(User $user, ?PaymentMethod $paymentMethod): void
    {
        $expiryDate = null;
        if ($paymentMethod != null && $paymentMethod->paymentType === PaymentType::CreditCard) {
            $year = $paymentMethod->paymentDetails->exp_year;
            $month = $paymentMethod->paymentDetails->exp_month;
            $expiryDate = Carbon::now()->setYear($year)->setMonth($month)->endOfMonth()->timestamp;
        }

        $attribute = "_user_payment_primary-method-expiration-date";
        $data = collect(config('event-data-synchronizer.customer_io_brands_to_sync'))
            ->flatMap(fn (string $b) => [
                $b . $attribute => $expiryDate
            ])
            ->toArray();

        dispatchWithDelay(new CustomerIoSyncUserByUserId($user, $data), 30);
    }

    public function handleSubscriptionPaused(
        Subscription $subscription,
        User $user
    ): void {
        $expirationDate = Carbon::parse($user->membership_expiration_date);
        $nextCharge = $subscription->nextChargeScheduledAt;
        $diff = $expirationDate->diffInMonths($nextCharge);
        $data = [
            'timestamp' => Carbon::now()->timestamp,
            'duration_in_months' => $diff,
            'paused_until' => $nextCharge->timestamp,
        ];

        dispatchWithDelay(
            new CustomerIoSyncUserByUserId(
                $user,
                [$subscription->product->brand . '_subscription_paused_until' => $nextCharge->timestamp]
            ),
            30
        );

        dispatchWithDelay(
            new CustomerIoCreateEventByUserId(
                $user->id,
                'musora',
                'musora_user_subscription_paused',
                $data
            ),
            30
        );
    }

    public function handleSubscriptionCancelled(
        User $user,
        string $brand,
        Carbon $cancellation_date,
        mixed $cancellation_reason,
    ): void {
        $attributes = [];
        $attributes[$brand . '_membership_status'] = 'cancelled';
        $attributes[$brand . '_membership_subscription_cancellation-date'] = $cancellation_date->timestamp;
        $attributes[$brand . '_membership_subscription_cancellation-reason'] = $cancellation_reason;

        dispatch(
            (new CustomerIoSyncUserByUserId($user, $attributes))->delay(
                Carbon::now()
                    ->addSeconds(30)
            )
        );
    }

    public function handleChargeFailed(User $user, string $brand, int $chargeAttemps): void
    {
        $attributes = [
            'musora_retention_failed-billing_membership_subscription-renewal-attempts' => $chargeAttemps,
            $brand . '_retention_failed-billing_membership_subscription-renewal-attempts' => $chargeAttemps
        ];

        dispatch(
            (new CustomerIoSyncUserByUserId($user, $attributes))->delay(
                Carbon::now()
                    ->addSeconds(30)
            )
        );
    }

    public function handleSubscriptionExpired(User $user, string $brand): void
    {
        $attributes = [];
        $attributes[$brand . '_membership_status'] = 'expired';

        dispatch(
            (new CustomerIoSyncUserByUserId($user, $attributes))->delay(
                Carbon::now()
                    ->addSeconds(30)
            )
        );
    }
}
