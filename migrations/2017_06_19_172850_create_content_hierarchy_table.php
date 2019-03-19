<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateContentHierarchyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix'). 'content_hierarchy',
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
        Schema::dropIfExists(config('railcontent.table_prefix'). 'content_hierarchy');
    }
}
