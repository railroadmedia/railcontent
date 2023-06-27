<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameOnPlaylistItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix') . 'user_playlist_content',
            function(Blueprint $table) {
                $table->string('content_name')->index()->nullable();
                $table->string('playlist_item_name')->index()->nullable();
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
            ->table(config('railcontent.table_prefix') . 'user_playlist_content', function (Blueprint $table) {
                $table->dropColumn('content_name');
                $table->dropIndex('playlist_item_name');
            });

    }
}