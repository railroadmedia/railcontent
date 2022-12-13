<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlaylistsDataToPlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlists', function (Blueprint $table) {
                $table->string('name')->index();
                $table->text('description');
                $table->string('thumbnail_url')->nullable();
                $table->string('category')->index();
                $table->integer('private')->index()->default(true);
            });

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlist_content', function (Blueprint $table) {
                $table->integer('position')->index();
                $table->boolean('includes_assignments')
                    ->after('position')
                    ->default(true);
                $table->integer('start_second')->after('includes_assignments')
                    ->nullable();
                $table->integer('end_second')->after('start_second')
                    ->nullable();
            });

        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'playlist_likes',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('playlist_id')->index();
                $table->integer('user_id')->index();
                $table->dateTime('created_at')->index();
            });

        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'pinned_playlists',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('playlist_id')->index();
                $table->integer('user_id')->index();
                $table->dateTime('created_at')->index();
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
            ->table(config('railcontent.table_prefix') . 'user_playlists', function (Blueprint $table) {
                $table->dropColumn('name');
                $table->dropColumn('description');
                $table->dropColumn('thumbnail_url');
                $table->dropColumn('category');
                $table->dropColumn('private');
            });

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlist_content', function (Blueprint $table) {
                $table->dropColumn('position');
                $table->dropColumn('includes_assignments');
                $table->dropColumn('start_second');
                $table->dropColumn('end_second');
            });

        Schema::dropIfExists(config('railcontent.table_prefix') . 'playlist_likes');

        Schema::dropIfExists(config('railcontent.table_prefix') . 'pinned_playlists');
    }
}