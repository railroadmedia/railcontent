<?php

namespace App\Modules\Ecommerce\Collections;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserAccessPermissionsCollection
{
    const MusoraBasicMembershipPermission = 91;
    const MusoraPlusMembershipPermission = 92;
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

    public function getActiveDates(int|array $permissions): array
    {
        if (is_integer($permissions)) {
            $userAccessPermissions = $this->permissionIdLookup[$permissions] ?? collect();
        } else {
            $userAccessPermissions = $this->collection->whereIn('permission_id', $permissions);
        }

        $userAccessPermissions = $userAccessPermissions
            ->where('status', '!=', UserAccessPermissionsStatusEnum::Revoked->value)
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
            $userAccessPermission->actualStartTime = $tempStartDate;
            $userAccessPermission->actualExpirationTime = $expirationDate;
        }
        if ($expirationDate) {
            $expirationDate->addDays(config('ecommerce.days_before_access_revoked_after_expiry', 7));
        }
        if ($expirationDate > Carbon::maxValue()) {
            $expirationDate = Carbon::maxValue();
        }
        return array($startDate, $expirationDate);
    }

    public function getMembershipExpirationDate(): ?Carbon
    {
        list($startDate, $endDate) = $this->getActiveDates([
            self::MusoraPlusMembershipPermission,
            self::MusoraBasicMembershipPermission
        ]);
        return $endDate;
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

    public function getPermissionIds(): array
    {
        return $this->collection->pluck('permission_id')->unique()->sort()->toArray();
    }

    public function hasUserOwnedPermissions(array $permissionIds): bool
    {
        list($startDate, $endDate) = $this->getActiveDates($permissionIds);
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


}
