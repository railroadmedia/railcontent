<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsClothingSeeder extends Seeder
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
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Pianote Floral Shirt White",
                "slug" => "shirt-floral-white",
                "sku" => "tshirt-pianote-floral-white",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/womens-floral-shirt.jpg",
                "meta_desc" => "This custom-designed graphic features roses and a grand piano.",
                "meta_img" => "https://pianote.s3.amazonaws.com/shop/products/2020-merch/2022-08-24-Pianote-Music-Brings-Happiness-RED-114-Edit.jpg",
                "short_desc" => "This custom-designed graphic features roses and a grand piano.",
                "header_text" => "Women’s White Floral T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Music brings happiness. A simple concept you know to be true. This custom-designed graphic features roses and a grand piano. Share a beautiful image, and a beautiful message."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Boxercraft"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "80% Polyester, 20% Cotton Sueded Jersey"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "White"
                    ],
                    [
                        "title" => "Style",
                        "desc" => '	Relaxed Fit Scoop Neck Short Sleeve T-Shirt'
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    'https://pianote.s3.amazonaws.com/shop/products/2020-merch/2022-08-24-Pianote-Music-Brings-Happiness-RED-105-Edit.jpg',
                    'https://pianote.s3.amazonaws.com/shop/products/2020-merch/2022-08-24-Pianote-Music-Brings-Happiness-RED-112-Edit.jpg',
                    'https://pianote.s3.amazonaws.com/shop/products/2020-merch/2022-08-24-Pianote-Music-Brings-Happiness-RED-130-Edit.jpg',
                    'https://pianote.s3.amazonaws.com/shop/products/2020-merch/2022-08-24-Pianote-Music-Brings-Happiness-RED-114-Edit.jpg'
                ],
                "sizeChart" => 10,
                "sizes" => [
                    1,2,3,4,5
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 3,
                "name" => "Minimalist Hat",
                "slug" => "hat-minimalist",
                "sku" => "6477-wool-flexfit-cap-black",
                "thumbnail" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/card-thumbs/minimalist-hat2.jpg",
                "meta_desc" => "Simple and clean, this hat features a branded snare icon on the front and a discreet Drumeo logo on the back.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/hat.jpg",
                "short_desc" => "Simple and clean, this hat features a branded snare icon on the front and a discreet Drumeo logo on the back.",
                "header_text" => "Minimalist Hat",
                "price" => 19,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Simple and clean, this hat features a branded snare icon on the front and a discreet Drumeo logo on the back."
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => "S/M (6 3/4” - 7 1/4”), L/XL (7 1/8” - 7 5/8”)"
                    ],
                    [
                        "title" => "ManuFacturer",
                        "desc" => "Flexfit Wool Blend 6477"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "83% Acrylic / 14%Wool / 2% Spandex"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Style",
                        "desc" => 'Mid profile, 3 1/2" high crown, curved visor, 6 panels'
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/hat.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/hat2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/hat4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/hat3.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    9,10
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 3,
                "name" => "Drumeo Beanie",
                "slug" => "beanie",
                "sku" => "Drumeo-Beanie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/beanie.jpg",
                "meta_desc" => "Smooth, slim fit keeps you warm + Drumeo logo keeps you cool.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/1.jpg",
                "short_desc" => "When it gets cold, you need to keep your ears warm. This all-black beanie features a 4” wide Drumeo logo on the front.",
                "header_text" => "Drumeo Beanie",
                "price" => 19,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "It gets cold here at the Drumeo HQ in Canada, so we’ve finally embraced the cold with a Drumeo-branded beanie to keep every drummer warm and styling!"
                ],
                "specs" => [
                    [
                        "title" => "Manufacturer",
                        "desc" => "Apollo"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Acrylic"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Size",
                        "desc" => "8.5”"
                    ],
                    [
                        "title" => "Logo",
                        "desc" => "4” wide, front embroidery."
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/4.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ],
            ],
            [
                "brand" => 2,
                "product_type_id" => 2,
                "name" => "Pianote Hat",
                "slug" => "hat-logo",
                "sku" => "pianote-hat",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/black-hat.jpg",
                "meta_desc" => "This hat features the Pianote logo on the front.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hat-1.jpg",
                "short_desc" => "This hat features the Pianote logo on the front.",
                "header_text" => "Pianote Hat",
                "price" => 19,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Wear your love for Pianote with pride (and keep the sun out of your eyes). This hat features the Pianote logo on the front."
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => "S/M (6 3/4” - 7 1/4”), L/XL (7 1/8” - 7 5/8”)"
                    ],
                    [
                        "title" => "ManuFacturer",
                        "desc" => "Flexfit Wool Blend 6477"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "83% Acrylic / 14% Wool / 2% Spandex"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Style",
                        "desc" => 'Mid profile, 3 1/2" high crown, curved visor, 6 panels'
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hat-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hat-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hat-3.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    9,10
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Sketchy Drums Shirt",
                "slug" => "tshirt-sketchy-drums",
                "sku" => "3001-unisex-jersey-sketchy-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/sketchy-shirt.jpg",
                "meta_desc" => "Stay cool flying the Drumeo flag with this 100% cotton t-shirt featuring the iconic hand-drawn “Sketchy Drums” logo.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch1.jpg",
                "short_desc" => "Stay cool flying the Drumeo flag with this 100% cotton t-shirt featuring the iconic hand-drawn “Sketchy Drums” logo.",
                "header_text" => "Sketchy Drums Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "The classic Drumeo hand-drawn drum set logo. Created by Drumeo’s own Catrina Jackson, wearing this shirt is like joining an exclusive club. Be prepared for secretive winks and curt nods of approval from Drumeo die-hards around the globe flying the “Sketchy Drums” flag."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black with a blue Drumeo logo"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch2.jpg"
                ],
                "sizeChart" => 1,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Discounted Sketchy Drums Shirt",
                "slug" => "tshirt-sketchy-drums-discount",
                "sku" => "3001-unisex-jersey-sketchy-shirt",
                "promo_code" => "25-off",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/sketchy-shirt.jpg",
                "meta_desc" => "Stay cool flying the Drumeo flag with this 100% cotton t-shirt featuring the iconic hand-drawn “Sketchy Drums” logo.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch1.jpg",
                "short_desc" => "Stay cool flying the Drumeo flag with this 100% cotton t-shirt featuring the iconic hand-drawn “Sketchy Drums” logo.",
                "header_text" => "Sketchy Drums Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "he classic Drumeo hand-drawn drum set logo. Created by Drumeo’s own Catrina Jackson, wearing this shirt is like joining an exclusive club. Be prepared for secretive winks and curt nods of approval from Drumeo die-hards around the globe flying the “Sketchy Drums” flag."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black with a blue Drumeo logo"
                    ],
                ],
                "visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch2.jpg"
                ],
                "sizeChart" => 1,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Drumeo Gab Shirt",
                "slug" => "tshirt-drumeo-gab",
                "sku" => "dt1350-tri-v-neck-drumeo-gab",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/drumeo-gab-shirt.jpg",
                "meta_desc" => "The official t-shirt of the world’s hottest drumming podcast.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab1.jpg",
                "short_desc" => "The official t-shirt of the world’s hottest drumming podcast.",
                "header_text" => "Drumeo Gab Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Drumeo Gab has become one of the hottest drumming podcasts on the planet! Get the official Drumeo Gab t-shirt and display your listenership with pride. Available in rich royal blue, this v-neck features a tasteful drum set logo stealthily positioned over your left hip."
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "District V-Neck"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "Tri-blend (Poly/Cotton/Rayon)"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Royal Frost Blue"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab3.jpg"
                ],
                "sizeChart" => 2,
                "sizes" => [
                    2,3,4,5,6,7,8
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Women’s Sleeveless Shirt",
                "slug" => "ladies-sleeveless",
                "sku" => "28712-womens-sleeveless",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/womens-tank.jpg",
                "meta_desc" => "Show your drumming pride in this loose and flowy fitting sleeveless t-shirt made of 100% organic & recycled cotton.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/tank1.jpg",
                "short_desc" => "Show your drumming pride in this loose and flowy fitting sleeveless t-shirt made of 100% organic & recycled cotton. ",
                "header_text" => "Women’s Sleeveless Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "This flowy-fitting, sleeveless t-shirt made of 100% organic & recycled cotton features a discrete but powerful graphic to proudly display your instrument of choice. Wear it to that festival or concert and scan the crowd for your drumming allies -- instant icebreaker."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "	Alternative Apparel Women’s Sleeveless"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton, organic & recycled materials"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Coal"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/tank1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/tank2.jpg"
                ],
                "sizeChart" => 3,
                "sizes" => [
                    2,3,4,5
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Binary Rudiments Shirt",
                "slug" => "tshirt-rudiments",
                "sku" => "3001C-crew-binary-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/rudiments.jpg",
                "meta_desc" => "Never miss a beat! Get your rudiment sticking patterns down with the Binary Rudiment shirt.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary2.jpg",
                "short_desc" => "Never miss a beat! Get your rudiment sticking patterns down with the Binary Rudiment shirt.",
                "header_text" => "Binary Rudiments Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Never miss a beat! Get your rudiment sticking patterns down with the Binary Rudiment shirt."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52/48 Cotton/Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Heather Slate"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary2.jpg"
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Gray Minimalist Shirt",
                "slug" => "tshirt-minimalist-gray",
                "sku" => "3001C-crew-minimalist-shirt-grey",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-gray.jpg",
                "meta_desc" => "Simple and clean. What's not to love about the new minimalist look?",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray2.jpg",
                "short_desc" => "Simple and clean, this gray t-shirt features a Drumeo logo.",
                "header_text" => "Gray Minimalist Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Simple and clean. What's not to love about the new minimalist look?"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52/48 Cotton/Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Heather Dark Gray"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray.jpg"
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Teal Minimalist Shirt",
                "slug" => "tshirt-minimalist-teal",
                "sku" => "3001C-crew-minimalist-shirt-teal",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-teal.jpg",
                "meta_desc" => "Simple and clean. What's not to love about the new minimalist look?",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal.jpg",
                "short_desc" => "Simple and clean, this teal t-shirt features a Drumeo logo.",
                "header_text" => "Teal Minimalist Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Simple and clean. What's not to love about the new minimalist look?"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52/48 Cotton/Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Heather Deep Teal"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal2.jpg"
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Dino-Space-Goblin Shirt",
                "slug" => "tshirt-dino",
                "sku" => "3005C-v-neck-dino-space-goblin",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/space-goblin.jpg",
                "meta_desc" => "No matter your species, profession, or universe of origin, you'll represent your love for the drums with this quirky v-neck shirt!",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin2.jpg",
                "short_desc" => "No matter your species, profession, or universe of origin, you'll represent your love for the drums with this quirky v-neck shirt!",
                "header_text" => "Dino-Space-Goblin Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "No matter your species, profession, or universe of origin, you can represent your love of drums with the quirky and fun Dino-Space-Goblin v-neck!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Flexfit Wool Blend 6477"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "83% Acrylic / 14% Wool / 2% Spandex"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin.jpg"
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Vintage Mountain Tee",
                "slug" => "tshirt-vintage",
                "sku" => "3604-nl-jersey-ringer-tee-vintage-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/vintage-shirt.jpg",
                "meta_desc" => "This vintage-styled t-shirt features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage.jpg",
                "short_desc" => "This vintage-styled t-shirt features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "header_text" => "Vintage Mountain Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "We are Canadian and love where we live! This vintage-styled t-shirt features the view from atop Cheam Mountain which overlooks British Columbia's Fraser Valley and surrounding areas. Did we actually take a drumkit up this mountain for a photo-op? We sure did!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Next Level Fine Jersey Ringer Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Natural/Forest Green"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage4.jpg"
                ],
                "sizeChart" => 5,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Jokester Shirt",
                "slug" => "tshirt-jokester",
                "sku" => "3001C-unisex-crew-budumtss-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/jokester.jpg",
                "meta_desc" => "Ba-Dum-Tss. Wear the sound effect that's perfect for all of your good, bad, and dad jokes.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester4.jpg",
                "short_desc" => "Ba-Dum-Tss. Wear the sound effect that's perfect for all of your good, bad, and dad jokes.",
                "header_text" => "Jokester Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Wear the sound effect that's perfect for all of your good, bad, and dad jokes with the new Drumeo Jokester shirt! In a deep red, this shirt will make you look good whether your punchline lands or not."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Oxblood Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester2.jpg"
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Team-Player Shirt",
                "slug" => "tshirt-team-player",
                "sku" => "3200-3-4-baseball-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/team-player.jpg",
                "meta_desc" => "Be a sport! Knock your next gig or practice session out of the park with this baseball styled shirt.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team4.jpg",
                "short_desc" => "Be a sport! Knock your next gig or practice session out of the park with this baseball styled shirt.",
                "header_text" => "Team-Player Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Be a sport! Knock your next gig or practice session out of the park with the new Drumeo Team-Player shirt!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas 3/4 Raglan Sleeve Baseball Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52/48 Cotton/Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Heather Gray & Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team5.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team3.jpg"
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Death Drummer Shirt",
                "slug" => "tshirt-skull",
                "sku" => "3200c-3-4-baseball-skull-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/skull.jpg",
                "meta_desc" => "Rock on, metal heads! Pair yourself up with The Death Drummer and you'll be sure to make skeletons dance out of their graves.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull3.jpg",
                "short_desc" => "Rock on, metal heads! Pair yourself up with The Death Drummer and you'll be sure to make skeletons dance out of their graves.",
                "header_text" => "Death Drummer Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Rock on, metal heads! Pair yourself up with The Death Drummer and you'll be sure to make skeletons dance out of their graves."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas 3/4 Raglan Sleeve Baseball Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52/48 Cotton/Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black/White"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull.jpg",
                ],
                "sizeChart" => 4,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 5,
                "name" => "Sketchy Drums Hoodie",
                "slug" => "hoodie-sketchy-drums",
                "sku" => "86228-sketchy-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/sketchy-hoodie.jpg",
                "meta_desc" => "Stay warm before & after the gig in the iconic “Sketchy Drums” Drumeo hoodie.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/hoodie2.jpg",
                "short_desc" => "Stay warm before & after the gig in the iconic “Sketchy Drums” Drumeo hoodie.",
                "header_text" => "Sketchy Drums Hoodie",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days. The hand-drawn logo has become a classic, created by Drumeo’s own Catrina Jackson. Be prepared for secretive winks and curt nods of approval from Drumeo die-hards around the globe flying the “Sketchy Drums” flag."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "J. America"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "60% Cotton, 40% Polyester Air-Spun Fleece"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black with blue Drumeo logo"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/hoodie2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/hoodie1.jpg"
                ],
                "sizeChart" => 6,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 5,
                "name" => "Retro Hoodie",
                "slug" => "hoodie-retro",
                "sku" => "ind4000-retro-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/retro-hoodie.jpg",
                "meta_desc" => "Stay cozy, comfy, AND colorful in this ultra-soft, vintage style Drumeo hoodie.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro1.jpg",
                "short_desc" => "Stay cozy, comfy, AND colorful in this ultra-soft, vintage style Drumeo hoodie.",
                "header_text" => "Retro Hoodie",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Cozy and comfy! The Drumeo Retro Hoodie features the Drumeo logo in a splash of color that will transport you to the time of Ringo’s reign. This generous fitting sweatshirt, in bone white, features a fleece-lined hood and handy front pouch pocket -- for your drumsticks, obviously."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Manufacturer",
                        "desc" => "Independent Trading Co. - Heavyweight Hooded Sweatshirt"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "70/30 cotton/polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Bone"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro3.jpg"
                ],
                "sizeChart" => 7,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 5,
                "name" => "Minimalist Zip-Up Hoodie",
                "slug" => "hoodie-minimalist",
                "sku" => "3939-full-zip-minimalist-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-hoodie.jpg",
                "meta_desc" => "Simple and clean. The minimalist zip-up hoodie features a discreet Drumeo logo and a branded snare icon on the back.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie4.jpg",
                "short_desc" => "Simple and clean. The minimalist hooded zip features a discreet Drumeo logo and a branded snare icon on the side. It fits a size smaller than standard hoodies.",
                "header_text" => "Minimalist Zip-Up Hoodie",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Simple and clean. The minimalist zip-up hoodie features a discreet Drumeo logo and a branded snare icon on the side. It fits a size smaller than standard hoodies."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex, Slim Fit, Note: This hoodie fits small, see Size Chart"
                    ],
                    [
                        "title" => "Manufacturer",
                        "desc" => "Bella + Canvas Triblend Lightweight Hooded Full-Zip"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "50/25/25 Polyester/cotton/rayon"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Charcoal-Black Triblend"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie6.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie5.jpg"
                ],
                "sizeChart" => 8,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 5,
                "name" => "Vintage Mountain Hoodie",
                "slug" => "hoodie-vintage",
                "sku" => "8885-hooded-vintage-pullover-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/vintage-hoodie.jpg",
                "meta_desc" => "This vintage-styled hoodie features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie2.jpg",
                "short_desc" => "This vintage-styled hoodie features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "header_text" => "",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "We are Canadian and love where we live! This vintage-styled hoodie features the view from atop Cheam Mountain which overlooks British Columbia's Fraser Valley and surrounding areas. Did we actually take a drumkit up this mountain for a photo-op? We sure did!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex, Baggy Fit - Size Chart"
                    ],
                    [
                        "title" => "Manufacturer",
                        "desc" => "J.America Vintage Heather Hooded Sweatshirt"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "80/20 Cotton/polyester heathered fleece"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Oatmeal Heather/Army Green"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie4.jpg"
                ],
                "sizeChart" => 9,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Rainbow Pianote T-Shirt",
                "slug" => "shirt-rainbow",
                "sku" => "tshirt-pianote-rainbow",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/rainbow-shirt.jpg",
                "meta_desc" => "This shirt features a rainbow Pianote logo on a white tee.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/rainbow-1.jpg",
                "short_desc" => "This shirt features a rainbow Pianote logo on a white tee.",
                "header_text" => "Rainbow Pianote T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Show your Pride. This comfortable short-sleeve T-shirt features a rainbow Pianote logo on a white tee."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52% Cotton, 48% Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "White"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/rainbow-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/rainbow-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/rainbow-3.jpg"
                ],
                "sizeChart" => 11,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Grand Piano T-Shirt",
                "slug" => "shirt-grand-piano",
                "sku" => "tshirt-grand-piano-black",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/black-piano-shirt.jpg",
                "meta_desc" => "This T-shirt features a stylish grand piano graphic behind the iconic Pianote logo.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-black-piano-2.jpg",
                "short_desc" => "This T-shirt features a stylish grand piano graphic behind the iconic Pianote logo. ",
                "header_text" => "Grand Piano T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Subtle, with a statement. This 100% cotton T-shirt features a stylish grand piano graphic behind the iconic Pianote logo. Simplicity is at the heart of this design."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-black-piano-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-black-piano1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-black-piano-3.jpg",
                ],
                "sizeChart" => 12,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Piano FunKeys T-Shirt",
                "slug" => "shirt-funkeys",
                "sku" => "tshirt-funkeys",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/funkeys-shirt.jpg",
                "meta_desc" => "Piano players will get it right away. Others… not so much.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-funkeys-1.jpg",
                "short_desc" => "Piano players will get it right away. Others… not so much.",
                "header_text" => "Piano FunKeys T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Fun, meet fashion. Stay cool with this funky red piano keys T-shirt. 100% cotton so it’s super-breathable featuring a custom artistic piano keyboard. Piano players will get it right away. Others… not so much."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Red"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-funkeys-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-funkeys-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-funkeys-3.jpg"
                ],
                "sizeChart" => 12,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Minimalist Pianote T-Shirt",
                "slug" => "shirt-minimalist-red",
                "sku" => "tshirt-minimalist-black",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/black-red-pianote-shirt.jpg",
                "meta_desc" => "This black T-shirt features the iconic red Pianote logo across the front.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-blackred-1.jpg",
                "short_desc" => "This black T-shirt features the iconic red Pianote logo across the front.",
                "header_text" => "Minimalist Pianote T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Simple and clean, this black T-shirt features the iconic red Pianote logo across the front. Made from 100% cotton to keep you cool even while you’re looking hot."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-blackred-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-blackred-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-blackred-3.jpg"
                ],
                "sizeChart" => 12,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Women's Grand Piano T-Shirt",
                "slug" => "shirt-womens-grand-piano",
                "sku" => "tshirt-womens-grand-piano-red",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/womens-red-vneck-shirt.jpg",
                "meta_desc" => "This shirt features a minimalist grand piano logo on the front.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/red-v-2.jpg",
                "short_desc" => "This shirt features a minimalist grand piano logo on the front.",
                "header_text" => "Women’s Grand Piano T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Relaxed is exactly how you’ll feel in this relaxed-fit T-shirt. Super soft with 100% cotton and a stylish v-neck, this shirt features a minimalist grand piano logo on the front."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Next Level"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Red"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Women’s Fine Jersey Relaxed V T-Shirt"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/red-v-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/red-v-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/red-v-3.jpg"
                ],
                "sizeChart" => 13,
                "sizes" => [
                    1,2,3,4,5,6
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Men’s Pocket Keys T-Shirt",
                "slug" => "shirt-mens-pocket",
                "sku" => "tshirt-mens-pocket-gray",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/pocket-mens-shirt.jpg",
                "meta_desc" => "This v-neck T-shirt features a subtle yet striking piano key design on the breast pocket.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-m-1.jpg",
                "short_desc" => "This v-neck T-shirt features a subtle yet striking piano key design on the breast pocket.",
                "header_text" => "Men’s Pocket Keys T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Carry your love for the piano in your front pocket. This ultra-soft v-neck T-shirt features a subtle yet striking piano key design on the breast pocket."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Men's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "MONROE Short Sleeve Pocket Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52% Cotton, 48% Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Gray"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "V-Neck Rib Knit Collar w/Contrast Pocket"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-m-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-m-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-m-3.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Women's Pocket Keys T-Shirt",
                "slug" => "shirt-womens-pocket",
                "sku" => "tshirt-womens-pocket-gray",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/pocket-womens-shirt.jpg",
                "meta_desc" => "Ladies, carry your love for the piano in your front pocket.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-f-2.jpg",
                "short_desc" => "This v-neck T-shirt features a subtle yet striking piano key design on the breast pocket.",
                "header_text" => "Women’s Pocket Keys T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Ladies, carry your love for the piano in your front pocket. This ultra-soft v-neck T-shirt features a subtle yet striking piano key design on the breast pocket."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "MONROE Short Sleeve Pocket Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52% Cotton, 48% Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Gray"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "V-Neck Rib Knit Collar w/Contrast Pocket"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-f-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/pocket-f-1.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    1,2,3,4,5,6
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Iconic Pianote T-Shirt",
                "slug" => "shirt-iconic",
                "sku" => "2019-TSHIRT",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/iconic-shirt.jpg",
                "meta_desc" => "The iconic Pianote T-Shirt, as comfortable as it looks.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/1.jpg",
                "short_desc" => "Share your love for Pianote with the world!",
                "header_text" => "Iconic Pianote T-shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "The iconic Pianote T-Shirt, as comfortable as it looks."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Vintage Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/3.jpg"
                ],
                "sizeChart" => 14,
                "sizes" => [
                    2,3,4,5,6,7,8
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Discounted Iconic Pianote T-Shirt",
                "slug" => "shirt-iconic-discount",
                "sku" => "2019-TSHIRT",
                "promo_code" => "25-off",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/iconic-shirt.jpg",
                "meta_desc" => "The iconic Pianote T-Shirt, as comfortable as it looks.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/1.jpg",
                "short_desc" => "Share your love for Pianote with the world!",
                "header_text" => "Iconic Pianote T-shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "The iconic Pianote T-Shirt, as comfortable as it looks."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Vintage Black"
                    ],
                ],
                "visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-shirt/3.jpg"
                ],
                "sizeChart" => 14,
                "sizes" => [
                    2,3,4,5,6,7,8
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Women's Black Floral T-Shirt",
                "slug" => "shirt-floral",
                "sku" => "Tshirt-Floral-Black",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/flora-shirt2.jpg",
                "meta_desc" => "A stylish, floral design allows you to show your love of Pianote in a unique way.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt/1.jpg",
                "short_desc" => "A stylish, floral design allows you to show your love of Pianote in a unique way.",
                "header_text" => "Women’s Black Floral T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "A stylish, floral design allows you to show your love of Pianote in a unique way. Featuring a scoop neck, short sleeves, and a modern, relaxed fit, this shirt will help you look as good as you play."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Boxercraft"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "80% Polyester, 20% Cotton Sueded Jersey"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Relaxed Fit Scoop Neck Short Sleeve T-Shirt"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt/1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt/2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt/3.jpg"
                ],
                "sizeChart" => 10,
                "sizes" => [
                    1,2,3,4,5
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Women's Mint Floral T-Shirt",
                "slug" => "shirt-floral-mint",
                "sku" => "Tshirt-Floral-Mint",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/floral-shirt-mint2.jpg",
                "meta_desc" => "A stylish, floral design allows you to show your love of Pianote in a unique way.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt-mint/1.jpg",
                "short_desc" => "A stylish, floral design set against a beautiful mint green fabric allows you to show your love of Pianote in a bright, fun way.",
                "header_text" => "Women’s Mint Floral T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "A stylish, floral design set against a beautiful mint green fabric allows you to show your love of Pianote in a bright, fun way. Featuring a scoop neck, short sleeves, and a modern, relaxed fit, this shirt is Lisa’s favorite, and will help you look as good as you play."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Boxercraft"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "80% Polyester, 20% Cotton Sueded Jersey"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Mint"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Relaxed Fit Scoop Neck Short Sleeve T-Shirt"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt-mint/1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt-mint/2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/floral-shirt-mint/3.jpg"
                ],
                "sizeChart" => 10,
                "sizes" => [
                    1,2,3,4,5
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 5,
                "name" => "Grand Piano Hoodie",
                "slug" => "hoodie-grand-piano",
                "sku" => "hoodie-grand-piano-red",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/red-hoodie.jpg",
                "meta_desc" => "This hoodie features a minimalist grand piano logo on the front.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hoodie-3.jpg",
                "short_desc" => "This hoodie features a minimalist grand piano logo on the front.",
                "header_text" => "Grand Piano Hoodie",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "This ultra-soft, classic fit zip-up hoodie wears like a dream, and looks stunning. The grand piano logo will show everyone who you are (a piano player!), while the front kangaroo pockets will keep your fingers warmed and ready to play."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Hoodie",
                        "desc" => "American Apparel"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "50% Cotton, 50% Polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Red"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Zip-Up Hoodie With Kangaroo Pockets"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hoodie-3.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hoodie-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hoodie-2.jpg"
                ],
                "sizeChart" => 15,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 5,
                "name" => "Iconic Pianote Hoodie",
                "slug" => "hoodie-iconic",
                "sku" => "Sweatshirt-Hooded-Black",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/iconic-hoodie.jpg",
                "meta_desc" => "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-hoodie/1.jpg",
                "short_desc" => "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days.",
                "header_text" => "Iconic Pianote Hoodie",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days. Your piano playing fingers will be kept warm between practices thanks to the front pouch pocket. This hoodie fits beautifully and creates a flattering look because of the spandex waist. But the best part is the iconic Pianote logo."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Hoodie",
                        "desc" => "J. America"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "60% Cotton, 40% Polyester Air-Spun Fleece"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Hooded Sweatshirt With Front Pouch Pocket"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-hoodie/1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-hoodie/2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/iconic-hoodie/3.jpg"
                ],
                "sizeChart" => 6,
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 4,
                "product_type_id" => 5,
                "name" => "Do Re Mi Hoodie",
                "slug" => "doremi-hoodie",
                "sku" => "doremi-hoodie",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/hoodie-shop-sale-page.jpg",
                "meta_desc" => "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days. This hoodie fits beautifully and creates a flattering look because of the spandex waist.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/funnel-sweatshirt/1.jpg",
                "short_desc" => "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days. This hoodie fits beautifully and creates a flattering look because of the spandex waist.",
                "header_text" => "Do Re Mi Singeo Hoodie",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "This ultra-soft, super warm fleeced hoodie will keep you cozy on those chilly days. This hoodie fits beautifully and creates a flattering look because of the spandex waist. PLUS, it’s fashionable purple will have you singing with much more style and confidence. Oh, and the solfege on the sleeve? It’s not upside down, singers understand. 😜"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Hoodie",
                        "desc" => "J. America"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "60% Cotton, 40% Polyester Air-Spun Fleece"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Lavender"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Hooded Sweatshirt With Front Pouch Pocket"
                    ],
                ],
                "visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    'https://singeo.s3.amazonaws.com/products/hoodie-shop-sale-page.jpg'
                ],
                "sizeChart" => 6,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 4,
                "product_type_id" => 4,
                "name" => "Chorus T-shirt",
                "slug" => "shirt-chorusz",
                "sku" => "chorus-shirt",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/t-shirt-shop-sale-page.jpg",
                "meta_desc" => "The Chorus Singeo T-Shirt, as comfortable as it looks.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/funnel-sweatshirt/1.jpg",
                "short_desc" => "The Chorus Singeo T-Shirt, as comfortable as it looks.",
                "header_text" => "Singeo Chorus T-Shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "The Chorus Singeo T-Shirt, as comfortable as it looks."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Lavender"
                    ],
                ],
                "visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    'https://singeo.s3.amazonaws.com/products/t-shirt-shop-sale-page.jpg'
                ],
                "sizeChart" => 14,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 4,
                "product_type_id" => 4,
                "name" => "Retro T-shirt",
                "slug" => "shirt-retro",
                "sku" => "retro-shirt",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/retro-shirt.png",
                "meta_desc" => "Sing with confidence AND style with this super slick Singeo Retro T-shirt!",
                "meta_img" => "https://singeo.s3.amazonaws.com/products/retro-shirt.png",
                "short_desc" => "Sing with confidence AND style with this super slick Singeo Retro T-shirt!",
                "header_text" => "The Singeo Retro T-shirt",
                "price" => 29,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Sing with confidence AND style with this super slick Singeo Retro T-shirt!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "Bella + Canvas Short Sleeve Jersey Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "52% cotton, 48% polyester"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                ],
                "visible" => true,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                'size_case_sensitive' => true,
                'bundle_free_shipping' => true,
                "images" => [
                    "https://singeo.s3.amazonaws.com/products/retro-shirt-thumb.png"
                ],
                "sizeChart" => 14,
                "sizes" => [
                    2,3,4,5,6
                ],
                'bundle_img' => 'https://singeo.s3.amazonaws.com/products/retro-shirt.png',
                'bundle_desc' => 'Sing with confidence AND style with this super slick Retro T-shirt.'
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "Women's Sketchy Drums Shirt",
                "slug" => "ladies-shirt",
                "sku" => "2017-Black-Ladies-Shirt",
                "thumbnail" => "",
                "meta_desc" => "Featuring a V-neck, short sleeves, and a modern, relaxed fit for effortless style.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Merch/ladies-shirt/2.jpg",
                "short_desc" => "",
                "header_text" => "Women's Sketchy Drums Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Featuring a V-neck, short sleeves, and a modern, relaxed fit for effortless style - the Sketchy Drums Shirt lets you share your love for Drumeo while you’re playing the drums!"
                ],
                "specs" => [
                    [
                        "title" => "Manufacturer",
                        "desc" => "Bella + Canvas"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "	100% Cotton"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Relaxed fit v-neck shirt."
                    ],
                    [
                        "title" => "Logo",
                        "desc" => "8” wide front screenprint"
                    ],
                ],
                "visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/ladies-shirt/2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/ladies-shirt/3.jpg"
                ],
                "sizeChart" => 16,
                "sizes" => [
                    2,3,4,5
                ]
            ],
            [
                "brand" => 1,
                "product_type_id" => 4,
                "name" => "The Holiday T-Shirt",
                "slug" => "tshirt-holiday",
                "sku" => "holidayshirt",
                "thumbnail" => "",
                "meta_desc" => "Get in the Christmas spirit with the Drumeo Holiday T-shirt, featuring a bold Drumeo logo with antlers and holiday flair!",
                "meta_img" => "https://www.drumeo.com/laravel/public/assets/order-form/images/product-images/holidayshirt-XXL.png",
                "short_desc" => "",
                "header_text" => "The Holiday T-Shirt",
                "price" => 25,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Get in the Christmas spirit with the Drumeo Holiday T-shirt, featuring a bold Drumeo logo with antlers and holiday flair!"
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "All sizes are listed in Men's"
                    ],
                    [
                        "title" => "Shirt",
                        "desc" => "American Apparel Unisex 100% Cotton Tee"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "100% Combed Cotton, with a soft feel"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Black, with superior screen printing"
                    ],
                ],
                "visible" => false,
                "sold_out" => true,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    'https://s3.amazonaws.com/drumeo-packs/Merch/holiday.jpg'
                ],
                "sizeChart" => 17,
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 2,
                "product_type_id" => 4,
                "name" => "Women’s Funnel Neck Sweatshirt",
                "slug" => "sweatshirt-funnel",
                "sku" => "Sweatshirt-Womens-Oatmeal",
                "thumbnail" => "",
                "meta_desc" => "Designed with pianists in mind, this SUPER-SOFT funnel neck sweatshirt is a must-have for your wardrobe.",
                "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/funnel-sweatshirt/1.jpg",
                "short_desc" => "",
                "header_text" => "Women’s Funnel Neck Sweatshirt",
                "price" => 59,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                    "Designed with pianists in mind, this SUPER-SOFT funnel neck sweatshirt is a must-have for your wardrobe. The eye-catching funnel neck is as fashionable as it is comfortable, and discreet side pockets add versatility without affecting the shirt line."
                ],
                "specs" => [
                    [
                        "title" => "Sizing",
                        "desc" => "Women's"
                    ],
                    [
                        "title" => "Sweatshirt",
                        "desc" => "Weatherproof"
                    ],
                    [
                        "title" => "Fabric",
                        "desc" => "60% Polyester, 35% Rayon, 5% Spandex Faux Cashmere"
                    ],
                    [
                        "title" => "Color",
                        "desc" => "Oatmeal"
                    ],
                    [
                        "title" => "Style",
                        "desc" => "Funnel Neck With Matching Drawcord & Side Pockets"
                    ],
                ],
                "visible" => false,
                "sold_out" => true,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/funnel-sweatshirt/1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/funnel-sweatshirt/2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/funnel-sweatshirt/3.jpg"
                ],
                "sizeChart" => 18,
                "sizes" => [
                    1,2,3,4,5
                ]
            ],

