<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Address;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition(): array
    {
        return [
            'method_type' => 'credit_card',
            'currency' => 'USD',
            'created_at' => Carbon::now()->toDateTimeString(),
        ];
    }

    public static function createSuccessPaymentMethod(
        User $user,
        array $attributes = []
    ): PaymentMethod {
        $attributes = array_merge($attributes, [
            'method_type' => 'credit_card',
            'credit_card_id' => CreditCardFactory::createSuccessTestCard(),
            'currency' => 'USD',
            'billing_address_id' => AddressFactory::createBillingAddress($user),
        ]);
        return PaymentMethod::factory()->create($attributes);
    }
}
