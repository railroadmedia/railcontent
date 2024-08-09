<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CMUpdates extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //BUNDLE UPDATES
        $bundles = [
            //DRUMEO
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Cyber Monday Bundle',
                'slug' => '',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => 240,
                'discounted_price' => 200,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'For the drummer who wants it all. (Includes 15 bonus lesson packs)',
                'video_src' => '',
                'images' => [
                ],
                'overview' => 'This is it!

You’ll have access to ALL the drum lessons inside Drumeo PLUS get 15 digital training packs (worth $1173.91!) taught by drumming’s biggest names.

Your Drumeo membership gives you unlimited drum lessons, 5000+song breakdowns, play-alongs, and way, way more -- and your bonus packs unlock courses taught by legendary drummers like Neil Peart, Thomas Lang, and Mike Portnoy.

It’s all designed to help you have your best year on the drums yet. Scroll down to see everything included with The Cyber Monday Bundle -- and we’ll see you inside the Drumeo members area soon!',
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
                        'name' => 'Learn Songs Faster',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Anatomy Of A Drum Solo',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Methods & Mechanics',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The Language Of Drumming',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Great Hands For A Lifetime',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Hands Grooves & Fills',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'In Constant Motion',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Creative Control',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The Grid',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Beyond The Chops',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            //PIANOTE
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Whole 9 Yards Cyber BUNDLE',
                'slug' => '',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => 97,
                'discounted_price' => 0,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'For the drummer who wants it all. (Includes 15 bonus lesson packs)',
                'video_src' => '',
                'images' => [
                ],
                'overview' => 'The Whole 9 Yards
Idiom, informal;
**Everything you can possibly want**

All the courses, none of the commitment. The Whole 9 Yards Cyber Bundle is your complete guide to learning the piano without a membership.

Pay once and get lifetime access to 9 courses. You’ll learn how to play beautiful chords, classical piano, amazing improvisation, boost your speed, and more.
',
                'sold_out' => false,
                'guaranteed' => false,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Drumeo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => '',
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
                'name' => 'Build-A-Song Bundle',
                'slug' => 'song-bundle',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => 735,
                'discounted_price' => 97,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'Build and play songs you love on the guitar.',
                'video_src' => '',
                'images' => [
                ],
                'overview' => '',
                'sold_out' => false,
                'guaranteed' => false,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'GuitarQuest',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Rhythm & Groove',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Acoustic Guitar Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Guitar Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
        ];

        foreach($bundles as $product) {
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

            foreach($product['images'] as $key => $image) {
                Image::create([
                    'product_id' => $newProduct->id,
                    'path' => $image,
                    'order_number' => $key
                ]);
            }

            foreach($product['products'] as $key => $bundle) {
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
