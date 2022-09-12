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
use Railroad\Ecommerce\Entities\Subscription;
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
    const MINIMUM_SAVINGS_TO_PRESENT_ANNUAL_UPGRADE_OFFER = 10;

    /**
     * @var NotificationSettingsService
     */
    private $notificationSettingsService;
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

    public function account(Request $request, $domain, $brand, $userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        if ($userId != auth()->id()) {
            // todo: redirect to version of this page for auth()->id()
        }

        $userId = auth()->id();
        $ecommerceUser = $this->userProvider->getCurrentUser();

        $now = Carbon::now();
        $hasHadMembership = false;
        $userProductsDigitalAccessTypeSpecific = [];
        $activeAllContentAccessExpiryDate = null;
        $pausedSubscriptionStartDate = null;
        $accessIsFromAppPurchase = false;
        $isLifetime = false;

        $trialUrl = ''; // todo


        // ---------------------------- determine all owned digital non-membership products ----------------------------

        $userProducts = $this->userProductService->getAllUsersProducts($userId);

        foreach ($userProducts as $userProduct) {
            if ($userProduct->getProduct()->getDigitalAccessType() == 'specific content access') {
                $userProductsDigitalAccessTypeSpecific[] = $userProduct;
            }
            $expired = $userProduct->getExpirationDate() ? $userProduct->getExpirationDate()->lt($now) : null;
            $isAllContentAccessProduct = $userProduct->getProduct()->getDigitalAccessType() == 'all content access';
            if ($isAllContentAccessProduct) {
                $paused = $userProduct->getStartDate() && $userProduct->getStartDate()->gt($now);
                if(!$expired) {
                    if ($paused) {
                        $pausedSubscriptionStartDate = $userProduct->getStartDate();
                    } else {
                        $activeAllContentAccessExpiryDate = $userProduct->getExpirationDate();
                    }
                }
                $hasHadMembership = true;
            }
        }


        // --------------------------------------- get the active subscription -----------------------------------------

        $activeSubscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;


        // ---------------------------------- have they had a membership previously? ----------------------------------

        $subscriptions = $this->subscriptionRepository->getSubscriptionsForUsers([$userId]);

        foreach ($subscriptions as $subscription) {
            $isCorrectType = $subscription->getType() == 'subscription';

            $subscriptionProductId = $subscription->getProduct()->getId();
            $productsGrantingAllContentAccessIdsOnly = ProductAccessMap::productsGrantingAllContentAccessIdsOnly();

            if ($isCorrectType && in_array($subscriptionProductId, $productsGrantingAllContentAccessIdsOnly)) {
                $hasHadMembership = true;
                $membershipSubscriptions[] = $subscription;
            }
        }


        // --------------------------------------------- is lifetime member --------------------------------------------

        foreach ($userProducts as $userProduct) {
            if (in_array($userProduct->getProduct()->getId(), [7,8,22,141,412])) {
                $isLifetime = true;
            }
        }


        // --------------------- is their current access remaining from a cancelled subscription? ----------------------

        $noMembershipSubscriptionNowButHadOnePreviously = empty($activeSubscription) && !empty($membershipSubscriptions);

        if ($noMembershipSubscriptionNowButHadOnePreviously && !$isLifetime) {

            foreach ($subscriptions as $subscription) {           // todo: delete
                $paidUntil = $subscription->getPaidUntil();       // todo: delete
                $cancelledOn = $subscription->getCanceledOn();    // todo: delete
                $sku = $subscription->getProduct()->getSku();     // todo: delete
                $cancelledSubs1[] = [                             // todo: delete
                    'subId' => $subscription->getId(),            // todo: delete
                    'paidUntil' => $paidUntil,                    // todo: delete
                    'cancelledOn' => $cancelledOn,                // todo: delete
                    'sku' => $sku,                                // todo: delete
                ];                                                // todo: delete
            }                                                     // todo: delete

            usort($subscriptions, function($x, $y){
                /**
                 * @var $x Subscription
                 * @var $y Subscription
                 */
                if ($x->getPaidUntil() === $y->getPaidUntil()) {
                    $xCancelledOn = $x->getCanceledOn() ?? null;
                    $yCancelledOn = $y->getCanceledOn() ?? null;
                    if ($xCancelledOn === $yCancelledOn) {
                        return 0;
                    }
                    return $xCancelledOn < $yCancelledOn ? -1 : 1;
                }
                return $x->getPaidUntil() < $y->getPaidUntil() ? -1 : 1;
            });

            foreach ($subscriptions as $subscription) {           // todo: delete
                $paidUntil = $subscription->getPaidUntil();       // todo: delete
                $cancelledOn = $subscription->getCanceledOn();    // todo: delete
                $sku = $subscription->getProduct()->getSku();     // todo: delete
                $cancelledSubs2[] = [                             // todo: delete
                    'subId' => $subscription->getId(),            // todo: delete
                    'paidUntil' => $paidUntil,                    // todo: delete
                    'cancelledOn' => $cancelledOn,                // todo: delete
                    'sku' => $sku,                                // todo: delete
                ];
            }

            $mostRecentSubscription = end($subscriptions);
            $mostRecentSubscriptionCancelledOn = $mostRecentSubscription->getCanceledOn() ?? null;
        }

        // ------------------------------------------ access from app purchase -----------------------------------------

        if ($activeSubscription) {

            // if the student's subscription is administered via a mobile app, we don't offer the same controls and
            // instead direct them to the Apple's or Google's pages on the matter.
            if (
                $activeSubscription->getType() == 'apple_subscription' ||
                $activeSubscription->getType() == 'google_subscription'
            ) {
                $accessIsFromAppPurchase = true;
            }

            // if the student is an active monthly subscriber we present an offer to upgrade to an annual membership
            if ($activeSubscription->getType() == 'subscription') {
                if ($activeSubscription->getIntervalType() == 'month') {

                    if ($activeSubscription->getIntervalCount() == 1) {
                        $multiplyFactor = 12;
                    } elseif ($activeSubscription->getIntervalCount() == 3) {
                        $multiplyFactor = 4;
                    } elseif ($activeSubscription->getIntervalCount() == 6) {
                        $multiplyFactor = 2;
                    }

                    if ($multiplyFactor ?? false) {
                        $offerUpgradeToAnnualPrice = ProductAccessMap::annualSubscriptionPrice();
                        $currentMonthlySubPricePerYear = $activeSubscription->getTotalPrice() * $multiplyFactor;
                        $savingsFactor = 1 - ($offerUpgradeToAnnualPrice / $currentMonthlySubPricePerYear);
                        $savingsPercentageRaw = $savingsFactor * 100;

                        if ($savingsPercentageRaw > self::MINIMUM_SAVINGS_TO_PRESENT_ANNUAL_UPGRADE_OFFER) {
                            $offerUpgradeToAnnualShowToStudent = true;
                            $offerUpgradeToAnnualPercentSaved = round($savingsPercentageRaw);
                        }
                    }

                }
            }
        }

        // -------------------------------------------------------------------------------------------------------------

        return view('account.settings.account',
            [
                'user' => user(),
                'sections' => $this->settingSections('account'),
                'userProductsDigitalAccessTypeSpecific' => $userProductsDigitalAccessTypeSpecific,
                'activeAllContentAccessExpiryDate' => $activeAllContentAccessExpiryDate,
                'isLifetime' => $isLifetime,
                'pausedSubscriptionStartDate' => $pausedSubscriptionStartDate,
                'accessIsFromAppPurchase' => $accessIsFromAppPurchase,
                'subscription' => $activeSubscription,
                'hasHadMembership' => $hasHadMembership,
                'now' => $now,
                'trialUrl' => $trialUrl,
                'mostRecentSubscriptionCancelledOn' => $mostRecentSubscriptionCancelledOn ?? null,
                'offerUpgradeToAnnualShowToStudent' => $offerUpgradeToAnnualShowToStudent ?? false,
                'offerUpgradeToAnnualPercentSaved' => $offerUpgradeToAnnualPercentSaved ?? null,
            ]
        );
    }

    /**
     * @return void
     * POST
     */
    public function acceptAnnualOffer()
    {
        $foo = 'bar';
    }

    /**
     * @return void
     * POST
     */
    public function resumePaused()
    {
        $foo = 'bar';
    }

    /**
     * @return void
     * GET
     */
    public function cancelReasonForm($domain, $brand)
    {
        $foo = 'bar';

        return view('account.settings.cancel', ['brand' => $brand, 'domain' => $domain, 'userId' => user()->id]);
    }

    /**
     * @return void
     * POST
     */
    public function submitCancelReason(Request $request)
    {
        $reason = $request->get('reason');
        $textReason = $request->get('other-reason-text');

        // get current subscription
        $ecommerceUser = $this->userProvider->getCurrentUser();
        $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

        // determine if the subscription is a trial
        $trialMembershipProductIds = ProductAccessMap::trialMembershipProductIds();
        $isTrial = in_array($subscription->getProduct()->getId(), $trialMembershipProductIds);

        /*
         * previous version here stored cancellation-reason and cancellation-reason-text in session, but I don't
         * understand why, so I am leaving it out for now
         */

        // store in session (reason and reason-text)
        session()->put('cancel-reason', $reason);
        session()->put('cancel-reason-text', $textReason);

        // check if they've claimed the retention(win-back) offer recently
        if (ProductAccessMap::hasClaimedRetentionOfferWithin(user()) || $isTrial) {
            return $this->cancel($request);
        }

        // check if they've claimed the retention(win-back) offer recently

        // get reasons map from config

        // create list of reasons that qualify for criteria

        // see if reason is in list

        // send to final offer screen depending on use case


    }

    /**
     * @return void
     * GET
     */
    public function winBack(Request $request)
    {
        dd($request);

        return view('account.settings.win-back', []);
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
                    "url" => url()->route('platform.profile.settings.account'),
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
