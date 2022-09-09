<?php

namespace App\Providers;

use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\EventDataSynchronizer\Providers\UserProviderInterface;

class EventDataSynchronizerUserProvider implements UserProviderInterface
{
    public function isAdministrator(int $userId): bool
    {
        if (!empty(user()) && $userId == user()->id) {
            return user()->isAdmin();
        }

        $user = User::query()->find($userId);

        return !empty($user) && $user->isAdmin();
    }

    public function saveMembershipData(
        int $userId,
        ?Carbon $membershipExpirationDate,
        bool $isLifetimeMember,
        string $accessLevel,
        bool $isPackOwner
    ): bool {
        $user = User::query()->find($userId);

        if (!empty($user)) {
            $user->membership_expiration_date = !empty($membershipExpirationDate) ?
                $membershipExpirationDate->toDateTimeString() : null;
            $user->is_lifetime_member = $isLifetimeMember;
            $user->access_level = $accessLevel;
            $user->is_pack_owner = $isPackOwner;

            $user->save();

            return true;
        }

        return false;
    }

    public function saveExperiencePoints(int $userId, int $totalXp):bool
    {
        $user = User::query()->find($userId);
        if (!empty($user)) {
            $user->total_xp = $totalXp;
            $user->save();

            return true;
        }

        return false;
    }
}
