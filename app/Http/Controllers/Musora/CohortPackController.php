<?php

namespace App\Http\Controllers\Musora;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;
use Doctrine\ORM\ORMException;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CohortPackController
{
    private UserAccessPermissionsService $userAccessPermissionsService;
    private ProductService $productService;

    public function __construct(
        UserAccessPermissionsService $userAccessPermissionsService,
        ProductService $productService
    ) {
        $this->userAccessPermissionsService = $userAccessPermissionsService;
        $this->productService = $productService;
    }

    /**
     * @throws ORMException
     * @throws Throwable
     */
    private function registerForProductPack(string $sku, string $successMessage): RedirectResponse
    {
        if (user()?->isAMember()) {
            $product = $this->productService->getBySku($sku);
            $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
                user()->id,
                [$product->id],
                Carbon::now(),
                '',
                UserAccessPermissionsSourceEnum::Challenges
            );
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
