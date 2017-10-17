<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateUserLanguagePreferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ConfigService::$tableUserLanguagePreference,
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->integer('language_id')->index();
                $table->string('brand', 255)->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ConfigService::$tableUserLanguagePreference);
    }
}
