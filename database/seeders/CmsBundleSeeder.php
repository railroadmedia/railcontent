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
                'slug' => 'bundle-beginner',
                'sku' => 'products[PIANOTE-MEMBERSHIP-6-MONTH]=1&products[play-beautiful-piano]=1&products[500-songs-in-5-days]=1&products[piano-riffs-and-fills]=1&locked=true',
                'meta_desc' => 'The PERFECT bundle to get started on the piano.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/beginner/vid-thumb21.jpg',
                'price' => 97,
                'discounted_price' => 0,
                'special_text' => '+$205 In Bonuses',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/beginner/logo2020.png',
                'header_text' => 'The PERFECT bundle to get started on the piano.',
                'video_src' => 'https://player.vimeo.com/external/647936834.hd.mp4?s=b9075b44c7e72d4fc687568b8dcc32a667347511&profile_id=174',
                'images' => [
                ],
                'overview' => 'Start learning piano the right way without the long-term commitment.

This beginner bundle has everything you need to begin your journey on the piano. Learn the songs you love from our HUGE song tutorial library, complete with downloadable backing tracks and sheet music.

Scroll down to see everything that’s included - and start learning today!',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => '6-Month Pianote Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Playing Beautiful Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
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
                'sku' => 'products[classical-book]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&locked=true',
                'meta_desc' => 'Only the BEST piano books from Pianote.',
                'meta_img' => 'https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/july/book_banner.png',
                'price' => 117,
                'discounted_price' => 67,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/july/book_black.png',
                'header_text' => 'Only the BEST piano books from Pianote.',
                'video_src' => '',
                'images' => [
                    'https://pianote.s3.amazonaws.com/sales/promos/july/book_banner.png'
                ],
                'overview' => 'Build your musical knowledge (and library) with 3 beautiful books from Pianote. This bundle will give you a beautiful repertoire of classical piano pieces, as well as a handy chord and scale reference guide so you never get stuck, PLUS the tool to plan and perfect your practice time so you see serious progress.

Save BIG on these books by bundling them together.
',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Classical Piano Pieces',
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
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Classical Bundle',
                'slug' => 'classical-bundle',
                'sku' => 'products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-technique-made-easy]=1&products[pianote-practice-planner]=1&products[classical-book]=1&locked=true&redirect=/order',
                'meta_desc' => 'The FUN way to learn beautiful classical piano.',
                'meta_img' => 'https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/july/classical_banner.png',
                'price' => 197,
                'discounted_price' => 0,
                'special_text' => 'Bonuses worth $198',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/july/classical_black.png',
                'header_text' => 'The FUN way to learn beautiful classical piano.',
                'video_src' => '',
                'images' => [
                    'https://pianote.s3.amazonaws.com/sales/promos/july/classical_banner.png',
                ],
                'overview' => 'Chopin, Beethoven, Mozart.

Classical piano is timeless and beautiful. We’ve just launched a brand-new curriculum from world-class touring pianist Victoria Theodore. It’s yours with The Classical Bundle, along with 3 fantastic bonuses.

