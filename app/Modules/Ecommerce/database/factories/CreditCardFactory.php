<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\CreditCard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    protected $model = CreditCard::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now()->toDateTimeString(),
        ];
    }

    public static function createSuccessTestCard(array $attributes = []): CreditCard
    {
        $attributes = array_merge($attributes, [
            'fingerprint' => '666M5Jc411UObyjY',
            'last_four_digits' => '1111',
            'company_name' => 'Visa',
            'expiration_date' => Carbon::parse('2039-07-16 19:12:46'),
            'external_id' => 'card_1MFjKpKoDqdTNxK1KMdoZCb4',
            'external_customer_id' => 'cus_MpCQ9dc1iGHY67',
            'payment_gateway_name' => 'drumeo'
        ]);
        return CreditCard::factory()->create($attributes);
    }
}
