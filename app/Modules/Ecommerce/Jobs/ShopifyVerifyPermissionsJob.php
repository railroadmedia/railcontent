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
        foreach ($items as $user) {
            /** @var User $item */
            try {
                $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissions($user->id);

                $newExpirationDate = $userAccessPermissions->getMembershipExpirationDate();
                $oldExpirationDate = $user->membership_expiration_date;

                $diff = $newExpirationDate?->diffInDays($oldExpirationDate);
                Log::info("$user->id:Verifying user permissions");
                if ($diff == null || $diff > 0) {
                    Log::warning("$user->id:$oldExpirationDate -> $newExpirationDate ($diff)");
                }

                $permissionIds = $userAccessPermissions->getActivePermissionIds();
                $existingUserPermissions = $this->contentPermissionsService->getUserPermissions($user->id)->keyBy(
                    'permission_id'
                );

                $toDeleteIds = $existingUserPermissions->where(function ($item, $key) use ($permissionIds) {
                    return !in_array($key, $permissionIds);
                })->pluck('id')->toArray();

                foreach ($permissionIds as $permissionId) {
                    list($startDate, $expirationDate) = $userAccessPermissions->getActiveDates($permissionId);
                    /** @var UserPermission $userPermission */
                    $userPermission = $existingUserPermissions[$permissionId] ?? null;
                    if ($userPermission == null) {
                        Log::warning(
                            "$user->id:User permission not found for user:$user->id, permission:$permissionId ($startDate - $expirationDate)"
                        );
                    }
                    $diffStart = $startDate?->diffInDays($userPermission->start_date);
                    $diffExpiration = $expirationDate?->diffInDays($userPermission->expiration_date);
                    if ($diffStart == null || $diffStart > 0) {
                        Log::warning("$user->id:$permissionId $oldExpirationDate -> $newExpirationDate ($diffStart)");
                    }
                    if ($diffExpiration == null || $diffExpiration > 0) {
                        Log::warning("$user->id:$permissionId $oldExpirationDate -> $newExpirationDate ($diffExpiration)");
                    }
                }

                Log::warning("$user->id:Deleting user permissions:" . implode(',', $toDeleteIds));
            } catch (\Throwable $ex) {
                Log::error("$user->id:Error verifying user permissions");
                Log::error($ex);
            }
        }
        return true;
    }
}
