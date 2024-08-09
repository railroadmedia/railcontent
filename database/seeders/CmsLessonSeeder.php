<?php

namespace Database\Seeders;

use App\Models\Benefit;
use App\Models\Bundle;
use App\Models\Feature;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPUnit\Framework\isEmpty;

class CmsLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = [
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drumeo Membership",
                "slug" => "",
                "sku" => "",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/dcb-01.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "The Ultimate Online Drum Lessons Experience. You’ll get step-by-step drum lessons from the best drummers in the world (and much more).",
                "header_text" => "",
                "price" => 240,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Award-Winning Membership",
                "instructor_desc" => "",
                "instructor_img" => null,
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/drumeo_annual.jpg',
                "bundle_desc" => "Get better, faster with Drumeo’s award-winning online drum lessons taught by the world’s greatest drummers. You’ll always know what to practice with step-by-step lessons, 3100+ note-for-note song breakdowns, hundreds of drum-less playalongs, and ongoing support & motivation from pro drummers."
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Last Minute Gift for Drummers",
                "slug" => "six-month-ticket",
                "sku" => "DLM-6mo",
                "thumbnail" => "",
                "meta_desc" => "Drumeo 6 month ticket. The perfect last minute gift for Drummers!",
                "meta_img" => "https://i.vimeocdn.com/video/834275611-3f666c3ade2a940ebd9bb59a12ca66669b83ffe56f85b097e319bb0d6bbbb7f7-d_1280",
                "short_desc" => "",
                "header_text" => "The perfect last minute gift for Drummers!",
                "price" => 127,
                "discounted_price" => "",
                "features" => [
                    "We know it's hard to find the perfect Christmas gift for drummers, especially at the last minute. So we created it. The 6-Month Ticket to Drumeo is an amazing gift for any drummer and can be ready to put under the tree within minutes!",
                    "Immediately after ordering, you’ll get a printable PDF file along with a special Access Code that you can write onto the ticket - turning it into a gift that anybody can use to redeem 6 months of full access to Drumeo.",
                    "The Drumeo Gift Card includes full access to Drumeo, The Ultimate Online Drum Lessons Experience. It includes access to a new live lesson every day, more than 2500 pre-recorded video drum lessons, a massive library of play-alongs and song breakdowns, the best online drum community in the world, and more!"
                ],
                "specs" => [
                    [
                        "title" => "Format",
                        "desc" => "	PDF file, printable anytime"
                    ],
                    [
                        "title" => "Redeem",
                        "desc" => "	Go to drumeo.com/redeem-ticket"
                    ],
                    [
                        "title" => "Membership",
                        "desc" => "	6 months of full access"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "",
                "video" => "//player.vimeo.com/video/375490419",
                "instructor_name" => "",
                "instructor_desc" => "",
                "instructor_img" => null,
                "studyText" => "",
                "overview" => "",
                'bundle_img' => '',
                "bundle_desc" => ""
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "30 Day Drummer",
                "slug" => "30-day-drummer",
                "sku" => "",
                "thumbnail" => "https:/drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/header_thumb.png",
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/promos/august/30logo.png",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Learn the drums by PLAYING the drums with daily guided workouts. The first-ever class starts September 5, 2022.",
                'badge_text' => 'Registration closed',
                "header_text" => "",
                "price" => 97,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => false,
                "free_shipping" => false,
                "included_edge" => true,
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Domino Santantonio",
                "instructor_desc" => "",
                "instructor_img" => null,
                "studyText" => "",
                "overview" => "",
                "bundle_desc" => ""
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "New Drummers Start Here",
                "slug" => "new-drummers",
                "sku" => "new-drummers-start-here",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/new-drummers-start-here.jpg",
                "meta_desc" => "The fastest way to get started on the drums and play the songs you love.",
                "meta_img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/og-image.jpg",
                "short_desc" => "Your guide to go from a total beginner to playing drums with real music in 90-days or less.",
                "header_text" => "",
                "price" => 7,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Jared Falk",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/ndsh.jpg',
                "bundle_desc" => "Crush your first 90 days on the drums. New Drummers Start Here will help you go from a beginner drummer to playing with REAL music in 90 days or less. By the end of the course, you’ll be ready to enter the intermediate phase of your drumming with confidence.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Rock Drumming Masterclass",
                "slug" => "rock-drumming-masterclass",
                "sku" => "rock-drumming-masterclass-pack",
                "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/rdm-card-comp.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Todd Sucherman’s 26-week course to rapidly improve your rock drumming -- featuring weekly video lessons and hand-picked exercises.",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/logo-white.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Todd Sucherman",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/rdm.jpg',
                'bundle_desc' => 'Rock icon Todd Sucherman is your personal drum coach with a 26-week online course to rapidly improve your rock drumming. You’ll get weekly video lessons and exercises to improve your beats, fills, creativity, solos, bass drum combinations, hand technique, shuffles & variations, musicality, and more.',
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drum Technique Made Easy",
                "slug" => "drum-technique-made-easy",
                "sku" => "drum-technique-made-easy-pack",
                "thumbnail" => "https://dz5i3s4prcfun.cloudfront.net/drum-technique-made-easy/dtme-pack-card-thumb-w-o-logo.png",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Bruce Becker’s 26-week course to improve your hand technique and foot technique on the drums -- featuring weekly video lessons and exercises.",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/logo-white.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Bruce Becker",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/dtme.jpg',
                "bundle_desc" => "Technique guru Bruce Becker delivers an intimate 26-week course where you’ll get his proven process for improving your hand technique and foot technique so you can develop more speed and control around the kit -- all while preventing injuries & enjoying the music.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Independence Made Easy",
                "slug" => "independence-made-easy",
                "sku" => "independence-made-easy-pack",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/independence-made-easy.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Jared Falk’s 26-week course to unlock your musicality and creativity on the drums -- with weekly video lessons and hand-picked exercises.",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Jared Falk",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/ime.jpg',
                "bundle_desc" => "Freedom starts here. Jared Falk’s 26-week course was built to unlock all four limbs so you can play more musical grooves, better sounding fills, and finally achieve the musical freedom that allows you to play whatever you want, whenever you want.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Learn Songs Faster",
                "slug" => "learn-songs-faster",
                "sku" => "learn-songs-faster-pack",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/learn-songs-faster.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Your guide to learning MORE songs in less time with Jared Falk & Dave Atkinson",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 19,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/learn-songs-faster-logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Jared Falk & Dave Atkinson",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/lsf.jpg',
                "bundle_desc" => "A 75-minute masterclass with Jared Falk & Dave Atkinson to help you learn MORE songs in less time -- from active listening that’ll help you hear phrasing and understand song structure, to building effective grooves and fills, and keeping time so your playing always matches the music.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Four Weeks To Better Drum Fills",
                "slug" => "better-drum-fills",
                "sku" => "four-weeks-to-better-drum-fills",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/four-weeks-to-better-drum-fills.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "The ultimate crash course to playing more creative & more musical drum fills your audience will love!",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 97,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/four-weeks-to-better-drum-fills-logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Jared Falk",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/fwtbdf.jpg',
                "bundle_desc" => "The ultimate crash course to playing more creative and more musical drum fills your audience will love. Rather than memorizing and playing the same fills over and over again, you’ll gain the skills you need to create effective drum fills on the fly and adapt them to any musical setting.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Beyond Beginner Drumming",
                "slug" => "beyond-beginner-drumming",
                "sku" => "beyond-beginner-drumming",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/beyond-beginner-drummer/Title+Card.jpg",
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/beyond-beginner-drummer/BeyondBeginnerDrumming_Logo-white.svg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Make the jump from beginner to intermediate drummer",
                "header_text" => "",
                "price" => 127,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/beyond-beginner-drummer/BeyondBeginnerDrumming_Logo-white.svg",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Siros Vaziri",
                "instructor_desc" => "",
                "instructor_img" => null,
                "studyText" => "",
                "overview" => "",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Electrify Your Drumming",
                "slug" => "electrify-your-drumming",
                "sku" => "electrify-your-drumming",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/card-thumb.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "The ultimate guide to playing electronic dance music on the drums.",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 197,
                "discounted_price" => '',
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "included_edge" => true,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Michael Schack",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/eyd.jpg',
                'bundle_desc' => 'Electrify Your Drumming will teach you the tools and styles of electronic dance music -- so you can build energy with risers, lock in with the vocals, add power to your beats and fills, create a climax in the music, and ultimately fuel any song with your playing -- giving you valuable skills that will apply to every style of music.'
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Successful Drumming",
                "slug" => "successful-drumming",
                "sku" => "SD-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/successful-drumming.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Jared Falk’s step-by-step curriculum for building a rock-solid foundation on the drums -- with 18 hours of video lessons and a 274-page workbook.",
                "header_text" => "",
                "price" => 247,
                "discounted_price" => '',
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/successful-drumming.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Jared Falk",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/sd.jpg',
                'bundle_desc' => 'Jared Falk’s step-by-step curriculum for building a rock-solid foundation on the drums. This digital training pack includes 18 hours of video lessons and a 274-page workbook -- helping you lock in with other musicians, prepare for gigs, and set yourself up for a successful experience on the drums.'
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drumming System",
                "slug" => "drumming-system",
                "sku" => "DSYS2-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/drumming-system-2.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Mike Michalkow’s encyclopedia of drum lessons -- with more than 30 hours of video lessons on every topic that most drummers ever want to learn.",
                "header_text" => "",
                "speicalText" => "Or free with Drumeo",
                "price" => 247,
                "discounted_price" => '',
                "features" => [

                ],
                "specs" => [

                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/drumming-system-2.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Mike Michalkow",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Methods & Mechanics",
                "slug" => "methods-and-mechanics",
                "sku" => "MAM-DIGI",
                "thumbnail" => "https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/packs/550/methods-and-mechanics.jpg",
                "meta_desc" => "Todd Sucherman brings the knowledge of thousands of gigs, shows and recording sessions along with over three decades as a professional drummer to this useful and unique package.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Methods%20And%20Mechanics/og-image.jpg",
                "short_desc" => "Todd Sucherman brings the knowledge of thousands of gigs, shows and recording sessions along with over three decades as a professional drummer to this useful and unique package.",
                "header_text" => "Enhance your rhythmic & musical vocabulary on the drums.",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Better Practice",
                    "Hand Technique",
                    "Applying Rudiments",
                    "Drum Tuning",
                    "Developing Musicality",
                    "History of Drumming",
                    "Double Bass",
                    "Creative Drum Fills",
                    "Performance Breakdowns",
                    "Keeping Things Fresh",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2009"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "312 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "All Levels"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Methods%20And%20Mechanics/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Methods%20And%20Mechanics/logo.png",
                "video" => "//player.vimeo.com/video/85543585",
                "instructor_name" => "Todd Sucherman",
                "instructor_desc" => "Todd Sucherman is one of the most in-demand drummers on the planet. In addition to a 20+ year tenure with the legendary rock band, Styx, Sucherman is also an in-demand clinician and the creator of the award-winning Methods and Mechanics instructional DVD series.

                Sucherman recently won two awards in the 2018 Modern Drummer Readers Poll for #1 Progressive Rock Drummer and the #1 Recorded Performance for The Mission (Styx).",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Todd Sucherman",
                        "desc" => "Award-Winning Rock Drummer, In-Demand Clinician, & 20+ Year Drummer For Styx"
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "**“Best DVD”, Modern Drummer Readers Poll (2009)**

                Todd Sucherman brings the knowledge of thousands of gigs, shows and recording sessions along with over three decades as a professional drummer to this useful and unique package.

                Astonishing technique, power and musicality explode from the various musical and solo performances throughout this presentation. Working with artists over a myriad of genres diverse as Styx, Brian Wilson, Spinal Tap, Eric Marienthal, Peter Cetera, John Wetton, Steve Cole, The Falling Wallendas and countless more, there’s a wealth of knowledge imparted that goes way beyond just the technical aspects of drumming.

You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/todd-sucherman.jpg",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "The Language Of Drumming",
                "slug" => "the-language-of-drumming",
                "sku" => "TLOD-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/language-of-drumming.jpg",
                "meta_desc" => "The Language of Drumming helps you express yourself through the drums by focusing on the most basic components: the individual letters of the rhythmic alphabet.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Language%20Of%20Drumming/og-image.jpg",
                "short_desc" => "Benny Greb’s system for musical expression -- featuring over three hours of online video lessons to help you express your ideas on the drums.",
                "header_text" => "Benny Greb’s System For Musical Expression",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "The letters of the rhythmic alphabet.",
                    "Applying the rhythmic alphabet around the kit.",
                    "How to play the alphabet leading with either hand.",
                    "Ternary letters of the rhythmic alphabet.",
                    "Introductions to the words and odd note groupings.",
                    "How to practice independence on the drums.",
                    "Improvisation techniques.",
                    "Applying rhythmic syntax on the kit.",
                    "Improving your timing with a metronome.",
                    "Exploring creative sounds on your drum kit."
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2009"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "192 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "Intermediate"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Language%20Of%20Drumming/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Language%20Of%20Drumming/logo.png",
                "video" => "//player.vimeo.com/video/292144481",
                "instructor_name" => "Benny Greb",
                "instructor_desc" => "Internationally-acclaimed drummer and educator Benny Greb has taken the art of drumming to an entirely new level with his awe-inspiring creativity, musicality, and technique -- arriving on the scene in 2009 with “The Language of Drumming” and landing on the front cover of Modern Drummer in June 2015 for a feature on “The Art And Science Of Groove”. Benny also writes, records, and releases his own solo records including Grebfruit, Brass Band, and Moving Parts.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/benny-greb.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Benny Greb",
                        "desc" => "Award-Winning Clinician, Modern Drummer Cover Artist, & Accomplished Solo Drummer"
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "Learning to play the drums is like learning to speak a language. Knowing a few basic drum beats and fills is like knowing only a few standard phrases in a language; you won’t be able to communicate or have a full, interactive conversation in practical situations.

                The Language of Drumming helps you express yourself through the drums by focusing on the most basic components: the individual letters of the rhythmic alphabet. Benny Greb introduces his revolutionary 24-character system and shows you how to use the basic binary and ternary rhythms to develop timing, technique, dynamic control, and speed.

                Covering hands and feet, with and without a practice pad, Greb quickly progresses from simple alphabetical exercises to more intricate examples of words (rhythmic phrases) and syntax (sentences and vocabulary) on the full drum set. You will gain insights on the importance of listening, building fills and solos using standard improvisational forms, developing better timing, expanding rhythmic comfort zones through the creative use of a metronome, and finding new sounds on the drum set.

                Throughout the entire presentation, Greb flawlessly performs exercises and patterns that illustrate his theories. You’ll also get several drum solos as well as Greb’s performances with master percussionist Pete Lockett and the Benny Greb Brass Band.

You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Great Hands For A Lifetime",
                "slug" => "great-hands-for-a-lifetime",
                "sku" => "GHFAL-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/great-hands-for-a-lifetime.jpg",
                "meta_desc" => "Tommy Igoe guides you towards developing and maintaining the physical tools that are essential for every drummer and drumming application: your hands.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Great%20Hands%20For%20A%20Lifetime/og-image.jpg",
                "short_desc" => "Tommy Igoe helps you improve your hand strength, speed, stamina, comfort, and control in the drums in four hours of video lessons.",
                "header_text" => "Improve Your Hand Strength, Speed, Stamina, Comfort, & Control On The Drums",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Developing your grip and fulcrum.",
                    "Left hand finger control.",
                    "A rebound stroke practice routine.",
                    "An accent practice routine.",
                    "Essential rudiments and exercises.",
                    "The Basic Lifetime Warmup.",
                    "The Intermediate Lifetime Warmup.",
                    "The Advanced Lifetime Warmup.",
                    "The 5-Minute Advanced Lifetime Warmup.",
                    "An interview with Tommy’s father, Sonny Igoe.",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2010"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "240 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "All Levels"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Great%20Hands%20For%20A%20Lifetime/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Great%20Hands%20For%20A%20Lifetime/logo.png",
                "video" => "//player.vimeo.com/video/292145247",
                "instructor_name" => "Tommy Igoe",
                "instructor_desc" => "Tommy Igoe is a world-class musician living in San Francisco. He has been long recognized as one of the finest drummers in the world and is the top-selling author in his field with four #1 titles on Amazon.com.

                Igoe wrote the drum set book for Disney’s epic Broadway production of the “The Lion King” where he served as principal drummer and conductor. He has played drums on three Grammy award winning recordings and was voted the World’s #1 Jazz Drummer in the 2014 Modern Drummer Readers Poll. He has created two ongoing weekly musical residency at iconic Jazz clubs in New York and San Francisco. His New York band, The Birdland Big Band, is the most popular weekly music event in the city for the last 9 years.

                His most recent and exciting project is the Tommy Igoe Groove Conspiracy, a 15-piece supergroup from the San Francisco that has quickly become an integral part of the San Francisco cultural landscape. He is currently the President of Deep Rhythm Music, his recording studio, publishing arm, record label and has several endorsement partners.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/tommy-igoe.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Tommy Igoe",
                        "desc" => "2X Best Jazz Drummer, Best-Selling Author, & Drummer for The Birdland Big Band in New York City."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "Tommy Igoe guides you towards developing and maintaining the physical tools that are essential for every drummer and drumming application: your hands.

At the heart of this life-changing, career-extending system is the three-tier “Lifetime Warmup” originally conceived in the 1950s by Tommy’s father, Sonny Igoe. Featuring basic, intermediate, and advanced levels - the Lifetime Warmup is a challenging routine that weaves its way through standard drum rudiments and original exercises while simultaneously keeping drummers in command of their basic drumming motions.

Your pathway to playing better, faster, and healthier for a lifetime of pain-free drumming -- Great Hands For A Lifetime will help you unlock your potential and protect your hands for the many years of drumming to come.

All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
                'bundle_img' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/july/tommy_card.jpg',
                "bundle_desc" => "Tommy Igoe helps you improve your hand strength, speed, stamina, comfort, and control on the drums in this digital course. You’ll learn a challenging routine that weaves its way through standard rudiments while keeping you in command of drumming’s basic motions.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Hands Grooves & Fills",
                "slug" => "hands-grooves-and-fills",
                "sku" => "HGAF-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/hands-grooves-fills.jpg",
                "meta_desc" => "Hands Grooves & Fills gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Hands%20Grooves%20And%20Fills/og-image.jpg",
                "short_desc" => "Pat Petrillo’s curriculum for developing technique, groove ideas, and a drum fill vocabulary -- with three hours of video lessons and a 52-page workbook.",
                "header_text" => "Better Hand Technique, More Groove Ideas, & More Creative Drum Fills",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Hand Technique & Coordination",
                    "Rudiment TAB System",
                    "Bass Drum Technique",
                    "Ghost Notes",
                    "Groovalations, Nastifications, & Swingalations",
                    "Linear Grooves",
                    "Drum Fills using the drag.",
                    "Drum Fills using the six stroke roll.",
                    "Drum soloing",
                    "Stick Tricks",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2007"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "175 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "All Levels"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Hands%20Grooves%20And%20Fills/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Hands%20Grooves%20And%20Fills/logo.png",
                "video" => "//player.vimeo.com/video/292145073",
                "instructor_name" => "Pat Petrillo",
                "instructor_desc" => "Pat Petrillo is one of today’s most prolific drummers. Whether it’s a deep pocket funk groove or a fiery fusion fill, Petrillo can bring it all together with musicality, finesse, and uncanny technical ability.

He has performed and recorded with R&B legends Gloria Gaynor and Patti LaBelle, Pop/Rock artists Glen Burtnik and Patty Smyth, and jazz artists Ed Hamilton and Gerald Veasley -- as well as playing the original Broadway productions A Chorus Line, Grease, and Footloose.

Petrillo has served as a faculty member at the Drummer’s Collective in New York City and has served as a regular educational contributor to Drumeo, Drummerworld, and Modern Drummer Magazine.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/pat-petrillo.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Pat Petrillo",
                        "desc" => "Veteran NYC Drummer, Acclaimed Drum Educator, & Designer of the Drumeo P4 Practice Pad."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "Hands, Grooves, & Fills is a complete curriculum for developing technique, groove ideas, and a drum fill vocabulary.

**Hands:** Petrillo demonstrates his exercises and methods for developing smooth, relaxed hand technique, endurance and coordination. He also demonstrates all of the standard rudiments with modern interpretations, and shows you how to put them into musical phrases using his groundbreaking “Rudiment TAB System”.

**Grooves:** Music is all about the groove, and Petrillo demonstrates how to develop bass drum technique and ghost note ideas, while having FUN with over 50 play along tracks featuring a great band of New York’s finest musicians in the groove styles of Rock, R&B, Jam Band, New Orleans Funk, Fusion, Drum n’ Bass and many more.

**Fills:** Creating fills is always a challenge, and Pat shows his methods of orchestrating 16th notes, sextuplets and numerous rudiment stickings into creative, awesome sounding fills. If you are lacking a fill vocabulary, or always wanted to learn killer fills, PAT BREAKS IT ALL DOWN!

This video pack also comes with a 52 page workbook.

All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Anatomy Of A Drum Solo",
                "slug" => "anatomy-of-a-drum-solo",
                "sku" => "AOADS-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/anatomy-of-a-drum-solo.jpg",
                "meta_desc" => "In-studio footage of Neil Peart discussing, in detail, his approach to soloing.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Anatomy%20Of%20A%20Drum%20Solo/og-image.jpg",
                "short_desc" => "Neil Peart breaks down his approach to drum soloing -- with more than three hours of online video to improve your rhythm and improvisation.",
                "header_text" => "Neil Peart’s Inspiration, Improvisation,& Approach To Soloing",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Overall approach to composing a drum solo.",
                    "Introduction to the drums and setup that Peart uses.",
                    "The R30 tour setlist.",
                    "Introduction to “Element 1” of his drum solo.",
                    "How he uses the narrative arc in soloing.",
                    "Incorporating African rhythms into a solo.",
                    "Rhythmic variations and incorporating them into your playing.",
                    "Creating mood changes with different voices on the drums.",
                    "Hand technique and how it’s changed throughout his career.",
                    "Big band sections of drum solos.",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2005"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "200 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "Intermediate"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Anatomy%20Of%20A%20Drum%20Solo/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Anatomy%20Of%20A%20Drum%20Solo/logo-white.png",
                "video" => "//player.vimeo.com/video/292144959",
                "instructor_name" => "Neil Peart",
                "instructor_desc" => "Best known as the drummer and primary lyricist for the rock band Rush, Neil Peart has received numerous awards for his musical performances including Best Rock Drummer, Best Multi-Percussionist, Best All Around Drummer, as well as inductions into the Rock and Roll Hall of Fame and the Modern Drummer Hall of Fame.

Peart is noted for his distinctive in-concert drum solos, characterized by exotic percussion instruments and long, intricate passages in odd time signatures - and his drum solos were featured on every live album released by Rush. “Anatomy of a Drum Solo” gives you an in-depth examination of how he constructs a solo that is musical, rather than indulgent, using his solo from the 2004 R30 30th anniversary tour as an example.",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Neil Peart",
                        "desc" => "World-renowned drummer for Rush. Inducted into the Rock and Roll Hall of Fame in 2013."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "**“Best Instructional Video”, Modern Drummer Readers Poll (2006)
                “Best DVD”, DRUM! Magazine Drummie Awards (2007)**

In-studio footage of Neil Peart discussing, in detail, his approach to soloing. Using a solo recorded in 2004 in Frankfurt, Germany, as a framework - Peart talks about each segment of this nine-minute tour de force that is a highlight of each Rush performance.

Also included are:

Two explorations -- completely improved workouts at the drums, each over thirty minutes long; a never-before-released solo recorded in Hamburg, Germany in September, 2004.
Peart’s Grammy Award-nominated solo from Rush in Rio.
Two full Rush performances from Frankfurt 2004, shown entirely from the perspective of the drum cameras.
Interviews with Lorne Wheaton, Peart’s drum tech, and Paul Northfield, Rush co-producer and engineer.
A previously unreleased solo from the Rush Counterparts tour recorded in 1994 at the Palace of Auburn Hills in Michigan.

You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/neil-peart.jpg",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "In Constant Motion",
                "slug" => "in-constant-motion",
                "sku" => "ICM-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/in-constant-motion.jpg",
                "meta_desc" => "In Constant Motion gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/In%20Constant%20Motion/og-image.jpg",
                "short_desc" => "Seven hours of instruction, live and studio performances, and insights into Mike Portnoy’s various drumming projects.",
                "header_text" => "Mike Portnoy’s Performances, Drum Solos, & Musical Insights",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Playing with a band",
                    "Song breakdowns",
                    "Musical influences",
                    "Drum kit walkthrough",
                    "Drum solo performances",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2007"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "420 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "Intermediate"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/In%20Constant%20Motion/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/In%20Constant%20Motion/logo.png",
                "video" => "//player.vimeo.com/video/292144804",
                "instructor_name" => "Mike Portnoy",
                "instructor_desc" => "Mike Portnoy is known for his incredible performances as the drummer for Dream Theater for 25 years -- along with his musical side projects including Transatlantic and Liquid Tension Experiment.

He has won 30 Modern Drummer Readers Poll awards including Best Rock Drummer, Best Progressive Rock Drummer, Best Recorded Performance, Best Clinician, Best Educational Video, and the Most Valuable Player -- as well as being the second youngest drummer to be inducted into the Modern Drummer Hall of Fame.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-portnoy.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Mike Portnoy",
                        "desc" => "Legendary drummer for Dream Theater and 30x Modern Drummer Readers Poll Award-Winner."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "In Constant Motion features over seven hours of instruction, live and studio performances, and insights into Mike Portnoy’s numerous projects. Packed with audio and video, special features, and printable transcriptions of selected performances, the depth and diversity of this package is recommended for drummers of all interests and skill levels.

**Section 1** titled “In the Dream” focuses on music from three of Portnoy’s Dream Theater albums: Six Degrees of Inner Turbulence, Train of Thought, and Octavarium; featuring complete band performances of six songs from these albums as well as new studio performances of the drum tracks and Portnoy’s in-depth analysis of each song.

**Section 2** titled “On the Side” covers a wide range of Portnoy’s side projects, including his work with TransAtlantic, John Arch, John Petrucci/G3, Fates Warning and Overkill. In addition to the nearly 6 hours of high quality, all-new content, excerpts of rare performances are also included – including a detailed look at each of Mike’s tribute bands, paying homage to The Beatles, Led Zeppelin, The Who and Rush!

**Section 3** offers Bonus Material containing four additional Dream Theater tracks filmed on the band’s 20th Anniversary tour, three live drum solos featuring duets with Charlie Benante, Jason Bittner and Richard Christy, a tour of Portnoy’s infamous “Albino Monster” drum kit and bonus clips including unreleased live solos, studio footage and more.

All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Creative Control",
                "slug" => "creative-control",
                "sku" => "CC-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/creative-control.jpg",
                "meta_desc" => "Thomas Lang presents a completely innovative and inspired practice regime, and system for helping you develop incredible drumset technique, that will forever change your approach to drumming.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Creative%20Control/og-image.jpg",
                "short_desc" => "Thomas Lang’s innovative system for developing technique so you can play more effectively in any style of music. Includes more than four hours of video.",
                "header_text" => "Hone Your Chops & Play More Effectively In Any Style Of Music",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Applied rudiments and orchestration",
                    "Dynamic foot control",
                    "Stick tricks and showmanship",
                    "Ergonomic mechanics on the drum kit",
                    "Advanced interdependence/coordination",
                    "Multi-pedal orchestrations",
                    "Creative practice concepts",
                    "Twin effect pedal playing and practice",
                    "Contemporary groove concepts",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2004"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "314 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "Intermediate & Advanced"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Creative%20Control/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Creative%20Control/logo.png",
                "video" => "//player.vimeo.com/video/292145163",
                "instructor_name" => "Thomas Lang",
                "instructor_desc" => 'A world-class drummer whose passion is "to play the unplayed", Thomas Lang has headlined at every major international drum festival and toured the world many times over as a solo performer, as well as playing with artists including Tina Turner, Kelly Clarkson, Robbie Williams, The Commodores, George Michael, and Victoria Beckham. Thomas has won numerous awards from drum magazines and publications including the Best Studio Drummer, Best Pop Drummer, Best All-Around Drummer, Best DVD, Best Drummer, Best Recorded Drum Performance, and Best Drum Clinician.',
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/thomas-lang.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Thomas Lang",
                        "desc" => "Voted the “Best Clinician/Educator” three times in the Modern Drummer Readers Poll."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "Thomas Lang presents a completely innovative and inspired practice regime, and system for helping you develop incredible drumset technique, that will forever change your approach to drumming. Lang's awesome speed, control, finesse and unparalleled interdependence will inspire you to hone your drumming chops so that you can play more effectively in any musical context. Thomas also offers blazing solos and performances in many different styles, including a definitive version of The Black Page, the Frank Zappa tour de force.

All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "The Grid",
                "slug" => "the-grid",
                "sku" => "TG-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/the-grid.jpg",
                "meta_desc" => "With The Grid, Mike Mangini presents a complete system for expanding your skills as a creative player and improviser, focusing in on your own musical identity.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Grid/og-image.jpg",
                "short_desc" => "Mike Mangini’s system for creative drumming and improvisation -- including more than three hours of online video for expanding your skills.",
                "header_text" => "Mike Mangini’s System For Creative Drumming & Improvisation",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "The world of time signatures.",
                    "Subdivisions and how they relate to time.",
                    "How to incorporate dynamics into your playing.",
                    "Using your limbs to create musical ideas and keep time.",
                    "Musical styles and why they are important.",
                    "The importance of musical phrasing.",
                    "The concept of improvisation.",
                    "Protocols for Jazz, Rock, Afro-Cuban, and funk.",
                    "Balance and playing on a large drum set.",
                    "How to use a variety of different ostinatos.",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2013"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "203 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "Intermediate & Advanced"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Grid/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Grid/logo.png",
                "video" => "//player.vimeo.com/video/292144708",
                "instructor_name" => "Mike Mangini",
                "instructor_desc" => "The current drummer for Dream Theater and a touring drum clinician, Mike Mangini has a musically diverse background containing over 60 awards spanning musical styles from Classical, Jazz, Rock, to Heavy Metal, solo drumming, and World’s Fastest Drummer records.

Mangini taught at the Berklee College of Music for eleven years - and chose to release The Grid to define “improvisation”, break it down, and show how it works.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-mangini.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Mike Mangini",
                        "desc" => "Drummer for Dream Theater, Accomplished Educator, & World’s Fastest Drummer in five categories."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "**“Best Instructional Video”, Modern Drummer Readers Poll (2015)**

With The Grid, Mike Mangini presents a complete system for expanding your skills as a creative player and improviser, focusing in on your own musical identity.

This system is presented through performed examples and graphics, and applies to drummers of all musical styles. Dividing your drumming into time signature, subdivision, dynamics, instrument sounds, limbs, style, and phrases, Mike demonstrates dozens of grooves, fills, and patterns from easy to extremely advanced -- systematically showing you how to use “the grid” to expand your understanding of music and drumming, and improve your physical abilities.

You will increase your speed, develop better independence, learn how to use ostinatos, expand your knowledge of styles, learn polyrhythms, play in odd time signatures, develop a deeper understanding of rhythm, and become a more creative player.

All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Beyond The Chops",
                "slug" => "beyond-the-chops",
                "sku" => "BTC-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/beyond-the-chops.jpg",
                "meta_desc" => "Beyond The Chops gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Beyond%20The%20Chops/og-image.jpg",
                "short_desc" => "A three-hour masterclass experience showcasing Aaron Spears’ phenomenal drumming through performances, educational segments, and interviews.",
                "header_text" => "Groove, Musicality, & Technique",
                "special_text" => "",
                "price" => 29.99,
                "discounted_price" => "",
                "features" => [
                    "Shuffle variations.",
                    "Grooves and fills.",
                    "Bass drum pedal technique.",
                    "Hand-to-foot combinations.",
                    "Drum fill orchestration.",
                    "How to develop a sense of time.",
                    "Coming up with new ideas on the drums.",
                    "Modern drum beats.",
                    "Technique and setup.",
                    "Creativity in drum solos.",
                ],
                "specs" => [
                    [
                        "title" => "Publisher",
                        "desc" => "Hudson Music, 2009"
                    ],
                    [
                        "title" => "Video",
                        "desc" => "187 minutes"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "All Levels"
                    ],
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Beyond%20The%20Chops/logo-white.png",
                "page_logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Beyond%20The%20Chops/logo.png",
                "video" => "//player.vimeo.com/video/292144401",
                "instructor_name" => "Aaron Spears",
                "instructor_desc" => "Aaron Spears is a two-time winner of the “Best R&B Drummer” award in the Modern Drummer Readers Poll -- and his “in the pocket” style of playing and authentic delivery is unparalleled in the world of drummers today.

His playing style has given him the opportunity to perform with some of the most popular musicians on the planet including Usher, Ariana Grande, Carrie Underwood, Britney Spears, Chamillionaire, the Backstreet Boys, James Brown, Alicia Keys, Adam Lambert, Jordin Sparks, Lil Wayne, Miley Cyrus, and many more.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/aaron-spears.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-trophy",
                        "heading" => "Study With Aaron Spears",
                        "desc" => "Drummer for mega-platinum superstars including Usher, Ariana Grande, and Carrie Underwood."
                    ],
                    [
                        "icon" => "fa-users",
                        "heading" => "Drumeo Interactive Edition",
                        "desc" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience."
                    ],
                ],
                "overview" => "Beyond The Chops gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.

This 3-hour program offers amazing performances, enlightening educational segments, and revealing interviews as Spears displays his natural talent, incredible groove, and deep skills in a set of performances with Gospel, R&B, Motown, rock, shuffle, and odd-meter tracks. You’ll get an in-depth look at his exceptional ability to combine a wide range of musical genres and influences into a seamless, powerful, new style of drumming.

Spears also hosts a Q&A session in front of a masterclass and then sits down with drumming icon Jojo Mayer for a candid interview covering everything from his gospel roots to his recent work with Usher, the Backstreet Boys, and the American Idol tour. You’ll gain insights into the unique rhythmic vocabulary he has created with many of the grooves and fills transcribed in an accompanying 21-page workbook.

All sheet music features Drumeo SmartBeat Sheet Music for playing or pausing the notation, speeding up or slowing down the exercises, and creating loops to improve your learning experience. You’ll also get online access to Drumeo features like progress tracking, video commenting, and community forums where you can connect with students and teachers from around the world.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Pianote Membership",
                "slug" => "",
                "sku" => "",
                "thumbnail" => "https://pianote.s3.amazonaws.com/sales/promos/july/header.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Perfectly structured step by step lessons, with teachers that are fun to watch, and unlimited support - 100% guaranteed. Learn piano online the easy way.",
                "header_text" => "",
                "price" => 240,
                "discounted_price" => "",
                "features" => [
                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/pianote-annual.png',
                "bundle_desc" => "Discover the best online piano lessons experience with Pianote. Your Pianote membership will give you hundreds of expertly designed, step-by-step lessons to guide you along the path to musical freedom. And you don’t need any special cables or software to get started, it works with EVERY piano or keyboard. And you’ll get access to REAL teachers who will be able to answer any questions you have along the way.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "The Power of Chords",
                "slug" => "the-power-of-chords",
                "sku" => "the-power-of-chords",
                "thumbnail" => "https:/pianote.s3.amazonaws.com/products/the-power-of-chords/header_thumb.png",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Play the music you love on piano.",
                "header_text" => "",
                "price" => 97,
                "discounted_price" => 0,
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://pianote.s3.amazonaws.com/sales/promos/august/Logo_center_white.svg",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/power-of-chords.jpg',
                "bundle_desc" => "Play the music you love on the piano with the awesome Power of Chords. This fun course will demystify chording and show you how chords are the foundation of ALL music (even classical). When you understand and can play chords -- you’ll be able to play the songs you love easier, with more confidence.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Improvisation & Musical Freedom",
                "slug" => "improvisation-with-jesus-molina",
                "sku" => "jesus-molina-improvisation-and-musical-freedom-pack",
                "thumbnail" => "https://pianote.s3.amazonaws.com/sales/2022/coaches/jesus_molina3.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Get inside the mind of one of the world’s best improvisers",
                "header_text" => "",
                "price" => 47,
                "discounted_price" => 0,
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://pianote.s3.amazonaws.com/sales/jesus-molina/Logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Jesus Molina",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/improv-musical-freedom.jpg',
                "bundle_desc" => "How do you learn to improvise on the piano? Simple. You learn from the best in the world! Join Jesús Molina as he shows you how to approach improvising in a structured, step-by-step way that’s fun, inspiring, and 100% not scary. It’s rare to get access to teachers of this caliber. But the course is yours for life.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Worship Piano",
                "slug" => "worship-piano",
                "sku" => "worship-piano",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/card-thumb.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Start playing piano or keyboard in your church.",
                "header_text" => "",
                "price" => 99,
                "discounted_price" => 29,
                "features" => [
                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/logo-text-white.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt & Amberly Martz",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/worship-piano.jpg',
                "bundle_desc" => "Master the skills to play modern worship songs and learn how to be part of a band. You’ll learn how to read worship chord charts, create beautiful background music, and how to be part of a worship team. Plus, this pack comes with your own band as a backing track, so YOU can join the band and play piano with other musicians. No prior knowledge or experience necessary. We start from scratch with this one.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Playing Beautiful Piano",
                "slug" => "play-beautiful-piano",
                "sku" => "play-beautiful-piano",
                "thumbnail" => "https://pianote.s3.amazonaws.com/products/play-beautiful-piano/shop-card.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Start playing beautiful piano music from your very first lesson.",
                "header_text" => "",
                "price" => 7,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://pianote.s3.amazonaws.com/products/play-beautiful-piano/logo-minimal.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/TBGTPBP.jpg',
                "bundle_desc" => "Start playing beautiful piano music from the very first time you touch the keyboard. The Beginner’s Guide To Playing Beautiful Piano is your introduction to the world of stunning melodies and emotional music. Follow along and play beautiful sounds. But you won’t just be copying what you see… You’ll learn WHY certain chords and melodies sound beautiful. So after the course, you can create your own beautiful piano music.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "500 Songs In 5 Days",
                "slug" => "500-songs",
                "sku" => "500-songs-in-5-days",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/500-songs.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Don’t you want your playing to sound... better?",
                "header_text" => "",
                "price" => 99,
                "discounted_price" => 39,
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/500-songs-in-5-days.jpg',
                "bundle_desc" => "Learn the skills to play 500 songs in just 5 days. You’ll learn how to build and play chords, chord inversions, as well as fancy riffs and fills to make you sound like a pro. Plus -- you’ll get downloadable chord charts for 500 songs that are yours to keep FOREVER! Perfect for the beginner who wants to play REAL songs as fast as possible, even if you’ve never touched a piano before.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Piano Technique Made Easy",
                "slug" => "piano-technique-made-easy",
                "sku" => "piano-technique-made-easy",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/cart-image.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Master the fundamentals -- so you can play anything you want on the piano.",
                "header_text" => "",
                "price" => 120,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Cassi Falk",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg',
                "bundle_desc" => "Piano Technique Made Easy is the comprehensive guide for learning and perfecting your technique. Every scale. Every key signature. Every chord. You’ll learn them all to build a strong piano foundation so you can play faster, learn songs quicker, and express yourself through your playing.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "De-Stupefy Your Left Hand",
                "slug" => "destupefy-your-left-hand",
                "sku" => "destupefy-your-left-hand",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/destupefy-your-left-hand.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "It’s time to tame your left hand.",
                "header_text" => "",
                "price" => 99,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/de-stupefy-logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg',
                "bundle_desc" => "Your left hand is weaker. And that’s normal. Most piano players struggle with their left hand, and sadly, most just accept it. De-Stupefy Your Left Hand is your 3-step path to a better left hand. Yes, your left hand might be weaker… but it doesn’t have to be.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Faster Fingers",
                "slug" => "faster-fingers",
                "sku" => "faster-fingers",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/faster-fingers.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Play faster, make fewer mistakes, and learn songs quickly!",
                "header_text" => "",
                "price" => 99,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/faster-fingers.jpg',
                "bundle_desc" => "Increase your finger speed, strength, and accuracy with this complete digital training pack. Faster Fingers is your roadmap to success on the piano. You’ll be guided every step of the way with daily practice videos and encouragement, plus you’ll be able to play along with every exercise and record your speed. The metronome doesn’t lie -- you’ll be able to SEE how much faster you’re getting."
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Piano Riffs & Fills",
                "slug" => "riffs-and-fills",
                "sku" => "piano-riffs-and-fills",
                "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/piano-riffs-and-fills.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "The shortcuts to sounding great on the piano.",
                "header_text" => "",
                "price" => 99,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
                "bundle_desc" => "Anyone can play a chord -- but what happens in the spaces between the chords distinguishes the great players from the mediocre ones. Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect. This course is broken down so even complete beginners can start sounding amazing. You’ll be shown exactly how to play the fills -- note for note.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Classical Piano",
                "slug" => "beginner-classical-piano",
                "sku" => "classical-piano",
                "thumbnail" => "https://pianote.s3.amazonaws.com/shop/card-thumbs/classical-piano.png",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "The fun way to start playing classical piano.",
                "header_text" => "",
                "price" => 47,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://pianote.s3.amazonaws.com/lead-gen/classical-piano/logo-2.svg",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Victoria Theodore",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/TBGTCP.jpg',
                "bundle_desc" => "Discover the beautiful world of classical piano, without the stuffy reputation. Learn Chopin, Bach, and Beethoven from touring expert Victoria Theodore. This course is your step-by-step introduction to classical music that’s fun and inviting, so you can play beautiful pieces with ease.",
            ],

            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "Guitareo Membership",
                "slug" => "",
                "sku" => "",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/2021/header-background.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.",
                "header_text" => "",
                "price" => 240,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://guitareo.s3.amazonaws.com/sales/storefront/guitareo-membership-logo-white.svg",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Ayla Tesler-Mabe",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/annual.jpg',
                'bundle_desc' => 'Get inspired, stay motivated, and crush your goals on guitar with a Guitareo Membership. Ayla Tesler-Mabe’s 10-level METHOD curriculum will help you reach all of your goals – plus you’ll have access to guitar courses by Mark Lettieri (Snarky Puppy), Yvette Young (Covet), Dave Weiner (Steve Vai’s Guitarist), and more. Even better – you’ll get access to REAL teachers who will be able to answer any questions you have along the way.',
            ],
            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "Rhythm & Groove",
                "slug" => "rhythm-and-groove",
                "sku" => "rhythm-and-groove",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/coach.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.",
                "header_text" => "",
                "price" => 47,
                "discounted_price" => 0,
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/Logo.svg",
                "page_logo" => "",
                "included_edge" => true,
                "video" => "",
                "instructor_name" => "Sami Ghawi",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/rhythm_groove_cart.jpg',
                'bundle_desc' => 'Get inspired, stay motivated, and crush your goals on guitar with a Guitareo Membership. Ayla Tesler-Mabe’s 10-level METHOD curriculum will help you reach all of your goals – plus you’ll have access to guitar courses by Mark Lettieri (Snarky Puppy), Yvette Young (Covet), Dave Weiner (Steve Vai’s Guitarist), and more. Even better – you’ll get access to REAL teachers who will be able to answer any questions you have along the way.',
            ],
            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "Guitar Technique Made Easy",
                "slug" => "guitar-technique-made-easy",
                "sku" => "GTME-OCT-2018-SEMESTER",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/storefront/guitar-technique-made-easy-image.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Learn the most important guitar techniques and reach total guitar freedom.",
                "included_edge" => true,
                "header_text" => "",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://guitareo.s3.amazonaws.com/gtme/logo-white.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Nate Savage",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-technique-made-easy.png',
                'bundle_desc' => 'Better technique starts here! Guitar Technique Made Easy is the step-by-step process for learning the most important guitar techniques. Whether you want to focus on acoustic or electric guitar, this 26-week course will give you the skills and knowledge to pursue any genre or style of music. Break bad habits, and achieve total freedom on the guitar with Guitar Technique Made Easy.',
            ],
            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "The Guitar System",
                "slug" => "guitar-system",
                "sku" => "GUITAR-SYSTEM",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/june/guitar-system.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Transform your guitar playing with the ultimate encyclopedia of guitar lessons.",
                "included_edge" => true,
                "header_text" => "",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://guitareo.s3.amazonaws.com/tripwire/gs-logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Nate Savage",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-system.png',
                'bundle_desc' => 'Transform your guitar playing with the ULTIMATE Encyclopedia of Guitar Lessons. From very beginner to advanced, learn anything you want on the guitar with lessons that have been trusted by thousands of guitarists around the world! Whether you want to learn the basic guitar fundamentals, the ins-and-outs of tone, palm muting, guitar theory, or anything else you could possibly need. The Guitar System has it all!',
            ],
            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "GuitarQuest",
                "slug" => "guitar-quest",
                "sku" => "guitar-quest",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/june/guitar-quest.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Transform your guitar playing with the ultimate encyclopedia of guitar lessons.",
                "included_edge" => true,
                "header_text" => "",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Rob Scallon",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
                'bundle_desc' => 'Music is a language -- and just like you didn’t start talking by understanding prepositions and nouns, you shouldn’t learn guitar by endlessly studying theory. Instead, let’s just start playing!
