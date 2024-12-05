<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Ecommerce\Controllers\ShopifyCartAPIController;
use App\Modules\Ecommerce\Services\ShopifyAPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LoginPageController extends BaseController
{
    private ShopifyAPIService $shopifyAPIService;
    // DEV NOTE: there was a typo when this was first created within Shopify, and so we need to maintain it here
    private const SHOPIFY_MULTIPASS_KEY = 'shopify_mulitpass';
    private const REDIRECT_TO_MULTIPASS_KEY = 'redirect_to_multipass';
    private const SHOPIFY_CHECKOUT_URL_KEY = 'checkout_url';

    public function __construct(ShopifyAPIService $shopifyAPIService)
    {
        $this->shopifyAPIService = $shopifyAPIService;
    }

    public function show(Request $request)
    {
        // Shopify Multipass Logic
        // 1. if shopify_mulitpass query param = 1
        // 2. pass shopify_mulitpass query param and checkout_url query param to form (set checkout_url to referrer if empty)
        // 3. pass both values through login form to auth endpoint
        // 4. auth endpoint should log in redirect back to checkout_url with encoded json for shopify: https://shopify.dev/docs/api/multipass

        // only redirect already logged-in users to the platform if it's not a multipass request.
        if (!empty(user()) && $request->get(self::SHOPIFY_MULTIPASS_KEY, 0) != 1) {
            return redirect()->route('platform.home-redirect');
        }

        // always set checkout url to current session cart checkout url if it's not in the url params
        if ($request->get(self::SHOPIFY_MULTIPASS_KEY, 0) == 1 && empty($request->get(self::SHOPIFY_CHECKOUT_URL_KEY))) {
            $existingShopifyCartId = Session::get(ShopifyCartAPIController::SHOPIFY_CART_ID_SESSION_KEY);

            if (!empty($existingShopifyCartId)) {
                $cartData = $this->shopifyAPIService->getCart($existingShopifyCartId);
                $request[self::SHOPIFY_CHECKOUT_URL_KEY] = parse_url($cartData['checkoutUrl'], PHP_URL_PATH);
            }
        }

        // if the user just logged in, and it's a multipass request, redirect back to shopify multipass/checkout url
        if (!empty(user()) &&
            $request->get(self::SHOPIFY_MULTIPASS_KEY, 0) == 1 &&
            $request->get(self::REDIRECT_TO_MULTIPASS_KEY, 0) == 1) {

            if (!empty($request->get(self::SHOPIFY_CHECKOUT_URL_KEY))) {
                $shopifyRedirectUrl = config('shopify.storefront.host_name') . $request->get(self::SHOPIFY_CHECKOUT_URL_KEY);
            } else {
                // fallback if all else fails
                $shopifyRedirectUrl = 'https://www.drumeo.com/shop';
            }

            $shopifyMultipassToken = $this->shopifyAPIService->generateMultipassToken(
                user()->getEmail(),
                $shopifyRedirectUrl
            );

            $multipassLoginUrl = config('shopify.storefront.host_name') . '/account/login/multipass/' . $shopifyMultipassToken;

            return redirect()->away($multipassLoginUrl);
        }

        if ($request->get(self::SHOPIFY_MULTIPASS_KEY, 0) == 1) {
            // If there is a logged-in user, and it's a multipass request, always log the user out and force the
            // person to log in using the form. We must do this otherwise people cannot log out via Shopify.
            if (!empty(user())) {
                Auth::logout();
            }

            return view(
                'pages.login',
                [
                    'redirect' => url()->route(
                        'login',
                        [
                            self::SHOPIFY_MULTIPASS_KEY => 1,
                            self::REDIRECT_TO_MULTIPASS_KEY => 1,
                            self::SHOPIFY_CHECKOUT_URL_KEY => $request->get(self::SHOPIFY_CHECKOUT_URL_KEY),
                            'referrer' => $request->headers->get('referer', 'https://www.musora.com')
                        ]
                    )
                ]
            );
        }

        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }

    public function showResetForm(Request $request): View
    {
        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }
}
