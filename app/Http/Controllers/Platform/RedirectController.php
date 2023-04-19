<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Railroad\Railcontent\Services\ContentService;

class RedirectController extends BaseController
{

    private ContentService $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function homeRedirect()
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function profileRedirect()
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/dashboard");
    }

    public function paymentSettingsRedirect()
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/payments");
    }

    public function notificationsRedirect()
    {
        return redirect("/" . brand() . "/notifications");
    }

    public function notificationSettingsRedirect()
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/notifications");
    }

    public function redirect30day()
    {
        return view('pages.redirect30day');
    }

    public function redirectPurchase(Request $request, $domain, $brand)
    {
        $products = explode(',', $request->get('products'));

        /** @var Cohort $cohort */
        $cohort = Cohort::query()->whereIn('product_id', $products)->first();
        if ($cohort) {
            $content = $this->contentService->getById($cohort->content_id);
            if ($content['url']) {
                return redirect($content['url']);
            }
        }
        return redirect()->route('platform.home', ['brand' => $brand]);
    }
}
