<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentDataColumnToContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                $table->json('parent_content_data')
                    ->after('hierarchy_position_number')
                    ->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                $table->dropColumn('parent_content_data');
            });
    }
}