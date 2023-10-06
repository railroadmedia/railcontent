<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\User as EcommerceUser;

class UserAccessPermissionsService
{
    private ProductService $productService;
    private ContentPermissionsService $contentPermissionsService;

    private ?array $cachedPackPermissionIds = null;
    private UserProductService $userProductService;

    function __construct(
        ProductService $productService,
        ContentPermissionsService $contentPermissionsService,
        UserProductService $userProductService
    ) {
        $this->productService = $productService;
        $this->contentPermissionsService = $contentPermissionsService;
        $this->userProductService = $userProductService;
    }

    private function getUserAccessPermissionsQuery(int $userId)
    {
        return UserAccessPermission::query()->where('user_id', '=', $userId);
    }

    public function getUserAccessPermissions(int $userId): UserAccessPermissionsCollection
    {
        $permissions = $this->getUserAccessPermissionsQuery($userId)->get();
        return new UserAccessPermissionsCollection($userId, $permissions);
    }

    /**
     * @param int $userId
     * @param int[] $productIds
     * @param Carbon $startTime
     * @param UserAccessPermissionsSourceEnum $source
     * @return void
     * @throws Exception
     */
    public function addUserAccessPermissionsForProducts(
        int $userId,
        array $productIds,
        Carbon $startTime,
        UserAccessPermissionsSourceEnum $source
    ): void {
        $contentPermissionsLookup = $this->getContentPermissionsLookup();

        $products =
            Product::whereIn('id', $productIds)
                ->get();

        foreach ($products as $product) {
            $contentPermissions = $product->getContentPermissions($contentPermissionsLookup);

            foreach ($contentPermissions as $contentPermission) {
                $accessPermission = new UserAccessPermission();
                $accessPermission->user_id = $userId;
                $accessPermission->permission_id = $contentPermission->id;
                $accessPermission->source = $source;
                $accessPermission->source_hash = '';
                $accessPermission->start_time = $startTime;
                $accessPermission->time_days = $product->getMembershipTimeDays();
                $accessPermission->time_months = $product->getMembershipTimeMonths();
                $accessPermission->time_lifetime = $product->isLifeTime();
                $accessPermission->status = UserAccessPermissionsStatusEnum::Active;
                $accessPermission->save();
            }
        }

        $accessPermissions = $this->getUserAccessPermissions($userId);
        event(new UserAccessPermissionsUpdated($accessPermissions));
    }


    public function syncShopifyOrders(int $userId, $orders): void
    {
        $contentPermissionsLookup = $this->getContentPermissionsLookup();
        $existingAccessPermissionsLookup = $this->getExistingUserAccessLookup($userId);
        $variantIds = $orders->pluck('line_items')->flatten(1)->pluck('variant_id')->unique()->toArray();
        $productLookup = $this->productService->getProductsByShopifyIds($variantIds)->keyBy('shopify_id');

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

        $wasUpdated |= $this->ensureUserProductAccess(
            $userId,
            $existingAccessPermissionsLookup,
            $contentPermissionsLookup
        );


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
                    $accessPermission->source = UserAccessPermissionsSourceEnum::Shopify;
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
            return UserAccessPermissionsStatusEnum::Revoked;
        }
        return UserAccessPermissionsStatusEnum::Active;
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

        return $userAccessPermissions->doesUserOwnPermissions($this->cachedPackPermissionIds);
    }

    public function userHadOrHasAnyDigitalProductsForBrand(User $user, $brand): bool
    {
        if (config('shopify.enabled')) {
            $userAccessPermissions = $this->getUserAccessPermissions($user->id);
            $permissionIds = $this->contentPermissionsService->getByBrand($brand)->pluck('id')->toArray();
            return $userAccessPermissions->hasUserOwnedPermissions($permissionIds);
        }
        $userProductService = app(UserProductService::class);

        return $userProductService->userHadOrHasAnyDigitalProductsForBrand(
            new EcommerceUser($user->id, $user->email),
            $brand
        );
    }

    /**
     * Temporary function to handle manual changes to user products not represented in users orders
     */
    private function ensureUserProductAccess(
        int $userId,
        Collection $existingAccessPermissionsLookup,
        Collection $contentPermissionsLookup
    ): bool {
        $userAccessPermissions = new UserAccessPermissionsCollection(
            $userId, $existingAccessPermissionsLookup->values()
        );
        $userPermissions = $this->buildUserPermissionsList($userId, $contentPermissionsLookup);
        $wasUpdated = false;
        foreach ($userPermissions as $permissionId => $dates) {
            $isLifeTime = $dates['expiration_date'] == null;
            $expirationDate = $isLifeTime ? Carbon::maxValue() : Carbon::parse($dates['expiration_date']);

            list(, $userAccessExpirationDate) = $userAccessPermissions->getActiveDates($permissionId);
            if ($userAccessExpirationDate < Carbon::now()) {
                $userAccessExpirationDate = Carbon::now();
            }
            if ($userAccessExpirationDate < $expirationDate) {
                $days = $isLifeTime ? 0 : ($expirationDate->diffInDays($userAccessExpirationDate) + 1);
                //User products not synced with orders Add manual permission to fix missing access
                $accessPermission = new UserAccessPermission();
                $accessPermission->user_id = $userId;
                $accessPermission->permission_id = $permissionId;
                $accessPermission->source = UserAccessPermissionsSourceEnum::Manual;
                $accessPermission->source_hash = '';
                $accessPermission->start_time = $userAccessExpirationDate;
                $accessPermission->time_days = $days;
                $accessPermission->time_months = 0;
                $accessPermission->time_lifetime = $isLifeTime;
                $accessPermission->status = UserAccessPermissionsStatusEnum::Active;
                $accessPermission->save();
                $existingAccessPermissionsLookup["manual.$accessPermission->id"] = $accessPermission;
                $wasUpdated = true;
            }
        }
        return $wasUpdated;
    }

    private function buildUserPermissionsList(int $userId, $permissionsLookup): array
    {
        $userProducts = $this->userProductService->getUserProductsQuery($userId)->with('product')->get();
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
        ksort($permissionsToCreate);
        return $permissionsToCreate;
    }

    private function getContentPermissionsLookup(): Collection
    {
        return $this->contentPermissionsService->getAll()->keyBy(function ($permission) {
            return $permission->brand . '_' . $permission->name;
        });
    }

    private function getExistingUserAccessLookup(int $userId): Collection
    {
        return $this->getUserAccessPermissionsQuery($userId)->get()->keyBy(
            function (UserAccessPermission $permission) {
                $hash = !empty($permission->source_hash) ? $permission->source_hash : $permission->id;
                return "$permission->source.$hash";
            }
        );
    }

    public function getUserAccessPermissionsList(int $userId, int $page, int $limit): UserAccessPermissionsCollection
    {
        $items = collect(
            $this->getUserAccessPermissionsQuery($userId)->with('permission')->paginate(
                $limit,
                ['*'],
                'page',
                $page
            )->items()
        );
        return new UserAccessPermissionsCollection($userId, $items);
    }
}
