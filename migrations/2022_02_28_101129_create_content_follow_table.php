<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO: Should be migrated only for tests
        if(config('railcontent.database_connection_name') == 'testbench') {
            Schema::connection(config('railcontent.database_connection_name'))->create(
                config('railcontent.table_prefix') . 'content_follows',
                function(Blueprint $table) {
                    $table->increments('id');
                    $table->integer('content_id')->index();
                    $table->integer('user_id')->index();
                    $table->dateTime('created_on')->index();
                });
        }
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        if(config('railcontent.database_connection_name') == 'testbench') {
            Schema::dropIfExists(config('railcontent.table_prefix') . 'content_follows');
        }
    }
}