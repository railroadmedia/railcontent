<?php

namespace App\Modules\EventDataSynchronizer\Services;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Events\UserMembershipDateUpdated;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;
use Railroad\Railcontent\Services\ContentService;

class UserMembershipFieldsService
{
    private ContentService $contentService;
    private UserProviderInterface $userProvider;

    private $instructorsCache = null;
    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(
        ContentService $contentService,
        UserProviderInterface $userProvider,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        $this->contentService = $contentService;
        $this->userProvider = $userProvider;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    public function syncUserAccess(UserAccessPermissionsCollection $userAccessPermissions): bool
    {
        $user = $userAccessPermissions->getUser();
        $userId = $user->id;

        //This code is complex and should be thoroughly understood before changing it
        //membership expiration date comes from both plus and basic permissions combined
        $membershipExpirationDate = $userAccessPermissions->getMembershipExpirationDate();
        if (!$membershipExpirationDate && $user->legacy_expiration_date) {
            //legacy permissions were not migrated to the new shopify permission system
            //customer io relies on having the expiration date populated for historical data
            $membershipExpirationDate = Carbon::parse($user->legacy_expiration_date);
        }
        //access level comes from plus or basic permissions
        $plusMembershipExpirationDate = $userAccessPermissions->getPlusMembershipExpirationDate();
        $basicMembershipExpirationDate = $userAccessPermissions->getBasicMembershipExpirationDate();

        $songsOnlyExpirationDate = $userAccessPermissions->getSongsOnlyExpirationDate();

        $membershipLevel = null;
        if ($plusMembershipExpirationDate > Carbon::now() ||
            ($basicMembershipExpirationDate > Carbon::now() && $songsOnlyExpirationDate > Carbon::now())) {
            $membershipLevel = 'plus';
        } elseif ($basicMembershipExpirationDate > Carbon::now()) {
            $membershipLevel = 'basic';
        }

        $isLifetimeMember = $userAccessPermissions->getIsLifetimeMember();
        $isDrumeoLifetimeMember = $userAccessPermissions->getIsDrumeoLifetimeMember();
        $ownsPacks = $this->userAccessPermissionsService->getOwnsPacks($userAccessPermissions);


        $isAMember = $membershipExpirationDate > Carbon::now();

        $accessLevel = $this->getAccessLevelName(
            $userId,
            $isLifetimeMember,
            $isAMember,
            $membershipExpirationDate,
            $ownsPacks
        );

        return $this->saveMembershipData(
            $userId,
            $membershipExpirationDate,
            null,
            $isLifetimeMember,
            $accessLevel,
            $ownsPacks,
            $membershipLevel,
            $isDrumeoLifetimeMember
        );
    }

    public function saveMembershipData(
        int $userId,
        ?Carbon $membershipExpirationDate,
        ?Carbon $membershipStartDate,
        bool $isLifetimeMember,
        string $accessLevel,
        bool $isPackOwner,
        ?string $membershipLevel,
        bool $isDrumeoLifetimeMember
    ): bool {
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
            $user->membership_start_date = !empty($membershipStartDate) ? $membershipStartDate->toDateTimeString(
            ) : null;
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

    public function sync($userId): bool
    {
        $user = User::find($userId);
        if ($user == null) {
            return false;
        }
        $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissionsByUser($user);
        return $this->syncUserAccess($userAccessPermissions);
    }

    /**
     * The value of this should be not used for anything other than visual purposes. It does not always represent the
     * state of the users membership exactly.
     *
     * @param $userId
     * @param bool $isLifetime
     * @param bool $isAMember
     * @param Carbon|null $membershipExpirationDate
     * @param bool $ownsPacks
     * @return string
     */
    public function getAccessLevelName(
        $userId,
        bool $isLifetime,
        bool $isAMember,
        ?Carbon $membershipExpirationDate,
        bool $ownsPacks,
        array $associatedCoaches = null
    ): string {
        if (empty($userId)) {
            return '';
        }

        if ($this->isHouseCoach($userId, $associatedCoaches)) {
            return 'house-coach';
        }

        if ($this->isCoach($userId, $associatedCoaches)) {
            return 'coach';
        }

        if ($this->userProvider->isAdministrator($userId)) {
            return 'team';
        }

        if ($isLifetime) {
            return 'lifetime';
        }

        if ($isAMember && (!empty($membershipExpirationDate) && $membershipExpirationDate > Carbon::now())) {
            return 'member';
        }

        if ($ownsPacks) {
            return 'pack';
        }

        if (!empty($membershipExpirationDate) && $membershipExpirationDate < Carbon::now()) {
            return 'expired';
        }

        return '';
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isHouseCoach($userId, array $associatedCoaches = null): bool
    {
        if (!isset($associatedCoaches)) {
            $associatedCoaches = $this->getCoaches();
        }

        return
            (!empty($associatedCoaches) &&
                array_key_exists($userId, $associatedCoaches) &&
                ($associatedCoaches[$userId]['is_house_coach'] == "1"));
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isCoach($userId, array $associatedCoaches = null): bool
    {
        if (!isset($associatedCoaches)) {
            $associatedCoaches = $this->getCoaches();
        }

        return !empty($associatedCoaches) && array_key_exists($userId, $associatedCoaches);
    }

    /**
     * @return array
     */
    public function getCoaches(): array
    {
        $associatedUsers = [];

        if (!isset($this->instructorsCache)) {
            $this->instructorsCache =
                $this->contentService
                    ->getFiltered(
                        1,
                        'null',
                        '-published_on',
                        ['instructor'],
                        [],
                        [],
                        [],
                        []
                    );
        }

        $instructors = $this->instructorsCache;

        foreach ($instructors->results() as $instructor) {
            $associatedUsers[$instructor->fetch('fields.associated_user_id')] = [
                'id' => $instructor['id'],
                'url' => $instructor->fetch('url', ''),
                'is_house_coach' => $instructor->fetch('fields.is_house_coach', 0),
            ];
        }

        return $associatedUsers;
    }
}
