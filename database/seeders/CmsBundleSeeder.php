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
                        'name' => 'Drumeo QuietPad',
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
                'spread' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-spread.png',
                'overview' => 'Run your rudiments anytime day or night & develop silky-smooth hands on the kit.

The Practice Anywhere Bundle includes the P4 Practice Pad – the only practice pad that simulates the feels of a REAL drum set – fresh drumsticks, and the all NEW Drumeo Rudiments poster.

You’ll have everything you need to improve your hands around the drums.',
                'images' => [
                ],
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
                        'name' => 'Drumeo QuietPad',
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
                'spread' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/ultimate-bundle-spread.png',
                'overview' => 'The Ultimate Lessons Bundle is your chance to get unlimited drum lessons for a year at **the lowest price ever.**

You’ll get $1228.94 in FREE bonuses (including an ultra-quiet practice pad & drumsticks).

That breaks down to just $20/month to learn the drums with legendary instructors, access 5,000+ note-for-note breakdowns of famous drumming songs, and get personalized support every step of the way.

If you’ve always wanted to learn the drums, are getting BACK into drumming, or are ready to take your playing to the next level, this is the bundle for YOU.

Scroll down to see everything included with the Ultimate Lessons Bundle.',
                'images' => [
                ],
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
                        'name' => 'Vater Drumeo 5A Drumsticks',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Drum Technique Made Easy',
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
                        'name' => 'Rock Drumming Masterclass',
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
                        'name' => 'Successful Drumming',
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
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Book Bundle',
                'slug' => 'book-bundle',
                'sku' => 'products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[christmas-song-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&redirect=/order&locked=true',
                'meta_desc' => 'Only the BEST piano books from Pianote.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/just-the-books-fb-share-image.jpg',
                'price' => 145,
                'discounted_price' => 59,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/july/book_black.png',
                'header_text' => 'Only the BEST piano books from Pianote.',
                'video_src' => '',
                'images' => [
                    'https://pianote.s3.amazonaws.com/sales/promos/july/book_banner.png'
                ],
                'overview' => 'Build your musical knowledge (and library) with 3 beautiful books, 1 digital book, and 2 posters from Pianote. This bundle will give you 10 classical Christmas Carols, an encyclopedia of all the important chords and scales, PLUS the tool to plan and perfect your practice time so you see serious progress.

And you’ll get 2 big color posters to hang in your practice space for easy and quick reference to learn your piano chords and scales..
',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Pianote Christmas Songbook',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Pianote Digital Christmas Songbook',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Pianote Practice Planner',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Piano Chords & Scales',
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
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'Ultimate Upgrade',
                'slug' => 'ultimate-upgrade',
                'sku' => 'products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[100-days-of-practice-poster]=1&products[poster-chords]=1&products[poster-scales]=1&products[pianote-practice-planner]=1&locked=true&redirect=/order&promo-code=ult-upgrade',
                'meta_desc' => 'Lock in your progress! Get this exclusive offer when you continue your membership today.',
                'meta_img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg',
                'price' => 302,
                'discounted_price' => 167,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'Lock in your progress! Get this exclusive offer when you continue your membership today.',
                'video_src' => '//player.vimeo.com/video/668814962',
                'images' => [

                ],
                'overview' => 'You’ve come so far, and now you can lock in a super-low rate for a year of lessons with Pianote. So to help you stick around, we want to give you a discount and 5 amazing bonuses worth $105 when you decide to continue your journey with us.

**Continue your membership today and get…**',
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
                        'name' => '100 Days of Practice Poster',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Buginner Quick-Start Bundle',
                'slug' => 'beginner-bundle',
                'sku' => 'products[guitar-quest]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&locked=true',
                'meta_desc' => 'Thinking of becoming a guitarist? Start here.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/vid-thumb.jpg',
                'price' => 491,
                'discounted_price' => 127,
                'special_text' => '',
                'page_logo' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/logo-black.png',
                'header_text' => 'Thinking of becoming a guitarist? <br>Start here.',
                'video_src' => '//player.vimeo.com/video/649717515',
                'images' => [
                ],
                'overview' => 'Have you ever wanted to be able to pick up a guitar and start playing your favorite songs? Or be able to start jamming with your friends? Or maybe you want to pursue your dreams as a professional guitarist. No matter what your reasons are, THE BEGINNER QUICK-START BUNDLE is for you. These three digital lesson packs are designed to get you started on the guitar, playing songs and having fun right away! Go on an adventure, learn hundreds of songs, and build your skills on the guitar so you can reach your goals faster. And you get these lessons for a lifetime, so you can keep growing and learning the guitar as much as you want.',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'GuitarQuest',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The Guitar System',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The 5-Pack Bundle',
                'slug' => '5-pack-bundle',
                'sku' => 'products[guitar-quest]=1&products[500-songs-in-5-days-guitareo]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&products[GUITAR-SYSTEM]=1&redirect=/order&locked=true',
                'meta_desc' => 'Chase your guitar goals with 5 digital training packs for one low price.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/ultimate_banner.jpg',
                'price' => 885,
                'discounted_price' => 97,
                'special_text' => '',
                'page_logo' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/5pack_black_logo.png',
                'header_text' => 'Chase your guitar goals with 5 digital training packs for one low price.',
                'video_src' => '',
                'images' => [
                    'https://guitareo.s3.amazonaws.com/sales/promos/july/5pack_banner.jpg'
                ],
                'overview' => 'Sure, six packs are all the rage – but this 5-pack bundle will give you goal-oriented lesson plans for the most popular guitar goals.

