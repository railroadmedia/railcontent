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
//        session()->put('test1', 1);

        if (empty($existingShopifyCartId)) {
            $cartData = $this->shopifyStoreFrontAPIService->createCart(['46334167810343' => 3, '46137514590503' => 1],
                ['my-discount01']);

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        } else {
            $cartData = $this->shopifyStoreFrontAPIService->addToCart(
                $existingShopifyCartId,
                ['46334167810343' => 3, '46137514590503' => 1]
            );

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        }

        $responseData = $this->createLegacyCartResponseDataFromShopifyCartData($cartData);

        return response()->json($responseData, 200);
    }

    public function updateCartQuantity(Request $request)
    {
        // todo
        return response("Yes!");
    }

    public function deleteAllCartItems(Request $request)
    {
        // todo
        return response("Yes!");
    }

    private function createLegacyCartResponseDataFromShopifyCartData($shopifyCartData)
    {
        $legacyResponseData = [
            'data' => null,
            'meta' => [
                'cart' => [
                    'items' => [],
                    'totals' => [
                        "tax" => $shopifyCartData['cost']['totalTaxAmount']['amount'],
                        "due" => $shopifyCartData['cost']['totalAmount']['amount'],
                    ],
                ]
            ]
        ];

        if (!empty($shopifyCartData['lines']['edges'])) {
            foreach ($shopifyCartData['lines']['edges'] as $edge) {
                $shopifyLineItemData = $edge['node'];

                if (empty($shopifyLineItemData)) {
                    continue;
                }

                $legacyLineItemData = [
                    "id" => $shopifyLineItemData['merchandise']['id'],
                    "sku" => $shopifyLineItemData['merchandise']['sku'],
                    "name" => $shopifyLineItemData['merchandise']['product']['title'],
                    "quantity" => $shopifyLineItemData['quantity'],
                    "thumbnail_url" => $shopifyLineItemData['merchandise']['image']['url'],
                    "description" => $shopifyLineItemData['merchandise']['product']['description'],
                    "price_before_discounts" => $shopifyLineItemData['cost']['subtotalAmount']['amount'],
                    "price_after_discounts" => $shopifyLineItemData['cost']['totalAmount']['amount'],
                ];

                $legacyResponseData['meta']['cart']['items'][] = $legacyLineItemData;
            }
        }

        return $legacyResponseData;
    }
}
