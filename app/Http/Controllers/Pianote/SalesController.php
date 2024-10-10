<?php

namespace App\Http\Controllers\Pianote;

use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSendTransactionalEmail;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoTriggerEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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
        return view('pianote.sales.subscription', ['theme' => 'pianote', ]);
    }

    public function homeBF()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'bfVersion' => 'true']);
    }
    public function homeMonth()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'month' => true]);
    }
    public function promo()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'promoVersion' => 'true', 'promoPage' => 'true']);
    }
    public function restart()
    {
        return view('pianote.sales.restart', ['theme' => 'pianote']);
    }
    public function ultimatepractice()
    {
        return view('pianote.sales.ultimate-practice', ['theme' => 'pianote', 'smallPromoBanner' => 'true',]);
    }
    public function beginner()
    {
        return view('pianote.sales.beginner', ['theme' => 'pianote', 'smallPromoBanner' => 'true',]);
    }
    public function backToSchool()
    {
        return view('pianote.sales.back-to-school', ['theme' => 'pianote', 'smallPromoBanner' => 'true',]);
    }
    public function monthly()
    {
        return view('pianote.sales.monthly', ['theme' => 'pianote', 'smallPromoBanner' => 'true',]);
    }
    public function promoEG()
    {
        return view('pianote.sales.subscription', ['theme' => 'pianote', 'promoVersion' => 'true', 'evergreenVersion' => 'true']);
    }
    public function promoWO()
    {
        return view('pianote.sales.welcome-offer', ['theme' => 'pianote', 'promoVersion' => 'true']);
    }
    public function welcomeBackDiscount()
    {
        return view('pianote.sales.welcome-back-discount', ['theme' => 'pianote']);
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
    public function promoUT()
    {
        return view('pianote.sales.ultimate-technique', ['theme' => 'pianote', 'promoVersion' => 'true']);
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
        return view('pianote.sales.pages.lifetime', [ 'theme' => 'pianote' ]);
    }

    public function lifetimeDiscount()
    {
        return view('pianote.sales.pages.lifetime', [ 'theme' => 'pianote', 'upgradeVersion' => true  ]);
    }

    public function lisarecommends()
    {
        return view('pianote.pages.lisa-recommends', ['theme' => 'pianote']);
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
        return view('pianote.products.prestige-metronome', ['theme' => 'pianote', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function christmasSongbook()
    {
        return view('pianote.products.christmas-songbook', ['theme' => 'pianote']);
    }
    public function christmasSongbookMembers()
    {
        return view('pianote.products.christmas-songbook', ['theme' => 'pianote', 'membersVersion' => true]);
    }
    public function bookBag()
    {
        return view('pianote.products.book-bag', ['theme' => 'pianote']);
    }
    public function bookBagMembers()
    {
        return view('pianote.products.book-bag', ['theme' => 'pianote', 'membersVersion' => true]);
    }

    public function fiveforthreeBundle()
    {
        return view('pianote.products.5-for-3-bundle', ['theme' => 'pianote']);
    }

    public function newPianoPlayers()
    {
        $productId = 517;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('pianote.products.new-piano-players', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }
    public function easyChords()
    {
        $productId = 734;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('pianote.products.easy-chords', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }
    public function thirtyDayBluesPiano()
    {
        $productId = 740;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('pianote.products.30-day-blues-piano', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }

    // 408 is the 3 month access code product
    // 2 is the customer.io email ID from their system
    public function claimRoland90DaysAccess(Request $request)
    {
        // Validate email before proceeding

        $messages = [
            'email.already_pianote_user' => 'pianote_user',
            'email.code_claimed' => 'code_claimed'
        ];

        $validatedData = $request->validate([
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $user = DB::table('usora_users')
                    ->join('user_access_permissions', 'usora_users.id', '=', 'user_access_permissions.user_id')
                    ->where('usora_users.email', $value)
                    ->where(function ($query) {
                        $query->where(function ($query) {
                            $query->whereIn('user_access_permissions.permission_id', [77, 88]);
                        })
                        ->orWhere('user_access_permissions.product_id', 408);
                    })
                    ->first();

                    $codeClaimed = DB::table('usora_users')
                        ->join('ecommerce_access_codes', 'usora_users.id', '=', 'ecommerce_access_codes.claimer_id')
                        ->where('usora_users.email', $value)
                        ->where('ecommerce_access_codes.is_claimed', 1)
                        ->where('ecommerce_access_codes.source', 'roland-piano-promo')
                        ->exists();

                    if ($user && $codeClaimed) {
                        $fail('email.code_claimed');
                    } elseif ($user) {
                        $fail('email.already_pianote_user');
                    }
                }
            ],
        ], $messages);

        // If validation passes, the customer does not exist as pianote user or did not claim, continue with the process

        // create access code
        $accessCode = $this->accessCodeService->generateAccessCode([408], 'pianote', 'roland-piano-promo');

        // create the customer and send the email
        dispatch(
            (new CustomerIoSendTransactionalEmail(
                'pianote',
                2,
                $request->get('email'),
                ['access_code' => strtoupper($this->accessCodeService->hyphenateCode($accessCode->code))]
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


    public function betterTechnique()
    {
        $productId = 843;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('pianote.products.30-days-to-better-technique', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }

    public function readMusic()
    {
        $productId = 851;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('pianote.products.read-music', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }

    public function readMusicBook()
    {
        return view('pianote.products.read-music-book', ['theme' => 'pianote']);
    }

    public function practiceKit()
    {
        return view('pianote.products.practice-kit', ['theme' => 'pianote']);
    }

    public function easyChordsTrial()
    {
        return view('pianote.products.easy-chords-trial', ['theme' => 'pianote']);
    }

    public function yuletideshirtBundle()
    {
        return view('pianote.products.yuletide-shirt-bundle', ['theme' => 'pianote']);
    }

    public function yuletidesweaterBundle()
    {
        return view('pianote.products.yuletide-sweater-bundle', ['theme' => 'pianote']);
    }

    public function classicalPianoCollection()
    {
        $productId = 1044;
        /** @var UserAccessPermissionsService $userAccessPermissionsService */
        $userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $hasProduct = user() && $userAccessPermissionsService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userAccessPermissionsService->getNumberProductOwners($productId);

        return view('pianote.products.classical-piano-collection', [
            'recaptchaKey' => config('recaptcha.key'),
            'theme' => 'pianote',
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
        ]);
    }
    public function classicalPianoCollectionMembership()
    {
        return view('pianote.sales.classical-piano-collection-membership', [
            'theme' => 'pianote',
        ]);
    }
}
