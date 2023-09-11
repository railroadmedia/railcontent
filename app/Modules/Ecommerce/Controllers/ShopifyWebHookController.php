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

    public function orderUpdated(Request $request)
    {
        Log::debug('Shopify order updated webhook received');
        Log::debug(print_r($request->all(), true));

        $shopifyCustomerId = $request->get('customer')['id'];
        $this->shopifyOrderService->syncCustomer($shopifyCustomerId);
    }

}
