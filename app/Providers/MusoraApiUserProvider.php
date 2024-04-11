<?php

namespace App\Providers;

use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use App\Services\CalendarService;
use Carbon\Carbon;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\FirebaseToken;
use Railroad\MusoraApi\Contracts\UserProviderInterface;
use Railroad\MusoraApi\Entities\User;
use Railroad\MusoraApi\Exceptions\MusoraAPIException;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railforums\Repositories\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MusoraApiUserProvider implements UserProviderInterface
{
    private CalendarService $calendarService;
    private CommentService $commentService;
    private PostRepository $postRepository;
    private ContentService $contentService;
    private CustomerIoService $customerIoService;
    private RevenueCatService $revenueCatService;
    private SubscriptionService $subscriptionService;

    public function __construct(
        CalendarService $calendarService,
        CommentService $commentService,
        PostRepository $postRepository,
        ContentService $contentService,
        CustomerIoService $customerIoService,
        RevenueCatService $revenueCatService,
        SubscriptionService $subscriptionService
    ) {
        $this->calendarService = $calendarService;
        $this->commentService = $commentService;
        $this->postRepository = $postRepository;
        $this->contentService = $contentService;
        $this->customerIoService = $customerIoService;
        $this->revenueCatService = $revenueCatService;
        $this->subscriptionService = $subscriptionService;
    }

    public function getCurrentUser(): ?User
    {
        if (user()) {
            return new User(
                user()->id, user()->email, user()->display_name, user()->profile_picture_url ?? '', user()->phone_number
            );
        }

        return null;
    }

    public function getCurrentUserMembershipData(?string $app = null)
    : array {
        $user = user();

        $isAppleAppSubscriber = $user->has_apple_subscription;
        $isGoogleAppSubscriber = $user->has_google_subscription;

        $hasExperience = user()->onboardingExperience ? true : false;

        $hasGear = count(
                user()->onboardingGear->filter(function ($item) use($user) {
                    return $item->brand == $user->last_used_brand;
                })
            ) > 0;

        $hasTopics = count(
                user()->onboardingTopics->filter(function ($item) use($user) {
                    return $item->brand == $user->last_used_brand;
                })
            ) > 0;

        $hasGenres = count(
                user()->onboardingGenres->filter(function ($item) use($user) {
                    return $item->brand == $user->last_used_brand;
                })
            ) > 0;

        try {
            $accountName = ($app)?strtolower($app):config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
            $customerIoData = $this->customerIoService->getCustomerByUserId(
                $accountName,
                $user->id,
            );
        } catch (ModelNotFoundException $exception) {
            $customerIoData = null;
        }

        $extraData = [
            'customer_io_id' => $customerIoData?->uuid,
        ];

        $branchData = $this->getAllBranchInformation();
        $featureData = $this->getAccessibleFeatures();
        $featureArray = ['branches' => $branchData, 'features' => $featureData];

        $userArray = array_merge($user->toArray(), $extraData, $featureArray);

        return [
            'user' => $userArray,
            'isEdge' => $user->isAMember(),
            'isEdgeExpired' => !$user->membership_expiration_date || $user->isAnExpiredMember(),
            'edgeExpirationDate' => $user->membership_expiration_date,
            'isPackOnlyOwner' => $user->isPackOnlyOwner(),
            'isAppleAppSubscriber' => $isAppleAppSubscriber,
            'isGoogleAppSubscriber' => $isGoogleAppSubscriber,
            'membership_level' => $user->membership_level,
            'is_drumeo_lifetime_member' => $user->is_drumeo_lifetime_member,
            'is_lifetime_member' => $user->is_lifetime_member,
            'show_onboarding' => (!$hasGear || !$hasTopics || !$hasGenres || !$hasExperience),
            'access_level' => $user->access_level,
            'is_enrolled_into_cohort' => $user->isEnrolledIntoCohort(),
            'subcription_date' => Carbon::parse($user->created_at)->format('Y/m/d H:i:s'),
        ];
    }

    public function getCurrentUserProfileData(?string $app = null)
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
                $user->id,
            );
        } catch (ModelNotFoundException $exception) {
            $customerIoData = null;
        }

        $extraData = [
            'customer_io_id' => $customerIoData?->uuid,
        ];

        $brand = brand();
        $showLearningPathsOnHomepage = false;
        $hideSection = $brand.'_trial_section_hide';

        if($user->is_trial && !user()->$hideSection && $user->created_at->diffInDays(now()) <= 30) {
            $hasExperienceLevels =  count(
                    user()->onboardingExperience->filter(function ($item) use($brand) {
                        return $item->brand == $brand && ($item->experience_level == 0 || $item->experience_level == 1);
                    })
                ) > 0;
            $showLearningPathsOnHomepage = ($hasExperienceLevels) ? true : false;
        }

        $completedWorkouts = $this->contentService->countByTypesRecentUserProgressState(
            ['workout'],
            $user->id,
            'completed'
        );

        return array_merge([
            'id' => $user->id,
            'email' => $user->email,
            'permission_level' => $user->permission_level,
            'display_name' => $user->display_name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'avatarUrl' => $user->profile_picture_url,
            'profile_picture_url' => $user->profile_picture_url,
            'helpscout_beacon_id' => config('railhelpscout.helpscout_tracking_beacon_id.' . brand()),
            'level_rank' => $user->getMethodLevel(),
            'has_started_method' => $hasStartedMethod ?? false,
            'has_completed_method' => $hasCompletedMethod ?? false,
            'login_as_users' => $user->hasRole('login_as_users'),
            'show_learning_paths_on_homepage' => $showLearningPathsOnHomepage,
            'completed_workouts' => $completedWorkouts,
        ], $extraData);
    }

    public function getCurrentUserExperienceData(): array
    {
        return [
            'totalXp' => user()->getBrandTotalXp(),
            'xpRank' => user()->getXpRank(),
            'musoraXP' => user()->getTotalXp(),
        ];
    }

    public function setCurrentUserProfilePictureUrl(?string $profilePictureUrl = null): User
    {
        user()->profile_picture_url = $profilePictureUrl;
        user()->save();

        return $this->getCurrentUser();
    }

    public function setCurrentUserPhoneNumber(string $phoneNumber): User
    {
        user()->phone_number = $phoneNumber;
        user()->save();

        return $this->getCurrentUser();
    }

    public function setCurrentUserDisplayName(string $displayName): ?User
    {
        $inUseDisplayName =
            \Modules\UserManagementSystem\Models\User::where('display_name', $displayName)
                ->get();
        $mobileEndpointVersion = (config('musora-api.api.version'));
        $mobileEndpointVersion = str_replace('v', '', $mobileEndpointVersion);

        if (($inUseDisplayName->count() > 0) && (strtolower($displayName) != strtolower(user()->display_name))) {
            throw new MusoraAPIException(
                'This display name is already in use', 'Display name exist', ($mobileEndpointVersion >= 2) ? 200 : 500
            );
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

    public function setAndGetUserTimezone(): string
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
        $this->subscriptionService->cancelAllSubscriptions($user, 'Account deleted');

        $user->fill([
            'email' => 'musora+deleted_' .
                Carbon::now()
                    ->getTimestamp() .
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
            'musora+deleted_' .
            Carbon::now()
                ->getTimestamp() .
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
        $user = \Modules\UserManagementSystem\Models\User::onWriteConnection()->where(
        'revenuecat_origin_app_user_id',
        '=',
        $revenuecatOriginalAppUserId
    )
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

    /**
     * @return array
     */
    public function getAllBranchInformation()
    {
        return FeatureFlagging::allBranches(user());
    }

    /**
     * @return array
     */
    public function getAccessibleFeatures()
    {
        return FeatureFlagging::allowedFeatures(user());
    }
}
