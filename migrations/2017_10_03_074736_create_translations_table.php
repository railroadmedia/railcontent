<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ConfigService::$tableTranslations,
            function(Blueprint $table) {
                $table->increments('id');
                $table->string('entity_type',255)->index();
                $table->integer('entity_id')->index();
                $table->integer('language_id')->index();
                $table->string('value', 255)->index();

                $table->unique(['entity_type','entity_id','language_id']);
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
        Schema::dropIfExists(ConfigService::$tableTranslations);
    }
}
