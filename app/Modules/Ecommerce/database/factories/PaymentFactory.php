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
    protected array $externalProviders = [Payment::EXTERNAL_PROVIDER_STRIPE, Payment::EXTERNAL_PROVIDER_PAYPAL, Payment::EXTERNAL_PROVIDER_APPLE, Payment::EXTERNAL_PROVIDER_GOOGLE];

    public function definition(): array
    {
        return [
            'conversion_rate' => '1.00',
            'currency' => 'USD',
            'status' => Payment::STATUS_PAID,
            'total_due' => '100.00',
            'total_paid' => '100.00',
            'type' => Payment::TYPE_INITIAL_ORDER
        ];
    }

    public function withAmount(float $amount): Factory
    {
        $amount = number_format($amount, 2, '.', '');
        return $this->state(['total_due' => $amount, 'total_paid' => $amount]);
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

    /**
     * @throws Exception
     */
    public function withExternalProvider(?string $externalProvider): Factory
    {
        if ($externalProvider && !in_array($externalProvider, $this->externalProviders)) {
            throw new Exception(
                sprintf("Invalid external provider %s. Must be one of %s.", $externalProvider, implode(', ', $this->externalProviders))
            );
        }

        $externalId = match ($externalProvider) {
            Payment::EXTERNAL_PROVIDER_STRIPE => 'ch_'.$this->faker->regexify('[a-zA-Z0-9]{27}'),
            Payment::EXTERNAL_PROVIDER_PAYPAL => $this->faker->regexify('[a-zA-Z0-9]{17}'),
            Payment::EXTERNAL_PROVIDER_APPLE => $this->faker->regexify('\d{15}'),
            Payment::EXTERNAL_PROVIDER_GOOGLE => 'GPA.'.$this->faker->regexify('\d{4}-\d{4}-\d{4}-\d{4}'),
            null => null
        };

        return $this->state([
            'external_provider' => $externalProvider,
            'external_id' => $externalId
        ]);
    }
}
