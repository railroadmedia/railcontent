<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoTypeStatusIndexesToContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                $table->index(['vimeo_video_id', 'youtube_video_id','type','status'], 'v_y_t_s');
                $table->index(['video'], 'video_index');
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
            ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                $table->dropIndex('v_y_t_s');
                $table->dropIndex('video_index');
            });
    }
}