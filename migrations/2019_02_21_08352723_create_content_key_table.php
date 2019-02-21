<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_key',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('key')->index();
                $table->integer('position')->index();

                $table->index(['key', 'content_id'], 'kc');
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
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_key');
    }
}
