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
        $product_id = Product::where('brand_id', 2)->where('name', 'The Unlimited Lessons Bundle')->first()->id;
        Bundle::where('bundle_id', $product_id)->delete();

        $bundles = [
              [
                  'name' => 'Pianote Membership',
                  'free_bonus' => false,
                  'lifetime_access' => false,
              ],
            [
                'name' => 'Piano Chords & Scales',
                'free_bonus' => true,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Pianote Practice Planner',
                'free_bonus' => true,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Classical Piano Pieces',
                'free_bonus' => true,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Chords Poster',
                'free_bonus' => true,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Scales Poster',
                'free_bonus' => true,
                'lifetime_access' => false,
            ],
            [
                'name' => 'The Power of Chords',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => '',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'Improvisation & Musical Freedom',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'Playing Beautiful Piano',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'Piano Riffs & Fills',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'Piano Technique Made Easy',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'De-Stupefy Your Left Hand',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'Worship Piano',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
            [
                'name' => 'Faster Fingers',
                'free_bonus' => true,
                'lifetime_access' => true,
            ],
        ];

        foreach($bundles as $key => $bundle){
            $product_id = Product::where('name', '=', $bundle['name'])->where('brand_id', '=', 2)->first()->id;

            Bundle::create([
                'bundle_id' => $product_id,
                'product_id' => $product_id,
                'free_bonus' => $bundle['free_bonus'],
                'lifetime_access' => $bundle['lifetime_access'],
                'order_number' => $key
            ]);
        }

        $product_id = Product::where('brand_id', 2)->where('name', 'The Book Bundle')->first()->id;
        Bundle::where('bundle_id', $product_id)->delete();

        $bundles = [
            [
                'name' => 'Piano Chords & Scales',
                'free_bonus' => false,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Classical Piano Pieces',
                'free_bonus' => false,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Pianote Practice Planner',
                'free_bonus' => false,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Chords Poster',
                'free_bonus' => false,
                'lifetime_access' => false,
            ],
            [
                'name' => 'Scales Poster',
                'free_bonus' => false,
                'lifetime_access' => false,
            ],
        ];

        foreach($bundles as $key => $bundle){
            $product_id = Product::where('name', '=', $bundle['name'])->where('brand_id', '=', 2)->first()->id;

            Bundle::create([
                'bundle_id' => $product_id,
                'product_id' => $product_id,
                'free_bonus' => $bundle['free_bonus'],
                'lifetime_access' => $bundle['lifetime_access'],
                'order_number' => $key
            ]);
        }

        //GUITAREO UPDATES
        Product::where('brand_id', 3)->where('name', 'GuitarQuest')->update(['discounted_price' => 60]);
        Product::where('brand_id', 3)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 9]);
        Product::where('brand_id', 3)->where('name', 'Acoustic Guitar Made Easy')->update(['discounted_price' => 49]);
        Product::where('brand_id', 3)->where('name', 'Guitar Technique Made Easy')->update(['discounted_price' => 49]);
        Product::where('brand_id', 3)->where('name', 'The Guitar System')->update(['discounted_price' => 27]);
        Product::where('brand_id', 3)->where('name', "Guitarist's Survival Kit")->update(['discounted_price' => 69]);
        Product::where('brand_id', 3)->where('name', "Rhythm & Groove")->update(['discounted_price' => 27]);
        Product::where('brand_id', 3)->where('name', "Guitareo Survival Guide")->update(['discounted_price' => 5]);

        //SINGEO UPDATES
        Product::where('brand_id', 4)->where('name', 'The Singing Starter Kit')->update(['discounted_price' => 5]);
        Product::where('brand_id', 4)->where('name', 'The Essential Guide to Beautiful Harmonies')->update(['discounted_price' => 9]);
        Product::where('brand_id', 4)->where('name', 'Do Re Mi Tumbler')->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('name', 'Rockstar Mug')->update(['discounted_price' => 9]);
        Product::where('brand_id', 4)->where('name', 'Vowel Practice Poster')->update(['discounted_price' => 5]);
        Product::where('brand_id', 4)->where('name', 'Retro T-shirt')->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('product_type_id', 4)->update(['discounted_price' => 19]);
        Product::where('brand_id', 4)->where('product_type_id', 5)->update(['discounted_price' => 39]);

        //BUNDLE UPDATES
        $bundles = [
            //DRUMEO
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Ultimate Lessons Bundle',
                'slug' => 'bundle-ultimate-lessons',
                'sku' => 'products[DLM]=1,year,1&amp;products[quietpad]=1&amp;products[Drumeo-VaterSticks]=1&amp;products[drum-technique-made-easy-pack]=1&amp;products[four-weeks-to-better-drum-fills]=1&amp;products[GHFAL-DIGI]=1&amp;products[SD-DIGI]=1&amp;products[rock-drumming-masterclass-pack]=1&amp;products[independence-made-easy-pack]=1&amp;products[electrify-your-drumming]=1&amp;products[learn-songs-faster-pack]=1&amp;locked=true" data-base-url="/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&amp;products[quietpad]=1&amp;products[Drumeo-VaterSticks]=1&amp;products[drum-technique-made-easy-pack]=1&amp;products[four-weeks-to-better-drum-fills]=1&amp;products[GHFAL-DIGI]=1&amp;products[SD-DIGI]=1&amp;products[rock-drumming-masterclass-pack]=1&amp;products[independence-made-easy-pack]=1&amp;products[electrify-your-drumming]=1&amp;products[learn-songs-faster-pack]=1&amp;locked=true',
                'meta_desc' => 'The Biggest Drumeo Discount EVER + 10 Free Bonuses',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/ultimate-lessons-fb-share-image.jpg',
                'price' => 1468.94,
                'discounted_price' => 240,
                'special_text' => '',
                'page_logo' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/ultimate-lessons-bundle-black.png',
                'header_text' => 'The Biggest Drumeo Discount EVER + 10 Free Bonuses',
                'video_src' => '//player.vimeo.com/video/772644649',
                'images' => [
                ],
                'spread' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/ultimate-bundle-spread.png',
                'overview' => 'The Ultimate Lessons Bundle is your chance to get unlimited drum lessons for a year at **the lowest price ever.**

You’ll get $1228.94 in FREE bonuses (including an ultra-quiet practice pad & drumsticks).

That breaks down to just $20/month to learn the drums with legendary instructors, access 5,000+ note-for-note breakdowns of famous drumming songs, and get personalized support every step of the way.

If you’ve always wanted to learn the drums, are getting BACK into drumming, or are ready to take your playing to the next level, this is the bundle for YOU.

Scroll down to see everything included with the Ultimate Lessons Bundle.',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Drumeo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Drumeo QuietPad',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Drumeo QuietKick',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Vater Drumeo 5A Drumsticks',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Drumeo Rudiments Poster',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Rock Drumming Masterclass',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Drum Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Independence Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Successful Drumming',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Electrify Your Drumming',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Four Weeks To Better Drum Fills',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Great Hands For A Lifetime',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Learn Songs Faster',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Practice Anywhere Bundle',
                'slug' => 'bundle-practice-anywhere',
                'sku' => 'products[practicepad]=1&products[Drumeo-VaterSticks]=1&products[rudiments-poster]=1',
                'meta_desc' => 'Improve your rudiments & stickings on the fly.',
                'meta_img' => 'https://i.vimeocdn.com/video/1554531059-c7c5e2ba1eeadebdb604459ef6527d5afb6ea8c91d057880342efca2f90df414-d_1200.jpg',
                'price' => 98.95,
                'discounted_price' => 79,
                'special_text' => '',
                'page_logo' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-bundle-black.png',
                'header_text' => 'Improve your rudiments & stickings on the fly.',
                'video_src' => '//player.vimeo.com/video/773981652',
                'images' => [
                ],
                'overview' => 'Run your rudiments anytime day or night & develop silky-smooth hands on the kit.

The Practice Anywhere Bundle includes the P4 Practice Pad – the only practice pad that simulates the feels of a REAL drum set – fresh drumsticks, and the all NEW Drumeo Rudiments poster.

You’ll have everything you need to improve your hands around the drums.',
                'sold_out' => false,
                'guaranteed' => false,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'The P4 Practice Pad',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Vater Drumeo 5A Drumsticks',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Drumeo Rudiments Poster',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Perfect Gift Bundle',
                'slug' => 'bundle-perfect-gift',
                'sku' => 'products[PASS-12]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=1&locked=true',
                'meta_desc' => 'Need the perfect gift idea for YOU or a drummer you know?',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/perfect-gift-fb-share-image.jpg',
                'price' => 240,
                'discounted_price' => 0,
                'special_text' => '+$91.95 In Bonuses',
                'page_logo' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/perfect-gift-bundle-black.png',
                'header_text' => 'The perfect gift for any drummer. (Unlimited drum lessons + free bonuses!)',
                'video_src' => '//player.vimeo.com/video/774004079',
                'images' => [
                ],
                'spread' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/perfect-gift-spread.png',
                'overview' => 'Need the perfect gift idea for YOU or a drummer you know?

The Perfect Gift Bundle comes ready to wrap and put under the tree -- loaded with a 1-year Drumeo access pass (unlimited drum lessons!), the super-versatile P4 Practice Pad, and a fresh pair of drumsticks.

**Drumeo offers ongoing access to:**
  • **Drumeo Method:** Our 10-level step-by-step curriculum so you always know exactly what to practice next.
  • **Drumeo Songs:** 2000+ note-for-note breakdowns of drumming’s most famous songs complete with handy playback tools.
  • **Drumeo Coaches:** Ongoing motivation & support with pro drummers. Ask questions, take notes, and learn directly from drummers who know what it takes.
  • **Artist Courses:** 220+ mini-courses by the best drummers and teachers in the world, always teaching the specific topics that made them famous!
  • **Personal Support:** You’ll have unlimited access to our community forums, student plans, weekly live streams, video reviews, and more!',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => true,
                'products' => [
                    [
                        'name' => 'Drumeo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The P4 Practice Pad',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Vater Drumeo 5A Drumsticks',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                ],
            ],

            //PIANOTE
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Unlimited Lessons Bundlee',
                'slug' => 'bundle-unlimited-lessons',
                'sku' => 'products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[christmas-song-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&redirect=/order&locked=true',
                'meta_desc' => 'UNLIMITED piano lessons you can take anywhere, anytime.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/unlimited-lessons-fb-share-image-1.jpg',
                'price' => 1101,
                'discounted_price' => 240,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/november/unlimited-lessons-bundle-black.png',
                'header_text' => 'UNLIMITED piano lessons you can take anywhere, anytime.',
                'video_src' => '//player.vimeo.com/video/774401622',
                'images' => [
                ],
                'overview' => 'The Unlimited Lessons Bundle gives you just that - unlimited piano lessons. Watch as many as you like, as often as you like.

Learn your favorite songs in the comfort of your own home, whenever you want. Impress your family and friends with your piano playing - for a tiny fraction of the cost of private lessons.

And get the support and feedback from real teachers who will help you every step of the way.',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Pianote Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Piano Chords & Scales',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Pianote Practice Planner',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Pianote Christmas Songbook',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Pianote Digital Christmas Songbook',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Chords Poster',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Scales Poster',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The Power of Chords',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Classical Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Improvisation & Musical Freedom',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Playing Beautiful Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'De-Stupefy Your Left Hand',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Worship Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Faster Fingers',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Whole 9 Yards Cyber Bundle',
                'slug' => 'bundle-9-yards',
                'sku' => 'products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&locked=true',
                'meta_desc' => 'Everything You Need. The Whole 9 Yards',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/whole-9-yards-fb-share-image.jpg',
                'price' => 716,
                'discounted_price' => 127,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/november/the-whole-9-yards-bundle-black.png',
                'header_text' => 'https://pianote.s3.amazonaws.com/sales/promos/november/the-whole-9-yards-bundle-black.png',
                'video_src' => '//player.vimeo.com/video/774401637',
                'images' => [
                ],
                'spread' => 'https://pianote.s3.amazonaws.com/sales/promos/november/the-whole-9-yards-spread.png',
                'overview' => 'All the courses, none of the commitment. The Whole 9 Yards Cyber Bundle is your complete guide to learning the piano without a membership.

Pay once and get lifetime access to 9 courses. You’ll learn how to play beautiful chords, classical piano, amazing improvisation, boost your speed, and more.',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'The Power of Chords',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Classical Piano',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Improvisation & Musical Freedom',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Playing Beautiful Piano',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Technique Made Easy',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'De-Stupefy Your Left Hand',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Worship Piano',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Faster Fingers',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                ],
            ],

            //GUITAREO
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Sound Better Bundle',
                'slug' => 'sound-better-bundle',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => 127,
                'discounted_price' => 0,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'Get ALL the lessons and gear essentials to start sounding better on the guitar.',
                'video_src' => '',
                'images' => [
                ],
                'overview' => 'Need the perfect gift idea for YOU or a drummer you know?

The Perfect Gift Bundle comes ready to wrap and put under the tree -- loaded with a 1-year Drumeo access pass (unlimited drum lessons!), the super-versatile P4 Practice Pad, and a fresh pair of drumsticks.

**Drumeo offers ongoing access to:**
  • **Drumeo Method:** Our 10-level step-by-step curriculum so you always know exactly what to practice next.
  • **Drumeo Songs:** 2000+ note-for-note breakdowns of drumming’s most famous songs complete with handy playback tools.
  • **Drumeo Coaches:** Ongoing motivation & support with pro drummers. Ask questions, take notes, and learn directly from drummers who know what it takes.
  • **Artist Courses:** 220+ mini-courses by the best drummers and teachers in the world, always teaching the specific topics that made them famous!
  • **Personal Support:** You’ll have unlimited access to our community forums, student plans, weekly live streams, video reviews, and more!
',
                'sold_out' => false,
                'guaranteed' => false,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Guitareo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Guitareo Survival Guide',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'GuitarQuest',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'The Guitar System',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Guitar Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Acoustic Guitar Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Rhythm & Groove',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],

        ];

        foreach($bundles as $product){
            $newProduct = Product::create([
                'brand_id' => $product['brand'],
                'product_type_id' => $product['product_type_id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'sku' => $product['sku'],
                'meta_desc' => $product['meta_desc'],
                'meta_img' => $product['meta_img'],
                'price' => $product['price'],
                'discounted_price' => empty($product['discounted_price']) ? 0 : $product['discounted_price'],
                'special_text' => $product['special_text'],
                'page_logo' => $product['page_logo'],
                'header_text' => $product['header_text'],
                'video_src' => $product['video_src'],
                'sold_out' => $product['sold_out'],
                'guaranteed' => $product['guaranteed'],
                'free_shipping' => $product['free_shipping'],
                'overview' => empty($product['overview']) ? false : $product['overview'],
            ]);

            foreach($product['images'] as $key => $image){
                Image::create([
                    'product_id' => $newProduct->id,
                    'path' => $image,
                    'order_number' => $key
                ]);
            }

            foreach($product['products'] as $key => $bundle){
                $product_id = Product::where('name', '=', $bundle['name'])->where('brand_id', '=', $product['brand'])->first()->id;

                Bundle::create([
                    'bundle_id' => $newProduct->id,
                    'product_id' => $product_id,
                    'free_bonus' => $bundle['free_bonus'],
                    'lifetime_access' => $bundle['lifetime_access'],
                    'order_number' => $key
                ]);
            }
        }
    }
}
