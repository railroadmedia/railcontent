<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('cohorts', function (Blueprint $table) {
            $table->renameColumn('description', 'body_top_description');
            $table->renameColumn('cohort_thrailer', 'cohort_trailer');
            $table->renameColumn('cohort_image_url', 'header_image_url');
            $table->renameColumn('logo', 'header_logo');
            $table->renameColumn('title', 'body_title');
            $table->string('header_description')->nullable();
            $table->string('body_image_url')->nullable();
            $table->string('body_logo')->nullable();
            $table->longText('body_bottom_description')->nullable();
            $table->string('dropdown_title')->nullable();
            $table->string('bottom_title')->nullable();
            $table->string('bottom_description')->nullable();
        });

        Schema::create('cohort_dropdowns', function (Blueprint $table) {
            $table->integer('cohort_id');
            $table->string('title');
            $table->longText('description');
            $table->timestamps();
        });

        \App\Models\Cohort::truncate();

        $cohorts = [
            [
                'brand_id' => 1,
                'header_logo' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer2_logo.png',
                'slug' => '30-day-drummer',
                'headline' => 'Learn the drums',
                'subheadline' => 'with daily guided workouts.',
                'header_description' => 'Save your seat in Season 2 starting February 27th.',
                'header_image_url' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_no_badge_thumb.jpg',

                'body_title' => 'Learn the drums by playing the drums.',
                'body_top_description' => 'It’s all about repetition.<br><br>
Drumming is simple motions repeated over and over to create, you guessed it, RHYTHM! In this one-month class, you’ll build your musical skills following 10-minute daily guided drum workouts. By focusing on timing & coordination, you’ll learn the skills to play hundreds of your favorite pop & rock songs on the drums.<br><br>
Plus, you’ll have a weekly LIVE session with your instructor, Domino Santantonio – to ask your questions, stay motivated, and make sure you’re having FUN playing the drums.<br><br>
Scroll down to watch the trailer and save your seat in the first-ever 30-Day Drummer class.',
                'body_image_url' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_no_badge_thumb.jpg',
                'body_logo' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Just_Press_Play_logo.png',
                'body_bottom_description' => '30-Day Drummer is a NEW way to learn the drums – where you learn by actually playing the drums. By focusing on timing & coordination, you’ll build your skills over thirty days following daily guided workouts with your instructor, Domino Santantonio.<br><br>
And the best part is you only need 10 minutes per day.
',
                'dropdown_title' => 'Still have questions?',
                'dropdowns' => [
                    [
                        'title' => 'Why do I need to register if I get it for free as a member?',
                        'description' => 'It’s a 30-day course and it only works if you’re actively participating. So we wanted to make sure you raised your hand to enroll in the journey.<br><br>
This isn’t a “watch a lesson, go do something else for 10 days, watch another” type of routine. So we’re asking for a commitment from anybody who participates.',
                    ],
                    [
                        'title' => ' Do I need to attend the lessons live?',
                        'description' => 'The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are totally optional, and they’ll also include a recording that you can watch or re-watch anytime.',
                    ],
                ],
                'bottom_title' => 'Commit to Your Improvement',
                'bottom_description' => 'Classes start on {date}.',
                'start_date' => '2023-03-27 11:11:01',
                'end_date' => '2023-04-27 11:11:01',
                'icon1' => 'fa-calendar',
                'icon1_title' => 'Course Dates',
                'icon1_copy' => 'February 27th to March 27th',
                'icon2' => 'fa-clock',
                'icon2_title' => 'Commitment',
                'icon2_copy' => '10 minutes/day for 30 days.',
                'icon3' => 'fa-trophy',
                'icon3_title' => 'Result',
                'icon3_copy' => 'Play your favorite songs with excellent timing & feel.',
                'cohort_trailer' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/video-reel2.mp4',

                'pack_id' => 190
            ],
            [
                'brand_id' => 2,
                'header_logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png',
                'slug' => 'Pianote-piano',
                'headline' => 'Online piano lessons',
                'subheadline' => 'for all skill levels.',
                'body_title' => 'Learn the piano in 30 days.',
                'header_image_url' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb2.jpg',
                'header_description' => 'Save your seat for season 2 starting May 1st.',

                'body_top_description' => 'You don’t learn by watching. You learn by doing.<br><br>
Start the year off right and learn the piano by playing the piano. You’ll be playing a song from the very first lesson and you’ll follow along with 10-minute daily guided sessions that show you exactly what to play.<br><br>
No complicated theory. No need to read music. No frustration.<br><br>
All you have to do is press play and follow along. Plus, you’ll have a weekly live lesson with Lisa Witt to answer your questions, stay motivated, and make sure you’re on track and having FUN on the piano.<br><br>
So if you’re a new piano player and you’re wondering where to start…<br><br>
Start here.<br><br>
Scroll down to save your seat.',
                'body_image_url' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/video-thumb.jpg',
                'body_logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/Just_Press_Play_logo.png',
                'body_bottom_description' => '
New Piano Players Start Here is unlike any other way to learn the piano. From day 1 you’ll be playing a REAL song by following guided play-along lessons with your instructor, Lisa Witt.<br><br>
This isn’t a video game. You’ll be building your skills every single day. And the best part…<br><br>
It only takes 10 minutes a day.',
                'dropdown_title' => 'Still have questions?',
                'dropdowns' => [
                    [
                        'title' => 'What is Pianote?',
                        'description' => 'Pianote is an online platform that offers an organized piano lesson curriculum, artist courses on popular topics, 1000+ songs transcribed note-for-note, and a supportive global community of students and teachers.',
                    ],
                    [
                        'title' => 'Is Pianote good for beginners?',
                        'description' => 'Yes! You’ll always know what to practice with step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community.',
                    ],
                    [
                        'title' => 'Does Pianote have anything for advanced pianists?',
                        'description' => 'Pianote is the perfect companion for advanced pianists, giving you access to artist courses so you can gain insights and inspiration from professionals. Plus, you’ll get note-for-note sheet music for thousands of songs and practical playback tools, so you can take on any new challenge with confidence.',
                    ],
                    [
                        'title' => 'Am I too old to learn piano?',
                        'description' => 'You’re never too old to learn piano. Pianote has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring pianists just like you who are learning and applying their skills to music.',
                    ],
                    [
                        'title' => 'Do I need to be tech-savvy to learn through your app?',
                        'description' => 'Not at all! Technology is here to make your life easier, and Pianote is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support.',
                    ],
                ],
                'bottom_title' => 'Commit to Your Improvement',
                'bottom_description' => 'Classes start on {date}.',
                'start_date' => '2023-03-01 11:11:01',
                'end_date' => '2023-04-20 11:11:01',
                'icon1' => 'fa-calendar-day',
                'icon1_title' => 'Course Dates',
                'icon1_copy' => 'February 27th to March 27th',
                'icon2' => 'fa-clock',
                'icon2_title' => 'Commitment',
                'icon2_copy' => '10 minutes/day for 30 days.',
                'icon3' => 'fa-trophy',
                'icon3_title' => 'Result',
                'icon3_copy' => 'Play real songs on the
piano and sound beautiful.',
                'cohort_trailer' => '//player.vimeo.com/video/798501810?autoplay=1',

                'pack_id' => 240
            ],
        ];

        foreach ($cohorts as $cohort) {
            $addcohort = \App\Models\Cohort::create([
                'brand_id' => $cohort['brand_id'],
                'header_logo' => $cohort['header_logo'],
                'slug' => $cohort['slug'],
                'headline' => $cohort['headline'],
                'subheadline' => $cohort['subheadline'],
                'header_description' => $cohort['header_description'],
                'header_image_url' => $cohort['header_image_url'],

                'body_title' => $cohort['body_title'],
                'body_top_description' => $cohort['body_top_description'],
                'body_image_url' => $cohort['body_image_url'],
                'body_bottom_description' => $cohort['body_bottom_description'],
                'body_logo' => $cohort['body_logo'],

                'dropdown_title' => $cohort['dropdown_title'],

                'bottom_title' => $cohort['bottom_title'],
                'bottom_description' => $cohort['bottom_description'],

                'start_date' => $cohort['start_date'],
                'end_date' => $cohort['end_date'],

                'icon1' => $cohort['icon1'],
                'icon1_title' => $cohort['icon1_title'],
                'icon1_copy' => $cohort['icon1_copy'],

                'icon2' => $cohort['icon2'],
                'icon2_title' => $cohort['icon2_title'],
                'icon2_copy' => $cohort['icon2_copy'],

                'icon3' => $cohort['icon3'],
                'icon3_title' => $cohort['icon3_title'],
                'icon3_copy' => $cohort['icon3_copy'],

                'cohort_trailer' => $cohort['cohort_trailer'],
                'pack_id' => $cohort['pack_id'],
            ]);

            foreach ($cohort['dropdowns'] as $dropdown){
                \App\Models\CohortDropdown::create([
                    'cohort_id' => $addcohort->id,
                    'title' => $dropdown['title'],
                    'description' => $dropdown['description'],
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('cohorts', function (Blueprint $table) {
            $table->renameColumn('body_top_description', 'description');
            $table->renameColumn('cohort_trailer', 'cohort_thrailer');
            $table->renameColumn('header_image_url', 'cohort_image_url');
            $table->renameColumn('header_logo', 'logo');
            $table->renameColumn('body_title', 'title');
            $table->dropColumn('header_description');
            $table->dropColumn('body_image_url');
            $table->dropColumn('body_logo');
            $table->dropColumn('body_bottom_description');
            $table->dropColumn('dropdown_title');
            $table->dropColumn('bottom_title');
            $table->dropColumn('bottom_description');
        });

        Schema::dropIfExists('cohort_dropdowns');
    }
};
