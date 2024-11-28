<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('challenges_user_progress', function (Blueprint $table) {
            $table->boolean('hide_completed_banner')->default(false)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges_user_progress', function (Blueprint $table) {
            $table->dropColumn('hide_completed_banner');
        });
    }
};
