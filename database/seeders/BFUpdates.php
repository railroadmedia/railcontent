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
        Product::where('brand_id', 1)->where('name', 'Drumeo QuietKick')->update(['discounted_price' => 67]);
        Product::where('brand_id', 1)->where('name', 'The P4 Practice Pad')->update(['discounted_price' => 65]);
        Product::where('brand_id', 1)->where('name', 'Drumeo Tone Control Kit')->update(['discounted_price' => 59]);
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

        Product::where('brand_id', 1)->where('product_type_id', 4)->update(['discounted_price' => 5]);
        Product::where('brand_id', 1)->where('product_type_id', 5)->update(['discounted_price' => 39]);
        Product::where('brand_id', 1)->where('product_type_id', 3)->update(['discounted_price' => 15]);

        //GUITAREO UPDATES
        Product::where('brand_id', 3)->where('name', 'GuitarQuest')->update(['discounted_price' => 97]);
        Product::where('brand_id', 3)->where('name', '500 Songs In 5 Days')->update(['discounted_price' => 29]);
        Product::where('brand_id', 3)->where('name', 'Acoustic Guitar Made Easy')->update(['discounted_price' => 49]);
        Product::where('brand_id', 3)->where('name', 'Guitar Technique Made Easy')->update(['discounted_price' => 49]);
        Product::where('brand_id', 3)->where('name', 'The Guitar System')->update(['discounted_price' => 49]);

        //BUNDLE UPDATES
        $bundles = [
            //DRUMEO
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Ultimate Lessons Bundle',
                'slug' => 'ultimate-lessons',
                'sku' => '',
                'meta_desc' => 'Improve your drumming anywhere & anytime.',
                'meta_img' => '',
                'price' => ,
                'discounted_price' => ,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'Improve your drumming anywhere & anytime. (+ get 12 FREE bonuses)',
                'video_src' => '',
                'images' => [
                ],
                'overview' => 'It’s a drummer’s paradise.

The Ultimate Lessons Bundle includes access to unlimited drum lessons -- PLUS, you’ll get an ultra-quiet practice pad, the NEW Drumeo QuietKick, and fresh drumsticks sp you run rudiments & stickings late into the night without disturbing anyone.

You’ll get 12 FREE bonuses in total (valued at $1345.93) -- including Drumeo’s most popular training packs.

Scroll down to see everything included in the Ultimate Lessons Bundle and get ready for your best year on the drums yet.
',
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
                        'name' => 'Drumeo QuietKick',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Drumeo QuietPad',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Vater Drumeo 5A Drumsticks',
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
                'slug' => 'practice-anywhere',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => ,
                'discounted_price' => ,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'Improve your rudiments & stickings on the fly. (SAVE 50%)',
                'video_src' => '',
                'images' => [
                ],
                'overview' => 'Run your rudiments anytime day or night & develop silky-smooth hands on the kit.

The Practice Anywhere Bundle includes the P4 Practice Pad – the only practice pad that simulates the feels of a REAL drum set – fresh drumsticks, and the all NEW Drumeo Rudiments poster.

You’ll have everything you need to improve your hands around the drums.
',
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
                        'name' => 'Drumeo QuietPad',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Perfect Gift Bundle',
                'slug' => 'perfect-gift',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => ,
                'discounted_price' => ,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'The perfect gift for any drummer. (Unlimited drum lessons + free bonuses!)',
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
            //GUITAREO
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Perfect Gift Bundle',
                'slug' => 'sound-better-bundle',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => ,
                'discounted_price' => ,
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