Follow famous YouTuber and musician Rob Scallon as he takes you on a 9 mission journey where you’ll write songs, shoot a music video, make commercial jingles, and rock out ridiculously hard! So skip the boring stuff and start having fun with GuitarQuest!',
            ],
            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "Acoustic Guitar Made Easy",
                "slug" => "acoustic-guitar-made-easy",
                "sku" => "AGME-JAN-2019-SEMESTER",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/storefront/acoustic-guitar-made-easy-image.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Build a rock-solid foundation and get started on the acoustic guitar the right way.",
                "included_edge" => true,
                "header_text" => "",
                "price" => 197,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/AGME-logo-white.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Nate Savage",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/acoustic-guitar-made-easy.png',
                'bundle_desc' => 'Get started on the acoustic guitar the right way! With Acoustic Guitar Made Easy, you’ll learn and master the five pillars of the acoustic guitar to build a rock-solid foundation so you can play the songs you love. See your newfound skills in action as you learn to play iconic songs like “Horse With No Name,” “Brown Eyed Girl,” “Let It Be,” “Jambalaya,” and “Take It Easy.” This is your crystal-clear pathway to reaching your guitar goals.',
            ],
            [
                "brand" => 3,
                "product_type_id" => 1,
                "name" => "500 Songs In 5 Days",
                "slug" => "500-songs",
                "sku" => "500-songs-in-5-days-guitareo",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/june/500-songs-card-small.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Build the skills and knowledge to play 500 songs on the guitar. Comes with downloadable chord charts.",
                "included_edge" => true,
                "header_text" => "",
                "price" => 97,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => true,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "https://guitareo.s3.amazonaws.com/500-songs/logo.svg",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Nate Savage",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://guitareo.s3.amazonaws.com/500-songs/cart-image.png',
                'bundle_desc' => '500 Songs In 5 Days is designed to give you the skills and knowledge to quickly learn and play 500 songs from a variety of eras and styles. No memorization needed! Get the tips and tricks for playing almost any popular song, along with downloadable chord charts for 500 songs. So you can play the songs you love as much as you’d like, whenever you want.',
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Bass Drum Secrets",
                "slug" => "bass-drum-secrets",
                "sku" => "BDS2-DIGI",
                "thumbnail" => "",
                "meta_desc" => "ass Drum Secrets includes over 15 hours of video training to help you improve your bass drum speed, power, and control.",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "Improve your bass drum speed, power, & control",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Bass Drum Secrets features three uniquely qualified instructors who will show you three of the most powerful bass drum techniques, through step-by-step detail and slow-motion video technology. You’ll then learn exactly how each of the techniques are applied in practical playing situations, with applications that include single and double pedal beats, fills, and patterns.",
                    "You’ll also get 1000+ unique play-along loops to enhance your bass drum practice."
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "15 hours of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "1000+ play-along loops"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "171 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/bass-drum-secrets-black.png",
                "video" => "//player.vimeo.com/video/85543585",
                "instructor_name" => "Jared Falk, Dave Atkinson and Sean Lang",
                "instructor_desc" => "One of the most unique components of BDS 2.0 is that it includes three specialized instructors. Each of them bring something different to the table. First, Jared Falk is a well rounded gigging drummer that prefers to use the unique heel-toe technique. Next, Dave Atkinson is a powerful studio drummer that favors the slide technique. And finally, Sean Lang is an incredibly technical drummer that is partial to the flat foot technique for blazing fast singles.

Beyond the use of specific techniques, these three instructors bring unique advice, tips and tricks, and practical applications to the BDS 2.0 lessons. This allows you to choose from several options when applying essential concepts within your drumming. Ultimately, it will allow you to refine your own unique drumming style instead of adopting a single point of view.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/jared-dave-sean.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Step-By-Step Lessons",
                        "desc" => "More than 15 hours of video training to help you improve your bass drum speed, power, and control."
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "3 Qualified Instructors",
                        "desc" => "Learn from three specialized instructors - each offering unique advice, tips and tricks, and practical applications."
                    ],
                ],
                "overview" => "**Getting Started**
