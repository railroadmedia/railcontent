<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_instructors',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->integer('instructor_id')->index();
                $table->integer('position')->index();

                $table->index(['instructor_id', 'content_id'], 'ic');
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
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_instructors');
    }
}
