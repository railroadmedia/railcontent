<?php

namespace App\Modules\EventDataSynchronizer\Listeners;

use App\Modules\Content\Models\UserPermission;
use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Events\UserProductsUpdated;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Railroad\Ecommerce\Events\Subscriptions\CommandSubscriptionRenewFailed;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Services\ConfigService;


class UserProductToUserContentPermissionListener
{
    private UserProductService $userProductService;
    private ProductService $productService;
    private ContentPermissionsService $contentPermissionsService;

    public function __construct(
        UserProductService $userProductService,
        ProductService $productService,
        ContentPermissionsService $contentPermissionsService,
    ) {
        $this->userProductService = $userProductService;
        $this->productService = $productService;
        $this->contentPermissionsService = $contentPermissionsService;
    }

    public function handleUserProductsUpdated(UserProductsUpdated $userProductsUpdated)
    {
        $this->syncUserId($userProductsUpdated->getUserId());
    }

    /**
     * @param CommandSubscriptionRenewFailed $commandSubscriptionRenewFailed
     */
    public function handleSubscriptionRenewalFailureFromDatabaseError(
        CommandSubscriptionRenewFailed $commandSubscriptionRenewFailed
    ) {
        try {
            error_log('--- Attempting to recover railcontent renewal permissions ---');
            $this->syncUserId($commandSubscriptionRenewFailed->getSubscription()->getUser()->getId());
            error_log(
                '--- Recovered railcontent renewal permissions successfully! user id: ' .
                $commandSubscriptionRenewFailed->getSubscription()->getUser()->getId() . ' ---'
            );
        } catch (\Exception $exception) {
            error_log(
                '--- Recovered railcontent renewal permissions FAILED! user id: ' .
                $commandSubscriptionRenewFailed->getSubscription()->getUser()->getId() . ' ---'
            );
            error_log($exception);
        }
    }

    public function syncUserId($userId)
    {
        $userPermissions = $this->buildUserPermissions($userId);
        $existingPermissions = UserPermission::query()->where('user_id', '=', $userId)
            ->whereIn('permission_id', array_keys($userPermissions))->get()->keyBy('permission_id');

        foreach ($userPermissions as $permissionId => $dates) {
            $expirationDate = $dates['expiration_date'];
            $startDate = $dates['start_date'] ?? Carbon::now();

            $existingPermission = $existingPermissions[$permissionId] ?? null;
            $now = Carbon::now();
            if (!$existingPermission) {
                $existingPermission = new UserPermission();
                $existingPermission->user_id = $userId;
                $existingPermission->permission_id = $permissionId;
                $existingPermission->created_on = $now;
            }
            $existingPermission->start_date = $startDate;
            $existingPermission->expiration_date = $expirationDate;
            $existingPermissions->updated_on = $now;
            $existingPermission->save();
        }
    }

    private function buildUserPermissions(int $userId): array
    {
        $userProducts = $this->userProductService->getUserProductsQuery($userId)->with('product')->get();
        $permissionsLookup = $this->contentPermissionsService->getAll()->keyBy(function ($permission) {
            return $permission->brand . '_' . $permission->name;
        });
        $permissionsToCreate = [];

        /** @var UserProduct $userProduct */
        foreach ($userProducts as $userProduct) {
            $product = $userProduct->product;
            $permissionNames = $product->getDigitalAccessPermissionNames();

            if (empty($permissionNames)) {
                continue;
            }

            foreach ($permissionNames as $permissionName) {
                // we need to check by brand as well since some permissions across brands have the same name
                $brand = $product->brand;
                $keyBrand = $brand . '_' . $permissionName;
                $keyGeneral = 'musora_' . $permissionName;
                $permission = $permissionsLookup[$keyBrand] ?? $permissionsLookup[$keyGeneral] ?? null;
                if (!$permission) {
                    Log::error(
                        "Permission $brand - $permissionName does not exist.  Fix issue with product $product->id - $product->name and resync."
                    );
                    continue;
                }
                $permissionId = $permission['id'];

                if (!array_key_exists($permissionId, $permissionsToCreate)
                    || $permissionsToCreate[$permissionId]['expiration_date'] < $userProduct->expiration_date) {
                    $permissionsToCreate[$permissionId] = [
                        'expiration_date' => $userProduct->expiration_date,
                        'start_date' => $userProduct->start_date,
                    ];
                }
            }
        }
        return $permissionsToCreate;
    }
}
