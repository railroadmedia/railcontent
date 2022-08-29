<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Crux\ProductAccessMap;
use App\Services\User\UserAccessService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Railroad\Crux\Services\NavigationSpecificsDeterminationService;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Ecommerce\Services\SubscriptionService;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Location\Services\CountryListService;
use Railroad\Railcontent\Services\UserPermissionsService;
use Railroad\Railforums\Repositories\UserSignaturesRepository;
use Railroad\Railnotifications\Services\NotificationSettingsService;

class ProfileSettingsPagesController extends BaseController
{
    private NotificationSettingsService $notificationSettingsService;

    /**
     * @var UserPermissionsService
     */
    private $userPermissionsService;

    /**
     * @var UserProductService
     */
    private $userProductService;
    /**
     * @var SubscriptionService
     */
    private $subscriptionService;
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;
    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @param NotificationSettingsService $notificationSettingsService
     */
    public function __construct(
        NotificationSettingsService $notificationSettingsService,
        UserSignaturesRepository $userSignaturesRepository,
        UserPermissionsService $userPermissionsService,
        UserProductService $userProductService,
        SubscriptionService $subscriptionService,
        SubscriptionRepository $subscriptionRepository,
        UserProviderInterface $userProvider
    )
    {
        $this->notificationSettingsService = $notificationSettingsService;
        $this->userSignaturesRepository = $userSignaturesRepository;
        $this->userPermissionsService = $userPermissionsService;
        $this->userProductService = $userProductService;
        $this->subscriptionService = $subscriptionService;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProvider = $userProvider;
    }

