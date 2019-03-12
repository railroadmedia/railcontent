<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            config('railcontent.table_prefix'). 'user_permissions',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->integer('permission_id')->index();
                $table->dateTime('start_date')->index();
                $table->dateTime('expiration_date')->index()->nullable();

                $table->dateTime('created_on')->index();
                $table->dateTime('updated_on')->index()->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix'). 'user_permissions');
    }
}
