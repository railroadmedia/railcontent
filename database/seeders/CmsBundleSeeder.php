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
                'sku' => 'products[DLM-1-year]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true" data-base-url="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true',
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
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Whole 9 Yards Cyber Bundle',
                'slug' => 'bundle-9-yards',
                'sku' => 'products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&locked=true',
                'meta_desc' => 'Everything You Need. The Whole 9 Yards',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/whole-9-yards-fb-share-image.jpg',
                'price' => 716,
                'discounted_price' => 127,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/november/the-whole-9-yards-bundle-black.png',
                'header_text' => 'Everything You Need. The Whole 9 Yards',
                'video_src' => '//player.vimeo.com/video/774401637',
                'spread' => 'https://pianote.s3.amazonaws.com/sales/promos/november/the-whole-9-yards-spread.png',
                'images' => [

                ],
                'overview' => 'All the courses, none of the commitment. The Whole 9 Yards Cyber Bundle is your complete guide to learning the piano without a membership.

Pay once and get lifetime access to 9 courses. You’ll learn how to play beautiful chords, classical piano, amazing improvisation, boost your speed, and more.',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'The Power of Chords',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Classical Piano',
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
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Unlimited Lessons Bundle',
                'slug' => 'bundle-unlimited-lessons',
                'sku' => 'products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[christmas-song-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&redirect=/order&locked=true',
                'meta_desc' => 'UNLIMITED piano lessons you can take anywhere, anytime.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/unlimited-lessons-fb-share-image-1.jpg',
                'price' => 1101,
                'discounted_price' => 240,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/november/unlimited-lessons-bundle-black.png',
                'header_text' => 'UNLIMITED piano lessons you can take anywhere, anytime.',
                'video_src' => '//player.vimeo.com/video/774401622',
                'spread' => '',
                'images' => [

                ],
                'overview' => 'The Unlimited Lessons Bundle gives you just that - unlimited piano lessons. Watch as many as you like, as often as you like.

Learn your favorite songs in the comfort of your own home, whenever you want. Impress your family and friends with your piano playing - for a tiny fraction of the cost of private lessons.

And get the support and feedback from real teachers who will help you every step of the way.',
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
                        'name' => 'Pianote Christmas Songbook',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Pianote Digital Christmas Songbook',
                        'free_bonus' => true,
                        'lifetime_access' => true,
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
                        'name' => 'The Power of Chords',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Classical Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Improvisation & Musical Freedom',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Playing Beautiful Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'De-Stupefy Your Left Hand',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Worship Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Faster Fingers',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Build A Song Bundle',
                'slug' => 'build-a-song',
                'sku' => 'products[500-songs-in-5-days-guitareo]=1&products[guitar-quest]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&products[rhythm-and-groove]=1&redirect=/order&locked=true',
                'meta_desc' => 'Build and play songs you love on the guitar.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/build-a-song-fb-share-image.jpg',
                'price' => 735,
                'discounted_price' => 127,
                'special_text' => '',
                'page_logo' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/logo-black.png',
                'header_text' => 'Build and play songs you love on the guitar.',
                'video_src' => '//player.vimeo.com/video/774474785',
                'images' => [
                ],
                'spread' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/build-a-song-spread.png',
                'sold_out' => false,
                'guaranteed' => true,
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
                        'name' => 'The Guitar System',
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
            [
                'brand' => 3,
                'product_type_id' => 6,
                'name' => 'The Sound Better Bundle',
                'slug' => 'sound-better-bundle',
                'sku' => 'products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true',
                'meta_desc' => 'Get ALL the lessons and gear essentials to sound better on the guitar.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/sound-better-fb-share-image.jpg',
                'price' => 491,
                'discounted_price' => 240,
                'special_text' => '',
                'page_logo' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/the-sound-better-bundle-black.png',
                'header_text' => 'Get ALL the lessons and gear essentials to start sounding better on the guitar.',
                'video_src' => '//player.vimeo.com/video/774475126',
                'spread' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/sound-better-bundle-spread-.png',
                'images' => [

                ],
                'overview' => '',
                'sold_out' => false,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Guitareo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => "Guitarist's Survival Kit",
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
            [
                'brand' => 4,
                'product_type_id' => 6,
                'name' => 'The Unlimited Lessons Bundle',
                'slug' => 'bundle-unlimited',
                'sku' => 'products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&products[the-essential-guide-to-beautiful-harmonies]=1&products[vowel-sounds-poster]=1&bonuses[PIANOTE-MEMBERSHIP-1-YEAR]=1&bonuses[GUITAREO-1-YEAR-MEMBERSHIP]=1&locked=true&redirect=/order',
                'meta_desc' => 'Get UNLIMITED personal coaching to become the musician you’ve always wanted to be.',
                'meta_img' => 'https://singeo.s3.amazonaws.com/shop/bundles/unlimited-lessons/unlimited-lessons.png',
                'price' => 778,
                'discounted_price' => 240,
                'special_text' => '',
                'page_logo' => 'https://singeo.s3.amazonaws.com/shop/bundles/unlimited-lessons/unlimited-lessons-bundle-black.png',
                'header_text' => 'Get UNLIMITED personal coaching to become the musician you’ve always wanted to be.',
                'video_src' => '',
                'images' => [
                    'https://singeo.s3.amazonaws.com/shop/bundles/unlimited-lessons/unlimited-lessons.png'
                ],
                'spread' => 'https://singeo.s3.amazonaws.com/shop/bundles/unlimited-lessons/unlimited-lessons-spread.png',
                'overview' => "Picture some of the world's most iconic singers.

Elton John. Elvis Presley. Dolly Parton. Johnny Cash. Lady Gaga. Taylor Swift. - The list goes on and on.

All of them are incredible vocalists. But there is something else they have in common… They all play the guitar or piano.

Now you might think the coordination to sing AND play is some super-human skill, but it's not. It's more like riding a bike.

Sure, you might wobble a bit at first - but once you figure out the basics, you've got a new skill… for life.

With The Unlimited Lessons Bundle, you can get all the personal support you need to make the process even easier!

REAL teachers will guide you every step of the way on your journey to becoming a complete, talented musician.

And the best part? You can be chording along to your favorite song 10 minutes from now!

If you've always dreamed of sitting at the piano keys, picking up the guitar around a campfire, and singing your favorite songs (or even writing your own)...

This is the perfect time.

You'll get all-access memberships to ALL THREE BRANDS for an entire year. That means structured step-by-step lessons, live Q&As and access to world-class coaches. Coaches that will personally give you the feedback you need to make sure you're getting better.

No going around in circles. No wasting your time.

Taking the first step is the hardest part of learning to play an instrument or improving your voice. This is your chance to become the musician you've always dreamed of being.

**Lifetime Access:**
Once you grab The Unlimited Lessons Bundle, you’ll never have to worry about having access to your lessons. Because even if you don’t choose to renew your Singeo membership, you’ll get to keep your bonus featured courses FOREVER.",
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
                        'name' => 'Pianote Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                        'mix' => true
                    ],
                    [
                        'name' => 'Guitareo Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                        'mix' => true
                    ],
                    [
                        'name' => 'The Essential Guide to Beautiful Harmonies',
                        'free_bonus' => true,
                        'lifetime_access' => true,
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
                if(!empty($bundle['mix']) && $bundle['mix']){
                    $product_id = Product::where('name', '=', $bundle['name'])->first()->id;
                }
                else {
                    $product_id = Product::where('name', '=', $bundle['name'])->where('brand_id', '=', $product['brand'])->first()->id;
                }

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
