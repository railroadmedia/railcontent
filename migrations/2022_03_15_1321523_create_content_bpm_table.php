<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentBpmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_bpm',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('bpm')->index();
                $table->integer('position')->index();

                $table->index(['bpm', 'content_id'], 'bmc');
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
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_bpm');
    }
}