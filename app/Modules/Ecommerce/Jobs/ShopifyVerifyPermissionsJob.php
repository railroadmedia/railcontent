<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Models\ShopifySync;
use App\Modules\Content\Models\UserPermission;
use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Enums\SubscriptionIntervalType;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ShopifyVerifyPermissionsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private UserAccessPermissionsService $userAccessPermissionsService;
    private ContentPermissionsService $contentPermissionsService;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        return User::query()->whereNotNull('shopify_id');
    }

    function handleItem($item): void
    {
    }

    function handleAllItems($items): bool
    {
        $this->userAccessPermissionsService = app(UserAccessPermissionsService::class);
        $this->contentPermissionsService = app(ContentPermissionsService::class);
        /** @var UserProductToUserContentPermissionListener $cs */
        $cs = app()->make(UserProductToUserContentPermissionListener::class);

        foreach ($items as $user) {
            /** @var User $item */
            try {
                $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissions($user->id);

                $newExpirationDate = $userAccessPermissions->getMembershipExpirationDate();
                $oldExpirationDate = $user->membership_expiration_date;
                if ($oldExpirationDate == null && $user->isALifetimeMember()) {
                    $oldExpirationDate = Carbon::maxValue();
                }
                $diff = $newExpirationDate?->diffInDays($oldExpirationDate);
                Log::info("$user->id:Verifying user permissions");
                if (is_null($diff) || $diff > 0) {
                    Log::warning("$user->id:$oldExpirationDate -> $newExpirationDate ($diff)");
                }

                $permissionIds = $userAccessPermissions->getActivePermissionIds();
//                $existingUserPermissions = $this->contentPermissionsService->getUserPermissions($user->id)->keyBy(
//                    'permission_id'
//                );

                $permissions = $cs->buildUserPermissionsList($user->id);


                $toDeleteIds = collect($permissions)->where(function ($item, $key) use ($permissionIds) {
                    return !in_array($key, $permissionIds) && $item['expiration_date'] >= Carbon::now();
                })->keys()->toArray();


                foreach ($permissionIds as $permissionId) {
                    list($startDate, $expirationDate) = $userAccessPermissions->getActiveDates($permissionId);
                    /** @var UserPermission $userPermission */
                    $userPermission = $permissions[$permissionId] ?? null;
                    if ($userPermission == null) {
                        Log::warning(
                            "$user->id:User permission not found for user:$user->id, permission:$permissionId ($startDate - $expirationDate)"
                        );
                        continue;
                    }

                    $oldStartDate = $userPermission['start_date'];
                    $oldExpirationDate = $userPermission['expiration_date'] ?? Carbon::maxValue();
                    $diffStart = $oldStartDate ? $startDate?->diffInDays($oldStartDate) : null;
                    $diffExpiration = $oldExpirationDate ? $expirationDate?->diffInDays($oldExpirationDate) : null;
                    if ($startDate > Carbon::now()) {
                        Log::warning("$user->id:$permissionId start date in the future");
                    }
                    if (is_null($diffExpiration) || $diffExpiration > 0) {
                        Log::warning(
                            "$user->id:$permissionId $oldExpirationDate -> $expirationDate ($diffExpiration)"
                        );
                    }
                }

                if (count($toDeleteIds) > 0) {
                    Log::warning("$user->id:Deleting user permissions:" . implode(',', $toDeleteIds));
                }
            } catch (\Throwable $ex) {
                Log::error("$user->id:Error verifying user permissions");
                Log::error($ex);
            }
        }
        return true;
    }
}
