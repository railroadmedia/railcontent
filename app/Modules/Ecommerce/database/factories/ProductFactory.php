<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Enums\Interval;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'sku' => fake()->word . rand(100000, 10000000),
            'fulfillment_sku' => fake()->word . rand(100000, 10000000),
            'inventory_control_sku' => fake()->word . rand(100000, 10000000),
            'price' => fake()->numberBetween(1, 1000),
            'type' => fake()->randomElement(
                [
                    Product::TYPE_DIGITAL_ONE_TIME,
                    Product::TYPE_DIGITAL_SUBSCRIPTION,
                    Product::TYPE_PHYSICAL_ONE_TIME,
                ]
            ),
            'active' => fake()->randomElement([0, 1]),
            'category' => fake()->word,
            'description' => fake()->text,
            'thumbnail_url' => fake()->imageUrl(),
            'sales_page_url' => fake()->url,
            'is_physical' => fake()->randomElement([0, 1]),
            'weight' => fake()->numberBetween(0, 100),
            'subscription_interval_type' => fake()->randomElement(
                [
                    config('ecommerce.interval_type_daily'),
                    config('ecommerce.interval_type_monthly'),
                    config('ecommerce.interval_type_yearly'),
                ]
            ),
            'subscription_interval_count' => fake()->numberBetween(0, 12),
            'stock' => fake()->numberBetween(100, 1000),
            'auto_decrement_stock' => fake()->randomElement([0, 1]),
            'brand' => config('ecommerce.brand'),
            'note' => fake()->text,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
            'public_stock_count' => fake()->numberBetween(1, 1000),
            'digital_access_time_interval_length' => fake()->numberBetween(0, 12),
            'digital_access_time_type' => fake()->text,
            'digital_access_time_interval_type' => fake()->text,
            'digital_access_type' => fake()->text,
            'digital_access_permission_names' => fake()->text,
        ];
    }

    public static function createSubscriptionProduct(DigitalAccessType $accessType, Interval $interval, float $price,
        array $attributes = []): Product
    {
        $attributes = array_merge($attributes, [
            'price' => $price,
            'type' => Product::TYPE_DIGITAL_SUBSCRIPTION,
            'digital_access_type' => $accessType,
            'digital_access_time_interval_type' => $interval,
        ]);
        return Product::factory()->create($attributes);
    }

}
