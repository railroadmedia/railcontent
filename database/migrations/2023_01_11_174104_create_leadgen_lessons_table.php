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
        Schema::create('leadgen_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('leadgen_id');
            $table->string('slug');
            $table->string('title');
            $table->longText('desc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('video_src');
            $table->integer('duration');
            $table->boolean('one_off');
            $table->integer('display_order');
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
        Schema::dropIfExists('leadgen_lessons');
    }
};
