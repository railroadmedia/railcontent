<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothingPriceIncreaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::where('product_type_id', 4)->update(['discounted_price' => 35]);
        Product::where('product_type_id', 5)->update(['discounted_price' => 65]);
    }
}