The 'Getting Started' Module is the perfect introduction to BDS 2.0. You will get to know your three instructors: Jared, Sean, and Dave - while learning essential bass drum fundamentals. Lessons include: choosing a pedal, drum tuning and muffling, bass drum pedal settings, bass drum pedal adjustments, seat height & posture, bass drum setup tips, heel up technique, heel down technique, flat foot technique, and a few other great tips to help get you started.

**Bass Drum Independence**
Bass Drum Independence is something that a lot of drummers struggle with. Separating your hands from your feet and your right foot from your left foot is no easy task. That's where this module hits the mark. It includes beginner, intermediate, and advanced hand patterns that are designed specifically to take your bass drum independence to the next level. Then, once you have completed the module, you can apply your new skills with some of the included drum play-along songs.

**Heel-Toe Technique**
The heel-toe technique has always been somewhat of a mystery to many drummers. When taught correctly, it can be learned in a few short minutes. However, without proper instruction, it can easily take days or even weeks of trial-and-error to get it working. This module simplifies the process and teaches you how to play the heel-toe technique with step-by-step examples. You will learn both how to master the technique, and how to apply it within your drumming.

**Heel-Toe Exercises**
Once you have developed the basic heel-toe technique, you'll want to start incorporating it within practical beats and fills. This fourth module covers beginner, intermediate, and advanced drumming patterns that make specific use of this unique technique. These examples will help you get started with incorporating double strokes in beats, and will leave you well prepared for creating your own unique heel-toe-based beats and fills in the future!

