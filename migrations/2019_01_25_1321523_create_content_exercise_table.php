<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->create(
            config('railcontent.table_prefix') . 'content_exercise',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index();
                $table->integer('exercise_id')->index();
                $table->integer('position')->index();

                $table->index(['exercise_id', 'content_id'], 'ec');
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
        Schema::dropIfExists(config('railcontent.table_prefix') . 'content_exercise');
    }
}
