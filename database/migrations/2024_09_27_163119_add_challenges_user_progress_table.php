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
        Schema::create('challenges_user_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('content_id');
            $table->dateTime('start_date')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->integer('current_rest_days')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('lessons_meta_data')->nullable();
            // completed Data
            $table->dateTime('last_completed_date')->nullable();
            $table->integer('completed_time_practiced')->nullable();
            $table->integer('completed_best_streak')->nullable();
            $table->index(['user_id', 'content_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges_user_progress');
    }
};
