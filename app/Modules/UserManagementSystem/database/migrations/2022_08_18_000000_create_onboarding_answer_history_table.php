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
        if (!Schema::hasTable('onboarding_answer_history')) {
            Schema::create('onboarding_answer_history', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand')->nullable();
                $table->string('onboarding_question');
                $table->text('onboarding_answer');
                $table->text('coach_name')->nullable();
                $table->timestamps();
            });
        }

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_answer_history');
    }
};
