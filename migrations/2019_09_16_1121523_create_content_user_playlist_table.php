<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentUserPlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'user_playlist_content',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->integer('user_playlist_id')->index();

                $table->dateTime('created_at')->index();
                $table->dateTime('updated_at')->index()->nullable();

                $table->index(['user_playlist_id', 'content_id'], 'upc');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix') . 'user_playlist_content');
    }
}
