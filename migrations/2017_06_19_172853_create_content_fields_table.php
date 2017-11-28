<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            ConfigService::$tableContentFields,
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('key', 255)->index();
                $table->string('value', 255)->nullable()->index();
                $table->string('type', 255)->index();
                $table->integer('position')->index()->nullable();

                $table->index(['key', 'value', 'type', 'content_id'], 'kvtc');
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
        Schema::dropIfExists(ConfigService::$tableContentFields);
    }
}
