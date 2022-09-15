<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'brand' => 'test',
            'type' => Subscription::TYPE_SUBSCRIPTION,
            'customer_id' => null,
            'order_id' => null,
            'product_id' => fake()->randomNumber(),
            'is_active' => 1,
            'stopped' => 0,
            'start_date' => Carbon::now()
                ->toDateTimeString(),
            'paid_until' => Carbon::now()
                ->addYear(1)
                ->toDateTimeString(),
            'canceled_on' => null,
            'note' => fake()->text,
            'total_price' => fake()->randomNumber(3),
            'tax' => 0,
            'currency' => 'USD',
            'interval_type' => 'year',
            'interval_count' => fake()->randomNumber(),
            'total_cycles_due' => fake()->randomNumber(),
            'total_cycles_paid' => fake()->randomNumber(),
            'renewal_attempt' => 0,
            'payment_method_id' => fake()->randomNumber(),
            'created_at' => Carbon::now()
                ->toDateTimeString(),
            'updated_at' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
            'cancellation_reason' => null,
        ];
    }

}
