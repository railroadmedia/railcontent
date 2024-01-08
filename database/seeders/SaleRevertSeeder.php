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
//        all shirts
        Product::where('product_type_id', 4)->update(['discounted_price' => 35]);
//        all hoodies
        Product::where('product_type_id', 5)->update(['discounted_price' => 65]);
//        all sweaters
        Product::where('product_type_id', 7)->update(['discounted_price' => 45]);

        Product::where('name', '30-Day Drummer Plaid Shirt')->update(['discounted_price' => 65]);
        Product::where('name', 'Drumeo Yuletide Knit Sweater')->update(['discounted_price' => 69]);
        Product::where('name', 'Pianote Yuletide Knit Sweater')->update(['discounted_price' => 69]);
        Product::where('name', '30-Day Drummer Satin Tour Jacket')->update(['discounted_price' => 89]);
    }
}
