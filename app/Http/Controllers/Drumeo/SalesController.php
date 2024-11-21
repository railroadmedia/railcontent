<?php

namespace App\Http\Controllers\Drumeo;

use App\Http\Controllers\BaseController;
use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @param stdClass[] $arrayOfEntities
 * @param string $getMethodName
 * @return array
 */
function array_entity_column(array $arrayOfEntities, $getMethodName)
{
    $arrayOfValues = [];

    foreach ($arrayOfEntities as $entity) {
        if (method_exists($entity, $getMethodName)) {
            $arrayOfValues[] = $entity->$getMethodName();
        }
    }

    return $arrayOfValues;
}
class SalesController extends BaseController
{
    public function ___construct()
    {
    }

    private AccessCodeService $accessCodeService;

    /**
     * MarketingController constructor.
     *
     * @param  AccessCodeService $accessCodeService
     */
    public function __construct(
        AccessCodeService $accessCodeService
    ) {
        $this->accessCodeService = $accessCodeService;

    }

    public function home()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo']);

    }
    public function homeBF()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'bfVersion' => 'true', 'noEverflow' => true, 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function homeMonth()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'month' => true]);
    }
    public function trial()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => true, 'trialVersion' => true ]);
    }
    public function trialKey()
    {
        return view('drumeo.sales.trial-key', ['theme' => 'drumeo', 'promoVersion' => true, 'keyPage' => true, 'trialVersion' => true ]);
    }
    public function trialBeginner()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => true, 'trialVersion' => true, 'beginnerVersion' => true ]);
    }
    public function promo()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => 'true', 'promoPage' => 'true', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function practiceAnywhere()
    {
        return view('drumeo.sales.practice-anywhere', ['theme' => 'drumeo', 'promoPage' => 'true', 'smallPromoBanner' => 'true', ]);
    }
    public function backToSchool()
    {
        return view('drumeo.sales.back-to-school', ['theme' => 'drumeo', 'promoPage' => 'true', 'smallPromoBanner' => 'true', ]);
    }
    public function guitarcenter()
    {
        return view('drumeo.sales.guitarcenter', ['theme' => 'drumeo', 'promoPage' => 'true', 'smallPromoBanner' => 'true', ]);
    }
    public function welcomeBackDiscount()
    {
        return view('drumeo.sales.welcome-back-discount', ['theme' => 'drumeo']);
    }
    public function restart()
    {
        return view('drumeo.sales.restart', ['theme' => 'drumeo']);
    }
    public function promoEG()
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => 'true', 'evergreenVersion' => 'true']);
    }
    public function choosePlanVDF()
    {
        return view('drumeo.sales.pages.vdf', ['theme' => 'drumeo']);
    }
    public function choosePlan()
    {
        return view('drumeo.sales.choose-plan', ['theme' => 'drumeo']);
    }
    public function choosePlanMonth(Request $request)
    {
        return view('drumeo.sales.choose-plan', ['theme' => 'drumeo', 'month' => true, 'referralCode' => $request->get('referralCode')]);
    }
    public function method()
    {
        return view('drumeo.sales.features.method', ['theme' => 'drumeo', 'page' => 'method']);
    }
    public function songs()
    {
        return view('drumeo.sales.features.songs', ['theme' => 'drumeo', 'page' => 'songs']);
    }
    public function coaches()
    {
        return view('drumeo.sales.features.coaches', ['theme' => 'drumeo', 'page' => 'coaches']);
    }
    public function salesUpgrade()
    {
        return view('drumeo.sales.pages.upgrade-offer', ['theme' => 'drumeo']);
    }
    public function salesLifetime()
    {
        return view('drumeo.sales.pages.lifetime', ['theme' => 'drumeo']);
    }
    public function lifetimeDiscount()
    {
        return view('drumeo.sales.pages.lifetime', ['theme' => 'drumeo', 'upgradeVersion' => true]);
    }
    public function thirtyDayDrummer()
    {
        $productId = 833;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-drummer-4', [
            'recaptchaKey' => config('recaptcha.key'),
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }
    public function thirtyDayDrummerEG()
    {
        $productId = 741;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-drummer', [
            'recaptchaKey' => config('recaptcha.key'),
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }
    public function thirtyDayChops()
    {
        $productId = 733;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-chops', [
            'recaptchaKey' => config('recaptcha.key'),
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }

    public function thirtyDayIndependence()
    {
        $productId = 844;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-independence', [
            'recaptchaKey' => config('recaptcha.key'),
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }
    public function thirtyDayDoubleBass()
    {
        $productId = 930;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-double-bass', [
            'recaptchaKey' => config('recaptcha.key'),
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }
    public function thirtyDayJazz()
    {
        $productId = 1165;
//        $productId = 930;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-jazz', [
            'recaptchaKey' => config('recaptcha.key'),
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }
    public function thirtyDayIndependenceDeal()
    {
        return view('drumeo.lead-gen.pages.30-day-independence-deal', ['theme' => 'drumeo']);
    }

    public function thirtyDayDrummerDeal()
    {
        return view('drumeo.lead-gen.pages.30-day-drummer-deal', ['theme' => 'drumeo']);
    }

    public function impact()
    {
        return view('drumeo.sales.pages.impact');
    }

    public function about()
    {
        return view('drumeo.sales.pages.about');
    }

    public function privacy()
    {
        return view('drumeo.sales.pages.privacy');
    }

    public function terms()
    {
        return view('drumeo.sales.pages.terms');
    }

    public function cookie()
    {
        return view('drumeo.sales.pages.cookie');
    }

    public function app()
    {
        return view('drumeo.sales.pages.app');
    }

    public function kids()
    {
        return view('drumeo.sales.pages.kids');
    }

    public function songDemo()
    {
        return view('drumeo.sales.pages.song-demo');
    }

    public function tomSawyer()
    {
        return view('drumeo.sales.pages.tom-sawyer');
    }

    public function awards()
    {
        return view('drumeo.lead-gen.pages.awards');
    }


    public function sonor()
    {
        return view('drumeo.sales.pages.sonor');
    }


    public function handleRedeemRequest(Request $request, $productType, $isNewAccount)
    {
        $data = [
            $productType => true,
            'newAccount' => $isNewAccount,
            'accessCodeArray' => $this->accessCodeService->checkAndSplitAccessCode($request->get('code'))
        ];
        return view('drumeo.pages.alesis', $data, ['theme' => 'drumeo']);
    }

    public function alesisNitro(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisNitro', true);
    }

    public function alesisNitroExisting(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisNitro', false);
    }

    public function alesisNitroPro(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisNitroPro', true);
    }

    public function alesisNitroProExisting(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisNitroPro', false);
    }

    public function alesisStrata(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisStrata', true);
    }

    public function alesisStrataExisting(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisStrata', false);
    }

    public function alesisCrimson(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisCrimson', true);
    }

    public function alesisCrimsonExisting(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisCrimson', false);
    }

    public function alesisStrataCore(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisStrataCore', true);
    }

    public function alesisStrataCoreExisting(Request $request)
    {
        return $this->handleRedeemRequest($request, 'alesisStrataCore', false);
    }

    public function yamaha(Request $request)
    {
        return $this->handleRedeemRequest($request, 'yamaha', true);
    }

    public function yamahaExisting(Request $request)
    {
        return $this->handleRedeemRequest($request, 'yamaha', false);
    }

    public function coachTrial(Request $request, $domain, $pageC = null)
    {
        return view('drumeo.sales.affiliate.coaches.'.$pageC, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }
    public function trialPages(Request $request, $domain, $pageT = null)
    {
        return view('drumeo.sales.trials.'.$pageT, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function estepario()
    {
        return view('drumeo.sales.affiliate.estepario', ['theme' => 'drumeo', 'month' => true]);
    }

    public function a(Request $request, $domain, $page = null)
    {
        return view('drumeo.sales.affiliate.'.$page, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function affiliates(Request $request, $domain, $page = null)
    {
        return view('drumeo.sales.affiliate.'.$page, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function ambassador(Request $request, $domain, $page = null)
    {
        return view('drumeo.sales.affiliate.'.$page, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function eardrums()
    {
        return view('drumeo.products.eardrums', ['theme' => 'drumeo', 'recaptchaKey' => config('recaptcha.key')]);
    }

    public function kit()
    {
        return view('drumeo.products.kit', ['theme' => 'drumeo', 'recaptchaKey' => config('recaptcha.key')]);
    }

    public function kitLifetime()
    {
        return view('drumeo.products.kit', ['theme' => 'drumeo', 'membersVersion' => true, 'recaptchaKey' => config('recaptcha.key')]);
    }

    public function pro()
    {
        return view('drumeo.products.pro');
    }

    public function jaredRecommends()
    {
        return view('drumeo.pages.jared-recommends');
    }

    public function giftCard()
    {
        return view('drumeo.products.gift-card', ['theme' => 'drumeo']);
    }

    public function easyRudimentsPlaylist()
    {
        return view('drumeo.pages.easy-rudiments-playlist', ['theme' => 'drumeo']);
    }

    public function fiveforthreeBundle()
    {
        return view('drumeo.products.5-for-3-bundle', ['theme' => 'drumeo']);
    }

    public function vote()
    {
        return view('drumeo.pages.vote', ['theme' => 'drumeo']);
    }

    public function headphones()
    {
        return view('drumeo.products.headphones', ['theme' => 'drumeo',]);
    }
}
