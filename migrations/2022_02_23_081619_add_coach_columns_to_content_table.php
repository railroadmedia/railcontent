<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCoachColumnsToContentTable extends Migration
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

                    $table->string('bands')
                        ->index()
                        ->after('youtube_video_id')
                        ->nullable();

                    $table->string('endorsements')
                        ->index()
                        ->after('bands')
                        ->nullable();

                    $table->integer('forum_thread_id')
                        ->index()
                        ->after('endorsements')
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

                    $table->integer('is_featured')
                        ->index()
                        ->after('is_coach_of_the_month')
                        ->nullable();

                    $table->integer('is_house_coach')
                        ->index()
                        ->after('is_featured')
                        ->nullable();

                    $table->integer('associated_user_id')
                        ->index()
                        ->after('is_house_coach')
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
        Schema::connection(config('usora.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->dropColumn('bands');
                    $table->dropColumn('endorsements');
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