<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class DropContentVimeoYoutubeVideoIndex extends Migration
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
                    $table->dropIndex('vimeo_video_id_index');
                    $table->dropIndex('youtube_video_id_index');

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
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                    $table->index(['vimeo_video_id'], 'vimeo_video_id_index');
                    $table->index(['youtube_video_id'], 'youtube_video_id_index');
                }
            );
    }
}
