<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentFocusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::connection(config('railcontent.database_connection_name'))->create(
                config('railcontent.table_prefix') . 'content_focus',
                function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('content_id')->index();
                    $table->string('focus')->index();
                    $table->integer('position')->index();
                });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
            Schema::dropIfExists(config('railcontent.table_prefix') . 'content_focus');
    }
}