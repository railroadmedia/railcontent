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

class CMSClothingSeeder extends Seeder
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
                "productType" => 3,
                "name" => "Minimalist Hat",
                "slug" => "hat-minimalist",
                "sku" => "6477-wool-flexfit-cap-black",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-hat.jpg",
                "metaDesc" => "Simple and clean, this hat features a branded snare icon on the front and a discreet Drumeo logo on the back.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/hat.jpg",
                "shortDesc" => "Simple and clean, this hat features a branded snare icon on the front and a discreet Drumeo logo on the back.",
                "headerText" => "Minimalist Hat",
                "price" => 19,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
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
                "brand" => 2,
                "productType" => 3,
                "name" => "Pianote Hat",
                "slug" => "hat-logo",
                "sku" => "pianote-hat",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/black-hat.jpg",
                "metaDesc" => "This hat features the Pianote logo on the front.",
                "metaImg" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-hat-1.jpg",
                "shortDesc" => "This hat features the Pianote logo on the front.",
                "headerText" => "Pianote Hat",
                "price" => 19,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
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
                "productType" => 3,
                "name" => "Drumeo Beanie",
                "slug" => "beanie",
                "sku" => "Drumeo-Beanie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/beanie.jpg",
                "metaDesc" => "Smooth, slim fit keeps you warm + Drumeo logo keeps you cool.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/1.jpg",
                "shortDesc" => "When it gets cold, you need to keep your ears warm. This all-black beanie features a 4” wide Drumeo logo on the front.",
                "headerText" => "Drumeo Beanie",
                "price" => 19,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "It gets cold here at the Drumeo HQ in Canada, so we’ve finally embraced the cold with a Drumeo-branded beanie to keep every drummer warm and styling!"
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => "8.5"
                    ],
                    [
                        "title" => "ManuFacturer",
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
                        "title" => "Logo",
                        "desc" => '4” wide, front embroidery.'
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/4.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Sketchy Drums Shirt",
                "slug" => "tshirt-sketchy-drums",
                "sku" => "3001-unisex-jersey-sketchy-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/sketchy-shirt.jpg",
                "metaDesc" => "Stay cool flying the Drumeo flag with this 100% cotton t-shirt featuring the iconic hand-drawn “Sketchy Drums” logo.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch1.jpg",
                "shortDesc" => "Stay cool flying the Drumeo flag with this 100% cotton t-shirt featuring the iconic hand-drawn “Sketchy Drums” logo.",
                "headerText" => "Sketchy Drums Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/sketch2.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Drumeo Gab Shirt",
                "slug" => "tshirt-drumeo-gab",
                "sku" => "dt1350-tri-v-neck-drumeo-gab",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/drumeo-gab-shirt.jpg",
                "metaDesc" => "The official t-shirt of the world’s hottest drumming podcast.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab1.jpg",
                "shortDesc" => "The official t-shirt of the world’s hottest drumming podcast.",
                "headerText" => "Drumeo Gab Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/gab3.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7,8
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Women’s Sleeveless Shirt",
                "slug" => "ladies-sleeveless",
                "sku" => "28712-womens-sleeveless",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/womens-tank.jpg",
                "metaDesc" => "Show your drumming pride in this loose and flowy fitting sleeveless t-shirt made of 100% organic & recycled cotton.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/tank1.jpg",
                "shortDesc" => "Show your drumming pride in this loose and flowy fitting sleeveless t-shirt made of 100% organic & recycled cotton. ",
                "headerText" => "Women’s Sleeveless Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/tank1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/tank2.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Binary Rudiments Shirt",
                "slug" => "tshirt-rudiments",
                "sku" => "3001C-crew-binary-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/rudiments.jpg",
                "metaDesc" => "Never miss a beat! Get your rudiment sticking patterns down with the Binary Rudiment shirt.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary2.jpg",
                "shortDesc" => "Never miss a beat! Get your rudiment sticking patterns down with the Binary Rudiment shirt.",
                "headerText" => "Binary Rudiments Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/binary2.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Gray Minimalist Shirt",
                "slug" => "tshirt-minimalist-gray",
                "sku" => "3001C-crew-minimalist-shirt-grey",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-gray.jpg",
                "metaDesc" => "Simple and clean. What's not to love about the new minimalist look?",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray2.jpg",
                "shortDesc" => "Simple and clean, this gray t-shirt features a Drumeo logo.",
                "headerText" => "Gray Minimalist Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-gray.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Teal Minimalist Shirt",
                "slug" => "tshirt-minimalist-teal",
                "sku" => "3001C-crew-minimalist-shirt-teal",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-teal.jpg",
                "metaDesc" => "Simple and clean. What's not to love about the new minimalist look?",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal.jpg",
                "shortDesc" => "Simple and clean, this teal t-shirt features a Drumeo logo.",
                "headerText" => "Teal Minimalist Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-teal2.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Dino-Space-Goblin Shirt",
                "slug" => "tshirt-dino",
                "sku" => "3005C-v-neck-dino-space-goblin",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/space-goblin.jpg",
                "metaDesc" => "No matter your species, profession, or universe of origin, you'll represent your love for the drums with this quirky v-neck shirt!",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin2.jpg",
                "shortDesc" => "No matter your species, profession, or universe of origin, you'll represent your love for the drums with this quirky v-neck shirt!",
                "headerText" => "Dino-Space-Goblin Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/space-goblin.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Vintage Mountain Tee",
                "slug" => "tshirt-vintage",
                "sku" => "3604-nl-jersey-ringer-tee-vintage-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/vintage-shirt.jpg",
                "metaDesc" => "This vintage-styled t-shirt features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage.jpg",
                "shortDesc" => "This vintage-styled t-shirt features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "headerText" => "Vintage Mountain Shirt",
                "price" => 1,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage4.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Jokester Shirt",
                "slug" => "tshirt-jokester",
                "sku" => "3001C-unisex-crew-budumtss-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/jokester.jpg",
                "metaDesc" => "Ba-Dum-Tss. Wear the sound effect that's perfect for all of your good, bad, and dad jokes.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester4.jpg",
                "shortDesc" => "Ba-Dum-Tss. Wear the sound effect that's perfect for all of your good, bad, and dad jokes.",
                "headerText" => "Jokester Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/jokester2.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6,7
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Team-Player Shirt",
                "slug" => "tshirt-team-player",
                "sku" => "3200-3-4-baseball-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/team-player.jpg",
                "metaDesc" => "Be a sport! Knock your next gig or practice session out of the park with this baseball styled shirt.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team4.jpg",
                "shortDesc" => "Be a sport! Knock your next gig or practice session out of the park with this baseball styled shirt.",
                "headerText" => "Team-Player Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team5.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/team3.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "productType" => 4,
                "name" => "Death Drummer Shirt",
                "slug" => "tshirt-skull",
                "sku" => "3200c-3-4-baseball-skull-shirt",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/skull.jpg",
                "metaDesc" => "Rock on, metal heads! Pair yourself up with The Death Drummer and you'll be sure to make skeletons dance out of their graves.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull3.jpg",
                "shortDesc" => "Rock on, metal heads! Pair yourself up with The Death Drummer and you'll be sure to make skeletons dance out of their graves.",
                "headerText" => "Death Drummer Shirt",
                "price" => 25,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/skull.jpg",
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "productType" => 5,
                "name" => "Sketchy Drums Hoodie",
                "slug" => "hoodie-sketchy-drums",
                "sku" => "86228-sketchy-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/sketchy-hoodie.jpg",
                "metaDesc" => "Stay warm before & after the gig in the iconic “Sketchy Drums” Drumeo hoodie.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/hoodie2.jpg",
                "shortDesc" => "Stay warm before & after the gig in the iconic “Sketchy Drums” Drumeo hoodie.",
                "headerText" => "Sketchy Drums Hoodie",
                "price" => 59,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/hoodie2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/hoodie1.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "productType" => 5,
                "name" => "Retro Hoodie",
                "slug" => "hoodie-retro",
                "sku" => "ind4000-retro-hoodie-",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/retro-hoodie.jpg",
                "metaDesc" => "Stay cozy, comfy, AND colorful in this ultra-soft, vintage style Drumeo hoodie.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro1.jpg",
                "shortDesc" => "Stay cozy, comfy, AND colorful in this ultra-soft, vintage style Drumeo hoodie.",
                "headerText" => "Retro Hoodie",
                "price" => 59,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Cozy and comfy! The Drumeo Retro Hoodie features the Drumeo logo in a splash of color that will transport you to the time of Ringo’s reign. This generous fitting sweatshirt, in bone white, features a fleece-lined hood and handy front pouch pocket -- for your drumsticks, obviously."
                ],
                "specs" => [
                    [
                        "title" => "Unisex, Baggy Fit",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro1.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2020-merch/retro3.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "productType" => 5,
                "name" => "Minimalist Zip-Up Hoodie",
                "slug" => "hoodie-minimalist",
                "sku" => "3939-full-zip-minimalist-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/minimalist-hoodie.jpg",
                "metaDesc" => "Simple and clean. The minimalist zip-up hoodie features a discreet Drumeo logo and a branded snare icon on the back.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie4.jpg",
                "shortDesc" => "Simple and clean. The minimalist hooded zip features a discreet Drumeo logo and a branded snare icon on the side. It fits a size smaller than standard hoodies.",
                "headerText" => "Minimalist Zip-Up Hoodie",
                "price" => 59,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie6.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie4.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/minimalist-hoodie5.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
            [
                "brand" => 1,
                "productType" => 5,
                "name" => "Vintage Mountain Hoodie",
                "slug" => "hoodie-vintage",
                "sku" => "8885-hooded-vintage-pullover-hoodie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/vintage-hoodie.jpg",
                "metaDesc" => "This vintage-styled hoodie features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie2.jpg",
                "shortDesc" => "This vintage-styled hoodie features the view from Cheam Mountain in Canada, where we took a drumkit for a photo-op!",
                "headerText" => "",
                "price" => 59,
                "discountedPrice" => "",
                "specialText" => "",
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
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie2.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie3.jpg",
                    "https://s3.amazonaws.com/drumeo-packs/Merch/2018-merch/vintage-hoodie4.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [
                    2,3,4,5,6
                ]
            ],
//            [
//                "brand" => 1,
//                "productType" => 5,
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
