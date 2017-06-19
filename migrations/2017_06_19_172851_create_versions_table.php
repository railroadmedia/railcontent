<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            ConfigService::$tableVersions,
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('subject_id')->index();
                $table->string('subject_type', 64)->index();
                $table->integer('author_id')->index()->nullable();
                $table->string('state', 64)->index();
                $table->text('data');
                $table->dateTime('saved_on')->index();

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
        Schema::dropIfExists(ConfigService::$tableVersions);
    }
}
