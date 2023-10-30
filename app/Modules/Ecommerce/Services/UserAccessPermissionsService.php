<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Collections\OrderCollection;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Models\Shopify\Order;
use App\Modules\Ecommerce\Models\Shopify\OrderLineItem;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Services\UserProductService as EcommerceUserProductService;


class UserAccessPermissionsService
{
    private ProductService $productService;
    private ContentPermissionsService $contentPermissionsService;

    private ?array $cachedPackPermissionIds = null;
    private UserProductService $userProductService;
    private UserService $userService;
    private SubscriptionService $subscriptionService;

    function __construct(
        ProductService $productService,
        ContentPermissionsService $contentPermissionsService,
        UserProductService $userProductService,
        UserService $userService,
        SubscriptionService $subscriptionService
    ) {
        $this->productService = $productService;
        $this->contentPermissionsService = $contentPermissionsService;
        $this->userProductService = $userProductService;
        $this->userService = $userService;
        $this->subscriptionService = $subscriptionService;
    }

    private function getUserAccessPermissionsQuery(int $userId, array $filterPermissionIds = [])
    {
        //force using write db so we have latest data for query
        $query = UserAccessPermission::on('musora_laravel_mysql::write')->where('user_id', '=', $userId);
        if ($filterPermissionIds) {
            $query = $query->whereIn('permission_id', $filterPermissionIds);
        }
        return $query;
    }

    public function getUserAccessPermissions(
        int $userId,
        array $filterPermissionIds = []
    ): UserAccessPermissionsCollection {
        $permissions = $this->getUserAccessPermissionsQuery($userId, $filterPermissionIds)->get();
        return new UserAccessPermissionsCollection($userId, $permissions);
    }

    /**
     * @param int $userId
     * @param int[] $productIds
     * @param Carbon $startTime
     * @param string $sourceId
     * @param UserAccessPermissionsSourceEnum $source
     * @return void
     */
    public function addUserAccessPermissionsForProducts(
        int $userId,
        array $productIds,
        Carbon $startTime,
        string $sourceId,
        UserAccessPermissionsSourceEnum $source
    ): void {
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $existingAccessPermissionsLookup = $this->getExistingUserAccessLookup($userId);

        $products =
            Product::whereIn('id', $productIds)
                ->get();
        $user = $this->userService->getByIdOrNull($userId);

        /** @var Product $product */
        foreach ($products as $product) {
            $contentPermissions = $product->getContentPermissions($contentPermissionsLookup);

            foreach ($contentPermissions as $contentPermission) {
                $hash = sha1("$sourceId.$product->id.$contentPermission->id");
                $accessPermission = $existingAccessPermissionsLookup["$source->value.$hash"] ?? null;

                // if the permission exist, skip it
                if (!$accessPermission) {
                    $this->createUserAccessPermission(
                        $user,
                        $contentPermission->id,
                        $startTime,
                        $source,
                        $hash,
                        $product,
                        UserAccessPermissionsStatusEnum::Active
                    );
                }
            }

            $this->handleBonusMembershipPermission(
                $product,
                $user,
                $source,
                $sourceId,
                $existingAccessPermissionsLookup
            );
        }

        $this->handleUserPermissionsUpdatedEvent($userId);
    }

    public function syncUser(User $user): void
    {
        $this->handleUserPermissionsUpdatedEvent($user->id);
    }

    public function syncShopifyOrders(User $user, OrderCollection $orderCollection): void
    {
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $existingAccessPermissionsLookup = $this->getExistingUserAccessLookup($user->id);

        foreach ($orderCollection->getOrders()->sortBy('created_at') as $order) {
            $this->syncShopifyOrder(
                $user,
                $order,
                $existingAccessPermissionsLookup,
                $contentPermissionsLookup
            );
        }

        $this->ensureUserProductAccess(
            $user,
            $contentPermissionsLookup,
        );


        $this->handleUserPermissionsUpdatedEvent($user->id, $orderCollection);
    }

    private function syncShopifyOrder(
        User $user,
        Order $order,
        Collection $existingAccessPermissionsLookup,
        Collection $contentPermissionsLookup
    ): bool {
        $shopifyOrderId = $order->id;

        $wasUpdated = false;
        foreach ($order->lineItems as $lineItem) {
            if (!$lineItem->product) {
                continue;
            }
            /** @var OrderLineItem $lineItem */
            $contentPermissions = $lineItem->product->getContentPermissions($contentPermissionsLookup);

            foreach ($contentPermissions as $contentPermission) {
                $hash = sha1("$shopifyOrderId.$lineItem->id.$contentPermission->id");
                $source = $order->getPaymentSourceEnum();
                $accessPermission = $existingAccessPermissionsLookup["$source->value.$hash"] ?? null;

                $status = $this->getPermissionStatusFromOrder($order);
                if (!$accessPermission) {
                    $accessPermission = $this->createUserAccessPermission(
                        $user,
                        $contentPermission->id,
                        Carbon::parse($order->processedAt),
                        $source,
                        $hash,
                        $lineItem->product,
                        $status
                    );
                    if ($accessPermission == null) {
                        continue;
                    }
                    $wasUpdated = true;
                } elseif ($accessPermission->status != $status->value) {
                    //Only ever need to update the order status if order is cancelled
                    $accessPermission->status = $status;
                    $accessPermission->save();
                    $wasUpdated = true;
                }
            }
            $this->handleBonusMembershipPermission(
                $lineItem->product,
                $user,
                $order->getPaymentSourceEnum(),
                $shopifyOrderId . $lineItem->id,
                $existingAccessPermissionsLookup
            );
        }
        return $wasUpdated;
    }

