<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FBUpdates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DRUMEO UPDATES
        Product::where('name', 'Rock Drumming Masterclass')->update(['discounted_price' => 79]);
        Product::where('name', 'Drum Technique Made Easy')->update(['discounted_price' => 79]);
        Product::where('name', 'Independence Made Easy')->update(['discounted_price' => 79]);
        Product::where('name', 'New Drummers Start Here')->update(['discounted_price' => 5]);
        Product::where('name', 'Learn Songs Faster')->update(['discounted_price' => 5]);
        Product::where('name', 'Four Weeks To Better Drum Fills')->update(['discounted_price' => 18]);
        Product::where('name', 'Electrify Your Drumming')->update(['discounted_price' => 47]);
        Product::where('name', 'Beyond Beginner Drumming')->update(['discounted_price' => 97]);
        Product::where('name', 'Successful Drumming')->update(['discounted_price' => 47]);
        Product::where('name', 'Drumeo EarDRUM In-Ear Monitors')->update(['discounted_price' => 129]);
        Product::where('name', 'Drumeo QuietPad')->update(['discounted_price' => 29]);
        Product::where('name', 'Drumeo QuietKick')->update(['discounted_price' => 67]);
        Product::where('name', 'The P4 Practice Pad')->update(['discounted_price' => 65]);
        Product::where('name', 'Drumeo Tone Control Kit')->update(['discounted_price' => 59]);
        Product::where('name', 'Drumeo Comfort Cover')->update(['discounted_price' => 49]);
        Product::where('name', 'Vater Drumeo 5A Drumsticks')->update(['discounted_price' => 9.95]);
        Product::where('name', 'The Best Beginner Drum Book')->update(['discounted_price' => 19.99]);
        Product::where('name', 'The Drummer’s Toolbox')->update(['discounted_price' => 19.99]);
        Product::where('name', 'Drummer Towels')->update(['discounted_price' => 15]);
        Product::where('name', 'Drumeo Water Bottle')->update(['discounted_price' => 9.95]);
        Product::where('name', 'Drumeo Coffee Mug')->update(['discounted_price' => 9.95]);

        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 5]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 39]);
        Product::where('brand_id', 1)->where('product_type_id', 3)->update(['discounted_price' => 15]);

        //GUITAREO UPDATES
        Product::where('name', 'GuitarQuest')->update(['discounted_price' => 97]);
        Product::where('name', '500 Songs In 5 Days')->update(['discounted_price' => 29]);
        Product::where('name', 'Acoustic Guitar Made Easy')->update(['discounted_price' => 49]);
        Product::where('name', 'Guitar Technique Made Easy')->update(['discounted_price' => 49]);
        Product::where('name', 'The Guitar System')->update(['discounted_price' => 49]);
    }
}
