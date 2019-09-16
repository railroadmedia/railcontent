<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeCommentsCollation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'comments',
                function ($table) {

                    DB::connection(config('railcontent.database_connection_name'))
                        ->table(config('railcontent.table_prefix') . 'comments')
                        ->where('deleted_at', '0000-00-00 00:00:00')
                        ->update(
                            [
                                'deleted_at' => Carbon::now()
                                    ->toDateTimeString(),
                            ]
                        );

                    if (config('railcontent.database_connection_name') != 'testbench') {
                        DB::connection(config('railcontent.database_connection_name'))
                            ->statement(
                                'ALTER TABLE ' .
                                config('railcontent.table_prefix') .
                                'comments' .
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
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'comments',
                function ($table) {

                    DB::connection(config('railcontent.database_connection_name'))
                        ->statement(
                            'ALTER TABLE ' .
                            config('railcontent.table_prefix') .
                            'comments' .
                            ' MODIFY comment TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci;'
                        );
                }
            );
    }
}
