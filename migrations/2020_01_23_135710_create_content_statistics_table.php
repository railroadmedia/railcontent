<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            ConfigService::$tableContentStatistics,
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('content_type', 128)->index();
                $table->dateTime('content_published_on')->index()->nullable();
                $table->integer('total_completes')->index();
                $table->integer('total_starts')->index();
                $table->integer('total_comments')->index();
                $table->integer('total_likes')->index();
                $table->integer('total_added_to_list')->index();
                $table->dateTime('start_interval')->index();
                $table->dateTime('end_interval')->index();
                $table->integer('week_of_year')->index();
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
        Schema::dropIfExists(ConfigService::$tableContentStatistics);
    }
}
