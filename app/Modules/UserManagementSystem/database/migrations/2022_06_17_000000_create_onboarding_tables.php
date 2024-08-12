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
        if (!Schema::hasTable('onboarding_gears')) {
            Schema::create('onboarding_gears', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand');
                $table->string('gear');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('onboarding_topics')) {
            Schema::create('onboarding_topics', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand');
                $table->string('topic');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('onboarding_genres')) {
            Schema::create('onboarding_genres', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand');
                $table->string('genre');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('onboarding_experience')) {
            Schema::create('onboarding_experience', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand');
                $table->string('experience_level');
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_gears');
        Schema::dropIfExists('onboarding_topics');
        Schema::dropIfExists('onboarding_genres');
        Schema::dropIfExists('onboarding_experience');
    }
};
