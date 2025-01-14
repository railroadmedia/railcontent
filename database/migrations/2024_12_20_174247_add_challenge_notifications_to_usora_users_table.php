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
        Schema::table('usora_users', function (Blueprint $table) {
            $table->json('challenges_enrollment_notifications')->after('notify_on_lesson_comment_reply')->nullable();
            $table->json('challenges_community_notifications')->after('challenges_enrollment_notifications')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usora_users', function (Blueprint $table) {
            $table->dropColumn('challenges_enrollment_notifications');
            $table->dropColumn('challenges_community_notifications');
        });
    }
};
