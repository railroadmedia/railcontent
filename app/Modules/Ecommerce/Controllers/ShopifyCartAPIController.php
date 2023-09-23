<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\ShopifyStoreFrontAPIService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Signifly\Shopify\Shopify;

class ShopifyCartAPIController extends Controller
{
    private ShopifyStoreFrontAPIService $shopifyStoreFrontAPIService;

    private const SHOPIFY_CART_ID_SESSION_KEY = 'shopify_session_cart_id';

    public function __construct(ShopifyStoreFrontAPIService $shopifyStoreFrontAPIService)
    {
        $this->shopifyStoreFrontAPIService = $shopifyStoreFrontAPIService;
    }

    public function createOrAddToCart(Request $request)
    {
        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        var_dump(Session::all());

        if (empty($existingShopifyCartId)) {
            $cartData = $this->shopifyStoreFrontAPIService->createCart(['46137514361127' => 3], ['my-discount01']);

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        } else {
            $cartData = $this->shopifyStoreFrontAPIService->addToCart($existingShopifyCartId, ['46137514361127' => 3]);
        }

        return response("Yes!");
    }
}
