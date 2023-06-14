<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastProgressOnPlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix') . 'user_playlists',
            function(Blueprint $table) {
                $table->dateTime('last_progress')->index()->nullable();
                $table->index(['user_id', 'brand','last_progress'], 'publ');
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
                $table->dropColumn('last_progress');
                $table->dropIndex('publ');
            });

    }
}