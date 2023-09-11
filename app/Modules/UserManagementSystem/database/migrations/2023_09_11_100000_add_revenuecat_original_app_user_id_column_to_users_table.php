<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRevenuecatOriginalAppUserIdColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->string('revenuecat_origin_app_user_id')->after('is_lifetime_member')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('revenuecat_origin_app_user_id');
        });
    }

}
