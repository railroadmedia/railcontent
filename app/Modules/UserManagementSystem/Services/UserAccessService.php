<?php

namespace App\Modules\UserManagementSystem\Services;

use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\UserProduct;
use Railroad\Ecommerce\Repositories\UserProductRepository;

class UserAccessService
{
    private static function getMembershipUserProduct($userId, array $userProducts = null): ?UserProduct
    {
        if (!isset($userProducts)) {
            /** @var UserProductRepository $userProductRepository */
            $userProductRepository = app(UserProductRepository::class);
            $userProducts = $userProductRepository->getAllUsersProducts($userId);
        }

        /** @var UserMembershipFieldsService $userMembershipFieldService */
        $userMembershipFieldService = app(UserMembershipFieldsService::class);

        return $userMembershipFieldService->getUserProductThatRepresentsUsersMembership($userId, $userProducts);
    }

    public static function isActiveAnnualRecurringMember($userId): bool
    {
        $userProduct = UserAccessService::getMembershipUserProduct($userId);

        if (!empty($userProduct) &&
            $userProduct->isValid() &&
            $userProduct->getProduct()->getType() == Product::TYPE_DIGITAL_SUBSCRIPTION &&
            $userProduct->getProduct()->getSubscriptionIntervalType() == 'year') {
            return true;
        }
        return false;
    }

   public static function isAnnualOrLifetimeMember()
    {
        $user = auth()->user();

        if (!empty($user)) {
            if ($user->isALifetimeMember() ||
                UserAccessService::isActiveAnnualRecurringMember($user->id)) {
                return true;
            }
        }

        return false;
    }
}
