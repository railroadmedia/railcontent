<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Railroad\Railcontent\Services\ConfigService;

class CreateContentPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(ConfigService::$databaseConnectionName)->create(
            config('railcontent.table_prefix'). 'content_permissions',
            function(Blueprint $table) {
                $table->increments('id');
                $table->integer('content_id')->index()->nullable();
                $table->string('content_type', 64)->index()->nullable();
                $table->integer('permission_id')->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('railcontent.table_prefix'). 'content_permissions');
    }
}
