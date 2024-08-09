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
        if (!Schema::hasTable('onboarding_goals')) {
            Schema::create('onboarding_goals', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand');
                $table->string('goals');
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_goals');
    }
};
