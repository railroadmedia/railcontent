<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('onboarding_gears')) {
            return;
        }
        Schema::create('onboarding_gears', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('brand');
            $table->string('gear');
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
        Schema::dropIfExists('onboarding_gears');
    }
}
