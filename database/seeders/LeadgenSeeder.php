<?php

namespace Database\Seeders;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
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
                                'soundslice' => '3x-Dc'
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
                                'soundslice' => '9s-Dc'
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
                                'soundslice' => 'thQDc'
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
//            [
//                'brand_id' => 1,
//                'title' => '9 Metal Play-Alongs',
//                'meta_desc' => 'Add your drumming to nine heavy drum play-along tracks. (FREE).',
//                'meta_img' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/share-image.jpg',
//                'slug' => 'metal-playalongs/songs',
//                'lessons' => [
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => 'The Marzear Labyrinth (Derek Roddy)',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '//player.vimeo.com/video/201214928',
//                        'duration' => 5,
//                        'assets' => [
//                            [
//                                'title' => 'Song Chart',
//                                'src' => 'https://dz5i3s4prcfun.cloudfront.net/00-archive/jpegs/drumeo-pa206-the-marzear-labyrinth.png',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/2',
//                        'title' => 'Nightmares (Jared Falk)',
//                        'desc' => '',
//                        'thumbnail' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Nightmares.jpg',
//                        'video_src' => '',
//                        'duration' => 4,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                    [
//                        'slug' => 'metal-playalongs/songs/1',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [],
//                    ],
//                ],
//            ],
//            [
//                'brand_id' => 1,
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
//            [
//                'brand_id' => 1,
//                'title' => 'Getting Started On The Drums',
//                'meta_desc' => 'Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk\'s free video series!',
//                'meta_img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg',
//                'slug' => 'getting-started/lessons',
//                'lessons' => [
//                    [
//                        'slug' => 'getting-started/1-setting-up-your-drums',
//                        'title' => 'Setting Up Your Drums',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '//player.vimeo.com/video/100332067',
//                        'duration' => 20,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/2-tuning-your-drums',
//                        'title' => 'Tuning Your Drums',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469168227-d41168d949f436a688503c73880282804b41bce62adbc5b3ef641eab341ee202-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90129042',
//                        'duration' => 40,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/3-holding-your-drumsticks',
//                        'title' => 'Holding Your Drumsticks',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469051158-bcdcf0b70b3c56a5e418d027490b82f58ad935e92f87d6f1f76f204643783623-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90056794',
//                        'duration' => 6,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/4-reading-drum-notation',
//                        'title' => 'Reading Drum Notation',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469050062-930904bdcfd1f34a6b5d2a0264cfe3a81b7deac917bcf6b785e5dfe66460532a-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90056795',
//                        'duration' => 5,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                            [
//                                'title' => 'Reading Drum Notation',
//                                'src' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/4-reading-drum-notation.jpg',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/5-basic-counting',
//                        'title' => 'Basic Counting',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/91367890',
//                        'duration' => 9,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                            [
//                                'title' => 'Basic Counting',
//                                'src' => 'https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/5-basic-counting.jpg',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/6-your-first-beat',
//                        'title' => 'Your First Drum Beats',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469052552-33deecae0570b09577411a972fa6f80334c930dd68b498e57f1509505b3b3f4b-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90056797',
//                        'duration' => 8,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                            [
//                                'title' => 'Playing Your First Beat',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/6-playing-your-first-beat.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/7-your-first-fill',
//                        'title' => 'Your First Drum Fills',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469067095-0284183a7b530d903528db71ba826503cddfe27567da138ac67ff1e29f9f8e21-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90068631',
//                        'duration' => 11,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                            [
//                                'title' => 'Playing Your First Fill',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/7-playing-your-first-fill.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/8-using-a-metronome',
//                        'title' => 'Using A Metronome',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469065379-b1df7a24a11a3150f8ecb85f6db3f8fdd5d582223be3121de116b464590aab2e-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90068632',
//                        'duration' => 7,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/9-your-first-song',
//                        'title' => 'Playing Your First Song',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469064749-45eff4eb5b9f1b79db2ad813ae966cd1139460c5fbf0610ae28a277a6a9b1416-d?mw=1000&mh=563',
//                        'video_src' => '//player.vimeo.com/video/90068633',
//                        'duration' => 5,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                            [
//                                'title' => 'Playing Your First Song',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/9-playing-your-first-song.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => 'getting-started/10-practice-routine',
//                        'title' => 'Building Your Practice Routine',
//                        'desc' => '',
//                        'thumbnail' => 'https://i.vimeocdn.com/video/469066472-bc5480a2b6ba3652fc1c3c8ebc87096ddbabbe423cf22670c5ea3ab3f1933c27-d?mw=1000&mh=563',
//                        'video_src' => '',
//                        'duration' => 8,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                            [
//                                'title' => 'Developing a Practice Routine',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/10-developing-a-practice-routine.pdf',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => '',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => '',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
//                    ],
//                    [
//                        'slug' => '',
//                        'title' => '',
//                        'desc' => '',
//                        'thumbnail' => '',
//                        'video_src' => '',
//                        'duration' => 1,
//                        'assets' => [
//                            [
//                                'title' => 'All Course PDFs',
//                                'src' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip',
//                                'soundslice' => ''
//                            ],
//                        ],
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
                    'one_off' => !empty($lesson['one_off']) ? $lesson['one_off'] : false,
                ]);

                if(count($lesson['assets']) > 0){
                    foreach($lesson['assets'] as $asset){
                        LeadgenLessonAsset::create([
                            'leadgen_lesson_id' => $newLesson->id,
                            'title' => $asset['title'],
                            'src' => $asset['src'],
                            'soundslice' => !empty($asset['soundslice']) ? $asset['soundslice'] : null,
                        ]);
                    }
                }
            }
        }
    }
}
