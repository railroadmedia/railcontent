<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\ShopifyOrderService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ShopifyWebHookController extends Controller
{
    private ShopifyOrderService $shopifyOrderService;

    public function __construct(ShopifyOrderService $shopifyOrderService)
    {
        $this->shopifyOrderService = $shopifyOrderService;
    }

    public function orderCreated(Request $request)
    {
        Log::debug('Shopify order created webhook received');
        Log::debug(print_r($request->all(), true));

        //TODO: Verify this is a genuine request from Shopify

        //TODO: Transform the request data into a format that can be used by the ShopifyOrderService
        $customerId = $request->get('customer')['id'];
        $productsPurchased = $request->get('line_items');
        $this->shopifyOrderService->orderCreated($customerId, $productsPurchased);

    }

}
