<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserAccessPermissionsService
{
    const MembershipPermissions = [
        self::MusoraBasicMembershipPermission,
        self::MusoraPlusMembershipPermission
    ];
    const MusoraBasicMembershipPermission = 91;
    const MusoraPlusMembershipPermission = 92;
    const MusoraSongsAccessPermission = 94;
    const DrumeoLifetimePermission = 78;
    const LifetimePermissions = [self::DrumeoLifetimePermission, 88, 89, 90,];

    private ProductService $productService;
    private ContentPermissionsService $contentPermissionsService;

    private array $cachedPackPermissionIds;

    function __construct(ProductService $productService, ContentPermissionsService $contentPermissionsService)
    {
        $this->productService = $productService;
        $this->contentPermissionsService = $contentPermissionsService;
    }

    public function getUserAccessPermissions(int $userId)
    {
        return UserAccessPermission::query()->where('user_id', '=', $userId);
    }

    public function syncShopifyOrders(int $userId, $orders): void
    {
        $existingAccessPermissionsLookup = $this->getUserAccessPermissions($userId)->get()->keyBy(
            function (UserAccessPermission $permission) {
                return "$permission->source.$permission->source_hash";
            }
        );
        $variantIds = $orders->pluck('line_items')->flatten(1)->pluck('variant_id')->unique()->toArray();
        $productLookup = $this->productService->getProductsByShopifyIdsQuery($variantIds)->keyBy('shopify_id');
        $contentPermissionsLookup = $this->contentPermissionsService->getAll()->keyBy(function ($permission) {
            return $permission->brand . '_' . $permission->name;
        });

        $wasUpdated = false;
        foreach ($orders->sortBy('created_at') as $order) {
            $wasUpdated |= $this->syncShopifyOrder(
                $userId,
                $order,
                $existingAccessPermissionsLookup,
                $productLookup,
                $contentPermissionsLookup
            );
        }

        if ($wasUpdated) {
            $accessPermissions = $existingAccessPermissionsLookup->values();
            event(new UserAccessPermissionsUpdated($userId, $accessPermissions));
        }
    }


    private function syncShopifyOrder(
        int $userId,
        $order,
        Collection $existingAccessPermissionsLookup,
        Collection $productLookup,
        Collection $contentPermissionsLookup
    ): bool {
        $shopifyOrderId = $order["id"];

        $wasUpdated = false;
        foreach ($order['line_items'] as $lineItem) {
            /** @var Product $product */
            $product = $productLookup[$lineItem['variant_id']] ?? null;
            if (!$product) {
                continue;
            }
            $contentPermissions = $product->getContentPermissions($contentPermissionsLookup);

            foreach ($contentPermissions as $contentPermission) {
                $hash = sha1("$shopifyOrderId.$lineItem[id].$contentPermission->id");
                $accessPermission = $existingAccessPermissionsLookup["shopify.$hash"] ?? null;

                $status = $this->getPermissionStatusFromOrder($order);
                if (!$accessPermission) {
                    $accessPermission = new UserAccessPermission();
                    $accessPermission->user_id = $userId;
                    $accessPermission->permission_id = $contentPermission->id;
                    $accessPermission->source = UserAccessPermissionsSourceEnum::shopify;
                    $accessPermission->source_hash = $hash;
                    $accessPermission->start_time = Carbon::parse($order['created_at']);
                    $accessPermission->time_days = $product->getMembershipTimeDays();
                    $accessPermission->time_months = $product->getMembershipTimeMonths();
                    $accessPermission->time_lifetime = $product->isLifeTime();
                    $accessPermission->status = $status;
                    $accessPermission->save();
                    $existingAccessPermissionsLookup[$hash] = $accessPermission;
                    $wasUpdated = true;
                } elseif ($accessPermission->status != $status) {
                    //Only ever need to update the order status if order is cancelled
                    $accessPermission->status = $status;
                    $accessPermission->save();
                    $wasUpdated = true;
                }
            }
        }
        return $wasUpdated;
    }

    private function getPermissionStatusFromOrder($order): UserAccessPermissionsStatusEnum
    {
        if ($order['cancelled_at']) {
            return UserAccessPermissionsStatusEnum::revoked;
        }
        return UserAccessPermissionsStatusEnum::active;
    }

    public function getActiveDates(Collection $userAccessPermissions): array
    {
        $userAccessPermissions = $userAccessPermissions
            ->where('status', '!=', UserAccessPermissionsStatusEnum::revoked)
            ->sortBy('start_time');
        $expirationDate = null;
        $startDate = null;
        /** @var UserAccessPermission $userAccessPermission */
        foreach ($userAccessPermissions as $userAccessPermission) {
            if ($userAccessPermission->time_lifetime) {
                return [Carbon::parse($userAccessPermission->start_time), Carbon::maxValue()];
            }
            $startDate = $expirationDate != null && $expirationDate > $userAccessPermission->start_time
                ? $startDate : Carbon::parse($userAccessPermission->start_time);
            $tempStartDate = $expirationDate != null && $expirationDate > $userAccessPermission->start_time
                ? $expirationDate : Carbon::parse($userAccessPermission->start_time);
            $expirationDate = $tempStartDate->clone()
                ->addDays($userAccessPermission->time_days)
                ->addMonths($userAccessPermission->time_months);
        }
        return array($startDate, $expirationDate);
    }

    public function getPlusMembershipExpirationDate(Collection $userAccessPermissions): ?Carbon
    {
        $userAccessPermissions = $userAccessPermissions->whereIn('permission_id', self::MusoraPlusMembershipPermission);
        list($startDate, $endDate) = $this->getActiveDates($userAccessPermissions);
        return $endDate;
    }

    public function getBasicMembershipExpirationDate(Collection $userAccessPermissions): ?Carbon
    {
        $userAccessPermissions = $userAccessPermissions->where('permission_id', self::MusoraBasicMembershipPermission);
        list($startDate, $endDate) = $this->getActiveDates($userAccessPermissions);
        return $endDate;
    }

    public function getSongsAccessExpirationDate(Collection $userAccessPermissions): ?Carbon
    {
        $userAccessPermissions = $userAccessPermissions->where('permission_id', self::MusoraSongsAccessPermission);
        list($startDate, $endDate) = $this->getActiveDates($userAccessPermissions);
        return $endDate;
    }

    public function getIsLifetimeMember($userAccessPermissions): bool
    {
        $userAccessPermissions = $userAccessPermissions->whereIn('permission_id', [self::LifetimePermissions]);
        list($startDate, $endDate) = $this->getActiveDates($userAccessPermissions);
        return $endDate == Carbon::maxValue();
    }

    public function getIsDrumeoLifetimeMember($userAccessPermissions): bool
    {
        $userAccessPermissions = $userAccessPermissions->where('permission_id', self::DrumeoLifetimePermission);
        list($startDate, $endDate) = $this->getActiveDates($userAccessPermissions);
        return $endDate == Carbon::maxValue();
    }

    public function getOwnsPacks($userAccessPermissions): bool
    {
        if (!$this->cachedPackPermissionIds) {
            $permissions = $this->contentPermissionsService->getAll();
            $packProducts = $this->productService->getAllPacks();
            $this->cachedPackPermissionIds = $packProducts->map(function ($product) use ($permissions) {
                return $product->getContentPermissions($permissions)->pluck('id');
            })->flatten(1)->unique()->toArray();
        }

        $userAccessPermissions = $userAccessPermissions->whereIn('permission_id', $this->cachedPackPermissionIds);
        list($startDate, $endDate) = $this->getActiveDates($userAccessPermissions);
        return $endDate > Carbon::now();
    }
}
