<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveParentIdFromPlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlist_content', function (Blueprint $table) {
                $table->dropColumn('parent_id');
                $table->dropIndex('cp');
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
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix') . 'user_playlist_content',
            function(Blueprint $table) {
                $table->integer('parent_id')->index()->nullable();
                $table->index(['content_id','parent_id'], 'cp');
            });
    }
}