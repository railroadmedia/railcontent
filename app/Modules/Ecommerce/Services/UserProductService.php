<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\UserProduct;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
use Railroad\Ecommerce\Repositories\UserProductRepository;

class UserProductService
{
    private UserProductRepository $userProductRepository;

    /**
     * @param UserProductRepository $userProductRepository
     */
    public function __construct(UserProductRepository $userProductRepository)
    {
        $this->userProductRepository = $userProductRepository;
    }

    public function getFirstUserProductBrand(int $userId, array $brands)
    : string {
        $result =
            UserProduct::query()
                ->join('ecommerce_products', 'ecommerce_user_products.product_id', '=', 'ecommerce_products.id')
                ->fromUser($userId)
                ->whereIn('ecommerce_products.brand', $brands)
                ->orderBy('ecommerce_user_products.created_at')
                ->first('ecommerce_products.brand');
        return $result['brand'] ?? '';
    }

    public function hasProductNotCached(int $userId, int $productId)
    : bool {
        $product =
            UserProduct::query()
                ->where('user_id', '=', $userId)
                ->where('product_id', '=', $productId)
                ->first();
        return $product && $product->isValid();
    }

    public function getNumberProductOwners(int $productId)
    : int {
        $count =
            UserProduct::query()
                ->where('product_id', '=', $productId)
                ->count();
        return $count;
    }

    public function getUserProductsQuery($userId)
    : Builder {
        return UserProduct::query()
            ->where('user_id', '=', $userId);
    }

    public function assignUserProduct(int $userId, int $productId, string $expirationDate)
    {
        $userProduct =
            UserProduct::query()
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

        if (!$userProduct) {
            $userProduct = new UserProduct();
            $userProduct->user_id = $userId;
            $userProduct->product_id = $productId;
            $userProduct->quantity = 1;
            $userProduct->expiration_date =
                Carbon::parse($expirationDate)
                    ->addDays(
                        config(
                            'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                            5
                        )
                    );
            $userProduct->save();

            $userProduct = $this->userProductRepository->find($userProduct->id);

            event(new UserProductCreated($userProduct));
        } else {
            $oldUserProduct = $this->userProductRepository->find($userProduct->id);

            UserProduct::query()
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->update([
                    'expiration_date' => Carbon::parse($expirationDate)
                        ->addDays(
                            config(
                                'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                                5
                            )
                        ),
                ]);
            $userProduct = $this->userProductRepository->find($oldUserProduct->getId());
            event(new UserProductUpdated($userProduct, $oldUserProduct));
        }
    }
}
