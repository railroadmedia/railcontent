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
        Product::where('brand_id', 1)->where('name', 'Rock Drumming Masterclass')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Drum Technique Made Easy')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'Independence Made Easy')->update(['discounted_price' => 79]);
        Product::where('brand_id', 1)->where('name', 'New Drummers Start Here')->update(['discounted_price' => 5]);
        Product::where('brand_id', 1)->where('name', 'Learn Songs Faster')->update(['discounted_price' => 5]);
        Product::where('brand_id', 1)->where('name', 'Four Weeks To Better Drum Fills')->update(['discounted_price' => 18]);
        Product::where('brand_id', 1)->where('name', 'Electrify Your Drumming')->update(['discounted_price' => 47]);
        Product::where('brand_id', 1)->where('name', 'Beyond Beginner Drumming')->update(['discounted_price' => 97]);
        Product::where('brand_id', 1)->where('name', 'Successful Drumming')->update(['discounted_price' => 47]);
        Product::where('brand_id', 1)->where('name', 'Drumeo EarDRUM In-Ear Monitors')->update(['discounted_price' => 129]);
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietPad')->update(['discounted_price' => 29]);
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietKick')->update(['discounted_price' => 59]);
        Product::where('brand_id', 1)->where('name', 'The P4 Practice Pad')->update(['discounted_price' => 65]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Tone Control Kit')->update(['discounted_price' => 69]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Comfort Cover')->update(['discounted_price' => 49]);
        Product::where('brand_id', 1)->where('name', 'Vater Drumeo 5A Drumsticks')->update(['discounted_price' => 9.95]);
        Product::where('brand_id', 1)->where('name', 'The Best Beginner Drum Book')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'The Drummer’s Toolbox')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'Drummer Towels')->update(['discounted_price' => 15]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Water Bottle')->update(['discounted_price' => 9.95]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Coffee Mug')->update(['discounted_price' => 9.95]);
        Product::where('brand_id', 1)->where('name', 'Methods & Mechanics')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'The Language Of Drumming')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'Great Hands For A Lifetime')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'Hands Grooves & Fills')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'Anatomy Of A Drum Solo')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'In Constant Motion')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'Creative Control')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'The Grid')->update(['discounted_price' => 19.99]);
        Product::where('brand_id', 1)->where('name', 'Beyond The Chops')->update(['discounted_price' => 19.99]);

        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 15]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 39]);
        Product::where('brand_id', 1)->where('product_type_id', 3)->update(['discounted_price' => 15]);

        //PIANOTE UPDATES
        Product::where('brand_id', 2)->where('name', 'De-Stupefy Your Left Hand')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Piano Riffs & Fills')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Faster Fingers')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Piano Technique Made Easy')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'The Power Of Chords')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Improvisation & Musical Freedom')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Playing Beautiful Piano')->update(['discounted_price' => 4]);
        Product::where('brand_id', 2)->where('name', 'Scales Poster')->update(['discounted_price' => 9]);
        Product::where('brand_id', 2)->where('name', 'Chords Poster')->update(['discounted_price' => 9]);
        Product::where('brand_id', 2)->where('name', 'Pianote Practice Planner')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Piano Chords & Scales')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Worship Piano')->update(['discounted_price' => 39]);
        Product::where('brand_id', 2)->where('name', 'Pianote Headphones')->update(['discounted_price' => 169]);
        Product::where('brand_id', 2)->where('name', 'Pianote Christmas Songbook')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Member Pianote Christmas Songbook')->update(['discounted_price' => 29]);
        Product::where('brand_id', 2)->where('name', 'Classical Piano Pieces')->update(['discounted_price' => 39]);

        Product::where('brand_id', 2)->where('product_type_id', 3)->update(['discounted_price' => 19]);
        Product::where('brand_id', 2)->where('product_type_id', 4)->update(['discounted_price' => 5]);
        Product::where('brand_id', 2)->where('product_type_id', 5)->update(['discounted_price' => 19]);
        Product::where('brand_id', 2)->where('name', 'Sketchy Mug')->update(['discounted_price' => 12]);
        Product::where('brand_id', 2)->where('name', 'Music Brings Happiness Mug')->update(['discounted_price' => 12]);

        Product::where('brand_id', 2)->where('name', 'The Unlimited Lessons Bundle')->update(['overview' => 'The Unlimited Lessons Bundle gives you just that - unlimited piano lessons. Watch as many as you like, as often as you like.

Learn your favorite songs in the comfort of your own home, whenever you want. Impress your family and friends with your piano playing - for a tiny fraction of the cost of private lessons.

And get support and feedback from real teachers who will help you every step of the way.

This bundle is for new members only. You’ll pay just $129 for your first year (recurring price will be $240/year).']);

        //GUITAREO UPDATES
        Product::where('brand_id', 3)->where('name', 'GuitarQuest')->update(['discounted_price' => 60]);
        Product::where('brand_id', 3)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 9]);
        Product::where('brand_id', 3)->where('name', 'Acoustic Guitar Made Easy')->update(['discounted_price' => 49]);
        Product::where('brand_id', 3)->where('name', 'Guitar Technique Made Easy')->update(['discounted_price' => 49]);
        Product::where('brand_id', 3)->where('name', 'The Guitar System')->update(['discounted_price' => 27]);
        Product::where('brand_id', 3)->where('name', "Guitarist's Survival Kit")->update(['discounted_price' => 69]);
        Product::where('brand_id', 3)->where('name', "Rhythm & Groove")->update(['discounted_price' => 27]);
        Product::where('brand_id', 3)->where('name', "Guitareo Survival Guide")->update(['discounted_price' => 5]);
        Product::where('brand_id', 3)->where('name', "The Build A Song Bundle")->update(['discounted_price' => 97]);

        //SINGEO UPDATES
        Product::where('brand_id', 4)->where('name', 'The Singing Starter Kit')->update(['discounted_price' => 5]);
        Product::where('brand_id', 4)->where('name', 'The Essential Guide to Beautiful Harmonies')->update(['discounted_price' => 9]);
        Product::where('brand_id', 4)->where('name', 'Do Re Mi Tumbler')->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('name', 'Rockstar Mug')->update(['discounted_price' => 9]);
        Product::where('brand_id', 4)->where('name', 'Vowel Practice Poster')->update(['discounted_price' => 5]);
        Product::where('brand_id', 4)->where('name', 'Retro T-shirt')->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('product_type_id', 4)->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('product_type_id', 5)->update(['discounted_price' => 39]);
    }
}
