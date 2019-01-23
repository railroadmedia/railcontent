<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCoreColumnsToContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content',
                function (Blueprint $table) {

                    $table->string('difficulty')
                        ->index()
                        ->after('user_id')
                        ->nullable();

                    $table->string('home_staff_pick_rating')
                        ->index()
                        ->after('difficulty')
                        ->nullable();

                    $table->integer('legacy_id')
                        ->index()
                        ->after('home_staff_pick_rating')
                        ->nullable();

                    $table->integer('legacy_wordpress_post_id')
                        ->index()
                        ->after('legacy_id')
                        ->nullable();

                    $table->string('qna_video')
                        ->index()
                        ->after('legacy_wordpress_post_id')
                        ->nullable();

                    $table->string('style')
                        ->index()
                        ->after('qna_video')
                        ->nullable();

                    $table->string('title')
                        ->index()
                        ->after('style')
                        ->nullable();

                    $table->string('video')
                        ->index()
                        ->after('title')
                        ->nullable();

                    $table->integer('xp')
                        ->index()
                        ->after('video')
                        ->nullable();

                    $table->string('album')
                        ->index()
                        ->after('xp')
                        ->nullable();

                    $table->string('artist')
                        ->index()
                        ->after('album')
                        ->nullable();

                    $table->integer('bpm')
                        ->index()
                        ->after('video')
                        ->nullable();

                    $table->string('cd_tracks')
                        ->index()
                        ->after('bpm')
                        ->nullable();

                    $table->string('chord_or_scale')
                        ->index()
                        ->after('cd_tracks')
                        ->nullable();

                    $table->string('difficulty_range')
                        ->index()
                        ->after('chord_or_scale')
                        ->nullable();

                    $table->integer('episode_number')
                        ->index()
                        ->after('difficulty_range')
                        ->nullable();

                    $table->string('exercise_book_pages')
                        ->index()
                        ->after('episode_number')
                        ->nullable();

                    $table->integer('fast_bpm')
                        ->index()
                        ->after('exercise-book-pages')
                        ->nullable();

                    $table->boolean('includes_song')
                        ->index()
                        ->after('fast_bpm')
                        ->nullable();

                    $table->string('instructors')
                        ->index()
                        ->after('includes_song')
                        ->nullable();

                    $table->dateTime('live_event_start_time')
                        ->index()
                        ->after('instructors')
                        ->nullable();

                    $table->dateTime('live_event_end_time')
                        ->index()
                        ->after('live_event_start_time')
                        ->nullable();

                    $table->string('live_event_youtube_id')
                        ->index()
                        ->after('live_event_end_time')
                        ->nullable();

                    $table->string('live_stream_feed_type')
                        ->index()
                        ->after('live_event_youtube_id')
                        ->nullable();

                    $table->string('name')
                        ->index()
                        ->after('live_stream_feed_type')
                        ->nullable();

                    $table->string('released')
                        ->after('name')
                        ->nullable();

                    $table->string('slow_bpm')
                        ->after('released')
                        ->nullable();

                    $table->string('total_xp')
                        ->index()
                        ->after('slow_bpm')
                        ->nullable();

                    $table->string('transcriber_name')
                        ->index()
                        ->after('total_xp')
                        ->nullable();

                    $table->integer('week')
                        ->index()
                        ->after('transcriber_name')
                        ->nullable();
                }
            );
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('usora.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->dropColumn('difficulty');
                    $table->dropColumn('home_staff_pick_rating');
                    $table->dropColumn('legacy_id');
                    $table->dropColumn('legacy_wordpress_post_id');
                    $table->dropColumn('qna_video');
                    $table->dropColumn('style');
                    $table->dropColumn('title');
                    $table->dropColumn('video');
                    $table->dropColumn('album');
                    $table->dropColumn('artist');
                    $table->dropColumn('bpm');
                    $table->dropColumn('cd_tracks');
                    $table->dropColumn('chord_or_scale');
                    $table->dropColumn('difficulty_range');
                    $table->dropColumn('episode_number');
                    $table->dropColumn('exercise_book_pages');
                    $table->dropColumn('fast_bpm');
                    $table->dropColumn('includes_song');
                    $table->dropColumn('instructors');
                    $table->dropColumn('live_event_start_time');
                    $table->dropColumn('live_event_end_time');
                    $table->dropColumn('live_event_youtube_id');
                    $table->dropColumn('live_stream_feed_type');
                    $table->dropColumn('name');
                    $table->dropColumn('released');
                    $table->dropColumn('slow_bpm');
                    $table->dropColumn('total_xp');
                    $table->dropColumn('transcriber_name');
                    $table->dropColumn('week');
                }
            );
    }
}