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
        Schema::create('leadgen_lesson_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('leadgen_id')->nullable();
            $table->integer('leadgen_lesson_id')->nullable();
            $table->string('title');
            $table->string('src')->nullable();
            $table->string('soundslice')->nullable();
            $table->boolean('score')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('leadgen_lesson_assets');
    }
};
