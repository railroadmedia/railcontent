<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class AddPopularityToContent extends Migration
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
                ConfigService::$tableContent,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->integer('popularity')->after('total_xp')->nullable()->index();
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
                ConfigService::$tableContent,
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */

                    $table->dropColumn('popularity');
                }
            );
        }
    }
}
