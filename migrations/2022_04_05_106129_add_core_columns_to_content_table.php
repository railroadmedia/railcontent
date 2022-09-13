<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            ->table(config('railcontent.table_prefix').'content', function (Blueprint $table) {
                $table->string('album')
                    ->index()
                    ->after('user_id')
                    ->nullable();

                $table->string('artist')
                    ->index()
                    ->after('album')
                    ->nullable();

                $table->integer('associated_user_id')
                    ->index()
                    ->after('artist')
                    ->nullable();

                $table->string('avatar_url')
                    ->after('associated_user_id')
                    ->nullable();

                $table->string('bands')
                    ->after('avatar_url')
                    ->nullable();

                $table->string('cd_tracks')
                    ->after('bands')
                    ->nullable();

                $table->string('chord_or_scale')
                    ->index()
                    ->after('cd_tracks')
                    ->nullable();

                $table->string('difficulty')
                    ->index()
                    ->after('chord_or_scale')
                    ->nullable();

                $table->string('difficulty_range')
                    ->index()
                    ->after('difficulty')
                    ->nullable();

                $table->string('endorsements')
                    ->after('difficulty_range')
                    ->nullable();

                $table->integer('episode_number')
                    ->index()
                    ->after('endorsements')
                    ->nullable();

                $table->string('exercise_book_pages')
                    ->after('episode_number')
                    ->nullable();

                $table->integer('fast_bpm')
                    ->index()
                    ->after('exercise_book_pages')
                    ->nullable();

                $table->integer('forum_thread_id')
                    ->after('fast_bpm')
                    ->nullable();

                $table->string('high_soundslice_slug')
                    ->after('forum_thread_id')
                    ->nullable();

                $table->integer('high_video')
                    ->after('high_soundslice_slug')
                    ->nullable();

                $table->integer('home_staff_pick_rating')
                    ->index()
                    ->after('high_video')
                    ->nullable();

                $table->boolean('includes_song')
                    ->after('home_staff_pick_rating')
                    ->nullable();

                $table->integer('is_active')
                    ->index()
                    ->after('includes_song')
                    ->nullable();

                $table->integer('is_coach')
                    ->index()
                    ->after('is_active')
                    ->nullable();

                $table->integer('is_coach_of_the_month')
                    ->index()
                    ->after('is_coach')
                    ->nullable();

                $table->integer('is_featured')
                    ->index()
                    ->after('is_coach_of_the_month')
                    ->nullable();

                $table->integer('is_house_coach')
                    ->index()
                    ->after('is_featured')
                    ->nullable();

                $table->integer('length_in_seconds')
                    ->index()
                    ->after('is_house_coach')
                    ->nullable();

                $table->dateTime('live_event_start_time')
                    ->index()
                    ->after('length_in_seconds')
                    ->nullable();

                $table->dateTime('live_event_end_time')
                    ->index()
                    ->after('live_event_start_time')
                    ->nullable();

                $table->string('live_event_youtube_id')
                    ->after('live_event_end_time')
                    ->nullable();

                $table->string('live_stream_feed_type')
                    ->after('live_event_youtube_id')
                    ->nullable();

                $table->string('low_soundslice_slug')
                    ->after('live_stream_feed_type')
                    ->nullable();

                $table->integer('low_video')
                    ->after('low_soundslice_slug')
                    ->nullable();

                $table->string('name')
                    ->index()
                    ->after('low_video')
                    ->nullable();

                $table->integer('original_video')
                    ->after('name')
                    ->nullable();

                $table->string('pdf')
                    ->after('original_video')
                    ->nullable();

                $table->string('pdf_in_g')
                    ->after('pdf')
                    ->nullable();

                $table->string('qna_video')
                    ->after('pdf_in_g')
                    ->nullable();

                $table->string('released')
                    ->after('qna_video')
                    ->nullable();

                $table->boolean('show_in_new_feed')
                    ->after('qna_video')
                    ->index()
                    ->nullable();

                $table->string('slow_bpm')
                    ->after('show_in_new_feed')
                    ->nullable();

                $table->string('song_name')
                    ->index()
                    ->after('slow_bpm')
                    ->nullable();

                $table->string('soundslice_slug')
                    ->after('song_name')
                    ->nullable();

                $table->text('soundslice_xml_file_url')
                    ->after('soundslice_slug')
                    ->nullable();

                $table->integer('staff_pick_rating')
                    ->index()
                    ->after('soundslice_xml_file_url')
                    ->nullable();

                $table->integer('student_id')
                    ->index()
                    ->after('staff_pick_rating')
                    ->nullable();

                $table->string('title')
                    ->index()
                    ->after('student_id')
                    ->nullable();

                $table->string('transcriber_name')
                    ->index()
                    ->after('title')
                    ->nullable();

                $table->string('video')
                    ->after('transcriber_name')
                    ->nullable();

                $table->string('vimeo_video_id')
                    ->after('video')
                    ->nullable();

                $table->string('youtube_video_id')
                    ->after('vimeo_video_id')
                    ->nullable();

                $table->integer('xp')
                    ->index()
                    ->after('youtube_video_id')
                    ->nullable();

                $table->integer('week')
                    ->index()
                    ->after('xp')
                    ->nullable();
            });
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
            ->table(config('railcontent.table_prefix').'content', function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropColumn('difficulty');
                $table->dropColumn('home_staff_pick_rating');
                $table->dropColumn('qna_video');
                $table->dropColumn('style');
                $table->dropColumn('title');
                $table->dropColumn('video');
                $table->dropColumn('album');
                $table->dropColumn('artist');
                $table->dropColumn('cd_tracks');
                $table->dropColumn('chord_or_scale');
                $table->dropColumn('difficulty_range');
                $table->dropColumn('episode_number');
                $table->dropColumn('exercise_book_pages');
                $table->dropColumn('fast_bpm');
                $table->dropColumn('includes_song');
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
//                $table->dropColumn('sbt_bpm');
//                $table->dropColumn('sbt_exercise_number');
                $table->dropColumn('song_name');
                $table->dropColumn('soundslice_xml_file_url');
            });
    }
}