<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Console\Commands\PackBonusExpirationDateResyncTool;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class CustomerIoSyncOrderPlaced extends CustomerIoBaseJob
{
    private array $order;

    public function __construct(array $order)
    {
        $this->order = $order;
    }

    /**
     * @param ShopifySyncService $shopifySyncService
     * @return void
     */
    public function handle(ShopifySyncService $shopifySyncService): void
    {
        $order = $this->order;
        $user = User::query()->where('shopify_id', $order['customer']['id'])->first();

        $ownedProducts = $shopifySyncService
            ->getOwnedProducts($order['customer']['id'])
            ->pluck('product_id')
            ->unique()
            ->toArray();

        $brand = $order['source_name'] ?? 'musora';
        $data = [
            'checkout_token' => $order['checkout_token'],
            'processed_at' => $order['processed_at'],
            'order_id' => $order['id'],
            'subtotal' => $order['subtotal_price'],
            'total' => $order['total_price'],
            'currency' => $order['currency'],
            'tax' => $order['total_tax'],
            'revenue' => intval($order['total_price']) + intval($order['total_discounts']),
            'shipping' => $order['total_shipping_price_set']['shop_money']['amount'],
            'discount' => $order['total_discounts'],
            'brand' => $brand,
            'promo_code' => $order['discount_codes'],
            'products' => $this->getProductList($order['line_items']),
            'owned_products' => $ownedProducts,
        ];

        dispatch(
            new CustomerIoCreateEventByUserId(
                $user->id,
                $brand,
                'Order Placed',
                $data,
                null,
                $order['processed_at'],
            )
        )->delay(Carbon::now()->addSeconds(30));

        if ($brand !== 'musora') {
            dispatch(
                new CustomerIoCreateEventByUserId(
                    $user->id,
                    'musora',
                    'Order Placed',
                    $data,
                    null,
                    $order['processed_at'],
                )
            )->delay(Carbon::now()->addSeconds(30));
        }

        // @TODO EVENT TRACKING: move to avo when migration is completed
        // Avo::order_placed($data);
    }

    /**
     * @param array $lineItems
     * @return array
     */
    public function getProductList(array $lineItems = []): array
    {
        return collect($lineItems)
            ->map(function ($lineItem) {
                return [
                    'product_id' => $lineItem['product_id'],
                    'product_name' => $lineItem['name'],
                    'brand' => $lineItem['vendor'],
                    'price' => $lineItem['price'],
                    'quantity' => $lineItem['quantity'],
                    'variant_id' => $lineItem['variant_id'],
                    'variant_name' => $lineItem['variant_title'],
                    'sku' => $lineItem['sku'],
                ];
            })
            ->toArray();
    }
}