Learn classical pieces you can actually play with our NEW 92-page music book. It’s just one of your free bonuses. Scroll down to see them all.',
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Pianote Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Classical piano',
                        'free_bonus' => true,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Piano Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Classical Piano Pieces',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Pianote Practice Planner',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Digital Training Bundle',
                'slug' => 'bundle-digital-training',
                'sku' => 'products%5B500-songs-in-5-days%5D=1&products%5Bpiano-riffs-and-fills%5D=1&products%5Bworship-piano%5D=1&locked=true',
                'meta_desc' => 'Grab 3 Pianote digital training packs for one low price.',
                'meta_img' => 'https://i.vimeocdn.com/video/962210152-9648f81a987b76a00b76f0dda8dcaaefcd3e38c5f5f8efb534782d07db39c63d-d_1280',
                'price' => 297,
                'discounted_price' => 0,
                'special_text' => '',
                'page_logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/digital-bundle-logo.png',
                'header_text' => 'Three Awesome Training Packs. One Low Price. Introducing... The Digital Bundle.',
                'video_src' => 'https://player.vimeo.com/external/460721075.hd.mp4?s=ed782250e3acc9b9994106e22b4b52c1a371149c&profile_id=174',
                'images' => [
                ],
                'overview' => 'Grab 3 Pianote digital training packs for one low price. Learn hundreds of songs with 500 Songs in 5 Days, play beautiful riffs, fills, and licks with Piano Riffs & Fills, and play piano at church with Worship Piano. With this bundle, you’ll get LIFETIME access to all three.',
                'sold_out' => true,
                'guaranteed' => false,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Worship Piano',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Essential Songs Bundle',
                'slug' => 'bundle-essential-songs',
                'sku' => 'products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[500-songs-in-5-days]=1&products[piano-riffs-and-fills]=1&products[worship-piano]=1&products[faster-fingers]=1&products[sight-reading-made-simple]=1&locked=true',
                'meta_desc' => 'EVERYTHING you need to start playing songs beautifully.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/essential-songs/thumbnail2020.png',
                'price' => 634,
                'discounted_price' => 97,
                'special_text' => '',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/essential-songs/logo2020.png',
                'header_text' => 'EVERYTHING you need to start playing songs beautifully.',
                'video_src' => 'https://player.vimeo.com/external/484633541.hd.mp4?s=5079bbd76593613805099057731216c295fed57b&profile_id=174',
                'images' => [
                ],
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
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
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
                        'free_bonus' => true,
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
                    [
                        'name' => 'Sight Reading Made Simple',
                        'free_bonus' => false,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Simply Songs Bundle',
                'slug' => 'songs-bundle',
                'sku' => 'products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[500-songs-in-5-days]=1&products[piano-riffs-and-fills]=1&products[piano-chords-and-scales-guide]=1&locked=true',
                'meta_desc' => 'Because you just want to play your favorite songs.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/july/simply_songs_banner.png',
                'price' => 197,
                'discounted_price' => 0,
                'special_text' => 'bonuses worth $237',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/july/simply_songs_black.png',
                'header_text' => 'Because you just want to play your favorite songs.',
                'video_src' => '',
                'overview' => 'It’s Saturday night. Your friends are over, and you just want to sit at the piano and belt out the classics while having a fantastic time. You don’t need to know how to read music or understand the finer points of piano theory -- you just want to have FUN!

The Simple Songs Bundle will get you there in no time. You’ll get expert teaching from your Pianote Membership, PLUS 3 bonuses to shortcut your progress so you can start playing real songs right away.',
                'images' => [
                    'https://pianote.s3.amazonaws.com/sales/promos/july/simply_songs_banner.png'
                ],
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Pianote Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Chords & Scales',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                ],
            ],
            [
                'brand' => 2,
                'product_type_id' => 6,
                'name' => 'The Unlimited Lessons Bundle',
                'slug' => 'bundle-unlimited-lessons',
                'sku' => 'products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-practice-planner]=1&products[poster-chords]=1&products[poster-scales]=1&products[play-beautiful-piano]=1&products[500-songs-in-5-days]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&products[sight-reading-made-simple]=1&locked=true",
        "fullPrice',
                'meta_desc' => 'UNLIMITED piano lessons you can take anywhere, anytime.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/vid-thumb21.jpg',
                'price' => 197,
                'discounted_price' => 0,
                'special_text' => '+$698 In Bonuses',
                'page_logo' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/logo2020.png',
                'header_text' => 'UNLIMITED piano lessons you can take anywhere, anytime.',
                'video_src' => 'https://player.vimeo.com/external/647937515.hd.mp4?s=982ac3c2ab74a80cf1f24a727c4df5c88fda859a&profile_id=174',
                'images' => [
                ],
                'sold_out' => true,
                'guaranteed' => true,
                'free_shipping' => false,
                'products' => [
                    [
                        'name' => 'Pianote Membership',
                        'free_bonus' => false,
                        'lifetime_access' => false,
                    ],
                    [
                        'name' => 'Chords Poster',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Scales Poster',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Pianote Practice Planner',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Technique Made Easy',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Playing Beautiful Piano',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => '500 Songs In 5 Days',
                        'free_bonus' => true,
                        'lifetime_access' => true,
                    ],
                    [
                        'name' => 'Piano Riffs & Fills',
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
                    [
                        'name' => 'Sight Reading Made Simple',
                        'free_bonus' => true,
                        'lifetime_access' => true,
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
                'header_text' => 'Thinking of becoming a guitarist? Start here.',
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
                'page_logo' => '',
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
//            [
//                'brand' => 4,
//                'product_type_id' => 6,
//                'name' => 'The Beginner Bundle',
//                'slug' => 'beginner-bundle',
//                'sku' => 'products[singeo-6-month-recurring-membership]=1&products[singing-starter-kit]=1&locked=true',
//                'meta_desc' => 'You CAN Sing! And this is the perfect place to start.',
//                'meta_img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/bundles/beginner-thumb.jpg',
//                'price' => 158,
//                'discounted_price' => 127,
//                'special_text' => '+$31 In Bonuses',
//                'page_logo' => 'https://singeo.s3.amazonaws.com/sales/promos/november/bundles/beginner-logo.png',
//                'header_text' => 'Know exactly where to start & get immediate results',
//                'video_src' => '',
//                'images' => [
//                    'https://singeo.s3.amazonaws.com/sales/promos/august/beginner_banner.jpg'
//                ],
//                'overview' => 'If you’ve been struggling with the sound or quality of your voice - not seeing a difference despite putting in the work, there’s something you need to know
//
//**The problem is NOT YOU.**
//
//Because beginner singers all face the same problem…
//
//You don’t know what you don’t know!
//
//And it’s not your fault. But it can lead to vocal strain and frustration, and ultimately lead you to quit.
//
//That’s why having a REAL vocal coach guide your every step is so important. **It’s the best way to guarantee you’re making progress and not just going in circles.**
//
//With **The Beginner Bundle**, you can take your first singing lesson in less than 2 minutes from now -- and hear the difference in your voice by the end of it.
//
//Maximize results using the Singing Starter Kit. Then use your Member Access to get personal feedback from real vocal coaches who will guide you every step of the way.
//
//The Singeo Method will give you all the tools you need to bring your voice to a whole new level and become a proficient, confident singer. Learn to…
//
//• Develop your voice
//• Sound better when you sing
//• Fine tune your pitch
//• Do vocal riffs and runs like your favorite artists
//• Train your ear to tackle harmonies.
//',
//                'sold_out' => true,
//                'guaranteed' => true,
//                'free_shipping' => false,
//                'products' => [
//                    [
//                        'name' => 'Singeo Membership',
//                        'free_bonus' => false,
//                        'lifetime_access' => false,
//                    ],
//                    [
//                        'name' => 'The Singing Starter Kit',
//                        'free_bonus' => true,
//                        'lifetime_access' => true,
//                    ],
//                    [
//                        'name' => 'Vowel Practice Poster',
//                        'free_bonus' => true,
//                        'lifetime_access' => false,
//                    ],
//                ],
//            ],
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
                'discounted_price' => $product['discounted_price'],
                'special_text' => $product['special_text'],
                'page_logo' => $product['page_logo'],
                'header_text' => $product['header_text'],
                'video_src' => $product['video_src'],
                'sold_out' => $product['sold_out'],
                'guaranteed' => $product['guaranteed'],
                'free_shipping' => $product['free_shipping'],
                'overview' => empty($product['overview']) ? false : $product['overview'],
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
