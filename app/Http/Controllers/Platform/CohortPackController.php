<?php

namespace App\Http\Controllers\Platform;

use App\Modules\Content\Services\CohortService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UserProductService as EcommerceUserProductService;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class CohortPackController
{

    private ProductRepository $productRepository;
    private UserProductService $userProductService;
    private EcommerceUserProductService $ecommerceUserProductService;
    private CohortService $cohortService;
    private ContentService $contentService;

    public function __construct(
        UserProductService $userProductService,
        EcommerceUserProductService $ecommerceUserProductService,
        ProductRepository $productRepository,
        CohortService $cohortService,
        ContentService $contentService
    ) {
        $this->userProductService = $userProductService;
        $this->ecommerceUserProductService = $ecommerceUserProductService;
        $this->productRepository = $productRepository;
        $this->cohortService = $cohortService;
        $this->contentService = $contentService;
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function template(Request $request, $domain, $brand, $slug, $purchased = false)
    {
        $cohort = $this->cohortService->getCohort($slug);
        if (!$cohort) {
            abort(404);
        }

        $productId = $cohort['product_id'];
        $product = $this->productRepository->findProduct($productId);

        $hasProduct = user() && $this->userProductService->hasProductNotCached(user()?->id, $productId);
        $nPackOwners = $this->userProductService->getNumberProductOwners($productId);
        $registerButtonUrl =
            (!$hasProduct) ?
                url()->route('platform.cohort.register', ['brand' => brand(), 'product' => $product->getSku()]) :
                '#final';

        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $cohort['enrollment_end_date']);
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $cohort['enrollment_start_date']);
        $now = Carbon::now();
        $enrollmentClosed = $endDate->lessThan($now) || $startDate->greaterThan($now);
        $initialBypassPermissions = ContentRepository::$bypassPermissions;
        $initialPullFutureContent = ContentRepository::$pullFutureContent;
        $initialContentStatuses = ContentRepository::$availableContentStatues;
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$pullFutureContent = true;
        ContentRepository::$availableContentStatues = false;
        $content = $this->contentService->getById($cohort['content_id']);
        ContentRepository::$bypassPermissions  = $initialBypassPermissions;
        ContentRepository::$pullFutureContent = $initialPullFutureContent;
        ContentRepository::$availableContentStatues = $initialContentStatuses;

        $cohort['course_url'] = ($content) ? $content->fetch('url', '') : '';
        $cohort['conversation_url'] =
            $cohort['conversation_thread_id'] ?
                url()->route('forums.jump-to-thread', ['threadId' => $cohort['conversation_thread_id']]) : '';

        return view('content.cohort-template', [
            'hasProduct' => $hasProduct,
            'nPackOwners' => $nPackOwners,
            'registerButtonUrl' => $registerButtonUrl,
            'brand' => brand(),
            'cohort' => $cohort,
            'enrollmentClosed' => $enrollmentClosed,
            'homeUrl' => url()->route('platform.home', ['brand' => brand()]),
            'purchased' => $purchased
        ]);
    }

    public function purchased(Request $request, $domain, $brand, $slug)
    {
        return $this->template($request, $domain, $brand, $slug, purchased: true);
    }

    public function register(Request $request, $domain, $brand, $sku)
    {
        $successMessage = 'Success! You have registered. Check your email for the details.';

        return $this->registerForProductPack($sku, $successMessage, $request);
    }

    /**
     * @param string $sku
     * @param string $successMessage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Throwable
     */
    private function registerForProductPack(string $sku, string $successMessage, Request $request)
    {
        if (user()?->isAMember()) {
            $user = new User(user()->id, user()->email);

            /** @var Product $product */
            $product = $this->productRepository->bySku($sku);
            $this->ecommerceUserProductService->assignUserProduct($user, $product, null, 1);
            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => $successMessage
                    ],
                    200
                );
            }
            return redirect()
                ->back()
                ->with(
                    'success-message',
                    $successMessage
                );
        }

        $urlParams = [];
        $urlParams['products'][$sku] = 1;
        $urlParams['locked'] = true;
        $queryString = http_build_query($urlParams);

        return redirect()->away('/ecommerce/add-to-cart?' . $queryString);
    }

}
