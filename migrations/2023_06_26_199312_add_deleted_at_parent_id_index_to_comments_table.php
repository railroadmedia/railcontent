<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtParentIdIndexToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))->table(
            config('railcontent.table_prefix') . 'comments',
            function (Blueprint $table) {
                $table->index(['parent_id', 'deleted_at'], 'parent_id_deleted_at_index');
            }
        );
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
            ->table(config('railcontent.table_prefix') . 'comments', function (Blueprint $table) {
                $table->dropIndex('parent_id_deleted_at_index');
            });
    }
}