<?php

namespace App\Providers;

use Carbon\Carbon;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\MusoraApi\Contracts\UserProviderInterface;
use Railroad\MusoraApi\Entities\User;
use Railroad\MusoraApi\Exceptions\MusoraAPIException;

class MusoraApiUserProvider implements UserProviderInterface
{
    private SubscriptionRepository $subscriptionRepository;
    private ProductRepository $productRepository;

    public function __construct(
        SubscriptionRepository $subscriptionRepository,
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->subscriptionRepository = $subscriptionRepository;
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

    public function getCurrentUserMembershipData(?string $brand = null)
    : array {
        $user = user();
        $productsIds = [];
        $products = [];
        foreach (config('ecommerce.available_brands', []) as $availableBrand) {
            if (!isset(config('ecommerce.membership_product_skus')[$availableBrand])) {
                break;
            }
            $products += $this->productRepository->bySkus(config('ecommerce.membership_product_skus')[$availableBrand]);
        }

        foreach ($products as $product) {
            $productsIds[] = $product->getId();
        }

        $membershipSubscription = $this->subscriptionRepository->getUserSubscriptionForProducts(
            $user->id,
            $productsIds,
            true
        );

        $isAppleAppSubscriber = false;
        $isGoogleAppSubscriber = false;

        if ($membershipSubscription) {
            $isAppleAppSubscriber = $membershipSubscription->getType() == Subscription::TYPE_APPLE_SUBSCRIPTION;
            $isGoogleAppSubscriber = $membershipSubscription->getType() == Subscription::TYPE_GOOGLE_SUBSCRIPTION;
        }

        return [
            'isEdge' => $user->isAMember(),
            'isEdgeExpired' => $user->isAnExpiredMember(),
            'edgeExpirationDate' => $user->membership_expiration_date,
            'isPackOnlyOwner' => $user->isPackOnlyOwner(),
            'isAppleAppSubscriber' => $isAppleAppSubscriber,
            'isGoogleAppSubscriber' => $isGoogleAppSubscriber,
        ];
    }

    public function getCurrentUserProfileData()
    : array
    {
        $user = user();
        return [
            'id' => $user->id,
            'email' => $user->email,
            'permission_level' => $user->permission_level,
            'display_name' => $user->display_name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'avatarUrl' => $user->profile_picture_url,
            'profile_picture_url' => $user->profile_picture_url,
            'helpscout_beacon_id' => config('railhelpscout.helpscout_tracking_beacon_id')
        ];
    }

    public function getCurrentUserExperienceData()
    : array
    {
        return [
            'totalXp' => user()->total_xp,
            'xpRank' => user()->getXpRank(),
        ];
    }

    public function setCurrentUserProfilePictureUrl(?string $profilePictureUrl = null)
    : User {
        user()->profile_picture_url = $profilePictureUrl;
        user()->save();

        return $this->getCurrentUser();
    }

    public function setCurrentUserPhoneNumber(string $phoneNumber)
    : User {
        user()->phone_number = $phoneNumber;
        user()->save();

        return $this->getCurrentUser();
    }

    public function setCurrentUserDisplayName(string $displayName)
    : ?User {
        $inUseDisplayName = \Modules\UserManagementSystem\Models\User::where('display_name',$displayName)->get();

        if(($inUseDisplayName->count() > 0) && (strtolower($displayName) != strtolower(user()->display_name))){
            throw new MusoraAPIException('This display name is already in use', 'Display name exist', 500);
        }

        user()->display_name = $displayName;
        user()->save();

        return $this->getCurrentUser();
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
