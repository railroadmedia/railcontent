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

    public function registerFor30DayDrummer2(Request $request)
    {
        $sku = "30-day-drummer-2";
        $successMessage = 'Success! You have registered for 30-Day Drummer. Check your email for the details.';

        return $this->registerForProductPack($sku, $successMessage);
    }

    public function registerNewPianoPlayersStartHere(Request $request)
    {
        $sku = "new-piano-players-start-here";
        $successMessage =
            'Success! You have registered for New Piano Players Start Here. Check your email for the details.';

        return $this->registerForProductPack($sku, $successMessage);
    }

    /**
     * @throws ORMException
     * @throws Exception
     */
    private function registerForProductPack(string $sku, string $successMessage)
    : RedirectResponse {
        if (user()?->isAMember()) {
            $user = new User(user()->id, user()->email);

            /** @var Product $product */
            $product = $this->productRepository->bySku($sku);
            if (config('shopify.enabled')) {
                $productId = $product->getId();
                $userId = $user->getId();
                $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
                    $user->getId(),
                    [$product->getId()],
                    Carbon::now(),
                    "challenge-$productId-$userId",
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
