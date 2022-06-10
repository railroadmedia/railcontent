<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateIndexesToContentTable extends Migration
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
                $table->index(['published_on'], 'published_on_index');
                $table->index(['created_on'], 'created_on_index');
                $table->index(['type', 'status', 'brand', 'published_on'], 't_s_b_p_index');
                $table->index(['published_on', 'created_on'], 'p_c_index');
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
                $table->dropIndex('published_on_index');
                $table->dropIndex('created_on_index');
                $table->dropIndex('t_s_b_p_index');
                $table->dropIndex('p_c_index');
            });
    }
}