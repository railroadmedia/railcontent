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
    const C = [
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo EarDRUM In-Ear Monitors",
            "slug" => "eardrums",
            "sku" => "drumeo-eardrums",
            "thumbnail" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/card-thumbs/drumeo-eardrums.jpg",
            "meta_desc" => "Protect your ears + play your favorite songs.",
            "meta_img" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/eardrums/Pro_BG2.jpg",
            "short_desc" => "Feel every kick drum while protecting your ears. Drumeo’s new EarDRUMS are professional-quality in-ear monitors for drummers of all levels.",
            "header_text" => "",
            "price" => 149,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ]
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo Comfort Cover",
            "slug" => "comfort-cover",
            "sku" => "comfort-cover",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/shop-image.jpg",
            "meta_desc" => "Upgrade any round drum throne in seconds.",
            "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/fb-share-image.jpg",
            "short_desc" => "The Comfort Cover absorbs shock, distributes your weight evenly, and improves your posture behind the drums.",
            "header_text" => "",
            "price" => 149,
            "discounted_price" => '',
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo QuietKick",
            "slug" => "quietkick",
            "sku" => "quietkick",
            "thumbnail" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/card-thumbs/quietkick.jpg",
            "meta_desc" => "Improve your kick foot anywhere.",
            "meta_img" => "https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/fb-share-image.jpg",
            "short_desc" => "Improve your kick foot anywhere.",
            "header_text" => "",
            "price" => 79,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_img' => 'https://drumeo-assets.s3.amazonaws.com/promos/july/quietkick_card.jpg',
            "bundle_desc" => "Improve your kick foot anywhere with the portable & quiet bass drum workout pad. Attaches to any single OR double pedal (pedal not included).",
            'bundle_free_shipping' => true,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ]
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "The P4 Practice Pad",
            "slug" => "practice-pad-full",
            "sku" => "practicepad",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/p4.jpg",
            "meta_desc" => "Four unique playing surfaces. Three levels for movement. The Drumeo P4 Practice Pad by Pat Petrillo was designed to help you develop more skills that will transfer easily to the drum set. Click here to see the difference.",
            "meta_img" => "https://i.vimeocdn.com/video/601570925-0bd7be34161bdea9c32b201d4225c3e9924bb83c52ff0089ac52112cbd181824-d_1200",
            "short_desc" => "The most versatile practice pad in the world, featuring four playing surfaces on three different levels for simulating movement around the kit.",
            "header_text" => "",
            "price" => 79,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/p4.jpg',
            "bundle_desc" => "The P4 Practice Pad is the most versatile practice pad in the world -- with four different playing surfaces to replicate different parts of the drum set. When you’re running rudiments & stickings at the pad, you’re still getting the various feels of your drum set.",
            'bundle_free_shipping' => true,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ]
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo Tone Control Kit",
            "slug" => "tone-control-kit",
            "sku" => "tone-control-kit",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/tone-control-kit.jpg",
            "meta_desc" => "Better drum sounds in seconds.",
            "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/og-image.jpg",
            "short_desc" => "The Drumeo Tone Control Kit helps you balance overtones with four adjustable levels of dampening in one simple system.",
            "header_text" => "",
            "price" => 79,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo QuietPad",
            "slug" => "quietpad",
            "sku" => "quietpad",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/quiet-pad.png",
            "meta_desc" => "Practice anywhere with two full-size playing surfaces.",
            "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/og-image.jpg",
            "short_desc" => "Practice anywhere with two full-size playing surfaces.",
            "header_text" => "",
            "price" => 35,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/pad.jpg',
            "bundle_desc" => "Practice anywhere with two full-size playing surfaces. The QuietPad offers a traditional side with realistic snare-like rebound, and a quiet side that’ll allow you to practice late into the night.",
            'bundle_free_shipping' => true,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "The Drummer’s Toolbox",
            "slug" => "the-drummers-toolbox",
            "sku" => "the-drummers-toolbox-book",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/cart-image.png",
            "meta_desc" => "The Drummer’s Toolbox presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.",
            "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/og-image.jpg",
            "short_desc" => "The Drummer’s Toolbox presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.",
            "header_text" => "",
            "price" => 29.99,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "The Best Beginner Drum Book",
            "slug" => "beginner-book",
            "sku" => "BeginnerBook",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/cart-pic-2.png",
            "meta_desc" => "The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level.",
            "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/og-image.jpg",
            "short_desc" => "The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level. (210 pages)",
            "header_text" => "",
            "price" => 29.99,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/bbdb.jpg',
            "bundle_desc" => "It’s the perfect companion to your morning coffee. The Best Beginner Drum Book is the simplest guide for beginner drummers to get started on the drums and advance to the next level. You’ll have all your information in one easy-to-reference guide.",
            'bundle_free_shipping' => true,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Vater Drumeo 5A Drumsticks",
            "slug" => "drumsticks",
            "sku" => "Drumeo-VaterSticks",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/cart-image.jpg",
            "meta_desc" => "Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.",
            "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/og-image.jpg",
            "short_desc" => "Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.",
            "header_text" => "",
            "price" => 12.95,
            "discounted_price" => "",
            "special_text" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
            "bundle_desc" => "Our new Drumeo 5A Drumsticks by Vater -- made of hickory for strength and durability, featuring up to 2X the moisture content than most manufacturers for longer lasting sticks, and personally hand-rolled by Alan Vater to ensure they’re weighted and tone-matched to perfection.",
            'bundle_free_shipping' => true,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drummer Towels",
            "slug" => "drummer-towels",
            "sku" => "Drumeo-Towel",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/towel.jpg",
            "meta_desc" => "Play the drums until you sweat - and then play some more.",
            "meta_img" => "",
            "short_desc" => "Play the drums until you sweat - and then play some more. 16” x 25”, navy with a 4” white Drumeo embroidered logo.",
            "header_text" => "Drummer Towel",
            "price" => 19,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => true,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://s3.amazonaws.com/drumeo-packs/Merch/towel/1-blue.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/towel/2-blue.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/towel/3-blue.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo Water Bottle",
            "slug" => "water-bottle",
            "sku" => "Drumeo-Water-Bottle",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/bottle.jpg",
            "meta_desc" => "Stainless steel water bottle to quench your thirst on the drums.",
            "meta_img" => null,
            "short_desc" => "24oz stainless steel water bottle with a matte black finish and a blue/white Drumeo logo.",
            "header_text" => "Drumeo Water Bottle",
            "price" => 12,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => true,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/1.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/2.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/3.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/4.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/water-bottle/5.jpg",
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 1,
            "product_type_id" => 2,
            "name" => "Drumeo Coffee Mug",
            "slug" => "coffee-mug",
            "sku" => "Drumeo-Mug",
            "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/mug.jpg",
            "meta_desc" => "Ceramic coffee mug: your daily dose of energy to play the drums.",
            "meta_img" => "",
            "short_desc" => "Get your daily dose of energy for playing the drums with our 15oz ceramic coffee mug -- black outside with a blue/white logo, and blue inside.",
            "header_text" => "Drumeo Coffee Mug",
            "price" => 12,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => true,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://s3.amazonaws.com/drumeo-packs/Merch/mug/1.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/mug/2.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/mug/3.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/mug/4.jpg",
                "https://s3.amazonaws.com/drumeo-packs/Merch/mug/5.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Pianote Headphones",
            "slug" => "concert-headphones",
            "sku" => "pianote-headphones",
            "thumbnail" => "https://pianote.s3.amazonaws.com/shop/card-thumbs/headphones-cart.jpg",
            "meta_desc" => "Enhance your playing experience.",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/concert-headphones/fb-share-image.jpg",
            "short_desc" => "Enhance your playing experience.",
            "header_text" => "Piano Chords & Scales The Ultimate Guide",
            "price" => 189,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "",
            "features" => [
            ],
            "specs" => [

            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [

            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/shop/card-thumbs/headphones-cart.jpg',
            "bundle_desc" => "These beautiful hi-end headphones are by piano players for piano players. Lightweight with comfortable ear padding for extended playing sessions and unrivalled sound definitition and bass response. Your playing has never sounded so good.",
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Pianote Christmas Songbook",
            "slug" => "christmas-book",
            "sku" => "christmas-song-book",
            "thumbnail" => "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-02.jpg",
            "meta_desc" => "Play Your Favorite Christmas Songs on the Piano",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-digital-spread.jpg",
            "short_desc" => "Play Your Favorite Christmas Songs on the Piano",
            "header_text" => "The Pianote Christmas Songbook",
            "price" => 39,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "**Chestnuts roasting on an open fire…**

Logs crackling in the fireplace. Snowflakes fluttering against the window.

Beautiful Christmas songs sung around the piano.

Embrace the joy of Christmas with 14 beautiful songs, hand-picked and arranged for solo piano. And yes, “The Christmas Song” is one of them.

Learn these beautiful songs in time for Christmas around the piano with your loved ones.

Here’s the full list:

   • Away in a Manger
   • Carol of the Bells
   • Christmas Time is Here
   • Dance of the Sugarplum Fairy
   • Frosty the Snowman
   • God Rest Ye Merry Gentlemen
   • Joy to the World
   • O Christmas Tree
   • O Holy Night
   • Rudolph the Red-Nosed Reindeer
   • Silent Night
   • The Christmas Song
   • The First Noel
   • We Wish You a Merry Christmas

Presented in full color and spiral-bound so it always lays flat on your music stand, this book is the perfect way to spread cheer this Christmas.

Your book will typically be shipped out from our fulfillment center within 2-3 business days. While you’re waiting for your physical book to arrive, you can start learning thanks to your BONUS Digital Copy of the book.

You’ll get 10 of the 14 songs delivered to your inbox immediately after completing your purchase. You can download and print them and start learning your favorites while you wait for your book to arrive.",
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
                    "desc" => "38 pages"
                ],
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-01.jpg",
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-02.jpg",
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-04.jpg",
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-03.jpg",
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/christmas-book.jpg',
            "bundle_desc" => "Play the most beautiful Christmas Carols with the Pianote Christmas Songbook. You’ll get 14 stunning songs hand-picked and arranged for solo piano. Spiral-bound so it lays perfectly flat on your piano, these songs will bring joy to anyone who plays them.",
            'bundle_free_shipping' => true,
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Member Pianote Christmas Songbook",
            "slug" => "christmas-book-members",
            "sku" => "christmas-song-book",
            "thumbnail" => "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-02.jpg",
            "meta_desc" => "Play Your Favorite Christmas Songs on the Piano",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-digital-spread.jpg",
            "short_desc" => "Play Your Favorite Christmas Songs on the Piano",
            "header_text" => "The Pianote Christmas Songbook",
            "price" => 39,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "**Chestnuts roasting on an open fire…**

Logs crackling in the fireplace. Snowflakes fluttering against the window.

Beautiful Christmas songs sung around the piano.

Embrace the joy of Christmas with 14 beautiful songs, hand-picked and arranged for solo piano. And yes, “The Christmas Song” is one of them.

Learn these beautiful songs in time for Christmas around the piano with your loved ones.

Here’s the full list:

   • Away in a Manger
   • Carol of the Bells
   • Christmas Time is Here
   • Dance of the Sugarplum Fairy
   • Frosty the Snowman
   • God Rest Ye Merry Gentlemen
   • Joy to the World
   • O Christmas Tree
   • O Holy Night
   • Rudolph the Red-Nosed Reindeer
   • Silent Night
   • The Christmas Song
   • The First Noel
   • We Wish You a Merry Christmas

Presented in full color and spiral-bound so it always lays flat on your music stand, this book is the perfect way to spread cheer this Christmas.

Your book will typically be shipped out from our fulfillment center within 2-3 business days. While you’re waiting for your physical book to arrive, you can start learning thanks to your BONUS Digital Copy of the book.

You’ll get 10 of the 14 songs delivered to your inbox immediately after completing your purchase. You can download and print them and start learning your favorites while you wait for your book to arrive.",
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
                    "desc" => "38 pages"
                ],
            ],
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-01.jpg",
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-02.jpg",
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-04.jpg",
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-book-03.jpg",
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/christmas-book.jpg',
            "bundle_desc" => "Play the most beautiful Christmas Carols with the Pianote Christmas Songbook. You’ll get 14 stunning songs hand-picked and arranged for solo piano. Spiral-bound so it lays perfectly flat on your piano, these songs will bring joy to anyone who plays them.",
            'bundle_free_shipping' => true,
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Pianote Digital Christmas Songbook",
            "slug" => "christmas-book-digital",
            "sku" => "christmas-song-book-digital",
            "thumbnail" => "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-digital-spread.jpg",
            "meta_desc" => "Play Your Favorite Christmas Songs on the Piano",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-digital-spread.jpg",
            "short_desc" => "Play Your Favorite Christmas Songs on the Piano",
            "header_text" => "The Pianote Digital Christmas Songbook",
            'subheader_text' => 'Play Your Favorite Christmas Songs on the Piano',
            "price" => 10,
            "discounted_price" => "",
            "special_text" => "Just $1 per song.",
            'overview' => "**Logs crackling in the fireplace…**

