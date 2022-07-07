<?php

namespace App\Providers;

use Carbon\Carbon;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Providers\UserServiceProvider;
use Railroad\MusoraApi\Contracts\UserProviderInterface;
use Railroad\MusoraApi\Entities\User;

class MusoraApiUserProvider implements UserProviderInterface
{
    /**
     * @var UserServiceProvider
     */
    private $userServiceProvider;

    /**
     * @param UserServiceProvider $userServiceProvider
     */
    public function __construct(UserServiceProvider $userServiceProvider)
    {
        $this->userServiceProvider = $userServiceProvider;
    }

    public function getCurrentUser()
    : ?User
    {
        if (user()) {
            return new User(
                user()->id, user()->email, user()->display_name, user()->profile_picture_url ?? '', user()->phone_number
            );
        }

        return null;
    }

    public function getCurrentUserMembershipData(?string $brand)
    : array {
        $user = user();

        return [
            'isEdge' => $user->isAMember(),
            'isEdgeExpired' => $user->isAnExpiredMember(),
            'edgeExpirationDate' => $user->membership_expiration_date,
            'isPackOnlyOwner' => $user->isPackOnlyOwner(),
            'isAppleAppSubscriber' => true,
            'isGoogleAppSubscriber' => false,
        ];
    }

    public function getCurrentUserProfileData()
    : array
    {
        // TODO: Implement getCurrentUserProfileData() method.
    }

    public function getCurrentUserExperienceData()
    : array
    {
        // TODO: Implement getCurrentUserExperienceData() method.
    }

    public function setCurrentUserProfilePictureUrl(string $profilePictureUrl)
    : User {
        user()->profile_picture_url =  $profilePictureUrl;
        user()->save();

        return $this->getCurrentUser();
    }

    public function setCurrentUserPhoneNumber(string $phoneNumber)
    : User {
        // TODO: Implement setCurrentUserPhoneNumber() method.
    }

    public function setCurrentUserDisplayName(string $displayName)
    : ?User {
        // TODO: Implement setCurrentUserDisplayName() method.
    }

    public function setCurrentUserFirebaseTokens(?string $iosToken, ?string $androidToken)
    {
        // TODO: Implement setCurrentUserFirebaseTokens() method.
    }

    /**
     * @param string $deviceType
     * @param int $reviewCount
     * @return mixed|\Modules\UserManagementSystem\Models\User|null
     */
    public function setReviewDataForCurrentUser(string $deviceType, int $reviewCount)
    {
        $user = user();
        if ($user) {
            $oldUser = clone($user);
            if ($deviceType == 'ios') {
                $user->ios_latest_review_display_date = Carbon::now();
                $user->ios_count_review_display = $reviewCount;
            } elseif ($deviceType == 'android') {
                $user->google_latest_review_display_date = Carbon::now();
                $user->google_count_review_display = $reviewCount;
            }

            $user->save();

            event(new UserUpdated($user, $oldUser));
        }

        return $user;
    }

    public function getUsoraCurrentUser()
    {
        // TODO: Implement getUsoraCurrentUser() method.
    }

    public function setAndGetUserTimezone()
    : string
    {
        return '';
    }

    public function login($request)
    {
        $passedCheck =
            auth()
                ->guard('user-management-system')
                ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user =
                \Modules\UserManagementSystem\Models\User::query()
                    ->where(['email' => $request->get('email')])
                    ->firstOrFail();

            auth()->login($user);

            event(
                new MobileAppLogin($user, $request->get('firebase_token'), $request->get('platform'))
            );

            $token = $user->createToken($request->get('platform', ''));
            $user->withAccessToken($token);

            return ['token' => $token->plainTextToken, 'user' => $user];
        }

        return null;
    }
}
