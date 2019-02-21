<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class DropUserContentProgressUniqueIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)
            ->table(
                ConfigService::$tableUserContentProgress,
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
        Schema::connection(ConfigService::$databaseConnectionName)
            ->table(
                ConfigService::$tableUserContentProgress,
                function (Blueprint $table) {

                    $table->unique(['content_id', 'user_id']);

                }
            );
    }
}
