<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ProductAccessMap;
use App\Services\User\UserAccessService;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Railroad\Crux\Services\NavigationSpecificsDeterminationService;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Location\Services\CountryListService;
use Railroad\Railnotifications\Services\NotificationSettingsService;

class ProfileSettingsPagesController extends BaseController
{
    private NotificationSettingsService $notificationSettingsService;

    /**
     * @param NotificationSettingsService $notificationSettingsService
     */
    public function __construct(NotificationSettingsService $notificationSettingsService)
    {
        $this->notificationSettingsService = $notificationSettingsService;
    }

    public function profile(Request $request, $domain, $brand, $userId)
    {
        $userSignature = [];

        return view('account.settings.profile', [
            'user' => user(),
            'signature' => ($userSignature) ? $userSignature['signature'] : '', // todo: railforums integration
            'sections' => $this->settingSections('profile'),
        ]);
    }

    public function loginCredentials(Request $request, $domain, $brand, $userId)
    {
        $userSignature = [];

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

    public function membership(Request $request, $domain, $brand, $userId)
    {
        return 'WIP.';
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
                    "url" => url()->route('platform.profile.settings.membership', ['userId' => user()->id]),
                    'icon' => 'fas fa-calendar-alt',
                    'title' => 'Account Details',
                    'active' => $section === 'access',
                ],
            ];
        } catch (\Exception $exception) {
            error_log($exception);
            return [];
        }
    }
}
