<?php

namespace App\Providers;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Services\CalendarService;
use Carbon\Carbon;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\FirebaseToken;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\SubscriptionService;
use Railroad\MusoraApi\Contracts\UserProviderInterface;
use Railroad\MusoraApi\Entities\User;
use Railroad\MusoraApi\Exceptions\MusoraAPIException;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railforums\Repositories\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class MusoraApiUserProvider implements UserProviderInterface
{
    private SubscriptionRepository $subscriptionRepository;
    private ProductRepository $productRepository;
    private CalendarService $calendarService;
    private CommentService $commentService;
    private PostRepository $postRepository;
    private ContentService $contentService;
    private CustomerIoService $customerIoService;
    private SubscriptionService $subscriptionService;
    private RevenueCatService $revenueCatService;

    public function __construct(
        SubscriptionRepository $subscriptionRepository,
        ProductRepository $productRepository,
        CalendarService $calendarService,
        CommentService $commentService,
        PostRepository $postRepository,
        ContentService $contentService,
        CustomerIoService $customerIoService,
        SubscriptionService $subscriptionService,
        RevenueCatService $revenueCatService
    ) {
        $this->productRepository = $productRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->calendarService = $calendarService;
        $this->commentService = $commentService;
        $this->postRepository = $postRepository;
        $this->contentService = $contentService;
        $this->customerIoService = $customerIoService;
        $this->subscriptionService = $subscriptionService;
        $this->revenueCatService = $revenueCatService;
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

//        foreach (config('ecommerce.available_brands', []) as $availableBrand) {
//            if (!isset(config('ecommerce.membership_product_skus')[$availableBrand])) {
//                break;
//            }
//            $products += $this->productRepository->bySkus(config('ecommerce.membership_product_skus')[$availableBrand]);
//        }
//
//        foreach ($products as $product) {
//            $productsIds[] = $product->getId();
//        }
//
//        $membershipSubscription = $this->subscriptionRepository->getUserSubscriptionForProducts(
//            $user->id,
//            $productsIds,
//            true
//        );
//
//        $isAppleAppSubscriber = false;
//        $isGoogleAppSubscriber = false;
//
//        if ($membershipSubscription) {
//            $isAppleAppSubscriber = $membershipSubscription->getType() == Subscription::TYPE_APPLE_SUBSCRIPTION;
//            $isGoogleAppSubscriber = $membershipSubscription->getType() == Subscription::TYPE_GOOGLE_SUBSCRIPTION;
//        }

        $revenuecatSubscriber = $this->revenueCatService->getSubscriber($user['revenuecat_origin_app_user_id']);
        $entitlements = $revenuecatSubscriber->entitlements;
        $subscriptions = $revenuecatSubscriber->subscriptions;

        $store = false;
        if (!empty($entitlements)) {
            foreach ($entitlements as $entitlement) {
                $productIdentifier = $entitlement->product_identifier;
                $subscriptionData = $subscriptions->$productIdentifier;
                $store = $subscriptionData->store;
            }
        }
        $isAppleAppSubscriber = ($store && $store == 'app_store')?true:false;
        $isGoogleAppSubscriber = ($store && $store == 'play_store')?true:false;

        return [
            'isEdge' => $user->isAMember(),
            'isEdgeExpired' => $user->isAnExpiredMember(),
            'edgeExpirationDate' => $user->membership_expiration_date,
            'isPackOnlyOwner' => $user->isPackOnlyOwner(),
            'isAppleAppSubscriber' => $isAppleAppSubscriber,
            'isGoogleAppSubscriber' => $isGoogleAppSubscriber,
            'membership_level' => $user->membership_level,
            'is_drumeo_lifetime_member' => $user->is_drumeo_lifetime_member,
            'is_lifetime_member' => $user->is_lifetime_member,
            'access_level' => $user->access_level,
        ];
    }

    public function getCurrentUserProfileData()
    : array
    {
        $user = user();

        switch (brand()) {
            case 'drumeo':
                $methodSlug = 'drumeo-method';
                break;
            case 'pianote':
                $methodSlug = 'pianote-method';
                break;
            case 'guitareo':
                $methodSlug = 'guitareo-method';
                break;
            case 'singeo':
                $methodSlug = 'singeo-method';
                break;
            default:
                throw new NotFoundHttpException();
        }

        $methodContent =
            $this->contentService->getBySlugAndType($methodSlug, 'learning-path')
                ->first();
        if ($methodContent) {
            $hasStartedMethod = $methodContent['started'];
            $hasCompletedMethod = $methodContent['completed'];
        }

        try {
            $customerIoData = $this->customerIoService->getCustomerByUserId(
                config('event-data-synchronizer.customer_io_account_to_sync_all_brands'),
                $user->id
            );
        } catch (ModelNotFoundException $exception) {
            $customerIoData = null;
        }

        $extraData = [
            'cio_id' => null,
            'customer_io_id' => null,
        ];

        if ($customerIoData && !empty($externalAttributes = $customerIoData->getExternalAttributes())) {
            $extraData = [
                'cio_id' => $externalAttributes['cio_id'],
                'customer_io_id' => $externalAttributes['id'],
            ];
        }

        return array_merge([
                               'id' => $user->id,
                               'email' => $user->email,
                               'permission_level' => $user->permission_level,
                               'display_name' => $user->display_name,
                               'first_name' => $user->first_name,
                               'last_name' => $user->last_name,
                               'avatarUrl' => $user->profile_picture_url,
                               'profile_picture_url' => $user->profile_picture_url,
                               'helpscout_beacon_id' => config(
                                   'railhelpscout.helpscout_tracking_beacon_id.'.brand()
                               ),
                               'level_rank' => $user->getMethodLevel(),
                               'has_started_method' => $hasStartedMethod ?? false,
                               'has_completed_method' => $hasCompletedMethod ?? false,
                           ], $extraData);
    }

    public function getCurrentUserExperienceData()
    : array
    {
        return [
            'totalXp' => user()->getBrandTotalXp(),
            'xpRank' => user()->getXpRank(),
            'musoraXP' => user()->getTotalXp(),
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
        $firebaseToken = [
            'type' => ($iosToken) ? 'ios' : 'android',
            'brand' => brand(),
            'user_id' => user()->id,
            'token' => $iosToken ?? $androidToken,
        ];

        FirebaseToken::firstOrNew($firebaseToken)
            ->save();

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

    public function deleteAccount()
    {
        $user = user();
        $userId = $user['id'];

        $this->commentService->markUserCommentsAsDeleted($userId);
        $this->postRepository->deleteByUserId($userId);
        $this->subscriptionService->cancelUserSubscriptions($userId);

        $user->fill([
                        'email' => 'musora+deleted_'.
                            Carbon::now()
                                ->getTimestamp().
                            '@musora.com',
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
        $user->email =
            'musora+deleted_'.
            Carbon::now()
                ->getTimestamp().
            '@musora.com';
        $user->updated_at =
            Carbon::now()
                ->toDateTimeString();
        $user->save();

        return $user;
    }

    public function getAuthKey()
    {
        return generate_musora_cross_platform_login_key(user()->id, user()->password);
    }


    public function getUserAfterRevenuecatPurchase($email, $password, $revenuecatOriginalAppUserId)
    {
        $user =
            \Modules\UserManagementSystem\Models\User::where('revenuecat_origin_app_user_id', '=', $revenuecatOriginalAppUserId)
                ->first();

        if (!$user) {
            $user = $this->revenueCatService->syncSubscriber($revenuecatOriginalAppUserId, $email, true);
        }

        if ($user) {
            $user->email = $email;
            $user->setPassword($password);
            $user->save();

            return $user;
        }

        return null;
    }
}
