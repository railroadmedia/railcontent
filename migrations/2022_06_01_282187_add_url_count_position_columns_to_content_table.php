<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlCountPositionColumnsToContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix').'content', function (Blueprint $table) {
                $table->text('web_url_path')
                    ->after('popularity')
                    ->nullable();

                $table->text('mobile_app_url_path')
                    ->after('web_url_path')
                    ->nullable();

                $table->integer('child_count')
                    ->index()
                    ->after('mobile_app_url_path')
                    ->nullable();

                $table->integer('hierarchy_position_number')
                    ->index()
                    ->after('child_count')
                    ->nullable();

                $table->integer('like_count')
                    ->index()
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
            ->table(config('railcontent.table_prefix').'content', function (Blueprint $table) {
                $table->dropColumn('web_url_path');
                $table->dropColumn('mobile_url_path');
                $table->dropColumn('child_count');
                $table->dropColumn('hierarchy_position_number');
                $table->dropColumn('like_count');
            });
    }
}