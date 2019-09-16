<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeBpmColumnTypeContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content')
            ->where('published_on', '0000-00-00 00:00:00')
            ->update(
                [
                    'published_on' => null                ]
            );

        DB::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content')
            ->where('created_on', '0000-00-00 00:00:00')
            ->update(
                [
                    'created_on' => Carbon::now()
                        ->toDateTimeString()
                ]
            );

        DB::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content')
            ->where('archived_on', '0000-00-00 00:00:00')
            ->update(
                [
                    'archived_on' => Carbon::now()
                        ->toDateTimeString()
                ]
            );

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->string('bpm')
                        ->change();
                    $table->string('fast_bpm')
                        ->change();
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
                config('railcontent.table_prefix') . 'content',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->integer('bpm')
                        ->change();
                    $table->integer('fast_bpm')
                        ->change();
                }
            );
    }
}
