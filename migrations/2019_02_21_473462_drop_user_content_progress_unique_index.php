<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class DropUserContentProgressUniqueIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix'). 'user_content_progress',
                function (Blueprint $table) {

                    $table->dropIndex('railcontent_user_content_progress_content_id_user_id_unique');

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
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix'). 'user_content_progress',
                function (Blueprint $table) {

                    $table->unique(['content_id', 'user_id']);

                }
            );
    }
}
