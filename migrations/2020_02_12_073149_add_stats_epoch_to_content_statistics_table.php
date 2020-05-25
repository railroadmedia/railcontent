<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class AddStatsEpochToContentStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix'). 'content_statistics',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->integer('stats_epoch')->after('week_of_year')->index()->nullable();
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
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix'). 'content_statistics',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropColumn('stats_epoch');
            }
        );
    }
}
