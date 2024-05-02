<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessCodeFactory extends Factory
{
    protected $model = AccessCode::class;

    public function definition(): array
    {
        return [
            'code' => AccessCode::generateNewCode(),
            'is_claimed' => 0,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];
    }

    public static function createAccessCode(
        Product $product,
        array $attributes = []
    ): AccessCode {
        $attributes = array_merge($attributes, [
            'product_ids' => serialize([(int)$product->id]),
            'brand' => $product->brand
        ]);
        return AccessCode::factory()->create($attributes);
    }
}
