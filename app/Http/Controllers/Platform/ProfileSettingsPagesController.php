<?php

namespace App\Http\Controllers\Platform;

use App;
use App\Http\Controllers\BaseController;
use App\Modules\Crux\ProductAccessMap;
use App\Services\User\UserAccessService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Mail;
use Railroad\Crux\Services\NavigationSpecificsDeterminationService;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\MembershipAction;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Entities\Product;
use App\Modules\Ecommerce\Models\Product as ProductModel;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Entities\Traits\NotableEntity;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionUpdated;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\PaymentMethodRepository;
use Railroad\Ecommerce\Repositories\PaymentRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\InvoiceService;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Ecommerce\Services\SubscriptionService;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Ecommerce\Transformers\SubscriptionTransformer;
use Railroad\Location\Services\CountryListService;
use Railroad\Mailora\Mail\General;
use Railroad\Mailora\Services\MailService;
use Railroad\Railcontent\Services\UserPermissionsService;
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

    public static $generalSuccessMessageToUser = 'Your account has been updated.';

    public static $generalErrorMessageToUser = 'We\'re sorry, but there\'s been an error. Please reload the page and try ' .
    'again. If that doesn\'t work email or use the chat at the bottom right of your screen to get things sorted out ' .
    'right away.';

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
     * @var MailService
     */
    private $mailService;

    private CartService $cartService;
    private PaymentRepository $paymentRepository;
    private SubscriptionTransformer $subscriptionTransformer;
    private InvoiceService $invoiceService;
    private PaymentMethodRepository $paymentMethodRepository;
    /**
     * @var EcommerceEntityManager
     */
    private $ecommerceEntityManager;

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
        UserProviderInterface $userProvider,
        MailService $mailService,
        CartService $cartService,
        PaymentRepository $paymentRepository,
        SubscriptionTransformer $subscriptionTransformer,
        InvoiceService $invoiceService,
        PaymentMethodRepository $paymentMethodRepository,
        EcommerceEntityManager $ecommerceEntityManager
    ) {
        $this->notificationSettingsService = $notificationSettingsService;
        $this->userSignaturesRepository = $userSignaturesRepository;
        $this->userPermissionsService = $userPermissionsService;
        $this->userProductService = $userProductService;
        $this->subscriptionService = $subscriptionService;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProvider = $userProvider;
        $this->mailService = $mailService;
        $this->cartService = $cartService;
        $this->paymentRepository = $paymentRepository;
        $this->subscriptionTransformer = $subscriptionTransformer;
        $this->invoiceService = $invoiceService;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->ecommerceEntityManager = $ecommerceEntityManager;
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
            'userNotificationsSettings' => $this->notificationSettingsService->getUserNotificationSettings(
                user()->id,
                null,
                $request->get('selected-brand', $brand)
            ),
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

        // --------------------------------------- get the active subscription -----------------------------------------

        $activeSubscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

        if (!$activeSubscription) {
            if ($activeAllContentAccessExpiryDate > Carbon::now()) {
                $membershipWithoutSubscription = true;
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

        if($urlParamsByBrandForTrial[$brand]){
            $urlParams = $urlParamsByBrandForTrial[$brand];
            $addToCartUrlTrial = 'https://' . $brand . '.com/ecommerce/add-to-cart?' . $urlParams;
            if ($brand == 'drumeo') {
                $addToCartUrlTrial = 'https://drumeo.com/laravel/public/shopping-cart/api/query?' . $urlParams;
            }
        } else {
            $addToCartUrlTrial = 'https://musora.com/';
        }

//        $annualSKUsByBrand = [
//            'drumeo' => 'DLM-1-year',
//            'pianote' => 'PIANOTE-MEMBERSHIP-1-YEAR',
//            'guitareo' => 'GUITAREO-1-YEAR-MEMBERSHIP',
//            'singeo' => 'singeo-annual-recurring-membership',
//        ];

        $salesPage['drumeo'] = 'https://www.drumeo.com/';
        $salesPage['pianote'] = 'https://www.pianote.com/';
        $salesPage['guitareo'] = 'https://www.guitareo.com/';
        $salesPage['singeo'] = 'https://www.singeo.com/';
        $salesPageUrl = $salesPage[$brand] ?? $salesPage['drumeo'];

        // -------------------------------------------------------------------------------------------------------------

        $viewData = [
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
        ];

        return view(
            'account.settings.account',
            $viewData
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

        if(!$subscription) {
            return $this->returnRedirect(false);
        }

        // determine if the subscription is a trial
        $trialMembershipProductIds = ProductAccessMap::trialMembershipProductIds();
        $isTrial = in_array($subscription->getProduct()->getId(), $trialMembershipProductIds);

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * store in session because we don't yet need it. We'll present the student with an offer, and if they     *
         * accept that offer then we don't need the cancellation-reason anymore (I least I don't think we're doing *
         * anything with it, though maybe we should anyway). If they do cancel, then we'll take that               *
         * stored-in-the-session cancellation-reason and use that when writing the cancellation to the DB.         *
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
        session()->put('cancel-reason', $reason);
        session()->put('cancel-reason-text', $textReason);

        // TEMPORARY version that immediately cancels instead of offering a retention offer.
        return $this->cancel($request);
        // TEMPORARY version that immediately cancels instead of offering a retention offer.


        // if they claimed retention(win-back) offer recently don't offer it again, instead go right to cancelling
        if (ProductAccessMap::hasClaimedRetentionOfferWithin(user()) || $isTrial) {
            return $this->cancel($request);
        }

        $isSubscriberMonthly = false;
        $isSubscriberAnnual = false;
        $isSubscriberAnnualRenewingSoon = false;

        /* what if the subscription is a 2-month, 3-month, or 6-month subscription? */
        if ($subscription->getIntervalType() === 'month' && $subscription->getIntervalCount() == 1) {

            $amountSaved = $subscription->getTotalPrice() * 2;
            $nextPaymentDateWithOffer = Carbon::parse($subscription->getPaidUntil())->addMonths(2);

            return view('account.settings.offer', [
                'isSubscriberMonthly' => true,
                'subscriptionPrice' => $subscription->getTotalPrice(),
                'amountSaved' => $subscription->getTotalPrice() * 2,
                'nextPaymentDateWithOffer' => $nextPaymentDateWithOffer,
            ]);
        }

        if($subscription->getIntervalType() == 'year') {

            $pointBeforeWhichWeConsiderRenewingSoon = Carbon::now()->addMonths(3);
            $renewingSoon = $subscription->getPaidUntil() <= $pointBeforeWhichWeConsiderRenewingSoon;

            if($renewingSoon) {
                // $isSubscriberAnnualRenewingSoon = true;
                // offer
                    // pause your account
                    // switch to monthly payments

            } else {
                // $isSubscriberAnnual = true;
                // offer
                    // special renewal offer
                    // switch to monthly payments


            }
        }


        // send to final offer screen depending on use case


    }

    public function acceptStudentPlanOffer(Request $request)
    {
        dd('\App\Http\Controllers\Platform\ProfileSettingsPagesController::acceptStudentPlanOffer', $request);
    }

    public function acceptSwitchToMonthly(Request $request)
    {
        dd('\App\Http\Controllers\Platform\ProfileSettingsPagesController::acceptSwitchToMonthly', $request);
    }

    public function acceptGratisAccess(Request $request)
    {
        $userId = auth()->id();
        $ecommerceUser = $this->userProvider->getCurrentUser();

        try {
            $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

            if(!$subscription) {
                return $this->returnRedirect(
                    false,
                    'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                    'contact our support team.'
                );
            }

            $this->updateSubscriptionPaidUntilDate($subscription, 'addMonths', 2);
        } catch (\Exception $e) {
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

        $newRenewalDate = $subscription->getPaidUntil()->format('F j, Y');

        if (true) {
            $routeParams = [];
            $msg = 'Your trial has successfully been extended two months. Your new renewal date is: ' . $newRenewalDate;
        }

        return redirect()->route(
            'platform.profile.settings.account',
            $routeParams ?? ['open-modal-id' => 'modal-how-can-we-make-next-month-better']
        )->with([
            'success-message' => $msg ?? ('Your access has been extended. Your new renewal date is: ' . $newRenewalDate),
            'renewal-date' => $newRenewalDate
        ]);

        dd('\App\Http\Controllers\Platform\ProfileSettingsPagesController::acceptGratisAccess');
    }

    /**
     * @param bool $success
     * @param null $msg
     * @param string $route
     * @return RedirectResponse
     */
    private function returnRedirect($success = true, $msg = null, $route = 'platform.profile.settings.account')
    {
        $type = $success ? 'success-message' : 'error-message';

        $msg = $msg ?? ($success ? self::$generalSuccessMessageToUser : self::$generalErrorMessageToUser);

        return redirect()->route($route)->with([$type => $msg]);
    }


    /**
     * @param $targetProductIds []
     * @param string $carbonMethodName
     * @param string|int $carbonMethodParamValue
     * @return Subscription|boolean
     */
    private function updateSubscriptionPaidUntilDate($subscriptionToUpdate, $carbonMethodName, $carbonMethodParamValue)
    {
        // you're getting the carbon object that is set as an attribute on the entity, not a copy of the carbon object
        $paidUntil = $subscriptionToUpdate->getPaidUntil();

        try {
            /** @var Carbon $extendedPaidUntil */
            $extendedPaidUntil = $paidUntil->$carbonMethodName($carbonMethodParamValue);
        } catch (\Exception $e) {
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

    public function cancel(Request $request)
    {
        $userId = auth()->id();
        $ecommerceUser = $this->userProvider->getCurrentUser();

        try {
            $subscription = $this->subscriptionRepository->getUserActiveSubscription($ecommerceUser)[0] ?? null;

            if(!$subscription) {
                return $this->returnRedirect(
                    false,
                    'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                    'contact our support team.'
                );
            }
        } catch (\Exception $e) {
            return $this->returnRedirect(
                false,
                'Whoops, something went wrong when we tried to extend your membership. Please try again or ' .
                'contact our support team.'
            );
        }

        $oldSubscription = clone $subscription;

        $brand = $subscription->getProduct()->getBrand();

        $cancelReason = session($brand . '-cancel-reason');
        $cancelReasonText = session($brand . '-cancel-reason-text');

        $subscription->setCanceledOn(Carbon::now());
        $subscription->setIsActive(false);
        $subscription->setCancellationReason($cancelReason);

        try {
            $this->ecommerceEntityManager->persist($subscription);
            $this->ecommerceEntityManager->flush();

            $this->userProductService->updateSubscriptionProducts($subscription);
        } catch (Exception|Throwable $e) {
            return $this->returnRedirect(false);
        }

        event(new SubscriptionUpdated($oldSubscription, $subscription));

        $paidUntilRoundedUp = Carbon::parse($subscription->getPaidUntil()->format('Y-m-d'))->endOfDay();

        $trialMembershipProductIds = [
            126, 283, 400, 401, 266, 273, // drumeo
            318, 319, 403, 402, // pianote
            23, 429, 430, 431, // guitareo
            413, 414, 423, 424, // singeo
        ];

        // if trial with no payments made revoke access immediately
        $isTrial = in_array($subscription->getProduct()->getId(), $trialMembershipProductIds);
        $noPaymentsMade = count($subscription->getPayments()) == 0;
        $revokeAccessImmediately = $isTrial && $noPaymentsMade;

        if ($revokeAccessImmediately) {
            $paidUntilRoundedUp = Carbon::now();
        }

        $cancellationSuccessMessage = 'Your membership has been cancelled. You will no longer be automatically ' .
            'billed and your access will end ' . Carbon::parse($paidUntilRoundedUp)->format('l F jS');

        //  todo: send email
        //      (see \Railroad\Crux\Http\Controllers\ActionController::cancel)
        //      1. to staff
        //      2. to student

        // todo: tag in customer.io

        // save membership action
        $membershipAction = new MembershipAction();
        /** @var $membershipAction MembershipAction|NotableEntity */
        $membershipAction->setUser(new User(user()->getId(), user()->getEmail()));
        $membershipAction->setBrand($brand);
        $membershipAction->setAction(MembershipAction::ACTION_CANCELLED);
        $membershipAction->setActionReason($cancelReason);
        $membershipAction->setSubscription($subscription);
        $membershipAction->setNote($cancelReasonText);

        try {
            $this->ecommerceEntityManager->persist($membershipAction);
            $this->ecommerceEntityManager->flush();
        } catch (Exception|Throwable $e) {
            error_log($e);
            return $this->returnRedirect(false);
        }

        session()->remove($brand . '-cancel-reason');
        session()->remove($brand . '-cancel-reason-text');

        // respond
        return $this->returnRedirect(false, $cancellationSuccessMessage);
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
        $user = user();

        $paymentMethods = $this->paymentMethodRepository->getAllUsersPaymentMethods(
            $user->id,
            $request,
            'drumeo'
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

    public function sendHelpEmail(Request $request)
    {
        //Mail::to($recipient)

        $input = [];

        try {
            $helpIssue = $request->get('help-issue');
            $helpIssueText = self::HOW_CAN_WE_HELP_OPTIONS[$helpIssue] ?? null;
            $textInput = $request->get('text-input');

            $mailable = new General($input, 'emails.agnostic');


            $debug_userFromAuth = auth();
            $debug_userFromUserProvider = $this->userProvider->getCurrentUser();

            if (App::environment() !== 'production') {
                $recipientEmailAddress = 'jonathan+email_safety_in_mwp_profilesettingspagecontroller@musora.com';
            }

            $mailable->to($recipientEmailAddress ?? 'support@musora.com');
            $mailable->from('system@musora.com', 'Musora System');
            $mailable->replyTo(user()->email);

            $mailable->subject('Request for help making most of membership from ' . user()->email);

            Mail::send($mailable);
            $success = true;
        } catch (\Exception $exception) {
            error_log($exception);
        }
    }
}
