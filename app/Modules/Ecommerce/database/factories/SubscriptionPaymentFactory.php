<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionPaymentFactory extends Factory
{
    protected $model = SubscriptionPayment::class;

    protected ?Subscription $subscription;
    protected ?Payment $payment;

    public function definition(): array
    {
        if (!isset($this->subscription)) {
            $this->subscription = Subscription::factory()->create();
        }
        if (!isset($this->payment)) {
            $this->payment = Payment::factory()->withType(Payment::TYPE_SUBSCRIPTION_RENEWAL)->create();
        }

        return [
            'subscription_id' => $this->subscription->id,
            'payment_id' => $this->payment->id,
        ];
    }

    public function forSubscription(Subscription $subscription): Factory
    {
        return $this->state(['subscription_id' => $subscription->id]);
    }

    public function forPayment(Payment $payment): Factory
    {
        return $this->state(['payment_id' => $payment->id]);
    }
}
