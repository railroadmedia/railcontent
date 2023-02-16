<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateReportedCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'reported_comments',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('comment_id')->index();
                $table->integer('reporter_id')->index();

                $table->dateTime('created_on')->index();

                $table->index(['comment_id', 'reporter_id'], 'cr');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix') . 'reported_comments');
    }
}
