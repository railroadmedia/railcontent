<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            ConfigService::$tableComments,
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->integer('parent_id')->index()->nullable();
                $table->integer('user_id')->index();
                $table->text('comment');

                // this will get deleted once the UMS is finished
                $table->string('temporary_display_name');

                $table->dateTime('created_on')->index();
                $table->dateTime('deleted_at')->index()->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ConfigService::$tableComments);
    }
}
