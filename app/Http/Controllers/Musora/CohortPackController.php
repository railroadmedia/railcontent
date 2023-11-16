<?php

namespace App\Http\Controllers\Musora;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UserProductService;
use Throwable;

class CohortPackController
{

    private ProductRepository $productRepository;
    private UserProductService $userProductService;
    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(
        ProductRepository $productRepository,
        UserProductService $userProductService,
        UserAccessPermissionsService $userAccessPermissionsService,
    ) {
        $this->productRepository = $productRepository;
        $this->userProductService = $userProductService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    /**
     * @param string $sku
     * @param string $successMessage
     * @return RedirectResponse
     * @throws ORMException
     * @throws Throwable
     */
    private function registerForProductPack(string $sku, string $successMessage): RedirectResponse
    {
        if (user()?->isAMember()) {
            $user = new User(user()->id, user()->email);

            /** @var Product $product */
            $product = $this->productRepository->bySku($sku);
            if (config('shopify.enabled')) {
                $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
                    $user->getId(),
                    [$product->getId()],
                    Carbon::now(),
                    '',
                    UserAccessPermissionsSourceEnum::Challenges
                );
            } else {
                $this->userProductService->assignUserProduct($user, $product, null, 1);
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
