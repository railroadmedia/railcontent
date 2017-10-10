<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateUserPreferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ConfigService::$tableUserPreference,
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->integer('language_id')->index();

                $table->foreign('language_id')->references('id')->on(ConfigService::$tableLanguage);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ConfigService::$tableUserPreference);
    }
}