Snowflakes fluttering against the window. Beautiful Christmas songs sung around the piano.

Embrace the joy of Christmas with 10 beautiful songs, hand-picked and arranged for solo piano.

Learn these beautiful songs in time for Christmas around the piano with your loved ones.

Here’s the full list:

    • Away in a Manger
    • Carol of the Bells
    • Dance of the Sugarplum Fairy
    • God Rest Ye Merry Gentlemen
    • Joy to the World
    • O Christmas Tree
    • O Holy Night
    • Silent Night
    • The First Noel
    • We Wish You a Merry Christmas

And because it’s a digital copy, you’ll have instant access to all the songs. No need to wait for shipping (let alone pay for it). Download the book the second you buy it.",
            "features" => [
            ],
            "specs" => [
                [
                    "title" => "Pages",
                    "desc" => "25 pages"
                ],
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://pianote.s3.amazonaws.com/products/christmas-book/christmas-digital-spread.jpg",
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/christmas-songbook-card.jpg',
            "bundle_desc" => "Embrace the joy of the Holiday Season with this digital version of our Christmas Songbook. You’ll get 10 beautiful Christmas Carols arranged for solo piano that you can download, print, and play at home. Perfect for beginners and early intermediate players, these songs will make this Christmas season one to remember.",
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Classical Piano Pieces",
            "slug" => "classical-book",
            "sku" => "classical-book",
            "thumbnail" => "https://pianote.s3.amazonaws.com/sales/promos/july/classical_piano_book.png",
            "meta_desc" => "Welcome to the world of classical piano music (you can actually play)!",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-103.png",
            "short_desc" => "What good is learning classical piano if you don’t have beautiful music to play?",
            "header_text" => "Classical Piano Pieces (You Can Actually Play)",
            "price" => 39,
            "discounted_price" => "",
            "special_text" => "",
            "overview" => "**Classical piano has a reputation.**

Let’s be honest…

Classical piano can seem a little elitist, even snobby. And that’s a shame. Because classical music is so beautiful.

So we’re out to change that reputation.

Welcome to the world of classical piano music (you can actually play)! This book is your gateway to famous composers, stunning piano pieces, and an entirely new and rewarding experience on the piano.

It’s your repertoire of beautiful classical pieces that you can actually play (and that people will want to hear)!

Here are some of our favorites:
  • Ukrainian Folk Song by Ludwig van Beethoven
  • Minuet in F Major by Wolfgang Amadeus Mozart
  • Prelude in C Major by Johann Sebastian Bach
  • Sonatina in B-flat Major by George Frideric Handel
  • Waltz in A Minor by Frédéric Chopin
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/july/classical_piano_book_list.jpg',
            'bundle_desc' => 'What good is learning classical piano if you don’t have beautiful music to play? This NEW book is 92 pages full of beautiful pieces by famous classical composers that you can actually play! The perfect companion to The Classical Method, each piece has been hand-selected to be appropriate for your skill level - while still sounding beautiful. Beethoven, Chopin, Bach, they’re all in here.',
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Member Classical Piano Pieces",
            "slug" => "classical-book-discount",
            "sku" => "products[classical-book]=1&promo-code=member",
            "thumbnail" => "https://pianote.s3.amazonaws.com/sales/promos/july/classical_piano_book.png",
            "badge_text" => "New",
            "meta_desc" => "Welcome to the world of classical piano music (you can actually play)!",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/classical-book/2022-07-14-pianote-classical-book-103.png",
            "short_desc" => "What good is learning classical piano if you don’t have beautiful music to play?",
            "header_text" => "Classical Piano Pieces (You Can Actually Play)",
            "price" => 39,
            "discounted_price" => "",
            "special_text" => "",
            "overview" => "**Classical piano has a reputation.**

Let’s be honest…

Classical piano can seem a little elitist, even snobby. And that’s a shame. Because classical music is so beautiful.

So we’re out to change that reputation.

Welcome to the world of classical piano music (you can actually play)! This book is your gateway to famous composers, stunning piano pieces, and an entirely new and rewarding experience on the piano.

It’s your repertoire of beautiful classical pieces that you can actually play (and that people will want to hear)!

Here are some of our favorites:
  • Ukrainian Folk Song by Ludwig van Beethoven
  • Minuet in F Major by Wolfgang Amadeus Mozart
  • Prelude in C Major by Johann Sebastian Bach
  • Sonatina in B-flat Major by George Frideric Handel
  • Waltz in A Minor by Frédéric Chopin
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
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/july/classical_piano_book_list.jpg',
            'bundle_desc' => 'What good is learning classical piano if you don’t have beautiful music to play? This NEW book is 92 pages full of beautiful pieces by famous classical composers that you can actually play! The perfect companion to The Classical Method, each piece has been hand-selected to be appropriate for your skill level - while still sounding beautiful. Beethoven, Chopin, Bach, they’re all in here.',
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Piano Chords & Scales",
            "slug" => "chords-scales-book",
            "sku" => "piano-chords-and-scales-guide",
            "thumbnail" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
            "meta_desc" => "Master every single chord and scale with this comprehensive guide.",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
            "short_desc" => "Master Every Chord. Every Scale. In Every Key.",
            "header_text" => "Piano Chords & Scales The Ultimate Guide",
            "price" => 39,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "**Master Every Chord. Every Scale. In Every Key.**

This brand new book will help you learn every chord shape, chord variation, and scale in EVERY key.

It’s the ultimate guide to mastering the building blocks of music on the piano.

The handy tabs on the side will make it easy to look up any key signature and quickly find all the different scales and chords you need when it comes time to practice or learn a new song.

Here’s what that means:

Say you're learning a new song, and it's in the key of Eb major. But you haven't learned Eb yet. Easy...

You simply pull out your handy Chords & Scales Book and use the keyboard tabs on the side to find Eb and quickly flip to the page:

<img src='https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-107-Edit.jpg' alt='image 1' />

In there, you'll find all the major, minor, sus, and 7th chords you can expect in Eb, along with the notes of 9 different scales all starting on Eb.

Or, say you need to quickly find an F major chord in 1st inversion. Again, just use the tab to flip to F and find all the information you need:

<img src='https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-108-Edit.jpg' alt='image 2' />

Easy peasy!

Start Mastering your Chords & Scales today.",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/2022/bonus-chords-scales.jpg',
            "bundle_desc" => "You need chords to play your favorite songs, but learning them all can be a real challenge. The Piano Chords & Scales book is your go-to reference guide so you’ll never get stuck again. See a chord you don’t know? Simply flip to the relevant page in your book and you’ll see all the inversions and alterations you need to play beautifully and confidently. Don’t let scary-looking chords slow your progress.",
            'bundle_free_shipping' => true,
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Member Piano Chords & Scales",
            "slug" => "chords-scales-book-members",
            "sku" => "products[piano-chords-and-scales-guide]=1&promo-code=member",
            "promo_code" => "member",
            "thumbnail" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
            "meta_desc" => "Master every single chord and scale with this comprehensive guide.",
            "meta_img" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
            "short_desc" => "Master Every Chord. Every Scale. In Every Key.",
            "header_text" => "Piano Chords & Scales The Ultimate Guide",
            "price" => 39,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "**Master Every Chord. Every Scale. In Every Key.**

This brand new book will help you learn every chord shape, chord variation, and scale in EVERY key.

It’s the ultimate guide to mastering the building blocks of music on the piano.

The handy tabs on the side will make it easy to look up any key signature and quickly find all the different scales and chords you need when it comes time to practice or learn a new song.

Here’s what that means:

Say you're learning a new song, and it's in the key of Eb major. But you haven't learned Eb yet. Easy...

You simply pull out your handy Chords & Scales Book and use the keyboard tabs on the side to find Eb and quickly flip to the page:

<img src='https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-107-Edit.jpg' alt='image 1' />

In there, you'll find all the major, minor, sus, and 7th chords you can expect in Eb, along with the notes of 9 different scales all starting on Eb.

Or, say you need to quickly find an F major chord in 1st inversion. Again, just use the tab to flip to F and find all the information you need:

<img src='https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-108-Edit.jpg' alt='image 2' />

Easy peasy!

Start Mastering your Chords & Scales today.",
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
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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
            "product_type_id" => 2,
            "name" => "Pianote Practice Planner",
            "slug" => "practice-planner",
            "sku" => "pianote-practice-planner",
            "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-front-cover.jpg",
            "meta_desc" => "The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.",
            "meta_img" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner-6.jpg",
            "short_desc" => "Always know exactly what to practice.",
            "header_text" => "The Pianote Practice Planner",
            "price" => 39,
            "discounted_price" => "",
            "page_logo" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/logo.png",
            "special_text" => "",
            "video" => "//player.vimeo.com/video/492665630",
            "overview" => "**Always know exactly what to practice.**

They say practice makes perfect.

It’s a cliche -- but it’s not entirely true. Because if you’re not practicing the RIGHT things -- the RIGHT way....

You won’t be perfect.

Worse -- you could be wasting your time.

The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.

This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.

        <a target=\"_blank\" class=\"text-center\" style=\"display:inline-block\" href=\"https://pianote.s3.amazonaws.com/shop/products/practice-planner/preview.pdf\">
            <strong>Click to see inside &raquo;</strong><br>
            <img class='w-full mt-1' src=\"https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner.jpg\" alt='sample image' />
        </a>",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://i.vimeocdn.com/video/1024585383-ee7ef1199d46e1c795118a3665ad371e6a5c85a901ab333154b8a8edc709464b-d",
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
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/planner.png',
            "bundle_desc" => "Practice is the key to getting better. But to really progress it’s so important to practice the right things. Knowing what, when, and how to practice will make the biggest difference in your playing. The Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve. This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.",
            'bundle_free_shipping' => true,
            "sizeChart" => "",
            "sizes" => [

            ]
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "100 Days of Practice Poster",
            "slug" => "",
            "sku" => "",
            "thumbnail" => "",
            "meta_desc" => "",
            "meta_img" => "",
            "short_desc" => "",
            "header_text" => "",
            "price" => 9,
            "discounted_price" => "",
            "page_logo" => "",
            "special_text" => "",
            "video" => "",
            "overview" => "",
            "product_img" => "",
            "features" => [
            ],
            "specs" => [
            ],
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/2022/bonus-100days.jpg',
            "bundle_desc" => "Challenge yourself to 100 days of practice with this motivational poster.",
            'bundle_free_shipping' => true,
            "sizeChart" => "",
            "sizes" => [

            ]
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Member Pianote Practice Planner",
            "slug" => "practice-planner-members",
            "sku" => "pianote-practice-planner",
            "promo_code" => "member",
            "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pp-front-cover.jpg",
            "meta_desc" => "The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.",
            "meta_img" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner-6.jpg",
            "short_desc" => "Always know exactly what to practice.",
            "header_text" => "The Pianote Practice Planner",
            "price" => 39,
            "discounted_price" => "",
            "page_logo" => "https://pianote.s3.amazonaws.com/shop/products/practice-planner/logo.png",
            "special_text" => "",
            "video" => "//player.vimeo.com/video/492665630",
            "overview" => "**Always know exactly what to practice.**

They say practice makes perfect.

It’s a cliche -- but it’s not entirely true. Because if you’re not practicing the RIGHT things -- the RIGHT way....

You won’t be perfect.

Worse -- you could be wasting your time.

The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.

This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.

        <a target=\'_blank\" class=\"text-center\" style=\"display:inline-block\" href=\"https://pianote.s3.amazonaws.com/shop/products/practice-planner/preview.pdf\">
            <strong>Click to see inside &raquo;</strong><br>
            <img class='w-full mt-1' src=\"https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://pianote.s3.amazonaws.com/shop/products/practice-planner/pianote-planner.jpg\" alt='sample image' />
        </a>",
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
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://i.vimeocdn.com/video/1024585383-ee7ef1199d46e1c795118a3665ad371e6a5c85a901ab333154b8a8edc709464b-d",
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
            "product_type_id" => 2,
            "name" => "Chords Poster",
            "slug" => "chords-poster",
            "sku" => "poster-chords",
            "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/card-chords-poster.jpg",
            "meta_desc" => "The Pianote Chords Poster is your at-a-glance cheat sheet for nailing down all those hard chord shapes.",
            "meta_img" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/chords-poster.jpg",
            "short_desc" => "Your at-a-glance cheat sheet for nailing down all those hard chord shapes.",
            "header_text" => "*NEW* Pianote Chords Poster",
            "price" => 9,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://pianote.s3.amazonaws.com/shop/products/2021-merch/chords-poster.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/poster-chords.jpg',
            "bundle_desc" => "Chord shapes can be hard to remember, especially when you’re starting out and learning how they work. Luckily we have the Pianote Chords Poster to help you with all those tricky shapes! Get this awesome poster for your practice space and start chording your way through all your favorite songs. If you ever forget your chord shapes, all you have to do is look up!",
            'bundle_free_shipping' => true,
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Scales Poster",
            "slug" => "scales-poster",
            "sku" => "poster-scales",
            "thumbnail" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/card-scales-poster.jpg",
            "meta_desc" => "The Pianote Scales Poster is your saving grace for trying to remember those tricky scales.",
            "meta_img" => "https://pianote.s3.amazonaws.com/shop/products/2021-merch/scales-poster.jpg",
            "short_desc" => "Your saving grace for trying to remember those tricky scales.",
            "header_text" => "*NEW* Pianote Scales Poster",
            "price" => 9,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://pianote.s3.amazonaws.com/shop/products/2021-merch/scales-poster.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/poster-scales.jpg',
            "bundle_desc" => "If you ever find yourself forgetting the notes in a scale (like most of us do), the Pianote Scales Poster is here to help! Remember your scales with this easy-to-read poster, designed to help you quickly recall the right notes at the right time, making your scales (or soloing) a piece of cake. With this up on your wall, you’ll never miss a note again.",
            'bundle_free_shipping' => true,
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Sketchy Mug",
            "slug" => "mug-sketchy",
            "sku" => "products[pianote-sketchy-mug]=1&products[pianote-coasters]=1&products[pianote-stickers]=1",
            "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/sketchy-mug.jpg",
            "meta_desc" => "Matte white on the outside with a black/red sketchy Pianote logo, and red on the inside.",
            "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-sketch-2.jpg",
            "short_desc" => "Matte white on the outside with a black/red sketchy Pianote logo, and red on the inside.",
            "header_text" => "Sketchy Mug",
            "price" => 12,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-sketch-2.jpg",
                "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-sketch-1.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 2,
            "product_type_id" => 2,
            "name" => "Music Brings Happiness Mug",
            "slug" => "mug-floral",
            "sku" => "products[floral-mug]=1&products[pianote-coasters]=1&products[pianote-stickers]=1",
            "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/floral-mug.jpg",
            "meta_desc" => "Music brings happiness. It’s as simple as that.",
            "meta_img" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2020-merch/merch-mug-1.jpg",
            "short_desc" => "Music brings happiness. It’s as simple as that.",
            "header_text" => "Music Brings Happiness Mug",
            "price" => 12,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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
            "product_type_id" => 2,
            "name" => "Guitarist's Survival Kit",
            "slug" => "survival-kit",
            "sku" => "guitarists-survival-kit",
            "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-shop.jpg",
            "meta_desc" => "Get the gear essentials to start sounding better on the guitar.",
            "meta_img" => "https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-fb-share.jpg",
            "short_desc" => "Get the gear essentials to start sounding better on the guitar.",
            "header_text" => "The Guitarist's Survival Kit",
            "price" => 89,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "**Get the gear essentials to start
sounding better on the guitar.**

Whether you’re playing guitar casually at home, a jam session, or show – you’ll come prepared with the Guitarist’s Survival Kit to help you sound (and look) better.

This seven-piece gear kit helps you achieve four main goals:

**1. Stay perfectly in tune:**
 • Keep your guitar playing tight in a jam session or studio recording with perfectly tuned strings. Clip on a 360-degree wireless tuner on your guitar headstock for easy tuning.
**2. Get crisp, clean notes:**
 • Maintain your tone and crisp notes on the guitar with a new set of electric and acoustic strings. You’ll also get a handy string winder to help you with the process.
**3. Pick on great licks:**
 • Don’t know what to play? Flip through the Guitareo Survival Guide and master any of the essential chords, scales, and licks. This guide fits nicely into your guitar case – and you can carry it with you to any campfire or jam session – along with your pack of guitar picks to play with.
**4. Freshen up your look:**
 • Keep your guitar looking good as new – and slow your guitar’s aging and smell. Wipe off any sweat, oil, dirt sitting underneath your strings with a polishing cloth. (And buff that headstock as much as you’d like.)

**Instructional videos on using this kit:** www.guitareo.com/use-survival-kit

**What's included in your kit**
 • Nexxus 360 Rechargeable Tuner
 • Regular Light-Gauge Electric Strings
 • Light-Gauge Acoustic Strings
 • String Pro-Winder
 • Guitareo Survival Guide Book
 • Pack of 10 Assorted Picks
 • Microfibre Polishing Cloth",
            "features" => [
            ],
            "specs" => [
                [
                    "title" => "Size",
                    "desc" => '8.5" x 5.5"'
                ],
            ],
            "visible" => true,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_free_shipping' => true,
            'bundle_img' => '',
            'bundle_desc' => '',
            'video' => '//player.vimeo.com/video/774475043',
            "images" => [
                "https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-shop-01.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-shop-02.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-shop-03.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-shop-04.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-kit/survival-kit-shop-05.jpg",
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-shop.jpg',
            'bundle_desc' => "Be prepared for any musical jam with the guitar gear essentials. Inside this kit, you'll discover every component your guitar needs to stay in tune, sound crisp and clean, and look refreshed. The kit also comes with the Survival Guide, so you can carry the essential chords, scales, and licks in your guitar case."
        ],
        [
            "brand" => 3,
            "product_type_id" => 2,
            "name" => "Guitareo Survival Guide",
            "slug" => "survival-guide",
            "sku" => "survival-guide",
            "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg",
            "meta_desc" => "The Guitareo Survival Guide is perfect for adding a little fun while navigating your way through the wild and rewarding world of learning how to play the guitar.",
            "meta_img" => "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-102.jpg",
            "short_desc" => "Guitar Chords Scales And Licks You Can Take Anywhere",
            "header_text" => "The Guitareo Survival Guide",
            "price" => 19,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "Learning to play the guitar takes practice and patience.

But sometimes, you just want to show off a cool lick or get people singing along around the fire… without sitting down and learning an entire lesson.

That’s what makes The Guitareo Survival Guide such a handy tool.

This 37-page book gives you all the essential chords, strumming patterns, scales, and riffs to make your journey playing the guitar as fun and enjoyable as possible.

Set it up in your practice space, jam room, or toss it in your guitar case and take it wherever you go.

Want to play the riffs that sound just like Chuck Berry?

It’s got those.

Want to make your chords sound more like Jimi Hendrix?

You can.

The Guitareo Survival Guide is perfect for adding a little fun while navigating your way through the wild and rewarding world of learning how to play the guitar. Because that’s what it’s all about!",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_free_shipping' => true,
            'bundle_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg',
            'bundle_desc' => 'This 37-page book gives you all the essential chords, strumming patterns, scales, and riffs to make your journey playing the guitar as fun and enjoyable as possible.',
            "images" => [
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-102-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-108-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-104-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-105-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-106-Edit.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 3,
            "product_type_id" => 2,
            "name" => "Member Guitareo Survival Guide",
            "slug" => "survival-guide-members",
            "sku" => "products[survival-guide]=1&promo-code=members",
            "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg",
            "meta_desc" => "The Guitareo Survival Guide is perfect for adding a little fun while navigating your way through the wild and rewarding world of learning how to play the guitar.",
            "meta_img" => "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-102.jpg",
            "short_desc" => "Guitar Chords Scales And Licks You Can Take Anywhere",
            "header_text" => "The Guitareo Survival Guide",
            "price" => 19,
            "discounted_price" => "",
            "special_text" => "",
            'overview' => "Learning to play the guitar takes practice and patience.

But sometimes, you just want to show off a cool lick or get people singing along around the fire… without sitting down and learning an entire lesson.

That’s what makes The Guitareo Survival Guide such a handy tool.

This 37-page book gives you all the essential chords, strumming patterns, scales, and riffs to make your journey playing the guitar as fun and enjoyable as possible.

Set it up in your practice space, jam room, or toss it in your guitar case and take it wherever you go.

Want to play the riffs that sound just like Chuck Berry?

It’s got those.

Want to make your chords sound more like Jimi Hendrix?

You can.

The Guitareo Survival Guide is perfect for adding a little fun while navigating your way through the wild and rewarding world of learning how to play the guitar. Because that’s what it’s all about!",
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
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            'bundle_free_shipping' => true,
            'bundle_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg',
            'bundle_desc' => 'This 37-page book gives you all the essential chords, strumming patterns, scales, and riffs to make your journey playing the guitar as fun and enjoyable as possible.',
            "images" => [
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-102-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-108-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-104-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-105-Edit.jpg",
                "https://guitareo.s3.amazonaws.com/shop/survival-guide/2021-12-23-Guitareo-Survival-Guide-106-Edit.jpg"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
        [
            "brand" => 4,
            "product_type_id" => 2,
            "name" => "Rockstar Mug",
            "slug" => "mug-rockstar",
            "sku" => "mouth-mug",
            "thumbnail" => "https://singeo.s3.amazonaws.com/products/mug-rockstar.jpg",
            "meta_desc" => "keep your vocal cords hydrated with this super rad mug.",
            "meta_img" => "https://singeo.s3.amazonaws.com/products/mug-rockstar-thumb.png",
            "short_desc" => "Keep your vocal cords hydrated with this super rad mug.",
            "header_text" => "The Singeo Rockstar Mug",
            "price" => 12,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://singeo.s3.amazonaws.com/products/mug-rockstar-thumb.png"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/mug.jpg',
            'bundle_desc' => 'Did you know that it takes 4 hours for your vocal cords to hydrate after you have a drink? Keep your voice sounding its very best by hydrating yourself with this super rad mug. Hydration can help you have better vocal control, reach higher notes and have more reliable results.'
        ],
        [
            "brand" => 4,
            "product_type_id" => 2,
            "name" => "Vowel Practice Poster",
            "slug" => "poster-vowels",
            "sku" => "vowel-sounds-poster",
            "thumbnail" => "https://singeo.s3.amazonaws.com/products/poster-vowel2.png",
            "meta_desc" => "Your new favorite practice tool.",
            "meta_img" => "https://singeo.s3.amazonaws.com/products/poster-vowel-thumb2.png",
            "short_desc" => "Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.",
            "header_text" => "Vowel Practice Poster",
            "price" => 12,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
            "images" => [
                "https://singeo.s3.amazonaws.com/products/poster-vowel-thumb2.png"
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
            'bundle_img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',
            'bundle_desc' => 'Knowing how to style and pronounce your vowels will have instant effects on your singing. This poster will be your new favorite practice tool - and your ticket to hitting higher notes with ease and confidence.',
            'bundle_free_shipping' => true,
        ],
        [
            "brand" => 4,
            "product_type_id" => 2,
            "name" => "Do Re Mi Tumbler",
            "slug" => "tumbler-doremi",
            "sku" => "wallflower-tumbler",
            "thumbnail" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
            "meta_desc" => "Your new favorite practice tool.",
            "meta_img" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
            "short_desc" => "This cozy tumbler will keep you hydrated at home or on the go.",
            "header_text" => "Singeo Do-Re-Mi Tumbler",
            "price" => 29,
            "discounted_price" => "",
            "special_text" => "",
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
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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

            ],
        ],
        [
            "brand" => 4,
            "product_type_id" => 2,
            "name" => "Member Do Re Mi Tumbler",
            "slug" => "tumbler-doremi-member",
            "sku" => "wallflower-tumbler",
            "promo_code" => "member",
            "thumbnail" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
            "meta_desc" => "Your new favorite practice tool.",
            "meta_img" => "https://singeo.s3.amazonaws.com/products/tumbler-doremi2.png",
            "short_desc" => "This cozy tumbler will keep you hydrated at home or on the go.",
            "header_text" => "Singeo Do-Re-Mi Tumbler",
            "price" => 29,
            "discounted_price" => "",
            "special_text" => "",
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
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => false,
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

            ],
        ],
        [
            "brand" => 4,
            "product_type_id" => 2,
            "name" => "Eikon Studio Box Three",
            "slug" => "studio-box",
            "sku" => "studio-box",
            "thumbnail" => "",
            "meta_desc" => "CM14USB microphone equipped with a 96 Khz 24 bit USB audio interface for plug-and-play simplicity.",
            "meta_img" => "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/2022-11-24-Studio-In-A-Box-Studio-Photos-102.jpg",
            "short_desc" => "",
            "header_text" => "Singeo Do-Re-Mi Tumbler",
            "price" => 399,
            "discounted_price" => 349,
            'overview' => 'CM14USB microphone equipped with a 96 Khz 24 bit USB audio interface for plug-and-play simplicity.

Small-diaphragm condenser capsule captures lifelike vocals

Direct Monitoring control with independent Volume available on the microphone

H1000 Professional Hi-End Stereo Headphones

DST60TL Desktop Microphone Stand

APOP65 Nylon screen professional pop filter for studio-quality recordings',
            "special_text" => "",
            "features" => [

            ],
            "specs" => [

            ],
            "visible" => false,
            "sold_out" => false,
            "guaranteed" => false,
            "lifetime_access" => false,
            "free_shipping" => true,
            "images" => [
                "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/2022-11-24-Studio-In-A-Box-Studio-Photos-102.jpg",
                "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/2022-11-24-Studio-In-A-Box-Studio-Photos-100.jpg",
                "https://singeo.s3.amazonaws.com/sales/promos/november/bundles/2022-11-24-Studio-In-A-Box-Studio-Photos-101.jpg",
            ],
            "sizeChart" => "",
            "sizes" => [

            ],
        ],
//            [
//                "brand" => 1,
//                "product_type_id" => 2,
//                "name" => "",
//                "slug" => "",
//                "sku" => "",
//                "thumbnail" => "",
//                "meta_desc" => "",
//                "meta_img" => "",
//                "short_desc" => "",
//                "header_text" => "",
//                "price" => 1,
//                "discounted_price" => "",
//                "special_text" => "",
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
//            [
//                "brand" => 3,
//                "product_type_id" => 2,
//                "name" => "",
//                "slug" => "",
//                "sku" => "",
//                "thumbnail" => "",
//                "meta_desc" => "",
//                "meta_img" => "",
//                "short_desc" => "",
//                "header_text" => "",
//                "price" => 1,
//                "discounted_price" => "",
//                "special_text" => "",
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

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = self::C;

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
                'page_logo' => empty($product['page_logo']) ? null : $product['page_logo'],
                'thumbnail' => $product['thumbnail'],
                'badge_text' => empty($product['badge_text']) ? null : $product['badge_text'],
                'video_src' => empty($product['video']) ? null : $product['video'],
                'header_text' => $product['header_text'],
                'subheader_text' => empty($product['subheader_text']) ? null : $product['subheader_text'],
                'short_desc' => $product['short_desc'],
                'meta_desc' => $product['meta_desc'],
                'meta_img' => $product['meta_img'],
                'special_text' => $product['special_text'],
                'price' => $product['price'],
                'discounted_price' => empty($product['discounted_price']) ? 0 : $product['discounted_price'],
                'overview' => empty($product['overview']) ? null : $product['overview'],
                'product_img' => empty($product['product_img']) ? null : $product['product_img'],
                'sold_out' => $product['sold_out'],
                'free_shipping' => $product['free_shipping'],
                'guaranteed' => $product['guaranteed'],
                'visible' => $product['visible'],
                'display_order' => $product['visible'] ? $orderNum : 0,
                'size_chart_id' => null,
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

            if(count($product['specs']) > 0 ){
                foreach($product['specs'] as $key => $spec){
                    Spec::create([
                        'product_id' => $newProduct->id,
                        'title' => $spec['title'],
                        'desc' => $spec['desc'],
                        'order_number' => $key,
                    ]);
                }
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
