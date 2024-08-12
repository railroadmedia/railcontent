<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->string('access_level')->after('last_used_brand')->nullable()->index();
            $table->integer('total_xp')->after('access_level')->nullable()->index();
            $table->json('brand_method_levels')->after('total_xp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('access_level');
            $table->dropColumn('total_xp');
            $table->dropColumn('brand_method_levels');
        });
    }
};
