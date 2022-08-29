<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Beginner Bundle',
                'slug' => 'bundle-beginner',
                'sku' => 'products[DLM]=1,year,1&products[BeginnerBook]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=1&products[independence-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[new-drummers-start-here]=1&products[learn-songs-faster-pack]=1&locked=true',
                'meta_desc' => 'The perfect bundle to get you started on the drums.',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/promos/july/beginner_banner.jpg',
                'price' => 240,
                'discounted_price' => 200,
                'special_text' => '+$441.94 In FREE Bonuses',
                'page_logo' => 'https://drumeo-assets.s3.amazonaws.com/promos/july/beginner_bundle_dark.png',
                'header_text' => 'The perfect bundle to get you started on the drums.',
                'video_src' => '',
                'images' => [
                    'https://drumeo-assets.s3.amazonaws.com/promos/july/beginner_banner.jpg',
                ],
                'sold_out' => true,
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
                    [
                        'name' => 'The Best Beginner Drum Book',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Independence Made Easy',
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
                        'name' => 'New Drummers Start Here',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 1,
                'product_type_id' => 6,
                'name' => 'The Hands & Feet Bundle',
                'slug' => 'bundle-hands-feet',
                'sku' => 'products[DLM]=1,year,1&products[quietpad]=1&products[quietkick]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&locked=true',
                'meta_desc' => 'Improve your hands & feet anywhere, anytime.',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/promos/july/hands_feet_bundle.jpg',
                'price' => 240,
                'discounted_price' => 200,
                'special_text' => '+$450.94 In FREE Bonuses',
                'page_logo' => 'https://drumeo-assets.s3.amazonaws.com/promos/july/hands-feet-bundle-logo-stack-black.png',
                'header_text' => 'Improve your hands & feet anywhere, anytime.',
                'video_src' => '',
                'images' => [
                    'https://drumeo-assets.s3.amazonaws.com/promos/july/hands_banner.jpg',
                ],
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => true,
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
                        'name' => 'Drum Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Four Weeks To Better Drum Fills',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Great Hands For A Lifetime',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Beginner Bundle',
                'slug' => '',
                'sku' => '',
                'meta_desc' => '',
                'meta_img' => '',
                'price' => 0,
                'discounted_price' => 0,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => '',
                'video_src' => '',
                'images' => [
                    '',
                ],
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => true,
                'products' => [
                    [
                        'name' => '',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                ],
            ],
//            [
//                'brand' => 1,
//                'product_type_id' => 6,
//                'name' => '',
//                'slug' => '',
//                'sku' => '',
//                'meta_desc' => '',
//                'meta_img' => '',
//                'price' => 0,
//                'discounted_price' => 0,
//                'special_text' => '',
//                'page_logo' => '',
//                'header_text' => '',
//                'video_src' => '',
//                'images' => [
//                    '',
//                ],
//                'sold_out' => true,
//                'guaranteed' => true,
//                'free_shipping' => true,
//                'products' => [
//                    [
//                        'name' => '',
//                        'free_bonus' => false,
//                        'lifetime_access' => false,
//                    ],
//                ],
//            ],
        ];

        foreach($products as $product){
            $newProduct = Product::create([
                'brand_id' => $product['brand'],
                'product_type_id' => $product['product_type_id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'sku' => $product['sku'],
                'meta_desc' => $product['meta_desc'],
                'meta_img' => $product['meta_img'],
                'price' => $product['price'],
                'discounted_price' => $product['discounted_price'],
                'special_text' => $product['special_text'],
                'page_logo' => $product['page_logo'],
                'header_text' => $product['header_text'],
                'video_src' => $product['video_src'],
                'sold_out' => $product['sold_out'],
                'guaranteed' => $product['guaranteed'],
                'free_shipping' => $product['free_shipping'],
            ]);

            foreach($product['images'] as $key => $image){
                Image::create([
                    'product_id' => $newProduct->id,
                    'path' => $image,
                    'order_number' => $key
                ]);
            }

            foreach($product['products'] as $key => $bundle){
                $product_id = Product::where('name', '=', $bundle['name'])->first()->id;

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
