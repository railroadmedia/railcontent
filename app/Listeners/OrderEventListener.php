<?php

namespace App\Listeners;

use App\Analytics\Tracker;
use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Railroad\Ecommerce\Events\OrderEvent;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Ecommerce\Services\UserProductService;
use Throwable;

class OrderEventListener
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var CartService
     */
    private $cartService;

    const SIX_MONTH_ACCESS_CODE_PRODUCT_ID = 93;
    const SIX_MONTH_ACCESS_CODE_PRODUCT_SKU = 'DLM-6mo';

    /**
     * @var UserProductService
     */
    private $userProductService;
    private BrandService $brandService;

    /**
     * OrderEventListener constructor.
     * @param DatabaseManager $databaseManager
     * @param UserProductService $userProductService
     * @param CartService $cartService
     */
    public function __construct(
        DatabaseManager $databaseManager,
        UserProductService $userProductService,
        CartService $cartService,
        BrandService $brandService
    )

    {
        $this->databaseManager = $databaseManager;
        $this->userProductService = $userProductService;
        $this->cartService = $cartService;
        $this->brandService = $brandService;
    }

    /**
     * @param OrderEvent $orderEvent
     */
    public function handleOrderPlaced(OrderEvent $orderEvent)
    {
        if ($this->skuForSixMonthPassRequiringEmail($orderEvent)) {
            $this->sendEmailForSixMonthPass($orderEvent);
        }

        /** @var $orderItem \Railroad\Ecommerce\Entities\OrderItem */
        foreach ($orderEvent->getOrder()->getOrderItems()->toArray() as $orderItem) {
            if ($orderItem->getProduct()->getSku() === 'DLM-365') {
                $this->sendEmailFor1YearPass($orderEvent);
            }
        }

        // railanalytics
        try {
            $this->cartService->refreshCart();
            $promoCode = $this->cartService->getCart()->getPromoCode();

            // track per brand
            Tracker::queue(
                $orderEvent->getOrder()->getBrand(),
                function () use ($orderEvent, $promoCode) {
                    $products = [];
                    $order = $orderEvent->getOrder();

                    foreach ($order->getOrderItems() as $orderItem) {
                        $product = $orderItem->getProduct();
                        $products[] = [
                            'id' => $product->getId(),
                            'name' => $product->getName(),
                            'category' => $product->getType(),
                            'value' => $orderItem->getFinalPrice(),
                            'quantity' => $orderItem->getQuantity(),
                            'sku' => $product->getSku(),
                            'discount' => $orderItem->getTotalDiscounted()
                        ];
                    }

                    Tracker::trackTransaction(
                        $products,
                        $order->getId(),
                        $order->getTotalPaid(),
                        $order->getTaxesDue(),
                        $order->getShippingDue(),
                        $orderEvent->getPayment() ? $orderEvent->getPayment()->getType() : null,
                        $promoCode
                    );
                }
            );

            // also always track on musora domain if its not a musora origin order
            if ($orderEvent->getOrder()->getBrand() != 'musora') {
                Tracker::queue(
                    'musora',
                    function () use ($orderEvent, $promoCode) {
                        $products = [];
                        $order = $orderEvent->getOrder();

                        foreach ($order->getOrderItems() as $orderItem) {
                            $product = $orderItem->getProduct();
                            $products[] = [
                                'id' => $product->getId(),
                                'name' => $product->getName(),
                                'category' => $product->getType(),
                                'value' => $orderItem->getFinalPrice(),
                                'quantity' => $orderItem->getQuantity(),
                                'sku' => $product->getSku(),
                                'discount' => $orderItem->getTotalDiscounted()
                            ];
                        }

                        Tracker::trackTransaction(
                            $products,
                            $order->getId(),
                            $order->getTotalPaid(),
                            $order->getTaxesDue(),
                            $order->getShippingDue(),
                            $orderEvent->getPayment() ? $orderEvent->getPayment()->getType() : null,
                            $promoCode
                        );
                    }
                );
            }
        } catch (Throwable $throwable) {
            error_log("There is a problem with musora ecommerce order syncing to analytics providers.");
            error_log($throwable);
        }

        // add edge 30 days non-renewing access if they purchased the product
        foreach ($orderEvent->getOrder()->getOrderItems() as $orderItem) {
            if (in_array($orderItem->getProduct()->getSku(), ['drumeo_edge_30_days_access', 'drumeo_access_30-days'])) {

                // set user product expiration date to 30 days instead of unlimited
                $this->userProductService->assignUserProduct(
                    $orderEvent->getOrder()->getUser(),
                    $orderItem->getProduct(),
                    Carbon::now()->addDays(30)
                );

            }
        }
    }

    /**
     * @param OrderEvent $orderEvent
     * @return bool
     */
    private function skuForSixMonthPassRequiringEmail(OrderEvent $orderEvent)
    {
        /** @var $orderItem \Railroad\Ecommerce\Entities\OrderItem */
        foreach ($orderEvent->getOrder()->getOrderItems()->toArray() as $orderItem) {
            if ($orderItem->getProduct()->getSku() === self::SIX_MONTH_ACCESS_CODE_PRODUCT_SKU) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param OrderEvent $orderEvent
     * @return bool
     */
    private function sendEmailForSixMonthPass(OrderEvent $orderEvent)
    {
        $order = $orderEvent->getOrder();
        $user = $order->getUser();

        try {
            $accessCode = $this->generateAccessCode(self::SIX_MONTH_ACCESS_CODE_PRODUCT_ID);
        } catch (\Exception $e) {
            error_log('no access code sent for user ' . $user->getEmail());
            error_log($e);

            Mail::send(
                'emails.access-code-failure',
                [],
                function (Message $message) use ($user) {
                    $message->subject('Access code delayed')
                        ->from('support@drumeo.com', 'Drumeo Support')
                        ->replyTo('support@drumeo.com')
                        ->to($user->getEmail());
                }
            );

            Mail::send(
                'emails.access-code-failure',
                [],
                function (Message $message) use ($user) {
                    //$message->subject('Access code is on its way, but there was a delay today unfortunate...ly')
                    $message->subject('Access code delayed for user ' . $user->getEmail())
                        ->from('support@drumeo.com', 'Drumeo Support')
                        ->replyTo('support@drumeo.com')
                        ->to(['jonathan@drumeo.com', 'caleb@drumeo.com']);
                }
            );
            return true;
        }

        Mail::send(
            'emails.access-code',
            ['accessCode' => $accessCode],
            function (Message $message) use ($user) {
                $message->subject('Your 6-Month Access Code!')
                    ->from('support@drumeo.com', 'Drumeo Support')
                    ->replyTo('support@drumeo.com')
                    ->to($user->getEmail());
            }
        );
        return true;
    }

    /**
     * @param OrderEvent $orderEvent
     * @return bool
     */
    private function sendEmailFor1YearPass(OrderEvent $orderEvent)
    {
        $order = $orderEvent->getOrder();
        $user = $order->getUser();

        try {
            $accessCode = $this->generateAccessCode(125);
        } catch (\Exception $e) {
            error_log('no 1 year access code sent for user ' . $user->getEmail());
            error_log($e);

            return true;
        }

        // format the access code:
        $accessCode = $this->hyphenate(strtoupper($accessCode));

        Mail::send(
            'emails.one-year-access-code-promo',
            ['accessCode' => $accessCode],
            function (Message $message) use ($user) {
                $message->subject('Your Gift Access Pass 🎁 (Important)')
                    ->from('jared@drumeo.com', 'Jared Falk (Drumeo)')
                    ->replyTo('support@drumeo.com')
                    ->to($user->getEmail());
            }
        );
        return true;
    }

    /**
     * @param string $productId
     * @param string $brand
     * @return string
     * @throws \Exception
     */
    public function generateAccessCode($productId, $brand = 'drumeo')
    {
        // todo: move to railroad/ecommerce

        $now = Carbon::now();

        $unique = false;
        while (!$unique) {
            $accessCode = bin2hex(openssl_random_pseudo_bytes(24 / 2));
            $numberOfMatchingCodes = $this->databaseManager->connection(config('ecommerce.database_connection_name'))
                ->table('ecommerce_access_codes')
                ->select()
                ->where('code', $accessCode)
                ->count();
            $unique = $numberOfMatchingCodes === 0;
        }

        if (empty($accessCode)) {
            throw new \Exception('No access code created. This is impossible.');
        }

        $data = [
            'code' => strtoupper($accessCode),
            'product_ids' => serialize([$productId]),
            'is_claimed' => false,
            'claimer_id' => null,
            'claimed_on' => null,
            'brand' => $brand,
            'note' => null,
            'source' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $insertSuccessful = $this->databaseManager->connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_access_codes')
            ->insert($data);

        if (!$insertSuccessful) {
            error_log(
                'insert failed in \App\Listeners\OrderEventListener::generateAccessCode for data: ' .
                var_export($data, true)
            );
            return false;
        }
        return $accessCode;
    }

    public function hyphenate($str) {
        return implode(" - ", str_split($str, 4));
    }
}
