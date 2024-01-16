<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
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

        dispatch(
            new CustomerIoCreateEventByUserId(
                $user->id,
                $brand,
                'musora_user_order',
                $data,
                null,
                Carbon::parse($order['processed_at'])->timestamp
            )
        )->delay(Carbon::now()->addSeconds(3));

        if ($brand !== 'musora') {
            dispatch(
                new CustomerIoCreateEventByUserId(
                    $user->id,
                    $brand,
                    $brand . "_user_order",
                    $data,
                    null,
                    Carbon::parse($order['processed_at'])->timestamp
                )
            )->delay(Carbon::now()->addSeconds(3));
        }

        Avo::order_placed(AvoHelper::defaultEventProperties($data, $user));

        dispatch(new ImpactTrackConversion($user, $brand, $order))->delay(Carbon::now()->addSeconds(3));
    }

    public function handleOrderRefundEventTracking(array $refund, array $order): void
    {
        $user = User::query()->where('shopify_id', $order['customer']['id'])->first();

        $brand = $this->getBrandFromOrder($order);
        $data = $this->getOrderEventData($order, $brand);

        dispatch(
            new CustomerIoCreateEventByUserId(
                $user->id,
                $brand,
                'musora_user_refund',
                $data,
                null,
                null
            )
        )->delay(Carbon::now()->addSeconds(3));

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
                    'price' => floatval($lineItem['price']),
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

        return [
            'checkout_token' => $order['checkout_token'],
            'order_id' => $order['id'],
            'subtotal' => floatval($order['subtotal_price']),
            'total' => floatval($order['total_price']),
            'revenue' => floatval($order['total_price']) + floatval($order['total_discounts']),
            'shipping' => floatval($order['total_shipping_price_set']['shop_money']['amount']),
            'tax' => floatval($order['total_tax']),
            'discount' => floatval($order['total_discounts']),
            'discount_codes' => $order['discount_codes'],
            'currency' => $order['currency'],
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
            ->pluck('subtotal')
            ->map(fn ($a) => floatval($a) * -1)
            ->sum();

        $orderAdjustmentsAmount = collect($refund['order_adjustments'])
            ->pluck('amount')
            ->map(fn ($a) => floatval($a))
            ->sum();

        $lineItems = $refundLineItems->pluck('line_item')->toArray();

        return [
            'refund_id' => $refund['id'],
            'order_id' => $refund['order_id'],
            'refund_amount' => $refundLineItemsAmount + $orderAdjustmentsAmount,
            'currency' => $order['currency'],
            'products' => $this->getProductList($lineItems),
            'brand' => $brand,
            'timestamp' => Carbon::parse($refund['processed_at'])->timestamp,
        ];
    }
}
