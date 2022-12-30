<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Product;
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
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 5),
            'start_date' => Carbon::now()->subDays(10)->toDateTimeString(),
            'expiration_date' => Carbon::now()->addDays(10)->toDateTimeString(),
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];
    }

    public static function createUserProduct(
        User $user,
        Product $product,
        Carbon $startTime,
        Carbon $expirationDate,
        array $attributes = []
    ) {
        $attributes = array_merge($attributes, [
            'product_id' => $product,
            'user_id' => $user,
            'created_at' => $startTime,
            'expiration_date' => $expirationDate,
        ]);
        return UserProduct::factory()->create($attributes);
    }
}
