<?php

namespace App\Providers;

use Modules\UserManagementSystem\Events\MobileAppLogin;
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
                user()->id, user()->email, user()->display_name, user()->profile_picture_url, user()->phone_number
            );
        }

        return null;
    }

    public function getCurrentUserMembershipData(?string $brand)
    : array
    {
        // TODO: Implement getCurrentUserMembershipData() method.
        return [
            'isEdge' => true,
            'isEdgeExpired' => false,
            'edgeExpirationDate' => null,
            'isPackOlyOwner' => false,
            'isAppleAppSubscriber' => true,
            'isGoogleAppSubscriber' => false
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
        // TODO: Implement setCurrentUserProfilePictureUrl() method.
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

    public function setReviewDataForCurrentUser(string $deviceType, int $reviewCount)
    {
        // TODO: Implement setReviewDataForCurrentUser() method.
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
        $passedCheck = auth()->guard('user-management-system')
            ->validate(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if ($passedCheck) {
            $user = \Modules\UserManagementSystem\Models\User::query()->where(['email' => $request->get('email')])->firstOrFail();

            auth()->login($user);

            event(
                new MobileAppLogin($user, $request->get('firebase_token'), $request->get('platform'))
            );

            $token = $user->createToken($request->get('platform',''));
            $user->withAccessToken($token);

            return ['token' => $token->plainTextToken, 'user' => $user];
        }

        return null;
    }
}
