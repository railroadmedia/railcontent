<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix'). 'content_statistics',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->string('content_type', 128)->index();
                $table->dateTime('content_published_on')->index()->nullable();
                $table->integer('completes')->index();
                $table->integer('starts')->index();
                $table->integer('comments')->index();
                $table->integer('likes')->index();
                $table->integer('added_to_list')->index();
                $table->dateTime('start_interval')->index();
                $table->dateTime('end_interval')->index();
                $table->integer('week_of_year')->index();
                $table->dateTime('created_on')->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix'). 'content_statistics');
    }
}
