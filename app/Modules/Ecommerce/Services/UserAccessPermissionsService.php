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

    public static $timeMinutes = false;

    public function __construct(
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
        $query = UserAccessPermission::onWriteConnection()->where('user_id', '=', $userId);
        if ($filterPermissionIds) {
            $query = $query->whereIn('permission_id', $filterPermissionIds);
        }
        return $query;
    }

    public function getUserAccessPermissions(
        int $userId,
        array $filterPermissionIds = []
    ): UserAccessPermissionsCollection {
        $user = User::find($userId);
        $permissions = $this->getUserAccessPermissionsQuery($userId, $filterPermissionIds)->get();
        return new UserAccessPermissionsCollection($user, $permissions);
    }

    public function getUserAccessPermissionsByUser(
        User $user,
        array $filterPermissionIds = []
    ): UserAccessPermissionsCollection {
        $permissions = $this->getUserAccessPermissionsQuery($user->id, $filterPermissionIds)->get();
        return new UserAccessPermissionsCollection($user, $permissions);
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

        $this->handleUserPermissionsUpdatedEvent($user);
    }

    public function addFixedAccessPermission(User $user, int $permissionId, Carbon $startDate, Carbon $expirationDate)
    {
        $hash = sha1("fixed.$expirationDate->timestamp.$permissionId");
        $this->createUserAccessPermission(
            $user,
            $permissionId,
            $startDate,
            UserAccessPermissionsSourceEnum::Manual,
            $hash,
            null,
            UserAccessPermissionsStatusEnum::Active,
            fixed: $expirationDate,
        );
        $this->handleUserPermissionsUpdatedEvent($user);
    }

    public function syncUser(User $user, bool $skipEventSync = false): void
    {
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $this->ensureUserProductAccess(
            $user,
            $contentPermissionsLookup,
        );
        if (!$skipEventSync) {
            $this->handleUserPermissionsUpdatedEvent($user);
        }
    }

    public function syncShopifyOrders(
        User $user,
        OrderCollection $orderCollection,
        bool $isRebuildingPermissions = false,
        bool $skipEventSync = false,
        bool $removeDeletedOrderPermissions = false
    ): void {
        if ($isRebuildingPermissions) {
            $this->removeExistingPermissions($user);
        }
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $existingAccessPermissionsLookup = $this->getExistingUserAccessLookup($user->id);

        $accessPermissions = [];
        foreach ($orderCollection->getOrders()->sortBy('created_at') as $order) {
            $orderAccessPermissions = $this->syncShopifyOrder(
                $user,
                $order,
                $existingAccessPermissionsLookup,
                $contentPermissionsLookup
            );
            $accessPermissions = array_merge($accessPermissions, $orderAccessPermissions);
        }

        if ($removeDeletedOrderPermissions) {
            $this->removeDeletedOrderPermissions($user, $accessPermissions);
        }

        $this->ensureUserProductAccess(
            $user,
            $contentPermissionsLookup,
        );


        if (!$skipEventSync) {
            $this->handleUserPermissionsUpdatedEvent($user, $orderCollection);
        } else {
            try {
                $accessPermissions = $this->getUserAccessPermissionsByUser($user);
                $subscriptions = $this->subscriptionService->syncSubscriptionData($accessPermissions);
            } catch (\Throwable $e) {
                Log::error("Error syncing subscriptions for user: $user->id");
                Log::error($e);
            }
        }
    }

    private function syncShopifyOrder(
        User $user,
        Order $order,
        Collection $existingAccessPermissionsLookup,
        Collection $contentPermissionsLookup
    ) {
        $shopifyOrderId = $order->id;
        $status = $order->getPermissionStatusFromOrder();
        $accessPermissions = [];

        foreach ($order->lineItems as $lineItem) {
            if (!$lineItem->product) {
                continue;
            }
            /** @var OrderLineItem $lineItem */
            $contentPermissions = $lineItem->product->getContentPermissions($contentPermissionsLookup);

            foreach ($contentPermissions as $contentPermission) {
                $hash = sha1("$shopifyOrderId.$lineItem->id.$contentPermission->id");
                $source = $order->getPaymentSourceEnum();
                /** @var UserAccessPermission $accessPermission */
                $accessPermission = $existingAccessPermissionsLookup["$source->value.$hash"] ?? null;

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
                } else {
                    $this->updateUserAccessPermission($accessPermission, $status, $lineItem, $user);
                }
                $accessPermissions[] = $accessPermission;
            }
            $bonusAccessPermission = $this->handleBonusMembershipPermission(
                $lineItem->product,
                $user,
                $order->getPaymentSourceEnum(),
                $shopifyOrderId . $lineItem->id,
                $existingAccessPermissionsLookup
            );
            if ($bonusAccessPermission) {
                $accessPermissions[] = $bonusAccessPermission;
            }
        }
        return $accessPermissions;
    }

    private function updateUserAccessPermission(
        UserAccessPermission $accessPermission,
        UserAccessPermissionsStatusEnum $status,
        OrderLineItem $lineItem,
        User $user
    ): void {
        if ($accessPermission->status != $status->value && !$accessPermission->manually_revoked) {
            $accessPermission->status = $status;
            $accessPermission->save();
        }
        if ($accessPermission->created_at < Carbon::parse('2023-11-9')) {
            $expectedDays = $lineItem->product->getMembershipTimeDays();
            $expectedMonths = $lineItem->product->getMembershipTimeMonths();
            if ($accessPermission->time_days != $expectedDays || $accessPermission->time_months != $expectedMonths) {
                Log::info(
                    "$user->id: Fixing time for permission $accessPermission->permission_id days:$accessPermission->time_days -> $expectedDays months:$accessPermission->time_months -> $expectedMonths"
                );
                $accessPermission->time_days = $expectedDays;
                $accessPermission->time_months = $expectedMonths;
                $accessPermission->save();
            }
        }
        if ($accessPermission->product_id != $lineItem->product->id) {
            $accessPermission->product_id = $lineItem->product->id;
            $accessPermission->save();
        }
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

    public function shouldSyncCustomerIOWorkspace(User $user, $brand): bool
    {
        if ($user->cio_synced_workspaces) {
            return $user->shouldSyncCustomerIoWorkspace($brand);
        }
        //TODO: remove post shopify and $user->cio_synced_workspaces check above
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
    ): void {
        $permissions = $this->getUserAccessPermissionsQuery($user->id)
            ->where('source', '!=', UserAccessPermissionsSourceEnum::Migration->value)
            ->get();
        $migrationPermissionLookup = $this->getUserAccessPermissionsQuery($user->id)
            ->where('source', '=', UserAccessPermissionsSourceEnum::Migration->value)
            ->get()
            ->keyBy('permission_id');
        $userAccessPermissions = new UserAccessPermissionsCollection($user, $permissions);
        $userPermissions = $this->buildUserPermissionsList($user->id, $contentPermissionsLookup);
        foreach ($userPermissions as $permissionId => $dates) {
            $isLifeTime = $dates['expiration_date'] == null;
            $expirationDate = $isLifeTime ? Carbon::maxValue() : Carbon::parse($dates['expiration_date']);

            [, $userAccessExpirationDate] = $userAccessPermissions->getActiveDates($permissionId);
            if ($userAccessExpirationDate < Carbon::now()) {
                $userAccessExpirationDate = Carbon::now();
            }
            if ($userAccessExpirationDate < $expirationDate) {
                //User products not synced with orders Add manual permission to fix missing access
                $startDate = $userAccessExpirationDate->subDays(
                    config('ecommerce.days_before_access_revoked_after_expiry', 7)
                );
                $accessPermission = $migrationPermissionLookup[$permissionId] ?? null;
                $product = new Product();
                $product->id = $dates['product_id'];
                if ($accessPermission) {
                    $accessPermission->product_id = $dates['product_id'];
                    $accessPermission->time_days = 0;
                    $accessPermission->time_lifetime = $isLifeTime;
                    $accessPermission->time_fixed = $isLifeTime ? null : $expirationDate;
                    $accessPermission->save();
                } else {
                    $accessPermission = $this->createUserAccessPermission(
                        $user,
                        $permissionId,
                        $startDate,
                        UserAccessPermissionsSourceEnum::Migration,
                        '',
                        $product,
                        UserAccessPermissionsStatusEnum::Active,
                        0,
                        0,
                        $isLifeTime ? null : $expirationDate,
                        $isLifeTime
                    );
                }
            } else {
                $accessPermission = $migrationPermissionLookup[$permissionId] ?? null;
                if ($accessPermission) {
                    $accessPermission->delete();
                }
            }
        }
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
                        'product_id' => $product->id,
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
        $user = User::find($userId);
        $items = collect(
            $this->getUserAccessPermissionsQuery($userId)
                ->orderBy('updated_at', 'desc')
                ->with('permission')
                ->paginate(
                    $limit,
                    ['*'],
                    'page',
                    $page
                )
                ->items()
        );
        return new UserAccessPermissionsCollection($user, $items);
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
        $userAccessPermission->time_minutes = 0;
        $userAccessPermission->time_lifetime = $lifetime ?? 0;
        $userAccessPermission->time_fixed = null;
        $userAccessPermission->status = $status;

        if ($revokedAt) {
            $userAccessPermission->revoked_at = $revokedAt;
            $userAccessPermission->manually_revoked = true;
            if ($userAccessPermission->source == UserAccessPermissionsSourceEnum::Challenges->value) {
                $userAccessPermission->source_hash = uniqid();
            }
        } else {
            $userAccessPermission->revoked_at = null;
            $userAccessPermission->manually_revoked = false;
        }
        $userAccessPermission->save();

        $user = $this->userService->getByIdOrNull($userId);

        $this->handleUserPermissionsUpdatedEvent($user);

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
            && $product->digital_membership_access_expiration_date > Carbon::now()
            && $user
            && $user->membership_expiration_date < $product->digital_membership_access_expiration_date
        ) {
            $hash = sha1("$sourceId.$product->id.bonus");
            if ($existingAccessPermissionsLookup["$source->value.$hash"] ?? null) {
                return;
            }
            $membershipExpirationDate = Carbon::parse($user->membership_expiration_date)
                ->addDays(-config('ecommerce.days_before_access_revoked_after_expiry', 7));
            $digitalMembershipAccessExpirationDate = Carbon::parse($product->digital_membership_access_expiration_date);
            return $this->createUserAccessPermission(
                $user,
                UserAccessPermissionsCollection::MusoraPlusMembershipPermission,
                $membershipExpirationDate,
                $source,
                $hash,
                $product,
                UserAccessPermissionsStatusEnum::Active,
                0,
                0,
                $digitalMembershipAccessExpirationDate,
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
        ?string $hash,
        ?Product $product,
        UserAccessPermissionsStatusEnum $status,
        ?int $days = null,
        ?int $months = null,
        ?Carbon $fixed = null,
        ?bool $isLifeTime = null
    ): ?UserAccessPermission {
        if (!isset($days)) {
            $days = $product?->getMembershipTimeDays() ?? 0;
        }
        if (!isset($months)) {
            $months = $product?->getMembershipTimeMonths() ?? 0;
        }
        if (!isset($isLifeTime)) {
            $isLifeTime = $product?->isLifeTime() ?? false;
        }
        if (empty($hash)) {
            $hash = uniqid();
        }
        $accessPermission = new UserAccessPermission();
        $accessPermission->user_id = $user->id;
        $accessPermission->permission_id = $permissionId;
        $accessPermission->product_id = $product?->id;
        $accessPermission->source = $source;
        $accessPermission->source_hash = $hash;
        $accessPermission->start_time = $startTime;
        $accessPermission->time_days = (self::$timeMinutes) ? 0 : $days;
        $accessPermission->time_months = (self::$timeMinutes) ? 0 : $months;
        $accessPermission->time_minutes = (self::$timeMinutes) ? self::$timeMinutes : 0;
        $accessPermission->time_lifetime = $isLifeTime;
        $accessPermission->time_fixed = $fixed;
        $accessPermission->manually_revoked = 0;
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

    private function handleUserPermissionsUpdatedEvent(User $user, OrderCollection $orderCollection = null): void
    {
        $accessPermissions = $this->getUserAccessPermissionsByUser($user);
        $shouldSyncCIOWorkspaces = $this->getShouldSyncCustomerIOWorkspace(
            $orderCollection,
            $accessPermissions
        );
        $user->setCustomerIOSyncedWorkspaces($shouldSyncCIOWorkspaces);
        $user->save();

        $subscriptions = null;
        try {
            $subscriptions = $this->subscriptionService->syncSubscriptionData($accessPermissions);
        } catch (\Throwable $e) {
            Log::error("Error syncing subscriptions for user: $user->id");
            Log::error($e);
        }
        event(new UserAccessPermissionsUpdated($accessPermissions, $orderCollection, $subscriptions));
    }

    private function getShouldSyncCustomerIOWorkspace(
        ?OrderCollection $orderCollection,
        UserAccessPermissionsCollection $accessPermissions
    ): array {
        $contentPermissions = $this->contentPermissionsService->getAll();
        $brands = $contentPermissions->whereIn('id', $accessPermissions->getActivePermissionIds())->pluck(
            'brand'
        )->unique()->toArray();
        if ($orderCollection) {
            $orderBrands = $orderCollection->getOrderBrands();
            $brands = array_unique(array_merge($brands, $orderBrands));
        };
        return $brands;
    }

    public function removeExistingPermissions(User $user): void
    {
        $rebuildSources = [
            UserAccessPermissionsSourceEnum::Web->value,
            UserAccessPermissionsSourceEnum::Apple->value,
            UserAccessPermissionsSourceEnum::Google->value,
            UserAccessPermissionsSourceEnum::Migration->value
        ];

        UserAccessPermission::onWriteConnection()
            ->where('user_id', '=', $user->id)
            ->whereIn('source', $rebuildSources)->delete();
    }

    private function removeDeletedOrderPermissions(User $user, $accessPermissions)
    {
        $hashes = collect($accessPermissions)->pluck('source_hash')->toArray();
        $toRemove = $this->getUserAccessPermissionsQuery($user->id)
            ->whereNotIn('source_hash', $hashes)
            ->whereIn('source', [
                UserAccessPermissionsSourceEnum::Web->value,
                UserAccessPermissionsSourceEnum::Apple->value,
                UserAccessPermissionsSourceEnum::Google->value,
            ])->get();
        $toRemove->each(function (UserAccessPermission $permission) use ($accessPermissions) {
            Log::info(
                "Removing deleted order permission $permission->id $permission->time_days $permission->time_months"
            );
            $permission->delete();
        });
    }

    public function hasProductNotCached(int $userId, int $productId): bool
    {
        $product = $this->productService->getById($productId);
        if (!$product) {
            return false;
        }
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $permissionID =
            $product->getContentPermissions($contentPermissionsLookup)
                ->first()->id ?? null;
        if (!$permissionID) {
            return false;
        }
        $hasProduct = $this->hasPermission($userId, $permissionID);
        return $hasProduct;
    }

    public function getNumberProductOwners(int $productId): int
    {
        $product = $this->productService->getById($productId);
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
        $permissionID =
            $product->getContentPermissions($contentPermissionsLookup)
                ->first()->id ?? null;
        $nPackOwners = $this->getNumberPermissionOwners($permissionID);
        return $nPackOwners;
    }
}
