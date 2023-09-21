<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserAccessPermissionsService
{
    private ProductService $productService;
    private ContentPermissionsService $contentPermissionsService;

    private ?array $cachedPackPermissionIds = null;

    function __construct(ProductService $productService, ContentPermissionsService $contentPermissionsService)
    {
        $this->productService = $productService;
        $this->contentPermissionsService = $contentPermissionsService;
    }

    private function getUserAccessPermissionsQuery(int $userId)
    {
        return UserAccessPermission::query()->where('user_id', '=', $userId);
    }

    public function getUserAccessPermissions(int $userId): UserAccessPermissionsCollection
    {
        $permissions = $this->getUserAccessPermissionsQuery($userId);
        return new UserAccessPermissionsCollection($userId, $permissions);
    }

    public function syncShopifyOrders(int $userId, $orders): void
    {
        $existingAccessPermissionsLookup = $this->getUserAccessPermissionsQuery($userId)->get()->keyBy(
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
            $accessPermissions = new UserAccessPermissionsCollection(
                $userId, $existingAccessPermissionsLookup->values()
            );
            event(new UserAccessPermissionsUpdated($accessPermissions));
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

    public function getOwnsPacks(UserAccessPermissionsCollection $userAccessPermissions): bool
    {
        if (!$this->cachedPackPermissionIds) {
            $permissions = $this->contentPermissionsService->getAll();
            $packProducts = $this->productService->getAllPacks();
            $this->cachedPackPermissionIds = $packProducts->map(function ($product) use ($permissions) {
                return $product->getContentPermissions($permissions)->pluck('id');
            })->flatten(1)->unique()->toArray();
        }

        return $userAccessPermissions->getOwnsPacks($this->cachedPackPermissionIds);
    }
}