**Slide Technique**
This module covers the slide technique - a popular alternative to the heel-toe method. Dave Atkinson walks you through the basic fundamentals, including: correct footwear and pedal settings, how to develop the technique, how to develop the technique for your left foot, and how to apply the technique with drum beats and drum fills. The slide technique can be used in many different styles of music and is a natural way to play quick double strokes!

**Slide Technique Exercises**
In Module 6, you'll get a chance to apply the slide technique within practical beats and fills. It includes a collection of beginner, intermediate, and advanced patterns that progressively increase in difficulty. Each of the drum beats include ten unique variations, and the drum fills include five unique variations. Put your new found slide technique skills to work using these fun exercises, and be prepared to see a dramatic boost in the way you creatively incorporate the bass drum within music!

**Double Pedal Single Strokes 1**
Here we take a look at double pedal single strokes with Sean Lang. Sean walks you through a couple different lessons in this module, including: the element of groove, developing balance and control, basic 8th and 16th note patterns, bass drum triplets, foot assignment, single stroke beats, single stroke fills, note value exercises, and the herta lick. Playing quick single strokes is a valuable part of playing both single and double bass, so make sure you check out this fun module.

**Double Pedal Single Strokes 2**
In Module 8 we take a closer look at double pedal single strokes with Dave Atkinson. Dave takes you through a variety of topics, including: double bass warm ups, developing the weaker foot, double bass slide triplets, developing slow speeds, developing speed with single strokes, how to develop endurance, the swivel technique, practicing along to music, developing hand and foot independence, and ending with odd numbers. It's all broken down in step-by-step detail.

**Double Pedal Double Strokes**
Next, you get a chance to look at double pedal single strokes with Jared Falk. He walks you through basic 16th note patterns, 16th note triplets with double strokes, and hertas with double strokes. This really is something that can take your drumming to the next level and give you an edge over other drummers at the same time. By combining the tips and tricks from all three drummers, you'll have an opportunity to create your own original drumming style.

**Broken Double Bass Beats**
Module 10 features Sean Lang teaching broken double bass beats. These patterns are powerful for creating tight grooves with some added double bass flair. Sean teaches eleven beginner, intermediate, and advanced examples in a progressive way. You can start by learning these example patterns. Then, when you feel comfortable with the concepts, you can start creating your own original patterns to spice things up and boost your creativity on the drum set.

**Double Bass Exercises**
Module 11 covers some really fun double bass exercises that you can implement into your drumming immediately. Dave Atkinson walks you through beginner double bass beats and fills, intermediate double bass beats and fills, as well as advanced double bass beats and fills. If you have been working through the modules, then this is a great place to put some of those new techniques to work, and really start having some fun applying everything you have learned.

**Metal & Blast Beats**
Module 12 features Sean Lang teaching metal and blast beats. Even if you're not into metal drumming, these lessons will still teach you some very important speed and coordination concepts that every drummer should learn. Sean Lang walks you through: skank blasts, hammer blasts, bomb blasts, gravity blasts, traditional blasts, one foot vs. two feet, a hybrid hammer blast, developing speed with one foot, and creating groove within blasts.

**Rudiments With The Feet**
Playing rudiments with the feet is a massively under-rated concept of bass drumming. A lot of drummers assume that rudiments are only for the hands, but this module opens up new possibilities by utilizing the rudiments with your feet. Jared Falk takes you through playing 5, 6, 7, 9, and 11 stroke rolls - as well as playing swiss army triplets all with your feet. With this module you can create thousands of new drum beats and fills, all by using the rudiments with your feet.

**Hand To Feet Combinations**
This module is one of the coolest modules within the Bass Drum Secrets 2.0 pack. Here, Jared, Dave and Sean all give their take on unique hand to feet combinations. By the end of this module you will be able to create your own hand to feet combinations for use within beats, fills, and creative drum solos! This module will open new doors for your drumming and really start to expand your creativity when you sit down at the drums.

