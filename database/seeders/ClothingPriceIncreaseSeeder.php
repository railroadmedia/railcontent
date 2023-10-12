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
        Product::where('product_type_id', 4)->update(['price' => 35]);
        Product::where('product_type_id', 5)->update(['price' => 65]);
    }
}
