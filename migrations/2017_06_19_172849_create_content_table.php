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
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('slug', 255)->index();
                $table->string('status', 64)->index();
                $table->string('type', 64)->index();
                $table->integer('position')->index();
                $table->dateTime('published_on')->index();

                $table->timestamps();
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