    private function getPermissionStatusFromOrder(Order $order): UserAccessPermissionsStatusEnum
    {
        if ($order->cancelledAt) {
            return UserAccessPermissionsStatusEnum::Revoked;
        }
        return UserAccessPermissionsStatusEnum::Active;
    }

    public function getOwnsPacks(UserAccessPermissionsCollection $userAccessPermissions): bool
    {
        if (!$this->cachedPackPermissionIds) {
            $permissions = $this->contentPermissionsService->getContentPermissionsLookup();
            $packProducts = $this->productService->getAllPacks();
            $this->cachedPackPermissionIds = $packProducts->map(function ($product) use ($permissions) {
                return $product->getContentPermissions($permissions)
                    ->pluck('id');
            })
                ->flatten(1)
                ->unique()
                ->toArray();
        }

        return $userAccessPermissions->doesUserOwnPermissions($this->cachedPackPermissionIds);
    }

    public function userHadOrHasAnyDigitalProductsForBrand(User $user, $brand): bool
    {
        if (config('shopify.enabled')) {
            $userAccessPermissions = $this->getUserAccessPermissions($user->id);
            $permissionIds =
                $this->contentPermissionsService->getByBrand($brand)
                    ->pluck('id')
                    ->toArray();
            return $userAccessPermissions->hasUserOwnedPermissions($permissionIds);
        }
        $userProductService = app(EcommerceUserProductService::class);

        return $userProductService->userHadOrHasAnyDigitalProductsForBrand(
            new EcommerceUser($user->id, $user->email),
            $brand
        );
    }

    /**
     * Temporary function to handle manual changes to user products not represented in users orders
     */
    private function ensureUserProductAccess(
        User $user,
        Collection $contentPermissionsLookup
    ): bool {
        $userAccessPermissions = $this->getUserAccessPermissions($user->id);
        $userPermissions = $this->buildUserPermissionsList($user->id, $contentPermissionsLookup);
        $wasUpdated = false;
        foreach ($userPermissions as $permissionId => $dates) {
            $isLifeTime = $dates['expiration_date'] == null;
            $expirationDate = $isLifeTime ? Carbon::maxValue() : Carbon::parse($dates['expiration_date']);

            [, $userAccessExpirationDate] = $userAccessPermissions->getActiveDates($permissionId);
            if ($userAccessExpirationDate < Carbon::now()) {
                $userAccessExpirationDate = Carbon::now();
            }
            if ($userAccessExpirationDate < $expirationDate) {
                $days = $isLifeTime ? 0 : ($expirationDate->diffInDays($userAccessExpirationDate) + 1);
                //User products not synced with orders Add manual permission to fix missing access
                $accessPermission = $this->createUserAccessPermission(
                    $user,
                    $permissionId,
                    $userAccessExpirationDate,
                    UserAccessPermissionsSourceEnum::Migration,
                    '',
                    new Product(),
                    UserAccessPermissionsStatusEnum::Active,
                    $days,
                    0,
                    $isLifeTime
                );

                if ($accessPermission) {
                    $wasUpdated = true;
                }
            }
        }
        return $wasUpdated;
    }

