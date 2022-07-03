<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsAccessorySeeder extends Seeder
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
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo Water Bottle",
                "slug" => "water-bottle",
                "sku" => "Drumeo-Water-Bottle",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/bottle.jpg",
                "metaDesc" => "Stainless steel water bottle to quench your thirst on the drums.",
                "metaImg" => "",
                "shortDesc" => "24oz stainless steel water bottle with a matte black finish and a blue/white Drumeo logo.",
                "headerText" => "Drumeo Water Bottle",
                "price" => 12,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "This stainless steel water bottle will keep your H2O cool while you play the drums, with room for 24 oz of water so you don’t need to go for refills over and over again."
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "24 oz"
                    ],
                    [
                        "title" => "Height",
                        "desc" => '10.875"',
                    ],
                    [
                        "title" => "Diameter",
                        "desc" => '2.75"',
                    ],
                    [
                        "title" => "Materials",
                        "desc" => "	Stainless steel with threaded plastic lid."
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Matte black with a Drumeo logo."
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Hand wash recommended."
                    ],
                    [
                        "title" => "Microwave",
                        "desc" => "Do not microwave"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/5.jpg",
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo Coffee Mug",
                "slug" => "coffee-mug",
                "sku" => "Drumeo-Mug",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/mug.jpg",
                "metaDesc" => "Ceramic coffee mug: your daily dose of energy to play the drums.",
                "metaImg" => "",
                "shortDesc" => "Get your daily dose of energy for playing the drums with our 15oz ceramic coffee mug -- black outside with a blue/white logo, and blue inside.",
                "headerText" => "Drumeo Coffee Mug",
                "price" => 12,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Every time you grab a cup of coffee, this mug will remind you to get back on Drumeo and keep playing the drums. (And you’ll get the energy boost you need to grab the sticks, too!)"
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "15 oz"
                    ],
                    [
                        "title" => "Height",
                        "desc" => '4.875"',
                    ],
                    [
                        "title" => "Diameter",
                        "desc" => "3.5” (with handle: 5.25”)"
                    ],
                    [
                        "title" => "Materials",
                        "desc" => "Ceramic"
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Matte black exterior and blue interior."
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Microwave",
                        "desc" => "Microwave safe."
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/mug/1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/mug/2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/mug/3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/mug/4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/mug/5.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drummer Towels",
                "slug" => "drummer-towels",
                "sku" => "Drumeo-Towel",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/towel.jpg",
                "metaDesc" => "Play the drums until you sweat - and then play some more.",
                "metaImg" => "",
                "shortDesc" => "Play the drums until you sweat - and then play some more. 16” x 25”, navy with a 4” white Drumeo embroidered logo.",
                "headerText" => "Drummer Towel",
                "price" => 19,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Subtle and absorbent, this towel is perfect for those long practice sessions or live shows where you’re drumming up a sweat!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "16” x 25”"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Navy"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "Terry Cotton Sport Towel"
                    ],
                    [
                        "title" => "Logo",
                        "desc" => "4” Drumeo logo (blue and white)."
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/towel/1-blue.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/towel/2-blue.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/towel/3-blue.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
//            [
//                "brand" => 1,
//                "productType" => 2,
//                "name" => "",
//                "slug" => "",
//                "sku" => "",
//                "thumbnail" => "",
//                "metaDesc" => "",
//                "metaImg" => "",
//                "shortDesc" => "",
//                "headerText" => "",
//                "price" => 1,
//                "discountedPrice" => "",
//                "specialText" => "",
//                "features" => [
//                    ""
//                ],
//                "specs" => [
//                    [
//                        "title" => "Volume",
//                        "desc" => "Unisex"
//                    ],
//                    [
//                        "title" => "Height",
//                        "desc" => "Flexfit Wool Blend 6477"
//                    ],
//                    [
//                        "title" => "Diameter",
//                        "desc" => "83% Acrylic / 14% Wool / 2% Spandex"
//                    ],
//                    [
//                        "title" => "Materials",
//                        "desc" => "Black"
//                    ],
//                    [
//                        "title" => "Finish",
//                        "desc" => "Black"
//                    ],
//                    [
//                        "title" => "Washing",
//                        "desc" => "Black"
//                    ],
//                    [
//                        "title" => "Microwave",
//                        "desc" => "Black"
//                    ],
//                ],
//                "visible" => true,
//                "soldOut" => false,
//                "freeBonus" => false,
//                "badge" => false,
//                "lifeTime" => false,
//                "freeShipping" => false,
//                "images" => [
//
//                ],
//                "sizeChart" => "",
//                "sizes" => [
//
//                ]
//            ],
        ];

        foreach($products as $product) {
            $newProduct = Product::create([
                'brand_id' => $product['brand'],
                'product_type_id' => $product['productType'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'sku' => $product['sku'],
                'thumbnail' => $product['thumbnail'],
                'header_text' => $product['headerText'],
                'short_desc' => $product['shortDesc'],
                'meta_desc' => $product['metaDesc'],
                'meta_img' => $product['metaImg'],
                'special_text' => $product['specialText'],
                'price' => $product['price'],
                'discounted_price' => $product['discountedPrice'],
                'sold_out' => $product['soldOut'],
                'free_shipping' => $product['freeShipping'],
                'guaranteed' => $product['badge'],
                'visible' => $product['visible'],
                'free_bonus' => $product['freeBonus'],
                'membership_discount' => false,
                'lifetime_access' => $product['lifeTime'],
                'size_chart_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach($product['features'] as $key => $feature){
                Feature::create([
                    'product_id' => $newProduct->id,
                    'desc' => $feature,
                    'order_number' => $key
                ]);
            }

            foreach($product['specs'] as $key => $spec){
                Spec::create([
                    'product_id' => $newProduct->id,
                    'title' => $spec['title'],
                    'desc' => $spec['desc'],
                    'order_number' => $key,
                ]);
            }

            foreach($product['images'] as $key => $image){
                Image::create([
                    'product_id' => $newProduct->id,
                    'path' => $image,
                    'order_number' => $key
                ]);
            }

            foreach($product['sizes'] as $size){
                ProductSize::create([
                    'product_id' => $newProduct->id,
                    'size_id' => $size
                ]);
            }
        }
    }
}
