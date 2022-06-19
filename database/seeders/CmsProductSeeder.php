<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Product;
use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = [
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "Anatomy Of A Drum Solo",
                "slug" => "anatomy-of-a-drum-solo",
                "sku" => "AOADS-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/anatomy-of-a-drum-solo.jpg",
                "metaDesc" => "In-studio footage of Neil Peart discussing, in detail, his approach to soloing.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Anatomy%20Of%20A%20Drum%20Solo/og-image.jpg",
                "shortDesc" => "Neil Peart breaks down his approach to drum soloing -- with more than three hours of online video to improve your rhythm and improvisation.",
                "headerText" => "Neil Peart’s Inspiration, Improvisation,& Approach To Soloing",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => false,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Anatomy%20Of%20A%20Drum%20Solo/logo-white.png",
                "video" => "//player.vimeo.com/video/292144959",
                "instructorName" => "Neil Peart",
                "instructorDesc" => "Best known as the drummer and primary lyricist for the rock band Rush, Neil Peart has received numerous awards for his musical performances including Best Rock Drummer, Best Multi-Percussionist, Best All Around Drummer, as well as inductions into the Rock and Roll Hall of Fame and the Modern Drummer Hall of Fame.

                Peart is noted for his distinctive in-concert drum solos, characterized by exotic percussion instruments and long, intricate passages in odd time signatures - and his drum solos were featured on every live album released by Rush. “Anatomy of a Drum Solo” gives you an in-depth examination of how he constructs a solo that is musical, rather than indulgent, using his solo from the 2004 R30 30th anniversary tour as an example.",
                "studyText" => "World-renowned drummer for Rush. Inducted into the Rock and Roll Hall of Fame in 2013.",
                "overview" => "**“Best Instructional Video”, Modern Drummer Readers Poll (2006)
                “Best DVD”, DRUM! Magazine Drummie Awards (2007)**

                In-studio footage of Neil Peart discussing, in detail, his approach to soloing. Using a solo recorded in 2004 in Frankfurt, Germany, as a framework - Peart talks about each segment of this nine-minute tour de force that is a highlight of each Rush performance.

                Also included are:

                Two explorations -- completely improved workouts at the drums, each over thirty minutes long; a never-before-released solo recorded in Hamburg, Germany in September, 2004.
                Peart’s Grammy Award-nominated solo from Rush in Rio.
                Two full Rush performances from Frankfurt 2004, shown entirely from the perspective of the drum cameras.
                Interviews with Lorne Wheaton, Peart’s drum tech, and Paul Northfield, Rush co-producer and engineer.
                A previously unreleased solo from the Rush Counterparts tour recorded in 1994 at the Palace of Auburn Hills in Michigan.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/neil-peart.jpg",
                "images" => [

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "Methods & Mechanics",
                "slug" => "methods-and-mechanics",
                "sku" => "MAM-DIGI",
                "thumbnail" => "https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/packs/550/methods-and-mechanics.jpg",
                "metaDesc" => "Todd Sucherman brings the knowledge of thousands of gigs, shows and recording sessions along with over three decades as a professional drummer to this useful and unique package.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Methods%20And%20Mechanics/og-image.jpg",
                "shortDesc" => "Todd Sucherman brings the knowledge of thousands of gigs, shows and recording sessions along with over three decades as a professional drummer to this useful and unique package.",
                "headerText" => "Enhance your rhythmic & musical vocabulary on the drums.",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Methods%20And%20Mechanics/logo.png",
                "video" => "//player.vimeo.com/video/85543585",
                "instructorName" => "Todd Sucherman",
                "instructorDesc" => "Todd Sucherman is one of the most in-demand drummers on the planet. In addition to a 20+ year tenure with the legendary rock band, Styx, Sucherman is also an in-demand clinician and the creator of the award-winning Methods and Mechanics instructional DVD series.

                Sucherman recently won two awards in the 2018 Modern Drummer Readers Poll for #1 Progressive Rock Drummer and the #1 Recorded Performance for The Mission (Styx).",
                "studyText" => "Award-Winning Rock Drummer, In-Demand Clinician, & 20+ Year Drummer For Styx",
                "overview" => "** “Best DVD”, Modern Drummer Readers Poll (2009)**

                Todd Sucherman brings the knowledge of thousands of gigs, shows and recording sessions along with over three decades as a professional drummer to this useful and unique package.

                Astonishing technique, power and musicality explode from the various musical and solo performances throughout this presentation. Working with artists over a myriad of genres diverse as Styx, Brian Wilson, Spinal Tap, Eric Marienthal, Peter Cetera, John Wetton, Steve Cole, The Falling Wallendas and countless more, there’s a wealth of knowledge imparted that goes way beyond just the technical aspects of drumming.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/todd-sucherman.jpg",
                "images" => [

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
            [
                "brand" => 1,
                "productType" => 1,
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
                "features" => [

                ],
                "specs" => [
                    [
                        "title" => "",
                        "desc" => ""
                    ]
                ],
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => false,
                "lifeTime" => false,
                "freeShipping" => false,
                "logo" => "",
                "video" => "",
                "instructorName" => "",
                "instructorDesc" => "",
                "instructorImg" => "",
                "studyText" => "",
                "overview" => "",
                "images" => [

                ],
                "sizeChart" => "",
                "sizes" => [

                ]
            ],
        ];

        foreach($products as $product){
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
                            'study_text' => $product['studyText'],
                            'logo' => $product['logo'],
                            'price' => $product['price'],
                            'discounted_price' => $product['discountedPrice'],
                            'video_src' => $product['video'],
                            'overview' => $product['overview'],
                            'instructor_name' => $product['instructorName'],
                            'instructor_img' => $product['instructorImg'],
                            'instructor_desc' => $product['instructorDesc'],
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
                   'product_id' => 6,
                    'title' => $spec['title'],
                    'desc' => $spec['desc'],
                    'order_number' => $key,
                ]);
            }
        }
    }
}
