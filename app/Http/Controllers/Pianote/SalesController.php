<?php

namespace App\Http\Controllers\Pianote;

use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSendTransactionalEmail;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoTriggerEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function App\Http\Controllers\Drumeo\array_entity_column;

class SalesController extends BaseController
{
    private AccessCodeService $accessCodeService;

    public function __construct(AccessCodeService $accessCodeService)
    {
        $this->accessCodeService = $accessCodeService;
    }


    public function home()
    {

        return view('pianote.sales.subscription', ['theme' => 'pianote', 'promoVersion' => 'true']);
    }

    public function homeBF()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'promoVersion' => 'true', 'bfVersion' => 'true']);
    }
    public function homeMonth()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'month' => true]);
    }
    public function promo()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'promoVersion' => 'true']);
    }
    public function trial()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'trialVersion' => true, 'promoVersion' => 'true']);
    }
    public function trialSongs()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'trialVersion' => true, 'promoVersion' => 'true', 'songsVersion' => 'true']);
    }
    public function trialBeginner()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'trialVersion' => true, 'promoVersion' => 'true', 'beginnerVersion' => 'true']);
    }

    public function trialPosters()
    {
        return view('pianote.sales.posters-trial', ['theme' => 'pianote', 'trialVersion' => true, 'promoVersion' => 'true']);
    }
    public function trialChords()
    {
        return view('pianote.sales.chords-trial', ['theme' => 'pianote', 'trialVersion' => true, 'promoVersion' => 'true']);
    }
    public function promoSS()
    {
        return view('pianote.sales.song-secrets-bonus', ['theme' => 'pianote', 'promoVersion' => 'true']);
    }
    public function choosePlan()
    {
        return view('pianote.sales.choose-plan', ['theme' => 'pianote']);
    }
    public function choosePlanMonth(Request $request)
    {
        return view('pianote.sales.choose-plan', ['theme' => 'pianote', 'month' => true, 'referralCode' => $request->get('referralCode')]);
    }

    public function about()
    {
        return view('pianote.sales.pages.about', ['theme' => 'pianote']);
    }

    public function app()
    {
        return view('pianote.sales.pages.app', ['theme' => 'pianote']);
    }

    public function cookie()
    {
        return view('pianote.sales.pages.cookie', ['theme' => 'pianote']);
    }

    public function terms()
    {
        return view('pianote.sales.pages.terms', ['theme' => 'pianote']);
    }

    public function privacy()
    {
        return view('pianote.sales.pages.privacy', ['theme' => 'pianote']);
    }

    public function songs()
    {
        return view('pianote.sales.features.songs', [ 'theme' => 'pianote', 'page' => 'songs']);
    }

    public function method()
    {
        return view('pianote.sales.features.method', [ 'theme' => 'pianote', 'page' => 'method']);
    }

    public function coaches()
    {
        return view('pianote.sales.features.coaches', [ 'theme' => 'pianote', 'page' => 'coaches']);
    }

    public function davidbennett()
    {
        return view('pianote.sales.affiliates.davidbennett', ['theme' => 'pianote', 'month' => true]);
    }

    public function affiliates(Request $request, $domain, $page = null)
    {
        return view('pianote.sales.affiliates.'.$page, ['theme' => 'pianote', 'month' => true]);

        throw new NotFoundHttpException();
    }

    public function giveaway()
    {
        return view('pianote.lead-gen.giveaway', ['theme' => 'pianote']);
    }

    public function products(Request $request, $domain, $page = null)
    {
        return view('pianote.products.'.$page);

        throw new NotFoundHttpException();
    }

    public function fasterfingers()
    {
        return view('pianote.products.faster-fingers', ['theme' => 'pianote']);
    }

    public function worshippiano()
    {
        return view('pianote.products.worship-piano', ['theme' => 'pianote']);
    }

    public function pianotechniquemadeeasy()
    {
        return view('pianote.products.piano-technique-made-easy', ['theme' => 'pianote']);
    }

    public function destupefyyourlefthand()
    {
        return view('pianote.products.destupefy-your-left-hand', ['theme' => 'pianote']);
    }

    public function playbeautifulpiano()
    {
        return view('pianote.products.play-beautiful-piano', ['theme' => 'pianote']);
    }

    public function beginnerclassicalpiano()
    {
        return view('pianote.products.beginner-classical-piano', ['theme' => 'pianote']);
    }

    public function beautifulBeginnerBundle()
    {
        return view('pianote.products.beautiful-beginner-bundle', [ 'theme' => 'pianote' ]);
    }

    public function lifetime()
    {
        return view('pianote.shop.pages.lifetime', [ 'theme' => 'pianote' ]);
    }

    public function lifetimeUpgrade()
    {
        return view('pianote.shop.pages.lifetime', [ 'theme' => 'pianote', 'upgradeVersion' => true  ]);
    }

    public function lisarecommends()
    {
        return view('pianote.shop.lisa-recommends', ['theme' => 'pianote']);
    }

    public function welcomeparty()
    {
        return view('pianote.lead-gen.welcome-party', ['theme' => 'pianote']);
    }

    public function jesusMolina()
    {
        return view('pianote.products.improvisation-with-jesus-molina', ['theme' => 'pianote']);
    }

    public function roland()
    {
        return view('pianote.sales.pages.roland', ['theme' => 'pianote']);
    }

    public function songs500()
    {
        return view('pianote.products.500-songs', ['theme' => 'pianote']);
    }

    public function PowerOfChords()
    {
        return view('pianote.products.the-power-of-chords', ['theme' => 'pianote']);
    }

    public function PowerOfChordsGiveaway()
    {
        return view('pianote.products.the-power-of-chords-giveaway', ['theme' => 'pianote']);
    }

    public function concertHeadphones()
    {
        return view('pianote.products.concert-headphones', ['theme' => 'pianote']);
    }

    public function concertHeadphonesMember()
    {
        return view('pianote.products.concert-headphones', ['memberVersion' => true]);
    }

    public function foundations()
    {
        return view('pianote.products.foundation-books', ['theme' => 'pianote']);
    }
    public function classicalPianoPieces()
    {
        return view('pianote.products.classical-piano-pieces', ['theme' => 'pianote']);
    }
    public function metronome()
    {
        return view('pianote.products.metronome', ['theme' => 'pianote']);
    }
    public function metronomePrestige()
    {
        return view('pianote.products.prestige-metronome', ['theme' => 'pianote', 'recaptchaKey'=>config('recaptcha.key')]);
    }
    public function christmasSongbook()
    {
        return view('pianote.products.christmas-songbook', ['theme' => 'pianote']);
    }

    public function newPianoPlayers()
    {
        /** @var \App\Modules\Ecommerce\Services\UserProductService $userProductService */
        $productId = 517;
        $userProductService = app(\App\Modules\Ecommerce\Services\UserProductService::class);
        $hasProduct = user() && $userProductService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userProductService->getNumberProductOwners($productId);

        return view('pianote.products.new-piano-players', [
            'recaptchaKey'=>config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }
    public function newPianoPlayersDeal()
    {
        return view('pianote.products.new-piano-players-deal', ['theme' => 'pianote']);
    }
    public function easyChords()
    {
        /** @var \App\Modules\Ecommerce\Services\UserProductService $userProductService */
        $productId = 734;
        $userProductService = app(\App\Modules\Ecommerce\Services\UserProductService::class);
        $hasProduct = user() && $userProductService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userProductService->getNumberProductOwners($productId);

        return view('pianote.products.easy-chords', [
            'recaptchaKey'=>config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }
    public function thirtyDayBluesPiano()
    {
        /** @var \App\Modules\Ecommerce\Services\UserProductService $userProductService */
        $productId = 740;
        $userProductService = app(\App\Modules\Ecommerce\Services\UserProductService::class);
        $hasProduct = user() && $userProductService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userProductService->getNumberProductOwners($productId);

        return view('pianote.products.30-day-blues-piano', [
            'recaptchaKey'=>config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }
    public function thirtyDayBluesPianoDeal()
    {
        return view('pianote.products.30-day-blues-piano-deal', [
            'theme' => 'pianote',
        ]);
    }


    // 408 is the 3 month access code product
    // 2 is the customer.io email ID from their system
    public function claimRoland90DaysAccess(Request $request)
    {
        // create access code
        $accessCode = $this->accessCodeService->generateAccessCode([408], 'pianote', 'roland-piano-promo');

        // create the customer and send the email
        dispatch(
            (new CustomerIoSendTransactionalEmail(
                'pianote',
                2,
                $request->get('email'),
                ['access_code' => strtoupper($this->accessCodeService->hyphenateCode($accessCode->getCode()))]
            ))
                ->onConnection(config('event-data-synchronizer.customer_io_queue_connection_name', 'database'))
                ->onQueue(config('event-data-synchronizer.customer_io_queue_name', 'customer_io'))
                ->delay(Carbon::now()->addSeconds(3))
        );

        // dispatch the event
        dispatch(
            (new CustomerIoTriggerEvent(
                'pianote',
                $request->get('email'),
                null,
                'pianote_onboarding_roland-trial',
                null
            ))
                ->onConnection(config('event-data-synchronizer.customer_io_queue_connection_name', 'database'))
                ->onQueue(config('event-data-synchronizer.customer_io_queue_name', 'customer_io'))
                ->delay(Carbon::now()->addSeconds(10))
        );

        return response()->json(['success' => true]);
    }
}
