<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SQLite doesn't allow us to add a NOT NULL column with default value NULL, which is fixed in 2023_11_04_222532_permissions_fixed.php
        if (Schema::getConnection()->getDriverName() !== "sqlite") {
            Schema::table('user_access_permissions', function (Blueprint $table) {
                $table->integer('time_minutes')->after('start_time');
            });
        } else {
            Schema::table('user_access_permissions', function (Blueprint $table) {
                $table->integer('time_minutes')->nullable()->after('start_time');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_access_permissions', function (Blueprint $table) {
            $table->dropColumn('time_minutes');
        });
    }
};
