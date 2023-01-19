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
                $table->text('description')->nullable();
                $table->string('thumbnail_url')->nullable();
                $table->string('category')->index()->nullable();
                $table->integer('private')->index()->default(true);
                $table->string('duration')->nullable();
            });

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlist_content', function (Blueprint $table) {
                $table->integer('position')->index();
                $table->json('extra_data')
                    ->after('position')
                    ->nullable();
                $table->integer('start_second')->after('extra_data')
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
                $table->string('brand')->index();

                $table->index(['user_id', 'brand'], 'ppub');
                $table->index(['user_id', 'playlist_id'], 'ppup');
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
                $table->dropColumn('duration');
            });

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlist_content', function (Blueprint $table) {
                $table->dropColumn('position');
                $table->dropColumn('extra_data');
                $table->dropColumn('start_second');
                $table->dropColumn('end_second');
            });

        Schema::dropIfExists(config('railcontent.table_prefix') . 'playlist_likes');

        Schema::dropIfExists(config('railcontent.table_prefix') . 'pinned_playlists');
    }
}