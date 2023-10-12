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

    public function getCart(Request $request)
    {
        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        $cartData = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        $responseData = $this->createLegacyCartResponseDataFromShopifyCartData($cartData);

        return response()->json($responseData, 200);
    }

    public function createOrAddToCart(Request $request)
    {
        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);
        $productsToAdd = $request->get('products', []); // $products = ['product-sku' => quantity, ...]

        $productSKUsVariantIds =
            $this->shopifyStoreFrontAPIService->getProductVariantIdsFromSKUs(array_keys($productsToAdd));

        $productVariantIdsAndQuantitiesToAdd = [];

        foreach ($productsToAdd as $productSKUToAdd => $quantityToAdd) {
            $productVariantIdsAndQuantitiesToAdd[$productSKUsVariantIds[$productSKUToAdd]] = (integer)$quantityToAdd;
        }

        if (empty($existingShopifyCartId)) {
            $cartData = $this->shopifyStoreFrontAPIService->createCart(
                $productVariantIdsAndQuantitiesToAdd,
                ['my-discount01']
            );

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        } else {
            $cartData = $this->shopifyStoreFrontAPIService->addToCart(
                $existingShopifyCartId,
                $productVariantIdsAndQuantitiesToAdd
            );

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        }

        $responseData = $this->createLegacyCartResponseDataFromShopifyCartData($cartData);

        if ($request->expectsJson()) {
            return response()->json($responseData, 200);
        }

        $redirectResponse =
            $request->get('redirect') ? redirect()->away($request->get('redirect')) : redirect()->to(
                config('ecommerce.post_add_to_cart_redirect', '/order')
            );

        $redirectResponse->with('cart', $responseData['meta']['cart'] ?? []);
        $redirectResponse->with('referralCode', $request->get('referralCode'));

        session()->put('bonuses', []);

        $addedProducts = [];

        foreach ($productsToAdd as $productSKUToAdd => $quantityToAdd) {
            foreach ($responseData['meta']['cart']['items'] as $cartLineItem) {
                if ($cartLineItem['sku'] == $productSKUToAdd) {
                    $addedProducts[] = [
                        'name' => $cartLineItem['name'],
                        'description' => $cartLineItem['description'],
                        'thumbnail' => $cartLineItem['thumbnail_url'],
                    ];
                }
            }
        }

        if (!empty($addedProducts)) {
            session()->flash('addedProducts', $addedProducts);
            session()->flash('cartNumberOfItems', count($responseData['meta']['cart']['items'] ?? []));
            session()->flash('cartSubTotal', $responseData['meta']['cart']['totals']['due'] ?? 0);
        }

        return $redirectResponse;
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

    public function redirectToShopifyOrderForm(Request $request)
    {
        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        $cartData = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        $checkoutURL = $cartData['checkoutUrl'];

        // always use the checkout url for the current brand domain
        // (must be configured properly in shopify for the store)
        // if musora, do nothing
        if (!empty(brand())) {
            $checkoutURL = str_replace('musora.com', brand() . '.com', $checkoutURL);
        }

        return redirect()->away($checkoutURL);
    }

    private function createLegacyCartResponseDataFromShopifyCartData($shopifyCartData)
    {
        $legacyResponseData = [
            'data' => null,
            'meta' => [
                'cart' => [
                    'items' => [],
                    'totals' => [
                        "tax" => (float)($shopifyCartData['cost']['totalTaxAmount']['amount'] ?? 0),
                        "due" => (float)($shopifyCartData['cost']['totalAmount']['amount'] ?? 0),
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
                    "price_before_discounts" => (float)$shopifyLineItemData['cost']['subtotalAmount']['amount'],
                    "price_after_discounts" => (float)$shopifyLineItemData['cost']['totalAmount']['amount'],
                ];

                $legacyResponseData['meta']['cart']['items'][] = $legacyLineItemData;
            }
        }

        return $legacyResponseData;
    }
}
