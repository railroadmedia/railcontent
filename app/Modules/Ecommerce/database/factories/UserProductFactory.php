<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class UserProductFactory extends Factory
{
    protected $model = UserProduct::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => fake()->randomNumber(),
            'quantity' => fake()->numberBetween(1, 5),
            'start_date' => Carbon::now()->subDays(10)->toDateTimeString(),
            'expiration_date' => Carbon::now()->addDays(10)->toDateTimeString(),
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];
    }

}
