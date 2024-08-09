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
     */
    public function run(): void
    {
        //DRUMEO
        Product::where('brand_id', 1)->where('name', 'Rock Drumming Masterclass')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Drum Technique Made Easy')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Independence Made Easy')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Four Weeks To Better Drum Fills')->update(['discounted_price' => 39]);
        Product::where('brand_id', 1)->where('name', 'Beyond Beginner Drumming')->update(['discounted_price' => 50]);
        Product::where('brand_id', 1)->where('name', '30 Day Drummer - Season 3')->update(['discounted_price' => 50]);
        Product::where('brand_id', 1)->where('name', '30 Day Drummer - Season 3')->update(['price' => 127]);
        Product::where('brand_id', 1)->where('name', '30 Day Chops')->update(['discounted_price' => 50]);
        Product::where('brand_id', 1)->where('name', '30 Day Chops')->update(['price' => 127]);
        Product::where('brand_id', 1)->where('name', 'Electrify Your Drumming')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Learn Songs Faster')->update(['discounted_price' => 5]);
        Product::where('brand_id', 1)->where('name', 'Successful Drumming')->update(['discounted_price' => 47]);
        Product::where('brand_id', 1)->where('name', 'New Drummers Start Here')->update(['discounted_price' => 1]);
        Product::where('brand_id', 1)->where('name', 'Methods & Mechanics')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'The Language Of Drumming')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Great Hands For A Lifetime')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Hands Grooves & Fills')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Anatomy Of A Drum Solo')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'In Constant Motion')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Creative Control')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'The Grid')->update(['discounted_price' => 12]);
        Product::where('brand_id', 1)->where('name', 'Beyond The Chops')->update(['discounted_price' => 12]);

        Product::where('brand_id', 1)->where('name', 'Vater Drumeo 5A Drumsticks')->update(['discounted_price' => 9.71]);
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietPad')->update(['discounted_price' => 30]);
        Product::where('brand_id', 1)->where('name', 'The P4 Practice Pad')->update(['discounted_price' => 59]);
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietKick')->update(['discounted_price' => 59]);
        Product::where('brand_id', 1)->where('name', 'Drumeo EarDRUM In-Ear Monitors')->update(['discounted_price' => 112]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Comfort Cover')->update(['discounted_price' => 112]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Tone Control Kit')->update(['discounted_price' => 59]);
        Product::where('brand_id', 1)->where('name', 'The Best Beginner Drum Book')->update(['discounted_price' => 22.49]);
        Product::where('brand_id', 1)->where('name', 'The Drummer’s Toolbox')->update(['discounted_price' => 22.49]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Drum Key')->update(['discounted_price' => 11.25]);
        Product::where('brand_id', 1)->where('name', 'Drumeo StickBag')->update(['discounted_price' => 110]);
        Product::where('brand_id', 1)->where('name', 'Drumeo PadStand')->update(['discounted_price' => 59]);
        Product::where('brand_id', 1)->where('name', 'Easy Rudiments')->update(['discounted_price' => 22.49]);

        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 21]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 39]);
        Product::where('brand_id', 1)->where('product_type_id', 7)->update(['discounted_price' => 39]);

        //PIANOTE
        Product::where('brand_id', 2)->where('name', 'The Power Of Chords')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Improvisation & Musical Freedom')->update(['discounted_price' => 9]);
        Product::where('brand_id', 2)->where('name', 'Worship Piano')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Playing Beautiful Piano')->update(['discounted_price' => 2]);
        Product::where('brand_id', 2)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Piano Technique Made Easy')->update(['discounted_price' => 19]);
        Product::where('brand_id', 2)->where('name', 'De-Stupefy Your Left Hand')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Faster Fingers')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Piano Riffs & Fills')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'New Piano Players Start Here')->update(['discounted_price' => 50]);
        Product::where('brand_id', 2)->where('name', 'New Piano Players Start Here')->update(['price' => 127]);
        Product::where('brand_id', 2)->where('name', 'Easy Chords')->update(['discounted_price' => 50]);
        Product::where('brand_id', 2)->where('name', 'Easy Chords')->update(['price' => 127]);
        Product::where('brand_id', 2)->where('name', '30-Day Blues Piano')->update(['discounted_price' => 50]);
        Product::where('brand_id', 2)->where('name', '30-Day Blues Piano')->update(['price' => 127]);

        Product::where('brand_id', 2)->where('name', 'Classical Method Companion Book')->update(['discounted_price' => 29.25]);
        Product::where('brand_id', 2)->where('name', 'The Most Beautiful Classical Piano Pieces')->update(['discounted_price' => 36.75]);
        Product::where('brand_id', 2)->where('name', 'Pianote Music Theory Poster Bundle')->update(['discounted_price' => 29.25]);
        Product::where('brand_id', 2)->where('name', 'Piano Chords & Scales')->update(['discounted_price' => 29.25]);
        Product::where('brand_id', 2)->where('name', 'Pianote Practice Planner')->update(['discounted_price' => 29.25]);
        Product::where('brand_id', 2)->where('name', 'Chords Poster')->update(['discounted_price' => 2]);
        Product::where('brand_id', 2)->where('name', 'Scales Poster')->update(['discounted_price' => 2]);
        Product::where('brand_id', 2)->where('name', '100 Days of Practice Poster')->update(['discounted_price' => 2]);
        Product::where('brand_id', 2)->where('name', 'Sketchy Mug')->update(['discounted_price' => 9]);
        Product::where('brand_id', 2)->where('name', 'Music Brings Happiness Mug')->update(['discounted_price' => 9]);
        Product::where('brand_id', 2)->where('name', 'The Pianote Christmas Songbook')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Pianote Digital Christmas Songbook')->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('name', 'The Pianote Metronome')->update(['discounted_price' => 59]);
        Product::where('brand_id', 2)->where('name', 'The Prestige Flamed Maple Metronome')->update(['discounted_price' => 299]);

        Product::where('brand_id', 2)->where('product_type_id', 3)->update(['discounted_price' => 17.40]);
        Product::where('brand_id', 2)->where('product_type_id', 4)->update(['discounted_price' => 21]);
        Product::where('brand_id', 2)->where('product_type_id', 5)->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('product_type_id', 7)->update(['discounted_price' => 39]);

        //GUITAREO UPDATES
        Product::where('brand_id', 3)->where('name', 'Acoustic Guitar Made Easy')->update(['discounted_price' => 50]);
        Product::where('brand_id', 3)->where('name', 'Guitar Technique Made Easy')->update(['discounted_price' => 50]);
        Product::where('brand_id', 3)->where('name', 'GuitarQuest')->update(['discounted_price' => 50]);
        Product::where('brand_id', 3)->where('name', 'The Guitar System')->update(['discounted_price' => 50]);
        Product::where('brand_id', 3)->where('name', "Rhythm & Groove")->update(['discounted_price' => 19]);
        Product::where('brand_id', 3)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 19]);

        Product::where('brand_id', 3)->where('name', "Chords & Scales Poster")->update(['discounted_price' => 9]);
        Product::where('brand_id', 3)->where('name', "Guitarist's Survival Kit")->update(['discounted_price' => 66.75]);
        Product::where('brand_id', 3)->where('name', "Guitareo Survival Guide")->update(['discounted_price' => 14.25]);

        //SINGEO UPDATES
        Product::where('brand_id', 4)->where('name', 'The Singing Starter Kit')->update(['discounted_price' => 9]);
        Product::where('brand_id', 4)->where('name', 'The Essential Guide to Beautiful Harmonies')->update(['discounted_price' => 9]);

        Product::where('brand_id', 4)->where('name', 'Do Re Mi Tumbler')->update(['discounted_price' => 21.75]);
        Product::where('brand_id', 4)->where('name', 'Rockstar Mug')->update(['discounted_price' => 9]);
        Product::where('brand_id', 4)->where('name', 'Vowel Practice Poster')->update(['discounted_price' => 9]);

        Product::where('brand_id', 4)->where('product_type_id', 4)->update(['discounted_price' => 21]);
        Product::where('brand_id', 4)->where('product_type_id', 5)->update(['discounted_price' => 39]);
        Product::where('brand_id', 4)->where('product_type_id', 7)->update(['discounted_price' => 39]);
    }
}
