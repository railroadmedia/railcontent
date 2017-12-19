<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class AddContentStatusToSearchIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config()->get('database.default') != 'testbench') {
            Schema::connection(ConfigService::$databaseConnectionName)->table(
                ConfigService::$tableSearchIndexes,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->string('content_status', 64)->after('content_type')->index();
                }
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (config()->get('database.default') != 'testbench') {

            Schema::connection(ConfigService::$databaseConnectionName)->table(
                ConfigService::$tableSearchIndexes,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->dropColumn('content_status');
                }
            );
        }
    }
}
