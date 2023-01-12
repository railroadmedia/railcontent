<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leadgen_lesson_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('leadgen_lesson_id');
            $table->string('title');
            $table->string('src');
            $table->string('soundslice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leadgen_lesson_assets');
    }
};
