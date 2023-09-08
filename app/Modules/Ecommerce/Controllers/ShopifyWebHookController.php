<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\ShopifySyncService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ShopifyWebHookController extends Controller
{
    private ShopifySyncService $shopifyOrderService;

    public function __construct(ShopifySyncService $shopifyOrderService)
    {
        $this->shopifyOrderService = $shopifyOrderService;
    }

    public function orderCreated(Request $request)
    {
        Log::debug('Shopify order created webhook received');
        Log::debug(print_r($request->all(), true));

        //TODO: Verify this is a genuine request from Shopify

        //TODO: Transform the request data into a format that can be used by the ShopifyOrderService
        $shopifyCustomerId = $request->get('customer')['id'];
        $this->shopifyOrderService->syncCustomer($shopifyCustomerId);

    }

}
