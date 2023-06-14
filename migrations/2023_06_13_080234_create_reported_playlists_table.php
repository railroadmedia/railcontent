<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportedPlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'reported_playlists',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('playlist_id')->index();
                $table->integer('reporter_id')->index();

                $table->dateTime('created_on')->index();

                $table->index(['playlist_id', 'reporter_id'], 'pr');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix') . 'reported_playlists');
    }
}
