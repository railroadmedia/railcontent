<?php

namespace App\Http\Controllers\Platform;

use App;
use App\Http\Controllers\BaseController;
use App\Modules\Crux\ProductAccessMap;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\MembershipAction;
use Railroad\Ecommerce\Entities\Payment;
use App\Modules\Ecommerce\Models\Product as ProductModel;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Entities\Traits\NotableEntity;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionUpdated;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
use Railroad\Ecommerce\Exceptions\Cart\ProductNotActiveException;
use Railroad\Ecommerce\Exceptions\Cart\ProductNotFoundException;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\MembershipActionRepository;
use Railroad\Ecommerce\Repositories\PaymentMethodRepository;
use Railroad\Ecommerce\Repositories\PaymentRepository;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\InvoiceService;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Ecommerce\Transformers\SubscriptionTransformer;
use Railroad\Location\Services\CountryListService;
use Railroad\Mailora\Mail\General;
use Railroad\Railforums\Repositories\UserSignaturesRepository;
use Railroad\Railnotifications\Services\NotificationSettingsService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ProfileSettingsPagesController extends BaseController
{
    const MINIMUM_SAVINGS_TO_PRESENT_ANNUAL_UPGRADE_OFFER = 10;

    const HOW_CAN_WE_HELP_OPTIONS = [
        'direction' => 'I need more direction',
        'time' => 'I don’t have enough time',
        'watch' => 'I don’t know what lesson to watch',
        'easy' => 'The lessons are too easy',
        'difficult' => 'The lessons are too difficult',
        'website' => 'I don’t know how to use the website/app.',
        'other' => 'Other',
    ];

    const TRIAL_MEMBERSHIP_PRODUCT_IDS = [
        126, // Drumeo
        283,
        400,
        401,
        266,
        273,
        318, // Pianote
        319,
        403,
        402,
        23, // Guitareo
        429,
        430,
        431,
        413, // Singeo
        414,
        423,
        424,
    ];

    const SWITCH_TO_MONTHLY_PRICE = 19;

    public static $generalSuccessMessageToUser = 'Your account has been updated.';

    public static $generalErrorMessageToUser = 'We\'re sorry, but there\'s been an error. Please reload the page and try ' .
    'again. If that doesn\'t work email or use the chat at the bottom right of your screen to get things sorted out ' .
    'right away.';

    private NotificationSettingsService $notificationSettingsService;
    private UserSignaturesRepository $userSignaturesRepository;
    private UserProductService $userProductService;
    private SubscriptionRepository $subscriptionRepository;
    private UserProviderInterface $userProvider;
    private CartService $cartService;
    private PaymentRepository $paymentRepository;
    private SubscriptionTransformer $subscriptionTransformer;
    private InvoiceService $invoiceService;
    private PaymentMethodRepository $paymentMethodRepository;
    private EcommerceEntityManager $ecommerceEntityManager;
    private MembershipActionRepository $membershipActionRepository;
    private CustomerIoService $customerIoService;
    private ProductRepository $productRepository;

    /**
     * @param NotificationSettingsService $notificationSettingsService
     */
    public function __construct(
        NotificationSettingsService $notificationSettingsService,
        UserSignaturesRepository $userSignaturesRepository,
        UserProductService $userProductService,
        SubscriptionRepository $subscriptionRepository,
        UserProviderInterface $userProvider,
        CartService $cartService,
        PaymentRepository $paymentRepository,
        SubscriptionTransformer $subscriptionTransformer,
        InvoiceService $invoiceService,
        PaymentMethodRepository $paymentMethodRepository,
        EcommerceEntityManager $ecommerceEntityManager,
        MembershipActionRepository $membershipActionRepository,
        CustomerIoService $customerIoService,
        ProductRepository $productRepository
    ) {
        $this->notificationSettingsService = $notificationSettingsService;
        $this->userSignaturesRepository = $userSignaturesRepository;
        $this->userProductService = $userProductService;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProvider = $userProvider;
        $this->cartService = $cartService;
        $this->paymentRepository = $paymentRepository;
        $this->subscriptionTransformer = $subscriptionTransformer;
        $this->invoiceService = $invoiceService;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->ecommerceEntityManager = $ecommerceEntityManager;
        $this->membershipActionRepository = $membershipActionRepository;
        $this->customerIoService = $customerIoService;
        $this->productRepository = $productRepository;
    }

    // ------------------------------------------ "top-level" public methods -------------------------------------------

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $userId
     * @return Application|Factory|View
     */
    public function profile(Request $request, $domain, $brand, $userId)
    {
        $userSignature = $this->userSignaturesRepository->getUserSignature();
        return view('account.settings.profile', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('profile'),
        ]);
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $userId
     * @return Application|Factory|View
     */
    public function loginCredentials(Request $request, $domain, $brand, $userId)
    {
        $userSignature = $this->userSignaturesRepository->getUserSignature();

        return view('account.settings.login-credentials', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('login-credentials'),
        ]);
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $userId
     * @return Application|Factory|View
     * @throws NonUniqueResultException
     */
    public function notifications(Request $request, $domain, $brand, $userId)
    {
        $userSignature = [];

        return view('account.settings.settings', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('settings'),
            'userNotificationsSettings' => $this->notificationSettingsService->getUserNotificationSettings(
                user()->id,
                null,
                $request->get('selected-brand', $brand)
            ),
            'allBrands' => all_brands(),
            'selectedBrand' => $request->get('selected-brand', $brand)
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws Throwable
     * @throws ProductNotActiveException
     * @throws ProductNotFoundException
     */
    public function payments(Request $request)
    {
        $user = user();

        $paymentMethods = $this->paymentMethodRepository->getAllUsersPaymentMethods(
            $user->id,
            $request,
            brand()
        );

        $paymentMethodsJson = ResponseService::paymentMethod(
            $paymentMethods
        )
            ->respond()
            ->getContent();

        $stripePublishableKey = config('ecommerce.payment_gateways.stripe.' . brand() . '.stripe_publishable_key');

        $membershipProductIds = ProductModel::query()
            ->where([
                'type' => 'digital subscription',
                'digital_access_type' => 'all content access',
                'digital_access_time_type' => 'recurring'
            ])
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $currentSubscription = $this->subscriptionRepository->getUserSubscriptionForProducts(
            $user->id,
            $membershipProductIds
        );

        $existingSubscriptionActive = false;

        if (!empty($currentSubscription) && $currentSubscription->getIsActive()) {
            $existingSubscriptionActive = true;
        }

        if (!empty($currentSubscription) && !empty($currentSubscription->getProduct())) {
            $this->cartService->refreshCart();

            $this->cartService->clearCart();

            $this->cartService->addToCart(
                $currentSubscription->getProduct()
                    ->getSku(),
                1,
                true
            );

            try {
                if (!empty($currentSubscription->getPaymentMethod()) && !empty(
                    $currentSubscription->getPaymentMethod()
                        ->getBillingAddress()
                    )) {
                    $this->cartService->getCart()
                        ->setBillingAddress(
                            $currentSubscription->getPaymentMethod()
                                ->getBillingAddress()
                                ->toStructure()
                        );
                }
            } catch (Throwable $throwable) {
            }

            // if current sub price less than product standard price, set "override to display" price

            $subProductDefaultPrice = $currentSubscription->getProduct()->getPrice();
            $subCurrentPrice = $currentSubscription->getTotalPrice(); // same as $subTransformed['total_price'] below

            if ($subProductDefaultPrice !== $subCurrentPrice) {
                $subTransformed = $this->subscriptionTransformer->transform($currentSubscription);

                foreach ($this->cartService->getCart()->getItems() as $cartItem) {
                    $cartItem->setDueOverride($subTransformed['total_price']);
                }
            }
        }

        $payments = $this->paymentRepository->getAllUsersPayments($user->id, false, 'drumeo');

        // sort by date
        usort(
            $payments,
            function (Payment $a, Payment $b) {
                return $a->getCreatedAt() < $b->getCreatedAt();
            }
        );

        if ($user->is_lifetime_member) {
            $currentSubscription = null;
        }

        return view(
            'account.settings.payments',
            [
                'sections' => $this->settingSections('payments'),
                'paymentMethodsJson' => $paymentMethodsJson,
                'stripePublishableKey' => $stripePublishableKey,
                'countries' => json_encode(array_values(CountryListService::allWithCommonDuplicatedAtTop())),
                'provinces' => json_encode(array_keys(config('ecommerce.tax_rates_and_options.canada'))),
                'cartJson' => json_encode($this->cartService->toArray()),
                'currentSubscription' => $currentSubscription,
                'existingSubscriptionActive' => $existingSubscriptionActive,
                'currentUser' => $user,
                'payments' => $payments,
                'displayOverrideTax' => $displayOverrideTax ?? false,
                // todo: remove from here and vuesora because now obsolete
                'displayOverridePrice' => $displayOverridePrice ?? false,
                // todo: remove from here and vuesora because now obsolete
            ]
        );
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $userId
     * @param $paymentId
     * @return Factory|View|Application
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function showInvoiceForPayment(Request $request, $domain, $brand, $userId, $paymentId)
    {
        $payment = $this->paymentRepository->find($paymentId);

        $order = $payment->getOrder();
        $subscription = $payment->getSubscription();
        $paymentMethod = $payment->getPaymentMethod();

        if (!empty($subscription) && !empty(
            config(
                'ecommerce.invoice_email_details.' .
                $payment->getGatewayName() .
                '.subscription_renewal_invoice.invoice_view'
            )
            ) && $subscription->getType() != Subscription::TYPE_PAYMENT_PLAN) {
            $viewData = $this->invoiceService->getViewDataForSubscriptionRenewalInvoice($subscription, $payment);

            return view(
                config(
                    'ecommerce.invoice_email_details.' .
                    $payment->getGatewayName() .
                    '.subscription_renewal_invoice.invoice_view'
                ),
                $viewData
            );
        }

        if (!empty($order) && !empty(
            config(
                'ecommerce.invoice_email_details.' . $payment->getGatewayName() . '.order_invoice.invoice_view'
            )
            )) {
            $viewData = $this->invoiceService->getViewDataForOrderInvoice($order, $payment);

            return view(
                config('ecommerce.invoice_email_details.' . $payment->getGatewayName() . '.order_invoice.invoice_view'),
                $viewData
            );
        }

        throw new NotFoundHttpException();
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @return Application|Factory|View
     * @throws ORMException
     */
    public function account(Request $request, $domain, $brand)
    {
        $userId = auth()->id();
        $ecommerceUser = $this->userProvider->getCurrentUser();

        $now = Carbon::now();
        $accessIsFromAppPurchase = false;
        $isLifetime = false;

        // ---------------------------- determine all owned digital non-membership products ----------------------------

        $subscriptionInfo = $this->subscriptionInfo(user()->getId());

        $userProductsDigitalAccessTypeSpecific = $subscriptionInfo['userProductsDigitalAccessTypeSpecific'];
        $pausedSubscriptionStartDate = $subscriptionInfo['pausedSubscriptionStartDate'];
        $activeAllContentAccessExpiryDate = $subscriptionInfo['activeAllContentAccessExpiryDate'];
        $hasHadMembership = $subscriptionInfo['hasHadMembership'];
        $userProducts = $subscriptionInfo['userProducts'];

        // --------------------------------------- get the active subscription -----------------------------------------

        $activeSubscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

        if (!$activeSubscription) {
            if ($activeAllContentAccessExpiryDate > Carbon::now()) {
                $membershipWithoutSubscription = true;
            }
        } elseif ($activeSubscription->getType() == 'payment plan') {
            // this shouldn't happen, but when it does at least with this here it won't break things.
            //  todo: abstract this reduce to redundancy as this is duplicated elsewhere in this class
            $activeSubscriptions = [];
            $subscriptionsForUser = $this->subscriptionRepository->getSubscriptionsForUsers([$ecommerceUser->getId()]);
            foreach ($subscriptionsForUser as $sub) {
                if ($sub->getIsActive()) {
                    $activeSubscriptions[] = $sub;
                }
            }
            if (count($activeSubscriptions) === 1) {
                $activeSubscription = reset($activeSubscriptions);
                error_log(
                    'subscriptionRepository->getUserActiveSubscription returned a payment plan rather than a ' .
                    'subscription for user ' . user()->getId() . '. However all was okay because subscriptionReposit' .
                    'ory->getSubscriptionsForUsers() returned a sufficient substitute.'
                );
            } else {
                error_log(
                    'subscriptionRepository->getUserActiveSubscription returned a payment plan rather than a ' .
                    'subscription for user ' . user()->getId() . '. A hacky fix that calls subscriptionRepository->g' .
                    'etSubscriptionsForUsers() did not work though because instead of one result it returned ' .
                    count($activeSubscriptions) . '.'
                );
                $this->returnRedirect(
                    false,
                    'We\'re sorry, but there\'s been a system error on our end. Please contact Support to expedite ' .
                    'a solution. (Error code: 4d6c64)'
                );
            }
        }

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
            if (in_array($userProduct->getProduct()->getId(), [7, 8, 22, 141, 412])) {
                $isLifetime = true;
            }
        }


        // --------------------- is their current access remaining from a cancelled subscription? ----------------------

        $noMembershipSubscriptionNowButHadOnePreviously = empty($activeSubscription) && !empty($membershipSubscriptions);

        if ($noMembershipSubscriptionNowButHadOnePreviously && !$isLifetime) {
            usort($subscriptions, function ($x, $y) {
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
                    } elseif ($activeSubscription->getIntervalCount() == 2) {
                        $multiplyFactor = 6;
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

        $urlParamsByBrandForTrial = [
            'drumeo' => 'products[DLM-Trial]=1,month,1&locked=true',
            'pianote' => 'products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=%2Forder&locked=true',
            'guitareo' => 'products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=%2Forder&locked=true',
            'singeo' => 'products[singeo-monthly-recurring-7-day-trial-membership]=1&redirect=%2Forder&locked=true',
        ];

        if ($urlParamsByBrandForTrial[$brand]) {
            $urlParams = $urlParamsByBrandForTrial[$brand];
            $addToCartUrlTrial = 'https://' . $brand . '.com/ecommerce/add-to-cart?' . $urlParams;
            if ($brand == 'drumeo') {
                $addToCartUrlTrial = 'https://drumeo.com/laravel/public/shopping-cart/api/query?' . $urlParams;
            }
        } else {
            $addToCartUrlTrial = 'https://musora.com/';
        }

        $salesPage['drumeo'] = 'https://www.drumeo.com/';
        $salesPage['pianote'] = 'https://www.pianote.com/';
        $salesPage['guitareo'] = 'https://www.guitareo.com/';
        $salesPage['singeo'] = 'https://www.singeo.com/';
        $salesPageUrl = $salesPage[$brand] ?? $salesPage['drumeo'];

        // -------------------------------------------------------------------------------------------------------------

        return view(
            'account.settings.account',
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
                'addToCartUrlTrial' => $addToCartUrlTrial,
                'salesPageUrl' => $salesPageUrl,
                'mostRecentSubscriptionCancelledOn' => $mostRecentSubscriptionCancelledOn ?? null,
                'offerUpgradeToAnnualShowToStudent' => $offerUpgradeToAnnualShowToStudent ?? false,
                'offerUpgradeToAnnualPercentSaved' => $offerUpgradeToAnnualPercentSaved ?? null,
                'membershipWithoutSubscription' => $membershipWithoutSubscription ?? false,
            ]
        );
    }

    // -------------------------- private method used by each "top-level" public method above --------------------------

    /**
     * @param string $section
     * @return array|array[]
     */
    private function settingSections(string $section = 'profile')
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
        } catch (Exception $exception) {
            error_log($exception);
            return [];
        }
    }

    // ----------------------------------- public methods supporting cancellation-ui -----------------------------------

    /**
     * @param $domain
     * @param $brand
     * @return Application|Factory|View
     */
    public function cancelReasonForm($domain, $brand)
    {
        return view('account.settings.cancel', ['brand' => $brand, 'domain' => $domain, 'userId' => user()->id]);
    }

    /**
     * @return RedirectResponse
     * @throws ORMException
     * @throws Throwable
     */
    public function resumePaused()
    {
        // determine if paused

        $subscriptionInfo = $this->subscriptionInfo(user()->getId());

        $pausedSubscriptionStartDate = $subscriptionInfo['pausedSubscriptionStartDate'];
        $allContentAccessProduct = $subscriptionInfo['allContentAccessProduct'];

        // if not pause return to account-details (use returnRedirect(false)) method

        if (!$pausedSubscriptionStartDate || !$allContentAccessProduct) {
            return $this->returnRedirect(false);
        }

        try {
            // get the relevant membership-action

            // note that by default the results we're searching through are ordered by created_at desc thus we're
            // getting the most recent of type MembershipAction::ACTION_PAUSE_FOR_AMOUNT_OF_DAYS

            $membershipActions = $this->membershipActionRepository->getAllUsersMembershipActions(user()->getId());

            $action = false;

            foreach ($membershipActions as $actionCandidate) {
                if ($actionCandidate->getAction() == MembershipAction::ACTION_PAUSE_FOR_AMOUNT_OF_DAYS) {
                    $action = $actionCandidate;
                    break;
                }
            }

            if (!$action) {
                throw new Exception ('No MembershipAction of required type found for user ' . user()->getId());
            }

            // get the subscription and user-product

            $subscription = $action->getSubscription();
            $subscriptionBeforeChanges = clone($subscription);

            $userProduct = $allContentAccessProduct;
            $oldUserProduct = clone($userProduct);

            // if not pause return to account-details (use returnRedirect(false)) method

            // check that product from subscription from action is same product as membershipUserProduct
            if ($subscription->getProduct()->getId() != $userProduct->getProduct()->getId()) {
                throw new Exception (
                    'Product in paused subscription does not match membershipUserProduct (user ' . user()->getId() . ')'
                );
            }

            // calculate the length of time between start date and paid_until date

            $dateStart = Carbon::parse($userProduct->getStartDate());
            $datePaidUntil = Carbon::parse($subscription->getPaidUntil());

            if (Carbon::now()->gt($dateStart)) {
                throw new Exception(
                    'startDate for paused userProduct (' . $userProduct->getId() .
                    ')is in past but resume was called on it. This should not be possible.'
                );
            }

            $hoursToAdd = $dateStart->diffInHours($datePaidUntil) + 1; // adding an extra hour as a kind of rounding-up

            // update subscription and user-product


            $dateNewPaidUntil = Carbon::now()->addHours($hoursToAdd);
            $subscription->setPaidUntil($dateNewPaidUntil);

            $this->ecommerceEntityManager->persist($subscription);
            $this->ecommerceEntityManager->flush();

            event(new SubscriptionUpdated($subscriptionBeforeChanges, $subscription));
            $this->userProductService->updateSubscriptionProducts($subscription);

            $userProduct->setStartDate(null);

            $this->ecommerceEntityManager->persist($userProduct);
            $this->ecommerceEntityManager->flush();

            event(new UserProductUpdated($userProduct, $oldUserProduct));

            // create a MembershipAction
            $membershipAction = new MembershipAction();
            /** @var $membershipAction MembershipAction|NotableEntity */
            $membershipAction->setUser(new User(user()->getId(), user()->getEmail()));
            $membershipAction->setBrand(config('ecommerce.brand'));
            $membershipAction->setAction(MembershipAction::ACTION_RESUME_PAUSED_MEMBERSHIP);
            $membershipAction->setActionReason('user action on access-details page');
            $membershipAction->setSubscription($subscription);
            $this->ecommerceEntityManager->persist($membershipAction);
            $this->ecommerceEntityManager->flush();
        } catch (Exception $exception) {
            error_log($exception);
            return $this->returnRedirect(false);
        }

        return $this->returnRedirect(
            true,
            'You should now have full access again. If you have any issues please let us know right away so we ' .
            'can help you get back to playing!'
        );
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function submitCancelReason(Request $request)
    {
        $cancelReasonKey = $request->get('reason');
        $additionalFeedback = $request->get('additional-feedback');

        // get current subscription
        $ecommerceUser = $this->userProvider->getCurrentUser();
        $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

        if (!$subscription) {
            return $this->returnRedirect(false);
        }

        // determine if the subscription is a trial
        $isTrial = false;
        if ($subscription->getProduct()) {
            $isTrial = in_array($subscription->getProduct()->getId(), self::TRIAL_MEMBERSHIP_PRODUCT_IDS);
        } else {
            error_log(
                'User ' . user()->id . ' has a subscription (id ' . $subscription->getId() .
                ') without an attached product (in \App\Http\Controllers\Platform\ProfileSettingsPagesController::su' .
                ' bmitCancelReason).'
            );
        }

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * store in session because we don't yet need it. We'll present the student with an offer, and if they     *
         * accept that offer then we don't need the cancellation-reason anymore (I least I don't think we're doing *
         * anything with it, though maybe we should anyway). If they do cancel, then we'll take that               *
         * stored-in-the-session cancellation-reason and use that when writing the cancellation to the DB.         *
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
        session()->put('cancel-reason-key', $cancelReasonKey);
        session()->put('additional-feedback', $additionalFeedback);

        // TEMPORARY version that immediately cancels instead of offering a retention offer.
        //return $this->cancel($request);
        // TEMPORARY version that immediately cancels instead of offering a retention offer.


        // if they claimed retention(win-back) offer recently don't offer it again, instead go right to cancelling
        if (ProductAccessMap::hasClaimedRetentionOfferWithin(user()) || $isTrial) {
            return $this->cancel($request);
        }

        if ($subscription->getIntervalType() === 'month') {
            if ($subscription->getIntervalCount() == 1) {
                $subscriptionPrice = $subscription->getTotalPrice();
                $amountSaved = $subscriptionPrice * 2;
                $nextPaymentDateWithOffer = Carbon::parse($subscription->getPaidUntil())->addMonths(2);

                return view('account.settings.offer-monthly', [
                    'subscriptionPrice' => $subscriptionPrice,
                    'amountSaved' => $amountSaved,
                    'nextPaymentDateWithOffer' => $nextPaymentDateWithOffer,
                ]);
            } else {
                /*
                 * bimonthly, triannual and biannual (interval counts 2, 3, and 6 respectively) are very rare. Thus we
                 * haven't (yet) built handling for how the offers would have to be modified. So just go straight to
                 * cancellation.
                 */
                return $this->cancel($request);
            }
        }

        if ($subscription->getIntervalType() == 'year') {
            $pointBeforeWhichWeConsiderRenewingSoon = Carbon::now()->addMonths(3);
            $renewingSoon = $subscription->getPaidUntil() <= $pointBeforeWhichWeConsiderRenewingSoon;

            $subscriptionExpiryDate = $subscription->getPaidUntil();

            if ($renewingSoon) {
                return view('account.settings.offer-annual-renewing-soon', [
                    'switchToMonthlyPrice' => self::SWITCH_TO_MONTHLY_PRICE,
                    'subscriptionExpiryDate' => $subscriptionExpiryDate,
                    'subscriptionPrice' => $subscription->getTotalPrice(),
                    //'amountSaved' => $subscription->getTotalPrice() * 2,
                    //'nextPaymentDateWithOffer' => $nextPaymentDateWithOffer,,
                ]);
            } else {
                return view('account.settings.offer-annual', [
                    'switchToMonthlyPrice' => self::SWITCH_TO_MONTHLY_PRICE,
                    'subscriptionExpiryDate' => $subscriptionExpiryDate,
                    //'subscriptionPrice' => $subscription->getTotalPrice(),
                    //'amountSaved' => $subscription->getTotalPrice() * 2,
                    //'nextPaymentDateWithOffer' => $nextPaymentDateWithOffer,
                ]);
            }
        }

        error_log(
            'submitCancelReason was called but none of the possible cases matched (isSubscriberMonthly, isSubscriberAnnual, isSubscriberAnnualRenewingSoon)'
        );

        return $this->returnRedirect(false);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function acceptPauseOffer(Request $request)
    {
        $pauseLengthDays = (int)$request->get('pause-length');

        if ($pauseLengthDays < 30 || $pauseLengthDays > 90) {
            error_log(
                '\App\Http\Controllers\Platform\ProfileSettingsPagesController::acceptPauseOffer ' .
                'called with "$pauseLengthDays" value of ' . $pauseLengthDays
            );
            return $this->returnRedirect(false);
        }

        $ecommerceUser = $this->userProvider->getCurrentUser();

        try {
            $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

            if (!$subscription) {
                return $this->returnRedirect(
                    false,
                    'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                    'contact our support team.'
                );
            }
        } catch (Exception $e) {
            return $this->returnRedirect(
                false,
                'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                'contact our support team.'
            );
        }

        $oldSubscription = clone $subscription;

        $subscription->setPaidUntil($subscription->getPaidUntil()->copy()->addDays($pauseLengthDays));

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        try {
            $this->ecommerceEntityManager->persist($subscription);
            $this->ecommerceEntityManager->flush();
        } catch (ORMException $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        // update the user product start date which restricts access until that date
        try {
            $userProduct = $this->userProductService->getUserProduct(
                new User(user()->getId(), user()->getEmail()),
                $subscription->getProduct()
            );
        } catch (Throwable $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        $oldUserProduct = clone $userProduct;

        $userProduct->setStartDate(Carbon::now()->addDays($pauseLengthDays));
        $userProduct->setExpirationDate(
            $subscription->getPaidUntil()->addDays(
                config('ecommerce.days_before_access_revoked_after_expiry', 3)
            )
        );

        try {
            $this->ecommerceEntityManager->persist($userProduct);
            $this->ecommerceEntityManager->flush();
        } catch (ORMException $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        event(new UserProductUpdated($userProduct, $oldUserProduct));
        event(new SubscriptionUpdated($oldSubscription, $subscription));

        // save membership action
        /** @var $membershipAction MembershipAction|NotableEntity */
        $membershipAction = new MembershipAction();
        $membershipAction->setUser(new User(user()->getId(), user()->getEmail()));
        $membershipAction->setBrand(config('ecommerce.brand'));
        $membershipAction->setAction(MembershipAction::ACTION_PAUSE_FOR_AMOUNT_OF_DAYS);
        $membershipAction->setActionAmount($pauseLengthDays);
        $membershipAction->setSubscription($subscription);
        $membershipAction->setNote('membership was paused for ' . $pauseLengthDays . ' days');

        try {
            $this->ecommerceEntityManager->persist($membershipAction);
            $this->ecommerceEntityManager->flush();
        } catch (ORMException $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        return $this->returnRedirect(
            true,
            'Your membership has been paused for ' .
            $pauseLengthDays .
            ' days. Your access will automatically return on ' .
            $userProduct->getStartDate()->format('F jS, Y') . '.'
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function acceptStudentPlanOffer(Request $request)
    {
        try {
            $this->customerIoService->createOrUpdateCustomerByUserId(
                user()->getId(),
                'musora',
                user()->getEmail(),
                ['musora_retention_student_plan' => 'true'],
                user()->created_at->timestamp
            );
        } catch (Exception|Throwable $exception) {
            error_log($exception);

            return $this->returnRedirect(false);
        }

        return $this->returnRedirect(true, 'An instructor be in touch soon!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function acceptSwitchToMonthly(Request $request)
    {
        // get subscription
        $ecommerceUser = $this->userProvider->getCurrentUser();

        try {
            $oldSubscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

            if (!$oldSubscription) {
                return $this->returnRedirect(
                    false,
                    'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                    'contact our support team.'
                );
            }
        } catch (Exception $e) {
            return $this->returnRedirect(
                false,
                'Whoops, something went wrong when we tried to update your membership. Please try again or ' .
                'contact our support team.'
            );
        }

        $cyclesStillDue = false;
        $cyclesDue = $oldSubscription->getTotalCyclesDue();
        if (!is_null($cyclesDue)) {
            $cyclesPaid = $oldSubscription->getTotalCyclesPaid();
            $dueLessThanPaid = $cyclesDue < $cyclesPaid;
            if ($dueLessThanPaid) {
                error_log(
                    'switch-to-monthly retention offer presented to (and accepted by) student with more ' .
                    'cycles due on subscription than paid'
                );
                return $this->returnRedirect(false);
            }
        }

        try {
            $brand = $oldSubscription->getBrand();
            $newSubscription = new Subscription();
            $map = [
                'pianote' => 5,   # sku: 'PIANOTE-MEMBERSHIP-1-MONTH',          name: 'Pianote Membership - Monthly'
                'drumeo' => 124,  # sku: 'DLM-1-month',                         name: 'Drumeo Membership - Monthly'
                'guitareo' => 17, # sku: 'GUITAREO-1-MONTH-MEMBERSHIP',         name: 'Guitareo Monthly Membership'
                'singeo' => 409,  # sku: 'singeo-monthly-recurring-membership', name: 'Singeo Membership - Monthly'
            ];

            $oldSubscription->setCanceledOn(Carbon::now());
            $oldSubscription->setIsActive(false);
            $oldSubscription->setCancellationReason(
                'changed to monthly subscription as retention-offer during cancellation'
            );

            $this->ecommerceEntityManager->persist($oldSubscription);

            $idOfProductToUse = $map[$brand];
            $productForNew = $this->productRepository->find($idOfProductToUse);

            $newSubscription->setProduct($productForNew);
            $newSubscription->setBrand($brand);
            $newSubscription->setType($oldSubscription->getType());
            $newSubscription->setIsActive(true);
            $newSubscription->setStopped(false);
            $newSubscription->setStartDate(Carbon::now());
            $newSubscription->setPaidUntil($oldSubscription->getPaidUntil());
            $newSubscription->setPaidUntil($oldSubscription->getPaidUntil());
            $newSubscription->setCanceledOn(null);
            $newSubscription->setCurrency($oldSubscription->getCurrency());
            $newSubscription->setIntervalType('month');
            $newSubscription->setIntervalCount(1);

            $newSubscription->setTotalCyclesDue(null);
            $newSubscription->setTotalCyclesPaid(0);
            $newSubscription->setRenewalAttempt(0);
            $newSubscription->setPaymentMethod($oldSubscription->getPaymentMethod());
            $newSubscription->setUser($oldSubscription->getUser());
            $newSubscription->setCustomer($oldSubscription->getCustomer());

            $newPrice = self::SWITCH_TO_MONTHLY_PRICE;

            $order = $oldSubscription->getOrder();

            if (!$order) {
                // this may be because previous subscription was replaced but the order_id wasn't copied from there to
                // what was then the new one. One clue to this is that the user will have a cancelled subscription and
                // the cancellation-reason will be "replaced with new subscription while accepting retention offer"

                $subscriptionsForUsers = $this->subscriptionRepository->getSubscriptionsForUsers([user()->id]);

                foreach ($subscriptionsForUsers as $sub) {
                    $notActive = !$sub->getIsActive();
                    $hasCancelledOnDate = !empty($sub->getCanceledOn());
                    $reasonMatch = $sub->getCancellationReason() ===
                        'replaced with new subscription while accepting retention offer';

                    if ($notActive && $hasCancelledOnDate && $reasonMatch) {
                        $order = $sub->getOrder();
                    }
                }
            }

            if ($order) {
                $orderTaxesDue = $order->getTaxesDue();
                if ($orderTaxesDue > 0) {
                    $orderTotalDue = $order->getTotalDue();
                    $orderProductDue = $orderTotalDue - $orderTaxesDue;
                    $orderTaxFactor = $orderTaxesDue / $orderProductDue;

                    // USE JUST ONE OF THE TWO BELOW:
                    // --------- OPTION 1 ---------
//                $newSubscriptionTaxAmount = $orderTaxFactor * $newPrice;
//                $newSubscription->setTax($newSubscriptionTaxAmount);
//                $newPrice = $newPrice + $newSubscriptionTaxAmount;
                    // --------- OPTION 2 ---------
                    $newPrice = $newPrice * ($orderTaxFactor + 1);
                }
            } else {
                error_log(
                    'user ' . user()->id . ' processed in \App\Http\Controllers\Platform\ProfileSettingsPagesC' .
                    'ontroller::acceptSwitchToMonthly but did not have order attached to replaced subscription (id ' .
                    $oldSubscription->getId() . ')'
                );
            }

            $newSubscription->setTotalPrice($newPrice);

            $this->ecommerceEntityManager->persist($newSubscription);

            $this->userProductService->updateSubscriptionProducts($oldSubscription);
            $this->userProductService->updateSubscriptionProducts($newSubscription);

            event(new SubscriptionUpdated($oldSubscription, $oldSubscription));

            $membershipAction = new MembershipAction();
            /** @var $membershipAction MembershipAction|NotableEntity */
            $membershipAction->setUser($ecommerceUser);
            $membershipAction->setBrand($newSubscription->getProduct()->getBrand());
            $membershipAction->setSubscription($newSubscription);
            $membershipAction->setAction(MembershipAction::ACTION_SWITCH_BILLING_INTERVAL_TO_MONTHLY);
            $membershipAction->setActionAmount(null);
            $membershipAction->setNote('');

            $this->ecommerceEntityManager->persist($membershipAction);

            $this->ecommerceEntityManager->flush();
        } catch (Exception $e) {
            return $this->returnRedirect(
                false,
                'Whoops, something went wrong when we tried to update your membership. Please try again or ' .
                'contact our support team.'
            );
        }

        return $this->returnRedirect(
            true,
            'Your membership has been switched to a monthly membership. Your next payment is will be ' .
            $newSubscription->getPaidUntil()->format('F j, Y') . '.'
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function acceptGratisAccess(Request $request)
    {
        $ecommerceUser = $this->userProvider->getCurrentUser();

        try {
            $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

            if (!$subscription) {
                return $this->returnRedirect(
                    false,
                    'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                    'contact our support team.'
                );
            }

            $this->updateSubscriptionPaidUntilDate($subscription, 'addMonths', 2);
        } catch (Exception $e) {
            return $this->returnRedirect(
                false,
                'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                'contact our support team.'
            );
        }

        $oldSubscription = clone $subscription;
        event(new SubscriptionUpdated($oldSubscription, $subscription));

        // save membership action
        $membershipAction = new MembershipAction();
        /** @var $membershipAction MembershipAction|NotableEntity */
        $membershipAction->setUser($ecommerceUser);
        $membershipAction->setBrand($subscription->getProduct()->getBrand());
        $membershipAction->setSubscription($subscription);
        $membershipAction->setAction('extended for amount of months');
        $membershipAction->setActionAmount(2);
        $membershipAction->setNote('membership was extended by 2 months');

        try {
            $this->ecommerceEntityManager->persist($membershipAction);
            $this->ecommerceEntityManager->flush();
        } catch (Exception|Throwable $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        $newRenewalDate = $subscription->getPaidUntil()->format('F jS, Y');

        if (true) {
            return $this->returnRedirect(
                true, 'Your access has been extended. Your new renewal date is ' . $newRenewalDate
            );
        }
        return $this->returnRedirect(false);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function declineOfferProceedWithCancel(Request $request)
    {
        return $this->cancel($request);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendHelpEmail(Request $request)
    {
        try {
            $helpIssue = $request->get('help-issue');
            $helpIssueText = self::HOW_CAN_WE_HELP_OPTIONS[$helpIssue] ?? null;
            $textInput = $request->get('text-input');

            $input = [
                'studentId' => user()->id,
                'studentEmail' => user()->email,
                'helpIssue' => $helpIssue, // ex: "direction"
                'helpIssueText' => $helpIssueText, // ex: "I need more direction"
                'textInput' => $textInput,
            ];

            $mailable = new General($input, 'emails.agnostic');
            $mailable->to('support@musora.com');
            $mailable->from('system@musora.com', 'Musora System');
            $mailable->replyTo(user()->email);
            $mailable->subject('Request for help making most of membership from ' . user()->email);

            Mail::send($mailable);
        } catch (Exception $exception) {
            error_log($exception);
            return $this->returnRedirect(false, self::$generalErrorMessageToUser);
        }

        return $this->returnRedirect(true, 'Your message was successfully sent to our team.');
    }

    public function cancellationConfirmation(Request $request)
    {
        return view('account.settings.cancellation-confirmation');
    }

    // ---------------------------------- private methods supporting cancellation-ui -----------------------------------

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    private function cancel(Request $request)
    {
        try {
            // ---------------------------------------------------------------------------------------------------------
            // foundational information --------------------------------------------------------------------------------
            // ---------------------------------------------------------------------------------------------------------

            $ecommerceUser = $this->userProvider->getCurrentUser();
            $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

            if (!$subscription) {
                return $this->returnRedirect(
                    false,
                    'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                    'contact our support team.'
                );
            }

            $cancelReason = session('cancel-reason-key');
            $additionalFeedback = session('additional-feedback');

            // ---------------------------------------------------------------------------------------------------------
            // changes to subscription ---------------------------------------------------------------------------------
            // ---------------------------------------------------------------------------------------------------------

            $oldSubscription = clone $subscription;

            $subscription->setCanceledOn(Carbon::now());
            $subscription->setIsActive(false);
            $subscription->setCancellationReason($cancelReason);

            $this->ecommerceEntityManager->persist($subscription);
            $this->ecommerceEntityManager->flush();

            $this->userProductService->updateSubscriptionProducts($subscription);

            event(new SubscriptionUpdated($oldSubscription, $subscription));

            $subInfo = $this->subscriptionInfo(user()->getId());
            $contentAccessExpiryDate = $subInfo['activeAllContentAccessExpiryDate'] ?? null;

            // ---------------------------------------------------------------------------------------------------------
            // if trial with no payments made revoke access immediately ------------------------------------------------
            // ---------------------------------------------------------------------------------------------------------

            // this shouldn't happen, but when it does at least with this here it won't break things.
            //  todo: abstract this reduce to redundancy as this is duplicated elsewhere in this class
            if ($subscription->getType() == 'payment plan') {
                $activeSubscriptions = [];
                $subscriptionsForUser = $this->subscriptionRepository->getSubscriptionsForUsers(
                    [$ecommerceUser->getId()]
                );
                foreach ($subscriptionsForUser as $sub) {
                    if ($sub->getIsActive()) {
                        $activeSubscriptions[] = $sub;
                    }
                }
                if (count($activeSubscriptions) === 1) {
                    $subscription = reset($activeSubscriptions);
                    error_log(
                        'subscriptionRepository->getUserActiveSubscription returned a payment plan rather than a ' .
                        'subscription for user ' . user()->getId(
                        ) . '. However all was okay because subscriptionReposit' .
                        'ory->getSubscriptionsForUsers() returned a sufficient substitute.'
                    );
                } else {
                    error_log(
                        'subscriptionRepository->getUserActiveSubscription returned a payment plan rather than a ' .
                        'subscription for user ' . user()->getId(
                        ) . '. A hacky fix that calls subscriptionRepository->g' .
                        'etSubscriptionsForUsers() did not work though because instead of one result it returned ' .
                        count($activeSubscriptions) . '.'
                    );
                    $this->returnRedirect(
                        false,
                        'We\'re sorry, but there\'s been a system error on our end. Please contact Support to expedite ' .
                        'a solution. (Error code: 4d6c64-2)'
                    );
                }
            }

            $isTrial = false;
            if ($subscription->getProduct()) {
                $isTrial = in_array($subscription->getProduct()->getId(), self::TRIAL_MEMBERSHIP_PRODUCT_IDS);
            } else {
                error_log(
                    'User ' . user()->id . ' has a subscription (id ' . $subscription->getId() .
                    ') without an attached product (in \App\Http\Controllers\Platform\ProfileSettingsPagesController::su' .
                    ' bmitCancelReason).'
                );
            }

            $noPaymentsMade = count($subscription->getPayments()) == 0;

            $revokeAccessImmediately = $isTrial && $noPaymentsMade;

            if ($revokeAccessImmediately) {
                $contentAccessExpiryDate = Carbon::now();
            } // not currently used but kept for posterity and safety in case of future changes

            // todo: re-add this and pass it to the cancellation-confirmed page
//            $cancellationSuccessMessage = 'Your membership has been cancelled. You will no longer be automatically ' .
//                'billed and your access will end ' . Carbon::parse($contentAccessExpiryDate)->format('l F jS');
//
//            if ($revokeAccessImmediately) {
//                $cancellationSuccessMessage = 'Your membership has been cancelled. You will no longer be automatically billed.';
//            }

            // ---------------------------------------------------------------------------------------------------------
            // email to student ----------------------------------------------------------------------------------------
            // ---------------------------------------------------------------------------------------------------------

            $mailToStudent = new App\Mail\Agnostic();
            $mailToStudent->to(user()->email);
            $mailToStudent->from('system@musora.com');
            $mailToStudent->replyTo('team@musora.com');
            $mailToStudent->subject('[Important] Your cancellation request has been received.');
            $mailToStudent->view('emails.cancellation-notice-to-student');
            //$mailToStudent->with([]);
            Mail::send($mailToStudent);

            // ---------------------------------------------------------------------------------------------------------
            // email to staff ------------------------------------------------------------------------------------------
            // ---------------------------------------------------------------------------------------------------------

            $mailToStaff = new App\Mail\Agnostic();
            $mailToStaff->to('support+cancellations@musora.com');
            $mailToStaff->from('system@musora.com');
            //$mailToStaff->replyTo('team@musora.com');
            $mailToStaff->subject('Cancellation notice: ' . user()->getEmail());
            $mailToStaff->view('emails.cancellation-notice-to-staff');
            $mailToStaff->with([
                'userEmail' => user()->getEmail(),
                'userId' => user()->getId(),
                'cancellationReasonKey' => $cancelReason,
                'additionalFeedback' => $additionalFeedback,
            ]);
            Mail::send($mailToStaff);

            // ---------------------------------------------------------------------------------------------------------
            // save membership action ----------------------------------------------------------------------------------
            // ---------------------------------------------------------------------------------------------------------

            $membershipAction = new MembershipAction();
            /** @var $membershipAction MembershipAction|NotableEntity */
            $membershipAction->setUser(new User(user()->getId(), user()->getEmail()));
            $membershipAction->setBrand($subscription->getBrand());
            $membershipAction->setAction(MembershipAction::ACTION_CANCELLED);
            $membershipAction->setActionReason($cancelReason);
            $membershipAction->setSubscription($subscription);
            $membershipAction->setNote('additional feedback: "' . $additionalFeedback . '"');

            $this->ecommerceEntityManager->persist($membershipAction);
            $this->ecommerceEntityManager->flush();
        } catch (Exception|Throwable $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        session()->remove('cancel-reason-key');
        session()->remove('additional-feedback');

        return redirect()->route('platform.profile.settings.cancellation-confirmed');
    }

    /**
     * @param $userId
     * @return array
     * @throws ORMException
     */
    private function subscriptionInfo($userId)
    {
        $userProducts = $this->userProductService->getAllUsersProducts($userId);

        foreach ($userProducts as $userProduct) {
            if ($userProduct->getProduct()->getDigitalAccessType() == 'specific content access') {
                $userProductsDigitalAccessTypeSpecific[] = $userProduct;
            }
            $expired = $userProduct->getExpirationDate() ? $userProduct->getExpirationDate()->lt(Carbon::now()) : null;

            $isAllContentAccessProduct = $userProduct->getProduct()->getDigitalAccessType() == 'all content access';
            if ($isAllContentAccessProduct) {
                $allContentAccessProduct = $userProduct;
                $paused = $userProduct->getStartDate() && $userProduct->getStartDate()->gt(Carbon::now());
                if (!$expired) {
                    if ($paused) {
                        $pausedSubscriptionStartDate = $userProduct->getStartDate();
                    } else {
                        $activeAllContentAccessExpiryDate = $userProduct->getExpirationDate();
                    }
                }
                $hasHadMembership = true;
            }
        }

        return [
            'userProductsDigitalAccessTypeSpecific' => $userProductsDigitalAccessTypeSpecific ?? [],
            'pausedSubscriptionStartDate' => $pausedSubscriptionStartDate ?? null,
            'activeAllContentAccessExpiryDate' => $activeAllContentAccessExpiryDate ?? null,
            'hasHadMembership' => $hasHadMembership ?? false,
            'userProducts' => $userProducts,
            'allContentAccessProduct' => $allContentAccessProduct ?? null
        ];
    }

    /**
     * @param bool $success
     * @param null $msg
     * @param string $route
     * @return RedirectResponse
     */
    private function returnRedirect(
        bool $success = true,
        string $msg = null,
        string $route = 'platform.profile.settings.account',
        array $routeParams = []
    ) {
        if ($success) {
            $msg = Collect([$msg ?? self::$generalSuccessMessageToUser]);
            return redirect()->route($route, $routeParams)->with(['successes' => $msg]);
        }
        return redirect()->route($route, $routeParams)->with(['error-message' => ($msg ?? self::$generalErrorMessageToUser)]);
    }

    /**
     * @param $subscriptionToUpdate
     * @param string $carbonMethodName
     * @param string|int $carbonMethodParamValue
     * @return Subscription|boolean
     */
    private function updateSubscriptionPaidUntilDate(
        $subscriptionToUpdate,
        string $carbonMethodName,
        $carbonMethodParamValue
    ) {
        // you're getting the carbon object that is set as an attribute on the entity, not a copy of the carbon object
        $paidUntil = $subscriptionToUpdate->getPaidUntil();

        try {
            /** @var Carbon $extendedPaidUntil */
            $extendedPaidUntil = $paidUntil->$carbonMethodName($carbonMethodParamValue);
        } catch (Exception $e) {
            error_log($e);
            return false;
        }

        try {
            $oldSubscriptionToUpdate = clone($subscriptionToUpdate);

            /*
             * NOTE: "copy()" to get new obj else Doctrine won't detect change in Subscription entity (Doctrine doesn't
             * parse obj details, only evaluates whether object is same object of whole different instance)
             */
            $subscriptionToUpdate->setPaidUntil($extendedPaidUntil->copy());

            $this->ecommerceEntityManager->persist($subscriptionToUpdate);
            $this->ecommerceEntityManager->flush();

            event(new SubscriptionUpdated($oldSubscriptionToUpdate, $subscriptionToUpdate));
        } catch (Throwable $e) {
            error_log($e);
            return false;
        }

        try {
            $this->userProductService->updateSubscriptionProducts($subscriptionToUpdate);
        } catch (Throwable $e) {
            error_log($e);
            return false;
        }

        return $subscriptionToUpdate;
    }
}
