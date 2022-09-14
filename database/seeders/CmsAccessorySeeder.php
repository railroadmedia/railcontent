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
                "brand" => 2,
                "product_type_id" => 2,
                "name" => "Classical Piano Pieces",
                "slug" => "classical-book",
                "sku" => "classical-book",
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
                "bundle_desc" => "What good is learning classical piano if you don’t have beautiful music to play? This NEW book is 92 pages full of beautiful pieces by famous classical composers that you can actually play! The perfect companion to The Classical Method, each piece has been hand-selected to be appropriate for your skill level - while still sounding beautiful. Beethoven, Chopin, Bach, they’re all in here.",
            ],
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
                "name" => "Drumeo Tone Control Kit",
                "slug" => "tone-control-kit",
                "sku" => "tone-control-kit",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/tone-control-kit.jpg",
                "meta_desc" => "Better drum sounds in seconds.",
                "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/og-image.jpg",
                "short_desc" => "The Drumeo Tone Control Kit helps you balance overtones with four adjustable levels of dampening in one simple system.",
                "header_text" => "",
                "price" => 72,
                "discounted_price" => "",
                "special_text" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "visible" => true,
                "sold_out" => true,
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
                "sold_out" => false,
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
                "sold_out" => false,
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
                "sold_out" => false,
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
                'overview' => "Master Every Chord. Every Scale. In Every Key.

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
                "bundle_desc" => "You need chords to play your favorite songs, but learning them all can be a real challenge. The Piano Chords & Scales book is your go-to reference guide so you’ll never get stuck again. See a chord you don’t know? Simply flip to the relevant page in your book and you’ll see all the inversions and alterations you need to play beautifully and confidently. Don’t let scary-looking chords slow your progress.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 2,
                "name" => "Member Piano Chords & Scales",
                "slug" => "chords-scales-book-members",
                "sku" => "piano-chords-and-scales-guide",
                "promo_code" => "member",
                "thumbnail" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
                "meta_desc" => "Master every single chord and scale with this comprehensive guide.",
                "meta_img" => "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-110.jpg",
                "short_desc" => "Master Every Chord. Every Scale. In Every Key.",
                "header_text" => "Piano Chords & Scales The Ultimate Guide",
                "price" => 39,
                "discounted_price" => "",
                "special_text" => "",
                'overview' => "Master Every Chord. Every Scale. In Every Key.

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
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
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
                "bundle_desc" => "Practice is the key to getting better. But to really progress it’s so important to practice the right things. Knowing what, when, and how to practice will make the biggest difference in your playing. The Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve. This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.",
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
                "visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
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
                "bundle_desc" => "Chord shapes can be hard to remember, especially when you’re starting out and learning how they work. Luckily we have the Pianote Chords Poster to help you with all those tricky shapes! Get this awesome poster for your practice space and start chording your way through all your favorite songs. If you ever forget your chord shapes, all you have to do is look up!",
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
                "bundle_desc" => "If you ever find yourself forgetting the notes in a scale (like most of us do), the Pianote Scales Poster is here to help! Remember your scales with this easy-to-read poster, designed to help you quickly recall the right notes at the right time, making your scales (or soloing) a piece of cake. With this up on your wall, you’ll never miss a note again.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 2,
                "name" => "Sketchy Mug",
                "slug" => "mug-sketchy",
                "sku" => "pianote-sketchy-mug",
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
                "sku" => "floral-mug",
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
                "sold_out" => true,
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
                "special_text" => "or free with Guitareo",
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
                'bundle_desc' => 'Knowing how to style and pronounce your vowels will have instant effects on your singing. This poster will be your new favorite practice tool - and your ticket to hitting higher notes with ease and confidence.'
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
                "brand" => 2,
                "product_type_id" => 2,
                "name" => "Discounted Classical Piano Pieces",
                "slug" => "classical-book-discount",
                "sku" => "classical-book",
                "promo_code" => "member",
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
                'header_text' => $product['header_text'],
                'short_desc' => $product['short_desc'],
                'meta_desc' => $product['meta_desc'],
                'meta_img' => $product['meta_img'],
                'special_text' => $product['special_text'],
                'price' => $product['price'],
                'discounted_price' => $product['discounted_price'],
                'overview' => empty($product['overview']) ? null : $product['overview'],
                'product_img' => empty($product['product_img']) ? null : $product['product_img'],
                'sold_out' => $product['sold_out'],
                'free_shipping' => $product['free_shipping'],
                'guaranteed' => $product['guaranteed'],
                'visible' => $product['visible'],
                'lifetime_access' => $product['lifetime_access'],
                'display_order' => $orderNum,
                'size_chart_id' => null,
                'bundle_desc' => empty($product['bundle_desc']) ? null : $product['bundle_desc'],
                'physical' => true,
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
                    'size_id' => $size
                ]);
            }
        }
    }
}