**Drum Play-Alongs**
Okay, you made it! We are at the first play-along module of the Bass Drum Secrets 2.0. Here you get to put all of your new found bass drum techniques, beats, fills, concepts, ideas, and creativity to use. This module features Dave Atkinson's band 'Yuca' as well as a ton of cool jam tracks that you can download and take back to your drum kit. So, have some fun and remember to mix things up with the new techniques you have been developing!

**Drum Play-Alongs**
Sean Lang and his band 'First Reign' are featured in the second play-along module of Bass Drum Secrets 2.0. Sean plays along to a couple songs from First Reign's album, then plays along to some really cool jam tracks all of which you can download and take back to your kit. The musical styles include: fast rock, half time rock, metal, shuffle rock, punk, and straight rock. As with all the play-alongs, the video footage includes educational view and a dedicated foot-cam view.

**Drum Play-Alongs**
In this third play-along module, Jared Falk plays to some cool jam tracks, including: half time rock, fast rock, metal, straight rock, and drum and bass. You can start by watching the educational view to get an overall feel of the track, and then skip to the foot-cam view to see exactly what techniques are being used. Then, take the drum-less audio tracks to your kit to start jamming along with them. You can use his beats and fills, or come up with your own!

**Slow Motion**
Module 18 features all of the slow motion footage from Bass Drum Secrets 2.0 compiled for easy viewing. The module includes slow motion footage for the slide technique, double pedal slide technique, swivel technique, heel-toe technique, double stroke hertas, feathering the bass drum, swiss army triplets, one handed roll, break beat, gravity blast, double pedal single strokes and much more. This footage shows you exactly how each of these techniques are played!

**Pedal Reviews**
Here you can watch video reviews of nine popular bass drum pedals. If you are aren't sure what pedal would best suit your playing style, watch this module to learn more. Finding the right pedal can dramatically improve your bass drumming ability. Pedals included are: Gibraltar Intruder Direct Drive, Axis Longboard, Tama Speed Cobra, Tama Iron Cobra, Gibraltar 3311, Pearl Eliminator, Yamaha Flying Dragons, Pearl P900, and Stomp Direct Drive Retrofit.

**Bonuses**
In this 'bonuses' module, we have included some fun and creative behind-the-scenes footage! Some of the content includes: all three instructors playing in unison, plenty of drum solo footage, how to play the flat-foot technique, how to use triggers and what they are, gear talk, interviews of all the instructors, behind the scenes footage from the making of BDS 2.0, and much more. Nothing got held back - this section includes everything that didn't naturally fit somewhere else.

**The Workbook**
Bass Drum Secrets 2.0 does not require that you know how to read sheet music. However, there are a few lesson topics where it is beneficial to be able to see exactly what is being played. When that is the case, we've included sheet music that you can view on your computer, transfer to an iPad, or print off for use at your drum set. You can also download the entire book at once by visiting the resources section of the website. With one click you can have the entire book downloaded and ready to go.

**The Members Area**
In addition to all videos, and 15 songs, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, and connect with other students in the Cobus Method community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Cobus Method members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Cobus Method",
                "slug" => "cobus-method",
                "sku" => "TCM-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Cobus Method by Cobus Potgieter will show you how to play the drums completely by ear - with step by step video drum lessons for drummers of all levels.",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "The Cobus Method",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "The Cobus Method is based entirely around playing the drums by ear. This natural approach completely avoids sheet music and complex theory - focusing instead on playing the drums along with real music!",
                    "You’ll get 15 step-by-step training modules and 15 unique play-along songs so you can apply what you’ve learned to real music!"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "18+ hours of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "15 play-along songs"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => false,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/cobus-method-black.png",
                "video" => "//player.vimeo.com/video/85768626",
                "instructor_name" => "Cobus Potgieter",
                "instructor_desc" => "Cobus Potgieter is a self-taught phenom who has taken the drumming world by storm with his passionate approach and unique style - all without a single professional drum lesson.

He has amazingly learned how to play hundreds of songs without reading a single note of sheet music, and built an online following of more than 600,000 YouTube subscribers with hundreds of millions of video views. And after filming The Cobus Method, he has since started his own band titled “Ventura Lights” and toured with the English pop-rock band “Busted”.

In the Cobus Method training system, Cobus explores the boundaries of learning how to play the drums 100% by ear. He takes you through all of his strategies, including: how to learn to play songs by ear, how to make your own songs, and how to write new and unique drum parts while working with professional studio musicians.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/cobus-potgieter.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Say Goodbye To Sheet Music",
                        "desc" => "Not all drummers want to learn sheet music and theory. The Cobus Method will teach you how to play the drums entirely by ear!"
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Exclusive Play-Along Songs",
                        "desc" => "The Cobus Method is loaded with 15 awesome play-along songs for you to practice with - plus you'll learn how to play-along to any song!"
                    ],
                ],
                "overview" => "**No Sheet Music**
The Cobus Method is based entirely around playing the drums by ear. This natural approach completely avoids sheet music and complex theory - focusing instead on playing the drums along with real music!

**Step-By-Step Training**
Absolutely anybody can learn to play drums with this step-by-step approach. Cobus provides a simple framework for rapid development of your musical abilities through progressive lessons.

**Beat Shizzle System™**
Do you want to create unique and memorable drum beats? Cobus explains his simple approach to building original drum parts that you can use to create your own patterns entirely from scratch.

**Fill Shizzle System™**
Wish you could create fresh and original drum fills to use within real music? Cobus demystifies his approach to creating memorable drum fills, so you too can impress audiences with your creativity.

**Play-Along Song Assist™**
It can be tricky to understand the structure of full songs when first learning how to play the drums. The Cobus Method includes visual hints to make this process much easier when getting started!

**Epic Ear Training™**
Training your ears is a critical part of learning to play music. Cobus explains how to develop the ability to hear what other drummers are playing, and how to create your own drum parts by ear.

**Unlimited Play-Alongs**
The Cobus Method includes fifteen play-along songs for you to practice with. More importantly, it will help you develop the ability to turn your entire music collection into a massive play-along library!

**How To Practice Drums**
Drummers at all skill levels often struggle with getting value out of their practices. Cobus shares his personal advice on how to rapidly boost your musical abilities with three fun drum exercises.

**Writing With A Band**
One of the most exciting aspects of playing drums is creating original songs. With that in mind, Cobus sat down with a band to create five original songs from scratch, so you can watch the entire process!

**Organic Technique**
It is critical to play the drums with good technique to reduce the chance of injury. Cobus takes an organic approach to developing hand technique that delivers power through a relaxed grip.

**Developing Hand Speed**
Are you interested in developing speed around the drum set? Cobus explains his custom exercise for building speed, power, and control - while pointing out critical mistakes to avoid when getting started.

**Showmanship Techniques**
Do you enjoy adding a little visual flair to challenge yourself when drumming? Cobus demonstrates his favorite stick tricks, and explains his approach to using them within various drumming situations.

**Cobus Dictionary**
Cobus makes use of some “custom” english words throughout this training system, so the video team included a fun on-screen feature to help explain his unique terms like “ridonculously” and “defo”.

**Bonus Content**
The final section of the Cobus Method includes: gear overviews, drum solos, behind the scenes footage, funny outtakes, and a one-hour live drum lesson with Cobus - filmed in February 2011.

**The Members Area**
In addition to all videos, and 15 songs, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, and connect with other students in the Cobus Method community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Cobus Method members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drum Fill System",
                "slug" => "drum-fill-system",
                "sku" => "DFS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Drum Fill System will help you learn how to play more creative, dynamic drum fills so you can spice up your drumming and add some extra flare to any song!",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "Unlock your natural ability to play creative drum fills",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Lionel's 10 ways to personalize any drum fill",
                    "How to match beats and fills in any musical style",
                    "Detailed advice for setting up shots, building solos, improving independence, incorporating hand-to-feet combinations, playing powerful song-enders, and more",
                    "23 Play-alongs with the drum tracks removed, so you can practice drum fills within realistic playing situations",
                    "Examples from rock, heavy metal, funk, bossa nova, jazz, reggae, shuffles, country, and more"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "11 hour of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "23 play-along songs"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "361 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drum-fill-system-black.png",
                "video" => "//player.vimeo.com/video/85571279",
                "instructor_name" => "Lionel Duperron",
                "instructor_desc" => "Lionel Duperron is a focused musician and an extremely affable and knowledgeable teacher with over 25 years of professional experience, Lionel Duperron is as passionate about teaching as he’s dedicated. Proficient with every genre of drumming, he achieved worldwide acclaim with his fresh approach to teaching rudiments musically on FreeDrumLessons.com and DrumLessons.com, as well as with two popular instructional programs: the “Drum Fill System” and the “Drum Rudiment System”.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/lionel-duperron.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Unlock Your Creativity",
                        "desc" => "Get step-by-step lessons for developing new fills, expanding upon existing patterns, and applying your skills to real music."
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Fills For Any Style of Music",
                        "desc" => "Enjoy 23 play-along songs with examples from rock, heavy metal, funk, bossa nova, jazz, reggae, shuffles, country, and more."
                    ],
                ],
                "overview" => "**Beginner Part 1**
The first module includes: Lionel Duperron's introduction to the Drum Fill System, an overview of drum fill basics, a review of proper drum technique, details on how to practice, and drum theory essential to playing great drum fills. This material is sure to get you excited and well prepared for the lessons to come. It is highly recommended that you start here before moving on to any of the other modules.

**Beginner Part 2**
Picking up where the last section left off, Lionel walks you through simple beat-fill-beat exercises, covers playing fills in a musical context, reviews beginner drum soloing ideas, and discusses how to 'make the fill fit the beat'. Many of the concepts covered on this module will change the way you think about both creating and playing fills. You will likely have a few 'aha moments' where essential concepts begin to fall into place!

**Trillion Fill Formula**
In this module, Lionel explains his revolutionary Trillion Fill Formula. You'll discover ten simple techniques that you can use to instantly personalize any drum fill. In fact, using these powerful methods - you can literally create trillions of unique drum fill combinations. Lionel breaks everything down in step-by-step detail. Use this formula in combination with the comprehensive Drum Fill Encyclopedia to instantly create your own unique patterns.

**Intermediate Part 1**
The fourth module focuses on genre-specific applications. Lionel demonstrates fills for rock, heavy metal, funk, bossa nova, jazz, shuffles, reggae, country, and double bass. The examples are taken out of the Drum Fill System PDF Workbook, so you can follow along. Start by mastering these patterns and then apply the trillion fill formula to create your own unique musical variations. You'll quickly create a library of fills for any musical style.

**Intermediate Part 2**
Taking things even further, module five covers some important related concepts. You'll learn how to use fills to setup shots, intermediate soloing concepts, using more dynamics within your fills, powerful hand-to-feet combinations, musical filling concepts, and more! These topics really take the idea of playing fills to the next level, and Lionel does an excellent job of breaking everything down into step-by-step lessons.

**Advanced**
Here you will learn advanced fill concepts. Lionel covers playing drum fills in odd meters (3/4 time, 5/4 time, 6/8 time, 7/8 time, 9/8 time, and common time to odd-time), beat inflection fills (hi-hat embellishments, ghost notes, beat displacement, tom embellishments, double pedal embellishments, single pedal embellishments, and ride embellishments), and powerful drum fill permutations for both eighth note triplets and sixteenth notes.

**Additional Drum Fills & Exercises**
The seventh module includes something for everyone. The lessons cover buttons (also known as 'song enders'), flashy fill techniques, crossover patterns, how to make the most out of the Encyclopedia of Drum Fills, and ways to practice note values. Afterwards, Lionel wraps things up with some fun drum solos and a quick overview of the drum gear that he used while filming the entire Drum Fill System.

**Drum Play Alongs 1**
Want to apply what you've learned? Watch the videos in this moduleto see Lionel demonstrate all of the play-along loops in their entirety. The selections include: Blues, Ballad Rock, Shuffle, Full Rock, Funk Rock, Half Time Shuffle, and Swing. You can watch them in the split-screen 'educational view' or the fun 'performance view''. Afterwards you can play your own unique drum fills with the included audio MP3s.

**Drum Play Alongs 2**
Here you will find full band play-along songs. The selections include: Blues, Fast Rock, Slow Rock, Country, Metal, Reggae, Funk, Amazing Grace, and Punk. Each track is performed live by the entire band, so you can see exactly how the various members feed off of each other. Start by watching Lionel's performance and then take these play-along songs to your drum set to practice your creativity over live band tracks!

**The Workbook**
Everything covered in the Drum Fill System is also included in printed format. Anything not covered in the Encyclopedia of Drum Fills is included in this second workbook. The various sections refer directly to the training videos, so you know exactly where to find the relevant lessons. Likewise, the training videos refer back to any relevant material in the workbooks. You're covered no matter where you start!

**The Members Area**
In addition to all 9 modules, 23 songs, and 2 workbooks, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Drum Fill System community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Drum Fill System members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drum Play-Along System",
                "slug" => "drum-play-along-system",
                "sku" => "DPAS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Drum Play-Along System includes 50 play-along songs, so you can jam-along to rock, jazz, latin, pop rock, folk rock, and hard rock songs!",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "50 play-along songs to boost your creativity on the drums",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Watch each song performed by a professional drummer",
                    "Audio versions with the original drum tracks removed",
                    "Includes 50 songs from musical styles including: hard rock, pop rock, folk rock, alternative rock, jazz, Latin, and blues"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "6 hours of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "50 play-along songs"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "98 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "Skill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drum-play-along-system-black.png",
                "video" => "//player.vimeo.com/video/85769524",
                "instructor_name" => "",
                "instructor_desc" => "",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Drum%20Play-Along%20System/spread.png",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Boost Creativity & Confidence",
                        "desc" => "Improve your creativity, groove, and musical abilities by jamming along to real music!"
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Exclusive Play-Along Songs",
                        "desc" => "You'll get 50 fun play-along songs including hard rock, pop rock, folk rock, alternative rock, jazz, Latin, and blues."
                    ],
                ],
                "overview" => "**Hard Rock & Alternative Rock**
