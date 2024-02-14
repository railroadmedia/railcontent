<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
use App\Modules\EventDataSynchronizer\Jobs\ImpactTrackConversion;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ShopifyWebHookController extends Controller
{

    public function __construct(
        private ShopifySyncService $shopifySyncService,
        private ProductService $productService,
        private UserService $userService,
        private ShopifyGateway $shopifyGateway
    ) {
    }

    public function orderUpdated(Request $request)
    {
        try {
            $shopifyCustomerId = $request->get('customer')['id'];
            $email = $request->get('customer')['email'];
            $processedAt = $request->get('processed_at');

            if ($processedAt) {
                $launchDate = new Carbon(config('ecommerce.launch_date_times.shopify'));
                $processedAtDate = new Carbon($processedAt);
                if ($processedAtDate->isBefore($launchDate)) {
                    Log::debug("Shopify order updated webhook received: $shopifyCustomerId $email, processed at $processedAt. Ignoring update.");
                    return;
                }
            }

            Log::debug("Shopify order updated webhook received:$shopifyCustomerId $email");
            dispatch(new ShopifySyncCustomerJob($shopifyCustomerId, $email));
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    public function orderCreated(Request $request)
    {
        try {
            $shopifyCustomerId = $request->get('customer')['id'];
            $email = $request->get('customer')['email'];
            Log::debug("Shopify order created webhook received: $shopifyCustomerId $email");
            $this->handleOrderCreatedEventTracking($request->all());
            $this->updateLastTrialDate($shopifyCustomerId, $request);
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    private function updateLastTrialDate($shopifyCustomerId, Request $request)
    {
        $lineItems = $request['line_items'];
        foreach ($lineItems as $lineItem) {
            $sku = $lineItem['sku'];
            if (Product::IsTrialSku($sku)) {
                $trialProduct = $this->productService->getProductsBySkus([$sku])[0];
                $now = Carbon::now('UTC');
                $lastTrialEndDate = $now->addDays($trialProduct->getTrialDays());
                $this->shopifyGateway->updateCustomerLastTrialEndDate($shopifyCustomerId, $lastTrialEndDate);
                $this->userService->setTrialPeriod($shopifyCustomerId, $lastTrialEndDate);
                break;
            }
        }
    }

    public function refundCreated(Request $request): void
    {
        try {
            Log::debug('Shopify refund created webhook received');

            $orderId = $request->get('order_id');
            Log::info("Shopify refund created webhook received for order id: $orderId");

            $order = $this->shopifySyncService->getOrder($orderId);

            $this->handleOrderRefundEventTracking($order->getAttributes());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    private function handleOrderCreatedEventTracking($order): void
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

        // @TODO EVENT TRACKING: move to avo when migration is completed
        // Avo::order_placed($data);

        dispatch(new ImpactTrackConversion($user,  $brand, $order, $this->productService))->delay(Carbon::now()->addSeconds(3));
    }

    private function handleOrderRefundEventTracking($order): void
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

        // @TODO EVENT TRACKING: move to avo when migration is completed
        // Avo::order_refunded($data);
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

    public function getBrandFromOrder($order): string
    {
        $brand = $order[ShopifyMetafieldNamespace::Musora->value . '.' . ShopifyMetafieldKey::Brand->value] ?? null;
        if ($brand) {
            return $brand;
        }

        $product = Product::where('sku', $order['line_items'][0]['sku'])->first() ?? null;

        return $product->brand ?? 'musora';
    }

    private function getOrderEventData($order, string $brand): array
    {
        $paymentSource = $this->shopifySyncService->getOrderPaymentSource($order['id'])->value;

        Log::info('Testing shopify order webhook attributes data: ' . var_export($order['note_attributes'], true));

        return [
            'checkout_token' => $order['checkout_token'],
            'order_id' => $order['id'],
            'subtotal' => $order['subtotal_price'],
            'total' => $order['total_price'],
            'revenue' => intval($order['total_price']) + intval($order['total_discounts']),
            'shipping' => $order['total_shipping_price_set']['shop_money']['amount'],
            'tax' => $order['total_tax'],
            'discount' => $order['total_discounts'],
            'discount_codes' => $order['discount_codes'],
            'currency' => $order['currency'],
            'products' => $this->getProductList($order['line_items']),
            'brand' => $brand,
            'payment_source' => $paymentSource,
            'timestamp' => Carbon::parse($order['processed_at'])->timestamp,
        ];
    }
}
