<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Models\Cohort;
use App\Modules\Ecommerce\Services\ProductService;
use Illuminate\Http\Request;

class RedirectController extends BaseController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function homeRedirect(): RedirectResponse
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function profileRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/dashboard");
    }

    public function paymentSettingsRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/payments");
    }

    public function notificationsRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/notifications");
    }

    public function notificationSettingsRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/notifications");
    }

    public function redirect30day(): View
    {
        return view('pages.redirect30day');
    }

    public function redirectPurchase(Request $request, $domain, $brand): RedirectResponse
    {
        if ($brand == 'musora') {
            return redirect()->route('platform.onboarding');
        }

        $products = explode(',', $request->get('products'));

        /** @var Cohort $cohort */
        $cohort = Cohort::query()->whereIn('product_id', $products)->first();
        if ($cohort) {
            $product = $this->productService->getById($cohort['product_id']);

            $registerButtonUrl = url()->route(
                'platform.cohort.purchased',
                ['brand' => $brand, 'cohort' => $product->sku]
            );
            if ($registerButtonUrl) {
                return redirect($registerButtonUrl);
            }
        }
        return redirect()->route('platform.home', ['brand' => $brand]);
    }
}
