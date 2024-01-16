<?php

namespace App\Modules\EventDataSynchronizer\Providers;

use Carbon\Carbon;

interface UserProviderInterface
{
    /**
     * @param int $userId
     * @return bool
     */
    public function isAdministrator(int $userId): bool;

    /**
     * @param int $userId
     * @param Carbon|null $membershipExpirationDate
     * @param Carbon|null $membershipStartDate
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
        ?Carbon $membershipStartDate,
        bool $isLifetimeMember,
        string $accessLevel,
        bool $isPackOwner,
        ?string $membershipLevel,
        bool $isDrumeoLifetimeMember
    ): bool;

    /**
     * @param int $userId
     * @param int $totalXp
     * @return bool
     */
    public function saveExperiencePoints(int $userId, array $totalXp, $shouldRevert = false): bool;
}
