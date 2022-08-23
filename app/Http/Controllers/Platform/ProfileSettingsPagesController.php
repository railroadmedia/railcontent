<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Modules\Crux\ProductAccessMap;
use App\Services\User\UserAccessService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Railroad\Crux\Services\NavigationSpecificsDeterminationService;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Services\ResponseService;
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
     * @param NotificationSettingsService $notificationSettingsService
     */
    public function __construct(
        NotificationSettingsService $notificationSettingsService,
        UserSignaturesRepository $userSignaturesRepository,
        UserPermissionsService $userPermissionsService
    )
    {
        $this->notificationSettingsService = $notificationSettingsService;
        $this->userSignaturesRepository = $userSignaturesRepository;

        $this->userPermissionsService = $userPermissionsService;
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
/*  * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

student permutation groups
=============================

(and in some cases their component student permutations)

1. ACTIVE SUBSCRIPTION
    * monthly
    * annual
    * annual and renewing soon
2. OFFER FREE TRIAL
    * no membership access, has never been a member, but owns a packs
    * no membership access, has never been a member, does not own any packs (unimportant edge case)
3. SALES PAGE LINK
    * no membership access, has been a member previously, owns a packs
    * no membership access, has been a member previously, does not own any packs
    * monthly subscription, cancelled but access not yet expired
    * annual subscription, cancelled but access not yet expired
    * access from trial, with renewal
    * access from one-time products
    * access from trial, without renewal
    * anomalous non-renewing access
4. UNPAUSE
    * monthly subscription, paused
    * annual subscription, paused
5. APP-PURCHASED
    * access from app purchase, Google
    * access from app purchase, Apple
6. LIFETIME
    * lifetime member

For easy copy-pasta:


1. ACTIVE SUBSCRIPTION
2. OFFER FREE TRIAL
3. SALES PAGE LINK
4. UNPAUSE
5. APP-PURCHASED
6. LIFETIME

ACTIVE SUBSCRIPTION
OFFER FREE TRIAL
SALES PAGE LINK
UNPAUSE
APP-PURCHASED
LIFETIME

Things to figure out before rendering page
=================================================

do they have membership access?
    if yes
        what is the product name?
        is it recurring?
            if yes
                get renewal date
                get price
                If it's monthly then show the "UPGRADE" button
    if no
        have they ever had membership access before?
            if no, THEY ARE "OFFER FREE TRIAL" PERMUTATION GROUP
                pass $hideGetHelpRequestLink as true
            if yes, THEY ARE "SALES PAGE LINK" PERMUTATION GROUPA


If they are the "OFFER FREE TRIAL" permutation group
    do NOT show Get-HelpRequestLink ("Click here if you'd like help getting the most out of your account")

                     |  subscription-info       actions                         hideGetHelpRequestLink
---------------------|---------------------------------------------------------------------------------
ACTIVE SUBSCRIPTION  |  standard                standard                        no
OFFER FREE TRIAL     |  logo-only               trial-offer                     YES
SALES PAGE LINK      |  standard                link-to-sales                   no
UNPAUSE              |  paused-msg              unpause                         no
APP-PURCHASED        |  standard                app-subscription-links          no
LIFETIME             |  lifetime-msg            no-action                       no

subscription-info
    "standard" (price, renewal and student created_on date)
    "lifetime-msg" (standard-lite; student created_on date only)
    "logo-only" (nothing except a logo)
    "paused-msg" ("Your membership will continue on MONTH DD, YYYY and your next renewal date has been extended to MONTH DD, YYYY")
action
    "standard" (cancel if relevant and upgrade offer only if Monthly subscription)
    "trial-offer" ("START FREE TRIAL", "One time offer: 7 days free, no payment plan, starts immediately")
    "link-to-sales" ("RENEW YOUR MEMBERSHIP", "This link will take you to reorder on musora.com. Any purchased access will be added to your existing time. If you’d prefer, you can [click here](support contact page) to contact Support to restart your membership.")
    "unpause" ("CONTINUE YOUR MEMBERSHIP", "The above button will restart your access right away. You can also [contact us](support contact page) for help.")
    "app-subscription-links"
    "no-action" (just blank)

In summary...

subscription-info possibilities: 4
    standard
    lifetime-msg
    logo-only
    paused-msg
actions possibilities: 6
    standard
    trial-offer
    link-to-sales
    unpause-btn
    app-subscription-links
    no-action
hideGetHelpRequestLink possibilities: 2
    show
    hide



Thus, the controller must answer these three questions...
1. what subscription-info?
2. what actions?
3. hideGetHelpRequestLink?



Thus, the controller must answer these three questions...

1. what subscription-info?

    first eval for the most specific criteria
        if "lifetime-msg"
            specific permutation must be
                lifetime member
            trigger: is lifetime member
        if "logo-only"
            specific permutation must be one of these:
                no membership access, has never been a member, but owns a packs
                no membership access, has never been a member, does not own any packs (unimportant edge case)
            trigger: has never had membership access
        if "paused-msg",
            specific permutation must be one of these:
                monthly subscription, paused
                annual subscription, paused
            trigger:
                subscription is paused (ensure not cancelled or anything like that)
    If none of the above criteria are met, then by definition must be: "standard"
        permutation-group must be one of:
            ACTIVE SUBSCRIPTION
            SALES PAGE LINK
            APP-PURCHASED
        specific permutation must be one of these:
            * monthly
            * annual
            * annual and renewing soon
            * no membership access, has been a member previously, owns a packs
            * no membership access, has been a member previously, does not own any packs
            * monthly subscription, cancelled but access not yet expired
            * annual subscription, cancelled but access not yet expired
            * access from trial, with renewal
            * access from one-time products
            * access from trial, without renewal
            * anomalous non-renewing access
            * access from app purchase, Google
            * access from app purchase, Apple
        trigger: default




2. what actions?


    first eval for the most specific criteria...?
        trial-offer,            trigger: has never had membership access
        link-to-sales,          trigger: does NOT have an active subscription
        unpause-btn,            trigger: subscription is paused (ensure not cancelled or anything like that)
        app-subscription-links, trigger: access from app purchase
        no-action,              trigger: is lifetime member

    if none of those are met, default to standard

    though check that they have an active subscription. If they do not then yet we ended up here that may be an issue.



3. hideGetHelpRequestLink?
    return true if has never had membership access



------------------------

The sequence of checks


* [ ] determine baseline info needed to populate page
    * [ ] all owned digital non-membership products
    * [ ] the active subscription
    * [ ] has never had membership access
    * [ ] does NOT have an active subscription
    * [ ] subscription is paused (ensure not cancelled or anything like that)
    * [ ] access from app purchase
    * [ ] is lifetime member
* [ ] using that determine
    * [ ] what subscription-info?
    * [ ] what actions?
    * [ ] hideGetHelpRequestLink?


Misc. Notes:

* "click here for help getting the most of your account" always shows unless $doNothideGetHelpRequestLink is true

* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


        if ($userId != auth()->id()) {
            // ok so what now?
        }

        $userId = auth()->id();


        $userPermissions = $this->userPermissionsService->getUserPermissions($userId);

        $userPermissionsSorted = [
            'eternal' => [],
            'paused' => [],
            'active' => [],
            'expired' => [],
        ];

        foreach ($userPermissions as $userPermission) {
            $startDate = !empty($userPermission['start_date']) ? $userPermission['start_date'] : false;
            $expirationDate = !empty($userPermission['expiration_date']) ? $userPermission['expiration_date'] : false;
            //$userPermission['name']

            $startDateIsInFuture = false;
            $expirationDateIsPast = false;

            if ($startDate) {
                $startDateIsInFuture = Carbon::parse($startDate)->gt(Carbon::now());
            }

            if ($startDateIsInFuture) {
                $userPermissionsSorted['paused'][] = $userPermission;
                break;
            }

            if ($expirationDate) {
                $expirationDateIsPast = Carbon::parse($expirationDate)->gt(Carbon::now());
            } else {
                $userPermissionsSorted['eternal'][] = $userPermission;
                break;
            }

            if ($expirationDateIsPast) {
                $userPermissionsSorted['expired'][] = $userPermission;
            } else {
                $userPermissionsSorted['active'][] = $userPermission;
            }
        }

        dd($userPermissionsSorted);

        // -------------------------------------------------------------------------------------------------------------

        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: ownedNonMembershipProducts-  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -

        $userProductService = app(UserProductService::class);
        $userProducts = $userProductService->getAllUsersProducts($userId);

        $ownedNonMembershipProducts = [];

        foreach ($userProducts as $userProduct) {
            /** @var Product $product */
            $product = $userProduct->getProduct();

            $membershipProductIdsForBrand = [];

            if (!empty(ProductAccessMap::membershipProductIds()[$brand])) {
                $membershipProductIdsForBrand = ProductAccessMap::membershipProductIds()[$brand];
            }

            $isMembershipProduct = in_array($product->getId(), $membershipProductIdsForBrand);

            //dump(($isMembershipProduct ? '===YES===' : '---no--- ') . ': ' . $product->getName()); // DEBUGGING AID; DELETE ANYTIME

            if ($product->getBrand() == $brand && !$isMembershipProduct) {
                $ownedNonMembershipProducts[$brand][] = $product;
            }
        }

        $hasMembershipAccess = false;


        // todo: figure how membership's gonna work for MWP
        //  ===================================================================== PICK UP HERE ====== PICK UP HERE======



        // ------------- THESE ARE EASY SO DO EM FIRST? -------------

        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: the active subscription   -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -





        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: subscription is paused (ensure not cancelled or anything like that) -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -





        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: access from app purchase  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -





        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: is lifetime member  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -




        // ------------- THESE ARE MORE CHALLENGING SO DON'T DO THEM IF NOT NEEDED? -------------

        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: has never had membership access -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -





        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // foundational info: does NOT have an active subscription  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -














        // =============================================================================================================

        // =============================================================================================================

        // =============================================================================================================

        // =============================================================================================================

        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // determine page element: what subscription-info? -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -





        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // determine page element: what actions?  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -





        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // determine page element: hideGetHelpRequestLink? -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
        // -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -
















        // -------------------------------------------------------------------------------------------------------------








        // -------------------------------------------------------------------------------------------------------------

        return view('account.settings.account',
            [
                'user' => user(),
                'sections' => $this->settingSections('account'),
                'ownedNonMembershipProducts' => $ownedNonMembershipProducts,
                'hasMembershipAcess' => $hasMembershipAccess,
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
