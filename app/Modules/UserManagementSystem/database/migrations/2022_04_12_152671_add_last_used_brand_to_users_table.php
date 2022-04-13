<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastUsedBrandToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->string('last_used_brand')->after('permission_level')->nullable()->index();
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
            $table->dropColumn('last_used_brand');
        });
    }
}
