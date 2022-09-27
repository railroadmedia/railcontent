<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class AddContentInstructorsToSearchIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config()->get('database.default') != 'testbench' && app()->environment() != 'testing') {
            Schema::connection(ConfigService::$databaseConnectionName)->table(
                ConfigService::$tableSearchIndexes,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->string('content_instructors',64)->after('content_status')->nullable()->index();
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
        if (config()->get('database.default') != 'testbench' && app()->environment() != 'testing') {

            Schema::connection(ConfigService::$databaseConnectionName)->table(
                ConfigService::$tableSearchIndexes,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->dropColumn('content_instructors');
                }
            );
        }
    }
}
