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
            $table->boolean('solo_notification_to_be_processed')->after('is_solo')->default(0);
        });
        Schema::table('usora_users', function (Blueprint $table) {
            $table->json('challenges_solo_notifications')->after('challenges_community_notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges_user_progress', function (Blueprint $table) {
            $table->dropColumn('solo_notification_to_be_processed');
        });
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('challenges_solo_notifications');
        });
    }
};
