<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


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
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes' .
                ' DROP PRIMARY KEY'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes'.
                ' DROP INDEX high_full_text'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes' .
                ' DROP INDEX medium_full_text'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes' .
                ' DROP INDEX low_full_text'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes' .
                ' ADD `id` int unsigned not null auto_increment primary key'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes' .
                ' ADD FULLTEXT high_full_text(high_value)'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' .
                config('railcontent.table_prefix'). 'search_indexes' .
                ' ADD FULLTEXT medium_full_text(medium_value)'
            );
            Schema::connection(config('railcontent.database_connection_name'))->getConnection()->getPdo()->exec(
                'ALTER TABLE ' . config('railcontent.table_prefix'). 'search_indexes' . ' ADD FULLTEXT low_full_text(low_value)'
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
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix'). 'search_indexes',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropColumn('id');
            }
        );
    }
}
