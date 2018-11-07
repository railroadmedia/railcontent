<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class AddIdColumnToSearchIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config()->get('database.default') != 'testbench') {
            //DB::unprepared('ALTER TABLE ' . ConfigService::$tableSearchIndexes . ' DROP PRIMARY KEY');
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' DROP PRIMARY KEY'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' DROP INDEX high_full_text'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' DROP INDEX medium_full_text'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' DROP INDEX low_full_text'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' ADD `id` int unsigned not null auto_increment primary key'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' ADD FULLTEXT high_full_text(high_value)'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                ConfigService::$tableSearchIndexes .
                ' ADD FULLTEXT medium_full_text(medium_value)'
            );
            Schema::connection(ConfigService::$databaseConnectionName)->getConnection()->getPdo()->exec(
                'ALTER TABLE ' . ConfigService::$tableSearchIndexes . ' ADD FULLTEXT low_full_text(low_value)'
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
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            ConfigService::$tableSearchIndexes,
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropColumn('id');
            }
        );
    }
}
