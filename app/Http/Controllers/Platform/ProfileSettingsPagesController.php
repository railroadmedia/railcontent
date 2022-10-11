<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ProductAccessMap;
use App\Modules\Ecommerce\Models\Product;
use App\Services\User\UserAccessService;
use Illuminate\Http\Request;
use Railroad\Crux\Services\NavigationSpecificsDeterminationService;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Repositories\PaymentMethodRepository;
use Railroad\Ecommerce\Repositories\PaymentRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\InvoiceService;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Ecommerce\Transformers\SubscriptionTransformer;
use Railroad\Location\Services\CountryListService;
use Railroad\Railforums\Repositories\UserSignaturesRepository;
use Railroad\Railnotifications\Services\NotificationSettingsService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ProfileSettingsPagesController extends BaseController
{
    private NotificationSettingsService $notificationSettingsService;
    private UserSignaturesRepository $userSignaturesRepository;
    private PaymentMethodRepository $paymentMethodRepository;
    private SubscriptionRepository $subscriptionRepository;
    private CartService $cartService;
    private PaymentRepository $paymentRepository;
    private SubscriptionTransformer $subscriptionTransformer;
    private InvoiceService $invoiceService;

    /**
     * @param NotificationSettingsService $notificationSettingsService
     */
    public function __construct(
        NotificationSettingsService $notificationSettingsService,
        UserSignaturesRepository $userSignaturesRepository,
        PaymentMethodRepository $paymentMethodRepository,
        SubscriptionRepository $subscriptionRepository,
        CartService $cartService,
        PaymentRepository $paymentRepository,
        SubscriptionTransformer $subscriptionTransformer,
        InvoiceService $invoiceService
    ) {
        $this->notificationSettingsService = $notificationSettingsService;
        $this->userSignaturesRepository = $userSignaturesRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->cartService = $cartService;
        $this->paymentRepository = $paymentRepository;
        $this->subscriptionTransformer = $subscriptionTransformer;
        $this->invoiceService = $invoiceService;
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

    public function membership(Request $request, $domain, $brand, $userId)
    {
        return view('account.settings.membership', [
            'user' => user(),
            'sections' => $this->settingSections('account details'),
            'allBrands' => all_brands(),
            'selectedBrand' => $request->get('selected-brand', $brand)
        ]);
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

        $stripePublishableKey = config('ecommerce.payment_gateways.stripe.drumeo.stripe_publishable_key');

        $membershipProductIds = Product::query()
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
                'sections' => $this->settingSections(),
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
                    "url" => url()->route('platform.profile.settings.membership', ['userId' => user()->id]),
                    'icon' => 'fas fa-calendar-alt',
                    'title' => 'Account Details',
                    'active' => $section === 'account details',
                ],
            ];
        } catch (\Exception $exception) {
            error_log($exception);
            return [];
        }
    }
}
