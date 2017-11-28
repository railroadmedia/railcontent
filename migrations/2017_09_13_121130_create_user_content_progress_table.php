<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateUserContentProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            ConfigService::$tableUserContentProgress,
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->integer('user_id')->index();
                $table->string('state', 255)->index();
                $table->integer('progress_percent')->index()->default(0);
                $table->dateTime('updated_on');

                $table->unique(['content_id', 'user_id']);
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
        Schema::dropIfExists(ConfigService::$tableUserContentProgress);
    }
}
