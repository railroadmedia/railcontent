<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandOnPlaylistsLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix') . 'playlist_likes',
            function(Blueprint $table) {
                $table->string('brand')->index();
                $table->index(['user_id', 'brand'], 'plub');
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
            ->table(config('railcontent.table_prefix') . 'playlist_likes', function (Blueprint $table) {
                $table->dropColumn('brand');
                $table->dropIndex('plub');
            });

    }
}