<?php

namespace App\Http\Controllers\Drumeo;

use Illuminate\View\View;
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
     */
    public function __construct(
        AccessCodeService $accessCodeService
    ) {
        $this->accessCodeService = $accessCodeService;

    }

    public function home(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo']);

    }
    public function homeBF(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'bfVersion' => 'true']);
    }
    public function homeMonth(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'month' => true]);
    }
    public function trial(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => true, 'trialVersion' => true ]);
    }
    public function trialKey(): View
    {
        return view('drumeo.sales.trial-key', ['theme' => 'drumeo', 'promoVersion' => true, 'keyPage' => true, 'trialVersion' => true ]);
    }
    public function trialBeginner(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => true, 'trialVersion' => true, 'beginnerVersion' => true ]);
    }
    public function promo(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => 'true', 'promoPage' => 'true', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function practiceAnywhere(): View
    {
        return view('drumeo.sales.practice-anywhere', ['theme' => 'drumeo', 'promoPage' => 'true', 'smallPromoBanner' => 'true', ]);
    }
    public function restart(): View
    {
        return view('drumeo.sales.restart', ['theme' => 'drumeo']);
    }
    public function promoEG(): View
    {
        return view('drumeo.sales.subscription', ['theme' => 'drumeo', 'promoVersion' => 'true', 'evergreenVersion' => 'true']);
    }
    public function choosePlanVDF(): View
    {
        return view('drumeo.sales.pages.vdf', ['theme' => 'drumeo']);
    }
    public function choosePlan(): View
    {
        return view('drumeo.sales.choose-plan', ['theme' => 'drumeo']);
    }
    public function choosePlanMonth(Request $request): View
    {
        return view('drumeo.sales.choose-plan', ['theme' => 'drumeo', 'month' => true, 'referralCode' => $request->get('referralCode')]);
    }
    public function method(): View
    {
        return view('drumeo.sales.features.method', ['theme' => 'drumeo', 'page' => 'method']);
    }
    public function songs(): View
    {
        return view('drumeo.sales.features.songs', ['theme' => 'drumeo', 'page' => 'songs']);
    }
    public function coaches(): View
    {
        return view('drumeo.sales.features.coaches', ['theme' => 'drumeo', 'page' => 'coaches']);
    }
    public function salesUpgrade(): View
    {
        return view('drumeo.sales.pages.upgrade-offer', ['theme' => 'drumeo']);
    }
    public function salesLifetime(): View
    {
        return view('drumeo.sales.pages.lifetime', ['theme' => 'drumeo']);
    }
    public function lifetimeDiscount(): View
    {
        return view('drumeo.sales.pages.lifetime', ['theme' => 'drumeo', 'upgradeVersion' => true]);
    }
    public function thirtyDayDrummer(): View
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
    public function thirtyDayDrummerEG(): View
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
    public function thirtyDayChops(): View
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

    public function thirtyDayIndependence(): View
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
    public function thirtyDayDoubleBass(): View
    {
        $productId = 844;
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
    public function thirtyDayIndependenceDeal(): View
    {
        return view('drumeo.lead-gen.pages.30-day-independence-deal', ['theme' => 'drumeo']);
    }

    public function thirtyDayDrummerDeal(): View
    {
        return view('drumeo.lead-gen.pages.30-day-drummer-deal', ['theme' => 'drumeo']);
    }

    public function impact(): View
    {
        return view('drumeo.sales.pages.impact');
    }

    public function about(): View
    {
        return view('drumeo.sales.pages.about');
    }

    public function privacy(): View
    {
        return view('drumeo.sales.pages.privacy');
    }

    public function terms(): View
    {
        return view('drumeo.sales.pages.terms');
    }

    public function cookie(): View
    {
        return view('drumeo.sales.pages.cookie');
    }

    public function app(): View
    {
        return view('drumeo.sales.pages.app');
    }

    public function kids(): View
    {
        return view('drumeo.sales.pages.kids');
    }

    public function songDemo(): View
    {
        return view('drumeo.sales.pages.song-demo');
    }

    public function tomSawyer(): View
    {
        return view('drumeo.sales.pages.tom-sawyer');
    }

    public function awards(): View
    {
        return view('drumeo.lead-gen.pages.awards');
    }


    public function sonor(): View
    {
        return view('drumeo.sales.pages.sonor');
    }

    public function handleRedeemRequest(Request $request, $productType, $isNewAccount): View
    {
        $data = [
            $productType => true,
            'newAccount' => $isNewAccount,
            'accessCodeArray' => $this->accessCodeService->checkAndSplitAccessCode($request->get('code'))
        ];
        return view('drumeo.pages.alesis', $data);
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

    public function coachTrial(Request $request, $domain, $pageC = null): View
    {
        return view('drumeo.sales.affiliate.coaches.'.$pageC, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }
    public function trialPages(Request $request, $domain, $pageT = null): View
    {
        return view('drumeo.sales.trials.'.$pageT, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function estepario(): View
    {
        return view('drumeo.sales.affiliate.estepario', ['theme' => 'drumeo', 'month' => true]);
    }

    public function a(Request $request, $domain, $page = null): View
    {
        return view('drumeo.sales.affiliate.'.$page, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function affiliates(Request $request, $domain, $page = null): View
    {
        return view('drumeo.sales.affiliate.'.$page, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function ambassador(Request $request, $domain, $page = null): View
    {
        return view('drumeo.sales.affiliate.'.$page, ['theme' => 'drumeo', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function eardrums(): View
    {
        return view('drumeo.products.eardrums', ['theme' => 'drumeo', 'recaptchaKey' => config('recaptcha.key')]);
    }

    public function kit(): View
    {
        return view('drumeo.products.kit', ['theme' => 'drumeo', 'recaptchaKey' => config('recaptcha.key')]);
    }

    public function kitLifetime(): View
    {
        return view('drumeo.products.kit', ['theme' => 'drumeo', 'membersVersion' => true, 'recaptchaKey' => config('recaptcha.key')]);
    }

    public function pro(): View
    {
        return view('drumeo.products.pro');
    }

    public function jaredRecommends(): View
    {
        return view('drumeo.pages.jared-recommends');
    }

    public function giftCard(): View
    {
        return view('drumeo.products.gift-card', ['theme' => 'drumeo']);
    }

    public function easyRudimentsPlaylist(): View
    {
        return view('drumeo.pages.easy-rudiments-playlist', ['theme' => 'drumeo']);
    }

    public function fiveforthreeBundle(): View
    {
        return view('drumeo.products.5-for-3-bundle', ['theme' => 'drumeo']);
    }

    public function vote(): View
    {
        return view('drumeo.pages.vote', ['theme' => 'drumeo']);
    }

}