    private function buildUserPermissionsList(int $userId, $permissionsLookup): array
    {
        $userProducts =
            $this->userProductService->getUserProductsQuery($userId)
                ->with('product')
                ->get();
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

                if (!array_key_exists($permissionId, $permissionsToCreate) ||
                    $permissionsToCreate[$permissionId]['expiration_date'] < $userProduct->expiration_date) {
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

    private function getExistingUserAccessLookup(int $userId): Collection
    {
        return $this->getUserAccessPermissionsQuery($userId)
            ->get()
            ->keyBy(
                function (UserAccessPermission $permission) {
                    $hash = !empty($permission->source_hash) ? $permission->source_hash : $permission->id;
                    return "$permission->source.$hash";
                }
            );
    }

    public function getUserAccessPermissionsList(int $userId, int $page, int $limit): UserAccessPermissionsCollection
    {
        $items = collect(
            $this->getUserAccessPermissionsQuery($userId)
                ->with('permission')
                ->paginate(
                    $limit,
                    ['*'],
                    'page',
                    $page
                )
                ->items()
        );
        return new UserAccessPermissionsCollection($userId, $items);
    }

    public function createOrUpdateUserAccessPermission(
        $userId,
        $permissionId,
        $startTime,
        $timeDays,
        $timeMonths,
        $lifetime,
        $status,
        $revokedAt = null,
        $userProductId = null
    ) {
        $userAccessPermission = new UserAccessPermission();
        if ($userProductId) {
            $userAccessPermission = UserAccessPermission::query()->where('id', $userProductId)->first();
        } else {
            $userAccessPermission->user_id = $userId;
            $userAccessPermission->source = 'manual';
            $userAccessPermission->source_hash = uniqid();
        }
        $userAccessPermission->permission_id = $permissionId;
        $userAccessPermission->start_time = $startTime;
        $userAccessPermission->time_days = $timeDays;
        $userAccessPermission->time_months = $timeMonths;
        $userAccessPermission->time_lifetime = $lifetime ?? 0;
        $userAccessPermission->status = $status;
        if ($revokedAt) {
            $userAccessPermission->revoked_at = $revokedAt;
            if ($userAccessPermission->source == UserAccessPermissionsSourceEnum::Challenges->value) {
                $userAccessPermission->source_hash = uniqid();
            }
        }
        $userAccessPermission->save();

        $this->handleUserPermissionsUpdatedEvent($userId);

        return $userAccessPermission;
    }

    public function handleBonusMembershipPermission(
        Product $product,
        ?User $user,
        UserAccessPermissionsSourceEnum $source,
        string $sourceId,
        Collection $existingAccessPermissionsLookup
    ) {
        if ($product->digital_membership_access_expiration_date
            && $user
            && $user->membership_expiration_date < $product->digital_membership_access_expiration_date) {
            $hash = sha1("$sourceId.$product->id.bonus");
            if ($existingAccessPermissionsLookup["$source->value.$hash"] ?? null) {
                return;
            }
            $membershipExpirationDate = Carbon::parse($user->membership_expiration_date)
                ->addDays(-config('ecommerce.days_before_access_revoked_after_expiry', 7));
            $digitalMembershipAccessExpirationDate = Carbon::parse($product->digital_membership_access_expiration_date);
            $timeDays = $membershipExpirationDate->diffInDays($digitalMembershipAccessExpirationDate) + 1;
            $this->createUserAccessPermission(
                $user,
                UserAccessPermissionsCollection::MusoraPlusMembershipPermission,
                $membershipExpirationDate,
                $source,
                $hash,
                $product,
                UserAccessPermissionsStatusEnum::Active,
                $timeDays,
                0,
                false
            );
        }
    }

    public function hasPermission(?int $id, $permissionID): bool
    {
        return $this->getUserAccessPermissions($id, [$permissionID])->hasPermission($permissionID);
    }

    public function getNumberPermissionOwners($permissionID)
    {
        return UserAccessPermission::query()->distinct('user_id')
            ->where('permission_id', '=', $permissionID)
            ->where('status', '=', 'active')
            ->count();
    }

    public function createUserAccessPermission(
        User $user,
        int $permissionId,
        Carbon $startTime,
        UserAccessPermissionsSourceEnum $source,
        string $hash,
        Product $product,
        UserAccessPermissionsStatusEnum $status,
        ?int $days = null,
        ?int $months = null,
        ?bool $isLifeTime = null
    ): ?UserAccessPermission {
        if (!isset($days)) {
            $days = $product->getMembershipTimeDays();
        }
        if (!isset($months)) {
            $months = $product->getMembershipTimeMonths();
        }
        if (!isset($isLifeTime)) {
            $isLifeTime = $product->isLifeTime();
        }
        if (empty($hash)) {
            $hash = uniqid();
        }
        $accessPermission = new UserAccessPermission();
        $accessPermission->user_id = $user->id;
        $accessPermission->permission_id = $permissionId;
        $accessPermission->source = $source;
        $accessPermission->source_hash = $hash;
        $accessPermission->start_time = $startTime;
        $accessPermission->time_days = $days;
        $accessPermission->time_months = $months;
        $accessPermission->time_lifetime = $isLifeTime;
        $accessPermission->status = $status;
        try {
            $accessPermission->save();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { //unique constraint issue, permission already exists
                Log::warning(
                    "UserAccessPermission already exists for user $user->id, permission $permissionId, source $source->value, hash $hash"
                );
                return null;
            }
            throw $e;
        }
        return $accessPermission;
    }

    public function handleUserPermissionsUpdatedEvent(int $userId, OrderCollection $orderCollection = null): void
    {
        if (config('shopify.enabled')) {
            $accessPermissions = $this->getUserAccessPermissions($userId);
            $currentSubscription = null;
            try {
                $currentSubscription = $this->subscriptionService->syncSubscriptionData($accessPermissions);
            } catch (\Throwable $e) {
                Log::error("Error syncing subscriptions for user: $userId");
                Log::error($e);
            }
            event(new UserAccessPermissionsUpdated($accessPermissions, $orderCollection, $currentSubscription));
        }
    }
}