The first component of the Drum Play-Along System includes fifteen unique songs from rock sub-genres, such as: hard rock, alternative rock, progressive rock, punk rock, pop rock, and soft rock! The video footage includes both multi-angle and performance versions of all fifteen songs. The multi-angle view allows you to watch four angles at the same time, so you can study exactly how the drummer is playing the song (as you follow along with the workbook). The performance view allows you to take in the entire experience with alternating shots filling the entire screen.

**Pop Rock & Folk Rock**
The second component of the Drum Play-Along System includes sixteen more songs from rock sub-genres, such as: pop rock, alternative rock, folk rock, blues, and soft rock! As with the first component, the video footage includes both multi-angle and performance versions of all sixteen songs. You can start with the multi-angle view to learn the songs, or jump to the performance view for inspiration from the original drummer!

**Latin & Jazz**
The third component of the Drum Play-Along System moves away from rock to cover nineteen songs from unique world styles, including: jazz swing, Latin, ballads, blues, samba, salsa, jazz shuffle, bebop, naningo, and much more! As with the first components, the video footage includes both multi-angle and performance versions of all nineteen songs. You can start with the multi-angle view to learn the songs, or jump to the performance view for inspiration from the original drummer!

**Play-Along Songs w/o Drums**
The Drum Play-Along System audio library includes all fifty songs with the drum tracks removed, so you can play as the drummer. The physical version comes on audio CDs and the online members area features downloadable versions that are compatible with any portable music player that supports the MP3 audio format. This includes iPhones, iPads, iPods, Android phones, and more.

These play-along songs allow you to have a full band practice any time you want, and really allow you to unleash your creativity as a drummer!

**The Workbook**
The Drum Play-Along System workbook includes detailed sheet music for all 50 play-along songs! This way you can see the exact beats and fills that the original drummers used the play all the various songs featured in the performance videos.

You will also find biographies for each of the bands that performed songs in this pack, so you can get to know the musicians and learn more about their approaches to creating music!

All together, this workbook includes nearly 100 pages of detailed content that you can follow along with as you watch the videos or listen to the audio CDs.

**The Members Area**
In addition to all 6 hours, 50 songs, and workbook, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Drum Play-Along System community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Drum Play-Along System members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drum Rudiment System",
                "slug" => "drum-rudiment-system",
                "sku" => "DRUDSYS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "Learn how to play all 40 drum rudiments with these simple video drum lessons by renowned instructor Lionel Duperron.",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "Boost your drumming by mastering the 40 rudiments",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "All 40 drum rudiments covered in step-by-step detail",
                    "Practice pad and kit applications shown in slow-motion",
                    "Includes multi-angle video and on-screen sheet music",
                    "Beginner, intermediate, and advanced applications"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "13 hours of video lessons"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "231 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "SKill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drum-rudiment-system-black.png",
                "video" => "//player.vimeo.com/video/85564678",
                "instructor_name" => "Lionel Duperron",
                "instructor_desc" => "Lionel Duperron is a focused musician and an extremely affable and knowledgeable teacher with over 25 years of professional experience, Lionel Duperron is as passionate about teaching as he’s dedicated. Proficient with every genre of drumming, he achieved worldwide acclaim with his fresh approach to teaching rudiments musically on FreeDrumLessons.com and DrumLessons.com, as well as with two popular instructional programs: the “Drum Fill System” and the “Drum Rudiment System”.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/lionel-duperron.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Unlock Your Full Potential",
                        "desc" => "More than 13 hours of detailed step-by-step training to help you learn and apply all 40 drum rudiments."
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Expand Your Beats & Fills",
                        "desc" => "Discover how to use hybrid rudiments to come up with thousands of unique beats and fills."
                    ],
                ],
                "overview" => "**The Beginner Module**
This section is designed to introduce you to the Drum Rudiment System, improve your hand technique, and introduce you to all forty drum rudiments. Lionel starts out by giving you special practice tips and tricks that will enable you to move through the contents of the training modules with greater ease. Then, he gives detailed information about stick grips to be sure you are playing with the best technique. Finally, he goes through the basics of all 40 rudiments.

Each individual drum rudiment is first demonstrated on the practice pad. This is where Lionel explains each pattern in great detail, so you can understand exactly how to play the rudiments like they were meant to be played. Next, you get the opportunity to see the pattern played from three separate camera angles in slow motion. This helps you memorize the sound of the pattern, so it comes more naturally for you in practice. Finally, Lionel takes each rudiment to the drum set to demonstrate it on the snare drum, within two beginner drum beats, and within two beginner drum fills. All of these examples are demonstrated with four camera angles, sheet music on-screen, and at regular and slow-motion speeds.

As a special bonus, Lionel has also included some excellent drum warm-ups, practice tips, and footage of some of his creative snare-drum solos at the end of the beginner module. In total, this section includes 5 hours of video content and 45+ pages of detailed training material in the spiral-bound workbook.

**The Intermediate Module**
The intermediate section is designed to take everything a step further. It is jam packed with more tips and tricks, and all-new new applications!

You'll learn about 'the motions' and how they are to be incorporated into the rudiments to improve your overall speed and control. You'll also get some more information about stick grips, and some unique exercises to improve your accents and flam strokes. This invaluable information is what sets Lionel apart from other drummers, and he freely passes on all of his secrets in these revealing lessons.

When you are ready to learn more beats and fills, you can jump to the intermediate applications. Lionel revisits all 40 drum rudiments, giving you two new intermediate drum beats, and two new intermediate drum fills based on each rudiment. These patterns include the same special playback features as the applications in the beginner section. This means, all examples are shown from four separate camera angles, with sheet music on-screen, and playback at regular and slow-motion speeds. As the patterns become more complex, this unique training system becomes more and more valuable.

The modules include some bonus content including a special look at the 'towel technique', and another creative snare-drum solo from Lionel Duperron. In total, the intermediate section includes over 4 and a half hours of video content and 65+ pages of training material in the spiral-bound workbook.

**The Advanced Module**
The advanced section really takes the drum rudiments to a whole new level. This material is designed for motivated drummers that really want to push the envelope, and take their drumming to the extreme limits of what can be played.

Lionel starts by reviewing stick grip and finger techniques with some fresh insights into how you can continue to improve upon these important fundamentals. As with the tips in the intermediate section, this material is extremely valuable. Lionel has done a superb job of compiling valuable insights to deliver such a comprehensive training package.

As with the previous sections, the advanced pack also includes all-new applications based around the rudiments. You will find two advanced drum beats, and two advanced drum fills for each and every drum rudiment. Some of these are extremely challenging, and are sure to push your drumming to the limits. As expected, these video lessons also make use of the unique multi-angle training system that makes learning easy.

The training videos also feature additional bonus material including some special exercises, drum set solos, drum set & cymbal advice, an overview of drumsticks and practice pads, and a special in-studio interview with Lionel. All together, the advanced section includes over 4 hours of video content and 65+ pages of training material in the workbook.

**The Workbook**
The new Drum Rudiment System Expansion Pack is also included. It covers many related topics that compliment the material included in the Drum Rudiment System.

Modified Hybrid Rudiments - Over 120 modified hybrid rudiments that will expand your library of beats and fills even further! This rudiment pack will show you a variety of rudiments that build on top of the original 40. Lionel also talks about mixing the hybrid rudiments with the standard 40 to come up with thousands of unique patterns.

21 Steps To Becoming A Working Drummer - Stop playing drums as just a hobby, and start drumming for a living! With this downloadable workbook, you will get 21 tips on how to become a working drummer.

Encyclopedia Of Drum Terms - A detailed encyclopedia of terms strictly related to drumming, percussion, and rhythm. It's a valuable resource for any drummer.

**The Members Area**
In addition to all 13 hours of video, and the workbooks, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Drum Rudiment System community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Drum Rudiment System members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Drum Tuning System",
                "slug" => "drum-tuning-system",
                "sku" => "DTUNESYS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Drum Tuning System gives you tips for cleaning, tuning, and maintaining your drums so you can get the most value out of your kit!",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Tips for tuning snare drums, bass drums, and toms.",
                    "Special adjustments for rock, jazz, and Latin gigs.",
                    "Advice for drum set maintenance, muffling, and more.",
                    "Tips and tricks for recording drums in a studio."
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "	4 hours of video lessons"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "SKill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drum-tuning-system-black.png",
                "video" => "//player.vimeo.com/video/85769526",
                "instructor_name" => "Mike Michalkow",
                "instructor_desc" => "Mike Michalkow has been teaching drums and percussion for more than 20 years, having studied under master drummers Dom Famularo, Jim Chapin, Chuck Silverman, Thomas Lang, John “JR” Robinson, Peter Magadini, and Virgil Donati.

He has a wealth of experience to draw from having played in various original and cover bands, working on a popular cruise line as the orchestra drummer, and recording with songwriters and bands with styles ranging from prog-rock, latin, jazz, blues, pop, folk, celtic, country, metal, and R&B.

Mike’s comprehensive teaching methods have helped thousands of drummers around the world reach their goals, through his best-selling training packs including The Drumming System, Jazz Drumming System, Latin Drumming System, Moeller Method Secrets, and Total Rock Drummer.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-michalkow.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Detailed Video Lessons",
                        "desc" => "The Drum Tuning System gives you tips for cleaning, tuning, and maintaining your drums so you can get the most value out of your kit!"
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Make Your Drums Sound Better",
                        "desc" => "The better your drums sound, the better you will sound when you play them! You'll learn how to tune your drums for any situation."
                    ],
                ],
                "overview" => "**Module 1**

**Drum Set Maintenance** - This section includes information about polishing your drums, cleaning your cymbals (with advanced tips on how to deal with different types), and keeping your single and double bass drum pedals in perfect working condition!

**Changing Your Drumheads** - Here you will learn how to change drumheads for each type of drum individually. Mike covers the snare drum, bass drum, and tom-toms each individually - with special drum-specific tips to be sure you get the best results from each drum!

**Snare Drum Tuning** - Mike explains exactly how to tune this important drum to be sure you get a perfect crack each and every time. He covers the top and bottom drum heads, the snare wires, and the snare throw-off. You'll learn how to adjust each of these components to get the best results!

**Bass Drum Tuning** - This section includes specialized information about bass drum tuning. Mike explains several advanced concepts to ensure you get great tone from this booming drum. He explains a variety of adjustments that will allow you to change the sound of this drum to suit your needs.

**Tom-Tom Tuning** - Mike wraps up the basic tuning section with specialized tips about tom-tom tuning to ensure you get great tone from all the toms in your set. It doesn't matter if you have two, three, four, or even 5+ toms in your drum set. This section will show you exactly how to make them sound great all together!

**Module 2**

**Tuning for Rock Music** - This section includes important tips and tricks on how to tune your drums for various rock drumming situations.

**Tuning for Latin Music** - Here Mike explains the adjustments needed for playing along with a variety of Latin music styles.

**Tuning for Jazz Music** - Mike shows exactly how to get a kit ready for swinging along with some fun Jazz tunes.

**Studio Drumming Tips** - This lesson includes advanced tips for drummers that are interested in studio drumming. Mike walks you through essential information you will need to know long before you go into any recording gig!

**Drum Tuning Troubleshooting** - Important tips for dealing with unique tuning situations. Mike explains how to troubleshoot odd situations to come up with quick solutions!

**Drum Muffling Techniques** - Mike explains a wide variety of drum muffling options that you can use to tweak the sound of your drums. Always remember, muffling is never a solution to poor tuning, but is a way to enhance great tuning!

**The Members Area**
In addition to all the content, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Drum Tuning System community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Drum Tuning System members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Jazz Drumming System",
                "slug" => "jazz-drumming-system",
                "sku" => "JDS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Jazz Drumming System is a complete and comprehensive solution for drummers interested in learning to play jazz music - with over seven hours of step-by-step video training by Mike Michalkow.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Jazz%20Drumming%20System/thumbnail.jpg",
                "short_desc" => "",
                "header_text" => "The ultimate guide for playing jazz music on the drums",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Split screen video makes learning simple",
                    "Progressive step-by-step video drum lessons",
                    "Seven powerful exercises that combine all strokes and motions.",
                    "Apply what you've learned with fun play-alongs"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "5 hours of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "10 play-along songs"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "77 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "SKill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/jazz-drumming-system-black.png",
                "video" => "//player.vimeo.com/video/88395554",
                "instructor_name" => "Mike Michalkow",
                "instructor_desc" => "Mike Michalkow has been teaching drums and percussion for more than 20 years, having studied under master drummers Dom Famularo, Jim Chapin, Chuck Silverman, Thomas Lang, John “JR” Robinson, Peter Magadini, and Virgil Donati.

He has a wealth of experience to draw from having played in various original and cover bands, working on a popular cruise line as the orchestra drummer, and recording with songwriters and bands with styles ranging from prog-rock, latin, jazz, blues, pop, folk, celtic, country, metal, and R&B.

Mike’s comprehensive teaching methods have helped thousands of drummers around the world reach their goals, through his best-selling training packs including The Drumming System, Jazz Drumming System, Latin Drumming System, Moeller Method Secrets, and Total Rock Drummer.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-michalkow.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Learn How To Play Jazz",
                        "desc" => "Get 5 hours of detailed lessons for learning jazz drum fills, jazz drum beats, different styles of jazz drumming, grooves, shuffles, and more!"
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "10 Fun Play-Along Songs",
                        "desc" => "The Jazz Drumming System comes with 10 jazz drumming play-along tracks and a complete video guide to playing jazz drum solos!"
                    ],
                ],
                "overview" => "**Getting Started**

The first Jazz Drumming System training module features a complete overview of the drum legend/key for drum notation, a guide to drum gear selection for jazz drumming, how to tune your drums to play jazz music, a traditional and match grip overview, how to count triplet note values, tips for counting in a swing tune, a bass drum technique overview, a hi-hat technique overview, a guide to developing jazz groove, an overview of the key differences between playing with a big band vs playing with a combo band, an introduction to the shuffle groove, and introduction to drum set comping, hundreds of jazz exercises and much more!

