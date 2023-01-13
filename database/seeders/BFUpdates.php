<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BFUpdates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DRUMEO UPDATES
        Product::where('brand_id', 1)->where('name', 'Rock Drumming Masterclass')->update(['discounted_price' => 197]);
        Product::where('brand_id', 1)->where('name', 'Drum Technique Made Easy')->update(['discounted_price' => 197]);
        Product::where('brand_id', 1)->where('name', 'Independence Made Easy')->update(['discounted_price' => 197]);
        Product::where('brand_id', 1)->where('name', 'New Drummers Start Here')->update(['discounted_price' => 7]);
        Product::where('brand_id', 1)->where('name', 'Learn Songs Faster')->update(['discounted_price' => 19]);
        Product::where('brand_id', 1)->where('name', 'Four Weeks To Better Drum Fills')->update(['discounted_price' => 97]);
        Product::where('brand_id', 1)->where('name', 'Electrify Your Drumming')->update(['discounted_price' => 97]);
        Product::where('brand_id', 1)->where('name', 'Beyond Beginner Drumming')->update(['discounted_price' => 127]);
        Product::where('brand_id', 1)->where('name', 'Successful Drumming')->update(['discounted_price' => 247]);
        Product::where('brand_id', 1)->where('name', 'Drumeo EarDRUM In-Ear Monitors')->update(['discounted_price' => 149]);
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietPad')->update(['discounted_price' => 35]);
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietKick')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'The P4 Practice Pad')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Tone Control Kit')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Comfort Cover')->update(['discounted_price' => 149]);
        Product::where('brand_id', 1)->where('name', 'Vater Drumeo 5A Drumsticks')->update(['discounted_price' => 12.95]);
        Product::where('brand_id', 1)->where('name', 'The Best Beginner Drum Book')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'The Drummer’s Toolbox')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'Drummer Towels')->update(['discounted_price' => 19]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Water Bottle')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Coffee Mug')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Methods & Mechanics')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'The Language Of Drumming')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'Great Hands For A Lifetime')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'Hands Grooves & Fills')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'Anatomy Of A Drum Solo')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'In Constant Motion')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'Creative Control')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'The Grid')->update(['discounted_price' => 29.99]);
        Product::where('brand_id', 1)->where('name', 'Beyond The Chops')->update(['discounted_price' => 29.99]);

        Product::where('brand_id', 1)->where('product_type_id', 3)->update(['discounted_price' => 19]);
        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 25]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 59]);

        //PIANOTE UPDATES
        Product::where('brand_id', 2)->where('name', 'De-Stupefy Your Left Hand')->update(['discounted_price' => 99]);
        Product::where('brand_id', 2)->where('name', 'Piano Riffs & Fills')->update(['discounted_price' => 99]);
        Product::where('brand_id', 2)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 99]);
        Product::where('brand_id', 2)->where('name', 'Faster Fingers')->update(['discounted_price' => 99]);
        Product::where('brand_id', 2)->where('name', 'Piano Technique Made Easy')->update(['discounted_price' => 120]);
        Product::where('brand_id', 2)->where('name', 'The Power Of Chords')->update(['discounted_price' => 97]);
        Product::where('brand_id', 2)->where('name', 'Improvisation & Musical Freedom')->update(['discounted_price' => 47]);
        Product::where('brand_id', 2)->where('name', 'Playing Beautiful Piano')->update(['discounted_price' => 7]);
        Product::where('brand_id', 2)->where('name', 'Worship Piano')->update(['discounted_price' => 99]);
        Product::where('brand_id', 2)->where('name', 'Scales Poster')->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('name', 'Chords Poster')->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('name', 'Pianote Practice Planner')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Piano Chords & Scales')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Pianote Headphones')->update(['discounted_price' => 189]);
        Product::where('brand_id', 2)->where('name', 'Pianote Christmas Songbook')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Member Pianote Christmas Songbook')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Classical Piano Pieces')->update(['discounted_price' => 19]);
        Product::where('brand_id', 2)->where('name', 'Sketchy Mug')->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('name', 'Music Brings Happiness Mug')->update(['discounted_price' => 5]);

        Product::where('brand_id', 2)->where('product_type_id', 3)->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('product_type_id', 4)->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('product_type_id', 5)->update(['discounted_price' => 19]);

        //GUITAREO UPDATES
        Product::where('brand_id', 3)->where('name', 'GuitarQuest')->update(['discounted_price' => 197]);
        Product::where('brand_id', 3)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 97]);
        Product::where('brand_id', 3)->where('name', 'Acoustic Guitar Made Easy')->update(['discounted_price' => 197]);
        Product::where('brand_id', 3)->where('name', 'Guitar Technique Made Easy')->update(['discounted_price' => 197]);
        Product::where('brand_id', 3)->where('name', 'The Guitar System')->update(['discounted_price' => 197]);
        Product::where('brand_id', 3)->where('name', "Guitarist's Survival Kit")->update(['discounted_price' => 89]);
        Product::where('brand_id', 3)->where('name', "Rhythm & Groove")->update(['discounted_price' => 47]);
        Product::where('brand_id', 3)->where('name', "Guitareo Survival Guide")->update(['discounted_price' => 19]);
        Product::where('brand_id', 3)->where('name', "The Build A Song Bundle")->update(['discounted_price' => 97]);

        //SINGEO UPDATES
        Product::where('brand_id', 4)->where('name', 'The Singing Starter Kit')->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('name', 'The Essential Guide to Beautiful Harmonies')->update(['discounted_price' => 27]);
        Product::where('brand_id', 4)->where('name', 'Do Re Mi Tumbler')->update(['discounted_price' => 29]);
        Product::where('brand_id', 4)->where('name', 'Rockstar Mug')->update(['discounted_price' => 12]);
        Product::where('brand_id', 4)->where('name', 'Vowel Practice Poster')->update(['discounted_price' => 12]);

        Product::where('brand_id', 4)->where('product_type_id', 4)->update(['discounted_price' => 29]);
        Product::where('brand_id', 4)->where('product_type_id', 5)->update(['discounted_price' => 59]);



        //ETC
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
        Product::where('brand_id', 2)->where('name', 'Pianote Membership')->update(['discounted_price' => 240]);
        Product::where('brand_id', 2)->where('name', 'Classical Piano')->update(['discounted_price' => 47]);
        Product::where('brand_id', 1)->where('name', 'Drumming System')->update(['discounted_price' => 247]);
        Product::where('brand_id', 1)->where('name', '30 Day Drummer')->update(['discounted_price' => 97]);
        Product::where('brand_id', 1)->where('name', 'Last Minute Gift for Drummers')->update(['discounted_price' => 127]);
        Product::where('brand_id', 1)->where('name', 'Drumeo annual Membership')->update(['discounted_price' => 240]);
    }
}
