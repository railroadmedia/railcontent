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
                                'title' => 'How to practice',
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
                                'soundslice' => 'https://www.soundslice.com/slices/WR3Dc/embed/?api=1&amp;scroll_type=2&amp;branding=0'
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
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/236563-sheet-image-1573086392.svg',
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
                        'desc' => '',
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
                        'thumbnail' => 'https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/prelaunch/5-myths.jpg',
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
                                'title' => 'PDF',
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
                                'title' => 'PDF',
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
                                'title' => 'PDF',
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
                                'title' => 'PDF',
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
                                'title' => 'PDF',
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
                                'title' => 'PDF',
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
                                'title' => 'PDF',
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
            [
                'brand_id' => 3,
                'title' => 'Getting Started On The Electric Guitar',
                'meta_desc' => 'Pick up your guitar and start playing today!',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/og-image.jpg',
                'slug' => 'free-electric-guitar-lessons/lessons',
                'assets' => [
                    [
                        'title' => 'Course Resources',
                        'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/free-electric-guitar-lessons.zip',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'free-electric-guitar-lessons/lessons/1',
                        'title' => 'Electric 101',
                        'desc' => 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-01.jpg',
                        'video_src' => '//player.vimeo.com/video/519278952',
                        'duration' => 9,
                        'assignments' => [
                            [
                                'title' => 'Get comfortable with the guitar in your lap',
                            ],
                            [
                                'title' => 'Tune your guitar',
                            ],
                            [
                                'title' => 'Go through each string one by one and say their name out loud',
                            ],
                        ],
                        'assets' => [],
                    ],
                    [
                        'slug' => 'free-electric-guitar-lessons/lessons/2',
                        'title' => 'Sounding Good',
                        'desc' => 'Plug in your guitar and start exploring the tone of your guitar through the different knobs and switches. Ayla explains how finding your tone can come from playing around with your guitar and amplifier settings to find what you like the most. You’ll also play your first chord, E Minor.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-02.jpg',
                        'video_src' => '//player.vimeo.com/video/519279105',
                        'duration' => 9,
                        'assignments' => [
                            [
                                'title' => 'Spend time exploring your guitar',
                            ],
                            [
                                'title' => 'Play the E minor chord cleanly',
                            ],
                            [
                                'title' => 'Play the E minor chord one string at a time',
                            ],
                        ],
                        'assets' => [],
                    ],
                    [
                        'slug' => 'free-electric-guitar-lessons/lessons/3',
                        'title' => 'Strumming Basics',
                        'desc' => 'Learn the correct motion of your wrist to strum the guitar. You’ll go over downstrokes in a whole note and quarter note pattern and then add in upstrokes. Play another new chord shape, the A Minor chord.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-03.jpg',
                        'video_src' => '//player.vimeo.com/video/519279207',
                        'duration' => 9,
                        'assignments' => [
                            [
                                'title' => 'Practice downstrokes',
                            ],
                            [
                                'title' => 'Practice upstrokes',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/strumming-basics.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-electric-guitar-lessons/lessons/4',
                        'title' => 'Start Making Music',
                        'desc' => 'Now it’s time to learn four new chords: the G Major special chord, C Major special, D Major chord, and G power chord. You’ll learn how the chords can be played together in a chord progression and how to create your own chord progression with these chords.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-04.jpg',
                        'video_src' => '//player.vimeo.com/video/519279301',
                        'duration' => 11,
                        'assignments' => [
                            [
                                'title' => 'Play through each chord comfortably',
                            ],
                            [
                                'title' => 'Use these chords to play a chord progression',
                            ],
                            [
                                'title' => 'Create your OWN progression',
                            ],
                        ],
                        'assets' => [],
                    ],
                    [
                        'slug' => 'free-electric-guitar-lessons/lessons/5',
                        'title' => 'Play a Song',
                        'desc' => 'It’s the moment you’ve been waiting for! Put together everything you’ve learned to play “Aint No Sunshine.” You’ll be playing two chords for two bars each as well as an easy lead guitar line.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-05.jpg',
                        'video_src' => '//player.vimeo.com/video/531040914',
                        'duration' => 8,
                        'assignments' => [
                            [
                                'title' => 'Download the track and play along',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/play-along-no-guitar.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/play-along-with-guitar.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'free-electric-guitar-lessons/lessons/6',
                        'title' => 'Pave Your Own Path',
                        'desc' => 'Here’s a quick recap of how much you’ve accomplished in just a few short lessons. You already know way more than when you began and can play hundreds of songs with the chords and strumming patterns you learned. Even though your guitar journey is just beginning, make sure to keep practicing at your own pace until you feel comfortable and ready to move onto the next steps of your journey.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-06.jpg',
                        'video_src' => '//player.vimeo.com/video/519279477',
                        'duration' => 2,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Guitar Chords for Hit Songs',
                'meta_desc' => 'Gain the skills to play guitar chords used in thousands of hit songs with Ayla Tesler-Mabe.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/fb-share-image.jpg',
                'slug' => 'chords-for-hit-songs/lessons',
                'lessons' => [
                    [
                        'slug' => 'chords-for-hit-songs/lessons/1',
                        'title' => 'Meet your instructor Ayla',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1540842009-552c59e720c8073bc3ebd61b5b314a1c2540ae1eb8e700eb69e308a85fff1a49-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/767472595',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chords-for-hit-songs/lessons/2',
                        'title' => 'Master G and Em guitar chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.ytimg.com/vi_webp/loHMELy5o18/maxresdefault.webp',
                        'video_src' => '//player.vimeo.com/video/768670165',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chords-for-hit-songs/lessons/3',
                        'title' => 'Link Em and C chords together',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1506332098-fd854496821e35a9d8be15a757df7ba8acda9180adb550b6fa35f8d299e88164-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/747766620',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chords-for-hit-songs/lessons/4',
                        'title' => 'Switch between chords C and D',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1506332274-205ed5d0c3036afcd11585649df1339a79706fd1f590ec9a5573dede5119f0e7-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/748994985',
                        'duration' => 14,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chords-for-hit-songs/lessons/5',
                        'title' => 'Nail down the D and G chord transition',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1511650271-4937cec726d4692df296826f8c4de1480d9910ac9c3f2bab4048d4f10adad867-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/751835669',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chords-for-hit-songs/lessons/6',
                        'title' => 'Play these four chords altogether',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1516159925-b4d1b05c63f5463ea705031b8881abe2ffd3c88aac94274096f325678d7f2ae2-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/754484207',
                        'duration' => 10,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => '2 Simple Guitar Tricks',
                'meta_desc' => 'How to use vibrato & palm muting to unlock new possibilities on the guitar.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/og-image.jpg',
                'slug' => 'guitar-tricks/your-videos',
                'lessons' => [
                    [
                        'slug' => 'guitar-tricks/your-videos/1-intro',
                        'title' => 'Introduction',
                        'desc' => '**Thank goodness you’re here! We have a mission.**

    You’ve been learning to play guitar, and now your band has to sell-out in order to afford some new gear.

    We’ve got two things to do:
      1. Sell Trucks
      2. Sell Shampoo

    But first we’ll need to learn some guitar techniques to create the ultimate sales jingles.

    Today we’ll learn to use **vibrato** and **palm muting** in a musical way to get those trucks off the lot and the shampoo off the shelves.

    Onwards, to vibrato.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/997054724-4d463ff2db28c0ea62592effdb7f09a1df500854a839741b2a5caacecae484f6-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/476482334',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'guitar-tricks/your-videos/2-vibrato',
                        'title' => 'Skill #1 - Vibrato',
                        'desc' => '**Skill 1: Vibrato**

Vibrato is your new secret weapon. It’s going to be unique to you, and you need to lovingly hone your skills with it over time.

But we don’t have that kind of time.

We’ve got a commercial soundtrack to add audio to!

Here’s your quick reference guide to vibrato:
      1. Grab a guitar
      2. Put your fingers on the strings
      3. Hit a note
      4. Shake the note (from the wrist)

We’re ready to go.

Add some delay and reverb to your guitar sound if you have it, and let’s go make this commercial.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/997055252-6a79e3c18f41a2299a119f47d4cdd239280dfaaf6c0a60c358aa47f2542c3c2c-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/476482371',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Playthrough MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-Playthrough.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Full Ad MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-FullAd.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Sheet Music PDF',
                                'src' => 'https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-SheetMusic.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'guitar-tricks/your-videos/3-shampoo',
                        'title' => 'Shampoo Jingle',
                        'desc' => '**Mission 1: Shampoo Ad Performance**

This is it! The moment you’ve been waiting for -- all of your hard work pays off and the advertisement comes to life.

Use the technique we studied in painstaking depth in the last video, and put it to work now. Your wallet depends on it!

**Quick Tip:** The note you are performing the vibrato on is on the 11th fret of the G string. Which one is the G string? The 3rd from the bottom!

Once you’ve locked in the best vibrato performance of your life carry on to the next video to learn trick #2.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/997056488-b8a318adb6981c3394bb2cc8ca65108ddafb390dec5f63c2fb4c058b0d7a97c8-d?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/476482393',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'guitar-tricks/your-videos/4-palm-muting',
                        'title' => 'Skill #2 - Palm Muting',
                        'desc' => '**Skill 2: Palm Muting**

Palm muting is a cross-genre skill, but today we need you to put it to work in a country themed truck commercial. To get yourself in the mood for this skill you’ll need to imagine a dusty porch, a rocking chair, and some tumbleweeds rolling across your homestead.

Y’all ready?
      1. Learn the E Major Chord
      2. Practice the placement of your palm for ultimate chunky muting
      3. Practice alternating between strumming and palm muting
      4. Wait for checks in the mail

When you’re ready to perform, it’s time to make the jingle:
      1. Download the full truck ad MP3 to hear what the jingle track sounds like with guitar.
      2. Download the Playthrough MP3 where YOU will play the guitar part.
      3. Click through to the <a href="/guitar-tricks/your-videos/5-truck">next video</a> to see the advertisement come to life!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/997057305-44a6271229a63cf48cabd949ec2d8edd6d7bbb4af54f38c38236b0fc9f55e80f-d?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/476482409',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'Playthrough MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-Playthrough.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Full Ad MP3',
                                'src' => 'https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-FullAd.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Sheet Music PDF',
                                'src' => 'https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-SheetMusic.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'guitar-tricks/your-videos/5-truck',
                        'title' => 'Truck Jingle',
                        'desc' => '**Alright Partner,**

Grab your boots, your cowboy hat, and your chaps, because we’re about to pull a comically large trailer full of hay bales off the ranch with a Truckeo truck.

Let’s get on the road.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/997057977-34a12c51aaa79cda646d8186793fcf677beb1610e4801404fc2e49247f4221d2-d?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/476482485',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'guitar-tricks/your-videos/6-whats-next',
                        'title' => 'What’s Next...',
                        'desc' => '**Mission Complete. You’ve done it!**

You’ve learned vibrato & palm muting.
You’ve sold shampoo & trucks.

But you know there’s more…

So if you’ve enjoyed this journey, then check out Rob’s FULL guitar course, GuitarQuest.

Take the skills you’ve just learned, and add to them as you:
 • Join a band
 • Realize you should probably know how to play guitar if you’re going to be the guitarist in the band
 • Play your first show at an empty bar gig
 • Develop your musical career
 • Sell out!

Claim your exclusive GuitarQuest discount below, and continue the Quest today.

<a href="/guitar-quest-discount-tricks">www.Guitareo.com/guitar-quest-discount-tricks</a>',
                        'thumbnail' => 'https://i.vimeocdn.com/video/997058436-babe1561549ca8e8b548cf70d98ff35cc84abc56ad6be9bfa00e911ffb0394d2-d?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/476482505',
                        'duration' => 1,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Solo In An Hour',
                'meta_desc' => 'Play your first solo in less than 60 minutes.',
                'meta_img' => 'https://guitareo.s3.amazonaws.com/lead-gen/solo-in-an-hour/og-image.jpg',
                'slug' => 'solo-in-an-hour/lessons',
                'lessons' => [
                    [
                        'slug' => 'solo-in-an-hour/lessons/1',
                        'title' => 'Yes, You Can Solo In An Hour!',
                        'desc' => 'Soloing doesn\'t need to be scary! In this course, Ayla will walk you through a few simple steps to have you soloing in under an hour!

The sooner you start to learn these skills, the sooner you’ll be able to express yourself and understand the instrument better.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1301279869-7bd9d86ad2f6e5b64479fc42feeff3f1337f412ce97a66145?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/552497276',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'solo-in-an-hour/lessons/2',
                        'title' => 'The Most Important Scale For Soloing',
                        'desc' => ' In this lesson, Ayla’s going to show you the most important scale for learning how to solo.

With even just a few of these notes, you’ll see how quickly it is to solo over all types of different music.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1301279139-beeb14b2d730ba66abb4126de072ea23de0c18c9805e0ca24?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/551517629',
                        'duration' => 7,
                        'assignments' => [
                            [
                                'title' => 'Practice With A Jam Track',
                                'subtitle' => 'Use Soundslice to work on the exercises from this lesson in a musical setting.',
                                'soundslice' => 'https://www.soundslice.com/slices/zwTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'Jam Track',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'solo-in-an-hour/lessons/3',
                        'title' => 'What Makes A Good Solo?',
                        'desc' => 'Now that you’ve got the most important scale for soloing in your back pocket, it’s time to ask the serious question - what makes a good solo?

In this lesson, we’re going to dive into some classic guitar solos and uncover the secrets of what makes them so great.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/3-what-makes-a-good-solo.png',
                        'video_src' => '//player.vimeo.com/video/551517661',
                        'duration' => 10,
                        'assignments' => [
                            [
                                'title' => 'Explore with the minor pentatonic',
                                'subtitle' => 'Play the minor pentatonic scale over the jam track and see what happens when you try to play different melodies over it.',
                                'soundslice' => 'https://www.soundslice.com/slices/zwTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'Jam Track',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'solo-in-an-hour/lessons/4',
                        'title' => 'Building A Lick Vocabulary',
                        'desc' => 'Now that you’ve gotten comfortable with the minor pentatonic scale, it’s time to start exploring and discovering your own melodies.

With these 3 boxed and ready licks, you’ll start to build momentum towards creating your very own solo.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/4-building-lick-library.png',
                        'video_src' => '//player.vimeo.com/video/551517691',
                        'duration' => 1,
                        'assignments' => [
                            [
                                'title' => 'Build a lick vocabulary',
                                'subtitle' => 'Play each lick on their own. Play each lick to the backing track. Play each lick to the backing track but try adding some extra notes.',
                                'soundslice' => 'https://www.soundslice.com/slices/zwTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => 'Lick #1',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303809-sheet-image-1621355502.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/HzTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => 'Lick #2',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303810-sheet-image-1621355918.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/TzTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                            [
                                'title' => 'Lick #3',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303811-sheet-image-1621355953.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/GzTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'Sheet Music',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303808-resource-1621447122.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'solo-in-an-hour/lessons/5',
                        'title' => 'Playing Your First Solo',
                        'desc' => 'It’s time to take the fragments of licks that you’ve learned and tie them all together to create your very first solo!

This is what we’ve been working towards, and here we are. All in less than an hour!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1301277567-c7534c605249a9a84856d69ca7222a8a9bb5dd3b1e066643c?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/551517718',
                        'duration' => 8,
                        'assignments' => [
                            [
                                'title' => 'Getting some inspiration',
                                'subtitle' => 'Take everything you learned so far and practice soloing over the jam track.',
                                'soundslice' => 'https://www.soundslice.com/slices/zwTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'Jam Track',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'solo-in-an-hour/lessons/6',
                        'title' => 'What About Soloing In Other Keys?',
                        'desc' => 'In case you haven’t realized... not all music is in the same key.

But once you know how to solo in one key, you’ll know how to solo in any key. Ayla will show you how.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1301276875-aabf62485e6cd3b785ee36d6f1a797bd74d9b1f60b9ddad48?mw=1000&mh=562',
                        'video_src' => '//player.vimeo.com/video/551517736',
                        'duration' => 5,
                        'assignments' => [
                            [
                                'title' => 'Soloing in different keys',
                                'subtitle' => 'Apply everything you learned so far about soloing to these new keys.',
                                'soundslice' => 'https://www.soundslice.com/slices/1HTDc/embed/?api=1&amp;scroll_type=2&amp;branding=0',
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'Jam Track - Key of C',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track - Key of E',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/303787-resource-1621453625.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'solo-in-an-hour/lessons/7',
                        'title' => 'Where To Go From Here',
                        'desc' => 'Thank you so much, and congratulations on learning to Solo In An Hour!

In this last video, Ayla will show you the techniques that separate a good guitar player from a great guitar player and will help you find your own artistic identity on the guitar.

And now that you’re well on your way, you might be wondering where do you go from here?

Well, we’d love to show you!

So if you enjoyed this series, come and check out <a href="/trial" target="_blank">a 7-day free trial</a> to Guitareo and keep learning from Ayla.',
                        'thumbnail' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/7-where-to-go.png',
                        'video_src' => '//player.vimeo.com/video/552498302',
                        'duration' => 6,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Acoustic Guitar Jumpstart',
                'meta_desc' => 'Sign up on this page and you\'ll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.',
                'meta_img' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg',
                'slug' => 'acoustic-guitar-jumpstart/course-index',
                'assets' => [
                    [
                        'title' => 'Course Resources',
                        'src' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/acoustic-guitar-jump-start.pdf',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/1',
                        'title' => 'Intro',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737347927-166fded238067fc2a7d6aa90afe324b554e915a363323dac7e7af24088d6a5e1-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299263691',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/2',
                        'title' => 'Tuning',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737351519-edb6fe14faf06d481ce60340492a4660f73710f0e560fe8823881435e70593f4-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299266556',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/3',
                        'title' => 'Strumming',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737353109-d7bce4b404daad0181add03b7e6a816d89bfa2f7f39bf484cfcb9c9625398107-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299267918',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/4',
                        'title' => 'Clean Chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737358341-89fed9172f16b88c85ee9363bec9ee5f252d903e4c803f0c8f96c6c7e61dc29a-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299271710',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/5',
                        'title' => 'Changing Chords Smoothly',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737361727-b7002ed2a132f4e6138eec3b90a47314ca7d82d31a24908b40c9e13330b07721-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299274819',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/6',
                        'title' => 'Learning Songs',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737367207-d7dbd393d9685a942edb102941f0a8818ba52f23a8ade866325b1c0e0283d6db-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299279143',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Full Speed',
                                'src' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/jambalaya.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Slow Speed',
                                'src' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/jambalaya-slow.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/7',
                        'title' => 'Music Theory',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737368212-33be88307072a4bca4a01b530a7f00ac433097e6ea49da74bbf90d3fc9340fe6-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299279896',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'acoustic-guitar-jumpstart/course-index/8',
                        'title' => 'What To Do Next',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/737368608-605f4aa55b2fbd21dc573f4dc9e5f0e90f4e0f15f5171c0916b4d1b430f737ab-d?mw=1200&mh=675',
                        'video_src' => '//player.vimeo.com/video/299280602',
                        'duration' => 3,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Starter Kit - Guitar Fundamentals',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'starter-kit/lessons/fundamentals',
                'lessons' => [
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571188524-98c535b638996563106961fda5ff9e7ee3865921ab525e814acae6f434acdeba-d?mw=1000&mh=56',
                        'video_src' => '//player.vimeo.com/video/166972298',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/2',
                        'title' => 'Parts Of The Acoustic Guitar',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571218190-fb3ecc2a5e81f487639300198f87de642e67edcba794bf7207d4b794d8b8847f-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/166972304',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/3',
                        'title' => 'Parts Of The Electric Guitar',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571233289-a77ed408eb0822dfd011ea13d86936f26f498ae3e90c56d8c1ede089cba7ee8b-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/166972302',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/4',
                        'title' => 'How To Hold The Guitar',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571218082-55852ebead9fe86fb81958eecc5528408c3cf2a3a40ff207c98e10ef4dae866a-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/166972303',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/5',
                        'title' => 'Numbering Systems',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571209737-9e4e24322d0b19fa74b699abb2081f6bc14a749020dbac34b9da30cdd1c89b92-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/166972299',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/6',
                        'title' => 'Names Of The Open Strings',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571204819-c37cf7a6891d853c7f55017e3445148e0b14b46c34fec46847a3d08ac42fe3b0-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/166972300',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/fundamentals/7',
                        'title' => 'Series Review',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571200203-8fe04f6092b3012d2776866063d57319e03b7e8968945202f9edfe08a440bd81-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/166972305',
                        'duration' => 1,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Starter Kit - Open Chords',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'starter-kit/lessons/open-chords',
                'lessons' => [
                    [
                        'slug' => 'starter-kit/lessons/open-chords/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/589593047-4a148264b860a4e19d36f24ad68b407f7321b5433591c7db0a823a3321e5b527-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/181099081',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Open Chords Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/open-chords-1.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/open-chords/2',
                        'title' => 'Basic Chording Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/589622533-6c155ed671dfc5c0391c5a82888729703d4223e538866d144d56a35ddd67b58d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/181099098',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Basic Chording Technique PNG',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/open-chords/3',
                        'title' => 'Open A, D, & E Major Chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/589656864-fef38a0f9706127ed6364a8f7f6d9d8a1efe4dd0ce82dc16f320c7571fcb503d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/181099143',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Basic Chording Technique PNG',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/open-chords/4',
                        'title' => 'Changing Between A, D, & E Major',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/589685775-3bc41ce35ee43cff9978895b721468ec236ede3df7367f7ca3c345f24875ae8c-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/181099154',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Changing Between A, D, & E Major PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/open-chords-1-examples.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/open-chords/5',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/589652608-7c69bd63e5ef49d7062cb87520fe4827e27025ea50d753320066755b74c65508-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/181099162',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Practice Along PNG 1',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Practice Along PNG 2',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-chords-1-examples.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/open-chords/6',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/589632976-327c955a812ac3fe56effaa3de65a9f9559282a813e1254b212ccd4f6f294fa0-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/181099168',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Musical Application PNG',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Musical Application PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/open-chords-1-examples.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Musical Application MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/open-chords-1-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Musical Application MP3 w/ Click',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/open-chords-1-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Starter Kit - Heartbreak Avenue',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'starter-kit/lessons/heartbreak-avenue',
                'assets' => [
                    [
                        'title' => 'All Lesson Resources',
                        'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/zip/heartbreak-avenue.zip',
                        'soundslice' => ''
                    ],
                    [
                        'title' => 'Jam Track w/ Click',
                        'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-no-rhythm-guitar-click.mp3',
                        'soundslice' => ''
                    ],
                    [
                        'title' => 'Jam Track No Click',
                        'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-no-rhythm-guitar-no-click.mp3',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579719510-d42a7ccc8fdc9225fe0761fa316407cb177b0bc0c1c55587ffcf07c0c12984f9-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/173407382',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Full Band Jam Track',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-full-band.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Tabs & Sheet Music',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/2',
                        'title' => 'The Chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579726452-3957b8d94ea37643c56fd5306813c081d39ea1ce489a3da42fa62485d20d5296-d_1280x720?r=pad',
                        'video_src' => '//player.vimeo.com/video/173407380',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'The Chords PNG',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/images/heartbreak-chords.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/3',
                        'title' => 'Strumming Patterns',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579721441-172eae1d0cc0194ce02060afa04d49cb39af77e4f8b4cd811555bc037dfd3637-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/173407384',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'The Chords PNG',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/images/heartbreak-chords.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/4',
                        'title' => 'Song A Section',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579718599-099c8d821bbd6f38cb7aa55f7b3c50ea2e990489f903a6821a2e7653f6049f1d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/173407381',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Tabs & Sheet Music',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/5',
                        'title' => 'Song B Section',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579717931-3018a79aef1565ee77392ce824cf987f56fc0b69c9a84809197e886dbaba2a1b-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/173407383',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Tabs & Sheet Music',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/6',
                        'title' => 'Song Structure',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579711765-2decd6304436925813433c7bec1f5dba5e6b0297bee4e4a3d0326bb72f97dc6d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/173407385',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Full Band Jam Track',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-full-band.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Tabs & Sheet Music',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/heartbreak-avenue/7',
                        'title' => 'Performance',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/579725313-42acb2d2bae42d6ed67e86fdaad705aded0de5412035e9721862d66e7cd7e71d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/173407378',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Full Band Jam Track',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-full-band.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Tabs & Sheet Music',
                                'src' => 'https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Starter Kit - Strumming',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'starter-kit/lessons/strumming',
                'lessons' => [
                    [
                        'slug' => 'starter-kit/lessons/strumming/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/592824329-4d66f633b42b4292a17a4fcf52996e43fe8abcc8070c63aef6e087086c097161-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/182874374',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Strumming Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/strumming-1.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/strumming/2',
                        'title' => 'Basic Strumming Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/592099106-ea1574b1f75a519a835317488b9b42387ff9ce1b5585bdc433e3c769f97bd324-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/182874370',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/strumming/3',
                        'title' => 'Downstrokes',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/592844038-489afcf8b1244ee2e12f4a540354127044ece36d8be1a560759ca3bc41eb62da-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/182874375',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Strumming Examples 1-4 PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/strumming/4',
                        'title' => 'Upstrokes',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/591974884-50339e825985ece7d67531d673aea30011d7f17386a7c3ab466c480d5790110a-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/182874372',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Strumming Examples 1-4 PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/strumming/5',
                        'title' => 'Downstrokes & Upstrokes Together',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/591974785-81125dcce7f73d7cbb21e43caebbf61d4116f251993562206e35f328203681f9-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/182874373',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Strumming Examples 1-4 PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/strumming/6',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/591974955-505af73ef5c1deeae618d697e0e9caa7acf1e47392596a7d863fc1c4cae5b3ed-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/182874376',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Strumming Examples 1-4 PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'starter-kit/lessons/strumming/7',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/591975257-b4d7193d3e95396cc398aab2a0514cc96265797f5e44e2ac59fd9b3f81a9c15b-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/182874369',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Strumming Examples 1-4 PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 No Click',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/strumming-1-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'MP3 With Click',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/strumming-1-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Changing Chords Smoothly',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/changing-chords-smoothly',

                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571265065-b747144fc7799529acc354d0fbdf9cd137fbe8f458191f6e2b96eeee40fb4c47-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/167037192',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Changing Chords Smoothly Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/changing-chords-smoothly.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/2',
                        'title' => 'Chording Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571269669-6d043dd73cc383be25744e4aed12c6ad20f1a94fc0aebf3f0cca4de9ff5f3154-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167037193',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/3',
                        'title' => 'Knowing The Chords First',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571427895-fb8cffb35cb1596dcabaaf2a8bb9e50481522ce8c04cf0d2acf687462dc12edd-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167037191',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/4',
                        'title' => 'Tips For Changing Chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571272562-73a38cc6da4faceb8a78f8bdbda040d61cb1f21dd19842b43d2d5017ea9f44b5-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167037189',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/5',
                        'title' => 'The Open G & C Chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571415213-aaf612b98f9a302879c01369167af3b6ef322bace5d9888c1fc86bcbd969f3dd-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167037190',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/6',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571437697-d7fee13565686039492c607d16cc960019c795b46934079c42c5b10c6ac346e8-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167037188',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/changing-chords-smoothly/7',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571437697-d7fee13565686039492c607d16cc960019c795b46934079c42c5b10c6ac346e8-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167037194',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Changing Chords A To D No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-a-d-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Changing Chords A To D Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-a-d-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Changing Chords G To C No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-g-c-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Changing Chords G To C Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-g-c-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Exploring Guitar Rhythms',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/exploring-guitar-rhythms',
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/exploring-guitar-rhythms/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587450172-6a683fd27ef68ec34713047ae77b6c121ac34f19cdb6e8189198915fb9138bf6-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179472223',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/exploring-guitar-rhythms/2',
                        'title' => 'How Rhythm Works',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587459414-b15d0999348fb4ebc25467d8289ab0e162b6c66767eab2697c9edb2787c71290-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/179472224',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/exploring-guitar-rhythms/3',
                        'title' => 'Whole & Half Note Exercises 1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/588524938-7cb7cd4f02d4a50be81b94f5822b510367f04aed9ec0f2703631fd4dfa2bc07b-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/180326078',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/exploring-guitar-rhythms/4',
                        'title' => 'Whole & Half Note Exercises 2',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587460114-787126431e0e99a3bc61d5818287119e9a12dc17f28ce98c8bdc291f38bb8731-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/179472230',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Reading Rhythm Examples 1-10 - PNG',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/reading-rhythms-1/reading-rhythms-1-10.png',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/exploring-guitar-rhythms/5',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587449342-817583dd41b64204a4d0825b54404bbfce3a890636df031759353638a5913b3d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/179472228',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Reading Rhythm Examples 1-10 - PNG',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/reading-rhythms-1/reading-rhythms-1-10.png',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Whole & Half Note Song No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/whole-and-half-note-song-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Whole & Half Note Song Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/whole-and-half-note-song-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - How To Tune A Guitar',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/how-to-tune-a-guitar',
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572984065-e3b791a5ee5a8450a97eecc0fb10e5a319e36174895648d5234fd6469b1f282b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467649',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/2',
                        'title' => 'Open String Names',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572987993-b9fefaefa895a248c7dbf0e0c75befccc3b826e42425e2d06c5afd4d4bba6570-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467656',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/3',
                        'title' => 'Naturals, Sharps & Flats',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572988689-4ff5237b89335bcee4f3cc47205626f15c7c03ba8d9ec6809d19b5085e5736c4-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467654',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/4',
                        'title' => 'Using An Electronic Tuner',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572994177-64fd71ec6704a15777f951d08c7de0bfc41928ec4c6f98525d68e93a3fd2eae8-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467651',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/5',
                        'title' => 'Developing Your Ear',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572985760-35eb1eb5b63eec5a987d90d6fd679771733a098ce0fbf035d18aa569081ca155-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467653',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/6',
                        'title' => 'Tuning By Ear',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572994644-7d4b1d7ddc8ef3504e9ac3880cef201e433e0592383717eb71eb35402f6c683b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467655',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/how-to-tune-a-guitar/7',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/572993726-558588ee14f6da1fe7fe392222f628a59f425f815e0dfd3d77b6b0a9002f2636-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168467652',
                        'duration' => 7,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Legato Hammer Ons & Pull Offs',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs',
                'assets' => [
                    [
                        'title' => 'Legato Hammer Ons &amp; Pull Offs Examples',
                        'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/legato-technique-1-examples.pdf',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/605954515-8460b046e67ce64de625ab015601321a274fd4a6ceb569bc05b1351d55fc0e4b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193950412',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Legato Hammer Ons &amp; Pull Offs Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/legato-technique-1.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/2',
                        'title' => 'Hammer-On Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606309781-e7ed5d98eb34e3c52e0a6b033d40bc15808ea1109437421b0c2132b6ef28c78e-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/193950419',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/3',
                        'title' => 'Pull-Off Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606328591-a4116810a5e6ef3a23755c7e7459dafe45d7bf9eba8bec3c353cef5f38a05432-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193950443',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/4',
                        'title' => 'Legato Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606328591-a4116810a5e6ef3a23755c7e7459dafe45d7bf9eba8bec3c353cef5f38a05432-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193950460',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/5',
                        'title' => 'Legato With Minor Pentatonic',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606400202-100554e74a515b9f15d8320d4fcdce79bdfede001feb3a862ec731b4762525d3-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193950467',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/6',
                        'title' => 'Legato Licks',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606422010-628455cdba8278305bd023fd5115e9ba1a87e3f042aac650ab41db56c7ba77b4-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193950483',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/7',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606426087-990a8b74c5f261003e19880e932252fda8aa0041844cd4a9404b7c2e1f14e67a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193950490',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/legato-hammer-ons-pull-offs/8',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/606426087-990a8b74c5f261003e19880e932252fda8aa0041844cd4a9404b7c2e1f14e67a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/193949188',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/legato-technique-1-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/legato-technique-1-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Making Chords Sound Clean',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/making-chords-sound-clean',
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/making-chords-sound-clean/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571577345-734265fee12b59155896757b23ea7260d37920079cb4f24ebcab9fc65d49213a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/167285840',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Making Chords Sounds Clean Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/making-chords-sound-clean.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/making-chords-sound-clean/2',
                        'title' => 'Clean Chord Technique Tips',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571588650-226d0470ef0933e688d23f1eeea79a05ef7c716af832f9b2e1cfb4df736ef306-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167285844',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/making-chords-sound-clean/3',
                        'title' => 'Remembering Chord Shapes',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571587616-a1f2c609ad5ddd494c0cc94140bc9988e1e102e6884270e40ac169e6333e598d-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167285842',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/making-chords-sound-clean/4',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571585436-7f56a0936ae732e6997b639e7a453360dad62d8c5f795221863d689f04e7142e-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167285841',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/making-chords-sound-clean/5',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571583098-85e81d1d244a23fff3c12b498d2096e3750327d42fed41e96e714c9254e99aba-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167285843',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Making Chords Sound Clean No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/making-chords-sound-clean-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Making Chords Sound Clean Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/making-chords-sound-clean-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Playing Your First Guitar Solo',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/playing-your-first-guitar-solo',
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573436992-1d32a8fc54c477bfca8bffa1402b767127338314d594e51631c56decb1418e6f-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/168665897',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Solo Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/playing-your-first-solo.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/2',
                        'title' => 'How Rhythm Works',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573424079-03d9c9c82cacf53aa89ad3affcc9722701ea257d7e5570f97e69db94e2e92ef4-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665889',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/3',
                        'title' => 'Basic Picking Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573461282-a587064b57e9fb1ca2035255205b3a8d7a7b0d4bc0e9fd33503b19e6255b45b5-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665896',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/4',
                        'title' => 'Basic Fretting Technique',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573447761-569a0f2d70854a26c16e77100417704473a86ea5c672142c48c8627a63863c9f-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665891',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/5',
                        'title' => 'A2 D2 Melody #1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573456972-5b91585fa6aec5296239f8a92b28f02f9e159de69e89cb4111ba5d5749fd0c8a-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665892',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/6',
                        'title' => 'A2 D2 Melody #2',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573466232-e25e3a45dd395c5331500e947d38e0ed209bc2ad3b8af6ac47c1fb23e75db4e2-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665890',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/7',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573460326-6d78bdb725f89ef8a9cf9bbe8198380174563a28bb4134b01a022964fa2262df-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665893',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-guitar-solo/8',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/573465243-2c4ea7e279e75941149685f8af3b1fa23e3e86c812c6891af061023c8cec72d3-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/168665894',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'A2 D2 Progression No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-progression-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'A2 D2 Progression Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-progression-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Examples 1 &amp; 2 - PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/exercises-1-and-2.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Playing Your First Song',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/playing-your-first-song',
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/629673925-ddf79e971be15e929aaa4bfdcc8aa727eb922ebddb54925a319d35394948a1e0-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/167499055',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Playing Your First Song Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/playing-your-first-song.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/2',
                        'title' => 'The Open A2 Chord',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571838353-d17d268e6a4c50464e5b0dc79411f4e2c9d9558898cf0313639f116551ea8135-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499053',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/3',
                        'title' => 'The Open D2 Chord',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571834737-527a2d4d6d51498cf3fb449cee23691b2e498e5bbf8e0ce29149110d4544c414-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499057',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/4',
                        'title' => 'How Rhythm Works',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571832944-e2afa09511286fe5588a3e619b2d6e328eabdd18590d4a954766ee71f62678de-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499056',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/5',
                        'title' => 'Simple Strumming',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571843620-151b3f7185b96824036539c3fc62a290a7763dab661ab93f1e3e290dd1a7f573-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499058',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/6',
                        'title' => 'Changing Chords',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571839768-deea88f19579268887f9fcaa955d1999383d09549eda7d8c408f822d1364efec-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499059',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/7',
                        'title' => 'Dress Up Your Strumming',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571842111-16c9f1f825970e3764ba64bf3dd21c205b87ffe2ab20a3ad44fc843cff20ab49-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499061',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/8',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571840719-d07290be5f2f6cb056a8927a8d305a86f13c61126443f419bafa49e78a0b1a14-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499054',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/playing-your-first-song/9',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/571839944-375950379f97a45476e3c223857fed86e97bb2bc853889cf422589330156d016-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/167499060',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'A2 D2 Groove No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-groove-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'A2 D2 Groove Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-groove-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'A2 D2 Groove Notation - PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/a2-d2-groove.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Sight Reading Essentials',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/sight-reading-essentials',
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/sight-reading-essentials/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587125268-11061a71943b8b670c2b1070ec2615297590f4d18a3c8df120f61debe85bece7-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179247804',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Sight Reading Essentials Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/reading-music-1.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/sight-reading-essentials/2',
                        'title' => 'Reading Basics',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587139107-0fce8f93d6b6bc4cb60da70ccefccbe74cde43f6e71dd0cbad5999ece1b5a76b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179247808',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/sight-reading-essentials/3',
                        'title' => 'Natural Notes On The E & B Strings',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587145380-4cb9fb9ab5d26f73538e55f7b4d4ea82131b48b864d39a7383e963c803e06df6-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179247809',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/sight-reading-essentials/4',
                        'title' => 'Whole & Half Note Exercises 1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587146392-6842aed594f959ca1fd60565f6eb283973aa8cfd0ce83f8c770f3fb834dac58f-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179247806',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Reading Music 1 Examples 1-12',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/reading-music-1-examples-1-12.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/sight-reading-essentials/5',
                        'title' => 'Whole & Half Note Exercises 2',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587134161-bb709c3f2912d7d80963d37fa3147e00f05d31f90b3bfcd7cdb9c089682da8e1-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179247807',
                        'duration' => 3,
                        'assets' => [
                            [
                                'title' => 'Reading Music 1 Examples 1-12',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/reading-music-1-examples-1-12.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/sight-reading-essentials/6',
                        'title' => 'Musical Application',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/587133642-19b52faf6290df95551fc796bc5de172dc19b38e4a0361cebad079376cd891ca-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/179247814',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Reading Music 1 Song - PDF',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/reading-music-1-song.pdf',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Reading Music 1 Song No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/reading-music-1-song-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Reading Music 1 Song Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/reading-music-1-song-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 3,
                'title' => 'Toolbox - Soloing With Minor Pentatonic Scales',
                'meta_desc' => 'Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics. These exclusive video lessons are provided by Nate Savage of Guitareo.com.',
                'meta_img' => 'https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg',
                'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales',
                'assets' => [
                    [
                        'title' => 'Soloing With Pentatonic Scales Examples',
                        'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/minor-pentatonic-scales-1-examples.pdf',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/1',
                        'title' => 'Series Overview',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603714108-3d03776e227a32e94cc075dfa461c7fce9329a86edbee72605bdda40aa3ad15a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367837',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Soloing With Pentatonic Scales Resources',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/minor-pentatonic-scales-1.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/2',
                        'title' => 'How It\'s Made',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/604214743-a2a2d2dbf71c181a78cc689f15a40e4a9b2db6ebd36d2fb89494c7424105e737-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367838',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/3',
                        'title' => 'Scale Shape 6 1',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603758552-1d739849b6b194737f20e972373c0e90721a612513975a6d087cd6b7b38607e4-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367841',
                        'duration' => 18,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/4',
                        'title' => 'Emphasizing The Root Notes',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603725009-e8f7427a7000b2f90a75fbeba662dcb8055c81c920ed9819670307ab6bd41a97-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367842',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/5',
                        'title' => 'Sing The Notes',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603734323-e525808dc95e402526d3659bc06bbb42af04eec843597f20bbdbfa1884f79f61-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367848',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/6',
                        'title' => 'How To Use The Scale',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603752760-ded001121e940d534ce72d84aef1a8de95456371579c0bef56b137e5856db00b-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367844',
                        'duration' => 13,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/7',
                        'title' => 'Minor Pentatonic Scale Licks',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603745117-48a05225c9818977bbe6ec88e43e738093f9881fffef99337e75a9b08e337d99-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367840',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'toolbox/lessons/soloing-with-minor-pentatonic-scales/8',
                        'title' => 'Practice Along',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/603732916-b6c37cba3ed9f5399e25f43eaa155ccd7639863e02f5f5495c0a1b2a90053964-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/192367843',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'Jam Track No Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Jam Track With Click - MP3',
                                'src' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Chord Hacks',
                'meta_desc' => 'The easier way to learn piano chords so you can play popular songs!',
                'meta_img' => 'https://pianote.s3.amazonaws.com/chord-hacks/og-image.jpg',
                'slug' => 'chord-hacks/lessons',
                'lessons' => [
                    [
                        'slug' => 'chord-hacks/lessons/chord-hacking',
                        'title' => 'Intro To Chord Hacking',
                        'desc' => 'No piano player is gonna get very far without learning about chords. Luckily, chords are pretty simple and
<em>highly </em>addictive to learn, so it shouldn’t be too hard for you to get started.

The first question you might be asking is...what
<em>is </em>a chord? You can think of a chord as a collection of notes sounding in unison of each other.
<em>Technically </em> you can make a chord out of any combo of three or more notes, but since you’re just starting out you should stick to creating simple chords called
<em>triads. </em>They’re really easy to make. The first chord you can make is called the C major triad. This chord is formed of three notes: a root note, a third, and a fifth note. So what does that look like applied to the key of C major? It looks like the notes C - E - G.

Making a single major triad is one thing, but what makes chords really shine is when you play multiple chords together. This is called a
<em>chord progression. </em> The easiest way to make chord progressions is to base them off of the key that you’re playing in. There are a few chords in every key that go great together, so let’s have a look at those.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/cms-uploaded/rsz_lisa_smile_pic__file_1496167589.jpeg" alt="lisa-smile">

Every major scale has seven notes, plus an eighth note (the octave) on top. You can make chords off of every note in this scale. The next logical note to make a chord off of is the fifth note of the scale. In the case of C major, that note will be G. The G chord looks a lot like the C chord, except the notes are now G - B - D.

The next chord after that is going to sound quite a bit different. Take the notes that make up the G chord, and move each note up one white key to the right. Now you’ve got the A minor triad, and it’s made up of A - C - E. Even though it looks/feels like a similar chord to your C and G chords, it
<em>sounds </em>way different. We’ll save why that is for a later lesson. For now just listen to the difference between the C major chord and the A minor chord.

The final chord to look at is the F major chord. To make this chord, base it off of the fourth note in the C major scale. The notes are F - A - C.

So, now you’ve learned how to make a simple triad and apply that chord shape to several points in the C major scale, creating different chords. You learned the C major triad, along with G, A minor and F major. Countless songs have been written using these four chords alone! Go ahead and try em out in any combination you like.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/902167102-c92046bc9bbb9c4e996021294d014330cbca50d5947d89174c4a9c1f707057b1-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/424943799',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chord-hacks/lessons/inversions',
                        'title' => 'All About Inversions',
                        'desc' => 'Chord hacks depend
<em>hugely</em> on inversions. So in this lesson, you’re going to learn how to take simple triads and reorder how the notes are stacked to make new chord inversions!

The best way to learn chord inversions is to take a chord you already know very well, like the C major triad. The C major triad is made of the notes C - E and G. Those are the notes you need to make the chord,
<em>but </em>those chords don’t necessarily need to be spelled out in that order. You can actually take the three notes of this chord and reorder them in three different ways! These alternate chord reorderings are called
<em>inversions</em>.  <br><br>
To make the first inversion of the C major triad, take the C note off the bottom of the chord instead play the C on the octave above. This makes the chord spelled out E - G - C, also known as
<em>C first inversion. </em>

Now that you know how to make a C major chord in first inversion, you can take the E off the bottom of the chord and put it one octave higher on top. This makes the chord G - C - E, or
<em>C second inversion. </em>

If you do this inversion trick one more time, you’ll find that you end up on the original form of the C chord, just an octave above. Practicing all the inversions in one fluid motion is a great way to familiarize yourself with the keyboard and gain some essential muscle memory as well.

Once you’ve learned the C major chord in all its inversions, try taking the same concept and applying it to the other chords that you’ve learned so far, the V chord, the minor vi chord and the IV chord. You can make a root position chord, a first inversion and a second inversion out of each triad!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/902167370-e996b0b99b3110cc1f122622478fca336db140ccb257ef05363e02622befdf34-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/424943879',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chord-hacks/lessons/adding-rhythm',
                        'title' => 'Adding Rhythm With Your Left Hand',
                        'desc' => 'So now that you know some amazing chords in all of their inversions, you’re going to want to find some great ways to play them in the left hand. It\'ll make learning songs and cool keyboard patterns so much more fun! Here’s how to add some magic to your left hand accompaniment.

The simplest way to add magic to your left hand chord progression is to actually strip them
<em>right back </em>to just their root notes. If you play them a few octaves below middle C, you’ll have a deep, rich, open sound that won’t get in the way of your right hand chords and melodies. Wanna make that bass sound even deeper? Add an octave note to the bass notes.

If you want to
<em>hint </em>at the chord progression in the left hand without voicing all the notes in the chord, try simply playing just the 5th intervals of the chord, leaving the 3rd to be played in the right hand. Most times the best approach for the left hand is to keep it simple. The last thing you want is to cover all your beautiful melody playing with some muddy chords down below.

Once you get good at all of that, you can combine some of these skills and play broken arpeggios in the left hand consisting of the root, the fifth and the octave. Before long, you’ll have developed your instincts in the left hand to create your own patterns on the fly!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/902167277-cf096acfc9146f9f1db5cfd60e96f2da205448c5d4279b7e0f477ce573aa90f0-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/424943981',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chord-hacks/lessons/two-hands',
                        'title' => 'Two Hands More Fun',
                        'desc' => 'Have you ever wanted to put both hands on the piano and just play without worrying about missing notes or screwing up? Then this lesson is for you.

Now that you’ve learned about chord inversions and left hand patterns, it’s time to put both hands together. You’re gonna be moving between chords and their inversions in the right hand, while the left uses some of the magic accompaniment patterns.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/cms-uploaded/Lisa Pose_file_1496175211.jpeg" alt="lisa-pose-file">

In your last chord hack lesson, you learned a few ways to make your left hand move within the chords. You learned how to use root notes to give the chords some depth, and you learned how to play octaves to give the chords and even
<em>deeper, richer </em>sound. You learned about the importance of the 5th interval for creating a subtle, open framework that will let the right hand chords and melodies really shine, and you learned about using arpeggio patterns to create some rhythmic movement.

So with all of these different rhythmic variations, you’re probably gonna want to work in your right hand as well, including those sweet chord inversions! One of the most difficult barriers that a lot of students struggle with is understanding where the root is when you’ve made chord inversions. That’s why it’s important to follow the name or number in the chord, especially when you’re just starting out. Remember, the chords used in this song are the I, V, vi, IV. Start out with the I chord in root position, then move to the V chord in 1st inversion before moving that chord shape up one white key to the right and making the vi chord in 1st inversion. Your final chord movement of the progression will be the IV chord, but in 2nd inversion. When changing from chord to chord using these inversion, you’ll notice that it’s really easy to hear
<em>exactly </em>what chord you’re playing when you play the root notes in the left hand.

So go ahead and create your own left handed patterns using these examples. Don’t be afraid to experiment, and keep your ears open! You never know what you can come up with until you try!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/902167411-a901220a513f3647a8f56b9e7345340b19a6e6a3337a8b5113c00f5fb3b54eca-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/424944086',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chord-hacks/lessons/chord-progressions',
                        'title' => 'Fancy Chord Progressions',
                        'desc' => 'It’s time to make things fancy! Inversions and left hand patterns are awesome ways to sound pretty darn good at the piano, but there’s even more you can do to really make things sound awesome!

The first fancy trick you can learn...we’ll call the
<em>twinkle</em>. You can call it whatever you like, but it goes like this. Make a simple C major triad. That means the notes C - E - G. But instead of playing them all at once, use finger 2 to really quickly throw in a D note in there before landing on the E. This sound adds a
<em>tiny </em>about of additional texture to the chord.

If you’re still new to piano, this might feel a little weird to move your fingering quite this fast. So try making a simple exercise out of it. Just move nice and slow, transferring between the default triad and the ‘twinkled’ version. Try to think of this twinkle note as outside of rhythmic time, visualize the note bending or gliding up into the third.

You can also use the notes above and below the major third to create a gentle tension in your chords. These are called
<em>suspended chords. </em>If you voice a chord with the I, II, and V, you’ve created something called the sus2 chord, named because you’re creating this suspended sound by holding the 2nd note before resolving into the major 3rd, creating a major triad. Or you can create a suspended 4th sound by making a chord with a I, IV, and V. This time the suspended note hovers just
<em>above </em>the triad shape, wanting to resolve down into the major triad.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/cms-uploaded/Lisa Action Shot_file_1496177093.jpeg" alt="lisa-action-shot-file">

Of course, you don’t have to stick to just one chord to try all of this out. You can try this technique with any triad chord, be it a major chord or a minor chord. Try this motion on all the big chords you’ve learned in this chord hacks series. Suspended 2nd and 4th chords sound
<em>way </em>different when they’re resolving to a minor chord vs a major chord, so listen out for that big change when you get to the minor vi chord.

The next thing you can do to make things fancy is to use passing notes in the left hand. This smooths out your chord movements as you jump from chord to chord. An example of the passing note in action can be shown when moving from the minor vi chord to the IV chord. Starting on A in the left hand, stop by the G note just before landing again on the F note in the bass. This creates an awesome sense of motion as you gently step down to the next chord.

Once you’ve mastered the twinkles and the passing notes in isolation, it’s time to put your own musical spin on them. So play through this progression that you’ve been learning and experiment with different combinations of these techniques!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/902167575-11ca75a2d533545f3f73b69704b5838beb61d66a55b58055482fec30768e57b5-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/424944168',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'chord-hacks/lessons/popular-songs',
                        'title' => 'Big Chords For Popular Songs',
                        'desc' => 'Now that you’ve become so familiar with the BIG CHORDS in pop music (the I, V, vi, IV chord progression), you might start to hear it everywhere. That’s because it’s one of the most popular chord progressions ever, found in anything from classical to synthpop. ‘Let It Be’ by the Beatles, ‘I’m Yours’ by Jason Mraz, ‘Don’t Stop Believin’ by Journey...this ever-growing list goes on and on!

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/cms-uploaded/Lisa Witt at Piano_file_1496179806.jpeg" alt="lisa-at-piano-profile">

So why not add a few songs yourself to this list? I hope that these chords have inspired you to create your own musical compositions, whether you use these chords to accompany a new vocal melody, or create some instrumental music from these chords.

You can use the exercise in this video to get inspired, or you can create your own exercises out of these chords. If you’re looking for more advice on creating your own music, arranging your favourite songs for the piano, and other practice tips, we’ve got plenty more to teach you in the pianote foundations lesson series!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/902167640-2332f8dc3b5d83f2c49ccd764b1a6e30965e58c84eb273fb81a2fa4c42b094f7-d?mw=1100&mh=619',
                        'video_src' => '//player.vimeo.com/video/424944241',
                        'duration' => 4,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Piano Riffs & Fills',
                'meta_desc' => 'The Shortcuts To Sounding Great On The Piano',
                'meta_img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/og-image.jpg',
                'slug' => 'riffs-and-fills/lessons',
                'lessons' => [
                    [
                        'slug' => 'riffs-and-fills/lessons/1',
                        'title' => 'Introduction',
                        'desc' => 'Welcome to Riffs & Fills. The shortcuts to sounding great on the piano.',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255245-card-thumbnail-maxres-1588770771.jpg',
                        'video_src' => '//player.vimeo.com/video/415195718',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'riffs-and-fills/lessons/2',
                        'title' => 'Building Your Foundation With Chord Inversions',
                        'desc' => '<a class="join smaller mb-4 bg-pianote" target="_blank" href="https://d1923uyy6spedc.cloudfront.net/255246-resource-1588931722.pdf">DOWNLOAD PDF</a>
Before you can become amazing at riffs and fills you need to have a strong understanding of chords and their inversions. This lesson will teach you the chord notes and inversions for the chords you will be working with in this course.',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255246-card-thumbnail-maxres-1588770808.jpg',
                        'video_src' => '//player.vimeo.com/video/415196064',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'riffs-and-fills/lessons/3',
                        'title' => 'Chord Note Fills',
                        'desc' => 'In this lesson you will learn your first fills! These fills use chord tones (notes you already know!) to create a full and rich sound.',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255247-card-thumbnail-maxres-1588770990.jpg',
                        'video_src' => '//player.vimeo.com/video/415196611',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'riffs-and-fills/lessons/4',
                        'title' => 'Sus Chord Fills',
                        'desc' => 'Learn how to use the notes of a sus chord to add some sparkle to your playing!',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255248-card-thumbnail-maxres-1588771051.jpg',
                        'video_src' => '//player.vimeo.com/video/415196416',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'riffs-and-fills/lessons/5',
                        'title' => 'Combining And Applying Your Skills',
                        'desc' => '<a class="join smaller mb-4 bg-pianote" target="_blank" href="https://d1923uyy6spedc.cloudfront.net/255250-resource-1588935038.pdf">DOWNLOAD PDF</a>
Learn how to take what you\'ve learned so far and put it together in the context of a song. This is where all the magic comes to life!

**C Chord Inversions**

<img src="https://d1923uyy6spedc.cloudfront.net/255253-sheet-image-1588760291.svg" alt="sheet image 1">

**G Chord Inversions**

<img src="https://d1923uyy6spedc.cloudfront.net/255254-sheet-image-1588760839.svg" alt="sheet image 2">

**Am Chord Inversions**

<img src="https://d1923uyy6spedc.cloudfront.net/255255-sheet-image-1588762212.svg" alt="sheet image 3">

**F Chord Inversions**

<img src="https://d1923uyy6spedc.cloudfront.net/255256-sheet-image-1588762774.svg" alt="sheet image 4">',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255249-card-thumbnail-maxres-1588771102.jpg',
                        'video_src' => '//player.vimeo.com/video/415195897',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'riffs-and-fills/lessons/6',
                        'title' => 'Left Hand Accompaniment Rhythms',
                        'desc' => 'Believe it or not, the left hand plays a VERY important role when it comes to sounding amazing BUT it doesn\'t have to be fancy to sound fancy. What it really comes down to is the RHYTHM with which you play the left hand notes.',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255250-card-thumbnail-maxres-1588771138.jpg',
                        'video_src' => '//player.vimeo.com/video/415195748',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'riffs-and-fills/lessons/7',
                        'title' => 'Advanced Fills & Riffs',
                        'desc' => 'Now that you are playing fills, riffs and rhythms like a pro it is time to take things up a little and experiment with some more melodic sounding fills. These concepts are a little bit more advanced so be sure to get lots of practice in on the previous lessons first.',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/255251-card-thumbnail-maxres-1588771189.jpg',
                        'video_src' => '//player.vimeo.com/video/415196214',
                        'duration' => 7,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Piano Technique Made Easy',
                'meta_desc' => 'Master the fundamentals -- so you can play anything you want on the piano.',
                'meta_img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/og-image.jpg',
                'slug' => '',
                'lessons' => [
                    [
                        'slug' => 'piano-technique-made-easy/10-min',
                        'title' => '10 Minute Practice Routine',
                        'desc' => 'With busy being the new norm, finding time to practice can be both overwhelming and difficult!

The good news is that you can accomplish a whole lot in a short amount of time if you know what to practice and if you are consistent.

This lesson shows you how to take 10 minutes and turn it into a super-effective practice session.

<a class="join smaller w-full sm:w-1/2 mx-auto bg-pianote" href="/piano-technique-made-easy/">Piano Technique Made Easy &raquo;</a>',
                        'thumbnail' => 'https://i.vimeocdn.com/video/970519590-02c3469fee10abaefebaf395ad82c03fc01be5e271f911f728f8e6632217c460-d_480',
                        'video_src' => '//player.vimeo.com/video/342788953',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'Download Sheet Music',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/226214-resource-1560970072.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'piano-technique-made-easy/4-exercises',
                        'title' => '4 Exercises for Beginners',
                        'desc' => 'This one is for the beginners out there who want to wake up the hands and build up some speed, dexterity, and hand independence.

Some of these will be easier than others, so take your time and focus on playing the exercises correctly!

You can practice all three at once or pick a favorite to work on as a part of your daily routine.

<a class="join smaller w-full sm:w-1/2 mx-auto bg-pianote" href="/piano-technique-made-easy/">Piano Technique Made Easy &raquo;</a>',
                        'thumbnail' => 'https://i.vimeocdn.com/video/970520513-9f0a9d7c9b8c035c33e2143a2ef034fc0755753f3139c1408dce79f5bf0eba9a-d_480',
                        'video_src' => '//player.vimeo.com/video/332085926',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-technique-made-easy/scales-sound',
                        'title' => 'I Bet You Didn’t Know Scales Could Sound Like This',
                        'desc' => 'Scales are super important for your development as a pianist. If you want to develop a better understanding of the piano and be able to play faster, scales are a must.

But ... they can be boring to practice.

Here’s the good news…

Scale practice does NOT have to be traditional. In this lesson, Lisa shows you how you can take a basic scale and practice it in a way that is beautifully musical and creative!

<a class="join smaller w-full sm:w-1/2 mx-auto bg-pianote" href="/piano-technique-made-easy/">Piano Technique Made Easy &raquo;</a>',
                        'thumbnail' => 'https://i.vimeocdn.com/video/970521117-99c32e89bb3a03e212e134a2559045ecf1c485292ebc849f41a6d88ec8b17023-d_480',
                        'video_src' => '//player.vimeo.com/video/373204131',
                        'duration' => 5,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Learn-To-Play-Piano',
                'meta_desc' => 'Ever wanted to learn the piano?  This video series will get you playing in no time!',
                'meta_img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/learn-piano.jpg',
                'slug' => 'my-lessons',
                'lessons' => [
                    [
                        'slug' => 'my-lessons/how-to-play-piano',
                        'title' => 'How to Play Piano',
                        'caption' => 'Learning to play piano can seem like a pretty big challenge for a beginner.',
                        'desc' => '<p class="mb-4"><strong>Learning to play piano can seem like a pretty big challenge for a beginner.  You might be staring at your keyboard right now, wondering ‘where do I even start?’</strong></p><p class="mb-4">But don’t let all those keys intimidate you!  Making sense of the keyboard is actually quite simple, you just have to know what to look out for.</p><h4 class="font-bold mb-3">Identifying Octaves</h4><p class="mb-4">The first thing we’ll do is break the piano down into more manageable chunks.  If you look closely at the keyboard, you’ll see that there is actually a pattern to how the keys are laid out.  They’re laid out in such a way that after 12 keys the notes repeat themselves.  We call this sequence of 12 keys an Octave.  A traditional 88 key piano can be split up into just 7 octaves.  Learning to identify this octave pattern is crucial for finding your way around the keyboard.</p><h4 class="font-bold mb-3">Finding Middle C</h4><p class="mb-4">Now that you know how to split your piano up into discrete octaves, finding specific notes is easy!  Let’s start with the most important note on the piano, Middle C.  How do we find it?  Take a look at the black keys of the piano, and notice how there’s a pattern of black keys across the whole keyboard, alternating between groupings of three black keys and two black keys.</p><div class="text-center"><img class="piano-img mx-auto" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/graphics/2-octaves.jpg" alt="2-octaves"></div><p class="mb-4">To find any ‘C’ note, simply take that grouping of two black keys and play the white key just below the lowest black key.  You can see this pattern across the whole keyboard, so if you want to find a ‘C’ note anywhere, all you have to do is find that grouping of two black keys!</p><p class="mb-4">Middle C is the fourth ‘C’ note from the bottom of the piano.  Take special note of it as it’ll be your home base for learning the entire instrument.</p><div class="flex flex-col lg:flex-row"><div class="w-full lg:w-1/2"><h4 class="font-bold mb-3">Naming the Notes</h4><p class="mb-4">Knowing middle C is one thing, but what about all those other notes in the octave?  These notes are all given letters as well.  For now, just focus on the white keys.  Walking up from middle C, the note order is D, E, F, G, A, B, and then the octave pattern repeats with C again.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/c-major-scale.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/c-major-scale.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/c-major-scale.jpg" alt="{c-major-scale"></video></div></div></div><div class="flex flex-col lg:flex-row"><div class="w-full lg:w-1/2"><h4 class="font-bold mb-3">Number The Fingers</h4><p class="mb-4">In order to play the piano to the best of our ability, you need to be sure to play with the proper fingerings.  The first step to proper fingerings is to number the fingers themselves.  For both hands the fingerings go from #1 for thumbs to #5 for the pinky finger.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/fingers.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/fingers.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/fingers.jpg" alt="fingers"></video></div></div></div><h4 class="font-bold mb-3">Playing Scales</h4><p class="mb-4">Now that you know the numbers for your fingers and the names of the notes, you can apply your knowledge to play a C major scale.  The C major scale consists of eight notes from C to the C in the octave above.  This means that you’ll need to learn some special finger techniques to get your five fingers to play an eight note sequence fluidly.</p><p class="mb-4">The fingering pattern in the right hand is 1, 2, 3, 1, 2, 3, 4, 5.  Notice how there’s a fingering reset between the 3rd and 4th notes of the scale.  In order to play this order of fingerings fluidly, you’ll need to master a technique called the thumbtuck.  A thumbtuck involves curling your thumb under your hand in order to play reposition your hand and continue playing a phrase.  Although it may seem simple, the thumbtuck is one of the most important skills in a pianist’s bag of tricks, so make sure you’re always aware of it during your practice sessions!</p><div class="flex flex-col lg:flex-row"><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/thumbtuck.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/thumbtuck.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/thumbtuck.jpg" alt="thumbtuck"></video></div></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/left-hand-thumbtuck.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/left-hand-thumbtuck.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/left-hand-thumbtuck.jpg" alt="left-hand-thumbtuck"></video></div></div></div><p class="mb-4">When playing scales in the left hand, all the same rules apply, except our hands are mirrored.  This means the fingering pattern is 5, 4, 3, 2, 1, 3, 2, 1.  Keep an eye out for that fingertuck between notes 5 and 6.  It’s a similar motion to the right hand, but this time your middle finger will cross over to continue playing the scale.</p><p class="mb-4">Practicing scales is just one of the many ways you’ll build confidence and musicality as a piano player.  When you’re practicing them make sure you’ve got your technique and fingerings consistently solid.  <strong>Prioritizing good technique in your early days as a piano player will pay off HUGELY moving forward!</strong></p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-play-piano.png',
                        'video_src' => 'https://www.youtube.com/embed/UMSQ831_74k/',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/how-to-play-chords',
                        'title' => 'How to Play Chords',
                        'caption' => 'Let’s look at how to play chords.  A chord is a combination of three or more notes played in unison.',
                        'desc' => '<div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p><strong>Let’s look at how to play chords.  A chord is a combination of three or more notes played in unison.</strong>  The easiest chord to learn is the Major Triad.  Every Major triad you’ll come across is built out of the 1st, 3rd, and 5th notes of a major scale.  We’ll look at C major triad as our first chord.  The C major triad is built up of the notes C - E - G.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/c-major-triad.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/c-major-triad.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/c-major-triad.jpg" alt="c-major-triad"></video></div></div></div><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">In the right hand, you play the chord with fingers 1 - 3 - 5.  When you’re practicing chords, be sure to keep your fingers rounded so that you’re playing the keyboard with the balls of your fingertips.  This will allow your hands to have maximum power, control and accuracy while playing.</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/left-hand-c-major-triad.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/left-hand-c-major-triad.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/left-hand-c-major-triad.jpg" alt="left-hand-c-major-triad"></video></div></div></div><p class="mb-4">The left hand chord fingerings for a major triad are also pretty intuitive.  You play with finger 5 on C, 3 on E, and 1 on G.</p><p class="mb-4">To practice these chords, you can play them in either solid or broken forms.  When playing a chord in solid form, you’re playing all notes in the chord at once.  When playing a chord in broken form, you’re playing all the notes in the chord separately in a sequence.  Both are great ways to practice these chords and build muscle strength as well!  <strong>Be sure to practice your chords both solid and broken as you’re strengthening different skills with each.</strong></p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-play-chords.png',
                        'video_src' => 'https://www.youtube.com/embed/sb9RNEhMauw/',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/strengthening-your-hands',
                        'title' => 'Strengthening Your Hands',
                        'caption' => 'Now that you’ve learned a little about scales and chords, it’s time to build your hand strength up so you can play with fluidity and control.',
                        'desc' => '<p class="mb-4"><strong>Now that you’ve learned a little about scales and chords, it’s time to build your hand strength up so you can play with fluidity and control.</strong></p><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">A simple way to build up strength in each finger is to simply place your hands on the keyboard as if you were going to play a scale and walk up the first 5 notes, focusing directly on each finger as it’s playing the note.  This will give you a sense of how it feels to move each finger independently, and will help to build up those muscles in each finger that are needed to play the piano.</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/finger-exercise-3.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/finger-exercise-3.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/finger-exercise-3.jpg" alt="finger-exercise-3"></video></div></div></div><br class="lg:hidden"><p class="mb-4">Another area to focus on with early finger exercises is perfecting that thumbtuck technique.  A great way to do this is to walk up a scale to the point where the thumbtuck happens and then walk back down.</p><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">Once you’re feeling warmed up and confident, you can challenge yourself by practicing your scales and other exercises with both hands at once.  Make sure that you’re very comfortable with each hand separately before trying to tackle any scale or exercise hands together!  Remember, fingerings and technique are very important so make sure to prioritize the proper fingerings while practicing both hands together.</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/2-handed-scale.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/2-handed-scale.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/2-handed-scale.jpg" alt="2-handed-scale"></video></div></div></div><p class="mb-4">Incorporating exercises like these in your practice regimen will keep your fingerings and technique in tiptop shape, and build good habits for you as a player!  <strong>So whenever you’re practicing, always keep in mind not only what you’re playing, but also how you’re playing it.</strong></p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/strengthening-your-hands.png',
                        'video_src' => 'https://www.youtube.com/embed/s54At63Ee5o/',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/play-g-major',
                        'title' => 'How to Play G-Major',
                        'caption' => 'It’s time to switch things up and learn a new key, G-Major.',
                        'desc' => '<p class="mb-4"><strong>Up to this point, you’ve been looking at the piano via the key of C major.  Now it’s time to switch things up and learn a new key, G major.</strong>  The G major scale has a lot of similarities to the C major scale, except for one important  new feature: the addition of a new kind of note called a sharp note.  To sharpen any note, all you have to do is take any note and raise it by one semitone.  To do this, simply take your natural note and play the key directly above it.  In the case of G major, the note you’ll have to sharpen is the 7th note in the scale, creating F-sharp, played with that black key between F and G.</p><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p>Pay special attention to the sound of the sharpened 7th note climbing up to the 8th note.  This is an essential sound you’ll hear in all major scales, so training your ear to identify it will help you tremendously in the future. </p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/04/g-major-scale.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/04/g-major-scale.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/04/g-major-scale.jpg" alt="g-major-scale"></video></div></div></div><p class="mb-4">Making a G Major chord is also very simple.  It’s built just like the C major triad, but starting with G as the bottom.  <strong>So the notes are G - B - D, played with fingers 1 - 3- 5 in the right hand and 5 - 3 - 1 in the left hand.</strong></p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/play-g-major.png',
                        'video_src' => 'https://www.youtube.com/embed/0PP-PofEpew/',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/play-f-major',
                        'title' => 'How to Play F-Major',
                        'caption' => 'Let’s look at the key of F-Major. F-Major features a flat note in its key signature.',
                        'desc' => '<p class="mb-4"><strong>Let’s look at the key of F major.  F major features a flat note in its key signature.</strong>  Flattening a note works in much the same way as sharpening a note, except this time you’ll be lowering a note by a semitone.  The special flat note in F major is B-flat.  That means playing the black key between notes A and B.</p><p class="mb-4">The reason why we need to add sharps and flats to certain keys is because there is a formula that all major scales follow.  Without this formula all of your scales will sound slightly off in one way or another.  Let’s take a look at how this formula works to give us that major scale sound.  We can break any scale down into a series of full-tones and semitones.  You’ve already learned about semitones via sharps and flats.  A full-tone step is two piano keys apart.  For example, the jump from E to F is a semitone jump, as there\'s not black key in between..</p><img class="piano-img w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/graphics/full-tone-semi-tone.jpg}" alt="full-tone-semi-tone"><p class="mb-4">A major scale is mostly made up of fulltones with two big exceptions.  There are semitone jumps between notes 3-4 and notes 7-8 of every major scale.  If you look closely at the pattern of the keyboard from starting on F, you can see why we need to flatten the fourth note, B in order for the scale to work within that formula.  As long as you remember those two semitone ‘jump-points’ you can play that major scale pattern in any key!</p><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">Because of this B-flat note, there’s a slight change in the fingering pattern needed in order to play the F major scale accurately. <strong>All that you need to change is instead of playing 1-2-3 and then thumbtucking to reset your hands on the 4th note, this time you’ll play 1-2-3-4 and THEN thumbtuck to reset your hand on the 5th note.</strong></p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/05/f-major-scale.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/05/f-major-scale.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/05/f-major-scale.jpg" alt="f-major-scale"></video></div></div></div>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/play-f-major.png',
                        'video_src' => 'https://www.youtube.com/embed/K4rl7HCjunw/',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/minor-keys',
                        'title' => 'Minor Keys',
                        'caption' => 'We’ve learned so much about major chords and scales, but what about minor chords?',
                        'desc' => '<p class="mb-4"><strong>We’ve learned so much about major chords and scales, but what about minor chords?</strong> For every chord and scale that you’ve learned so far, there is a relative minor chord.  The good news is you’ve already learned everything you need to know to play minor chords and scales.  That’s because every minor chord and scale is based off of the notes used in a major chord or scale.  Since you’ve already learned about the C major, G major, and F major chords, you can easily learn the relative minor of these three chords!  Let’s start with finding the relative minor of the C major chord.</p><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p>To find the relative minor key, all you have to do is count up to the 6th note in the C major scale.  Try walking the C major scale up to its 6th note, landing on A.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/walk-from-a-c.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/walk-from-a-c.mp" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/walk-from-a-c.jpg" alt="walk-from-a-c"></video></div></div></div><p class="mb-4">If you start a scale on note A using the same notes as the C major scale, you’ll play an entirely different sounding scale called the A minor scale.  You can even use the same fingerings to play it in the both hands!</p><p class="mb-4">If you want to find the relative minors of the other keys you’ve learned, all you have to do is count up to the 6th note of that major scale!  Using this rule, you can see that the relative minor of G is E minor, and the relative minor of F is D minor.  Remember, each of these relative minors use the exact same notes as their relative major counterparts.</p><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p>What about minor chords?  They follow a very similar principle as the major chords.  All minor triads are based on the 1st, 3rd and 5th note of the minor scale.  This means that the A minor triad is comprised of notes A-C-E</p>   </div>   <div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/a-minor-triad.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/a-minor-triad.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/a-minor-triad.jpg" alt="a-minor-triad"></video></div></div></div><div class="flex flex-col lg:flex-row lg:mt-3 mb-4"><br><p class="small-body text-center w-full lg:w-1/2">The E minor triad is composed of notes E-G-B</p><p class="small-body text-center w-full lg:w-1/2 hidden lg:block">The D minor triad is composed of notes D-F-A</p></div><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/e-minor-triad.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/e-minor-triad.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/e-minor-triad.jpg" alt="e-minor-triad"></video></div></div><p class="small-body text-center lg:hidden">The D minor triad is composed of notes D-F-A</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/d-minor-triad.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/d-minor-triad.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/d-minor-triad.jpg" alt="d-minor-triad"></video></div></div></div></div><p class="mb-4">Now that you know some chords and scales in the minor keys, you have any entirely new sound palette to practice, experiment and play with!  A good way to get these new sounds under your fingers is to jump back and forth between the major chord and its relative minor chord.  <strong>Not only will you be practicing the chords themselves, but you’ll also be working on your ear training, helping your ear identify the relationship between major and minor chords.</strong></p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/minor-keys.png',
                        'video_src' => 'https://www.youtube.com/embed/EtHao8Hi4ac/',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/chord-inversions',
                        'title' => 'How to Play Chord Inversions',
                        'caption' => 'Chord inversions are a way to take these same chords you’ve already learned, and restacking the order of the notes in the chord.',
                        'desc' => '<p class="mb-4"><strong>Now that you’ve learned all about chord inversions and how to form the basic triads, let’s talk about chord inversions.</strong>  Chord inversions are a way to take these same chords you’ve already learned, and restacking the order of the notes in the chord.  This serves two purposes.  First, chord inversions can change the sound of the chord.  Second, chord inversions are a great way to move from different chords smoothly without having to make great jumps across the keyboard.</p><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><br class="visible-lg"><p>Let’s take a closer look at the C major triad.  The C major chord is built up of C, E, and G.  But we can take this same chord and play it with E in the base, then G, and C on top.  This chord is called C 1st inversion.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-1st-inversion.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-1st-inversion.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-1st-inversion.jpg" alt="c-1st-inversion"></video></div></div></div><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><br class="visible-lg"><p>We can play the C major triad in another way as well.  If we put the G in the bass, then play C and E on top, we create C 2nd inversion</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-2nd-inversion.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-2nd-inversion.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-2nd-inversion.jpg" alt="c-2nd-inversion"></video></div></div></div><p class="mb-4">When playing a chord in 2nd inversion, your fingering should alter slightly.  In the right hand, you play fingers 1-2-5 and in the left hand you play 5-2-1 to best voice each chord.</p><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><br class="visible-lg"><p>With knowledge of these chord inversions, it is much easier to create chords on the keyboard and move from chord to chord.  It’s also a great practice exercise to play all the chord inversions in one pass, moving up and down the keyboard.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-triads-exercise.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-triads-exercise.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-triads-exercise.jpg" alt="c-triads-exercise"></video></div></div></div><p class="mb-4"><strong>Now that you know how to create these chord inversions, you can take these principles and create chord inversions for the other chords you know!</strong></p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/chord-inversions.png',
                        'video_src' => 'https://www.youtube.com/embed/8WyHzHCp2R8/',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/other-chords',
                        'title' => 'How to Play Other Chords In The Major Keys',
                        'desc' => '<p class="mb-4"><strong>Now that you know the basics of creating chords, you can build all sorts of different chords within the major scale,</strong> easily making all sorts of new sounding triads, built entirely out of that major scale!</p><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">If you take that basic triad form, you can walk up the C major scale, making triads out of each chord.  Starting with the C chord, move each finger up one white key, making a chord that consists of notes D-F-A.  If you think this chord sounds quite different from C major, that’s because it’s a totally different type of chord called a minor chord.  These chords sound a lot sadder, more mysterious than their major counterparts.</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/d-minor-chord.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/d-minor-chord.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/d-minor-chord.jpg" alt="d-minor-chord"></video></div></div></div><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><br class="visible-lg"><p>If you continue to walk up the scale making chords in this manner you’ll create another minor chord based off the notes E-G-B, creating an E minor chord.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/e-minor-chord.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/e-minor-chord.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/e-minor-chord.jpg" alt="e-minor-chord"></video></div></div></div><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p>The next two chords are the 4th and 5th chords in the major key.  You’re already familiar with the F and G major triads.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/f-major-and-g-major-chords.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/f-major-and-g-major-chords.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/f-major-and-g-major-chords.jpg" alt="f-major-and-g-major-chords"></video></div></div></div><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p>The final triad you can make walking up the major scale is a unique sounding chord, the half-diminished chord.  This chord is made from the notes B-D-F.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/b-half-diminished-chord.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/b-half-diminished-chord.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/b-half-diminished-chord.jpg" alt="b-half-diminished-chord"></video></div></div></div><p class="mb-4"><strong>Now that you have access to all these chords, experiment with combining them in different ways to create your own chord progressions, working entirely within the major key!</strong></p>',
                        'caption' => 'Now that you know the basics of creating chords, you can build all sorts of different chords within the major scale.',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/play-other-chords-in-the-major-keys.png',
                        'video_src' => 'https://www.youtube.com/embed/-_MkQ3qJkWc/',
                        'duration' => 5,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/all-about-arpeggios',
                        'title' => 'All About Arpeggios',
                        'desc' => '<p class="mb-4"><strong>Arpeggios are a fun and simple technique to play patterns at the piano.</strong>  They are an incredibly useful tool that you can use to play flashy sounding melodies and intricate sounding rhythms.  Even though they might sound complicated to play, they are actually quite easy once you break them down into their basic parts.</p><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">To make a C major arpeggio, start out with your hands in root position over C.  The notes you’ll play are C-E-G and the high octave of C, all played like a broken chord.  In order to do this as efficiently as possible, be sure to pay attention to your fingerings.  In the right hand, you should be playing with fingers 1-2-3-5 to make that stretch to the high octave note.</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/09/right-hand-arpeggio.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/09/right-hand-arpeggio.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/09/right-hand-arpeggio.jpg" alt="right-hand-arpeggio"></video></div></div></div><p class="mb-4"><strong>The left hand features a similar fingering modification:  You should play your left hand arpeggios with fingers 5-3-2-1.</strong></p><div class="flex flex-col lg:flex-row mb-4"><p class="w-full lg:w-1/2">You can also take your knowledge of chord inversions and create a simple progression with arpeggios.  Try using arpeggios to create a I-IV-V chord progression, basing your progression off of C in root position, F in 2nd inversion, and G in 2nd inversion.</p><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/09/arpeggio-progression.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/09/arpeggio-progression.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/09/arpeggio-progression.jpg" alt="arpeggio-progression"></video></div></div></div>',
                        'caption' => 'Arpeggios are a fun and simple technique to play patterns at the piano.',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/all-about-arpeggios.png',
                        'video_src' => 'https://www.youtube.com/embed/X5KiGk1ZCfE/',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'my-lessons/how-to-write-a-song',
                        'title' => 'How to Write a Song',
                        'desc' => '<p class="mb-4"><strong>Writing a song might seem hard at first, but it’s actually quite easy when you break it down into its basic components.</strong></p><div class="flex flex-col lg:flex-row mb-4"><div class="w-full lg:w-1/2"><p>First, start off with a simple chord progression.  A great progression to use is the I-IV-V progression. It’ll make for a great progression for the first section of your song.</p></div><div class="w-full lg:w-1/2 px-4"><div class="w-full relative" style="padding-bottom: 41.66%;"><video class="absolute w-full h-full" poster="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/10/i-iv-v-progression-triads.jpg" autoplay muted playsinline loop><source class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/10/i-iv-v-progression-triads.mp4" type="video/mp4"><img class="w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/10/i-iv-v-progression-triads.jpg" alt="i-iv-v-progression-triads"></video></div></div></div><p class="mb-4">This progression makes a great verse, but it’s just a start.  Every great verse needs a chorus.  When writing your own chorus, remember that simpler is better.  You don’t necessarily need a whole new set of chords for the chorus to sound distinctive from the verse.  Try using the chords you already know!  In this short video series, not only have you learned the C, F and G major chords, but you’ve also learned your first minor chord, A minor.  Swapping from a major progression to a minor progression is a good way to separate the verse from the chorus.</p><p class="mb-4">Working with chords is one thing, but you’ll also need some cool melody ideas to use over those chords.  As always, remember that less is more for melodies.  Try basing your melodies off the third note in your root chord.  The third note in any triad is the most important note for determining whether that chord is a major or a minor chord.  In this case, that root chord is C major, and the third note of that chord is E.</p><p class="mb-4">Of course, there are countless ways to write a song.  These ideas are just a couple ways to get you started.  But above all, never be afraid to experiment!  Writing a great song is first and foremost about writing a song that means something to you.  <strong>What emotions or feelings are you trying to express through music? As a songwriter, use your musical technique and theory knowledge and see what you come up with!</strong></p>',
                        'caption' => 'Writing a song might seem hard at first, but it’s actually quite easy when you break it down into its basic components.',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-write-a-song.png',
                        'video_src' => 'https://www.youtube.com/embed/UcIx_Ca30G8/',
                        'duration' => 8,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Getting Started On The Piano',
                'meta_desc' => 'Go from absolute beginner to playing your first song in four easy lessons!',
                'meta_img' => 'https://pianote.s3.amazonaws.com/lead-gen/getting-started-2022/share-image.jpg',
                'slug' => 'getting-started/lessons',
                'lessons' => [
                    [
                        'slug' => 'getting-started/lessons/now-what',
                        'title' => 'What To Play First',
                        'caption' => 'Your first lesson',
                        'desc' => 'Welcome to the piano! If you’re here it is likely because you want to learn how to play but just aren’t quite sure where to begin. We’ve got you covered! By the end of this series, you will understand how the piano works, how to play scales, chords, and even SONGS!

So let’s begin!

We’ll start with the keyboard. I want you to first notice that we’ve got black keys and white keys. The black keys work in a pattern. We’ve got two, three, two three. Etc etc. While we aren’t going to use these black keys in the early stage of learning, we are going to use them as landmarks to help us understand the layout of the keyboard.

Attached to each white key is a note name which corresponds to the letters of the alphabet.

The musical alphabet is special. It goes from A-G. Like this:


<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-1-keyboard-layout.png" alt="keyboard-layout">

When you get to G, you head back to A and repeat it all over again.

Those black keys will work as landmarks to help us find these notes. If you find a group of 2 black keys and then look down and to the left, you will find C! Go ahead- find and play all the C’s on your piano. Logically after C, we have D after D we have E, after E we have F, then G then A then B, and we find ourselves back at C.

These little tricks will help you to learn how to make your way around the keyboard as quickly as possible. One of the first things you can practice is finding and saying out loud all the note names on the keyboard!

Now let\'s come back to C. C is the easiest place to begin learning so we are going to use C as our home base.

Firstly, sit nice and tall at your bench- feet on the floor, back straight, shoulders relaxed. Now, look at your hand. Your fingers are number 1-5 with your thumbs being your 1.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-1-finger-numbering.png" alt="finger-numbering">

We’re going to start by placing the thumb (or the 1 finger) of our right hand on C. Now, notice how nicely each finger rests above the notes?

It’s the same with our left hand. We’ll place our pinky (or the 5 finger) on C, and the rest of our fingers just rest on top of the notes. This is the five finger scale!

We’ll practice by playing each note with each finger, going up and down the scale.

And that’s the first lesson! Your homework is to practice and master that five finger C scale. Remember to practice at a speed that feels comfortable to you. And practice right hand, left hand and hands together!

Have fun, and I’ll see you in the next lesson!',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/sit-down-now-what.png',
                        'video_src' => '//player.vimeo.com/video/296037713',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/lessons/scales',
                        'title' => 'How To Play Your First Scales',
                        'caption' => 'The C Major Scale',
                        'desc' => 'Welcome back!

In this lesson we are going to learn to play your first real scales. In the previous lesson we learned how to play a 5 finger scale. Now, we are going to look at a complete 8 tone scale.

Scales are important for a variety of reasons. For now, they will help you to become more comfortable moving around the piano and help you to develop the fine motor skills in your hands to be able to play the music you want to play.

So let\'s begin with C scale. We have 8 notes in total. Now you might be thinking “eight notes?! But I only have 5 fingers” and you are correct! We are going to learn a fancy way of tucking our thumb so that you can play the full scale without any problem. It looks like this:

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-2-thumb-tuck-1.jpg" alt="thumb-tuck-1">

As you can see, when I get to the E, I keep my third finger pressed down, and then rotate our thumb UNDER our finger to play the F. Then we reset our hand and finish the scale with our five fingers.

Now that thumb tuck is going to take some practice! So don’t feel discouraged if you don’t get it right away.


We start at the top on C with our 5 finger (remember, the pinky!), then play down the five fingers until we reach the F with our thumb. Then, instead of tucking, we rotate OVER the thumb to land on the E with our 3 finger. I call this a Fly Over!

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-2-fly-over-1.jpg" alt="fly-over-1">

Ok! Now it’s time for the left hand! We’ll start with our pinky on the C below the C we were just using.

We begin by playing a five finger scale. When the thumb lands on the G, we do the Fly Over to bring our 3 finger to the A, then finish the scale up to C.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-2-fly-over-2.jpg" alt="fly-over-2">

Now you may have noticed that this is the opposite of our right hand. And that’s true! So on our way down, we will use the thumb tuck technique!

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-2-thumb-tuck-2.jpg" alt="thumb-tuck-2">

So when we get to the A we need to tuck our thumb UNDER our 3 finger to land on the G. We then reset our hand and play the five finger scale down to C.

We made it! That’s the C major scale. Now we need to PRACTICE! And I just want to give you a word of encouragement. Playing this scale, especially hands together can be difficult for beginners. So don’t get discouraged if it takes a bit of time! It can take days, sometimes weeks to master this.

The reason it is difficult is because we are changing fingering at different times. But with practice and time, it becomes easier.

So your homework for this lesson is to practice the C major scale. With your right hand, left hand and hands together. Remember to start at a nice easy pace that is comfortable for you.

Have fun, and I’ll see you in the next lesson!',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/scales.png',
                        'video_src' => '//player.vimeo.com/video/292382335',
                        'duration' => 8,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/lessons/minor-scale',
                        'title' => 'How To Play The A Minor Scale',
                        'caption' => 'Adding Emotion To Your Playing',
                        'desc' => 'Welcome back! So far we have learned the keyboard geography, how to play a five-finger scale and how to play a C major scale.

Today we are going to learn the A minor scale. So what is a minor scale? Well, in music every major scale has a relative minor scale. Think if it like a brother or sister scale. They have the same traits, but they sound different.

To find the relative minor scale, simply count up six notes from the note you’re starting on. We are in C, so we will start on C. If we count up six notes we get to A.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-3-relative-minor.png" alt="relative-minor">

So A is the relative minor of C!

So what does this have to do with playing scales? Well, remember when we played the C scale, there were NO black keys in the scale? The same is true of A minor. Both scales have exactly the SAME notes!

So why do they sound so different? Well, it’s all about where you start.

The A minor scale starts on (you guessed it!) A! Pay attention when you play it to see how different it sounds from the C scale. It sounds much ‘sadder’ I think. That is a common theme with minor scales. They sound ‘sad’ in relation to their relative majors.

But don’t feel too sad, because I have some good news! Because you already know how to play a C major scale, you can already play the A minor scale!

The finger patterns are EXACTLY the same. The only difference is the starting note.

So for the right hand, we will start on A. We play the first three notes, A B C and then TUCK our thumb UNDER the 3 finger to land on the D. Then reset and finish with a five finger scale.

Going back down we start with the 5 finger (remember, the pinky?) on A. We play DOWN five notes until we get to the D with our thumb, and then FLY OVER with our 3 finger to land on the C, and then finish the scale.

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-3-c-scale.jpg" alt="c-scale">

For our left hand, we start on the lower A. We play the first FIVE notes until we land on the E with our thumb, and then FLY OVER to land on the F with our 3 finger and finish the scale up to A.

On the way down we play the first THREE notes until we get to the F, and then we TUCK our thumb UNDER the 3 finger so that it lands on E. We reset and finish with the five finger scale.

And that is the A minor scale!!

Like I said in the last lesson, this can take a while to learn and master. So practice along with the video, and at home at your own tempo!

Have fun, and I’ll see you in the next (and LAST!) lesson!',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/minor-scale.png',
                        'video_src' => '//player.vimeo.com/video/292385224',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'getting-started/lessons/first-song',
                        'title' => 'Play Your First Song!',
                        'caption' => 'Putting It All Together',
                        'desc' => 'Welcome back! And welcome to your FINAL lesson in this Getting Started On The Piano series. This is my absolute favorite lesson the whole series because today we are going to learn CHORDS!!

And the reason I love chords so much? Is because with chords we can start playing SONGS!!

So what is a chord?! A chord is a collection of three notes played together. That’s it!

So let’s learn our first chord. The C chord:

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-4-c-chord.jpg" alt="c-chord">

The C chord has three notes: C, E and G. And the fingers we use to play them are the 1, the 3 and the 5.

In this lesson, we are going to learn four chords that are used in literally HUNDREDS of popular songs. We’ve already learned the C chord, so we only need to learn three more!

And the good news is that the fingering for ALL of the chords is exactly the SAME! For each chord, we will use the 1, 3 and 5 fingers.

So let’s learn the next one! The G chord:

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-4-g-chord.jpg" alt="g-chord">

So the notes of the G chord are G, B and D. Try it out!

Our next chord is the A minor chord. Remember that A is the relative minor of C, so the chord is a minor chord:

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-4-a-chord.jpg" alt="a-chord">

 Play it, and notice how it sounds ‘sadder’ than the other chords? That’s because it’s a minor chord.

And finally, we will learn an F chord:

<img src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lesson-4-f-chord.jpg" alt="f-chord">

So those are the four chords that make-up so many popular songs! You can play them in ANY order and they will always sound great together.

And that’s it! I really, really hope you’ve enjoyed this series and found it useful. You can watch any of the lessons again at any time.

And finally, have fun playing the piano!',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/your-first-song.png',
                        'video_src' => '//player.vimeo.com/video/296461777',
                        'duration' => 8,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Sight Reading Made Simple',
                'meta_desc' => 'If you’ve ever struggled through a music class or felt daunted by the notes on the page -- let us show you how easy reading music can be.',
                'meta_img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/og-image.jpg',
                'slug' => 'sight-reading-made-simple/lessons',
                'lessons' => [
                    [
                        'slug' => 'sight-reading-made-simple/lessons/1',
                        'title' => 'Getting Started With Sight-Reading',
                        'caption' => 'Learning the notes of the keyboard',
                        'desc' => 'Welcome to Sight-Reading Made Simple - A Beginner\'s Guide To Reading Music! In this series, you’ll learn how the notes on the piano are represented on a musical score. Even better, you’ll get some great tips and techniques to read music on a score quickly, so you can play music you may not have seen before.

I often say learning to sight-read music is like learning to read a foreign language while riding a bike and juggling. It’s NO SMALL TASK! But it can be done, and in this series, I am going to take you through step-by-step the best way to learn how to read music, without the confusion.

Now, you might already know some of the concepts I’m about to explain. If you do, that’s awesome! Feel free to skip ahead. But before we can learn what the notes are on a page, we need to know what they are on the keyboard.<div class="text-3xl mt-5 mb-2"><strong>Naming the notes</strong></div><p class="mb-4">Every key on the keyboard has a letter name attached to it. That letter is from the musical alphabet, which goes from A-G. Like this:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/1-keyboard-notes-A-G-1.png" alt="keyboard-notes-A-G-1">
When you get to G, you head back to A and repeat it all over again.<div class="text-3xl mt-5 mb-2"><strong>Your fingers are numbered</strong></div><p class="mb-4">Your fingers have numbers. Each finger (and thumb) has a different number. As you can see below, your thumbs are number 1 and your pinkies are number 5:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/1-finger-numbers-1.png" alt="finger-numbers">
Our ‘home base’ on the piano for this lesson will be Middle C. Middle C is the C note that is located nearest to the middle of your piano. (It’s not actually the middle note of the piano, but it is pretty close!)

We’ll start by putting our right-hand thumb (or number 1 finger) on Middle C. Your left-hand pinky (number 5) goes on the C BELOW Middle C. We call that Low C. This position is called C Position.

To warm up, try playing the five notes that lie under your fingers up and down a few times.<div class="text-3xl mt-5 mb-2"><strong>Let’s talk about rhythm</strong></div><p class="mb-4">We can’t learn how to read music without first understanding rhythm! Notated music is shown in rhythmic groupings. On a piece of music you will see vertical lines. These are called bar lines. The space between the lines is called a bar, or measure:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/ZZ-blank-staff-1.png" alt="ZZ-blank-staff"><p class="mb-4">Inside each bar, we have a certain number of notes. So how do we know how many notes we can fit inside each bar? Well, that’s the job of the Time Signature:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-time-signature-1.png" alt="trebleclef-time-signature"><p class="mb-4">The Time Signature is what tells us how many beats each bar gets. The time signature above is called Four-Four. It means that we can have four beats in each bar, and each beat = 1 quarter note.

This is a quarter note:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/zz-quarter-note-1.png" alt="zz-quarter-note"><p class="mb-4">It equals one beat. So we can fit four of these inside our bar.

There are other notes as well. This is a half note:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/zz-half-note-1.png" alt="zz-half-note"><p class="mb-4">A half note equals two beats. It is twice as long as a quarter note. So we could fit two half notes in our bar next to the quarter notes, like this:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/3h-quarter-notes-half-notes-numbers-nocount-1.png" alt="3h-quarter-notes-half-notes-numbers-nocount"><p class="mb-4">If we have a half note, that means we can have a whole note, right? Correct! This is a whole note:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/zz-whole-note-1.png" alt="zz-whole-note"><p class="mb-4">A whole note is twice as long as a half note, and four times as long as a quarter note. So it takes up the whole of our bar.

There is one more note we are going to learn, and it’s my personal favorite. It’s called an eighth note, and it looks like this:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/zz-eighth-note-1.png" alt="zz-eighth-note"><p class="mb-4">You might be able to guess how long an eighth note is. It is half the length of a quarter note. You can fit eight eighth notes in one bar. Make sense?

As you can see eighth notes have a little flag coming off their stem. That’s when they are on their own. When they are next to each other, they hold hands and connect, like a little bridge: Eighth notes are often grouped in two’s because two eighth notes equal 1 beat.</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/zz-eighth-notes-1.png" alt="zz-eighth-notes"><p>And that is your introduction to rhythm! Make sure you watch the lesson to practice along at the piano. In our next lesson, we are going to look at the musical staff and move the notes from the keys to the page.</p>',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb1.jpg',
                        'video_src' => '//player.vimeo.com/video/333189064',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sight-reading-made-simple/lessons/2',
                        'title' => 'The Treble Clef',
                        'caption' => 'What to play with your right hand',
                        'desc' => '<p class="mb-4">Welcome to lesson two in our Sight-Reading Made Simple series! Today, we are going to be looking at the Treble Clef and how to read the notes on the lines and spaces.

This is the Treble Clef:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-symbol-1.png" alt="trebleclef-symbol"><p class="mb-4">This symbol tells us that we are going to be playing with our right hand. The treble clef lives on something called the staff, which is just a fancy name for five lines and four spaces:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-time-signature-1.png" alt="trebleclef-time-signature">
Each one of these lines and spaces represents a letter of the musical alphabet.<div class="text-3xl mt-5 mb-2"><strong>Every Good Boy Does Fine</strong></div><p class="mb-4">Now that’s a lot to remember! Fortunately, there are some easy ways to remember the note names. To do this, it can be helpful to think of an easy-to-remember phrase. For example, the lines on the treble staff represent the notes E, G, B, D, and F. To remember this, teachers often use the phrase: Every Good Boy Deserves Fudge. It’s a silly phrase, but it’s easy to remember and that’s the whole point.

You can also use the phrase: Every Good Boy Does Fine. It’s really up to you for whatever is easiest to remember!</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-egbdf-1.png" alt="trebleclef-egbdf"><p class="mb-4">Remembering the spaces is even easier! From the bottom, the notes are F, A, C, and E. They spell the word FACE!</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-face-1.png" alt="trebleclef-face">
As you can see, the order of the notes on the staff is the same as the order of the notes of the actual keys on the piano. So F comes after E, and before G etc.<div class="text-3xl mt-5 mb-2"><strong>Middle C: A Line Of Its Own</strong></div><p class="mb-4">So where is Middle C in all this? Remember Middle C is our ‘home base’. Well, Middle C is actually BELOW the staff, on a separate little line all of its own. We’ll talk about why that is later in the series, but for now, you just need to know that’s where it is:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-middle-c-1.png" alt="trebleclef-middle-c"><p class="mb-4">So if that is C, then the space above the Middle C line but below the E line would be D! So going up from C we have C, D, E, F, G, A, B, C, D, E, and F on the top line. And that’s as far as we will go:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-all-notes-1.png" alt="trebleclef-all-notes"><div class="text-3xl mt-5 mb-2"><strong>Speeding It up</strong></div><p class="mb-4">So now we know what all the notes are, how do we get better at reading them quickly? We don’t want to stop at each note to figure out which one it is!

I find the easiest way to read notes, especially if you are reading them for the first time, is to combine knowing a few ‘landmark’ notes and then looking for patterns in the music.

For example. We know that notes that go from a line to a space, or from a space to a line are just one step apart. This means if we have Middle C, which is a line and D, which is a space, we can READ the C and the look at the next note and know it’s a D based on how far away it is from the C. If that pattern continues from line to space to line, we know we are just stepping up one note at a time:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-staff-eighth-notes-1.png" alt="trebleclef-staff-eighth-notes"><p class="mb-4">The more you practice and play, the more you will remember and get comfortable with all the notes on the staff, but this is a great way to increase the speed of your reading as you practice.

We can also use the same logic for what I like to call jumps (or skips). That’s where you have a line note going to the next line note. Or a space going to the next space. It’s jumping or skipping over the line or space in between.

So let’s start on Middle C again. We know this is C, as it is our landmark note. Just from that, we can tell that the next line up will be E, because it is two steps away from C on the keyboard. And the next line is G, which is two steps up from E.</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/trebleclef-staff-half-notes-1.png" alt="trebleclef-staff-half-notes">
This technique is really useful when we are playing phrases of music we haven’t seen before. To put it into practice, we only really need to know the first note of the phrase, and we can look at the pattern to figure out the rest really quickly!

In the next lesson, we’ll take a look at the Bass Clef, which is where our left-hand comes into play.

See you then!',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb2.jpg',
                        'video_src' => '//player.vimeo.com/video/333194948',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sight-reading-made-simple/lessons/3',
                        'title' => 'The Bass Clef',
                        'caption' => 'What to play with your left hand',
                        'desc' => '<p class="mb-4">Welcome to lesson three! It’s time to use our left hand and learn the Bass Clef. This is the Bass Clef:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/bass-clef-symbol-1.png" alt="bass-clef-symbol">
It tells us to play with our left hand. Just like the Treble Clef, the Bass Clef lives on a staff, with five lines and four spaces. And just like the Treble Clef, those lines and spaces each represent one note on the keyboard.

But here is where things get different. The lines and spaces are NOT the same notes as the treble clef.<div class="text-3xl mt-5 mb-2"><strong>All Cows Eat Grass</strong></div><p class="mb-4">Again, we can use some easy-to-remember phrases to learn what the lines and spaces are. For the lines, we can say Good Boys Deserve Fun Always to remember that it’s G, B, D, F, and A.</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/bassclef-gbdfa-fun-1.png" alt="bassclef-gbdfa-fun"><p class="mb-4">For the spaces, we can use the phrase All Cows Eat Grass to remember that the notes are A, C, E, and G.</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/bassclef-aceg-1.png" alt="bassclef-aceg">
So if we start at the bottom line of the staff, the notes are G, A, B, C, D, E, F, G, and then we land back on A.<div class="text-3xl mt-5 mb-2"><strong>Finding Low C</strong></div>
Just like we used Middle C in the Treble Clef as our home base, we will need a home base for our left hand. Remember in lesson one, that was Low C?

On the keyboard, Low C is the C below Middle C. On the bass staff Low C is the second space from the bottom. It is the ‘Cow’ in the phrase we just learned.<div class="text-3xl mt-5 mb-2"><strong>Time To Practice</strong></div>
Now that we understand which notes are which and we have found our home base, it’s time to explore the patterns we learned in the Treble Clef lesson, but with our left hand! Remember to look for the patterns: if a line moves to a space, it’s going up one step. If it ‘skips’, then we’re going up two steps!

This might take some time to get your head around, and that’s ok! It might help when you see the Treble and Bass Clefs together on one piece of music.

That’s what we’ll look at in the next lesson when we introduce the Grand Staff.',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb3.jpg',
                        'video_src' => '//player.vimeo.com/video/333199433',
                        'duration' => 9,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'sight-reading-made-simple/lessons/4',
                        'title' => 'The Grand Staff',
                        'caption' => 'Putting it all together',
                        'desc' => '<p class="mb-4">Welcome to the final lesson in this series on Sight-Reading Made Simple.

In this lesson, we are going to combine everything we have learned up until now, and hopefully explain some things that might have been confusing earlier.

To do that, we need to use the Grand Staff:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/grand-staff-blank-1.png" alt="grand-staff-blank">
The Grand Staff is what we use when we play both hands at the same time. Simply put, it’s both the treble and bass staffs joined together.<div class="text-3xl mt-5 mb-2"><strong>It All Makes Sense</strong></div><p class="mb-4">A lot of people ask - why are the notes different in the treble and bass staffs when all the lines and spaces look the same? I mentioned this in the last lesson.

Well, this is why - the Treble and Bass Staffs are not their own separate entities - they are connected in the Grand Staff.

And it all comes back to Middle C. Remember how Middle C is not the actual middle note on the piano? Well, it IS the middle note on the Grand Staff:</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/grand-staff-treble-bass-middle-c-1.png" alt="grand-staff-treble-bass-middle-c"><p class="mb-4">This is where we get the note names for the lines and spaces. From Middle C, when you move up in the treble you get D, then E, F, G, A, and so on.

When you move down in the bass, it goes from C to B, A, G, F, E, D, C and so on</p><img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/grand-staff-all-notes-1.png" alt="grand-staff-all-notes">
So you can see how the musical alphabet moves up and down from the middle! And that is how each line and space gets its note, and why the treble and bass are different.

I do have some practice tips that I think are REALLY important in setting you up for success:<div class="text-3xl mt-5 mb-2"><strong>Go Slow</strong></div>
This is so important. Especially for new concepts. We want to make sure we are learning things CORRECTLY. Going slow allows us to do that, and to master the concepts. Going slow now will pay off BIG TIME in the future. Otherwise, you risk developing bad habits, and if you go too fast too soon, you might hit a wall and get discouraged.<div class="text-3xl mt-5 mb-2"><strong>Hands Separately</strong></div>
Another big tip. NEVER practice anything hands together until you can play each hand by itself. This allows you to get comfortable and focus on one thing at a time, so you don’t get overwhelmed and frustrated.<div class="text-3xl mt-5 mb-2"><strong>Take It In Small Chunks</strong></div>
And finally, take it in small chunks. Don’t try to play the ENTIRE song the first time. Take it one bar at a time. Play the right hand, then the left hand, and then hands together. Then move on to the next bar. Once you get more comfortable start putting whole lines together. By taking it piece-by-piece you won’t get overwhelmed and you will really get to know the song.

And that’s it! The course is over. Hopefully, by now you understand the basics of rhythm and how to read notes on the staff in both the treble and bass! Now you can read a foreign language while riding a bike and juggling. NO SMALL TASK remember?!

But this is just the start. Hopefully, this has given you a good introduction to these very important concepts. If you’re wondering what to do now, then I cannot speak highly enough of a Pianote membership. Our structured lessons (similar to these) will guide you step-by-step so you always know exactly what to learn, and have FUN doing it.

Thanks again, I truly hope you enjoyed the course!

Have fun and good luck!',
                        'thumbnail' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb4.jpg',
                        'video_src' => '//player.vimeo.com/video/303793096',
                        'duration' => 10,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'earn 3 Songs On Piano',
                'meta_desc' => 'Start playing REAL songs today!',
                'meta_img' => 'https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/share-image.jpg',
                'slug' => 'learn-songs/lessons',
                'lessons' => [
                    [
                        'slug' => 'learn-songs/lessons/intro',
                        'title' => 'Introduction - The Musical Alphabet',
                        'caption' => 'Learn the note names on your piano to start playing real songs.',
                        'desc' => 'Hello and welcome to this free series that will give you the skills and confidence to start playing REAL songs on the piano.

Even if this is your very first time sitting down at the keys.

Just a couple of small things before you start…

These lessons are designed to be taken in order, as they build on skills that you’ll learn along the way. However, if you’re feeling comfortable (or brave), feel free to skip ahead to the song you want to learn the most.

And speaking of songs, <a href="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/learn-3-songs.zip"><u>here is the link</u></a> to download your resources pack.

Inside, you’ll find chord charts for all the songs, as well as a handy <a href="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/chord-chart.pdf"><u>chord reference poster</u></a> - so you can see ALL the chords on the piano that you’ll need for these songs.

And one thing that’s SUPER useful to know before you start playing your first song is…

        <strong>The Musical Alphabet</strong>

Just like English, music uses an alphabet, and while it’s similar…

There are some differences.

Every single key on the piano has a note name. Here are all the notes you’ll need to know right now:
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/all-keys.png" alt="all keys">
The great thing about the piano is that the note names simply repeat up and down the keyboard. So you start with A and work your way up to G. Once you get to G, you simply start over again.

Finding and remembering all the names of the notes can be tricky, so it’s helpful to identify some “Landmark” notes. These are notes that you can use to quickly find your spot on the keyboard.

The first is the most common: C

To find C, simply find a group of 2 black keys on the piano. The white note immediately to the left of that group of 2 is C.
<video class="rounded-xl my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/finding-c.mp4" autoplay muted playsinline loop></video>
The next landmark note to learn is F. To find F, simply look for a group of 3 black keys anywhere on the piano. The white note immediately to the left of that group of 3 is F.

Once you get comfortable finding C and F, it becomes a lot easier to move to any other note on the piano.

So your homework is to spend some time familiarizing yourself with the musical alphabet.

Once you can quickly find your landmark notes, you’re ready to learn your first song.

Just <a href="/learn-songs/lessons/someone-you-loved"><u>click here</u></a> to get started.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1123530929-9b5a5f5ff1cb24ce4a8fd6e1685a7fdc75112b59178a8510c861e933896aa9f0-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/542728954',
                        'duration' => 2,
                        'assets' => [
                            [
                                'title' => 'Download All PDFs',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/learn-3-songs.zip',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'learn-songs/lessons/someone-you-loved',
                        'title' => 'Lewis Capaldi - Someone You Loved',
                        'caption' => 'Start with this beautiful 4-chord ballad',
                        'desc' => 'We’ll be starting with a beautiful song that’s wildly popular, fun to play, super simple!

In fact, there are really only 4 chords you’ll need to know for this one.

<strong>How to play a “power chord”</strong>

If you’re a complete beginner, it might be challenging to play a chord with 3 notes, so we’ll start by playing what I like to call a “power chord”. This chord has only 2 notes, a bottom note (which is also called the root note) and a top note.

Remember your musical alphabet? Because you’ll need it to find the notes that you’ll be using for your chords.

Let’s look at the first line of the song.

This is called a chord chart. It contains the lyrics to the song and the chords written above the lyrics.
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/chords.jpg" alt="chords">
When you see a chord written above a word - that’s when you play it.

So let’s learn the 4 chords that make up 99% of this song. The first one is C.

As you’ll remember from the musical alphabet, you can find C immediately to the left of a group of 2 black notes.

Put your right-hand thumb on C. And then notice how your fingers rest on top of the other white notes.

Now, with your pinky, play the G note. That is a C power chord. You can use this shape on ANY of the white notes in the musical alphabet to play a power chord on that note.

Let’s put that to work.

The next chord is a G. So find G on the keyboard (It’s under your pinky, remember?).

Now, put your thumb on G and let your fingers rest on the white notes. You’ll notice your pinky is sitting on the note D.

So play it.

That’s a G power chord. You can repeat this for all the chords in the first line.

And here’s the good news…

hey simply repeat over and over again!


<strong>The Bridge. And a new chord</strong>

When you get to the bridge, you’ll notice something.
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/bridge-chords.png" alt="bridge-chords">
Dm?!

What the heck is that?! It’s a new chord! But don’t worry, because you’ll simply use the exact same process you’ve already learned.

So all you need to do is find D. It’s one up from C, remember?

Then let your fingers rest on the notes so your pinky will be over the note A. That’s your power chord.

Simple!

<strong>A note on minor chords</strong>

You’ll see the little “m” next to chords like Am and Dm.

That means it’s a minor chord. In music, there are 2 main types of chords: major and minor. The difference between them is the middle note.

You don’t need to know too much more about that here, but it helps to think of major chords as the “happier” sounding chords, while minor chords are more “sad” sounding.

If you’d like to hear the difference, you can refer to <a href="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/chord-chart.pdf"><u>the chord reference guide</u></a>. Try playing a C major chord, then play a C minor chord.

Notice the difference?

We’ll explore those types of chords a little bit more in the coming lessons, but for now it’s just something to be aware of.

So there you go! You’ve learned your first song and it’s a beautiful one.

Now go practice, and I’ll see you in the <a href="/learn-songs/lessons/hallelujah"><u>next lesson</u></a>.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1123526113-47c61468e59a55845cd1f63aeb12a4297016220b45b8b68d1f49cccf20e9bf0a-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/542728989',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/lewis-capaldi-someone-you-loved.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'learn-songs/lessons/hallelujah',
                        'title' => 'Leonard Cohen - Hallelujah',
                        'caption' => 'A new rhythm, and some fancy techniques',
                        'desc' => 'Hallelujah!

You’re ready to learn your next song. And it’s a classic.

Hallelujah by Leonard Cohen is one of the most famous songs in the world and has been covered by so many musicians over the years.

There are only 5 chords in this song, and the best news is…

You already know 4 of them! The chords of C, Am, G, and F will be familiar because you learned those in “Someone You Loved”.

So let’s start with the new chord you’ll need to know for this song.

It’s Em.

That means E minor (because of the little “m” remember?).

So the power chord for E minor can be played by putting your thumb on E, and your pinky finger on B.

<strong>Beyond power chords. The middle note</strong>

Power chords are great. And if that’s all you feel up to right now, keep playing them.

But I want to talk quickly about adding the middle note. This is the note that determines whether the chord is major or minor.

In the next lesson, I’ll teach you the formula to figure that out so you can play a major or minor chord on ANY note on the piano (even the black ones).

But for now, I’d like you to just practice adding in the middle note if you can. The good news is, this song is in the key of C - so EVERY note will be a white note.

Here is how to play all of the chords you’ll need for this song.
<div class="flex flex-wrap justify-center my-2">
        <img class="w-full sm:w-1/2" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/c-maj.png" alt="c-maj">
        <img class="w-full sm:w-1/2" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/a-min.png" alt="a-min">
        <img class="w-full sm:w-1/2" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/f-maj.png" alt="f-maj">
        <img class="w-full sm:w-1/2" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/g-maj.png" alt="g-maj">
        <img class="w-full sm:w-1/2" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/e-min.png" alt="e-min">
</div>
For all of these chords, you’ll use your thumb for the bottom note, your pinky for the top note, and your middle finger for the middle note.

<strong>A quick note on rhythm</strong>

As you learn this song, you’ll notice that it has a different rhythm than “Someone You Loved”.

This is because it has a different “Time Signature”.

That’s a musical concept we won’t go into here, but if you’d like to learn more about it, you can <a target="_blank" href="/trial"><u>start a free 7-day trial with Pianote</u></a>.

Basically, the rhythm is the “feel” of the song. It can be hard to figure that out from a chord chart, so I recommend listening to the song before you try and learn it. That way you know when the chord changes are happening and how the song is supposed to sound!

<strong>If you’re feeling brave…</strong>

This last part is much more challenging, so don’t feel like it’s something you “should” be able to do (at least not at this early stage).

But if you’re finding the chords a little “easy” and are looking for an added challenge, you could try playing each chord as a “broken” chord. This means instead of playing all the notes at the same time, you play them one at a time, going up and down.

The musical term for this is an “arpeggio”. Here’s what it looks like for the C chord:
<video class="rounded-xl my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/c-arpeggio.mp4" autoplay muted playsinline loop></video>
It sounds amazing, but it takes practice!

Make sure you watch the lesson to see how to play these arpeggios for all the chords in this song.

We have one more song to go, and this time we’ll get using some black notes! So when you’re ready,
        <a href="/learn-songs/lessons/love-story"><u>click here to start learning “Love Story” by Taylor Swift</u></a>.',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1123533706-a2a3b17fca5f8a71d1ea803cb4ade2f72ff45d92a60826da1e4a3b1c6d0ea7ed-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/542733159',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/leonard-cohen-hallelujah.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'learn-songs/lessons/love-story',
                        'title' => 'Taylor Swift - Love Story',
                        'caption' => 'A new twist on Shakespeare’s classic tale',
                        'desc' => 'Welcome to the final song in this series, and welcome to a new key signature!

This song is in the key of D, which means it uses 2 black notes!

But don’t worry…

You don’t need to memorize which ones, because I’ll show you the special formula that will allow you to play a major or minor chord on ANY note on the keyboard.

<strong>The Chord Formula</strong>

This is a super simple, easy-to-remember formula that you can learn in seconds and start using right away.

The first thing you need to do is pick a note.

Any note…
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/all-keys.png" alt="all-keys">
That’s the root note. We’re going to build a major and minor chord on top of it.

<strong>Building a major chord</strong>

From your root note (the bottom note), count up 4 half-steps.

A half-step is the smallest distance between notes on the piano. Here’s what it looks like:
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/half-step.png" alt="half-step">
So count up 4 half-steps from the bottom note and you’ll find the middle note. This note is what makes this a major chord.

Then, from the middle note count up another 3 half-steps to find the top note.

So the chord formula for a major chord is 4 half-steps, then 3 half-steps.

Try it!

We’ll use G as an example.

Start on G and count up 4 half-steps:
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/major-chord-1.png" alt="major-chord-1">
The note is B. Now to find the top note, count up another 3 half-steps:
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/major-chord-2.png" alt="major-chord-2">
Now you’re on D. So your G chord has the notes G-B-D.

Try it again...

Choose a random note on the keyboard and count up 4 half-steps, then 3 half-steps. You’ve just built a major chord!

<strong>Building a minor chord</strong>

This is very similar to the major chord, but the numbers are reversed.

So from the bottom note, you count up 3 half-steps to find the middle note. Then count up another 4 half-steps to find the top note.

Let’s use B as an example. Count up 3 half-steps from B:
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/minor-chord-1.png" alt="minor-chord-1">
Now, count up 4 half-steps to find the top note:
<img class="my-7" src="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/minor-chord-2.png" alt="minor-chord-2">
That’s it.

That’s the formula that will allow you to play any major or minor on the piano!

<strong>You’ve got this!</strong>

It can be a little daunting seeing new chords, but with the chord formula, you are now well-equipped to play any major or minor chord on the piano.

And don’t forget, you also have <a href="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/chord-chart.pdf"><u>the chord reference guide</u></a> that you can download and print out. It has every note on the piano, and all the major and minor chords.

Thank you so much for being part of this journey, and I hope you enjoy learning (and playing) these beautiful songs!',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1123576828-d4d2a0ec2867d0d6579ed0a02f62fc5ba567b42e73eb9c30d9292be5080d89b0-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/542742250',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'PDF',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/taylor-swift-love-story.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Beginner Piano Christmas Carols',
                'meta_desc' => 'Play these beautiful carols for your loved ones this holiday season.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/og-image.jpg',
                'slug' => 'christmas-carols/songs',
                'lessons' => [
                    [
                        'slug' => 'christmas-carols/songs/deck-the-halls',
                        'title' => 'Deck the Halls',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover01.jpg',
                        'video_src' => '//player.vimeo.com/video/376204427',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'The Music Sheet',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/deck-the-halls.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'christmas-carols/songs/joy-to-the-world',
                        'title' => 'Joy To The World',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover02.jpg',
                        'video_src' => '//player.vimeo.com/video/301298460',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'The Music Sheet',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/joy-to-the-world.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'christmas-carols/songs/o-holy-night',
                        'title' => 'O Holy Night',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover03.jpg',
                        'video_src' => '//player.vimeo.com/video/305099707',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'The Music Sheet',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/o-holy-night.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'christmas-carols/songs/silent-night',
                        'title' => 'Silent Night',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover04.jpg',
                        'video_src' => '//player.vimeo.com/video/647941747',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'The Music Sheet',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/silent-night.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'christmas-carols/songs/jingle-bells',
                        'title' => 'Jingle Bells',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover05.jpg',
                        'video_src' => '//player.vimeo.com/video/647939618',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'The Music Sheet',
                                'src' => 'https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/jingle-bells.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => 'Classical Piano Quick Start',
                'meta_desc' => 'Start playing beautiful classical piano with 4 easy lessons.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/lead-gen/classical-piano/og-image2.jpg',
                'slug' => 'classical-piano/lessons',
                'lessons' => [
                    [
                        'slug' => 'classical-piano/lessons/1',
                        'title' => '5 Classical Piano Tips',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1348484700-f1676cc5d71f95c91af4359c80dd48f31d8459d6d2e424ea221682a7da1e3624-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/659807663',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'classical-piano/lessons/2',
                        'title' => 'Hand Positioning & Exercises',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1348485549-add695e75f60eedd07eec845c0e07a8e9468795b94d2400bcc4f3288db9bb0db-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/659806997',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'classical-piano/lessons/3',
                        'title' => 'Playing Your First Classical Piece',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1348486156-e5fd383daef14bde0507d3485eb4935b1457be075f4546b3debca6f2d5c80be5-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/659807253',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'The Music Sheet',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/1-3-1%20Raindrop%20Prelude%20-%20Score-1640988541.pdf',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'classical-piano/lessons/4',
                        'title' => 'Playing With Expression',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1348487138-78a002bff259c65a103bb4a45a97021e03eba1da366155a554ba74b3a38a6da2-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/659808017',
                        'duration' => 6,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => '7 Days to Sight Reading',
                'meta_desc' => 'Learn to read music. Play your favorite songs. Have more fun.',
                'meta_img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/share_image.jpg',
                'slug' => '7-days-to-sight-reading/lessons',
                'assets' => [
                    [
                        'title' => 'Days 1-7 Exercises',
                        'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%20QT%20-%20Score-1664655069.pdf',
                        'soundslice' => ''
                    ],
                    [
                        'title' => 'Note Values PDFs',
                        'src' => 'https://d1923uyy6spedc.cloudfront.net/note-values-sheet-1664816317.pdf',
                        'soundslice' => ''
                    ],
                    [
                        'title' => 'Grand Staff Cheat Sheet PDF',
                        'src' => 'https://d1923uyy6spedc.cloudfront.net/TheGrandStaff-1664821463.pdf',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-1',
                        'title' => 'The Basics',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1514990478-1456b975745f9f80d5f75f3eca5d0d5b24930da81e55f26d553518f58ced95e7-d?mw=700&mh=393',
                        'video_src' => '//player.vimeo.com/video/753899485',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Day 1 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%201001-1664655393.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955555/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-2',
                        'title' => 'Musical Patterns',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1514991832-c6408142816720371226a0e44c32cc5048dc1af7241b408f5d3d30b096b75dcc-d?mw=700&mh=393',
                        'video_src' => '//player.vimeo.com/video/753900349',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Day 2 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%202001-1664655543.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955562/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-3',
                        'title' => 'Intervals',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1514994059-2e6973658803a10097d0352b6243bd708a7e4d39146a679b9016cf79132d67a3-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/753902457',
                        'duration' => 9,
                        'assets' => [
                            [
                                'title' => 'Day 3 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%203001-1664655618.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955569/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-4',
                        'title' => 'Play a Song',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1515022546-b4bbbf0ece20333790cb8151f2c395c255825aebaa02b871cbeaaf53046e19ff-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/753917225',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Day 4 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%204001-1664655669.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955570/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-5',
                        'title' => 'Chords & Arpeggios',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1515026590-10472ccad6746bedd5723115849cd66091c9570505f00d57b58e54bcb9ba2730-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/753922961',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'Day 5 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%204001-1664655669.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955570/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-6',
                        'title' => 'Understanding Rhythm',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1515029395-1756cc1c94bc47e78f4cd3249b0ac33a05b5eca857bc64ace7374eee99741f18-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/753925248',
                        'duration' => 10,
                        'assets' => [
                            [
                                'title' => 'Day 6 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%206001-1664655781.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955573/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                    [
                        'slug' => '7-days-to-sight-reading/lessons/day-7',
                        'title' => 'Putting it All Together',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1515033645-4566ef735c380776158a57e4a67a136cdd43f98667b8c102edf237d7fd3eecb8-d?mw=1000&mh=563',
                        'video_src' => '//player.vimeo.com/video/753928040',
                        'duration' => 8,
                        'assets' => [
                            [
                                'title' => 'Day 7 Exercise',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%207001-1664655908.svg',
                                'soundslice' => 'https://www.soundslice.com/scores/955575/embed/?api=1&scroll_type=2&branding=0'
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 2,
                'title' => '5 Days to Playing Piano',
                'meta_desc' => 'Start learning how to play the piano in just 5 days!',
                'meta_img' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/og-image.jpg',
                'slug' => 'piano-in-5-days/lessons',
                'lessons' => [
                    [
                        'slug' => 'piano-in-5-days/lessons/day-1-welcome-to-the-piano',
                        'title' => 'Day 1: Welcome To The Piano',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-01-1643338235.jpg',
                        'video_src' => '//player.vimeo.com/video/664409925',
                        'duration' => 13,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-1-practice-video-1',
                        'title' => 'Day 1: Practice Video 1',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day1-1.jpg',
                        'video_src' => '//player.vimeo.com/video/664410112',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-1-practice-video-2',
                        'title' => 'Day 1: Practice Video 2',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day1-2.jpg',
                        'video_src' => '//player.vimeo.com/video/664410180',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-2-you-can-play-a-melody',
                        'title' => 'Day 2: You Can Play A Melody',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-04-1643338334.jpg',
                        'video_src' => '//player.vimeo.com/video/664410235',
                        'duration' => 7,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-2-practice-video-1',
                        'title' => 'Day 2: Practice Video 1',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day2-1.jpg',
                        'video_src' => '//player.vimeo.com/video/664410311',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-3-you-can-use-both-hands',
                        'title' => 'Day 3: Using Both Hands',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-06-1643338374.jpg',
                        'video_src' => '//player.vimeo.com/video/664410345',
                        'duration' => 6,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-3-practice-video-1',
                        'title' => 'Day 3: Practice Video 1',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day3-1.jpg',
                        'video_src' => '//player.vimeo.com/video/664410459',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-3-practice-video-2',
                        'title' => 'Day 3: Practice Video 2',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day3-2.jpg',
                        'video_src' => '//player.vimeo.com/video/664410507',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-4-reading-music',
                        'title' => 'Day 4: Reading Music',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-09-1643338442.jpg',
                        'video_src' => '//player.vimeo.com/video/664410545',
                        'duration' => 11,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-4-practice-video-1',
                        'title' => 'Day 4: Practice Video 1',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4-1.jpg',
                        'video_src' => '//player.vimeo.com/video/664410689',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-4-practice-video-2',
                        'title' => 'Day 4: Practice Video 2',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4-2.jpg',
                        'video_src' => '//player.vimeo.com/video/664410713',
                        'duration' => 3,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-4-practice-video-3',
                        'title' => 'Day 4: Practice Video 3',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4-3.jpg',
                        'video_src' => '//player.vimeo.com/video/664410774',
                        'duration' => 1,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-5-you-can-play-piano',
                        'title' => 'Day 5: You Can Play Piano',
                        'desc' => '',
                        'thumbnail' => 'https://d1923uyy6spedc.cloudfront.net/5DaysToPlayingPiano-13-1643338576.jpg',
                        'video_src' => '//player.vimeo.com/video/664410799',
                        'duration' => 10,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-5-practice-video-1',
                        'title' => 'Day 5: Practice Video 1',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5-1.jpg',
                        'video_src' => '//player.vimeo.com/video/664410951',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-5-practice-video-2',
                        'title' => 'Day 5: Practice Video 2',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5-2.jpg',
                        'video_src' => '//player.vimeo.com/video/664410994',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/day-5-practice-video-3',
                        'title' => 'Day 5: Practice Video 3',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5-3.jpg',
                        'video_src' => '//player.vimeo.com/video/664411032',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'piano-in-5-days/lessons/tips-for-success',
                        'title' => 'Tips For Success',
                        'desc' => '',
                        'thumbnail' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/benefit.jpg',
                        'video_src' => '//player.vimeo.com/video/664409852',
                        'duration' => 6,
                        'assets' => [],
                    ],
                ],
            ],
            [
                'brand_id' => 4,
                'title' => '4 Exercises Guaranteed To Improve ANY Voice!',
                'meta_desc' => 'Anyone can sing! Singeo is here to show you how in this free mini lesson series.',
                'meta_img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/og-image.jpg',
                'slug' => '',
                'assets' => [
                    [
                        'title' => 'Download All MP3 Exercises',
                        'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-exercises.zip',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'improve-any-voice/lessons/1',
                        'title' => 'Why You Need To Exercise Your Voice',
                        'desc' => '',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-1.png',
                        'video_src' => '//player.vimeo.com/video/543823396',
                        'duration' => 2,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'improve-any-voice/lessons/2',
                        'title' => 'The Most Useful Vocal Exercise',
                        'desc' => '',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-2.png',
                        'video_src' => '//player.vimeo.com/video/543823457',
                        'duration' => 7,
                        'assets' => [
                            [
                                'title' => 'Bubble Exercise (Lower Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/1-bubble-lower.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Bubble Exercise (Higher Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/1-bubble-higher.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'improve-any-voice/lessons/3',
                        'title' => 'The Perfect Balance Exercise',
                        'desc' => '',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-3.png',
                        'video_src' => '//player.vimeo.com/video/543823544',
                        'duration' => 5,
                        'assets' => [
                            [
                                'title' => 'VVV Exercise (Lower Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/2-vvv-lower.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'VVV Exercise (Higher Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/2-vvv-higher.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'improve-any-voice/lessons/4',
                        'title' => 'The Strength Building, Pitch Accuracy Exercise',
                        'desc' => '',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png',
                        'video_src' => '//player.vimeo.com/video/543823601',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Creaky Door Exercise (Lower Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/3-creaky-door-lower.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Creaky Door Exercise (Higher Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/3-creaky-door-higher.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'improve-any-voice/lessons/5',
                        'title' => 'The Range Builder Exercise',
                        'desc' => '',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-5.png',
                        'video_src' => '//player.vimeo.com/video/543823668',
                        'duration' => 4,
                        'assets' => [
                            [
                                'title' => 'Nay Exercise (Lower Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-nay-lower.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Nay Exercise (Higher Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-nay-higher.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'improve-any-voice/lessons/6',
                        'title' => 'The Full Vocal Routine',
                        'desc' => '',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-6.png',
                        'video_src' => '//player.vimeo.com/video/543823702',
                        'duration' => 1,
                        'assets' => [
                            [
                                'title' => 'Full Routine (Lower Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/full-routine-lower.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Full Routine (Higher Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/full-routine-higher.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'improve-any-voice/lessons/7',
                        'title' => 'Outro',
                        'desc' => '',
                        'thumbnail' => 'https://i.vimeocdn.com/video/1125685312-50e2683c4aae37fd0bde953dcd962a8ec505a43e31c100ab92f3fb258424342c-d_800',
                        'video_src' => '//player.vimeo.com/video/543823720',
                        'duration' => 2,
                        'assignments' => [
                            [
                                'title' => 'Practice both chords.',
                                'subtitle' => 'Practice going back and forth between both chords, sounding clean, without hurting your fingers.',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6a.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/jBjfc/embed/?api=1&amp;scroll_type=2&amp;branding=0'
                            ],
                            [
                                'title' => 'Practice both chords in time with the jam track.',
                                'subtitle' => 'Practice going back and forth between both chords IN TIME along with the drum track.',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6b.svg',
                                'soundslice' => 'https://www.soundslice.com/slices/zWSfc/embed/?api=1&amp;scroll_type=2&amp;branding=0'
                            ],
                        ],
                        'assets' => [
                            [
                                'title' => 'Sheet Music',
                                'src' => 'https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6.png',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Practice Both Chords In Time',
                                'src' => 'https://d1923uyy6spedc.cloudfront.net/Practice%20Both%20Chords%20In%20Time%20-%20Full.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                ],
            ],
            [
                'brand_id' => 4,
                'title' => 'How To Stop Hating Your Voice',
                'meta_desc' => 'Learn to love your voice in 3 easy lessons!',
                'meta_img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/fb-share-image.jpg',
                'slug' => 'stop-hating-your-voice/lessons',
                'assets' => [
                    [
                        'title' => 'Download All MP3 Exercises',
                        'src' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/mp3s.zip',
                        'soundslice' => ''
                    ],
                ],
                'lessons' => [
                    [
                        'slug' => 'stop-hating-your-voice/lessons/1',
                        'title' => 'It\'s Normal!',
                        'desc' => 'One of the biggest misconceptions about singing is that the voice you are born with is the voice you have forever. In this very first lesson we’ll bust that myth.',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/thumb-1.png',
                        'video_src' => 'https://www.youtube.com/embed/bNpiCbY2y0c?rel=0&showinfo=0',
                        'duration' => 4,
                        'assets' => [],
                    ],
                    [
                        'slug' => 'stop-hating-your-voice/lessons/2',
                        'title' => 'Get Control',
                        'desc' => 'You’ll get control of your voice after this lesson. Follow along with these exercises to build a stronger voice you can be proud of.',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/thumb-2.png',
                        'video_src' => 'https://www.youtube.com/embed/MY-9Svljta0?rel=0&showinfo=0',
                        'duration' => 6,
                        'assets' => [
                            [
                                'title' => 'Practice Along (Lower Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/practice-along-lower.mp3',
                                'soundslice' => ''
                            ],
                            [
                                'title' => 'Practice Along (Higher Octave)',
                                'src' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/practice-along-higher.mp3',
                                'soundslice' => ''
                            ],
                        ],
                    ],
                    [
                        'slug' => 'stop-hating-your-voice/lessons/3',
                        'title' => 'Find Your New Voice',
                        'desc' => 'We’ll dive deeper into exactly how you can sound better. And what better way to do that than with a beautiful song! Sing this Adele ballad and sound more beautiful.',
                        'thumbnail' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/thumb-3.png',
                        'video_src' => 'https://www.youtube.com/embed/jxtgOO5z7SI?rel=0&showinfo=0',
                        'duration' => 8,
                        'assets' => [],
                    ],
                ],
            ],
//            [
//                'brand_id' => 4,
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
        LeadgenLessonAssignment::truncate();

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
                    'caption' => $lesson['caption'] ?? null,
                    'desc' => $lesson['desc'] ?? null,
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
                            'subtitle' => $asset['subtitle'] ?? null,
                            'src' => $asset['src'] ?? null,
                            'soundslice' => $asset['soundslice'] ?? null,
                        ]);
                    }
                }
            }
        }
    }
}