    public function profile(Request $request, $domain, $brand, $userId)
    {
        $userSignature = $this->userSignaturesRepository->getUserSignature();
        return view('account.settings.profile', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('profile'),
        ]);
    }

    public function loginCredentials(Request $request, $domain, $brand, $userId)
    {
        $userSignature = $this->userSignaturesRepository->getUserSignature();

        return view('account.settings.login-credentials', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('login-credentials'),
        ]);
    }

    public function notifications(Request $request, $domain, $brand, $userId)
    {
        $userSignature = [];

        return view('account.settings.settings', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('settings'),
            'userNotificationsSettings' => $this->notificationSettingsService->getUserNotificationSettings(user()->id, null, $request->get('selected-brand', $brand)),
            'allBrands' => all_brands(),
            'selectedBrand' => $request->get('selected-brand', $brand)

        ]);
    }

    public function account(Request $request, $domain, $brand, $userId)
    {
        if ($userId != auth()->id()) {
            // todo: redirect to version of this page for auth()->id()
        }

        $userId = auth()->id();

        $ecommerceUser = $this->userProvider->getCurrentUser();

        $now = Carbon::now();


        // ---------------------------- determine all owned digital non-membership products ----------------------------

        $userProducts = $this->userProductService->getAllUsersProducts($userId);

        $userProductsDigitalAccessTypeSpecific = [];

        $activeAllContentAccess = false;
        $subscriptionIsPaused = false;

        foreach ($userProducts as $userProduct) {
            if ($userProduct->getProduct()->getDigitalAccessType() == 'specific content access') {
                $userProductsDigitalAccessTypeSpecific[] = $userProduct;
            }
            $expired = $userProduct->getExpirationDate() ? $userProduct->getExpirationDate()->lt($now) : null;
            $isAllContentAccessProduct = $userProduct->getProduct()->getDigitalAccessType() == 'all content access';
            if (($expired !== true) && $isAllContentAccessProduct) {
                $paused = $userProduct->getStartDate() ? $userProduct->getStartDate()->gt($now) : false;
                if ($paused) {
                    $subscriptionIsPaused = true;
                } else {
                    $activeAllContentAccess = true;
                }
            }
        }

        // ---------------------------------------- get the active subscription ----------------------------------------

        $membershipSubscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;


        // ---------------------------------- have they had a membership previously? ----------------------------------

        $subscriptions = $this->subscriptionRepository->getSubscriptionsForUsers([$userId]);

        $hasHadMembership = false;

        foreach ($subscriptions as $subscription) {
            $isCorrectType = $subscription->getType() == 'subscription';

            $subscriptionProductId = $subscription->getProduct()->getId();
            $productsGrantingAllContentAccessIdsOnly = ProductAccessMap::productsGrantingAllContentAccessIdsOnly();

            if ($isCorrectType && in_array($subscriptionProductId, $productsGrantingAllContentAccessIdsOnly)) {
                $hasHadMembership = true;
            }
        }


        // ------------------------------------------ access from app purchase -----------------------------------------

        $accessIsFromAppPurchase = false;

        if ($membershipSubscription) {
            if (
                $membershipSubscription->getType() == 'apple_subscription' ||
                $membershipSubscription->getType() == 'google_subscription'
            ) {
                $accessIsFromAppPurchase = true;
            }
        }


        // --------------------------------------------- is lifetime member --------------------------------------------

        $isLifetime = false;

        foreach ($userProducts as $userProduct) {
            if (in_array($userProduct->getProduct()->getId(), [7,8,22,141,412])) {
                $isLifetime = true;
            }
        }

        // -------------------------------------------------------------------------------------------------------------

        return view('account.settings.account',
            [
                'user' => user(),
                'sections' => $this->settingSections('account'),
                'userProductsDigitalAccessTypeSpecific' => $userProductsDigitalAccessTypeSpecific,
                'activeAllContentAccess' => $activeAllContentAccess,
                'isLifetime' => $isLifetime,
                'subscriptionIsPaused' => $subscriptionIsPaused,
                'accessIsFromAppPurchase' => $accessIsFromAppPurchase,
                'membershipSubscription' => $membershipSubscription,
                'hasHadMembership' => $hasHadMembership
            ]
        );
    }

    public function payments(Request $request)
    {
//        $this->ecommerceEntityManager->getFilters()
//            ->disable('soft-deleteable');
//
//        $currentSubscription = $this->subscriptionRepository->getUserSubscriptionForProducts(
//            user()->id,
//            ProductAccessMap::membershipProductIds()
//        );
//
//        $existingSubscriptionActive = false;
//
//        if (!empty($currentSubscription) && $currentSubscription->getIsActive()) {
//            $existingSubscriptionActive = true;
//        }
//
//        $payments = $this->paymentRepository->getAllUsersPayments(user()->id);
//
//        foreach ($payments as $paymentIndex => $payment) {
//            if ($payment->getGatewayName() != 'pianote') {
//                unset($payments[$paymentIndex]);
//            }
//        }
//
//        // sort by date
//        usort($payments, function (Payment $a, Payment $b) {
//            return $a->getCreatedAt() < $b->getCreatedAt();
//        });
//
//        $paymentMethods = $this->paymentMethodRepository->getAllUsersPaymentMethods(
//            user()->id,
//            $request,
//            config('ecommerce.brand', null)
//        );
//
//        foreach ($paymentMethods as $paymentMethodIndex => $paymentMethod) {
//            if (!empty($paymentMethod->getDeletedAt())) {
//                unset($paymentMethods[$paymentMethodIndex]);
//            }
//        }
//
//        $paymentMethodsJson = ResponseService::paymentMethod(
//            $paymentMethods
//        )
//            ->respond()
//            ->getContent();
//
//        $stripePublishableKey = config('ecommerce.payment_gateways.stripe.pianote.stripe_publishable_key');
//
//        if (!empty($currentSubscription) && !empty($currentSubscription->getProduct())) {
//            $this->cartService->refreshCart();
//
//            $this->cartService->clearCart();
//
//            $this->cartService->addToCart(
//                $currentSubscription->getProduct()
//                    ->getSku(),
//                1,
//                true
//            );
//
//            if ($currentSubscription->getPaymentMethod()) {
//                $this->cartService->getCart()
//                    ->setBillingAddress(
//                        $currentSubscription->getPaymentMethod()
//                            ->getBillingAddress()
//                            ->toStructure()
//                    );
//            }
//        }
//
//        if (!UserAccessService::isMember(auth()->id()) && current_user()->getPermissionLevel() != 'administrator') {
//            session()->now(
//                'successes',
//                new MessageBag([
//                    'You do not currently have an active subscription. If you\'d like to subscribe, adding a payment
//                    method will automatically charge you and add access to your account.',
//                ])
//            );
//        }
//
//        if (UserAccessService::isLifetime(user()->id)) {
//            $currentSubscription = null;
//        }
//
//        return view('members.account.settings.payments', [
//            'user' => user(),
//            'existingSubscriptionActive' => $existingSubscriptionActive,
//            'currentSubscription' => $currentSubscription,
//            'sections' => $this->settingSections('payments'),
//            'cards' => [],
//            'paypalUrl' => '',
//            'payments' => $payments,
//            'paymentMethodsJson' => $paymentMethodsJson,
//            'stripePublishableKey' => $stripePublishableKey,
//            'countries' => json_encode(array_values(CountryListService::allWithCommonDuplicatedAtTop())),
//            'provinces' => json_encode(array_keys(config('ecommerce.tax_rates_and_options.canada'))),
//            'cartJson' => json_encode($this->cartService->toArray()),
//        ]);

        return 'WIP.';
    }

    /**
     * @param $section
     * @return array[]
     * @note public so can be used by \Railroad\Crux\Http\Controllers\AccountDetailsController
     */
    public function settingSections($section = 'profile')
    {
        try {
            return [
                [
                    "url" => url()->route('platform.profile.settings.profile', ['userId' => user()->id]),
                    'icon' => 'fas fa-edit',
                    'title' => 'Profile',
                    'active' => $section === 'profile',
                ],
                [
                    "url" => url()->route('platform.profile.settings.login-credentials', ['userId' => user()->id]),
                    'icon' => 'fas fa-lock',
                    'title' => 'Login Credentials',
                    'active' => $section === 'login-credentials',
                ],
                [
                    "url" => url()->route('platform.profile.settings.payments', ['userId' => user()->id]),
                    'icon' => 'far fa-credit-card',
                    'title' => 'Payments',
                    'active' => $section === 'payments',
                ],
                [
                    "url" => url()->route('platform.profile.settings.notifications', ['userId' => user()->id]),
                    'icon' => 'fas fa-bell',
                    'title' => 'Notification Settings',
                    'active' => $section === 'settings',
                ],
                [
                    "url" => url()->route('platform.profile.settings.account', ['userId' => user()->id]),
                    'icon' => 'fas fa-calendar-alt',
                    'title' => 'Account Details',
                    'active' => $section === 'account',
                ],
            ];
        } catch (\Exception $exception) {
            error_log($exception);
            return [];
        }
    }
}
