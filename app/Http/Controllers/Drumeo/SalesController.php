<?php

namespace App\Http\Controllers\Drumeo;

use App\Http\Controllers\BaseController;
use App\Listeners\OrderEventListener;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Railroad\Ecommerce\Repositories\ProductRepository;

use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Services\UserProductService;
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


    /**
     * @var UserProductService
     */
    private $userProductService;


    public function ___construct(UserProductService $userProductService, ProductRepository $productRepository)
    {
        $this->userProductService = $userProductService;
        $this->productRepository = $productRepository;
    }

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var OrderEventListener
     */
    private $orderEventListener;

    /**
     * MarketingController constructor.
     *
     * @param  DatabaseManager $databaseManager
     * @param  ProductRepository $productRepository
     * @param  OrderEventListener $orderEventListener
     */
    public function __construct(
        DatabaseManager $databaseManager,
        ProductRepository $productRepository,
        OrderEventListener $orderEventListener
    ) {
        $this->databaseManager = $databaseManager;
        $this->productRepository = $productRepository;
        $this->orderEventListener = $orderEventListener;
    }

    public function home()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.subscription', ['products' => $products, 'theme' => 'drumeo']);
    }
    public function promo()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.subscription', ['products' => $products, 'theme' => 'drumeo', 'promoVersion' => 'true']);
    }
    public function plan23()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.choose-plan', ['products' => $products, 'theme' => 'drumeo']);
    }
    public function method()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.features.method', ['products' => $products, 'theme' => 'drumeo', 'page' => 'method']);
    }
    public function songs()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.features.songs', ['products' => $products, 'theme' => 'drumeo', 'page' => 'songs']);
    }
    public function coaches()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.features.coaches', ['products' => $products, 'theme' => 'drumeo', 'page' => 'coaches']);
    }
    public function salesStudents()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.student-only', ['products' => $products]);
    }
    public function salesUpgrade()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.upgrade-offer', ['products' => $products]);
    }
    public function salesUpgradeLifetime()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.lifetime', ['products' => $products]);
    }

    public function Festival()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.festival', ['products' => $products]);
    }

    public function toneControl()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.tone-control-kit', ['products' => $products]);
    }
    public function quietKick()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.quietkick', ['products' => $products]);
    }
    public function eardrums()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.eardrums', ['products' => $products]);
    }
    public function thirtyDayDrummer()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.30-day-drummer', ['products' => $products]);
    }

    public function hitLikeAGirlSubmission(Request $request)
    {
        $code = false;

        if (session()->has('claimed_hlag')) {
            return redirect()
                ->away('/power-pack#customize-anchor')
                ->withErrors(['You cannot claim another code']);
        }

        $request->validate(
            [
                'email' => 'email',
            ]
        );

        // todo: better way to prevent abuse?
        session()->push('claimed_hlag', true);

        // todo: orderEventListener::generateAccessCode method was changed to from private to pubilc for use here - refactor it
        try{
            $code = $this->orderEventListener->generateAccessCode(124); // 124 is id for "Drumeo Edge Membership - Monthly" (sku: DLM-1-month)
        }catch(\Exception $e){
            error_log($e);
        }

        if(!$code){
            Mail::send(
                'emails.general',
                [
                    'user' => ['email' => 'The Drumeo server'],
                    'message' => 'An error occurred for a user tying to get a Hit-Like-A-Girl promo 1-month ' .
                        'access code. Please look up info about the user to see if maybe they\'ve tried again ' .
                        'successfully. If they haven\'t, please email them informing help on the way and then ' .
                        'development asking for a code to send them. The user\'s email is: ' .
                        $request->get('email') . ' (name: '  . $request->get('first_name')  . ' ' .
                        $request->get('last_name') . ')'],
                function (\Illuminate\Mail\Message $message) use ($request) {
                    $message->from('system@drumeo.com', 'Drumeo');
                    $message->to('support@drumeo.com')->subject('[Drumeo Edge] Your Free 30-Day Access Code');
                }
            );
            return redirect()->away('/power-pack#customize-anchor')->with(['error' => true]);
        }

        Mail::send(
            'emails.hit-like-a-girl-free-code-delivery',
            [
                'code' => $code,
                'firstName' => $request->get('first_name'),
                'lastName' => $request->get('last_name'),
            ],
            function (\Illuminate\Mail\Message $message) use ($request) {
                $message->from('support@drumeo.com', 'Drumeo');
                $message->to($request->get('email'))
                    ->subject('[Drumeo Edge] Your Free 30-Day Access Code');
            }
        );

        return redirect()
            ->away('/power-pack#customize-anchor')
            ->with(['success' => 'Your code has been sent to your email!']);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function registerFor30DayDrummer(Request $request)
    {
        if (is_current_user_a_member()) {
            $product = $this->productRepository->findOneBy(['sku' => '30-day-drummer']);
            $user = new User(current_user()->getId(), current_user()->getEmail());

            $this->userProductService->assignUserProduct($user, $product, null, 1);

            return redirect()->back()
                ->with('success-message', 'Success! You have registered for 30-Day Drummer. Check your email for the details.');
        }

        return redirect()->away(url()->route('shopping-cart.to-cart.api') . "?products[30-day-drummer]=1");
    }

    public function beginner()
    {
        return view('drumeo.sales.pages.beginner');
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

    public function drumFest()
    {
        return view('drumeo.sales.pages.drumfest');
    }

    public function awards()
    {
        return view('drumeo.lead-gen.pages.awards');
    }

    public function trial()
    {
        return view('drumeo.sales.trials.trial');
    }

    public function earthWorks()
    {
        return view('drumeo.sales.trials.earthworks');
    }

    public function coachesQuiz()
    {
        return view('drumeo.sales.trials.coaches-quiz');
    }

    public function thirtyDayTrial()
    {
        return view('drumeo.sales.trials.30-day-trial');
    }

    public function melodics()
    {
        return view('drumeo.sales.trials.melodics');
    }

    public function newDrummerTrial()
    {
        return view('drumeo.sales.trials.new-drummers-trial');
    }

    public function powerPack()
    {
        return view('drumeo.sales.trials.power-pack');
    }

    public function bestBookTrial()
    {
        return view('drumeo.sales.trials.bestbook-trial');
    }

    public function toolBoxTrial()
    {
        return view('drumeo.sales.trials.toolbox-trial');
    }

    public function vDrums()
    {
        return view('drumeo.sales.trials.vdrums');
    }

    public function sonor()
    {
        return view('drumeo.sales.trials.sonor');
    }

    public function coachTrial()
    {
        return view('drumeo.sales.trials.trial-selection.coach-trial');
    }

    public function chooseTrial()
    {
        return view('drumeo.sales.trials.trial-selection.choose-your-trial');
    }

    public function earthWorksTrial()
    {
        return view('drumeo.sales.trials.trial-selection.earthworks-trial');
    }

    public function coachQuizTrial()
    {
        return view('drumeo.sales.trials.trial-selection.coaches-quiz-trial');
    }

    public function chooseTrialMonth()
    {
        return view('drumeo.sales.trials.trial-selection.choose-your-trial-month');
    }

    public function melodicTrial()
    {
        return view('drumeo.sales.trials.trial-selection.melodics-trial');
    }

    public function newDrummerTrialMonth()
    {
        return view('drumeo.sales.trials.trial-selection.new-drummers-trial-month');
    }

    public function affiliateTrial()
    {
        return view('drumeo.sales.trials.trial-selection.affiliate-trial');
    }

    public function aric()
    {
        return view('drumeo.sales.trials.coaches.aric');
    }

    public function domino()
    {
        return view('drumeo.sales.trials.coaches.domino');
    }

    public function dorothea()
    {
        return view('drumeo.sales.trials.coaches.dorothea');
    }

    public function jared()
    {
        return view('drumeo.sales.trials.coaches.jared');
    }

    public function john()
    {
        return view('drumeo.sales.trials.coaches.john');
    }

    public function kaz()
    {
        return view('drumeo.sales.trials.coaches.kaz');
    }

    public function larnell()
    {
        return view('drumeo.sales.trials.coaches.larnell');
    }

    public function matt()
    {
        return view('drumeo.sales.trials.coaches.matt');
    }

    public function sarah()
    {
        return view('drumeo.sales.trials.coaches.sarah');
    }

    public function schack()
    {
        return view('drumeo.sales.trials.coaches.schack');
    }

    public function sharon()
    {
        return view('drumeo.sales.trials.coaches.sharon');
    }

    public function todd()
    {
        return view('drumeo.sales.trials.coaches.todd');
    }

    public function estepario()
    {
        return view('drumeo.sales.trials.affiliate.estepario');
    }

    public function a(Request $request, $domain, $page = null)
    {
        return view('drumeo.sales.trials.affiliate.'.$page);

        throw new NotFoundHttpException();
    }

    public function affiliates(Request $request, $domain, $page = null)
    {
        return view('drumeo.sales.trials.affiliate.'.$page);

        throw new NotFoundHttpException();
    }

    public function pro()
    {
        return view('drumeo.products.pro');
    }

    public function jaredRecommends()
    {
        return view('drumeo.drumshop.jared-recommends');
    }

    public function giftCard()
    {
        return view('drumeo.drumshop.pages.gift-card', ['theme' => 'drumeo']);
    }

    public function drummingSystem()
    {
        return view('drumeo.drumshop.pages.drumming-system', ['theme' => 'drumeo']);
    }
}
