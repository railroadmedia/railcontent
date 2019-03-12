<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix'). 'comment_assignment',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('comment_id')->index();
                $table->integer('user_id')->index();
                $table->dateTime('assigned_on')->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix'). 'comment_assignment');
    }
}
