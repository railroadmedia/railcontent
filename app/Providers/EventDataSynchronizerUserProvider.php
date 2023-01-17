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

    /**
     * @param int $userId
     * @param Carbon|null $membershipExpirationDate
     * @param bool $isLifetimeMember
     * @param string $accessLevel
     * @param bool $isPackOwner
     * @param string|null $membershipLevel
     * @param bool $isDrumeoLifetimeMember
     * @return bool
     */
    public function saveMembershipData(
        int $userId,
        ?Carbon $membershipExpirationDate,
        bool $isLifetimeMember,
        string $accessLevel,
        bool $isPackOwner,
        ?string $membershipLevel,
        bool $isDrumeoLifetimeMember
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
            $user->is_drumeo_lifetime_member = $isDrumeoLifetimeMember;
            $user->access_level = $accessLevel;
            $user->is_pack_owner = $isPackOwner;
            $user->membership_level = $membershipLevel;

            $user->save();

            if ($isUpdatingMembershipDate) {
                event(new UserMembershipDateUpdated($user));
            }

            return true;
        }

        return false;
    }

    public function saveExperiencePoints(int $userId, array $totalXpPerBrands, $shouldRevert = false)
    : bool {
        $user =
            User::query()
                ->find($userId);

        if (!empty($user) && $user) {
            $userBrandXP = $user->brand_total_xp;
            $totalXp = 0;
            foreach ($totalXpPerBrands as $brand => $totalXpPerBrand){
                $userBrandXP[$brand] = $totalXpPerBrand;
                $totalXp += $totalXpPerBrand;
            }

            $user->brand_total_xp = $userBrandXP;
            $user->total_xp = $totalXp;
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
