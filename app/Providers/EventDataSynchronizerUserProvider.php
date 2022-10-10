<?php

namespace App\Providers;

use App\Modules\EventDataSynchronizer\Events\UserMembershipDateUpdated;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;

class EventDataSynchronizerUserProvider implements UserProviderInterface
{
    public function isAdministrator(int $userId)
    : bool {
        if (!empty(user()) && $userId == user()->id) {
            return user()->isAdmin();
        }

        $user =
            User::query()
                ->find($userId);

        return !empty($user) && $user->isAdmin();
    }

    public function saveMembershipData(
        int $userId,
        ?Carbon $membershipExpirationDate,
        bool $isLifetimeMember,
        string $accessLevel,
        bool $isPackOwner
    )
    : bool {
        $user =
            User::query()
                ->find($userId);

        if (!empty($user)) {
            if ($isLifetimeMember) {
                $membershipExpirationDate = Carbon::maxValue();
            }
            $isUpdatingMembershipDate = $user->membership_expiration_date != $membershipExpirationDate;

            $user->membership_expiration_date =
                !empty($membershipExpirationDate) ? $membershipExpirationDate->toDateTimeString() : null;
            $user->is_lifetime_member = $isLifetimeMember;
            $user->access_level = $accessLevel;
            $user->is_pack_owner = $isPackOwner;

            $user->save();

            if ($isUpdatingMembershipDate) {
                event(new UserMembershipDateUpdated($user));
            }

            return true;
        }

        return false;
    }

    public function saveExperiencePoints(int $userId, int $totalXp, $shouldRevert = false)
    : bool {
        $user =
            User::query()
                ->find($userId);
        if (!empty($user)) {
            $userBrandXP = user()->brand_total_xp;
            $brand = config('railcontent.brand');
            if ($shouldRevert) {
                $userBrandXP[$brand] = isset($userBrandXP[$brand]) ? $userBrandXP[$brand] - $totalXp : 0;
                $totalGXp = ($user->total_xp > 0) ? $user->total_xp - $totalXp : 0;
            } else {
                $userBrandXP[$brand] = ($userBrandXP[$brand] ?? 0) + $totalXp;
                $totalGXp = ($user->total_xp ?? 0) + $totalXp;
            }

            $user->brand_total_xp = $userBrandXP;
            $user->total_xp = $totalGXp;
            $user->save();

            return true;
        }

        return false;
    }

    public function savePackOwnerData(int $userId, bool $isPackOwner)
    : bool {
        // TODO: Implement savePackOwnerData() method.
    }
}
