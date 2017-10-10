<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            ConfigService::$tableFields,
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('key', 255)->index();
                $table->string('value', 255)->nullable()->index();
                $table->string('type', 255)->index();
                $table->integer('position')->index()->nullable();
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
        Schema::dropIfExists(ConfigService::$tableFields);
    }
}
