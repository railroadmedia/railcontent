<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ShopifyWebHookController extends Controller
{
    private ShopifySyncService $shopifySyncService;

    public function __construct(ShopifySyncService $shopifyOrderService)
    {
        $this->shopifySyncService = $shopifyOrderService;
    }

    public function orderUpdated(Request $request)
    {
        try {
            Log::debug('Shopify order updated webhook received');
            //Log::debug(print_r($request->all(), true));

            $shopifyCustomerId = $request->get('customer')['id'];
            $email = $request->get('customer')['email'];
            Log::debug("Shopify customer id: $shopifyCustomerId email: $email");
            $this->shopifySyncService->syncCustomer($shopifyCustomerId, $email);
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    public function orderCreated(Request $request)
    {
        try {
            Log::debug('Shopify order created webhook received');
            //Log::debug(print_r($request->all(), true));

            $shopifyCustomerId = $request->get('customer')['id'];
            $email = $request->get('customer')['email'];
            Log::debug("Shopify customer id: $shopifyCustomerId email: $email");


            $this->handleOrderCreatedEventTracking($request->all());
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    private function handleOrderCreatedEventTracking($order): void
    {
        $user = User::query()->where('shopify_id', $order['customer']['id'])->first();

        $brand = $order[ShopifyMetafieldNamespace::Musora->value . '.' . ShopifyMetafieldKey::Brand->value] ?? 'musora';
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


    private function getProductList(array $lineItems = []): array
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
