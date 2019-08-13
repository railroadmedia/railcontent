<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class ChangeCommentsCollation extends Migration
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
                ConfigService::$tableComments,
                function ($table) {

                    DB::connection(ConfigService::$databaseConnectionName)
                        ->table(ConfigService::$tableComments)
                        ->where('deleted_at', '0000-00-00 00:00:00')
                        ->update(
                            [
                                'deleted_at' => Carbon::now()
                                    ->toDateTimeString()
                            ]
                        );
                    if (config()->get('database.default') != 'testbench') {
                        DB::connection(ConfigService::$databaseConnectionName)
                            ->statement(
                                'ALTER TABLE ' .
                                ConfigService::$tableComments .
                                ' MODIFY comment TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;'
                            );
                    }
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
                ConfigService::$tableComments,
                function ($table) {

                    DB::connection(ConfigService::$databaseConnectionName)
                        ->statement(
                            'ALTER TABLE ' .
                            ConfigService::$tableComments .
                            ' MODIFY comment TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci;'
                        );
                }
            );
    }
}
