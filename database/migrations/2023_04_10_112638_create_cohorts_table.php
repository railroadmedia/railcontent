<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('slug');
            $table->string('headline')
                ->nullable();
            $table->string('subheadline')
                ->nullable();
            $table->string('title')
                ->nullable();
            $table->string('cohort_image_url')
                ->nullable();
            $table->string('cohort_thrailer')
                ->nullable();
            $table->longText('description')
                ->nullable();
            $table->string('logo')
                ->nullable();
            $table->timestamp('start_date')
                ->nullable();
            $table->timestamp('end_date')
                ->nullable();
            $table->string('icon1')
                ->nullable();
            $table->string('icon1_title')
                ->nullable();
            $table->string('icon1_copy')
                ->nullable();

            $table->string('icon2')
                ->nullable();
            $table->string('icon2_title')
                ->nullable();
            $table->string('icon2_copy')
                ->nullable();

            $table->string('icon3')
                ->nullable();
            $table->string('icon3_title')
                ->nullable();
            $table->string('icon3_copy')
                ->nullable();

            $table->integer('pack_id');
            $table->timestamps();
        });

        $cohorts = [
            [
                'brand_id' => 1,
                'logo' => 'https://www.musora.com/musora-cdn/image/width=440,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer2_logo.png',
                'slug' => '30-day-drummer',
                'headline' => 'Learn the drums',
                'subheadline' => 'with daily guided workouts.',
                'title' => 'Learn the drums by playing the drums.',
                'cohort_image_url' => 'https://www.musora.com/musora-cdn/image/width=850,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_no_badge_thumb.jpg',

                'description' => 'It’s all about repetition.

Drumming is simple motions repeated over and over to create, you guessed it, RHYTHM! In this one-month class, you’ll build your musical skills following 10-minute daily guided drum workouts. By focusing on timing & coordination, you’ll learn the skills to play hundreds of your favorite pop & rock songs on the drums.

Plus, you’ll have a weekly LIVE session with your instructor, Domino Santantonio – to ask your questions, stay motivated, and make sure you’re having FUN playing the drums.

Scroll down to watch the trailer and save your seat in the first-ever 30-Day Drummer class.',
                'logo' => 'https://www.musora.com/musora-cdn/image/width=440,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer2_logo.png',
                'start_date' => '2023-03-27 11:11:01',
                'end_date' => '2023-04-27 11:11:01',
                'icon1' => 'fa-calendar',
                'icon1_title' => 'Course Dates',
                'icon1_copy' => 'February 27th to March 27th',
                'icon2' => 'fa-clock',
                'icon2_title' => 'Commitment',
                'icon2_copy' => '10 minutes/day for 30 days.',
                'icon3' => 'fa-throphy',
                'icon3_title' => 'Result',
                'icon3_copy' => 'Play your favorite songs with excellent timing & feel.',
                'cohort_thrailer' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/video-reel2.mp4',

                'pack_id' => 190
            ],
            [
                'brand_id' => 2,
                'logo' => 'https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png',
                'slug' => 'Pianote-piano',
                'headline' => 'Online piano lessons',
                'subheadline' => 'for all skill levels.',
                'title' => 'Learn the piano in 30 days.',
                'cohort_image_url' => 'https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb2.jpg',

                'description' => 'You don’t learn by watching. You learn by doing.

Start the year off right and learn the piano by playing the piano. You’ll be playing a song from the very first lesson and you’ll follow along with 10-minute daily guided sessions that show you exactly what to play.

No complicated theory. No need to read music. No frustration.

All you have to do is press play and follow along. Plus, you’ll have a weekly live lesson with Lisa Witt to answer your questions, stay motivated, and make sure you’re on track and having FUN on the piano.

So if you’re a new piano player and you’re wondering where to start…

Start here.

Scroll down to save your seat.',
                'start_date' => '2023-03-01 11:11:01',
                'end_date' => '2023-04-20 11:11:01',
                'icon1' => 'fa-calendar-day',
                'icon1_title' => 'Course Dates',
                'icon1_copy' => 'February 27th to March 27th',
                'icon2' => 'fa-clock',
                'icon2_title' => 'Commitment',
                'icon2_copy' => '10 minutes/day for 30 days.',
                'icon3' => 'fa-throphy',
                'icon3_title' => 'Result',
                'icon3_copy' => 'Play real songs on the
piano and sound beautiful.',
                'cohort_thrailer' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/video-reel2.mp4',

                'pack_id' => 240
            ],
        ];

        foreach ($cohorts as $cohort) {
            \App\Models\Cohort::create([
                                           'brand_id' => $cohort['brand_id'],
                                           'logo' => $cohort['logo'],
                                           'slug' => $cohort['slug'],
                                           'headline' => $cohort['headline'],
                                           'subheadline' => $cohort['subheadline'],
                                           'title' => $cohort['title'],
                                           'cohort_image_url' => $cohort['cohort_image_url'],

                                           'description' => $cohort['description'],
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

                                           'cohort_thrailer' => $cohort['cohort_thrailer'],
                'pack_id' => $cohort['pack_id'],
                                       ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cohorts');
    }
};
