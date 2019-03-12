<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class OptimizeUserPermissionIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            config('railcontent.table_prefix'). 'user_permissions',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropIndex('railcontent_user_permissions_user_id_index');
                $table->dropIndex('railcontent_user_permissions_permission_id_index');
                $table->dropIndex('railcontent_user_permissions_expiration_date_index');

                $table->index(['user_id', 'permission_id', 'expiration_date'], 'ui_pi_ed');
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
        Schema::connection(ConfigService::$databaseConnectionName)->table(
            config('railcontent.table_prefix'). 'user_permissions',
            function ($table) {
                /**
                 * @var $table \Illuminate\Database\Schema\Blueprint
                 */

                $table->dropIndex('ui_pi_ed');

                $table->index('user_id', 'railcontent_user_permissions_user_id_index');
                $table->index('permission_id', 'railcontent_user_permissions_permission_id_index');
                $table->index('expiration_date', 'railcontent_user_permissions_expiration_date_index');
            }
        );
    }
}
