<?php

namespace Database\Seeders;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use App\Models\LeadgenLessonAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadgenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leadgens = [
            [
                'brand_id' => 1,
                'title' => 'How to Play Drum Fills',
                'meta_desc' => 'Learn 20 beginner rock drum fills with Jared Falk of Drumeo. This is a free sample course, similar to the courses you\'d get when you join Drumeo.',
                'meta_img' => 'https://s3.amazonaws.com/drumeo-packs/drum-fills/1.png',
                'slug' => 'drum-fills',
                'lessons' => [
                    [
                        'slug' => 'drum-fills/1',
                        'title' => 'Part 1',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/O6Yd7XnYcPU/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/O6Yd7XnYcPU',
                        'duration' => 12,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/2',
                        'title' => 'Part 2',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/0JOnroNveHw/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/0JOnroNveHw',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/3',
                        'title' => 'Part 3',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/_QrSJbBzZwk/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/_QrSJbBzZwk',
                        'duration' => 15,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/4',
                        'title' => 'Part 4',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/9DETi6s4zD0/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/9DETi6s4zD0',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-fills/5',
                        'title' => 'Part 5',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/vG5EKqx8MhU/sddefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/vG5EKqx8MhU',
                        'duration' => 5,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'How To Start Playing Drums',
                'meta_desc' => 'Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg',
                'slug' => 'coop3rdrumm3r/lessons',
                'lessons' => [
                    [
                        'slug' => 'coop3rdrumm3r/1-the-drum-set',
                        'title' => 'Understanding The Drum Set',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551839388-a432e655008cce35ee73cec69639b3c801281023879f6a54a323f112782e7ef3-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674625',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/2-drum-theory',
                        'title' => 'Drum Theory',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/548962045-245c563e3dc6c0dfc39ffcd73ea0818c46579c70cf31b71c5f5ddf969b23580e-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674628',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Drum theory',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/2-drum-theory.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/3-practice',
                        'title' => 'How To Practice',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551839496-2316746236b066eb501ca6b120f2afb0e5d1a77dab1ee4902541021bbf2ebf79-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149675118',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'How to practicey',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/3-how-to-practice.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/4-grooves',
                        'title' => 'Starter Grooves',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/548963870-f2b45bc2cf148787602cd2dd0cd604ee6df16a75b28d4b303eb01ff3e5a77c53-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674627',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Starter grooves',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/4-starter-grooves.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/5-drum-fills',
                        'title' => 'Starter Fills',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551839554-da5d348f09ac3cc5864cc2a4d0651e216216127609a1e657d1e2ba932f673eff-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/149674630',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Starter fills',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/5-starter-fills.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'coop3rdrumm3r/keep-getting-better',
                        'title' => 'The Best Way To Keep Getting Better',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/551834334-d7a3d2ffcdc1635e764d6daf9e0d6c57b6e78433f678676e8586bb2f82d1b996-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/149674633',
                        'duration' => 2,
                        'assets' => [],
                        'one_off' => true,
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'David Raouf - Drum Set Maintenance',
                'meta_desc' => 'Sign up on this page and you’ll get 7 videos with David Raouf that are normally reserved for Drumeo members.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/og-image.jpg',
                'slug' => 'drum-set-maintenance/course-index',
                'lessons' => [
                    [
                        'slug' => 'drum-set-maintenance/course-index/1',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/1.jpg',
                        'video_src' => '//player.vimeo.com/video/388360545',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-set-maintenance/course-index/2',
                        'title' => 'Drum Maintenance',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/2.jpg',
                        'video_src' => '//player.vimeo.com/video/388360705',
                        'duration' => 12,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-set-maintenance/course-index/3',
                        'title' => 'Hardware Maintenance',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/3.jpg',
                        'video_src' => '//player.vimeo.com/video/388360960',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-set-maintenance/course-index/4',
                        'title' => 'Cymbal Maintenance',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/4.jpg',
                        'video_src' => '//player.vimeo.com/video/388361059',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-set-maintenance/course-index/5',
                        'title' => 'Pedal Maintenance',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/5.jpg',
                        'video_src' => '//player.vimeo.com/video/388361176',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-set-maintenance/course-index/6',
                        'title' => 'Common Repairs',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/6.jpg',
                        'video_src' => '//player.vimeo.com/video/388361282',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-set-maintenance/course-index/7',
                        'title' => 'Conclusion',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/851591302-93972f93101ad7a4cc558f727efb43e79f2d437b9697fa2b513463e0b13f487c-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/388361411',
                        'duration' => 1,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Drum Technique Made Easy',
                'meta_desc' => 'Drum Technique Made Easy is a 26-week online course with Bruce Becker.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/thumbnail.jpg',
                'slug' => '',
                'lessons' => [
                    [
                        'slug' => 'drum-technique-made-easy/1-five-technique-myths',
                        'title' => 'Top 5 Myths Of Drum Technique',
                        'desc' => 'Have you ever thought drum technique is only for professional drummers? Or that it takes way too long to see results? Watch today’s video to see why those are myths -- and 3 more myths -- and why drum technique is really about becoming the best YOU that you can be.

    If you’re looking to improve your technique then we’ve got something VERY special coming soon. Just click here to sign-up to be the first to hear about it: <a class="font-bold text-[#00BC75]" href="/drum-technique/">www.Drumeo.com/drum-technique/</a>.',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/5myths.jpg',
                        'video_src' => 'https://www.youtube.com/embed/HYSgMX0maAY?rel=0&amp;showinfo=0',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-technique-made-easy/2-massive-technique-fails',
                        'title' => 'Massive Drum Technique FAILS That Even The Pros Make',
                        'desc' => 'Every drummer makes some HUGE drum technique fails. And nobody knows that better than Bruce Becker, who studied with the late Freddie Gruber before teaching his own cast of all-star students including Daniel Glass, David Garibaldi, Mark Schulman, and more.

    Enjoy the video. And if you\'re looking to take your drumming to the next level in 2018, be sure to click here for our upcoming announcement: <a class="font-bold text-[#00BC75]" href="/drum-technique/">www.Drumeo.com/drum-technique/</a>.',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/fails.jpg',
                        'video_src' => 'https://www.youtube.com/embed/86lYLgElfdU?rel=0&amp;showinfo=0',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'drum-technique-made-easy/3-the-most-important-technique',
                        'title' => 'The Most Important Drum Technique In The World',
                        'desc' => 'Ever wanted to improve your fluidity of movement? Improve your speed? Have way more control on the drums? Tune in for today\'s video on the Moeller Method.

    This is just a sneak peek into the upcoming Drum Technique Made Easy course with Bruce Becker. Click here so you don\'t miss out: <a class="font-bold text-[#00BC75]" href="/drum-technique/">www.Drumeo.com/drum-technique/</a>.',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/important-technique.jpg',
                        'video_src' => 'https://www.youtube.com/embed/8MQnuDmNT2k?rel=0&amp;showinfo=0',
                        'duration' => 7,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Fastest Way To Get Faster',
                'meta_desc' => 'Jared Falk\'s 10-day routine that will help you rapidly improve your speed around the kit.',
                'meta_img' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/og-image.jpg',
                'slug' => 'faster/lessons',
                'lessons' => [
                    [
                        'slug' => 'faster/1',
                        'title' => 'Day 1 - Paradiddle Madness',
                        'desc' => 'Most of what we play on the drums is simply a combination of singles and double strokes - and that’s why I love the practicality of today’s Paradiddle Madness exercise.

        The first pattern is a triple paradiddle played around the kit, starting on the snare and moving down the three toms. If you only have two toms, you can play double the notes on the snare drum and floor tom. Next, we have a double paradiddle in a bar of 3 / 4. Just like the triple paradiddle, this one also moves down and back up the drum-set. Finally, there is the single paradiddle that moves between the snare and hi-tom.

        Once you have practiced each pattern individually, you can play them all together in sequence with each other. Remember to start at a slower tempo of at least 60 bpm and increase your speed in 5 bpm intervals.',
                        'thumbnail' => 'https://img.youtube.com/vi/URG4sD7HjwA/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/URG4sD7HjwA',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Paradiddle Madness',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/01-paradiddle-madness.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/2',
                        'title' => 'Day 2 - The Buddy Bruiser',
                        'desc' => 'I can’t say for certain that Buddy Rich played this exact fill, but it sure sounds like something he would do, especially when it’s played super fast.

The exercise is played using triplets and will again help increase your speed and movement around the drum-set. Most drummers are very good at playing groups of four around the kit and always leading each of those groupings with their dominant hand. Well, that’s going to change right now. When you move from drum to drum you’ll be changing the lead hand. I know it looks easy, but it’s not when you push it faster and faster!
You can start this one a little faster at 70-80 bpm and move up in increments of 5 bpm at a time as you become comfortable with the pattern.',
                        'thumbnail' => 'https://img.youtube.com/vi/6N658525ULs/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/6N658525ULs',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'The Buddy Bruiser',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/02-the-buddy-bruiser.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/3',
                        'title' => 'Day 3 - The Forearm Crusher',
                        'desc' => 'This warm-up is not something I created; I was first inspired to practice it when hanging out with Larnell Lewis (check him out if you haven’t).

It’s a simple exercise that consists of one bar of single strokes, one bar double strokes, and one bar single paradiddle. You’re probably saying to yourself, “well, that’s easy!” But it’s not as easy as you think if you force yourself to focus on the right things. Start off just by familiarizing yourself with the individual patterns, then move on to playing them in sequence.

When playing, focus on getting the singles, doubles, and paradiddles to all sound totally even. If I was listening to you practice, I should have trouble discerning when you were switching between stickings. Once you can seamlessly switch between the stickings, start to speed this up and move it around the kit. You’re going to notice huge improvements!',
                        'thumbnail' => 'https://img.youtube.com/vi/AxLiCX13xGI/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/AxLiCX13xGI',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'The Forearm Crusher',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/03-the-forearm-crusher.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/4',
                        'title' => 'Day 4 - Do You Even Math?',
                        'desc' => 'Okay, it’s not a very good title but hopefully I caught your attention and you are reading this wondering what I was thinking!?

This is one of my favorite ways to practice my speed and fluidity around the kit. The first pattern is in 2/4, you play two notes on each drum moving down to the floor tom and then back to the snare. Each following pattern uses the exact same format. You’ll start with groups of two, then move to four, six, and eights.

When practicing this as a sequence or individually, you’ll notice that one of the hardest parts is to re-start the pattern back on the snare. Since you have to come over from the floor tom it can cause a traffic jam between the right and left hands. Just start slowly with this at 60 bpm and speed up at increments of 5 bpm.',
                        'thumbnail' => 'https://img.youtube.com/vi/MbscOsXBwtU/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/MbscOsXBwtU',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'Do you Even Math',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/04-do-you-even-math.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/5',
                        'title' => 'Day 5 - Crazy Crossover',
                        'desc' => 'Drumming isn’t all about crossovers and showmanship, but they sure look cool and are fun to practice! I don’t use crossovers that much while I’m playing the drums, but they’ve been extremely helpful for me while warming up or practicing speed - they’re a great way to get some exercise and you’ll definitely break a sweat as you speed it up!

The first pattern is just a simple 16 note crossover fill. Play this as a single stroke roll and go slowly to start. The last thing you want to do is bash your knuckles with a drumstick.

For the second exercise we’re going to increase the complexity by using 16th note triplets. Again, play all single strokes when practicing these. Start off by learning the pattern then practice playing it as a one-bar fill.

The final pattern is definitely the most challenging. Normally I have just used this pattern as a 10-note single stroke grouping - but for the sake of keeping this as a one-bar fill, I decided to turn it into 32nd notes - so the main pattern repeats three times and ends with two extra 32nd notes. Start this off at 50 bpm and increase tempo only when you are very comfortable with the pattern played to a metronome.',
                        'thumbnail' => 'https://img.youtube.com/vi/liDmsVjp2wE/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/liDmsVjp2wE',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Crazy Crossovers',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/05-crazy-crossovers.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/6',
                        'title' => 'Day 6 - The Illusion Of Speed',
                        'desc' => '',
                        'thumbnail' => 'https://img.youtube.com/vi/55yHSKYj_6k/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/55yHSKYj_6k',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'The Illusion Of Speed',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/06-the-illusion-of-speed.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/7',
                        'title' => 'Day 7 - The Main Foot Killer',
                        'desc' => '        Simply playing fast isn’t enough, but it all comes together when you add control. So let’s get your main foot ready for a battle of double-stroke madness that will help you alternate between your lead hand and your main foot for controlled double strokes. (This is a valuable tool to have in your toolbox for that next gig or recording session.)

        The first exercise starts with groups of four and the pattern is played in 4/4 timing. Next, the pattern is played in 5/4 using 16th note groups of five, and finally we have groups of seven played as 16th notes in 7/4. I’d recommend using a quarter note click and don’t worry too much about the odd times.

        Start off by practicing each pattern individually, then practice them in sequence starting with a 60 bpm click track. If you find that is too fast, feel free to slow it down!',
                        'thumbnail' => 'https://img.youtube.com/vi/aixl1vCL3Wk/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/aixl1vCL3Wk',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'The Main Foot Killer',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/07-the-main-foot-killer.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/8',
                        'title' => 'Day 8 - Do You Even Math? (The Sequel)',
                        'desc' => 'Sequels are never as good as the original, right? Well we’re going to break that trend with the second part of “Do You Even Math”. Today we’re going to challenge your abilities as we play groupings of 3, 5, and 7 between the hands and feet.

For the first exercise, we’re playing groups of 3 using 16th note triplets. The right and left hands will alternate as you place the kicks in between. As an added challenge, you can also play quarter notes with your hi-hat foot. Once you have nailed the basic pattern, feel free to start moving it around the drums, this works great in solos.

The next exercise is also played as 16th note triplets, but we’re going to use groups of 5. I have become obsessed with using RLRLL as a hand pattern (thanks to Benny Greb), so in this case I split it up between the hands and feet. What would normally be the left hand is now going to be played on the bass drum and we’re going to split to the two main hand strokes between the right and left hand. Take your time with this one and make sure you practice using a metronome so you know you’re playing it in time using the correct note value.

The final exercise is the same concept as previous, but this time we’re going to play sevens. Similarly to playing fives as RLRLL, we’re going to play sevens as RLRLRLL but place the main foot where our left hand, and alternate the hits on the hands. You’ll notice that the hand lead patterns actually change each time the sequence repeats. The first exercise is written in 4/4, the next one is 5/4, and the last one is 7/4. I’ve done this so they all naturally repeat and it creates a nice sequence of exercises for practicing.

Start practicing all of these at 50-60 bpm and speed them up in 5 bpm increments as you get comfortable with the patterns.',
                        'thumbnail' => 'https://img.youtube.com/vi/EEra-3i65yQ/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/EEra-3i65yQ',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Do You Even Math? (The Sequel)',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/08-do-you-even-math-the-sequel.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/9',
                        'title' => 'Day 9 - Everything\'s Better When You\'re Part Of A Team',
                        'desc' => 'Yes, I stole the title. It’s actually a line from the Tegan and Sara song “Everything Is Awesome” which is part of the soundtrack to The LEGO Movie. It’s burned into my memory from hearing my kids running around the house screaming it.

Anyways, these next two exercises are fun ones. After studying lots of technique over the years (thanks Dom Famularo, Claus Hessler, Mike Michalkow, Lionel Duperron, and my many other great teachers), I’ve always wondered how drummers will go from 0-100 mph with their sticks using hardly any effort. As I studied more, I found that this is simply a technique issue.

What I’ve done to practice this myself is played my hands in unison. This helped me determine if there are any weak points with my hands. Most of you will find that your weak hand is much slower and less controlled. Since you’re only as fast as your weakest limb, you need to make sure you start at your weak hand’s slowest tempo.

The first exercise has two beats of the hands played unison with the kick drum stroke on the “let”, then we split the hands up and play 16th note triplets for the second half of the exercise. Technically, the hands aren’t actually playing any faster individually, but when they’re off-set instead of played unison it sounds quite fast! When I practice this I simply throw my sticks down at slightly different times, using the rebound of the stick which is controlled by the fingers, to keep the note spacing even. This can take time to learn but it’s so worth it!

The second exercise is similar, but this time we’re playing longer groups of unison and single strokes. You can continue to expand on this if you like, playing groups of 8, 10, or even 12 notes. I’d recommend starting very slowly at around 60 bpm and then speed it up from there.',
                        'thumbnail' => 'https://img.youtube.com/vi/zBLSP4zcnUk/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/zBLSP4zcnUk',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Everything\'s Better When You\'re Part Of A Team',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/09-everythings-better-when-your-part-of-a-team.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'faster/10',
                        'title' => 'Day 10 - Take\'r For A Rip, Eh?',
                        'desc' => '        It’s the last day! Congratulations! Now let’s take the concepts that we’ve covered so far and merge them into -- say this next part in your best announcer voice - a single mind-numbing exercise! I love doing this sort of thing as it reinforces everything you’ve been practicing and ensures that you’ve internalized all the concepts.

        Similarly to the other exercises in Fastest Way To Get Faster, you should start these all slowly and learn the patterns first, then practice along to a metronome in time. Once you have done that, try applying these within a one-bar drum beat.

        The first exercise utilizes 16ths, 32nds, and 16th note triplets. So hopefully you’ve practiced your note value tree! And next up, we are playing the pattern in 6/4 time and utilize 8th and 16th note triplets. Within these note values, we are playing different groupings of 3, 5, and 7. It’s not easy, but using these combinations can help you so much with your speed and fluidity around the kit.

        And for the final exercise in this series, we play another exercise in 6/4 and utilize 16ths and 16th note triplets. Both of the hands are played together.',
                        'thumbnail' => 'https://img.youtube.com/vi/6QmiAkOTYGM/maxresdefault.jpg',
                        'video_src' => 'https://www.youtube.com/embed/6QmiAkOTYGM',
                        'duration' => 11,
                        'assets' => [
                            [
                                'title' => 'Take\'r For A Rip, Eh?',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/10-take-er-for-a-rip-eh.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Gavin Harrison - The Grooves Of Porcupine Tree',
                'meta_desc' => 'Sign up on this page and you’ll get 8 videos with Gavin Harrison that are normally reserved for Drumeo members.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/og-image.jpg',
                'slug' => 'gavins-grooves/course-index',
                'lessons' => [
                    [
                        'slug' => 'gavins-grooves/course-index/1-intro',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663013265-226b00fc5c84436f5016ff4f351d24bcfbc3298421811facc5fb0e884ae544f4-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239900977',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/2-mother-child-divided',
                        'title' => 'Mother & Child Divided',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663013265-226b00fc5c84436f5016ff4f351d24bcfbc3298421811facc5fb0e884ae544f4-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239901169',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/3-halo',
                        'title' => 'Halo',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663014190-ad790cd826773b2008358bc91ac3ad1770f8e94a124e0d8655ba96b0cde74b12-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239901665',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/4-sound-of-muzak',
                        'title' => 'The Sound Of Muzak',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663014717-dbb3c326fdc75065e420ecf04d8f59aba21bb2c3f1451b42b079a95b528aa3f0-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239901924',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/5-futile',
                        'title' => 'Futile',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663015309-cbf29363ef085e601ddc772eb512d320c5c13cd44a29abae6929888b56f625f3-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239902285',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/6-anesthetize',
                        'title' => 'Anesthetize',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663015884-7fd13b20a200561822ac99fb248b5653dbdbcb366a193a198bb117377f087c16-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239902856',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/7-life',
                        'title' => 'Gavin Harrison & 05Ric - "Life"',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663016429-a46042af7b9272f2730770057f07b55fa367dc5eba8c90279a245aed2ab27761-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239903253',
                        'duration' => 12,
                        'assets' => [
                            [
                                'title' => 'Life',
                                'src' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/life.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'gavins-grooves/course-index/8-conclusion',
                        'title' => 'Conclusion',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/663016828-3d4605b90d40133d5b7d594f7b2ac2c66adeffa4d4a25ee51e8782626e37e494-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/239903696',
                        'duration' => 6,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => '9 FREE PLAY-ALONGS',
                'meta_desc' => 'Add your drumming to nine high-quality drum play-along tracks. (FREE).',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/og-image.jpg',
                'slug' => 'free-playalongs/songs',
                'lessons' => [
                    [
                        'slug' => 'free-playalongs/songs/1',
                        'title' => 'The Check In (Jost Nickel)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/jost-nickel-the-check-in.png',
                        'video_src' => '//player.vimeo.com/video/541721200',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/301539-sheet-image-1619782863.svg',
                                'soundslice' => 'WR3Dc'
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/the-check-in/the-check-in-drums-false-click-false.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/2',
                        'title' => 'Rock Out (Rashid Williams)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Rashid-williams-Rock-out.png',
                        'video_src' => '//player.vimeo.com/video/370373250',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/236722-sheet-image-1573314094.svg',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/rock-out/rock-out-drums-false-click-false.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/rock-out/rock-out-drums-false-click-true.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/3',
                        'title' => 'Funky NASA (Raghav Mehrotra)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Raghav-mehrotra-funky-nasa.png',
                        'video_src' => '//player.vimeo.com/video/371460235',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/236722-sheet-image-1573314094.svg',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/rock-out/rock-out-drums-false-click-false.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/rock-out/rock-out-drums-false-click-true.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/4',
                        'title' => 'Hypnotized (Thomas Pridgen)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/thomas-pridgen-hypnotized.png',
                        'video_src' => '//player.vimeo.com/video/266779491',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/drumeo-pa224-hypnotized.png',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/hypnotized/hypnotized-drums-false-click-false.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/hypnotized/hypnotized-drums-false-click-true.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/5',
                        'title' => 'Drum-E-O (Kaz Rodriguez)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/kaz-rodriguez-drum-e-o.png',
                        'video_src' => '//player.vimeo.com/video/558181220',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/306212-sheet-image-1623079844.svg',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/drum-e-o/drum-e-o-drums-false-click-false.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/drum-e-o/drum-e-o-drums-false-click-true.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/6',
                        'title' => '7/8 Rock (Glen Sobel)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/glen-sobel-7-8-rock.png',
                        'video_src' => '//player.vimeo.com/video/546105932',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-7-8-rock-01.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/3x-Dc/embed/?api=1&amp;scroll_type=2&amp;branding=0'
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/7-8-rock-pa-no-drums-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/7-8-rock-pa-no-drums-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/7',
                        'title' => 'Straight Reggae (Sarah Thawer)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/sarah-thawer-straight-reggae.png',
                        'video_src' => '//player.vimeo.com/video/471541648',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-reggae-02.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/9s-Dc/embed/?api=1&amp;scroll_type=2&amp;branding=0'
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/reggae-straight-pa-no-drums-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/reggae-straight-pa-no-drums-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 (Swung)',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/reggae-swing-pa-no-drums-no-click-1630077317.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 (Swung) With Metronome',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/reggae-swing-pa-no-drums-click-1630077276.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/8',
                        'title' => 'Tony Coleman Shuffle (Tony Coleman)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/tony-coleman-shuffle.png',
                        'video_src' => '//player.vimeo.com/video/342294294',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/226671-sheet-image-1560530045.svg',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/tony-coleman-shuffle/tony-coleman-shuffle-drums-false-click-false.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://s3.amazonaws.com/drumeo/play-along-resources/tony-coleman-shuffle/tony-coleman-shuffle-drums-false-click-true.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-playalongs/songs/9',
                        'title' => 'Just A Second (Todd Sucherman)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/todd-sucherman-just-a-second.png',
                        'video_src' => '//player.vimeo.com/video/534524172',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-just-a-second-01.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/thQDc/embed/?api=1&amp;scroll_type=2&amp;branding=0'
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/just-a-second-pa-no-drums-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Metronome',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/just-a-second-pa-no-drums-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => '9 Metal Play-Alongs',
                'meta_desc' => 'Add your drumming to nine heavy drum play-along tracks. (FREE).',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/share-image.jpg',
                'slug' => 'metal-playalongs/songs',
                'lessons' => [
                    [
                        'slug' => 'metal-playalongs/songs/1',
                        'title' => 'The Marzear Labyrinth (Derek Roddy)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/The+Marzear+Labyrinth.jpg',
                        'video_src' => '//player.vimeo.com/video/201214928',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://dz5i3s4prcfun.cloudfront.net/00-archive/jpegs/drumeo-pa206-the-marzear-labyrinth.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/2',
                        'title' => 'Nightmares (Jared Falk)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Nightmares.jpg',
                        'video_src' => '//player.vimeo.com/video/286086238',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/drumeo-pa231-nightmares.svg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/3',
                        'title' => 'Double Bass (With Alex Rüdinger)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Double+Bass.jpg',
                        'video_src' => '//player.vimeo.com/video/546106139',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-double-bass-01.svg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/4',
                        'title' => 'Basic Metal (Mike Michalkow)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Basic+Metal.jpg',
                        'video_src' => '//player.vimeo.com/video/538801358',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-basic-metal-01.svg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/5',
                        'title' => 'Hypnotized (Thomas Pridgen)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Hypnotized.jpg',
                        'video_src' => '//player.vimeo.com/video/266779491',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/drumeo-pa224-hypnotized.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/6',
                        'title' => 'Resurrection Through Fire (Jason Bittner)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Resurrection+Through+Fire.jpg',
                        'video_src' => '//player.vimeo.com/video/151171143',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/1515589078-drumeo-pa140-resurrection-through-fire.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/7',
                        'title' => 'Opus I Excerpt, No. 5 (Julia Gaeman)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Opus+I+Excerpt%2C+No.5.jpg',
                        'video_src' => '//player.vimeo.com/video/262427768',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/8',
                        'title' => 'Brotherhood Of The Snake (Gene Hoglan)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Brotherhood+Of+The+Snake.jpg',
                        'video_src' => '//player.vimeo.com/video/274582283',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/drumeo-pa225-brotherhood-of-the-snake.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'metal-playalongs/songs/9',
                        'title' => 'Teratogenesis (Ash Pearson)',
                        'desc' => '',
                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Teratogenesis.jpg',
                        'video_src' => '//player.vimeo.com/video/154760938',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Song Chart',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/1515594241-drumeo-pa143-teratogenesis.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Getting Started On The Drums',
                'meta_desc' => 'Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk\'s free video series!',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg',
                'slug' => 'getting-started/lessons',
                'assets' => [
                    [
                        'title' => 'All Course PDFs',
                        'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'getting-started/1-setting-up-your-drums',
                        'title' => 'Setting Up Your Drums',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/481788468-e2ab307642602c8f591214d3f50c15a8f791268676105605927c5f5bd932b7ec-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/100332067',
                        'duration' => 20,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/2-tuning-your-drums',
                        'title' => 'Tuning Your Drums',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469168227-d41168d949f436a688503c73880282804b41bce62adbc5b3ef641eab341ee202-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90129042',
                        'duration' => 40,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/3-holding-your-drumsticks',
                        'title' => 'Holding Your Drumsticks',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469051158-bcdcf0b70b3c56a5e418d027490b82f58ad935e92f87d6f1f76f204643783623-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90056794',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/4-reading-drum-notation',
                        'title' => 'Reading Drum Notation',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469050062-930904bdcfd1f34a6b5d2a0264cfe3a81b7deac917bcf6b785e5dfe66460532a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90056795',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Reading Drum Notation',
                                'src' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/4-reading-drum-notation.jpg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'getting-started/5-basic-counting',
                        'title' => 'Basic Counting',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/91367890',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Basic Counting',
                                'src' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/5-basic-counting.jpg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'getting-started/6-your-first-beat',
                        'title' => 'Your First Drum Beats',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469052552-33deecae0570b09577411a972fa6f80334c930dd68b498e57f1509505b3b3f4b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90056797',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Beat',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/6-playing-your-first-beat.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'getting-started/7-your-first-fill',
                        'title' => 'Your First Drum Fills',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469067095-0284183a7b530d903528db71ba826503cddfe27567da138ac67ff1e29f9f8e21-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068631',
                        'duration' => 11,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Fill',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/7-playing-your-first-fill.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'getting-started/8-using-a-metronome',
                        'title' => 'Using A Metronome',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469065379-b1df7a24a11a3150f8ecb85f6db3f8fdd5d582223be3121de116b464590aab2e-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068632',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/9-your-first-song',
                        'title' => 'Playing Your First Song',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469064749-45eff4eb5b9f1b79db2ad813ae966cd1139460c5fbf0610ae28a277a6a9b1416-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068633',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Song',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/9-playing-your-first-song.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'getting-started/10-practice-routine',
                        'title' => 'Building Your Practice Routine',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469066472-bc5480a2b6ba3652fc1c3c8ebc87096ddbabbe423cf22670c5ea3ab3f1933c27-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068634',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Developing a Practice Routine',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/10-developing-a-practice-routine.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'getting-started/checking-in',
                        'title' => 'Just Checking In',
                        'desc' => '',
                        'thumbnail' => '',
                        'video_src' => '//player.vimeo.com/video/98685191',
                        'duration' => 2,
                        'assets' => [],
                        'one_off' => true,
                    ],
                    [
                        'slug' => 'getting-started/great-news',
                        'title' => 'Great News',
                        'desc' => '',
                        'thumbnail' => '',
                        'video_src' => '//player.vimeo.com/video/98685192',
                        'duration' => 2,
                        'assets' => [],
                        'one_off' => true,
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Grooves Of John Bonham',
                'meta_desc' => 'The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/grooves-of-john-bonham/og-image.jpg',
                'slug' => 'grooves-of-john-bonham/lessons',
                'lessons' => [
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/1',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221063-card-thumbnail-maxres-1551445812',
                        'video_src' => '//player.vimeo.com/video/320570405',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/2',
                        'title' => '"When The Levee Breaks"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221064-card-thumbnail-maxres-1551454221',
                        'video_src' => '//player.vimeo.com/video/320570725',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => '#1',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221110-sheet-image-1551465529.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200371/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/3',
                        'title' => '"Fool In The Rain"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221065-card-thumbnail-maxres-1551454986',
                        'video_src' => '//player.vimeo.com/video/320571012',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => '#2a Hi-Hat Groove',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221111-sheet-image-1551465999.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200372/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => '#2b Ride Groove',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221112-sheet-image-1551466569.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200375/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/4',
                        'title' => 'Bonham Triplets',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221066-card-thumbnail-maxres-1551455602',
                        'video_src' => '//player.vimeo.com/video/320571470',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => '#3',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221113-sheet-image-1551466800.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200376/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/5',
                        'title' => '"Good Times Bad Times"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221067-card-thumbnail-maxres-1551455704',
                        'video_src' => '//player.vimeo.com/video/320571796',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => '#4',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221115-sheet-image-1551466942.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200378/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/6',
                        'title' => '"Black Dog"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221068-card-thumbnail-maxres-1551456070',
                        'video_src' => '//player.vimeo.com/video/320572050',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => '#5',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221116-sheet-image-1551467292.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200380/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/7',
                        'title' => '"Immigrant Song"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221069-card-thumbnail-maxres-1551456169',
                        'video_src' => '//player.vimeo.com/video/320572228',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => '#6',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221117-sheet-image-1551467473.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200381/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/8',
                        'title' => '"Stairway To Heaven"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221070-card-thumbnail-maxres-1551456686',
                        'video_src' => '//player.vimeo.com/video/320572518',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => '#7a Solo Groove',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221118-sheet-image-1551468088.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200384/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => '#7b Fill',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221119-sheet-image-1551468294.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200386/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/9',
                        'title' => '"Rock And Roll"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221071-card-thumbnail-maxres-1551456914',
                        'video_src' => '//player.vimeo.com/video/320573002',
                        'duration' => 16,
                        'assets' => [
                            [
                                'title' => '#8a Intro',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221120-sheet-image-1551470522.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200401/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => '#8b Outro',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221121-sheet-image-1551470787.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200402/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/10',
                        'title' => '"Moby Dick"',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221072-card-thumbnail-maxres-1551457382',
                        'video_src' => '//player.vimeo.com/video/320573882',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => '#9a',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221122-sheet-image-1551471371.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200406/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => '#9b',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/221123-sheet-image-1551471878.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/200408/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'grooves-of-john-bonham/lessons/11',
                        'title' => 'Conclusion & Solo',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/221073-card-thumbnail-maxres-1551458585',
                        'video_src' => '//player.vimeo.com/video/320574354',
                        'duration' => 3,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Hand Technique - The Motions Of Drumming',
                'meta_desc' => 'Learn drumming\'s 3 hand techniques in this FREE series.',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/hand-technique/share-image.jpg',
                'slug' => 'hand-technique/lessons',
                'assets' => [
                    [
                        'title' => 'Lesson Resources',
                        'src' => 'https://dzryyo1we6bm3.cloudfront.net/courses/pdf/dcb-34.pdf',
                        'soundslice' => '',
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'hand-technique/lessons/1',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/623662001-6670b0b644776c95b6ed1ce97c005c22b0fe568ee5225de3d83409d8f04e77b4-d_640',
                        'video_src' => '//player.vimeo.com/video/208363526',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'hand-technique/lessons/2',
                        'title' => 'The Motions In French Grip',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/623668805-0397615e9c33e5e4ae1bb8f7896ec06f02fd171a584d980c9dbda70d6513bac7-d_640',
                        'video_src' => '//player.vimeo.com/video/208364706',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'hand-technique/lessons/3',
                        'title' => 'The Motions In German Grip',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/623675350-f559455aae45948e23f25dc59495f86126ef1cc564e2a7208e1a157e50c58108-d_640',
                        'video_src' => '//player.vimeo.com/video/208370136',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'hand-technique/lessons/4',
                        'title' => 'The Motions In Traditional Grip',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/623682435-7d053de096d78221d9dbce6d036bfc2493a55fd0731408b65745901dd56387d6-d_640',
                        'video_src' => '//player.vimeo.com/video/208375473',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'hand-technique/lessons/5',
                        'title' => 'How To Apply The Motions',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/623694516-8be0d21532e9385c94a633f75f5211f44cd097a3c792108fd2d621fdb54ea8e2-d_640',
                        'video_src' => '//player.vimeo.com/video/208381114',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'hand-technique/lessons/6',
                        'title' => 'Applying The Motions To The Drumset',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/625581492-1d00b9fd5975cc94f21c13baf2208d673b9c57a72f63ec30173fba6efe88ba96-d_640',
                        'video_src' => '//player.vimeo.com/video/208390763',
                        'duration' => 5,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Linear Drumming',
                'meta_desc' => 'In this exclusive video series, you\'ll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!',
                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg',
                'slug' => 'linear-drumming/lessons',
                'lessons' => [
                    [
                        'slug' => 'linear-drumming/1-about',
                        'title' => 'What Is Linear Drumming?',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/560726784-7f2c75c0dbb17e9ae0fceb339df0fd6b681c626b3401fd46d7c9b06dadae617d-d_640',
                        'video_src' => '//player.vimeo.com/video/158554609',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'linear-drumming/2-dance-pop',
                        'title' => 'Dance Pop Grooves',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/560726966-41e3db31ccbccda9d6a259160f07ed51c064dbbfb09a3e56a12e9065b9043655-d_640',
                        'video_src' => '//player.vimeo.com/video/158554566',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Dance Pop Grooves',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/02-dance-pop-grooves.pdf',
                                'soundslice' => '',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'linear-drumming/3-rock-tom',
                        'title' => 'Rock Tom Grooves',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/560727218-21ae1bae198ad6c555b15363f351ba618f2846e2efbdf98a2480cba5ed7648e7-d_640',
                        'video_src' => '//player.vimeo.com/video/158554381',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Rock Tom Grooves',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/03-rock-tom-grooves.pdf',
                                'soundslice' => '',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'linear-drumming/4-gospel',
                        'title' => 'Gospel Grooves',
                        'desc' => '//player.vimeo.com/video/158554374',
                        'thumbnail' => 'https://i.vimeocdn.com/video/560727540-477b10caa006c5bd1c67b666ca5ff8408b56e302acfdeffc32513f649aa716bb-d_640',
                        'video_src' => '//player.vimeo.com/video/158554374',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Gospel Grooves',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/04-gospel-grooves.pdf',
                                'soundslice' => '',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'linear-drumming/5-metal',
                        'title' => 'Metal Fills',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/560727679-c21a30b3084fcaf2a799dbd465d526ed48cdfba97e436f6a209f8bc332e30ca6-d_640',
                        'video_src' => '//player.vimeo.com/video/158554402',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'Metal Fills',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/05-metal-fills.pdf',
                                'soundslice' => '',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'linear-drumming/next-level',
                        'title' => 'Take Your Drumming To The Next Level',
                        'desc' => '',
                        'thumbnail' => '',
                        'video_src' => '//player.vimeo.com/video/158554433',
                        'duration' => 1,
                        'assets' => [],
                        'one_off' => true,
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'The Grooves Of Michael Jackson',
                'meta_desc' => 'In this 10-video series, you’ll learn Michael Jackson’s most iconic drum grooves firsthand from the man who brought them to life in arenas around the world.',
                'meta_img' => 'https://s3.amazonaws.com/drumeoblog/beat/wp-content/uploads/2019/10/24202002/IMG_0237-1-2400x1260.jpg',
                'slug' => 'michael-jackson-grooves/course-index',
                'lessons' => [
                    [
                        'slug' => 'michael-jackson-grooves/course-index/1-intro',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-1.jpg',
                        'video_src' => '//player.vimeo.com/video/280980075',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/2-wannabestartin',
                        'title' => 'Wanna Be Startin\' Somethin\'',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-2.jpg',
                        'video_src' => '//player.vimeo.com/video/280980137',
                        'duration' => 15,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/3-smoothcriminal',
                        'title' => 'Smooth Criminal',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-3.jpg',
                        'video_src' => '//player.vimeo.com/video/280980619',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/4-billiejean',
                        'title' => 'Billie Jean',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-4.jpg',
                        'video_src' => '//player.vimeo.com/video/280980926',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/5-humannature',
                        'title' => 'Human Nature',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-5.jpg',
                        'video_src' => '//player.vimeo.com/video/280981370',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/6-beatit',
                        'title' => 'Beat It',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-6.jpg',
                        'video_src' => '//player.vimeo.com/video/280981718',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/7-threatened',
                        'title' => 'Threatened',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-7.jpg',
                        'video_src' => '//player.vimeo.com/video/280982101',
                        'duration' => 12,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/8-thriller',
                        'title' => 'Thriller',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-8.jpg',
                        'video_src' => '//player.vimeo.com/video/280983066',
                        'duration' => 16,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/9-workingdayandnight',
                        'title' => 'Working Day And Night',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/jonathan-moffett-grooves-9.jpg',
                        'video_src' => '//player.vimeo.com/video/280983690',
                        'duration' => 15,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'michael-jackson-grooves/course-index/10-ontheroad',
                        'title' => 'On The Road With Michael Jackson',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/714610295-2802ea17cef756eee35fc25d8f66b51fd10b556a306dc00c96fe7471b804d24e-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/280984349',
                        'duration' => 13,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Rich Redmond - Must-Know Drum Grooves',
                'meta_desc' => 'Sign up on this page and you’ll get 9 videos with Rich Redmond that are normally reserved for Drumeo members.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/og-image.jpg',
                'slug' => 'must-know-grooves/course-index',
                'lessons' => [
                    [
                        'slug' => 'must-know-grooves/course-index/1-intro',
                        'title' => 'Getting Started',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-getting-started.jpg',
                        'video_src' => '//player.vimeo.com/video/145688805',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/2-shuffle',
                        'title' => 'Shuffle',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-shuffle.jpg',
                        'video_src' => '//player.vimeo.com/video/145688990',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/3-lindybeat',
                        'title' => 'Lindy Beat',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-lindy-beat.jpg',
                        'video_src' => '//player.vimeo.com/video/145688808',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/4-motown',
                        'title' => 'Motown Beat',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-motown-beat.jpg',
                        'video_src' => '//player.vimeo.com/video/145688803',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/5-latin',
                        'title' => 'Latin Beats',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-latin-beats.jpg',
                        'video_src' => '//player.vimeo.com/video/145689024',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/6-vacationrhythms',
                        'title' => 'Vacation Rhythms',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-vacation-rhythms.jpg',
                        'video_src' => '//player.vimeo.com/video/145688809',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/7-secondline',
                        'title' => 'Second Line',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-second-line.jpg',
                        'video_src' => '//player.vimeo.com/video/145688807',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/8-socalpunk',
                        'title' => 'SoCal Punk',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-social-punk.jpg',
                        'video_src' => '//player.vimeo.com/video/145688810',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'must-know-grooves/course-index/9-mozambiquesongo',
                        'title' => 'Mozambique & Songo',
                        'desc' => '',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-mozambique-songo.jpg',
                        'video_src' => '//player.vimeo.com/video/145688811',
                        'duration' => 11,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Rock Drumming Masterclass',
                'meta_desc' => 'The Rock Drumming Masterclass is a 26-week online course with Todd Sucherman.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/og-image.jpg',
                'slug' => '',
                'lessons' => [
                    [
                        'slug' => 'rock-drumming-masterclass/most-underrated-drummer',
                        'title' => 'Most Underated Drummer',
                        'desc' => 'Recently we had Todd Sucherman (drummer for the band Styx, Brian Wilson, Spinal Tap, and more) out to Drumeo to create a very special project that we can\'t wait to share with you on January 1st. During filming one day, the topic of underrated drummers came up in conversation. I\'m sure each one of you has one or two drummers you think don\'t get enough appreciation or recognition from the industry. Today, Todd\'s here to talk about one particular drummer that he thinks deserves a little more credit for his accomplishments.

    Who do you think is an underrated drummer? Why? Leave a comment below. Todd and I want to know!

    - Jared Falk

<div class="text-center mt-8">
    <a class="rounded-md border-2 font-bold border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white py-2 px-4 md:px-10 lg:px-12" href="/rock-drumming-masterclass">Rock Drumming Masterclass</a>
</div>',
                        'thumbnail' => '',
                        'video_src' => 'https://www.youtube.com/embed/Yr8BE1M7qPc?rel=0&amp;showinfo=0',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'rock-drumming-masterclass/most-important-rock-drum-tips',
                        'title' => 'Most Important Tips For Rock Drummers',
                        'desc' => '    Todd Sucherman has been playing with the famous rock band Styx for 23 years, so it\'s safe to say he\'s more than qualified to come up with FIVE essential tips for aspiring rock drummers (or drummers of any genre, to be honest). He\'ll covers topics from certain stick techniques you should be practicing to your general mindset you should have when playing this genre of music.

    If you\'re looking to drastically improve your rock drumming in 2019, stay tuned for a special announcement on January 1st. We can\'t wait to show you what we\'ve been working on with Todd.

    - Jared Falk

<div class="text-center mt-8">
    <a class="rounded-md border-2 font-bold border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white py-2 px-4 md:px-10 lg:px-12" href="/rock-drumming-masterclass">Rock Drumming Masterclass</a>
</div>',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/prelaunch/5-myths.jpg',
                        'video_src' => 'https://www.youtube.com/embed/Xs2nGgnL0Nw?rel=0&amp;showinfo=0',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'rock-drumming-masterclass/epic-drum-video',
                        'title' => 'The Most Epic Drum Video We’ve Ever Made (Todd Sucherman)',
                        'desc' => 'In the most EPIC drum video we\'ve ever filmed, we took two helicopters, a beautiful Pearl kit, and one of the best rock drummers of all time into the mountains of British Columbia - in the pouring rain!

    This video is a tribute to drummers around the world. Drummers are a rare and amazing breed. We dedicate entire rooms of our homes to our passion, we buy vehicles based on how our drums will fit, and we set up our kits in the craziest of situations all because of our LOVE for music.

    We\'re so thankful for the drum companies who supported this ambitious project including <a href="https://pearldrum.com/">Pearl</a>, <a href="https://remo.com/" target="_blank">Remo</a>, <a href="http://www.promark.com/" target="_blank">Pro-Mark</a>, <a href="https://audixusa.com/" target="_blank">Audix</a>, and <a href="https://sabian.com/" target="_blank">Sabian</a>.

    And a huge thank you to Mischa Gelb and <a href="https://www.bchelicopters.com/" target="_blank">BC Helicopters</a> for making this video possible. If you\'d like to follow their incredible adventures (including a helicopter trip around the world), make sure to check out Mischa\'s YouTube channel here: <a href="https://www.youtube.com/user/mischagelb" target="_blank">www.YouTube.com/user/mischagelb</a>.

<div class="text-center mt-8">
    <a class="rounded-md border-2 font-bold border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white py-2 px-4 md:px-10 lg:px-12" href="/rock-drumming-masterclass">Rock Drumming Masterclass</a>
</div>',
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/prelaunch/important-technique.jpg',
                        'video_src' => 'https://www.youtube.com/embed/QUKMr0_hVNg?rel=0&amp;showinfo=0',
                        'duration' => 10,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Anika Nilles - Subdivision Challenge',
                'meta_desc' => 'Sign up on this page and you’ll get 5 videos with Anika Nilles that are normally reserved for Drumeo members.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/og-image.jpg',
                'slug' => 'subdivision-challenge/course-index',
                'lessons' => [
                    [
                        'slug' => 'subdivision-challenge/course-index/1',
                        'title' => 'Quintuplets Workout',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644945826-eae7cd07d676d449046e3ea5e2deed1b00dd90794069f5d315f463921cd74564-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/225583286',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'subdivision-challenge/course-index/2',
                        'title' => 'Septuplets Workout',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644948335-1c4f7dfd71279ac5b4f2862dbd1124d5c556f143ea3efe7473025e13cd25ee49-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/225584307',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'subdivision-challenge/course-index/3',
                        'title' => 'Septuplet Workout Expansion',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644949583-86ae82dd2c0bef44b61159ac941008edce0d0bf934570c8f43163d625a1a04ec-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/225586191',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'subdivision-challenge/course-index/4',
                        'title' => 'Mixed Subdivisions',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644950963-b8652f12e9a8b416115ee1043f0ee48085a60ca25c7e51158ecbfa771add454c-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/225587140',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'subdivision-challenge/course-index/5',
                        'title' => 'How This Is All Applied',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644951839-1bb4e37d007285e90d410f926dd9f205d5a3d3204147ad96f0b17ce5672f961f-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/225588059',
                        'duration' => 12,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'Todd Sucherman - How To Become A  Good Sounding Drummer',
                'meta_desc' => 'Sign up on this page and you’ll get 5 videos with Todd Sucherman that are normally reserved for Drumeo members.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/sucherman-sound/bg.jpg',
                'slug' => 'sucherman-sound/course-index',
                'lessons' => [
                    [
                        'slug' => 'sucherman-sound/course-index/1-good-sounding',
                        'title' => 'What Does It Mean To Be A Good Sounding Drummer',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1040119731-c2dc6efa05d89750fb99f05772fef2a7a56b4e08846d392c0fb979c349206636-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/224954127',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sucherman-sound/course-index/2-hi-hats',
                        'title' => 'The Importance Of The Hi-Hats',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1040120650-4b9321fa37b38916cfe659b79374604ebe0eeff6b50d02f8c9ff4d4c38b468f3-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/224954314',
                        'duration' => 16,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sucherman-sound/course-index/3-bass-snare',
                        'title' => 'Mixing The Bass, Snare And Hats',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1040121560-ee27e9c3cbf6cf975c6445fa1963b3119d9786ff29ece084a06a9b2900d95906-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/224956340',
                        'duration' => 12,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sucherman-sound/course-index/4-elevating-sound',
                        'title' => 'Elevating Your Sound',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644130749-91c4cc54fc3296cddafa470e5b3412c381b6427a0859351aecb65806f9614a40-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/224956736',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sucherman-sound/course-index/5-shift-focus',
                        'title' => 'A Shift In Focus',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/644131239-72ea451a085e9567d60366215bc4305c1a2ff242423dae5bf3b3498fb685d157-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/224957056',
                        'duration' => 11,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'The Ultimate Drumming Toolbox - Getting Started On The Drums',
                'meta_desc' => 'In this free video course, you’ll get the detailed video training you need to set up your drum kit, learn your first drum beats and fills, and play your very first song!',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg',
                'slug' => 'ultimate-toolbox/gsotd',
                'lessons' => [
                    [
                        'slug' => 'ultimate-toolbox/gsotd/1',
                        'title' => 'Setting Up Your Drums',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/481788468-e2ab307642602c8f591214d3f50c15a8f791268676105605927c5f5bd932b7ec-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/100332067',
                        'duration' => 20,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/2',
                        'title' => 'Tuning Your Drums',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469168227-d41168d949f436a688503c73880282804b41bce62adbc5b3ef641eab341ee202-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90129042',
                        'duration' => 40,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/3',
                        'title' => 'Holding Your Drumsticks',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469051158-bcdcf0b70b3c56a5e418d027490b82f58ad935e92f87d6f1f76f204643783623-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90056794',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/4',
                        'title' => 'Reading Drum Notation',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469050062-930904bdcfd1f34a6b5d2a0264cfe3a81b7deac917bcf6b785e5dfe66460532a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90056795',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Reading Drum Notation',
                                'src' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/4-reading-drum-notation.jpg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/5',
                        'title' => 'Basic Counting',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/91367890',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Basic Counting',
                                'src' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/5-basic-counting.jpg',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/6',
                        'title' => 'Your First Drum Beats',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469052552-33deecae0570b09577411a972fa6f80334c930dd68b498e57f1509505b3b3f4b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90056797',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Beat',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/6-playing-your-first-beat.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/7',
                        'title' => 'Your First Drum Fills',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469067095-0284183a7b530d903528db71ba826503cddfe27567da138ac67ff1e29f9f8e21-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068631',
                        'duration' => 11,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Fill',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/7-playing-your-first-fill.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/8',
                        'title' => 'Using A Metronome',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469065379-b1df7a24a11a3150f8ecb85f6db3f8fdd5d582223be3121de116b464590aab2e-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068632',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/9',
                        'title' => 'Playing Your First Song',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469064749-45eff4eb5b9f1b79db2ad813ae966cd1139460c5fbf0610ae28a277a6a9b1416-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068633',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Song',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/9-playing-your-first-song.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/gsotd/10',
                        'title' => 'Building Your Practice Routine',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469066472-bc5480a2b6ba3652fc1c3c8ebc87096ddbabbe423cf22670c5ea3ab3f1933c27-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/90068634',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Developing a Practice Routine',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/10-developing-a-practice-routine.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'The Ultimate Drumming Toolbox - 5 Play Alongs',
                'meta_desc' => 'The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg',
                'slug' => 'ultimate-toolbox/5pa',
                'lessons' => [
                    [
                        'slug' => 'ultimate-toolbox/5pa/1',
                        'title' => 'Eighth Note Rock',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/460798010-b37892e3ec70357cd0f9902725cdba330edd4c533f3ad4b0d4df10d68d14de1a-d_640',
                        'video_src' => '//player.vimeo.com/video/84085314',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/eighth-note-rock.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/eighth-note-rock-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 with click',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/eighth-note-rock-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/5pa/2',
                        'title' => 'Happy Hour',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/460793418-c4cac00025167cd090a51782db07373164b0dd549ace26dd30e222d8f2a4fd7f-d_640',
                        'video_src' => '//player.vimeo.com/video/84082165',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/happy-hour.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/happy-hour-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 with click',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/happy-hour-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/5pa/3',
                        'title' => 'Bossa Nova',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/469179675-82ad83f9ecd4ae8b97645ea1c37c4034c30df5cda4bc4979350949f3d0a11258-d_640',
                        'video_src' => '//player.vimeo.com/video/90152319',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/bossa-nova.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/bossa-nova-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 with click',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/bossa-nova-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/5pa/4',
                        'title' => 'Country Train',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/460801706-c1b2d2bcbaa562b61c4920d519e77bb0377a18e5c63fa573b3067132304b968f-d_640',
                        'video_src' => '//player.vimeo.com/video/84087719',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/country-train.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/country-train-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 with click',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/country-train-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/5pa/5',
                        'title' => 'The Ancient Forest',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/460792882-40214b37f07201e61b443e0497c0daecb067f0fcaa825fe17ffc9dd23f0a020d-d_640',
                        'video_src' => '//player.vimeo.com/video/84081827',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/the-ancient-forest.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/the-ancient-forest-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 with click',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/the-ancient-forest-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'The Ultimate Drumming Toolbox - Bass Drum Bootcamp',
                'meta_desc' => 'Discover powerful techniques that the worlds fastest drummers are using to achieve maximum speed, power, and control!',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg',
                'slug' => 'ultimate-toolbox/bdbc',
                'lessons' => [
                    [
                        'slug' => 'ultimate-toolbox/bdbc/1',
                        'title' => 'The Slide Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468224350-8ddf62e2d85fa0184fd2f9fbbb3bc934a3e391fa18a5081d7273d93a922c6083-d_640',
                        'video_src' => '//player.vimeo.com/video/89463440',
                        'duration' => 60,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-slide-technique.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-slide-technique.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/bdbc/2',
                        'title' => 'The Heel-Toe Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/466887795-041cbe3b0281e34f89d71e308ab681f62eacf14b61d16c63eedb7e544a282df0-d_640',
                        'video_src' => '//player.vimeo.com/video/88432225',
                        'duration' => 55,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-heel-toe-technique.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-heel-toe-technique.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/bdbc/3',
                        'title' => 'The Swivel Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/466686932-1de2b64a078a0c807f3423041290adb5bbed3b89f5dde67ef3a94b9080afbe21-d_640',
                        'video_src' => '//player.vimeo.com/video/88288483',
                        'duration' => 48,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-swivel-technique.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-swivel-technique.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/bdbc/4',
                        'title' => 'The Constant-Release Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/513296207-2dbe056a4adb4245aaa999da6f7b169fad09f5fc8364e1d5d6b659822c54245e-d_640',
                        'video_src' => '//player.vimeo.com/video/123788412',
                        'duration' => 52,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-constant-release-technique.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-constant-release-technique.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/bdbc/5',
                        'title' => 'The Flat Foot Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468377892-aa6914b6db45909c1b9d7376ee57730c611cb0667e3d1b716bfb7d1be4eea510-d_640',
                        'video_src' => '//player.vimeo.com/video/89575436',
                        'duration' => 58,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-flat-foot-technique.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-flat-foot-technique.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/bdbc/6',
                        'title' => 'Single Bass Drum Bootcamp',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/460642069-7ec02f90f4f1aac27bfac4c189f22b6f7b677ae8a368e23477102b8016dc6526-d_640',
                        'video_src' => '//player.vimeo.com/video/83974109',
                        'duration' => 60,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp.zip',
                                'soundslice' => ''
                            ],
                            [
                                'title' => '80 BPM Play-Along',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp-pa-80bpm.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => '120 BPM Play-Along',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp-pa-120bpm.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => '160 BPM Play-Along',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp-pa-160bpm.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/bdbc/7',
                        'title' => 'Double Bass Drum Bootcamp',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/466608062-1fc2a1569c4a22326ecb0bc22d19b6848a0450f1b48a339e8f46dbc891eaf7e0-d_640',
                        'video_src' => '//player.vimeo.com/video/88231176',
                        'duration' => 65,
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3s',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp.zip',
                                'soundslice' => ''
                            ],
                            [
                                'title' => '80 BPM Play-Along',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp-pa-80bpm.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => '120 BPM Play-Along',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp-pa-120bpm.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => '160 BPM Play-Along',
                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp-pa-160bpm.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 1,
                'title' => 'The Ultimate Drumming Toolbox - Fastest Way To Get Faster',
                'meta_desc' => 'The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.',
                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg',
                'slug' => 'ultimate-toolbox/fwtgf',
                'lessons' => [
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/1',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468462591-0591247a658a222a1451ddba9374e9825368731349ef1978c2d4ab94290dcc33-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89637098',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/2',
                        'title' => 'Exercise 1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468462922-4e60de18d43a40d3d449d8b56735e01b60494d619cf2a1bbd422d1c7e35dcdd3-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89637353',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/3',
                        'title' => 'Exercise 2',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468463206-70e2ae1aff12b5b73b2675bdb2f39aa9b47fe4b6b063c16262c84ae7d76d154f-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89637543',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/4',
                        'title' => 'Exercise 3',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468463619-751c666bf20b290baedbd20b81cc5f68e696df01af2e0c790f36b41e2153844c-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89637866',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/5',
                        'title' => 'Exercise 4',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468463970-f53c0f17d09c71453503ab638a3c6708cc424874bce5f877ad9df11ac97fa6c9-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89638178',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/6',
                        'title' => 'Exercise 5',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468463959-b15f743f876736499972705d6fd975620d97ba6e6cc91b2d1648e2962349009c-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89638137',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/7',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468463970-f53c0f17d09c71453503ab638a3c6708cc424874bce5f877ad9df11ac97fa6c9-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89638324',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/8',
                        'title' => 'Exercise 1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468464558-8ab3abdf097c6d07c260fb3a6069f914a26a619b16aff7bf2f8c2105351fdb4b-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89638542',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/9',
                        'title' => 'Exercise 2',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468464697-c789c4f1e95ad173da4eb0acb177c3b8640174230433021132e84e7f27fae524-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89638625',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/10',
                        'title' => 'Exercise 3',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468465312-3bc75a3cb1fff8da83c97c0ad3fa6feeeea7161412bf4a2cd3014b3140c41d25-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89639083',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/11',
                        'title' => 'Exercise 4',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468465007-d931b0fb1564d04666c21897fcfb3258a8f67668f8df2be39ab0ff2086702a32-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89638875',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/12',
                        'title' => 'Exercise 5',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468465317-36b42df8d9585ede4560350d2529469c3fde6d81e6a43558b4d3ae54260a3b01-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89639098',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/13',
                        'title' => 'Introduction',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468465007-d931b0fb1564d04666c21897fcfb3258a8f67668f8df2be39ab0ff2086702a32-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89639076',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/14',
                        'title' => 'Exercise 1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468465837-a713fe204be18020e4dd63d5b70b6554c3b04efdd6443f754f47f9742e58d9b4-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89639473',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/15',
                        'title' => 'Exercise 2',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468465825-1ae84191e678505bb3867eb7d224d1b380c11261d4dd530affce1dc169cd4d46-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89639448',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/16',
                        'title' => 'Exercise 3',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468466472-cafd2faf42e3c0d925a881856a6a012b51cd600e879b82626e3b5da272fc8b3f-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89639941',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/17',
                        'title' => 'Exercise 4',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468466651-c5db0822c030c82859d7c766965e4db86ba37af00c78e52fe25639f5742ae00f-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89640060',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/18',
                        'title' => 'Exercise 5',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468466646-4e47a36cb4b8058d59b98cf9b05d25184d7b00a5913b16fc2575d1a576571582-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89640056',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'ultimate-toolbox/fwtgf/19',
                        'title' => 'Conclusion',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/468466881-30ddd2f68277c803b48b5012f17cba6bf7136c8805b22b6b806f6edf45b1fd56-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/89640228',
                        'duration' => 2,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Getting Started On The Acoustic Guitar',
                'meta_desc' => 'Pick up your guitar and start playing today!',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/og-image.jpg',
                'slug' => 'free-acoustic-guitar-lessons/lessons',
                'assets' => [
                    [
                        'title' => 'Course Resources',
                        'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/getting-started-on-the-acoustic-guitar.zip',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'free-acoustic-guitar-lessons/lessons/1',
                        'title' => 'Becoming Familiar With Your Acoustic Guitar',
                        'desc' => 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She’ll go over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-01.jpg',
                        'video_src' => '//player.vimeo.com/video/531010732',
                        'duration' => 9,
                        'assets' => [],
                        'assignments' => [
                            [
                                'title' => 'Hold your guitar comfortably',
                            ],
                            [
                                'title' => 'Tune your guitar',
                            ],
                            [
                                'title' => 'Memorize the strings',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-acoustic-guitar-lessons/lessons/2',
                        'title' => 'Sounding Good',
                        'desc' => 'In this lesson, you’ll learn your first chord, the E minor chord, and play each string one by one to make sure it sounds clean and clear. You’ll learn how to apply the right amount of pressure to the string to prevent string-buzz  without straining your hand. Then you’ll move onto your next chord, the C major7 chord, and practice playing each string.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-02.jpg',
                        'video_src' => '//player.vimeo.com/video/531010850',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Chord Charts',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/strumming-basics.pdf',
                                'soundslice' => ''
                            ],
                        ],
                        'assignments' => [
                            [
                                'title' => 'Go through each chord string by string',
                            ],
                            [
                                'title' => 'Play each chord back to back',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-acoustic-guitar-lessons/lessons/3',
                        'title' => 'Strumming Basics',
                        'desc' => 'Learn the correct motion of your wrist to strum the guitar. You’ll go over downstrokes, upstrokes, and a bonus strumming pattern if you’re feeling up for it.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-03.jpg',
                        'video_src' => '//player.vimeo.com/video/531010974',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Chord Charts',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/strumming-basics.pdf',
                                'soundslice' => ''
                            ],
                        ],
                        'assignments' => [
                            [
                                'title' => 'Practice downstrokes',
                            ],
                            [
                                'title' => 'Practice upstrokes',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-acoustic-guitar-lessons/lessons/4',
                        'title' => 'Start Making Music',
                        'desc' => 'Ayla teaches you how to play five more essential chords every guitar player should know. You’ll learn a simplified and full version of each chord. The chords are C major, Dsus2, D major, G major, full G major. Once you have these chords under your belt, you can play hundreds and hundreds of your favorite songs.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-04.jpg',
                        'video_src' => '//player.vimeo.com/video/531011075',
                        'duration' => 11,
                        'assets' => [
                            [
                                'title' => 'Chord Charts',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/strumming-basics.pdf',
                                'soundslice' => ''
                            ],
                        ],
                        'assignments' => [
                            [
                                'title' => 'Play each chord shape one at a time',
                            ],
                            [
                                'title' => 'Get comfortable switching chords',
                            ],
                            [
                                'title' => 'Learn the simplified chords then learn the full chords',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-acoustic-guitar-lessons/lessons/5',
                        'title' => 'Play a Song',
                        'desc' => 'Now that we know a handful of chords, what do we do with them? You’ll learn how to put the chords together in a progression to play a song. We’ll recap on what your strumming hand will be doing during the song and play in time to the right beat of the backing track. We’ll switch different strumming patterns to play along with the backing track.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-05.jpg',
                        'video_src' => '//player.vimeo.com/video/531040914',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Chord Charts',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/play-a-song.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/play-a-song.mp3',
                                'soundslice' => ''
                            ],
                        ],
                        'assignments' => [
                            [
                                'title' => 'Play along to the track with the first strumming pattern',
                            ],
                            [
                                'title' => 'Play along to the track with the second strumming pattern',
                            ],
                            [
                                'title' => 'Play along to the track with the bonus strumming pattern (OPTIONAL)',
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-acoustic-guitar-lessons/lessons/6',
                        'title' => 'Pave Your Own Path',
                        'desc' => 'This is a quick recap of how much you’ve accomplished in just a few short lessons. You already know WAY more than when you began and can play a bunch of songs with the chords and strumming patterns you learned. Even though your guitar journey is just beginning, make sure to keep practicing at your own pace until you feel comfortable and ready to move onto the next steps of your journey.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-06.jpg',
                        'video_src' => '//player.vimeo.com/video/531041006',
                        'duration' => 2,
                        'assets' => [],
                    ],
                ],
            ],
//            [
//                'brand_id' => 3,
//                'title' => '',
//                'meta_desc' => '',
//                'meta_img' => '',
//                'slug' => '',
//                'lessons' => [
//                    [
//                        'slug' => '',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                ],
//            ],
        ];

        Leadgen::truncate();
        LeadgenLesson::truncate();
        LeadgenLessonAsset::truncate();

        foreach($leadgens as $leadgen){
            $newLeadgen = Leadgen::create([
                'brand_id' => $leadgen['brand_id'],
                'title' => $leadgen['title'],
                'meta_desc' => $leadgen['meta_desc'],
                'meta_img' => $leadgen['meta_img'],
                'slug' => $leadgen['slug'],
            ]);

            if(!empty($leadgen['assets']) && count($leadgen['assets']) > 0){
                foreach($leadgen['assets'] as $asset){
                    LeadgenLessonAsset::create([
                        'leadgen_id' => $newLeadgen->id,
                        'title' => $asset['title'],
                        'src' => $asset['src'],
                        'soundslice' => $asset['soundslice'] ??  null,
                    ]);
                }
            }

            foreach($leadgen['lessons'] as $key => $lesson){
                $newLesson = LeadgenLesson::create([
                    'leadgen_id' => $newLeadgen->id,
                    'title' => $lesson['title'],
                    'desc' => !empty($lesson['desc']) ? $lesson['desc'] : null,
                    'thumbnail' => $lesson['thumbnail'],
                    'video_src' => $lesson['video_src'],
                    'slug' => $lesson['slug'],
                    'duration' => $lesson['duration'],
                    'display_order' => $key + 1,
                    'one_off' => $lesson['one_off'] ?? false,
                ]);

                if(count($lesson['assets']) > 0){
                    foreach($lesson['assets'] as $asset){
                        LeadgenLessonAsset::create([
                            'leadgen_lesson_id' => $newLesson->id,
                            'title' => $asset['title'],
                            'src' => $asset['src'],
                            'soundslice' => $asset['soundslice'] ??  null,
                        ]);
                    }
                }

                if(!empty($lesson['assignments']) && count($lesson['assignments']) > 0){
                    foreach($lesson['assignments'] as $asset){
                        LeadgenLessonAssignment::create([
                            'leadgen_lesson_id' => $newLesson->id,
                            'title' => $asset['title'],
                        ]);
                    }
                }
            }
        }
    }
}
