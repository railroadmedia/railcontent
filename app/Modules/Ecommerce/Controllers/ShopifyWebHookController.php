<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\EventTrackingService;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ShopifyWebHookController extends Controller
{

    public function __construct(
        private ShopifySyncService $shopifySyncService,
        private ProductService $productService,
        private UserService $userService,
        private ShopifyGateway $shopifyGateway,
        private EventTrackingService $eventTrackingService
    ) {
    }

    public function orderUpdated(Request $request)
    {
        try {
            $shopifyCustomerId = $request->get('customer')['id'];
            $email = $request->get('customer')['email'];
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
            $this->eventTrackingService->handleOrderCreatedEventTracking($request->all());
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

            $this->eventTrackingService->handleOrderRefundEventTracking($request->all(), $order->getAttributes());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
