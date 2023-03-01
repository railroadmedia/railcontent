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
    public function homeMonth()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.subscription', ['products' => $products, 'theme' => 'drumeo', 'month' => true]);
    }
    public function promo()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.subscription', ['products' => $products, 'theme' => 'drumeo', 'promoVersion' => 'true']);
    }
    public function anniversary()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.march-promo', ['products' => $products, 'theme' => 'drumeo', 'promoVersion' => 'true']);
    }
    public function choosePlan()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.choose-plan', ['products' => $products, 'theme' => 'drumeo']);
    }
    public function choosePlanMonth()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.choose-plan', ['products' => $products, 'theme' => 'drumeo', 'month' => true]);
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
    public function salesUpgrade()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.pages.upgrade-offer', ['products' => $products]);
    }
    public function salesUpgradeLifetime()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.pages.lifetime', ['products' => $products]);
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

        return view('drumeo.products.quietkick', ['products' => $products, 'theme' => 'drumeo']);
    }
    public function eardrums()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.eardrums', ['products' => $products]);
    }
    public function thirtyDayDrummer()
    {
        $productId = 516;
        /** @var \App\Modules\Ecommerce\Services\UserProductService $userProductService */
        $userProductService = app(\App\Modules\Ecommerce\Services\UserProductService::class);
        $hasProduct = user() && $userProductService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $userProductService->getNumberProductOwners($productId);

        return view('drumeo.products.30-day-drummer', [
            'nPackOwners' => $nPackOwners,
            'theme' => 'drumeo',
            'hasProduct' => $hasProduct
        ]);
    }

    public function thirtyDayDrummerDeal()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.lead-gen.pages.30-day-drummer-deal', ['products' => $products]);
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


    public function sonor()
    {
        return view('drumeo.sales.pages.sonor');
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
