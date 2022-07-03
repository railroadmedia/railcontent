<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Product;
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
    public function run()
    {
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
                "lifeTime" => true,
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
                "badge" => true,
                "lifeTime" => true,
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
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "The Language Of Drumming",
                "slug" => "the-language-of-drumming",
                "sku" => "TLOD-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/language-of-drumming.jpg",
                "metaDesc" => "The Language of Drumming helps you express yourself through the drums by focusing on the most basic components: the individual letters of the rhythmic alphabet.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Language%20Of%20Drumming/og-image.jpg",
                "shortDesc" => "Benny Greb’s system for musical expression -- featuring over three hours of online video lessons to help you express your ideas on the drums.",
                "headerText" => "Benny Greb’s System For Musical Expression",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Language%20Of%20Drumming/logo.png",
                "video" => "//player.vimeo.com/video/292144481",
                "instructorName" => "Benny Greb",
                "instructorDesc" => "Internationally-acclaimed drummer and educator Benny Greb has taken the art of drumming to an entirely new level with his awe-inspiring creativity, musicality, and technique -- arriving on the scene in 2009 with “The Language of Drumming” and landing on the front cover of Modern Drummer in June 2015 for a feature on “The Art And Science Of Groove”. Benny also writes, records, and releases his own solo records including Grebfruit, Brass Band, and Moving Parts.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/benny-greb.jpg",
                "studyText" => "Award-Winning Clinician, Modern Drummer Cover Artist, & Accomplished Solo Drummer",
                "overview" => "Learning to play the drums is like learning to speak a language. Knowing a few basic drum beats and fills is like knowing only a few standard phrases in a language; you won’t be able to communicate or have a full, interactive conversation in practical situations.

                The Language of Drumming helps you express yourself through the drums by focusing on the most basic components: the individual letters of the rhythmic alphabet. Benny Greb introduces his revolutionary 24-character system and shows you how to use the basic binary and ternary rhythms to develop timing, technique, dynamic control, and speed.

                Covering hands and feet, with and without a practice pad, Greb quickly progresses from simple alphabetical exercises to more intricate examples of words (rhythmic phrases) and syntax (sentences and vocabulary) on the full drum set. You will gain insights on the importance of listening, building fills and solos using standard improvisational forms, developing better timing, expanding rhythmic comfort zones through the creative use of a metronome, and finding new sounds on the drum set.

                Throughout the entire presentation, Greb flawlessly performs exercises and patterns that illustrate his theories. You’ll also get several drum solos as well as Greb’s performances with master percussionist Pete Lockett and the Benny Greb Brass Band.",
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "Great Hands For A Lifetime",
                "slug" => "great-hands-for-a-lifetime",
                "sku" => "GHFAL-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/great-hands-for-a-lifetime.jpg",
                "metaDesc" => "Tommy Igoe guides you towards developing and maintaining the physical tools that are essential for every drummer and drumming application: your hands.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Great%20Hands%20For%20A%20Lifetime/og-image.jpg",
                "shortDesc" => "Tommy Igoe helps you improve your hand strength, speed, stamina, comfort, and control in the drums in four hours of video lessons.",
                "headerText" => "Improve Your Hand Strength, Speed, Stamina, Comfort, & Control On The Drums",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Great%20Hands%20For%20A%20Lifetime/logo.png",
                "video" => "//player.vimeo.com/video/292145247",
                "instructorName" => "Tommy Igoe",
                "instructorDesc" => "Tommy Igoe is a world-class musician living in San Francisco. He has been long recognized as one of the finest drummers in the world and is the top-selling author in his field with four #1 titles on Amazon.com.

                Igoe wrote the drum set book for Disney’s epic Broadway production of the “The Lion King” where he served as principal drummer and conductor. He has played drums on three Grammy award winning recordings and was voted the World’s #1 Jazz Drummer in the 2014 Modern Drummer Readers Poll. He has created two ongoing weekly musical residency at iconic Jazz clubs in New York and San Francisco. His New York band, The Birdland Big Band, is the most popular weekly music event in the city for the last 9 years.

                His most recent and exciting project is the Tommy Igoe Groove Conspiracy, a 15-piece supergroup from the San Francisco that has quickly become an integral part of the San Francisco cultural landscape. He is currently the President of Deep Rhythm Music, his recording studio, publishing arm, record label and has several endorsement partners.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/tommy-igoe.jpg",
                "studyText" => "2X Best Jazz Drummer, Best-Selling Author, & Drummer for The Birdland Big Band in New York City.",
                "overview" => "Tommy Igoe guides you towards developing and maintaining the physical tools that are essential for every drummer and drumming application: your hands.

                At the heart of this life-changing, career-extending system is the three-tier “Lifetime Warmup” originally conceived in the 1950s by Tommy’s father, Sonny Igoe. Featuring basic, intermediate, and advanced levels - the Lifetime Warmup is a challenging routine that weaves its way through standard drum rudiments and original exercises while simultaneously keeping drummers in command of their basic drumming motions.

                Your pathway to playing better, faster, and healthier for a lifetime of pain-free drumming -- Great Hands For A Lifetime will help you unlock your potential and protect your hands for the many years of drumming to come.",
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "Hands Grooves & Fills",
                "slug" => "hands-grooves-and-fills",
                "sku" => "HGAF-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/hands-grooves-fills.jpg",
                "metaDesc" => "Hands Grooves & Fills gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Hands%20Grooves%20And%20Fills/og-image.jpg",
                "shortDesc" => "Pat Petrillo’s curriculum for developing technique, groove ideas, and a drum fill vocabulary -- with three hours of video lessons and a 52-page workbook.",
                "headerText" => "Better Hand Technique, More Groove Ideas, & More Creative Drum Fills",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Hands%20Grooves%20And%20Fills/logo.png",
                "video" => "//player.vimeo.com/video/292145073",
                "instructorName" => "Pat Petrillo",
                "instructorDesc" => "Pat Petrillo is one of today’s most prolific drummers. Whether it’s a deep pocket funk groove or a fiery fusion fill, Petrillo can bring it all together with musicality, finesse, and uncanny technical ability.

                He has performed and recorded with R&B legends Gloria Gaynor and Patti LaBelle, Pop/Rock artists Glen Burtnik and Patty Smyth, and jazz artists Ed Hamilton and Gerald Veasley -- as well as playing the original Broadway productions A Chorus Line, Grease, and Footloose.

                Petrillo has served as a faculty member at the Drummer’s Collective in New York City and has served as a regular educational contributor to Drumeo, Drummerworld, and Modern Drummer Magazine.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/pat-petrillo.jpg",
                "studyText" => "Veteran NYC Drummer, Acclaimed Drum Educator, & Designer of the Drumeo P4 Practice Pad.",
                "overview" => "Hands, Grooves, & Fills is a complete curriculum for developing technique, groove ideas, and a drum fill vocabulary.

                **Hands:** Petrillo demonstrates his exercises and methods for developing smooth, relaxed hand technique, endurance and coordination. He also demonstrates all of the standard rudiments with modern interpretations, and shows you how to put them into musical phrases using his groundbreaking “Rudiment TAB System”.

                **Grooves:** Music is all about the groove, and Petrillo demonstrates how to develop bass drum technique and ghost note ideas, while having FUN with over 50 play along tracks featuring a great band of New York’s finest musicians in the groove styles of Rock, R&B, Jam Band, New Orleans Funk, Fusion, Drum n’ Bass and many more.

                **Fills:** Creating fills is always a challenge, and Pat shows his methods of orchestrating 16th notes, sextuplets and numerous rudiment stickings into creative, awesome sounding fills. If you are lacking a fill vocabulary, or always wanted to learn killer fills, PAT BREAKS IT ALL DOWN!

                This video pack also comes with a 52 page workbook.",
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "In Constant Motion",
                "slug" => "in-constant-motion",
                "sku" => "ICM-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/in-constant-motion.jpg",
                "metaDesc" => "In Constant Motion gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/In%20Constant%20Motion/og-image.jpg",
                "shortDesc" => "Seven hours of instruction, live and studio performances, and insights into Mike Portnoy’s various drumming projects.",
                "headerText" => "Mike Portnoy’s Performances, Drum Solos, & Musical Insights",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/In%20Constant%20Motion/logo.png",
                "video" => "//player.vimeo.com/video/292144804",
                "instructorName" => "Mike Portnoy",
                "instructorDesc" => "Mike Portnoy is known for his incredible performances as the drummer for Dream Theater for 25 years -- along with his musical side projects including Transatlantic and Liquid Tension Experiment.

                He has won 30 Modern Drummer Readers Poll awards including Best Rock Drummer, Best Progressive Rock Drummer, Best Recorded Performance, Best Clinician, Best Educational Video, and the Most Valuable Player -- as well as being the second youngest drummer to be inducted into the Modern Drummer Hall of Fame.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-portnoy.jpg",
                "studyText" => "Legendary drummer for Dream Theater and 30x Modern Drummer Readers Poll Award-Winner.",
                "overview" => "In Constant Motion features over seven hours of instruction, live and studio performances, and insights into Mike Portnoy’s numerous projects. Packed with audio and video, special features, and printable transcriptions of selected performances, the depth and diversity of this package is recommended for drummers of all interests and skill levels.

                **Section 1** titled “In the Dream” focuses on music from three of Portnoy’s Dream Theater albums: Six Degrees of Inner Turbulence, Train of Thought, and Octavarium; featuring complete band performances of six songs from these albums as well as new studio performances of the drum tracks and Portnoy’s in-depth analysis of each song.

                **Section 2** titled “On the Side” covers a wide range of Portnoy’s side projects, including his work with TransAtlantic, John Arch, John Petrucci/G3, Fates Warning and Overkill. In addition to the nearly 6 hours of high quality, all-new content, excerpts of rare performances are also included – including a detailed look at each of Mike’s tribute bands, paying homage to The Beatles, Led Zeppelin, The Who and Rush!

                **Section 3** offers Bonus Material containing four additional Dream Theater tracks filmed on the band’s 20th Anniversary tour, three live drum solos featuring duets with Charlie Benante, Jason Bittner and Richard Christy, a tour of Portnoy’s infamous “Albino Monster” drum kit and bonus clips including unreleased live solos, studio footage and more.",
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "Creative Control",
                "slug" => "creative-control",
                "sku" => "CC-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/in-constant-motion.jpg",
                "metaDesc" => "Thomas Lang presents a completely innovative and inspired practice regime, and system for helping you develop incredible drumset technique, that will forever change your approach to drumming.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Creative%20Control/og-image.jpg",
                "shortDesc" => "Thomas Lang’s innovative system for developing technique so you can play more effectively in any style of music. Includes more than four hours of video.",
                "headerText" => "Hone Your Chops & Play More Effectively In Any Style Of Music",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Creative%20Control/logo.png",
                "video" => "//player.vimeo.com/video/292145163",
                "instructorName" => "Thomas Lang",
                "instructorDesc" => 'A world-class drummer whose passion is "to play the unplayed", Thomas Lang has headlined at every major international drum festival and toured the world many times over as a solo performer, as well as playing with artists including Tina Turner, Kelly Clarkson, Robbie Williams, The Commodores, George Michael, and Victoria Beckham. Thomas has won numerous awards from drum magazines and publications including the Best Studio Drummer, Best Pop Drummer, Best All-Around Drummer, Best DVD, Best Drummer, Best Recorded Drum Performance, and Best Drum Clinician.',
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/thomas-lang.jpg",
                "studyText" => "Voted the “Best Clinician/Educator” three times in the Modern Drummer Readers Poll.",
                "overview" => "Thomas Lang presents a completely innovative and inspired practice regime, and system for helping you develop incredible drumset technique, that will forever change your approach to drumming. Lang's awesome speed, control, finesse and unparalleled interdependence will inspire you to hone your drumming chops so that you can play more effectively in any musical context. Thomas also offers blazing solos and performances in many different styles, including a definitive version of The Black Page, the Frank Zappa tour de force.",
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "The Grid",
                "slug" => "the-grid",
                "sku" => "TG-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/the-grid.jpg",
                "metaDesc" => "With The Grid, Mike Mangini presents a complete system for expanding your skills as a creative player and improviser, focusing in on your own musical identity.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Grid/og-image.jpg",
                "shortDesc" => "Mike Mangini’s system for creative drumming and improvisation -- including more than three hours of online video for expanding your skills.",
                "headerText" => "Mike Mangini’s System For Creative Drumming & Improvisation",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/The%20Grid/logo.png",
                "video" => "//player.vimeo.com/video/292144708",
                "instructorName" => "Mike Mangini",
                "instructorDesc" => "The current drummer for Dream Theater and a touring drum clinician, Mike Mangini has a musically diverse background containing over 60 awards spanning musical styles from Classical, Jazz, Rock, to Heavy Metal, solo drumming, and World’s Fastest Drummer records.

                Mangini taught at the Berklee College of Music for eleven years - and chose to release The Grid to define “improvisation”, break it down, and show how it works.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/mike-mangini.jpg",
                "studyText" => "Drummer for Dream Theater, Accomplished Educator, & World’s Fastest Drummer in five categories.",
                "overview" => "**“Best Instructional Video”, Modern Drummer Readers Poll (2015)**

                With The Grid, Mike Mangini presents a complete system for expanding your skills as a creative player and improviser, focusing in on your own musical identity.

                This system is presented through performed examples and graphics, and applies to drummers of all musical styles. Dividing your drumming into time signature, subdivision, dynamics, instrument sounds, limbs, style, and phrases, Mike demonstrates dozens of grooves, fills, and patterns from easy to extremely advanced -- systematically showing you how to use “the grid” to expand your understanding of music and drumming, and improve your physical abilities.

                You will increase your speed, develop better independence, learn how to use ostinatos, expand your knowledge of styles, learn polyrhythms, play in odd time signatures, develop a deeper understanding of rhythm, and become a more creative player.",
            ],
            [
                "brand" => 1,
                "productType" => 1,
                "name" => "Beyond The Chops",
                "slug" => "beyond-the-chops",
                "sku" => "BTC-DIGI",
                "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/beyond-the-chops.jpg",
                "metaDesc" => "Beyond The Chops gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.",
                "metaImg" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Beyond%20The%20Chops/og-image.jpg",
                "shortDesc" => "A three-hour masterclass experience showcasing Aaron Spears’ phenomenal drumming through performances, educational segments, and interviews.",
                "headerText" => "Groove, Musicality, & Technique",
                "specialText" => "",
                "price" => 29.99,
                "discountedPrice" => "",
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
                "visible" => true,
                "soldOut" => false,
                "freeBonus" => false,
                "badge" => true,
                "lifeTime" => true,
                "freeShipping" => false,
                "logo" => "https://s3.amazonaws.com/drumeo-packs/Pack%20Images/Beyond%20The%20Chops/logo.png",
                "video" => "//player.vimeo.com/video/292144401",
                "instructorName" => "Aaron Spears",
                "instructorDesc" => "Aaron Spears is a two-time winner of the “Best R&B Drummer” award in the Modern Drummer Readers Poll -- and his “in the pocket” style of playing and authentic delivery is unparalleled in the world of drummers today.

                His playing style has given him the opportunity to perform with some of the most popular musicians on the planet including Usher, Ariana Grande, Carrie Underwood, Britney Spears, Chamillionaire, the Backstreet Boys, James Brown, Alicia Keys, Adam Lambert, Jordin Sparks, Lil Wayne, Miley Cyrus, and many more.",
                "instructorImg" => "https://s3.amazonaws.com/drumeo-packs/Instructors/aaron-spears.jpg",
                "studyText" => "Drummer for mega-platinum superstars including Usher, Ariana Grande, and Carrie Underwood.",
                "overview" => "Beyond The Chops gives you a unique masterclass experience, showcasing Aaron Spears’ phenomenal drumming that critics, fans, and even his peers have described as “beyond category”.

                This 3-hour program offers amazing performances, enlightening educational segments, and revealing interviews as Spears displays his natural talent, incredible groove, and deep skills in a set of performances with Gospel, R&B, Motown, rock, shuffle, and odd-meter tracks. You’ll get an in-depth look at his exceptional ability to combine a wide range of musical genres and influences into a seamless, powerful, new style of drumming.

                Spears also hosts a Q&A session in front of a masterclass and then sits down with drumming icon Jojo Mayer for a candid interview covering everything from his gospel roots to his recent work with Usher, the Backstreet Boys, and the American Idol tour. You’ll gain insights into the unique rhythmic vocabulary he has created with many of the grooves and fills transcribed in an accompanying 21-page workbook.",
            ],
//            [
//                "brand" => 2,
//                "productType" => 1,
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
//                "features" => [
//
//                ],
//                "specs" => [
//                    [
//                        "title" => "Publisher",
//                        "desc" => "Hudson Music, 2010"
//                    ],
//                    [
//                        "title" => "Video",
//                        "desc" => "minutes"
//                    ],
//                    [
//                        "title" => "Online",
//                        "desc" => "Lifetime access to all content"
//                    ],
//                    [
//                        "title" => "Skill",
//                        "desc" => ""
//                    ],
//                ],
//                "visible" => true,
//                "soldOut" => false,
//                "freeBonus" => false,
//                "badge" => true,
//                "lifeTime" => true,
//                "freeShipping" => false,
//                "logo" => "",
//                "video" => "",
//                "instructorName" => "",
//                "instructorDesc" => "",
//                "instructorImg" => "",
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
        }
    }
}
