<?php

namespace App\Http\Controllers\Platform;

use App\Modules\Ecommerce\Services\ShopifyAPIService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class LoginPageController extends BaseController
{

    private ShopifyAPIService $shopifyAPIService;

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

        // If user is already logged in and it's a shopify multipass request,
        // redirect straight back to shopify checkout_url or referrer with the encoded json.


        if (!empty(user())) {
            if ($request->get('shopify_mulitpass', 0) == 1) {
                if (!empty($request->get('checkout_url'))) {
                    $shopifyRedirectUrl = config('shopify.hostName') . $request->get('checkout_url');
                } else {
                    $shopifyRedirectUrl = $request->get(
                        'referrer',
                        $request->headers->get('referer', 'https://www.musora.com')
                    );
                }

                $shopifyMultipassToken = $this->shopifyAPIService->generateMultipassToken(
                    user()->getEmail(),
                    $shopifyRedirectUrl
                );

                $multipassLoginUrl = config('shopify.hostName') . '/account/login/multipass/' . $shopifyMultipassToken;

                return redirect()->away($multipassLoginUrl);
            }

            return redirect()->route('platform.home-redirect');
        }

        if ($request->get('shopify_mulitpass', 0) == 1) {
            return view(
                'pages.login',
                [
                    'redirect' => url()->route(
                        'login',
                        [
                            'shopify_mulitpass' => 1,
                            'checkout_url' => $request->get('checkout_url'),
                            'referrer' => $request->headers->get('referer', 'https://www.musora.com')
                        ]
                    )
                ]
            );
        }

        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }

    public function showResetForm(Request $request)
    {
        return view('pages.login', ['redirect' => $request->get('redirect_to')]);
    }
}
