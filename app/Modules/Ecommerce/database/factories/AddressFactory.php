<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Address;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'type' => 'billing',
            'brand' => 'drumeo',
            'region' => 'British Collumbia',
            'country' => 'Canada',
            'created_at' => Carbon::now()->toDateTimeString(),
        ];
    }

    public static function createBillingAddress(
        User $user,
        array $attributes = []
    ): Address {
        $attributes = array_merge($attributes, [
            'user_id' => $user,
            'type' => 'billing'
        ]);
        return Address::factory()->create($attributes);
    }

    public static function createShippingAddress(
        User $user,
        array $attributes = []
    ): Address {
        $attributes = array_merge($attributes, [
            'user_id' => $user,
            'type' => 'shipping'
        ]);
        return Address::factory()->create($attributes);
    }
}
