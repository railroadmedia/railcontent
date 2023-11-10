<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Services\ShopifyAPIService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Signifly\Shopify\Shopify;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopifyCartAPIController extends Controller
{
    private ShopifyAPIService $shopifyStoreFrontAPIService;

    public const SHOPIFY_CART_ID_SESSION_KEY = 'shopify_session_cart_id';
    public const SHOPIFY_CART_LOCKED_SESSION_KEY = 'shopify_session_cart_locked';

    public function __construct(ShopifyAPIService $shopifyStoreFrontAPIService)
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
        $existingCart = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        $productSKUsAndQuantities = $request->get('products', []); // $products = ['product-sku' => quantity, ...]

        $productsWithSellingPlans =
            $this->shopifyStoreFrontAPIService->getProductsVariantsWithSellingPlansFromSKUs(
                array_keys($productSKUsAndQuantities)
            );

        $productVariantIdsAndQuantitiesToAdd = [];

        foreach ($productSKUsAndQuantities as $productSKUToAdd => $quantityToAdd) {
            $productVariantIdsAndQuantitiesToAdd[$productsWithSellingPlans[$productSKUToAdd]['id']] =
                [
                    'quantity' => (integer)$quantityToAdd,
                    'sellingPlanId' => $productsWithSellingPlans[$productSKUToAdd]['sellingPlan']['id'] ?? null
                ];
        }

        if (!empty($request->get('promo-code')) && is_string($request->get('promo-code'))) {
            $discountCodesToApply = explode(',', $request->get('promo-code'));
        } else {
            $discountCodesToApply = [];
        }

        if (empty($existingShopifyCartId) || empty($existingCart)) {
            $cartData = $this->shopifyStoreFrontAPIService->createCart(
                $productVariantIdsAndQuantitiesToAdd,
                $discountCodesToApply
            );

            if ($request->get('locked') == 'true') {
                Session::put(self::SHOPIFY_CART_LOCKED_SESSION_KEY, true);
            }

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        } else {
            // clear the cart if locked=true or it was locked previously
            if (Session::get(self::SHOPIFY_CART_LOCKED_SESSION_KEY, false) == true ||
                $request->get('locked') == 'true') {
                Session::forget(self::SHOPIFY_CART_LOCKED_SESSION_KEY);
                $this->shopifyStoreFrontAPIService->clearCart($existingShopifyCartId);
                $this->shopifyStoreFrontAPIService->applyDiscountCodes($existingShopifyCartId, []);
            }

            if ($request->get('locked') == 'true') {
                Session::put(self::SHOPIFY_CART_LOCKED_SESSION_KEY, true);
            }

            $cartData = $this->shopifyStoreFrontAPIService->addToCart(
                $existingShopifyCartId,
                $productVariantIdsAndQuantitiesToAdd,
                !empty($discountCodeToApply) ? [$discountCodeToApply] : []
            );

            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);
        }

        if ($request->get('referralCode')) {
            Session::put('referral_code', $request->get('referralCode'));
            Session::put('referral_code_product_sku', array_keys($productSKUsAndQuantities)[0]);
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

        foreach ($productSKUsAndQuantities as $productSKUToAdd => $quantityToAdd) {
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

    public function updateCartItemQuantity(Request $request)
    {
        $productSku = $request->segment(4);
        $newQuantity = $request->segment(5);

        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        if (empty($existingShopifyCartId)) {
            throw new NotFoundHttpException();
        }

        if (Session::get(self::SHOPIFY_CART_LOCKED_SESSION_KEY, false) == true) {
            Session::forget(self::SHOPIFY_CART_LOCKED_SESSION_KEY);
            $this->shopifyStoreFrontAPIService->clearCart($existingShopifyCartId);
            $this->shopifyStoreFrontAPIService->applyDiscountCodes($existingShopifyCartId, []);
        }

        $shopifyCartData = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        $productSKUVariantId =
            $this->shopifyStoreFrontAPIService->getProductVariantIdsFromSKUs([$productSku]
            )[$productSku] ?? null;

        if (empty($shopifyCartData['lines']['edges']) || empty($productSKUVariantId)) {
            throw new NotFoundHttpException();
        }

        $merchandiseLineItemId = null;

        if (!empty($shopifyCartData['lines']['edges'])) {
            foreach ($shopifyCartData['lines']['edges'] as $edge) {
                $shopifyLineItemData = $edge['node'];

                if (empty($shopifyLineItemData)) {
                    continue;
                }

                if ($shopifyLineItemData['merchandise']['id'] == $productSKUVariantId) {
                    $merchandiseLineItemId = $shopifyLineItemData['id'];
                }
            }
        }

        if (empty($merchandiseLineItemId)) {
            throw new NotFoundHttpException();
        }

        $cartData = $this->shopifyStoreFrontAPIService->updateCartItemQuantity(
            $existingShopifyCartId,
            $merchandiseLineItemId,
            $newQuantity
        );

        Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);

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

        return $redirectResponse;
    }

    public function deleteCartItem(Request $request)
    {
        $productSku = $request->segment(4);

        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        if (empty($existingShopifyCartId)) {
            throw new NotFoundHttpException();
        }

        if (Session::get(self::SHOPIFY_CART_LOCKED_SESSION_KEY, false) == true) {
            Session::forget(self::SHOPIFY_CART_LOCKED_SESSION_KEY);
            $this->shopifyStoreFrontAPIService->clearCart($existingShopifyCartId);
        }

        $shopifyCartData = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        $productSKUVariantId =
            $this->shopifyStoreFrontAPIService->getProductVariantIdsFromSKUs([$productSku]
            )[$productSku] ?? null;

        if (empty($shopifyCartData['lines']['edges']) || empty($productSKUVariantId)) {
            throw new NotFoundHttpException();
        }

        $merchandiseLineItemId = null;

        if (!empty($shopifyCartData['lines']['edges'])) {
            foreach ($shopifyCartData['lines']['edges'] as $edge) {
                $shopifyLineItemData = $edge['node'];

                if (empty($shopifyLineItemData)) {
                    continue;
                }

                if ($shopifyLineItemData['merchandise']['id'] == $productSKUVariantId) {
                    $merchandiseLineItemId = $shopifyLineItemData['id'];
                }
            }
        }

        if (empty($merchandiseLineItemId)) {
            throw new NotFoundHttpException();
        }

        $cartData = $this->shopifyStoreFrontAPIService->removeCartItems(
            $existingShopifyCartId,
            [$merchandiseLineItemId]
        );

        Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);

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

        return $redirectResponse;
    }

    public function deleteAllCartItems(Request $request)
    {
        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        if (empty($existingShopifyCartId)) {
            throw new NotFoundHttpException();
        }

        $shopifyCartData = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        $merchandiseLineItemIdsToDelete = [];

        if (!empty($shopifyCartData['lines']['edges'])) {
            foreach ($shopifyCartData['lines']['edges'] as $edge) {
                $shopifyLineItemData = $edge['node'];

                if (empty($shopifyLineItemData)) {
                    continue;
                }

                $merchandiseLineItemIdsToDelete[] = $shopifyLineItemData['id'];
            }
        }

        if (empty($merchandiseLineItemIdsToDelete)) {
            throw new NotFoundHttpException();
        }

        $cartData = $this->shopifyStoreFrontAPIService->removeCartItems(
            $existingShopifyCartId,
            $merchandiseLineItemIdsToDelete
        );

        Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $cartData['id']);

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

        return $redirectResponse;
    }

    public function redirectToShopifyOrderForm(Request $request)
    {
        $existingShopifyCartId = Session::get(self::SHOPIFY_CART_ID_SESSION_KEY);

        if (!empty($request->get('shopify-cart-id'))) {
            $existingShopifyCartId = $request->get('shopify-cart-id');
            Session::put(self::SHOPIFY_CART_ID_SESSION_KEY, $existingShopifyCartId);
        }

        $cartData = $this->shopifyStoreFrontAPIService->getCart($existingShopifyCartId);

        if (empty($cartData)) {
            return redirect()->back();
        }

        $checkoutURL = $cartData['checkoutUrl'];

        // If the user is logged in always send them to the multipass auth url first and
        // redirect them to the checkout after it authenticates them.
        if (!empty(user())) {
            $shopifyMultipassToken = $this->shopifyStoreFrontAPIService->generateMultipassToken(
                user()->getEmail(),
                $checkoutURL
            );

            $multipassLoginUrl = config('shopify.hostName') . '/account/login/multipass/' . $shopifyMultipassToken;

            return redirect()->away($multipassLoginUrl);
        }

        return redirect()->away($checkoutURL);
    }

    public function serveShopifyCartCustomizationScriptTagFile(Request $request)
    {
        $response = Response::make(
            file_get_contents(base_path('shopify_checkout_account_creation_link_injection_script.js')),
            200
        );
        $response->header('Content-Type', 'application/javascript');

        return $response;
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
                    'locked' => Session::get(self::SHOPIFY_CART_LOCKED_SESSION_KEY, false),
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
                    "thumbnail_url" => $shopifyLineItemData['merchandise']['image']['url'] ?? '',
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
