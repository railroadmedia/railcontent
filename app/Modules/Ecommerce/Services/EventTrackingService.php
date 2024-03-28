<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
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

        $eventTrackingData = $this->getRefundData($refund, $order, $brand);

        Avo::order_refunded(AvoHelper::defaultEventProperties($eventTrackingData, $user));
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
            'products' => $this->getProductList($order['line_items']),
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
            ->map(fn($a) => floatval($a['presentment_money']['amount']))
            ->sum();

        $orderAdjustmentsAmount = collect($refund['order_adjustments'])
            ->pluck('amount_set')
            ->map(fn($a) => floatval($a['presentment_money']['amount']) * -1)
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
}
