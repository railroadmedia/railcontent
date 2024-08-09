<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\PaymentMethod;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\OrderRepository;
use Railroad\Ecommerce\Repositories\PaymentMethodRepository;
use Railroad\Ecommerce\Services\CartAddressService;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\ResponseService;
use Railroad\Location\Services\CountryListService;
use App\Analytics\Tracker;

class OrderController extends Controller
{
    /**
     * @var AddressRepository
     */
    private $addressRepository;

    /**
     * @var CartAddressService
     */
    private $cartAddressService;

    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var PaymentMethodRepository
     */
    private $paymentMethodRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * OrderController constructor.
     *
     * @param AddressRepository $addressRepository
     * @param CartAddressService $cartAddressService
     * @param CartService $cartService
     * @param PaymentMethodRepository $paymentMethodRepository
     * @param UserProviderInterface $userProvider
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        AddressRepository $addressRepository,
        CartAddressService $cartAddressService,
        CartService $cartService,
        PaymentMethodRepository $paymentMethodRepository,
        UserProviderInterface $userProvider,
        OrderRepository $orderRepository
    ) {
        $this->addressRepository = $addressRepository;
        $this->cartAddressService = $cartAddressService;
        $this->cartService = $cartService;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->userProvider = $userProvider;
        $this->orderRepository = $orderRepository;
    }

    public function checkEmailExists(Request $request): JsonResponse
    {
        return Response::json(
            [
                'unique' => !$this->userProvider->checkEmailExists($request->get('email'))
            ]
        );
    }

    public function showOrderForm(Request $request, $domain, $brand = null)
    {
        $user = user();

        $billingAddress = $this->cartAddressService->getBillingAddress();

        $shippingAddress = $this->cartAddressService->getShippingAddress();

        $this->cartService->refreshCart();

        $cart = $this->cartService->getCart();
        $cartDataArray = $this->cartService->toArray();
        $referralCode = $request->session()->get('referralCode');

        // if it's a brand domain, redirect to musora with the current cart items
        if (Str::endsWith($domain, 'drumeo.com') ||
            Str::endsWith($domain, 'pianote.com') ||
            Str::endsWith($domain, 'guitareo.com') ||
            Str::endsWith($domain, 'singeo.com')) {

            if (Str::endsWith($domain, 'drumeo.com')) {
                $brand = 'drumeo';
            } elseif (Str::endsWith($domain, 'pianote.com')) {
                $brand = 'pianote';
            } elseif (Str::endsWith($domain, 'guitareo.com')) {
                $brand = 'guitareo';
            } elseif (Str::endsWith($domain, 'singeo.com')) {
                $brand = 'singeo';
            } elseif (Str::endsWith($domain, 'musora.com')) {
                $brand = 'musora';
            } else {
                $brand = 'drumeo';
            }

            $urlParams = [];

            foreach ($cartDataArray['items'] ?? [] as $cartItem) {
                $urlParams['products'][$cartItem['sku']] = $cartItem['quantity'];
            }

            foreach ($cartDataArray['bonuses'] ?? [] as $bonusItem) {
                $urlParams['bonuses'][$bonusItem['sku']] = $bonusItem['quantity'];
            }

            $urlParams['locked'] = $cartDataArray['locked'] ?? false;
            $urlParams['number_of_payments'] = $cartDataArray['number_of_payments'] ?? false;
            $urlParams['redirect'] = $cartDataArray['redirect'] ?? ('/order/' . $brand);
            $urlParams['referralCode'] = $referralCode;

            $queryString = http_build_query($urlParams);

            return redirect()->away(get_musora_brand_base_url() . '/ecommerce/add-to-cart?' . $queryString);
        }

        $currentUrl = get_musora_brand_base_url() . '/order/' . $brand;
        $loginUrl = route('login', ['redirect_to' => $currentUrl]);
        $logoutUrl = route('user_management_system.logout.cookie', ['redirect_to' => $currentUrl]);

        // this is likely no longer needed
        //        if (!empty($user) &&
        //            UserAccessService::isEdge($user->id) &&
        //            !empty($cart->getItemBySku('drumeo_edge_30_days_access'))) {
        //
        //            $cart->removeItemBySku('drumeo_edge_30_days_access');
        //            $cart->toSession();
        //
        //        }

        if (empty($cart->getItems())) {
            return redirect()->to('/');
        }

        Tracker::queue(
            'musora',
            function () use ($cartDataArray) {
                $trackerProducts = [];
                foreach ($cartDataArray['items'] as $cartItemData) {
                    $trackerProduct = null;
                    $trackerProduct['id'] = $cartItemData['id'];
                    $trackerProduct['name'] = $cartItemData['name'];
                    $trackerProduct['type'] = $cartItemData['type'];
                    $trackerProduct['value'] = $cartItemData['price_after_discounts'];
                    $trackerProduct['quantity'] = $cartItemData['quantity'];
                    $trackerProducts[] = $trackerProduct;
                }
                Tracker::trackInitiateCheckout(
                    $trackerProducts,
                    null,
                    $this->cartService->getTotalItemCosts()
                );
            }
        );

        $stripePublishableKey = config('ecommerce.payment_gateways.stripe.musora.stripe_publishable_key');

        $bonuses = $request->session()->get('bonuses', []);

        foreach ($bonuses as $bonusIndex => $bonus) {
            if ($bonus['sku'] == 'rock-drumming-masterclass-pack') {
                $bonuses[$bonusIndex]['description'] = 'Get Todd Sucherman\'s masterclass with Drumeo Edge.';
            } elseif ($bonus['sku'] == 'drum-technique-made-easy-pack') {
                $bonuses[$bonusIndex]['description'] = 'Get Bruce Becker\'s 26-week course with Drumeo Edge.';
            } elseif ($bonus['sku'] == 'independence-made-easy-pack') {
                $bonuses[$bonusIndex]['description'] = 'Get Jared Falk\'s 26-week course with Drumeo Edge.';
            }
        }

        $paymentMethods = [];
        $shippingAddresses = [];

        if (!empty($user)) {
            $paymentMethods = $this->paymentMethodRepository->getAllUsersPaymentMethods(
                $user->id,
                $request,
                $brand
            );

            // we only want to show unique payment methods, based on the card finger print and paypal agreement id
            // most recent first, only show a max of 5
            $existingCardFingerPrints = [];
            $existingPayPalAgreementIds = [];

            foreach ($paymentMethods as $paymentMethodIndex => $paymentMethod) {
                if ($paymentMethod->getMethodType() == PaymentMethod::TYPE_CREDIT_CARD) {
                    if (isset($existingCardFingerPrints[$paymentMethod->getMethod()->getFingerprint()])) {
                        unset($paymentMethods[$paymentMethodIndex]);
                    } else {
                        $existingCardFingerPrints[$paymentMethod->getMethod()->getFingerprint()] = true;
                    }
                }

                if ($paymentMethod->getMethodType() == PaymentMethod::TYPE_PAYPAL) {
                    if (isset($existingPayPalAgreementIds[$paymentMethod->getMethod()->getExternalId()])) {
                        unset($paymentMethods[$paymentMethodIndex]);
                    } else {
                        $existingPayPalAgreementIds[$paymentMethod->getMethod()->getExternalId()] = true;
                    }
                }
            }

            /**
             * @var $paymentMethods PaymentMethod[]
             */
            $paymentMethods = array_splice($paymentMethods, 0, 5);

            $shippingAddresses = $this->addressRepository->getUserShippingAddresses($user->id, $brand);

            // also get all shipping addresses from their previous orders
            $userOrders =
                $this->orderRepository->findBy(
                    ['user' => new User($user->id, $user->email), 'brand' => $brand],
                    ['createdAt' => 'DESC']
                );

            foreach ($userOrders as $userOrder) {
                if (!empty($userOrder->getShippingAddress())) {
                    $shippingAddresses[] = $userOrder->getShippingAddress();
                }
            }

            // filter out all the duplicate shipping addresses
            $shippingAddressHashes = [];

            foreach ($shippingAddresses as $shippingAddressIndex => $_shippingAddress) {
                $hash = md5(
                    $_shippingAddress->getFirstName() .
                    $_shippingAddress->getLastName() .
                    $_shippingAddress->getStreetLine1() .
                    $_shippingAddress->getStreetLine2() .
                    $_shippingAddress->getCity() .
                    $_shippingAddress->getCountry() .
                    $_shippingAddress->getRegion() .
                    $_shippingAddress->getZip()
                );

                if (isset($shippingAddressHashes[$hash]) ||
                    empty($_shippingAddress->getFirstName()) ||
                    empty($_shippingAddress->getLastName()) ||
                    empty($_shippingAddress->getRegion()) ||
                    empty($_shippingAddress->getStreetLine1()) ||
                    empty($_shippingAddress->getCountry()) ||
                    empty($_shippingAddress->getCity())) {
                    unset($shippingAddresses[$shippingAddressIndex]);
                } else {
                    $shippingAddressHashes[$hash] = true;
                }
            }

            $shippingAddresses = array_splice($shippingAddresses, 0, 5);
        }

        // remove all but the latest paypal payment method otherwise people get confused that they can have
        // multiple payment methods per account
        $hasPayPal = false;

        foreach ($paymentMethods as $paymentMethodIndex => $paymentMethod) {
            if ($paymentMethod->getMethodType() == PaymentMethod::TYPE_PAYPAL) {
                if (!$hasPayPal) {
                    $hasPayPal = true;
                } else {
                    unset($paymentMethods[$paymentMethodIndex]);
                }
            }
        }

        $paymentMethodsJson = ResponseService::paymentMethod(
            $paymentMethods
        )
            ->respond()
            ->getContent();

        $shippingAddressesJson = ResponseService::address(
            $shippingAddresses
        )
            ->respond()
            ->getContent();

        return view(
            $brand . '.pages.order-form',
            [
                'cart' => $cartDataArray,
                'billingAddress' => $billingAddress->toArray(),
                'shippingAddress' => $shippingAddress->toArray(),
                'user' => $user ? [
                    'email' => $user->email
                ] : null,
                'loginUrl' => $loginUrl,
                'logoutUrl' => $logoutUrl,
                'stripePublishableKey' => $stripePublishableKey,
                'countries' => json_encode(array_values(CountryListService::allWithCommonDuplicatedAtTop())),
                'bannedCountries' => json_encode(array_values(CountryListService::unableToShipTo())),
                'provinces' => json_encode(array_keys(config('ecommerce.tax_rates_and_options.canada'))),
                'bonuses' => json_encode($bonuses),
                'paymentMethodsJson' => $paymentMethodsJson,
                'shippingAddressesJson' => $shippingAddressesJson,
                'allMembershipProductSkus' => config('event-data-synchronizer.' . $brand . '_membership_product_skus', []),
                'lifetimeMembershipProductSkus' => config('ecommerce.lifetime_membership_product_skus.drumeo', []),
                'membershipsNumberOfFreeDays' => config('ecommerce.memberships_number_of_free_days.drumeo', []),
                'referralCode' => $referralCode,
            ]
        );
    }

    public function thankYouPageForCustomerOrder(): View
    {
        return view('musora.pages.order-thankyou');
    }

    public function redirectToMusoraOrderForm(Request $request): RedirectResponse
    {
        $parse = parse_url($request->url());

        if (Str::endsWith($parse['host'], 'drumeo.com')) {
            return redirect()->to('/order/drumeo');
        } elseif (Str::endsWith($parse['host'], 'pianote.com')) {
            return redirect()->to('/order/pianote');
        } elseif (Str::endsWith($parse['host'], 'guitareo.com')) {
            return redirect()->to('/order/guitareo');
        } elseif (Str::endsWith($parse['host'], 'singeo.com')) {
            return redirect()->to('/order/singeo');
        } elseif (Str::endsWith($parse['host'], 'musora.com')) {
            return redirect()->to('/order/musora');
        }

        // default
        return redirect()->to('/order/drumeo');
    }

    public function redirectLegacyDrumeoAddToCartUrl(Request $request): RedirectResponse
    {
        $input = $request->all();
        $addedProducts = [];

        // Lots of urls were set up using the wrong locked param name.
        if (!empty($input['lock-cart'])) {
            $input['locked'] = $input['lock-cart'];
        }

        if (($input['go-back-to-shop'] ?? null) == true) {
            // redirecting to hardcoded url, instead of route('drumshop.index'), avoids two redirects made by .htaccess
            $input['redirect'] = '/drumshop/';
        } else {
            $input['redirect'] = route('order-form', ['brand' => 'drumeo']);
        }

        unset($input['go-back-to-shop']);

        $products = [];

        foreach ($input['products'] as $requestProductSku => $productInfo) {
            $productSku = $requestProductSku;
            $productInfo = explode(',', $productInfo);
            $quantityToAdd = $productInfo[0];

            if (!empty($productInfo[1])) {
                // remap product sku for subscriptions
                $subscriptionType = !empty($productInfo[1]) ? $productInfo[1] : null;
                $subscriptionFrequency = !empty($productInfo[2]) ? $productInfo[2] : null;
                $productSku = $requestProductSku . '-' . $subscriptionFrequency . '-' . $subscriptionType;
            }

            $products[$productSku] = $quantityToAdd;
        }

        $input['products'] = $products; // rebuilt products array to maintain cart items order for the subscriptions sku remap case

        // route from ecommerce package
        return redirect()->to('/ecommerce/add-to-cart?' . http_build_query($input));

    }
}
