<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            config('railcontent.table_prefix'). 'comment_likes',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('comment_id')->index();
                $table->integer('user_id')->index()->nullable();

                $table->dateTime('created_on')->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix'). 'comment_likes');
    }
}
