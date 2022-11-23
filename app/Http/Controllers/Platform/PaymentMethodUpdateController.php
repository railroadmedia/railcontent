<?php

namespace App\Http\Controllers\Platform;

use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Modules\Ecommerce\Models\Product as ProductModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Entities\PaymentMethod;
use Railroad\Ecommerce\Entities\Structures\Purchaser;
use Railroad\Ecommerce\Events\PaypalPaymentMethodEvent;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionUpdated;
use Railroad\Ecommerce\Exceptions\PaymentFailedException;
use Railroad\Ecommerce\Gateways\PayPalPaymentGateway;
use Railroad\Ecommerce\Gateways\StripePaymentGateway;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\CurrencyService;
use Railroad\Ecommerce\Services\PaymentMethodService;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Ecommerce\Services\SubscriptionService;
use Spatie\Fractal\Fractal;
use Throwable;

class PaymentMethodUpdateController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * @var PaymentMethodService
     */
    private $paymentMethodService;

    /**
     * @var SubscriptionService
     */
    private $subscriptionService;

    /**
     * @var PayPalPaymentGateway
     */
    private $payPalPaymentGateway;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var CurrencyService
     */
    private $currencyService;

    /**
     * @var StripePaymentGateway
     */
    private $stripePaymentGateway;

    /**
     * @var EcommerceEntityManager
     */
    private $entityManager;

    public function __construct(
        CurrencyService $currencyService,
        EcommerceEntityManager $entityManager,
        PaymentMethodService $paymentMethodService,
        PayPalPaymentGateway $payPalPaymentGateway,
        StripePaymentGateway $stripePaymentGateway,
        SubscriptionRepository $subscriptionRepository,
        SubscriptionService $subscriptionService,
        UserProviderInterface $userProvider
    ) {
        $this->currencyService = $currencyService;
        $this->entityManager = $entityManager;
        $this->paymentMethodService = $paymentMethodService;
        $this->payPalPaymentGateway = $payPalPaymentGateway;
        $this->stripePaymentGateway = $stripePaymentGateway;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->subscriptionService = $subscriptionService;
        $this->userProvider = $userProvider;
    }

    /**
     * @param UpdatePaymentMethodRequest $request
     * @return RedirectResponse|JsonResponse|Fractal
     * @throws PaymentFailedException
     */
    public function submitUpdateForm(UpdatePaymentMethodRequest $request)
    {
        $user = $this->userProvider->getCurrentUser();

        $purchaser = new Purchaser();

        $purchaser->setId($user->getId());
        $purchaser->setEmail($user->getEmail());
        $purchaser->setType(Purchaser::USER_TYPE);
        $purchaser->setBrand($request->get('gateway', config('ecommerce.brand')));

        $updateActiveSubscriptions = $request->get('update_active_subscriptions');

        try {
            $billingCountry = $request->get('billing_country');
            $billingState = $request->get('billing_region');

            // credit card
            if ($request->get('method_type') == PaymentMethod::TYPE_CREDIT_CARD) {
                $customer = $this->stripePaymentGateway->getOrCreateCustomer(
                    $request->get('gateway'),
                    $user->getEmail()
                );

                $card = $this->stripePaymentGateway->createCustomerCard(
                    $request->get('gateway'),
                    $customer,
                    $request->get('card_token')
                );

                // save billing address
                $billingAddress = new Address();

                $billingAddress->setType(Address::BILLING_ADDRESS_TYPE);
                $billingAddress->setBrand(config('ecommerce.brand'));
                $billingAddress->setUser($user);
                $billingAddress->setRegion($billingState);
                $billingAddress->setCountry($billingCountry);

                $this->entityManager->persist($billingAddress);

                $paymentMethod = $this->paymentMethodService->createCreditCardPaymentMethod(
                    $purchaser,
                    $billingAddress,
                    $card,
                    $customer,
                    $request->get('gateway'),
                    $request->get('currency', $this->currencyService->get()),
                    true ? $updateActiveSubscriptions : false
                );

                event(new PaypalPaymentMethodEvent($paymentMethod->getId()));
            } // paypal
            elseif ($request->get('method_type') == PaymentMethod::TYPE_PAYPAL || !empty($request->get('token'))) {
                // if the paypal token is not set we must first redirect to paypal
                if (empty($request->get('token'))) {
                    $gateway = $request->get('gateway');
                    $url = url()->route(config('ecommerce.paypal.agreement_route'), ['gateway' => $gateway]);

                    $checkoutUrl = $this->payPalPaymentGateway->getBillingAgreementExpressCheckoutUrl($gateway, $url);

                    session()->put(brand() . 'payment-method-update-input', $request->all());

                    return response()->json(['redirect' => $checkoutUrl]);
                }

                // otherwise do the update
                $billingAgreementId = $this->payPalPaymentGateway->createBillingAgreement(
                    config('ecommerce.brand'),
                    '',
                    '',
                    $request->get('token')
                );

                $billingAddress = new Address();

                $billingAddress->setType(Address::BILLING_ADDRESS_TYPE);
                $billingAddress->setBrand(config('ecommerce.brand'));
                $billingAddress->setUser($user);
                $billingAddress->setRegion($billingState);
                $billingAddress->setCountry($billingCountry);;

                $this->entityManager->persist($billingAddress);

                $paymentMethod = $this->paymentMethodService->createPayPalPaymentMethod(
                    $purchaser,
                    $billingAddress,
                    $billingAgreementId,
                    config('ecommerce.brand'),
                    $this->currencyService->get(),
                    true
                );

                event(new PaypalPaymentMethodEvent($paymentMethod->getId()));
            } // failure
            else {
                throw new PaymentFailedException('Payment method not supported.');
            }
        } catch (Throwable $exception) {
            $url = $request->get('redirect') ?? strtok(app('url')->previous(), '?');

            return response()->json(
                [
                    'redirect' => $url,
                    'errors' => ['payment' => $exception->getMessage()],
                ],
                400
            );
        }

        // update_active_subscriptions
        // renew_due_subscription

        $subscriptions = $this->subscriptionRepository->getAllUsersSubscriptions(
            $user->getId()
        );

        // if update_active_subscriptions is true, update all active subscriptions to use the new payment method
        if ($updateActiveSubscriptions) {
            foreach ($subscriptions as $subscription) {
                if ($subscription->getIsActive()) {
                    $oldSubscription = clone $subscription;

                    $subscription->setPaymentMethod($paymentMethod);

                    $this->entityManager->persist($subscription);
                    $this->entityManager->flush();

                    event(new SubscriptionUpdated($oldSubscription, $subscription));
                }
            }
        }

        // if their most recent membership subscription is not active, and they chose to renew:
        // update its payment method but dont persist it
        // then attempt to renew it
        // if its successful, persist the new payment method to that subscription, otherwise return error

        $membershipProductIds = ProductModel::query()
            ->where([
                'type' => 'digital subscription',
                'digital_access_type' => 'all content access',
                'digital_access_time_type' => 'recurring'
            ])
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $subscriptionToBill = $this->subscriptionRepository->getUserSubscriptionForProducts(
            $user->getId(),
            $membershipProductIds
        );

        if (user()->isALifetimeMember()) {
            $subscriptionToBill = null;
        }

        // only renew if they choose the option
        if ($request->get('renew_due_subscription') &&
            !empty($subscriptionToBill) &&
            !$subscriptionToBill->getIsActive()) {
            // update its payemnt method
            $oldSubscription = clone $subscriptionToBill;

            $subscriptionToBill->setPaymentMethod($paymentMethod);

            // bill
            try {
                $this->subscriptionService->renew($subscriptionToBill);
            } catch (Throwable $exception) {
                $url = $request->get('redirect') ?? strtok(app('url')->previous(), '?');

                if ($request->isJson()) {
                    return response()->json(
                        [
                            'redirect' => $url,
                            'errors' => ['payment' => $exception->getMessage()],
                        ],
                        400
                    );
                } else {
                    return redirect()
                        ->route('members.settings.payments')
                        ->with(['errors' => new MessageBag([$exception->getMessage()])]);
                }
            }

            // persist if successful
            $this->entityManager->persist($subscriptionToBill);
            $this->entityManager->flush();

            event(new SubscriptionUpdated($oldSubscription, $subscriptionToBill));
        }

        if ($request->isJson()) {
            return ResponseService::paymentMethod($paymentMethod);
        } else {
            return redirect()
                ->route('members.settings.payments')
                ->with(['successes' => new MessageBag(['Your payment method has been updated!'])]);
        }
    }
}