//            [
//                "brand" => 2,
//                "product_type_id" => 4,
//                "name" => "",
//                "slug" => "",
//                "sku" => "",
//                "thumbnail" => "",
//                "meta_desc" => "",
//                "meta_img" => "",
//                "short_desc" => "",
//                "header_text" => "",
//                "price" => 29,
//                "discounted_price" => "",
//                "special_text" => "",
//                "features" => [
//                    ""
//                ],
//                "specs" => [
//                    [
//                        "title" => "Sizing",
//                        "desc" => "Unisex"
//                    ],
//                    [
//                        "title" => "Shirt",
//                        "desc" => "Flexfit Wool Blend 6477"
//                    ],
//                    [
//                        "title" => "Fabric",
//                        "desc" => "83% Acrylic / 14% Wool / 2% Spandex"
//                    ],
//                    [
//                        "title" => "Color",
//                        "desc" => "Black"
//                    ],
//                ],
//                "visible" => false,
//                "sold_out" => false,
//                "guaranteed" => false,
//                "lifetime_access" => false,
//                "free_shipping" => false,
//                "images" => [
//
//                ],
//                "sizeChart" => "",
//                "sizes" => [
//
//                ]
//            ],
        ];

        $drumeo = 5;
        $pianote = 5;
        $guitareo = 5;
        $singeo = 5;
        $orderNum = 5;

        foreach($products as $product) {
            $brand = $product['brand'];

            if($brand === 1){
                $orderNum = $drumeo;
            }
            elseif($brand === 2){
                $orderNum = $pianote;
            }
            elseif($brand === 3){
                $orderNum = $guitareo;
            }
            elseif($brand === 4){
                $orderNum = $singeo;
            }

            $newProduct = Product::create([
                'brand_id' => $product['brand'],
                'product_type_id' => $product['product_type_id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'sku' => $product['sku'],
                'promo_code' => empty($product['promo_code']) ? null : $product['promo_code'],
                'thumbnail' => $product['thumbnail'],
                'header_text' => $product['header_text'],
                'short_desc' => $product['short_desc'],
                'meta_desc' => $product['meta_desc'],
                'meta_img' => $product['meta_img'],
                'special_text' => $product['special_text'],
                'price' => $product['price'],
                'discounted_price' => empty($product['discounted_price']) ? 0 : $product['discounted_price'],
                'sold_out' => $product['sold_out'],
                'free_shipping' => $product['free_shipping'],
                'guaranteed' => $product['guaranteed'],
                'visible' => $product['visible'],
                'lifetime_access' => $product['lifetime_access'],
                'display_order' => $orderNum,
                'size_case_sensitive' => empty($product['size_case_sensitive']) ? false : $product['size_case_sensitive'],
                'physical' => true,
                'size_chart_id' => empty($product['sizeChart']) ? null : $product['sizeChart'],
                'bundle_img' => empty($product['bundle_img']) ? null : $product['bundle_img'],
                'bundle_desc' => empty($product['bundle_desc']) ? null : $product['bundle_desc'],
                'bundle_free_shipping' => empty($product['bundle_free_shipping']) ? false : $product['bundle_free_shipping'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if($brand === 1){
                $drumeo += 5;
            }
            elseif($brand === 2){
                $pianote += 5;
            }
            elseif($brand === 3){
                $guitareo += 5;
            }
            elseif($brand === 4){
                $singeo += 5;
            }

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
                    'size_id' => $size,
                ]);
            }
        }
    }
}
