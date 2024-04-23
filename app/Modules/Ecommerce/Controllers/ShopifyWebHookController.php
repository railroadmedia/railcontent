<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Jobs\WebhookJob;
use App\Modules\Ecommerce\Jobs\Shopify\AddOrderTags;
use App\Modules\Ecommerce\Jobs\Shopify\RefundCreatedJob;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerJob;
use App\Modules\Ecommerce\Jobs\Shopify\OrderCreatedEventTrackingJob;
use App\Modules\Ecommerce\Jobs\Shopify\OrderCreatedUpdateLastTrialDataJob;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ShopifyWebHookController extends Controller
{
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
            $id = $this->getWebhookIdentifierOrGUID($request);
            $content = $request->all();
            $children = [
                new ShopifySyncCustomerJob($shopifyCustomerId, $email)
            ];
            dispatch(new WebhookJob('Shopify-order-updated', $id, $content, $children));
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json();
    }

    public function orderCreated(Request $request)
    {
        try {
            $shopifyCustomerId = $request->get('customer')['id'];
            $email = $request->get('customer')['email'];
            Log::debug("Shopify order created webhook received: $shopifyCustomerId $email");
            $id = $this->getWebhookIdentifierOrGUID($request);
            $contents = $request->all();
            $children = [
                new AddOrderTags(new Order(json_decode(json_encode($contents), false))),
                new OrderCreatedEventTrackingJob($contents),
                new OrderCreatedUpdateLastTrialDataJob($contents)
            ];
            dispatch(new WebhookJob('Shopify-order-created', $id, $contents, $children));
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json();
    }

    public function refundCreated(Request $request)
    {
        try {
            Log::debug('Shopify refund created webhook received');

            $orderId = $request->get('order_id');
            Log::info("Shopify refund created webhook received for order id: $orderId");
            $id = $this->getWebhookIdentifierOrGUID($request);
            $contents = $request->all();
            $children = [
                new RefundCreatedJob($orderId, $contents)
            ];
            dispatch(new WebhookJob("Shopify-order-refunded", $id, $contents, $children));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json();
    }

    private function getWebhookIdentifierOrGUID(Request $request)
    {
        return $request->header('x-shopify-webhook-id') ?? $request->header('X-Shopify-Webhook-Id') ?? uniqid('generated-');
    }
}
