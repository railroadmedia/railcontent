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
                "name" => "Drumeo EarDRUM In-Ear Monitors",
                "slug" => "eardrums",
                "sku" => "drumeo-eardrums",
                "thumbnail" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/card-thumbs/drumeo-eardrums.jpg",
                "metaDesc" => "Protect your ears + play your favorite songs.",
                "metaImg" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/eardrums/Pro_BG2.jpg",
                "shortDesc" => "Feel every kick drum while protecting your ears. Drumeo’s new EarDRUMS are professional-quality in-ear monitors for drummers of all levels.",
                "headerText" => "",
                "price" => 149,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => true,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo QuietKick",
                "slug" => "quietkick",
                "sku" => "quietkick",
                "thumbnail" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/card-thumbs/quietkick.jpg",
                "metaDesc" => "Improve your kick foot anywhere.",
                "metaImg" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/fb-share-image.jpg",
                "shortDesc" => "Improve your kick foot anywhere.",
                "headerText" => "",
                "price" => 79,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo Tone Control Kit",
                "slug" => "tone-control-kit",
                "sku" => "tone-control-kit",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/tone-control-kit.jpg",
                "metaDesc" => "Better drum sounds in seconds.",
                "metaImg" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/og-image.jpg",
                "shortDesc" => "The Drumeo Tone Control Kit helps you balance overtones with four adjustable levels of dampening in one simple system.",
                "headerText" => "",
                "price" => 72,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => true,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo Comfort Cover",
                "slug" => "comfort-cover",
                "sku" => "comfort-cover",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/shop-image.jpg",
                "metaDesc" => "Upgrade any round drum throne in seconds.",
                "metaImg" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/fb-share-image.jpg",
                "shortDesc" => "The Comfort Cover absorbs shock, distributes your weight evenly, and improves your posture behind the drums.",
                "headerText" => "",
                "price" => 149,
                "discountedPrice" => 97,
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Vater Drumeo 5A Drumsticks",
                "slug" => "drumsticks",
                "sku" => "Drumeo-VaterSticks",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/cart-image.jpg",
                "metaDesc" => "Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.",
                "metaImg" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/og-image.jpg",
                "shortDesc" => "Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.",
                "headerText" => "",
                "price" => 12.95,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "The P4 Practice Pad",
                "slug" => "practice-pad-full",
                "sku" => "practicepad",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/p4.jpg",
                "metaDesc" => "Four unique playing surfaces. Three levels for movement. The Drumeo P4 Practice Pad by Pat Petrillo was designed to help you develop more skills that will transfer easily to the drum set. Click here to see the difference.",
                "metaImg" => "https://i.vimeocdn.com/video/601570925-0bd7be34161bdea9c32b201d4225c3e9924bb83c52ff0089ac52112cbd181824-d_1200",
                "shortDesc" => "The most versatile practice pad in the world, featuring four playing surfaces on three different levels for simulating movement around the kit.",
                "headerText" => "",
                "price" => 79,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo QuietPad",
                "slug" => "quietpad",
                "sku" => "quietpad",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/quiet-pad.png",
                "metaDesc" => "Practice anywhere with two full-size playing surfaces.",
                "metaImg" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/og-image.jpg",
                "shortDesc" => "Practice anywhere with two full-size playing surfaces.",
                "headerText" => "",
                "price" => 35,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "The Drummer’s Toolbox",
                "slug" => "the-drummers-toolbox",
                "sku" => "the-drummers-toolbox-book",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/cart-image.png",
                "metaDesc" => "The Drummer’s Toolbox presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.",
                "metaImg" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/og-image.jpg",
                "shortDesc" => "The Drummer’s Toolbox presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.",
                "headerText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "The Best Beginner Drum Book",
                "slug" => "beginner-book",
                "sku" => "BeginnerBook",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/cart-pic-2.png",
                "metaDesc" => "The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level.",
                "metaImg" => "https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/og-image.jpg",
                "shortDesc" => "The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level. (210 pages)",
                "headerText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo Water Bottle",
                "slug" => "water-bottle",
                "sku" => "Drumeo-Water-Bottle",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/bottle.jpg",
                "metaDesc" => "Stainless steel water bottle to quench your thirst on the drums.",
                "metaImg" => null,
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
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Piano Chords & Scales",
                "slug" => "chords-scales-book",
                "sku" => "piano-chords-and-scales-guide",
                "thumbnail" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
                "metaDesc" => "Master every single chord and scale with this comprehensive guide.",
                "metaImg" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
                "shortDesc" => "Master Every Chord. Every Scale. In Every Key.",
                "headerText" => "Piano Chords & Scales The Ultimate Guide",
                "price" => 39,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '8.5" x 6.5"'
                    ],
                    [
                        "title" => "Weight",
                        "desc" => "1 lbs"
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "143 pages"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-117.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-103-Edit.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-109.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-118.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-111.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Member Piano Chords & Scales",
                "slug" => "chords-scales-book-members",
                "sku" => "piano-chords-and-scales-guide",
                "promoCode" => "member",
                "thumbnail" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
                "metaDesc" => "Master every single chord and scale with this comprehensive guide.",
                "metaImg" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
                "shortDesc" => "Master Every Chord. Every Scale. In Every Key.",
                "headerText" => "Piano Chords & Scales The Ultimate Guide",
                "price" => 39,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '8.5" x 6.5"'
                    ],
                    [
                        "title" => "Weight",
                        "desc" => "1 lbs"
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "143 pages"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-117.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-103-Edit.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-109.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-118.jpg",
                    "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-111.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Pianote Practice Planner",
                "slug" => "practice-planner",
                "sku" => "pianote-practice-planner",
                "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-front-cover.jpg",
                "metaDesc" => "The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.",
                "metaImg" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner-6.jpg",
                "shortDesc" => "Always know exactly what to practice.",
                "headerText" => "The Pianote Practice Planner",
                "price" => 39,
                "discountedPrice" => "",
                "page_logo" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/logo.png",
                "specialText" => "",
                "overview" => "Always know exactly what to practice.

They say practice makes perfect.

It’s a cliche -- but it’s not entirely true. Because if you’re not practicing the RIGHT things -- the RIGHT way....

You won’t be perfect.

Worse -- you could be wasting your time.

The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.

This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.",
                "product_img" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner.jpg",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '9.5" x 6"'
                    ],
                    [
                        "title" => "Weight",
                        "desc" => "1.3 lbs"
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "198 pages total. Includes 12 undated months, chord reference chart, note reference guide, blank pages for notes, blank ledger-line pages"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-front-cover.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-side-thickness.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-back-cover.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-sample-week.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-welcome-goal-setting.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-chords.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-note-values-repertoire.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-blank-week.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-staff-pages.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Member Pianote Practice Planner",
                "slug" => "practice-planner-members",
                "sku" => "pianote-practice-planner",
                "promoCode" => "member",
                "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-front-cover.jpg",
                "metaDesc" => "The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.",
                "metaImg" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner-6.jpg",
                "shortDesc" => "Always know exactly what to practice.",
                "headerText" => "The Pianote Practice Planner",
                "price" => 39,
                "discountedPrice" => "",
                "page_logo" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/logo.png",
                "specialText" => "",
                "overview" => "Always know exactly what to practice.

They say practice makes perfect.

It’s a cliche -- but it’s not entirely true. Because if you’re not practicing the RIGHT things -- the RIGHT way....

You won’t be perfect.

Worse -- you could be wasting your time.

The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.

This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.",
                "product_img" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner.jpg",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '9.5" x 6"'
                    ],
                    [
                        "title" => "Weight",
                        "desc" => "1.3 lbs"
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "198 pages total. Includes 12 undated months, chord reference chart, note reference guide, blank pages for notes, blank ledger-line pages"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-front-cover.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-side-thickness.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-back-cover.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-sample-week.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-welcome-goal-setting.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-chords.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-note-values-repertoire.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-blank-week.jpg",
                    "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-staff-pages.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Chords Poster",
                "slug" => "chords-poster",
                "sku" => "poster-chords",
                "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/card-chords-poster.jpg",
                "metaDesc" => "The Pianote Chords Poster is your at-a-glance cheat sheet for nailing down all those hard chord shapes.",
                "metaImg" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/chords-poster.jpg",
                "shortDesc" => "Your at-a-glance cheat sheet for nailing down all those hard chord shapes.",
                "headerText" => "*NEW* Pianote Chords Poster",
                "price" => 9,
                "discountedPrice" => "",
                "specialText" => "",
                "overview" => "**Always know your chord shapes.**

The Pianote Chords Poster is your at-a-glance cheat sheet for nailing down all those hard chord shapes.

This easy-to-read poster is designed to help you quickly recall the different chord shapes.

So when you’re trying out some new chords, or a new song you’re learning has a chord you rarely play, all you have to do is look up!

At 17” x 22” this helpful poster can keep your chording on track. Don’t waste your time searching for chord shapes when you can have the answer right above your piano.",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Dimensions",
                        "desc" => '17" x 22"'
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/shop/products/2021-merch/chords-poster.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Scales Poster",
                "slug" => "scales-poster",
                "sku" => "poster-scales",
                "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/card-scales-poster.jpg",
                "metaDesc" => "The Pianote Scales Poster is your saving grace for trying to remember those tricky scales.",
                "metaImg" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/scales-poster.jpg",
                "shortDesc" => "Your saving grace for trying to remember those tricky scales.",
                "headerText" => "*NEW* Pianote Scales Poster",
                "price" => 9,
                "discountedPrice" => "",
                "specialText" => "",
                "overview" => "**Always know your scales.**

The Pianote Scales Poster is your saving grace for trying to remember those tricky scales.

This easy-to-read poster is designed to help you quickly recall the right notes at the right time, making your scales (or soloing) a piece of cake.

Whenever you’re having trouble remembering what notes to play, all you have to do is look up!

At 22” x 17” this helpful cheat sheet can be placed anywhere you like to make your practice space more musical, and your playing more efficient.",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Dimensions",
                        "desc" => '22" x 17"'
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/shop/products/2021-merch/scales-poster.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Sketchy Mug",
                "slug" => "mug-sketchy",
                "sku" => "pianote-sketchy-mug",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/sketchy-mug.jpg",
                "metaDesc" => "Matte white on the outside with a black/red sketchy Pianote logo, and red on the inside.",
                "metaImg" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-sketch-2.jpg",
                "shortDesc" => "Matte white on the outside with a black/red sketchy Pianote logo, and red on the inside.",
                "headerText" => "Sketchy Mug",
                "price" => 12,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Get your daily dose of energy (and caffeine) with this 15oz ceramic coffee mug. Matte white on the outside with a black/red sketchy Pianote logo, and red on the inside."
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "15 oz"
                    ],
                    [
                        "title" => "Height",
                        "desc" => '4.875"'
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
                        "desc" => "Matte white exterior, red interior."
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Hand wash recommended."
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
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-sketch-2.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-sketch-1.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Music Brings Happiness Mug",
                "slug" => "mug-floral",
                "sku" => "floral-mug",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/floral-mug.jpg",
                "metaDesc" => "Music brings happiness. It’s as simple as that.",
                "metaImg" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-1.jpg",
                "shortDesc" => "Music brings happiness. It’s as simple as that.",
                "headerText" => "Music Brings Happiness Mug",
                "price" => 12,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Music brings happiness. It’s as simple as that. Start each day with a cup of happiness in this 15oz ceramic coffee mug."
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "15 oz"
                    ],
                    [
                        "title" => "Height",
                        "desc" => '4.875"'
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
                        "desc" => "Matte white with floral graphic exterior, red interior"
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Hand wash recommended."
                    ],
                    [
                        "title" => "Microwave",
                        "desc" => "Microwave safe."
                    ],
                ],
                "visible" => true,
                "soldOut" => true,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-1.jpg",
                    "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-2.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 3,
                "productType" => 2,
                "name" => "Guitareo Survival Guide",
                "slug" => "survival-guide",
                "sku" => "survival-guide",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-108-Edit.jpg",
                "metaDesc" => "The Guitareo Survival Guide is perfect for adding a little fun while navigating your way through the wild and rewarding world of learning how to play the guitar.",
                "metaImg" => "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-102.jpg",
                "shortDesc" => "Guitar Chords Scales And Licks You Can Take Anywhere",
                "headerText" => "The Guitareo Survival Guide",
                "price" => 19,
                "discountedPrice" => "",
                "specialText" => "or free with Guitareo",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '8.5" x 5.5"'
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "37 pages total, includes fretboard diagram, chord reference chart, strumming pattern"
                    ],
                    [
                        "title" => "Page Material",
                        "desc" => "Pacesetter Silk"
                    ],
                    [
                        "title" => "Binding",
                        "desc" => "Black Wire"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-102-Edit.jpg",
                    "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-108-Edit.jpg",
                    "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-104-Edit.jpg",
                    "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-105-Edit.jpg",
                    "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-106-Edit.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],

            [
                "brand" => 4,
                "productType" => 2,
                "name" => "Rockstar Mug",
                "slug" => "mug-rockstar",
                "sku" => "mouth-mug",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/mug-rockstar.jpg",
                "metaDesc" => "keep your vocal cords hydrated with this super rad mug.",
                "metaImg" => "https://singeo.s3.amazonaws.com/products/mug-rockstar-thumb.png",
                "shortDesc" => "Keep your vocal cords hydrated with this super rad mug.",
                "headerText" => "The Singeo Rockstar Mug",
                "price" => 12,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Keep your vocal cords hydrated with this super rad mug."
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "12 oz"
                    ],
                    [
                        "title" => "Height",
                        "desc" => '4.875"'
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
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Dishwasher recommended."
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
                    "https://singeo.s3.amazonaws.com/products/mug-rockstar-thumb.png"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 4,
                "productType" => 2,
                "name" => "Vowel Practice Poster",
                "slug" => "poster-vowels",
                "sku" => "vowel-sounds-poster",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/poster-vowel2.png",
                "metaDesc" => "Your new favorite practice tool.",
                "metaImg" => "https://singeo.s3.amazonaws.com/products/poster-vowel-thumb2.png",
                "shortDesc" => "Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.",
                "headerText" => "Vowel Practice Poster",
                "price" => 12,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "Your new favorite practice tool - and your ticket to hitting higher notes with ease and confidence."
                ],
                "specs" => [
                    [
                        "title" => "Dimensions",
                        "desc" => '22" x 17"'
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Gloss"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://singeo.s3.amazonaws.com/products/poster-vowel-thumb2.png"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 4,
                "productType" => 2,
                "name" => "Do Re Mi Tumbler",
                "slug" => "tumbler-doremi",
                "sku" => "wallflower-tumbler",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
                "metaDesc" => "Your new favorite practice tool.",
                "metaImg" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
                "shortDesc" => "This cozy tumbler will keep you hydrated at home or on the go.",
                "headerText" => "Singeo Do-Re-Mi Tumbler",
                "price" => 29,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "The singer’s companion! This cozy tumbler will keep you hydrated at home or on the go."
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "20.9 oz"
                    ],
                    [
                        "title" => "Materials",
                        "desc" => "Double wall stainless steel with copper vacuum insulation"
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Matte pearlized finish"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-110.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-100.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-124.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-109.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-120-Edit.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-104-2-up.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 4,
                "productType" => 2,
                "name" => "Member Do Re Mi Tumbler",
                "slug" => "tumbler-doremi-member",
                "sku" => "wallflower-tumbler",
                "promoCode" => "member",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
                "metaDesc" => "Your new favorite practice tool.",
                "metaImg" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
                "shortDesc" => "This cozy tumbler will keep you hydrated at home or on the go.",
                "headerText" => "Singeo Do-Re-Mi Tumbler",
                "price" => 29,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    "The singer’s companion! This cozy tumbler will keep you hydrated at home or on the go."
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "20.9 oz"
                    ],
                    [
                        "title" => "Materials",
                        "desc" => "Double wall stainless steel with copper vacuum insulation"
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Matte pearlized finish"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-110.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-100.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-124.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-109.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-120-Edit.jpg",
                    "https://singeo.s3.amazonaws.com/products/doremi-tumbler/2022-03-18-DoReMiMug-104-2-up.jpg"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "Drumeo Beanie",
                "slug" => "beanie",
                "sku" => "Drumeo-Beanie",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/beanie.jpg",
                "metaDesc" => "Smooth, slim fit keeps you warm + Drumeo logo keeps you cool.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Merch/beanie/1.jpg",
                "shortDesc" => "",
                "headerText" => "Drumeo Beanie",
                "price" => 19,
                "discountedPrice" => "",
                "specialText" => "",
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
                "brand" => 2,
                "productType" => 2,
                "name" => "Classical Piano Pieces",
                "slug" => "classical-book",
                "sku" => "classical-book",
                "thumbnail" => "https://pianote.s3.amazonaws.com/sales/promos/july/classical_piano_book.png",
                "badgeText" => "New",
                "metaDesc" => "Welcome to the world of classical piano music (you can actually play)!",
                "metaImg" => "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-103.png",
                "shortDesc" => "What good is learning classical piano if you don’t have beautiful music to play?",
                "headerText" => "Classical Piano Pieces (You Can Actually Play)",
                "price" => 39,
                "discountedPrice" => "",
                "specialText" => "",
                "overview" => "**Classical piano has a reputation.**

Let’s be honest…

Classical piano can seem a little elitist, even snobby. And that’s a shame. Because classical music is so beautiful.

So we’re out to change that reputation.

Welcome to the world of classical piano music (you can actually play)! This book is your gateway to famous composers, stunning piano pieces, and an entirely new and rewarding experience on the piano.

It’s your repertoire of beautiful classical pieces that you can actually play (and that people will want to hear)!

Here are some of our favorites:
  - Ukrainian Folk Song by Ludwig van Beethoven
  - Minuet in F Major by Wolfgang Amadeus Mozart
  - Prelude in C Major by Johann Sebastian Bach
  - Sonatina in B-flat Major by George Frideric Handel
  - Waltz in A Minor by Frédéric Chopin
And so many more!",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '11" x 8.5"'
                    ],
                    [
                        "title" => "Weight",
                        "desc" => "1 lbs"
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "92 pages"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-103.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-132.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-146.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-100.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-109.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-111.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-113.png"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 2,
                "productType" => 2,
                "name" => "Discounted Classical Piano Pieces",
                "slug" => "classical-book-discount",
                "sku" => "classical-book",
                "promoCode" => "member",
                "thumbnail" => "https://pianote.s3.amazonaws.com/sales/promos/july/classical_piano_book.png",
                "badgeText" => "New",
                "metaDesc" => "Welcome to the world of classical piano music (you can actually play)!",
                "metaImg" => "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-103.png",
                "shortDesc" => "What good is learning classical piano if you don’t have beautiful music to play?",
                "headerText" => "Classical Piano Pieces (You Can Actually Play)",
                "price" => 39,
                "discountedPrice" => "",
                "specialText" => "",
                "overview" => "**Classical piano has a reputation.**

Let’s be honest…

Classical piano can seem a little elitist, even snobby. And that’s a shame. Because classical music is so beautiful.

So we’re out to change that reputation.

Welcome to the world of classical piano music (you can actually play)! This book is your gateway to famous composers, stunning piano pieces, and an entirely new and rewarding experience on the piano.

It’s your repertoire of beautiful classical pieces that you can actually play (and that people will want to hear)!

Here are some of our favorites:
  - Ukrainian Folk Song by Ludwig van Beethoven
  - Minuet in F Major by Wolfgang Amadeus Mozart
  - Prelude in C Major by Johann Sebastian Bach
  - Sonatina in B-flat Major by George Frideric Handel
  - Waltz in A Minor by Frédéric Chopin
And so many more!",
                "features" => [
                ],
                "specs" => [
                    [
                        "title" => "Size",
                        "desc" => '11" x 8.5"'
                    ],
                    [
                        "title" => "Weight",
                        "desc" => "1 lbs"
                    ],
                    [
                        "title" => "Pages",
                        "desc" => "92 pages"
                    ],
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "images" => [
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-103.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-132.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-146.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-100.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-109.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-111.png",
                    "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-113.png"
                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 2,
                "name" => "",
                "slug" => "",
                "sku" => "",
                "thumbnail" => "",
                "metaDesc" => "",
                "metaImg" => "",
                "shortDesc" => "",
                "headerText" => "",
                "price" => 1,
                "discountedPrice" => "",
                "specialText" => "",
                "features" => [
                    ""
                ],
                "specs" => [
                    [
                        "title" => "Volume",
                        "desc" => "Unisex"
                    ],
                    [
                        "title" => "Height",
                        "desc" => "Flexfit Wool Blend 6477"
                    ],
                    [
                        "title" => "Diameter",
                        "desc" => "83% Acrylic / 14% Wool / 2% Spandex"
                    ],
                    [
                        "title" => "Materials",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Finish",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Washing",
                        "desc" => "Black"
                    ],
                    [
                        "title" => "Microwave",
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

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
//            [
//                "brand" => 3,
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
                'promo_code' => empty($product['promoCode']) ? null : $product['promoCode'],
                'page_logo' => empty($product['page_logo']) ? null : $product['page_logo'],
                'thumbnail' => $product['thumbnail'],
                'badge_text' => empty($product['badgeText']) ? null : $product['badgeText'],
                'header_text' => $product['headerText'],
                'short_desc' => $product['shortDesc'],
                'meta_desc' => $product['metaDesc'],
                'meta_img' => $product['metaImg'],
                'special_text' => $product['specialText'],
                'price' => $product['price'],
                'discounted_price' => $product['discountedPrice'],
                'overview' => empty($product['overview']) ? null : $product['overview'],
                'product_img' => empty($product['product_img']) ? null : $product['product_img'],
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
