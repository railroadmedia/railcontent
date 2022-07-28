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
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('usora_users');
            $table->json('supported_brands');
            $table->unsignedInteger('active_student_max_count');
            $table->unsignedInteger('active_student_count');
        });

        Schema::create('mentor_students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('usora_users');
            $table->string('primary_brand');
            $table->unsignedInteger('mentor_user_id');
            $table->foreign('mentor_user_id')->references('id')->on('usora_users');
            $table->foreign('mentor_user_id', 'mentor_students_mentors_foreign')->references('user_id')->on('mentors');
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
