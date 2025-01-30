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
            $table->unique(['content_id', 'user_id'], 'c_u_i');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges_user_progress', function (Blueprint $table) {
            $table->dropIndex('c_u_i');
        });
    }
};
