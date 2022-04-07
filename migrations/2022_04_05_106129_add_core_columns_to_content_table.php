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

                    $table->integer('home_staff_pick_rating')
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

                    $table->string('title')
                        ->index()
                        ->after('qna_video')
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

                    $table->string('bpm')
                        ->index()
                        ->after('artist')
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
                        ->after('exercise_book_pages')
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


                    $table->string('transcriber_name')
                        ->index()
                        ->after('released')
                        ->nullable();

                    $table->integer('week')
                        ->index()
                        ->after('transcriber_name')
                        ->nullable();

                    $table->string('avatar_url')
                        ->index()
                        ->after('week')
                        ->nullable();

                    $table->integer('length_in_seconds')
                        ->index()
                        ->after('avatar_url')
                        ->nullable();

                    $table->string('soundslice_slug')
                        ->index()
                        ->after('avatar_url')
                        ->nullable();

                    $table->integer('staff_pick_rating')
                        ->index()
                        ->after('soundslice_slug')
                        ->nullable();

                    $table->integer('student_id')
                        ->index()
                        ->after('staff_pick_rating')
                        ->nullable();

                    $table->string('vimeo_video_id')
                        ->index()
                        ->after('student_id')
                        ->nullable();

                    $table->string('youtube_video_id')
                        ->index()
                        ->after('vimeo_video_id')
                        ->nullable();

                    $table->boolean('show_in_new_feed')->after('youtube_video_id')->index()->nullable();

                    $table->string('bands')
                        ->index()
                        ->after('show_in_new_feed')
                        ->nullable();

                    $table->string('endorsements')
                        ->index()
                        ->after('bands')
                        ->nullable();

                    $table->string('focus')
                        ->index()
                        ->after('endorsements')
                        ->nullable();

                    $table->integer('forum_thread_id')
                        ->index()
                        ->after('focus')
                        ->nullable();

                    $table->integer('is_active')
                        ->index()
                        ->after('forum_thread_id')
                        ->nullable();

                    $table->integer('is_coach')
                        ->index()
                        ->after('forum_thread_id')
                        ->nullable();

                    $table->integer('is_coach_of_the_month')
                        ->index()
                        ->after('is_coach')
                        ->nullable();

                    $table->integer('is_house_coach')
                        ->index()
                        ->after('is_coach_of_the_month')
                        ->nullable();

                    $table->integer('is_featured')
                        ->index()
                        ->after('is_house_coach')
                        ->nullable();

                    $table->integer('associated_user_id')
                        ->index()
                        ->after('is_featured')
                        ->nullable();

                    $table->string('high_soundslice_slug')
                        ->index()
                        ->after('associated_user_id')
                        ->nullable();

                    $table->string('low_soundslice_slug')
                        ->index()
                        ->after('high_soundslice_slug')
                        ->nullable();

                    $table->integer('high_video')
                        ->index()
                        ->after('low_soundslice_slug')
                        ->nullable();

                    $table->integer('low_video')
                        ->index()
                        ->after('high_video')
                        ->nullable();

                    $table->integer('original_video')
                        ->index()
                        ->after('artist')
                        ->nullable();

                    $table->string('pdf')
                        ->index()
                        ->after('original_video')
                        ->nullable();

                    $table->string('pdf_in_g')
                        ->index()
                        ->after('pdf')
                        ->nullable();

                    $table->string('sbt_bpm')
                        ->index()
                        ->after('pdf_in_g')
                        ->nullable();

                    $table->integer('sbt_exercise_number')
                        ->index()
                        ->after('sbt_bpm')
                        ->nullable();

                    $table->string('song_name')
                        ->index()
                        ->after('sbt_exercise_number')
                        ->nullable();

                    $table->string('soundslice_xml_file_url')
                        ->index()
                        ->after('song_name')
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
        Schema::connection(config('railcontent.database_connection_name'))
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
                    $table->dropColumn('transcriber_name');
                    $table->dropColumn('week');
                    $table->dropColumn('avatar_url');
                    $table->dropColumn('length_in_seconds');
                    $table->dropColumn('soundslice_slug');
                    $table->dropColumn('staff_pick_rating');
                    $table->dropColumn('student_id');
                    $table->dropColumn('vimeo_video_id');
                    $table->dropColumn('youtube_video_id');
                    $table->dropColumn('show_in_new_feed');
                    $table->dropColumn('bands');
                    $table->dropColumn('endorsements');
                    $table->dropColumn('focus');
                    $table->dropColumn('forum_thread_id');
                    $table->dropColumn('is_active');
                    $table->dropColumn('is_coach');
                    $table->dropColumn('is_coach_of_the_month');
                    $table->dropColumn('is_featured');
                    $table->dropColumn('associated_user_id');
                    $table->dropColumn('high_soundslice_slug');
                    $table->dropColumn('low_soundslice_slug');
                    $table->dropColumn('high_video');
                    $table->dropColumn('low_video');
                    $table->dropColumn('original_video');
                    $table->dropColumn('pdf');
                    $table->dropColumn('pdf_in_g');
                    $table->dropColumn('sbt_bpm');
                    $table->dropColumn('sbt_exercise_number');
                    $table->dropColumn('song_name');
                    $table->dropColumn('soundslice_xml_file_url');
                }
            );
    }
}