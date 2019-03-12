<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ConfigService;

class RenameDatetimeColumnsUserPermissionTable extends Migration
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
                config('railcontent.table_prefix'). 'user_permissions',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->renameColumn('created_on', 'created_at');
                }
            );

        Schema::connection(ConfigService::$databaseConnectionName)
            ->table(
                config('railcontent.table_prefix'). 'user_permissions',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->renameColumn('updated_on', 'updated_at');
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
                config('railcontent.table_prefix'). 'user_permissions',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->renameColumn('created_at', 'created_on');
                }
            );

        Schema::connection(ConfigService::$databaseConnectionName)
            ->table(
                Cconfig('railcontent.table_prefix'). 'user_permissions',
                function ($table) {
                    /**
                     * @var $table \Illuminate\Database\Schema\Blueprint
                     */
                    $table->renameColumn('updated_at', 'updated_on');
                }
            );
    }
}
