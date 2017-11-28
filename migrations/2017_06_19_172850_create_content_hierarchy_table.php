<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentHierarchyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            ConfigService::$tableContentHierarchy,
            function(Blueprint $table) {
                $table->increments('id');

                $table->integer('parent_id')->index()->nullable();
                $table->integer('child_id')->index();
                $table->integer('child_position')->index();

                $table->unique(['child_id', 'parent_id']);
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
        Schema::dropIfExists(ConfigService::$tableContentHierarchy);
    }
}