**Want to get started on guitar?** GuitarQuest is here!
**Want to play songs easier?** Try 500 Songs In 5 Days.

**Want a rock-solid foundation for the acoustic?**
Acoustic Guitar Made Easy is a 26-week plan that’s easy to follow – with one lesson each week and a clear path to better strumming, clean chords, changing chords, music theory, and playing songs.

**Need to improve your technique?**
Guitar Technique Made Easy is a 26-week plan for building a technical foundation that will allow you to express yourself creatively and without limitations.

**Or if you want an encyclopedia of lessons on EVERY TOPIC**, you’ll also get The Guitar System – with 35 hours of lessons and 85 jam tracks to help you accelerate any skill, anytime.

**The 5-Pack Bundle gives you instant digital access to all five packs with no membership and no recurring fees.**',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'GuitarQuest',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Acoustic Guitar Made Easy',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],                    [
                        'name' => 'Guitar Technique Made Easy',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],                    [
                        'name' => 'The Guitar System',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Summer Songs Bundle',
                'slug' => 'summer-songs-bundle',
                'sku' => 'products[500-songs-in-5-days-guitareo]=1&products[AGME-JAN-2019-SEMESTER]=1&locked=true',
                'meta_desc' => 'CRUSH your campfire singalongs this summer.',
                'meta_img' => 'https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/shop/bundles/500songs_acoustic_combo.jpg',
                'price' => 294,
                'discounted_price' => 49,
                'special_text' => '',
                'page_logo' => 'https://guitareo.s3.amazonaws.com/shop/bundles/SummerSongs_logo_stacked.png',
                'header_text' => 'CRUSH your campfire singalongs this summer. Get comfortable on your acoustic guitar + learn 500 songs!',
                'video_src' => '',
                'images' => [
                    'https://guitareo.s3.amazonaws.com/shop/bundles/500songs_acoustic_bundle.jpg'
                ],
                'overview' => 'It’s summer. You’re sitting around the campfire when someone pulls out an acoustic guitar. Suddenly it’s your time to shine…

Get the skills to feel confident on the acoustic with Acoustic Guitar Made Easy. But what good are skills without songs? That’s why you’ll also get 500 Songs in 5 Days. So you’ll be primed and ready to crush any campfire singalong.

Make this summer one to remember with the Summer Songs Bundle.',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Acoustic Guitar Made Easy',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Ultimate Lessons Bundle',
                'slug' => 'ultimate-bundle',
                'sku' => 'products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitar-quest]=1&products[500-songs-in-5-days-guitareo]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&products[GUITAR-SYSTEM]=1&products[survival-guide]=1&redirect=/order&locked=true',
                'meta_desc' => 'Your ULTIMATE way to learn the guitar.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/vid-thumb.jpg',
                'price' => 127,
                'discounted_price' => 0,
                'special_text' => '6 bonuses worth $904',
                'page_logo' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/ultimate_black_logo.png',
                'header_text' => 'Your ULTIMATE way to learn the guitar.',
                'video_src' => '',
                'images' => [
                    'https://guitareo.s3.amazonaws.com/sales/promos/july/ultimate_banner.jpg'
                ],
                'overview' => "This is the ULTIMATE bundle for any guitarist. Whether you're just getting started, taking that next step in your playing, or just looking for new creative ways to have fun on the guitar - this is the bundle for you! With LIFETIME access to every digital lesson pack and a 1-year membership to Guitareo, you'll study any technique imaginable, learn hundreds of songs, and explore your creativity the way you've always wanted on the guitar.",
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Guitareo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'GuitarQuest',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => '500 Songs In 5 Days',
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
                    [
                        'name' => 'The Guitar System',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Guitareo Survival Guide',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 4,
                'product_type_id' => 6,
                'name' => 'The Perfect Harmony Bundle',
                'slug' => 'harmony-bundle',
                'sku' => 'products[singeo-annual-recurring-membership]=1&products[the-essential-guide-to-beautiful-harmonies]=1&products[singing-starter-kit]=1&locked=true',
                'meta_desc' => 'The EASY way to sing in perfect harmony',
                'meta_img' => 'https://singeo.s3.amazonaws.com/sales/promos/october/harmony_bundle_banner.jpg',
                'price' => 158,
                'discounted_price' => 127,
                'special_text' => '',
                'page_logo' => 'https://singeo.s3.amazonaws.com/sales/promos/october/perfect_harmony_bundle_black.png',
                'header_text' => 'The EASY way to sing in perfect harmony',
                'video_src' => '',
                'images' => [
                    'https://singeo.s3.amazonaws.com/sales/promos/october/harmony_bundle_banner.jpg'
                ],
                'overview' => "<h2 class=\"text-center font-extrabold text-lg md:text-xl lg:text-2xl mb-6\" style=\"font-weight: 900;\">What's included:</h2><img class='hidden md:inline mb-4' src='https://laravel-nova.s3.us-east-2.amazonaws.com/Singeo/product-image/harmony-bundle.png' alt='what is included image' /><img class='md:hidden mb-4' src='https://laravel-nova.s3.us-east-2.amazonaws.com/Singeo/product-image/harmony-bundle-m.png' alt='what is included image' />
                If you dream of singing beautiful harmonies and creating something extraordinary, then you need The Perfect Harmony Bundle.

Kick your singing journey into gear with the Singer Starter Kit and learn to unleash the full potential of your voice. From warm-up exercise routines to tricks and techniques to help you vocalize with less tension and accurate pitch.

Then use The Essential Guide To Beautiful Harmonies to elevate your performances with your choir, band, or duet partner. This 8-lesson, easy-to-follow course will have you harmonizing after the first lesson. **That means you could sing your first harmony 10 minutes from now!**

Finally, use your Singeo Member Access to get unlimited personal feedback from real coaches to help you get unstuck in your journey. Get the support you need to achieve your singing goals and have the voice you’ve always wanted.

**Lifetime Access:**

Once you grab The Perfect Harmony Bundle, you’ll never have to worry about having access to your lessons. Because even if you don’t choose to renew your Singeo membership, you’ll get to keep your bonus featured courses FOREVER.",
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => true,
                'products' => [
                    [
                        'name' => 'Singeo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The Singing Starter Kit',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'The Essential Guide to Beautiful Harmonies',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 4,
                'product_type_id' => 6,
                'name' => 'The Beginner Bundle',
                'slug' => 'beginner-bundle',
                'sku' => 'products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&products[vowel-sounds-poster]=1&locked=true',
                'meta_desc' => 'Know exactly where to start & get immediate results',
                'meta_img' => 'https://singeo.s3.amazonaws.com/sales/promos/august/beginner_bundle.jpg',
                'price' => 158,
                'discounted_price' => 127,
                'special_text' => '+$31 In Bonuses',
                'page_logo' => 'https://singeo.s3.amazonaws.com/sales/promos/november/bundles/beginner-logo.png',
                'header_text' => 'Know exactly where to start & get immediate results',
                'video_src' => '',
                'images' => [
                    'https://singeo.s3.amazonaws.com/sales/promos/august/beginner_banner.jpg'
                ],
                'overview' => 'If you’ve been struggling with the sound or quality of your voice - not seeing a difference despite putting in the work, there’s something you need to know

**The problem is NOT YOU.**

Because beginner singers all face the same problem…

You don’t know what you don’t know!

And it’s not your fault. But it can lead to vocal strain and frustration, and ultimately lead you to quit.

That’s why having a REAL vocal coach guide your every step is so important. **It’s the best way to guarantee you’re making progress and not just going in circles.**

With **The Beginner Bundle**, you can take your first singing lesson in less than 2 minutes from now -- and hear the difference in your voice by the end of it.

Maximize results using the Singing Starter Kit. Then use your Member Access to get personal feedback from real vocal coaches who will guide you every step of the way.

The Singeo Method will give you all the tools you need to bring your voice to a whole new level and become a proficient, confident singer. Learn to…

• Develop your voice
• Sound better when you sing
• Fine tune your pitch
• Do vocal riffs and runs like your favorite artists
• Train your ear to tackle harmonies.
',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Singeo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'The Singing Starter Kit',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Vowel Practice Poster',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                ],
            ],
            [
                'brand' => 4,
                'product_type_id' => 6,
                'name' => 'The Swag Bundle',
                'slug' => 'swag-bundle',
                'sku' => 'products[singeo-annual-recurring-membership]=1&products[vowel-sounds-poster]=1&products[mouth-mug]=1&products[wallflower-tumbler]=1&products[singing-starter-kit]=1&redirect=/order&locked=true',
                'meta_desc' => 'Sing with confidence AND Style',
                'meta_img' => 'https://singeo.s3.amazonaws.com/sales/promos/august/swag_bundle.jpg',
                'price' => 127,
                'discounted_price' => 0,
                'special_text' => '',
                'page_logo' => '',
                'header_text' => 'Sing with confidence AND Style',
                'video_src' => '',
                'images' => [
                    'https://singeo.s3.amazonaws.com/sales/promos/august/swag_banner.jpg'
                ],
                'overview' => '',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Singeo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Rockstar Mug',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Retro T-shirt',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                ],
            ],
//            [
//                'brand' => 2,
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
                'discounted_price' => empty($product['discounted_price']) ? 0 : $product['discounted_price'],
                'special_text' => $product['special_text'],
                'page_logo' => $product['page_logo'],
                'header_text' => $product['header_text'],
                'video_src' => $product['video_src'],
                'sold_out' => $product['sold_out'],
                'guaranteed' => $product['guaranteed'],
                'free_shipping' => $product['free_shipping'],
                'overview' => empty($product['overview']) ? null : $product['overview'],
                'spread_img' => empty($product['spread']) ? null : $product['spread'],
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