**Jazz Exercises**

You can go a long way with exercises and fills, but to really learn and feel the music there is no better way then to get in the drummers seat with the band and start to play. That's why the Jazz Drumming System includes 10 fun jazz drumming play-along tracks and a complete video guide to playing jazz drum solos.

We have also included audio MP3s with the drum tracks removed so you can join the band and play the songs yourself. They work with any portable MP3 player.

**Jazz Drum Play-Alongs**

The second module is where you can apply all you have learned and really start to hone your jazz drumming skills with videos covering jazz fills, applying rudiments within jazz drumming, hundreds of jazz drumming exercises, how to correctly use brushes within jazz drumming, brush technique, jazz drum solos, many different time signature lessons and much more!

All of the building blocks to mastering this amazing style of drumming are here for you to take advantage of. You will be amazed at how fast you can begin to apply these powerful concepts into your everyday drumming!

**The Workbook**

To ensure you get the most out of the Jazz Drumming System we have also included a downloadable PDF workbook with over 70 pages of training material that works in companion with the training videos to teach you all the various Jazz drum beats, fills, and patterns to develop this fun an exciting style of music.

Within the workbook you will find all the relevant sheet music, and several informative drum articles to assist in the learning process. You can download it and use it directly on your computer, or print off specific lessons to take to your drum set.

**The Members Area**

In addition to the 3 modules, 10 songs, and the workbook, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Jazz Drumming System community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Jazz Drumming System members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Latin Drumming System",
                "slug" => "latin-drumming-system",
                "sku" => "LDS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Latin Drumming System is a complete and comprehensive solution for drummers interested in learning to play latin music - with over five hours of step-by-step video training by Mike Michalkow.",
                "meta_img" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Latin%20Drumming%20System/thumbnail.jpg",
                "short_desc" => "",
                "header_text" => "The ultimate guide for playing latin music on the drums",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Split screen video makes learning simple",
                    "Progressive step-by-step video drum lessons",
                    "Apply what you've learned with fun play-alongs"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "5 hours of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "12 play-along songs"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "54 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "SKill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/latin-drumming-system-black.png",
                "video" => "//player.vimeo.com/video/81924030",
                "instructor_name" => "Mike Michalkow",
                "instructor_desc" => "Mike Michalkow has been teaching drums and percussion for more than 20 years, having studied under master drummers Dom Famularo, Jim Chapin, Chuck Silverman, Thomas Lang, John “JR” Robinson, Peter Magadini, and Virgil Donati.

He has a wealth of experience to draw from having played in various original and cover bands, working on a popular cruise line as the orchestra drummer, and recording with songwriters and bands with styles ranging from prog-rock, latin, jazz, blues, pop, folk, celtic, country, metal, and R&B.

Mike’s comprehensive teaching methods have helped thousands of drummers around the world reach their goals, through his best-selling training packs including The Drumming System, Jazz Drumming System, Latin Drumming System, Moeller Method Secrets, and Total Rock Drummer.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-michalkow.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Learn How To Play Latin",
                        "desc" => "Get 5+ hours of detailed lessons for learning Latin drum fills, beats, grooves, shuffles, bass drum techniques, hi-hat techniques, and more!"
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "12 Fun Play-Along Songs",
                        "desc" => "The Latin Drumming System comes with 12 latin drumming play-along tracks and a complete video guide to playing Latin drum solos!"
                    ],
                ],
                "overview" => "**Module 1**

The first Latin Drumming System training module includes a look at matched and traditional grip, information about drum tuning and drum head selection, an indepth look at dynamic drumming techniques, an overview of all the sounds that make up Mikes kit, a look at various bass drum techniques, a hi-hat technique overview, various style explanations, numerous Latin drum patterns, Latin drum fill and beat examples, a review of the quarter note-pulse and the eighth note subdivisions, an overview of the Son Clave, Rumba Clave, and 6/8 Afro Cuban Clave and more!

**Module 2**

The second module in the Latin Drumming System features twelve samba 16th note beats, eleven baiao drum beats, twenty-one sixteenth note fills, nin cha-cha drum beats, an overview of sixteenth note triplets, sixteen bolero beats, a complete guide to developing a tumbao pattern, ninteen tumbao beats, six mambo drum grooves, five merengue beats, six songo two-bar beats, eleven demos of sixteenth note groupings, applying drum rudiments to Latin drumming, valuable tips for 'Playing Along with a Percussionist', tips for 'Developing Left Foot Clave', and much more!

**Latin Drum Play-Alongs**

You can go a long way with exercises and fills, but to really learn and feel the music there is no better way then to get in the drummers seat with the band and start to play. That's why the Latin Drumming System includes 12 fun Latin drumming play-along tracks, and a complete video guide to playing Latin drum solos.

We have also included audio MP3s with the drum tracks removed so you can join the band and play the songs yourself. They work with any portable MP3 player.

**The Workbook**

The Latin Drumming System also includes a downloadable PDF workbook featuring over 50 pages of detailed training material. This is designed to be a companion tool that you can reference while watching the step-by-step training videos.

Within the workbook you will find all the relevant sheet music, and several informative drum articles to assist in the learning process. You can download it and use it directly on your computer, or print off specific lessons to take to your drum set.

**The Members Area**

In addition to the 3 modules, 12 songs, and the workbook, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Latin Drumming System community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Latin Drumming System members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Maximum Meytal",
                "slug" => "maximum-meytal",
                "sku" => "MM-DIGI",
                "thumbnail" => "",
                "meta_desc" => "Meytal Cohen's Maximum Meytal video training pack will help anyone learn how to play rock music on the drums, with step-by-step lessons for all levels.",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "Build your foundation & improve your creativity on the drums",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "5 step-by-step training modules, 5 play-alongs, and 1 PDF workbook",
                    "The Rock Drummer's Foundation, The Rock Drumming Techniques, The Rock Drummers Beat Library, The Rock Drummers Fill Library, and The Rock Drumming Play-Alongs",
                    "Four-way split screen video ensures you see everything",
                    "On-screen sheet music with a blue bar marking progress",
                    "Drum-less play-along songs with and without a metronome"
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "4 hours of video lessons"
                    ],
                    [
                        "title" => "Audio",
                        "desc" => "5 play-along songs"
                    ],
                    [
                        "title" => "Books",
                        "desc" => "98 page workbook"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "SKill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/maximum-meytal-black.png",
                "video" => "//player.vimeo.com/video/85364289",
                "instructor_name" => "Meytal Cohen",
                "instructor_desc" => "Meytal Cohen was born in Israel. She is the youngest of seven children with four sisters and two brothers. Her father passed away when she was in the second grade, so her mom raised all seven children. They would eventually become doctors and lawyers - except for Meytal.

At 18 years old she started playing drums shortly before being drafted into the Israeli Defence Force. She served the mandatory two years. In reflection, she says 'I met some of the best friends I'll ever have, but as a whole I'm looking forward to world peace and to love all living things'.

Meytal moved to LA to pursue a career in music at the age of 21. She attended the LA Music Academy and began to study drumming. Unfortunately, while attending school, she broke her back in a car accident. She had to wear a back brace for six months and returned to Israel during the healing process. But, she returned within a year and graduated.

She spent the next few years taking on small gigs while focusing on practicing along to her favorite music in her spare time. Nothing came easy. She was just trying to make a living.

Her big break came when she teamed up with two friends to film an electric violin version of Toxicity by System Of A Down. It was to be an audition tape for America's Got Talent, but it ended up having far greater success on YouTube. As a result, Meytal continued to upload videos. Today she has over 430,000 subscribers and well over 75,000,000 video views on YouTube. In addition, she has nearly half a million fans following her on Facebook.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/meytal-cohen.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Establish A Solid Foundation",
                        "desc" => "Get step-by-step lessons from Meytal Cohen to establish your foundation, master essential techniques, and improve your creativity."
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Exclusive Play-Along Songs",
                        "desc" => "Apply everything you learn along to music with the drum tracks removed, so you can be the drummer."
                    ],
                ],
                "overview" => "**The Rock Drummer's Foundation**

This section covers all of the essential information you need to become a solid rock drummer. You'll learn about holding the drumsticks, setting up your drums, using a metronome, the basic note values, reading sheet music, and playing beats and fills.

It is recommended that you start at the beginning, even if you already have some experience on the drums, because it will ensure you have a solid foundation for all of the future lessons.

**The Rock Drummer's Techniques**

Now that you've established a solid foundation it's time to learn fundamental techniques and concepts that are popular within rock drumming. The lesson topics include: ghost notes, double bass, playing accented notes, finger technique, drum rudiments, developing independence, and building speed.

These lessons will unlock entirely new options for you, so that you can be more creative and dynamic when playing the drums.

**The Rock Drummer's Beat Library**

In this section, Meytal demonstrates the beginner, intermediate, and advanced beats that are notated in the companion workbook. These unique patterns were developed by Meytal as she began to establish her own unique drumming style.

It is recommended that you wait until you can play each beat at the demonstrated tempos before moving on to more complex patterns.

**The Rock Drummer's Fill Library**

In this section Meytal demonstrates her favorite beginner, intermediate, and advanced fills. They are also notated out in the companion workbook, Each pattern is performed starting with a beat, transitioning into the fill, and then returning back to the beat - as you would use them in a song.

As with the beats, it's recommended that you wait until you can play each individual pattern at the demonstrated tempos before moving on.

**The Rock Drumming Play-Alongs**

Once you have established a solid foundation, learned the essential techniques, and mastered some of Meytal's favorite beats and fills - it's time to apply your skills with fun play-along songs.

This section includes five original songs. You can start by watching Meytal demonstrate them on video and then use the drum-less audio tracks to jam along to them on your own!

**The Workbook**

The Maximum Meytal experience also includes a companion workbook that you can use to follow along with the video and audio content. Everything is organized based on the module sections, so you can easily find the beats, fills, and interactive worksheets that are referenced in the training videos.

**The Members Area**

In addition to all 5 modules, 5 songs, and the workbook, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Maximum Meytal community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Maximum Meytal members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 1,
                "product_type_id" => 1,
                "name" => "Moeller Method Secrets",
                "slug" => "moeller-method-secrets",
                "sku" => "MOELLERMS-DIGI",
                "thumbnail" => "",
                "meta_desc" => "The Moeller Method Secrets video lessons will teach you the moeller technique to help you improve your hand speed, power, and control on the drums.",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "The proven method to improve your hand speed, power, & control",
                "price" => 0,
                "discounted_price" => "",
                "features" => [
                    "Comprehensive training on traditional grip, matched grip, and all the key variations (German, American, and French grips).",
                    "Covers finger control technique, the motions, the tap stroke, the full stroke, the half stroke, the down stroke, and the up stroke.",
                    "Seven powerful exercises that combine all strokes and motions.",
                    "A complete breakdown of the moeller method (low, half, and full).",
                    "Inspirational solos and practical applications for the techniques.",
                    "Three professional jam tracks and five complete band tracks."
                ],
                "specs" => [
                    [
                        "title" => "Video",
                        "desc" => "2.5 hours of video lessons"
                    ],
                    [
                        "title" => "Online",
                        "desc" => "Lifetime access to all content"
                    ],
                    [
                        "title" => "SKill",
                        "desc" => "From beginner to advanced"
                    ],
                ],
                "shop_card_visible" => false,
                "sold_out" => true,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "https://dpwjbsxqtam5n.cloudfront.net/pack-logos/moeller-method-secrets-black.png",
                "video" => "//player.vimeo.com/video/85769523",
                "instructor_name" => "Mike Michalkow",
                "instructor_desc" => "Mike Michalkow has been teaching drums and percussion for more than 20 years, having studied under master drummers Dom Famularo, Jim Chapin, Chuck Silverman, Thomas Lang, John “JR” Robinson, Peter Magadini, and Virgil Donati.

He has a wealth of experience to draw from having played in various original and cover bands, working on a popular cruise line as the orchestra drummer, and recording with songwriters and bands with styles ranging from prog-rock, latin, jazz, blues, pop, folk, celtic, country, metal, and R&B.

Mike’s comprehensive teaching methods have helped thousands of drummers around the world reach their goals, through his best-selling training packs including The Drumming System, Jazz Drumming System, Latin Drumming System, Moeller Method Secrets, and Total Rock Drummer.",
                "instructor_img" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-michalkow.jpg",
                "benefits" => [
                    [
                        "icon" => "fa-list",
                        "heading" => "Improve Your Technique",
                        "desc" => "Having great hand technique will help you improve your speed, power, and control - and help you reduce the risk of injury."
                    ],
                    [
                        "icon" => "fa-music",
                        "heading" => "Become A Musical Drummer",
                        "desc" => "Enjoy practice sessions and inspiring performances that will show you how various hand techniques can be used within musical drumming."
                    ],
                ],
                "overview" => "**Technique Instruction**

