<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SizeChart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleRevertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DRUMEO UPDATES
        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 25]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 59]);
    }
}
