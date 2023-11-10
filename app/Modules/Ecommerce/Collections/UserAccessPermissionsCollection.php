<?php

namespace App\Modules\Ecommerce\Collections;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UserAccessPermissionsCollection
{
    const MusoraBasicMembershipPermission = 91;
    const MusoraPlusMembershipPermission = 92;
    const SongsOnlyMembershipPermission = 94;
    const DrumeoLifetimePermission = 78;
    const LifetimePermissions = [self::DrumeoLifetimePermission, 88, 89, 90];

    private Collection $collection;
    private int $userId;
    private Collection $permissionIdLookup;

    public function __construct(int $userId, Collection $collection)
    {
        $this->collection = $collection;
        $this->userId = $userId;
        $this->collection->each(function (UserAccessPermission $item) {
            if ($item->user_id != $this->userId) {
                throw new \Exception("User id mismatch");
            }
        });
        $this->permissionIdLookup = $this->collection->groupBy('permission_id');
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getActiveDates(int|array $permissions, $includeBuffer = true): array
    {
        $unifiedLaunchDate = Carbon::parse(config('ecommerce.launch_dates.unified'));
        if (is_integer($permissions)) {
            $userAccessPermissions = $this->permissionIdLookup[$permissions] ?? collect();
        } else {
            $userAccessPermissions = $this->collection->whereIn('permission_id', $permissions);
        }

        $userAccessPermissions = $userAccessPermissions
            ->sortBy('start_time');
        $expirationDate = null;
        $startDate = null;
        $canAggregate = false;
        /** @var UserAccessPermission $userAccessPermission */
        foreach ($userAccessPermissions as $userAccessPermission) {
            if ($userAccessPermission->time_lifetime && $userAccessPermission->status != 'revoked') {
                return [Carbon::parse($userAccessPermission->start_time), Carbon::maxValue()];
            }
            if ($userAccessPermission->status == 'revoked') {
                $userAccessPermission->actualStartTime = Carbon::parse($userAccessPermission->start_time);
                $calculatedExpiration = $userAccessPermission->time_fixed ? Carbon::parse(
                    $userAccessPermission->time_fixed
                )
                    : Carbon::parse($userAccessPermission->start_time)->clone()
                        ->addMinutes($userAccessPermission->time_minutes)
                        ->addDays($userAccessPermission->time_days)
                        ->addMonths($userAccessPermission->time_months);
                $revokedAt = Carbon::parse($userAccessPermission->revoked_at);

                $userAccessPermission->actualExpirationTime = min($revokedAt, $calculatedExpiration);
                continue;
            }
            $aggregatePrevious = $expirationDate != null
                && $expirationDate > $userAccessPermission->start_time
                && $canAggregate; //do not aggregate permissions before unified launch
            $canAggregate = $userAccessPermission->start_time > $unifiedLaunchDate;
            $startDate = $aggregatePrevious ? $startDate : Carbon::parse($userAccessPermission->start_time);
            $tempStartDate = $aggregatePrevious ? $expirationDate : Carbon::parse($userAccessPermission->start_time);
            $expirationDate = $userAccessPermission->time_fixed ? Carbon::parse($userAccessPermission->time_fixed)
                : $tempStartDate->clone()
                    ->addMinutes($userAccessPermission->time_minutes)
                    ->addDays($userAccessPermission->time_days)
                    ->addMonths($userAccessPermission->time_months);
            $userAccessPermission->actualStartTime = $tempStartDate;
            $userAccessPermission->actualExpirationTime = $expirationDate;
        }
        if ($expirationDate && $includeBuffer) {
            $expirationDate->addDays(config('ecommerce.days_before_access_revoked_after_expiry', 7));
        }
        if ($expirationDate > Carbon::maxValue()) {
            $expirationDate = Carbon::maxValue();
        }
        return array($startDate, $expirationDate);
    }

    public function getMembershipExpirationDate($includeBuffer = true): ?Carbon
    {
        list($startDate, $endDate) = $this->getActiveDates([
            self::MusoraPlusMembershipPermission,
            self::MusoraBasicMembershipPermission
        ], $includeBuffer);
        return $endDate;
    }

    /**
     * @return string|void
     */
    public function getMembershipLevel()
    {
        if ($this->getIsLifetimeMember()) {
            return 'lifetime';
        }

        if (!empty($this->getPlusMembershipExpirationDate())) {
            return 'plus';
        }

        if (!empty($this->getBasicMembershipExpirationDate())) {
            return 'basic';
        }

        return 'none';
    }

    public function getAllNonMembershipPermissionNames()
    {
        $permissionNames = [];

        foreach ($this->getCollection()->all() as $userAccessPermission) {
            if (!Str::contains($userAccessPermission->permission->name, 'membership', true) &&
                !Str::contains($userAccessPermission->permission->name, 'edge', true)) {
                $permissionNames[] = $userAccessPermission->permission->name;
            }
        }

        return $permissionNames;
    }

    public function getPlusMembershipExpirationDate(): ?Carbon
    {
        list($startDate, $endDate) = $this->getActiveDates(self::MusoraPlusMembershipPermission);
        return $endDate;
    }

    public function getBasicMembershipExpirationDate(): ?Carbon
    {
        list($startDate, $endDate) = $this->getActiveDates(self::MusoraBasicMembershipPermission);
        return $endDate;
    }

    public function getSongsOnlyExpirationDate(): ?Carbon
    {
        list($startDate, $endDate) = $this->getActiveDates(self::SongsOnlyMembershipPermission);
        return $endDate;
    }

    public function getIsLifetimeMember(): bool
    {
        list($startDate, $endDate) = $this->getActiveDates(self::LifetimePermissions);
        return $endDate == Carbon::maxValue();
    }

    public function getIsDrumeoLifetimeMember(): bool
    {
        list($startDate, $endDate) = $this->getActiveDates(self::DrumeoLifetimePermission);
        return $endDate == Carbon::maxValue();
    }

    public function doesUserOwnPermissions(array $permissionIds): bool
    {
        list($startDate, $endDate) = $this->getActiveDates($permissionIds);
        return $endDate > Carbon::now();
    }

    public function getActivePermissionIds(): array
    {
        return $this->collection->where(function ($permission) {
            return $permission->status != 'revoked';
        })->pluck('permission_id')->unique()->sort()->toArray();
    }

    public function hasUserOwnedPermissions(array $permissionIds): bool
    {
        list(, $endDate) = $this->getActiveDates($permissionIds);
        return $endDate != null;
    }

    public function determineActiveTimes()
    {
        $this->permissionIdLookup->keys()->each(function ($key) {
            $this->getActiveDates($key);
        });
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function hasPermission($permissionID): bool
    {
        list(, $endDate) = $this->getActiveDates($permissionID);
        return $endDate > Carbon::now();
    }
}
