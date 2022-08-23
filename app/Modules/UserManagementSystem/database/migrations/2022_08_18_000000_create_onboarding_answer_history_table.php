<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingAnswerHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('onboarding_answer_history')) {
            Schema::create('onboarding_answer_history', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('brand')->nullable();
                $table->string('onboarding_question');
                $table->text('onboarding_answer');
                $table->timestamps();
            });
        }

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onboarding_answer_history');
    }
}
