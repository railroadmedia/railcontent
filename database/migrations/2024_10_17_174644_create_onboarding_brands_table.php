<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('onboarding_brands', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('brands')->nullable();
            $table->string('first_brand')->nullable();
            $table->string('last_brand')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('usora_users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('onboarding_brands');
    }
};
