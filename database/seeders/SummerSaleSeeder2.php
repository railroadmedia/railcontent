<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SizeChart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SummerSaleSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DRUMEO UPDATES
        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 12.50]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 29.50]);
    }
}
