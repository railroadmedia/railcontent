<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('user_access_permissions', function (Blueprint $table) {
            $table->dateTime('time_fixed')->nullable()->after('time_lifetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('user_access_permissions', function (Blueprint $table) {
            $table->dropColumn('time_fixed');
        });
    }
};
