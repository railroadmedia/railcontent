<?php

namespace App\Http\Controllers\Guitareo;

use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalesController extends BaseController
{
    public function home()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo']);
    }

    public function homeMonth()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo', 'month' => true]);
    }

    public function trial()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo', 'trialVersion' => true, 'promoVersion' => 'true']);
    }

    public function promo()
    {
        return view('guitareo.sales.subscription', ['theme' => 'guitareo', 'promoVersion' => 'true']);
    }

    public function welcomeBackDiscount()
    {
        return view('guitareo.sales.welcome-back-discount', ['theme' => 'guitareo']);
    }

    public function choosePlan()
    {
        return view('guitareo.sales.choose-plan', ['theme' => 'guitareo']);
    }

    public function choosePlanStrumming()
    {
        return view('guitareo.sales.choose-plan-strumming', ['theme' => 'guitareo']);
    }

    public function choosePlanMonth(Request $request)
    {
        return view('guitareo.sales.choose-plan', ['theme' => 'guitareo', 'month' => true, 'referralCode' => $request->get('referralCode')]);
    }

    public function affiliates(Request $request, $domain, $page = null)
    {
        return view('guitareo.sales.affiliates.'.$page, ['theme' => 'guitareo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function cookie()
    {
        return view('guitareo.sales.pages.cookie');
    }

    public function terms()
    {
        return view('guitareo.sales.pages.terms');
    }

    public function privacy()
    {
        return view('guitareo.sales.pages.privacy');
    }

    public function lifetime()
    {
        return view('guitareo.shop.pages.lifetime-bundle', [ 'theme' => 'guitareo' ]);
    }
    public function salesLifetime()
    {
        return view('guitareo.sales.pages.lifetime', ['theme' => 'guitareo']);
    }
    public function lifetimeDiscount()
    {
        return view('guitareo.sales.pages.lifetime', ['theme' => 'guitareo', 'upgradeVersion' => true]);
    }


    public function welcome()
    {
        return view('guitareo.sales.pages.welcome-1');
    }

    public function welcome2()
    {
        return view('guitareo.sales.pages.welcome-2');
    }

    public function welcome3()
    {
        return view('guitareo.sales.pages.welcome-3');
    }

    public function aylarecommends()
    {
        return view('guitareo.pages.ayla-recommends');
    }

    public function survivalkitinstructions()
    {
        return view('guitareo.pages.survival-kit-instructions');
    }

    public function songs500()
    {
        return view('guitareo.products.500-songs', [ 'theme' => 'guitareo' ]);
    }

    public function acousticGuitarMadeEasy()
    {
        return view('guitareo.products.acoustic-guitar-made-easy', [ 'theme' => 'guitareo' ]);
    }

    public function guitarQuest()
    {
        return view('guitareo.products.guitar-quest', [ 'theme' => 'guitareo' ]);
    }

    public function guitarQuestDiscount()
    {
        return view('guitareo.products.guitar-quest-discount', [ 'theme' => 'guitareo' ]);
    }

    public function guitarQuestDiscountTricks()
    {
        return view('guitareo.products.guitar-quest-discount-tricks', [ 'theme' => 'guitareo' ]);
    }

    public function guitarQuestTestimonials()
    {
        return view('guitareo.pages.guitar-quest-testimonials', [ 'theme' => 'guitareo' ]);
    }

    public function gs(Request $request)
    {
        if ($request->get('utm_campaign') === 'gs27_aug2019') {
            return redirect('/acoustic-guitar-made-easy', [ 'theme' => 'guitareo' ]);
        }

        return view('guitareo.products.guitar-system', [ 'theme' => 'guitareo' ]);
    }

    public function guitarTechniqueMadeEasy()
    {
        return view('guitareo.products.guitar-technique-made-easy', [ 'theme' => 'guitareo' ]);
    }

    public function rhythmAndGroove()
    {
        return view('guitareo.products.rhythm-and-groove', [ 'theme' => 'guitareo' ]);
    }

    public function thirtyDaysToBetterStrumming()
    {
//        $productId = 741;
        $productId = 846;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('guitareo.products.30-days-to-better-strumming', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'guitareo',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }

    public function products(Request $request, $domain, $page = null)
    {
        return view('guitareo.products.' . $page, [ 'theme' => 'guitareo' ]);

        throw new NotFoundHttpException();
    }

    public function songs()
    {
        return view('guitareo.sales.features.songs', ['theme' => 'guitareo', 'page' => 'songs']);
    }

    public function coaches()
    {
        return view('guitareo.sales.features.coaches', ['theme' => 'guitareo', 'page' => 'coaches']);
    }

    public function method()
    {
        return view('guitareo.sales.features.method', ['theme' => 'guitareo', 'page' => 'method']);
    }
}
