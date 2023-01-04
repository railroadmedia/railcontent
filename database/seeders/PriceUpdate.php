<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SizeChart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::where('brand_id', 4)->where('name', 'Member Do Re Mi Tumbler')->update(['discounted_price' => 29]);
        Product::where('brand_id', 3)->where('name', 'Member Guitareo Survival Guide')->update(['discounted_price' => 19]);
        Product::where('brand_id', 2)->where('name', 'Member Pianote Practice Planner')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', '100 Days of Practice Poster')->update(['discounted_price' => 9]);
        Product::where('brand_id', 2)->where('name', 'Member Piano Chords & Scales')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Member Classical Piano Pieces')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Pianote Digital Christmas Songbook')->update(['discounted_price' => 10]);
        Product::where('brand_id', 4)->where('name', 'Singeo Membership')->update(['discounted_price' => 240]);
        Product::where('brand_id', 1)->where('name', 'Moeller Method Secrets')->update(['discounted_price' => 29]);
        Product::where('brand_id', 1)->where('name', 'Moeller Method Secrets')->update(['price' => 29]);
        Product::where('brand_id', 1)->where('name', 'Maximum Meytal')->update(['discounted_price' => 127]);
        Product::where('brand_id', 1)->where('name', 'Maximum Meytal')->update(['price' => 127]);
        Product::where('brand_id', 1)->where('name', 'Latin Drumming System')->update(['discounted_price' => 77]);
        Product::where('brand_id', 1)->where('name', 'Latin Drumming System')->update(['price' => 77]);
        Product::where('brand_id', 1)->where('name', 'Jazz Drumming System')->update(['discounted_price' => 77]);
        Product::where('brand_id', 1)->where('name', 'Jazz Drumming System')->update(['price' => 77]);
        Product::where('brand_id', 1)->where('name', 'Drum Tuning System')->update(['discounted_price' => 27]);
        Product::where('brand_id', 1)->where('name', 'Drum Tuning System')->update(['price' => 27]);
        Product::where('brand_id', 1)->where('name', 'Drum Rudiment System')->update(['discounted_price' => 147]);
        Product::where('brand_id', 1)->where('name', 'Drum Play-Along System')->update(['discounted_price' => 77]);
        Product::where('brand_id', 1)->where('name', 'Drum Play-Along System')->update(['price' => 77]);
        Product::where('brand_id', 1)->where('name', 'Drum Fill System')->update(['discounted_price' => 147]);
        Product::where('brand_id', 1)->where('name', 'Drum Fill System')->update(['price' => 147]);
        Product::where('brand_id', 1)->where('name', 'Cobus Method')->update(['discounted_price' => 147]);
        Product::where('brand_id', 1)->where('name', 'Cobus Method')->update(['price' => 147]);
        Product::where('brand_id', 1)->where('name', 'Bass Drum Secrets')->update(['discounted_price' => 147]);
        Product::where('brand_id', 1)->where('name', 'Bass Drum Secrets')->update(['price' => 147]);
        Product::where('brand_id', 3)->where('name', 'Guitareo Membership')->update(['discounted_price' => 240]);
        Product::where('brand_id', 2)->where('name', 'Classical Piano')->update(['discounted_price' => 47]);
        Product::where('brand_id', 2)->where('name', 'Pianote Membership')->update(['discounted_price' => 240]);
        Product::where('brand_id', 1)->where('name', 'Drumming System')->update(['discounted_price' => 247]);
        Product::where('brand_id', 1)->where('name', '30 Day Drummer')->update(['discounted_price' => 97]);
        Product::where('brand_id', 1)->where('name', 'Last Minute Gift for Drummers')->update(['discounted_price' => 127]);
        Product::where('brand_id', 1)->where('name', 'Drumeo annual Membership')->update(['discounted_price' => 240]);
    }
}
