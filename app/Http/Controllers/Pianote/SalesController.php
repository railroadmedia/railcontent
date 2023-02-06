<?php

namespace App\Http\Controllers\Pianote;

use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSendTransactionalEmail;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoTriggerEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Railroad\Ecommerce\Services\AccessCodeService;
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
        return view('pianote.sales.subscription', ['theme' => 'pianote']);
    }
    public function homeMonth()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'month' => true]);
    }
    public function promo()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'promoVersion' => 'true']);
    }
    public function choosePlan()
    {
        return view('pianote.sales.choose-plan', ['theme' => 'pianote']);
    }
    public function choosePlanMonth()
    {
        return view('pianote.sales.choose-plan', ['theme' => 'pianote', 'month' => true]);
    }

    public function about()
    {
        return view('pianote.sales.pages.about');
    }

    public function app()
    {
        return view('pianote.sales.pages.app');
    }

    public function cookie()
    {
        return view('pianote.sales.pages.cookie');
    }

    public function terms()
    {
        return view('pianote.sales.pages.terms');
    }

    public function privacy()
    {
        return view('pianote.sales.pages.privacy');
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
        return view('pianote.lead-gen.giveaway');
    }

    public function products(Request $request, $domain, $page = null)
    {
        return view('pianote.products.'.$page);

        throw new NotFoundHttpException();
    }

    public function fasterfingers()
    {
        return view('pianote.products.faster-fingers');
    }

    public function worshippiano()
    {
        return view('pianote.products.worship-piano');
    }

    public function pianotechniquemadeeasy()
    {
        return view('pianote.products.piano-technique-made-easy');
    }

    public function destupefyyourlefthand()
    {
        return view('pianote.products.destupefy-your-left-hand');
    }

    public function playbeautifulpiano()
    {
        return view('pianote.products.play-beautiful-piano');
    }

    public function beginnerclassicalpiano()
    {
        return view('pianote.products.beginner-classical-piano');
    }

    public function lifetime()
    {
        return view('pianote.shop.pages.lifetime');
    }

    public function lifetimeMembers()
    {
        return view('pianote.sales.pages.lifetime-members');
    }

    public function lisarecommends()
    {
        return view('pianote.shop.lisa-recommends');
    }

    public function welcomeparty()
    {
        return view('pianote.lead-gen.welcome-party');
    }

    public function jesusMolina()
    {
        return view('pianote.products.improvisation-with-jesus-molina');
    }

    public function roland()
    {
        return view('pianote.sales.pages.roland', ['theme' => 'pianote']);
    }

    public function songs500()
    {
        return view('pianote.products.500-songs');
    }

    public function PowerOfChords()
    {
        return view('pianote.products.the-power-of-chords');
    }

    public function PowerOfChordsBootcamp()
    {
        return view('pianote.products.the-power-of-chords-bootcamp');
    }

    public function PowerOfChordsGiveaway()
    {
        return view('pianote.products.the-power-of-chords-giveaway');
    }

    public function concertHeadphones()
    {
        return view('pianote.products.concert-headphones');
    }

    public function foundations()
    {
        return view('pianote.products.foundation-books');
    }

    public function newPianoPlayers()
    {
        return view('pianote.products.new-piano-players');
    }
    public function newPianoPlayersDeal()
    {
        return view('pianote.products.30-day-drummer-deal');
    }


    // 408 is the 3 month access code product
    // 2 is the customer.io email ID from their system
    public function claimRoland90DaysAccess(Request $request)
    {
        // create access code
        $accessCode = $this->accessCodeService->generateAccessCode([408], 'pianote');

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
