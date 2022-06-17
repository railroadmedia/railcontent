<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'user_playlists',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('brand', 64)->index();
                $table->string('type', 64)->index();
                $table->integer('user_id')->index();
                $table->dateTime('created_at')->index();
                $table->dateTime('updated_at')->index()->nullable();
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
        Schema::dropIfExists(config('railcontent.table_prefix') . 'user_playlists');
    }
}
