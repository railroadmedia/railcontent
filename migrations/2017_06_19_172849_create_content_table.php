<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            ConfigService::$tableContent,
            function(Blueprint $table) {
                $table->increments('id');
                $table->string('status', 64)->index();
                $table->string('type', 64)->index();
                $table->integer('position')->index()->nullable();
                $table->integer('parent_id')->index()->nullable();
                $table->dateTime('published_on')->index()->nullable();
                $table->dateTime('created_on')->index();
                $table->dateTime('archived_on')->index()->nullable();
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
        Schema::dropIfExists(ConfigService::$tableContent);
    }
}
