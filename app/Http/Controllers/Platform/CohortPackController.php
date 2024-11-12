<?php

namespace App\Http\Controllers\Platform;

use App\Modules\Content\Controllers\ChallengesMetaDataController;
use Illuminate\View\View;
use App\Modules\Content\Services\CohortService;
use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UserProductService as EcommerceUserProductService;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Throwable;

class CohortPackController
{
    public function __construct(
        private CohortService $cohortService,
        private ContentService $contentService,
        private UserAccessPermissionsService $userAccessPermissionsService,
        private ProductService $productService,
        private ChallengesMetaDataController $challengesMetaDataController,
    ) {
    }

    /**
     * @param $domain
     * @param $brand
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function template(Request $request, $domain, $brand, $slug, $purchased = false): View
    {
        return $this->challengesMetaDataController->enrollmentPage($request, $slug, $purchased);
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
     * @return JsonResponse|RedirectResponse
     * @throws ORMException
     * @throws Throwable
     */
    private function registerForProductPack(
        string $sku,
        string $successMessage,
        Request $request
    ): JsonResponse|RedirectResponse {
        if (user()?->isAMember()) {
            $user = new User(user()->id, user()->email, user()->getMembershipExpirationDate());
            $product = $this->productService->getBySku($sku);
            $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
                $user->getId(),
                [$product->id],
                Carbon::now(),
                '',
                UserAccessPermissionsSourceEnum::Challenges
            );

            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => $successMessage,
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
