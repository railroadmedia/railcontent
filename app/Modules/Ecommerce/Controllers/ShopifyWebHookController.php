<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncOrderPlaced;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

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
            dispatch(new CustomerIoSyncOrderPlaced($request->all()))->delay(Carbon::now()->addSeconds(3));
        } catch (\Exception $e) { //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
