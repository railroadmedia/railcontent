<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\UserPaymentMethod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class UserPaymentMethodFactory extends Factory
{
    protected $model = UserPaymentMethod::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now()->toDateTimeString(),
        ];
    }

    public static function createPrimarySuccessfulPaymentMethod(
        User $user,
        array $attributes = []
    ): UserPaymentMethod {
        $attributes = array_merge($attributes, [
            'user_id' => $user,
            'payment_method_id' => PaymentMethodFactory::createSuccessPaymentMethod($user),
            'is_primary' => 1
        ]);
        return UserPaymentMethod::factory()->create($attributes);
    }
}
