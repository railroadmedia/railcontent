<?php

namespace App\Providers;

use App\Services\CalendarService;
use Carbon\Carbon;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\FirebaseToken;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\MusoraApi\Contracts\UserProviderInterface;
use Railroad\MusoraApi\Entities\User;
use Railroad\MusoraApi\Exceptions\MusoraAPIException;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railforums\Repositories\PostRepository;

class MusoraApiUserProvider implements UserProviderInterface
{
    private SubscriptionRepository $subscriptionRepository;
    private ProductRepository $productRepository;
    private CalendarService $calendarService;
    private CommentService $commentService;
    private PostRepository $postRepository;

    public function __construct(
        SubscriptionRepository $subscriptionRepository,
        ProductRepository $productRepository,
        CalendarService $calendarService,
        CommentService $commentService,
        PostRepository $postRepository
    ) {
        $this->productRepository = $productRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->calendarService = $calendarService;
        $this->commentService = $commentService;
        $this->postRepository = $postRepository;
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
            'helpscout_beacon_id' => config('railhelpscout.helpscout_tracking_beacon_id.' . brand() ),
            'level_rank' => $user->getMethodLevel(),
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
        $inUseDisplayName =
            \Modules\UserManagementSystem\Models\User::where('display_name', $displayName)
                ->get();

        if (($inUseDisplayName->count() > 0) && (strtolower($displayName) != strtolower(user()->display_name))) {
            throw new MusoraAPIException('This display name is already in use', 'Display name exist', 500);
        }

        user()->display_name = $displayName;
        user()->save();

        return $this->getCurrentUser();
    }

    /**
     * @param string|null $iosToken
     * @param string|null $androidToken
     * @return User|null
     */
    public function setCurrentUserFirebaseTokens(?string $iosToken, ?string $androidToken)
    {
       $firebaseToken =
            [
                'type' => ($iosToken) ? 'ios' : 'android',
                'brand' => brand(),
                'user_id' => user()->id,
                'token' => $iosToken ?? $androidToken,
            ]
        ;

       FirebaseToken::firstOrNew($firebaseToken)->save();

        return $this->getCurrentUser();
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
        return $this->calendarService->getTimezone(request());
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

    public function deleteAccount(){
        $user = user();
        $userId = $user['id'];

        $this->commentService->markUserCommentsAsDeleted($userId);
        $this->postRepository->deleteByUserId($userId);

        $user->fill([
            'email' => 'musora+deleted_'.Carbon::now()->getTimestamp().'@musora.com',
            'first_name' => null,
            'last_name' => null,
            'display_name' => '',
            'gender' => null,
            'country' => null,
            'region' => null,
            'city' => null,
            'birthday' => null,
            'phone_number' => null,
            'profile_picture_url' => null,
            'timezone' => null,
            'permission_level' => null,
            'drums_gear_photo' => null,
            'biography' => null,
            'piano_gear_photo' => null,
            'drums_gear_set_brands' => null,
            'drums_gear_hardware_brands' => null,
            'drums_gear_stick_brands' => null,
            'drums_gear_cymbal_brands' => null,
            'drums_playing_since_year' => null,
            'piano_gear_piano_brands' => null,
            'piano_gear_keyboard_brands' => null,
            'piano_playing_since_year' => null,

        ]);
        $user->email = 'musora+deleted_'.Carbon::now()->getTimestamp().'@musora.com';
        $user->save();

        return $user;
    }
}
