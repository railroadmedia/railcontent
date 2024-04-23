<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'quantity' => 1,
            'initial_price' => function (array $attributes) {
                return Product::find($attributes['product_id'])->price;
            },
            'total_discounted' => 0,
            'final_price' => function (array $attributes) {
                return Product::find($attributes['product_id'])->price;
            },
        ];
    }
}
