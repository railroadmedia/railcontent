<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class UserContentProgressIndexCU extends Migration
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

                $table->index(['content_id', 'user_id'], 'c_u');
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

                $table->dropIndex('c_u');
            }
        );
    }
}
