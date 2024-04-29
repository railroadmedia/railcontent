<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Payment;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    protected array $types = [
        Payment::TYPE_INITIAL_ORDER,
        Payment::TYPE_PAYMENT_PLAN,
        Payment::TYPE_SUBSCRIPTION_RENEWAL,
        Payment::TYPE_APPLE_SUBSCRIPTION_RENEWAL,
        Payment::TYPE_GOOGLE_SUBSCRIPTION_RENEWAL,
        Payment::TYPE_PAYPAL_SUBSCRIPTION_RENEWAL
    ];
    protected array $statuses = [Payment::STATUS_PAID, Payment::STATUS_FAILED, Payment::STATUS_REFUNDED];

    public function definition(): array
    {
        return [
            'currency' => 'USD',
            'status' => Payment::STATUS_PAID,
            'total_due' => 100.00,
            'type' => Payment::TYPE_INITIAL_ORDER
        ];
    }

    /**
     * @throws Exception
     */
    public function withType(string $type): Factory
    {
        if (!in_array($type, $this->types)) {
            throw new Exception(sprintf("Invalid type %s. Must be one of %s.", $type, implode(', ', $this->types)));
        }

        return $this->state(['type' => $type]);
    }

    /**
     * @throws Exception
     */
    public function withStatus(string $status): Factory
    {
        if (!in_array($status, $this->statuses)) {
            throw new Exception(
                sprintf("Invalid status %s. Must be one of %s.", $status, implode(', ', $this->statuses))
            );
        }

        return $this->state(['status' => $status]);
    }
}
