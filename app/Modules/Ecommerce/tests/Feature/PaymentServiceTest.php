<?php


use App\Modules\Ecommerce\Models\AppleReceipt;
use App\Modules\Ecommerce\Models\GoogleReceipt;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Services\PaymentService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    private PaymentService $paymentService;

    public function test_returns_total_paid_for_order()
    {
        $amount = 999.0;
        // create a basic order that doesn't use an external provider
        $order = $this->createOrder(null, 'USD', $amount);
        $totalAmount = $this->paymentService->getTotalPaid($order);
        $this->assertEquals($amount, $totalAmount);
    }

    /**
     * Helper function to create an order with a valid payment using the specified external provider for each
     * amount given
     *
     * @param  string|null  $externalProvider
     * @param  string  $currency
     * @param  float  ...$amounts
     * @return Order
     */
    private function createOrder(?string $externalProvider, string $currency, float ...$amounts): Order
    {
        $payments = collect();
        foreach ($amounts as $amount) {
            $payments->push(
                Payment::factory()->withExternalProvider($externalProvider)->withAmount($amount, $currency)->create()
            );
        }
        return Order::factory()->hasAttached($payments, ['created_at' => now()])->create();
    }

    public function test_returns_total_paid_in_usd_for_order_in_another_currency()
    {
        $amount = 100.0;
        // create a basic order that doesn't use an external provider
        $order = $this->createOrder(null, 'CAD', $amount);
        Http::fake([
            // fake the call to exchangerate-api.com
            '*' => Http::response([
                'result' => 'success',
                'conversion_amounts' => ['USD' => 74.01879]
            ]),
        ]);
        $totalAmount = $this->paymentService->getTotalPaid($order);
        $this->assertEquals(74.02, $totalAmount);
    }

    public function test_returns_total_paid_for_order_with_multiple_payments()
    {
        $amount1 = 100.0;
        $amount2 = 555.0;
        $amount3 = 344.0;
        // create a basic order that doesn't use an external provider
        $order = $this->createOrder(null, 'USD', $amount1, $amount2, $amount3);
        $totalAmount = $this->paymentService->getTotalPaid($order);
        $this->assertEquals($amount1 + $amount2 + $amount3, $totalAmount);
    }

    public function test_returns_total_paid_for_subscription_payment()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(null, 'USD', $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_subscription_payment_with_refund()
    {
        $paid = 999.0;
        $refunded = 100.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(null, 'USD', $paid);
        $payment = $subscriptionPayment->payment;
        // set a refunded value that's less than the payment
        $payment->total_refunded = $refunded;
        $payment->save();
        $payment->save();

        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals(899.0, $totalAmount);
    }

    public function test_returns_total_paid_for_subscription_payment_with_over_refund()
    {
        $paid = 999.0;
        $refunded = 1000.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(null, 'USD', $paid);
        $payment = $subscriptionPayment->payment;
        // set a refunded value that's greater than the payment
        $payment->total_refunded = $refunded;
        $payment->save();

        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals(0.0, $totalAmount);
    }

    /**
     * Helper function to create a subscription payment with a valid payment in the given amount,
     * using the specified external provider
     *
     * @param  string|null  $externalProvider
     * @param  string  $currency
     * @param  float  $amount
     * @return SubscriptionPayment
     */
    private function createSubscriptionPayment(
        ?string $externalProvider,
        string $currency,
        float $amount
    ): SubscriptionPayment {
        $payment = Payment::factory()->withExternalProvider($externalProvider)->withAmount($amount, $currency)->create(
        );

        $subscriptionPayment = SubscriptionPayment::factory()->forPayment($payment)->create();

        // if using Apple or Google, we need to create receipts as well
        if ($externalProvider === Payment::EXTERNAL_PROVIDER_APPLE) {
            AppleReceipt::create([
                'brand' => 'musora',
                'receipt' => $this->faker->text(),
                'request_type' => AppleReceipt::MOBILE_APP_REQUEST_TYPE,
                'valid' => 1,
                'transaction_id' => $payment->external_id,
                'local_price' => $amount,
                'local_currency' => 'USD'
            ]);
        } elseif ($externalProvider === Payment::EXTERNAL_PROVIDER_GOOGLE) {
            GoogleReceipt::create([
                'brand' => 'musora',
                'package_name' => 'com.musoraapp',
                'product_id' => $subscriptionPayment->subscription->product_id,
                'purchase_token' => $this->faker->text(),
                'request_type' => GoogleReceipt::MOBILE_APP_REQUEST_TYPE,
                'notification_type' => GoogleReceipt::GOOGLE_RENEWAL_NOTIFICATION_TYPE,
                'valid' => 1,
                'order_id' => $payment->external_id,
                'local_price' => $amount,
                'local_currency' => 'USD'
            ]);
        }

        return $subscriptionPayment;
    }

    public function test_returns_total_paid_for_stripe()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_STRIPE, 'USD', $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_paypal()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_PAYPAL, 'USD', $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_apple()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_APPLE, 'USD', $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_google()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_GOOGLE, 'USD', $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    /**
     * @throws RequestException
     */
    public function test_get_converted_currency_amount_throws_exception_for_invalid_original_currency()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->paymentService->getConvertedCurrencyAmount(1.0, 'xyz', now(), 'usd');
    }

    /**
     * @throws RequestException
     */
    public function test_get_converted_currency_amount_throws_exception_for_invalid_desired_currency()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->paymentService->getConvertedCurrencyAmount(1.0, 'usd', now(), 'xyz');
    }

    /**
     * @throws RequestException
     */
    public function test_get_converted_currency_amount_throws_exception_for_failure()
    {
        Http::fake([
            // fake the call to exchangerate-api.com
            '*' => Http::response([
                'result' => 'error'
            ]),
        ]);
        $this->expectException(Exception::class);
        $this->paymentService->getConvertedCurrencyAmount(1.0, 'CAD', now(), 'USD');
    }

    /**
     * @throws RequestException
     */
    public function test_get_converted_currency_amount_throws_exception_for_missing_desired_currency()
    {
        Http::fake([
            // fake the call to exchangerate-api.com
            '*' => Http::response([
                'result' => 'success',
                'conversion_amounts' => ['USD' => 0.7401]
            ]),
        ]);
        $this->expectException(Exception::class);
        $this->paymentService->getConvertedCurrencyAmount(1.0, 'CAD', now(), 'GBP');
    }

    /**
     * @throws RequestException
     */
    public function test_get_converted_currency_amount_returns_converted_amount()
    {
        Http::fake([
            // fake the call to exchangerate-api.com
            '*' => Http::response([
                'result' => 'success',
                'conversion_amounts' => ['USD' => 0.7401]
            ]),
        ]);
        $usd = $this->paymentService->getConvertedCurrencyAmount(1.0, 'CAD', now(), 'USD');
        $this->assertEquals(0.74, $usd);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->paymentService = $this->app->make(PaymentService::class);
    }
}
