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

        $totalProcessed = 0;
        $totalPassed = 0;
        $totalPercentagePassed = 0;

        foreach ($items as $user) {
            /** @var User $user */
            try {
                $potentialIssue = false;
                $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissions($user->id);

                $newExpirationDate = $userAccessPermissions->getMembershipExpirationDate();
                $oldExpirationDate = $user->membership_expiration_date;
                if ($oldExpirationDate == null && $user->isALifetimeMember()) {
                    $oldExpirationDate = Carbon::maxValue();
                }
                $diff = $newExpirationDate?->diffInDays($oldExpirationDate);
                Log::info("$user->id:Verifying user permissions ($totalPercentagePassed%)");
                if (($oldExpirationDate > Carbon::now() || $newExpirationDate > Carbon::now())
                    and (is_null($diff)
                        || $diff > 2 //buffer changed form 5 to 7 days
                        || $diff < 0)
                    and ($oldExpirationDate > Carbon::now() || $newExpirationDate > Carbon::now())) {
                    $potentialIssue = true;
                    Log::warning("$user->id:membership $oldExpirationDate -> $newExpirationDate ($diff)");
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
                        if ($expirationDate > Carbon::now()) {
                            $potentialIssue = true;
                            Log::warning(
                                "$user->id:User permission not found for user:$user->id, permission:$permissionId ($startDate - $expirationDate)"
                            );
                        }
                        continue;
                    }

                    $oldStartDate = $userPermission['start_date'];
                    $oldExpirationDate = $userPermission['expiration_date'] ?? Carbon::maxValue();
                    $diffStart = $oldStartDate ? $startDate?->diffInDays($oldStartDate) : null;
                    $diffExpiration = $oldExpirationDate ? $expirationDate?->diffInDays($oldExpirationDate) : null;
                    if ($startDate > Carbon::now()) {
                        $potentialIssue = true;
                        Log::warning(
                            "$user->id:$permissionId start date in the future $oldStartDate -> $startDate ($diffStart)"
                        );
                    }
                    if (($oldExpirationDate > Carbon::now() || $expirationDate > Carbon::now())
                        and (is_null($diffExpiration)
                            || $diffExpiration > 2 //buffer changed form 5 to 7 days
                            || $diffExpiration < 0)) {
                        if ($permissionId == 1 && $expirationDate == Carbon::maxValue(
                            ) && $user->is_drumeo_lifetime_member) {
                            continue;
                        }
                        if (in_array($permissionId, [73, 77, 92]) && $expirationDate == Carbon::maxValue() && $user->is_lifetime_member) {
                            continue;
                        }

                        $potentialIssue = true;
                        Log::warning(
                            "$user->id:$permissionId $oldExpirationDate -> $expirationDate ($diffExpiration)"
                        );
                    }
                }

                if (count($toDeleteIds) > 0) {
                    $potentialIssue = true;
                    Log::warning("$user->id:Deleting user permissions:" . implode(',', $toDeleteIds));
                }
            } catch
            (\Throwable $ex) {
                $potentialIssue = true;
                Log::error("$user->id:Error verifying user permissions");
                Log::error($ex);
            }
            if (!$potentialIssue) {
                $totalPassed++;
            }
            $totalProcessed++;
            $totalPercentagePassed = round($totalPassed / $totalProcessed * 100, 2);
        }
        return true;
    }
}
