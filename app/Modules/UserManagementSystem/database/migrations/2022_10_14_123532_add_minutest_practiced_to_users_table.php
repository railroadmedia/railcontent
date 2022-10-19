<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinutestPracticedToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->json('brand_minutes_practiced')->after('brand_total_xp')->nullable();
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
            $table->dropColumn('brand_minutes_practiced');
        });
    }
}