- Mike's early experiences with poor technique, and how he was able to overcome them to advance his drumming abilities.
- An introduction to correct stick grip, and an overview of how stick grip can make a big difference in how you play the drums.
- The unique 'gun system' for discovering correct hand position for holding the drumstick. This creative approach is extremely easy to follow along with. Every part of the grip is explained in detail.
- How to find the balance point of your drumsticks to allow them to get the most natural rebound (vital for virtually all techniques associated with speed drumming).
- Tips and suggestions for removing tension from your hands and wrists (which helps reduce the risk of serious injury, and extends drumming endurance).
- A breakdown of matched grip, and how both hands are mirrored for this style of playing (the most commonly used grip today).
- An in-depth look at traditional grip, including close-up shots and detailed explanations of exactly how to play this technique (and an overview of the pros and cons of using it).
- How to perform the German or Germanic grip with the correct hand positioning, and 'relaxed feel' (includes video of the grip being used in a short mini-solo).
- How to perform the American grip, and how it relates to the German grip previously covered. This section includes special multi-angle viewing to show the exact differences of this grip in detail (also includes video of the grip being used in a mini-solo).
- How to perform the French grip, and how it relates to the German and American grips (includes a mini-solo with the grip being used).
- A unique exercise that combines the three grip types (German, American, and French) in one complete stick grip warm-up.
- An in-depth look at the free stroke with detailed explanation of how it makes full use of the natural rebound of the drumstick (includes slow motion video). The lesson also features a special exercise to assist in fully understanding the principles behind the free stroke.
- A detailed break-down of the Finger Control Technique, what grip works best, and exactly how to perform it for maximum speed (includes two excellent exercises for developing the method while you watch TV or relax on the couch). Also covers tips for conserving energy, and improving overall control. This method is an absolute must for speed drumming!
- Applications for using the Finger Control Technique around the drum set (excellent for coming up with unique drum beat and fill ideas).Great for speed drumming and faster solos.
- Mike's blazing fast 'Flurry Fills' based on Finger Control
- An explanation of 'the motions', and how they will benefit you.
- A complete look at the tap stroke motion, and how it can improve your speed, dynamic drumming, and more. This section also includes important practice tips, and simple exercises.
- An in-depth look at the full stroke motion, and tips on what to focus on when first developing it. (Includes examples of common mistakes many drummers make).
- Complete training for the medium full stroke (aka half stroke) with simple examples and exercises.
- A detailed breakdown of the down-stroke, and an explanation of how it ties in with other strokes to create dynamics (including exercises that tie in with the tap stroke).
- Finally, an in-depth look at the up-stroke to round out the section and provide you with a complete set of motions for continuous dynamic drumming. This is one of most important motions, and can be used with the down-stroke in a wide variety of ways (including the moeller method).
- Seven powerful exercises that combine all the strokes/motions inunique accented patterns to assist you in developing each motion correctly (including additional related exercises, and tips to save valuable practice time).
- Ten beats that utilize the motions and demonstrate how they completely change the dynamic feel of a groove. These examples are excellent for drummers interested in applying the motions in their everyday drumming right away.
- Ten unique drum fills with the motions being applied in both simple and complex forms to help you with creative fills.
- An introduction to the Moeller Method (aka Moeller Technique), where it came from, and an overview of Mike's experiences while learning it. This section is incredibly revealing, and breaks through many of the misconceptions drummers have of this method.
- A complete breakdown of the low Moeller. This includes multi-angle shots, slow motion footage, and very detailed explanations.
- A detailed explanation of the half Moeller, some important exercises to ensure it is developed correctly, and warnings about common mistakes seen in drummers first learning this method. Also included are multi-angle shots, and a slow-motion demonstration.
- Finally, the king of the power strokes, the full Moeller! This section includes advanced tips rarely taught, multi-angle shots, and once again - slow motion footage breaking everything down.
- A powerful exercise for incorporating the three Moeller types. This is a great way to begin applying them on your kit right away.
- A full-length drum solo titled 'Solo for Sanford' in which Mike Michalkow pays tribute to Sanford Augustus Moeller.
- Advanced applications based around the single paradiddle, including a breakdown of this important drum rudiment, and how it can be played with the motions and the moeller method for truly amazing speed (an exciting section for speed drumming enthusiasts).
- A full-length drum solo titled 'Paradiddle Madness' which is played entirely with this valuable drum rudiment. An excellent example of the speed, power, control, and endurance that can be achieved.
- Bonus slow-motion video loops that are perfect for practice sessions in front of the TV. You can watch and imitate the material along with Mike for complete method mastery!

**Musical Inspiration**

- Seven unique full-length Drum Solos performed by Mike Michalkow on his massive Yamaha drum set. An excellent source of ideas and inspiration for drummers of all skill levels.
- Three professional Jam Tracks that Mike Michalkow performs along with (two used with permission from Yamaha, and the last with permission from Chuck Silverman).
- Five complete Band Tracks performed by superstar musicians Mike Michalkow (drums), Cameron Peace (guitar), and Damian Erskine (bass). These tracks are both entertaining and educational!
- Five Drum Gear Demos showing off some of Mike's favorite drum gear with detailed descriptions of the kits, cymbals, sticks, practice pedals, and tuning accessories that he prefers.
- Extras - Including digital copies of all the sheet music exercises covered in the entire training pack, and slow motion video examples of drum techniques!

**The Members Area**

In addition to all the content, you will also get instant-access to all of the same great content through our online members area. You'll be able to stream all the video lessons, download the play-along songs, view or print the included sheet music, and connect with other students in the Moeller Method Secrets community.

This powerful resource makes it easy to access your lessons anytime from virtually anywhere. It's works on PCs, Macs, iPads, iPhones, Android devices, and other mobile computers that have an active Internet connection. Best of all, you get unlimited lifetime access to the Moeller Method Secrets members area, so you can enjoy the lessons for years to come.",
            ],
            [
                "brand" => 2,
                "product_type_id" => 1,
                "name" => "Sight Reading Made Simple",
                "slug" => "sight-reading-made-simple",
                "sku" => "sight-reading-made-simple",
                "thumbnail" => "https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/sight-reading-made-simple.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "",
                "price" => 0,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/sight-reading-made-simple.jpg',
                'bundle_desc' => 'Start reading music in MINUTES with this fantastic digital training pack. Sight-Reading Made Simple breaks down the task or reading music into short FUN lessons, so you can learn the basics in no time. If you’ve ever wanted to read music, or tried before and had a bad experience, this training pack will have you reading notes, rhythm, and time signatures in no time. You’ll get practice exercises to go along with the lessons, PLUS a downloadable glossary of music notes and symbols that you can download, print, and keep at the keyboard. Reading music doesn’t have to be hard. This training pack will show you just how easy it can be.',
            ],
            [
                "brand" => 4,
                "product_type_id" => 1,
                "name" => "Singeo Membership",
                "slug" => "",
                "sku" => "",
                "thumbnail" => "https://singeo.s3.amazonaws.com/sales/promos/november/annual-tall.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "",
                "price" => 240,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "freeBonus" => false,
                "guaranteed" => true,
                "lifetime_access" => true,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "",
                "instructor_desc" => "",
                "instructor_img" => null,
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/annual-tall.jpg',
                "bundle_desc" => "For less than the price of two in-person singing lessons, get a FULL YEAR of access to our Singeo Member's Area. You'll have step-by-step lessons to guide you along the way to the singing voice you've always wanted, personal feedback from REAL vocal coaches, on-demand practice and vocal exercise routines, exclusive access to featured courses taught by Grammy Award-winning singers and a forum with thousands of other students on the same journey as you."
            ],
            [
                "brand" => 4,
                "product_type_id" => 1,
                "name" => "The Singing Starter Kit",
                "slug" => "singing-starter-kit",
                "sku" => "singing-starter-kit",
                "thumbnail" => "https://singeo.s3.amazonaws.com/products/singing-starter-kit/header.jpg",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "Everything You Need To Start Singing Now",
                "header_text" => "",
                "price" => 19,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "thumbnail_logo" => "https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "Lisa Witt",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',
                'bundle_desc' => 'Start your singing journey the right way with The Singing Starter Kit. Get rid of all the guesswork and frustration as you follow along with 6 step-by-step lessons to discover your beautiful, unique voice. Use “The Most Important Vocal Exercise” to warm up your voice, and unlock the “Singer’s Secret Weapon” that will instantly make you sound better. Plus, you’ll have support and feedback from real teachers to help you at every turn.',
            ],
            [
                "brand" => 4,
                "product_type_id" => 1,
                "name" => "The Essential Guide to Beautiful Harmonies",
                "slug" => "live-bootcamp",
                "sku" => "",
                "thumbnail" => "",
                "meta_desc" => "",
                "meta_img" => "",
                "short_desc" => "",
                "header_text" => "",
                "price" => 27,
                "discounted_price" => "",
                "features" => [

                ],
                "specs" => [
                ],
                "shop_card_visible" => false,
                "sold_out" => false,
                "guaranteed" => false,
                "lifetime_access" => false,
                "free_shipping" => false,
                "thumbnail_logo" => "",
                "page_logo" => "",
                "video" => "",
                "instructor_name" => "",
                "instructor_desc" => "",
                "instructor_img" => "",
                "studyText" => "",
                "overview" => "",
                'bundle_img' => 'https://singeo.s3.amazonaws.com/sales/promos/october/Beautiful_harmonies_card.jpg',
                'bundle_desc' => 'In 8 easy-to-follow video lessons, you’ll learn everything you need to know to elevate any song to a whole new level. You’ll learn the SECRET to finding ANY harmony (high or low), how to make your harmony fit with the melody and the easiest harmony in the world (That also sounds incredible). You can be singing your first harmony 10 minutes from NOW!',
            ],
//            [
//                "brand" => 2,
//                "product_type_id" => 1,
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
//                "features" => [
//
//                ],
//                "specs" => [
//                ],
//                "shop_card_visible" => false,
//                "sold_out" => false,
//                "guaranteed" => true,
//                "lifetime_access" => true,
//                "free_shipping" => false,
//                "thumbnail_logo" => "",
//                "page_logo" => "",
//                "video" => "",
//                "instructor_name" => "",
//                "instructor_desc" => "",
//                "instructor_img" => "",
//                "studyText" => "",
//                "overview" => "",
//                "images" => [
//
//                ],
//                "sizeChart" => "",
//                "sizes" => [
//
//                ]
//            ],
//            [
//                "brand" => 2,
//                "product_type_id" => 1,
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
//                "features" => [
//
//                ],
//                "specs" => [
//                ],
//                "shop_card_visible" => false,
//                "sold_out" => false,
//                "guaranteed" => true,
//                "lifetime_access" => true,
//                "free_shipping" => false,
//                "thumbnail_logo" => "",
//                "page_logo" => "",
//                "video" => "",
//                "instructor_name" => "",
//                "instructor_desc" => "",
//                "instructor_img" => "",
//                "studyText" => "",
//                "overview" => "",
//                "images" => [
//
//                ],
//                "sizeChart" => "",
//                "sizes" => [
//
//                ]
//            ],
        ];

        Product::truncate();
        Benefit::truncate();
        Spec::truncate();
        Feature::truncate();
        Image::truncate();
        ProductSize::truncate();
        Bundle::truncate();


        $drumeo = 5;
        $pianote = 5;
        $guitareo = 5;
        $singeo = 5;
        $orderNum = 5;

        foreach($products as $product) {
            $brand = $product['brand'];

            if($brand === 1) {
                $orderNum = $drumeo;
            } elseif($brand === 2) {
                $orderNum = $pianote;
            } elseif($brand === 3) {
                $orderNum = $guitareo;
            } elseif($brand === 4) {
                $orderNum = $singeo;
            }

            $newProduct = Product::create([
                            'brand_id' => $product['brand'],
                            'product_type_id' => $product['product_type_id'],
                            'name' => $product['name'],
                            'slug' => empty($product['slug']) ? null : $product['slug'],
                            'sku' => $product['sku'],
                            'thumbnail' => empty($product['thumbnail']) ? null : $product['thumbnail'],
                            'badge_text' => empty($product['badge_text']) ? null : $product['badge_text'],
                            'header_text' => $product['header_text'],
                            'short_desc' => $product['short_desc'],
                            'meta_desc' => $product['meta_desc'],
                            'meta_img' => empty($product['meta_img']) ? null : $product['meta_img'],
                            'special_text' => empty($product['special_text']) ? null : $product['special_text'],
                            'thumbnail_logo' => empty($product['thumbnail_logo']) ? null : $product['thumbnail_logo'],
                            'page_logo' => empty($product['page_logo']) ? null : $product['page_logo'],
                            'price' => $product['price'],
                            'discounted_price' => empty($product['discounted_price']) ? 0 : $product['discounted_price'],
                            'video_src' => $product['video'],
                            'overview' => $product['overview'],
                            'instructor_name' => $product['instructor_name'],
                            'product_img' => empty($product['instructor_img']) ? null : $product['instructor_img'],
                            'instructor_desc' => $product['instructor_desc'],
                            'sold_out' => $product['sold_out'],
                            'free_shipping' => $product['free_shipping'],
                            'included_edge' => empty($product['included_edge']) ? false : $product['included_edge'],
                            'guaranteed' => $product['guaranteed'],
                            'shop_card_visible' => $product['shop_card_visible'],
                            'display_order' => $product['shop_card_visible'] ? $orderNum : 0,
                            'bundle_img' => empty($product['bundle_img']) ? null : $product['bundle_img'],
                            'bundle_desc' => empty($product['bundle_desc']) ? null : $product['bundle_desc'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
            if(empty($product['display_order'])) {
                if($brand === 1) {
                    $drumeo += 5;
                } elseif($brand === 2) {
                    $pianote += 5;
                } elseif($brand === 3) {
                    $guitareo += 5;
                } elseif($brand === 4) {
                    $singeo += 5;
                }
            }

            foreach($product['features'] as $key => $feature) {
                Feature::create([
                    'product_id' => $newProduct->id,
                    'desc' => $feature,
                    'order_number' => $key
                ]);
            }

            if(!empty($product['benefits'])) {
                foreach($product['benefits'] as $key => $benefit) {
                    Benefit::create([
                        'product_id' => $newProduct->id,
                        'icon' => $benefit['icon'],
                        'heading' => $benefit['heading'],
                        'desc' => $benefit['desc'],
                        'order_number' => $key
                    ]);
                }
            }

            foreach($product['specs'] as $key => $spec) {
                Spec::create([
                    'product_id' => $newProduct->id,
                    'title' => $spec['title'],
                    'desc' => $spec['desc'],
                    'order_number' => $key,
                ]);
            }
        }
    }
}
