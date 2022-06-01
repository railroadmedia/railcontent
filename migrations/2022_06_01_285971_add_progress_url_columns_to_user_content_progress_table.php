<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgressUrlColumnsToUserContentProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_content_progress', function (Blueprint $table) {

                $table->integer('current_child_content_id')
                    ->index('higher_key_progress_index')
                    ->after('higher_key_progress')
                    ->nullable();

                $table->integer('current_child_content_index')
                    ->index('current_child_content_id_index')
                    ->after('current_child_content_id')
                    ->nullable();

                $table->text('current_child_content_url')
                    ->after('current_child_content_index')
                    ->nullable();

                $table->integer('next_child_content_id')
                    ->index('current_child_content_url_index')
                    ->after('current_child_content_url')
                    ->nullable();

                $table->integer('next_child_content_index')
                    ->index('next_child_content_id_index')
                    ->after('next_child_content_id')
                    ->nullable();

                $table->text('next_child_content_url')
                    ->after('next_child_content_index')
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
            ->table(config('railcontent.table_prefix') . 'user_content_progress', function (Blueprint $table) {
                $table->dropColumn('current_child_content_id');
                $table->dropColumn('current_child_content_index');
                $table->dropColumn('current_child_content_url');
                $table->dropColumn('next_child_content_id');
                $table->dropColumn('next_child_content_index');
                $table->dropColumn('next_child_content_url');
            });
    }
}