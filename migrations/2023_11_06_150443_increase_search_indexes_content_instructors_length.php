<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncreaseSearchIndexesContentInstructorsLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config()->get('database.default') != 'testbench' && app()->environment() != 'testing') {
            Schema::connection(config('railcontent.database_connection_name'))->table(
                config('railcontent.table_prefix') . 'search_indexes',
                function (Blueprint $table) {
                    $table->string('content_instructors', 128)->change();
                }
            );
        }
    }


    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        if (config()->get('database.default') != 'testbench' && app()->environment() != 'testing') {
            Schema::connection(config('railcontent.database_connection_name'))->table(
                config('railcontent.table_prefix') . 'search_indexes',
                function (Blueprint $table) {
                    $table->string('content_instructors', 64)->change();
                }
            );
        }
    }
}