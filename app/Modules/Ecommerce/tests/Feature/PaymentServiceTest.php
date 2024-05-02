<?php


use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Services\PaymentService;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    private PaymentService $paymentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paymentService = $this->app->make(PaymentService::class);
    }

    public function test_returns_total_paid_for_order()
    {
        $amount = 999.0;
        // create a basic order that doesn't use an external provider
        $order = $this->createOrder(null, $amount);
        $totalAmount = $this->paymentService->getTotalPaid($order);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_order_with_multiple_payments()
    {
        $amount1 = 100.0;
        $amount2 = 555.0;
        $amount3 = 344.0;
        // create a basic order that doesn't use an external provider
        $order = $this->createOrder(null, $amount1, $amount2, $amount3);
        $totalAmount = $this->paymentService->getTotalPaid($order);
        $this->assertEquals($amount1 + $amount2 + $amount3, $totalAmount);
    }

    public function test_returns_total_paid_for_subscription_payment()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(null, $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_stripe()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_STRIPE, $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_paypal()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_PAYPAL, $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_apple()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_APPLE, $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }

    public function test_returns_total_paid_for_google()
    {
        $amount = 999.0;
        // create a basic subscription payment that doesn't use an external provider
        $subscriptionPayment = $this->createSubscriptionPayment(Payment::EXTERNAL_PROVIDER_GOOGLE, $amount);
        $totalAmount = $this->paymentService->getTotalPaid($subscriptionPayment);
        $this->assertEquals($amount, $totalAmount);
    }
    /**
     * Helper function to create a subscription payment with a valid payment in the given amount,
     * using the specified external provider
     *
     * @param  string|null  $externalProvider
     * @param  float  $amount
     * @return SubscriptionPayment
     */
    private function createSubscriptionPayment(?string $externalProvider, float $amount): SubscriptionPayment
    {
        $payment = Payment::factory()->withExternalProvider($externalProvider)->withAmount($amount)->create();
        return SubscriptionPayment::factory()->forPayment($payment)->create();
    }

    /**
     * Helper function to create an order with a valid payment using the specified external provider for each
     * amount given
     *
     * @param  string|null  $externalProvider
     * @param  float  ...$amounts
     * @return Order
     */
    private function createOrder(?string $externalProvider, float ...$amounts): Order
    {
        $payments = collect();
        foreach ($amounts as $amount) {
            $payments->push(Payment::factory()->withExternalProvider($externalProvider)->withAmount($amount)->create());
        }
        return Order::factory()->hasAttached($payments, ['created_at' => now()])->create();
    }
}
