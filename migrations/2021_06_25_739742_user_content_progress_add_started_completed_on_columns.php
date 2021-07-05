<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class UserContentProgressAddStartedCompletedOnColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            ConfigService::$tableUserContentProgress,
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */
                $table->dateTime('started_on')->nullable()->index();
                $table->dateTime('completed_on')->nullable()->index();
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
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            ConfigService::$tableUserContentProgress,
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */
                $table->dropColumn('started_on');
                $table->dropColumn('completed_on');
            }
        );
    }
}
