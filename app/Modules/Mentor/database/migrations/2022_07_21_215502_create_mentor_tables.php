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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->string('supported_brands');
            $table->integer('active_student_max_count');
            $table->integer('active_student_count');
        });

        Schema::create('mentor_students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->string('primary_brand');
            $table->integer('mentor_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentors');
        Schema::dropIfExists('mentor_students');
    }
};
